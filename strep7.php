<?php
# 11.04.2012 - специфичен директен отчет 
# само преведени суми от постъпления - към взискател, евент.с представител, за период 
# - по деловодители и дела 

ini_set("memory_limit","128M");
								include_once "common.php";

								$repocont= "";
								$repocont .= '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="height:100%">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script type="text/javascript" src="js/jquery-1.2.6.pack.js"></script>
<script type="text/javascript" src="autocomp/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="autocomp/jquery.autocomplete.css" />
<style>
td {font: normal 8pt verdana; padding: 2px 6px 2px 6px;}
.head {font: normal 8pt verdana; background: #dddddd;}
.he2 {font: normal 7pt verdana; background-color: burlywood;}
.suma {font: bold 8pt verdana; background: #dddddd;}
.money {font: normal 8pt verdana; background: lavender;}
.erty {font: bold 8pt verdana; background: red}
</style>
<script type="text/javascript">
$(document).ready(function(){
$("#cage").autocomplete("agclaiauto.ajax.php",{matchSubset:false,max:30});
});
</script>
</head>
<body>
								';
//print_rr($_POST);
$ceik= $_POST["ceik"];
	$ceik= trim($ceik);
$cage= $_POST["cage"];
	$cage= trim($cage);
$cdat= $_POST["cdat"];
	$cdat= trim($cdat);

//if (empty($ceik) or empty($year) or empty($mont)){
if (empty($ceik) and empty($cage) and empty($cdat)){
								$e1= <<<E1
						<form method=post>
								<table>
								<tr>
						<td> описание
						<td> преведени суми за взискател през период
							<br> участват постъпленията, които са по дела на взискателя
								<tr>
						<td> ЕИК на взискателя
						<td> <input type=text name=ceik>
								<tr>
						<td> представител на взискателя
						<td> <input type=text name=cage id="cage" size=80>
								<tr>
						<td> дата на превода от-до <br> (само преведените в периода)
						<td> <input type=text name=cdat id="cdat" size=30>
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
//print_rr($_POST);
		$arhead= array();
//		$arfilt= array();
if (empty($ceik)){
		$ceikfilt= "1";
		$arhead[]= "всички дела независимо от взискателя";
}else{
	# име на взискателя 
	$clainame= $DB->selectCell("select name from claimer where bulstat=? limit 1"  ,$ceik);
	$clainame= tran1251(stripslashes($clainame));
		$arhead[]= "взискател $clainame ЕИК=$ceik";
//		$arfilt[]= "claimer.bulstat='$ceik'";
		$ceikfilt= "claimer.bulstat='$ceik'";
}
if (empty($cage)){
		$cagefilt= "1";
}else{
	# име на представителя 
		$arhead[]= "представител на взискателя ".tran1251($cage);
//		$arfilt[]= "claimer.agent='$cage'";
		$cagefilt= "claimer.agent=?";
}
if (empty($cdat)){
		$cdatfilt= "1";
		$arhead[]= "всички преведени суми независимо от периода на превода";
}else{
	# прериод на превода - 1 или 2 дати 
	list($d1,$d2)= explode("-",$cdat);
	$dat1= bgdateto($d1);
	$vidat1= bgdatefrom($dat1);
	if (empty($d2)){
		$arhead[]= "само сумите преведени на взискателя на $vidat1";
		$cdatfilt= "finance.isclosed=1 and date(finance.timeclosed)='$dat1'";
	}else{
		$dat2= bgdateto($d2);
		$vidat2= bgdatefrom($dat2);
//print "dat2=[$dat2][$vidat2]";
		$arhead[]= "само сумите преведени на взискателя в периода $vidat1 - $vidat2";
		$cdatfilt= "finance.isclosed=1 and date(finance.timeclosed)>='$dat1' and date(finance.timeclosed)<='$dat2'";
	}
}

		//$arhead[]= "преведени и непреведени суми";
$txhead= implode("<br>",$arhead);
//$codefilt= implode(" and ",$arfilt);
//var_dump($codefilt);

//								$repocont .= "<form method=post><table>";
								$repocont .= "<table>";
								$repocont .= toutf8("<tr><td colspan=7> <h4>$txhead</h4>");

$userlist= $DB->selectCol("select id as ARRAY_KEY,name from user order by name");
# важно за Дичев 
$userlist= array(0=>"") + $userlist;

					$agreal= $cage;
//					$agreal= mysql_real_escape_string($agreal);
//					$agreal= mysql_real_escape_string($agreal);
//					$agreal= mysql_real_escape_string($agreal);
	$query= "
		select finance.toclai, finance.inco, finance.rest, finance.isclosed, finance.dateinco
			, finance.idtype as finatype, substring(finance.timeclosed,1,10) as timeclos
			, suit.serial as caseseri, suit.year as caseyear
			, claimer.id as idclaimer, claimer.agent as agent
			, finance.idcase as ARRAY_KEY1, finance.id as ARRAY_KEY2
		from finance
		left join suit on finance.idcase=suit.id
		left join claimer on claimer.idcase=suit.id
		where $ceikfilt and $cagefilt and $cdatfilt and suit.iduser=?d
		order by suit.year, suit.serial
		";
							prinhead();	
foreach($userlist as $iduser=>$username){
								$pout= "";
				$aruser= array();
if (empty($cage)){
	$mylist= $DB->select($query  ,$iduser);
}else{
//var_dump($agreal);
//var_dump($iduser);
	$mylist= $DB->select($query  ,$agreal,$iduser);
}
											if (empty($mylist)){
											}else{
	foreach($mylist as $idcase=>$ar2){
								$casout= "";
				$arcase= array();
		foreach($ar2 as $idfina=>$elem){
			$arclam= unsetoclai($elem["toclai"]);
			$toclai= $arclam[$ft=$elem["idclaimer"]];
						# само ако за взискателя е разпределена и преведена ненулева сума 
						if ($toclai+0 <>0 and $elem["isclosed"]<>0){
			$arfina= array();
			$arfina["inco"]= $elem["inco"];
			$arfina["rest"]= $elem["rest"];
			$arfina["dist"]= $elem["inco"] - $elem["rest"];
			$arfina["tosu"]= $toclai;
			$arfina["tono"]= ($elem["isclosed"]==0) ? $toclai :0;
			$arfina["toye"]= ($elem["isclosed"]==0) ? 0 : $toclai;
				$arcase= arplus($arcase,$arfina);
								$casout .= "<tr>";
								$casout .= "<td>".$elem["caseseri"]."/".$elem["caseyear"]."<td>".$username;
								//$casout .= om2($arfina["inco"] ,"постъпила");
								//$casout .= "<td>".dafrom($elem["dateinco"])."<td>".$listfinatype2_utf8[$ft=$elem["finatype"]];
								//$casout .= om2($arfina["rest"] ,"неразпределена");
								//$casout .= om2($arfina["dist"] ,"разпределена общо");
								//$casout .= om2($arfina["tosu"] ,"разпределена за взискателя");
								//$casout .= om2($arfina["tono"] ,"втч непреведена");
								$casout .= om2($arfina["toye"] ,"втч преведена");
								$casout .= "<td>".dafrom($elem["timeclos"]);
				if (empty($cage)){
								$casout .= "<td>".$elem["agent"];
				}else{
				}
						# if ($toclai+0 <>0 and $elem["isclosed"]<>0){
						}else{
						}
		}
				$aruser= arplus($aruser,$arcase);
//							prinhead();	
/*
								$pout .= "<tr>";
								$pout .= "<td class='head'><b>".$elem["caseseri"]."/".$elem["caseyear"]."</b>";
								$pout .= toutf8("<td class='head'><b>общо за делото</b>");
								$pout .= om2($arcase["inco"] ,"постъпила","head");
								$pout .= "<td class='head'>"."<td class='head'>";
								$pout .= om2($arcase["rest"] ,"неразпределена","head");
								$pout .= om2($arcase["dist"] ,"разпределена общо","head");
								$pout .= om2($arcase["tosu"] ,"разпределена за взискателя","head");
								$pout .= om2($arcase["tono"] ,"втч непреведена","head");
								$pout .= om2($arcase["toye"] ,"втч преведена","head");
*/
							$pout .= $casout;
	}
				$artota= arplus($artota,$aruser);
/*
							prinhead();	
								$repocont .= "<tr>";
								$repocont .= "<td class='head'>".toutf8("<b>общо за</b>") ."<td class='head'><b>".$username."</b>";
								$repocont .= om2($aruser["inco"] ,"постъпила","head");
								$repocont .= "<td class='head'>"."<td class='head'>";
								$repocont .= om2($aruser["rest"] ,"неразпределена","head");
								$repocont .= om2($aruser["dist"] ,"разпределена общо","head");
								$repocont .= om2($aruser["tosu"] ,"разпределена за взискателя","head");
								$repocont .= om2($aruser["tono"] ,"втч непреведена","head");
								$repocont .= om2($aruser["toye"] ,"втч преведена","head");
*/
							$repocont .= $pout;
											# if (empty($mylist)){
											}
}

//							prinhead();	
								$repocont .= "<tr><td colspan=2 class='suma'>".toutf8("ОБЩО");
								//$repocont .= om2($artota["inco"] ,"","suma");
								//$repocont .= "<td colspan=2 class='suma'>";
								//$repocont .= om2($artota["rest"] ,"","suma");
								//$repocont .= om2($artota["dist"] ,"","suma");
								//$repocont .= om2($artota["tosu"] ,"","suma");
								//$repocont .= om2($artota["tono"] ,"","suma");
								$repocont .= om2($artota["toye"] ,"","suma");

//								$repocont .= "</table></form>";
								$repocont .= "</table>";
								$repocont= tran1251($repocont);


function prinhead(){
global $repocont;
/*
								$repocont .= "<tr>";
								$repocont .= toutf8("<td class='he2'>дело <td class='he2'>деловодител <td class='he2'>постъпила 
								<td class='he2'>дата <td class='he2'>тип 
								<td class='he2'>неразпределена <td class='he2'>разпределена <br>общо 
								<td class='he2'>разпределена <br>за взискателя
								<td class='he2'>втч <br>непреведена <td class='he2'>втч <br>преведена <td class='he2'>дата <br>превод
								");
*/
								$repocont .= "<tr>";
								$repocont .= toutf8("<td class='he2'>дело <td class='he2'>деловодител 
								<td class='he2'>преведена на взискателя <td class='he2'>дата на превода
								");
				global $cage;
				if (empty($cage)){
								$repocont .= toutf8("<td class='he2'>представител<br>на взискателя");
				}else{
				}
}

function om2($p1,$p2="",$p3=""){
	$clas= (empty($p3)) ? "" : "class='$p3'";
#--- HTML 
//return "<td $clas align=right>" .(($p1+0==0) ? "-" : number_format($p1,2,".",","));
#--- Excel 
return "<td $clas align=right>" .(($p1+0==0) ? "-" : number_format($p1,2,",",""));
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

function dafrom($p1){
	if (empty($p1)){
return "";
	}else{
return bgdatefrom($p1);
	}
}


?>