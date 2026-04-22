<?php
# отчет ВСС сумарно в 1 ред - формиране в iframe frarep 

								include_once "rep2.inc.php";
								include_once "rep3.inc.php";

/***
# заявката 
$codeex= "where $filtperi";
$q2= str_replace("[CODEEXTE]",$codeex,$qubase);
$query= str_replace("[CODECLAI]","'c'",$q2);

# данните 
$ardata= $DB->select($query);
//print_rr($ardata);
$ardata= dbconv($ardata);
$smarty->assign("ARDATA", $ardata);
fp($ardata);
***/

		if (file_exists($creaname1) and file_exists($creaname2)){
		}else{
//$smarty->assign("NOSESS", true);
exit;
		}

$ar1= unserialize(file_get_contents($creaname1));
$ar2= unserialize(file_get_contents($creaname2));
//fp($ar1);
//fp($ar2);
$ardata= array();
$ardata["c1"]= $ar1["1170-01"];
$ardata["c2"]= $ar1["1170-02"];
$ardata["c3"]= (int)($ardata["c1"] +$ardata["c2"]);
$ardata["c4"]= $ar1["1170-04"];
$ardata["c5"]= $ar1["1170-05"];
$ardata["c6"]= $ar1["1170-06"];
$ardata["c7"]= (int)($ardata["c3"] -$ardata["c4"] -$ardata["c5"] -$ardata["c6"]);

$ardata["c8"]= get2("C");
$ardata["c9"]= get2("D");
$ardata["c10"]= round($ardata["c8"] +$ardata["c9"] ,2);
$ardata["c12"]= get2("H");
$ardata["c13"]= get2("I");
$ardata["c11"]= round($ardata["c12"] +$ardata["c13"] ,2);
$ardata["c14"]= get2("J");
$ardata["c15"]= get2("K");

//$smarty->assign("ARDATA", $ardata);
$smarty->assign("ARDATA", array($ardata));

function get2($p1){
global $ar2;
	$resu= $ar2[13][$p1];
	$resu= str_replace(",",".",$resu);
return $resu;
}

# съдържанието 
$cont= smdisp("rep3crea.tpl","fetch");

# извеждаме 
ExcelHeader("rep3-$period.xls");
	
	$outp= "
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\" />
<body>
	$cont
</body>
</html>
	";

print $outp;

?>