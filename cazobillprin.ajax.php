<?php
# извеждане на сметка за дело 
# отгоре : 
#    $edit= case.id 
#    $zone= bill 
# управляващ : 
#    $prinbill - сметката bill.id 
//print_r($GETPARAM);

											include_once "billprin.inc.php";
$robill= getrow("bill",$prinbill);
if(strtotime($robill['date']) < strtotime('2026-01-01')) {
	$namebill= "outgoing/BILL_LEV.HTML";
	$tpnamebill= "billprin_lev.tpl";
} else {										
	$namebill= "outgoing/BILL.HTML";
	$tpnamebill= "billprin.tpl";
}

# шаблона за сметката 
$cont= file_get_contents($namebill);
$cont= tran1251($cont);
//file_put_contents("smtemp/$tpnamebill",$cont);
file_put_contents("outgoing/$tpnamebill",$cont);

//# таблицата 
//$taname= "bill";
# шаблона 
$tpname= "cazobillprin.ajax.tpl";

# параметър отпечатване 
$print= $GETPARAM["print"];
$flprin= $print=="yes";
										if ($flprin){
$contbill= billtran($prinbill,$tpnamebill);
//$smarty->assign("CONTENT", $contbill);
//print smdisp("_print.tpl","iconv");
# изход в Word 
//$cont= smdisp("stagen.tpl","fetch");
		$roinvo= getrow("bill",$prinbill);
		$roinvo= toutf8($roinvo);
	$inseri= $roinvo["serial"];
	$indate= $roinvo["date"];
		$indate= bgdatefrom($indate);
		$indate= str_replace(".","",$indate);
ExcelHeader(toutf8("сметка_").$inseri."_".$indate.".doc");
	$outp= "
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\" />
<body>
	$contbill
</body>
</html>
	";
//<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
//print $cont;
print $outp;
//exit;
										}else{
										
# линк за отпечатване 
			if ($edit==0){
//$modeel= "prinbill=$prinbill";
//$modeel= "edit=-1&zone=-1&prinbill=$prinbill";
$modeel= "mode=$mode&page=$page&prinbill=$prinbill";
			}else{
$modeel= "edit=$edit&zone=$zone&prinbill=$prinbill";
			}
$linkprin= geturl($modeel."&print=yes");
$smarty->assign("LINKPRIN", $linkprin);

/*
# шаблона за сметката 
$cont= file_get_contents($namebill);
$cont= tran1251($cont);
//file_put_contents("smtemp/$tpnamebill",$cont);
file_put_contents("outgoing/$tpnamebill",$cont);
*/

# заместваме в шаблона 
//$contbill= smdisp($tpnamebill,"fetch");
$contbill= billtran($prinbill,$tpnamebill);
$smarty->assign("CONT", $contbill);

# извеждаме 
$smarty->assign("ISCLAIMER", $isclaimer);
print smdisp($tpname,"iconv");
//	$pagecont= smdisp($tpname,"iconv");
										
										}

/*
function billtran($prinbill,$tpnamebill){
global $DB, $smarty;
global $rooffi;
	
	$robill= getrow("bill",$prinbill);
//print_rr($robill);
$smarty->assign("ROBILL", $robill);
	$rocase= getrow("suit",$robill["idcase"]);
	
	$rooffi= getofficerow(0);
		$billpa= unserialize(toutf8($rooffi["billparams"]));
		$billpa= tran1251($billpa);
		$rooffi["iban"]= $billpa["iban"];
		$rooffi["bic"]= $billpa["bic"];
		$rooffi["bank"]= $billpa["bank"];
		$rooffi["address"]= $billpa["address"];
	$rooffi["date"]= $robill["date"];
	$rooffi["seribill"]= $robill["serial"];
	$rooffi["fullcase"]= getfullnumb($rocase);
$smarty->assign("RODATA", $rooffi);

	$mylist= $DB->select("select billelem.* ,billelem.id as id
		from billelem
		where billelem.idbill=?d
		order by billelem.level, billelem.id
		"  ,$prinbill);
	$mylist= dbconv($mylist);
$smarty->assign("LIST", $mylist);

	$suma= $DB->selectCell("
		select sum(taxprop+taxregu+taxaddi) as suma
		from billelem
		where idbill=?d
		group by idbill
		"  ,$prinbill);
///////////////////////////////////////////	$svat= round(0.2*$suma ,2);
						# 29.01.2014 - Пазарджик 
						# 29.02.2012 - флаг за ДДС 
						if ($robill["isvat"]==0){
	$svat= 0;
						}else{
	$svat= round(0.2*$suma ,2);
						}
	$tota= $suma + $svat;
$rbpaid= $robill["paid"];
$smarty->assign("SUMA", array("suma"=>$suma, "svat"=>$svat, "tota"=>$tota
, "paid"=>$rbpaid));

//	list($c1,$c2)= explode(".",$tota);
//$nfpaid= number_format($robill["paid"],2);
	list($c1,$c2)= explode(".",number_format($rbpaid,2));
					include_once "SLOVOM.php";
	$slovom= slovom($c1,$c2);
//	$slovom= toutf8($slovom);
$smarty->assign("SLOVOM", $slovom);

$GLOBALS["smartytempdir"]= "outgoing/";
$contbill= smdisp($tpnamebill,"fetch");
unset($GLOBALS["smartytempdir"]);
return $contbill;
}
*/


?>
