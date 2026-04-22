<?php
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
# и още : 
#    $idcaseuser - за кой деловодител 
#    $caseyear - годината 
//print_r($GETPARAM);

/*
# текущата страница 
//print_r($GETPARAM);
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;
*/

# текущата страница 
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

# СТАНДАРТ 
#-------------------------------------------------------------------------------------------
					# разглеждане на избрано дело без възможност за корекция 
//					# - не елемент от списъка, а делото, с което е свързан 
					# източник : case.php 
					$edit= $GETPARAM["edit"];
					if (isset($edit)){
												# глобален флаг - не са разрешени корекции в делото 
												# но само ако не е на логнатия 
												$FLAGNOCHANGE= getnochange($edit);
												# да не се извежда таба с делата 
												$smarty->assign("FLAGNOTABS", true);
							# скрипта за корекция/разглеждане 
							include_once "caseedit.php";
# назад към списъка с дела 
$smarty->assign("PAGEBACK", $page);
$smarty->assign("PAGEBACKTEXT", "назад към списъка дела");
	# текст с номера на делото 
	$datacase= getrow("suit",$edit);
	$smarty->assign("PAGEDATACASE", $datacase);
# ВНИМАНИЕ. 
# URL за връщане е специфичен, не е стандартен 
# съвпада с $modeel - от параметрите за иконите 
$smarty->assign("PAGEBACKLINK", geturl("mode=".$mode ."&view=".$view ."&page=".$page));
//$smarty->assign("PAGEBACKLINK", geturl("mode=".$mode ."&view=".$view));
$pagecont= smdisp("caseedit.tpl","fetch");
return;
					}else{
					}
#-------------------------------------------------------------------------------------------


# масива с линкове за годините 
	$baseurl= "mode=".$mode;
		$yearli= array();
foreach ($listyear as $cuyear){
//		$yearli[$cuyear]= geturl($baseurl."&year=".$cuyear);
							# основния параметър 
							$myview= $idcaseuser ."^" .$cuyear;
		$yearli[$cuyear]= geturl($baseurl."&view=".$myview);
}
$smarty->assign("YEARLIST", $yearli);

									include_once "comp2.inc.php";

# фиксираните данни - деловодител, година 
$rouser= getrow("user",$idcaseuser);
$smarty->assign("USERDATA", $rouser);

# заявката - за година=$caseyear и деловодител=$idcaseuser 
$filter= getcomplefilt();
$filt2= "suit.year=$caseyear and suit.iduser=$idcaseuser";
	$query= "
select suit.*, suit.id as id, claimorigin.name as origname
from suit
left join claimorigin on suit.idclaimorig=claimorigin.id
where ($filter) and $filt2
order by suit.year desc, suit.serial desc
	";
		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
		$prefurl= "";
//		$baseurl= "mode=".$mode ."&year=".$caseyear ."&page=".$page;
		$baseurl= "mode=".$mode ."&view=".$view ."&page=".$page;
		$obpagi= new paginator(20, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
# списъка 
$mylist= dbconv($mylist);
//print_r($mylist);
# трансформираме го - параметри за иконите 
				$modeel= "mode=".$mode ."&view=".$view ."&page=".$page;
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
//				$mycase= $uscont["idcase"];
	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
}

							# за извеждане на "идва от" - кеширания масив 
							# предаваме съдържанието 
							$arfrom= unserialize(file_get_contents(COFROMFILE));
							$smarty->assign("ARFROM", $arfrom);
						# за извеждане на "титул" - масива $listtitu - commspec.php 
						# предаваме съдържанието на масива 
						$smarty->assign("ARTITU", $listtitu);
						# за извеждане на "вид" - масива $listsort - commspec.php 
						# предаваме съдържанието на масива 
						$smarty->assign("ARSORT", $listsort);
							# за извеждане на "ред за отчета" 
							# предаваме съдържанието на разгърнатия масив 
							$smarty->assign("ARREPO", $viewrepo);
							# за извеждане на "характер на изпълнението" 
							# предаваме съдържанието на разгърнатия масив 
							$smarty->assign("ARCHAR", $listchartype);
//						# за извеждане на "схема на погасяване" - масива $lispayoff - commspec.php 
//						# предаваме съдържанието на масива 
//						$smarty->assign("ARPAYOFF", $listpayoff);
							# за извеждане на "произход на вземането" 
							$roorig= getrow("claimorigin",$rocase["idclaimorig"]);
							$rocase["origtext"]= $roorig["name"];

# извеждаме 
$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("comple.tpl","fetch");


?>
