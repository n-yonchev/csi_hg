<?php
# трансформира aainvita.date от bg-формат d.m.Y в mySQL-формат 

							include "common.php";

$DB->query("update aainvita set date=if(date='','',str_to_date(date,'%d.%m.%Y'))");

print "OK";

?>
