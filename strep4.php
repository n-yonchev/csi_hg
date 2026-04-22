<?php
# 17.01.2012 - специфичен директен отчет 
# дела на взискател с въведен стринг в името 

								$repocont= "";
								
								$repocont .= "
<style>
td {font: normal 8pt verdana;}
.head {font: bold 8pt verdana; background: #dddddd; padding: 14px 10px 14px 10px;}
.h2 {font: normal 8pt verdana; background: #dddddd}
.erty {font: bold 8pt verdana; background: red}
</style>
								";

$findtext= $_POST["text"];
$findtext= trim($findtext);

//if (empty($ceik) or $minisuma==0){
if (empty($findtext)){
								$e1= <<<E1
						<form method=post>
								<table>
								<tr>
						<td> описание
						<td> дела на взискател, чието име съдържа въведен текст
								<tr>
						<td> частичен текст за търсене в името
						<td> <input type=text name=text size=70>
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
/*
# име на взискателя 
$clainame= $DB->selectCell("select name from claimer where bulstat=? limit 1"  ,$findtext);
$clainame= tran1251(stripslashes($clainame));

$misu= number_format($minisuma,2,".",",");
*/
		$text1= $findtext;
		$text2= mysql_real_escape_string($text1);
		$text3= mysql_real_escape_string($text2);
	$outext= tran1251($findtext);

								$repocont .=  "<table>";
								$repocont .=  toutf8("<tr><td colspan=7> 
								<h4>взискатели, които имат [$outext] в името и техните дела</h4>
								");
/*
$mylist= $DB->select("
	select subject.*, subject.id as idsubj
		, suit.serial as caseseri, suit.year as caseyear, suit.idtitu as idtitu
		, claimer.id as idclaimer
		, user.name as username, cofrom.name as cofromname
	from subject
	left join suit on subject.idcase=suit.id
	left join claimer on claimer.idcase=suit.id
		left join user on suit.iduser=user.id
		left join cofrom on suit.idcofrom=cofrom.id
	where claimer.bulstat=? and subject.idtype=1 and subject.amount>=?d
	order by suit.year, suit.serial
	"  ,$findtext,$minisuma);
*/
//$mylist= dbconv($mylist);
/*****
$mylist= $DB->select("
	select claimer.*
		, suit.serial as caseseri, suit.year as caseyear, suit.created
		, user.name as username
	from claimer
	left join suit on claimer.idcase=suit.id
	left join user on suit.iduser=user.id
	where upper(claimer.name) like upper('%$text3%')
	order by claimer.name   ,claimer.idtype,claimer.bulstat,claimer.egn
	"  ,$findtext);
*****/
$codeclai= "concat(claimer.name,'^',claimer.idtype,'^',claimer.bulstat,'^',claimer.egn)";
$mylist= $DB->select("
	select suit.serial as caseseri, suit.year as caseyear, suit.created
		, user.name as username
		, $codeclai as ARRAY_KEY1
		, suit.id as ARRAY_KEY2
	from claimer
	left join suit on claimer.idcase=suit.id
	left join user on suit.iduser=user.id
	where upper(claimer.name) like upper('%$text3%')
	order by ARRAY_KEY1, ARRAY_KEY2
	"  ,$findtext);
//print_rr($mylist);
$artype= array();
$artype[1]= "юрид";
$artype[2]= "физич";
$artype[3]= "други";
$artype= toutf8($artype);

						$coclai= 0;
						$cocase= 0;
foreach($mylist as $code=>$ar2){
	list($name,$idtype,$eik,$egn)= explode("^",$code);
	$coun= count($ar2);
						$coclai ++;
						$cocase += $coun;
								$repocont .=  "<tr><td>&nbsp;";
								$repocont .=  "<tr>";
								$repocont .=  toutf8("
									<td class='h2' align=center colspan=2>взискател <b>$coclai</b> има <b>$coun</b> дела
									<td class='h2' align=center>тип 
									<td class='h2' align=center>ЕИК 
									<td class='h2' align=center>ЕГН
									");
								$repocont .=  "<tr>";
								$repocont .=  
									"<td class='head' colspan=2>" .$name
									."<td class='head'>" .$artype[$idtype]
									."<td class='head'>" .$eik
									."<td class='head'>" .$egn;
								$repocont .=  "<tr>";
								$repocont .=  toutf8("
									<td width=100>
									<td class='h2'>дело 
									<td class='h2'>деловодител 
									<td class='h2'>образувано
									");
	foreach($ar2 as $idcase=>$elem){
								$repocont .=  "<tr>";
								$repocont .=  
									"<td><td>".$elem["caseseri"]."/".$elem["caseyear"]
									."<td>".$elem["username"]
									."<td>".bgdatefrom($elem["created"]);
	}
}
								$repocont .=  "<tr><td>&nbsp;";
								$repocont .=  "<tr>";
								$repocont .=  toutf8("
									<td class='head' align=center colspan=2> общо $coclai взискатели имат $cocase дела
									");
								$repocont .=  "</table>";
								$repocont= tran1251($repocont);

?>