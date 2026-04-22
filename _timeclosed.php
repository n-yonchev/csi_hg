<?php
# 10.02.2010 
# масово зареждане на полето finance.timeclosed - ново поле - времето на приключване 
# за всяко приключено постъпление (finance.isclosed=1) преглеждаме записите с история (finahist) 
# и търсим последния по време запис, в който isclosed=1 
# намереното време записваме в полето finance.timeclosed 

									include_once "common.php";

$idlist= $DB->selectCol("select id from finance where isclosed=1 order by id");
					print "<style>td{font:normal 8pt verdana}</style>";
					print "<table>";
foreach($idlist as $idcurr){
					print "<tr><td>$idcurr";
									print "<td width=20>";
	# всички промени на постъплението 
	$histlist= $DB->selectCol("select content from finahist where idfinance=$idcurr");
	$counhist= count($histlist);
					if ($counhist==0){
						print "<td><font color=red>no.hist</font>";
					}else{
						print "<td>$counhist";
					}
									print "<td width=20>";
			# масив с времето за всички състояния с isclosed=1 
			# трябва да има точно 1 такъв елемент, но са възможни отклонения 
			$arclos= array();
	foreach($histlist as $histelem){
		# данни за поредната промяна 
		# - източник : finahist.ajax.php 
		$myar= unseriraw($histelem);
//		$mytime= $myar["time"];
//		$myclos= $myar["isclosed"];
//			$arclos[$mytime]= $myclos;
//					print "<td>";
//print_r($myar);
		if ($myar["isclosed"]==1){
			$arclos[]= $myar["time"];
		}else{
		}
	}
//					print "<td>";
//print_r($arclos);
		$counclos= count($arclos);
# няма време на приключване 
$mytime= "";
					if ($counclos==0){
						print "<td><font color=red>no.closed</font>";
# няма време на приключване - проблем 
					}elseif ($counclos==1){
						print "<td>$counclos";
# вземаме времето на единствения елемент 
$mytime= $arclos[0];
									print "<td width=20>";
						print "<td>$mytime";
					}else{
						print "<td><font color=red>$counclos closed</font>";
# сортираме времената в обратен ред 
rsort($arclos);
# вземаме макс.време 
$mytime= $arclos[0];
									print "<td width=20>";
						print "<td>$mytime";
					}
	# накрая 
	# зареждаме новото поле с полученото време на приключване 
	$aset= array();
	$aset["timeclosed"]= $mytime;
	$DB->query("update finance set ?a where id=?d"  ,$aset,$idcurr);
}
					print "</table>";

?>
