<?php
									session_start();
									include_once "common.php";

$para= $_GET["para"];
print "<h2>$para</h2>";

# името на .xml файла 
$savename= $_SESSION["savename"];
			# получаваме основ.данни и масива с транзакциите 
			include('xml.inc.php');
			$arcont = getxml($savename,true);
//print_r($arcont);
//foreach($arcont as $arelem){
//	print "\r\n $arelem";
//}
			$artran= $arcont["tran"];
//print_r($artran);
foreach($artran as $arelem){
			print "\r\n<nobr>";
	foreach($arelem as $arva){
			print $arva["value"];
	}
			print "</nobr>";
}

?>
