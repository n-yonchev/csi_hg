<?php

use ISSI\ActionRegDetailsType;
use ISSI\CasesRegDetailsType;
use ISSI\IncomingRegDetailsType;
use ISSI\OutgoingRegDetailsType;

/**
 * Клас IssiXmlGen представляа съдържанието на xml файла, 
 * който ще бъде изпратен до системата на ИССИ.
 * 
 * Класа съдържа методи за оформянате на всяка информация,
 * която ще бъде изпратена и/или се изисква от системата ИССИ,
 * подредена според структурата на xsd файловете изпратени от ИССИ.
 * 
 * @created 14.03.2024 
 */

class IssiXmlGen {

    /**
     * Името на файла, който ще бъде изпратен.
     * 
     * @var string
     */
    private $filename;

    /**
     * Идентификационния номер на ЧСИ.
     * 
     * @var int
     */
    private $csiNum;

    /**
     * Името на ЧСИ.
     * 
     * @var string
     */
    private $csiName;

    /**
     * Съдаржанито на xml файла.
     * 
     * @var SimpleXMLElement
     */
    private $xml;

    /**
     * Header елемента на xml файла.
     * 
     * @var SimpleXMLElement
     */
    private $header;

    /**
     * Body елемента на xml файла.
     * 
     * @var SimpleXMLElement
     */
    private $body;

    /**
     * IncomingReg елемента на xml файла.
     * 
     * @var SimpleXMLElement
     */
    private $incomingReg;

    /**
     * OutgoingReg елемента на xml файла.
     * 
     * @var SimpleXMLElement
     */
    private $outgoingReg;

    /**
     * CasesReg елемента на xml файла
     * 
     * @var SimpleXMLElement
     */
    private $casesReg;

    /**
     * ActionReg елемента на xml файла.
     * 
     * @var SimpleXMLElement
     */
    private $actionReg;


    /**
     * Конструктор на класа. Изисква основната информация
     * за даден xml файл, който да бъде изпратен до системата на ИССИ.
     * 
     * @param string $filename Името на файла.
     * @param int $csiNum Идентификационния номер на ЧСИ.
     * @param string $csiName Името на ЧСИ.
     */
    public function __construct($filename, $csiNum, $csiName) {
        $this->filename = $filename;
        $this->csiNum = $csiNum;
        $this->csiName = $csiName;
    }

    /**
     * Генерира на случаен принцип GUID, което се изисква
     * за изпрщането на файла. Генерираното GUID съответства на следния регулярен израз:
     * \{[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}\}
     * 
     * @return string $udi Генерирания идентификационен номер 
     */
    public static function generateGUID() {
        $uid = sprintf(
            '{%04x%04x-%04x-%04x-%04x-%04x%04x%04x}',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );

        return $uid;
    }

    /**
     * Генерира основната структура на xml фала. Изпълнява следните методи:
     * initializeXMLFile(), generateHeader(), genеrateBody().
     */
    public function generateBasicXmlStructure() {
        $this->initializeXMLFile();

        $this->generateHeader();
        $this->genеrateBody();
    }

    /**
     * Инициализира основната структура на xml файла:
     * <TransferMessage>
     *  <Header></Header>
     *  <Body></Body>
     * </TransferMessage>
     */
    public function initializeXMLFile() {
        $this->xml = new SimpleXMLElement(
            '<?xml version="1.0" encoding="utf-8"?>
            <TransferMessage xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="http://issi.transfer.bg/messaging/v1">
            </TransferMessage>'
        );

        $this->header = $this->xml->addChild('Header');
        $this->body = $this->xml->addChild('Body');
    }

    /**
     * Инициализира Header елемнта, както и информацията в него:
     * номер на ЧСИ, име на ЧСИ, GUID, текуща дата и час във формат - Y-m-d\TH:i:sP
     */
    public function generateHeader() {
        $enforcementAgentType = $this->header->addChild('EnforcementAgentType');
        $enforcementAgentType->addChild('EnforcementAgentRegNum', $this->csiNum);
        $enforcementAgentType->addChild('EnforcementAgentName', $this->csiName);

        $this->header->addChild('TransferDate', date('Y-m-d\TH:i:sP'));
        $this->header->addChild('TransferGUID', self::generateGUID());
    }

