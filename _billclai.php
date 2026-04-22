<?php

								include_once "common.php";

$coun= $DB->query("
	update bill 
	left join claimer on bill.idclaimer=claimer.id
	set bill.name=claimer.name, bill.egn=claimer.egn, bill.eik=claimer.bulstat, bill.address=claimer.address
	where bill.idclaimer<>0
	");

print "OK=$coun";

?>