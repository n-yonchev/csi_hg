<?php
						include "cazo6creadocudefi.inc.php";

				print iconv("windows-1251","UTF-8",'
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title> ЧСИ изх.тагове </title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style>
td {font: normal 10pt verdana}
</style>
</head>
<body>
				');
				print "<table>";
foreach($arsource as $indx=>$elem){
	$text= iconv("windows-1251","UTF-8",$elem["text"]);
				print "\n<tr><td>$indx<td>".$text;
}
				print "</table>";

?>
