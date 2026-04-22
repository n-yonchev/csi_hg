<?php
# деловодител обслужва всички типове постъпления към неговите дела 
#    влизат само постъпленията към неговите дела 
# източник : 
#    fina.php - финансист обслужва банковите и други преводи 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $page - текущата страница 
									
									# функции, свързани с финансите 
									include_once "fina.inc.php";
//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

# текущата страница 
//print_r($GETPARAM);
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

									# функции, свързани с филтрите 
									include_once "finafilt.inc.php";
/*
# евентуалния филтър от антетката 
$filtpara= $GETPARAM["filtpara"];
//if (isset($filtpara)){
if (!empty($filtpara)){
	$filttext= finafilttext($filtpara);
	$smarty->assign("FILTTEXT", $filttext);
			$modeel= "mode=".$mode;
	$smarty->assign("FILTTOALL", geturl($modeel));
	# кода за филтъра 
	$filtcode= finafiltcode($filtpara);
}else{
}

//print_r($_SESSION);
									# всички разклонения 
									include_once "finaclon.inc.php";
*/									
//$relurl= geturl("mode=".$mode."&page=".$page);

#----- 30.06.2010 филтър и за постъпленията на деловодител --------------------------------------
# източник : fina.php 
									# всички разклонения 
									# 16.03.2010 - да бъде преди finaexfilt.inc.php - в него се изтрива $_POST 
									include_once "finaclon.inc.php";

				# 09.03.2010 - доп.филтър директно в заглавната зона 
				# предава се чрез ajax и сесията (finaexfilt.ajax.php), а не чрез форма 
				include "finaexfilt.inc.php";
				# получихме $exfiltcode - кода за доп.филтър 
//print "<br>FINA22.PHP=";
//print_rr($_POST);
//print $exfiltcode;
//				# първа страница 
//				$page= 1;
//print_rr($_SESSION["exfilt"]);

# евентуалния филтър от антетката 
$filtpara= $GETPARAM["filtpara"];
//if (isset($filtpara)){
if (!empty($filtpara)){
	$filttext= finafilttext($filtpara);
	$smarty->assign("FILTTEXT", $filttext);
			$modeel= "mode=".$mode;
	$smarty->assign("FILTTOALL", geturl($modeel));
	# кода за филтъра 
	$filtcode= finafiltcode($filtpara);
}else{
}
#--------------------------------------------------------------------------

# СТАНДАРТ 
#-------------------------------------------------------------------------------------------
					# разглеждане на избрано дело без възможност за корекция 
					# - не елемент от списъка, а делото, с което е свързан 
					# източник : case.php 
					$viewcase= $GETPARAM["viewcase"];
					if (isset($viewcase)){
											//	# глобален флаг - не са разрешени корекции в делото 
											//	$FLAGNOCHANGE= true;
											//	# да не се извежда таба с делата 
											//	$smarty->assign("FLAGNOTABS", true);
# ВНИМАНИЕ. 
# изкуствена стойност - заради caseedit.php 
$edit= $viewcase;
$GETPARAM["edit"]= $edit;
							# скрипта за корекция/разглеждане 
							include_once "caseedit.php";
# назад към списъка с взискатели 
$smarty->assign("PAGEBACK", $page);
$smarty->assign("PAGEBACKTEXT", "назад към списъка постъпления");
	# текст с номера на делото 
	$datacase= getrow("suit",$viewcase);
	$smarty->assign("PAGEDATACASE", $datacase);
//# ВНИМАНИЕ. 
//# URL за връщане е специфичен, не е стандартен 
//# съвпада с $modeel - от параметрите за иконите 
//$smarty->assign("PAGEBACKLINK", geturl("mode=".$mode ."&seek=".$seek ."&page=".$page));
$smarty->assign("PAGEBACKLINK", geturl("mode=".$mode ."&page=".$page));
$pagecont= smdisp("caseedit.tpl","fetch");
return;
					}else{
					}
#-------------------------------------------------------------------------------------------

# списъка 
		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
	$query= finaquery();
# евентуалния филтър от антетката 
if (empty($filtcode)){
	$filtcode= "1";
}else{
}
# ВНИМАНИЕ. 
# Само делата на логнатия 
//	$query= "$query order by finance.id desc";
//	$query= "$query where suit.iduser=$iduser and $filtcode order by finance.id desc";
#----- 30.06.2010 филтър и за постъпленията на деловодител --------------------------------------
	$query= "$query where suit.iduser=$iduser and $filtcode and $exfiltcode order by finance.id desc";
		$prefurl= "";
