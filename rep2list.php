<?php
# отчет раздел 2 - вторично меню 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
# и още отгоре : 
#    $period - периода за отчета 


# URL за вътр.фрейм, който извежда 
$urlcreate= geturl("mode=".$mode."&period=".$period."&create=1");
$smarty->assign("URLCREATE", $urlcreate);

								include_once "rep2.inc.php";

# вторично меню с линкове 
$arvari= array();
$arvari["prep"]["text"]= "подготовка";		$arvari["prep"]["php"]= "rep2v1.php";
$arvari["calc"]["text"]= "изчисления";		$arvari["calc"]["php"]= "rep2v2.php";
$arvari["resu"]["text"]= "резултат";		$arvari["resu"]["php"]= "rep2v3.php";
$arvari["form"]["text"]= "формиране";		$arvari["form"]["php"]= "rep2v4.php";
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
}else{
//	$akey= array_keys($arvari);
//	$vari= $akey[0];
	if (tabexists($tarepo)){
		$vari= "resu";
	}else{
		$vari= "prep";
	}
}
$smarty->assign("VARI", $vari);

					include_once($arvari[$vari]["php"]);
$smarty->assign("REP2CONT", $rep2cont);

# извеждаме 
$smarty->assign("PERIOD", $period);
//$smarty->assign("LIST", $mylist);
$pagecont= smdisp("rep2list.tpl","fetch");

?>
