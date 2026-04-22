<?php
# корекция на основните данни за ЧСИ 
#    вика се в основния прозорец, а не в ajax 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
//#    $edit - user.id за корекция 

# 22.12.2009 
# - брой дела за миналите години 
unset($listyear[0]);
unset($listyear[date("Y")+0]);
$smarty->assign("LISTYEAR", $listyear);
$counprefix= "coun";
//print_r($listyear);

# фиксиран първия запис 
$edit= 1;

# таблицата 
$taname= "office";
# шаблона 
$tpname= "base.tpl";
# полетата 
$filist= array(
	"text"=>       array("validator"=>"notempty", "error"=>"задължително съдържание")
	,"serial"=>    array("validator"=>"notempty", "error"=>"задължително съдържание")
	,"bulstat"=>   array("validator"=>"notempty", "error"=>"задължително съдържание")
	,"region"=>    array("validator"=>"notempty", "error"=>"задължително съдържание")
	,"fullname"=>  array("validator"=>"notempty", "error"=>"задължително съдържание")
	,"shortname"=> array("validator"=>"notempty", "error"=>"задължително съдържание")
	,"address"=>   array("validator"=>"notempty", "error"=>"задължително съдържание")
	,"issiapikey"=> NULL
	,"epep_app_key"=> NULL
	,"epep_app_secret"=> NULL
//	,"iban"=>   array("validator"=>"notempty", "error"=>"задължително съдържание")
//	,"bic"=>   array("validator"=>"notempty", "error"=>"задължително съдържание")
//	,"bank"=>   array("validator"=>"notempty", "error"=>"задължително съдържание")
# 06.04.2009 - списък от банкови сметки с описателен текст 
# обработва се отделно 
,"listac"=> array("inactive"=>true)
	,"begidocu"=>  NULL
	,"begicase"=>  NULL
	,"begidocuout"=>  NULL
# 03.06.2009 - флаг - дали след вземане на дело да премине директно към въвеждане на основ.данни 
	,"isdirect"=>  NULL
# 07.04.2010 - флагове - ограничена корекция на входящите и изходящите документи 
	,"isdoculimi"=>  NULL
	,"isdocuoutlimi"=>  NULL
//# 31.08.2009 - тип xml формат за банковите извлечения 
//	,"xmlsuffix"=> array("validator"=>"notempty", "error"=>"типа XML е задължително поле")
# 23.04.2010 - букви за шаблони на изх.документи 
	,"letteredit"=>  NULL
	,"letterdocu"=>  NULL
//# 28.04.2010 - изходящи документи до много адресати да се изходяват с отделен номер за всеки адресат 
//	,"isseparate"=>  NULL
# 13.05.2010 - интервал в дни за стари постъпления 
	,"finainterval"=>    array("validator"=>"integer_or_empty", "error"=>"грешен брой дни")
# 15.06.2010 - флаг - изп.дела нямат постоянни деловодители 
	,"isnopermuser"=>  NULL
# 21.06.2010 - флаг - забранено ръчното въвеждане на банкови постъпления 
	,"isnomanual"=>  NULL
# 22.06.2010 - списък - от кои банки ще има постъпления 
	,"banklist"=>  NULL
# 23.06.2010 - флаг - при изходяване на документ автоматично да се добавя таксата като предмет на изпълнение
	,"isregitax"=>  NULL
# 12.07.2010 - число - банкова такса за превод на разпределение 
# ако е празно или нула - не се начислява 
	,"banktax"=> array("validator"=>"amount_or_empty", "error"=>"грешна такса")
# 06.10.2010 - флаг - в дневника на изв.действия да се формира отделен номер за всяко дело 
	,"isjoursepa"=>  NULL
# 30.11.2010 - флаг - дали в данните за регистъра да участват взискателите 
	,"isregiclai"=>  NULL
//# 08.12.2010 - начален номер на сметка чл.79 
//	,"billnumber"=>    array("validator"=>"integer_or_empty", "error"=>"грешен начален номер")
//# 29.07.2011 - цяло число - нулев номер за фактурите 
//	,"invobase"=>  array("validator"=>"integer", "error"=>"грешeн нулев номер")
# и МОЛ за фактурите 
	,"invopers"=>  array("validator"=>"notempty", "error"=>"задължително съдържание")
# 22.11.2017 дв-86/17 - мин.работна заплата 
	,"minsal"=>  array("validator"=>"amount", "error"=>"грешна мин.работна заплата")
);

