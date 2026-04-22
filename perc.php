<?php
# обслужване на лихв.проценти 
# отгоре : 
#    $percent_file - файла с процентите 
#    $percent_logfile - файла с история на обновяването 


/*
# обновяване на лихв.проценти 
$refresh= $GETPARAM["refresh"];
if ($refresh=="yes"){
					//sleep(2);
					include_once "_getpercent.php";
}else{
}


# четем и десериализираме съдържанието 
			$arperc= array();
	if (file_exists($percent_file)){
$arperc= unserialize(file_get_contents($percent_file));
# в обратен ред 
$arperc= array_reverse($arperc);
	}else{
	}
//print_r($arperc);

# четем историята 
//# вече е в обратен ред 
			$arl2= array();
	if (file_exists($percent_logfile)){
$arlog= file($percent_logfile);
# в обратен ред 
$arlog= array_reverse($arlog);
# вземаме само първите 100 елемента 
$arlog= array_slice($arlog,0,100);
foreach($arlog as $loel){
			$arl2[]= explode(" ",$loel);
}
	}else{
	}


# за бутона "обнови" 
$modeel= "mode=".$mode;
$butref= geturl($modeel."&refresh=yes");

# извеждаме 
$smarty->assign("BUTREF", $butref);
$smarty->assign("ARPERC", $arperc);
$smarty->assign("ARLOG", $arl2);
$pagecont= smdisp("perc.tpl","fetch");
*/


# 07.05.2009 
# вече се извежда съдържанието от MySQL таблицата 
$arperc= $DB->select("select * from percent $MYFILTPERC order by id desc");
//print_r($arperc);
$coun= count($arperc);
//$step= (int)($coun/3) +1;
$step= ceil($coun/3);

# извеждаме 
$smarty->assign("ARPERC", $arperc);
$smarty->assign("STEP", $step);
$pagecont= smdisp("perc.tpl","fetch");

?>
