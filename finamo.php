<?php
# специално за Гери - Бъзински 
# списък на постъпленията в обратен ред на датата 
#    източник : fina.php 
# датата на постъплението е според типа : 
#    - банково = има запис в табл.finance-finasource = finasource.timebank 
#    - друго   = само във finance = finance.time 
# имаше проби с ниска MySQL ефективност 
#----- 15.01.2010 - ефективно решение (MySQL) с разделяне по месеци и заявка с union 
# избира се конкретен месец 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $page - текущата страница 
//print_rr($GETPARAM);

#-------------- ПРОБИ С НИСКА ЕФЕКТИВНОСТ НА MySQL ----------------------
/*
$BANKTIME= "if(finasource.id is null,finance.time,finasource.timebank)";
		$query= "select count(finance.id), substring($BANKTIME,1,7) as montbank
			from finance 
			left join finasource on finance.id=finasource.idfinance
			group by montbank
			";
*/
/*
		$query= "select finance.*, substring($BANKTIME,1,7) as montbank
			from finance 
			left join finasource on finance.id=finasource.idfinance
			where substring($BANKTIME,1,7)='2009-08'
			";
*/
		/*
		$query= "
select finance.*
, substring(if(finasource.id is null,finance.time,finasource.timebank)  ,1,7) as montbank
from finance 
left join finasource on finance.id=finasource.idfinance
where substring(if(finasource.id is null,finance.time,finasource.timebank)  ,1,7)='2009-08'
		";
		*/
/*----
$tempfilt= "substring(%s,1,7)='2009-08'";
$filtsour= sprintf($tempfilt,"timebank");
$filtfina= sprintf($tempfilt,"time");
		$qusour= "
select finance.id as id, finasource.timebank as timebank
,concat('sour/',finasource.id) as code
from finasource
left join finance on finance.id=finasource.idfinance
where $filtsour
		";
		$qufina= "
select id as id, time as timebank
,concat('fina/',finance.id) as code
from finance
where $filtfina
		";
		$query= "
($qusour) 
		union distinct
($qufina) 
order by timebank
		";
----*/
									
									# функции, свързани с финансите 
									include_once "fina.inc.php";
//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

#---------------------------------------------------------------
# списъка с месеците 
# - аналог на списъка с дела от case.php - TABSLIST 
					$modeel= "mode=".$mode;
$cuye= date("Y");
$cumo= date("m");
			$armont= array();
for ($i=1; $i<=15; $i++){
					$cumo= str_pad($cumo,2,"0",STR_PAD_LEFT);
					$myelem["text"]= "$cuye-$cumo";
					$myelem["link"]= geturl($modeel."&mont="."$cuye-$cumo");
			$armont["$cuye-$cumo"]= $myelem;
	$cumo --;
	if ($cumo==0){
		$cumo= 12;
		$cuye --;
	}else{
	}
}
$smarty->assign("ONLYTABS", true);
$smarty->assign("TABSLIST", $armont);

# кода на текущия месец 
$mont= $GETPARAM["mont"];
if (isset($mont)){
}else{
	$ak= array_keys($armont);
	$mont= $ak[0];
}
$smarty->assign("MONT", $mont);
#---------------------------------------------------------------

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
//			$modeel= "mode=".$mode;
			$modeel= "mode=".$mode ."&mont=".$mont;
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
//	$modeel= "mode=".$mode ."&page=".$page ."&filtpara=".$filtpara;
	$modeel= "mode=".$mode ."&mont=".$mont ."&page=".$page ."&filtpara=".$filtpara;
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
//$smarty->assign("PAGEBACKLINK", geturl("mode=".$mode ."&page=".$page));
$smarty->assign("PAGEBACKLINK", geturl("mode=".$mode ."&mont=".$mont ."&page=".$page));
$pagecont= smdisp("caseedit.tpl","fetch");
return;
					}else{
					}
#-------------------------------------------------------------------------------------------

# списъка 
		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
//	$query= finaquery();

