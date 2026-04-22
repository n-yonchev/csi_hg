<?php
# корекция на банково постъпление 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $page - текущата страница 
# $edit - finance.id за корекция 
		# този скрипт може да е извикан алтернативно от дело - виж cazofina.php 
		# в този случай : 
		#      $CALLFROMCASE===true 
		#      $editcase - делото = suit.id 
		# източник : cazofinaedit.php - не се използва 
//print_rr($smarty->get_template_vars());
//print_rr($_SESSION);
//print "correction [$mode][$edit]";
//print_r($GETPARAM);
//print_r($_POST);
//var_dump($edit);

# 12.05.2010 - евент.ограничаване датата на погасяване за старо постъпление 
# - деловодителя може да въвежда дата, не по-късна от от днешната минус интервала 
# - админа може да въвежда произволна дата 
# дали има ограничаване на датата 
$rooffi= getofficerow($iduser);
$finainte= $rooffi["finainterval"] +0;
$smarty->assign("FINAINTE", $finainte);
					# 21.06.2010 - флаг - забранено ръчното въвеждане на банкови постъпления 
					$isnomanual= $rooffi["isnomanual"]<>0;
					$smarty->assign("ISNOMANUAL", $isnomanual);
										#----------------------------------------------------------------------
										# 12.07.2010 - число - банк.такса за превод на разпределение 
										#----------------------------------------------------------------------
										$banktax= $rooffi["banktax"] +0;
										$isbanktax= $banktax<>0;
										$smarty->assign("BANKTAX", number_format($banktax,2,".",""));
//										$smarty->assign("BANKTAX", $banktax);
										$smarty->assign("ISBANKTAX", $isbanktax);
										# константа 
										# префикс за POST име на такса на взискател, POST името = claitax[claimer.id] 
										$claitaxpref= "claitax";
										$smarty->assign("CLAITAXPREF", $claitaxpref);
