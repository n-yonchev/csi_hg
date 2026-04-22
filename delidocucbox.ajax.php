<?php
									session_start();
									include_once "common.php";

$cblist= $_GET["list"];
$arlist= explode("/",$cblist);
unset($arlist[count($arlist)-1]);
$_SESSION["aridpost"]= $arlist;

//print "taralala";
print "ok";

?>