# евентуалния филтър от антетката 
if (empty($filtcode)){
	$filtcode= "1";
}else{
}
//$query= "$query where $filtcode";

#----- 15.01.2010 - ефективно решение (MySQL) с разделяне по месеци и заявка с union 
# адаптирана с елементи от заявката във finaquery-fina.inc.php 
$tempfilt= "substring(%s,1,7)='$mont'";
$filtsour= sprintf($tempfilt,"timebank");
$filtfina= sprintf($tempfilt,"time");
				$listfiel= "
					, user.name as finaname
					, suit.id as idcase, suit.serial as caseseri, suit.year as caseyear
					, t2.name as username
					";
				$listsour= "
					, finasource.idfinabank as idfinabank
					, finasource.date as date
					, finasource.hour as hour
					, finasource.amount as amount
					, finasource.desc1 as desc1
					, finasource.desc2 as desc2
					, finasource.desc3 as desc3
					, finasource.desc4 as desc4
					, finasource.reference as reference
					";
				$listjoin= "
					left join user on finance.iduser=user.id
					left join suit on finance.idcase=suit.id
					left join user as t2 on suit.iduser=t2.id
					";
		$qusour= "
select finance.*
, finance.id as id, finasource.timebank as timebank
, 1 as banktype
, concat('sour/',finasource.id) as code
				$listfiel
				$listsour
from finance
left join finasource on finance.id=finasource.idfinance
				$listjoin
where $filtsour and finasource.id is not null
and $filtcode
		";
		$qufina= "
select finance.*
, finance.id as id, finance.time as timebank
, 0 as banktype
, concat('fina/',finance.id) as code
				$listfiel
				$listsour
from finance
left join finasource on finance.id=finasource.idfinance
				$listjoin
where $filtfina and finasource.id is null
and $filtcode
		";
/*
		$query= "
($qusour) 
		union all
($qufina) 
order by timebank
		";
*/
		$query= "
($qusour) 
		union all
($qufina) 
order by timebank desc
		";
#------------------------------------------------------------------------------------

		$prefurl= "";
//		$baseurl= "mode=".$mode ."&filtpara=".$filtpara;
		$baseurl= "mode=".$mode ."&mont=".$mont ."&filtpara=".$filtpara;
//		$obpagi= new paginator(30, 8, $query);
		$obpagi= new paginator(20, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);

# трансформираме го - параметри за иконите 
//				$modeel= "mode=".$mode ."&page=".$page;
//				$modeel= "mode=".$mode ."&page=".$page ."&filtpara=".$filtpara;
				$modeel= "mode=".$mode ."&mont=".$mont ."&page=".$page ."&filtpara=".$filtpara;
foreach ($mylist as $uskey=>$uscont){
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
				/****
				# записа с извлечението за текущото постъпление - НЕЕФЕКТИВНО 
				$sour= $DB->selectRow("select * from finasource where idfinance=?d"  ,$idcurr);
				$sour= dbconv($sour);
				****/
							# данните от банк.извлечение за текущото постъпление 
							# 15.01.2010 - дръг подход - за повишаване ефективността 
							$sour= array();
							$sour["idfinabank"]= $uscont["idfinabank"];
							$sour["date"]= $uscont["date"];
							$sour["hour"]= $uscont["hour"];
							$sour["amount"]= $uscont["amount"];
							$sour["desc1"]= $uscont["desc1"];
							$sour["desc2"]= $uscont["desc2"];
							$sour["desc3"]= $uscont["desc3"];
							$sour["desc4"]= $uscont["desc4"];
							$sour["reference"]= $uscont["reference"];
							
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
//		$smarty->assign("ARFINALINK", getfinalink("mode=".$mode));
		$smarty->assign("ARFINALINK", getfinalink("mode=".$mode ."&mont=".$mont));
//print_r(getfinalink("mode=".$mode));
$smarty->assign("ADDNEW", $addnew);
$smarty->assign("COPYFROM", $copyfrom);
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("finamo.tpl","fetch");

?>
