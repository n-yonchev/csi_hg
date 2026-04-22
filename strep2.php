<?php
# 10.10.2011 - специфичен директен отчет 
# преведени и непреведени суми за взискател - общо за всички постъпления 
# - по деловодители и дела 

ini_set("memory_limit","128M");
								include_once "common.php";
/*
								print <<<EOH
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style='height:100%'>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<body>
<style>
td {font: normal 8pt verdana; padding: 2px 6px 2px 6px;}
.head {font: normal 8pt verdana; background: #dddddd;}
.suma {font: bold 8pt verdana; background: #dddddd;}
.money {font: normal 8pt verdana; background: lavender;}
.erty {font: bold 8pt verdana; background: red}
</style>
EOH;
*/
								$repocont= "";
								$repocont .= "
<style>
td {font: normal 8pt verdana; padding: 2px 6px 2px 6px;}
.head {font: normal 8pt verdana; background: #dddddd;}
.suma {font: bold 8pt verdana; background: #dddddd;}
.money {font: normal 8pt verdana; background: lavender;}
.erty {font: bold 8pt verdana; background: red}
</style>
								";
								
$ceik= $_POST["ceik"];
	$ceik= trim($ceik);
//$year= $_POST["year"];
//	$year= trim($year);
//$mont= $_POST["mont"];
//	$mont= trim($mont);

//if (empty($ceik) or empty($year) or empty($mont)){
if (empty($ceik)){
								$e1= <<<E1
						<form method=post>
								<table>
								<tr>
						<td> описание
						<td> преведени и непреведени суми за взискател  
							<br> участват всички постъпления, които са по делата на взискателя
								<tr>
						<td> ЕИК на взискателя
						<td> <input type=text name=ceik>
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
/*
# година-месец за датата на приключване 
if (strlen($mont)==1){
	$mont= "0".$mont;
}else{
}
$yemo= "$year-$mont";
*/
								$repocont .= "<form method=post><table>";
								$repocont .= toutf8("<tr><td colspan=7> 
								<h4>взискател $clainame ЕИК=$ceik <br>преведени и непреведени суми общо </h4>
								");
//						<input type=hidden name=ceik value='$ceik'>
//						<input type=submit name=toex value='excel'>
/*
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
*/
$mylist= $DB->select("
	select finance.*, finance.idtype as finatype, substring(finance.timeclosed,1,10) as timeclos
		, suit.serial as caseseri, suit.year as caseyear
		, user.name as username, claimer.id as idclaimer
		, user.id as ARRAY_KEY1, suit.id as ARRAY_KEY2, finance.id as ARRAY_KEY3
	from finance
	left join suit on finance.idcase=suit.id
	left join claimer on claimer.idcase=suit.id
		left join user on suit.iduser=user.id
	where claimer.bulstat=? 
	order by user.name, suit.year, suit.serial
	"  ,$ceik);
//$mylist= dbconv($mylist);

/*						
						$step= 20;
						$coun= $step -1;
*/
//				$suma1= 0;
//				$suma2= 0;

				$artota= array();
foreach($mylist as $iduser=>$ar1){
								$pout= "";
				$aruser= array();
foreach($ar1 as $idcase=>$ar2){
								$casout= "";
				$arcase= array();
foreach($ar2 as $idfina=>$elem){
/*
						$coun ++;
						if ($coun % $step ==0){
								prinhead();	
						}else{
						}
*/
	$arclam= unsetoclai($elem["toclai"]);
	$toclai= $arclam[$ft=$elem["idclaimer"]];
		$arfina= array();
		$arfina["inco"]= $elem["inco"];
		$arfina["rest"]= $elem["rest"];
		$arfina["dist"]= $elem["inco"] - $elem["rest"];
		$arfina["tosu"]= $toclai;
		$arfina["tono"]= ($elem["isclosed"]==0) ? $toclai :0;
		$arfina["toye"]= ($elem["isclosed"]==0) ? 0 : $toclai;
				$arcase= arplus($arcase,$arfina);
								$casout .= "<tr>";
								$casout .= "<td>".$elem["caseseri"]."/".$elem["caseyear"]."<td>".$elem["username"];
								$casout .= outmoney($arfina["inco"] ,"постъпила");
								$casout .= "<td>".$elem["dateinco"]."<td>".$listfinatype2_utf8[$ft=$elem["finatype"]];
								$casout .= outmoney($arfina["rest"] ,"неразпределена");
								$casout .= outmoney($arfina["dist"] ,"разпределена общо");
								$casout .= outmoney($arfina["tosu"] ,"разпределена за взискателя");
								$casout .= outmoney($arfina["tono"] ,"втч непреведена");
								$casout .= outmoney($arfina["toye"] ,"втч преведена");
								$casout .= "<td>".$elem["timeclos"];
//				$suma1 += $elem["inco"];
//				$suma2 += $toclai;
}
				$aruser= arplus($aruser,$arcase);
								$pout .= "<tr>";
								$pout .= "<td class='head'><b>".$elem["caseseri"]."/".$elem["caseyear"]."</b>";
//								$pout .= "<td class='head'>".$elem["username"];
								$pout .= toutf8("<td class='head'><b>общо за делото</b>");
								$pout .= outmoney($arcase["inco"] ,"постъпила","head");
								$pout .= "<td class='head'>"."<td class='head'>";
								$pout .= outmoney($arcase["rest"] ,"неразпределена","head");
								$pout .= outmoney($arcase["dist"] ,"разпределена общо","head");
								$pout .= outmoney($arcase["tosu"] ,"разпределена за взискателя","head");
								$pout .= outmoney($arcase["tono"] ,"втч непреведена","head");
								$pout .= outmoney($arcase["toye"] ,"втч преведена","head");
							$pout .= $casout;
}
				$artota= arplus($artota,$aruser);
							prinhead();	
								$repocont .= "<tr>";
								$repocont .= "<td class='head'>".toutf8("<b>общо за</b>") ."<td class='head'><b>".$elem["username"]."</b>";
								$repocont .= outmoney($aruser["inco"] ,"постъпила","head");
								$repocont .= "<td class='head'>"."<td class='head'>";
								$repocont .= outmoney($aruser["rest"] ,"неразпределена","head");
								$repocont .= outmoney($aruser["dist"] ,"разпределена общо","head");
								$repocont .= outmoney($aruser["tosu"] ,"разпределена за взискателя","head");
								$repocont .= outmoney($aruser["tono"] ,"втч непреведена","head");
								$repocont .= outmoney($aruser["toye"] ,"втч преведена","head");
								$repocont .= $pout;
}

/*
$s1= number_format($suma1,2,".",",");
$s2= number_format($suma2,2,".",",");
								print "<tr><td colspan=2 class='suma'>".toutf8("ОБЩО");
								print "<td class='suma'> $s1 <td colspan=2 class='suma'> &nbsp; <td class='suma'> $s2";
								print "<td class='suma'> &nbsp;";
*/
							prinhead();	
								$repocont .= "<tr><td colspan=2 class='suma'>".toutf8("ОБЩО");
/*
								$repocont .= "<td class='suma'> $s1 <td colspan=2 class='suma'> &nbsp; <td class='suma'> $s2";
								$repocont .= "<td class='suma'> &nbsp;";
*/
								$repocont .= outmoney($artota["inco"] ,"","suma");
								$repocont .= "<td colspan=2 class='suma'>";
								$repocont .= outmoney($artota["rest"] ,"","suma");
								$repocont .= outmoney($artota["dist"] ,"","suma");
								$repocont .= outmoney($artota["tosu"] ,"","suma");
								$repocont .= outmoney($artota["tono"] ,"","suma");
								$repocont .= outmoney($artota["toye"] ,"","suma");

								$repocont .= "</table></form>";
								$repocont= tran1251($repocont);



function prinhead(){
global $repocont;
								$repocont .= "<tr>";
								$repocont .= toutf8("<td class='head'>дело <td class='head'>деловодител <td class='head'>постъпила 
								<td class='head'>дата <td class='head'>тип 
								<td class='head'>неразпределена <td class='head'>разпределена <br>общо 
								<td class='head'>разпределена <br>за взискателя
								<td class='head'>втч <br>непреведена <td class='head'>втч <br>преведена <td class='head'>дата <br>превод
								");
}

function outmoney($p1,$p2,$p3=""){
	$p2= toutf8($p2);
return "<td class='$p3' align=right title='$p2'>" .(($p1+0==0) ? "-" : number_format($p1,2,".",","));
}

function arplus($ar1,$ar2){
//print "<br>----ARPLUS---<br>";
//print_rr($ar1);
//print_rr($ar2);
	foreach($ar2 as $ind2=>$con2){
		$ar1[$ind2] += $con2;
	}
//print_rr($ar1);
return $ar1;
}


?>