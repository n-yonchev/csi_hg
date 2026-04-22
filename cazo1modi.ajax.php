<?php
# отгоре : 
#    $iduser - логнатия потребител 
//#    $mode - текущия режим 
//#    $view - case.id за разглеждане 
//# отгоре : 
#    $edit= case.id за модифициране 
#    $zone= 1
#    $func= modi 
//print "correction [$iduser][$mode][$edit][$zone][$func]";

			# 02.03.2010 - скрипта се вика вече и от rep1list.php 
			# номера на делото за извеждане 
			$rosu= getrow("suit",$edit);
			$smarty->assign("SERIYEAR", $rosu["serial"]."/".$rosu["year"]);

# таблицата 
$taname= "suit";
# шаблона 
$tpname= "cazo1modi.ajax.tpl";
# полетата 
$filist= array(
# 29.05.2009 Бъзински - да се корегира датата на образуване 
"created"=> array("validator"=>"bgdate_valid_notempty")
# 08.04.2010 - вече не е задължително 
//	,"text"=>  array("validator"=>"notempty", "error"=>"описанието не може да е празно")
	,"text"=> NULL
# не работи след корекцията с динамичното добавяне 
# затова проверяваме във функцията 
//	,"idcofrom"=>  array("validator"=>"notzero", "error"=>"\"идва от\" е задължително поле")
,"idcofrom"=>  NULL
	,"cogrou"=>  NULL
	,"idtitu"=>  array("validator"=>"notzero", "error"=>"титула е задължително поле")
	,"idsubtit"=>  NULL
	,"dateexec"=>  NULL
,"nomecomm"=>  NULL
	,"datecomm"=>  NULL
# 14.10.2009 - обезп.заповед и наказат.постановл.
,"_obezpe_nakaza"=> NULL
	,"idsort"=>  array("validator"=>"notzero", "error"=>"вида е задължително поле")
	,"conome"=>  array("validator"=>"notempty", "error"=>"номера не може да е празен")
	,"coyear"=>  array("validator"=>"notempty", "error"=>"годината не може да е празна")
# 03.05.2009 - ред от статистическия отчет 
,"idrepo"=>  array("validator"=>"notzero", "error"=>"реда за отчета е задължително поле")
# 03.05.2009 - текущ статус на делото 
# нулевото състояние е нормално (активно дело) - не е грешка 
,"idstat"=>  NULL
	,"idchar"=>  array("validator"=>"notzero", "error"=>"характера е задължително поле")
//	,"idpayoff"=>  array("validator"=>"notzero", "error"=>"схемата е задължително поле")
	,"idpayoff"=>  NULL
# за регистъра на завед.дела 
	,"claimdescrip"=>  array("validator"=>"notempty", "error"=>"денните за вземането са задължителни")
# 08.04.2010 - вече не е задължително 
//	,"idclaimorig"=>   array("validator"=>"notzero", "error"=>"произхода е задължително поле")
	,"idclaimorig"=> NULL
# 02.08.2010 отчет-1 - да се корегира датата на послед.статус 
,"timestat"=> array("validator"=>"bgdate_valid_notempty")
# 13.01.2011 - надбавка ОЛП 
	,"extraint"=>  array("validator"=>"notzero", "error"=>"надбавката е задължителна")
# 16.05.2014 - заради ЦРД-2014 
	,"idtypereg4"=>  array("validator"=>"notzero", "error"=>"типа е задължително поле")
	,"idvarireg4"=>  array("validator"=>"notzero", "error"=>"вида е задължително поле")
	,"idorigreg4"=>  array("validator"=>"notzero", "error"=>"произхода е задължително поле")
);

					# 18.02.2009 
					# специална проверка за вземане на ново дело - виж newc.php - линк с ["newcase"] 
					if (substr($edit,0,1)=="@"){
									$GETNEW= true;
						$edit= substr($edit,1);
						/*
						# назначаваме логнатия юзер към делото 
						$sset= array();
						$sset["iduser"]= $iduser;
						$DB->query("update suit set ?a, lastdocu=now() where id=?" ,$sset,$edit);
						*/
					}else{
					}

