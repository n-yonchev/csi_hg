<?php
# към регистъра - заявка за съвпадение на длъжник - queryMyDebtor 
# отгоре : 
#    $mode= режима в глав.меню 
#    $page= текущата страница от списъка 
# управляващ : 
#    $regi - длъжник debtor.id 
//print_r($GETPARAM);
//print "[$mode][$page][$princert]";

				sleep(1);

# данните 
//$myquery= getcertqu() ." where iddocu=$view";
//$data= $DB->select($myquery);
//print_rr($data);
$rodebt= getrow("debtor",$regi);
$smarty->assign("DEBTNAME", $rodebt["name"]);

//# обекта за предаване 
								include_once "regicert/nusoap.php";
							//	include_once "regi.inc.php";
								include_once "reg2.inc.php";

# предаваме 
	$paracall= tranregi($rodebt);
//print "paracell=";
//print_rr($paracall);
				$rooffi= getofficerow(0);
				$code= $rooffi["serial"];
$arresu= toregi($code,"queryMyDebtor",$paracall);
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
							//$smarty->assign("OKRESU", "<pre>".tran1251($co4)."</pre>");
		$smarty->assign("OKLIST", tran1251($co3));
		$smarty->assign("OKCOUN", count($co3));
$smarty->assign("MESS", $mess);
////////$co3["QueryResult"]= array();
////////$smarty->assign("QURESU", tran1251($co3["QueryResult"]));
	}else{
//$smarty->assign("ARCONT", array($mess,$recont));
$smarty->assign("MESS", $mess);
$smarty->assign("ERCONT", $recont);
	}

# извеждаме 
//$smarty->assign("CONT", $contcert);
$tpname= "cazo34regi.ajax.tpl";
print smdisp($tpname,"iconv");
//	$pagecont= smdisp($tpname,"iconv");


function tranregi($data){
		$data= arstrip($data);
		$idtype= $data["idtype"];
		if (empty($data["exdata"])){
			$ardata= array();
		}else{
			$ardata= unserialize($data["exdata"]);
		}
				if ($idtype==1){
	$qpar= $data["bulstat"];
	$isfo= "0";
				}elseif ($idtype==2){
					if ($ardata["t2fo"]==0){
	$qpar= $data["egn"];
	$isfo= "0";
					}else{
	$qpar= $data["name"];
	$isfo= "1";
					}
				}else{
	$qpar= "";
	$isfo= "0";
				}

	$arcall= array();
	$arcall["query"]= $qpar;
	$arcall["isForeignPerson"]= $isfo;
return toutf8($arcall);
}

?>