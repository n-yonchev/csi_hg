<?php
# извежда списък дела по критерий номер 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
# и още отгоре : 
#    $seeknome - номера за търсене 
//print_r($GETPARAM);
//var_dump($seeknome);

									# специален компонент за архив 
									include_once "archive.inc.php";

# СТАНДАРТ 
#-------------------------------------------------------------------------------------------
					# разглеждане на избрано дело без възможност за корекция 
					# - не елемент от списъка, а делото, с което е свързан 
					# източник : case.php 
					$edit= $GETPARAM["edit"];
					if (isset($edit)){
												# глобален флаг - не са разрешени корекции в делото 
//												$FLAGNOCHANGE= true;
//$smarty->assign("FLAGNOCHANGE", true);
												$FLAGNOCHANGE= getnochange($edit);
											//	# да не се извежда таба с делата 
											//	$smarty->assign("FLAGNOTABS", true);
							# скрипта за корекция/разглеждане 
							include_once "caseedit.php";
# назад към списъка с взискатели 
$smarty->assign("PAGEBACK", $page);
$smarty->assign("PAGEBACKTEXT", "назад към списъка дела");
	# текст с номера на делото 
	$datacase= getrow("suit",$edit);
	$smarty->assign("PAGEDATACASE", $datacase);
# ВНИМАНИЕ. 
# URL за връщане е специфичен, не е стандартен 
# съвпада с $modeel - от параметрите за иконите 
$smarty->assign("PAGEBACKLINK", geturl("mode=".$mode ."&seeknome=".$seeknome ."&page=".$page));
$pagecont= smdisp("caseedit.tpl","fetch");
return;
					}else{
					}
#-------------------------------------------------------------------------------------------

# текущата страница 
//print_r($GETPARAM);
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

#------- прилагаме филтъра ------- 
//$filter= "serial=$seeknome";
	#---- 30.09.2009 Т.Софрониев -------------------------------------------
	# идва от диалога "номер дело от-до +enter" - виж main.tpl 
	# източник : case.php 
				# формираме филтъра за заявката 
				list($ser1,$ser2)= explode("-",$seeknome);
				$ser1= $ser1 +0;
				$ser2= $ser2 +0;
				$ser2= ($ser2==0) ? $ser1 : $ser2;
					$filter= "suit.serial>=$ser1 and suit.serial<=$ser2";
# списъка 
		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
		$query= "select suit.*, suit.id as id
				,user.name as username
			from suit
				left join user on suit.iduser=user.id
			where $filter 
			order by suit.id desc
			";
		$prefurl= "";
//		$baseurl= "mode=".$mode;
		$baseurl= "mode=".$mode."&seeknome=".$seeknome;
		$obpagi= new paginator(20, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);

# трансформираме го - параметри за иконите 
				$modeel= "mode=".$mode ."&seeknome=".$seeknome ."&page=".$page;
								$arus= array();
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
								$arus[]= $idcurr;
//				$mycase= $uscont["idcase"];
	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
									# циклична заявка за архивните данни 
									$roarch= getarchdata($idcurr);
	$mylist[$uskey]["archive"]= $roarch;
}

//# add new link 
//$addnew= geturl($modeel."&edit=0");

							# за извеждане на "идва от" - кеширания масив 
							$arfrom= unserialize(file_get_contents(COFROMFILE));
							# предаваме съдържанието 
							$smarty->assign("ARFROM", $arfrom);
			#--------------------------------------------------------------------
					# за извеждане на статуса - съдържанието на 1-мерния масив 
					$smarty->assign("ARSTAT", $viewcasestat);
					# взискатели и длъжници 
					if (empty($arus)){
								$codeus= "0";
					}else{
								$codeus= implode(",",$arus);
					}
					$listclai= $DB->select("select idtype, name, idcase as ARRAY_KEY1, id as ARRAY_KEY2 from claimer where idcase in ($codeus)");
					$listclai= dbconv($listclai);
			$smarty->assign("LISTCLAI", $listclai);
					$listdebt= $DB->select("select idtype, name, idcase as ARRAY_KEY1, id as ARRAY_KEY2 from debtor where idcase in ($codeus)");
					$listdebt= dbconv($listdebt);
			$smarty->assign("LISTDEBT", $listdebt);
			#--------------------------------------------------------------------
# извеждаме 
//$smarty->assign("ADDNEW", $addnew);
$smarty->assign("SEEKNOME", to1251($seeknome));
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("finolist.tpl","fetch");


?>
