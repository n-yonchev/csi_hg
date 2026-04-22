<?php
# зона-плащане : всички приходи по делото - списък 
# източник : cazo2.php 
# отгоре : 
#    $edit= case.id 
#    $zone= paym 
//#    $func= view, modi 
//# елемент за настройка 
//#    $idel - cash.id  
//print session_name()."=".session_id();
//print_rr($_SESSION);
//print_rr($GETPARAM);

# 16.05.2011 - админа може да игнорира приключване на постъпление 
# дали логнатия е админ 
	$rouser= getrow("user",$iduser=$_SESSION["iduser"]);
	$adminlogged= ($rouser["type"]==ADMINTYPE);
$smarty->assign("ADMINLOGGED", $adminlogged);

# 05.03.2010 - финансиста да може да корегира постъпленията от тази зона в делото 
# - дали логнатия е финансист 
# източник : 
								$finalo= false;
$rouser= getrow("user",$iduser=$_SESSION["iduser"]);
$arperm= explode(",",$rouser["listperm"]);
		if (array_search(4,$arperm)===false){
		}else{
$smarty->assign("FINALOGGED", true);
								$finalo= true;
		}
# 14.12.2010 
# финансист и друг деловодител да може да добавят погасяване в брой 
$FLAGNOCHANGE= getnochange($edit);
$smarty->assign("FLAGNOCHANGE", $FLAGNOCHANGE);
					$FLAGCASHONLY= false;
		if (array_search(3,$arperm)===false){
		}else{
			if ($FLAGNOCHANGE and !$finalo){
					$FLAGCASHONLY= true;
			}else{
			}
		}
$smarty->assign("FLAGCASHONLY", $FLAGCASHONLY);
//print "NOCHA=";
//var_dump($FLAGNOCHANGE);
//print "CAONLY=";
//var_dump($FLAGCASHONLY);
									
									# функции, свързани с финансите 
									include_once "fina.inc.php";
									# всичко за преводите 
									include_once "tran.inc.php";
/*
# списъка с постъпленията 
$qutranlist= "$qutran where $filtcase and $filtvari order by finance.id desc";
$mylist= $DB->select($qutranlist);
$mylist= dbconv($mylist);
*/
/***
# доп.данни - постъпления и преводи 
$exlist= $DB->select("select $qurefe where finatran.idcase=$edit order by finatran.idclaimer");
//$exlist= dbconv($exlist);
//print_rr($exlist);
$smarty->assign("EXLIST", $exlist);
# доп.данни - приключени постъпления чрез преводи 
$enddlist= $DB->select("select $quendd where finatran.idcase=$edit $quenddgr");
$smarty->assign("ENDDLIST", $enddlist);
//print_rr($enddlist);
***/

# таблицата 
$taname= "finance";
# шаблона 
$tpname= "cazofina.tpl";

//# съобщение при авариен край 
//$diemess= "cazofina";

//print_r($GETPARAM);
//print "[$edit][$zone][$func][$idel]";
//									$hist= $GETPARAM["hist"];
//									if (isset($hist)){

# ВНИМАНИЕ. 
# Специфични трансформации на ключовите параметри. 
									# историята на избран запис 
									$finahist= $GETPARAM["finahist"];
									if (isset($finahist)){
		$hist= $finahist;
		include_once "finahist.ajax.php";
		exit;
									}else{
									}

									# модификация на избрания запис 
									$finaedit= $GETPARAM["finaedit"];
									if (isset($finaedit)){
# използваме компонента за финансиста с модификации 
//		include_once "cazofinaedit.ajax.php";
			# специален флаг 
			$CALLFROMCASE= true;
	# съхраняваме 
	$editcase= $edit;
	$edit= $finaedit;
include_once "finaedit.ajax.php";
	# възстановяваме 
	$finaedit= $editcase;
exit;
									}else{
									}

									# отпечатване на избрания запис - ПКО 
									$finaprin= $GETPARAM["finaprin"];
									if (isset($finaprin)){
		include_once "cazofinaprin.ajax.php";
		exit;
									}else{
									}

									# изтриване на избрания запис 
									$finadele= $GETPARAM["finadele"];
									if (isset($finadele)){
		include_once "cazofinadele.ajax.php";
		exit;
									}else{
									}

							# разглеждане на избран запис - приключено постъпление 
							$info= $GETPARAM["info"];
							if (isset($info)){
		include_once "finainfo.ajax.php";
		exit;
							}else{
							}

							# корекция само на датата за погасяване 
							$date= $GETPARAM["date"];
							if (isset($date)){
			# специален флаг 
			$CALLFROMCASE= true;
		include_once "finadate.ajax.php";
		exit;
							}else{
							}

									/***/
									# приключване на избран запис 
									$clos= $GETPARAM["clos"];
									if (isset($clos)){
			# специален флаг 
			$CALLFROMCASE= true;
		include_once "finaclos.ajax.php";
		exit;
									}else{
									}
									/***/

