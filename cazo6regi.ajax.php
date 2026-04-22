<?php
# зона-6 : извеждане (регистрация) на съществуващ изходящ документ по делото 
# отгоре : 
//#    $edit= docuout.id 
#    $zone= 6 
#    $func= view 
#  $regi= документа за регистрация 
//print_r($GETPARAM);
//var_dump($regi);
outnext("cazo6regi/begin/$regi", "BEGIN");

/*
# връчване
if ($ISPOST){
include_once "deli.inc.php";
}else{
}
*/
//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser = @$_SESSION["iduser"];
//# таблицата 
//$taname= "docuout";
# шаблона 
$tpname = "cazo6regi.ajax.tpl";
# полетата 
$filist = array(
    //	"serinome"=>  array("validator"=>"notempty", "error"=>"изх.номер не може да е празен")
    "getnext" => NULL
, "serinome" => NULL
, "adresat" => array("validator" => "notempty", "error" => "адресата е задължителен")
, "notes" => NULL
    # 23.06.2010 - флаг - при изходяване на документ
    # автоматично да се добавя таксата като предмет на изпълнение
, "regitext" => NULL
, "regitax" => NULL
);
# константни полета 
//$ficonst= array("iduser"=>$iduser);
$ficonst = array();
//# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page);

#------ подготовка ---------------------------------------------------------
# 29.04.2010 
# дали е вдигнат флага - изходящ документ с отделен номер за всеки адресат 
//$rooffi= getofficerow(0);
//									$issepa= ($rooffi["isseparate"]<>0);
$issepa = true;
/*
										# 23.06.2010 - флаг - при изходяване на документ 
										# автоматично да се добавя таксата като предмет на изпълнение
										//$rooffi= getofficerow(0);
										$regita= $rooffi["isregitax"];
										$isregitax= ($regita<>0);
									$smarty->assign("ISREGITAX", $isregitax);
*/
# четем данните за изх.документ 
$rodocu = getrow("docuout", $regi);
$docont = $rodocu["content"];
$docont = toutf8($docont);
# 27.04.2010 - ако документа е на Word 
# ANGEL REPLACE IN WORD FILE 
$rodoty = getrow("docutype", $rodocu["iddocutype"]);
$arelem = explode(".", $rodoty["filename"]);
$filesuff = $arelem[count($arelem) - 1];
# дали шаблона на документа е на word 
$isword = ($filesuff <> "html");
if ($isword) {
    $wordname = "docs/" . $regi . ".doc";
    $docont = file_get_contents($wordname);
} else {
}
# 23.06.2010 - флаг - при изходяване на документ
# автоматично да се добавя таксата като предмет на изпълнение
$rooffi= getofficerow(0);
$regita = $rooffi["isregitax"];
$isregitax = ($regita <> 0);
$smarty->assign("ISREGITAX", $isregitax);
# и данните за предмета на изпълнение
//		$rot2= toutf8($rodoty);
//		$exem= toutf8("екз.");
$rot2 = $rodoty;
$exem = "екз.";
$postregitext = $rot2["regitext"] . " COPIES " . $exem . " " . $rot2["text"];
$smarty->assign("TEMPTEXT", $postregitext);
$smarty->assign("TEMPMARK", "COPIES");
$smarty->assign("REGITAX_DEF", $rot2);
$postregitax = $rot2["regitax"];
if ($postregitax + 0 == 0) {
    $flagwilladd = false;
    $smarty->assign("NOADDSUB", true);
} else {
    $flagwilladd = true;
}