//$isdatelimi= ($finainte<>0);
# ако има ограничаване 
if ($finainte==0){
}else{
	# дали логнатия е админ 
	$rouser= getrow("user",$iduser=$_SESSION["iduser"]);
	$adminlogged= ($rouser["type"]==ADMINTYPE);
$smarty->assign("ADMINLOGGED", $adminlogged);
	# $pastdate = днешната дата минус интервала - бг формат 
	$ardate= getdate();
	$cuye= $ardate["year"];
	$cumo= $ardate["mon"];
	$cuda= $ardate["mday"];
	$padate= mktime(0,0,1, $cumo,$cuda-$finainte,$cuye);
	$pastdate= date("d.m.Y",$padate);
	# евентуалния запис с причината за нарушаване на интервала
	$roreas= $DB->selectRow("
		select finareason.*, finareason.id as id, user.name as username
		from finareason 
		left join user on finareason.iduser=user.id 
		where finareason.idfinance=?d
		"  ,$edit);
					# за всеки случай след грешен запис на причина с id=0 
					if ($edit==0){
	$roreas= array();
					}else{
					}
//	$roreas= dbconv($roreas);
$smarty->assign("ISREASON", !empty($roreas));
$smarty->assign("DATAREAS", $roreas);
//print_rr($roreas);
$smarty->assign("ADMINAME", tran1251($roreas["username"]));
$smarty->assign("ADMITEXT", tran1251($roreas["text"]));
}

								#------------------------ ЗАКЛЮЧВАНЕ --------------------------
								# проверка дали записа е заключен 
								$rofina= getrow("finance",$edit);
								$lockedby= $rofina["lockedby"];
								$curruser= $_SESSION["iduser"];
//print "[$lockedby][$curruser]";
								if ($lockedby==0 or $lockedby==$curruser){
									# свободен или заключен от логнатия - заключваме го и продължаваме 
									updrow("finance",$edit,"lockedby=".$curruser);
	# за отключването след нормален exit - виж _window.header.tpl 
	$nyremo["idfina"]= $edit;
	$nyremo["idzone"]= "zone".$edit;
	$smarty->assign("NYREMO", $nyremo);
//print_r($smarty->get_template_vars());
								}else{
									# заключен от друг - съобщение и шунт 
									$rouser= getrow("user",$lockedby);
//print_r($_SERVER);
	$smarty->assign("LOCKNAME", $rouser["name"]);
//	$smarty->assign("URLAGAIN", $_SERVER["HTTP_REFERER"]);
	$smarty->assign("EDIT", $edit);
	print smdisp("finalock.ajax.tpl","iconv");
	exit;
								}

# константи 
# префикс за POST име на взискател, POST името = clai[claimer.id] 
$claipref= "clai";
$smarty->assign("CLAIPREF", $claipref);

# reload - след успешен събмит 
$relurl= geturl("mode=".$mode."&page=".$page);

							# шунт - заявка за изтриване 
							# $deleget е натиснатия бутон "изтрий това постъпление" 
//							$deleget= $_POST["deleget"];
							$deleget= $GETPARAM["deleget"];
							if (isset($deleget)){
# ВНИМАНИЕ. 
# Специфичен случай - вложени въпроси. 
								# шунт - изтриване на запис 
								# $dele е натиснатия бутон "изтрий" 
								$dele= $_POST["dele"];
								if (isset($dele)){
									# добавяме записа в архива 
									finaarchive($edit);
	# изтриваме 
	$DB->query("delete from finance where id=?d"  ,$edit);
	# redirect 
	reload("parent",$relurl);
exit;
								}else{
	$rofina= getrow("finance",$edit);
		$rocase= getrow("suit",$rofina["idcase"]);
		$rofina["caseseri"]= $rocase["serial"];
		$rofina["caseyear"]= $rocase["year"];
	$smarty->assign("DATA", $rofina);
							# за извеждане на "тип" - масива $listfinatype - commspec.php 
							# предаваме съдържанието на масива 
							$smarty->assign("ARTYPE", $listfinatype);
	print smdisp("finadele.ajax.tpl","iconv");
exit;
								# if (isset($dele)){
								}
							}else{
							}


# таблицата 
$taname= "finance";
# шаблона 
$tpname= "finaedit.ajax.tpl";
# полетата 
$filist= array(
	"idtype"=> array("validator"=>"notzero", "error"=>"типа е задължително поле")
	,"inco"=> array("validator"=>"amount_not_zero", "error"=>"грешна сума")
	,"descrip"=> NULL
	,"idcase"=> array("validator"=>"caseexi", "error"=>"несъществуващо дело", "transformer"=>"getputcase")
# ако е назначено дело 
	,"separa"=> array("validator"=>"amount_or_empty", "error"=>"грешна сума")
# 03.11.2009 - отделно поле за т.26 
# separa е за такси и разноски, неплатени от взискателя 
	,"separa2"=> array("validator"=>"amount_or_empty", "error"=>"грешна сума")
# 11.05.2010 - сума за връщане 
	,"back"=> array("validator"=>"amount_or_empty", "error"=>"грешна сума")
# 03.11.2009 - от името на кой длъжник е постъплението 
	,"iddebtor"=> NULL
# 28.01.2010 - динамично преизчисляване на погасяването 
# и текстове за автоматично попълване на дневника изв.действия 
	,"datebala"=> array("validator"=>"bgdate_valid", "transformer"=>"getputbgdate")
//	,"jourtext1"=> array("validator"=>"notempty", "error"=>"текста е задължителен")
//	,"jourtext2"=> array("validator"=>"notempty", "error"=>"текста е задължителен")
# 21.10.2010 - доп.поле dateinco = дата на постъпление 
	,"dateinco"=> array("validator"=>"bgdate_valid_notempty", "transformer"=>"getputbgdate")
);
										#----------------------------------------------------------------------
										# 12.07.2010 - число - банк.такса за превод на разпределение 
										#----------------------------------------------------------------------
										if ($isbanktax){
# банк.такса за връщане 
$filist["backtax"]= array("validator"=>"amount_or_empty", "error"=>"грешна такса");
										}else{
										}
//print_rr($filist);

# константни полета 
$ficonst= array();
# дали е извикван от дело 
$smarty->assign("CALLFROMCASE", $CALLFROMCASE);

# 03.11.2009 - избор на длъжник 
# списък на длъжниците - само ако е избрано делото 
//if (isset($editcase)){
if ($edit==0){
	$casefordebt= $editcase;
}else{
	$casefordebt= $rofina["idcase"];
}
//var_dump($casefordebt);
if (empty($casefordebt)){
}else{
$smarty->assign("ISSETCASE",true);
	# за избор на длъжник - четем списъка с длъжниците по делото 
	$ardebt= getselect("debtor","name","idcase=$casefordebt",false);
	# масива с id на длъжниците 
	$ardebtkeys= array_keys($ardebt);
	# предаваме името на масива 
	$smarty->assign("ARDEBTNAME", "ardebt");
//					# за извеждане - предаваме и съдържанието на масива 
//					$smarty->assign("ARDEBT", $ardebt);
}

					# допълнителни полета - само за тип=2=в_брой=ПКО 
					# само за формата : 
					#     getnext  - флаг дали да земе следващия номер 
					#     serinome - въведен номер/година 
					# съответно полета само от данните : 
					#     cashserial, cashyear 
					# за формата и от данните : 
					#     cashdate, cashname 
					# допълнителни полета - за тип=9=директно 
					#     idclaimer - id на взискателя 
# текущата година - за ПКО 
$curryear= (int) date("Y");					
$smarty->assign("CURRYEAR", $curryear);

									# класа за редактиране 
									include_once "edit.class.php";
#----------------- директно редактиране -----------------------
# главна променлива : $edit = finance.id = записа за корекция 

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
//print_rr($_POST);

									# основен входен параметър - 
									# $edit - $taname.id 
							# $listclai - маневрена променлива - сумите за превод на всеки взискател по делото 
							# - сериализиран масив: calimer.id => сума 

# взискателите по делото 
							if ($CALLFROMCASE){
//print "clailist=A";
$clailist= getclailist($editcase);
$smarty->assign("CLAILIST", $clailist);
							}else{
							}

											# 11.06.2010 
											# съществува ли таблицата finatran в БД ? 
											$finatran_exists= tabexists("finatran");
					
					# 21.10.2010 Бургас - не може да се корегират банк.постъпления 
					# доп.уточнение - да може само ако има запис в табл. finasource 
//					$rofiso= $DB->selectRow("select * from finasource where idfinance=?d" ,$edit);
					$rofiso= $DB->selectRow("select * from finasource where idfinance=?d and idfinance<>0" ,$edit);
//var_dump($edit);
//print_rr($rofiso);
					$smarty->assign("ISSOURCE", $rofiso["id"]<>0);
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	if ($edit==0){
# 21.10.2010 - доп.поле dateinco = дата на постъпление 
$_POST["dateinco"]= date("d.m.Y");
							# ако е извикан алтернативно от дело 
							if ($CALLFROMCASE){
				$resufunc= call_user_func($filist["idcase"]["transformer"],"get",$edit,"idcase",array("idcase"=>$editcase));
				$_POST["idcase"]= $resufunc;
		# взискателите по делото 
		$idcase= $editcase;
//print "clailist=B";
		$clailist= getclailist($idcase);
		$smarty->assign("CLAILIST", $clailist);
//print_r($clailist);
							}else{
							}
											# 03.11.2009 - от името на кой длъжник е постъплението 
											if (empty($casefordebt)){
												# няма избрано дело - нулев 
												$_POST["iddebtor"]= 0;
											}else{
												# има избрано дело - първия длъжник от списъка 
												$_POST["iddebtor"]= $ardebtkeys[0];
											}
		# вземи следв.номер - чекнато 
		$_POST["getnext"]= 1;
		# дата на постъпление в-брой 
		$_POST["cashdate"]= date("d.m.Y");
	}else{
		$rocont= $DB->selectRow("select * from $taname where id=?" ,$edit);
		foreach($filist as $finame=>$ficont){
//			if ($ficont["inactive"]){
//			}else{
				$_POST[$finame]= $rocont[$finame];
							# get трансформация 
							if (isset($ficont["transformer"])){
				$resufunc= call_user_func($ficont["transformer"],"get",$edit,$finame,$rocont);
				$_POST[$finame]= $resufunc;
							}else{
							}
//			}
		}
		# специално за тип=2=вброй=ПКО 
		//if ($edit==0){
		//}else{
			if ($rocont["idtype"]==2){
				# съществуващ ПКО 
				$_POST{"serinome"}= $rocont["cashserial"];
				$_POST{"cashdate"}= $rocont["cashdate"];
				$_POST{"cashname"}= $rocont["cashname"];
			}else{
			}
		//}
		# сумите по взискатели 
		if (empty($rocont["toclai"])){
		}else{
//			$arclam= unserialize($rocont["toclai"]);
			$arclam= unsetoclai($rocont["toclai"]);
			foreach($arclam as $clid=>$clamou){
				$clpostname= $claipref.$clid;
				$_POST[$clpostname]= $clamou;
			}
											# специално за директен превод на взискателя 
											$arke= array_keys($arclam);
											$_POST["idclaimer"]= $arke[0];
		}
		# взискателите по делото 
		$idcase= $rocont["idcase"];
//print "clailist=C";
		$clailist= getclailist($idcase);
		$smarty->assign("CLAILIST", $clailist);
//print_r($clailist);
											# 03.11.2009 - от името на кой длъжник е постъплението 
											if (empty($casefordebt)){
												# няма избрано дело - нулев 
															$_POST["iddebtor"]= 0;
											}else{
												# има избрано дело - 
												$roid= $rocont["iddebtor"];
												if (empty($roid)){
													# в записа още няма избран длъжник - вземаме първия длъжник от списъка 
															$_POST["iddebtor"]= $ardebtkeys[0];
												}else{
													# в записа вече има избран длъжник - вземаме него 
															$_POST["iddebtor"]= $roid;
												}
											}
	}
	# 12.05.2010 - евент.ограничаване датата на погасяване за старо постъпление 
	# ако има ограничаване 
	if ($finainte==0){
	}else{
		$_POST["reason"]= $roreas["text"];
	}
										#----------------------------------------------------------------------
										# 12.07.2010 - число - банк.такса за превод на разпределение 
										#----------------------------------------------------------------------
										# назначаваме банк.такси - ако е предвидено и ако полето за такса е ПРАЗНО 
										# ако полето съдържа нула, тя остава 
														if ($isbanktax){
																					//$arfiel= array();
										#-- за сумите към взискателите 
										if (empty($rocont["toclaitax"])){
											$arclamtax= array();
										}else{
											$arclamtax= unsetoclai($rocont["toclaitax"]);
										}
							# 21.10.2010 - Дичев- иначе грешка warning ако няма дело 
							$clailist= empty($clailist) ? array() : $clailist;
										foreach($clailist as $clid=>$x2){
											$clpostname= $claitaxpref.$clid;
											$clamou= $arclamtax[$clid];
																					//$arfiel[$claipref.$clid]= $claitaxpref.$clid;
//											$_POST[$clpostname]= ($clamou+0==0) ? $banktax : $clamou;
											$_POST[$clpostname]= (trim($clamou)=="") ? $banktax : $clamou;
											$_POST[$clpostname]= number_format($_POST[$clpostname] ,2,".","");
										}
										#-- за сумата за връщане 
										$backtax= $rocont["backtax"];
//										$_POST["backtax"]= ($backtax+0==0) ? $banktax : $backtax;
										$_POST["backtax"]= (trim($backtax)=="") ? $banktax : $backtax;
										$_POST["backtax"]= number_format($_POST["backtax"] ,2,".","");
																					//$arfiel["back"]= "backtax";
																				//$smarty->assign("ARFIEL", $arfiel);
														}else{
														}

#------ submit без формални грешки 
//}elseif ($mfacproc=="submit"){
}elseif ($mfacproc=="submit" or $mfacproc=="submit2"){
							$retucode= 0;
													# заключваме 
//													$DB->query("lock tables $taname write, finahist write, claimer write, suit write");
															if ($finatran_exists){
													$DB->query("lock tables $taname write, finahist write, claimer write, suit write
													, finasource write, claimadva write, prih write, finatran write");
															}else{
													$DB->query("lock tables $taname write, finahist write, claimer write, suit write
													, finasource write, claimadva write, prih write");
															}
	# следващия възможен номер ПКО за текущ.година 
	$nextcash= getnextcash();
	# заради съхраняване на данните след грешка в полетата за тип=в_брой=ПКО 
	$rocont= $DB->selectRow("select * from $taname where id=?" ,$edit);

											# проверяваме за допълнителни грешки 
											$lister= array();

# 12.05.2010 ------------- проверяваме датата на погасяване за старо постъпление -----------------------
						# ако има ограничаване 
						# - деловодителя може да въвежда дата, не по-късна от днешната минус интервала =$pastdate 
						# - админа може да въвежда произволна дата, но с обяснение, ако нарушава интервала 
						if ($_POST["idtype"]==7){
							# старо плащане 
							if ($finainte==0){
							}else{
								# има ограничаване 
								# датата е задължителна 
								if (empty($_POST["datebala"])){
											$lister["datebala"]= "датата на погасяване е задължителна";
								}else{
									# въведена е нова дата 
									$myinpu= bgdateto($_POST["datebala"]);
									# дали досега е имало дата 
$rocont= $DB->selectRow("select * from $taname where id=?" ,$edit);
									$currdate= $rocont["datebala"];
									if (empty($currdate)){
										# досега няма дата 
										# новата дата дали нарушава интервала 
										$mypast= bgdateto($pastdate);
										$isviol= ($myinpu > $mypast);
										if ($adminlogged){
											# админ 
											if ($isviol){
$smarty->assign("ISRE2", true);
												if (empty($_POST["reason"])){
													$lister["reason"]= "трябва да въведете текст";
												}else{
												}
											}else{
											}
										}else{
											# НЕадмин 
											if ($isviol){
												$lister["datebala"]= "нарушен $finainte-дневен интервал. най-късната дата е $pastdate";
											}else{
											}
										}
									}else{
										# има стара дата 
										# новата дата не може да е след старата - и за админа, и за НЕадмина 
										if ($myinpu > $currdate){
												$lister["datebala"]= "не може да е след предишната дата ".bgdatefrom($currdate);
										}else{
										}
									# край - дали досега е имало дата 
									}
								}
							}
						}else{
						}

//print_r($_POST);
#--------- проверяваме описанието ------------------------------------------------------------
	$descrip= trim($_POST["descrip"]);
	if (empty($descrip)){
											$lister["descrip"]= "описанието е задължително";
	}else{
	}

#--------- проверяваме параметрите за тип=2=вброй=ПКО  ------------------------------------------------------------
	$idtype= $_POST["idtype"];
//var_dump($idtype);
	if ($idtype==2){
		# датата 
		$cashdate= $_POST["cashdate"];
		$dateresu= validator_bgdate_valid_notempty($cashdate,NULL);
		if ($dateresu !== true){
											$lister["cashdate"]= $dateresu[0];
		}else{
		}
		# вносителя 
		$cashname= $_POST["cashname"];
		if (empty($cashname)){
											$lister["cashname"]= "името е задължително";
		}else{
		}
		# номера за текущ.година 
		# източник : oureedit.ajax.php 
		$getnext= isset($_POST["getnext"]);
		$serinome= $_POST["serinome"];
		if ($getnext){
			# избрано е "вземи следващия изх.номер" 
		}else{
			# въведен е желания изх.номер 
			if (empty($serinome)){
											$lister["serinome"]= "изходящия номер е задължителен";
			}else{
				# дали е правилно цяло число 
				if ((string)((int)$serinome)==$serinome){
					# дали вече не съществува ПКО с този номер за текущата година 
									if ($edit==0){
										$exfi= "";
									}else{
										# ако е корекция на съществуващ запис 
										# и да не е текущия запис 
										$exfi= " and id<>$edit";
									}
					$mycoun= $DB->selectCell("select count(*) from $taname where cashserial=? and cashyear=? $exfi" ,$serinome,$curryear);
					if ($mycoun==0){
						# дали въведения номер не превишава максималния - следв.възможен 
//						$nextcash= getnextcash();
/***
						if ($serinome+0 <= $nextcash){
						}else{
											$lister["serinome"]= "превишава макс.възможен номер";
						}
***/
					}else{
											$lister["serinome"]= "има касов ордер с този номер";
					}
				}else{
											$lister["serinome"]= "грешен изходящ номер";
				}
			}
		# if ($getnext){
		}
#--------------------------------------------------------------------------------------------
# ВНИМАНИЕ. 10.02.2010 
# ако типа е "банков превод", това постъпление трябва да е свързано с банково извлечение 
	}elseif ($idtype==1){
		if ($edit==0){
//											$lister["idtype"]= "няма връзка с банково извлечение";
# ВНИМАНИЕ. 23.02.2010 
# ако типа е "банков превод", само се извежда текст и грешката не може да се види 
# освен това няма поле за избор и не може да се промени 
# затова премахнах тази грешка 
		}else{
			$socoun= $DB->selectCell("select count(id) from finasource where idfinance=?d"  ,$edit);
			if ($socoun==0){
//											$lister["idtype"]= "няма връзка с банково извлечение";
			}else{
			}
		}
#--------------------------------------------------------------------------------------------
	}else{
	# if ($idtype==2){
	}

	# определяме назначеното дело 
	# имитация на idcase-put-transformer 
	$idcase= call_user_func($filist["idcase"]["transformer"],"put",$edit,"idcase",$_POST);
	
#--------- проверяваме разпределението ЧСИ-взискатели ------------------------------------------------------------
	# според назначеното дело 
	if (empty($idcase)){
		# не е избрано дело 
																# ако е директен превод - грешка 
																if ($idtype==9){
											$lister["idcase"]= "няма избрано дело";
																	}else{
																	}
	}else{
		# има избрано дело - проверяваме полетата за разпределение 
																# ако е директен превод - 
																# проверяваме само дали е избран взискател 
																if ($idtype==9){
																	$idclaimer= $_POST["idclaimer"];
																	if (empty($idclaimer)){
											$lister["idclaimer"]= "няма избран взискател";
																	}else{
																	}
																	
																}else{
				# разпред.за ЧСИ 
				$separa= $_POST["separa"] +0;
				$separa2= $_POST["separa2"] +0;
				# 11.05.2010 - за връщане 
				$back= $_POST["back"] +0;
									# общо разпределена сума - ЧСИ + взискателите 
									$disttota= 0;
									$disttota += $separa +0;
# 03.11.2009 - separa2 - отделно поле за т.26 
# separa е за такси и разноски, неплатени от взискателя 
$disttota += $separa2 +0;
				# 11.05.2010 - за връщане 
				$disttota += $back +0;
									$iserror= false;
			# взискателите по делото 
//print "clailist=D";
			$clailist= getclailist($idcase);
$smarty->assign("CLAILIST", $clailist);
//var_dump($idcase);
//print_r($clailist);
			foreach($clailist as $idclai=>$x2){
				$claipostname= $claipref.$idclai;
/*
				$clamou= str_replace(" ","?",$_POST[$claipostname]);
print "<br>";
var_dump($claipostname);
var_dump($clamou);
				$_POST[$claipostname]= $clamou;
*/
/****
				$clamou= $_POST[$claipostname]= str_replace(" ","?",$_POST[$claipostname]);
#---------------------------------------------------------------------------------------------
				# формална проверка - имитация на validator_amount_or_empty, univalidator 
				# - виж commvali.php 
				if ($clamou==""){
				}else{
					$exvali= $evalvali["amount"];
					$value= $clamou;
					eval("\$result= ($exvali);");
					if ($result){
//var_dump($result);
											$lister[$claipostname]= "грешна сума за взискател";
											$iserror= true;
					}else{
					}
				}
****/
				# формална проверка сумата за взискател 
				$clamou= checkamou($claipostname,"грешна сума за взискател");
						# общо разпределената сума 
						$disttota += $clamou +0;
#---------------------------------------------------------------------------------------------
										#----------------------------------------------------------------------
										# 12.07.2010 - число - банк.такса за превод на разпределение 
										#----------------------------------------------------------------------
										# паралелно формална проверка и таксите за суми към взискатели 
														if ($isbanktax){
									$claiposttaxname= $claitaxpref.$idclai;
/*
									$txamou= str_replace(" ","?",$_POST[$claiposttaxname]);
print "<br>";
var_dump($claiposttaxname);
var_dump($txamou);
									$_POST[$claiposttaxname]= $txamou;
*/
/*
									$txamou= $_POST[$claiposttaxname]= str_replace(" ","?",$_POST[$claiposttaxname]);
									if ($txamou==""){
									}else{
										$exvali= $evalvali["amount"];
										$value= $txamou;
										eval("\$result= ($exvali);");
										if ($result){
//var_dump($result);
											$lister[$claiposttaxname]= "грешна сума за такса";
											$iserror= true;
										}else{
										}
									}
*/
				# формална проверка на таксата за сумата за взискател 
				$txamou= checkamou($claiposttaxname,"грешна сума за такса"  ,$claipostname,"такса върху нулева сума");
								# общо разпределената сума 
								$disttota += $txamou +0;
														}else{
														}
			}
										#----------------------------------------------------------------------
										# 12.07.2010 - число - банк.такса за превод на разпределение 
										#----------------------------------------------------------------------
										# проверяваме и таксите към сумата за връщане 
														if ($isbanktax){
/*
									$txback= $_POST["backtax"]= str_replace(" ","?",$_POST["backtax"]);
									if ($txback==""){
									}else{
										$exvali= $evalvali["amount"];
										$value= $txback;
										eval("\$result= ($exvali);");
										if ($result){
//var_dump($result);
											$lister["backtax"]= "грешна сума за Такса";
											$iserror= true;
										}else{
										}
									}
*/
				# формална проверка на таксата за връщане 
				$backtax= checkamou("backtax","грешна сума за такса връщане"  ,"back","такса върху нулева сума връщане");
								# общо разпределената сума 
								$disttota += $backtax +0;
														}else{
														}

									# ако всички числа са верни формално - 
									# проверяваме дали постъпилата сума е равна на разпределената 
													# само ако не е натиснат бутона submit2 = запиши с несъвпадение 
													if ($mfacproc=="submit2"){
													}else{
									if ($iserror){
									}else{
//var_dump($_POST["inco"]+0);
//var_dump($disttota);
										$inco= $_POST["inco"] +0;
										$nfinco= number_format($inco,2,".","");
										$nfdist= number_format($disttota,2,".","");
//										if ($inco==$disttota){
										if ($nfinco==$nfdist){
										}else{
											$lister["inco"]= "не съвпада с общо разпределената сума " .number_format($disttota,2,".","");
		$smarty->assign("DISTTOTA", $disttota);
		$smarty->assign("SUBMIT2", true);
										}
									}
													# if ($mfacproc=="submit2"){
													}
																# край ако е директен превод - 
																# if ($idtype==9){
																}
	# if (empty($idcase)){
	}

//print_r(toutf8($lister));
											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
#---------------------------------- няма грешки ----------------------------------- 
							$retucode= 0;
		# подготвяме данните 
		$aset= $ficonst;
//print_r($aset);
		foreach($filist as $finame=>$ficont){
//print "<br>$finame";
//			if ($ficont["inactive"]){
//			}else{
				$aset[$finame]= $_POST[$finame];
							# put трансформация 
							if (isset($ficont["transformer"])){
								$resufunc= call_user_func($ficont["transformer"],"put",$edit,$finame,$_POST);
				$aset[$finame]= $resufunc;
							}else{
							}
//			}
		}
		# ако още не е избрано дело 
		unset($aset["separa"]);
		unset($aset["separa2"]);
				# 11.05.2010 - за връщане 
		unset($aset["back"]);
		
		# подготвяме допълнит.полета за ПКО 
		if ($idtype==2){
			# типа е в_брой=ПКО 
			$aset["cashyear"]= $curryear;
			$aset["cashdate"]= $cashdate;
			$aset["cashname"]= $cashname;
			if ($getnext){
				# избрано е "вземи следващия изх.номер" 
				# само за нов запис $finaedit==0 
				$aset["cashserial"]= $nextcash;
			}else{
				# въведен е желания изх.номер 
				$aset["cashserial"]= $serinome;
			}
		}else{
			# типа е различен - изчистваме евент.старо съдържание 
			$aset["cashserial"]= "";
			$aset["cashyear"]= "";
			$aset["cashdate"]= "";
			$aset["cashname"]= "";
		}
	
	# още корекции 
	$aset["iduser"]= $_SESSION["iduser"];
	$aset["inco"]= number_format($aset["inco"],2,".","");
										# 21.04.2010 - автоматично зареждаме делото, ако е възможно 
										# след автом.зареждане полето isauto=1 - тук го нулираме, но само ако е сменено делото 
										if ($aset["idcase"]==$rofina["idcase"]){
										}else{
											$aset["isauto"]= 0;
										}
//print_r($aset);
	
													#-----------------------------------------------------------------
													# частен случай - директен превод на взискателя 
													#-----------------------------------------------------------------
													if ($idtype==9){
															$INPARA= "1";
															include "finaeditdire.inc.php";
													}else{
#------------------ записваме -------------------
/*
	if ($edit==0){
		# нов запис 
		# - все още не е избрано дело и няма разпределение 
//					# финансиста може да добавя само тип "банков превод" 
//					$aset["idtype"]= 1;
		$edit= $DB->query("insert into $taname set ?a, time=now()" ,$aset);
	}else{
*/
		# корекция на записа 
			# разпред.за ЧСИ 
			$separa= $_POST["separa"] +0;
			$separa2= $_POST["separa2"] +0;
		# 11.05.2010 - за връщане 
		$back= $_POST["back"] +0;
					# финансиста може да корегира и други типове - без 2=вброй=ПКО 
//					$aset["idtype"]= 1;
		# ВНИМАНИЕ. $idcase вече е трансформирано 
		if (empty($idcase)){
			# не е избрано дело - чистим полетата за разпределение 
			$aset["separa"]= "";
			$aset["separa2"]= "";
			$aset["toclai"]= "";
		# 11.05.2010 - за връщане 
			$aset["back"]= "";
							# 21.04.2010 - оправена СТАРА грешка 
							# появява се, ако се нулира указателя към делото idcase 
							$aset["rest"]= $aset["inco"];
		}else{
			# взискателите по делото 
//print "clailist=E";
			$clailist= getclailist($idcase);
$smarty->assign("CLAILIST", $clailist);
			# има избрано дело - формираме полетата за разпределение 
			$separa= (empty($separa)) ? $separa : number_format($separa,2,".","");
			$aset["separa"]= $separa;
			$separa2= (empty($separa2)) ? $separa2 : number_format($separa2,2,".","");
			$aset["separa2"]= $separa2;
	# 11.05.2010 - за връщане 
	$back= (empty($back)) ? $back : number_format($back,2,".","");
	$aset["back"]= $back;
										#----------------------------------------------------------------------
										# 12.07.2010 - число - банк.такса за превод на разпределение 
										#----------------------------------------------------------------------
										if ($isbanktax){
	$backtax= (empty($backtax)) ? $backtax : number_format($backtax,2,".","");
	$aset["backtax"]= $backtax;
										}else{
										}
						
						$arclai= array();
											# 01.10.2009 - доп.поле за неразпределения остатък 
											# общата сума на взискателите 
											$suclai= 0;
//print_r($clailist);
										#----------------------------------------------------------------------
										# 12.07.2010 - число - банк.такса за превод на разпределение 
										#----------------------------------------------------------------------
										if ($isbanktax){
						$arclaitax= array();
										}else{
										}
			foreach($clailist as $idclai=>$x2){
				$claipostname= $claipref.$idclai;
				$clamou= $_POST[$claipostname];
//print "<br>[$idclai][$claipostname][$clamou]";
				$clamou= (empty($clamou)) ? $clamou : number_format($clamou,2,".","");
						$arclai[$idclai]= $clamou;
											# 01.10.2009 - доп.поле за неразпределения остатък 
											# общата сума на взискателите 
											$suclai += $clamou;
										#----------------------------------------------------------------------
										# 12.07.2010 - число - банк.такса за превод на разпределение 
										#----------------------------------------------------------------------
										if ($isbanktax){
											$claiposttaxname= $claitaxpref.$idclai;
											$txamou= $_POST[$claiposttaxname];
											$txamou= (empty($txamou)) ? $txamou : number_format($txamou,2,".","");
						$arclaitax[$idclai]= $txamou;
										}else{
										}
											# общата сума на взискателите 
											$suclai += $txamou;
			}
//print_r($arclai);
			$aset["toclai"]= serialize($arclai);
										#----------------------------------------------------------------------
										# 12.07.2010 - число - банк.такса за превод на разпределение 
										#----------------------------------------------------------------------
										if ($isbanktax){
			$aset["toclaitax"]= serialize($arclaitax);
										}else{
										}
											# 01.10.2009 - доп.поле за неразпределения остатък 
//											$aset["rest"]= $aset["inco"] - $aset["separa"] - $suclai;
//print "suclai=[$suclai]";
//											$aset["rest"]= $aset["inco"] - $aset["separa"] - $aset["separa2"] - $suclai;
//											$aset["rest"]= ($aset["inco"]+0) - ($aset["separa"]+0) - ($aset["separa2"]+0) - ($suclai+0);
											$aset["rest"]= round($aset["inco"],2) 
												- round($aset["separa"],2) 
												- round($aset["separa2"],2) 
										# 11.05.2010 - за връщане 
										- round($aset["back"],2) 
												- round($suclai,2);
										#----------------------------------------------------------------------
										# 12.07.2010 - число - банк.такса за превод на разпределение 
										#----------------------------------------------------------------------
//var_dump($aset["rest"]);
//var_dump(round($aset["backtax"],2));
										if ($isbanktax){
											$aset["rest"] -= round($aset["backtax"],2);
										}else{
										}
//var_dump($aset["rest"]);
											$aset["rest"]= round($aset["rest"],2);
/***********
print "<br>".round($aset["inco"],2);
print "<br>".round($aset["separa"],2);
print "<br>".round($aset["separa2"],2);
print "<br>".round($suclai,2);
print "<br>".round($aset["rest"],2);
**********/
		}
//print_r($aset);
//die();
/*
		$DB->query("update $taname set ?a, time=now() where id=?d" ,$aset,$edit);
	}
*/
											# 03.11.2009 - от името на кой длъжник е постъплението 
											$aset["iddebtor"]= $_POST["iddebtor"];
											if (empty($casefordebt)){
												unset($aset["iddebtor"]);
											}else{
											}
//print_r($aset);
	if ($edit==0){
						# 11.01.2011 - отделно НОВО поле за събирача 
						$aset["cashiduser"]= $_SESSION["iduser"];
		$edit= $DB->query("insert into $taname set ?a, time=now()" ,$aset);
										# 13.04.2011 КРЪПКА Дичев времето на създаване 
										$ro5= getrow($taname,$edit);
										if (isset($ro5["created"])){
		$DB->query("update $taname set created=now() where id=?d" ,$edit);
										}else{
										}
	}else{
		$DB->query("update $taname set ?a, time=now() where id=?d" ,$aset,$edit);
	}
															
															#------- само ако съществува таблицата finatran ------ 
															if ($finatran_exists){

#===================================================================
# 20.05.2010 записваме и в специална таблица за преводите 
	# добавяме полетата за псевдо взискателите 
	#   -1 = ЧСИ неолихвяеми 
	#   -2 = ЧСИ т.26 
	#   -3 = ЧСИ връщане 
/*
	$arclai[-1]= $aset["separa"];
	$arclai[-2]= $aset["separa2"];
	$arclai[-3]= $aset["back"];
*/
											include_once "fina.inc.php";
	foreach($pseuclaifiel as $psindx=>$psfiel){
		$arclai[$psindx]= $aset[$psfiel];
	}
//		# полетата за преводите 
//		$tset= array();
//		$tset["idfinance"]= $edit;
//		$tset["isdone"]= 0;
	# досегашните записи за преводи 
//	# [взискател] = id 
//	$currclai= $DB->selectCol("select idclaimer as ARRAY_KEY, id from finatran where idfinance=?d"  ,$edit);
	$currlist= $DB->selectCol("select id from finatran where idfinance=?d"  ,$edit);
//print_r($currlist);
		//	# за да запазим евент.указатели към пакети за превод 
		//	# [idclaimer] = idfinatranpack 
		//	$currpack= $DB->selectCol("select idfinatranpack, idclaimer as ARRAY_KEY from finatran where idfinance=?d"  ,$edit);
			# за да запазим останалите полета от съществ.разпределение 
			# [idclaimer] = idfinatranpack и др.полета 
			$currpack= $DB->select("select idclaimer as ARRAY_KEY
				, idfinatranpack, idclaim2, iban, bic, isdone
				from finatran where idfinance=?d"
				,$edit);
//print_r($currpack);
	# за всички взискатели вкл.псевдо 
	foreach($arclai as $clid=>$clamou){
		if ($clamou+0==0){
		}else{
			$tset= array();
			$tset["idfinance"]= $edit;
			$tset["isdone"]= 0;
			$tset["idclaimer"]= $clid;
			$tset["amount"]= $clamou;
			# възстановяваме запазените полета 
//			$tset["idfinatranpack"]= $currpack[$clid]["idfinatranpack"] +0;
			foreach(array("idfinatranpack","idclaim2","iban","bic","isdone") as $finame){
//			foreach(array("idfinatranpack","idclaim2","iban","bic") as $finame){
				$tset[$finame]= $currpack[$clid][$finame] ."";
			}
					if (empty($currlist)){
			$DB->query("insert into finatran set ?a, created=now()" ,$tset);
					}else{
			$myid= $currlist[0];
						# изтриваме 1вия елемент и преномерираме 
						array_shift($currlist);
			$DB->query("update finatran set ?a, created=now() where id=?d" ,$tset,$myid);
					}
		}
	}
	# ако досегашните записи са повече, изтриваме останалите 
	foreach($currlist as $currid){
		$DB->query("delete from finatran where id=?d" ,$currid);
	}
#===================================================================

															# край само ако съществува таблицата finatran 
															}else{
															}

													#-----------------------------------------------------------------
													# край на частен случай - директен превод на взискателя 
													#-----------------------------------------------------------------
													}
	
	# добавяме записа в архива 
	finaarchive($edit);
											# край - според дали има грешка 
											}

													# отключваме 
													$DB->query("unlock tables");

# 12.05.2010 ------------- проверяваме датата на погасяване за старо постъпление -----------------------
# записваме евент.причина за нарушаване на интервала 
$reason= $_POST["reason"];
if (isset($reason)){
	$rset= array();
//	$rset["idfinance"]= $edit;
//	$rset["finainterval"]= $finainte;
	$rset["text"]= $reason;
	$rset["iduser"]= $_SESSION["iduser"];
	if (empty($roreas)){
				$rset["idfinance"]= $edit;
				$rset["finainterval"]= $finainte;
		$DB->query("insert into finareason set ?a, time=now()" ,$rset);
	}else{
		$idreas= $roreas["id"];
		$DB->query("update finareason set ?a, time=now() where id=?d" ,$rset,$idreas);
	}
}else{
}

#------ submit с формални грешки 
}elseif ($mfacproc==NULL){
							$retucode= 1;
	doerrors();

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
if ($retucode==0){
								#------------------------ ЗАКЛЮЧВАНЕ --------------------------
								# отключваме заключения запис 
								updrow("finance",$edit,"lockedby=0");

							# ако е извикан алтернативно от дело 
							if ($CALLFROMCASE){
				# redirect 
							#---- януари-2010 актуален дълг ----
//				$smarty->assign("EXITCODE", getnyroexit("tpaymlink"));
							$redilink= array("tpaymlink","tactulink");
							$smarty->assign("EXITCODE", getnyroexit($redilink));
				print smdisp($tpname,"iconv");
							}else{
	# redirect 
	reload("parent",$relurl);
							}
}else{
				# линк за изтриване 
				$modeel= "mode=".$mode ."&page=".$page;
				$delelink= geturl($modeel."&edit=".$edit."&deleget=".$edit);
				$smarty->assign("DELELINK", $delelink);

							/*
							# за избор на "тип" - масива $listfinatype - commspec.php 
							# предаваме името, а не съдържанието на масива 
							$smarty->assign("ARTYPENAME", "listfinatype_utf8");
							*/
										# ВНИМАНИЕ. 17.02.2010 - ограничаваме корекциите на банкови постъпления 
							# за избор на "тип" - само при добавяне - масива $listfinatype - commspec.php 
							# предаваме името, а не съдържанието на масива 
										# премахваме типа банково постъпление 
										$listfinatype2= $listfinatype_utf8;
					# 21.06.2010 - флаг - забранено ръчното въвеждане на банкови постъпления 
					# премахваме типа банково постъпление - само ако е вдигнат този флаг 
					if ($isnomanual){
										unset($listfinatype2[1]);
# 14.12.2010 
# финансист и друг деловодител да може да добавят само погасяване в брой 
					}elseif ($FLAGCASHONLY){
						$listfinatype2= array(2=>$listfinatype2[2]);
					}else{
					}
							$smarty->assign("ARTYPENAME", "listfinatype2");
										# за извеждане - само при корекция 
										# предаваме и съдържанието на масива в 1251 
										$smarty->assign("ARTYPE", $listfinatype);
/*
# 14.12.2010 
# финансист и друг деловодител да може да добавят само погасяване в брой 
if ($FLAGCASHONLY){
						$smarty->assign("ARTYPE", array(2=>$listfinatype2[2]));
			}else{
						$smarty->assign("ARTYPE", $listfinatype2);
			}
*/
			# евентуалния следващ номер ПКО за текущата година 
			$smarty->assign("NEXTNUMB", getnextcash());
						# за тип=9=директно - заради избора на взискател - select/option 
															$INPARA= "2";
															include "finaeditdire.inc.php";
/*
# 12.05.2010 - ограничаване датата на погасяване за старо постъпление 
# - деловодителя може да въвежда дата, не по-раншна от преди 30 дена 
# - админа може да въвежда произволна дата 
# ако досега датата на погасяване е празна, подсказваме най-късната взъможна дата = 30 дена преди днешната 
if ($adminlogged and empty($_POST["datebala"])){
	$_POST["datebala"]= $padate;
}else{
}
*/					
															#------- само ако съществува таблицата finatran ------ 
															# създаваме масив с имената на маскирани полета, в които не може да се въвежда 
															# това са вече преведените суми по това постъпление 
															if ($finatran_exists){
																		$psfiel= array();
																		$psfiel[-3]= "separa";
																		$psfiel[-2]= "separa2";
																		$psfiel[-1]= "back";
																$mydisa= $DB->selectCol("
																select idclaimer from finatran
																where idfinance=?d and isdone<>0
																"  ,$edit);
												//print_rr($mydisa);
																			$ardisafiel= array();
																foreach($mydisa as $idcl){
																	if ($idcl <0){
																		$finame= $psfiel[$idcl];
																	}else{
																		$finame= $claipref .$idcl;
																	}
																			$ardisafiel[$finame]= true;
																}
																$smarty->assign("ARDISAFIEL", $ardisafiel);
												//print_rr($ardisafiel);
															}else{

															}
										#----------------------------------------------------------------------
										# 12.07.2010 - число - банк.такса за превод на разпределение 
										#----------------------------------------------------------------------
										# списъци за синхрон на банк.такси в шаблона - javascript 
														if ($isbanktax){
																					$arfiel= array();
							# 21.10.2010 - Дичев- иначе грешка warning ако няма дело 
							$clailist= empty($clailist) ? array() : $clailist;
										#--  за взискателите 
										foreach($clailist as $clid=>$x2){
																					$arfiel[$claipref.$clid]= $claitaxpref.$clid;
										}
										#-- за сумата за връщане 
																					$arfiel["back"]= "backtax";
																				$smarty->assign("ARFIEL", $arfiel);
														}else{
														}
	# извеждаме формата 
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
//print_rr($smarty->get_template_vars());
	print smdisp($tpname,"iconv");
}




# формална проверка - имитация на validator_amount_or_empty, univalidator 
# - виж commvali.php 
function checkamou($finame,$ertext  ,$finame2="",$ertext2=""){
global $evalvali, $lister, $iserror;
				$myamou= $_POST[$finame]= str_replace(" ","?",$_POST[$finame]);
				if ($myamou==""){
				}else{
					$exvali= $evalvali["amount"];
					$value= $myamou;
					eval("\$result= ($exvali);");
					if ($result){
//var_dump($result);
											$lister[$finame]= $ertext;
											$iserror= true;
					}else{
						if ($finame2==""){
						}else{
							if ($_POST[$finame2]+0==0 and $myamou+0<>0){
											$lister[$finame]= $ertext2;
											$iserror= true;
							}else{
							}
						}
					}
				}
return $myamou;
}


?>