# 12.11.2012 - старо приключено или готово за превод 
	# маркиране като старо приключено 
	$markclos= $GETPARAM["markclos"];
	if (isset($markclos)){
			# специален флаг 
			$CALLFROMCASE= true;
		include_once "finamarkclos.ajax.php";
		exit;
	}else{
	}
/*
	# маркиране като готово за превод 
	$marktran= $GETPARAM["marktran"];
	if (isset($marktran)){
			# специален флаг 
			$CALLFROMCASE= true;
		include_once "finamarktran.ajax.php";
		exit;
	}else{
	}
*/

							# септ-2010 групово разпределение 
									$grdist= $GETPARAM["grdist"];
									if ($grdist=="yes"){
			# специален флаг 
			$CALLFROMCASE= true;
		include_once "cazofinagrou.ajax.php";
		exit;
									}else{
									}

#---- 21.10.2011 БАНКОВИ ПРЕВОДИ ---------------------------------------------- 
									# функции за банковите преводи 
									include_once "finapaym.inc.php";
					# формиране на разпределения за банков превод 
					# не е в nyroModal 
					$topaym= $GETPARAM["topaym"];
					if (isset($topaym)){
//		$CALLFROMCASE= true;
//		include_once "cazofinagrou.ajax.php";
//		exit;
									paymcrea($topaym);
print "AAAA BBBB GGGGGGGGGGG";
//exit;
					}else{
					}

//									# всички разклонения 
//									include_once "finaclon.inc.php";

# основните параметри 
$modeel= "edit=$edit&zone=$zone";
# add new link 
//$addnew= geturl($modeel."&func=modi&idel=0");
$addnew= geturl($modeel."&finaedit=0");
# септ-2010 групово разпределение 
//$grdist= geturl($modeel."&grdist=yes");
$grdist= geturl($modeel."&grdist=yes"."&ajaxwait=yes");
$smarty->assign("GRDIST", $grdist);

# списъка 
$filter= "where $taname.idcase=$edit";
$myquery= "select $taname.*, $taname.id as id, user.name as finaname
				,debtor.name as debtname
						, finasource.idfinabank as idfinabank, finabank.codebank as codebank
, $BANKTIME as banktime
, $BANKTYPE as banktype
	from $taname 
	left join user on finance.iduser=user.id
				left join debtor on finance.iddebtor=debtor.id
left join finasource on finasource.idfinance=finance.id
						left join finabank on finasource.idfinabank=finabank.id
	$filter 
	order by $taname.id desc
	";
$mylist= $DB->select($myquery);
$mylist= dbconv($mylist);

# доп.данни - постъпления и преводи 
$exlist= $DB->select("select $qurefe where finatran.idcase=$edit order by finatran.idclaimer");
//$exlist= dbconv($exlist);
//print_rr($exlist);
$smarty->assign("EXLIST", $exlist);
# доп.данни - приключени постъпления чрез преводи 
$enddlist= $DB->select("select $quendd where finatran.idcase=$edit $quenddgr");
$smarty->assign("ENDDLIST", $enddlist);
//print_rr($enddlist);
										
										#----------------------------------------------------------------------
										# 12.07.2010 - число - банк.такса за превод на разпределение 
										#----------------------------------------------------------------------
										$rooffi= getofficerow($iduser);
										$banktax= $rooffi["banktax"] +0;
										$isbanktax= $banktax<>0;