# дали документа съдържа таг за размножаване по адресати (поделения) 
# и таблицата, определена от тага 
$tablmult = "";
//											if ($issepa){
#+++++++++++++++++++++++++++++++++++++++++++++++
# 02.07.2010 ВАЖНО.
# размножаваме word документите именно тук при изходяване
//////var_dump($issepa);
//////var_dump($isword);
if ($issepa or $isword) {
    #+++++++++++++++++++++++++++++++++++++++++++++++
    foreach ($arregioncb as $mymark => $x2) {
        if (strpos($docont, $mymark) === false) {
        } else {
            # съдържа таг за размножаване по адресати (поделения)
            # източник : cazo6prnt.ajax.php
            $tagmulti = $mymark;
            # трансформираме стринга
            $tag2 = $tagmulti;
            $tag2 = str_replace("(-[", "", $tag2);
            $tag2 = str_replace("]-)", "", $tag2);
            # разбиваме стринга
            list($par1, $tablmult, $par3) = explode("_", $tag2);
            # заради case sensitivity in Linux
            $tablmult = strtolower($tablmult);
            # проверяваме
            if ($par1 == "DB") {
            } else {
                die("6regi=1");
            }
            if ($par3 == "CB") {
            } else {
                die("6regi=3");
            }
        }
    }
} else {
}
# ако има размножаване по адресати (поделения)
# - пълния списък с поделения - за чекбоксове
# източник : cazo6prnt.ajax.php
//////print "<br>TABLMULT=";
//////var_dump($tablmult);
if (empty($tablmult)) {
} else {
    include_once "cazo6bran.inc.php";
    $arbran = getbranlist($tablmult, $extra);
    $arbran = arstrip($arbran);
    # предаваме целия списък
    $smarty->assign("ARBRAN", $arbran);
    # колко записа в една колона
    $smarty->assign("COUNTPERCOL", 20);
    //# предаваме списъка с избраните - няма избрани
    //$_POST["branlist"]= array();
}
# край на подготовката 
#---------------------------------------------------------------------------

# класа за редактиране
include_once "edit.class.php";
#----------------- директно редактиране -----------------------

if (isset($mfacproc)) {
} else {
    $mfacproc = $mfac->process();
}
//print "MFACPROC=[$mfacproc]";
//print_rr($_POST);
outnext("cazo6regi/MFAC/$regi->" . (($mfacproc === NULL) ? "NULL" : $mfacproc), "MFAC");

//# основен входен параметър -
//# $edit - $taname.id

