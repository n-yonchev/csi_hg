<?php
# автоматично отпечатване на група фактури 
# - вика се самостоятелно във вътр.фрейм - виж finainvo.tpl 

									session_start();
									include_once "common.php";
//$type= $_GET["type"];
$para= $_GET["para"];
	$palist= explode("/",$para);
	unset($palist[count($palist)-1]);

							include_once "invo.inc.php";
//$invotext= toutf8(strtoupper($arinvotype[$type]));

						# 16.01.2014 допълнително за фактурата 
						include_once "invo2.inc.php";

							# функции за формиране на документ с фактура 
							include_once "invoprin.inc.php";
							# функции за xml/word документ - много документи от един шаблон, разделени с PageBreak 
							include_once "wordmult.inc.php";
# формираме сборен документ за групата фактури 
# източници : cazobillinviprin.ajax.php - cazo6regi.ajax.php 
							$arnewcont= array();
foreach($palist as $indx=>$prnt){
	$prnt= $prnt -157;
//	$continvo= invoprin($prnt,$invotext);
	$continvo= invoprin($prnt);
	$clearcon= get_doc_content($continvo);
							$arnewcont[]= $clearcon;
				$clearcon= str_replace(toutf8("ОРИГИНАЛ"),toutf8("КОПИЕ"),$clearcon);
							$arnewcont[]= $clearcon;
}
# сборния документ с начало/край 
# $pagemult - от wordmult.inc.php 
$newcont= implode($pagemult,$arnewcont);
$endcont= replace_doc_content($continvo, $newcont);
$continvo= $endcont;

# изход в Word 
ExcelHeader("група_фактури_".date("dmY_Hi").".doc");
print $continvo;


?>