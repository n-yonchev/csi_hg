<?php
# отгоре :
#    $iduser - логнатия потребител
#    $mode - текущия режим
#    $page - текущата страница от списъка
#    $edit - docu.id за корекция

# кой одобрява сканирането 
$id2user = $_SESSION["iduser"];
$ro2user = getrow("user",$id2user);
$na2user = $ro2user["name"];
$arscandone = array();
$arscandone[$id2user] = $na2user;
$arscandone[0] = "бъдещия деловодител";
$smarty->assign("ARSCANDONE", $arscandone);

include_once "epep_functions.php";
include_once "docued2.php";

$key_messages = array();

$window_tabs = array(
    0 => array(
        "name" => "образуване на документ",
        "url" => geturl("mode=" . $mode . "&view=" . $view . "&page=" . $page . "&edit=0&newcase=1"),
        "selected" => false
    ),
    1 => array(
        "name" => "образуване на делa с ел. партида",
        "url" => geturl("mode=" . $mode . "&view=" . $view . "&page=" . $page . "&edit=0&proccess_case_create=0"),
        "selected" => true
    ),
);
$smarty->assign("TABS", $window_tabs);

$app_key = get_epep_app_key();
$app_secret = get_epep_app_secret();

# таблицата
$taname = "docu";
# шаблона
$tpname = "el_proccess_case_create.tpl";
# полетата
$filist = array(
    "idtype" =>  array("validator" => "notzero", "error" => "типа е задължителен"),
    "el_process_list" =>  array("validator" => "notempty", "error" => "ключа за ел. партида е задължителен"),
    "text" => NULL,
    "from" =>  array("validator" => "notempty", "error" => "подателя е задължителен"),
    "notes" =>  NULL
);

#------------------------------------------------------------------------------------------
# 16.03.2010 - за съществуващ документ - редуцираме полетата според датата
# 07.04.2010 - само ако има ограничена корекция
$ofro = getofficerow(0);
$isdoculimi = $ofro["isdoculimi"];
if ($isdoculimi) {
    if ($edit != 0) {
        $roco = getrow($taname, $edit);
        $datc = substr($roco["created"], 0, 10);
        if ($datc != date("Y-m-d")) {
            # полетата
            $filist = array(
                "notes" =>  NULL
            );
        }
    }
}
#------------------------------------------------------------------------------------------

# константни полета

$ficonst = array();

# reload - след успешен събмит
$page = $GETPARAM["page"];
$relurl = geturl("mode=" . $mode . "&view=" . $view . "&page=" . $page);


#----------------- директно редактиране -----------------------

# класа за редактиране
# само заради функцията doerrors
include_once "edit.class.php";

if (!isset($mfacproc)) {
    $mfacproc = $mfac->process();
}

