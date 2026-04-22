<?php
# финансист обслужва банковите (преводи) и други постъпления 
#    не влизат прих.касови ордери тип=2=в_брой=ПКО 
#    влизат всички постъпления, независимо от насочването към дела, вкл. ненасочените 
#    може да се въвеждат масово записи чрез "копиране" от извлечението на ОББ 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $page - текущата страница 

/*
						# 15.05.2012 - пакетни преводи чрез XML файл 
# флаг дали да се включва новия клон 
# резултат - $flagubb 
$fileubb= "ubb.txt";
if (file_exists($fileubb)){
	$contubb= file_get_contents($fileubb);
	$s1= substr($contubb,0,1);
		$flagubb= ($s1=="1");
}else{
		$flagubb= false;
}
$smarty->assign("FLAGUBB", $flagubb);
*/

											# 22.02.2012 - разпределение на сумата по дела 
											if (tabexists("finadist")){
							$ISFINADIST= true;
							$smarty->assign("ISFINADIST", true);
							$ordedist= "finance.crearange desc";
											}else{
							$ordedist= "1";
											}

									# функции, свързани с финансите 
									include_once "fina.inc.php";
									# всичко за преводите 
									include_once "tran.inc.php";

//print "<br>FINA.PHP=";
//print_rr($_POST);
//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

# текущата страница 
//print_rr($GETPARAM);
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;
//print_rr($_SESSION);

									# функции, свързани с филтрите 
									include_once "finafilt.inc.php";
									
//print "<br>FINA11.PHP=";
//print_rr($_POST);
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
//									# всички разклонения 
//									include_once "finaclon.inc.php";
									
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
			# 08.03.2012 Софрониев - от главното меню да излизат само филтъра без записи постъпления
			if (isset($_SESSION["exfilt"])){
	$filtcode= "1";
			}else{
	$filtcode= "finance.id=0";
			}
}else{
}
	# всички постъпления 
//	$query= "$query where $filtcode order by finance.id desc";
				# 09.03.2010 - доп.филтър директно в заглавната зона 
//print "<br>[$filtcode]";
//print "<br>[$exfiltcode]";
	//$query= "$query where $filtcode and $exfiltcode order by finance.id desc";
	$query= "$query where $filtcode and $exfiltcode order by finance.created desc, $ordedist, finance.id";
//print $query;
//	$query= "$query order by finance.id desc";
//	$query= "$query where finance.idtype in (1,7,9) order by finance.id desc";
		$prefurl= "";
		$baseurl= "mode=".$mode ."&filtpara=".$filtpara;
		$obpagi= new paginator(30, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);
//print_rr($mylist);

	# 19.09.2017 суми по всички страници от списъка 
	$ipos= strpos($query,"from");
	$str2= substr($query,$ipos);
	$qsum= "
		select *, round(suinco-susepara-susepara2-suback-surest,2) as suclai
		from (
			select sum(inco) as suinco, sum(separa) as susepara, sum(separa2) as susepara2
				, sum(back) as suback, sum(rest) as surest
			$str2
		) as t2
		";
//print $qsum;
	$arsu= $DB->selectRow($qsum);
//print_rr($arsu);
	$smarty->assign("ARSU", $arsu);
	
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
						# 15.05.2012 - пакетни преводи чрез XML файл 
						$arid= array();
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
						# 15.05.2012 - пакетни преводи чрез XML файл 
						$arid[]= $idcurr;
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
//				$sour= $DB->selectRow("select * from finasource where idfinance=?d"  ,$idcurr);
# 03.10.2011 Бъзински - да се извежда и името на банката 
				$sour= $DB->selectRow("
					select finasource.*, finasource.id as id, finabank.codebank as codebank
					from finasource 
					left join finabank on finasource.idfinabank=finabank.id
					where finasource.idfinance=?d
					"  ,$idcurr);
				$sour= dbconv($sour);
								$sour["bankname"]= $listxmltype[$cb=$sour["codebank"]];
	$mylist[$uskey]["sour"]= $sour;
	$mylist[$uskey]["idfinabank"]= $sour["idfinabank"];
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
# 14.03.2013 - старо приключено или готово за превод 
$mylist[$uskey]["markclos"]= geturl($modeel."&markclos=".$idcurr);
//$mylist[$uskey]["marktran"]= geturl($modeel."&marktran=".$idcurr);
				# само разглеждане на приключено постъпление 
	$mylist[$uskey]["info"]= geturl($modeel."&info=".$idcurr);
				# корекция само на датата за погасяване 
	$mylist[$uskey]["date"]= geturl($modeel."&date=".$idcurr);
# отпечатване на записа с текущото постъпление 
# ВНИМАНИЕ - без $modeel - виж шаблона 
//$mylist[$uskey]["prnt"]= geturl("prnt=".$idcurr);
$mylist[$uskey]["prntcode"]= $idcurr +132;
//print "<br>$idcurr=".intval("$idcurr",12);
				# 05.05.2010 игнориране 
//				$nodist= empty($uscont["toclai"]) and empty($uscont["separa"]) and empty($uscont["separa2"]);
			/*
					$arto= unsetoclai($uscont["toclai"]);
					$arsu= array_sum($arto);
				$nodist= $arsu==0 and $uscont["separa"]+0==0 and $uscont["separa2"]+0==0 and $uscont["back"]+0==0;
			*/
				$nodist= $uscont["inco"]+0 == $uscont["rest"]+0;
				if ($uscont["idcase"]==0 or $nodist){
	$mylist[$uskey]["igno"]= geturl($modeel."&igno=".$idcurr);
				}else{
				}
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
		# 22.02.2012 - за разпределение по дела 
	$mylist[$uskey]["distcase"]= geturl($modeel."&distcase=".$idcurr);
/**/
		if ($ISFINADIST){
			$distsuma= $DB->selectCell("select sum(inco) from finadist where idfinance=?d"  ,$idcurr);
	$mylist[$uskey]["distsuma"]= $distsuma;
		}else{
		}
/**/
	# линк връщане 
	$mylist[$uskey]["tranback"]= geturl($modeel."&tranback=".$idcurr);
# край на цикъла 
}
/*
						# броя преводи 
						$trancoun= $DB->selectCell("select count(*) from finatran where idfinance=?d"  ,$idcurr);
	$mylist[$uskey]["trancoun"]= $trancoun;
						# линк връщане 
	$mylist[$uskey]["tranback"]= geturl($modeel."&tranback=".$idcurr);
*/
//print_rr($mylist);

