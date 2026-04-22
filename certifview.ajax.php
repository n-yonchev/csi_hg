<?php
# към регистъра - удостоверение за вписване на произволен адресат - queryDebtor 
# отгоре : 
#    $mode= режима в глав.меню 
#    $page= текущата страница от списъка 
# управляващ : 
#    $view - молбата за удостоверение docu.id, удостоверението е в aadocucert 
//print_rr($GETPARAM);
//var_dump($tpname);
//print "[$mode][$page][$princert]";

				sleep(1);

# данните 
$myquery= getcertqu() ." where iddocu=$view";
$data= $DB->select($myquery);
$smarty->assign("ADRESAT", tran1251($data[0]["adresat"]));
//print_rr($data);

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
/*****
$_SESSION["REGICERTIF"]= $co3;
				$modeel= "mode=".$mode."&page=".$page;
				$toword= geturl($modeel."&word=".$view);
$smarty->assign("TOWORD", $toword);
*****/
# 15.07.2011 - само запомняме отговора от сървъра 
$aset= array();
$aset["response"]= serialize($co3);
$DB->query("update aadocucert set ?a, resptime=now() where iddocu=?d"  ,$aset,$view);
# redirect - към разглеждане на резултата 
$relurl= geturl("mode=".$mode."&page=".$page."&resp=".$view  ."&fromview=yes");
//$relurl= geturl("mode=".$mode."&page=".$page."&resp=".$view);
//print "reload="  .("mode=".$mode."&page=".$page."&word=".$view);
reload("",$relurl);
	}else{
//$smarty->assign("ARCONT", array($mess,$recont));
$smarty->assign("MESS", $mess);
$smarty->assign("ERCONT", $recont);
	}

# извеждаме 
////////$tpname= "certifview.ajax.tpl";
print smdisp($tpname,"iconv");
//	$pagecont= smdisp($tpname,"iconv");


function tranregi($data){
						$arbank= getselect("banklist","name","1",true);
	$arcall= array();
	$arcall["enterDocDate"]= $data["dateapplic"];
	$arcall["enterDocNumber"]= $data["serial"];
	$arcall["exitDocDate"]= $data["dateout"];
	$arcall["exitDocNumber"]= $data["seriout"];
	$arcall["payee"]= $data["taxname"];
	$arcall["payDate"]= $data["taxdate"];
	$arcall["payBank"]= trim($arbank[$idbank=$data["idtaxbank"]]);
	$arcall["payNum"]= $data["taxrefe"];
				# certifedit.ajax.php - $listty 
				$idtype2= $data["idtype2"];
/***
				if ($idtype2==7){
	$arcall["isForeignPerson"]= 1;
	$arcall["queryParam"]= "";
	$arcall["personName"]= $data["param"];
				}else{
	$arcall["isForeignPerson"]= 0;
	$arcall["queryParam"]= $data["param"];
//	$arcall["personName"]= "";
	$arcall["personName"]= $data["param"];
				}
***/
	# 25.08.2011 
				if ($idtype2==7){
	$arcall["isForeignPerson"]= 1;
	$arcall["queryParam"]= $data["param"];
	$arcall["personName"]= $data["adresat"];
				}else{
	$arcall["isForeignPerson"]= 0;
	$arcall["queryParam"]= $data["param"];
	$arcall["personName"]= $data["adresat"];
				}
	# 05.10.2011 
	$arcall= arstrip($arcall);
			$ar1= array("\"","'","!","\$");
			$ar2= array(" "," "," "," ");
	$arcall["personName"]= str_replace($ar1,$ar2, $arcall["personName"]);
return $arcall;
}

?>