<?php
# 10.10.2011 - специфичен директен отчет 
# преведени и непреведени суми за взискател - общо за всички постъпления 
# - по деловодители и дела 
ini_set("memory_limit", "128M");
include_once "common.php";

$repocont = "";
$repocont .= "
<style>
td {font: normal 8pt verdana; padding: 2px 6px 2px 6px;}
.head {font: normal 8pt verdana; background: #dddddd;}
.suma {font: bold 8pt verdana; background: #dddddd;}
.money {font: normal 8pt verdana; background: lavender;}
.erty {font: bold 8pt verdana; background: red}
</style>
								";

$ceik = $_POST["ceik"];
$ceik = trim($ceik);
$fromdate = $_POST["fromdate"];
$fromdate = date("Y-m-d", strtotime(trim($fromdate)));
$todate = $_POST["todate"];
$todate = date("Y-m-d", strtotime(trim($todate)));

if (empty($ceik) or empty($fromdate) or empty($todate)) {
	$e1= <<<E1
			<form method=post>
					<table>
					<tr>
			<td> описание
			<td> неразпределена сума за взискател за период 
				<br> участват всички постъпления, които са по делата на взискателя
					<tr>
			<td> ЕИК на взискателя
			<td> <input type=text name=ceik>
					<tr>
			<td> от дата
			<td> <input type=text name=fromdate>
					<tr>
			<td> до дата
			<td> <input type=text name=todate>
					<tr>
			<td> 
			<td> <input type=submit name=submit value=въведи>
					</table>
			</form>
E1;
	$repocont .= toutf8($e1);
	$repocont = tran1251($repocont);
	return;
}

$repocont .= "<form method=post><table>";
$repocont .= toutf8(
	"<tr><td colspan=7> 
	<h4>взискател $clainame ЕИК=$ceik <br>неразпределена сума за период " . date("d.m.Y", strtotime($fromdate)) . " - " . date("d.m.Y", strtotime($todate)) . "</h4>"
);

$mylist = $DB->select(
	"SELECT concat(s.serial, '/', s.year) as suit_number,
	u.name as user_name,
	ROUND(sum(f.inco), 2) as suma
	FROM suit s
	INNER JOIN claimer c ON c.idcase = s.id
	INNER JOIN finance f ON f.idcase = s.id
	INNER JOIN user u ON u.id = s.iduser
	WHERE c.bulstat = ?
	AND idstat = 24
	AND f.dateinco > ?
	AND f.dateinco < ?
	AND f.isclosed = 0
	GROUP BY s.id
	ORDER BY s.created desc
	", $ceik, $fromdate, $todate);

prinhead();
$artota = array();
$all_inco = 0;
foreach ($mylist as $iduser => $ar1) {
	$pout = "";
$pout .= "<tr>";
$pout .= "<td>" . $ar1["suit_number"] . "<td>" . $ar1["user_name"] . "<td>" . $ar1["suma"];
$pout .= "</tr>";
$all_inco += $ar1["suma"];
	$repocont .= $pout;
}

$repocont .= "<tr><td colspan=2 class='suma'>" . toutf8("ОБЩО");
$repocont .= outmoney($all_inco, "", "suma");
$repocont .= "</tr>";
$repocont = tran1251($repocont);



function prinhead()
{
	global $repocont;
	$repocont .= "<tr>";
	$repocont .= toutf8(
		"<td class='head'>дело <td class='head'>деловодител
		<td class='head'>сума"
	);
}

function outmoney($p1, $p2, $p3 = "")
{
	$p2 = toutf8($p2);
	return "<td class='$p3' align=right title='$p2'>" . (($p1 + 0 == 0) ? "-" : number_format($p1, 2, ".", ","));
}

function arplus($ar1, $ar2)
{
	foreach ($ar2 as $ind2 => $con2) {
		$ar1[$ind2] += $con2;
	}
	return $ar1;
}
