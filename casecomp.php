<?php
# дела с непълни основни данни - по деловодители и години 
# източник : 
#    fius.php - търси дело по деловодител и година 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
# още : 
#    $view - деловодител^година = user.id ^ year 
//print_r($GETPARAM);

									# извеждане списък по въведен номер 
									$view= $GETPARAM["view"];
									if (isset($view)){
										include_once "casecomplist.php";
# ВНИМАНИЕ. 
# exit - излиза въобще от index.php 
return;
									}else{
									}
									
# броя дела по деловодители/години, вкл. и неназначените 
/*
$que1= "select iduser as ARRAY_KEY_1, year as ARRAY_KEY_2, count(*) as coun from suit group by iduser, year";
$arc1= $DB->selectCol($que1);
//print_r($arc1);
*/
									include_once "comp2.inc.php";
$filter= getcomplefilt();
//$filt2= "suit.year=$caseyear and suit.iduser=$idcaseuser";
	$que1= "
select iduser as ARRAY_KEY_1, year as ARRAY_KEY_2, count(*) as coun
from suit
where ($filter) 
group by iduser, year
	";
$arc1= $DB->selectCol($que1);
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
$myquery= "select id, name from user order by name";
$mylist= $DB->select($myquery);
$mylist= dbconv($mylist);
		# добавяме празен юзер за неназначените 
		$mylist[]=  array("id"=>0, "name"=>"");
//$mylist= dbconv($mylist);
//print_r($mylist);

# трансформираме го - параметри за иконите 
				$modeel= "mode=".$mode ."&page=".$page;
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
$pagecont= smdisp("casecompform.tpl","fetch");


?>
