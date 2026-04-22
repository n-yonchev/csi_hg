<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body style="font: normal 8pt verdana">

<?php
# 21.10.2010 Дичев - подредба на съдълищата по 
# - индекса на префикса 
# - азб.ред на града след префикса 
# ВНИМАНИЕ. 
# Веднага след този скрипт трябва да се изпълни _coformcache.php за кеширане на резултата 

								include "common.php";

$arpref= array();
$arpref[0]= "Районен съд";
$arpref[1]= "Окръжен съд";
$arpref[2]= "Административен съд";
$arpref[3]= "Апелативен съд";
$arpref[4]= "Военен съд";
$arpref[9]= "";
//$altindx= 9;

$query= "select id as ARRAY_KEY, name from cofrom";
$mylist= $DB->selectCol($query);
$mylist= dbconv($mylist);
						$arresu= array();
foreach($mylist as $idcurr=>$elem){
	foreach($arpref as $inpref=>$prefix){
//			$found= false;
		if (substr($elem,0,strlen($prefix))==$prefix){
						$arresu[$inpref][$idcurr]= $elem;
//			$found= true;
			break;
		}else{
		}
	}
//print "<br>".toutf8($elem)."[$inpref]";
//	if ($found){
//	}else{
//						$arresu[$altindx][]= $elem;
//	}
}

foreach($arresu as $inpref=>$arelem){
	uasort($arelem,"fusort");
	$arresu[$inpref]= $arelem;
}
function fusort($a,$b){
global $arpref, $inpref;
	$lepref= strlen($arpref[$inpref]);
	$a1= trim(substr($a,$lepref));
	$b1= trim(substr($b,$lepref));
	if ($a1==$b1){
return 0;
	}elseif ($a1<$b1){
return -1;
	}else{
return 1;
	}
}

$arresu= toutf8($arresu);
//print_rr($arresu);
						$seri= 0;
foreach ($arpref as $inpref=>$arelem){
	foreach ($arresu[$inpref] as $idcurr=>$elem){
print "<br>[$inpref][$idcurr] $elem";
						$seri ++;
		$DB->query("update cofrom set serial=?d where id=?d"  ,$seri,$idcurr);
	}
}

?>