    /**
     * Инициализира основните елементи за регистрите, който ще бъдат изпратени на
     * системата на ИССИ:
     * InocmingReg - входящ регистър
     * OutgoingReg - изходящ регистър
     * CasesReg - регисър на делата
     * ActionReg - регистър на действията
     * 
     * Както е указано в xsd схемите всички те са подчинени на елемента TransferData.
     */
    public function genеrateBody() {
        $transferData = $this->body->addChild('TransferData');

        $this->incomingReg = $transferData->addChild('IncomingReg');
        $this->incomingReg->addAttribute('xmlns', 'http://issi.transfer.bg/R-0010');

        $this->outgoingReg = $transferData->addChild('OutgoingReg');
        $this->outgoingReg->addAttribute('xmlns', 'http://issi.transfer.bg/R-0010');

        $this->casesReg = $transferData->addChild('CasesReg');
        $this->casesReg->addAttribute('xmlns', 'http://issi.transfer.bg/R-0010');

        $this->actionReg = $transferData->addChild('ActionReg');
        $this->actionReg->addAttribute('xmlns', 'http://issi.transfer.bg/R-0010');
    }

    /**
     * Добавя нов запис към изходящия регистър.
     * 
     * @param IncomingRegDetailsType $data Информацията за записа, който ще бъде изпратен.
     * 
     * Калсът садържа следната информация:
     * RegDate              - Входяща дата (датата на постъпване на документа в деловодството)(Y-m-d\TH:i:sP)
     * RegNumber            - Входящ номер
     * CaseNum              - Номер на изпълнителното дело, по което постъпва входираният документ. В случай че документът не е по конкретно дело, се попълва "друго".
     * CaseDate             - Дата на изпълнителното дело
     * Subject              - Информация за лицето подател(SubjectType)
     * deliveryId           - Информация за начина на получаване(DeliveryType)
     * DocSubCategoryCode   - Код на вид на документа от номенклатурата на документите
     * Description          - Описание-свободен текст
     * Notes                - Забележки-свободен текст
     */
    public function addIncomingReg(IncomingRegDetailsType $data) {
        $incomingRegDetails = $this->incomingReg->addChild('IncomingRegDetails');
        $incomingRegDetails->addAttribute('xmlns', 'http://issi.transfer.bg/R-0001');

        $incomingRegDetails->addChild('RegDate', $data->getRegDate()->format('Y-m-d\TH:i:sP'));
        $incomingRegDetails->addChild('RegNumber', $data->getRegNumber());

        if($data->getCaseNum()) {
            $incomingRegDetails->addChild('CaseNum', $data->getCaseNum());
            $incomingRegDetails->addChild('CaseDate', $data->getCaseDate()->format('Y-m-d'));
        }
        
        $subjectData = array();
        if($data->getSubject() !== null) {
            $subjectData['type']    = $data->getSubject()->getPerson() !== null ? 2 : 1;
            $subjectData['name']    = $data->getSubject()->getPerson() !== null ? 
                $data->getSubject()->getPerson()->getName() : $data->getSubject()->getEntity()->getName();
            $subjectData['id']      = $data->getSubject()->getPerson() !== null ?
                $data->getSubject()->getPerson()->getIdentifier()->getEgn() : $data->getSubject()->getEntity()->getIdentifier();
            $subjectData['address'] = $data->getSubject()->getPerson() !== null ?
            $data->getSubject()->getPerson()->getAddress() : $data->getSubject()->getEntity()->getAddress();
        }

        $subject = $incomingRegDetails->addChild('Subject');
        $subject->addAttribute('xmlns', 'http://issi.transfer.bg/0001');
        $this->addEntityData($subjectData, $subject);
        
        $delivery = $incomingRegDetails->addChild('Delivery');
        $delivery->addChild('DeliveryId', $data->getDelivery()->getDeliveryId())
        ->addAttribute('xmlns', 'http://issi.transfer.bg/0002');
        $delivery->addChild('DeliveryName', mb_convert_encoding($data->getDelivery()->getDeliveryName(), "UTF-8", "Windows-1251"))
        ->addAttribute('xmlns', 'http://issi.transfer.bg/0002');

        $incomingRegDetails->addChild('DocSubCategoryCode', $data->getDocSubCategoryCode());
        $incomingRegDetails->addChild('Description', $data->getDescription());
        $incomingRegDetails->addChild('Notes', $data->getNotes());

    }