# константни полета 
//$ficonst= array("iduser"=>$iduser);
$ficonst= array();

# за линка - добави нов идва от 
$addcofrom= geturl("mode=idva&edit=0&cazo1=yes");
$smarty->assign("ADDCOFROM", $addcofrom);

									# класа за редактиране 
									include_once "edit.class.php";

# редактиране 
$obedit= new edit($taname,$edit,$filist,$ficonst);
# функция за допълнит.грешки 
$obedit->errorfunc= "funcer";
# 29.05.2009 Бъзински - да се корегира датата на образуване 
# специфична функция за състояние INIT 
$obedit->funcinit= "funcinit";
# действие 
$reedit= $obedit->action();
//var_dump($reedit);
//print_r($_POST);

# резултат 
if ($reedit==0){
#--------------------------------------------------------------------------------
			# 17.12.2009 - оправена грешка 
			# корекцията на формата на датата НЕ се правеше при вземане на ново дело, само при корекция на съществуващо 
			# сега вече е ОК, специален скрипт за синхронизация на старите данни - _created.php 
		# 29.05.2009 Бъзински - да се корегира датата на образуване 
		# допълнителни корекции на записа - датата в MySQL формат 
		$crea= $_POST["created"];
		$creacano= bgdateto($crea);
			$aset= array();
			$aset["created"]= $creacano;
			$aset["lastdocu"]= $creacano;
		$DB->query("update suit set ?a where id=?d" ,$aset,$obedit->paid);
#--------------------------------------------------------------------------------
# 15.05.2010 - адвокат - специална обработка 
$agent= $_POST["agent"];
$agent= trim($agent);
if (empty($agent)){
	$idag= 0;
}else{
	$idag= $DB->selectCell("select id from agent where name=?"  ,$agent);
	if ($idag==0){
		$gset= array();
		$gset["name"]= $agent;
		$idag= $DB->query("insert into agent set ?a" ,$gset);
	}else{
	}
}
	$aset= array();
	$aset["idagent"]= $idag;
# 02.08.2010 отчет-1 - да се корегира датата на послед.статус 
		$timestat= $_POST["timestat"];
		$timestat= bgdateto($timestat);
		if ($_POST["idstat"]==0){
			$timestat= "";
		}else{
		}
	$aset["timestat"]= $timestat;
$DB->query("update suit set ?a where id=?d" ,$aset,$obedit->paid);
#--------------------------------------------------------------------------------
					# 18.02.2009 
					# специална проверка дали приключваме вземане на ново дело 
					if ($GETNEW){
		# назначаваме логнатия юзер към делото 
		$sset= array();
		$sset["iduser"]= $iduser;
		$DB->query("update suit set ?a, lastdocu=now() where id=?" ,$sset,$edit);
						# reload - след успешен събмит 
						# - към списъка с делата на логнатия потребител 
						# ВНИМАНИЕ. 
						# викаме явно index.php, защото текущия скрипт е друг - caseeditzone.php - виж cazo1modi.ajax.tpl 
//						$relurl= "index.php".geturl("mode=case");
						$relurl= "index.php".geturl("mode=cas1");
						reload("parent",$relurl);
exit;
					}else{
/*
# 29.05.2009 Бъзински - да се корегира датата на образуване 
						# допълнителни корекции на записа - датата в MySQL формат 
						$crea= $_POST["created"];
						$creacano= bgdateto($crea);
							$aset= array();
							$aset["created"]= $creacano;
							$aset["lastdocu"]= $creacano;
						$DB->query("update suit set ?a where id=?d" ,$aset,$obedit->paid);
*/
			# 02.03.2010 - скрипта се вика вече и от rep1list.php 
			if (isset($relurl)){
reload("parent",$relurl);
exit;
			}else{
	# redirect 
	$smarty->assign("EXITCODE", getnyroexit("t1link"));
	print smdisp($tpname,"iconv");
			}
					}
//												# край - проверяваме за отрицателно id в $edit 
//												}
}else{

/*
							# за избор на "идва от" - кеширания UTF-8 масив 
							$arfrom= unserialize(file_get_contents(COFROMFILE.SUFFUTF8));
//print_r($arfrom);
							# предаваме името, а не съдържанието на масива 
							$smarty->assign("ARFROMNAME", "arfrom");
# ЛЕПЕНКА 
//	$arco= "<option value='0'></option>";
	$arco= "";
foreach($arfrom as $arin=>$artx){
	$arco .= "<option value='$arin'>$artx</option>";
}
$smarty->assign("ARFROMCODE", to1251($arco));
*/
//							$smarty->assign("ARFROMCODE", unserialize(file_get_contents(COFROMFILE.SUFFUTF8)));
							
							# за избор на "идва от" - option/optgroup - името на масива 
							$arfrom= selcofrom();
//print_r($arfrom);
							$smarty->assign("ARFROMNAME", "arfrom");

$rocase= getrow($taname,$edit);
$smarty->assign("POSTCOFROM", $rocase["idcofrom"]);
			# за избор на "надбавка ОЛП" - масива $listextraint - commspec.php 
			# предаваме името, а не съдържанието на масива 
			$smarty->assign("AREXINNAME", "listextraint_utf8");
						# за избор на "титул" - масива $listtitu - commspec.php 
						# предаваме името, а не съдържанието на масива 
						$smarty->assign("ARTITUNAME", "listtitu_utf8");
						# за избор на "подтитул" - масива $listsubtit - commspec.php 
						# предаваме името, а не съдържанието на масива 
						$smarty->assign("ARSUBTNAME", "listsubtit_utf8");
						# за избор на "вид дело" - масива $listsort - commspec.php 
						# предаваме името, а не съдържанието на масива 
						$smarty->assign("ARSORTNAME", "listsort_utf8");
			# 03.05.2009 - за избор на ред от статистическия отчет 
			# двумерен масив - заради optgroup - FormPersister 
			# предаваме името, а не съдържанието на масива 
			$smarty->assign("ARREPONAME", "listrepo_utf8");
			# 03.05.2009 - за избор на текущ статус на делото 
			# двумерен масив - заради optgroup - FormPersister 
			# предаваме името, а не съдържанието на масива 
			$smarty->assign("ARCASESTATNAME", "listcasestat_utf8");
						# за избор на "характер на изпълнението" - масива $listchartype - commspec.php 
						# предаваме името, а не съдържанието на масива 
						$smarty->assign("ARCHARNAME", "listchartype_utf8");
				# за избор на "схема на погасяване" - масива $listpayoff - commspec.php 
				# предаваме името, а не съдържанието на масива 
				$smarty->assign("ARPAYOFF", "listpayoff_utf8");
						# за избор на произход на вземането - четем списъка с произходи 
						# предаваме името, а не съдържанието на масива 
						$arclaiorig= $DB->selectCol("select id as ARRAY_KEY, name from claimorigin order by serial");
						$arclaiorig= array(0=>"") + $arclaiorig;
						# предаваме съдържанието на масива 
						$smarty->assign("ARCLAIORIG", "arclaiorig");
				# 16.05.2014 - заради ЦРД-2014 
				$smarty->assign("AR4TYPENAME", "list4type_utf8");
				$smarty->assign("AR4VARINAME", "list4vari_utf8");
				$smarty->assign("AR4ORIGNAME", "list4orig_utf8");
	# извеждаме формата 
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
//sdisplay(1, "eeee.html", $tpname);
//print "<xmp>".smdisp($tpname,"iconv")."</xmp>";
//print_rr($smarty->get_template_vars());
	print smdisp($tpname,"iconv");
//	$pagecont= smdisp($tpname,"iconv");
}


