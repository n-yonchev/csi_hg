<?php
//# проверваме коректността на датата за предмети с тип 1=олихвяема и 3=месечна 

									include_once "common.php";

$query= "
SELECT subject.*
	, suit.serial, suit.year, user.name
FROM `subject`
	left join suit on subject.idcase=suit.id
	left join user on suit.iduser=user.id
order by user.name, suit.id
";
//order by subject.fromdate 
//WHERE subject.idtype =1
						print '
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style>
td {font: normal 8pt verdana}
</style>
<head>
<body>
						';
$mylist= $DB->select($query);
						print "<table>";
												$arlist= array();
foreach($mylist as $elem){
	$idtype= $elem["idtype"];
	$fromdate= $elem["fromdate"];
//	if ($idtype==1 or $idtype==3){
		$date2= str_replace(" ","s",$fromdate);
		if ($fromdate==$date2){
			list($ye,$mo,$da)= explode("-",$fromdate);
			if (checkdate($mo+0,$da+0,$ye+0)){
//						print "<td>"."OK";
			}else{
												$arlist[]= $elem["id"];
						outrec($elem);
						print "<td>"."<font color=red>".$fromdate."</font>";
			}
		}else{
												$arlist[]= $elem["id"];
						outrec($elem);
						print "<td>"."<font color=blue>".$date2."</font>";
		}
//	}else{
//	}
}
						print "</table>";
												$stlist= implode(",",$arlist);
												file_put_contents("_subjdate.txt",$stlist);


function outrec($elem){
global $listsubjtype_utf8;
//print_r($listsubjtype_utf8);
						print "<tr>";
						print "<td>".$elem["serial"]."/".$elem["year"];
						print "<td>".$elem["name"];
						print "<td>".$elem["amount"];
//						print "<td>".$elem["idtype"];
						print "<td>".$listsubjtype_utf8[$idtype=$elem["idtype"]];
						print "<td>".$elem["text"];
						print "<td>".$elem["id"];
						print "<td>".$elem["idcase"];
						print "<td>".$elem["fromdate"];
}

?>
