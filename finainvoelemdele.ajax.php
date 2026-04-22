<?php
# вика се чрез jQuery.ajax от finainvo2.ajax.tpl 

									session_start();
									include_once "common.php";

						//# всичко за фактурата 
						//include_once "invo.inc.php";

$idelem= $_GET["p"];
$idinvo= $_GET["i"];
$DB->query("delete from invoelem where id=?d"  ,$idelem);

print "ok^$idinvo";

?>