<?php

								include_once "commdb.php";

# за прих.касов ордер 
# връща следващия свободен номер за текущата година 
//# ако няма записи, взема номера от основ.данни 
//# ВНИМАНИЕ. Трябва да са заключени таблиците : docuout, user, office 
//#     източник : cazo6regi.ajax.php 
function getnextcash(){
global $DB;
	$myyear= (int) date("Y");
					# ВНИМАНИЕ. 26.06.2009 
					# в таблицата finance има постъпления от различен тип, затова търсим само тип=2=ПКО 
					# ако липсват записи, резултата е същия 
//	$maxser= $DB->selectCell("select max(cashserial) from finance where cashyear=? and idtype=2" ,$myyear);
/*
	# 08.08.2011 - ПКО вече има и в табл.claimadva - аванс.такси от взискатели 
	$se1= "select cashserial from finance where cashyear=$myyear and idtype=2";
	$se2= "select cashserial from claimadva where cashyear=$myyear and iscash=1";
	$maxser= $DB->selectCell("select max(cashserial) from (($se1) union distinct ($se2)) as t2");
*/
	$se1= "select cashserial from finance where cashyear=$myyear and idtype=2";
	$se2= "select cashserial from claimadva where cashyear=$myyear and iscash=1";
	$se3= "select cashserial from prih where cashyear=$myyear";
	$maxser= $DB->selectCell("select max(cashserial) from (($se1) union distinct ($se2) union distinct ($se3)) as t2");
	if ($maxser==0){
		$cashseri= 1;
	}else{
		$cashseri= $maxser + 1;
	}
return $cashseri;
}

