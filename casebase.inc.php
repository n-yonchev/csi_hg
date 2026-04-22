<?php
# 11.06.2009 - предупреждение за непълни основни данни 
# всички компоненти 


# php условие за проверката в момента - има ли грешка 
$basecode= "\$data['idrepo']==0 or \$data['idchar']==0";

# макс.стойност на брояча 
$basemaxi= "10";

# глобалния флаг за офиса 
$rooffi= getofficerow($iduser);
$isbasestatus= $rooffi["isbasestatus"]<>0;
//var_dump($isbasestatus);
$smarty->assign("ISBASESTATUS", $isbasestatus);


# проверява състоянието, записва статуса (брояча), вкл. при първо влизане в ново дело 
# вика се от списъка с дела 
function basecheck(&$data){
global $DB, $basecode, $basemaxi, $isbasestatus;
											if ($isbasestatus){
	$idcase= $data["id"];
	eval("\$result= ($basecode);");
	if ($result){
		# има грешка 
		if ($data["basestatus"]==""){
			# досегашния статус е няма грешка, възможни причини : 
			#     - нов запис 
			#     - сменено е условието : при предишното условие е нямало, сега вече има грешка 
			# записваме новия статус - има грешка - с макс.брой отваряния 
$DB->query("update suit set basestatus=?s where id=?d" ,$basemaxi,$idcase);
$data["basestatus"]= $basemaxi;
		}else{
		}
	}else{
		# няма грешка 
		if ($data["basestatus"]<>""){
			# досегашния статус е има грешка, възможни причини : 
			#     - сменено е условието : при предишното условие е имало, сега вече няма грешка 
			# записваме новия статус - няма грешка 
$DB->query("update suit set basestatus=?s where id=?d" ,"",$idcase);
$data["basestatus"]= "";
		}else{
		}
	}
											}else{
											}
}

# намалява брояча с единица 
function baseminus(&$data){
global $DB, $basecode, $basemaxi, $isbasestatus;
	# нормалното влизане е от списъка с дела, тогава тази проверка вече е изпълнена 
	# възможно е влизането директно от таб, а не от списъка с дела 
	# ако глобалния флаг е бил изключен и веднага след включването деловодителя влиза направо от таба 
	# - проверката не е изпълнена, затова я извикваме 
	basecheck($data);
											if ($isbasestatus){
	$idcase= $data["id"];
	eval("\$result= ($basecode);");
	if ($result){
		# има грешка 
		# намаляваме брояча 
		$coun= $data["basestatus"];
		$coun= ($coun==0) ? $coun : $coun-1;
$DB->query("update suit set basestatus=?s where id=?d" ,$coun,$idcase);
$data["basestatus"]= $coun;
	}else{
		# няма грешка 
	}
											}else{
											}
}


?>