    /**
     * Добавя нов запис към входящия регистър.
     * 
     * @param OutgoingRegDetailsType $data Информацията за записа, който ще бъде изпратен.
     * 
     * Класът съдържа следните ключове:
     * RegDate              - Входяща дата (датата на постъпване на документа в деловодството)(Y-m-d\TH:i:sP)
     * RegNumber            - Входящ номер
     * CaseNum              - Номер на изпълнителното дело, по което постъпва входираният документ. В случай че документът не е по конкретно дело, се попълва "друго".
     * CaseDate             - Дата на изпълнителното дело
     * Subject              - Информация за лицето подател(SubjectType)
     * Delivery             - Информация начина на получаване(DeliveryType)
     * DocSubCategoryCode   - Код на вид на документа от номенклатурата на документите
     * Description          - Описание-свободен текст
     * Notes                - Забележки-свободен текст
     * DeliveryDate         - Дата на връчване
     */
    public function addOutgoingReg(OutgoingRegDetailsType $data) {
        $outgoingRegDetails = $this->outgoingReg->addChild('OutgoingRegDetails');
        $outgoingRegDetails->addAttribute('xmlns', 'http://issi.transfer.bg/R-0002');

        $outgoingRegDetails->addChild('RegDate', $data->getRegDate()->format('Y-m-d\TH:i:sP'));
        $outgoingRegDetails->addChild('RegNumber', $data->getRegNumber());

        if($data->getCaseNum()) {
            $outgoingRegDetails->addChild('CaseNum', $data->getCaseNum());
            $outgoingRegDetails->addChild('CaseDate', $data->getCaseDate()->format('Y-m-d'));
        }

        $subjectData = array();
        if($data->getSubject() !== null) {
            $subjectData['type']    = $data->getSubject()->getPerson() !== null ? 2 : 1;
            $subjectData['name']    = $data->getSubject()->getPerson() !== null ?
                $data->getSubject()->getPerson()->getName() : $data->getSubject()->getEntity()->getName();
            $subjectData['id']      = $data->getSubject()->getPerson() !== null ?
            $data->getSubject()->getPerson()->getIdentifier()->getEgn() : $data->getSubject()->getEntity()->getIdentifier();
            $subjectData['address'] = $data->getSubject()->getPerson() !== null ?
            $data->getSubject()->getPerson()->getAddress() : $data->getSubject()->getEntity()->getAddress();
        }
        
        $subject = $outgoingRegDetails->addChild('Subject');
        $this->addEntityData($subjectData, $subject);

        $delivery = $outgoingRegDetails->addChild('Delivery');
        $delivery->addChild('DeliveryId', $data->getDelivery()->getDeliveryId())
        ->addAttribute('xmlns', 'http://issi.transfer.bg/0002');
        $delivery->addChild('DeliveryName', mb_convert_encoding($data->getDelivery()->getDeliveryName(), "UTF-8", "Windows-1251"))
        ->addAttribute('xmlns', 'http://issi.transfer.bg/0002');

        $outgoingRegDetails->addChild('DocSubCategoryCode', $data->getDocSubCategoryCode());
        $outgoingRegDetails->addChild('Description', $data->getDescription());
        $outgoingRegDetails->addChild('Notes', $data->getNotes());
        $outgoingRegDetails->addChild('DeliveryDate', $data->getDeliveryDate()->format('Y-m-d'));

    }