# 08.08.2011 - ПКО вече има и в табл.claimadva - аванс.такси от взискатели 
# дали сер.номер не е зает 
function iscashseriuniq($cashyear,$cashseri,$cashidcode){
global $DB;
	$se1= "select cashserial, concat('fina',id) as cashidcode from finance where cashyear=$cashyear and idtype=2";
	$se2= "select cashserial, concat('adva',id) as cashidcode from claimadva where cashyear=$cashyear and iscash=1";
	$se3= "select cashserial, concat('prih',id) as cashidcode from prih where cashyear=$cashyear";
	$mycoun= $DB->selectCell("select count(*) from (($se1) union distinct ($se2) union distinct ($se3)) as t2 
		where cashserial=$cashseri and cashidcode<>'$cashidcode'");
return ($mycoun==0);
}

# за прих.касов ордер 
# връща следващия свободен номер за текущата година 
//# ВНИМАНИЕ. Трябва да са заключени таблиците : razh 
function getnextcashrazh(){
global $DB;
	$myyear= (int) date("Y");
	$maxser= $DB->selectCell("select max(cashserial) from razh where cashyear=?" ,$myyear);
	if ($maxser==0){
		$cashseri= 1;
	}else{
		$cashseri= $maxser + 1;
	}
return $cashseri;
}

# трансформираме стринга с изх.документ преди разпечатване 
# логото получава абсолютен път 
function logotran($cont){
	$sear= ".php";
	$what= "[LOGOPREFIX]";
				# подготвяме съдържанието 
				$cont= stripslashes($cont);
				# за абсолютния адрес на логото <img= src="http://......"> 
				$refe= $_SERVER["HTTP_REFERER"];
//print $refe;
				$pind= strpos($refe,$sear);
				if ($pind===false){
				}else{
					$subs= substr($refe,0,$pind);
					$pind= strrpos($subs,"/");
					$pref= substr($subs,0,$pind+1);
//var_dump($pref);
	$cont= str_replace($what,$pref,$cont);
				}
return $cont;
}


# масова трансформация на слешовете - за извеждане 
function arstrip($value){
	$value = is_array($value) ?	array_map('arstrip', $value) : stripslashes($value);
return $value;
}
# и масово добавяне на слешове - за масив от чекбоксове 
function addsla($value){
	$value = is_array($value) ?	array_map('addsla', $value) : addslashes($value);
return $value;
}

/***
# за прих.касов ордер 
# връща следващия свободен номер за текущата година 
//# ако няма записи, взема номера от основ.данни 
//# ВНИМАНИЕ. Трябва да са заключени таблиците : docuout, user, office 
//#     източник : cazo6regi.ajax.php 
function getnextcash(){
global $DB;
	$myyear= (int) date("Y");
					# ВНИМАНИЕ. 26.06.2009 
					# в таблицата finance има постъпления от различен тип, затова търсим само тип=2=ПКО 
					# ако липсват записи, резултата е същия 
	$maxser= $DB->selectCell("select max(cashserial) from finance where cashyear=? and idtype=2" ,$myyear);
	if ($maxser==0){
		$cashseri= 1;
	}else{
		$cashseri= $maxser + 1;
	}
return $cashseri;
}
***/

# за изходящ документ 
# връща следващия свободен номер за текущата година 
# ако няма записи, взема номера от основ.данни 
# ВНИМАНИЕ. Трябва да са заключени таблиците : docuout, user, office 
#     източник : cazo6regi.ajax.php 
function getnextout(){
global $DB;
	$myyear= (int) date("Y");
//	$maxser= $DB->selectCell("select max(serial) from docuout where year=?" ,$myyear);
//return $maxser + 1;
					# ВНИМАНИЕ. 13.05.2009 
					# при създаване изх.документи получават номер нула, а истинския номер - по-късно при регистрация 
					# затова в таблицата търсим не дали изобщо има записи, а дали има само записи с нулеви номера 
					# ако липсват записи, резултата е същия 
//	$counreco= $DB->selectCell("select count(*) from docuout");
	$maxser= $DB->selectCell("select max(serial) from docuout where year=?" ,$myyear);
	if ($maxser==0){
		$doutseri= getoffbegi("begidocuout");
		$doutseri= ($doutseri==0) ? 1 : $doutseri;
	}else{
//		$maxser= $DB->selectCell("select max(serial) from docuout where year=?" ,$myyear);
		$doutseri= $maxser + 1;
	}
return $doutseri;
}
function outnext($p1,$p2){
/******
		$time= date("d.m.Y-H:i:s-u");
		$mitime= microtime();
	$f1= fopen("outnext.txt","a");
//	fwrite($f1,"outnext=$time=$p2=$p1\n");
//	fwrite($f1,"micro=$mitime\n");
	fwrite($f1,"outnext=$time=$p2=$p1\n"."micro=$mitime\n");
	fclose($f1);
******/
}

# за дело 
# връща следващия свободен номер за текущата година 
# ако няма записи, взема номера от основ.данни 
# ВНИМАНИЕ. Трябва да са заключени таблиците : case, user, office 
#     източник : cazo6regi.ajax.php 
function getnextcase(){
global $DB;
	$myyear= (int) date("Y");
					# ВНИМАНИЕ. 13.05.2009 
					# при създаване изх.документи получават номер нула, а истинския номер - по-късно при регистрация 
					# затова в таблицата търсим не дали изобщо има записи, а дали има само записи с нулеви номера 
					# ако липсват записи, резултата е същия 
	$maxser= $DB->selectCell("select max(serial) from suit where year=?" ,$myyear);
	if ($maxser==0){
		$caseseri= getoffbegi("begicase");
		$caseseri= ($caseseri==0) ? 1 : $caseseri;
	}else{
		$caseseri= $maxser + 1;
	}
return $caseseri;
}


				# 06.05.2009 - незапочнало добров.изпълнение на ПДИ в нормативния срок 7/14 дена 
# евент. променяме флага на делото flagstat 
# $idca = suit.id 
# ВНИМАНИЕ. 
# преди извикване трябва евент.да е извършено заключване с lock tables 
function invicaseupdate($newflag,$idca,$mustupdate){
global $DB;
	# зачитаме само състоянията на флага за ПДИ - 0, 2 
	# текущото може да flagstat=1 - висящо - тогава не го пипаме 
	if ($mustupdate){
	}else{
		$roca= getrow("suit",$idca);
		$flca= $roca["flagstat"];
		if ($flca==0 or $flca==2){
			$mustupdate= true;
		}else{
		}
	}
	if ($mustupdate){
		$hset= array();
		$hset["flagstat"]= $newflag;
		$DB->query("update suit set ?a, lastdocu= now() where id=?d" ,$hset,$idca);
	}else{
	}
}

				# 23.04.2009 - за въвеждане на датата в бг формат 
				# трансформира от MySQL в бг 
function bgdatefrom($mydate){
	list($ye,$mo,$da)= explode("-",substr($mydate,0,10));
//	$da= str_pad($da,2,"0",STR_PAD_LEFT);
//	$mo= str_pad($mo,2,"0",STR_PAD_LEFT);
		# 04.06.2010 - заради Тозева, имаше [space] отзад 
		$ye= trim($ye);
		$mo= trim($mo);
		$da= trim($da);
	$bgdate= "$da.$mo.$ye";
return $bgdate;
}

				# 23.04.2009 - за въвеждане на датата в бг формат 
				# трансформира от бг в MySQL 
function bgdateto($bgdate){
	list($da,$mo,$ye)= explode(".",$bgdate);
		# 04.06.2010 - заради Тозева, имаше [space] отзад 
		$ye= trim($ye);
		$mo= trim($mo);
		$da= trim($da);
	$da= str_pad($da,2,"0",STR_PAD_LEFT);
	$mo= str_pad($mo,2,"0",STR_PAD_LEFT);
			# 19.11.2009 
			if (strlen($ye)==4){
			}else{
				$ye= "20" .$ye;
			}
	$bgcano= "$ye-$mo-$da";
return $bgcano;
}

				# 13.04 2009 - един документ - много дела 
function get_docu_of_case($idcase){
global $DB;
	$docuqu= "select 
			docu.*, docu.id as id
		from docusuit
			left join docu on docusuit.iddocu=docu.id
		where docusuit.idcase=?
		ORDER BY docu.year ASC, docu.serial ASC
        ";
	$doculist= $DB->select($docuqu ,$idcase);
	$doculist= dbconv($doculist);
return $doculist;
}

				# 13.04 2009 - един документ - много дела 
function getcaselist($iddocu){
global $DB;
	$casequ= "
		select docusuit.*, docusuit.id as id
			,suit.serial as caseseri ,suit.year as caseyear
			,user.name as username
		from docusuit
			left join suit on docusuit.idcase=suit.id
			left join user on suit.iduser=user.id
		where docusuit.iddocu=?d
		order by docusuit.docurange
		";
	$caselist= $DB->select($casequ ,$iddocu);
	$caselist= dbconv($caselist);
return $caselist;
}

				# 06.10.2010 - 
				# всяко ръчно добавено действие може да има списък с дела, а не само едно 
function getcaselistjour($idjour){
global $DB;
//var_dump($idjour);
	$casequ= "
		select 
			suit.serial as caseseri ,suit.year as caseyear
		from joursuit
			left join suit on joursuit.idcase=suit.id
		where joursuit.idjour=?d
		order by caseyear, caseseri
		";
	$caselist= $DB->select($casequ ,$idjour);
	$caselist= dbconv($caselist);
//print_rr($caselist);
return $caselist;
}

/*
				# едно изв.действие - много дела 
				# списък на изв.действия за дадено дело 
function get_jour_of_case($idcase){
global $DB;
	$jourqu= "select 
			jour.*, jour.id as id
		from joursuit
			left join jour on joursuit.idjour=jour.id
		where joursuit.idcase=?
		";
	$jourlist= $DB->select($jourqu ,$idcase);
	$jourlist= dbconv($jourlist);
return $jourlist;
}
*/

function putiplog($paerr,$pauser){
global $DB;
	$pset= array();
	$pset["ipaddr"]= $_SERVER["REMOTE_ADDR"];
	$pset["iduser"]= $pauser +0;
	$pset["errtype"]= $paerr +0;
	$DB->query("insert into ipuser set ?a, time=now()" ,$pset);
}

function getipparams(){
	$rooffi= getofficerow(0);
	$arpa= explode("^",$rooffi["ipparams"]);
//	$arresu["acti"]= $arpa[0];
	$arresu["acti"]= $rooffi["ipactive"];
	$arresu["mail"]= $arpa[0];
	$arresu["mes1"]= $arpa[1];
	$arresu["mes2"]= $arpa[2];
	$arresu["from"]= $arpa[3];
return $arresu;
}
function putipparams($arpa){
global $DB, $idoffice;
//	$arip[0]= $arpa["acti"];
	$arip[0]= $arpa["mail"];
	$arip[1]= $arpa["mes1"];
	$arip[2]= $arpa["mes2"];
	$arip[3]= $arpa["from"];
	$ipparams= implode("^",$arip);
	$DB->query("update office set ipparams=? where id=?" ,$ipparams,$idoffice);
}
function putipactive($pact){
global $DB, $idoffice;
	$DB->query("update office set ipactive=? where id=?" ,$pact,$idoffice);
}


$taxtablename= "TAXTABLE.TXT";
$taxglobalname= "taxtab";

function gettax(){
global $taxglobalname, $taxtablename;
			if (isset($GLOBALS[$taxglobalname])){
			}else{
	$ar1= file($taxtablename);
//print_r(toutf8($ar1));
						$arresu= array();
	foreach($ar1 as $elem){
		if (substr($elem,0,1)=="#"){
		}else{
						$arresu[]= explode("\t",$elem);
		}
	}
//print_r($arresu);
	$GLOBALS[$taxglobalname]= $arresu;
			}
//return $arresu;
}

function calctax($sumcollect){
global $taxglobalname;
//print "<br>calctax=$sumcollect=";
	gettax();
	$artax= $GLOBALS[$taxglobalname];
	$cotax= count($artax);
//print_r($artax);
	foreach ($artax as $indx=>$cont){
		if ($indx==$cotax){
			break;
		}else{
		}
		if ($sumcollect <= $cont[0]){
			$indx --;
			break;
		}else{
		}
	}
	$base= $artax[$indx][0];
	$fixi= $artax[$indx][1];
	$proc= $artax[$indx][2];
	$resu= $fixi + 0.01*$proc*($sumcollect-$base);
//print "<br>[$indx][$base][$fixi][$proc][$resu]";
# 13.10.2009 - директно с ДДС и закръглено 
return round(1.2*$resu,2);
}

# 06.01.2010 - MySQL филтър за лихв.процент БНБ 
# причина - URL за процента вече на работи - виж percfrombnb.inc.php 
$MYFILTPERC= "where substring(bnb,1,4)<>'not.'";

function getpercent(){
global $DB, $MYFILTPERC;
return $arperc= $DB->select("select * from percent $MYFILTPERC order by id");
}

function getoffbegi($beginame){
global $iduser;
	$rooffi= getofficerow($iduser);
	$begico= $rooffi[$beginame];
	$begico= ($begico==0) ? 1 : $begico;
return $begico;
}

function getofficerow($iduser){
	$rouser= getrow("user",$iduser);
	$idoffi= $rouser["idoffice"];
	# ЗАСЕГА САМО ПЪРВИЯ ЗАПИС от таблицата с ЧСИ 
	$idoffi= ($idoffi==0) ? 1 : $idoffi;
	$rooffi= getrow("office",$idoffi);
	$headtext= $rooffi["text"];
	$_SESSION["headtext"]= $headtext;
return $rooffi;
}


function dbconv($p1){
	$resu= array();
	foreach($p1 as $indx=>$cont){
		if (is_array($cont)){
			$resu[$indx]= dbconv($cont);
		}else{
			$resu[$indx]= iconv("UTF-8","windows-1251",$cont);
		}
	}
return $resu;
}

/*
function db($query,$isconv=true){
global $DB;
	$resu= $DB->select($query);
	if ($isconv){
		$resu= dbconv($resu);
	}else{
	}
return $resu;
}
function dbcol($query,$isconv=true){
global $DB;
	$resu= $DB->selectCol($query);
	if ($isconv){
		$resu= dbconv($resu);
	}else{
	}
return $resu;
}
function dbrow($query,$isconv=true){
global $DB;
	$resu= $DB->selectRow($query);
	if ($isconv){
		$resu= dbconv($resu);
	}else{
	}
return $resu;
}
*/


function updatabslist(){
global $GETPARAM;
	$mode= $GETPARAM["mode"];
	$page= $GETPARAM["page"];
	$filt= $GETPARAM["filt"];
//	$edit= $GETPARAM["edit"];
	$editel= "mode=$mode&page=$page&filt=$filt";
				if (isset($_SESSION["tabs"])){
	foreach ($_SESSION["tabs"] as $tain=>$x2){
		$_SESSION["tabs"][$tain]["link"]= geturl($editel ."&edit=".$tain);
												# 09.11.2009 - директен линк за премахване от списъка с табовете 
		$_SESSION["tabs"][$tain]["goout"]= geturl($editel ."&goout=".$tain);
	}
				}else{
				}
}

/*
#------------ jsCalendar -----------------
define ("CALEINIT", '
<link rel="stylesheet" type="text/css" media="all" href="jscalendar/calendar-win2k-1.css" />
<script type="text/javascript" src="jscalendar/calendar.js"></script>
<script type="text/javascript" src="jscalendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="jscalendar/calendar-setup.js"></script>
');
*/

#--------------------------------- общи константи -------------------------------------
# тип за админите 
define("ADMINTYPE",37);
# ВНИМАНИЕ. hard coded constant 
define("ADMINSPECTIME","2009-01-17 18:51:12");

# суфикс за имената всички файлове за кеширане - специално за select вътре в ajax 
# - съдържанието е сериализиран масив в UTF-8 
define("SUFFUTF8","_utf8");
# име на файл за кеширане на "идва от" 
//define("COFROMFILE","_cofrom");
define("COFROMFILE","cache/_cofrom");
# име на вътр.директория с шаблоните за изх.документи 
define("OUTDIR","outgoing/");

# $listyear - масив с години за избор 
$baseyear= 2005;
$curryear= (int) date("Y");
$listyear= array(0=>"");
for ($i=$curryear; $i>=$baseyear; $i--){
	$listyear[$i]= $i;
}

# $listdocutype - масив с типове входящи документи 
$listdocutype[0]= "";
							/*
							# ВНИМАНИЕ. 25.02.2009 
							# временни корекции - само за процеса на изравняване документите от началото на 2009 год.
							# с реалния темп на въвеждане 
							#     нормалния вариант на този скрипт е 3commspec.php 
							*/
/*
$listdocutype[1]= "ново дело";
$listdocutype[2]= "съществуващо дело";
$listdocutype[3]= "извън дела";
$listdocutype[4]= "старо дело";
*/
							/*
							//$listdocutype[1]= "ново дело";
							$listdocutype[2]= "съществуващо дело за 2009 г.";
							$listdocutype[3]= "извън дела";
							$listdocutype[4]= "старо дело ПРЕДИ 2009 г.";
							*/
			/*
			# 17.03.2009 
			# номерацията на делата вече е изравнена 
			# ВНИМАНИЕ. 
			# Преди тази корекция (и съотв.в docuedit.ajax.php) изтрий кухитедела от DB таблицата suit 
			$listdocutype[1]= "създай ново дело със следващия номер за текущата година";
			$listdocutype[2]= "документа е за съществуващо дело с въведените номер/година";
			$listdocutype[4]= "създай старо дело с въведения номер за година преди текущата";
			$listdocutype[9]= "документа не се отнася за дело";
			*/
$listdocutype_utf8= toutf8($listdocutype);

# $listtitu - масив с титули на делата 
/*
$listtitu[0]= "";
$listtitu[1]= "изпълнителен лист";
$listtitu[2]= "наказателно постановление";
$listtitu[3]= "обезпечителна заповед";
$listtitu[4]= "нотариален акт";
$listtitu[5]= "несъстоятелност";
$listtitu[6]= "договор за залог";
*/
$listtitu[0]= "";
$listtitu[1]= "изпълнителен лист";
$listtitu[2]= "обезпечителна заповед";
$listtitu[3]= "АДВ";
$listtitu[4]= "НАП";
$listtitu[5]= "наказателно постановление";
$listtitu[6]= "акт";
$listtitu_utf8= toutf8($listtitu);
		# 05.05.2009 - паралелен масив със сроковете за добр.изпълнение на ПДИ 
		#    по ГПК = 14 дни 
		#    по ДОПК = 7 дни 
		$timetitu[1]= 14;
		$timetitu[2]= 14;
		$timetitu[3]= 7;
		$timetitu[4]= 7;
		$timetitu[5]= 7;
		$timetitu[6]= 7;
	# 01.06.2011 - паралелен масив със сроковете за доброволно събиране за отчет раздел 2 
	#    по ГПК = 17 дни 
	#    по ДОПК = 10 дни 
	$timerep2[1]= 17;
	$timerep2[2]= 17;
	$timerep2[3]= 10;
	$timerep2[4]= 10;
	$timerep2[5]= 10;
	$timerep2[6]= 10;
/*
		# 24.04.2009 - разширен списък - без промяна в номерацията 
		# двумерен масив - заради optgroup - FormPersister 
$listtitu[0]= "";
	$liti[1]= "решение";
	$liti[14]= "заповед за изпълнение";
	$liti[16]= "заповед за незабавно изп.";
$listtitu["изпълнителен лист"]= $liti;
$listtitu[2]= "обезпечителна заповед";
$listtitu[3]= "АДВ";
$listtitu[4]= "НАП";
$listtitu[5]= "наказателно постановление";
$listtitu_utf8= toutf8($listtitu);
*/


		# 03.05.2009 - редове от статистическия отчет 
		# двумерен масив - заради избор select/option-optgroup - FormPersister 
$listrepo[0]= "";
/*
	$lire1[11]= "публични държавни вземания";
	$lire1[12]= "частни държавни вземания";
$listrepo["в полза на държавата"]= $lire1;
*/
									# юни 2019 промени в отчетите раздел 1 и 2 
										$lire1[11]= "публични вземания";
										$lire1[12]= "частни вземания";
									$listrepo["в полза на държавни органи"]= $lire1;
										$lire7[71]= "публични вземания";
										$lire7[72]= "частни вземания";
									$listrepo["в полза на общините"]= $lire7;
									$listrepo[8]= "в полза на съдилища";
	$lire2[21]= "в полза на банки";
	$lire2[22]= "в полза на търговци";
	$lire2[23]= "в полза на други ЮЛ";
$listrepo["в полза на юрид.лица и търговци"]= $lire2;
	$lire3[31]= "за издръжка";
	$lire3[32]= "по трудови спорове";
	$lire3[33]= "предаване на дете";
	$lire3[34]= "други";
$listrepo["в полза на граждани"]= $lire3;
$listrepo[4]= "изпълнение на чуждестр.решения";
$listrepo[5]= "изпълнение на обезпечит.мерки";
$listrepo_utf8= toutf8($listrepo);
		# формираме отделен едномерен масив - само за извеждане 
$viewrepo= createview($listrepo);
$viewrepo_utf8= toutf8($viewrepo);
					# специално за отчета 
					# паралелен масив с шифрите на редовете от отчета 
					$repocode[0]= "0";
/*
						$repocode[11]= "1110";
						$repocode[12]= "1120";
*/
									# юни 2019 промени в отчетите раздел 1 и 2 
										$repocode[11]= "1120";
										$repocode[12]= "1130";
									$repocode[71]= "1150";
									$repocode[72]= "1160";
										$repocode[8]= "1170";
					$repocode[21]= "1210";
					$repocode[22]= "1220";
					$repocode[23]= "1230";
						$repocode[31]= "1310";
						$repocode[32]= "1320";
						$repocode[33]= "1330";
						$repocode[34]= "1340";
					$repocode[4]= "1400";
					$repocode[5]= "1500";

		# 03.05.2009 - текущ статус на делото 
		# двумерен масив - заради избор select/option-optgroup - FormPersister 
		# нулевото състояние е нормално (активно дело) 
$listcasestat[0]= "";
$listcasestat[4]= "перемирано";
$listcasestat[8]= "спряно";
	$lica1[121]= "1. разписка от взискателя";
	$lica1[122]= "2. писмено от взискателя";
	$lica1[123]= "3. обезсилен изп.лист";
	$lica1[124]= "4. отменен акт за изп.лист";
	$lica1[125]= "5. непродаваемо имущество";
	$lica1[126]= "6. неплатени авансови такси";
	$lica1[127]= "7. уважен иск чл.439 или 440";
	$lica1[128]= "8. изтекъл 2-год.срок";
# 08.09.2010 - Велева 
	$lica1[129]= "9. по други причини";
$listcasestat["прекратено чл.433(1)"]= $lica1;
$listcasestat[16]= "свършено";
	$lica2[201]= "по молба на взискателя";
	$lica2[202]= "по резолюция на ЧСИ";
	$lica2[203]= "връщане на регистър приет от друг ЧСИ";
$listcasestat["изпратено на друг ЧСИ"]= $lica2;
$listcasestat[24]= "висящо";
$listcasestat_utf8= toutf8($listcasestat);
		# формираме отделен едномерен масив - само за извеждане 
$viewcasestat= createview($listcasestat);
$viewcasestat_utf8= toutf8($viewcasestat);
		# формираме списък с индекси за филтриране - прекратени и свършени 
			$listterminate= array();
			$listterminate[]= 16;	
		foreach($lica1 as $liin=>$x2){
			$listterminate[]= $liin;	
		}
$codeinterm= implode(",",$listterminate);
		# отделна променлива за индекса на висящо дело 
$indxhang= 24;

# двумерен масив - заради избор select/option-optgroup - FormPersister 
# функция - формира и връща съответен 1-мерен масив - само за извеждане 
function createview($ar1){
				$resu= array();
	foreach($ar1 as $indx=>$cont){
		if (is_array($cont)){
			foreach($cont as $ind2=>$con2){
				$resu[$ind2]= "$indx - $con2";
			}
		}else{
				$resu[$indx]= $cont;
		}
	}
return $resu;
}



# 13.01.2011 
# $listsubtit - масив с подтитули за титул "изп.лист" 
$listextraint["10"]= "10 % ";
$listextraint["20"]= "20 % ";
$listextraint_utf8= toutf8($listextraint);

# $listsubtit - масив с подтитули за титул "изп.лист" 
$listsubtit[0]= "";
$listsubtit[1]= "417-1 акт на адм.орган";
$listsubtit[2]= "417-2 извлечение счет.книги";
$listsubtit[3]= "417-3 нотариален акт";
$listsubtit[4]= "417-4 особен залог - обезпечение";
$listsubtit[5]= "417-5 особен залог - договор";
$listsubtit[6]= "417-6 договор за залог";
$listsubtit[7]= "417-7 акт за вземане";
$listsubtit[8]= "417-8 акт за начет";
$listsubtit[9]= "417-9 запис на заповед";
$listsubtit[10]= "410";
$listsubtit[11]= "404";
$listsubtit[12]= "решение";
$listsubtit[13]= "акт за установяване на задължение";
$listsubtit[14]= "чл.35 от ЗОЗ";
$listsubtit_utf8= toutf8($listsubtit);

# $listsort - масив с видове на делата 
$listsort[0]= "";
$listsort[1]= "АХНД";
//$listsort[2]= "ЧГД";
$listsort[2]= "ч.гр.д.";
$listsort[3]= "НОХД";
$listsort[4]= "НЧХД";
$listsort[5]= "ГП по трудов спор";
$listsort[6]= "адм.дело";
//$listsort[7]= "търг.дело";
$listsort[7]= "т.д.";
$listsort[8]= "ЧНД";
//	$listsort[10]= "ГД";
	$listsort[10]= "гр.д.";
	$listsort[9]= "други";
$listsort_utf8= toutf8($listsort);

# $listsubjtype - масив с типове предмет на изпълнение 
$listsubjtype[0]= "";
/*
$listsubjtype[1]= "олихвяема сума";
$listsubjtype[2]= "неолихвяема сума";
$listsubjtype[3]= "месечна сума";
$listsubjtype[4]= "непарични вземания";
*/
$listsubjtype[1]= "олихвяема сума";
$listsubjtype[2]= "неолихвяема сума";
$listsubjtype[3]= "месечна олихвяема сума";
$listsubjtype[5]= "месечна НЕОЛИХВ.сума";
$listsubjtype[4]= "непарични вземания";
# 13.01.2011 - месечна неолихвяема сума 
$listsubjtype_utf8= toutf8($listsubjtype);
		# същото за съкратено извеждане в таблица 
/*
		$listsubjtype2[1]= "олихвяема";
		$listsubjtype2[2]= "неолих";
		$listsubjtype2[3]= "месечна";
		$listsubjtype2[4]= "непарично";
*/
		$listsubjtype2[1]= "олихвяема";
		$listsubjtype2[2]= "неолих";
		$listsubjtype2[3]= "мес.олихв";
		$listsubjtype2[5]= "мес.НЕОЛИХВ";
		$listsubjtype2[4]= "непарично";
		$listsubjtype2_utf8= toutf8($listsubjtype2);

# $listsubjst - масив с подтипове за тип "неолихв.сума" 
/*
$listsubjst[0]= "";
$listsubjst[1]= "по изпълнителния лист";
$listsubjst[2]= "начислени такси";
$listsubjst[3]= "допълнителни разноски";
$listsubjst[4]= "приети други разходи";
$listsubjst_utf8= toutf8($listsubjst);
		# същото за съкратено извеждане в таблица 
		$listsubjst2[1]= "изп.лист";
		$listsubjst2[2]= "такси";
		$listsubjst2[3]= "доп.разн";
		$listsubjst2[4]= "др.разх";
		$listsubjst2_utf8= toutf8($listsubjst2);
*/
/***
$listsubjst[0]=  "";
$listsubjst[4]=  "по изпълнителния лист";
$listsubjst[6]=  "по обезпечителна заповед";
$listsubjst[8]=  "авансови такси";
$listsubjst[12]= "субсидирани такси";
$listsubjst[16]= "допълнителни разноски";
$listsubjst[18]= "по удостоверение от ЧСИ";
$listsubjst[20]= "приети други разходи";
//$listsubjst[99]= "такса ЧСИ чл.26";
$listsubjst_utf8= toutf8($listsubjst);
		# същото за съкратено извеждане в таблица 
		$listsubjst2[4]=  "изп.лист";
		$listsubjst2[6]=  "обезпеч.зап";
		$listsubjst2[8]=  "аванс.такси";
		$listsubjst2[12]= "субс.такси";
		$listsubjst2[16]= "доп.разнос";
		$listsubjst2[20]= "други.разх";
//		$listsubjst2[99]= "такса.ЧСИ";
		$listsubjst2_utf8= toutf8($listsubjst2);
***/

$listsubjst[0]=  "";
$listsubjst[4]=  "по изпълнителния лист";
$listsubjst[6]=  "по обезпечителна заповед";
$listsubjst[8]=  "авансови такси";
$listsubjst[12]= "субсидирани такси";
$listsubjst[16]= "допълнителни разноски";
$listsubjst[18]= "по удостоверение от ЧСИ";
//$listsubjst[20]= "приети други разходи";
# 05.11.2013 от Каримов 
$listsubjst[30]= "акт";
$listsubjst[34]= "наказат.постановление";
//$listsubjst[99]= "такса ЧСИ чл.26";
# ВНИМАНИЕ. разместване 
$listsubjst[20]= "приети други разходи";
$listsubjst_utf8= toutf8($listsubjst);
		# същото за съкратено извеждане в таблица 
		$listsubjst2[4]=  "изп.лист";
		$listsubjst2[6]=  "обезпеч.зап";
		$listsubjst2[8]=  "аванс.такси";
		$listsubjst2[12]= "субс.такси";
		$listsubjst2[16]= "доп.разнос";
$listsubjst2[30]= "акт";
$listsubjst2[34]= "наказат.пост";
		$listsubjst2[20]= "други.разх";
//		$listsubjst2[99]= "такса.ЧСИ";
		$listsubjst2_utf8= toutf8($listsubjst2);

#~~~~~~ 09.05.2011 за отчет раздел 2 ~~~~~~~~~~~~~~~~~~~ 
# тип/подтип за дълга - към колони отчет 2 
# съгласувано с $listsubjtype и $listsubjst - commspec.php 
$rep2col= array();
	$rep2col["1/0"]=  "9";
	$rep2col["3/0"]=  "9";
	$rep2col["5/0"]=  "9";
$rep2col["2/4"]=  "9";
//==$rep2col["2/8"]=  "5";
//==$rep2col["2/12"]= "5";
$rep2col["2/8"]=  "c5dru";
$rep2col["2/12"]= "c5dru";
$rep2col["2/16"]= "6";
$rep2col["2/18"]= "7";
$rep2col["2/20"]= "7";
//==	$rep2col["t26/"]=  "5";
	$rep2col["t26/"]=  "c5fee";
	$rep2col["lih/"]=  "8";

function getr2col($p1,$p2){
global $rep2col;
	$p1a += 0;
	$p2a += 0;
			if ($p1a==0){
	$ind2= $p1 .'/' .$p2;
			}else{
	$ind2= $p1a .'/' .$p2a;
			}
//var_dump($ind2);
return $rep2col[$ind2];
}

# масив с характери на изпълнението 
$listchartype[0]= "";
$listchartype[1]= "продажба движими вещи";
$listchartype[2]= "продажба недвиж. вещи";
$listchartype[3]= "въвод";
$listchartype[4]= "предаване движ.вещи";
//$listchartype[5]= "друго";
$listchartype[5]= "други принудит.действия";
$listchartype_utf8= toutf8($listchartype);
# характер по подразбиране - за формата 
define("CASECHARDEFA",5);

# $listsubjst - масив с права за потребител 
//$listperm[0]= "";
$listperm[2]= "входящи документи";
$listperm[3]= "дела";
# 15.06.2009 - добавихме права финанси 
$listperm[4]= "финанси";
//# ВНИМАНИЕ. 
//# индекса е разместен заради визуалното подреждане 
//$listperm[1]= "потребители";
$listperm_utf8= toutf8($listperm);

# $listsubjst - масив с типове участник 
$listmembtype[0]= "";
$listmembtype[1]= "юридическо лице";
$listmembtype[2]= "физическо лице";
$listmembtype[3]= "други";
$listmembtype_utf8= toutf8($listmembtype);








# $listsubjst - масив с типове обхват при търсене на дело 
//$listcaserang[0]= "";
$listcaserang[3]= "взискател и длъжници";
$listcaserang[1]= "само взискател";
$listcaserang[2]= "само длъжници";
$listcaserang_utf8= toutf8($listcaserang);

# 24.04.2009 - статуси на жалба 
/*
$liststatcomp[0]= "";
$liststatcomp[1]= "удовлетворена";
$liststatcomp[2]= "неудовл.";
*/
# 21.01.2011 - нови статуси 
//$liststatcomp[0]= "входена";
$liststatcomp[2]= "приета от ЧСИ";
$liststatcomp[4]= "внесена такса";
$liststatcomp[6]= "удовлетворена";
$liststatcomp[8]= "неудовл.";
$liststatcomp_utf8= toutf8($liststatcomp);
	# съответните имена на полета от заявка 
//	$liststatfiel[0]= "registered";
	$liststatfiel[2]= "date2";
	$liststatfiel[4]= "date4";
	$liststatfiel[6]= "date6";
	$liststatfiel[8]= "date8";

# ВНИМАНИЕ. константа, зависима от данните 
# трябва да е съгласувана с id на записа за жалба в табл. aadocutype 
# документа е жалба, ако docu.idtype=$TYPECOMP 
$TYPECOMP= 2;

# 24.06.2009 - типове финансови постъпления за дело 
$listfinatype[0]= "";
//$listfinatype[1]= "превод";
//$listfinatype[2]= "в_брой";
//$listfinatype[9]= "друго";
$listfinatype[1]= "банков превод към ЧСИ";
$listfinatype[2]= "платено в.брой на ЧСИ";
$listfinatype[7]= "старо плащане към ЧСИ";
$listfinatype[9]= "директно на взискателя";
$listfinatype_utf8= toutf8($listfinatype);
		# същото за съкратено извеждане в таблица 
//		$listfinatype2[1]= "превод";
		$listfinatype2[1]= "банка";
		$listfinatype2[2]= "в-брой";
		$listfinatype2[7]= "старо";
//		$listfinatype2[9]= "директно";
		$listfinatype2[9]= "на-взиск";
		$listfinatype2_utf8= toutf8($listfinatype2);


# 31.08.2009 - типове xml формати за банкови извлечения 
$listxmltype[""]= "";
$listxmltype["ubb"]= "ОББ";			$listxmlsuff["ubb"]= ".xml";
$listxmltype["ali"]= "Алианц";		$listxmlsuff["ali"]= ".xml";
$listxmltype["ccb"]= "ЦКБ";			$listxmlsuff["ccb"]= ".csv";
$listxmltype["mub"]= "Общинска";	$listxmlsuff["mub"]= ".xls";
$listxmltype["dsk"]= "ДСК";			$listxmlsuff["dsk"]= ".txt";
$listxmltype["pos"]= "Пощенска";	$listxmlsuff["pos"]= ".xml";
$listxmltype["alb"]= "Алфабанк";	$listxmlsuff["alb"]= ".csv";
$listxmltype["uni"]= "Уникредит";	$listxmlsuff["uni"]= ".xml";
$listxmltype_utf8= toutf8($listxmltype);

# 13.10.2009 - схеми на погасяване 
$listpayoff[0]= "неолих-лихва-главница";
$listpayoff[1]= "главница-лихва-неолих";
$listpayoff_utf8= toutf8($listpayoff);



# 08.10.2010 - заради Регистъра на длъжници/взискатели - подтипове юрид.лице 
//$list1type[0]= "";
//$list1type[3]= "юрид.лице със стопанска цел";
$list1type[2]= "едноличен търговец";
$list1type[3]= "юрид.лице търговец";
$list1type[4]= "юрид.лице с нестопанска цел";
$list1type[5]= "друго юрид.лице";
$list1type_utf8= toutf8($list1type);

# 08.10.2010 - заради Регистъра на длъжници/взискатели - подтипове други 
$list3type[0]= "";
$list3type[6]= "община";
$list3type[7]= "държавата";
$list3type[8]= "дружество";
$list3type_utf8= toutf8($list3type);

/*@@@
# 08.10.2010 - заради Регистъра на длъжници/взискатели - статуси юрид.лице 
//$list1stat[""]= "";
$list1stat[0]= "активен";
$list1stat[1]= "в ликвидация";
$list1stat[2]= "в несъстоятелност";
$list1stat_utf8= toutf8($list1stat);
@@@*/

# 08.10.2010 - заради Регистъра предмети на изпълнение - типове вземания 
//$list1stat[""]= "";
$list4type[0]= "";
$list4type[1]= "частно вземане";
$list4type[2]= "частно държавно вземане";
$list4type[3]= "частно общинско вземане";
$list4type[4]= "публично държавно вземане";
$list4type[5]= "публично общински вземане";
$list4type_utf8= toutf8($list4type);

# 08.10.2010 - заради Регистъра предмети на изпълнение - видове вземания 
//$list1stat[""]= "";
$list4vari[0]= "";
$list4vari[1]= "парично вземане";
$list4vari[2]= "непарично вземане";
$list4vari[3]= "обезпечителни мерки";
$list4vari_utf8= toutf8($list4vari);

# 16.05.2014 - регистър-2014 
		# произход на вземане 
		$list4orig[0]= "";
		$list4orig[1]= "Договор за потребителски кредит";
		$list4orig[2]= "Договор за ипотечен кредит";
		$list4orig[3]= "Бизнес кредит обезпечен с ипотека";
		$list4orig[4]= "Друг бизнес кредит";
		$list4orig[5]= "Друг кредит";
		$list4orig[6]= "Застрахователно събитие";
		$list4orig[7]= "Договор за заем";
		$list4orig[8]= "Договор за наем";
		$list4orig[9]= "Запис на заповед";
		$list4orig[10]= "Трудово правоотношение";
		$list4orig[11]= "Издръжка";
		$list4orig[12]= "Въвод във владение";
		$list4orig[13]= "Предаване на движима вещ";
		$list4orig[14]= "предаване на дете";
		$list4orig[15]= "Глоба";
		$list4orig[16]= "Данък";
		$list4orig[17]= "Друго";
		$list4orig_utf8= toutf8($list4orig);

		# относителен път за компонентите 
		$reg4path= "reg4/";
		# име-файл с параметри 
		$mypath= dirname(realpath(__FILE__));
//var_dump($reg4path);
		$reg4finame= $mypath ."/".$reg4path ."regi14.txt";
//var_dump($reg4finame);
		# разделител
		$reg4delimi= "^";

		function reg4getpara(){
global $reg4finame, $reg4delimi;
			$reg4user= "";
			$reg4pass= "";
			if (file_exists($reg4finame)){
				$pacont= file_get_contents($reg4finame);
				$crcont= mycrypt("get",$pacont);
				list($reg4user,$reg4pass)= explode($reg4delimi,$crcont);
			}else{
			}
return array($reg4user,$reg4pass);
		}


# 08.10.2010 - заради Регистъра - номер дело 
function regicaseseri($p1){
return str_pad($p1,5,"0",STR_PAD_LEFT);
}




# константи за лихвените проценти 
# име на файла с процентите 
$percent_logfile= "cache/getpercent.log";
# име на файла с история на обновяването 
$percent_file= "cache/percent";


/*
# ВНИМАНИЕ - ЗАВИСИМОСТ ОТ БД 
# покана за доброволно изпълнение 
# docutype.id за този тип изходящ документ 
$IDINVITA= 4;
*/
# условие за ПДИ 
# 10.09.2009 ПДИ вече се маркират чрез полето mark=pdi 
function getpdlist(){
global $DB;
	$arpdii= $DB->selectCol("select id from docutype where mark='pdi'");
	$pdlist= implode(",",$arpdii);
	$pdlist= "0," .$pdlist;
//print "[$pdlist]";
return $pdlist;
}

function ExcelHeader($filename="outp"){
	header("Content-type: application/vnd.ms-word");
	header("Content-Disposition: attachment; filename=$filename" );
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
	header("Pragma: public");
}

function getnochange($idca){
global $smarty;
//global $logisadmin;
//var_dump($logisadmin);
						$rooffi= getofficerow($_SESSION["iduser"]);
						$NOPERMUSER= ($rooffi["isnopermuser"]<>0);
//var_dump($NOPERMUSER);
$logadm= $_SESSION["LOGGEDISADMIN"];
//var_dump($logadm);
						if ($NOPERMUSER or $logadm){
	$resu= false;					
						}else{
	$roca= getrow("suit",$idca);
	$resu= ($roca["iduser"]<>$_SESSION["iduser"]);
						}
$smarty->assign("FLAGNOCHANGE", $resu);
return $resu;
}


# сериализацията на не-Unicode стрингове не работи добре - реже стринга от началото 
# сериализацията на Unicode стрингове не работи добре - записва невярна дължина на стринга и дава грешка при десериализация 
# заместваме ги с нови функции 
function seriraw($arp1){
				$arresu= array();
	foreach($arp1 as $indx=>$elem){
				$arresu[$indx]= rawurlencode($elem);
	}
return serialize($arresu);
}

function unseriraw($p1){
	$myar= unserialize($p1);
				$arresu= array();
	foreach($myar as $indx=>$elem){
				$arresu[$indx]= rawurldecode($elem);
	}
return $arresu;
}

# връща пълния номер на делото 
# $rooffi - данните за кантората - трябва да е прочетен предварително 
# източник : 
#     cazo6creadocu.inc.php - function exnu 
# двете функции трябва да са съгласувани 
function getfullnumb($rocase){
global $rooffi;
return $rocase['year'] .$rooffi['serial'] . "04" .str_pad($rocase['serial'],5,"0",STR_PAD_LEFT);
}

# връща сума, редуцирана според броя на дните в месеца 
# необходима за нач. и крайния месец при месечен дълг 
function sumreduce($suma,$date,$type){
	list($frye,$frmo,$frda)= explode("-",$date);
				if (function_exists("cal_days_in_month")){
	$daycount= cal_days_in_month(CAL_GREGORIAN, $frmo, $frye);
				}else{
	$daycount= days_in_month($frmo, $frye);
				}
	if (0){
	}elseif ($type=="toend"){
		$dayrest= $daycount - $frda;
	}elseif ($type=="frombegin"){
		$dayrest= $frda;
	}else{
die("sumreduce=type=$type");
	}
	$sumrest= $suma / $daycount * $dayrest;
return round($sumrest,2);
}

# 08.01.2009 - за четене на шаблонен .html 
function readtemphtml($fnam){
global $smarty;
			$incpat= dirname(__FILE__);
			$smarty->assign("INCPAT", "$incpat/outgoing/");
//print $incpat;
//print "<br>FNAM=";
//var_dump($fnam);
							# 04.02.2010 - рожден ден на тате 
			# ЛЕПЕНКА. оправена важна грешка 
							# INCPAT е заради хедър/футер в шаблоните на Дервиш 
							# - за да се вмъкнат файловете с хедър/футер e необходимо предварително заместване чрез Smarty 
							# когато обаче в шаблона има {empty}{/empty} го приема за Smarty таг и дава грешка 
							# затова сменяме скобите за Smarty имената - съответно и в шаблоните на Дервиш 
							$GLOBALS["smartyleft"]= "[[";
							$GLOBALS["smartyright"]= "]]";
			$cont= smdisp("$incpat/$fnam","fetch");
							unset($GLOBALS["smartyleft"]);
							unset($GLOBALS["smartyright"]);
//print "<xmp>$cont</xmp>";
//print $cont;
//die();
return $cont;
}

/* ----------------- from PHP Manual ---------------------
 * days_in_month($month, $year) 
 * Returns the number of days in a given month and year, taking into account leap years. 
 * 
 * $month: numeric month (integers 1-12) 
 * $year: numeric year (any integer) 
 * 
 * Prec: $month is an integer between 1 and 12, inclusive, and $year is an integer. 
 * Post: none 
 */ 
// corrected by ben at sparkyb dot net 
function days_in_month($month, $year){ 
return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31); 
} 

