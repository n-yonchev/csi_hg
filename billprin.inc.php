<?php
										include_once "invo2.inc.php";

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
							# 16.01.2014 избор на сметка на ЧСИ като съставител 
						global $aracco;
							$iban= $robill["iban"];
							if (empty($iban) or $iban==$billpa["iban"]){
							}else{
$rooffi["iban"]= $iban;
$rooffi["bic"]= $aracco[$iban]["bic"];
$rooffi["bank"]= tran1251($aracco[$iban]["bank"]);
							}
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
						# 29.02.2012 - флаг за ДДС 
						if ($robill["isvat"]==0){
	$svat= 0;
						}else{
	$svat= round(0.2*$suma ,2);
						}
	$tota= $suma + $svat;
$smarty->assign("SUMA", array("suma"=>$suma, "svat"=>$svat, "tota"=>$tota
, "paid"=>$robill["paid"]));

//	list($c1,$c2)= explode(".",$tota);
	list($c1,$c2)= explode(".",$robill["paid"]);
					include_once "SLOVOM.php";
	if(strtotime($robill['date']) < strtotime('2026-01-01')) {
		$slovom= slovom($c1,$c2, ' лева и ', 'ст.');
	} else {
		$slovom= slovom($c1,$c2);
	}
//	$slovom= toutf8($slovom);
$smarty->assign("SLOVOM", $slovom);

$GLOBALS["smartytempdir"]= "outgoing/";
$contbill= smdisp($tpnamebill,"fetch");
unset($GLOBALS["smartytempdir"]);
return stripslashes($contbill);
}


?>