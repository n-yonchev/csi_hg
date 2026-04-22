<?php
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $page - текущата страница от списъка 
#    $edit - docu.id за корекция 
//print "correction [$mode][$edit][$page][$view]";
//print_rr($GETPARAM);

									#------ входящ документ от външен източник за връчване ------
									include_once "deli.inc.php";

									# действия за отделно дело от списъка 
									$casecode= $GETPARAM["casecode"];
									if (isset($casecode)){
										include_once "docucase.ajax.php";
										exit;
									}else{
									}
							

# разделител за списъка с дела 
$delimi= " ";

# таблицата 
$taname= "docu";
# шаблона 
$tpname= "docuedit.ajax.tpl";
# полетата 
$filist= array(
	"idtype"=>  array("validator"=>"notzero", "error"=>"типа е задължителен")
# 08.04.2010 - вече не е задължително 
//	,"text"=>  array("validator"=>"notempty", "error"=>"описанието е задължително")
	,"text"=> NULL
#------ входящ документ от външен източник за връчване ------
//	,"from"=>  array("validator"=>"notempty", "error"=>"подателя е задължителен")
	,"from"=>  NULL
	,"notes"=>  NULL
	,"notes"=>  NULL
				# 13.04 2009 - един документ - много дела 
				# $docutype вече не участва 
				# участват 2 нови маневрени полета : 
				#     iscreacase - флаг - дали е за образуване на дело (дела) 
				#     caselist - списъка с дела - textarea с разделител интервал 
				//,"iscreacase"=>  array("transformer"=>"getputcbox", "inactive"=>true)
				//,"caselist"=>  array("transformer"=>"getputcali", "inactive"=>true)
);

if($edit == 0) {
	$window_tabs = array(
		0 => array(
			"name" => "образуване на документ",
			"url" => geturl("mode=".$mode."&view=".$view."&page=".$page."&edit=0"),
			"selected" => true
		),
		1 => array(
			"name" => "образуване на дело с ел. партида",
			"url" => geturl("mode=".$mode."&view=".$view."&page=".$page."&edit=0&el_proccess_case_create=0"),
			"selected" => false
		),
	);
	$smarty->assign("TABS", $window_tabs);
}

# образуване на дело с ел. партида
$proccess_case_create = $GETPARAM["el_proccess_case_create"];
if (isset($proccess_case_create)){
	include_once "el_proccess_case_create.php";
	exit;
}

#------------------------------------------------------------------------------------------
										# 16.03.2010 - за съществуващ документ - редуцираме полетата според датата 
								# 07.04.2010 - само ако има ограничена корекция 
								$ofro= getofficerow(0);
								$isdoculimi= $ofro["isdoculimi"];
								if ($isdoculimi){
										if ($edit==0){
										}else{
											$roco= getrow($taname,$edit);
											$datc= substr($roco["created"],0,10);
											if ($datc==date("Y-m-d")){
											}else{
# полетата 
$filist= array(
	"notes"=>  NULL
);
# шаблона 
$tpname= "docuedit2.ajax.tpl";
											}
										}
								}else{
								}
#------------------------------------------------------------------------------------------

# константни полета 
//$ficonst= array("iduser"=>$iduser);
$ficonst= array();
# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page);
$page= $GETPARAM["page"];
$relurl= geturl("mode=".$mode."&view=".$view."&page=".$page);


#----------------- директно редактиране -----------------------

									# класа за редактиране 
									# само заради функцията doerrors 
									include_once "edit.class.php";
									
				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
//var_dump($mfacproc);
//print_rr($_POST);

