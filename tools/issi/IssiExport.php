<?php

use ISSI\ActionRegDetailsType;
use ISSI\AdditionalCreditorsDetailsType;
use ISSI\AdditionalDebtorsDetailsType;
use ISSI\CasesRegDetailsType;
use ISSI\DeliveryType;
use ISSI\EntityBasicDataType;
use ISSI\IncomingRegDetailsType;
use ISSI\OutgoingRegDetailsType;
use ISSI\PersonBasicDataType;
use ISSI\PersonIdentifierType;
use ISSI\SubjectType;


/**
 * Класът IssiExport служи за извличането на информация от базата данни
 * на системата и обработването и във вид готов за изпращане към системата
 * на ИССИ.
 * 
 * @created 21.03.2024 
 */

class IssiExport {

    /**
     * Връща времевата зона, в която се намира България.
     * зоната е нужна при създаване на инстанция на класа DateTime,
     * форматът за подаване на дата и време от моделите на ИССИ
     * 
     * @return DateTimeZone GMT зоната на България
     */
    public static function getTimeZone() {
        return new DateTimeZone('Etc/GMT-2');
    }

    /**
     * Взима стойността на дълга по зададено дело. Използва
     * системта и по-конкретно 'caseeditzone.php'. Като му задава зоната - 2,
     * id на дело и функционалност - view.
     * 
     * @param string $caseId Id на делото в нашата система,
     *  
     * @return double $recatot Променлива от cazo2.php, която съдържа стойността
     * на дълга към делото.
     */
    public static function getDept($caseId) {

        global $DB, $smarty, $arhist, $lastdate, $lastcapi, $lastinte;
        $_GET['edit=' . $caseId . '&func=view&zone=2'] = '';

        /* Сесиини променливи, които се използват в системата и са нужни иначе,
        хвърля "die" с дадента грешка. */
        $caseData = $DB->select("SELECT * FROM suit WHERE id = {$caseId}");
        $caseData = $caseData[0];
        session_start();
        $_SESSION["extraint"] = $caseData["extraint"];

        $minsal = $DB->select("SELECT * FROM office LIMIT 1");
        $minsal = $minsal[0]['minsal'];
        $_SESSION["minsal"] = $minsal;

        // Везето от системата csi. Вътре е описано коя част от кой файл е.
        include 'csi_sys/calculateDebt.php';

        return is_null($recatot) ? 0 : $recatot;
    }

    /**
     * Уеднаквява кодовете на нашата система и тази на ИССИ за типа на
     * вземане по дадено дело.
     * 
     * @param string $idTypeReg Кода от нашата система.
     * 
     * @return int $deptTypes[$idTypeReg] Кода, който очаква системата на ИССИ. 
     */
    public static function getDeptType($idTypeReg) {
        
        // Keys - кодове в нашата система, Values - кодове в системат6а на ИССИ
        $deptTypes = array(
            1 => 2, // частно вземане - частно
            2 => 2, // частно държавно вземане - частно
            3 => 2, // частно общинско вземане - частно
            4 => 1, // публично държавно вземане - публично
            5 => 1, // публично общинскo вземане - публично
        );

        return $deptTypes[$idTypeReg];
    }

    /**
     * Генерира дългия код на дело.
     * Формат: {година}{номер на ЧСИ}04{Сериен номер на дело(5 цифри)}
     * 
     * @param string $serial Сериен номе на дело
     * @param string $year Година на дело.
     * @param string $agentNum Номер на ЧСИ.
     * 
     * @return string Генерирания дълъг номер
     */
    public static function generateCaseNum($serial, $year, $agentNum) {
        $serial = str_pad((string)$serial, 5, '0', STR_PAD_LEFT);

        return $year . $agentNum . '04' . $serial;
    }

    /**
     * Генерира тип на изв. действия от номенклатурните типове на ИССИ.
     * 
     * @param int $actionType Тип на извършеното действие в нашата система т.е. от коя таблица е.
     * @param int $aditionalType Допълнителен вид. Взима се от различни полета, в зависимост от 
     * таблицата от която е взето изършеното действие.
     * 
     * @return int Код на извършеното действие.
     */
    public static function getActionType($actionType, $aditionalType) {
        switch($actionType) {
            case '0':
                // Таблица jour
                $actionTypes = array(
                    0 => 0,
                    1 => 199,
                    2 => 199,
                    3 => 202,
                    4 => 201,
                    5 => 0,
                );
                
                return $actionTypes[$aditionalType];
            case '1':
                // Таблица docu
                if($aditionalType >= 196 && $aditionalType <= 206) {
                    return $aditionalType;
                }

                break;
            case '2':
                // Таблица docuout
                if($aditionalType >= 196 && $aditionalType <= 206) {
                    return $aditionalType;
                }
                break;
            case '3':
                // Таблица finance
                return 204;
                break;
            case '4':
                // Таблица post
                if($aditionalType >= 196 && $aditionalType <= 206) {
                    return $aditionalType;
                }
                break;
            case '5':
                // Таблица finance
                return 205;
            case '6':
                // Таблица a aainvita
                if($aditionalType >= 196 && $aditionalType <= 206) {
                    return $aditionalType;
                }
                break;
        }

        return 0;
    }

    /**
     * Взима информацията за ЧСИ, управляващо текущатата система, от базата данни.
     * Взима име и номер.
     * 
     * @return array Инормацияата за ЧСИ-то под формата на масив.
     * Ключове:
     * agentName - име;
     * agentRegNum - номер.
     */
    public static function getAgentData() {
        global $DB;

        $queryAgent = "SELECT 
            o.fullname as agentName,
            o.serial as agentRegNum
        FROM office o LIMIT 1";

        $data = $DB->select($queryAgent);
        return $data[0];
    }

    /**
     * От предоставена информация за дадено лице прави инстанция на класа SubjectType.
     * 
     * @param array $subjectData Масив с информацията за дадено лице.
     * Ключове:
     * subjectType - тип на лицето - физическо/юридическо(2-физическо, друго(1,3)-юридическо);
     * subjectName - име на лицето;
     * subjectEgn - ЕГН на лицето(може да е празно);
     * subjectBulstat - Булстат на лицето(може да е празно);
     * subjectAddress - Адрес на лицето.
     * 
     * @return SubjectType $subject Инстанция на класа, съдържаща информацията за дадено лице.
     */
    public static function createSubject($subjectData) {
        $subject = new SubjectType;

        if ($subjectData['subjectType'] == 2) {
            $person = new PersonBasicDataType();

            $person->setName($subjectData['subjectName']);

            $personId = new PersonIdentifierType();
            $personId->setEGN($subjectData['subjectEgn']);
            $person->setIdentifier($personId);

            $person->setAddress($subjectData['subjectAddress']);

            $subject->setPerson($person);
        } else {
            $entity = new EntityBasicDataType();

            $entity->setName($subjectData['subjectName']);
            $entity->setIdentifier($subjectData['subjectBulstat']);
            $entity->setAddress($subjectData['subjectAddress']);

            $subject->setEntity($entity);
        }

        return $subject;
    }

    /**
     * Уеднаквява кодовете на нашата система и тази на ИССИ за начин
     * на изпращане/получаване на документ.
     * 
     * @param string $postType Кода от нашата система.
     * 
     * @return int $deliveryCodes[$postType] Кода, който очаква системата на ИССИ. 
     */
    public static function getDeliveryCode($postType) {

        // Keys - кодове в нашата система, Values - кодове в системат6а на ИССИ
        $deliveryCodes = array(
            1 => 1, // По пощата - Препоръчано писмо
            2 => 7, // Призовкар - Лично
            3 => 3, // Куриер - Куриер
            4 => 4, // Електронна поща - Електронна поща
            9 => 0, // НЕ СЕ ВРЪЧВА - ""
        );

        return $deliveryCodes[$postType];
    }

