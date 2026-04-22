<?php
# извеждане на избрано дело с корекция по зони 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $iduser - логнатия потребител 
//#    $mode - текущия режим 
//#    $page - страницата от списъка - за евент.бутон назад 
//#    $edit - user.id за извеждане 
//#    $filt - режима на филтъра 
//print_r($GETPARAM);


												# 11.02.2010 - общия план на зоните 
												$mainplan= $_SESSION["mainplan"][$edit];
//var_dump($mainplan);
												if (isset($mainplan)){
												}else{
# 04.10.2010 - профил на логнатия юзер 
//													$_SESSION["mainplan"][$edit]= "var1";
if (isset($usermainplan)){
	if (empty($usermainplan)){
		$usermainplan= "1";
	}else{
	}
	$mainplan= "var".$usermainplan;
}else{
	$mainplan= "var1";
}
//var_dump($mainplan);
												}
//print "[$edit][$mainplan]";
							$smarty->assign("MAINPLAN", $mainplan);
//print_rif($_SERVER);
							# за рефреша 
							$relurl= $_SERVER["REQUEST_URI"];
							$smarty->assign("RELURL", $relurl);
							
							# 25.11.2009 
							# регистрираме влизането за статистиката 
							$staset= array();
							$staset["idcase"]= $edit;
							$staset["iduser"]= $iduser;
							$staset["params"]= serialize($GETPARAM);
							$DB->query("insert into suithist set ?a, time=now()"  ,$staset);

# 17.06.2009 
# за финансиста - заради насочване на постъпление към дело 
$sedire= $_SESSION["direcase"];
if (isset($sedire)){
	$_SESSION["direcase"]["okcase"]= $edit;
	$smarty->assign("DATADIRECASE", true);
}else{
}

# заради cazobase.php 
if (isset($CASEALL)){
}else{
	$CASEALL= false;
			$_SESSION["FLAGALL"]= false;
}
//print "caseedit-caseall=";
//var_dump($CASEALL);
//print "caseedit-FLAGNOCHANGE=";
//var_dump($FLAGNOCHANGE);

//# номера на зоната 
//$zone= $GETPARAM["zone"];
//# функцията 
//$func= $GETPARAM["func"];
//print_rr($GETPARAM);
//			$_SESSION["CASEGETPARAM"]= $GETPARAM;

# 05.11.2009 
# линк за пълен рефреш на главния прозорец 
# - използва се в cazofinadebt.ajax.php 
			$refe= "";
foreach($GETPARAM as $gein=>$geco){
			$refe .= "&".$gein."=".$geco;
}
			$refe= substr($refe,1);
$_SESSION["CASEREFELINK"]= geturl($refe);

# режима от глав.меню 
$mode= $GETPARAM["mode"];
# страницата 
$page= $GETPARAM["page"];
# филтъра 
$filt= $GETPARAM["filt"];
# case.id за корекция 
$edit= $GETPARAM["edit"];

/*
# дали делото е на логнатия потребител 
$rocase= getrow("suit",$edit);
if ($rocase["iduser"]==$iduser){
}else{
//	var_dump($rocase["iduser"]);
//	var_dump($iduser);
								# 18.02.2009 
								# админа може да обслужва ВСИЧКИ дела, а не само своите 
								# проверяваме дали логнатия юзер е админ 
//								if ($ALLCASES){
								$rouser= getrow("user",$iduser);
								$isadmin= ($rouser["type"]==ADMINTYPE);
//								if ($isadmin){
								# b4 - 10.04.2009 - не допускаше разглеждане на дело след избор от търси дело 
//								if ($isadmin or $FLAGNOCHANGE){
												# 15.06.2010 - флаг - изп.дела нямат постоянни деловодители 
												# допуска разглеждането също и в този случай 
								if ($isadmin or $FLAGNOCHANGE or $NOPERMUSER){
								}else{
//	redirect("login.php");
exit;
//	var_dump($rocase["iduser"]);
//	var_dump($iduser);
//	print_rr($_SESSION);
//	print "==REDIRECT==";
								}
}
*/

# 01.07.2010 - ново решение 
#----------------------------------------------------------------------------------------
# уточняваме всички флагове 
# дали делото е на логнатия потребител 
$rocase= getrow("suit",$edit);
$flag_owncase= ($rocase["iduser"]==$iduser);
/*
													# 13.01.2011 - надбавката ОЛП 
													$_SESSION["extraint"]= $rocase["extraint"];
//var_dump($_SESSION["extraint"]);
*/
# дали логнатия юзер е админ 
$rouser= getrow("user",$iduser);
$flag_admin= ($rouser["type"]==ADMINTYPE);
		# 01.07.2010 - уточняваме глобалния флаг $FLAGNOCHANGE = не са разрешени корекции в делото 
		if ($flag_admin or $flag_owncase){
$FLAGNOCHANGE= false;
		}else{
		}
