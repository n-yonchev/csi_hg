<?php
									session_start();
									include_once "common.php";
$mont= $_GET["m"];
						include_once "cale.inc.php";
$listeven= getevents($mont);
print toutf8($listeven);

?>
