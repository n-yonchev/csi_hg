<?php
									session_start();
									include_once "common.php";
$modeel= $_POST["modeel"];
$seye= $_POST["seye"];
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

/*
	$resudate= validator_bgdate_valid($d1,"");
	if ($resudate===true){
$dat1= bgdateto($d1);
	}else{
print "1/".toutf8("грешна дата1");
exit;
	}

if (empty($d2)){
				$padate= $dat1;
}else{
	$resudate= validator_bgdate_valid($d2,"");
	if ($resudate===true){
$dat2= bgdateto($d2);
		if ($dat1<=$dat2){
		}else{
print "1/".toutf8("грешен период");
exit;
		}
	}else{
print "1/".toutf8("грешна дата2");
exit;
	}
				$padate= "$dat1^$dat2";
}
*/

//$para= "0/".$dat1."^".$dat2;
//print $para;

/*
$palink= geturl($modeel."&date=".$padate);
print "0/".$palink;
*/

?>