//		$baseurl= "mode=".$mode;
		$baseurl= "mode=".$mode ."&filtpara=".$filtpara;
		$obpagi= new paginator(30, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);
										#----------------------------------------------------------------------
										# 12.07.2010 - число - банк.такса за превод на разпределение 
										#----------------------------------------------------------------------
										# източник : cazofina.php 
										$rooffi= getofficerow($iduser);
										$banktax= $rooffi["banktax"] +0;
										$isbanktax= $banktax<>0;
//										$smarty->assign("BANKTAX", number_format($banktax,2,".",""));
//										$smarty->assign("BANKTAX", $banktax);
										$smarty->assign("ISBANKTAX", $isbanktax);

# трансформираме го - параметри за иконите 
//				$modeel= "mode=".$mode ."&page=".$page;
				$modeel= "mode=".$mode ."&page=".$page ."&filtpara=".$filtpara;
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
				# броя на записите в историята - НЕЕФЕКТИВНО 
				$coun= $DB->selectCell("select count(*) from finahist where idfinance=?d"  ,$idcurr);
				$coun= ($coun==0) ? 0 : $coun-1;
	$mylist[$uskey]["histcoun"]= $coun;
	$mylist[$uskey]["hist"]= geturl($modeel."&hist=".$idcurr);
				# записа с извлечението за текущото постъпление - НЕЕФЕКТИВНО 
				$sour= $DB->selectRow("select * from finasource where idfinance=?d"  ,$idcurr);
				$sour= dbconv($sour);
	$mylist[$uskey]["sour"]= $sour;
				# за разглеждане на назначеното дело 
				# предаваме id на делото 
				$idcase= $uscont["idcase"];
	$mylist[$uskey]["viewcase"]= geturl($modeel."&viewcase=".$idcase);
				# за назначаване на дело 
				# предаваме id на постъплението 
	$mylist[$uskey]["direcase"]= geturl($modeel."&direcase=".$idcurr);
				# изчисляваме и зареждаме балансовите полета 
	finacalc($uscont, $mylist[$uskey]);
				# приключване на постъплението 
	$mylist[$uskey]["clos"]= geturl($modeel."&clos=".$idcurr);
				# само разглеждане на приключено постъпление 
	$mylist[$uskey]["info"]= geturl($modeel."&info=".$idcurr);
				# корекция само на датата за погасяване 
	$mylist[$uskey]["date"]= geturl($modeel."&date=".$idcurr);
# отпечатване на записа с текущото постъпление 
# ВНИМАНИЕ - без $modeel - виж шаблона 
$mylist[$uskey]["prntcode"]= $idcurr +132;
										#----------------------------------------------------------------------
										# 12.07.2010 - число - банк.такса за превод на разпределение 
										#----------------------------------------------------------------------
										# обща сума на банк.такси 
										# източник : cazofina.php 
										if ($isbanktax){
											if (empty($uscont["toclaitax"])){
												$arclamtax= array();
											}else{
												$arclamtax= unsetoclai($uscont["toclaitax"]);
											}
											$sumabank= array_sum($arclamtax);
											$sumabank += $uscont["backtax"];
	$mylist[$uskey]["banktax"]= $sumabank;
										}else{
										}
		# 23.07.2010 - за взискателите - обща сума с cluetip 
		# изчисляваме общата сума 
		$claisuma= array_sum($mylist[$uskey]["claiamou"]);
	$mylist[$uskey]["claisuma"]= $claisuma;
}

//# add new link 
//$addnew= geturl($modeel."&edit=0");
//# копирай от извлечението на ОББ 
//$copyfrom= geturl($modeel."&copyfrom=0");

		# 23.07.2010 - за взискателите - обща сума с cluetip 
		# допълнителни js линкове за секцията head 
		$smarty->assign("HEADJS", array("cluetip.hoverIntent.js","jquery.cluetip.js"));

						# за извеждане на "тип" - масива $listfinatype - commspec.php 
						# предаваме съдържанието на масива 
						$smarty->assign("ARTYPE", $listfinatype2);
# извеждаме 
		//$smarty->assign("MODE", $mode);
		$smarty->assign("ARFINALINK", getfinalink("mode=".$mode));
//$smarty->assign("ADDNEW", $addnew);
$smarty->assign("COPYFROM", $copyfrom);
$smarty->assign("LIST", $mylist);
		$smarty->assign("SINGLEUSER", true);
$pagecont= smdisp("finaca.tpl","fetch");

?>
