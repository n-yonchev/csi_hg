<?php
#    $mode - текущия режим 
#    $period - периода за отчета 

								include_once "rep2.inc.php";
								include_once "rep3.inc.php";

# вторично меню с линкове 
$arvari= array();

#---- idrepo 
$arvari["rep2tran1"]["text"]= "формиране";			$arvari["rep2tran1"]["php"]= "rep2tran1.php";
$arvari["rep2tran2"]["text"]= "трансформации";		$arvari["rep2tran2"]["php"]= "rep2tran2.php";	
													$arvari["rep2tran2"]["isex"]= 1;

#---- rep1 
$arvari["form1"]["text"]= "извеждане";		$arvari["form1"]["php"]= "rep1v1.php";		$arvari["form1"]["create"]= "rep1crea.php";

#---- rep2 
$arvari["prep"]["text"]= "подготовка";		$arvari["prep"]["php"]= "rep2v1.php";
$arvari["calc"]["text"]= "изчисления";		$arvari["calc"]["php"]= "rep2v2.php";
											$arvari["calc"]["isex"]= 1;
$arvari["resu"]["text"]= "резултат";		$arvari["resu"]["php"]= "rep2v3.php";	
											$arvari["resu"]["isex"]= 1;
$arvari["form"]["text"]= "извеждане";		$arvari["form"]["php"]= "rep2v4.php";		$arvari["form"]["create"]= "rep2crea.php";

#---- rep3 
/***
$arvari["prep2"]["text"]= "подготовка";		$arvari["prep2"]["php"]= "rep3v1.php";
$arvari["clai2"]["text"]= "настройка";		$arvari["clai2"]["php"]= "rep3v22.php";
											$arvari["clai2"]["isex"]= 1;
$arvari["form2"]["text"]= "извеждане";		$arvari["form2"]["php"]= "rep3v3.php";		$arvari["form2"]["create"]= "rep3v33crea.php";
***/
$arvari["form2"]["text"]= "извеждане";		$arvari["form2"]["php"]= "rep3v3.php";		$arvari["form2"]["create"]= "rep3crea.php";

				$modeel= "mode=".$mode."&period=".$period;
foreach ($arvari as $uskey=>$uscont){
	$arvari[$uskey]["link"]= geturl($modeel."&vari=".$uskey);
}
$smarty->assign("ARVARI", $arvari);

# сценарий 
$arscen= array();
$arscen[1]= "ред за отчета";
$arscen[2]= "раздел 1";
$arscen[3]= "раздел 2";
$arscen[4]= "ВСС";
$smarty->assign("ARSCEN", $arscen);
	$argrou= array();
	$argrou[1]= array("rep2tran1","rep2tran2");
	$argrou[2]= array("form1");
	$argrou[3]= array("prep","calc","resu","form");
	$argrou[4]= array("prep2","clai2","form2");
	$smarty->assign("ARGROU", $argrou);

# текущ елемент 
$vari= $GETPARAM["vari"];
if (isset($vari)){
}else{
//	$akey= array_keys($arvari);
//	$vari= $akey[0];
	if (tabexists($tarepo)){
		$vari= "resu";
	}else{
//		$vari= "prep";
			//$akey= array_keys($x2);
			//$indx= $akey[0];
		$akey= array_keys($arvari);
		$vari= $akey[0];
	}
}
$smarty->assign("VARI", $vari);

					$phpcreate= $arvari[$vari]["create"];
									# формиране Excel 
									$create= $GETPARAM["create"];
									if (isset($create)){
					include_once($arvari[$vari]["create"]);
					exit;
									}else{
									}

					include_once($arvari[$vari]["php"]);
$smarty->assign("REP2CONT", $rep2cont);

					if (isset($phpcreate)){
# URL за вътр.фрейм - формиране Excel 
$urlcreate= geturl("mode=".$mode."&period=".$period."&vari=".$vari."&create=1");
$smarty->assign("URLCREATE", $urlcreate);
					}else{
					}
					
# извеждаме 
$smarty->assign("PERIOD", $period);
			if (isset($pagecont)){
			}else{
$pagecont= smdisp("repomenu.tpl","fetch");
			}

?>
