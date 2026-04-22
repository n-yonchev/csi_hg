<?php
# нарушена поредност на номерата в изх.регистър 
# източник : oure.php 

$foryear= $_GET["foryear"];
if (isset($foryear)){
	$filtyear= "docuout.year=$foryear";
}else{
	die("missing para foryear");
}

									include_once "common.php";

$rooffi= getofficerow($iduser);
$exname= $rooffi["shortname"];
$exname= toutf8($exname);

		print '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>'  .$exname .'
</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body style="font: normal 8pt verdana">
<style>
td {font: normal 8pt verdana; border-bottom: 1px solid black;}
</style>
		';
print "<h3>$exname</h3>";

/*
$q1= "
	select docuout.* ,docuout.id as id, date_format(registered,'%d.%m.%Y %H:%i:%s') as registered
		,suit.serial as caseseri ,suit.year as caseyear
		,docutype.text as descriptype
	from docuout
		left join suit on docuout.idcase=suit.id
		left join docutype on docuout.iddocutype=docutype.id
	where docuout.serial<>0 and docuout.year<>0 
and $filtyear
	order by docuout.serial
limit 1200
	";
*/
$q1= "
	select docuout.id as id, docuout.serial, docuout.year, docuout.isentered
		, date_format(docuout.created,'%d.%m.%Y %H:%i:%s') as created
		, date_format(docuout.registered,'%d.%m.%Y %H:%i:%s') as registered
		,suit.serial as caseseri ,suit.year as caseyear
	from docuout
		left join suit on docuout.idcase=suit.id
	where docuout.serial<>0 and docuout.year<>0 
and $filtyear
	order by docuout.serial desc
limit 2000
	";
$mylist= $DB->select($q1);
//$mylist= dbconv($mylist);
					//$cuyear= 0;
					//$cuseri= 0;
					$cuyear= $mylist[0]["year"];
					$cuseri= $mylist[0]["serial"] +1;
								print "<table>";
foreach($mylist as $elem){
	$seri= $elem["serial"];
	$year= $elem["year"];
	$crea= $elem["created"];
	$regi= $elem["registered"];
					//$cuseri ++;
					$cuseri --;
					if ($cuyear==$year and $cuseri==$seri){
								print "<tr>";
					}else{
								print "<tr bgcolor=gold>";
						$cuyear= $year;
						$cuseri= $seri;
					}
								print "<td>"."[".$elem["id"]."]";
								print "<td>".$seri."/".$year;
/*
								print "<td>";
					if (empty($regi)){
								print "<font color=red>emptyreg</font>";
					}else{
//								print date("d.m.Y H:i:s",$regi);
								print $regi;
					}
*/
								print "<td>&nbsp;".$crea."&nbsp;";
								print "<td>&nbsp;".$regi."&nbsp;";
//print "<td>";
//print "+++".$elem["registered"]."+++";
								print "<td>".$elem["caseseri"]."/".$elem["caseyear"];
								print "<td>".($elem["isentered"]==1 ? "man" : "");
}
								print "</table>";

?>