#------ начало
if ($mfacproc == "INIT") {
    $retucode= -1;

    #---- полета с автоматично съдържание 
    # година - текущата 
    # брой нови дела, ако е ново дело 
    $_POST["newcount"] = 1;
    if (isset($editcasecode)){
        $_POST["tacaselist"] = $editcasecode ." ";
    }

    #------ submit без формални грешки
} elseif ($mfacproc == "submit") {

    # масив за грешките
    $lister = array();

    $editold = $edit;

    $access_keys = $_POST['el_process_list'];
    $access_keys = explode("\n", $access_keys);

    foreach($access_keys as $key => $access_key) {
        if (trim($access_key) === '') {
            unset($access_keys[$key]);
        }
    }
    
    if(count($access_keys) > 20) {
        $lister['el_process_list'] = "Въведените кодове са твърде много. Максималният брой е 20.";
    }
    $post_params = array(
        'viewer_id' => $_POST['idvier'],
        'from' => $_POST['from'],
        'notes' => $_POST['notes'],
        'type_id' => $_POST['idtype'],
        'text' => $_POST['text']
    );

    if (count($lister) <> 0) {
        #---- има ----
        $smarty->assign("LISTER", $lister);
        $retucode = 1;
    } else {
        foreach($access_keys as $access_key) {
            $access_key = trim($access_key);
            
            if($access_key == "testw") {
                $claim_access_request = epep_request('ClaimAccessKey', $access_key, $app_key, $app_secret);
                if($claim_access_request['error']) {
                    $err_message = $claim_access_request['response']['message'] ? $claim_access_request['response']['message'] : '';
                    $key_messages[] = array(
                        "type" => "error",
                        "message" => "Въникна грешка при достъпа до ел. партида с код <b>" . $access_key . "</b>: " . to1251($err_message),
                    );
                    continue;
                }
            } else {
                $claim_access_request['response'] = 'bfb7061b-3d72-4646-a261-ac470743a007';
            }

            // var_dump($claim_access_request);

            // $claim_access_request = epep_request('ClaimAccessKey', $access_key, $app_key, $app_secret);
            // if($claim_access_request['error']) {
            //     $err_message = $claim_access_request['response']['message'] ? $claim_access_request['response']['message'] : '';
            //     $key_messages[] = array(
            //         "type" => "error",
            //         "message" => "Въникна грешка при достъпа до ел. партида с код <b>" . $access_key . "</b>: " . to1251($err_message),
            //     );
            //     continue;
            // }

            # 13.04 2009 - един документ - много дела
            # $docutype вече не участва

            # според дали има грешка
            $retucode = 0;

            # създаваме един нов документ и свързано с него дело
            $epep_case_data = array(
                'gid' => null,
                'execProcessGid' => $claim_access_request['response'],
                'caseState' => "51",
            );
            $add_case_request = epep_request('InsertExecCase', $epep_case_data, $app_key, $app_secret);
            if($add_case_request['error']) {
                $err_message = $claim_access_request['response']['message'] ? $claim_access_request['response']['message'] : '';
                $key_messages[] = array(
                    "type" => "error",
                    "message" => "Въникна грешка при опита за създаване на дело с код <b>" . $access_key . "</b>: " . to1251($err_message),
                );
            } else {

                case_create($post_params);
                $case_id = $DB->select("SELECT MAX(id) as 'last' FROM suit");
                $case_id = $case_id[0]['last'];

                $uid = $add_case_request['response'];
                $DB->query("UPDATE suit SET epep_case_uid = '{$uid}' WHERE id = {$case_id}");

                $case_data = $DB->select("SELECT * FROM suit WHERE id = {$case_id}");
                $case_data = $case_data[0];
                $epep_case_data['gid'] = $uid;
                $epep_case_data['number'] = $case_data['serial'];
                $date_register = new DateTime($case['created']);
                $epep_case_data['dateRegister'] = $date_register->format("Y-m-d");
                $update_case_request = epep_request('UpdateExecCase', $epep_case_data, $app_key, $app_secret);

                $exec_process = epep_request('GetExecProcessById', $claim_access_request['response'], $app_key, $app_secret);
                $exec_process = $exec_process['response'];
                foreach($exec_process['sideList'] as $elem) {
                    $new_entity = array(
                        "epep_uid" => $elem['gid'],
                        "name" => $elem["sideName"],
                        "address" => $elem["address"] ? $elem['address'] : '',
                        "idcase" => $case_id,
                    );
                    if($elem['subjectKind'] == 1) {
                        $new_entity['idtype'] = 2;
                        $new_entity['egn'] = $elem['sideUic'] . ''; 
                    } else {
                        $new_entity['idtype'] = 1;
                        $new_entity['bulstat'] = $elem['sideUic'] . ''; 
                    }

                    if($elem['sideType'] == 1) {
                        $old_claimer = array();
                        if($elem['sideUic']) {
                            $old_claimer = $DB->select("SELECT * FROM claimer WHERE egn = '{$elem['sideUic']}' OR bulstat = '{$elem['sideUic']}' ORDER BY id DESC");
                        }

                        if(!empty($old_claimer)) {
                            $new_entity = $old_claimer[0];
                            unset($new_entity['id']);
                            $new_entity["epep_uid"] = $elem['gid'];
                            $new_entity["idcase"] = $case_id;
                        }
                        $DB->query("INSERT INTO claimer SET ?a", $new_entity);
                    } else {
                        $DB->query("INSERT INTO debtor SET ?a", $new_entity);
                    }
                }

                $act_date = new DateTime($exec_process['actDate']);

                $update_case_data = array(
                    'conome' => $exec_process['caseNumber'],
                    'coyear' => $exec_process['caseYear'],
                    'idstat' => 24,
                    'idtitu' => 1,
                    'dateexec' => $act_date->format('d.m.Y'),
                );
                $DB->query("UPDATE suit SET ?a WHERE id = {$case_id}", $update_case_data);
                
                $docu_id = $DB->select("SELECT MAX(id) as 'last' FROM docu");
                $docu_id = $docu_id[0]['last'];

                $iduser = $_SESSION["iduser"];
                $time = new DateTime('now');
                $time = $time->format("Y-m-d H:i:s");

                if($exec_process['actFileId']) {
                    $document = epep_common_request('DownloadDocumentBinary', $exec_process['actFileId'], $app_key, $app_secret);
                    $binary_data = base64_decode($document['response']['binaryContent']);
                    $procces_filename = bin2hex(openssl_random_pseudo_bytes(8)) . "_" . $document['response']['fileName'];
                    $filename = './epep_files/' . $procces_filename;
                    file_put_contents($filename, $binary_data);
                    $DB->query("INSERT INTO epep_files(name, suit_id) VALUES ('{$procces_filename}', {$case_id})");
                }

                if($exec_process['orderFileId']) {
                    $document = epep_common_request('DownloadDocumentBinary', $exec_process['orderFileId'], $app_key, $app_secret);
                    $binary_data = base64_decode($document['response']['binaryContent']);
                    $procces_filename = bin2hex(openssl_random_pseudo_bytes(8)) . "_" . $document['response']['fileName'];
                    $filename = './epep_files/' . $procces_filename;
                    file_put_contents($filename, $binary_data);
                    $DB->query("INSERT INTO epep_files(name, suit_id) VALUES ('{$procces_filename}', {$case_id})");
                }

                if(!empty($exec_process['claimDocumentFiles'])) {
                    foreach($exec_process['claimDocumentFiles'] as $claim_document) {
                        $document = epep_common_request('DownloadDocumentBinary', $claim_document['gid'], $app_key, $app_secret);
                        $binary_data = base64_decode($document['response']['binaryContent']);
                        $procces_filename = bin2hex(openssl_random_pseudo_bytes(8)) . "_" . $document['response']['fileName'];
                        $filename = './epep_files/' . $procces_filename;
                        file_put_contents($filename, $binary_data);
                        $DB->query("INSERT INTO epep_files(name, suit_id) VALUES ('{$procces_filename}', {$case_id})");
                    }
                }

                foreach($exec_process['obligationList'] as $obligation) {
                    $new_obligation = array(
                        'epep_uid' => $obligation['gid'],
                        'case_id' => $case_id,
                        'epep_code' => $obligation['obligationTypeCode'],
                        'amount' => $obligation['amount']
                    );

                    $claimer = $DB->query("SELECT * FROM claimer WHERE idcase = ?d AND epep_uid = ?s", $case_id, $obligation['beneficiaryGid']);
                    $claimer = $claimer[0];
                    $new_obligation['claimer_id'] = $claimer['id'];

                    $DB->query("INSERT INTO epep_obligations SET ?a", $new_obligation);

                    $id_type = $DB->query("SELECT type FROM epep_subject WHERE epep_code = {$obligation['obligationTypeCode']}");
                    $id_type = $id_type[0]['type'];
                    if($id_type != 0) {
                        if($obligation['statutoryInterestDate']) {
                            $obligation_date = new DateTime($obligation['statutoryInterestDate']);
                        } else {
                            $obligation_date = new DateTime('now');
                        }

                        $new_subject = array(
                            'idcase' => $case_id,
                            'text' => $obligation['obligationTypeName'],
                            'idtype' => $id_type,
                            'amount' => $obligation['amount'],
                            'fromdate' => $obligation_date->format('Y-m-d'),
                            'idclaimer' => $claimer['id'],
                            'isintax' => 1
                        );

                        if($id_type != 1) {
                            $new_subject['idsubtype'] = 4;
                        }

                        $debtors = $DB->query("SELECT * FROM debtor WHERE idcase = ?d", $case_id);

                        $debtor_ids = array();
                        foreach($debtors as $debtor) {
                            $debtor_ids[] = $debtor['id'];
                        }

                        $new_subject['listdebtor'] = implode(',', $debtor_ids);

                        if($obligation['obligationTypeCode'] != 1015) {
                            $DB->query("INSERT INTO subject SET ?a", $new_subject);
                        }
                    }
                }

                $DB->query("INSERT INTO epep_debt_distribution(case_id) VALUES (?d)", $case_id);
                $key_messages[] = array(
                    "type" => "success",
                    "message" => "Успешно образувано дело " . $case_data['serial'] . "/" . $case_data['year'] . " с код <b>" . $access_key . "</b>.",
                );
            }
        }
    }

    # отключваме
    unlocktab();

    #------ submit с формални грешки
} elseif ($mfacproc == NULL) {
    $retucode = 1;
    doerrors();

    # да се извеждат ли във формата дело/година
    $smarty->assign("ISCASE", $_POST["docutype"] <> 9);

    #------ автоматичен submit -----------------------------------------------------
} elseif ($mfacproc == "UNKNOWN") {
    $retucode = 2;
    # 10.04.2009
    # - допълнително потвърждение само при серия нови дела+документи
    # НЕЯСЕН ПРОБЛЕМ от dklab-form
    # бутоните submityes и submitno връщат $mfacproc=="UNKNOWN", затова обработката им е тук

    if (isset($_POST["submityes"])) {
        # създаваме серия нови документи и дела, свързани поединично
        creadocucase($_POST["newcount"]);
        $retucode = 0;
    }

    #------ невъзможна грешка от библиотеката
} else {
    print "<br>error=mfacproc=";
    var_dump($mfacproc);
    die();
}

