<?php

$v1= $_GET["v1"];
$v2= $_GET["v2"];
$v3= $_GET["v3"];
	$myv1= str_replace(",","",$v1);
	$myv2= str_replace(",","",$v2);
	$myv3= str_replace(",","",$v3);
$suma= (float)$myv1 + (float)$myv2;
$osta= $suma - (float)$myv3;

$mysuma= number_format($suma,2,".",",");
$myosta= number_format($osta,2,".",",");
print $mysuma."^".$myosta;

?>
