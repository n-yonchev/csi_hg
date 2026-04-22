<?php
# 25.01.2011 
# добавяме служебни вноски от Взискател към ЧСИ според остарелия флаг subject.istoclaimer =1 
# след изпълнение флага става subject.istoclaimer=2 

								include_once "common.php";

# неолихвяема 
$fitype= "subject.idtype=2";
# флаг да се превежда на взискателя 
$ficlai= "subject.istoclaimer=1";
# сумата - от списък 
$fiamou= "subject.amount+0 in (522,504,540,186,108,126)";
# списъка 
$mylist= $DB->select("
	select subject.*, subject.id as id 
		, suit.serial as caseseri, suit.year as caseyear
		, claimer.name as clainame, user.name as username
	from subject
		left join suit on subject.idcase=suit.id
		left join claimer on subject.idclaimer=claimer.id
		left join user on suit.iduser=user.id
	where $fitype and $ficlai and $fiamou
	order by subject.id
	");
//$mylist= dbconv($mylist);
								
								print <<<EOH
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style='height:100%'>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<body>
<style>
body, td {font: normal 8pt verdana;}
.head {font: bold 8pt verdana; background: #dddddd}
.erty {font: bold 8pt verdana; background: red}
</style>
EOH;
								print "<table>";
foreach($mylist as $indx=>$elem){
	$elem= arstrip($elem);
	if ($indx % 26 ==0){
								print "<tr>";
								print "<td class='head'>id";
								print "<td class='head'>";
								print "<td class='head'>".toutf8("дело");
								print "<td class='head'>".toutf8("деловодител");
								print "<td class='head'>".toutf8("описание");
								print "<td class='head'>".toutf8("подтип");
								print "<td class='head'>".toutf8("сума");
								print "<td class='head'>".toutf8("от-дата");
								print "<td class='head'>";
								print "<td class='head'>".toutf8("взискател");
								print "<td class='head'>idca";
	}else{
	}
								print "<tr valign=top>";
								print "<td>[".$elem["id"]."]";
								print "<td>[".$elem["idcase"]."]";
								print "<td>".$elem["caseseri"]."/".$elem["caseyear"];
								print "<td><nobr>".$elem["username"]."</nobr>";
								print "<td>".$elem["text"];
								print "<td><nobr>".$listsubjst_utf8[$idsubt=$elem["idsubtype"]]."</nobr>";
								print "<td>".$elem["amount"];
								print "<td>".bgdatefrom($elem["fromdate"]);
								print "<td>[".$elem["idclaimer"]."]";
								print "<td>".$elem["clainame"];
//	if (1){
		$aset= array();
		$aset["idclaimer"]= $elem["idclaimer"];
		$aset["date"]= $elem["fromdate"];
		$aset["amount"]= $elem["amount"];
		$aset["descrip"]= $elem["text"];
		$idca= $DB->query("insert into claimadva set ?a"  ,$aset);
$sset= array();
$sset["idclaimadva"]= $idca;
$sset["istoclaimer"]= 2;
$DB->query("update subject set ?a where id=?d"  ,$sset,$elem["id"]);
								print "<td>".$idca;
//	}else{
//	}
}
								print "</table>";

print "<br>OK=".count($mylist);

?>