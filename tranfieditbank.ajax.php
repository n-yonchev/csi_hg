<?php
# вика се с ajax от шаблона tranfiedit.ajax.tpl 

									session_start();
									include_once "common.php";
$mybic= $_GET["p"];
$robank= $DB->selectRow("select * from bankbic where bic=?"  ,$mybic);

print "ok^" .$robank["bank"];

?>