    /**
     * Добавя нов запис към регистър за дела.
     * 
     * @param CaseRegDetails $data Информацията за записа, който ще бъде изпратен.
     * 
     * Легенда:
     * ^ - полето не е задължително
     * 
     * Класът съдържа следните ключове:
     * CaseNum                      - Номер на изпълнително дело
     * CaseDate                     - Дата на изпълнителното дело(yyyy-mm-dd)
     * RegNumber                    - Входящ номер
     * RegDate                      - Входяща дата (датата на постъпване на документа в деловодството)(Y-m-d\TH:i:sP)
     * CourtCase                    - попълва се наименованието на съда и номерът на делото, по което е издаден изпълнителният лист, съответно заповедта
     * AgentName                    - попълва се името на частния съдебен изпълнител така, както е вписано в регистъра на частните съдебни изпълнители
     * AgentRegNum                  - попълва се регистрационният номер на частния съдебен изпълнител, под който е вписан в регистъра на частните съдебни изпълнители
     * Creditor                     - Информация за лицето взискател(SubjectType)
     * Debtor                       - Информация лицето длъжник(SubjectType)
     * AdditionalCreditors^         - масив от информация за допълнителни взискатели(ако има такива)
     * AdditionalDebtors^           - масив от информация за допълнителни длъжници(ако има такива)
     * DebtType                     - номенклатурни данни за вида на вземането
     * Debt                         - попълва се размера на вземането
     * DebtDescription              - Описание на вземането
     * DebtOrigin                   - Описание на произхода на вземането
     * StopedDate^                  - Дата на спиране на изпълнителното производство (yyyy-mm-dd)
     * ResumedDate^                 - Дата на възобновяване на изпълнителното производство (yyyy-mm-dd)
     * TerminationDate^             - Дата на свършване на изпълнителното производство (yyyy-mm-dd)
     * TransferredDate^             - Дата на изпращане на делото на друг съдебен изпълнител (yyyy-mm-dd)
     * Description                  - Описание - свободен текст
     * Notes                        - Забележки - свободен текст
     * TransferredToEAgentName^     - Регистрационен номер на частния съдебен изпълнител до който е изпратено делото
     * TransferredToEAgentRegNum^   - Името на частния съдебен изпълнител до който е изпратено делото
     */
    public function addCaseReg(CasesRegDetailsType $data) {
        $caseRegDeatils = $this->casesReg->addChild('CasesRegDetails');
        $caseRegDeatils->addAttribute('xmlns', 'http://issi.transfer.bg/R-0003');

        $caseRegDeatils->addChild('CaseNum', $data->getCaseNum());
        $caseRegDeatils->addChild('CaseDate', $data->getCaseDate()->format('Y-m-d'));
        $caseRegDeatils->addChild('RegNumber', $data->getRegNumber());
        $caseRegDeatils->addChild('RegDate', $data->getRegDate()->format('Y-m-d\TH:i:sP'));
        $caseRegDeatils->addChild('CourtCase', $data->getCourtCase());
        $caseRegDeatils->addChild('AgentName', $data->getAgentName());
        $caseRegDeatils->addChild('AgentRegNum', $data->getAgentRegNum());

        $creditorData = array();
        $creditorData['type']    = $data->getCreditor()->getPerson() !== null? 2 : 1;
        $creditorData['name']    = $data->getCreditor()->getPerson() !== null? 
            $data->getCreditor()->getPerson()->getName() : $data->getCreditor()->getEntity()->getName();
        $creditorData['id']      = $data->getCreditor()->getPerson() !== null? 
        $data->getCreditor()->getPerson()->getIdentifier()->getEgn() : $data->getCreditor()->getEntity()->getIdentifier();
        $creditorData['address'] = $data->getCreditor()->getPerson() !== null? 
        $data->getCreditor()->getPerson()->getAddress() : $data->getCreditor()->getEntity()->getAddress();

        $creditor = $caseRegDeatils->addChild('Creditor');
        $this->addEntityData($creditorData, $creditor);

        $debtorData = array();
        $debtorData['type']    = $data->getDebtor()->getPerson() !== null? 2 : 1;
        $debtorData['name']    = $data->getDebtor()->getPerson() !== null?
            $data->getDebtor()->getPerson()->getName() : $data->getDebtor()->getEntity()->getName();
        $debtorData['id']      = $data->getDebtor()->getPerson() !== null?
        $data->getDebtor()->getPerson()->getIdentifier()->getEgn() : $data->getDebtor()->getEntity()->getIdentifier();
        $debtorData['address'] = $data->getDebtor()->getPerson() !== null?
        $data->getDebtor()->getPerson()->getAddress() : $data->getDebtor()->getEntity()->getAddress();

        $debtor = $caseRegDeatils->addChild('Debtor');
        $this->addEntityData($debtorData, $debtor);

        if($data->getAdditionalCreditors() !== null) {
            $additionalCreditors = $caseRegDeatils->addChild('AdditionalCreditors'); 
            foreach($data->getAdditionalCreditors() as $creditor) {
                $additionalCreditorData = array();
                $additionalCreditorData['type']    = $creditor->getCreditor()->getPerson() !== null ? 2 : 1; 
                $additionalCreditorData['name']    = $creditor->getCreditor()->getPerson() !== null ?
                    $creditor->getCreditor()->getPerson()->getName() : $creditor->getCreditor()->getEntity()->getName(); 
                $additionalCreditorData['id']      = $creditor->getCreditor()->getPerson() !== null ?
                $creditor->getCreditor()->getPerson()->getIdentifier()->getEgn() : $creditor->getCreditor()->getEntity()->getIdentifier(); 
                $additionalCreditorData['address'] = $creditor->getCreditor()->getPerson() !== null ?
                $creditor->getCreditor()->getPerson()->getAddress() : $creditor->getCreditor()->getEntity()->getAddress();
                
                $this->addEntityData($additionalCreditorData, $additionalCreditors);
            }
        }

        if($data->getAdditionalDebtors() !== null) {
            $additionalDebtors = $caseRegDeatils->addChild('AdditionalDebtors'); 
            foreach($data->getAdditionalDebtors() as $debtor) {
                $additionalDeptorData = array();
                $additionalDeptorData['type']    = $debtor->getDebtor()->getPerson() !== null ? 2 : 1; 
                $additionalDeptorData['name']    = $debtor->getDebtor()->getPerson() !== null ?
                    $debtor->getDebtor()->getPerson()->getName() : $debtor->getDebtor()->getEntity()->getName(); 
                $additionalDeptorData['id']      = $debtor->getDebtor()->getPerson() !== null ?
                $debtor->getDebtor()->getPerson()->getIdentifier()->getEgn() : $debtor->getDebtor()->getEntity()->getIdentifier();
                $additionalDeptorData['address'] = $debtor->getDebtor()->getPerson() !== null ?
                $debtor->getDebtor()->getPerson()->getAddress() : $debtor->getDebtor()->getEntity()->getAddress();
                
                $this->addEntityData($additionalDeptorData, $additionalDebtors);
            }
        }

        $caseRegDeatils->addChild('DebtType', $data->getDebtType());
        $caseRegDeatils->addChild('Debt', $data->getDebt());
        $caseRegDeatils->addChild('DebtDescription', $data->getDebtDescription());
        $caseRegDeatils->addChild('DebtOrigin', $data->getDebtOrigin());
        if(null !== $data->getStopedDate()) {
            $caseRegDeatils->addChild('StopedDate', $data->getStopedDate()->format('Y-m-d'));
        }
        if(null !== $data->getResumedDate()) {
            $caseRegDeatils->addChild('ResumedDate', $data->getResumedDate()->format('Y-m-d'));
        }
        if(null !== $data->getTerminationDate()) {
            $caseRegDeatils->addChild('TerminationDate', $data->getTerminationDate()->format('Y-m-d'));
        }
        if(null !== $data->getTransferredDate()) {
            $caseRegDeatils->addChild('TransferredDate', $data->getTransferredDate()->format('Y-m-d'));
        }
        
        $caseRegDeatils->addChild('Description', $data->getDescription());
        $caseRegDeatils->addChild('Notes', $data->getNotes());

        if(null !== $data->getTransferredToEAgentName()) {
            $caseRegDeatils->addChild('TransferredToEAgentRegNum', $data->getTransferredToEAgentName());
        }
        if(null !== $data->getTransferredToEAgentRegNum()) {
            $caseRegDeatils->addChild('TransferredToEAgentName', $data->getTransferredToEAgentRegNum());
        }

    }

