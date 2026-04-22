<?php
# от сървъра : номер на исканете за справка от регистъра на длъжниците 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $page= текущата страница от списъка 
#    $getcoderequ - aadocuc2.id на искането 
# reload - след успешен събмит 
//print_rr($GETPARAM);


# данните 
$q2= getcertqu() ." where aadocuc2.id=$getcoderequ";
//var_dump($q2);
$data= $DB->select($q2);
//print_rr($data);
$rocont= $data[0];
//$smarty->assign("DATA", $rocont);
$smarty->assign("D2", tran1251($rocont));
//print_rr($rocont);

# линкове за бутони 
$linktose= geturl("mode=".$mode."&page=".$page  ."&getcoderequ=".$getcoderequ."&tose=yes");
$smarty->assign("LINKTOSE", $linktose);

# обработка 
$tose= $GETPARAM["tose"];
									$retucode= -11;
							if (0){
							
							}elseif($tose=="yes"){
							
	# подготовка 
	$paracall= tran1($rocont);
//print_rr($paracall);
	# към сървъра 
//		$rooffi= getofficerow(0);
//		$code= $rooffi["serial"];
	$arresu= toregi($codeexof,"createQueryRequest",$paracall);
//var_dump($arresu);
//print_rr($arresu);
//print_rr($client);
	# резултата 
		$recode= key($arresu);
		$coderequ= $arresu[$recode];
	if ($recode=="ok"){
//var_dump($arresu);
//var_dump($mess);
# получен номер-искане 
$smarty->assign("CODEREQU", tran1251($coderequ));
$DB->query("update aadocuc2 set coderequ='$coderequ' where id=?d"  ,$rocont["id"]);
	}else{
		$smarty->assign("MESS", $mess);
		$smarty->assign("ERTX", "<pre>".print_r($recont,true)."</pre>");
	}
							}else{
							
							}

/*
# резултат 
if ($retucode==0){
	# redirect 
	reload("parent",$relurl);
}else{
	# извеждаме формата 
	$smarty->assign("EDIT", $edit);
//	$smarty->assign("FILIST", $filist);
	print smdisp("cer2coderequ.ajax.tpl","iconv");
}
*/
# извеждаме 
$smarty->assign("EDIT", $edit);
//$smarty->assign("FILIST", $filist);
print smdisp("cer2coderequ.ajax.tpl","iconv");


# подготовка на данните 
function tran1($data){
//print_rr($data);
	$arcall= array();
	$arcall["payeetype"]= $data["idtype"];
	$arcall["payeename"]= $data["name"];
	$arcall["payeeegneik"]= $data["egneik"];
	$arcall["payeeinvoicerequest"]= $data["isinvo"];
	$arcall["querypersonname"]= $data["name2"];
			if ($data["idtype2"]==3){
				$qpegneik= $data["name2"];
				$qpforeign= 1;
			}else{
				$qpegneik= $data["param"];
				$qpforeign= 0;
			}
	$arcall["querypersonegneik"]= $qpegneik;
	$arcall["querypersonisforegnperson"]= $qpforeign;
			if ($data["isinvo"]==0){
			}else{
//				$invodata= unserialize(toutf8($data["invodata"]));
				$invodata= unserialize($data["invodata"]);
//				$invodata= tran1251($invodata);
//print_rr($invodata);
	$arcall["payeevatnumber"]= $invodata["invovat"];
	$arcall["payeecity"]= $invodata["invocity"];
	$arcall["payeeaddress"]= $invodata["invoaddr"];
	$arcall["payeemol"]= $invodata["invomol"];
			}
return $arcall;
}

?>