<?php
# извеждане на фактура 
# отгоре : 
#    $mode= режима в глав.меню 
#    $page= текущата страница от списъка 
# управляващ : 
#    $pdfview - aadocuc2.id 
//print_r($GETPARAM);
//print "[$mode][$page][$princert]";

									session_start();
									include_once "common.php";
											# всичко за справките 2 
											include_once "cer2.inc.php";

$pdfname= sprintf($tempinvoname,$pdfview);
$continvo= file_get_contents($pdfname);

ExcelHeader("фактура_ЦРД.pdf");
print $continvo;


?>