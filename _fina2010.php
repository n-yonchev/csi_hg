<?php

$year= 2010;
								include_once "common.php";
		
# приключено постъпление 
$ficlos= "finance.isclosed=1";
# приключено през годината 
$fitime= "year(finance.timeclosed)=$year";
# списъка 
$mylist= $DB->select("
	select finance.* 
		, suit.serial as caseseri, suit.year as caseyear
		, user.name as username
	from finance
		left join suit on finance.idcase=suit.id
		left join user on suit.iduser=user.id
	where $ficlos and $fitime
	order by suit.year, suit.serial
	");
//$mylist= dbconv($mylist);

$head= toutf8("приключени през $year год. постъпления по всички изпълнителни дела ");
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
<font size=+1><b>$head</b></font>
<br>
<br>
EOH;
								print "<table>";
				$suma= 0;
						$suma1= 0;
						$suma2= 0;
						$suma7= 0;
						$suma9= 0;
foreach($mylist as $indx=>$elem){
	$elem= arstrip($elem);
	if ($indx % 26 ==0){
								print "<tr>";
								print "<td class='head'>id";
								print "<td class='head'>";
								print "<td class='head'>".toutf8("дело");
								print "<td class='head'>".toutf8("деловодител");
								print "<td class='head'>".toutf8("сума");
								print "<td class='head'>".toutf8("тип");
								print "<td class='head'>".toutf8("постъпила");
								print "<td class='head'>".toutf8("приключена");
								print "<td class='head'>".toutf8("описание");
								print "<td class='head'>".toutf8("банка");
								print "<td class='head'>".toutf8("вброй");
								print "<td class='head'>".toutf8("старо");
								print "<td class='head'>".toutf8("взиск");
	}else{
	}
				$suma += $elem["inco"];
								print "<tr valign=top>";
								print "<td>[".$elem["id"]."]";
								print "<td>[".$elem["idcase"]."]";
								print "<td>".$elem["caseseri"]."/".$elem["caseyear"];
								print "<td><nobr>".$elem["username"]."</nobr>";
								print "<td>".$elem["inco"];
								print "<td><nobr>".$listfinatype_utf8[$idtype=$elem["idtype"]]."</nobr>";
								print "<td>".bgdatefrom($elem["dateinco"]);
								print "<td>".bgdatefrom($elem["timeclosed"]);
								print "<td>".$elem["descrip"];
						$idtype= $elem["idtype"];
						$inco= $elem["inco"];
						${"suma".$idtype} += $inco;
						if (0){
						}elseif ($idtype==1){
								print "<td>".$inco;
						}elseif ($idtype==2){
								print "<td><td>".$inco;
						}elseif ($idtype==7){
								print "<td><td><td>".$inco;
						}elseif ($idtype==9){
								print "<td><td><td><td>".$inco;
						}else{
								print "<td>error=".$idtype;
						}
}
								print "<tr>";
								print "<td><td>";
								print "<td class='head'>".toutf8("ОБЩО");
								print "<td class='head' colspan=2 align=right>".number_format($suma,2,".",",");
								print "<td class='head'>&nbsp;";
								print "<td class='head'>&nbsp;";
								print "<td class='head'>&nbsp;";
								print "<td class='head'>&nbsp;";
								print "<td class='head' align=right>".number_format($suma1,2,".",",");
								print "<td class='head' align=right>".number_format($suma2,2,".",",");
								print "<td class='head' align=right>".number_format($suma7,2,".",",");
								print "<td class='head' align=right>".number_format($suma9,2,".",",");
								print "</table>";

print "<br>OK=".count($mylist);

?>
