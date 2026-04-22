<?php
# 16.11.2023 - висящи дела на физически лица по ЕГН
/*
								include_once "common.php";

								print <<<EOH
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style='height:100%'>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<body>
<style>
td {font: normal 10pt verdana;}
.head {font: bold 8pt verdana; background: #dddddd}
.erty {font: bold 8pt verdana; background: red}
</style>
EOH;
*/
								$repocont= "";
								
								$repocont .= "
<style>
td {font: normal 10pt verdana;}
.head {font: bold 8pt verdana; background: #dddddd}
.erty {font: bold 8pt verdana; background: red}
</style>
								";

$miny= $_POST["miny"];
	$miny= trim($miny);
$maxy= $_POST["maxy"];
	$maxy= trim($maxy);

if (empty($miny) and empty($maxy)){
								$e1= <<<E1
								<form method=post>
								<table>
								<tr>
						<td> описание
						<td> висящи дела на физически лица по ЕГН
								<tr>
						<td> от година
						<td> <select name=miny>
E1;
								$repocont .= toutf8($e1);
							for($y = 1900; $y <= ((int)date("Y")) - 17; $y++) {
								$repocont .= '<option value="' . $y . '">' . $y . '</option>';
							}
							$e2 = <<<E2
							</select>
							<tr>
							<td> до година
							<td> <select name=maxy >
E2;
							$repocont .= toutf8($e2);
							for($y = ((int)date("Y") - 17); $y >= 1901; $y--) {
								$repocont .= '<option value="' . $y . '">' . $y . '</option>';
							}
							$e3 = <<<E3
									<tr>
							<td> 
							<td> <input type=submit name=submit value=въведи>
									</table>
							</form>
E3;
							$repocont .= toutf8($e3);
								$repocont= tran1251($repocont);
return;
}else{
}


if($miny < 2000 and $maxy < 2000) {
	$cond = "AND CAST(LEFT(TRIM(d.egn), 2) as UNSIGNED) >= ? 
	AND CAST(LEFT(TRIM(d.egn), 2) as UNSIGNED) <= ?
	AND SUBSTRING(TRIM(d.egn), 3, 2) <= 12";
} 
elseif($miny >= 2000 and $maxy >= 2000) {
	$cond = "AND CAST(LEFT(TRIM(d.egn), 2) as UNSIGNED) >= ? 
	AND CAST(LEFT(TRIM(d.egn), 2) as UNSIGNED) <= ?
	AND CAST(SUBSTRING(TRIM(d.egn), 3, 2) as UNSIGNED) >= 41";
} 
elseif($miny < 2000 and $maxy > 2000) {
	$cond = "AND ((
		CAST(LEFT(TRIM(d.egn), 2) as UNSIGNED) >= ? 
	AND CAST(LEFT(TRIM(d.egn), 2) as UNSIGNED) <= 99
	AND SUBSTRING(d.egn, 3, 2) <= 12
	) OR (
		CAST(LEFT(TRIM(d.egn), 2) as UNSIGNED) >= 0 
		AND CAST(LEFT(TRIM(d.egn), 2) as UNSIGNED) <= ?
		AND CAST(SUBSTRING(TRIM(d.egn), 3, 2) as UNSIGNED) >= 41
	))";
}
$miny = $miny % 100;
$maxy = $maxy % 100;

//print "para=[$ceik][$year][$mont]";

								$repocont .=  "<form method=post><table>";
//						<input type=hidden name=ceik value='$ceik'>
//						<input type=hidden name=year value='$year'>
//						<input type=hidden name=mont value='$mont'>
//						<input type=submit name=toex value='excel'>
$mylist= $DB->select("
	SELECT s.serial, s.year, d.egn
	FROM suit s
	LEFT JOIN debtor d ON d.idcase = s.id
	WHERE s.idstat =24
	AND d.idtype =2
	". $cond ."
	ORDER BY
		SUBSTRING(TRIM(d.egn), 3, 2) > 12,
		LEFT(TRIM(d.egn), 2),
		SUBSTRING(TRIM(d.egn), 3, 2),
		SUBSTRING(TRIM(d.egn), 5, 2)
", $miny, $maxy);		

$repocont .=  "<tr class='head'>";
$repocont .=  toutf8("<td>дело <td>година <td>егн
");

foreach($mylist as $elem){
								$repocont .=  "<tr>";
								$repocont .=  "<td>".$elem["serial"]."<td>".$elem["year"]."<td>".$elem["egn"];
}

								$repocont .=  "</table></form>";
								$repocont= tran1251($repocont);

?>