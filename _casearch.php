<?php

									include_once "common.php";

$DB->query("truncate table a2");
$DB->query("
	insert into a2 (id,idcase,serial,year,date,protocol,protdate,notes,time,iduser)
	select id,idcase,serial
		,year(str_to_date(date,'%d.%m.%Y'))
		,str_to_date(date,'%d.%m.%Y')
		,protocol,'',notes,time,iduser
	from archive
	");

print "OK";

?>