# списък с имена на полета за една банк.сметка 
$listacfiel= array("desc","iban","bic","bank");
# 08.12.2010 - списък полета за сметките по чл.79 ЗЧСИ 
$listbifiel= array("number","address","iban","bic","bank");

# константни полета 
//$ficonst= array("iduser"=>$iduser);
$ficonst= array();
//# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode);

/******
									# класа за редактиране 
									include_once "edit.class.php";

# редактиране 
$obedit= new edit($taname,$edit,$filist,$ficonst);
//# добавяме параметри за кеширане 
//$obedit->cachequery= "select id as ARRAY_KEY, name from $taname order by id";
//$obedit->cachefile= COFROMFILE;

# действие 
$reedit= $obedit->action();
//var_dump($reedit);
******/

									# класа за редактиране 
									include_once "edit.class.php";
#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
//var_dump($mfacproc);
//print_rr($_POST);

									# основен входен параметър - 
									# $edit - $taname.id  

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
//	if ($edit==0){
//							#---- полета с автоматично съдържание 
//	}else{
		$rocont= $DB->selectRow("select * from $taname where id=?" ,$edit);
		foreach($filist as $finame=>$ficont){
			if ($ficont["inactive"]){
			}else{
				$_POST[$finame]= $rocont[$finame];
			}
		}
							#---- полета с автоматично съдържание 
							$unse= unserialize($rocont["accolist"]);
							/*
							if (empty($unse)){
								foreach($listacfiel as $acfi){
		$_POST["listac"][$acfi]= array("");
								}
							}else{
								foreach($listacfiel as $acfi){
		$_POST["listac"][$acfi]= $unse[$acfi];
								}
							}
							*/
							if (empty($unse)){
								foreach($listacfiel as $acfi){
		$_POST["listac"][0][$acfi]= "";
								}
							}else{
								foreach($listacfiel as $acfi){
		$_POST["listac"]= $unse;
								}
							}
							# 08.12.2010 - списък полета за сметките по чл.79 ЗЧСИ 
							$unse= unserialize($rocont["billparams"]);
							if (empty($unse)){
								foreach($listbifiel as $bifi){
		$_POST["bill"][0][$bifi]= "";
								}
							}else{
								foreach($listbifiel as $bifi){
		$_POST["bill"]= $unse;
								}
							}
		# само заради бройката на сметките 
		$smarty->assign("ACLIST", $_POST["listac"]);
# 03.06.2009 - флаг - дали след вземане на дело да премине директно към въвеждане на основ.данни 
		$_POST["isdirect"]= $rocont["isdirect"];
# 07.04.2010 - и флаговете за ограничена корекция 
		$_POST["isdoculimi"]= $rocont["isdoculimi"];
		$_POST["isdocuoutlimi"]= $rocont["isdocuoutlimi"];
//# 28.04.2010 - и флага за отделни изх.номера 
//		$_POST["isseparate"]= $rocont["isseparate"];
# 13.05.2010 - интервал в дни за стари постъпления 
		$_POST["finainterval"]= $rocont["finainterval"];
# 15.06.2010 - флаг - изп.дела нямат постоянни деловодители 
		$_POST["isnopermuser"]= $rocont["isnopermuser"];
# 21.06.2010 - флаг - забранено ръчното въвеждане на банкови постъпления 
		$_POST["isnomanual"]= $rocont["isnomanual"];
# 22.06.2010 - списък - от кои банки ще има постъпления 
		$banklist= $rocont["banklist"];
		if (empty($banklist)){
			$_POST["banklist"]= array();
		}else{
			$_POST["banklist"]= explode(",",$banklist);
		}
# 23.06.2010 - флаг - при изходяване на документ автоматично да се добавя таксата като предмет на изпълнение
		$_POST["isregitax"]= $rocont["isregitax"];
# 12.07.2010 - число - банкова такса за превод на разпределение 
		$_POST["banktax"]= $rocont["banktax"];
# 06.10.2010 - флаг - в дневника на изв.действия да се формира отделен номер за всяко дело 
		$_POST["isjoursepa"]= $rocont["isjoursepa"];
