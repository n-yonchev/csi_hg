<?php
#17.02.2020 Копиран файла tranoutf3.php => tranout4.php
# всичко за формиране на ИЗХ.ФАЙЛ за УниКредит

$HEAD = "{1:F01UNCR7000XXXX0000000000}{2:I103BACX9660XXXXN0000}{4:";
$TAIL = "-}";

# трансформация за полетата на ИЗХ.ФАЙЛ - преводи извън опис
function filetranfree($ardata, $arbudata)
{
    global $rooffi, $DB;
    $messid = "CRED";
    $curr = "EUR";
    $charges = "SHA";
    $rings = "/DTYPE/PORD/OPER/RINGS";
    $bisera = "/DTYPE/PORD/OPER/BISER";
    $roacco= $DB->selectRow("select * from tranacco where code='uni'");
    $orderingIBAN= toutf8($roacco["iban"]);

    $arresu = array();
    foreach ($ardata as $indx => $cont) {
        $reelem = array();

        //print_rr($cont);

        $reelem["orderefe"] = sprintf("%d1%09d", $rooffi['serial'], $cont['id']);
        $reelem["messid"] = $messid;

        //датата е във формат YYMMDD, валутата е BGN, сумата е с десетичен разделител запетая
        $amount = $cont["amount"];
        $suma = number_format($amount, 2, ",", "");
        $reelem["suma"] = $suma;
        $reelem["valudate"] = sprintf("%s%s%s", date("ymd"),$curr, $suma);

        $reelem["orderingIBAN"] = "/" . $orderingIBAN;
        $reelem["orderingBAE"] = substr($orderingIBAN, 4, 8);

        $destIBAN = $cont["iban"];
        $reelem["destIBAN"] = "/" . $destIBAN;

        $reelem["destBAE"] = substr($destIBAN, 4, 8);

        $destName = $cont["clainame"];
        $destName = charspec($destName);
        $reelem["destName"] = $destName;

        $bicto = $cont["bic"];
        $reelem["bicto"] = $bicto;

        $reelem["charges"] = $charges;

        $textto = $cont["text"];
        $textto = charspec($textto);
        $textto = str_replace(array("|"), array(" "), $textto);
        $reelem["text1"] = wordwrap($textto, 35, "\r\n", true);

        # RINGS
        if ($cont["isring"] == 0) {
            $reelem["paymsyst"] = $bisera;
            $reelem["ps"] = "БИСЕРА";
        } else {
            $reelem["paymsyst"] = $rings;
            $reelem["ps"] = "РИНГС";
        }
        $bankto= $cont["bankname"];
        $bankto= charspec($bankto);
        $reelem["bankto"]= $bankto;

        $arresu[] = $reelem;
    }
    return $arresu;
}