# функция за INIT 
function funcinit($obje){
global $DB, $smarty;
	if ($obje->paid==0){
		foreach($obje->filist as $fina=>$x2){
			$_POST[$fina]= "";
		}
	}else{
//		$row= getrow($obje->taname,$obje->paid);
//print_r($row);
		$row= $DB->selectRow("select * from $obje->taname where id=?" ,$obje->paid);
		foreach($obje->filist as $fina=>$x2){
			$_POST[$fina]= $row[$fina];
		}
		$_POST["created"]= bgdatefrom($row["created"]);
# 02.08.2010 отчет-1 - да се корегира датата на послед.статус 
		$_POST["timestat"]= bgdatefrom($row["timestat"]);
						if (trim($_POST["timestat"])==".."){
							$_POST["timestat"]= date("d.m.Y");
						}else{
						}
# 14.10.2009 - обезп.заповед и наказат.постановл.
$ardata= unserialize($row["_obezpe_nakaza"]);
if (empty($ardata)){
}else{
	foreach($ardata as $dain=>$daco){
		$_POST[$dain]= $daco;
	}
}
	}
					# 08.04.2010 - ако характера на изпълнение е празен, да стане "друго" 
					if ($_POST["idchar"]<=0){
						$_POST["idchar"]= CASECHARDEFA;
					}else{
					}
# 15.05.2010 - адвокат - специална обработка 
$idagent= $row["idagent"];
	$smarty->assign("IDMARK", $idagent +0);
$agname= $DB->selectCell("select name from agent where id=?d" ,$idagent);
$_POST["agent"]= $agname;
	$smarty->assign("AGNAME", tran1251($agname));
}


