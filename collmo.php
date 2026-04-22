<?php
# събрани суми от логнатия деловодител 

# логнатия потребител 
$iduser= @$_SESSION["iduser"];

# текущата страница 
//print_r($GETPARAM);
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

# текущ месец-година 
$currmoye= date("n-Y");
# съдържание на филтъра за всички дела 
$allcase= "all";
# брой месеци в антетката 
$stepmo= 6;
									/*
									# източник : stmontuser.ajax.php 
									# условие за постъпленията - влизат само : 
									#    тип=1 - банка, само ако има връзка с банк.постъпления 
									#    тип=2 - в-брой 
									$typefilt= "(finance.idtype=2 or finance.idtype=1 and finasource.id is not null)";
									$typelink= "left join finasource on finasource.idfinance=finance.id";
									*/
						include_once "stmont.inc.php";

# начален месец-година за текущата група 
$begimoye= $GETPARAM["begimoye"];
if (isset($begimoye)){
}else{
	$begimoye= $currmoye;
}

# месец-година за филтъра на делата 
$filtmoye= $GETPARAM["filtmoye"];
if (isset($filtmoye)){
}else{
	$filtmoye= $begimoye;
}
$smarty->assign("FILTMOYE", $filtmoye);
//print "filtmoye=[$filtmoye]";

# предишна и следваща група месеци 
						# префикс за линкoвете за месеците в групата 
//						$modeel= "mode=".$mode."&begimoye=".$begimoye."&filtmoye=".$filtmoye;
						$modeel= "mode=".$mode."&begimoye=".$begimoye;
			$listmoye= array($begimoye);
			$listmoyelink= array(geturl($modeel."&filtmoye=".$begimoye));
list($mo,$ye)= explode("-",$begimoye);
										$mymax= "12*$ye+$mo";
for ($i=1;$i<$stepmo;$i++){
	$mo --;
	if ($mo==0){
		$mo= 12;
		$ye --;
	}else{
	}
			$listmoye[]= "$mo-$ye";
			$listmoyelink[]= geturl($modeel."&filtmoye="."$mo-$ye");
}
$smarty->assign("LISTMOYE", $listmoye);
$smarty->assign("LISTMOYELINK", $listmoyelink);
$smarty->assign("LINKALL", geturl($modeel."&filtmoye=".$allcase));
										$mymin= "12*$ye+$mo";
//print "[$mymax][$mymin]";

list($mo,$ye)= explode("-",$begimoye);
						# префикс за линкoвете за групите - няма страница 
						$modeel= "mode=".$mode;
	$prevmo= $mo;
	$prevye= $ye;
	$prevmo -= $stepmo;
//print "[$prevmo][$prevye]";
	if ($prevmo<1){
		$prevmo += 12;
		$prevye --;
	}else{
	}
$prevmoye= "$prevmo-$prevye";
$smarty->assign("PREVMOYE", $prevmoye);
$smarty->assign("PREVLINK", geturl($modeel."&begimoye=".$prevmoye));
if ($begimoye==$currmoye){
}else{
	$nextmo= $mo;
	$nextye= $ye;
	$nextmo += $stepmo;
//print "x[$nextmo]x[$nextye]";
	if ($nextmo>12){
		$nextmo -= 12;
//print "nextmo=[$nextmo]";
		$nextye ++;
//print "nextye=[$nextye]";
	}else{
	}
$nextmoye= "$nextmo-$nextye";
$smarty->assign("NEXTMOYE", $nextmoye);
$smarty->assign("NEXTLINK", geturl($modeel."&begimoye=".$nextmoye));
}

# масив с обобщените данни за всички дела на деловодителя 
/*****
$mymoye= "12*year(finance.time)+month(finance.time)";
$mycode= "$mymoye >= $mymin and $mymoye <= $mymax";
$myconc= "concat(month(finance.time),'-',year(finance.time))";
$genedata= $DB->selectCol("
	select finance.idcase as ARRAY_KEY1, $myconc as ARRAY_KEY2
	, sum(finance.separa+finance.separa2)
	from finance
	left join suit on finance.idcase=suit.id
									$typelink
	where suit.iduser=$iduser and $mycode
									and $typefilt
	group by idcase, $myconc
	");
*****/
# 14.06.2010 - Бъзински (Софрониев) 
# - участват само приключените с датата на приключване : 
# виж и паралелната корекция в stmont.inc.php 
$mymoye= "12*year(finance.timeclosed)+month(finance.timeclosed)";
$mycode= "finance.isclosed<>0 and ($mymoye >= $mymin and $mymoye <= $mymax)";
$myconc= "concat(month(finance.timeclosed),'-',year(finance.timeclosed))";
$genedata= $DB->selectCol("
	select finance.idcase as ARRAY_KEY1, $myconc as ARRAY_KEY2
	, sum(finance.separa+finance.separa2)
	from finance
	left join suit on finance.idcase=suit.id
									$typelink
	where suit.iduser=$iduser and $mycode
									and $typefilt
	group by idcase, $myconc
	");

$smarty->assign("GENEDATA", $genedata);
//print_rr($genedata);

# обработваме обобщ.данни 
									# сумарно по месеци 
									$sumoye= array();
foreach($genedata as $idcase=>$elemcase){
	foreach($elemcase as $moye=>$sumamoye){
									$sumoye[$moye] += $sumamoye;
	}
}
$smarty->assign("SUMOYE", $sumoye);
//print_rr($sumoye);
//$mymax= "12*year(finance.time)+month(finance.time)";
/*
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
*/
# четем списъка с делата - според филтъра за делата 
			if ($filtmoye==$allcase){
				# всички дела 
//$myquery= "select * from suit where iduser=$iduser order by year, serial";
$myquery= "select id, serial, year from suit where iduser=$iduser order by year, serial";
			}else{
				# само делата, за които има ненулева събрана сума през месеца от филтъра 
$myc2= "$myconc = '$filtmoye'";
$myquery= "
	select distinct suit.id as id, suit.serial as serial, suit.year as year
	from finance
	left join suit on finance.idcase=suit.id
									$typelink
	where suit.iduser=$iduser 
		and $myc2
		and finance.separa+finance.separa2 >0
									and $typefilt
	order by year, serial
	";
//		,finance.separa+finance.separa  as sumata
//		and if(finance.separa='0','',finance.separa) + if(finance.separa2='0','',finance.separa2) >0
			}
						# префикс за линкoвете за странициране 
						$baseurl= "mode=".$mode."&begimoye=".$begimoye."&filtmoye=".$filtmoye;
		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
		$query= $myquery;
		$prefurl= "";
//		$baseurl= "mode=".$mode;
		$obpagi= new paginator(20, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);

$smarty->assign("LIST", $mylist);

//print "[$prevmoye][$nextmoye]";
# извеждаме 
$pagecont= smdisp("collmo.tpl","fetch");


?>