    /**
     * По подаден код за начин на испращане/получаване на документ от номенклатурните кодове
     * на ИССИ, връща наименованието на начина на изпращане/получаване.
     * 
     * @param int $deliveryCode Номенклатурния код.
     * 
     * @param string $deliveryType[$deliveryCode] Наименованието на начина на изпращане/получаване.
     */
    public static function getDeliveryName($deliveryCode) {
        $deliveryType = array(
            0 => '',
            1 => 'Препоръчано писмо',
            2 => 'Обратна разписка',
            3 => 'Куриер',
            4 => 'Електронна поща',
            5 => 'Факс',
            6 => 'Сигурно връчване',
            7 => 'Лично',
        );
        
        return $deliveryType[$deliveryCode];
    }

    /**
     * По подадено Id на дело в нашата система, връща готова инстанция за подаване дело
     * за изпращане към системата ИССИ. Взима информацията от нашата база данни.
     * 
     * @param int $caseId Id на делото.
     * 
     * @return CasesRegDetailsType $caseRegDetails Инстанция с всичката необходима за
     * изпращане на информация за дадено дело.
     */
    public static function getDataForCase($caseId){
        global $DB;

        /* Заявка за основните данни на дадено дело. Извлича:
            s.year, s.serial - година и сериен номер, за генериране на пълния номер на делото;
            s.created - дата на съсздаване на делото;
            s.text - описание на делото;
            s.claimdesrip - описание на дълга;
            s.idstat - статус на делото;
            s.timestat - дата на извършено действие от статуса;
            s.idtypereg4 - тип на взимането;
            cf.name - съда, който ръководи делото;
            co.name - произход на дълга;
        */
        $queryCase = "SELECT
            s.year as year,
            s.serial as serial,
            s.created as caseDate,
            s.text as description,
            s.claimdescrip as deptDescription,
            s.idstat as caseStatus,
            s.timestat as caseStatusDate,
            s.idtypereg4 as deptType,
            cf.name as courtCase,
            co.name as deptOrigin
            FROM suit s
            LEFT JOIN cofrom cf ON cf.id = s.idcofrom
            LEFT JOIN claimorigin co ON co.id = s.idclaimorig
            WHERE s.id = {$caseId}
        ";

        // Заявка за данните на взискателите по дадено дело.
        $queryClaimers = "SELECT
            c.id as id,
            c.idtype as subjectType,
            c.egn as subjectEgn,
            c.bulstat as subjectBulstat,
            c.name as subjectName,
            c.address as subjectAddress
            FROM claimer c
            WHERE c.idcase = {$caseId}
            ORDER BY c.id
        ";

        // Заявка за данните на длъжниците по дадено дело.
        $queryDebtors = "SELECT
            d.idtype as subjectType,
            d.egn as subjectEgn,
            d.bulstat as subjectBulstat,
            d.name as subjectName,
            d.address as subjectAddress
            FROM debtor d
            WHERE d.idcase = {$caseId}
            ORDER BY d.id
            ";

        /* Заявка за първия документ по дадено дело.
            Необходим за да се вземе регистационния номер и 
            дата на документа за регистриция делото. */
        $queryDocuments = "SELECT
            CONCAT(do.serial, '/', do.year) as regNumber,
            do.created as regDate
            FROM docu do
            INNER JOIN docusuit dos ON dos.iddocu = do.id
            WHERE dos.idcase = {$caseId}
            ORDER BY do.created
            LIMIT 1
        ";

        // Изпълняатв се заявките и информцията се съмбира в $caseData.
        $caseData = $DB->select($queryCase);
        $caseData = $caseData[0];

        $caseData['claimers'] = $DB->select($queryClaimers);
        $caseData['debtors'] = $DB->select($queryDebtors);
        $regData = $DB->select($queryDocuments);
        $regData = $regData[0];
        $caseData = array_merge($caseData, $regData);

        // Взима се информацията за ЧСИ.
        $agentData = self::getAgentData();
        $caseData = array_merge($caseData, $agentData);

        // Взима се сумата на дълга за делото.
        $caseData['debt'] = self::getDept($caseId);

        // Уеднаквяват се кодовете за типа на вземане
        $caseData['deptType'] = self::getDeptType($caseData['deptType']);

        // Формира се пълния номер на делото.
        $caseData['caseNum'] = self::generateCaseNum($caseData['serial'], $caseData['year'], $caseData['agentRegNum']);

        /* Форматиране на информациата в инстанция на калас CasesRegDetailsType.
            Там, където има дати, е необходимо да се подадът във формат DateTime.
        */
        $caseRegDetails = self::caseArrayToObject($caseData);

        return $caseRegDetails;
    }

    /**
     * По подадена информация за извършено действие в нашата система, връща готова инстанция за
     * за изпращане към системата ИССИ. Взима информацията от нашата база данни.
     * 
     * @param int $actionId Id на действието.
     * @param int $actionRegNumver Пореден номер на действието.
     * @param int $actionType Типа на действието. Т.е. от коя таблица е.
     *      Типове:
     *          0 - jour,
     *          1 - docu,
     *          2 - docuout,
     *          4 - post,
     *          5 - finance,
     *          6 - aainvita
     * @param int $claimer Id на взискател. Нужно при плажанията. По пoдразбиране е нула.
     *      (При таблица различна от finance).
     * 
     * @return ActionRegDetailsType $actionRegDetails Инстанция с всичката необходима за
     * изпращане на информация за дадено изв. действие.
     */
    public static function getDataForAction($actionId, $actionRegNumber, $actionType, $claimer = 0) {
        global $DB;

        /* Заявка за данните за дадено изв. действие. 
            Взета от jour.php. Взима данни от jour,
            docu, docuout, post, finance и aainvita
        */
        $query = "(SELECT
            j.id AS id,
            s.serial AS caseSerial,
            s.year AS caseYear,
            s.created AS caseDate,
            j.created AS actionDate,
            j.descrip AS description,
            j.person AS subjectName,
            0 AS actionType,
            j.idchar AS aditionalType
        FROM jour j
        LEFT JOIN joursuit js ON js.idjour = j.id
        LEFT JOIN suit s ON s.id = js.idcase
        WHERE j.id = {$actionId} AND {$actionType} = 0)
            UNION ALL
        (SELECT 
            d.id AS id,
            '' AS caseSerial,
            '' AS caseYear,
            '' AS caseDate,
            d.created AS actionDate,
            d.text AS description,
            '' AS subjectName,
            1 AS actionType,
            idi.id_doc_sub_category as docSubCategoryCode
        FROM docu d
        LEFT JOIN issi_docu_incoming idi ON idi.id_docutype = d.idtype 
        WHERE d.id = {$actionId} AND {$actionType} = 1)
            UNION ALL
        (SELECT 
            do.id AS id,
            s.serial AS caseSerial,
            s.year AS caseYear,
            s.created AS caseDate,
            do.registered AS actionDate,
            CASE 
                when do.isentered = 1 then do.descrip 
            ELSE 
                dt.text 
            END 
            AS description,
            do.adresat AS subjectName,
            2 AS actionType,
            ido.id_doc_sub_category AS aditionalType
        FROM docuout do
        LEFT JOIN suit s ON s.id = do.idcase
        LEFT JOIN docutype dt ON dt.id = do.iddocutype
        LEFT JOIN issi_docu_outgoing ido ON ido.id_docutype = do.iddocutype
        WHERE do.id = {$actionId} AND {$actionType} = 2)
            UNION ALL
        (SELECT 
            p.id AS id,
            s.serial AS caseSerial,
            s.year AS caseYear,
            s.created AS caseDate,
            IF(p.date2='', p.date3, p.date2) AS actionDate,
            CONCAT(
                'връчване',
                ' ',
                CASE p.idposttype 
                    WHEN 0 THEN '' 
                    WHEN 1 THEN 'по пощата' 
                    WHEN 2 THEN 'призовкар' 
                    WHEN 3 THEN 'куриер' 
                    WHEN 4 THEN 'email'  
                END,
                ' ',
                CASE 
                    WHEN do.isentered = 1 THEN do.descrip 
                ELSE 
                    dt.text 
                END,
                ' ',
                ps.name
            ) AS desription,
            p.adresat AS subjectName,
            6 AS actionType,
            ido.id_doc_sub_category AS aditionalType
        FROM post p
        LEFT JOIN poststat ps ON ps.id = p.idpoststat 
        LEFT JOIN docuout do ON do.id = p.iddocuout
        LEFT JOIN docutype dt ON dt.id = do.iddocutype
        LEFT JOIN suit s ON s.id = do.idcase
        LEFT JOIN issi_docu_outgoing ido ON ido.id_docutype = do.iddocutype
        WHERE p.id = {$actionId} AND {$actionType} = 6)
            UNION ALL
        (SELECT 
            a.id AS id,
            s.serial AS caseSerial,
            s.year AS caseYear,
            s.created AS caseDate,
            a.date AS actionDate,
            CONCAT(
                'връчена ПДИ изх.док.',
                do.serial,
                '/',
                do.year
            ) AS description,
            a.person as subjectName,
            4 AS actionType,
            ido.id_doc_sub_category AS aditionalType 
        FROM aainvita a
        LEFT JOIN docuout do ON do.id = a.iddocuout
        LEFT JOIN suit s ON s.id = do.idcase
        LEFT JOIN issi_docu_outgoing ido ON ido.id_docutype = do.iddocutype
        WHERE a.id = {$actionId} AND {$actionType} = 4)
            UNION ALL
        (SELECT
            f.id AS id,
            s.serial AS caseSerial,
            s.year AS caseYear,
            s.created AS caseDate,
            f.created AS actionDate, 
            c.name AS description,
            '' as subjectName,
            5 as actionType,
            0 as aditionalType
        FROM finance f
        LEFT JOIN suit s ON f.idcase = s.id
        LEFT JOIN claimer c ON c.id = {$claimer} 
        WHERE f.id = {$actionId} AND {$actionType} = 5)
        ";