#------ входящ документ от външен източник за връчване ------
# тип = възлагат.писмо 
$extetype= $DB->selectCell("select id from aadocutype where mode=?"  ,"exte");
$smarty->assign("EXTETYPE", $extetype);

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	if ($edit==0){
							#---- полета с автоматично съдържание 
							# година - текущата 
//							$myyear= (int) date("Y");
//							$_POST["year"]= $myyear;
											# брой нови дела, ако е ново дело 
											$_POST["newcount"]= 1;
		if (isset($editcasecode)){
			$_POST["tacaselist"]= $editcasecode ." ";
		}else{
		}
#------ входящ документ от външен източник за връчване ------
# описание 
$_POST["text2"]= toutf8("молба за връчване на документ по чл.18 от ЗЧСИ");
$smarty->assign("ISPOST", false);
	}else{
		$rocont= $DB->selectRow("select * from $taname where id=?" ,$edit);
		$rocont= arstrip($rocont);
		foreach($filist as $finame=>$ficont){
			if ($ficont["inactive"]){
			}else{
				$_POST[$finame]= $rocont[$finame];
			}
		}
				# 13.04 2009 - един документ - много дела 
				# формираме списъка на делата за textarea 
				$caselist= getcaselist($edit);
						$case2= array();
				foreach($caselist as $elem2){
						$case2[]= $elem2["caseseri"]."/".substr($elem2["caseyear"],2);
				}
				$_POST["tacaselist"]= implode(" ",$case2);
		#------ входящ документ от външен източник за връчване ------
		$rodeli= $DB->selectRow("select post.*, delisour.name as exname from post left join delisour on post.iddelisour=delisour.id where iddocu=?d"  ,$edit);
		$rodeli= dbconv($rodeli);
		$smarty->assign("ISPOST", !empty($rodeli));
		$smarty->assign("RODELI", $rodeli);
	}
	# текуща дата 
	$_POST["date"]= date("d.m.Y");

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
	#------ входящ документ от външен източник за връчване ------
	$smarty->assign("ISPOST", isset($_POST["ispost"]));
											# масив за грешките 
											$lister= array();
								
								#------ входящ документ от външен източник за връчване ------
								if (isset($_POST["ispost"])){

#----------------------------------------------------------------------------------------
//print "___ISPOST___";
									if ($edit==0){
										$iddelisour= $_POST["iddelisour"];
										if (empty($iddelisour)){
														$lister["iddelisour"]= "избери външен източник";
										}else{
										}
										$idposttype= $_POST["idposttype"];
										if (empty($idposttype)){
														$lister["idposttype"]= "избери метод на връчване";
										}else{
										}
									}else{
									}
unset($_POST["iscreacase"]);
//print_ru($lister);
											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
												#---- няма ---- 
							$retucode= 0;
//print_rr($_POST);
		$fromname= $DB->selectCell("select name from delisour where id=?d"  ,$_POST["iddelisour"]);
//var_dump($fromname);
				if ($edit==0){
					# нов входящ документ 
							$aset= array();
					foreach($filist as $finame=>$ficont){
							$aset[$finame]= $_POST[$finame];
					}
					$aset["iduser"]= $_SESSION["iduser"];
						$docuyear= (int) date("Y");
						$docuseri= getdocuseri($docuyear);
					$aset["year"]= $docuyear;
					$aset["serial"]= $docuseri;
		$aset["text"]= $_POST["text2"];
		$aset["from"]= $fromname;
		$aset["notes"]= $_POST["notes2"];
										$DB->query("lock tables docu write, post write");
					$edit= $DB->query("insert into docu set ?a, created=now()" ,$aset);
					# ново връчване 
							$dset= array();
					$dset["iduser"]= $_SESSION["iduser"];
					$dset["idposttype"]= $_POST["idposttype"];
					$dset["iddocu"]= $edit;
					$dset["iddelisour"]= $_POST["iddelisour"];
					$dset["adresat"]= $_POST["postadresat"];
					$dset["address"]= $_POST["postaddress"];
					$DB->query("insert into post set ?a, created=now()" ,$dset);
										$DB->query("unlock tables");
				}else{
					# корекция входящ документ 
							$aset= array();
					$aset["idtype"]= $_POST["idtype"];
/*
					$aset["text"]= $_POST["text2"];
					$aset["from"]= $fromname;
					$aset["notes"]= $_POST["notes2"];
*/
		$aset["text"]= $_POST["text"];
		$aset["from"]= $_POST["from"];
		$aset["notes"]= $_POST["notes"];
					$edit= $DB->query("update docu set ?a where id=?d" ,$aset,$edit);
				}
											}
