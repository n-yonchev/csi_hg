<?php
# съмнителни постъпления 
# източник : 
#    fina.php - финансист обслужва банковите (преводи) и други постъпления 
#+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
# ВНИМАНИЕ. 16.02.2010 
#    Този скрипт е директно копие на източника. 
#    Променена е само заявката към данните и е добавен нов елемент за всеки запис. 
#    Всички допълнитени възможности трябва да отпаднат.
#+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//#    не влизат прих.касови ордери тип=2=в_брой=ПКО 
//#    влизат всички постъпления, независимо от насочването към дела, вкл. ненасочените 
//#    може да се въвеждат масово записи чрез "копиране" от извлечението на ОББ 
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
//print_r($_SESSION);

									# функции, свързани с филтрите 
									include_once "finafilt.inc.php";
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
									# всички разклонения 
									include_once "finaclon.inc.php";
									
//$relurl= geturl("mode=".$mode."&page=".$page);
									
#-------- специфични извиквания - назначаване на дело към постъпление -----------------
# продължава извеждането на списъка постъпления 

			# начало - насочване на постъпление към дело 
			$direcase= $GETPARAM["direcase"];
			if (isset($direcase)){
	$rofina= getrow("finance",$direcase);
$_SESSION["direcase"]["rofina"]= $rofina;
$_SESSION["direcase"]["idfina"]= $direcase;
//	$modeel= "mode=".$mode ."&page=".$page;
	$modeel= "mode=".$mode ."&page=".$page ."&filtpara=".$filtpara;
$_SESSION["direcase"]["exitlink"]= geturl($modeel."&direcaseexit=0");
$_SESSION["direcase"]["oklink"]= geturl($modeel."&direcaseok=0");
//return;
			}else{
			}

			# прекратяване насочването към дело 
			$direcaseexit= $GETPARAM["direcaseexit"];
			if (isset($direcaseexit)){
unset($_SESSION["direcase"]);
			}else{
			}

			# успешно насочване към дело 
			$direcaseok= $GETPARAM["direcaseok"];
			if (isset($direcaseok)){
				$idfina= $_SESSION["direcase"]["idfina"];
				$idcase= $_SESSION["direcase"]["okcase"];
				$DB->query("update finance set idcase=?d where id=?d"  ,$idcase,$idfina);
								# добавяме новия запис в архива 
								finaarchive($idfina);
unset($_SESSION["direcase"]);
			}else{
			}

#-------- край на специфичните извиквания за назначаване на дело към постъпление -----------------

