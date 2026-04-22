<?php

									session_start();
									include_once "common.php";
//print "COLLMO.AJAX.PHP";
//print_rr($_GET);

$caid= $_GET["caid"];
$moye= $_GET["moye"];
	list($mymont,$myyear)= explode("-",$moye);
						
						# 15.04.2010 - Бъзински - влизат само : 
						#    тип=1 - банка, само ако има връзка с банк.постъпления 
						#    тип=2 - в-брой 
						include_once "stmont.inc.php";

# източник : collmo.php 
/*
$mymoye= "12*year(finance.time)+month(finance.time)";
$mycode= "$mymoye = 12*$myyear+$mymont";
//$myconc= "concat(month(finance.time),'-',year(finance.time))";
$mydata= $DB->select("
	select finance.*
	from finance
									$typelink
	where finance.idcase=$caid and $mycode
									and $typefilt
	");
*/
//$mymoye= "12*year(finance.time)+month(finance.time)";
//$mycode= "$mymoye = 12*$myyear+$mymont";
//$myconc= "concat(month(finance.time),'-',year(finance.time))";

/****
$mydata= $DB->select("
	select finance.*, finance.time as finatime, month(finance.time) as finamo, year(finance.time) as finaye
		,finasource.date as bankdate ,finasource.hour as bankhour
		,$typefiltcode as filtcode
	from finance
									$typelink
	where finance.idcase=$caid
	order by finance.id desc
	");
****/
# 14.06.2010 - Бъзински (Софрониев) 
# - участват само приключените с датата на приключване 
# - извеждаме и датата на приключване 
# виж и паралелните корекции в stmont.inc.php, collmo.php 
$mydata= $DB->select("
	select finance.*, finance.time as finatime
	, finance.timeclosed as finaclos
	, month(finance.timeclosed) as finamo, year(finance.timeclosed) as finaye
		,finasource.date as bankdate ,finasource.hour as bankhour
		,$typefiltcode as filtcode
	from finance
									$typelink
	where finance.idcase=$caid
	order by finance.id desc
	");
$mydata= dbconv($mydata);
//print_rr($mydata);
foreach($mydata as $myindx=>$myelem){
	$mydata[$myindx]["unseclai"]= unsetoclai($myelem["toclai"]);
//			if (12*$myelem["finaye"]+$myelem["finamo"] ==12*$myyear+$mymont){
			$con1= (12*$myelem["finaye"]+$myelem["finamo"] ==12*$myyear+$mymont);
			$con2= ($myelem["filtcode"]==1);
			if ($con1 and $con2){
	$mydata[$myindx]["mark"]= true;
			}else{
	$mydata[$myindx]["mark"]= false;
			}
}
$smarty->assign("DATA", $mydata);

						# за извеждане на "тип" - масива $listfinatype - commspec.php 
						# предаваме съдържанието на масива 
						$smarty->assign("ARTYPE", $listfinatype2);

print smdisp("collmo.ajax.tpl","iconv");

?>
