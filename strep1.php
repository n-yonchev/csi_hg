<?php
# 09.10.2011 - специфичен директен отчет 
# суми, преведени на взискател през месец 

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

$ceik= $_POST["ceik"];
	$ceik= trim($ceik);
$year= $_POST["year"];
	$year= trim($year);
$mont= $_POST["mont"];
	$mont= trim($mont);

if (empty($ceik) or empty($year) or empty($mont)){
								$e1= <<<E1
						<form method=post>
								<table>
								<tr>
						<td> описание
						<td> суми, преведени на взискател през месец 
							<br> участват само постъпления, които са по делата на взискателя и са приключени през месеца
								<tr>
						<td> ЕИК на взискателя
						<td> <input type=text name=ceik>
								<tr>
						<td> година
						<td> <input type=text name=year>
								<tr>
						<td> месец
						<td> <input type=text name=mont>
								<tr>
						<td> 
						<td> <input type=submit name=submit value=въведи>
								</table>
						</form>
E1;
								$repocont .= toutf8($e1);
								$repocont= tran1251($repocont);
return;
}else{
}


//print "para=[$ceik][$year][$mont]";
# име на взискателя 
$clainame= $DB->selectCell("select name from claimer where bulstat=? limit 1"  ,$ceik);
$clainame= tran1251(stripslashes($clainame));
# година-месец за датата на приключване 
if (strlen($mont)==1){
	$mont= "0".$mont;
}else{
}
$yemo= "$year-$mont";
								$repocont .=  "<form method=post><table>";
								$repocont .=  toutf8("<tr><td colspan=7> 
								<h4>взискател $clainame ЕИК=$ceik <br>преведени суми през месец $yemo </h4>
								");
//						<input type=hidden name=ceik value='$ceik'>
//						<input type=hidden name=year value='$year'>
//						<input type=hidden name=mont value='$mont'>
//						<input type=submit name=toex value='excel'>
$mylist= $DB->select("
	select finance.*, finance.idtype as finatype, substring(finance.timeclosed,1,10) as timeclos
		, suit.serial as caseseri, suit.year as caseyear
		, user.name as username, claimer.id as idclaimer
	from finance
	left join suit on finance.idcase=suit.id
	left join claimer on claimer.idcase=suit.id
		left join user on suit.iduser=user.id
	where claimer.bulstat=? 
	and finance.isclosed<>0 and substring(finance.timeclosed,1,7)=?
	order by suit.year, suit.serial
	"  ,$ceik,$yemo);
//$mylist= dbconv($mylist);
						
						$step= 20;
						$coun= $step -1;
				$suma1= 0;
				$suma2= 0;

foreach($mylist as $elem){
						$coun ++;
						if ($coun % $step ==0){
								$repocont .=  "<tr class='head'>";
								$repocont .=  toutf8("<td>дело <td>деловодител <td>постъпила <td>дата <td>тип <td>преведена <td>дата
								");
						}else{
						}
								$repocont .=  "<tr>";
								$repocont .=  "<td>".$elem["caseseri"]."/".$elem["caseyear"]."<td>".$elem["username"];
								$repocont .=  "<td>".$elem["inco"]."<td>".$elem["dateinco"]."<td>".$listfinatype2_utf8[$ft=$elem["finatype"]];
	$arclam= unsetoclai($elem["toclai"]);
	$toclai= $arclam[$ft=$elem["idclaimer"]];
								$repocont .=  "<td>".$toclai."<td>".$elem["timeclos"];
				$suma1 += $elem["inco"];
				$suma2 += $toclai;
}

$s1= number_format($suma1,2,".",",");
$s2= number_format($suma2,2,".",",");
								$repocont .=  "<tr><td colspan=2 class='head'>".toutf8("ОБЩО");
								$repocont .=  "<td class='head'> $s1 <td colspan=2 class='head'> &nbsp; <td class='head'> $s2";
								$repocont .=  "<td class='head'> &nbsp;";

								$repocont .=  "</table></form>";
								$repocont= tran1251($repocont);

?>