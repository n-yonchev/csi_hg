<?php
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

# текущата страница 
//print_rr($GETPARAM);
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

									# корекция на избран запис 
									$edit= $GETPARAM["edit"];
									if (isset($edit)){
										include_once "jouredit.ajax.php";
										exit;
									}else{
									}
									# изтриване на избран запис 
									$dele= $GETPARAM["dele"];
									if (isset($dele)){
										include_once "jourdele.ajax.php";
										exit;
									}else{
									}

# годината  
	unset($listyear[0]);
	$arke= array_keys($listyear);
$year= $GETPARAM["year"];
$year= isset($year) ? $year : $arke[0];
$smarty->assign("YEAR", $year);
//var_dump($year);

# датата или периода 
$date= $GETPARAM["date"];
$date= isset($date) ? $date : "";
$date2= $GETPARAM["date2"];
$date2= isset($date2) ? $date2 : "";

									# избор на дата 
									$func= $GETPARAM["func"];
									if ($func=="get"){
				include_once "doredate.ajax.php";
exit;
									}else{
									}
									# всички записи без дата 
									//$func= $GETPARAM["func"];
									if ($func=="all"){
				$date= "";
				$date2= "";
									}else{
									}

# флага за отпечатване 
$prinyes= $GETPARAM["print"];
$flprin= ($prinyes=="yes");
$smarty->assign("FLPRIN", $flprin);

# масива с линкове за годините 
	$baseurl= "mode=".$mode;
		$yearli= array();
foreach ($listyear as $cuyear){
		$yearli[$cuyear]= geturl($baseurl."&year=".$cuyear);
}
$smarty->assign("YEARLIST", $yearli);

/*
									# корекция на избран запис 
									$edit= $GETPARAM["edit"];
									if (isset($edit)){
										include_once "docuedit.ajax.php";
										exit;
									}else{
									}
*/
							# 06.10.2010 - 
							# всяко ръчно добавено действие може да има списък с дела, а не само едно 
							# от основ.данни - флаг дали за всяко дело да се образува отделен номер в дневника 
							$rooffi= getofficerow($iduser);
							$isjoursepa= ($rooffi["isjoursepa"]<>0);
											
											# за връчването 
											include_once "deli.inc.php";

# получаваме заявката 
//$myquery= getjourquery($year);
//++++$myquery= getjourquery($year,$date,$date2);
//print $myquery;

		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
//++++		$query= $myquery;
		$prefurl= "";
//		$baseurl= "mode=".$mode ."&year=".$year;
//		$baseurl= "mode=".$mode."&year=".$year."&date=".$date."&date2=".$date2;
		$baseurl= "mode=".$mode."&page=".$page."&year=".$year."&date=".$date."&date2=".$date2;
//		$obpagi= new paginator(8, 8, $query);
# константа - брой редове на страница 
$perpag= 200;
/*
# предаваме в шаблона общия брой редове преди текущата страница 
# - ще се използва за автоматично формиране на поред.номер 
$smarty->assign("BASESERI", ($page-1)*$perpag);
*/
		# формираме обекта за странициране 
//++++		$obpagi= new paginator($perpag, 8, $query);
		# четем текущата страница 
