<?php
# действия за справка от регистъра на длъжниците 
# етап-4 : получване от сървъра фактурата за номер-искане 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
//# $relurl - след успешен събмит 
//# $modeel - базов стринг за събмит 
# $modeinc - базов стринг за събмит 
# $reloinc - след успешен събмит - линк за следващ етап 
#    $code - =номер-искане 
#    $vari=4 - текущо действие 
# $roc2 - прочетен ред за искането 
//print_rr($GETPARAM);
//print_rr($_POST);


//# номер-искане 
//$smarty->assign("CODE", $code);

# вх/изх номера 
$rodocu= getrow("docu",$roc2["iddocu"]);
$rodocuout= getrow("docuout",$roc2["iddocuout"]);
	$num1= $rodocu["serial"]."/".$rodocu["year"];
	$num2= $rodocuout["serial"]."/".$rodocuout["year"];
$smarty->assign("DOCU", $num1);
$smarty->assign("DOUT", $num2);

# действие 
							$tose= $GETPARAM["tose"];
							if (isset($tose)){
	# към сървъра 
	$arpara= array();
	$arpara= array("queryrequestclientid"=>toutf8($code));
/*
	$arpara["enterDocNumber"]= $rodocu["serial"];
	$arpara["enterDocDate"]= bgdatefrom(substr($rodocu["created"],0,10));
	$arpara["exitDocNumber"]= $rodocuout["serial"];
	$arpara["exitDocDate"]= bgdatefrom(substr($rodocuout["registered"],0,10));
	$arpara["queryrequestclientid"]= toutf8($code);
*/
	$arresu= toregi($codeexof,"getQueryRequestInvoiceData",$arpara);
//var_dump($arresu);
//print_rr($arresu);
//print_rr($client);
	# резултата 
		$recode= key($arresu);
		$recont= $arresu[$recode];
//var_dump($recont);
	$mess= $arcall[$recode];

	if ($recode=="ok"){
$co2= base64_decode($recont);
		# записваме получения файл .pdf 
		$pdfname= sprintf($tempinvoname,$roc2["id"]);
		$putres= file_put_contents($pdfname,$co2);
if ($putres===false){
	die("pdf-write-error");
}else{
}
		# записваме данните от сървъра 
		$aset= array();
		$aset["isinvodown"]= 1;
		$DB->query("update aadocuc2 set ?a where id=?d" ,$aset,$roc2["id"]);
# край - следващ етап 
reload("",$reloinc);
	}else{
$smarty->assign("VARI", 2);
		$smarty->assign("MESS", $mess);
		$smarty->assign("ERTX", "<pre>".print_r(tran1251($recont),true)."</pre>");
	}
							# if (isset($tose)){
							}else{
# начало 
$smarty->assign("VARI", 1);
							}

# линк към сървъра 
$linktose= geturl($modeinc ."&tose=yes");
$smarty->assign("LINKTOSE", $linktose);

# извеждане 
print smdisp("cer2v4.inc.tpl","iconv");

?>