<?php
# 11.01.2012 - специфичен директен отчет 
# дела на взискател с минимална олихвяема сума 

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
$minisuma= $_POST["minisuma"];
	$minisuma= trim($minisuma) +0;

//if (empty($ceik) or $minisuma==0){
if (empty($ceik)){
								$e1= <<<E1
						<form method=post>
								<table>
								<tr>
						<td> описание
						<td> дела на взискател с минимална олихвяема сума 
							<br> участват само делата, които имат поне една олихв.сума и тя е по-голяма от въведената
								<tr>
						<td> ЕИК на взискателя
						<td> <input type=text name=ceik>
								<tr>
						<td> мин.олихв.сума €
						<td> <input type=text name=minisuma>
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

$misu= number_format($minisuma,2,".",",");
								$repocont .=  "<table>";
								$repocont .=  toutf8("<tr><td colspan=7> 
								<h4>взискател $clainame ЕИК=$ceik <br>дела с минимална олихвяема сума $misu €, дължима на взискателя</h4>
								");
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
	"  ,$ceik,$minisuma);
//$mylist= dbconv($mylist);
						
						$step= 20;
						$coun= $step -1;
				$suma1= 0;
				$suma2= 0;

foreach($mylist as $elem){
						$coun ++;
						if ($coun % $step ==0){
								$repocont .=  "<tr class='head'>";
//								$repocont .=  toutf8("<td>дело <td>деловодител <td>постъпила <td>дата <td>тип <td>преведена <td>дата
//								");
								$repocont .=  toutf8("<td>дело <td>деловодител <td>идва от <td>изп.титул <td align=right>олихв.сума");
						}else{
						}
								$repocont .=  "<tr>";
								$repocont .=  "<td>".$elem["caseseri"]."/".$elem["caseyear"]."<td>".$elem["username"];
								$repocont .=  "<td>".$elem["cofromname"]."<td>" .$listtitu_utf8[$idtitu=$elem["idtitu"]];
		$elemamou= number_format($elem["amount"],2,".",",");
								$repocont .=  "<td align=right>".$elemamou;
				$suma1 += 1;
				$suma2 += $elem["amount"];
}

//$s1= number_format($suma1,2,".",",");
$s2= number_format($suma2,2,".",",");
								$repocont .=  "<tr><td colspan=3 class='head'>".toutf8("ОБЩО");
								$repocont .=  "<td class='head'> $suma1 ".toutf8("броя дела")." <td class='head'> $s2";

								$repocont .=  "</table>";
								$repocont= tran1251($repocont);

?>