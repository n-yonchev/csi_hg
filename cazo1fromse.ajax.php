<?php

									session_start();
									include_once "common.php";

$idcase=$_GET["e"];

$rocase= getrow("suit",$idcase);
$caseyear= $rocase["year"];
$caseseri= $rocase["serial"];
						
						include_once $reg4path."reg4.inc.php";
//						reg4start($idcase);

/**/
//sleep(1);
# предаване 
# източник : cazo34reg4.ajax.php - съвпадение на длъжник 
//print "waiting...";
$reg4resu= reg4toserv("getCase",array($caseyear,$caseseri));
						if (is_array($reg4resu)){
////print_rr($reg4resu);
							if (empty($reg4resu)){
$smarty->assign("MESS", "на сървъра няма данни за това дело");
							}elseif (isset($reg4resu["e0"])){
$smarty->assign("MESS", "грешка-SoapClient");
							}elseif (isset($reg4resu["e1"])){
$smarty->assign("MESS", "грешка-автентикация");
							}elseif (isset($reg4resu["e2"])){
$smarty->assign("MESS", "грешка-метод");
							}else{
/*
//$smarty->assign("ARRESU", tran1251($reg4resu));
	$reg4resu["case"]= $reg4resu["case"] + $reg4resu["origins"];
	unset($reg4resu["origins"]);
//$smarty->assign("ARRESU", "<pre>".print_r(tran1251($reg4resu),true)."</pre>");
//$smarty->assign("ARRESU", tran1251($reg4resu));
*/
#----------------------------------------------------
	# трансформация 
	$reg4resu["case"]= $reg4resu["case"] + $reg4resu["origins"];
		unset($reg4resu["origins"]);
//	$reg4resu["case"]["casenumb"]= $reg4resu["case"]["number"]."/".$reg4resu["case"]["year"];
	$casenumb= $reg4resu["case"]["number"]."/".$reg4resu["case"]["year"];
	$reg4resu["case"]= array("casenumb"=>$casenumb) + $reg4resu["case"];
		unset($reg4resu["case"]["year"]);
		unset($reg4resu["case"]["number"]);
	foreach($reg4resu["case"] as $fina=>$fico){
		if (strpos($fina,"date")===false or empty($fico)){
		}else{
			$reg4resu["case"][$fina]= bgdatefrom($fico);
		}
	}
//print_rr($arresu);
//$smarty->assign("ARRESU", "<pre>".print_r(tran1251($reg4resu),true)."</pre>");
//file_put_contents("FROMSE.TXT", "<pre>".print_r(tran1251($reg4resu),true)."</pre>");
$smarty->assign("ARRESU", tran1251($reg4resu));
			# текстове 
			$artxcase= array(
				"casenumb"=> "дело"
				,"start_date"=> "образувано"
				,"stop_date"=> "спряно"
				,"finish_date"=> "прекратено"
				,"terminate_date"=> "свършено"
				,"renewal_date"=> "възобновено"
				,"send_date"=> "изпратено"
					,"type"=> "тип вземане"
					,"kind"=> "вид вземане"
					,"origin"=> "произход вземане"
				);
$smarty->assign("ARTXCASE", $artxcase);
			$artxpers= array(
				"name"=> "име лице/фирма"
				,"egn_eik"=> "ЕГН/ЕИК"
				,"type"=> "страна"
				,"client_type"=> "тип"
//				,"company_name"=> "име фирма"
				,"foreigner"=> "чужд"
				,"country_code"=> "държ"
				);
$smarty->assign("ARTXPERS", $artxpers);
#----------------------------------------------------
							}
						}else{
var_dump($reg4resu);
die("ERROR=getCase");
						}

# извеждане 
$contreg4= smdisp("cazo1fromse.ajax.tpl","iconv");
/**/


//print "ok^$idcase";
//print "ok^$caseyear/$caseseri";
print "ok^$contreg4";

?>