# 30.11.2010 - флаг - дали в данните за регистъра да участват взискателите 
		$_POST["isregiclai"]= $rocont["isregiclai"];
//# 08.12.2010 - начален номер на сметка чл.79 
//		$_POST["billnumber"]= $rocont["billnumber"];
//	}
# 22.12.2009 
# - брой дела за миналите години 
$yeco= $rocont["yearcount"];
if (empty($yeco)){
	$arcoun= array();
}else{
	$arcoun= unserialize($yeco);
}
foreach($listyear as $cuyear){
	$_POST[$counprefix.$cuyear]= $arcoun[$cuyear];
}
//print_r($_POST);

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
											# проверяваме за допълнителни грешки 
											$lister= array();
										# новия списък сметки 
										$newacc= array();
				# за всяка сметка - броя на празните полета 
//print_r($_POST["listac"]);
				foreach ($_POST["listac"] as $poin=>$poda){
								$coem= 0;
					foreach($listacfiel as $acfi){
						if (empty($poda[$acfi])){
								$coem ++;
						}else{
						}
					}
					if ($coem==count($listacfiel)){
						# всички са празни - сметката отпада 
					}elseif ($coem==0){
						# няма празни - сметката остава без грешки 
										$newacc[]= $poda;
					}else{
						# има празни, но не всички - сметката остава, но има грешки 
//print "=error=";
										$newacc[]= $poda;
						foreach($listacfiel as $acfi){
							if (empty($poda[$acfi])){
//print "=error=$acfi=$acindx";
											$acindx= count($newacc)-1;
											$lister[$acfi."_".$acindx]= "не може да е празно";
							}else{
							}
						}
					}
				}
//print_r(to1251($lister));
										# новия списък сметки - в POST 
										if (empty($newacc)){
											foreach($listacfiel as $acfi){
												$newacc[0][$acfi]= "";
											}
										}else{
										}
										$_POST["listac"]= $newacc;
# 22.12.2009 
# - брой дела за миналите години 
foreach($_POST as $poname=>$pocont){
	if (substr($poname,0,strlen($counprefix))==$counprefix){
		if (empty($pocont)){
		}else{
			if ($pocont<=0 or (string)($pocont+0)<>$pocont){
											$lister[$poname]= "грешен брой";
			}else{
			}
		}
	}else{
	}
}

											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
		# само заради бройката на сметките 
		$smarty->assign("ACLIST", $_POST["listac"]);
							$retucode= 1;
											}else{
												#---- няма ---- 
							$retucode= 0;
		$aset= $ficonst;
		foreach($filist as $finame=>$ficont){
			if ($ficont["inactive"]){
			}else{
				$aset[$finame]= $_POST[$finame];
			}
		}
		$aset["accolist"]= serialize($_POST["listac"]);
# 03.06.2009 - флаг - дали след вземане на дело да премине директно към въвеждане на основ.данни 
		$aset["isdirect"]= (isset($_POST["isdirect"])) ? 1 : 0;
# 07.04.2010 - и флаговете за ограничена корекция 
		$aset["isdoculimi"]= (isset($_POST["isdoculimi"])) ? 1 : 0;
		$aset["isdocuoutlimi"]= (isset($_POST["isdocuoutlimi"])) ? 1 : 0;
//# 28.04.2010 - и флага за отделни изх.номера 
//		$aset["isseparate"]= (isset($_POST["isseparate"])) ? 1 : 0;
# 15.06.2010 - флаг - изп.дела нямат постоянни деловодители 
		$aset["isnopermuser"]= (isset($_POST["isnopermuser"])) ? 1 : 0;
# 21.06.2010 - флаг - забранено ръчното въвеждане на банкови постъпления 
		$aset["isnomanual"]= (isset($_POST["isnomanual"])) ? 1 : 0;
# 22.06.2010 - списък - от кои банки ще има постъпления 
		$banklist= $_POST["banklist"];
		if (isset($banklist)){
		}else{
			$banklist= array();
		}
		$aset["banklist"]= implode(",",$banklist);
# 23.06.2010 - флаг - при изходяване на документ автоматично да се добавя таксата като предмет на изпълнение
		$aset["isregitax"]= (isset($_POST["isregitax"])) ? 1 : 0;
# 06.10.2010 - флаг - в дневника на изв.действия да се формира отделен номер за всяко дело 
		$aset["isjoursepa"]= (isset($_POST["isjoursepa"])) ? 1 : 0;
# 30.11.2010 - флаг - дали в данните за регистъра да участват взискателите 
		$aset["isregiclai"]= (isset($_POST["isregiclai"])) ? 1 : 0;
//var_dump($banklist);
//	if ($edit==0){
//							#---- полета с автоматично съдържание 
//		# нов запис 
//		$edit= $DB->query("insert into $taname set ?a" ,$aset);
//	}else{
# 08.12.2010 - списък полета за сметките по чл.79 ЗЧСИ 
		$aset["billparams"]= serialize($_POST["bill"]);
							#---- полета с автоматично съдържание 
# 22.12.2009 
# - брой дела за миналите години 
			$arcoun= array();
foreach($listyear as $cuyear){
			$arcoun[$cuyear]= $_POST[$counprefix.$cuyear];
}
$aset["yearcount"]= serialize($arcoun);
# 17.01.2011 - избрана сметка за изх.документи = accosele = [desc] за тази сметка 
$accosele= $_POST["accosele"];
$sele0= $_POST["listac"][0]["desc"];
//var_dump(count($_POST["listac"]));
if (count($_POST["listac"])>1){
	$aset["accosele"]= empty($accosele) ? $sele0 : $accosele;
}else{
	$aset["accosele"]= "";
}
		# корекция на записа 
		$DB->query("update $taname set ?a where id=?d" ,$aset,$edit);
//	}
		# само заради бройката на сметките 
		$smarty->assign("ACLIST", $_POST["listac"]);
											# край - според дали има грешка 
											}