//print "<h2>$retucode</h2>";
//print_ru($_POST);
//print_ru($filist);
//die("DDDDDDDDDDDDDDD");
#----------------------------------------------------------------------------------------

								}else{

//$editold= $edit;
										$from= trim($_POST["from"]);
										if (empty($from)){
														$lister["from"]= "подателя е задължителен";
										}else{
										}
											
		# 13.04 2009 - един документ - много дела 
		# $docutype вече не участва 
		$iscreacase= $_POST["iscreacase"];
		if (isset($iscreacase)){
			# образуване на ново дело (дела) 
			# - само при нов документ 
			# основен POST елемент - newcount - броя нови документи+дела 
													# проверяваме броя нови дела 
													$newcou= $_POST["newcount"];
													$newcou= (int) $newcou;
													if ($newcou>0){
													}else{
														$lister["newcount"]= "грешен брой нови дела";
													}
											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
												#---- няма ---- 
							$retucode= 0;
				# според желания брой дела за добавяне 
				if ($newcou==1){
					# създаваме един нов документ и свързано с него дело 
					creadocucase(1);
				}else{
					# ще изведем форма за допълнително потвърждение 
							$retucode= -2;
					$smarty->assign("CONF", true);
					# формираме съдържанието и масива $_POST 
							$posttran= array();
							$newpost= array();
					foreach($_POST as $poin=>$poco){
						if (strpos($poin,"submit")===false){
							$posttran[$poin]= $poco;
							$newpost[$poin]= $poco;
						}else{
						}
					}
					$posttran= dbconv($posttran);
//print_r($posttran);
					$_POST= $newpost;
					$smarty->assign("POSTTRAN", $posttran);
				}
											# край според дали има грешка 
											}
		
		}else{
			# документа НЕ Е за образуване на ново дело (дела) 
			# - може да е нов документ или корекция на съществуващ документ 
			# основен POST елемент - tacaselist - списък със свързаните дела 
													# заключваме 
													locktab();
							# масив за грешки в списъка 
							$caseer= array();
											# паралелно формираме масив с id на делата от списъка 
											# ще го използваме, ако евентуално няма грешки в списъка 
											$arcaseid= array();
# 22.12.2009 
# - брой дела за миналите години 
$roof= getofficerow(0);
$arco= unserialize($roof["yearcount"]);
			$listca= explode($delimi,$_POST["tacaselist"]);
//print_rr($listca);
			foreach($listca as $listel){
				if (empty($listel)){
				}else{
					list($caseri,$cayear)= explode("/",$listel);
					$caseri= $caseri +0;
					$cayear= "20".$cayear +0;
							$ele2= str_replace("/","_",$listel);
							$addlin= geturl("casecode=".$listel);
//					$mycoun= $DB->selectCell("select count(*) from suit where serial=? and year=?" ,$caseri,$cayear);
					$mydata= $DB->selectCol("select id from suit where serial=? and year=?" ,$caseri,$cayear);
					$mycoun= count($mydata);
//print "<br>[$caseri][$cayear][$mycoun]";
					if ($mycoun==0){
# 22.12.2009 
# - брой дела за миналите години 
# ако годината е минала и за нея има брой дела 
# проверяваме номера да не надвишава зададения брой 
		$flspec= false;
if ($cayear<date("Y") and !empty($arco[$cayear])){
	if ($caseri>$arco[$cayear]){
		$flspec= true;
	}else{
	}
}else{
}
if ($flspec){
							# 22.12.2009 - новата грешка, чрез [link] предаваме макс.номер 
							$ertype= 2;
							$caseer[]= array("text"=>$listel, "type"=>$ertype, "link"=>$arco[$cayear], "idcode"=>$ele2);
}else{
							# досегашната грешка 
							$ertype= 0;
							$caseer[]= array("text"=>$listel, "type"=>$ertype, "link"=>$addlin, "idcode"=>$ele2);
}
					}elseif ($mycoun==1){
											$arcaseid[]= $mydata[0];
//print "<br>ARCA=$caseri/$cayear/".$mydata[0]["id"];
//print "<br>ARCA=$caseri/$cayear=";
//print_r($arcaseid);
					}else{
							$ertype= 1;
							$caseer[]= array("text"=>$listel, "type"=>$ertype, "link"=>$addlin, "idcode"=>$ele2);
					}
				}
			}
			# според дали има грешки в списъка 
			if (empty($caseer)){
				# НЯМА грешки в списъка 
				# - добавяме/корегираме документа, корегираме списъка с делата и край 
							$retucode= 0;
				# съдържанието на полетата 
				$aset= array();
				foreach($filist as $finame=>$ficont){
					if ($ficont["inactive"]){
					}else{
						$aset[$finame]= $_POST[$finame];
					}
				}
										
										#-----------------------------------------------------------------------------------
										# 09.07.2010 Дичев 
										# флаг : за всяко дело - отделен документ
										# само при чекнат флаг, само при нов документ, но не за образуване 
										# и само ако има списък с дела 
										#-----------------------------------------------------------------------------------
										$flagmultidoc= $_POST["flagmultidoc"];
										if (isset($flagmultidoc) and $edit==0 and !isset($iscreacase) and !empty($arcaseid)){
				# действие : за всяко дело - отделен документ 
//print "VAR1";
			$serino= 0;
					$docuyear= (int) date("Y");
	$aset["iduser"]= $_SESSION["iduser"];
foreach($arcaseid as $idsuit){
	# добавяме поред.запис в основната таблица 
					# определяме поредния номер за новия документ - за текущата година 
					$docuseri= getdocuseri($docuyear);
	$aset["year"]= $docuyear;
	$aset["serial"]= $docuseri;
	# добавяме 
	$edit= $DB->query("insert into $taname set ?a, created=now()" ,$aset);
	# добавяме запис в рефер.таблица 
	$uset= array();
		$uset["iddocu"]= $edit;
		$uset["idcase"]= $idsuit;
		$uset["docurange"]= $serino;
	$DB->query("insert into docusuit set ?a" ,$uset);
}
										}else{
										
//print "VAR22222";
#---------------------------------------------------------------------------------------------------------------
				# евент.добавяме новия документ с id=$edit 
				if ($edit==0){
/*
					# определяме поредния номер за новия документ - за текущата година 
					$docuyear= (int) date("Y");
					$docuseri= getdocuseri($docuyear);
					# съдържанието на полетата 
					$aset= array();
					foreach($filist as $finame=>$ficont){
						if ($ficont["inactive"]){
						}else{
							$aset[$finame]= $_POST[$finame];
						}
					}
					$aset["year"]= $docuyear;
					$aset["serial"]= $docuseri;
					# потребителя, който въвежда документа - логнатия 
					$aset["iduser"]= $_SESSION["iduser"];
*/
					# определяме поредния номер за новия документ - за текущата година 
					$docuyear= (int) date("Y");
					$docuseri= getdocuseri($docuyear);
					$aset["year"]= $docuyear;
					$aset["serial"]= $docuseri;
					# потребителя, който въвежда документа - логнатия 
					$aset["iduser"]= $_SESSION["iduser"];
					# добавяме 
					$edit= $DB->query("insert into $taname set ?a, created=now()" ,$aset);
				}else{
					# корегираме 
					$DB->query("update $taname set ?a where id=?d" ,$aset,$edit);
//print_r($aset);
//var_dump($edit);
				}
				
				#------ корегираме списъка с делата за документа ------ 
				# вече имаме формиран масив с id на делата от въведения списък 
				# $arcaseid[] е suit.id - във въведения ред 
//print_r($arcaseid);
										# формираме масив с id на записите в референтната таблица docusuit, които са за текущия документ 
										# $refelist[]["id"] е docusuit.id - в реда на предишния въведен списък 
										$refelist= getcaselist($edit);
//print_r($refelist);
				# ще запишем в рефер.таблица всички елементи от масива $arcaseid 
				# паралелно в рефер.таблица ще изравним броя на необходимите записи - чрез изтриване или добавяне 
					# поредния номер в серията дела за този документ 
					$serino= 0;
				foreach($arcaseid as $idsuit){
										# вземаме поредното (първото) id от рефер.масив 
										$elrefe= $refelist[0];
										if (isset($elrefe)){
											$idrefe= $elrefe["id"];
//print "=$idrefe";
											# изтриваме поредния (първия) елемент от рефер.масив 
//											unset($refelist[0]);
											# СТАНДАРТ. 
											# изтрива нулевия елемент и преномерира останалите отново от нула 
											array_shift($refelist);
										}else{
											# няма повече елементи в рефер.масив 
											$idrefe= 0;
										}
					# поредния номер в серията 
					$serino ++;
					# полетата 
					$uset= array();
					$uset["iddocu"]= $edit;
					$uset["idcase"]= $idsuit;
					$uset["docurange"]= $serino;
					if ($idrefe==0){
						# добавяме запис в рефер.таблица 
						$DB->query("insert into docusuit set ?a" ,$uset);
					}else{
						# корегираме записа с поредното id от рефер.таблица 
						$DB->query("update docusuit set ?a where id=?d" ,$uset,$idrefe);
					}
				}
										# накрая - евентуално изтриваме ненужните записи от рефер.таблица 
										if (empty($refelist)){
										}else{
											foreach($refelist as $elrefe){
												$idrefe= $elrefe["id"];
						$DB->query("delete from docusuit where id=?d" ,$idrefe);
											}
										}
			
#---------------------------------------------------------------------------------------------------------------
													
													#-----------------------------------------------------------------------------------
													# if (isset($flagmultidoc) and $edit==0 and !isset($iscreacase)){
													}
													#-----------------------------------------------------------------------------------

			}else{
				# има грешки в списъка 
				# - ще изведем отново формата заедно с грешките 
							$retucode= 1;
				$smarty->assign("CASEER", $caseer);
			}
													# отключваме 
													unlocktab();
				
				# 20.04.2015 масово сканиране 
				# отпечатване на етикет - 
				#    само ако няма грешка, 
				#    само при нов документ, но не за образуване, 
				#    само ако не е чекнат флага "за всяко дело да се формира отделен документ" 
//				if (isset($flagmultidoc) and $edit==0 and !isset($iscreacase) and !empty($arcaseid)){
				//if ($retucode==0 and $editold==0 and !isset($iscreacase) and !isset($flagmultidoc)){
				$cocaseid= count($arcaseid);
				if ($retucode==0 and $editold==0 and $cocaseid<=1){
								if (empty($userprin)){
								}else{
//print "<br>PRINT_LABEL";
//print "<h2>LABEL</h2>";
												//# МНОГО ВАЖНО 
												//unset($_SESSION["ardocuuplo"]);
									include_once "scan.inc.php";
									print_scan_label($edit);
								}
				}else{
				}
//die("<br>--------------MASSSCAN------------------");
				if (empty($userprin)){
				}else{
									# МНОГО ВАЖНО 
									unset($_SESSION["ardocuuplo"]);
				}

		# if (isset($iscreacase)){
		}
								
								#------ входящ документ от външен източник за връчване ------
								# край външен източник за връчване 
								}