//										$smarty->assign("BANKTAX", number_format($banktax,2,".",""));
//										$smarty->assign("BANKTAX", $banktax);
										$smarty->assign("ISBANKTAX", $isbanktax);

# за рефреша след "linkdebt" 
/*
$furefe= $_SERVER["HTTP_REFERER"];
$npos= strpos($furefe,"index.php");
$refe= substr($furefe,$npos);
var_dump($refe);
			$refe= "";
foreach($_SESSION["CASEGETPARAM"] as $gein=>$geco){
			$refe .= "&".$gein."=".$geco;
}
*/

														# 03.11.2009 - суми по длъжници 
														$arsudebt= array();
																	# 21.09.2011 - суми по направления на разпределението 
																	$arsudire= array();
											# 17.07.2013 - суми по дати на погасяване 
											$cudate= "";
											$coundate= 0;
											$datekey= 0;
														//$arcudate= array();
# трансформираме го - параметри за иконите 
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
//								$sour["bankname"]= $listxmltype[$cb=$sour["codebank"]];
	$mylist[$uskey]["bankname"]= $listxmltype[$cb=$uscont["codebank"]];
/*
	$mylist[$uskey]["edit"]= geturl($modeel."&func=modi&idel=".$idcurr);
	$mylist[$uskey]["prin"]= geturl($modeel."&func=prin&idel=".$idcurr);
	$mylist[$uskey]["dist"]= geturl($modeel."&func=dist&idel=".$idcurr);
*/
				# броя на записите в историята - НЕЕФЕКТИВНО 
				$coun= $DB->selectCell("select count(*) from finahist where idfinance=?d"  ,$idcurr);
				$coun= ($coun==0) ? 0 : $coun-1;
	$mylist[$uskey]["histcoun"]= $coun;
//	$mylist[$uskey]["hist"]= geturl($modeel."&hist=".$idcurr);
//	$mylist[$uskey]["hist"]= geturl($modeel."&func=hist&hist=".$idcurr);
	$mylist[$uskey]["hist"]= geturl($modeel."&finahist=".$idcurr);
	$mylist[$uskey]["edit"]= geturl($modeel."&finaedit=".$idcurr);
	$mylist[$uskey]["prin"]= geturl($modeel."&finaprin=".$idcurr);
	$mylist[$uskey]["dele"]= geturl($modeel."&finadele=".$idcurr);
				# изчисляваме и зареждаме балансовите полета 
	finacalc($uscont, $mylist[$uskey]);
//print_ru($mylist[$uskey]);
											# 17.07.2013 - суми по дати на погасяване 
											$datebala= $uscont["datebala"];
											if ($datebala==$cudate){
													$coundate ++;
														$arcudate["back"] += $uscont["back"];
														$arcudate["rest"] += $uscont["rest"];
														$arcudate["separa"] += $uscont["separa"];
														$arcudate["separa2"] += $uscont["separa2"];
														foreach($mylist[$uskey]["claiamou"] as $idclai=>$suclai){
															$arcudate["claiamou"][$idclai] += $suclai;
														}
											}else{
												if ($uskey==0){
												}else{
													$mylist[$datekey]["coundate"]= $coundate;
													$mylist[$datekey]["ardate"]= $arcudate;
												}
												$cudate= $datebala;
												$coundate= 1;
												$datekey= $uskey;
														$arcudate= $mylist[$uskey];
											}
