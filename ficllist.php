<?php
# извежда списък дела по критерий за взискател 
# източник : fidelist.php - по длъжник 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
# и още отгоре : 
#    $seek - стринга за търсене на взискател 
//print_r($GETPARAM);
//var_dump($seek);

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
												# но само ако не е на логнатия 
										/*
													$roca= getrow("suit",$edit);
												$FLAGNOCHANGE= ($roca["iduser"]<>$iduser);
												$smarty->assign("FLAGNOCHANGE", $FLAGNOCHANGE);
										*/
												$FLAGNOCHANGE= getnochange($edit);
												$smarty->assign("FLAGNOCHANGE", $FLAGNOCHANGE);
												# да не се извежда таба с делата 
												$smarty->assign("FLAGNOTABS", true);
							# скрипта за корекция/разглеждане 
							include_once "caseedit.php";
# назад към списъка с взискатели 
$smarty->assign("PAGEBACK", $page);
$smarty->assign("PAGEBACKTEXT", "назад към списъка взискатели");
	# текст с номера на делото 
	$datacase= getrow("suit",$edit);
	$smarty->assign("PAGEDATACASE", $datacase);
# ВНИМАНИЕ. 
# URL за връщане е специфичен, не е стандартен 
# съвпада с $modeel - от параметрите за иконите 
$smarty->assign("PAGEBACKLINK", geturl("mode=".$mode ."&seek=".$seek ."&page=".$page));
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
# източник : casefilt.inc.php - $mytype=="like" - СТАНДАРТ 
#---- СТАНДАРТ -----------------------------------------------------------------------------------------------------------
								# ВНИМАНИЕ. 
								# стринговете в данните съдържат спец.символи - единични/двойни кавички, tab, newline и др. 
								# трябва да може да търсим в тях и ако стринга за критерия съдържа кавички 
								# при записа на стринга dbsimple е направила трансформация с mysql_real_escape_string 
								# трябва да направим подобна трансформация и за критерия 
					# ВАЖНО. 
					# 1. правим две, а не една трансформация - за MySQL-dbsimple и за like 
					# 2. заместваме с функцията sprintf - тя екранира коректно и двата вида кавички 
					$text1= $seek;
					$text2= mysql_real_escape_string($text1);
					$text3= mysql_real_escape_string($text2);
					$text4= "%" .$text3 ."%";
# 29.05.2009 Бъзински - 
# общ шаблон за търсене в двойни име, ЕГН, адрес 
$tempall= "(upper(%s) like upper('%s') or upper(%s) like upper('%s'))";
					# елементи на филтъра 
					# - за името 
# 29.05.2009 Бъзински - търсене в името, включително и на съпруга 
//					$elname= sprintf("upper(%s) like upper('%s')"  ,"claimer.name",$text4);
$elname= sprintf($tempall  ,"claimer.name",$text4,"claimer.name2",$text4);
					# - за идентификатора - едновременно юридич/физич лица 
# 29.05.2009 Бъзински - търсене в ЕГН, включително и на съпруга 
//						$elegnn= sprintf("upper(%s) like upper('%s')"  ,"claimer.egn",$text4);
$elegnn= sprintf($tempall  ,"claimer.egn",$text4,"claimer.egn2",$text4);
						$elbuls= sprintf("upper(%s) like upper('%s')"  ,"claimer.bulstat",$text4);
					$eliden= "case idtype when 1 then ($elbuls) when 2 then ($elegnn) when 3 then ($elbuls) else 0 end";
# 29.05.2009 Бъзински - търсене в адреса, включително и на съпруга 
$eladdr= sprintf($tempall  ,"claimer.address",$text4,"claimer.address2",$text4);
					# филтъра 
//					$filter= "$elname or $eliden";
					$filter= "$elname or $eliden or $eladdr";
//print "[$seek][$filter]";


# списъка 
		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
//		$query= "select * from claimer where $filter order by name";
		$query= "select claimer.*, claimer.id as id
				,suit.id as idcase ,suit.serial as caseseri ,suit.year as caseyear ,suit.idstat as idstat  
				,suit.idcofrom as casefrom ,suit.created as casedate ,suit.text as casetext
				,user.name as username
			from claimer 
				left join suit on claimer.idcase=suit.id
				left join user on suit.iduser=user.id
			where $filter 
			order by claimer.name
			";
		$prefurl= "";
//		$baseurl= "mode=".$mode;
		$baseurl= "mode=".$mode."&seek=".$seek;
		$obpagi= new paginator(20, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);


# трансформираме го - параметри за иконите 
				$modeel= "mode=".$mode ."&seek=".$seek ."&page=".$page;
						$arus= array();
foreach ($mylist as $uskey=>$uscont){
//				$idcurr= $uscont["id"];
				$mycase= $uscont["idcase"];
						$arus[]= $mycase;
	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$mycase);
									# циклична заявка за архивните данни 
									$roarch= getarchdata($mycase);
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
$smarty->assign("SEEK", to1251($seek));
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("ficllist.tpl","fetch");

?>
