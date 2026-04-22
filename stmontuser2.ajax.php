<?php
# февр.2010 - отчет-2 за бонусите 
# източник : stmontuser.ajax.php - отчет-1 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 

									session_start();
									include_once "common.php";

											# функциите 
											include_once "statis.inc.php";
$GEPA= getparam();
print_r($GEPA);
$iduser= $GEPA["user"];
	$rouser= getrow("user",$iduser);
					$smarty->assign("USERNAME", $rouser["name"]);
$stperi= $GEPA["peri"];
if (isset($stperi)){
	list($d1,$d2)= explode("^",$stperi);
					$smarty->assign("D1", $d1);
					$smarty->assign("D2", $d2);
}else{
	$year= $GEPA["year"];
	$stmont= $GEPA["mont"];
					$smarty->assign("YEAR", $year);
					$smarty->assign("MONT", $stmont);
}


/*
# данните -  източник : stmont.php 
#--------------------------------------------------------------------------------------------
#--------- 9. обща събрана СУМА през периода по делата на деловодителя по деловодители -------------
#--------- 10. събрана СУМА за ЧСИ през периода по делата на деловодителя по деловодители -------------
# сума, а не брояч - в единна заявка 
# ВНИМАНИЕ. 
#    желаното разпределение е а)по делата и б)по такси и разноски, но са необходими доп.уточнения 
$filt9= getfilt("finance.time");
$que9= "select suit.id as caseid, suit.serial as caseseri, suit.year as caseyear
	, sum(finance.inco) as coun
	, sum(finance.separa+finance.separa2) as coun2
	from finance
	left join suit on finance.idcase=suit.id
	where $filt9  and suit.iduser=$iduser
	group by caseid
	order by suit.year, suit.serial
	";
*/
# обхват - 
# постъпленията, които имат ненулеви суми за ЧСИ от приключени постъпления 
# по изп.дела на деловодител за месец/период 
	# филтри : 
	# - за периода - чрез времето на приключване 
	$filter= getfilt("finance.timeclosed");
	# - за деловодителя 
	$filter .= " and suit.iduser=$iduser";
	# - за приключено постъпление 
	$filter .= " and finance.isclosed=1";
	# за тип=1=банков.превод или тип=2=в.брой 
	# за банков превод - само ако има връзка с банк.извлечение 
	# игнорираме типовете 7=старо.плащане и 9=директно.взискателя 
	$filter .= " and (finance.idtype=1 and finasource.id is not null or finance.idtype=2)";
	# - за ненулеви сума за ЧСИ 
	$filter .= " and (finance.separa+finance.separa2<>0)";
# заявката 
$query= "select finance.timeclosed, finance.separa+finance.separa2 as suma, finance.inco, finance.idtype 
	, suit.id as caseid, suit.serial as caseseri, suit.year as caseyear
	from finance
	left join suit on finance.idcase=suit.id
			left join finasource on finasource.idfinance=finance.id
	where $filter
	order by finance.timeclosed
	";
//print "[$query]";
$mylist= $DB->select($query);
							# сумите по колони 
							$tota= array();
# изчисления 
foreach($mylist as $indx=>$elem){
	$novat= round($elem["suma"] /1.2 ,2);
	$mylist[$indx]["novat"]= $novat;
							$tota[1] += $elem["suma"];
							$tota[2] += $novat;
}
				$smarty->assign("TOTA", $tota);
							
							# за извеждане на "тип" - масива $listfinatype2 - commspec.php 
							# предаваме съдържанието на масива 
							$smarty->assign("ARTYPE", $listfinatype2);
$smarty->assign("DATA", $mylist);
#--------------------------------------------------------------------------------------------

//# извеждаме 
//print smdisp("stmontuser2.ajax.tpl","iconv");
# изход в Excel 
$cont= smdisp("stmontuser2.ajax.tpl","fetch");
//ExcelHeader("статистика-$stmont-$year.xls");
			if (isset($stperi)){
$sttext= "период";
			}else{
$sttext= "$stmont-$year";
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
