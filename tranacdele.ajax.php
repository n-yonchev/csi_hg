<?php
# вика се чрез jQuery.ajax от tranac.tpl 

									session_start();
									include_once "common.php";

$idelem= $_GET["p"];
$DB->query("delete from tranacco where id=?d"  ,$idelem);

print "ok";

?>