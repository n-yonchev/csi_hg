<?php

				include "common.php";

//$cas1= 148;
//$cas2= 800;
$cas1= 801;
$cas2= 1200;

for ($i=$cas1; $i<=$cas2; $i++){
	$DB->query("insert into suit set serial=?, year=2009, created=now(), lastdocu=now()" ,$i);
}

print "OK";

?>