<?php
# действия с готов номер-искане за справка от регистъра на длъжниците 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $codeto - =номер-искане 
# $relurl - след успешен събмит 
# $modeel - базов стринг за събмит 
print_rr($GETPARAM);
//print_rr($_POST);


# номер-искане 
$smarty->assign("CODE", $codeto);
$roc2= $DB->selectRow("select * from aadocuc2 where coderequ=?"  ,toutf8($codeto));
	$roc2= dbconv($roc2);
$smarty->assign("ROC2", $roc2);
$smarty->assign("ISLO", $roc2["islocal"]==1);
	$arinvo= unserialize(toutf8($roc2["invodata"]));
//print_ru($arinvo);
$smarty->assign("INVO", tran1251($arinvo));

# шаблона 
$tpname= "cer2codeto.ajax.tpl";

//$codeto= toutf8($codeto);
//var_dump($codeto);

# обработка 
$tose= $GETPARAM["tose"];
$crea= $GETPARAM["crea"];
									$retucode= -11;
							if (0){
							
							}elseif($tose=="yes"){
/***
	# към сървъра 
	$arresu= toregi($codeexof,"getQueryRequestData",$codeto);
//var_dump($arresu);
//print_rr($arresu);
//print_rr($client);
	# резултата 
		$recode= key($arresu);
		$recont= $arresu[$recode];
	$mess= $arcall[$recode];
***/
					/**/
						$recode= "ok";
						$arresu= array(
							"queryrequestclient" => "РД555555ИО"
							,"payeetype" => 1
							,"payeeinvoicerequest" => 1
							,"payeename" => "Стефан Иванов Димитров"
							,"payeeegneik" => "7601011234"
								,"payeeevatnumber" => "BG7601011234"
								,"payeeecity" => "София"
								,"payeeeaddress" => "ул.Незабравка 1"
								,"payeeemol" => "Иван Иванов"
							,"querypersonname" => "Иван Иванов"
							,"querypersonegneik" => "7601011234"
							,"querypersonforeignperson" => 0
							);
$_SESSION["cer2servdata"]= $arresu;
					/**/
//						$smarty->assign("ARSERV", $arresu);
//						$smarty->assign("ISINVO", $arresu["payeeinvoicerequest"]==1);
	if ($recode=="ok"){
//var_dump($arresu);
$smarty->assign("VARI", 3);
//		print_ru($roc2);
//		print_ru($arresu);
							//$linkgetdoc= geturl($modeel  ."&codeto=".$codeto."&getdoc=yes");
							//$smarty->assign("LINKGETDOC", $linkgetdoc);
		#--------------------------------------------------------------------------------
		$linkcrea= geturl($modeel  ."&codeto=".$codeto."&crea=yes");
reload("",$linkcrea);
	}else{
$smarty->assign("VARI", 2);
		$smarty->assign("MESS", $mess);
		$smarty->assign("ERTX", "<pre>".print_r($recont,true)."</pre>");
	}
							
							}elseif($crea=="yes"){

$arresu= $_SESSION["cer2servdata"];
//print_ru($arresu);
$smarty->assign("ARSERV", $arresu);
$smarty->assign("ISINVO", $arresu["payeeinvoicerequest"]==1);
$smarty->assign("VARI", 4);
	include "cer2crea.inc.php";
if ($retucode==0){
print "GOO TOO VOO";
}else{
}

							}else{
# начало 
$smarty->assign("VARI", 1);
//print smdisp($tpname,"iconv");
$linktose= geturl($modeel  ."&codeto=".$codeto."&tose=yes");
$smarty->assign("LINKTOSE", $linktose);

							}

# извеждане 
print smdisp($tpname,"iconv");


?>