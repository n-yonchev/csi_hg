<?php

/*
#-------------------------- ЗА ТЕСТОВЕТЕ --------------------------
# година за документите 
$docuyear= 2000;
# адрес на сървъра 
$urlserver= "https://test-registry.enforcer.bg/soap.php?wsdl";
//$urlserver= "https://test-registry.enforcer.bg/soap.php";
//$urlserver= "http://test-registry.enforcer.bg?wsdl";
//$urlserver= "https://test-registry.enforcer.bg";
*/

/**/
#-------------------------- РЕАЛНО --------------------------
# година за документите 
$docuyear= (int) date("Y");
# адрес на сървъра 
$urlserver= "https://registry.bcpea.org/soap.php?wsdl";
/**/

# код на ЧСИ 
$rooffi= getofficerow(0);
$codeexof= $rooffi["serial"];

# константа - aadocutype.mode за удостоверение 
$MODECERT= "cere";

# шаблон за име на фактура 
//$tempinvoname= "docs/%s.pdf";
$tempinvoname= "pdfs/%s.pdf";

# типове лице за подател 
$listpatype= array();
$listpatype[1]= "физическо лице";
$listpatype[2]= "юридическо лице";
$smarty->assign("ARTYPE", $listpatype);
/*
# типове данни за лицето по справката 
$listty= array();
$listty[5]= "egn";
$listty[6]= "eik";
$listty[7]= "foname";
*/
# полета за евент.фактура 
$fiinvo= array("invovat","invocity","invoaddr","invomol");



# резулт.заглавия 
$arcall= array();
$arcall["e1"]= "грешка-1";
$arcall["e2"]= "грешка-2";
$arcall["e3"]= "грешка-3";
$arcall["ok"]= "резултат";
/*
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
*/

function toregi($code,$name,$para){
global $DB;
//print "tose=[$code][$name][$para]";
	$pref= dirname(__FILE__);
	$pref .=  "/regicont"."/registry-enforcer-" .$code;
/*
	$cert = $pref .'.crt';
	$private = $pref .'.key';
//	$cacert = $pref .'.p12';
	$cacert = $pref .'/regicont/ca.crt';
//var_dump($cacert);
//+++++++++++++++		$urlwsdl = 'https://registry.bcpea.org/soap.php?wsdl';
//+++++++++++++++		$url = 'https://registry.bcpea.org/soap.php';
*/
	ini_set("soap.wsdl_cache_enabled", "0");
global $client;
//+++++++++++++++	$client= new nusoap_client($urlwsdl, true);
global $urlserver;
	$client= new nusoap_client($urlserver, true);
    $client->setCurlOption(CURLOPT_SSLVERSION, 3);
//var_dump($client);
//print_rr($client);
	$client->response_timeout = 3000;
	$client->timeout = 3000;
$certRequest = array(
	'sslcertfile' => $pref.$regi .".crt"
//	,'sslcacert' => $pref ."/ca.crt"
	,'sslkeyfile' => $pref.$regi .".key"
	,'verifyhost' => 0
	,'verifypeer' => 0
/*
      'sslcertfile' => $cert
      ,'sslcacert' => $cacert
      ,'sslkeyfile' => $private
      ,'verifyhost' => 0
      ,'verifypeer' => 0
*/
);
	$result= $client->setCredentials(null, null, 'certificate', $certRequest);
//print_rr($client);
	$err = $client->getError();
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



function getcertqu(){
return "
	select aadocuc2.*, aadocuc2.id as id
			,docu.serial as docuseri ,docu.year as docuyear
			,docuout.serial as outseri ,docuout.year as outyear ,date(docuout.created) as outdate
			,docuout.adresat as adresat ,docuout.descrip as descrip 
					,u2.name as creaname
					,u3.name as lastname
	from aadocuc2 
			left join docu on aadocuc2.iddocu= docu.id
			left join docuout on aadocuc2.iddocuout= docuout.id
					left join user as u2 on aadocuc2.iduser=u2.id
					left join user as u3 on aadocuc2.iduser=u3.id
	";
/*****
return "
	select docu.* ,aadocucert.* 
			,docu.id as id ,aadocucert.id as idcert
					,u2.name as u2name
					,u3.name as lastname
			,docuout.id as iddocuout
			,docuout.adresat as adresat ,docuout.descrip as descrip 
			,docuout.serial as seriout ,docuout.year as yearout ,date(docuout.created) as dateout
					,aadocutype.id as ddtype
	from docu
			left join aadocutype on docu.idtype=aadocutype.id
			left join aadocucert on aadocucert.iddocu=docu.id
					left join user as u2 on docu.iduser=u2.id
					left join user as u3 on aadocucert.iduser2=u3.id
			left join docuout on aadocucert.iddocuout=docuout.id
";
*****/
}

	
# връща вариант за предстоящото действие 
#    =0 - няма предстоящо действие 
#    =1 - получи номер искане от сървъра 
#    =2 - създай входящ и изх.документ 
#    =3 - получи справката от сървъра 
#    =4 - получи фактура от сървъра 
//function getvari($para){
function getvari($ardata){
global $DB;
/*
						if (is_array($para)){
	$ardata= $para;
						}else{
	$roc2= $DB->selectRow("select * from aadocuc2 where coderequ=?"  ,toutf8($para));
	if (empty($roc2)){
return 1;
	}else{
		$ardata= $roc2;
	}
						}
*/
	if (0){
	}elseif (empty($ardata["coderequ"])){
return 0;
	}elseif ($ardata["isveri"]==0){
return 1;
	}elseif ($ardata["iddocu"]==0){
return 2;
	}else{
		if ($ardata["response"]==""){
return 3;
		}else{
			if ($ardata["isinvo"]==0){
return 0;
			}else{
				if ($ardata["isinvodown"]==0){
return 4;
				}else{
return 5;
				}
/*
				$invoname= sprintf($GLOBALS["tempinvoname"],$ardata["id"]);
				if (file_exists($invoname)){
return 0;
				}else{
return 4;
				}
*/
			}
		}
	}
}


?>