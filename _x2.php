<?php

				include "common.php";

$data= $DB->select("select id,year,serial from suit order by year, serial");

$myse= 0;
$myye= 0;
foreach($data as $elem){
	$cuid= $elem["id"];
	$cuse= $elem["serial"];
	$cuye= $elem["year"];
	if ($myse==$cuse and $cuye==$myye){
print "<br><br>$cuid $cuse/$cuye<br><br>";
	}else{
		$myse= $cuse;
		$myye= $cuye;
print "$cuid "; 
	}
}

print "<br><br>END";

?>