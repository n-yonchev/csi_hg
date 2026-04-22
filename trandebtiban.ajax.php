<?php
									session_start();
									include_once "common.php";

$iddebt= $_GET["p"];
$rodebt= getrow("debtor",$iddebt);
$debtiban= $rodebt["iban"];

print "ok^$debtiban";

?>