if (0) {

    #------ начало
} elseif ($mfacproc == "INIT") {
    $retucode = -1;
    $rocont = getrow("docuout", $regi);
    //	$rocont= dbconv($rocont);
    $_POST["adresat"] = toutf8($rocont["adresat"]);
    # 18.08.2014 - връчване
    # доп.корекция
    if (empty($_POST["adresat"])) {
        $_POST["adresat"] = toutf8($rodoty["adresat"]);
    } else {
    }
    $_POST["notes"] = toutf8($rocont["notes"]);
    # 30.03.2010 - да е чекнат в началото
    $_POST["getnext"] = 1;
    # 09.04.2010 - за ПДИ адресата да се записва автоматично или чрез избор
    $pdlist = getpdlist();
    eval("\$arpdlist= array($pdlist);");
    //print_rr($arpdlist);
    if (in_array($rocont["iddocutype"], $arpdlist)) {
        # изх.документ е от тип ПДИ
        # четем списъка с длъжниците по делото
        $ardebt = getselect("debtor", "name", "idcase=" . $rocont["idcase"], true);
        $codebt = count($ardebt);
        if ($codebt == 1) {
        } elseif ($codebt == 2) {
            # има само 1 длъжник - зареждаме името му автоматично
            //# ако адресата е празен - зареждаме името му
            //if (empty($_POST["adresat"])){
            $arke = array_keys($ardebt);
            $myin = $arke[1];
            $_POST["adresat"] = $ardebt[$myin];
            //}else{
            //}
        } else {
            # има повече длъжници - избор от списъка
            $smarty->assign("ARDEBTNAME", "ardebt");
        }
    } else {
    }
    # ако има размножаване по адресати (поделения)
    # предаваме списъка с избраните чекбоксове
    if (empty($tablmult)) {
    } else {
        # - няма избрани
        $_POST["branlist"] = array();
    }

    # 23.06.2010 - флаг - при изходяване на документ
    # автоматично да се добавя таксата като предмет на изпълнение
    if ($isregitax) {
        # данните за предмета на изпълнение
        /*
            $rot2= toutf8($rodoty);
            $_POST["regitext"]= $rot2["regitext"]." - ".$rot2["text"];
            $_POST["regitax"]= $rot2["regitax"];
            if ($rot2["regitax"]+0==0){
        $smarty->assign("NOADDSUB", true);
            }else{
            }
        */
        $_POST["regitext"] = str_replace("COPIES", "1", toutf8($postregitext));
        $_POST["regitax"] = $postregitax;
    } else {
    }

    # 17.03.2017 - запомнените тагове и съдържания за връчването
    $artags = $DB->selectCol("select tag as ARRAY_KEY, tagcont from postrepl where iddocuout=?d", $regi);
    //print_rr($artags);
    foreach ($artags as $tana => $taco) {
        $_POST[$tana] = $taco;
    }

    /***
     * #---------------------------------------------------------------------------------------------
     * # 18.08.2014 - връчване
     * # начални данни за връчване
     * //print_ru($smarty->get_template_vars());
     * //var_dump($ISPOST);
     * if ($ISPOST){
     * //                            $_POST["idposttype"]= $ropout["idposttype"];
     * //                            $_POST["postadresat"]= $ropout["postadresat"];
     * //                            $_POST["postaddress"]= $ropout["postaddress"];
     * $iddocutype= $rodocu["iddocutype"];
     * if (empty($iddocutype)){
     * }else{
     * $artags= $DB->selectCol("select tag as ARRAY_KEY, tagcont from postrepl where iddocuout=?d"  ,$regi);
     * //$rotype= getrow("docutype",$rodocu["iddocutype"]);
     * //$ro8= toutf8($rotype);
     * $ro8= toutf8($rodoty);
     * //////print_ru($rotype);
     * //var_dump($rotype);
     * //print_ru($rodocu);
     * //print_ru($rotype);
     * $idposttype= $ro8["idposttype"];
     * $postadresat= $ro8["postadresat"];
     * $postaddress= $ro8["postaddress"];
     * $adresat= $ro8["adresat"];
     * $_POST["idposttype"]= $idposttype;
     * //                                    $tacont= posttran($postaddress,$artags);
     * $tacont= posttranempty($postaddress,$artags);
     * $_POST["postaddress"]= $tacont;
     * if (empty($postadresat)){
     * $_POST["postadresat"]= $adresat;
     * }else{
     * //                                    $tacont= posttran($postadresat,$artags);
     * $tacont= posttranempty($postadresat,$artags);
     * $_POST["postadresat"]= $tacont;
     * }
     * }
     * }else{
     * }
     * #---------------------------------------------------------------------------------------------
     ***/

    #------ submit без формални грешки
} elseif ($mfacproc == "submit") {
    $retucode = 0;
    # проверяваме за допълнителни грешки
    $lister = array();
    # ВНИМАНИЕ. 01.11.2018 КОРЕГИРАНА ВАЖНА ГРЕШКА
    # $_POST["getnext"] връща празен стринг вместо unset
    # затова променяме проверката
    //			if (isset($_POST["getnext"])){
    if (!empty($_POST["getnext"])) {
    } else {
        $serinome = $_POST["serinome"];
        $myyear = (int)date("Y");
        # дали е правилно цяло число
        if ((string)((int)$serinome) == $serinome) {
            # дали вече не съществува документ с този номер за текущата година
            $mycoun = $DB->selectCell("select count(*) from docuout where serial=? and year=?", $serinome, $myyear);
            if ($mycoun == 0) {
            } else {
                $lister["serinome"] = "има документ с този номер";
            }
        } else {
            $lister["serinome"] = "грешен номер";
        }
    }
    #-------------------------------------------------------------------------------------
    # 18.08.2014 - връчване
    # проверка за грешки
    if ($ISPOST) {
        $idposttype = $_POST["idposttype"];
        $postadresat = trim($_POST["postadresat"]);
        if ($idposttype == 0) {
            $lister["idposttype"] = "метода на връчване е задължителен";
        } else {
        }
        if (in_array($idposttype, array(1, 2))) {
            if (empty($postadresat)) {
                if ($rodoty["ismult"] == 0) {
                    $lister["postadresat"] = "адресата за връчване е задължителен";
                } else {
                }
            } else {
            }
        } else {
        }
    } else {
    }
    #-------------------------------------------------------------------------------------
    //print_ru($lister);
    //die("ERROR-CHECK");

    # според дали има грешка
    if (count($lister) <> 0) {
        #---- има ----
        $smarty->assign("LISTER", $lister);
        $retucode = 1;
    } else {
        #---- няма ----


        # според дали да има размножаване по адресати (поделения)
        if (empty($tablmult)) {
            # няма
            $flagok = true;
        } else {
            # има размножаване
            $branlist = $_POST["branlist"];
            $branstri = $_POST["branstri"];
            if (isset($branstri)) {
                $flagok = true;
            } else {
                $flagok = false;
                $_POST["branstri"] = implode(",", $branlist);
                $smarty->assign("COUNBRAN", count($branlist));
                $retucode = 1;
            }
        }
        #++++++++++++++++++++++++++++++++++
        # 02.07.2010 СПЕЦИАЛЕН СЛУЧАЙ
        # word документ с много адресати и един изх.номер
        //var_dump($isword);
        //var_dump($issepa);
        if ($isword and !$issepa) {
            # избягваме формата за потвърждение
            $flagok = true;
            $branlist = $_POST["branlist"];
            //					$branstri= implode(",",$branlist);
            # ВНИМАНИЕ. 21.01.2012
            # Ако няма размножаване $tablmult=="" дава грешка Warning implode invalid argument passed
            # след което отминава
            if (is_array($branlist)) {
                $branstri = implode(",", $branlist);
            } else {
            }
            unset($_POST["branstri"]);
            $retucode = 0;
        } else {
        }
        //var_dump($flagok);
        //var_dump($_POST["branstri"]);
        //var_dump($branstri);
        //var_dump($retucode);

        if ($flagok) {
            # успешен край
            #============================================================================================================================
            $retucode = 0;
            # СПЕЦИАЛНО при размножаване по адресати (поделения)
            # четем текстовете на адресатите
            if (empty($tablmult)) {
            } else {
                //											$liad= $DB->selectCol("select name from $tablmult where id in ($branstri)");
                //											$liad= $DB->select("select name, address from $tablmult where id in ($branstri)");
                $liad = $DB->select("select * from $tablmult where id in ($branstri)");
                //$liad= dbconv($liad);
            }
            # 18.08.2014 - връчване
            # заключваме
            //$DB->query("lock tables docuout write, user write, office write");
            if ($ISPOST) {
                $DB->query("lock tables docuout write, user write, office write, post write");
            } else {
                $DB->query("lock tables docuout write, user write, office write");
            }
            # подготвяме съдържанието
            $aset = array();
            $aset["year"] = (int)date("Y");
            $aset["adresat"] = $_POST["adresat"];
            $aset["notes"] = $_POST["notes"];
            # ВНИМАНИЕ. 01.11.2018 КОРЕГИРАНА ВАЖНА ГРЕШКА
            # $_POST["getnext"] връща празен стринг вместо unset
            # затова променяме проверката
            //			if (isset($_POST["getnext"])){
            if (!empty($_POST["getnext"])) {
                $aset["serial"] = getnextout();
                outnext("cazo6regi/1/aset-data/$regi", $aset["serial"]);
            } else {
                $aset["serial"] = $serinome;
            }
            # 04.01.2011 - изх.номер с водещи нули
            $aset["serial"] = str_pad($aset["serial"], 5, "0", STR_PAD_LEFT);
            # 11.05.2009 - специално за Бургас
            # добавяме и датата - за Бургас се извежда датата вместо годината
            //			$ar2= array($aset["serial"],$aset["year"]);
            $ar2 = array($aset["serial"], $aset["year"], date("d.m.Y"));
            # 22.07.2009 - мултиплициране за всички банки
            # предотвратяваме заместването на маркера за банка адресат с празен стринг
            if (strpos($docont, $noregist) === false) {
                $ar2[] = "";
            } else {
                $ar2[] = $noregist;
            }
            # 06.08.2009
            # проверяваме за маркер на списък, извеждан чрез избор на чекбоксове
            # ако има такъв маркер, предотвратяваме заместването му с празен стринг
            //print "<xmp>$docont</xmp>";
            foreach ($arregioncb as $mymark => $x2) {
                //print "<br>$mymark";
                if (strpos($docont, $mymark) === false) {
                    //print "=FALSE";
                    $ar2[] = "";
                } else {
                    //print "=$mymark";
                    $ar2[] = $mymark;
                }
            }

            //print_r($arregistration);
            //print_r($ar2);
            # според дали да има размножаване по адресати (поделения)
            if (empty($tablmult)) {
                # няма размножаване
                outnext("cazo6regi/1a/NOTmulti/$regi", $aset["serial"]);
                # заместваме в съдържанието
                $con2 = str_replace($arregistration, $ar2, $docont);
                # изходяване на единичен съществуващ документ
                regiaction($isword, $regi, $aset, $con2);
                # 18.08.2014 - връчване
                # единичен документ
                #====================================================================
                if ($ISPOST) {
                    $pset = array();
                    $pset["iduser"] = $_SESSION["iduser"];
                    $pset["iddocuout"] = $regi;
                    $pset["idposttype"] = $_POST["idposttype"];
                    $pset["adresat"] = trim($_POST["postadresat"]);
                    $pset["address"] = trim($_POST["postaddress"]);
                    //$DB->query("insert into post set ?a, created=now()"  ,$pset);
                    postinse($pset);
                } else {
                }
                #====================================================================
            } else {
                # СПЕЦИАЛНО при размножаване по адресати (поделения)
                outnext("cazo6regi/1b/MULTI/$regi", $aset["serial"]);
                //print_rr($liad);
                //---var_dump($isword);
                //---var_dump($issepa);
                //print_rr($aset);
                # функции за xml/word документ - много документи от един шаблон, разделени с PageBreak
                include_once "wordmult.inc.php";
                #+++++++++++++++++++++++++++++++++++
                # 02.07.2010 СПЕЦИАЛЕН СЛУЧАЙ
                # word документ с много адресати и един изх.номер
                if ($isword and !$issepa) {
                    /****/
                    #-------------------------------------------------------
                    //# функции за xml/word документ - много документи от един шаблон, разделени с PageBreak
                    //include_once "wordmult.inc.php";
                    # извличаме чистото съдържание без начало/край
                    $clearcon = get_doc_content($docont);
                    # същото без таговете с футера
                    $clear2 = putfooter($clearcon, "");
                    //# заместваме готовите тагове в чистото съдържание
                    //$con2= str_replace($arregistration, $ar2, $clearcon);
                    # мултиплицираме чистото съдържание
                    # масив с отделните документи - за сборния документ
                    $arnewcont = array();
                    # цикъл по избраните адресати
                    //			foreach($liad as $liin=>$adrename){
                    foreach ($liad as $liin => $lielem) {
                        $adrename = $lielem["name"];
                        //# адресата и сер.номер за новия запис
                        //$aset["adresat"]= $adrename;
                        //$aset["serial"] ++;
                        # адресата за заместване в съдържанието
                        ar2replace($tagmulti, stripslashes($adrename));
                        # сер.номер за заместване в съдържанието
                        ar2replace("(-[IZHODQSHT_NOMER]-)", $aset["serial"]);
                        # заместваме в съдържанието
                        if ($liin == count($liad) - 1) {
                            $con2 = str_replace($arregistration, $ar2, $clearcon);
                        } else {
                            $con2 = str_replace($arregistration, $ar2, $clear2);
                        }
                        # към масива за сборния документ
                        $arnewcont[] = $con2;
                    }
                    # сборния документ
                    # $pagemult - от wordmult.inc.php
                    $newcont = implode($pagemult, $arnewcont);
                    # сборния документ с начало/край
                    $endcont = replace_doc_content($docont, $newcont);
                    # адресата и сер.номер за новия запис
                    $aset["adresat"] = count($liad) . toutf8(" броя");
                    # еднократно изходяваме новия документ
                    regiaction($isword, $regi, $aset, $endcont);
                    #-------------------------------------------------------
                    /****/
                    # 18.08.2014 - връчване
                    # документ с много адресати и ЕДНАКЪВ изх.номер
                    #====================================================================
                    if ($ISPOST) {
                        //foreach($liad as $liin=>$adrename){
                        foreach ($liad as $liin => $lielem) {
                            $adrename = $lielem["name"];
                            //print "<br>$adrename";
                            $pset = array();
                            $pset["iduser"] = $_SESSION["iduser"];
                            $pset["iddocuout"] = $regi;
                            $pset["idposttype"] = $_POST["idposttype"];
                            //$pset["adresat"]= trim($_POST["postadresat"]);
                            //$pset["address"]= trim($_POST["postaddress"]);
                            ar2replace($tagmulti, stripslashes($adrename));
                            $postadresat = trim($_POST["postadresat"]);
                            $tranasat = str_replace($arregistration, $ar2, $postadresat);
                            //print "<br>$tranasat";
                            $postaddress = trim($_POST["postaddress"]);
                            $tranaddr = str_replace($arregistration, $ar2, $postaddress);
                            $pset["adresat"] = $tranasat;
                            $pset["address"] = $tranaddr;
                            //$DB->query("insert into post set ?a, created=now()"  ,$pset);
                            //print_rr($pset);
                            postinse($pset);
                        }
                    } else {
                    }
                    #====================================================================
                } else {
                    # определяме следващия номер на група - за новата група
                    $maxgroup = $DB->selectCell("select max(regigroup) from docuout");
                    $nextgroup = $maxgroup + 1;
                    # за всички нови записи - групата
                    # 29.03.2017
                    # в делото няма да излиза група с отваряне/затваряне, а отделни документи
                    # и всеки документ ще може да се корегира с десен бутон
                    ////////////////////////////////////////////////////$aset["regigroup"]= $nextgroup;
                    # допълваме полетата със съдържание от сегашния нерегистриран запис
                    foreach ($rodocu as $finame => $ficont) {
                        if (0) {
                        } elseif ($finame == "id") {
                        } elseif ($finame == "registered") {
                        } elseif (isset($aset[$finame])) {
                        } else {
                            $aset[$finame] = $ficont;
                        }
                    }
                    # 22.10.2010 Дичев - пропускаше изх.номер
                    $aset["serial"]--;
                    # цикъл по избраните адресати
                    //foreach($liad as $adrename){
                    foreach ($liad as $liin => $lielem) {
                        $adrename = $lielem["name"];
                        # адресата и сер.номер за новия запис
                        $aset["adresat"] = $adrename;
                        $aset["serial"]++;
                        # адресата за заместване в съдържанието
                        //										ar2replace($tagmulti,$adrename);
                        ar2replace($tagmulti, stripslashes($adrename));
                        # сер.номер за заместване в съдържанието
                        ar2replace("(-[IZHODQSHT_NOMER]-)", $aset["serial"]);
                        //print "<br>$tagmulti=$adrename=".$aset["serial"];
                        //print_rr($arregistration);
                        //print_rr($ar2);
                        /*
                        # заместваме в съдържанието
                        $aset["content"]= str_replace($arregistration, $ar2, $docont);
                                                                # създаваме пореден нов запис
                                                                $DB->query("insert into docuout set ?a, registered=now()" ,$aset);
                        */
                        # заместваме в съдържанието
                        $con2 = str_replace($arregistration, $ar2, $docont);
                        # изходяване - пореден нов документ
                        $iddocuout = regiaction($isword, NULL, $aset, $con2);
                        #====================================================================
                        # връчване - word документ с много адресати и ПОСЛЕДОВАТЕЛНИ изх.номер
                        # записваме в табл.postwait поредния запис за поредния адресат
                        if ($ISPOST) {
                            $postadresat = $_POST["postadresat"];
                            $tranasat = str_replace($arregistration, $ar2, $postadresat);
                            $postaddress = $_POST["postaddress"];
                            $tranaddr = str_replace($arregistration, $ar2, $postaddress);
                            $pset = array();
                            $pset["iduser"] = $_SESSION["iduser"];
                            $pset["iddocuout"] = $iddocuout;
                            $pset["idposttype"] = $_POST["idposttype"];
                            if ($nodeli) {
                                $pset["idposttype"] = $rodoty["idposttype"];
                            } else {
                            }
                            $pset["adresat"] = $tranasat;
                            $pset["address"] = $tranaddr;
                            # при размножаване - директно наименованието и адреса
                            if (empty($tablmult)) {
                            } else {
                                $pset["adresat"] = $lielem["name"];
                                //$pset["address"]= $lielem["address"];
                            }
                            //															insepostwait($pset);
                            postinse($pset);
                        } else {
                        }
                        #====================================================================
                        # край цикъл по избраните адресати
                    }
                    //# накрая - изтриваме сегашния нерегистриран (неизходен) запис
                    //$DB->query("delete from docuout where id=?d"  ,$regi);
                    # накрая - записваме групата в сегашния нерегистриран (неизходен) запис
                    $DB->query("update docuout set regigroup=$nextgroup where id=?d", $regi);
                    # КРАЙ word документ с много адресати и един изх.номер
                    # if ($isword and !$issepa){
                }

                #-----------------------------------------------------------------
                # 04.01 2011
                # ако е word документ с много адресати и РАЗЛИЧНИ изх.номера
                # - формираме общ документ за разпечатване
                if ($isword and $issepa) {
                    # документите от групата
                    //---var_dump($nextgroup);
                    $listid = $DB->selectCol("select id from docuout where regigroup=?d and serial<>0", $nextgroup);
                    //---print_rr($listid);
                    //	# извличаме чистото съдържание без начало/край
                    //	$clearcon= get_doc_content($docont);
                    //	# същото без таговете с футера
                    //	$clear2= putfooter($clearcon, "");
                    # масив с отделните документи - за сборния документ
                    $arnewcont = array();
                    $docont = "";
                    # цикъл по всички
                    foreach ($listid as $indx => $currid) {
                        $currname = "docs/" . $currid . ".doc";
                        $docont = file_get_contents($currname);
                        $clearcon = get_doc_content($docont);
                        if ($indx == count($listid) - 1) {
                            $con2 = $clearcon;
                            //---print "<br>$indx=clearcon";
                        } else {
                            $clear2 = putfooter($clearcon, "");
                            $con2 = $clear2;
                            //---print "<br>$indx=CON2";
                        }
                        # към масива за сборния документ
                        $arnewcont[] = $con2;
                        //---print "<br>".strlen($docont)."/".strlen($con2)."/".count($arnewcont);
                    }
                    # сборния документ
                    # $pagemult - от wordmult.inc.php
                    $newcont = implode($pagemult, $arnewcont);
                    //---print "<br>newcont=".strlen($docont)."/".strlen($newcont);
                    //---$p1= strpos($docont,"body");
                    //---var_dump($p1);
                    # сборния документ с начало/край
                    $endcont = replace_doc_content($docont, $newcont);
                    //---print "<br>".strlen($docont);
                    //---print "<br>".strlen($newcont);
                    //---print "<br>".strlen($endcont);
                    //---$p1= strpos($endcont,"body");
                    //---var_dump($p1);
                    # записваме сборния документ
                    $wordname = "docs/" . $nextgroup . "group.doc";
                    file_put_contents($wordname, $endcont);
                    chmod($wordname, 0777);
                } else {
                }
                #-----------------------------------------------------------------

                # КРАЙ според дали да има размножаване по адресати (поделения)
                # if (empty($tablmult)){
            }
            # ОТключваме
            $DB->query("unlock tables");
            /*
            #---------------------------------------------------------
            # 27.04.2010
            # ANGEL REPLACE IN WORD FILE
            if ($isword){
                $docont= str_replace($arregistration, $ar2, $docont);
                    $fh= fopen($wordname, 'w+');
                    fwrite($fh, $docont);
                    fclose($fh);
                    chmod($doname, 0777);
            }else{
            }
            */
            #============================================================================================================================

            # 23.06.2010 - флаг - при изходяване на документ
            # автоматично да се добавя таксата като предмет на изпълнение
            if ($isregitax and $flagwilladd) {
                include_once "cazo6tax.inc.php";
                insertsubject($regi);
            } else {
            }

        } else {
            # if ($flagok){
        }

        # край - според дали има грешка
    }

    #------ отказано изходяване
} elseif ($mfacproc == "cancel") {
    $retucode = 0;

    #------ submit с формални грешки
} elseif ($mfacproc == NULL) {
    $retucode = 1;
    doerrors();

    #------ автоматичен submit -----------------------------------------------------
} elseif ($mfacproc == "UNKNOWN") {
    $retucode = 2;

    #------ невъзможна грешка от библиотеката
} else {
    print "<br>error=mfacproc=";
    var_dump($mfacproc);
    die();
}

