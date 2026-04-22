<?php
# отчет раздел 2 - етап 2 изчисления 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $vari - текущия режим на вторичното меню 
# още отгоре : 
#    $period - периода за отчета 
#    $tarepo - име на таблицата за периода 
#       $temp1/$temp2 - таблици с посл.статуси преди/през периода 
#       $temp3 - таблица с предметите 
#    $peyear, $pemon1, $pemon2 - година, нач, краен месец 
#    $yemon1, $yemon2 - за MySQL нач.краен година-месец yyyy-mm 

/*
					# начало на стъпка 
					$stepview= $GETPARAM["stepview"];
					if (isset($stepview)){
							include_once "rep2v2.ajax.php";
//return;
exit;
					}else{
					}
					# обработка на стъпка 
					$step= $GETPARAM["step"];
					if (isset($step)){
							include_once "rep2v2.ajax.php";
//return;
exit;
					}else{
					}

$modeel= "mode=".$mode ."&period=".$period ."&vari=".$vari;
$gurl= geturl($modeel."&stepview=1");
$smarty->assign("GURL", $gurl);
*/

					# начало 
					$action= $GETPARAM["action"];
					if (isset($action)){
							include_once "rep2calc.ajax.php";
//return;
exit;
					}else{
					}

$modeel= "mode=".$mode ."&period=".$period ."&vari=".$vari;
	$gurl= geturl($modeel."&action=getlis");
	$cleurl= geturl($modeel."&action=clear");
	$begurl= geturl($modeel."&action=begin");
$smarty->assign("GURL", $gurl);
$smarty->assign("CLEURL", $cleurl);
$smarty->assign("BEGURL", $begurl);

# извеждаме 
$rep2cont= smdisp("rep2v2.tpl","fetch");


?>