# СТАНДАРТ 
#-------------------------------------------------------------------------------------------
					# разглеждане на избрано дело без възможност за корекция 
					# - не елемент от списъка, а делото, с което е свързан 
					# източник : case.php 
					$viewcase= $GETPARAM["viewcase"];
					if (isset($viewcase)){
												# глобален флаг - не са разрешени корекции в делото 
												$FLAGNOCHANGE= true;
												//$smarty->assign("FLAGNOCHANGE", $FLAGNOCHANGE);
												# да не се извежда таба с делата 
												$smarty->assign("FLAGNOTABS", true);
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
//		$query= "select * from finance order by id";
/*
		$query= "select finance.*, finance.id as id, user.name as username
			, suit.id as idcase, suit.serial as caseseri, suit.year as caseyear
			from finance 
			left join user on finance.iduser=user.id
			left join suit on finance.idcase=suit.id
			order by finance.id desc
			";
*/
	$query= finaquery();
//# ВНИМАНИЕ. 
//# Само типове 1=превод, 7=старо, 9=директно_взиск 
# евентуалния филтър от антетката 
if (empty($filtcode)){
	$filtcode= "1";
}else{
}
#+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//	# всички постъпления 
//	$query= "$query where $filtcode order by finance.id desc";
# ВНИМАНИЕ. 16.02.2010 
# само съмнителните постъпления 
				# ненасочено, но приключено 
				$sus1= "finance.idcase=0 and finance.isclosed=1";
				# ненасочено, но изравнено, независимо дали е приключено 
				$sus2= "finance.idcase=0 and finance.rest=0";
				# насочено, неизравнено, но приключено 
				$sus3= "finance.idcase<>0 and finance.rest<>0 and finance.isclosed=1";
					$query= "$query 
						where ($sus1) or ($sus2) or ($sus3)
						order by finance.id desc
						";
#+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//	$query= "$query order by finance.id desc";
//	$query= "$query where finance.idtype in (1,7,9) order by finance.id desc";
		$prefurl= "";
		$baseurl= "mode=".$mode ."&filtpara=".$filtpara;
		$obpagi= new paginator(30, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);

# трансформираме го - параметри за иконите 
//				$modeel= "mode=".$mode ."&page=".$page;
				$modeel= "mode=".$mode ."&page=".$page ."&filtpara=".$filtpara;
foreach ($mylist as $uskey=>$uscont){
#+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
# ВНИМАНИЕ. 16.02.2010 
# само съмнителните постъпления 
# вида на съмнителното постъпление 
/*
				# ненасочено, но приключено 
				$tys1= ($uscont["idcase"]==0 and $uscont["isclosed"]==1)   ? "1" : "0";
				# ненасочено, но изравнено, независимо дали е приключено 
				$tys2= ($uscont["idcase"]==0 and $uscont["rest"]==0)   ? "1" : "0";
				# насочено, неизравнено, но приключено 
				$tys3= ($uscont["idcase"]<>0 and $uscont["rest"]<>0 and $uscont["isclosed"]==1)   ? "1" : "0";
	$mylist[$uskey]["susp"]= $tys1.$tys2.$tys3;
*/
				# ненасочено, но приключено 
				$tys1= ($uscont["idcase"]==0 and $uscont["isclosed"]==1);
				if ($tys1){
	$mylist[$uskey]["susp"]= "ненасочено, но приключено";
				}else{
				}
				# ненасочено, но изравнено, независимо дали е приключено 
				$tys2= ($uscont["idcase"]==0 and $uscont["rest"]==0);
				if ($tys2){
	$mylist[$uskey]["susp"]= "ненасочено, но изравнено";
				}else{
				}
				# насочено, неизравнено, но приключено 
				$tys3= ($uscont["idcase"]<>0 and $uscont["rest"]<>0 and $uscont["isclosed"]==1);
				if ($tys3){
	$mylist[$uskey]["susp"]= "насочено, неизравнено, но приключено";
				}else{
				}
#+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
				$idcurr= $uscont["id"];
	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
				# броя на записите в историята - НЕЕФЕКТИВНО 
				$coun= $DB->selectCell("select count(*) from finahist where idfinance=?d"  ,$idcurr);
				$coun= ($coun==0) ? 0 : $coun-1;
	$mylist[$uskey]["histcoun"]= $coun;
	$mylist[$uskey]["hist"]= geturl($modeel."&hist=".$idcurr);
/*
				# броя на записите в извлеченията - НЕЕФЕКТИВНО 
				$coun= $DB->selectCell("select count(*) from finasource where idfinance=?d"  ,$idcurr);
	$mylist[$uskey]["sourcoun"]= $coun;
//	$mylist[$uskey]["sour"]= geturl($modeel."&sour=".$idcurr);
*/
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
//$mylist[$uskey]["prnt"]= geturl("prnt=".$idcurr);
$mylist[$uskey]["prntcode"]= $idcurr +132;
//print "<br>$idcurr=".intval("$idcurr",12);
}

# add new link 
$addnew= geturl($modeel."&edit=0");
# копирай от извлечението на ОББ 
$copyfrom= geturl($modeel."&copyfrom=0");
				//# допълнителни js линкове за секцията head 
				//$smarty->assign("HEADJS", array("cluetip.hoverIntent.js","jquery.cluetip.js"));

						# за извеждане на "тип" - масива $listfinatype - commspec.php 
						# предаваме съдържанието на масива 
						$smarty->assign("ARTYPE", $listfinatype2);
# извеждаме 
//		$smarty->assign("MODE", $mode);
		$smarty->assign("ARFINALINK", getfinalink("mode=".$mode));
//print_r(getfinalink("mode=".$mode));
$smarty->assign("ADDNEW", $addnew);
$smarty->assign("COPYFROM", $copyfrom);
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("fina.tpl","fetch");

?>
