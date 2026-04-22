<?php

$iplist["95.87.215.58/csi/"]="Бъзински";
$iplist["95.169.193.190"]=	"[Бургас] Ивелина Божилова";
//$iplist["83.228.21.208"]=	"[Бл.град] Виолина Тозева";
$iplist["83.228.22.211"]=	"[Петрич] Шукри Дервиш";
$iplist["93.152.151.175"]=	"[София] Виолета Матова";
$iplist["87.126.233.245"]=	"[Бл.град] Милица Велева";
$iplist["212.36.3.242"]=	"[София] Георги Дичев";

				print iconv("windows-1251","UTF-8",  '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title> Всички ЧСИ </title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style>
li {font: normal 10pt verdana; padding: 6px;}
a {font: normal 10pt verdana;}
</style>
				');

									include_once "common.php";
print "<h3>".toutf8("ДУПКИ В ИЗХ.РЕГИСТЪР")."</h3>";


//				print "<ul>";
foreach($iplist as $cuip=>$cutext){
//				print iconv("windows-1251","UTF-8",  "<li><a target='_blank' href='http://$cuip'>$cutext</a></li>");
				print iconv("windows-1251","UTF-8",  "<br><a target='_blank' href='http://$cuip/_docuout.php?foryear=2010'>$cutext</a><br>");
}
//				print "</ul>";

?>