//var_dump($flag_admin);
//var_dump($flag_owncase);
//var_dump($FLAGNOCHANGE);
# допускаме разглеждането или нов логин 
if ($flag_owncase){
}else{
								# b4 - 10.04.2009 - не допускаше разглеждане на дело след избор от търси дело 
								# 15.06.2010 - флаг - изп.дела нямат постоянни деловодители 
								# допуска разглеждането също и в този случай 
								if ($flag_admin or $FLAGNOCHANGE or $NOPERMUSER){
								}else{
//	print "==REDIRECT==";
	redirect("login.php");
exit;
								}
}
#----------------------------------------------------------------------------------------

															if ($FLAGNOCHANGE){
															}else{
# 04.05.2009 - специален режим за делата със статус висящо 
# ако делото е маркирано за извеждане с различен фон - 
# след 1-вото влизане премахваме маркировката 
# за маркирането виж case.php - еднократно дневно сканиране на висящите дела
if ($rocase["flagstat"]==1){
	$DB->query("update suit set flagstat=0 where id=?d" ,$edit);
}else{
}
							#---- за табовете 
#-------------------------------------------------------------------------------------------------------------
/***
							# записваме делото в списъка с отворените табове 
							$mytext= $rocase["serial"]."/".$rocase["year"];
//			$editel= "mode=$mode&edit=$edit&func=view";
			$editel= "mode=$mode&page=$page&filt=$filt&edit=$edit";
							$mylink= geturl($editel ."");
//							$_SESSION["tabs"][$edit]= array("text"=>$mytext, "link"=>$mylink);
							$_SESSION["tabs"][$edit]= array("text"=>$mytext, "link"=>$mylink, "mark"=>($iduser<>$rocase["iduser"]) );
												# 18.02.2009 
												# заключване на делата и в БД - табл. suit 
										# заключваме делото в БД 
										$DB->query("update suit set lockedby=? where id=?" ,$iduser,$edit);
							# за премахване текущия таб от списъка 
			$editel= "mode=$mode&page=$page&filt=$filt";
							$smarty->assign("GOOUT", geturl($editel ."&goout=$edit"));
//							# за извеждане списъка с отворените табове 
//							$smarty->assign("TABSLIST", $_SESSION["tabs"]);
									# трансформираме линковете в масива $_SESSION["tabs"] 
									# - заради актуалното състояние на параметъра $filt 
									updatabslist();
									# за извеждане списъка с отворените табове 
									$smarty->assign("TABSLIST", $_SESSION["tabs"]);
***/
#-------------------------------------------------------------------------------------------------------------
# 31.03.2010 - Софрониев 
# табовете да работят правилно и когато се извиква от списък дела по номер - finolist.php 
# има допълнителен параметър seeknome 

							# записваме делото в списъка с отворените табове 
							$mytext= $rocase["serial"]."/".$rocase["year"];
			$editel= "mode=$mode&page=$page&filt=$filt&edit=$edit" ."&seeknome=$seeknome";
							$mylink= geturl($editel ."");
							$_SESSION["tabs"][$edit]= array("text"=>$mytext, "link"=>$mylink, "mark"=>($iduser<>$rocase["iduser"]) );
												# 18.02.2009 
												# заключване на делата и в БД - табл. suit 
										# заключваме делото в БД 
										$DB->query("update suit set lockedby=? where id=?" ,$iduser,$edit);
							# за премахване текущия таб от списъка 
			$editel= "mode=$mode&page=$page&filt=$filt" ."&seeknome=$seeknome";
							$smarty->assign("GOOUT", geturl($editel ."&goout=$edit"));
									# трансформираме линковете в масива $_SESSION["tabs"] 
									# - заради актуалното състояние на параметъра $filt 
//									updatabslist();
# използваме специфичен клонинг с добавен параметъра seeknome 
# за да не целия подменяме commspec.php - заради другите функции в него 
updatabslist2();
									# за извеждане списъка с отворените табове 
									$smarty->assign("TABSLIST", $_SESSION["tabs"]);
#-------------------------------------------------------------------------------------------------------------
															# if ($FLAGNOCHANGE){
															}
										
										# 11.06.2009 - предупреждение за непълни основни данни 
										# без случаите, ако е админа и ако е само за гледане 
																	# специфично, за да се различава ситуацията 
																	$_SESSION["FLAGYESSTAT"]= false;
										if ($CASEALL or $FLAGNOCHANGE){
										}else{
														# възможно е директно извикване на caseedit.php 
														# от скриптовете за търсене без редактиране - fiXXXXXX.php 
														if (function_exists("baseminus")){
														}else{
															include_once "casebase.inc.php";
														}
											# ако има грешка, намаляваме брояча 
											baseminus($rocase);
											# за извеждането 
											$bastat= $rocase["basestatus"];
/*
print "bastat=";
var_dump($bastat);
											if ($bastat==""){
											}else{
							$smarty->assign("BASESTATUS", $bastat);
*/
												if ($bastat=="0"){
							# лимита е изчерпан, спираме достъпа за корекции 
//print "NOCHANGE";
							$FLAGNOCHANGE= true;
							$smarty->assign("FLAGNOCHANGE", true);
																	# специфично, за да се различава ситуацията 
																	$_SESSION["FLAGYESSTAT"]= true;
//							$smarty->assign("FLAGNOTABS", false);
												}else{
												}
/*
											}
*/
										}
																	# специфично, за да се различава ситуацията 
																	$smarty->assign("FLAGYESSTAT", $_SESSION["FLAGYESSTAT"]);

