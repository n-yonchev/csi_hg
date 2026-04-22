<?php
//error_reporting(E_ALL);
//# локално 
//$codeprinfile= "printers.conf";
//$scanpath_inp= "//PUMBA/www/scandocs/outdir/";
# Бъзински 
$codeprinfile = "autoscan_print/printers.conf";
$scanpath_inp = "autoscan_read/outdir/";

$codeprinmark = "Info ";
$scansuff = "pdf";
$scanpath_out = "incoming/";

$arscaner = array();
$arscaner[1] = "файла не съществува";
$arscaner[2] = "при четене на файла";
$arscaner[3] = "при запис на файла";
$arscaner[4] = "при изтриване на файла";
if (isset($smarty)) {
    $smarty->assign("ARSCANER", $arscaner);
} else {
}

function getprinsele()
{
    global $codeprinfile, $codeprinmark;
    if (file_exists($codeprinfile)) {
    } else {
        return array();
    }
    $lemark = strlen($codeprinmark);
    $arresu = array();
    $arcont = file($codeprinfile);
    foreach ($arcont as $elem) {
        $elem = trim($elem);
        if (substr($elem, 0, $lemark) == $codeprinmark) {
            $nameprin = substr($elem, $lemark);
            list($nam1, $nam2) = explode("^", $nameprin);
            $arresu[$nam2] = $nam1;
        } else {
        }
    }
    return array("" => "") + $arresu;
}

function getscanlist($iduser)
{
    global $DB;
    $arresu = $DB->select("
		select scanlist.id as idscan, scanlist.iddocu, scanlist.pageco, scanlist.ider 
			, docu.serial, docu.text, docu.from
		from scanlist 
		left join docu on scanlist.iddocu=docu.id
		where docu.iduser=?d
		order by docu.serial
		", $iduser);
    //		order by scanlist.id
    $arresu = dbconv($arresu);
    $arresu = arstrip($arresu);
    return $arresu;
}

function print_scan_label($iddocu)
{
    $iddo4 = $iddocu;
    $idus4 = $_SESSION["iduser"];
    $rous4 = getrow("user", $idus4);
    $codeprin = $rous4["codeprin"];
    $rodo4 = getrow("docu", $iddo4);
    $docuseri = $rodo4["serial"];
    $docucrea = bgdatefrom($rodo4["created"]);
    list($e1, $e2) = explode(" ", $rodo4["created"]);
    list($h1, $h2, $h3) = explode(":", $e2);
    $docucrea .= " " . $h1 . ":" . $h2;
    //	$idca4= $rodo4["idcase"];
    global $DB;
    $arcase = $DB->selectCol("
				select concat(suit.serial,'/',suit.year) as suitnumb
				from docusuit
				left join suit on docusuit.idcase=suit.id
				where docusuit.iddocu=?d
				", $iddo4);
    /*
    $councase= count($arcase);
    if ($councase==1){
        $txcase= $arcase[0];
    }else{
        $txcase= "";
    }
    */
    include_once('autoscan_print/autoscan_printlabel.php');
    //						autoscan_printlabel($codeprin,$iddo4, $docuseri,$docucrea);
    //						autoscan_printlabel($codeprin,$iddo4, $docuseri,$docucrea ,$txcase);
    autoscan_printlabel($codeprin, $iddo4, $docuseri, $docucrea, $arcase);
    //echo ($codeprin.$iddo4.$docuseri. $docucrea. $arcase);
    //print "[$txcase]";
    //print $iddocu;
}

# отпечатване етикет - ajax docu.tpl
$iddo4 = $_GET["d"];
if (empty($iddo4)) {
} else {
    session_start();
    include_once "common.php";
    print_scan_label($iddo4);
    /***
     * $idus4= $_SESSION["iduser"];
     * $rous4= getrow("user",$idus4);
     * $codeprin= $rous4["codeprin"];
     * $rodo4= getrow("docu",$iddo4);
     * $docuseri= $rodo4["serial"];
     * $docucrea= bgdatefrom($rodo4["created"]);
     * //    $idca4= $rodo4["idcase"];
     * include_once('autoscan_print/autoscan_printlabel.php');
     * //                        autoscan_printlabel($codeprin,$iddo4, $docuseri,$docucrea, '159/2015');
     * autoscan_printlabel($codeprin,$iddo4, $docuseri,$docucrea);
     * //print $iddocu;
     ***/
    print "ok^";
}

# брой автом.сканирани документи - ajax docu.tpl
$idus4 = $_GET["u"];
if (empty($idus4)) {
} else {
    session_start();
    include_once "common.php";
    $arscan = getscanlist($idus4);
    $coun4 = count($arscan);
    print "ok^" . $coun4;
}

?>