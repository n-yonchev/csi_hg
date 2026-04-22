<?php

								include_once "commdb.php";
								include_once "common.php";
//print_rr($DB);
//print_rr($DB2);

# наблюдатели и дела 
//$mylist= todb2("viewer");
$mylist= todb2("viewersuit", "", "idcase");

$mylist = array_slice($mylist, 460, 10);
//var_dump($mylist);
# списък дела 
										#---- изчисляваме актуалния дълг ----
										include_once "cazobalafunc.php";
									$ardebt= array();
				$arid= array();
foreach($mylist as $elem){
	$currid= $elem["idcase"];

	if (in_array($currid,$arid)){
	}else{
				$arid[]= $currid;
										#---- изчисляваме актуалния дълг ----
										$edit= $currid;
//++++++++print "<br>--------$edit---------";
												$rocase= getrow("suit",$edit);
												$_SESSION["extraint"]= $rocase["extraint"];
										include "cazobalamain.php";
//print_rr($balist);
												$akey= array_keys($balist);
										$actudebt= $balist[end($akey)]["tosuma"];
										var_dump($actudebt);
									$ardebt[$currid]= $actudebt;
//++++++++print $actudebt ." ".$rocase["serial"]."/".$rocase["year"];
//++++++++print "<br>actudebt=[$currid][$actudebt]";
	}
}
//print_rr($arid);
//print_rr($ardebt);
				if (empty($arid)){
// 		$codein= "0";
// 				}else{
// 		$codein= implode(",",$arid);
// 				}

// # дела 
// //$mylist= todb2("suit","id in ($codein)");
										#---- записваме актуалния дълг ----
										//$mylist= $DB2->selectCol("select id from suit");
										//var_dump($mylist);
// //print "<br>mylist=";
// //print_rr($mylist);
// //print "<br>ardebt=";
// //print_rr($ardebt);
// 										foreach($mylist as $cuid){
// //var_dump($cuid);
// //print "<br>ardebt=[$cuid]=".$ardebt[$cuid];
// 											$DB2->query("update suit set actual_debt=? where id=?d"  ,$ardebt[$cuid]*100, $cuid);

//print $cuid.">".$ardebt[$cuid];
										}

/* MITKO:: Коментирам го защото ме интересува само актуалният дълг за момента 
# взискатели и длъжници 
$mylist= todb2("claimer","idcase in ($codein)");
$mylist= todb2("debtor","idcase in ($codein)");
# събития 
$mylist= todb2("suitevent","idcase in ($codein)");

# извърш.действия 
$mylist= $DB->select("
	select 
		jour.created, jour.descrip, jour.person, jour.idchar
		, joursuit.idcase as idcase
	from joursuit
	left join jour on joursuit.idjour=jour.id
	where joursuit.idcase in ($codein)
	");
$mylist= arstrip($mylist);
//print_rr($mylist);
//$lico= $DB2->query("show columns from jour");
//print_rr($lico);
$DB2->query("truncate table jour");
arr2tab($mylist,"jour");

# платени суми към взискатели 
$mylist= $DB->select("
	select * from finance
	where idcase in ($codein) and isclosed<>0
	");
$mylist= arstrip($mylist);
//print_rr($mylist);
				$DB2->query("truncate table finance");
$arfiel= array("idtype","descrip","inco","idcase","timeclosed","iddebtor","dateinco");
foreach($mylist as $elem){
		$aset= array();
	foreach($arfiel as $finame){
		$aset[$finame]= $elem[$finame];
	}
	$artoclai= unsetoclai($elem["toclai"]);
	foreach($artoclai as $idclai=>$suclai){
		if ($suclai+0 ==0){
		}else{
			$aset["claimer_id"]= $idclai;
			$aset["claimer_payment"]= $suclai;
				$DB2->query("insert into finance set ?a"  ,$aset);
		}
	}
}

MITKO:: **/
print "OK";

?>