    /**
     * Добавя нов запис към входящия регистър.
     * 
     * @param ActionRegDetailsType $data Информацията за записа, който ще бъде изпратен.
     * 
     * Класът съдържа следните ключове:
     * ActionDate       - Дата и час на извършено действие.(Y-m-d\TH:i:sP)
     * ActionNumber     - Пореден номер на извършено действие в дневника.
     * CaseNum          - Номер на изпълнителното дело, по което постъпва входираният документ. В случай че документът не е по конкретно дело, се попълва "друго".
     * CaseDate         - Дата на изпълнителното дело
     * Сubject          - Информация за лицето
     * ActionTypeID     - Номенклатурен код за извършено действие(commonType.xsd)
     * Description      - Описание на извършеното действие
     * Notes            - Забележки за извършеното действие
     */
    public function addActionReg(ActionRegDetailsType $data) {
        $actionRegDetails = $this->actionReg->addChild('ActionRegDetails');
        $actionRegDetails->addAttribute('xmlns', 'http://issi.transfer.bg/R-0004');

        $actionRegDetails->addChild('ActionDate', $data->getActionDate()->format('Y-m-d\TH:i:sP'));
        $actionRegDetails->addChild('ActionNumber', $data->getActionNumber());

        if($data->getCaseNum()) {
            $actionRegDetails->addChild('CaseNum', $data->getCaseNum());
            $actionRegDetails->addChild('CaseDate', $data->getCaseDate()->format('Y-m-d'));
        }

        $subjectData = array();
        if(null !== $data->getLiableSubject()) {
            $subjectData['type']    = $data->getLiableSubject()->getPerson() !== null ? 1 : 2;
            $subjectData['name']    = $data->getLiableSubject()->getPerson() !== null ?
                $data->getLiableSubject()->getPerson()->getName() : $data->getLiableSubject()->getEntity()->getName();
            $subjectData['id']      = $data->getLiableSubject()->getPerson() !== null ?
            $data->getLiableSubject()->getPerson()->getIdentifier()->getEgn() : $data->getLiableSubject()->getEntity()->getIdentifier();
            $subjectData['address'] = $data->getLiableSubject()->getPerson() !== null ?
            $data->getLiableSubject()->getPerson()->getAddress() : $data->getLiableSubject()->getEntity()->getAddress();
        }
        $subject = $actionRegDetails->addChild('LiableSubject');
        $this->addEntityData($subjectData, $subject);

        $actionRegDetails->addChild('ActionTypeID', $data->getActionTypeID());
        $actionRegDetails->addChild('Description', $data->getDescription());
        $actionRegDetails->addChild('Notes', $data->getNotes());

    }

