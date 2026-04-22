<?php

				include "common.php";

$DB->query("update finasource set timebank=concat(str_to_date(date,'%d/%m/%Y'),' ',hour)");
print "OK";

?>
