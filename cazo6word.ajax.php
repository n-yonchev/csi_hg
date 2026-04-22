<?php
									session_start();
									include_once "common.php";
											
$name= $_GET["name"];
$cont= file_get_contents($name);
//var_dump($name);
											
											#--------------------------------------------------------------------
											# 13.11 2009 - קנוח Word [doc] 
											# ְֲֵָָּֽֽ. ג ראבכמםטעו הא סו המבאגט Footer [Word] 
											ExcelHeader("myfile.doc");
											$outp= "
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
<body>
	$cont
</body>
</html>
											";
//<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\" />
											print $outp;
											#--------------------------------------------------------------------


?>
