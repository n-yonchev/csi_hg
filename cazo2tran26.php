<?php

									session_start();
									include_once "common.php";
$p1=$_GET["p1"];
//print $p1;
list($idcase,$setto)= explode("/",$p1);
$DB->query("update suit set t26=? where id=?d"  ,$setto,$idcase);

print "ok";

?>