#----------------- край на директното редактиране -----------------------

# резултат
if ($retucode == 0) {
    $smarty->assign("KEY_MESSAGES", $key_messages);
    $smarty->assign("BACK_URL", geturl("mode=" . $mode . "&view=" . $view . "&page=" . $page . "&edit=0&el_proccess_case_create=0"));
    print smdisp("el_proccess_case_create_return.tpl", "iconv");
    exit;
} else {
    # извеждаме формата 
    # 13.04 2009 - един документ - много дела 
    # $docutype вече не участва 
    # 18.03.2009 - обслужване на списък податели с уникални имена 
    # подателя е поле, което може да се избира от масив чрез jquery.autocomplete 
    # за масива - четем списъка с подателите 
    $arsender = $DB->selectCol("select name from sender");
    $arsender = dbconv($arsender);

    # заграждаме елементите в двойни кавички  
    $ars2 = array();
    foreach ($arsender as $elem) {
        $ars2[] = '"' . addcslashes($elem,'"') . '"';
    }

    # формираме js код за масив 
    $sen2= implode(",",$ars2);
    
    # предаваме съдържанието на кода 
    $smarty->assign("SENDCODE", $sen2);

    # за избор на тип - четем списъка с типовете 
    $ardocutype = getselect("aadocutype", "name", "1", true);
    
    # планиране 2 
    $arcrea = $DB->selectCol("select id from aadocutype where mode='crea'");
    $isc2 = true;

    $ardo2 = array();
    foreach($ardocutype as $dtindx => $dtcont) {
        $increa = in_array($dtindx, $arcrea);
        if ($increa == $isc2) {
            $ardo2[$dtindx] = $ardocutype[$dtindx];
            if ($mfacproc == "INIT") {
                $_POST["text"] = $ardocutype[$idcrea=$arcrea[0]];
            }
        }
    }
    $ardocutype = $ardo2;

    # 21.03.2011 - премахваме и типа "cere" - молба за удостоверение за вписване 
    $idcere = $DB->selectCell("select id from aadocutype where mode='cere'");
    unset($ardocutype[$idcere]);

    # предаваме името на масива 
    $smarty->assign("ARDOCUTYPENAME", "ardocutype");
    $rocont= getrow($taname, $edit);
    $smarty->assign("DOCUMENT", $rocont["serial"] . "/" . $rocont["year"]);

    $smarty->assign("EDIT", $edit);
    $smarty->assign("FILIST", $filist);
    print smdisp($tpname,"iconv");
}

