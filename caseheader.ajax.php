<?php
# извежда за текущото дело : номера, годината, деловодителя 
# вика се чрез jQuery.load в <div id=caseheader> с НЕКРИПТИРАН параметър - виж cazo1view.tpl 
									
									session_start();
									include_once "common.php";

$para= $_GET["para"];
//print $para;
$para= $para - 10597;

$rocase= getrow("suit",$para);
	$caseri= $rocase["serial"];
	$cayear= $rocase["year"];
$rouser= getrow("user",$rocase["iduser"]);
	$causer= $rouser["name"];
	$causer= empty($causer) ? "няма" : $causer;

print toutf8("дело <b>$caseri/$cayear</b> деловодител <b>$causer</b>");

?>
