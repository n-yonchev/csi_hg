<?php
# извежда списък дела с непълни основни данни на избран деловодител и година 
# източници : 
#    fiuslist.php - всички дела за деловодител-година 
#    comple.php - дела с непълни основни данни за логнатия деловодител и избрана година 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
# и още отгоре : 
#    $view - деловодителя^годината = user.id ^ suit.year 
//print_r($GETPARAM);
//var_dump($view);

/****
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
****/

# разлагаме основния параметър на деловодител и година 
list($myuser,$myyear)= explode("^",$view);

							# деловодителя 
							$idcaseuser= $myuser;
							# годината 
							$caseyear= $myyear;
$smarty->assign("YEAR", $caseyear);
							# флаг за списъка с годините 
$smarty->assign("YEARFLAG", false);
									# извеждаме списъка с дела 
									include_once "comple.inc.php";

?>