$smarty->assign("EDIT", $edit);

# основните линкове 
			$editel= "edit=$edit&func=view";
$urllis["base"]= geturl($editel."&zone=base");
$urllis[1]= geturl($editel."&zone=1");
$urllis[2]= geturl($editel."&zone=2");
$urllis[3]= geturl($editel."&zone=3");
$urllis[4]= geturl($editel."&zone=4");
$urllis["paym"]= geturl($editel."&zone=paym");
					#---- януари-2010 актуален дълг ----
					$urllis["actu"]= geturl($editel."&zone=actu");
$urllis[5]= geturl($editel."&zone=5");
$urllis[6]= geturl($editel."&zone=6");
# 07.08.2009 - извадка от журнала - дневник на изв.действия 
$urllis["jour"]= geturl($editel."&zone=jour");

#---- 07.07.2009 финансов баланс [погасяване] ---- 
$urllis[7]= geturl($editel."&zone=7");
# 12.03.2010 зона-бележки и зона-събития 
$urllis["note"]= geturl($editel."&zone=note");
$urllis["even"]= geturl($editel."&zone=even");
# 18.07.2010 аванс.вноски от взиск. 
$urllis["adva"]= geturl($editel."&zone=adva");

# 22.11.2010 - сметки 
$urllis["bill"]= geturl($editel."&zone=bill");
//printarr($urllis);

# допълнителни js линкове за секцията head 
$smarty->assign("HEADJS", array("ajaxify.js","manageajax.js","_caseedit.js"));

# извеждаме 
							# ВАЖНО. беше изпуснато 
							$smarty->assign("FLAGNOCHANGE", $FLAGNOCHANGE);
//$smarty->assign("URLLIS", array($url1,$url2,$url3,$url4,$url5,$url6));
$smarty->assign("URLLIS", $urllis);
$smarty->assign("DATA", $rocase);

//$smarty->assign("CASELIST", $caselist);
//				$smarty->assign("EDIT", $edit);
//$pagecont= smdisp("caseview.tpl","fetch");



# 31.03.2010 - Софрониев 
# табовете да работят правилно и когато се извиква от списък дела по номер - finolist.php 
# има допълнителен параметър seeknome 
# използваме специфичен клонинг с добавен параметъра seeknome 
# за да не целия подменяме commspec.php - заради другите функции в него 
function updatabslist2(){
global $GETPARAM;
	$mode= $GETPARAM["mode"];
	$page= $GETPARAM["page"];
	$filt= $GETPARAM["filt"];
$seeknome= $GETPARAM["seeknome"];
$editel= "mode=$mode&page=$page&filt=$filt" ."&seeknome=$seeknome";
				if (isset($_SESSION["tabs"])){
	foreach ($_SESSION["tabs"] as $tain=>$x2){
		$_SESSION["tabs"][$tain]["link"]= geturl($editel ."&edit=".$tain);
												# 09.11.2009 - директен линк за премахване от списъка с табовете 
		$_SESSION["tabs"][$tain]["goout"]= geturl($editel ."&goout=".$tain);
	}
				}else{
				}
}

?>