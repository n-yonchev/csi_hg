<?php
# резултат от послед.обръщения към към регистъра - 
# удостоверение за вписване на произволен адресат - queryDebtor 
# отгоре : 
#    $mode= режима в глав.меню 
#    $page= текущата страница от списъка 
# управляващ : 
#    $resp - молбата за удостоверение docu.id, удостоверението е в aadocucert 
//print_r($GETPARAM);
//print "[$mode][$page][$princert]";

				sleep(1);

$fromview= $GETPARAM["fromview"]=="yes";
$smarty->assign("FROMVIEW", $fromview);

# данните 
$myquery= getcertqu() ." where iddocu=$resp";
$data= $DB->select($myquery);
$smarty->assign("ADRESAT", tran1251($data[0]["adresat"]));
//print_rr($data);

/*****
//# обекта за предаване 
								include_once "regicert/nusoap.php";
							//	include_once "regi.inc.php";
								include_once "reg2.inc.php";

# предаваме 
	$paracall= tranregi($data[0]);
//print_rr($paracall);
				$rooffi= getofficerow(0);
				$code= $rooffi["serial"];
$arresu= toregi($code,"queryDebtor",$paracall);
//print_rr($arresu);
////////$arresu= array("e3"=> "ERRORRRRRRRRRRRRR");
# резултата 
	$recode= key($arresu);
	$recont= $arresu[$recode];
//$recode= "ok";
//$recont= "AAAAAAA";
	$mess= $arcall[$recode];
	if ($recode=="ok"){
		$co2= base64_decode($recont);
//var_dump($co2);
		$co3= json_decode($co2,true);
//var_dump($co3);
//print_rr($co3);
		$co4= print_r($co3,true);
//$smarty->assign("ARCONT", array($mess, "<pre>".tran1251($co4)."</pre>"));
							$smarty->assign("OKRESU", "<pre>".tran1251($co4)."</pre>");
$smarty->assign("MESS", $mess);
////////$co3["QueryResult"]= array();
$smarty->assign("QURESU", tran1251($co3["QueryResult"]));
# 15.07.2011 - само запомняме отговора от сървъра 
$aset= array();
$aset["response"]= serialize($co3);
$DB->query("update aadocucert set ?a, resptime=now() where iddocu=?d"  ,$aset,$resp);
# redirect - към разглеждане на резултата 
$relurl= geturl("mode=".$mode."&page=".$page."&resp=".$resp);
//print "reload="  .("mode=".$mode."&page=".$page."&word=".$view);
reload("",$relurl);
	}else{
//$smarty->assign("ARCONT", array($mess,$recont));
$smarty->assign("MESS", $mess);
$smarty->assign("ERCONT", $recont);
	}
*****/

# отговора 
$response=  unserialize($data[0]["response"]);
$smarty->assign("QURESU", tran1251($response["QueryResult"]));

# документа автоматично 
			$modeel= "mode=".$mode."&page=".$page;
			$toword= geturl($modeel."&word=".$resp);
$smarty->assign("TOWORD", $toword);

# извеждаме 
$tpname= "certifresp.ajax.tpl";
print smdisp($tpname,"iconv");
//	$pagecont= smdisp($tpname,"iconv");


?>