#----------------- край на директното редактиране -----------------------

# резултат 
if ($retucode == 0) {
    outnext("cazo6regi/end-redir/$regi", "END");
    ////////////////////////////////////////die("REDIRECT");
    # redirect
    $smarty->assign("EXITCODE", getnyroexit(array("t6link", "t2link")));
    print smdisp($tpname, "iconv");
} else {
    //outnext("cazo6regi/end-form/$regi" ,"END");
    # извеждаме формата
    //	$smarty->assign("EDIT", $edit);
    $smarty->assign("NEXTNUMB", getnextout());
    outnext("cazo6regi/2/end-toform/$regi", $smarty->get_template_vars("NEXTNUMB"));
    $smarty->assign("FILIST", $filist);
    print smdisp($tpname, "iconv");
}


function ar2replace($ptag, $pcon)
{
    global $arregistration, $ar2;
    $tagind = array_search($ptag, $arregistration);
    if ($tagind === false) {
        die("ar2replace=$ptag");
    } else {
        $ar2[$tagind] = $pcon;
    }
}

/*
function putwordfile($wordname, $docont, $arregistration, $ar2){
	$docont= str_replace($arregistration, $ar2, $docont);
	$fh= fopen($wordname, 'w+');
	fwrite($fh, $docont);
	fclose($fh);
	chmod($wordname, 0777);
}
*/

