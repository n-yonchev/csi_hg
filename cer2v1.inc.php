<?php
# действия за справка от регистъра на длъжниците 
# етап-1 : вземи данните от сървъра за номер-искане 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
//# $relurl - след успешен събмит 
//# $modeel - базов стринг за събмит 
# $modeinc - базов стринг за събмит 
# $reloinc - след успешен събмит - линк за следващ етап 
#    $code - =номер-искане 
#    $vari=1 - текущо действие 
# $roc2 - прочетен ред за искането 
//print_rr($GETPARAM);
//print_rr($_POST);


//# номер-искане 
//$smarty->assign("CODE", $code);

# действие 
							$tose= $GETPARAM["tose"];
							if (isset($tose)){

	# към сървъра 
	$arpara= array("queryrequestclientid"=>toutf8($code));
	$arresu= toregi($codeexof,"getQueryRequestData",$arpara);
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
$arresu= json_decode($co2,true);
//print_rr($arresu);
								if ($arresu["isactive"]==0){
# неактивно 
$smarty->assign("VARI", 3);
								}else{
		# записваме данните от сървъра 
		$aset= array();
		$aset["iduser"]= $_SESSION["iduser"];
		$aset["idtype"]= $arresu["payeetype"];
		$aset["name"]= $arresu["payeename"];
		$aset["egneik"]= $arresu["payeeegneik"];
		$aset["isinvo"]= $arresu["payeeinvoicerequest"];
			if ($aset["isinvo"]==0){
		$aset["invodata"]= "";
			}else{
//print_rr($arresu);
				$arinvo= array();
				$arinvo["invovat"]= $arresu["payeevatnumber"];
				$arinvo["invocity"]= $arresu["payeecity"];
				$arinvo["invoaddr"]= $arresu["payeeaddress"];
				$arinvo["invomol"]= $arresu["payeemol"];
//print_rr($arinvo);
				$invodata= serialize($arinvo);
//var_dump($invodata);
		$aset["invodata"]= $invodata;
			}
		$aset["name2"]= $arresu["querypersonname"];
		$aset["param"]= $arresu["querypersonegneik"];
			if ($arresu["querypersonforeignperson"]==0){
				if(strlen($aset["param"])==10){
		# физическо 
		$aset["idtype2"]= 1;
				}else{
		# юридическо 
		$aset["idtype2"]= 2;
				}
			}else{
		# чужд 
		$aset["idtype2"]= 3;
			}
		$aset["coderequ"]= toutf8($code);
		# islocal остава същото 
		//$aset["islocal"]= 0;
		# искането проверено 
		$aset["isveri"]= 1;
		# запис 
//print_rr($aset);
		if (empty($roc2)){
			$DB->query("insert into aadocuc2 set ?a, created=now(), lastmodi=now()" ,$aset);
		}else{
			$DB->query("update aadocuc2 set ?a, created=now(), lastmodi=now() where id=?d" ,$aset,$roc2["id"]);
		}
# край - следващ етап 
reload("",$reloinc);
								# if ($arresu["isactive"]==0){
								}
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
print smdisp("cer2v1.inc.tpl","iconv");

?>