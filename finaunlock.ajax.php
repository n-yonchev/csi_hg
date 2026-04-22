<?php
# ajax отговор на обръщение за отключване на запис за постъпление 
# вика се в c_window.header.tpl 

									session_start();
									include_once "common.php";

# id на записа 
$idfina= $_GET["idfina"];

# отключваме записа 
$DB->query("update finance set lockedby=0 where id=?" ,$idfina);

# връщаме отговора 
print "OK";

?>
