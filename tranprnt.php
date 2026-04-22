<?php
# автоматично отпечатване на ред от банково извлечение 
# - вика се самостоятелно във вътр.фрейм - виж _fina.tpl 

session_start();
include_once "common.php";

# за извеждане на "тип" - масива $listfinatype - commspec.php
# предаваме съдържанието на масива
$smarty->assign("ARTYPE", $listfinatype);
/*
$GETPARAM= getparam();
//print_r($GETPARAM);
$prnt= $GETPARAM["prnt"];
*/

$para = $_GET["para"];
$palist = explode("/", $para);
unset($palist[count($palist) - 1]);
# 27.11.2012 
$smarty->assign("ARBANK", $listxmltype);
$content = "";
$first = 2;
foreach ($palist as $indx => $prnt) {
	//var_dump($prnt);
    /*
        if ($prnt==0){
            continue;
        }else{
        }
    */
    $prnt = $prnt;// -132;

    $rofina = getrow("finatran", $prnt);
    //print_rr($rofina);
# 27.11.2012 
    $rofina["bic"] = substr($rofina["iban"], 4, 8);
//var_dump($rofina["bic"]);
    $robankname = $DB->selectRow("select * from bankbic where bic=?", $rofina["bic"]);
    $robankname = dbconv($robankname);
	//print_rr($robankname);
    $rofina["bankname"] = $robankname["bank"];
    $rouser = getrow("user", $rofina["iduser"]);
    $rocase = getrow("suit", $rofina["idcase"]);
    $rocaseuser = getrow("user", $rocase["iduser"]);

    $smarty->assign("ROFINA", $rofina);
    $smarty->assign("ROUSER", $rouser);
    $smarty->assign("ROCASE", $rocase);
    $smarty->assign("ROCASEUSER", $rocaseuser);
    /*
    $robank= $DB->selectRow("select * from finasource where idfinance=?d" ,$prnt);
    if (empty($robank)){
    }else{
        $smarty->assign("ROBANK", dbconv($robank));
                $rofiba= getrow("finabank",$robank["idfinabank"]);
        $smarty->assign("ROFIBA", dbconv($rofiba));
    }
    */
    $first = 3 - $first;
//print "<br>".$indx."/".(count($palist)-1);
    if ($indx == count($palist) - 1) {
        $first = 0;
    } else {
    }
    $smarty->assign("FIRST", $first);
    $content .= smdisp("tranprnt.tpl", "fetch");
}

$smarty->assign("CONTENT", $content);
print smdisp("_print.tpl", "iconv");