# специфично 
#------ добавяне на банк.сметка в списъка 
}elseif ($mfacproc=="plusac"){
							$retucode= 0;
		$arwork= array();
	foreach($listacfiel as $acfi){
		$arwork[$acfi]= "";
	}
	$_POST["listac"][]= $arwork;
//	$smarty->assign("ACLIST",$_POST["listac"]["iban"]);
	# само заради бройката на сметките 
	$smarty->assign("ACLIST", $_POST["listac"]);

#------ submit с формални грешки 
}elseif ($mfacproc==NULL){
							$retucode= 1;
	doerrors();
	# само заради бройката на сметките 
	$smarty->assign("ACLIST", $_POST["listac"]);

#------ автоматичен submit -----------------------------------------------------
}elseif ($mfacproc=="UNKNOWN"){
							$retucode= 2;

#------ невъзможна грешка от библиотеката 
}else{
print "<br>error=mfacproc=";
var_dump($mfacproc);
die();
}

#----------------- край на директното редактиране -----------------------



# резултат 
if ($reedit==0){
	# синхронизираме заглавния текст 
	$rooffi= getofficerow($iduser);
//	$smarty->assign("HEADTEXT", $headtext);
}else{
}

	# извеждаме формата - независимо от резултата 
		# 17.01.2011 - избрана сметка за изх.документи = accosele = [desc] за тази сметка 
		$rocont= $DB->selectRow("select * from $taname where id=?" ,$edit);
		$unse= unserialize($rocont["accolist"]);
//print_rr($rocont);
//print_rr($unse);
//var_dump($unse);
//var_dump(count($unse));
		if ($unse===false){
		}else{
			if (count($unse)>1){
				$_POST["accosele"]= $rocont["accosele"];
//print "post.accosele=yes";
							$aracco= array();
				foreach($unse as $elem){
					$cudesc= $elem["desc"];
							$aracco[$cudesc]= $cudesc;
				}
$smarty->assign("ARACCONAME", "aracco");
//print "aracco=yes";
			}else{
				unset($_POST["accosele"]);
//print "aracco=NO";
			}
		}
							//# за избор на "тип XML" - масива $listxmltype - commspec.php 
							//# предаваме името, а не съдържанието на масива 
							//$smarty->assign("ARXMLNAME", "listxmltype_utf8");
							# за избор на списък банки 
							# предаваме съдържанието на масива 
								$arbank= $listxmltype;
								unset($arbank[""]);
							$smarty->assign("ARBANKNAME", $arbank);
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
//	print smdisp($tpname,"iconv");
//print_rr($smarty->get_template_vars());
//print_rr($_POST);
$pagecont= smdisp($tpname,"fetch");


?>