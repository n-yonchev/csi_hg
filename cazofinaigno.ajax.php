<?php
									session_start();
									include_once "common.php";

$idfina= $_GET["f"];
$DB->query("update finance set isclosed=0, timeclosed='' where id=?d"  ,$idfina);
print "ok";

?>