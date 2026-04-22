<?php
# 16.01.2014 - допълнителни функции за фактурата - от В.Петров Ловеч 


# списък на сметките за фактура 
# $ibaninit - глобалния iban за сметките и фактурите 
$aracco= getaccolist();
///print_rr($aracco);
list($araccosele,$ibaninit)= getaccosele($aracco);
//print_rr($araccosele);
$smarty->assign("ARACCO", tran1251($araccosele));
$smarty->assign("ARSELENAME", "araccosele");


function getaccolist(){
global $rooffi;
	if (isset($rooffi)){
	}else{
		$rooffi= getofficerow(1);
	}
	$rooffi= toutf8($rooffi);
	# всички сметки 
	$aracco= unserialize($rooffi["accolist"]);
//print_rr($aracco);
			$ar2= array();
	foreach($aracco as $elem){
		$iban= $elem["iban"];
			$ar2[$iban]["desc"]= $elem["desc"];
			$ar2[$iban]["bic"]= $elem["bic"];
			$ar2[$iban]["bank"]= $elem["bank"];
	}
	# сметката за фактури 
	$arbill= unserialize($rooffi["billparams"]);
//print_rr($arbill);
	$iban= $arbill["iban"];
	if (isset($ar2[$iban])){
	}else{
			$ar2[$iban]["desc"]= toutf8("за сметките и фактурите");
			$ar2[$iban]["bic"]= $arbill["bic"];
			$ar2[$iban]["bank"]= $arbill["bank"];
	}
			$ar2[$iban]["isinit"]= true;
//print_rr($ar2);
return $ar2;
}

function getaccosele($aracco){
				$arsele= array();
				$ibaninit= "";
	foreach($aracco as $iban=>$elem){
				$arsele[$iban]= $iban." ".$elem["desc"];
		if ($elem["isinit"]){
				$ibaninit= $iban;
		}else{
		}
	}
	$arsele= array(""=>"")+$arsele;
return array($arsele,$ibaninit);
}

?>