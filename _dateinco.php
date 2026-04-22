<?php

				include "common.php";

$mylist= $DB->selectCol("
	select finance.id as ARRAY_KEY, finasource.date as date
	from finance
	left join finasource on finasource.idfinance=finance.id
	where finasource.id is not null and finance.dateinco=''
	");
//print_rr($mylist);
				print '
<body style="font: normal 8pt verdana">
				';
foreach($mylist as $idfina=>$date){
			if (strpos($date,"/")===false){
	list($da,$mo,$ye)= explode(".",$date);
			}else{
	list($da,$mo,$ye)= explode("/",$date);
			}
	$da= str_pad($da,2,"0",STR_PAD_LEFT);
	$mo= str_pad($mo,2,"0",STR_PAD_LEFT);
	$dateinco= "$ye-$mo-$da";
print "<br>[$idfina][$date][$dateinco]";
$DB->query("update finance set dateinco='$dateinco' where id=$idfina");
}

print "<br><br>";
print "OK ".count($mylist)." finance rows";

?>
