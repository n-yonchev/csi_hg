<?php
									session_start();
									include_once "common.php";
$modeel= $_POST["modeel"];
$name= $_POST["name"];
$namesear= "%$name%";
/*
list($seri,$year)= explode("/",$seye);
if (strlen($year)==2){
	$year= "20" .$year;
}else{
}
$idcase= $DB->selectCell("select id from suit where serial=?d and year=?d"  ,$seri,$year);
	if ($idcase==0){
print "1/".toutf8("грешно дело");
	}else{
$palink= geturl($modeel."&filtcase=".$idcase);
print "0/".$palink;
	}
*/

//$coun= $DB->selectCell("select id from bill where name like ?"  ,$namesear);
$coun= $DB->selectCell("select id from bill where upper(name) like upper(?)"  ,$namesear);
	if ($coun==0){
print "1/".toutf8("няма фактури с такъв получател");
	}else{
$palink= geturl($modeel."&filtname=".$name);
print "0/".$palink;
	}


?>