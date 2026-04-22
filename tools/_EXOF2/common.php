<?php

#---------------------- dklab/dbsimple ---------------------------
# full DB 
require_once $dkpref."dklab/dbsimple/Generic.php";
							$dbconst= getdbconst();
$DB = DbSimple_Generic::connect($dbconst);
							$DB->query("SET NAMES 'utf8'");
$DB->setErrorHandler('databaseErrorHandler');
function databaseErrorHandler($message, $info){
	if (!error_reporting()) return;
	echo "SQL Error: $message<br><pre>"; 
	print_r($info);
	echo "</pre>";
	exit();
}

# extract DB 
							$dbconst2= getdbconst2();
$DB2 = DbSimple_Generic::connect($dbconst2);
							$DB2->query("SET NAMES 'utf8'");
$DB2->setErrorHandler('databaseErrorHandler');




function print_rr($p1){
	print "<pre>";
	$resu= print_r($p1);
	print "</pre>";
}

function arr2tab($data,$tablname){
global $DB2;
	foreach($data as $elem){
		$DB2->query("insert into $tablname set ?a"  ,$elem);
	}
}

function todb2($tablname,$filt="", $grp = "") { 
global $DB, $DB2;
	$filt= ($filt=="") ? "" : "where $filt";
	$grp= ($grp=="") ? "" : "group by $grp";
	$mylist= $DB->select("select * from $tablname $filt $grp");
	$mylist= arstrip($mylist);
//	$DB2->query("truncate table $tablname");
//	arr2tab($mylist,$tablname);
return $mylist;
}

function unsetoclai($p1){
	if ($p1==""){
return array();
	}else{
return unserialize($p1);
	}
}

function arstrip($value){
	$value = is_array($value) ?	array_map('arstrip', $value) : stripslashes($value);
return $value;
}


#----------------------- за изчисляване на актуалния дълг ----------------------------


#--------------------------- Smarty -----------------------------------
		# заради алтернативното извикване от поддир. /FCKlocal - fclgetpage.php 
define("SMARTY_DIR","./smarty/");
					# CAPITAL LETTER - not smarty.class.php
include SMARTY_DIR ."Smarty.class.php";
$smarty= new Smarty();

# заместител на smarty->display с избор на вариант - 0=frontend 1=backend
function sdisplay($mode, $temp0, $temp1="", $fetch=""){
global $smarty;
	if ($mode==0){
		$smarty->template_dir= 'html/';
		$smarty->config_dir= 'html/';
# отделни директории - заради правилното изпълнение на smarty-include-file 
$smarty->compile_dir= 'smarty/templates_c/';
			$smarty->left_delimiter= "[[";
			$smarty->right_delimiter= "]]";
		$smarty->assign("CSSPATH","html/");
		$diname= $temp0;
	}elseif ($mode==1){
					if ($temp1==""){
die("sdisplay=empty");
					}else{
					}
		$smarty->template_dir= 'smtemp/';
		$smarty->config_dir= 'smtemp/';
# отделни директории - заради правилното изпълнение на smarty-include-file 
$smarty->compile_dir= 'smtemp/compiled/';
			$smarty->left_delimiter= "{";
			$smarty->right_delimiter= "}";
//		$smarty->assign("CSSPATH","smtemp/");
							# 04.02.2010 - рожден ден на тате 
							# ЛЕПЕНКА. оправена важна грешка 
							# INCPAT е заради хедър/футер в шаблоните на Дервиш 
							if (isset($GLOBALS["smartyleft"])){
			$smarty->left_delimiter= $GLOBALS["smartyleft"];
			$smarty->right_delimiter= $GLOBALS["smartyright"];
							}else{
							}
							# 07.12.2010 заради шаблона BILL.HTML 
							if (isset($GLOBALS["smartytempdir"])){
			$smarty->template_dir= $GLOBALS["smartytempdir"];
							}else{
							}
		$smarty->assign("CSSPATH","css/");
		$diname= $temp1;
	}else{
die("sdisplay=mode=$mode");
	}
			if ($fetch=="fetch"){
return $smarty->fetch($diname);
			#---- октомври-2008 ---- 
			# заради jQuery-ajax съдържанието 
			}elseif ($fetch=="iconv"){
//return iconv("windows-1251","UTF-8",$smarty->fetch($diname));
# и заради кавичките в адреса и др.стрингове 
return iconv("windows-1251","UTF-8", stripslashes($smarty->fetch($diname)));
			}else{
$smarty->display($diname);
			}
}

# същото, но само за backend 
function smdisp($temp, $fetch=""){
return sdisplay(1,"",$temp,$fetch);
}


# 06.01.2010 - MySQL филтър за лихв.процент БНБ 
# причина - URL за процента вече на работи - виж percfrombnb.inc.php 
$MYFILTPERC= "where substring(bnb,1,4)<>'not.'";
function getpercent(){
global $DB, $MYFILTPERC;
return $arperc= $DB->select("select * from percent $MYFILTPERC order by id");
}

# връща един запис от таблица като масив 
function getrow($taname,$paid){
global $DB;
	$row= $DB->selectRow("select * from $taname where id=?" ,$paid);
	$row= dbconv($row);
//			# 13.03.2009 ПЕТЪК - важно за извеждането в изх.документи 
//			$row= nl2br($row);
//			array_walk($row,"getrowbr");
return $row;
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

# връща сума, редуцирана според броя на дните в месеца 
# необходима за нач. и крайния месец при месечен дълг 
function sumreduce($suma,$date,$type){
//++++++++print "<br>sumreduce=[$suma][$date][$type]";
/***
						# 11.02.2011 КРЪПКА. 
						if (empty($date)){
							if (0){
							}elseif ($type=="toend"){
global $rocase;
								if (isset($rocase)){
print "<br>rocase=toend=OK=";
//print_rr($rocase);
									$date= substr( $rocase["created"] ,0,10);
print "$date";
								}else{
print "<br>rocase=toend=notset";
								}
							}elseif ($type=="frombegin"){
									$date= date("Y-m-d");
print "<br>rocase=frombegin=$date";
							}else{
die("sumreduce=type=$type");
							}
						}else{
						# if (empty($date)){
						}
***/
	list($frye,$frmo,$frda)= explode("-",$date);
				if (function_exists("cal_days_in_month")){
	$daycount= cal_days_in_month(CAL_GREGORIAN, $frmo, $frye);
				}else{
	$daycount = $frmo == 2 ? ($frye % 4 ? 28 : ($frye % 100 ? 29 : ($frye % 400 ? 28 : 29))) : (($frmo - 1) % 7 % 2 ? 30 : 31);
//	$daycount= days_in_month($frmo, $frye);
				}
	if (0){
	}elseif ($type=="toend"){
		$dayrest= $daycount - $frda;
	}elseif ($type=="frombegin"){
		$dayrest= $frda;
	}else{
die("sumreduce2=type=$type");
	}
	$sumrest= $suma / $daycount * $dayrest;
return round($sumrest,2);
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


?>