# функция за допълнит.грешки 
# връща NULL или $lister 
function funcer(){
						$lister= array();

# след корекцията с динамичното добавяне 
if ($_POST["idcofrom"]==0){
						$lister["idcofrom"]= "задължително избери 'идва от'";
}else{
}
		/**/
		# ако титула е 1=изп.лист,  трябва да е избран подтитул, също и дата на изп.лист 
		if ($_POST["idtitu"]==1){
			if ($_POST["idsubtit"]==0){
						$lister["idsubtit"]= "подтитула е задължително поле";
			}else{
			}
			if (empty($_POST["dateexec"])){
						$lister["dateexec"]= "датата на изп.лист е задължителна";
			}else{
			}
		}else{
		}
		/**/
//		# 16.04.2009 - подтитула вече не е задължителен 
						if (count($lister)==0){
		# 03.05.2009 - текущ статус на делото 
		# ако има промяна в статуса - добавяме запис за историята на статусите 
		# вмъкваме тук, за да стане преди update на записа за делото 
global $taname, $edit, $DB;
		if ($edit==0){
			# ново дело 
		}else{
			$rocase= getrow($taname,$edit);
			if ($rocase["idstat"]==$_POST["idstat"]){
				# съществув.дело - няма промяна на статуса 
			}else{
				# съществув.дело - има промяна на статуса 
				# - добавяме запис в историята 
				$hset= array();
				$hset["idcase"]= $edit;
				$hset["idstat"]= $_POST["idstat"];
				$hset["iduser"]= $GLOBALS["iduser"];
				$DB->query("insert into suitstathist set ?a, time=now()" ,$hset);
//				# - записваме времето на промяната и вдигаме флага за оцветяване 
//				$DB->query("update suit set timestat=now(), flagstat=1 where id=?d" ,$edit);
				# - записваме времето на промяната 
				$DB->query("update suit set timestat=now() where id=?d" ,$edit);
			}
		}
# 14.10.2009 - обезп.заповед и наказат.постановл. [22.02.2011] и акт 
# списъка с имената на полета да е съгласуван с шаблона cazo1modi.ajax.tpl 
			$arresu= array();
//$arname= array("obezpe_nome","obezpe_date"  ,"nakaza_nome","nakaza_date","nakaza_izda");
$arname= array("obezpe_nome","obezpe_date"  ,"nakaza_nome","nakaza_date","nakaza_izda"  ,"akt_nome","akt_date");
foreach($arname as $poname){
			$arresu[$poname]= $_POST[$poname];
}
$_POST["_obezpe_nakaza"]= serialize($arresu);
# край 
return true;
						}else{
return $lister;
						}
}


?>
