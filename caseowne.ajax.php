<?php
# ajax отговор на обръщение за назначаване деловодител на дело 
# вика се в case.tpl 

									session_start();
									include_once "common.php";

# id на делото за назначаване 
$caid= $_GET["caid"];

# деловодителя за назначаване 
$ownerse= $_SESSION["ownerid"];
				# избягваме ситуацията $ownerse===NULL - в самото начало 
				if (isset($ownerse)){
				}else{
					$ownerse= 0;
					$_SESSION["ownerid"]= 0;
				}
$roowner= getrow("user",$ownerse);
$owname= $roowner["name"];

# назначаваме в БД 
$DB->query("update suit set iduser=? where id=?" ,$ownerse,$caid);

# връщаме отговора 
print toutf8($owname);

?>