/***************************
						# 15.05.2012 - пакетни преводи чрез XML файл 
											include_once "tran.inc.php";
						$filtid= implode(",",$arid);
						$filtid= empty($filtid) ? "0" : $filtid;
$arcoprep= $DB->selectCol("select idfinance as ARRAY_KEY, count(*) from tranprep where idfinance in ($filtid) group by idfinance");
$arcotran= $DB->selectCol("select idfinance as ARRAY_KEY, count(*) from finatran where idfinance in ($filtid) group by idfinance");
//var_dump($filtid);
//print_rr($arcoprep);
//print_rr($arcotran);
$smarty->assign("ARCOPREP", $arcoprep);
$smarty->assign("ARCOTRAN", $arcotran);
$armaxstat= $DB->selectCol("
	select idfinance as ARRAY_KEY
	, max(if(finatran.idstat=9,-4, if(finatran.idinve=0 and finatran.idpack=0,-2, if(finatran.idpack=0,traninve.idstat,tranpack.idstat) ) )) 
	from finatran 
			left join traninve on finatran.idinve=traninve.id
			left join tranpack on finatran.idpack=tranpack.id
	where idfinance in ($filtid) 
	group by idfinance");
//	, max(if(finatran.idstat=9,finatran.idstat, if(finatran.idpack=0,traninve.idstat,tranpack.idstat) )) 
$smarty->assign("ARMAXSTAT", $armaxstat);
//print_rr($armaxstat);
$artran= $DB->select("
	select idfinance as ARRAY_KEY1, finatran.id as ARRAY_KEY2
	, finatran.amount, finatran.idstat, finatran.idinve, finatran.idpack
			, traninve.idstat as investat, tranpack.idstat as packstat
	from finatran 
			left join traninve on finatran.idinve=traninve.id
			left join tranpack on finatran.idpack=tranpack.id
	where idfinance in ($filtid)
	");
$smarty->assign("ARTRAN", $artran);
***********************/


						# 15.05.2012 - пакетни преводи чрез XML файл 
						$filtid= implode(",",$arid);
						$filtid= empty($filtid) ? "0" : $filtid;
//var_dump($filtid);
# доп.данни - постъпления и преводи 
$exlist= $DB->select("select $qurefe where finatranrefe.idfinance in ($filtid) order by finatran.idclaimer");
//$exlist= dbconv($exlist);
//print_rr($exlist);
$smarty->assign("EXLIST", $exlist);
# доп.данни - приключени постъпления чрез преводи 
$enddlist= $DB->select("select $quendd where finatranrefe.idfinance in ($filtid) $quenddgr");
$smarty->assign("ENDDLIST", $enddlist);
//print_rr($enddlist);
# взискателите 
$clailist= $DB->selectCol("
	select finatran.idclaimer as ARRAY_KEY, claimer.name
	from finatranrefe
	left join finatran on finatranrefe.idfinatran=finatran.id
	left join claimer on finatran.idclaimer=claimer.id
	where finatranrefe.idfinance in ($filtid)
	");
$clailist= dbconv($clailist);
$smarty->assign("CLAILIST", $clailist);


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
	$smarty->assign("COUN", count($mylist));
$pagecont= smdisp("fina.tpl","fetch");

?>
