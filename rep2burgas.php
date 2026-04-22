<?php
							include "common.php";

print <<<EOH
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title> report-2 </title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style>
td {font: normal 8pt verdana}
</style>
<body>
EOH;

$mylist= $DB->select("select id, serial, year, claimdescrip from suit order by year, serial");
//print_rr($mylist);
//$mylist= dbconv($mylist);
				
					print "<table align=center>";
$stlist= "0123456789";
foreach($mylist as $elem){
					print "<tr>";
					print "<td>".$elem["serial"]."/".$elem["year"];
					print "<td>"."[".$elem["id"]."]";
	$desc= $elem["claimdescrip"];
	$desc= str_replace(" ","",$desc);
//	$descfl= $desc +0;
			$descfl= "0";
	for ($i=0; $i<=strlen($desc)-1; $i++){
		$curr= substr($desc,$i,1);
		if (strpos($stlist,$curr)===false){
		}else{
			$descfl= substr($desc,$i) +0;
			break;
		}
	}
	$descfl= number_format($descfl,2,".",",");
					print "<td align=right><font color=red>".$descfl."</font>";
					print "<td>".$elem["claimdescrip"];
}
					print "</table>
					</body>
					</html>
					";

?>