#------ submit с формални грешки 
}elseif ($mfacproc==NULL){
							$retucode= 1;
	doerrors();
	
	# да се извеждат ли във формата дело/година 
	$smarty->assign("ISCASE", $_POST["docutype"]<>9);

#------ автоматичен submit -----------------------------------------------------
}elseif ($mfacproc=="UNKNOWN"){
							$retucode= 2;
	# 10.04.2009 
	# - допълнително потвърждение само при серия нови дела+документи 
	# НЕЯСЕН ПРОБЛЕМ от dklab-form 
	# бутоните submityes и submitno връщат $mfacproc=="UNKNOWN", затова обработката им е тук 
//print_r($_POST);
	if (0){
	}elseif (isset($_POST["submityes"])){
		# създаваме серия нови документи и дела, свързани поединично 
		creadocucase($_POST["newcount"]);
							$retucode= 0;
	}elseif (isset($_POST["submitno"])){
	}else{
	}

#------ невъзможна грешка от библиотеката 
}else{
print "<br>error=mfacproc=";
var_dump($mfacproc);
die();
}

#----------------- край на директното редактиране -----------------------

# резултат 
if ($retucode==0){
	# redirect 
/*
	reload("parent",$relurl);
//print "RELOAD";
*/
			if (isset($editcasecode)){
chdir(realpath(__DIR__));
$smarty->assign("EXITCODE", getnyroexit("t5link"));
print smdisp($tpname,"iconv");
			}else{
reload("parent",$relurl);
exit;
			}
}else{
	# извеждаме формата 
				# 13.04 2009 - един документ - много дела 
				# $docutype вече не участва 
						# 18.03.2009 - обслужване на списък податели с уникални имена 
						# подателя е поле, което може да се избира от масив чрез jquery.autocomplete 
						# за масива - четем списъка с подателите 
						$arsender= $DB->selectCol("select name from sender");
						$arsender= dbconv($arsender);
						# заграждаме елементите в двойни кавички  
									$ars2= array();
						foreach ($arsender as $elem){
									$ars2[]= '"' .addcslashes($elem,'"') .'"';
						}
						# формираме js код за масив 
						$sen2= implode(",",$ars2);
						# предаваме съдържанието на кода 
						$smarty->assign("SENDCODE", $sen2);
						
				# за избор на тип - четем списъка с типовете 
				$ardocutype= getselect("aadocutype","name","1",true);
														# 21.10.2009 - добавянето на документ се вика в два варианта от две места в глав.меню 
														# затова трансформираме масива с типовете : 
														#    - вар.1 - за образуване на дело - оставяме само елемента за образуване 
														#    - вар.2 - за обикновен документ - оставяме всички останали 
														if ($edit==0){
															$idcrea= $DB->selectCell("select id from aadocutype where mode='crea'");
//var_dump($_SESSION["iscreacase"]);
//print_rr($ardocutype);
//var_dump($idcrea);
															if ($_SESSION["iscreacase"]){
																# за образуване 
																		$ardo2= array();
																$ardo2[$idcrea]= $ardocutype[$idcrea];
//print_rr($ardo2);
															}else{
																# обикновен 
																		$ardo2= array();
																foreach($ardocutype as $dtindx=>$dtcont){
																	if ($dtindx==$idcrea){
																	}else{
																		$ardo2[$dtindx]= $ardocutype[$dtindx];
																	}
																}
															}
				$ardocutype= $ardo2;
														}else{
														}
//print_rr($ardocutype);
//				$ardocutype= dbconv($ardocutype);
# 21.03.2011 - премахваме и типа "cere" - молба за удостоверение за вписване 
$idcere= $DB->selectCell("select id from aadocutype where mode='cere'");
unset($ardocutype[$idcere]);
									#------ входящ документ от външен източник за връчване ------
									# за избор на метод - масив с празен елемент 
									$listpoty= array(0=>"") + $listtypepost_utf8;
									$smarty->assign("ARPOSTTYPENAME", "listpoty");
										#------ входящ документ от външен източник за връчване ------
										# за избор на източник 
										$arsourpost= getselect("delisour","name","1",true);
										$smarty->assign("ARSOURPOSTNAME", "arsourpost");
				#------ външен източник ------
				# допълнително : основни данни за делата 
						$smarty->assign("ARTITUNAME", "listtitu_utf8");
						$smarty->assign("ARREPONAME", "listrepo_utf8");

				# предаваме името на масива 
				$smarty->assign("ARDOCUTYPENAME", "ardocutype");
								$rocont= getrow($taname,$edit);
								$smarty->assign("DOCUMENT", $rocont["serial"]."/".$rocont["year"]);
//	$smarty->assign("DOCUTYPE", $_POST["docutype"]);
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}



