<?php
				include "common.php";

/*
//$DB->query("update finance set datebala=concate('20',datebala) where datebala<>'' and length(datebala)<10");
$mydata= $DB->select("select id, datebala from finance where datebala<>'' and length(datebala)<10");
				$coun= 0;
foreach($mydata as $mycont){
	$myid= $mycont["id"];
	$mydate= $mycont["datebala"];
				$coun ++;
				print "<br>[$coun] $myid $mydate";
//	$DB->query("update finance set datebala=concat('20',datebala) where id=$myid");
}
*/

$mylist= $DB->selectCol("select id from finance where datebala<>'' and length(datebala)<10 order by id");
$listin= implode(",",$mylist);
$DB->query("update finance set datebala=concat('20',datebala) where id in ($listin)");

$mylist= $DB->select("select id,datebala from finance where id in ($listin)");
				$coun= 0;
foreach($mylist as $elem){
	$id= $elem["id"];
	$da= $elem["datebala"];
				$coun ++;
				print "<br>$coun [$id] [$da]";
}

?>