    /**
     * Осъщвява записа на лицата в xml файла. В xsd смхемите има разлика
     * във формата според това дали лицето е физическо или юридическо.
     * 
     * @param array $entityData съдържа следната информация за лицето:
     *      type    - Информация за това, какво е лицето: 1 - юридическо лице, 2 - физическо лице
     *      name    - Името на лицето
     *      id      - Идентификационен номер на лицето(ЕГН/ЕИК)
     *      address - Адрес на лицето
     * @param SimpleXMLElement инстанция към родителския елемент в xml файла - subject, creditor, debtor 
     */
    public function addEntityData($entityData, $entityElement) {
        if($entityData['type'] == 1) {
            $entityTag = 'Entity';
        } else {
            $entityTag = 'Person';
        }

        $entity = $entityElement->addChild($entityTag);
        $entity->addAttribute('xmlns', 'http://issi.transfer.bg/0001');

        $entity->addChild('Name', $entityData['name']);
        
        if($entityData['type'] == 1) {
            $entity->addChild('Identifier', $entityData['id']); 
        } else {
            $entity->addChild('Identifier')->addChild('EGN', $entityData['id']); 
        }

        $entity->addChild('Address', $entityData['address']);
    }

    /**
     * Добавя към xml файла информация за множество редове от различни регистри.
     * 
     * @param array $regsData Информацията за различните регистри,
     * структорирана по следния начин:
     * incoming - IncomingRegDetailsType[] Входящ регистър
     * outgoing - OutgoingRegDetailsType[] Изходящ регистър
     * cases - CasesRegDetailsType[] Регистър на делата
     * action - ActionRegDetailsType[] Регистър на изв. действия
     * 
     */
    public function addMultipleRegs($regsData) {

        foreach($regsData['incoming'] as $reg) {
            $this->addIncomingReg($reg);
        }

        foreach($regsData['outgoing'] as $reg) {
            $this->addOutgoingReg($reg);
        }

        foreach($regsData['cases'] as $reg) {
            $this->addCaseReg($reg);
        }

        foreach($regsData['action'] as $reg) {
            $this->addActionReg($reg);
        }
    }

    /**
     * Запазва моментното състояние на файла.
     */
    public function saveToFile() {
        $this->xml->asXML($this->filename);
    }

    /**
     * Обработва и принтира моментното състояние на файла като text/plain. 
     */
    public function printFile() {
        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->preserveWhiteSpace = false; 
        $dom->formatOutput = true;
        $dom->loadXML($this->xml->asXML());

        echo '<pre>' . htmlspecialchars($dom->saveXML(), ENT_QUOTES, 'UTF-8') . '</pre>';
    }
}