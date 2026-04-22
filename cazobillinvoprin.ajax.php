<?php
# отпечатване фактура за текущата сметка 
# отгоре : 
#     $invobillprin - директно фактурата invoice.id 
#     $type - типа фактура от $arinvotype 

$type= $GETPARAM["type"];
//$invotext= toutf8(strtoupper($arinvotype[$type]));

				include_once "invoprin.inc.php";
//$continvo= invoprin($invobillprin,$invotext);
$continvo= invoprin($invobillprin);

#---------------------------------------------------------------
# 07.03.2012 Бъзински - 2 екземпляра 
# източник : cazo6regi.ajax.php - word документ с много адресати и един изх.номер 
							# функции за xml/word документ - много документи от един шаблон, разделени с PageBreak 
							include_once "wordmult.inc.php";
# извличаме чистото съдържание без начало/край 
$clearcon= get_doc_content($continvo);
//# същото без таговете с футера 
//$clear2= putfooter($clearcon, "");
							# масив с отделните документи - за сборния документ 
							$arnewcont= array();
							$arnewcont[]= $clearcon;
					$clearcon= str_replace(toutf8("ОРИГИНАЛ"),toutf8("КОПИЕ"),$clearcon);
							$arnewcont[]= $clearcon;
# сборния документ 
# $pagemult - от wordmult.inc.php 
$newcont= implode($pagemult,$arnewcont);
# сборния документ с начало/край 
$endcont= replace_doc_content($continvo, $newcont);
$continvo= $endcont;
#---------------------------------------------------------------

# изход в Word 
//		$roinvo= getrow("invoice",$invobillprin);
		$roinvo= getrow("bill",$invobillprin);
		$roinvo= toutf8($roinvo);
//	$inseri= $roinvo["serial"];
	$inseri= $roinvo["seriinvo"];
//	$indate= $roinvo["date"];
	$indate= $roinvo["dateinvo"];
		$indate= bgdatefrom($indate);
		$indate= str_replace(".","",$indate);
//ExcelHeader("фактура.doc");
ExcelHeader("фактура_".$inseri."_".$indate.".doc");
print $continvo;


?>