# 19.02.2010 - обесването на Левски 
# специална функция за десериализиране на toclai 
# - разпределение на постъплението по взискатели 
# иначе даваше грешка cazobala=507 
function unsetoclai($p1){
	if ($p1==""){
return array();
	}else{
return unserialize($p1);
	}
}

# 11.06.2010 - дали дадена таблица съществува в БД 
function tabexists($arctab){
global $DB;
//	$dbindx= "Tables_in_exof";
	$dbindx= "Tables_in_".$GLOBALS["dbname"];
//	$arctab= "archive";
	$listtabl= $DB->query("show tables");
				$result= false;
	foreach($listtabl as $elem){
		if ($elem[$dbindx]==$arctab){
				$result= true;
			break;
		}else{
		}
	}
return $result;
}

# 12.01.2011 - за избор на "идва от" select/optgroup 
function selcofrom(){
global $DB;
	$query= "select id as ARRAY_KEY, name from cofrom %s order by serial, id";
	$q1= sprintf($query,"where idtype=0");
		$data1= $DB->selectCol($q1);
//		$data1= array(0=>"") + $data1;
	$q2= sprintf($query,"where idtype=1");
		$data2= $DB->selectCol($q2);
//		$data2= array(0=>"") + $data2;
//		$gr1= toutf8("съдилища");
//		$gr2= toutf8("други източници");
	$gr1= "съдилища";
	$gr2= "други източници";
				$ardata= array();
				$ardata[0]= "";
				$ardata[toutf8($gr1)]= $data1;
				$ardata[toutf8($gr2)]= $data2;
//print_rr($ardata);
	$ardata= arstrip($ardata);
return $ardata;
}


