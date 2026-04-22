<?php
# автоматично назначаване на длъжник за всяко постъпление 
# участват само постъпленията с назначено дело 
# постъпленията се групират по дело 
# ако делото има няколко длъжника, назначава се един от тях 
#    - според връзката : left join debtor on debtor.idcase=suit.id 

									include_once "common.php";

/*
		$query= "
select finance.id as finaid, debtor.id as debtid
, suit.id as caseid, suit.serial as caseseri, suit.year as caseyear
from finance
left join suit on finance.idcase=suit.id
left join debtor on debtor.idcase=suit.id
where finance.idcase<>0
order by finance.idcase
		";
*/
		$query= "
select finance.id as finaid, t2.id as debtid
, suit.id as caseid, suit.serial as caseseri, suit.year as caseyear
from finance 
left join suit on finance.idcase=suit.id
left join (
	select idcase, id, count(*) as coun
	from debtor
	group by idcase
	) as t2 on t2.idcase=suit.id
where finance.idcase<>0
order by finance.idcase
		";
// ERROR $debtlist= $DB->select("select distinct idcase as idca, id from debtor order by idcase");
// ERROR $debtlist= $DB->select("select distinct debtor.idcase as idca, debtor.id from debtor");
// OK $debtlist= $DB->select("select idcase, id, count(*) as coun from debtor group by idcase");
//print_r($debtlist);
$mylist= $DB->select($query);

						print "<style>td{font:normal 8pt verdana}</style>";
						print "<table>";
						print "<tr><td>idfina<td>case<td>iddebt";
				$oldcaseid= 0;
foreach($mylist as $elem){
						print "<tr>";
	$finaid= $elem["finaid"];
	$debtid= $elem["debtid"];
	$caseid= $elem["caseid"];
						print "<td> $finaid";
	if ($caseid==$oldcaseid){
						print "<td align=right>-same-";
	}else{
						print "<td>" .$elem["caseseri"]."/".$elem["caseyear"]." [".$caseid."]";
				$oldcaseid= $caseid;
	}
						print "<td> $debtid";
	# записваме длъжника към постъплението 
	$aset= array();
	$aset["iddebtor"]= $debtid +0;
	$DB->query("update finance set ?a where id=?d" ,$aset,$finaid);
						print "<td> upd";
}
						print "</table>";

?>