function regiaction($isword, $regi, $aset, $con2)
{
    global $DB;
    //print "<br>regiaction=$regi";
    //$aset["content"]= str_replace($arregistration, $ar2, $docont);
    if ($isword) {
        $aset["content"] = "";
    } else {
        $aset["content"] = $con2;
    }
    # 12.07.2011 - юзер, който изходява
    $aset["iduserregi"] = $_SESSION["iduser"];
    # 05.08.2010 КРЪПКА
    //$nextou= getnextout();
    //$aset["serial"]= $nextou;
    outnext("cazo6regi/BEFORE", $nextou);
    # данните
    if ($regi === NULL) {
        # създаваме пореден нов запис
        $regi = $DB->query("insert into docuout set ?a, registered=now()", $aset);
        outnext("cazo6regi/insert=$regi", $aset["serial"]);
    } else {
        # 05.08.2010 КРЪПКА
        $rodout = getrow("docuout", $regi);
        $seri = $rodout["serial"];
        if ($seri + 0 == 0) {
        } else {
            unset($aset["serial"]);
            unset($aset["year"]);
            outnext("cazo6regi/BEFORE-UNSET/$seri", $nextou);
        }
        # корекция на записа
        # 23.02.2010 - отново запомняме времето на регистрация
        $DB->query("update docuout set ?a, registered=now() where id=?d", $aset, $regi);
        outnext("cazo6regi/update=$regi", $aset["serial"]);
    }
    # ANGEL REPLACE IN WORD FILE
    if ($isword) {
        $wordname = "docs/" . $regi . ".doc";
        //	$docont= str_replace($arregistration, $ar2, $docont);
        file_put_contents($wordname, $con2);
        //		$fh= fopen($wordname, 'w+');
        //		fwrite($fh, $docont);
        //		fclose($fh);
        chmod($wordname, 0777);
    } else {
    }
    return $regi;
}


?>
