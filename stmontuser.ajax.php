<?php
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 

									session_start();
									include_once "common.php";

											# функциите 
											include_once "statis.inc.php";
$GEPA= getparam();
//print_r($GEPA);
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


# данните -  източник : stmont.php 
#--------------------------------------------------------------------------------------------
#--------- 9. обща събрана СУМА през периода по делата на деловодителя по деловодители -------------
#--------- 10. събрана СУМА за ЧСИ през периода по делата на деловодителя по деловодители -------------
# сума, а не брояч - в единна заявка 
# ВНИМАНИЕ. 
#    желаното разпределение е а)по делата и б)по такси и разноски, но са необходими доп.уточнения 
/*
//$filt9= "year(finance.time)=$year and month(finance.time)=$stmont";
$filt9= getfilt("finance.time");
$que9= "select suit.iduser as iduser
	, sum(finance.inco) as coun
	, sum(finance.separa+finance.separa2) as coun2
	from finance
	left join suit on finance.idcase=suit.id
	where $filt9 
	group by iduser
	";
*/
									/*
									# 15.04.2010 - Бъзински - влизат само : 
									#    тип=1 - банка, само ако има връзка с банк.постъпления 
									#    тип=2 - в-брой 
									$typefilt= "(finance.idtype=2 or finance.idtype=1 and finasource.id is not null)";
									$typelink= "left join finasource on finasource.idfinance=finance.id";
									*/
						include_once "stmont.inc.php";
$filt9= getfilt("finance.time");
$que9= "select suit.id as caseid, suit.serial as caseseri, suit.year as caseyear
	, sum(finance.inco) as coun
	, sum(finance.separa+finance.separa2) as coun2
	from finance
	left join suit on finance.idcase=suit.id
									$typelink
	where $filt9  and suit.iduser=$iduser
									and $typefilt
	group by caseid
	order by suit.year, suit.serial
	";
/*
$lis9= $DB->select($que9);

# обработваме данните 
						$lis9out= array();
						$lis10out= array();
foreach($lis9 as $elem){
	$cucase= $elem["caseid"];
		//# ВАЖНО. 
		//# $cuuser има стойности NULL -1 0 
		//$cuuser= $cuuser+0<=0 ? 0 : $cuuser;
//	$cumont= $elem["mont"];
	$cucoun= $elem["coun"];
						$lis9out[$cucase] += $cucoun;
												$suma[9] += $cucoun;
	$cucoun2= $elem["coun2"];
						$lis10out[$cucase] += $cucoun2;
												$suma[10] += $cucoun2;
}
												$sumamaxind= 10;
$smarty->assign("DATA9", $lis9out);
$smarty->assign("DATA10", $lis10out);
*/
$mylist= $DB->select($que9);
				# сумите по колони 
							$suma= array();
				foreach($mylist as $elem){
							$suma[1] += $elem["coun"];
							$suma[2] += $elem["coun2"];
				}
				$smarty->assign("SUMA", $suma);
$smarty->assign("DATA", $mylist);
#--------------------------------------------------------------------------------------------

# извеждаме 
print smdisp("stmontuser.ajax.tpl","iconv");

?>
