<?php

								include_once "common.php";

$coun= $DB->query("
	update aadocucomp 
	set date6=if(idstatus=1,date(created),'')
		, date8=if(idstatus=2,date(created),'')
	");

print "OK=$coun";

?>