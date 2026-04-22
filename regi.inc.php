<?php

# резулт.заглавия 
$arcall= array();
$arcall["e1"]= "грешка-1";
$arcall["e2"]= "грешка-2";
$arcall["e3"]= "грешка-3";
$arcall["ok"]= "резултат";
# резулт.файлове 
$arfina= array();
$arfina["e1"]= "_err1.txt";
$arfina["e2"]= "_fault.txt";
$arfina["e3"]= "_error.txt";
$arfina["ok"]= "_result.txt";
# резулт.текстове 
$armess= array();
$armess["e1"]= "ERR1";
$armess["e2"]= "FAULT";
$armess["e3"]= "ERROR";
$armess["ok"]= "OK";

function toregi($code,$name,$para){
global $DB;
//				$rooffi= getofficerow(0);
//				$code= $rooffi["serial"];
	$pref= dirname(__FILE__);
//	$pref .=  "/regicert"."/registry-enforcer-" .$code;
	$pref .=  "/regicont"."/registry-enforcer-" .$code;
	$cert = $pref .'.crt';
	$private = $pref .'.key';
	//$cacert = $pref .'.p12';
    $cacert = dirname(__FILE__) . '/regicont' . '/ca.crt';
//var_dump($cacert);
		$urlwsdl = 'https://registry.bcpea.org/soap.php?wsdl';
		$url = 'https://registry.bcpea.org/soap.php';
	ini_set("soap.wsdl_cache_enabled", "0");

global $client;
	$client= new nusoap_client($urlwsdl, true);
    $client->setCurlOption(CURLOPT_SSLVERSION, 3);
//var_dump($client);
	$client->response_timeout = 3000;
	$client->timeout = 3000;
$certRequest = array(
      'sslcertfile' => $cert
      ,'sslcacert' => $cacert
      ,'sslkeyfile' => $private
      ,'verifyhost' => 0
      ,'verifypeer' => 0
);
	$result= $client->setCredentials(null, null, 'certificate', $certRequest);
//print_rr($client);
	$err = $client->getError();
//++++++++++++++$err= "MYER=NENO";
	if($err){
$retu= array("e1"=>$err);
	}else{
		$result = $client->call($name,$para);
		if ($client->fault) {
$retuelem= print_r($result,true);
$retuelem= "<pre>" .$retuelem ."</pre>";
$retu= array("e2"=>$retuelem);
		}else{
		    $err = $client->getError();
		    if ($err) {
$retu= array("e3"=>$err);
		    }else{
//$retuelem= print_r($result,true);
$retuelem= $result;
//$retuelem= "<pre>" .$retuelem ."</pre>";
$retu= array("ok"=>$retuelem);
		    }
		} 
	}
//print_rr($client->operations);
return $retu;

}


?>