//print "<br>datebala=[$datebala]";
//print_ru($arcudate);
/***
				# приключване на постъплението 
	$mylist[$uskey]["clos"]= geturl($modeel."&clos=".$idcurr);
***/
# 12.11.2012 - старо приключено или готово за превод 
$mylist[$uskey]["markclos"]= geturl($modeel."&markclos=".$idcurr);
$mylist[$uskey]["clos"]= geturl($modeel."&clos=".$idcurr);
//$mylist[$uskey]["marktran"]= geturl($modeel."&marktran=".$idcurr);
				# само разглеждане на приключено постъпление 
	$mylist[$uskey]["info"]= geturl($modeel."&info=".$idcurr);
				# корекция само на датата за погасяване 
	$mylist[$uskey]["date"]= geturl($modeel."&date=".$idcurr);
														# 03.11.2009 - суми по длъжници 
														$iddebtor= $uscont["iddebtor"];
														$arsudebt[$iddebtor]["suma"] += $uscont["inco"];
														$arsudebt[$iddebtor]["name"]= $uscont["debtname"];
																	# 21.09.2011 - суми по направления на разпределението 
																	$arsudire["back"] += $uscont["back"];
																	$arsudire["rest"] += $uscont["rest"];
																	$arsudire["separa"] += $uscont["separa"];
																	$arsudire["separa2"] += $uscont["separa2"];
																	if (empty($uscont["toclai"])){
																		$arclam= array();
																	}else{
																		$arclam= unsetoclai($uscont["toclai"]);
																	}
																	foreach($arclam as $idclai=>$suclai){
																		$arsudire[$idclai] += $suclai;
																	}
				# 03.11.2009 - параметри на линка за смяна на длъжника 
	$mylist[$uskey]["linkdebt"]= geturl("finaid=".$idcurr);
										#----------------------------------------------------------------------
										# 12.07.2010 - число - банк.такса за превод на разпределение 
										#----------------------------------------------------------------------
										# обща сума на банк.такси 
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
	#---- 21.10.2011 БАНКОВИ ПРЕВОДИ ---------------------------------------------- 
	$mylist[$uskey]["topaym"]= geturl($modeel."&topaym=".$idcurr);
}
											# 17.07.2013 - суми по дати на погасяване 
											if (isset($mylist[$datekey]["datebala"])){
												$mylist[$datekey]["coundate"]= $coundate;
												$mylist[$datekey]["ardate"]= $arcudate;
											}else{
											}
//print_ru($mylist);
													
														# 03.11.2009 - суми по длъжници 
														$smarty->assign("ARSUDEBT", $arsudebt);
														$smarty->assign("ARSUDEBTLEN", count($arsudebt));
														# 03.11.2009 - и тоталната сума 
																	$sutota= 0;
														foreach($arsudebt as $alsu){
																	$sutota += $alsu["suma"];
														}
														$smarty->assign("SUTOTA", $sutota);
																	# 21.09.2011 - суми по направления на разпределението 
																	$smarty->assign("ARSUDIRE", $arsudire);
																		$ardireindx["separa"]= "за ЧСИ неолихв";
																		$ardireindx["separa2"]= "за ЧСИ т.26";
																		$ardireindx["rest"]= "неразпределени";
																		$ardireindx["back"]= "за връщане";
																	$smarty->assign("ARDIREINDX", $ardireindx);
																	# взискателите 
																	$clailist= getclailist($edit);
																	$smarty->assign("CLAILIST", $clailist);

						# за извеждане на "тип" - масива $listfinatype - commspec.php 
						# предаваме съдържанието на масива 
						$smarty->assign("ARTYPE", $listfinatype2);
				# 04.11.2009 - за специфичната смяна на длъжника 
				# ако делото има >1 длъжник и постъплението е приключено 
				# колко длъжника има делото 
				$debtcoun= $DB->selectCell("select count(*) from debtor where idcase=?d", $edit);
				$smarty->assign("DEBTCOUN", $debtcoun);
//				$smarty->assign("EDITCASE", geturl("edit=$edit"));
//var_dump($debtcoun);
	# за извеждане на длъжник, който не е от това дело 
	# възможно е, ако делото е сменено след като са въведени постъпленията с длъжниците 
# НЕЛОГИЧНО ! 
	# - четем списъка с длъжниците по делото 
	$ardebt= getselect("debtor","name","idcase=$edit",false);
	$ardebt= array_keys($ardebt);
	$smarty->assign("ARDEBT", $ardebt);


//print_rr($_SERVER);
# резултата 
$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
$smarty->assign("IDCASE", $edit);
//$smarty->assign("LISTTEXT", $listtext);
$pagecont= smdisp($tpname,"iconv");
//print "<xmp>$pagecont</xmp>";


?>