# 16.03.2011 - генериране на парола за наблюдател (Дичев) 
function passgene(){
	$p1= md5(microtime());
		$ar= rand(1,10);
	$p2= substr($p1,0,$ar);
	$p3= substr($p1,$ar-10);
		$xr= rand(65,90);
	$p4= $p2 .chr($xr) .$p3;
return $p4;
}

# Copyright (c) 2006 Georgi Chorbadzhiyski
# All rights reserved.
# 	http://georgi.unixsol.org/
/* Check if EGN is valid */
/* See: http://www.grao.bg/esgraon.html */
$EGN_WEIGHTS = array(2,4,8,5,10,9,7,3,6);
function egn_valid($egn) {
        global $EGN_WEIGHTS;
        if (strlen($egn) != 10)
            return false;
        $year = substr($egn,0,2);
        $mon  = substr($egn,2,2);
        $day  = substr($egn,4,2);
        if ($mon > 40) {
            if (!checkdate($mon-40, $day, $year+2000)) return false;
        } else
        if ($mon > 20) {
            if (!checkdate($mon-20, $day, $year+1800)) return false;
        } else {
            if (!checkdate($mon, $day, $year+1900)) return false;
        }
        $checksum = substr($egn,9,1);
        $egnsum = 0;
        for ($i=0;$i<9;$i++)
            $egnsum += substr($egn,$i,1) * $EGN_WEIGHTS[$i];
        $valid_checksum = $egnsum % 11;
        if ($valid_checksum == 10)
            $valid_checksum = 0;
        if ($checksum == $valid_checksum)
            return true;
}


?>