# създаваме серия нови документи и дела, свързани поединично 
function creadocucase($newcou){
global $DB, $taname, $filist;
													locktab();

	# годината на документа е текущата 
	$docuyear= (int) date("Y");
	# определяме поредния номер (първия от серията) за новия документ - за определената вече година 
	#-----------------------------------------------------------------------------------------------------
	$docuseri= getdocuseri($docuyear);
/*
	# дали изобщо има записи в таблицата 
	$counreco= $DB->selectCell("select count(*) from docu");
	if ($counreco==0){
		# няма записи - вземаме нач.номер от основните данни 
		$docuseri= getoffbegi("begidocu");
	}else{
		# има записи - определяме макс.номер документ за годината 
		$maxser= $DB->selectCell("select max(serial) from docu where year=?" ,$docuyear);
		# вземаме следващия номер - важи и ако е първия за годината 
		$docuseri= $maxser + 1;
	}
*/

	# определяме година и пор.номер за делото - годината съвпада с тази на документа 
	#-----------------------------------------------------------------------------------------------------
	$caseyear= $docuyear;
	# определяме поредния номер (първия от серията) за новия документ - за определената вече година 
	# дали изобщо има записи в таблицата 
	$counreco= $DB->selectCell("select count(*) from suit");
	if ($counreco==0){
		# няма записи - вземаме нач.номер от основните данни 
		$caseseri= getoffbegi("begicase");
	}else{
		# има записи - определяме макс.номер документ за годината 
//		$maxser= $DB->selectCell("select max(serial) from suit where year=?" ,$docuyear);
		$maxser= $DB->selectCell("select max(serial) from suit where year=?" ,$caseyear);
		# вземаме следващия номер - важи и ако е първия за годината 
		$caseseri= $maxser + 1;
	}

	# създаваме серията в 3 таблици 
	#-----------------------------------------------------------------------------------------------------
	$aset= array();
	foreach($filist as $finame=>$x2){
		$aset[$finame]= $_POST[$finame];
	}
	for ($i=1; $i<=$newcou; $i++){
			# създаваме ново дело 
			$casset= array();
			$casset["year"]= $caseyear;
			$casset["serial"]= $caseseri;
			$idcasenew= $DB->query("insert into suit set ?a ,created=now() ,lastdocu=now(),last2=0" ,$casset);
			# за следващото ново дело 
			$caseseri ++;
		# създаваме нов документ 
		# ВНИМАНИЕ. 
		# Не изчистваме масива със съдържанията на полетата, повтарят се за всички записи от серията. 
		$aset["year"]= $docuyear;
		$aset["serial"]= $docuseri;
# 17.03.2009 
# добавяме и потребителя, който въвежда документа - логнатия 
$aset["iduser"]= $_SESSION["iduser"];
		$edit= $DB->query("insert into $taname set ?a, created=now()" ,$aset);
		# за следващия нов документ 
		$docuseri ++;
				# 13.04 2009 - един документ - много дела 
				# свързваме новото дело с документа 
				$sset= array();
				$sset["iddocu"]= $edit;
				$sset["idcase"]= $idcasenew;
				$sset["docurange"]= 0;
				$DB->query("insert into docusuit set ?a" ,$sset);
												# 22.10.2009 - 
												# добавянето на вх.документ за образуване на дело - вече е отделно в глав.меню 
												# въведохме ново поле suit.iddocucrea = docu.id за документа, с който е образувано делото 
												# записваме съдържанието му - указател към документа 
			$DB->query("update suit set iddocucrea=?d where id=?d" ,$edit,$idcasenew);
	}
													
													unlocktab();
				# 20.04.2015 масово сканиране 
				# отпечатване на етикет - 
				#    само при образуване на 1 дело 
global $userprin;
				if ($newcou==1){
								if (empty($userprin)){
								}else{
//print "<br>PRINT_LABEL";
//die("SCAN-ARCASE");
									$iddocu2= $_SESSION["ardocuuplo"][0];
												//# МНОГО ВАЖНО 
												//unset($_SESSION["ardocuuplo"]);
									include_once "scan.inc.php";
									print_scan_label($iddocu2);
								}
				}else{
				}
				if (empty($userprin)){
				}else{
									# МНОГО ВАЖНО 
									unset($_SESSION["ardocuuplo"]);
				}
}


function getdocuseri($docuyear){
global $DB;
	# дали изобщо има записи в таблицата 
	$counreco= $DB->selectCell("select count(*) from docu");
	if ($counreco==0){
		# няма записи - вземаме нач.номер от основните данни 
		$docuseri= getoffbegi("begidocu");
	}else{
		# има записи - определяме макс.номер документ за годината 
		$maxser= $DB->selectCell("select max(serial) from docu where year=?" ,$docuyear);
		# вземаме следващия номер - важи и ако е първия за годината 
		$docuseri= $maxser + 1;
	}
return $docuseri;
}

function locktab(){
global $DB;
	$DB->query("lock tables docu write, suit write, docusuit write, user write, office write");
}

function unlocktab(){
global $DB;
	$DB->query("unlock tables");
}



/*
function getputcali($dire,$paid,$finame,$ardata){
	$value= $ardata[$finame] +0;
	if (0){
	}elseif ($dire=="get"){
		if ($paid==0){
return "";
		}else{
			$caselist= getcaselist($paid);
return implode(" ",$caselist);
		}
	}elseif ($dire=="put"){
		if ($value==0){
return 1;
		}else{
return 0;
		}
	}else{
die("GPcbox=dire=$dire");
	}
}
*/

?>