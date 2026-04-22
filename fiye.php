<?php
# търсене на дело по година - избора и списъка заедно 
#    вика се в основния прозорец, а не в ajax 
# източник : fius.php - търсене по деловодител 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
//print_r($GETPARAM);

									# извеждане списък по въведен номер 
									$view= $GETPARAM["view"];
									if (isset($view)){
										include_once "fiyelist.php";
# ВНИМАНИЕ. 
# exit - излиза въобще от index.php 
return;
									}else{
									}
									
# списъка с годините и бройката дела - без странициране 
$mylist= $DB->select("select year as ARRAY_KEY, count(*) as coun from suit group by year");
$mylist= dbconv($mylist);

# трансформираме го - параметри за иконите 
				$modeel= "mode=".$mode ."&page=".$page;
foreach ($mylist as $uskey=>$uscont){
//				$idcurr= $uscont["id"];
				$idcurr= $uskey;
//	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
//	$mylist[$uskey]["view"]= geturl($modeel."&view=".$idcurr);
	$mylist[$uskey]["view"]= geturl($modeel."&view=".$idcurr);
}
//print_r($mylist);
						# всички години 
						unset($listyear[0]);
						$smarty->assign("LISTYEAR", $listyear);

# извеждаме формата за избор 
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("fiyeform.tpl","fetch");


?>