# трансформация за полетата за ИЗХ.ФАЙЛ - от опис
function filetraninve($ardata)
{
    global $codet26, $codenop, $DB, $rooffi;

    $messid = "CRED";
    $curr = "EUR";
    $charges = "SHA";
    $rings = "/DTYPE/PORD/OPER/RINGS";
    $bisera = "/DTYPE/PORD/OPER/BISER";
    $roacco= $DB->selectRow("select * from tranacco where code='uni'");
    $orderingIBAN= toutf8($roacco["iban"]);

    $arresu = array();
    foreach ($ardata as $idinve => $cont) {
//$cont= tran1251($cont);
//print "<br>CONT=";
//print_rr($cont);
        $reelem = array();

        $reelem["orderefe"] = sprintf("%d2%09d", $rooffi['serial'], $idinve);
        $reelem["messid"] = $messid;

        //датата е във формат YYMMDD, валутата е BGN, сумата е с десетичен разделител запетая
        $amount = $cont["suma"];
        $suma = number_format($amount, 2, ",", "");
        $reelem["suma"] = $suma;
        $reelem["valudate"] = sprintf("%s%s%s", date("ymd"),$curr, $suma);

        $reelem["orderingIBAN"] = "/" . $orderingIBAN;
        $reelem["orderingBAE"] = substr($orderingIBAN, 4, 8);

        $destIBAN = $cont["accoiban"];
        $reelem["destIBAN"] = "/" . $destIBAN;

        $reelem["destBAE"] = substr($destIBAN, 4, 8);

        $destName = $cont["clainame"];
        $destName = charspec($destName);
        $reelem["destName"] = $destName;

        $bicto = $cont["bic"];
        $reelem["bicto"] = $bicto;

        $reelem["charges"] = $charges;


        if ($cont["accocode"] == $codet26 or $cont["accocode"] == $codenop) {
            $rtex1 = "ТАКСИ ОТ ТТР КЪМ ЗЧСИ С ДДС";
//				$rtex2= "ПО ОПИС $idinve ОТ " .date("d.m.Y");
            $rtex2 = "ПО ОПИС $idinve ОТ " . $cont["dateinve"];
        } else {
            $rtex1 = "ВНОСКИ ПО ИЗПЪЛНИТЕЛНИ ДЕЛА";
//				$rtex2= "ПО ОПИС $idinve ОТ " .date("d.m.Y");
            $rtex2 = "ПО ОПИС $idinve ОТ " . $cont["dateinve"];
        }
        $reelem["text1"] = wordwrap($rtex1 . ' ' . $rtex2, 35, "\r\n", true);

        # RINGS
        if ($cont["isring"] == 0) {
            $reelem["paymsyst"] = $bisera;
            $reelem["ps"] = "БИСЕРА";
        } else {
            $reelem["paymsyst"] = $rings;
            $reelem["ps"] = "РИНГС";
        }
        $bankto= $cont["bankname"];
        $bankto= charspec($bankto);
        $reelem["bankto"]= $bankto;

        $arresu[] = $reelem;
    }
    return $arresu;
}

# формиране ИЗХ.ФАЙЛ за Алианц
function getoutfile($ardate)
{
    global $rooffi;
    global $DB;
    GLOBAL $HEAD, $TAIL, $NL;
    GLOBAL $filegene; // tranpackfile.php - ID на пакета

    $arfiel = array("code", "nameto", "bicto", "ibanto", "bankto", "suma", "textto", "type", "ring", "taxt", "date");
    $arfiel = array("20" => "orderefe",
        "23B" => "messid",
        "32A" => "valudate",
        "50K" => "orderingIBAN",
        "52D" => "orderingBAE",
        "57D" => "destBAE",
        "59" => "destIBAN",
            "/59" =>"destName",
        "70" => "text1",
            //"/70" => "text2",
        "71A" => "charges",
        "72" => "paymsyst");

    $NL = "\r\n";
    $resucont = "";
    $sumacont = 0;
    $councont = 0;
    foreach ($ardate as $indx => $elem) {
        $elem = toutf8($elem);
        //$arrow= array();
        $row = "";
        foreach ($arfiel as $x1 => $fina) {
            $elemcont = $elem[$fina];
            if (strpos($x1, '/') === false) {
                $row .= sprintf(":%s:%s$NL", $x1, $elemcont);
            } else {
                $row .= sprintf("%s$NL", $elemcont);
            }
        }
        $resucont .= $HEAD . $NL . $row . $TAIL;
        $sumacont += $elem["suma"];
        $councont++;
    }
    $resucont .= $NL;

    #------------------------ водещ ред ---------------------------

    $sumatota = number_format($sumacont, 2, ",", "");

    $refe = sprintf("%d0%09d", $rooffi['serial'], $filegene);

    $r = "";
    $r .= sprintf(":20:%s$NL", $refe);
    $r .= sprintf(":12:%d$NL", $councont);
    $r .= sprintf(":77E::B01:%s$NL", date("ymd"));
    $r .= sprintf(":B1T:%dEUR%s$NL", $councont, $sumatota);

    $rowhead = $HEAD. $NL;
    $rowhead .= $r;
    $rowhead .= $TAIL;

    $rowhead = toutf8($rowhead);
    $result = $rowhead . $resucont;
    $result = tran1251($result);
    return $result;
}


