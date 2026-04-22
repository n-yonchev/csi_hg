<?php
									session_start();
									include_once "common.php";

$iduser= $_SESSION["iduser"];
$DB->query("update tranlock set mode='', idcase=0 where iduser=?d"  ,$iduser);

print "ok";

?>