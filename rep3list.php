<?php
# отчет раздел 2 - вторично меню 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
# и още отгоре : 
#    $period - периода за отчета 
//print_rr($GETPARAM);

								include_once "rep2.inc.php";
								include_once "rep3.inc.php";

# URL за вътр.фрейм, който извежда 
$urlcreate= geturl("mode=".$mode."&period=".$period."&create=1");
$smarty->assign("URLCREATE", $urlcreate);

# вторично меню с линкове 
$arvari= array();
$arvari["prep"]["text"]= "подготовка";		$arvari["prep"]["php"]= "rep3v1.php";
//$arvari["clai"]["text"]= "по взискатели";	$arvari["clai"]["php"]= "rep3v2.php";
//$arvari["form"]["text"]= "формиране";		$arvari["form"]["php"]= "rep3v3.php";
$arvari["clai2"]["text"]= "настройка";	$arvari["clai2"]["php"]= "rep3v22.php";
$arvari["form2"]["text"]= "формиране";	$arvari["form2"]["php"]= "rep3v3.php";
				$modeel= "mode=".$mode."&period=".$period;
foreach ($arvari as $uskey=>$uscont){
//	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
//	$mylist[$uskey]["acti"]= geturl($modeel."&acti=".$idcurr);
	$arvari[$uskey]["link"]= geturl($modeel."&vari=".$uskey);
}
$smarty->assign("ARVARI", $arvari);

# текущ елемент 
$vari= $GETPARAM["vari"];
if (isset($vari)){
					include_once($arvari[$vari]["php"]);
	$smarty->assign("REP3CONT", $rep3cont);
}else{
//	$akey= array_keys($arvari);
//	$vari= $akey[0];
/***
	if (tabexists($tarepo)){
		$vari= "resu";
	}else{
		$vari= "prep";
	}
***/
}
$smarty->assign("VARI", $vari);

//					include_once($arvari[$vari]["php"]);
//$smarty->assign("REP3CONT", $rep3cont);

# предупреждение за готовност 
			if (tabexists("$tarepo") and tabexists("$tacoun")){
			}else{
$smarty->assign("ISWARN", true);
			}

# извеждаме 
$smarty->assign("PERIOD", $period);
//$smarty->assign("LIST", $mylist);
$pagecont= smdisp("rep3list.tpl","fetch");

?>
