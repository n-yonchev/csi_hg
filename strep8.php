<?php
# 08.08.2013 - специфичен директен отчет 
# дълг и преводи към взискател 
# - по дела 

									include_once "common.php";
$selfname= "strep8.php";
$htname= "strep8resu.html";

																$indx= $_GET["indx"];
																if (isset($indx)){
									# да съвпада с името в statis.php 
									session_name("mainboss");
									session_start();
$ceik= $_GET["ceik"];
$arcase= $_SESSION["arcase"];
$idca= $arcase[$indx]["idcase"];
# общо за делото 
$txcase= $arcase[$indx]["txcase"];
	$rocase= getrow("suit",$idca);
$idstat= $rocase["idstat"];
$txstat= $viewcasestat[$idstat];
			$isacti= in_array($idstat,array(0,24));
if ($isacti){
	$clstat= "";
}else{
	$clstat= "cancel";
}
	$rouser= getrow("user",$rocase["iduser"]);
$txuser= $rouser["name"];
if ($isacti){
	# предмет 
	$rosubj= $DB->select("
		select subject.amount, subject.text, subject.idtype, subject.idsubtype
		from subject
		left join claimer on subject.idclaimer= claimer.id
		where subject.idcase=?d and claimer.bulstat=?
		"  ,$idca,$ceik);
						$suma1= 0;
								$htmlaa= "";
	foreach($rosubj as $elem){
		$amou= $elem["amount"];
						$suma1 += $amou;
//			$txamou= number_format($amou,2,".",",");
			$txamou= tomoney($amou);
		$type= $elem["idtype"];
		$subt= $elem["idsubtype"];
			$txtype= $listsubjtype2_utf8[$type];
			if ($type==2){
				$txtype .= "/".$listsubjst_utf8[$subt];
			}else{
			}
		$text= $elem["text"];
								$htmlaa .= tran1251("
<tr>
<td align=right> <b>$txamou</b>
<td> $txtype
<td> $text
								");
	}
//			$txsuma1= number_format($suma1,2,".",",");
			$txsuma1= tomoney($suma1);
	# преводи 
	$rofina= $DB->select("
		select inco, idtype, dateinco, isclosed, toclai, timeclosed
		from finance
		where finance.idcase=?d
		"  ,$idca);
//$pout= print_r($rofina,true);
						$suma2= 0;
								$htmlbb= "";
	foreach($rofina as $elem){
		$inco= $elem["inco"];
//			$txinco= number_format($inco,2,".",",");
			$txinco= tomoney($inco);
		$date= bgdatefrom($elem["dateinco"]);
		$type= $elem["idtype"];
			$txtype= $listfinatype2_utf8[$type];
				$dateclos= "";
		if ($elem["isclosed"]==0){
									$isnoclos= true;
				$txclai= toutf8("неприключено");
		}else{
									$isnoclos= false;
			$arclam= unsetoclai($elem["toclai"]);
					$arkeys= array_keys($arclam);
					if (empty($arkeys)){
						$codekeys= "0";
					}else{
						$codekeys= implode(",",$arkeys);
					}
					$idclai= $DB->selectCell("
						select claimer.id
						from claimer
						where id in ($codekeys) and claimer.idcase=?d and claimer.bulstat=?
						"  ,$idca,$ceik);
//$pout= print_r($arclam,true);
//$htmlbb .= "<pre>$pout</pre>";
			$toclai= $arclam[$idclai];
						$suma2 += $toclai;
			if ($toclai+0==0){
				$txclai= "-";
			}else{
//				$txclai= number_format($toclai,2,".",",");
				$txclai= tomoney($toclai);
				$dateclos= bgdatefrom(substr($elem["timeclosed"],0,10));
			}
		}
									if ($isnoclos){
$tdclai= "<td class='cancel' colspan=2> $txclai";
									}else{
$tdclai= "<td align=right> <b>$txclai</b>";
									}
								$htmlbb .= tran1251("
<tr>
<td align=right> $txinco
<td> $date
<td> $txtype
$tdclai
<td> $dateclos
								");
	}
//			$txsuma2= number_format($suma2,2,".",",");
			$txsuma2= tomoney($suma2);
}else{
}
$diff= $suma1 - $suma2;
//			$txdiff= number_format($diff,2,".",",");
			$txdiff= tomoney($diff);
# глобални суми 
$_SESSION["tosuma1"] += $suma1;
$_SESSION["tosuma2"] += $suma2;
$_SESSION["todiff"] += $diff;
//++$txtota= "<td>".$_SESSION["tosuma1"] ."<td>".$_SESSION["tosuma2"] ."<td>".$_SESSION["todiff"];
# извеждаме всичко за делото 
								$html= toutf8("
<tr>
<td class='he2'> $txcase
<td class='he2'> $txuser
<td class='he2 $clstat'> $txstat
<td class='he2' align=right> <b>$txsuma1</b>
<td class='he2' align=right> <b>$txsuma2</b>
<td class='he2' align=right> <b>$txdiff</b>
								");
//++$txtota
//<td> <pre>$pout</pre>
if ($isacti){
								$html .= toutf8("
<tr>
<td>
<td colspan=12> 
	<table>
		<tr>
		<td class='head' colspan=10> дълг (предмет)
				$htmlaa
	</table>
	<table>
		<tr>
		<td class='head' colspan=10> преводи
		<tr>
		<td class='head' align=right> постъп
		<td class='head'> на дата
		<td class='head'> тип
		<td class='head' align=right> превод на <br>взискателя
		<td class='head'> на дата
				$htmlbb
	</table>
								");
}else{
}
								file_put_contents($htname,$html,FILE_APPEND);

# следващо дело 
$indx ++;
if (isset($arcase[$indx])){
//	$idca= $arid[$indx];
	$idca= $arcase[$indx]["idcase"];
	$txcase= $arcase[$indx]["txcase"];
	print "$indx^$txcase^$ceik";
}else{
	# край 
	$txtosuma1= tomoney($_SESSION["tosuma1"]);
	$txtosuma2= tomoney($_SESSION["tosuma2"]);
	$txtodiff= tomoney($_SESSION["todiff"]);
								$html= toutf8("
<tr>
<td colspan=3>
<td class='he2' align=right> дълг <br>общо
<td class='he2' align=right> преводи <br>общо
<td class='he2' align=right> разлика <br>общо
<tr>
<td colspan=3>
<td class='he2' align=right> <b>$txtosuma1</b>
<td class='he2' align=right> <b>$txtosuma2</b>
<td class='he2' align=right> <b>$txtodiff</b>
								");
								$html .= '
</table>
</body>
</html>
								';
								file_put_contents($htname,$html,FILE_APPEND);
//	print "*^-край-";
$resu= file_get_contents($htname);
	print "*^$resu";
}
																}else{

								$repocont= "";
/*
								$repocont .= '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="height:100%">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style>
td {font: normal 8pt verdana; padding: 2px 6px 2px 6px;}
.head {font: normal 8pt verdana; background: #dddddd;}
.he2 {font: normal 7pt verdana; background-color: burlywood;}
.suma {font: bold 8pt verdana; background: #dddddd;}
.money {font: normal 8pt verdana; background: lavender;}
.erty {font: bold 8pt verdana; background: red}
</style>
</head>
<body>
								';
*/
								
//print_rr($_POST);
$ceik= $_POST["ceik"];
	$ceik= trim($ceik);
if (empty($ceik)){
								$e1= <<<E1
<style>
td {font: normal 8pt verdana; padding: 2px 6px 2px 6px;}
</style>
						<form method=post>
								<table>
								<tr>
						<td> описание
						<td> дължими и преведени суми към взискателя по дела
							<br> участват само активните дела
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

$arcase= $DB->select("
	select claimer.idcase, concat(suit.serial,'/',suit.year) as txcase
	from subject 
	left join claimer on subject.idclaimer=claimer.id
	left join suit on claimer.idcase=suit.id
	where claimer.bulstat=?
	group by claimer.idcase
	order by suit.year, suit.serial
/*** limit 30 ***/
	"  ,$ceik);
$_SESSION["arcase"]= $arcase;
$_SESSION["tosuma1"]= 0;
$_SESSION["tosuma2"]= 0;
$_SESSION["todiff"]= 0;
//print_rr($arid);

//$_SESSION["arid8"]= $arid;
$indx= 0;
$idca= $arcase[$indx]["idcase"];
$txcase= $arcase[$indx]["txcase"];

								$repocont= <<<E2
<br>
<div id="ajcont" align=center style="font:bold 12pt verdana">
</div>
<script>
fusucc("$indx^$txcase^$ceik");
function fusucc(data){
//alert("data="+data);
	var arre= data.split("^");
	var indx= arre[0];
	var txcase= arre[1];
	var ceik= arre[2];
	if (indx=="*"){
		$("#ajcont").html(txcase);
	}else{
//		$("#ajcont").text("изп.дело "+txcase);
		$("#ajcont").text(txcase);
		jQuery.ajax({
			url: "$selfname?indx="+indx+"&ceik="+ceik
//			url: "$selfname?indx="+indx
			,success: fusucc
			});
	}
}
</script>
E2;
	# име на взискателя 
	$clainame= $DB->selectCell("select name from claimer where bulstat=? limit 1"  ,$ceik);
	$clainame= tran1251(stripslashes($clainame));
//		$arhead[]= "взискател $clainame ЕИК=$ceik";
//		$ceikfilt= "claimer.bulstat='$ceik'";
								$html= '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="height:100%">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style>
td {font: normal 8pt verdana; padding: 2px 6px 2px 6px;}
.cancel {color:red;}
.head {font: normal 8pt verdana; background: #dddddd;}
.he2 {font: normal 8pt verdana; background-color: burlywood;}
.suma {font: bold 8pt verdana; background: #dddddd;}
.money {font: normal 8pt verdana; background: lavender;}
.erty {font: bold 8pt verdana; background: red}
</style>
</head>
<body>
<table align=center>
								';
								$html .= toutf8("
<tr>
<td class='head' colspan=12>
дълг и преводи към взискател <b>$clainame</b> ЕИК=<b>$ceik</b>
<tr>
<td class='head'> дело
<td class='head'> деловодител
<td class='head'> статус
<td class='head' align=right> дълг
<td class='head' align=right> преведено
<td class='head' align=right> разлика
								");
								file_put_contents($htname,$html);

																# if (isset($indx)){
																}


function tomoney($p1){
return number_format($p1,2,".",",");
}

?>