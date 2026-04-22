<?php
# суми от фактури по години и месеци 
//print_rr($GETPARAM);

									# избрани година-месец 
									$yemo= $GETPARAM["yemo"];
									if (isset($yemo)){
										//include_once "finainvo.php";
										//exit;

# списъка 
		list($ye1,$mo1)= explode("-",$yemo);
$smarty->assign("YEMO", $yemo);
		if ($mo1=="00"){
//$CODEFILT= "bill.seriinvo=0 and year(bill.date)=$ye1";
$CODEFILT= "bill.seriinvo=0 and year(bill.dateinvo)=$ye1";
$CODEBASE= "&yemo=$yemo";
$smarty->assign("TEXTHEAD", "неизходени през $ye1 год.");
		}else{
//$CODEFILT= "bill.seriinvo<>0 and substring(bill.date,1,7)='$yemo'";
$CODEFILT= "bill.seriinvo<>0 and substring(bill.dateinvo,1,7)='$yemo'";
$CODEBASE= "&yemo=$yemo";
$smarty->assign("TEXTHEAD", "изходени през месец $mo1-$ye1");
		}
$smarty->assign("ISYEARLIST", false);
include "finainvo.inc.php";
return;
									}else{
									}

/*
# годините 
unset($listyear[0]);
$smarty->assign("LISTYEAR", $listyear);
//print_rr($listyear);
*/
# месеците 
	$listmont= array();
for ($i=1; $i<=12; $i++){
//	$listmont[]= str_pad($i,2,"0",STR_PAD_LEFT);
	$listmont[]= $i;
}
$smarty->assign("LISTMONT", $listmont);
//print_rr($listmont);

# за кредитните известия 
$codecred= "if(bill.idinvotype=2,-1,1)";

# данните от самост.фактури 
//	$yeinvo= "year(bill.date)";
	$yeinvo= "year(bill.dateinvo)";
//	$moinvo= "if(bill.seriinvo=0,0,month(bill.date))";
	$moinvo= "if(bill.seriinvo=0,0,month(bill.dateinvo))";
/*
$quinvo= "
	select $yeinvo as year, $moinvo as mont
		, sum(if(bill.isvat=0,1,1.2) * invoelem.quan * invoelem.price) as suma
		, sum(if(bill.isvat=0,0,0.2) * invoelem.quan * invoelem.price) as svat
		, count(distinct bill.id) as coun
	from invoelem
	left join bill on invoelem.idbill=bill.id
	where 1
and bill.id is not null
and bill.serial=0
	group by $yeinvo, $moinvo
	";
*/
$quinvo= "
	select $yeinvo as year, $moinvo as mont
		, round( sum($codecred * if(bill.isvat=0,1,1.2) * invoelem.quan * invoelem.price) ,2) as suma
		, round( sum($codecred * if(bill.isvat=0,0,0.2) * invoelem.quan * invoelem.price) ,2) as svat
		, count(distinct bill.id) as coun
	from invoelem
	left join bill on invoelem.idbill=bill.id
	where 1
and bill.id is not null
and bill.serial=0
and bill.idcase=0
	group by $yeinvo, $moinvo
	";
//====$datainvo= $DB->select($quinvo);
//====print_rr($datainvo);
//$smarty->assign("DATA", $datainvo);

# данните от фактури по сметки 
/*
$qubill= "
	select $yeinvo as year, $moinvo as mont
		, sum(if(bill.isvat=0,1,1.2) * (billelem.taxprop+billelem.taxregu+billelem.taxaddi)) as suma
		, sum(if(bill.isvat=0,0,0.2) * (billelem.taxprop+billelem.taxregu+billelem.taxaddi)) as svat
		, count(distinct bill.id) as coun
	from billelem
	left join bill on billelem.idbill=bill.id
	where 1
and bill.id is not null
and bill.serial<>0
	group by $yeinvo, $moinvo
	";
*/
$qubill= "
	select $yeinvo as year, $moinvo as mont
		, round( sum($codecred * if(bill.isvat=0,1,1.2) * (billelem.taxprop+billelem.taxregu+billelem.taxaddi)) ,2) as suma
		, round( sum($codecred * if(bill.isvat=0,0,0.2) * (billelem.taxprop+billelem.taxregu+billelem.taxaddi)) ,2) as svat
		, count(distinct bill.id) as coun
	from billelem
	left join bill on billelem.idbill=bill.id
	where 1
and bill.id is not null
and bill.serial<>0
and bill.idcase<>0
	group by $yeinvo, $moinvo
	";
//====$databill= $DB->select($qubill);
//====print_rr($databill);
//$smarty->assign("DATA", $databill);

# всички данни 
$quall= "
	($qubill) 
	union all
	($quinvo) 
	";
//====$dataall= $DB->select($quall);
//====print_rr($dataall);
//$smarty->assign("DATA", $dataall);

# сумарните данни 
$query= "
	select t1.year as ARRAY_KEY1, t1.mont as ARRAY_KEY2
	, sum(t1.suma) as suma, sum(t1.svat) as svat, sum(t1.coun) as coun
	from ($quall) as t1
	group by t1.year, t1.mont
	";
$mylist= $DB->select($query);
//====print "<br>----MYLIST----<br>";
//====print_rr($mylist);

# изчисления : 21=всички месеци 0=неизходени 22=всичко 
# паралелно линковете 
								$modeel= "mode=".$mode;
foreach($mylist as $year=>$e1){
	foreach($e1 as $mont=>$e2){
								$cuyemo= $year ."-".str_pad($mont,2,"0",STR_PAD_LEFT);
								$mylist[$year][$mont]["link"]= geturl($modeel."&yemo=".$cuyemo);
//====print "<br>[$year][$mont][$cuyemo]";
		foreach($e2 as $fiel=>$cont){
//print "<br>[$year][$mont][$fiel]";
			if ($mont==0){
				$mylist[$year][22][$fiel] += $cont;
			}else{
				$mylist[$year][21][$fiel] += $cont;
				$mylist[$year][22][$fiel] += $cont;
			}
		}
	}
}
//====print_rr($mylist);

# годините - само за които има данни 
unset($listyear[0]);
//print_rr($listyear);
$aryear= array_keys($listyear);
for ($i=count($aryear)-1; $i>=0; $i--){
	$cuye= $aryear[$i];
//print "<br>[$i][$cuye]";
	if (isset($mylist[$cuye])){
		break;
	}else{
		unset($listyear[$cuye]);
	}
}
$smarty->assign("LISTYEAR", $listyear);
//print_rr($listyear);

# извеждаме 
$smarty->assign("DATA", $mylist);
$pagecont= smdisp("finai2.tpl","fetch");

?>