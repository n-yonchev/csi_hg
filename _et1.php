<?php
						include_once "common.php";

$DB->query("truncate table etlist");

$aretclai= getet("claimer");
//print_rr($aretclai);
$aretdebt= getet("debtor");
//print_rr($aretdebt);

$arcase= $DB->selectCol("
	select id as ARRAY_KEY, concat(serial,'/',year)
	from suit
	");

printet($aretclai,"CLAIMER");
printet($aretdebt,"DEBTOR");


function getet($tabl){
global $DB;
	$ardata= $DB->select("
		select idcase as ARRAY_KEY1, id as ARRAY_KEY2, exdata, name
		from $tabl 
		where idtype=2 
		order by idcase,id
		");
//print_rr($ardata);
					$arresu= array();
	foreach($ardata as $idcase=>$x2){
		foreach($x2 as $id=>$elem){
			$arex= unserialize($elem["exdata"]);
			if ($arex["t2et"]==1){
					$arresu[$idcase][]= $id;
/*
# корекция на флага etcode=1 
$DB->query("update $tabl set etcode=1 where id=?d"  ,$id);
# дублиране на записа като юрид.лице с флаг etcode=2 
$rotabl= $DB->selectRow("select * from $tabl where id=?d"  ,$id);
	unset($rotabl["id"]);
	$rotabl["idtype"]= 1;
	$rotabl["egn"]= "";
	$rotabl["bulstat"]= "";
	$rotabl["etcode"]= 2;
		$ardata= array();
		$ardata["t1type"]= 2;
		$ardata["t1stat"]= 0;
		$ardata["t1fo"]= 0;
	$rotabl["exdata"]= serialize($ardata);
$DB->query("insert into $tabl set ?a"  ,$rotabl);
*/
	$ardata= array();
	$ardata["idcase"]= $idcase;
	$ardata["tabl"]= $tabl;
	$ardata["idmemb"]= $id;
	$ardata["name"]= stripslashes($elem["name"]);
$DB->query("insert into etlist set ?a"  ,$ardata);
			}else{
			}
		}
	}
return $arresu;
}

function printet($arda,$text){
global $arcase;
						print "<br><br>$text<br>";
	foreach($arda as $idcase=>$x2){
						print "<br>[$idcase] ";
						print $arcase[$idcase];
		foreach($x2 as $id){
						print " ".$id;
		}
	}
}

?>