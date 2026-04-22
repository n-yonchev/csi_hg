<?php
# търсене на дело по деловодител/година - избора и списъка заедно 
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
										include_once "fiuslist.php";
# ВНИМАНИЕ. 
# exit - излиза въобще от index.php 
return;
									}else{
									}
									
# 16.05.2009 - включваме и неназначените дела 
# 2 етапа 
# броя дела по деловодители/години, вкл. и неназначените 
/*
$que1= "select iduser as ARRAY_KEY, count(*) as coun from suit group by iduser";
$arc1= $DB->selectCol($que1);
//print_r($arc1);
		# от старите версии има нензаначени дела с iduser=-1 
		# затова групираме заедно всички бройки с iduser=0 и iduser=-1 
				$arcoun= array();
		foreach($arc1 as $arin=>$arco){
			if ($arin<1){
				$arcoun[0] += $arco;
			}else{
				$arcoun[$arin]= $arco;
			}
		}
//print_r($arcoun);
*/
$que1= "select iduser as ARRAY_KEY_1, year as ARRAY_KEY_2, count(*) as coun from suit group by iduser, year";
$arc1= $DB->selectCol($que1);
//print_r($arc1);
		# от старите версии има неназначени дела с iduser=-1 
		# затова групираме заедно всички бройки с iduser=0 и iduser=-1 
				$arcoun= array();
		foreach($arc1 as $arin=>$arco){
			if ($arin<1){
				foreach($arco as $yeindx=>$yecont){
//print "[$arin][$yeindx][$yecont]";
					$arcoun[0][$yeindx] += $yecont;
				}
			}else{
				$arcoun[$arin]= $arco;
			}
		}

# всички деловодители 
//$myquery= "select id, name from user order by name";
					# 08.12.2010 - без деловодителите с нула дела 
								$arus= array();
					foreach($arc1 as $idus=>$x2){
								$arus[]= $idus;
					}
					if (empty($arus)){
								$codeus= "0";
					}else{
								$codeus= implode(",",$arus);
					}
$myquery= "select id, name from user where id in ($codeus) order by name";
$mylist= $DB->select($myquery);
$mylist= dbconv($mylist);
		# добавяме празен юзер за неназначените 
		$mylist[]=  array("id"=>0, "name"=>"");
//$mylist= dbconv($mylist);
//print_r($mylist);

# трансформираме го - параметри за иконите 
				$modeel= "mode=".$mode ."&page=".$page;
/*
						# общия брой 
						$tocoun= 0;
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
	# бройката дела 
	$mylist[$uskey]["councase"]= $arcoun[$idcurr];
						$tocoun += $arcoun[$idcurr];
//	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
	$mylist[$uskey]["view"]= geturl($modeel."&view=".$idcurr);
}
//print_r($mylist);
*/
								# общо за всички деловодители по месеци 
								$artota= array();
		foreach($arcoun as $usindx=>$usar){
						# за текущия деловодител общо за всички месеци 
						$arcoun[$usindx]["tota"]= 0;
			foreach($usar as $yeindx=>$yecont){
						$arcoun[$usindx]["tota"] += $yecont;
								$artota[$yeindx] += $yecont;
			}
		}
								# глобалния брой 
									$suto= 0;
								foreach($artota as $toelem){
									$suto += $toelem;
								}
								$artota["tota"]= $suto;
//print_r($artota);

# параметри за иконите - деловодител и година 
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
	foreach ($listyear as $cuyear){
		$mylist[$uskey][$cuyear]["view"]= geturl($modeel."&view=".$idcurr."^".$cuyear);
	}
}
//print_r($mylist);

# извеждаме формата за избор 
						$smarty->assign("ARCOUN", $arcoun);
						$smarty->assign("ARTOTA", $artota);
							unset($listyear[0]);
						$smarty->assign("LISTYEAR", $listyear);
//$smarty->assign("TOCOUN", $tocoun);
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("fiusform.tpl","fetch");


?>