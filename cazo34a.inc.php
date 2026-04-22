<?php

# полетата 
$filist= array(
	"idtype"=>  array("validator"=>"notzero", "error"=>"типа е задължително поле")
# за всички типове 
	,"name"=>  array("validator"=>"notempty", "error"=>"името не може да е празно")
	,"address"=>  NULL
	,"agent"=>  NULL
# само за физич.лице 
//	,"egn"=>  array("validator"=>"notempty", "error"=>"ЕГН не може да е празно")
	,"egn"=>  NULL
# само за юридич.лице 
	,"bulstat"=>  NULL
	,"regidocu"=>  NULL
	,"regidate"=>  NULL
	,"regicase"=>  NULL
# само за взискател 
	,"regipers"=>  NULL
	,"regipersegn"=>  NULL
# само за взискател 
	,"iban"=>  NULL
//////	,"bic"=>  NULL
# само за физич.лице - Бъзински - 29.05.2009 
# дани за съпруг 
,"name2"=> NULL
,"egn2"=>  NULL
,"address2"=>  NULL
# 12.01.2010 - коментар 
,"notes"=>  NULL
);
			# 20.04.2011 - флаг присъединен взискател 
			if ($isclaimer){
$filist["isjoin"]= NULL;
			}else{
			# 11.10.2011 - съотв. флаг длъжника да не се предава в регистъра 
$filist["isnoregi"]= NULL;
			}
# константни полета 
$ficonst= array("idcase"=>$edit);

?>