        $actionData = $DB->select($query);
        $actionData = $actionData[0];

        $actionData['actionNumber'] = $actionRegNumber;

        // Генериране на вид на действието.
        $actionData['actionType'] = self::getActionType($actionData['actionType'], $actionData['aditionalType']);

        // Генериране на описанието, ако действието е плащане.
        if($actionType == 5) {
            $amount = $DB->select("SELECT * FROM finance WHERE id = {$actionId}");
            $amount = $amount[0]["toclai"];
            $amount = unsetoclai($amount);
            $amount = $amount[$claimer];
            $actionData['description'] = mb_convert_encoding('извършено плащане ' . $amount . ' лв към ', "UTF-8", "Windows-1251") . $actionData['description'];
        }

        /* Форматиране на информациата в инстанция на калас ActionRegDetailsType.
            Там, където има дати, е необходимо да се подадът във формат DateTime.
        */
        $actionRegDetails = self::actionArrayToObject($actionData);

        return $actionRegDetails;
    }

    /**
     * По подадено Id на изходящ документ в нашата система, връща готова инстанция за подаване на 
     * изходящ документ за изпращане към системата ИССИ. Взима информацията от нашата база данни.
     * 
     * @param int $outgoingId Id на изходящия документ.
     * 
     * @return OutgoingRegDetailsType $outgoingData Инстанция с всичката необходима за
     * изпращане на информация за изходящ документ.
     */
    public static function getDataForOutgoing($outgoingId) {
        global $DB;

        /* Заявка за данните за дадено изходящ документ. Извлича:
            do.serial - сериен номер на документа;
            do.registered - дата на документа;
            s.year, s.serial - година и сериен номер, за генериране на пълния номер на делото;
            s.created - дата на съсздаване на делото;
            do.adresat - информация за лицето получател.
            p.idposttype - код на типа на доставка(курирер, e-mail и др.);
            do.descrip - описание на документа;
            p.date2 - дата на получаване;
            ido.id_doc_sub_category - номеклатурен код от исси за тип на документа.
        */
        $query = "SELECT
        do.serial as regNumber,
        do.registered as regDate,
        s.serial as caseSerial,
        s.year as caseYear,
        s.created as caseDate,
        do.adresat as subjectName,
        p.idposttype as delivery,
        CASE 
            WHEN do.isentered = 1 THEN do.descrip 
        ELSE 
            IF(dt.textout = '', dt.text, dt.textout)
        END as description,
        p.date2 as deliveryDate,
        ido.id_doc_sub_category as docSubCategoryCode
        FROM docuout do
        LEFT JOIN docutype dt ON dt.id = do.iddocutype
        LEFT JOIN suit s ON s.id = do.idcase
        LEFT JOIN post p ON p.iddocuout = do.id
        LEFT JOIN issi_docu_outgoing ido ON ido.id_docutype = do.iddocutype
        WHERE do.id = {$outgoingId}
        ";

        $outgoingData = $DB->select($query);
        $outgoingData = $outgoingData[0];

        /* Уеднаквяване на типовете за изпращане на документ в нашата система с
        номенклатурните типове на ИССИ*/
        $outgoingData['delivery'] = self::getDeliveryCode($outgoingData['delivery']);

        /* Форматиране на информациата в инстанция на калас OutgoingRegDetailsType.
            Там, където има дати, е необходимо да се подадът във формат DateTime.
        */
        $outgoingReg = self::outgoingArrayToObject($outgoingData);

        return $outgoingReg;
    }

    /**
     * По подадено Id на входящ документ в нашата система, връща готова инстанция за подаване изходящ
     * документ за изпращане към системата ИССИ. Взима информацията от нашата база данни.
     * 
     * @param int $incomingId Id на входящия документ.
     * 
     * @return IncomingRegDetailsType $incomingReg Инстанция с всичката необходима за
     * изпращане на информация за входящ документ.
     */
    public static function getDataForIncoming($incomingId) {
        global $DB;

        /* Заявка за данните за дадено изходящ документ. Извлича:
            d.serial - сериен номер на документа;
            d.created - дата на документа;
            s.year, s.serial - година и сериен номер, за генериране на пълния номер на делото;
            s.created - дата на съсздаване на делото;
            d.from - информация за лицето подател.
            d.text - описание на документа;
            idi.id_doc_sub_category - номеклатурен код от исси за тип на документа.
        */
        $query = "SELECT
        d.serial as regNumber,
        d.created as regDate,
        s.serial as caseSerial,
        s.year as caseYear, 
        s.created as caseDate,
        d.from as subjectName,
        d.text as description,
        idi.id_doc_sub_category as docSubCategoryCode
        FROM docu d
        LEFT JOIN docusuit ds ON ds.iddocu = d.id
        LEFT JOIN suit s ON s.id = ds.idcase
        LEFT JOIN issi_docu_incoming idi ON idi.id_docutype = d.idtype 
        WHERE d.id = {$incomingId}
        ";

        $incomingData = $DB->select($query);
        $incomingData = $incomingData[0];

        /* Поради липсата на информация за начина на получаване на документ,
        всички входни регистри се изпращат към ИССИ с код 7(лично)*/
        $incomingData['delivery'] = 7;
        
        /* Форматиране на информациата в инстанция на калас OutgoingRegDetailsType.
            Там, където има дати, е необходимо да се подадът във формат DateTime.
        */
        $incomingReg = self::incomingArrayToObject($incomingData);

        return $incomingReg;
    }

    /**
     * Връща готова за генериране на xml файла информация за всички входящи
     * документи за дадена дата.
     * 
     * @param Datetime $date Дата
     * 
     * @return IncomingRegDetailsType[] $incomingRegDetails Масив с цялата информация.
     */
    public static function getAllIncomingFromDate($date) {
        global $DB;

        $date = $date->format('Y-m-d');
        $query = "SELECT
        d.id as id, 
        d.serial as regNumber,
        d.created as regDate,
        s.serial as caseSerial,
        s.year as caseYear, 
        s.created as caseDate,
        d.from as subjectName,
        d.text as description,
        idi.id_doc_sub_category as docSubCategoryCode 
        FROM docu d
        LEFT JOIN docusuit ds ON ds.iddocu = d.id
        LEFT JOIN suit s ON s.id = ds.idcase
        LEFT JOIN issi_docu_incoming idi ON idi.id_docutype = d.idtype  
        WHERE d.created LIKE '{$date}%'";

        $incomingRegData = $DB->select($query);
        
        $incomingRegDetails = array();
        foreach($incomingRegData as $element) {
            $element['delivery'] = 7;

            // Проверка за възникнала грешка в типа на данните
            try {
                $newIncoming = self::incomingArrayToObject($element);
                $incomingRegDetails[] = $newIncoming;

                $logData = 'Successfull Incoming: id = ' . $element['id'] . "\n";
                $logData .= "----------------------------------------------\n";
                $logData .= 'regNumber: ' . $newIncoming->getRegNumber(). "\n";
                $logData .= 'regDate: ' . $newIncoming->getRegDate()->format('Y-m-d') . "\n";
                $logData .= 'caseNum: ' . $newIncoming->getCaseNum() . "\n";
                $logData .= 'caseDate: ' . ($newIncoming->getCaseDate() ? $newIncoming->getCaseDate()->format('Y-m-d') : '') . "\n";
                $logData .= 'subjectName: ' . ($newIncoming->getSubject() ? $newIncoming->getSubject()->getEntity()->getName() : '') . "\n";
                $logData .= 'description: ' . $newIncoming->getDescription() . "\n";
                $logData .= 'docSubCategoryCode: ' . $newIncoming->getDocSubCategoryCode() . "\n";
                $logData .= 'notes: ' . $newIncoming->getNotes() . "\n";
                $logData .= 'deliveryCode: ' . $newIncoming->getDelivery()->getDeliveryId() . "\n";
                $logData .= 'deliveryName: ' . mb_convert_encoding($newIncoming->getDelivery()->getDeliveryName(), 'utf-8', 'windows-1251') . "\n";

                echo $logData;
            } catch(Exception $e) {
                echo 'Exception at Incoming: id = ' . $element['id'] . "\n";
                echo "----------------------------------------------\n";
                echo $e->getMessage() . "\n";
            }

            echo "----------------------------------------------\n\n";
        }

        return $incomingRegDetails;
    }

    /**
     * Връща готова за генериране на xml файла информация за всички изходящи
     * документи за дадена дата.
     * 
     * @param Datetime $date Дата
     * 
     * @return OutgoingRegDetailsType[] $outgoingRegDetails Масив с цялата информация.
     */
    public static function getAllOutgoingFromDate($date) {
        global $DB;

        $date = $date->format('Y-m-d');
        $query = "SELECT
        do.id as id, 
        do.serial as regNumber,
        do.registered as regDate,
        s.serial as caseSerial,
        s.year as caseYear,
        s.created as caseDate,
        do.adresat as subjectName,
        (SELECT 
            p.idposttype
        FROM post p
        WHERE p.iddocuout = do.id
        ORDER BY p.id
        LIMIT 1) as delivery,
        CASE 
            WHEN do.isentered = 1 THEN do.descrip 
        ELSE 
            IF(dt.textout = '', dt.text, dt.textout)
        END as description,
        (SELECT 
            p.date2
        FROM post p
        WHERE p.iddocuout = do.id
        ORDER BY p.id
        LIMIT 1) as deliveryDate,
        ido.id_doc_sub_category as docSubCategoryCode
        FROM docuout do
        LEFT JOIN docutype dt ON dt.id = do.iddocutype
        LEFT JOIN suit s ON s.id = do.idcase
        LEFT JOIN issi_docu_outgoing ido ON ido.id_docutype = do.iddocutype 
        WHERE do.registered LIKE '{$date}%'";

        $outgoingRegData = $DB->select($query);
        
        $outgoingRegDetails = array();
        foreach($outgoingRegData as $element) {
            $element['delivery'] = self::getDeliveryCode($element['delivery']);

            // Проверка за възникнала грешка в типа на данните
            try {
                $newOutgoing = self::outgoingArrayToObject($element);
                $outgoingRegDetails[] = $newOutgoing;

                $logData = 'Successfull Outgoing: id = ' . $element['id'] . "\n";
                $logData .= "----------------------------------------------\n";
                $logData .= 'regNumber: ' . $newOutgoing->getRegNumber(). "\n";
                $logData .= 'regDate: ' . $newOutgoing->getRegDate()->format('Y-m-d') . "\n";
                $logData .= 'caseNum: ' . $newOutgoing->getCaseNum() . "\n";
                $logData .= 'caseDate: ' . ($newOutgoing->getCaseDate() ? $newOutgoing->getCaseDate()->format('Y-m-d') : '') . "\n";
                $logData .= 'subjectName: ' . ($newOutgoing->getSubject() ? $newOutgoing->getSubject()->getEntity()->getName() : '') . "\n";
                $logData .= 'description: ' . $newOutgoing->getDescription() . "\n";
                $logData .= 'docSubCategoryCode: ' . $newOutgoing->getDocSubCategoryCode() . "\n";
                $logData .= 'notes: ' . $newOutgoing->getNotes() . "\n";
                $logData .= 'deliveryCode: ' . $newOutgoing->getDelivery()->getDeliveryId() . "\n";
                $logData .= 'deliveryName: ' . mb_convert_encoding($newOutgoing->getDelivery()->getDeliveryName(), 'utf-8', 'windows-1251') . "\n";
                $logData .= 'deliveryDate: ' . ($newOutgoing->getDeliveryDate() ? $newOutgoing->getDeliveryDate()->format('Y-m-d') : '') . "\n";

                echo $logData;
            } catch(Exception $e) {
                echo 'Exception at Outgoing: id = ' . $element['id'] . "\n";
                echo "----------------------------------------------\n";
                echo $e->getMessage() . "\n";
            }

            echo "----------------------------------------------\n\n";
        }

        return $outgoingRegDetails;
    }

    /**
     * Връща готова за генериране на xml файла информация за всички дела
     * за дадена дата.
     * 
     * @param Datetime $date Дата
     * 
     * @return CasesRegDetailsType[] $caseRegDetails Масив с цялата информация.
     */
    public static function getAllCasesFromDate($date) {
        global $DB;

        $date = $date->format('Y-m-d');
        $query = "SELECT
            s.id as id,  
            s.year as year,
            s.serial as serial,
            s.created as caseDate,
            s.text as description,
            s.claimdescrip as deptDescription,
            s.idstat as caseStatus,
            s.timestat as caseStatusDate,
            s.idtypereg4 as deptType,
            cf.name as courtCase,
            co.name as deptOrigin,
            GROUP_CONCAT(DISTINCT
                '>',
                CONCAT(
                    c.id,
                    '^',
                    c.idtype,
                    '^',
                    c.egn,
                    '^',
                    c.bulstat,
                    '^',
                    c.name,
                    '^',
                    c.address
                )
            ) as claimers,
            GROUP_CONCAT(DISTINCT
                '>',
                CONCAT(
                    d.id,
                    '^',
                    d.idtype,
                    '^',
                    d.egn,
                    '^',
                    d.bulstat,
                    '^',
                    d.name,
                    '^',
                    d.address
                )
            ) as debtors,
            (
                SELECT 
                    CONCAT(do.serial, '/', do.year, '#', do.created)
                FROM docu do
                INNER JOIN docusuit dos ON dos.iddocu = do.id
                WHERE dos.idcase = s.id
                ORDER BY do.created
                LIMIT 1
            ) as regNumberAndDate
        FROM suit s
        LEFT JOIN cofrom cf ON cf.id = s.idcofrom
        LEFT JOIN claimorigin co ON co.id = s.idclaimorig 
        LEFT JOIN claimer c ON c.idcase = s.id
        LEFT JOIN debtor d ON d.idcase = s.id
        WHERE s.created LIKE '{$date}%'
        GROUP BY s.id";

        $casesRegData = $DB->select($query);

        $agentData = self::getAgentData();
        $caseRegDetails = array();
        foreach($casesRegData as $key => $element) {
            $claimers = explode('>', $element['claimers']);
            unset($claimers[0]);

            // Формиране на взискателите
            $claimersArray = array();
            foreach($claimers as $claimer) {
                $claimerData = explode('^', $claimer);
                $claimersArray[] = array(
                    'id' => $claimerData[0],
                    'subjectType' => $claimerData[1],
                    'subjectEgn' => $claimerData[2],
                    'subjectBulstat' => $claimerData[3],
                    'subjectName' => $claimerData[4],
                    'subjectAddress' => $claimerData[5],
                );
            }
            $element['claimers'] = $claimersArray;

            $debtors = explode('>', $element['debtors']);
            unset($debtors[0]);

            // Формиране на длъжниците
            $debtorsArray = array();
            foreach($debtors as $debtor) {
                $debtorData = explode('^', $debtor);
                $debtorsArray[] = array(
                    'id' => $debtorData[0],
                    'subjectType' => $debtorData[1],
                    'subjectEgn' => $debtorData[2],
                    'subjectBulstat' => $debtorData[3],
                    'subjectName' => $debtorData[4],
                    'subjectAddress' => $debtorData[5],
                );
            }
            $element['debtors'] = $debtorsArray;

            $documentData = explode('#', $element['regNumberAndDate']);
            $element['regNumber'] = $documentData[0];
            $element['regData'] = $documentData[1];

            $element['agentName'] = $agentData['agentName'];
            $element['agentRegNum'] = $agentData['agentRegNum'];

            $caseRegDetails[] = self::getDataForCase($element['id']);

            $element['debt'] = self::getDept($element['id']);

            $element['deptType'] = self::getDeptType($element['deptType']);

            $element['caseNum'] = self::generateCaseNum($element['serial'], $element['year'], $element['agentRegNum']);

            // Проверка за възникнала грешка в типа на данните
            try {
                $newCase = self::caseArrayToObject($element);
                $caseRegDetails[] = $newCase;

                $logData = 'Successfull Case: id = ' . $element['id'] . "\n";
                $logData .= "----------------------------------------------\n";
                $logData .= 'caseNum: ' . $newCase->getCaseNum() . "\n";
                $logData .= 'caseDate: ' . ($newCase->getCaseDate() ? $newCase->getCaseDate()->format('Y-m-d') : '') . "\n";
                $logData .= 'regNumber: ' . $newCase->getRegNumber(). "\n";
                $logData .= 'regDate: ' . $newCase->getRegDate()->format('Y-m-d') . "\n";
                $logData .= 'courtCase: ' . $newCase->getCourtCase() . "\n";
                $logData .= 'agentRegNum: ' . $newCase->getAgentRegNum() . "\n";
                $logData .= 'agentName: ' . $newCase->getAgentName() . "\n";
                $logData .= 'creditorName: ' . ($newCase->getCreditor()->getEntity() ? $newCase->getCreditor()->getEntity()->getName() : $newCase->getCreditor()->getPerson()->getName()) . "\n";
                $logData .= 'creditorIdentifier: ' . ($newCase->getCreditor()->getEntity() ? $newCase->getCreditor()->getEntity()->getIdentifier() : $newCase->getCreditor()->getPerson()->getIdentifier()->getEGN()) . "\n";
                $logData .= 'creditorAddress: ' . ($newCase->getCreditor()->getEntity() ? $newCase->getCreditor()->getEntity()->getAddress() : $newCase->getCreditor()->getPerson()->getAddress()) . "\n";
                $logData .= 'debtorName: ' . ($newCase->getDebtor()->getEntity() ? $newCase->getDebtor()->getEntity()->getName() : $newCase->getDebtor()->getPerson()->getName()) . "\n";
                $logData .= 'debtorIdentifier: ' . ($newCase->getDebtor()->getEntity() ? $newCase->getDebtor()->getEntity()->getIdentifier() : $newCase->getDebtor()->getPerson()->getIdentifier()->getEGN()) . "\n";
                $logData .= 'debtorAddress: ' . ($newCase->getDebtor()->getEntity() ? $newCase->getDebtor()->getEntity()->getAddress() : $newCase->getDebtor()->getPerson()->getAddress()) . "\n";
                $logData .= "additionalCreditors:";
                if($newCase->getAdditionalCreditors() !== null) {
                    $logData .= "\n";
                    foreach($newCase->getAdditionalCreditors() as $key => $creditor) {
                        $logData .= 'creditor[' . $key . ']Name: ' . ($creditor->getCreditor()->getEntity() ? $creditor->getCreditor()->getEntity()->getName() : $creditor->getCreditor()->getPerson()->getName()) . "\n";
                        $logData .= 'creditor[' . $key . ']Identifier: ' . ($creditor->getCreditor()->getEntity() ? $creditor->getCreditor()->getEntity()->getIdentifier() : $creditor->getCreditor()->getPerson()->getIdentifier()->getEGN()) . "\n";
                        $logData .= 'creditor[' . $key . ']Address: ' . ($creditor->getCreditor()->getEntity() ? $creditor->getCreditor()->getEntity()->getAddress() : $creditor->getCreditor()->getPerson()->getAddress()) . "\n";
                    }
                } else {
                    $logData .= "-\n";
                }
                $logData .= "additionalDebtors:";
                if($newCase->getAdditionalDebtors() !== null) {
                    $logData .= "\n";
                    foreach($newCase->getAdditionalDebtors() as $key => $debtor) {
                        $logData .= 'debtor[' . $key . ']Name: ' . ($debtor->getDebtor()->getEntity() ? $debtor->getDebtor()->getEntity()->getName() : $debtor->getDebtor()->getPerson()->getName()) . "\n";
                        $logData .= 'debtor[' . $key . ']Identifier: ' . ($debtor->getDebtor()->getEntity() ? $debtor->getDebtor()->getEntity()->getIdentifier() : $debtor->getDebtor()->getPerson()->getIdentifier()->getEGN()) . "\n";
                        $logData .= 'debtor[' . $key . ']Address: ' . ($debtor->getDebtor()->getEntity() ? $debtor->getDebtor()->getEntity()->getAddress() : $debtor->getDebtor()->getPerson()->getAddress()) . "\n";
                    }
                } else {
                    $logData .= "-\n";
                }

                $logData .= 'debt: ' . $newCase->getDebt() . "\n";
                $logData .= 'debtType: ' . $newCase->getDebtType() . "\n";
                $logData .= 'debtDescription: ' . $newCase->getDebtDescription() . "\n";
                $logData .= 'debtOrigin: ' . $newCase->getDebtOrigin() . "\n";
                $logData .= 'description: ' . $newCase->getDescription() . "\n";
                $logData .= 'notes: ' . $newCase->getNotes() . "\n";
                $logData .= 'stopedDate: ' . ($newCase->getStopedDate() ? $newCase->getStopedDate()->format('Y-m-d') : '') . "\n";
                $logData .= 'terminationDate: ' . ($newCase->getTerminationDate() ? $newCase->getTerminationDate()->format('Y-m-d') : '') . "\n";
                $logData .= 'transferredDate: ' . ($newCase->getTransferredDate() ? $newCase->getTransferredDate()->format('Y-m-d') : '') . "\n";

                echo $logData;
            } catch(Exception $e) {
                echo 'Exception at Case: id = ' . $element['id'] . "\n";
                echo "----------------------------------------------\n";
                echo $e->getMessage() . "\n";
            }

            echo "----------------------------------------------\n\n";
        }

        return $caseRegDetails;
    }

    /**
     * Връща готова за генериране на xml файла информация за всички изв.
     * действия за дадена дата.
     * 
     * @param Datetime $date Дата
     * 
     * @return ActionRegDetailsType[] $actionRegDetails Масив с цялата информация.
     */
    public static function getAllActionsFromDate($date) {
        global $DB;

        $date = $date->format('Y-m-d');
        
        // взето от jour.php
        $financeData = $DB->select("
        SELECT 
            f.id as id, 
		    f.datebala as created,
		    f.toclai,
		    f.idcase
		FROM finance f
		WHERE 
            f.datebala LIKE '{$date}%' 
            AND f.isclosed<>0 
            AND f.datebala<>''
            AND f.idtype<>9
		");

        $tmpFinanceTableName = md5(microtime()) . '_finance';
        $DB->query("create temporary table `$tmpFinanceTableName` (
            id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            created char(20),
            actionid char(255),
            type tinyint(3) unsigned,
            idcase bigint(20) unsigned,
                idclai bigint(20) unsigned,
                  claiamou char(255),
              PRIMARY KEY (id)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1		
            ");
        
        foreach($financeData as $elem){
            $toClaimer = $elem["toclai"];
            $claimersArray = unsetoclai($toClaimer);
            $elem["actionid"] = $elem["id"];

            unset($elem["id"]);
            unset($elem["toclai"]);

            foreach($claimersArray as $idClaimer => $claimerAmount){
                $elem["idclai"] = $idClaimer;
                $elem["claiamou"] = $claimerAmount;
                if ($idClaimer > 0 and $claimerAmount+0 <> 0){
                    $DB->query("INSERT INTO `$tmpFinanceTableName` SET ?a"  ,$elem);
                }
            }
        }

        $queryTextUTF8 = array(
            'aa' => mb_convert_encoding('връчена ПДИ изх.док.', 'UTF-8', 'Windows-1251'),
            'f1' => mb_convert_encoding('извършено плащане ', 'UTF-8', 'Windows-1251'),
            'f2' => mb_convert_encoding(' лв към ', 'UTF-8', 'Windows-1251'),
            'p' => mb_convert_encoding('връчване', 'UTF-8', 'Windows-1251'),
            'p1' => mb_convert_encoding('по пощата', 'UTF-8', 'Windows-1251'),
            'p2' => mb_convert_encoding('призовкар', 'UTF-8', 'Windows-1251'),
            'p3' => mb_convert_encoding('куриер', 'UTF-8', 'Windows-1251'),
            'p4' => mb_convert_encoding('email', 'UTF-8', 'Windows-1251'),
            'fi1' => mb_convert_encoding(' лв ', 'UTF-8', 'Windows-1251'),
            'fi2' => mb_convert_encoding('постъпило плащане ', 'UTF-8', 'Windows-1251'),
            'fi3' => mb_convert_encoding('банков превод към ЧСИ', 'UTF-8', 'Windows-1251'),
            'fi4' => mb_convert_encoding('платено в.брой на ЧСИ', 'UTF-8', 'Windows-1251'),
            'fi5' => mb_convert_encoding('старо плащане към ЧСИ', 'UTF-8', 'Windows-1251'),
            'fi6' => mb_convert_encoding('директно на взискателя', 'UTF-8', 'Windows-1251'),
        );

        // Заявка за взимане на всичките действия от всички таблици.
        $query = "
            (SELECT 
                j.id AS id,
                s.serial AS caseSerial,
                s.year AS caseYear,
                s.created AS caseDate,
                j.created AS actionDate,
                j.descrip AS description,
                j.person AS subjectName,
                0 AS actionType,
                'jour' AS tableName,
                j.idchar AS aditionalType
            FROM jour j
            LEFT JOIN joursuit js ON js.idjour = j.id
            LEFT JOIN suit s ON s.id = js.idcase
            WHERE j.created LIKE '{$date}%')
            UNION ALL
            (SELECT
                d.id AS id,
                '' AS caseSerial,
                '' AS caseYear,
                '' AS caseDate,
                d.created AS actionDate,
                d.text AS description,
                '' AS subjectName,
                1 AS actionType,
                'docu' AS tableName,
                idi.id_doc_sub_category as docSubCategoryCode
            FROM docu d
            LEFT JOIN issi_docu_incoming idi ON idi.id_docutype = d.idtype 
            WHERE d.created LIKE '{$date}%')
            UNION ALL
            (SELECT
                do.id AS id,
                s.serial AS caseSerial,
                s.year AS caseYear,
                s.created AS caseDate,
                do.registered AS actionDate,
                CASE 
                    WHEN do.isentered = 1 THEN do.descrip 
                ELSE 
                    dt.text 
                END 
                AS description,
                do.adresat AS subjectName,
                2 AS actionType,
                'docuout' AS tableName,
                ido.id_doc_sub_category AS aditionalType
            FROM docuout do
            LEFT JOIN suit s ON s.id = do.idcase
            LEFT JOIN docutype dt ON dt.id = do.iddocutype
            LEFT JOIN issi_docu_outgoing ido ON ido.id_docutype = do.iddocutype
            WHERE do.registered LIKE '{$date}%')
            UNION ALL
            (SELECT
                p.id AS id,
                s.serial AS caseSerial,
                s.year AS caseYear,
                s.created AS caseDate,
                IF(p.date2='', p.date3, p.date2) AS actionDate,
                CONCAT(
                    '{$queryTextUTF8['p']}',
                    ' ',
                    CASE p.idposttype 
                        WHEN 0 THEN '' 
                        WHEN 1 THEN '{$queryTextUTF8['p1']}' 
                        WHEN 2 THEN '{$queryTextUTF8['p2']}' 
                        WHEN 3 THEN '{$queryTextUTF8['p3']}' 
                        WHEN 4 THEN '{$queryTextUTF8['p4']}' 
                    END,
                    ' ',
                    CASE 
                        WHEN do.isentered = 1 THEN do.descrip 
                    ELSE 
                        dt.text 
                    END,
                    ' ',
                    ps.name
                ) AS desription,
                p.adresat AS subjectName,
                6 AS actionType,
                'post' AS tableName,
                ido.id_doc_sub_category AS aditionalType
            FROM post p
            LEFT JOIN poststat ps ON ps.id = p.idpoststat 
            LEFT JOIN docuout do ON do.id = p.iddocuout
            LEFT JOIN docutype dt ON dt.id = do.iddocutype
            LEFT JOIN suit s ON s.id = do.idcase
            LEFT JOIN issi_docu_outgoing ido ON ido.id_docutype = do.iddocutype
            WHERE if(p.date2='', p.date3, p.date2) LIKE '{$date}%')
            UNION ALL
            (SELECT
                a.id AS id,
                s.serial AS caseSerial,
                s.year AS caseYear,
                s.created AS caseDate,
                a.date AS actionDate,
                CONCAT(
                    '{$queryTextUTF8['aa']}',
                    do.serial,
                    '/',
                    do.year
                ) AS description,
                a.person as subjectName,
                4 AS actionType,
                'aainvita' AS tableName,
                ido.id_doc_sub_category AS aditionalType 
            FROM aainvita a
            LEFT JOIN docuout do ON do.id = a.iddocuout
            LEFT JOIN suit s ON s.id = do.idcase
            LEFT JOIN issi_docu_outgoing ido ON ido.id_docutype = do.iddocutype
            WHERE a.date LIKE '{$date}%')
            UNION ALL
            (SELECT
                ft.actionId AS id,
                s.serial AS caseSerial,
                s.year AS caseYear,
                s.created AS caseDate,
                ft.created AS actionDate, 
                CONCAT(
                    '{$queryTextUTF8['f1']}',
                    ft.claiamou,
                    '{$queryTextUTF8['f2']}',
                    c.name
                ) AS description,
                '' AS subjectName,
                5 AS actionType,
                'finance' AS tableName,
                0 AS aditionalType
            FROM `$tmpFinanceTableName` ft
            LEFT JOIN suit s ON ft.idcase = s.id
            LEFT JOIN claimer c ON c.id = ft.idclai
            WHERE ft.created LIKE '{$date}%')
            ORDER BY actionDate, caseYear, caseSerial, actionType, id, description
        ";

        $actionsRegData = $DB->select($query);
        
        $actionRegDetails = array();
        foreach($actionsRegData as $key => $element) {
            $element['actionNumber'] = $key + 1;

            // Генериране на вид на действието.
            $element['actionType'] = self::getActionType($element['actionType'], $element['aditionalType']);

            // Проверка за възникнала грешка в типа на данните
            try {
                $newAction = self::actionArrayToObject($element);
                $actionRegDetails[] = $newAction;

                $logData = 'Successfull Action: id = ' . $element['id'] . ' table = ' . $element['tableName'] . "\n";
                $logData .= "----------------------------------------------\n";
                $logData .= 'actionNumber: ' . $newAction->getActionNumber(). "\n";
                $logData .= 'actionDate: ' . $newAction->getActionDate()->format('Y-m-d'). "\n";
                $logData .= 'caseNum: ' . $newAction->getCaseNum() . "\n";
                $logData .= 'caseDate: ' . ($newAction->getCaseDate() ? $newAction->getCaseDate()->format('Y-m-d') : '') . "\n";
                $logData .= 'subjectName: ' . ($newAction->getLiableSubject() ? $newAction->getLiableSubject()->getEntity()->getName() : '') . "\n";
                $logData .= 'actionTypeId: ' . $newAction->getActionTypeID() . "\n";
                $logData .= 'description: ' . $newAction->getDescription() . "\n";
                $logData .= 'notes: ' . $newAction->getNotes() . "\n";

                echo $logData;
            } catch(Exception $e) {
                echo 'Exception at Action: id = ' . $element['id'] . ' table = ' . $element['tableName'] . "\n";
                echo "----------------------------------------------\n";
                echo $e->getMessage() . "\n";
            }

            echo "----------------------------------------------\n\n";
        }

        $DB->query("DROP TABLE IF EXISTS `$tmpFinanceTableName`;");

        return $actionRegDetails;
    }

    /**
     * Връща готова за генериране на xml файла информация от
     * всички регистри за дадена дата.
     * 
     * @param Datetime $date Дата
     * 
     * @return array $allRegs Масив с цялата информация.
     * Ключове в масива:
     * incoming - IncomingRegDetailsType[]
     * outgoing - OutgoingRegDetailsType[]
     * cases - CasesRegDetailsType[]
     * action - ActionRegDetailsType[]
     */
    public static function getAllRegsFromDate($date) {
        $allRegs = array();

        $allRegs['incoming'] = self::getAllIncomingFromDate($date);
        $allRegs['outgoing'] = self::getAllOutgoingFromDate($date);
        $allRegs['cases'] = self::getAllCasesFromDate($date);
        $allRegs['action'] = self::getAllActionsFromDate($date);

        return $allRegs;
    }

    /**
     * Структорира информацията за входящ документ от масив във инстанция
     * от тип IncomingRegDetailsType.
     * 
     * @param array $incomingData масивът с информацията
     * 
     * @return IncomingRegDetailsType $incomingReg
     */
    public static function incomingArrayToObject($incomingData) {
        global $DB;
        // Там, където има дати, е необходимо да се подадът във формат DateTime.
        $incomingReg = new IncomingRegDetailsType();

        $incomingReg->setRegNumber($incomingData['regNumber']);
        $incomingReg->setRegDate(new DateTime($incomingData['regDate'], self::getTimeZone()));

        // Проверка и записване на информцията за делото, към което е действието.
        // БЕЛЕЖКА: Едно действие може да не е свързано с никое дело.
        if($incomingData['caseSerial']) {
            $agentData = self::getAgentData(); 
            $incomingData['caseNum'] = self::generateCaseNum($incomingData['caseSerial'], $incomingData['caseYear'], $agentData['agentRegNum']);
            $incomingReg->setCaseNum($incomingData['caseNum']);
            $incomingReg->setCaseDate(new DateTime($incomingData['caseDate'], self::getTimeZone()));
            $incomingReg->setSubject(self::createSubject(array('subjectType' => 1, 'subjectName' => $incomingData['subjectName'], 'subjectBulstat' => '', 'subjectAddress' => '')));
        }

        $delivery = new DeliveryType();
        $delivery->setDeliveryId($incomingData['delivery']);
        $delivery->setDeliveryName(self::getDeliveryName($incomingData['delivery']));
        $incomingReg->setDelivery($delivery);

        $incomingReg->setDescription($incomingData['description']);

        // ВАЖНО!!! Бележките не се извличат от базата данни, въпреки че има такива в системата. 
        // Изпращат се празни.
        $incomingReg->setNotes('');

        // Входящите документи, отговори от НАП, не са свързани с типа "Отгоговор от НАП"(id = 15),
        // в нашата база данни. Вместо това са с idtype = 0.
        // За това го правим тук ръчно.
        if(!$incomingData['docSubCategoryCode']) {
            $incomingData['docSubCategoryCode'] = $DB->select("SELECT * FROM issi_docu_incoming WHERE id_docutype = 15");
            $incomingData['docSubCategoryCode'] = $incomingData['docSubCategoryCode'][0]['id_doc_sub_category'];
        }
        $incomingReg->setDocSubCategoryCode($incomingData['docSubCategoryCode']);

        return $incomingReg;
    }

    /**
     * Структорира информацията за изходящ документ от масив във инстанция
     * от тип OutgoingRegDetailsType.
     * 
     * @param array $outgoingData масивът с информацията
     * 
     * @return OutgoingRegDetailsType $outgoingReg
     */
    public static function outgoingArrayToObject($outgoingData) {
        // Там, където има дати, е необходимо да се подадът във формат DateTime.
        $outgoingReg = new OutgoingRegDetailsType();
        $outgoingReg->setRegNumber($outgoingData['regNumber']);
        $outgoingReg->setRegDate(new DateTime($outgoingData['regDate'], self::getTimeZone()));

        // Проверка и записване на информцията за делото, към което е действието.
        // БЕЛЕЖКА: Едно действие може да не е свързано с никое дело.
        if($outgoingData['caseSerial']) {
            $agentData = self::getAgentData();
            $outgoingData['caseNum'] = self::generateCaseNum($outgoingData['caseSerial'], $outgoingData['caseYear'], $agentData['agentRegNum']);
            $outgoingReg->setCaseNum($outgoingData['caseNum']);
            $outgoingReg->setCaseDate(new DateTime($outgoingData['caseDate'], self::getTimeZone()));
            $outgoingReg->setSubject(self::createSubject(array('subjectType' => 1, 'subjectName' => $outgoingData['subjectName'], 'subjectBulstat' => '', 'subjectAddress' => '')));
        }

        $delivery = new DeliveryType();
        $delivery->setDeliveryId($outgoingData['delivery']);
        $delivery->setDeliveryName(self::getDeliveryName($outgoingData['delivery']));
        $outgoingReg->setDelivery($delivery);

        $outgoingReg->setDescription($outgoingData['description']);
        $outgoingReg->setDeliveryDate(new DateTime($outgoingData['deliveryDate'], self::getTimeZone()));

        // ВАЖНО!!! Бележките не се извличат от базата данни, въпреки че има такива в системата. 
        // Изпращат се празни.
        $outgoingReg->setNotes('');

        // Някои изходчщия документ не са свързани с тип.
        // За това го слагаме с номенклатурен код 41("Съобщение/Други")
        if(!$outgoingData['docSubCategoryCode']) {
            $outgoingData['docSubCategoryCode'] = 41;
        }
        $outgoingReg->setDocSubCategoryCode($outgoingData['docSubCategoryCode']);

        return $outgoingReg;
    }

    /**
     * Структорира информацията за дадено действие от масив във инстанция
     * от тип ActionRegDetailsType.
     * 
     * @param array $actionData масивът с информацията
     * 
     * @return ActionRegDetailsType $caseRegDetails
     */
    public static function actionArrayToObject($actionData) {
        // Там, където има дати, е необходимо да се подадът във формат DateTime.
        $actionRegDetails = new ActionRegDetailsType();
        $actionRegDetails->setActionDate(new DateTime($actionData['actionDate'], self::getTimeZone()));
        $actionRegDetails->setActionNumber($actionData['actionNumber']);

        // Проверка и записване на информцията за делото, към което е действието.
        // БЕЛЕЖКА: Едно действие може да не е свързано с никое дело.
        if($actionData['caseSerial']) {
            $agentData = self::getAgentData();
            $actionData['caseNum'] = self::generateCaseNum($actionData['caseSerial'], $actionData['caseYear'], $agentData['agentRegNum']);
            $actionRegDetails->setCaseDate(new DateTime($actionData['caseDate'], self::getTimeZone()));
            $actionRegDetails->setCaseNum($actionData['caseNum']);
        }

        // Проверка и записване на информцията за лицето, към което е действието.
        // БЕЛЕЖКА: Едно действие може да не е свързано с никое лице.
        if($actionData['subjectName'] != '') {
            $actionRegDetails->setLiableSubject(self::createSubject(array('subjectType' => 1, 'subjectName' => $actionData['subjectName'], 'subjectBulstat' => '', 'subjectAddress' => '')));
        }

        $actionRegDetails->setActionTypeID($actionData['actionType']);
        $actionRegDetails->setDescription($actionData['description']);
        $actionRegDetails->setNotes('');

        return $actionRegDetails;
    }

    /**
     * Структорира информацията за дадено дело от масив във инстанция
     * от тип CasesRegDetailsType.
     * 
     * @param array $caseData масивът с информацията
     * 
     * @return CasesRegDetailsType $caseRegDetails
     */
    public static function caseArrayToObject($caseData) {
        // Там, където има дати, е необходимо да се подадът във формат DateTime.
        $caseRegDetails = new CasesRegDetailsType();
        $caseRegDetails->setCaseNum($caseData['caseNum']);
        $caseRegDetails->setCaseDate(new DateTime($caseData['caseDate'], self::getTimeZone()));
        $caseRegDetails->setRegNumber($caseData['regNumber']);
        $caseRegDetails->setRegDate(new DateTime($caseData['regDate'], self::getTimeZone()));
        $caseRegDetails->setCourtCase($caseData['courtCase']);
        $caseRegDetails->setAgentName($caseData['agentName']);
        $caseRegDetails->setAgentRegNum($caseData['agentRegNum']);

        /* Основните взистале и дело(първите) се подават отделно на класа CasesRegDetailsType.
            Останалите заедно, като всички лица се подават във фромат SubjectType.
        */
        $caseRegDetails->setCreditor(self::createSubject(array_shift($caseData['claimers'])));
        
        $caseRegDetails->setDebtor(self::createSubject(array_shift($caseData['debtors'])));

        if(!empty($caseData['claimers'])) {
            $additionalClaimers = array();
            foreach($caseData['claimers'] as $calimer) {
                $newClaimer = new AdditionalCreditorsDetailsType();
                $newClaimer->setCreditor(self::createSubject($calimer));
                array_push($additionalClaimers, $newClaimer); 
            }

            $caseRegDetails->setAdditionalCreditors($additionalClaimers);
        }

        if(!empty($caseData['debtors'])) {
            $additionalDebtors = array();
            foreach($caseData['debtors'] as $debtor) {
                $newDebtor = new AdditionalDebtorsDetailsType();
                $newDebtor->setDebtor(self::createSubject($debtor));
                array_push($additionalDebtors, $newDebtor); 
            }

            $caseRegDetails->setAdditionalDebtors($additionalDebtors);
        }

        $caseRegDetails->setDebt($caseData['debt']);
        $caseRegDetails->setDebtDescription($caseData['deptDescription']);
        $caseRegDetails->setDebtOrigin($caseData['deptOrigin']);
        $caseRegDetails->setDebtType($caseData['deptType']);
        $caseRegDetails->setDescription($caseData['description']);

        // ВАЖНО!!! Бележките не се извличат от базата данни, въпреки че има такива в системата. 
        // Изпращат се празни.
        $caseRegDetails->setNotes('');

        /*Проверка за статуса на дело:
            16 - сършено;
            121-129, 8, 4 - спряно;
            201, 202 - изпратено на друг ЧСИ.

            Повече информация на старницата за позаване на дело в системата.
            При повреките за статуса на делото се изпраща само дата на извършеното действие.
        */
        if($caseData['caseStatus'] == 16) {
            $caseRegDetails->setTerminationDate(new DateTime($caseData['caseStatusDate'], self::getTimeZone()));
        } elseif(($caseData['caseStatus'] > 120 && $caseData['caseStatus'] < 130) || $caseData['caseStatus'] == 8 || $caseData['caseStatus'] == 4) {
            $caseRegDetails->setStopedDate(new DateTime($caseData['caseStatusDate'], self::getTimeZone()));
        } elseif($caseData['caseStatus'] == 201 || $caseData['caseStatus'] == 202) {
            $caseRegDetails->setTransferredDate(new DateTime($caseData['caseStatusDate'], self::getTimeZone()));
        }

        return $caseRegDetails;
    }
}