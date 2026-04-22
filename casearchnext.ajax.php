<?php
									session_start();
									include_once "common.php";

$year= $_GET["year"];
//print $year;
$maxnum= $DB->selectCell("select max(serial) from archive where year=?d"  ,$year);
$nextnum= $maxnum +1;

print $nextnum;

?>