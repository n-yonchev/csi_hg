<?php
# автоматично отпечатване на група СМЕТКИ 
# - вика се самостоятелно във вътр.фрейм - виж finainvo.tpl 

									session_start();
									include_once "common.php";
//$type= $_GET["type"];
$para= $_GET["para"];
	$palist= explode("/",$para);
	unset($palist[count($palist)-1]);

						# 16.01.2014 допълнително за фактурата 
						include_once "invo2.inc.php";

#---------- копирано от cazobillprin.ajax.php - извеждане на единична сметка ----------
											include_once "billprin.inc.php";
$namebill= "outgoing/BILL.HTML";
//$tpnamebill= "billprin.tpl";
$tpnamebill= "b2prin.tpl";
# шаблона 
$tpname= "cazobillprin.ajax.tpl";
# шаблона за сметката 
$cont= file_get_contents($namebill);
$cont= tran1251($cont);
					$str1= "<body>";
					$str2= "</body>";
						$len1= strlen($str1);
						//$len2= strlen($str2);
					$ind1= strpos($cont,$str1);
					$ind2= strpos($cont,$str2);
				$par1= substr($cont,0,$ind1+$len1);
				$par2= substr($cont,$ind1+$len1,$ind2-$ind1-$len1);
				$par3= substr($cont,$ind2);
//file_put_contents("outgoing/$tpnamebill",$cont);
file_put_contents("outgoing/$tpnamebill",$par2);
#--------------------------------------------------------------------------------------

				$arnewcont= "";
foreach($palist as $indx=>$prnt){
	$prnt= substr($prnt,4) -19;
	$contbill= billtran($prnt,$tpnamebill);
				$arnewcont[]= $contbill;
}
				$pagebr= '<br style="page-break-after: always;">';
$contfull= implode($pagebr,$arnewcont);
$contfull= toutf8($contfull);

# изход в Word 
		$par1= str_replace("{ldelim}","{",$par1);
		$par1= str_replace("{rdelim}","}",$par1);
ExcelHeader("група_сметки_".date("dmY_Hi").".doc");
$outp= $par1 .$contfull .$par3;
print $outp;

/*
	$outp= "
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\" />
<body>
	$contfull
</body>
</html>
	";
*/
//print toutf8($contfull);
//print $contfull;

/*
#--------------------------------------------------------------------------------------
$contbill= billtran($prinbill,$tpnamebill);
	$robill= getrow("bill",$prinbill);
	$seribill= $robill["serial"];
ExcelHeader("сметка_$seribill.doc");
	$outp= "
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\" />
<body>
	$contbill
</body>
</html>
	";
print $outp;
#--------------------------------------------------------------------------------------
*/
/***
							include_once "invo.inc.php";

							# функции за формиране на документ с фактура 
							include_once "invoprin.inc.php";
							# функции за xml/word документ - много документи от един шаблон, разделени с PageBreak 
							include_once "wordmult.inc.php";
# формираме сборен документ за групата СМЕТКИ 
# източници : cazobillinviprin.ajax.php - cazo6regi.ajax.php 
							$arnewcont= array();
foreach($palist as $indx=>$prnt){
	$prnt= $prnt -19;
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
***/
/*
# изход в Word 
ExcelHeader("група_сметки_".date("dmY_Hi").".doc");
print $contfull;
*/

?>