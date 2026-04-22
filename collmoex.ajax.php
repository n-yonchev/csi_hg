<?php
# 14.06.2010 - изход в Excell за бонусите 
# източник : collmo.ajax.php, stmontuser2.ajax.php 
# отгоре : 
#    $iduser - логнатия потребител 
//#    $mode - текущия режим 

									session_start();
									include_once "common.php";

$iduser= $_SESSION["iduser"];
$moye= $_GET["moye"];
	list($mymont,$myyear)= explode("-",$moye);
	$smarty->assign("YEAR", $myyear);
	$smarty->assign("MONT", $mymont);
$rouser= getrow("user",$iduser);
	$smarty->assign("USERNAME", $rouser["name"]);
						
						# 15.04.2010 - Бъзински - влизат само : 
						#    тип=1 - банка, само ако има връзка с банк.постъпления 
						#    тип=2 - в-брой 
						include_once "stmont.inc.php";


# 14.06.2010 - Бъзински (Софрониев) 
# - участват само приключените с датата на приключване 
# - извеждаме и датата на приключване 
# виж и паралелните корекции в stmont.inc.php, collmo.php 
# обхват - 
# постъпленията, които имат ненулеви суми за ЧСИ от приключени постъпления 
# по изп.дела на деловодител за месец/период 
	# филтри : 
	# - за периода - чрез времето на приключване 
//	year($p1)=$year and month($p1)=$stmont
	$filter= "year(finance.timeclosed)=$myyear and month(finance.timeclosed)=$mymont";
	# - за деловодителя 
	$filter .= " and suit.iduser=$iduser";
	# - за приключено постъпление 
	$filter .= " and finance.isclosed=1";
//	# за тип=1=банков.превод или тип=2=в.брой 
//	# за банков превод - само ако има връзка с банк.извлечение 
//	# игнорираме типовете 7=старо.плащане и 9=директно.взискателя 
//	$filter .= " and (finance.idtype=1 and finasource.id is not null or finance.idtype=2)";
	# - за ненулеви сума за ЧСИ 
	$filter .= " and (finance.separa+finance.separa2<>0)";
$mydata= $DB->select("
	select finance.*, finance.id as id, finance.idtype  
	, sum(finance.separa+finance.separa2) as suma
	, suit.serial as caseseri, suit.year as caseyear
	from finance
		left join suit on finance.idcase=suit.id
									$typelink
	where $filter
	group by caseyear, caseseri
	order by caseyear, caseseri
	");
$mydata= dbconv($mydata);
//print_rr($mydata);
/*
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
*/
							# сумите по колони 
							$tota= array();
# изчисления 
foreach($mydata as $indx=>$elem){
	$novat= round($elem["suma"] /1.2 ,2);
	$mydata[$indx]["novat"]= $novat;
							$tota[1] += $elem["suma"];
							$tota[2] += $novat;
}
				$smarty->assign("TOTA", $tota);
$smarty->assign("DATA", $mydata);

						# за извеждане на "тип" - масива $listfinatype - commspec.php 
						# предаваме съдържанието на масива 
						$smarty->assign("ARTYPE", $listfinatype2);


//# извеждаме 
//print smdisp("stmontuser2.ajax.tpl","iconv");
# изход в Excel 
$cont= smdisp("collmoex.ajax.tpl","fetch");
//ExcelHeader("статистика-$stmont-$year.xls");
			if (isset($stperi)){
$sttext= "период";
			}else{
$sttext= "м.$mymont-$myyear";
			}
$usname= str_replace(" ","-",$rouser["name"]);
ExcelHeader("$usname-$sttext.xls");
	$outp= "
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\" />
<body>
	$cont
</body>
</html>
	";
//<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
//print $cont;
print $outp;

?>
