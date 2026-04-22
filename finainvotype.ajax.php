<?php
									session_start();
									include_once "common.php";
$modeel= $_POST["modeel"];
$idtype= $_POST["type"];

$palink= geturl($modeel."&filttype=".$idtype);
print "ok^".$palink;

?>