//		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
						if ($flprin){
#ini_set("memory_limit","192M");
		$query= getjourquery($year,$date,$date2);
		$mylist= $DB->select($query);
						}else{
		$query= getjourquery($year,$date,$date2,"desc");
		$obpagi= new paginator($perpag, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
						}
$mylist= dbconv($mylist);
//print_rr($mylist);
$mylist= arstrip($mylist);
//print_rr(to1251($mylist));
//print_rr($mylist);


											if ($flprin){
												# отпечатване 
					$beginnum= 0;
											}else{
												# извеждане 

#------------------------------------------------------------------------------
				# 07.05.2009 
				# номерацията е в рамките на датата, за 1-вата дата може да има записи в предишната страница 
				# определяме $beginnum - колко записа има в предишната страница за 1-вата дата 
				# това ще бъде началния номер за тази дата 
//				if ($page==0){
				if ($page==1){
					$beginnum= 0;
				}else{
	$firstdate= $mylist[0]["created"];
	$firstdate= substr($firstdate,0,10);
	# четем предишната страница 
	$beginnum= 0;
	//var_dump($prevlist[0]);
	$i = 1;
	$prevlist= $obpagi->calculate($page-1, $prefurl, $baseurl);
	$prevend = end($prevlist);
	while((substr($prevend["created"], 0, 10) == $firstdate) && $page - $i > 0) {
		$prevlist= $obpagi->calculate($page-$i, $prefurl, $baseurl);
		$prevend = end($prevlist);
		foreach ($prevlist as $uskey=>$uscont){
			$crea= $uscont["created"];
			if (substr($crea,0,10)==$firstdate){
				$beginnum ++;
			}else{
			}
		}
		$i++;
		if($i >= 20) {
			break;
		}
	}
				}
//var_dump($beginnum);
//$smarty->assign("BEGINNUM", $beginnum);
#------------------------------------------------------------------------------
# ВНИМАНИЕ. 
# Четенето на предишната страница обърква навигационния панел. 
# Затова четем отново текущата страница. 
# НЕЕФЕКТИВНО. 
		# четем текущата страница 
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
//foreach($mylist as $elem){
//	print "<br>my2=".$elem["type"]."/".$elem["created"];
//}
$mylist= dbconv($mylist);
$mylist= arstrip($mylist);
#------------------------------------------------------------------------------
											
											# if ($flprin){
											}


# трансформираме го - параметри за иконите 
# само за ръчно добавените записи type=0 
//				$modeel= "mode=".$mode;
//				$modeel= "mode=".$mode."&page=".$page;
//				$modeel= "mode=".$mode."&year=".$year."&date=".$date."&date2=".$date2;
				$modeel= "mode=".$mode."&page=".$page."&year=".$year."&date=".$date."&date2=".$date2;
foreach ($mylist as $uskey=>$uscont){
							if ($uscont["type"]==0){
				$idcurr= $uscont["id"];
	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
	$mylist[$uskey]["dele"]= geturl($modeel."&dele=".$idcurr);
							}else{
							}
# 17.11.2009 - трансформация за постъпление 
				if ($uscont["type"]==3){
	list($des1,$des2)= explode("/",$uscont["descrip"]);
//	$mylist[$uskey]["descrip"]= "постъпление $des1 ".$listfinatype[$des2];
	$mylist[$uskey]["descrip"]= "постъпило плащане $des1 ".$listfinatype[$des2];
				}else{
				}
}

/**/
# трансформираме го - пореден номер за всяка дата 
//				$sedate= array();
				# 07.05.2009 
				# номерацията е в рамките на датата, за 1-вата дата може да има записи в предишната страница 
				# зареждаме бройката $beginnum за 1-вата дата $firstdate 
				$sedate= array($firstdate=>$beginnum);
foreach ($mylist as $uskey=>$uscont){
				$cudate= substr($uscont["created"] ,0,10);
				$nodate= $sedate[$cudate];
				//if ($nodate==0){
				//	$seno= 1;
				//}else{
					$seno= $nodate +1;
				//}
				$sedate[$cudate]= $seno;
	$mylist[$uskey]["seno"]= str_pad($seno,3,"0",STR_PAD_LEFT);
}
/**/
				
				# 13.04 2009 - един документ - много дела 
				# само за входящите документи 
				# добавяме масив - списък на свързаните дела 
				# НЕЕФЕКТИВНО - заявки в цикъл 
				# източник : dore.php 
foreach ($mylist as $uskey=>$uscont){
	$idcurr= $uscont["id"];
				if ($uscont["type"]==1){
		$arlis2= "";
	$caselist= getcaselist($idcurr);
	foreach($caselist as $cael){
		$arlis2[]= $cael["caseseri"] ."/" .$cael["caseyear"];
	}
	$mylist[$uskey]["caselist"]= $arlis2;
				# 06.10.2010 - 
				# всяко ръчно добавено действие може да има списък с дела, а не само едно 
				}elseif ($uscont["type"]==0){
					# според флага дали за всяко дело да се образува отделен номер в дневника 
					if ($isjoursepa){
					}else{
						# не се образува отделен номер - формираме списък с делата 
						$arlis2= "";
						$caselistjour= getcaselistjour($idcurr);
						foreach($caselistjour as $cael){
							$arlis2[]= $cael["caseseri"] ."/" .$cael["caseyear"];
						}
	$mylist[$uskey]["caselist"]= $arlis2;
					}
				}else{
				}
}

# линк за отпечатване на текущата страница 
//		$baseurl= "mode=".$mode."&page=".$page."&year=".$year;
		$baseurl= "mode=".$mode."&page=".$page."&year=".$year."&date=".$date."&date2=".$date2;
$curint= geturl($baseurl."&print=yes");
$smarty->assign("CURINT", $curint);

# параметри за извеждане на датата и бутоните 
//$date= $GETPARAM["date"];
//$date= isset($date) ? $date : "";
//		$baseurl= "mode=".$mode."&page=".$page."&year=".$year;
		$baseurl= "mode=".$mode."&page=".$page."&year=".$year."&date=".$date."&date2=".$date2;
if (empty($date)){
	$ardate["linkget"]= geturl($baseurl."&func=get");
}else{
//	$ardate["date"]= $date;
//	$ardate["date2"]= $date2;
	$ardate["date"]= (empty($date)) ? "" : bgdateto($date);
	$ardate["date2"]= (empty($date2)) ? "" : bgdateto($date2);
	$ardate["linkget"]= geturl($baseurl."&func=get");
	$ardate["linkall"]= geturl($baseurl."&func=all");
}
//print_rr($ardate);
$smarty->assign("DATE", $ardate);

# add new link 
$addnew= geturl($modeel."&edit=0");

# извеждаме 
$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
						
						if ($flprin){
# отпечатване на всички страници чрез HTML-Excel 
# източник : cazo6prnt.ajax.php 
# съдържанието 
$cont= smdisp("jourprnt.tpl","fetch");
ExcelHeader("дневник.изв.действия.xls");
	$outp= "
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\" />
<body>
	$cont
</body>
</html>
	";
print $outp;
exit;
						}else{
# извеждане на текущата страница 
$pagecont= smdisp("jour.tpl","fetch");
						}




# връща union заявката евент.с филтър 
# датите : 0, 1 или 2 дати в MySQL формат 
//function getjourquery($year  ,$date1="",$date2=""){
function getjourquery($year  ,$date1="",$date2=""  ,$orddate="asc"){

	# формираме макет за евент.допълнит.MySQL филтър за дата/период 
	# created - фикс.име на полето за всички таблици 
				$bgdate1= bgdateto($date1);
				$bgdate2= bgdateto($date2);
	if (empty($date2)){
		if (empty($date1)){
			$tpfilt= "";
		}else{
			$tpfilt= "date(%s.created)='$bgdate1'";
		}
	}else{
		if (empty($date1)){
die("getjourqu=1");
		}else{
			$tpfilt= "date(%s.created)>='$bgdate1' and date(%s.created)<='$bgdate2'";
		}
	}
//var_dump($tpfilt);
//print sprintf($tpfilt,"jour","jour");
	
	# конст.код за делото 
	$fili= " ,suit.serial as caseseri, suit.year as caseyear";
	
	# 06.05.2009 - ръчно добавени записи 
	# тип=0 
	# връзки : jour -> suit 
								# евент.доп.филтър за таблицата 
								$filt= (empty($tpfilt)) ? "" : "and ".sprintf($tpfilt,"jour","jour");
//var_dump($filt);
/*
	$qujour= "select jour.id as id
		,'' as serial, '' as year, jour.created
		,0 as type $fili 
			,jour.descrip as descrip
						,jour.person as person
		from jour
		left join suit on jour.idcase=suit.id
		where year(jour.created)='$year'
								$filt
		";
*/
			# 06.10.2010 - 
			# всяко ръчно добавено действие може да има списък с дела, а не само едно 
# флаг дали за всяко дело да се образува отделен номер в дневника 
global $isjoursepa;
					if ($isjoursepa){
	$qusub= "select * from jour where year(created)='$year' $filt";
/*
	$qujour= "select t2.id as id
		,'' as serial, '' as year, t2.created
		,0 as type $fili 
			,t2.descrip as descrip
						,t2.person as person
		from joursuit
		left join ($qusub) as t2 on joursuit.idjour=t2.id
		left join suit on joursuit.idcase=suit.id
		where t2.id is not null
		";
*/		
					# 15.12.2010 включваме и действията без изп.дело 
	$qujour= "
	(
		select t2.id as id
		,'' as serial, '' as year, t2.created
		,0 as type $fili 
			,t2.descrip as descrip
						,t2.person as person
		from joursuit
		left join ($qusub) as t2 on joursuit.idjour=t2.id
		left join suit on joursuit.idcase=suit.id
		where t2.id is not null
	)
	union all 
	(
		select jour.id as id
		,'' as serial, '' as year, jour.created
		,0 as type 
,0 as caseseri, 0 as caseyear
			,jour.descrip as descrip
						,jour.person as person
		from jour
		left join joursuit on joursuit.idjour=jour.id
		where year(jour.created)='$year'
								$filt
		and joursuit.id is null
	)
		";
					}else{
	$qujour= "select jour.id as id
		,'' as serial, '' as year, jour.created
		,0 as type 
,0 as caseseri, 0 as caseyear
			,jour.descrip as descrip
						,jour.person as person
		from jour
		where year(jour.created)='$year'
								$filt
		";
					}
					# 15.12.2010 включваме и действията без изп.дело 
	$tajour= md5(microtime()) ."jour";
global $DB;
	$DB->query("create temporary table `$tajour` $qujour");
	$qujour= "select * from `$tajour`";

	# тип=1 
	# входящи документи 
	# връзки : docu > suit 
				# 13.04 2009 - един документ - много дела 
								# евент.доп.филтър за таблицата 
								$filt= (empty($tpfilt)) ? "" : "and ".sprintf($tpfilt,"docu","docu");
	$qudocu= "select docu.id as id
		,docu.serial, docu.year, docu.created
		,1 as type ,'' as caseseri ,'' as caseyear
			,docu.text as descrip
						,'' as person
		from docu
		where year(docu.created)='$year'
								$filt
		";
	# тип=2 
	# изходящи документи 
	# docuout.serial<>0 - само изведените 
	# връзки : docuout-suit, docuout-docutype 
								# евент.доп.филтър за таблицата 
//								$filt= (empty($tpfilt)) ? "" : "and ".sprintf($tpfilt,"docuout","docuout");
								$tpfiltout= str_replace("created","registered",$tpfilt);
								$filtout= (empty($tpfiltout)) ? "" : "and ".sprintf($tpfiltout,"docuout","docuout");
	# описанието - според дали е ръчно въведен 
//			,docutype.text as descrip
//	$codedesc= "case when docuout.isentered=1 then docuout.descrip else docutype.text end";
	$codedescdout= "case when docuout.isentered=1 then docuout.descrip else docutype.text end";
/*
	$qudocuout= "select docuout.id as id
		,docuout.serial, docuout.year, docuout.created
		,2 as type $fili 
			,$codedesc as descrip
						,docuout.adresat as person
		from docuout
		left join suit on docuout.idcase=suit.id
			left join docutype on docuout.iddocutype=docutype.id 
		where docuout.serial<>0
		and year(docuout.created)='$year'
								$filt
		";
*/
//		,docuout.serial, docuout.year, docuout.registered
	$qudocuout= "select docuout.id as id
		,docuout.serial, docuout.year, docuout.registered as created
		,2 as type $fili 
			,$codedescdout as descrip
						,docuout.adresat as person
		from docuout
		left join suit on docuout.idcase=suit.id
			left join docutype on docuout.iddocutype=docutype.id 
		where docuout.serial<>0
		and year(docuout.registered)='$year'
								$filtout
		";
//			,$codedesc as descrip
/****
	# тип=3 
	# постъпили плащания в брой (прих.касов ордер) 
	# връзки : cash-suit 
								# евент.доп.филтър за таблицата 
								$filt= (empty($tpfilt)) ? "" : "and ".sprintf($tpfilt,"cash","cash");
	$leva= toutf8("лв");
	$qucash= "select cash.id as id 
		,cash.serial, cash.year, cash.created
		,3 as type $fili 
			,concat(cash.amount,' $leva ',cash.text) as descrip
						,'' as person
		from cash
		left join suit on cash.idcase=suit.id
		where year(cash.created)='$year'
								$filt
		";
	# тип=4 
	# постъпили плащания в състава на банков пакет 
	# bank.idclaimer>0 - само насочените към взискател-дело 
	# връзки : bank-claimer-suit, bank-bankpack 
								# евент.доп.филтър за таблицата 
								$filt= (empty($tpfilt)) ? "" : "and ".sprintf($tpfilt,"bankpack","bankpack");
	$leva= toutf8("лв");
	$qupack= "select id,created from bankpack where year(created)='$year' $filt";
	$qubank= "select bank.id as id 
		,'' as serial, '' as year, t2.created
		,4 as type $fili 
			,concat(bank.AMOUNT_C,' $leva ',bank.TR_NAME,' ',bank.REM_I,' ',bank.REM_II) as descrip
						,'' as person
		from bank
		left join claimer on bank.idclaimer=claimer.id
		left join suit on claimer.idcase=suit.id
		left join ($qupack) as t2 on bank.idbankpack=t2.id
		where bank.idclaimer>0
		and t2.id is not null
		";
****/

#---------------------------------------------------------------------------------------------------
# 17.11.2009 
	# тип=3 
	# постъпили плащания - всички видове 
	# връзки : finance-suit-debtor 
/*
								# евент.доп.филтър за таблицата 
//								$filt= (empty($tpfilt)) ? "" : "and ".sprintf($tpfilt,"cash","cash");
								$tpfiltfina= str_replace("created","time",$tpfilt);
								$filtfina= (empty($tpfiltfina)) ? "" : "and ".sprintf($tpfiltfina,"finance","finance");
	$leva= toutf8("лв");
	$qufina= "select finance.id as id 
		,'' as serial, '' as year, finance.time as created
		,3 as type $fili 
			,concat(finance.inco,' $leva ','/',finance.idtype) as descrip
						,debtor.name as person
		from finance
		left join suit on finance.idcase=suit.id
		left join debtor on finance.iddebtor=debtor.id
		where year(finance.time)='$year'
								$filtfina
		";
*/
# 21.10.2010 - доп.поле dateinco = дата на постъпление 
								# евент.доп.филтър за таблицата 
								$tpfiltfina= str_replace("created","dateinco",$tpfilt);
								$filtfina= (empty($tpfiltfina)) ? "" : "and ".sprintf($tpfiltfina,"finance","finance");
	if($year <= $euro_first_year) {
		$leto= toutf8(" лв към ");
		$qufinatoclai= "select `$tawork`.id as id
		,'' as serial, '' as year, `$tawork`.created as created
		,5 as type $fili
/*------ ,`$tawork`.idcase ------*/
		,concat('$txcl',round(`$tawork`.claiamou * {$euro_to_lev_multiplier}, 2),'$leto',claimer.name) as descrip
		,'' as person
		from `$tawork`
		left join claimer on `$tawork`.idclai=claimer.id
		left join suit on `$tawork`.idcase=suit.id
		";
	} else {
		$leto= toutf8(" € към ");
		$qufinatoclai= "select `$tawork`.id as id
		,'' as serial, '' as year, `$tawork`.created as created
		,5 as type $fili
/*------ ,`$tawork`.idcase ------*/
		,concat('$txcl',`$tawork`.claiamou,'$leto',claimer.name) as descrip
		,'' as person
		from `$tawork`
		left join claimer on `$tawork`.idclai=claimer.id
		left join suit on `$tawork`.idcase=suit.id
		";
	}
#---------------------------------------------------------------------------------------------------

# 17.03.2010 
	# тип=4 
	# връчени ПДИ 
	# датата на връчване aainvita.date да не е празна - само връчените 
	# връзки : docuout-suit 
								# евент.доп.филтър за таблицата 
# 21.05.2010 - оправена грешка 
# aainvita няма поле created, използваме полето date 
//$tpfilt= str_replace("created","date",$tpfilt);
//								$filtinvi= (empty($tpfilt)) ? "" : "and ".sprintf($tpfilt,"aainvita","aainvita");
								$tpfiltinvi= str_replace("created","date",$tpfilt);
								$filtinvi= (empty($tpfiltinvi)) ? "" : "and ".sprintf($tpfiltinvi,"aainvita","aainvita");
	# описанието 
//	$codedesc= toutf8("'връчена ПДИ'");
	$codedesc= toutf8("concat('връчена ПДИ изх.док.',docuout.serial,'/',docuout.year)");
	$quaainvi= "select aainvita.id as id
		,docuout.serial, docuout.year, aainvita.date as created
		,4 as type $fili 
			,$codedesc as descrip
						,aainvita.person as person
		from aainvita
		left join docuout on aainvita.iddocuout=docuout.id
		left join suit on docuout.idcase=suit.id
		where aainvita.date<>'' and year(aainvita.date)='$year'
								$filtinvi
		";
//print $quaainvi;
//print_rr($GLOBALS["DB"]->select($quaainvi));

#---------------------------------------------------------------------------------------------------
# 19.11.2010 - нов тип [Дичев] 
	# тип=5 извършени плащания - ЧСИ > взискатели 
								# евент.доп.филтър за таблицата 
/*
								$tpfiltfina= str_replace("created","timeclosed",$tpfilt);
								$filtfina= (empty($tpfiltfina)) ? "" : "and ".sprintf($tpfiltfina,"finance","finance");
//var_dump($filtfina);
	# четем данните за постъпления 
global $DB;
//	$leva= toutf8("лв");
	$arfina= $DB->select("select finance.id as id 
		,finance.timeclosed as created
		,finance.toclai
		,finance.idcase
		from finance
		where year(finance.timeclosed)='$year'
								$filtfina
		");
*/
	# използваме поле datebala [дата погасяване], а не timeclosed [дата приключване] 
	# само непразните datebala 
								$tpfiltfina= str_replace("created","datebala",$tpfilt);
								$filtfina= (empty($tpfiltfina)) ? "" : "and ".sprintf($tpfiltfina,"finance","finance");
//var_dump($filtfina);
	# четем данните за постъпления 
global $DB;
//	$leva= toutf8("лв");
# 31.03.2011 Дичев - 
# постъпленията директно на взискателя да не се отразяват в дневника 
# idtype<>9 да се съгласува с масива $listfinatype - commspec.php 
$filtfinatype= "finance.idtype<>9";
	$arfina= $DB->select("select finance.id as id 
		,finance.datebala as created
		,finance.toclai
		,finance.idcase
		from finance
		where year(finance.datebala)='$year' and finance.isclosed<>0 and finance.datebala<>''
								$filtfina
and $filtfinatype
		");
	# временна таблица заради десериализирането на полето toclai 
	$tawork= md5(microtime());
	$DB->query("create temporary table `$tawork` (
		id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		created char(20),
		type tinyint(3) unsigned,
		idcase bigint(20) unsigned,
			idclai bigint(20) unsigned,
  			claiamou char(255),
  		PRIMARY KEY (id)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1		
		");
	# попълваме врем.таблица - размножаваме по взискатели 
	foreach($arfina as $elem){
		$toclai= $elem["toclai"];
		$artoclai= unsetoclai($toclai);
					unset($elem["id"]);
					unset($elem["toclai"]);
		foreach($artoclai as $idclai=>$clamou){
			$elem["idclai"]= $idclai;
			$elem["claiamou"]= $clamou;
			if ($idclai > 0 and $clamou+0 <> 0){
//print_rr($elem);
				$DB->query("insert into `$tawork` set ?a"  ,$elem);
			}else{
			}
		}
	}
	# заявката - елемент от union 
	$txcl= toutf8("извършено плащане ");
	if($year <= $euro_first_year) {
		$leto= toutf8(" лв към ");
		$qufinatoclai= "select `$tawork`.id as id
		,'' as serial, '' as year, `$tawork`.created as created
		,5 as type $fili
/*------ ,`$tawork`.idcase ------*/
		,concat('$txcl',round(`$tawork`.claiamou * {$euro_to_lev_multiplier}, 2),'$leto',claimer.name) as descrip
		,'' as person
		from `$tawork`
		left join claimer on `$tawork`.idclai=claimer.id
		left join suit on `$tawork`.idcase=suit.id
		";
	} else {
		$leto= toutf8(" € към ");
		$qufinatoclai= "select `$tawork`.id as id
		,'' as serial, '' as year, `$tawork`.created as created
		,5 as type $fili
/*------ ,`$tawork`.idcase ------*/
		,concat('$txcl',`$tawork`.claiamou,'$leto',claimer.name) as descrip
		,'' as person
		from `$tawork`
		left join claimer on `$tawork`.idclai=claimer.id
		left join suit on `$tawork`.idcase=suit.id
		";
	}
//print_rr($DB->select($qufinatoclai));

# 14.10.2014 Божилова - 
# тип=6 връчване/невръчване на изх.документ 
$postdatecode= "if(post.date2='',date3,date2)";
$filtposttype= "$postdatecode<>''";
								
								//$filtpost= (empty($tpfilt)) ? "" : "and ".sprintf("%s.created",$postdatecode,$postdatecode);
								$filtpost= (empty($tpfilt)) ? "" : "and ".str_replace("date(%s.created)",$postdatecode,$tpfilt);
	$delitext= toutf8("връчване");
				# код за метода 
global $listtypepost_utf8;
									//include_once "deli.inc.php";
					$codemeth= "";
				foreach($listtypepost_utf8 as $indx=>$text){
					$codemeth .= "when $indx then '$text' ";
				}
					$codemeth= "case post.idposttype $codemeth end";
	$qufina= "select post.id as id 
		,docuout.serial as serial, docuout.year as year, $postdatecode as created
		,6 as type $fili 
			,concat('$delitext',' ',$codemeth,' ',$codedescdout,' ',poststat.name) as descrip
						,post.adresat as person
		from post
		left join poststat on post.idpoststat=poststat.id
		left join docuout on post.iddocuout=docuout.id
		left join docutype on docuout.iddocutype=docutype.id 
		left join suit on docuout.idcase=suit.id
		where year($postdatecode)='$year'
								$filtpost
and $filtposttype
		";
#---------------------------------------------------------------------------------------------------
	
/*
	# общата заявка 
	$myquery= "
						($qujour) 
		union all 
	($qudocu) 
		union all 
	($qudocuout) 
		union all 
	($qucash) 
		union all 
	($qubank) 
		order by created
	";
*/
	# общата заявка 
	$myquery= "
						($qujour) 
		union all 
	($qudocu) 
		union all 
	($qudocuout) 
		union all 
	($qufina) 
		union all 
	($quaainvi) 
		union all 
	($qufinatoclai) 
		order by date(created) $orddate, created, caseyear, caseseri, type, id
	";
//		order by date(created) desc, created, caseyear, caseseri
//		order by created desc, caseyear, caseseri

//print $myquery;
return $myquery;
}


?>
