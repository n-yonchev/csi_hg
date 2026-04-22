<?php
# отгоре : 
#    $reg4 - длъжника debtor.id 

				sleep(1);

# подготовка 
$rodebt= getrow("debtor",$reg4);
$smarty->assign("DEBTNAME", $rodebt["name"]);
$r4name= arstrip($rodebt[""]);
$r4code= "";
	$r4type= $rodebt["idtype"];
	if ($r4type==1){
$r4code= $rodebt["bulstat"];
	}elseif ($r4type==2){
$r4code= $rodebt["egn"];
	}else{
	}
$reg4data= array($r4name,$r4code);
$reg4data= toutf8($reg4data);
								
								include_once $reg4path."reg4.inc.php";

# предаване 
//print "waiting...";
$reg4resu= reg4toserv("getDebtor",$reg4data);
//print_rr($reg4resu);
						if (is_array($reg4resu)){
////print_rr($reg4resu);
							if (empty($reg4resu)){
//$smarty->assign("MESS", "няма съвпадения");
							}elseif (isset($reg4resu["e0"])){
//$smarty->assign("MESS", "грешка-SoapClient");
$smarty->assign("MESS", "грешка-SoapClient" ."<br><br>" .$reg4resu["ertext"]);
							}elseif (isset($reg4resu["e1"])){
$smarty->assign("MESS", "грешка-автентикация");
							}elseif (isset($reg4resu["e2"])){
$smarty->assign("MESS", "грешка-метод");
							}elseif (isset($reg4resu["message"])){
$smarty->assign("MESS", "грешка от сървъра" ."<br><br>" .tran1251($reg4resu["message"]));
							}else{
$smarty->assign("ARRESU", tran1251($reg4resu));
							}
						}else{
var_dump($reg4resu);
die("ERROR=getDebtor");
						}

# извеждане 
print smdisp("cazo34reg4.ajax.tpl","iconv");


?>