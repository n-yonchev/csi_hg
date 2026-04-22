<?php
# търсене на вх.документ по въвел - избора и списъка заедно 
#    вика се в основния прозорец, а не в ajax 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
# още : 
#    $view - деловодителя = user.id 
//print_r($GETPARAM);

									# извеждане списък по въведен номер 
									$view= $GETPARAM["view"];
									if (isset($view)){
$filter= "docu.iduser=$view";
	$roente= getrow("user",$view);
$smarty->assign("FILTTX", "въведени от ".$roente["name"]);
										include_once "fdxxlist.php";
# ВНИМАНИЕ. 
# exit - излиза въобще от index.php 
return;
									}else{
									}
									
# списъка с потребителите с бройката вх.докум. - без странициране 
//$mylist= $DB->select("select * from user order by name");
$myquery= "select user.*, user.id as id
	,t2.coun as councase
	from user
	left join (
		select iduser, count(*) as coun
		from docu 
		group by iduser
	) as t2 on user.id=t2.iduser
	order by user.name
	";
$mylist= $DB->select($myquery);
$mylist= dbconv($mylist);

# трансформираме го - параметри за иконите 
				$modeel= "mode=".$mode ."&page=".$page;
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
//	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
	$mylist[$uskey]["view"]= geturl($modeel."&view=".$idcurr);
}

# извеждаме формата за избор 
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("fdusform.tpl","fetch");


?>