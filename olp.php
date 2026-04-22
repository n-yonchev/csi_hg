<?php

$infile= "OLP.TXT";
$delimi= "\t";
/*
			mysql_connect("localhost","root","") or die("not-connected");
			mysql_select_db("exof") or die("not-db");
$arcont= file($infile);
						print "<table border=1>";
*/
			mysql_query("truncate table percent");
$arcont= file($infile);
foreach($arcont as $cind=>$crow){
			$crow= trim($crow);
	$arcu= explode($delimi,$crow);
//						print "<tr>";
	foreach($arcu as $fiel){
//						print "<td> $fiel";
	}
				if ($cind==0){
				}else{
			$begin= $arcu[0];
								list($da,$mo,$ye)= explode(".",$begin);
								$begstamp= mktime(0,0,0,  $mo,$da,$ye);
			$end= $arcu[1];
								list($da,$mo,$ye)= explode(".",$end);
								$endstamp= mktime(0,0,0,  $mo,$da,$ye);
			$bnb= $arcu[2];
			$bnb= str_replace(",",".",$bnb);
			$_daily= $arcu[3];
			$_daily= str_replace(",",".",$_daily);
			mysql_query("insert into percent set begin='$begin', end='$end', bnb='$bnb', begstamp='$begstamp', endstamp='$endstamp', _daily='$_daily'");
				}
}
//						print "</table>";

?>