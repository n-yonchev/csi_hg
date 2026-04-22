<?php
# списък дела за перемпция - от Пазарджик 29.11.2018 
# последните ДВЕ години делото да няма 
#     нито постъпления 
#     нито изходени изх.документи от шаблони с флаг docutype.idpere=1 
//print_rr($GETPARAM);


//# статус перемирано 
//$idstatpere= 4;
//$smarty->assign("IDSTATPERE", $idstatpere);

//# подготовка 
//# за всички вече перемирани дела - премахваме указателя за разпореждане
//$DB->query("update suit set idor2=0 where idstat in (4)");

											/*
													# 06.04.2016 - всичко за планирането 
													include_once "taxe.inc.php";
											include_once "taxe2.inc.php";
											*/

# за базов линк 
$modeel= "mode=".$mode;

# подменю 
$arvari= array();
$arvari[0]= "дела за перемиране";
$arvari[1]= "типове входящи документи";
$arvari[2]= "изходящи шаблони";
$smarty->assign("ARVARI", $arvari);
		$arlink= array();
foreach($arvari as $indx=>$text){
		$arlink[$indx]= geturl($modeel."&vari=".$indx);
}
$smarty->assign("ARLINK", $arlink);
//print_rr($arlink);

# скриптове за подменю 
$arphp= array();
$arphp[0]= "pere0.php";
$arphp[1]= "pere1.php";
$arphp[2]= "pere1.php";

# текущо подменю 
$vari= $GETPARAM["vari"];
if (isset($vari)){
}else{
	$akey= array_keys($arvari);
	$vari= $akey[0];
}
//$smarty->assign("VARI", $vari);

# параметри, подготовка 
$filtvari= "1";
					include "pere2.inc.php";
$resupara= inpara();
list($p1days,$p1inlist,$p1outlist)= $resupara;
//var_dump($resupara);
					include "pere.inc.php";

# бройки вх/изх типове 
$coun1= count($p1inlist);
$coun2= count($p1outlist);
$smarty->assign("ARCOUN", array(1=>$coun1, 2=>$coun2));
/*
if ($coun1==0){
	$vari= 1;
}else{
}
if ($coun2==0){
	$vari= 2;
}else{
}
*/
$smarty->assign("VARI", $vari);

# извеждане 
				include_once $arphp[$vari];
$smarty->assign("VARICONT", $pagecont);
$pagecont= smdisp("pere.tpl","fetch");

?>