<?php
# зона-6 : създаване на нов изходящ документ по делото 
# отгоре : 
#    $edit= case.id - изп.дело 
#    $zone= 6 
#    $func= view 
#  $docu= 0 - за създаване 
#  $arregistration - масив с мета имена, които се заместват при регистрация 

# типа на документа 
//$idtype= $_REQUEST["idtype"];
$idtype= $_POST["iddocutype"];
//print "<h1>$idtype</h1>";
//print_r($_POST);

//								include_once "common.php";

			include_once "cazo6creadocudefi.inc.php";
			
			# специално за Бургас 
			include_once "cazo6creadocu3.inc.php";


# масив за избор - за поле AKTUALNO_DO 
$araktual= array("1"=>"АГЕНЦИЯ ПО ВПИСВАНИЯ" ,"2"=>"СОФИЙСКИ ГРАДСКИ СЪД");
$araktual_utf8= toutf8($araktual);
$araktuout= array("1"=>"АГЕНЦИЯ ПО ВПИСВАНИЯ<br/>ТЪРГОВСКИ РЕГИСТЪР" ,"2"=>"СОФИЙСКИ ГРАДСКИ СЪД");
$araktuout_utf8= toutf8($araktuout);


# имитации заради CURRENT_DATE - тип=formdata 
# имитация на масив с данни, прочетени от таблица 
$rocurrdate["currdate"]= date("d.m.Y");
# имитация на променени данни - само за началното състояние 
	if (isset($_POST["current_date"])){
$_SESSION["rocurrdate"]["changed"]= false;
	}else{
$_SESSION["rocurrdate"]["changed"]= true;
	}

# 08.05.2009 - адресат за всички документи. 
# същото и за адресата 
# имитация на променени данни - само за началното състояние 
	if (isset($_POST["adresat"])){
$_SESSION["rodoty"]["changed"]= false;
	}else{
$_SESSION["rodoty"]["changed"]= true;
	}

# 11.11.2009 - списък със сумите на длъжник 
# имитация на променени данни - само за началното състояние 
	if (isset($_POST["debtsumi"])){
$_SESSION["debtsumi"]["changed"]= false;
	}else{
$_SESSION["debtsumi"]["changed"]= true;
	}

#---------------------------------------------------------------------------------------
# 08.01.2010 - същото за списък с дължимите суми - Шукри Дервиш Благоевград 
# имитация на променени данни - само за началното състояние 
//$listsubj["suit"]= "ТОВА Е СПИСЪКА<br>НА ДЪЛЖИМИТЕ СУМИ";
					$mysubj= $DB->select("select * from subject where idcase=$edit order by id");
					$mysubj= dbconv($mysubj);
//print_r($mysubj);
								$mysu= array();
					foreach($mysubj as $elem){
								$mysu[]= $elem["amount"]." лв|представляваща ".$elem["text"];
					}
//print_r($mysu);
					$listsubj["suit"]= implode("\r\n",$mysu);
	if (isset($_POST["spis_sumi"])){
$_SESSION["listsubj"]["changed"]= false;
	}else{
$_SESSION["listsubj"]["changed"]= true;
	}
#---------------------------------------------------------------------------------------

//# мета имена, които ще се заместват по-късно 
//$arregistration= array("(-[IZHODQSHT_NOMER]-)","(-[IZHODQSHT_GODINA]-)");

# трансформираме индексите на масива 
# получаваме масив за търсене $arrepl 
		$arrepl= array();
foreach($arsource as $arin=>$arco){
		$arrepl["(-[".$arin."]-)"]= $arco;
}
//print_r($arrepl);
//printarr($arrepl);

# съдържанието на документа шаблон 
$rodoty= getrow("docutype", $idtype);
//print_r(to1251($rodoty));
$fnam= OUTDIR.$rodoty["filename"];
$cont= file_get_contents($fnam);
			#---08.01.2010---------------------------------------------
			$cont= readtemphtml($fnam);
			#----------------------------------------------------------
//print "<xmp>$cont</xmp>";

# регулярния израз за търсене 
//$pattern= '|' .$st1 .'.+?' .$st2 .'|si';
//$pattern= '|' .'\(\-\[' .'.+?' .'\]\-\)' .'|';
		# 27.04.2010 - 
		# i= insensitive, s= на повече от един ред 
$pattern= '|' .'\(\-\[' .'.+?' .'\]\-\)' .'|is';
//print $pattern ."<br>";
# търсим 
$found= preg_match_all($pattern, $cont, $matches);
//var_dump($found);
//var_dump($matches);

# четем данните за кантората 
$rooffi= getofficerow(1);
//printarr($rooffi);
//$rooffi= to1251($rooffi);

# четем данните за изпълнителното дело 
$rocase= getrow("suit", $edit);
# и за съда "идва от" 
$rofrom= getrow("cofrom", $rocase["idcofrom"]);

#------- допълнителни входни полета ------------------------
# извеждаме допълнителни полета за избор - взискател, длъжник, предмет 
# четем съотв.запис от данните 
foreach($arex as $exindx=>$exar){
	$resuex= exfiel($exindx);
//print "<br>[$exindx]";
//var_dump($resuex);
	if ($resuex){
		$tablna= $exar["table"];
		$fielna= $exar["postfiel"];
		$roname= $exar["roname"];
		$postcont= $_POST[$fielna];
//----------print "<br>[$tablna][$fielna][$roname][$postcont]";
						# за избор от select/option - четем списъка 
						$smarname= $exar["smarname"];
						$funcname= $exar["getselfunc"];
								if (empty($funcname)){
						${$smarname}= getselect($tablna,"name","idcase=$edit",true);
								}else{
//						${$smarname}= call_user_func($funcname);
						${$smarname}= call_user_func($funcname ,$exar["fupa"]);
								}
//							$myname= (empty($textname)) ? "name" : call_user_func($textname);
//						${$smarname}= getselect($tablna,$myname,"idcase=$edit",true);
//var_dump($smarname);
//print "postcont=[$postcont]";
//print_r(${$smarname});
						//$ardocutype= dbconv($ardocutype);
						# предаваме името на масива 
						$smarty->assign($smarname."NAME", $smarname);
				# ако в списъка има единствен елемент и още не е избран - избираме него 
				# ВНИМАНИЕ. първия елемент е с индекс =0 
//----------print "beforeAUTO=[$postcont][".count(${$smarname})."]";
# 17.01.2011 - автоматичен избор на сметка - от основ.данни = текста [desc] за избраната сметка 
//var_dump(${$smarname});
//print_rr(${$smarname});
$contelemsele= ${$smarname}["==sele=="];
				if ($postcont==0){
					if (count(${$smarname})==2){
														# 07.05.2009 
														# специфичен флаг 
														$AUTOFIRST= true;
						$akey= array_keys(${$smarname});
						$_POST[$fielna]= $akey[1];
		$postcont= $_POST[$fielna];
//print "<br>FIRSTELEM=roname=[$roname]";
					}else{
# 17.01.2011 - автоматичен избор на сметка - от основ.данни = текста [desc] за избраната сметка 
if (isset($contelemsele)){
				$indxsele= 0;
	foreach(${$smarname} as $smindx=>$smcont){
		if ($smindx=="==sele=="){
		}else{
			if ($smcont==$contelemsele){
				$indxsele= $smindx;
			}else{
			}
		}
	}
	$_POST[$fielna]= $indxsele;
	$postcont= $_POST[$fielna];
}else{
}
					}
				}else{
				}
# 17.01.2011 - автоматичен избор на сметка - от основ.данни = текста [desc] за избраната сметка 
if (isset($contelemsele)){
			unset(${$smarname}["==sele=="]);
}else{
}
//print "postcont=[$postcont]";
//		if (isset($postcont)){
		//if (isset($postcont) and $postcont<>0){
		if (empty($tablna)){
			# специално заради CSI_SMETKA 
			$datfuncname= $exar["getdatfunc"];
			${$roname}= call_user_func($datfuncname,$postcont);
//var_dump($postcont);
//var_dump(${$roname});
				# иначе дава грешка dbconv 
				if (isset($postcont) and isset(${$roname})){
			${$roname}= dbconv(${$roname});
				}else{
				}
//var_dump(${$roname});
//print_r(${$roname});
		}else{
			${$roname}= getrow($tablna,$postcont);
		}
			//# ВАЖНО. заради CSI_SMETKA - @ за да не излиза грешка 
			//${$roname}= @getrow($tablna,$postcont);
//print "before=roname=[$roname]";
														# според специфичния флаг 
														if ($AUTOFIRST){
//print "<br>AUTOFIRST";
											$_SESSION[$roname]["changed"]= true;
											$_SESSION[$roname]["idrecord"]= $postcont;
														}else{
											# за текущия тип съхраняваме в сесията 2 стойности 
											#    - id за текущия прочетен запис 
											#    - флаг дали това id е различен от предишния 
											$lastid= $_SESSION[$roname]["idrecord"];
//print "POSTCONT=[$postcont][$lastid][$postcont]roname=[$roname]";
											$_SESSION[$roname]["changed"]= ($lastid <> $postcont);
											$_SESSION[$roname]["idrecord"]= $postcont;
														}
//print "POSTCONT=[$postcont][$lastid][$postcont]roname=[$roname]";
//print_r($_SESSION[$roname]);
//var_dump($_SESSION[$roname]);
		//}else{
		//}
# 19.01.2011 - за чужденец 
if ($roname=="roclai" or $roname=="rodebt"){
		tranfore(${$roname});
/***
	$exdata= unserialize(${$roname}["exdata"]);
print_rr($exdata);
	if ($exdata===false){
${$roname}["t2fo"]= false;
	}else{
${$roname}["t2fo"]= ($exdata["t2fo"]==1);
${$roname}["t2date"]= $exdata["t2date"];
//		$rocory= getrow("country",$exdata["t2cory"]);
//${$roname}["t2cory"]= $rocory["name"];
		$coryname= $DB->selectCell("select name from country where code=?"  ,$exdata["t2cory"]);
${$roname}["t2cory"]= $coryname;
				$t2date= ${$roname}["t2date"];
				$t2cory= ${$roname}["t2cory"];
				$t2egn= ${$roname}["egn"];
				$newegn= "";
				$newegn .= (empty($t2egn)) ? "" : " с ЛНЧ ".$t2egn;
				$newegn .= (empty($t2date)) ? "" : " дата на раждане ".$t2date;
				$newegn .= (empty($t2cory)) ? "" : " гражданство ".$t2cory;
${$roname}["egn"]= $newegn;
//${$roname}["egn"]= toutf8($newegn);
	}
***/
}else{
}
# ВАЖНА КОРЕКЦИЯ - 27.05.2009 
${$roname}= arstrip(${$roname});
//++++var_dump($roname);
//++++print_rr(${$roname});
//print_rr(toutf8(${$roname}));
										# 11.11.2009 - 
										# специално за списък с дължимите суми за длъжник - маркер DLUJNIK_SUMI 
										if ($roname=="rodebt"){
													include "cazo6creadocu2.inc.php";
										}else{
										}
										
	}else{
	}
}
//print_r($debtsumi);

/*
function arstrip($value){
	$value = is_array($value) ?	array_map('arstrip', $value) : stripslashes($value);
return $value;
}
*/
#------- край на допълнителни входни полета ------------------------

# 17.08.2009 - избор на длъжници и съпрузите им с чекбоксове 
# еднократно преди цикъла - заради функцията за настройки при първото извикване spoubegi() 
						include_once "cazo6creadocudefi.inc.php";
/*
						# името на скрипта да е съгласувано със значението ["ajax"] за полето/полетата 
						# 19.01.2010 - според тага 
//print_rr($_SESSION);
print_rr($_POST);
						if ($fielname){
						}else{
						}

//+++++++++							include_once "c6spouse.ajax.php";
*/

# масива с намерените стрингове 
# формираме масив за извеждане на заместванията в този документ 
				$data= array();
foreach($matches[0] as $x1=>$maco){
//print "<br>BEGIN=$maco";
								# пропускаме името, ако вече го има в резултатния масив 
								# причина : 
								# присвояването на $_POST променливата за тип form и formdata 
								# по-надолу : $_POST[$fielname]= $contre; 
								# това изисква маркера да мине само веднъж през този цикъл, тоест да няма повторения 
								if (isset($data[$maco])){
//print "<br>";
//var_dump(isset($data[$maco]));
									continue;
								}else{
								}
									# пропускаме името, ако ще се замества чак при регистрация 
									if (in_array($maco,$arregistration)){
									}else{
//	print "<br>elem=$x1=$maco";
	$arelem= $arrepl[$maco];
//printarr($arelem);
	$contre= NULL;
										#++++++++++++++++++++ ВРЕМЕННО +++++++++++++++++++++++++ 
										if (isset($arelem)){
										}else{
											$specname= substr($maco,3);
											$specname= substr($specname,0,strlen($specname)-3);
//var_dump(strtoupper($specname));
//var_dump(mb_strtoupper($specname,"utf-8"));
/*
											$arelem= array(
												"type"=>"form"
											//	,"from"=>"EMPT"
												,"text"=>$specname
												,"fieltype"=>"text"
												,"fielname"=>$specname
											,"SPECFLAG"=> 1
												);
*/
											$arelem= array(
												"type"=>"form"
												,"text"=>tran1251($specname)
												,"fieltype"=>"text"
												,"fielname"=>cyrlat(tran1251(mb_strtoupper($specname,"utf-8")))
//												,"fielname"=>cyrlat(strtoupper($specname))
//												,"fielname"=>cyrlat(toutf8(strtoupper($specname)))
											,"SPECFLAG"=> 1
												);
										}
//print_r($arelem);
	if (isset($arelem)){
		$artype= $arelem["type"];
		$arfrom= $arelem["from"];
//		$arname= $arelem["name"];
//print "<br>[$artype][$arfrom][$arname]";
		if (0){
# ВНИМАНИЕ. 
# Демонстрация на 3 различни начина - според структурата на масива $arcource=$arrepl 
/*
#    =dire =dire2 =dire3, сега работи само dire3
		}elseif ($artype=="dire"){
			$contre= ${$arfrom}[$arname];
//var_dump($contre);
		}elseif ($artype=="dire2"){
//print "dire2=$arfrom";
			list($rena,$rein)= explode("^",$arfrom);
			$contre= ${$rena}[$rein];
*/

		#---- директна стойност ----
		}elseif ($artype=="dire3"){
			eval("\$contre= $$arfrom;");
																	#+++++++++++++++ ВРЕМЕННО +++++++++++++
																	# [SPECFLAG] 
											$arelem["SPECFLAG"]= (empty($contre)) ? 2 : 0;
//print "<br>$maco";
//var_dump($contre);
					$artran= $arelem["tran"];
					if (empty($artran)){
					}else{
			$contre= call_user_func($artran,$contre);
					}

		#---- стойност на поле от форма ----
		# 2 вида : 
		#    form - независима от данните 
		#    formdata - с начална стойност от данните 
//		}elseif ($artype=="form"){
		}elseif ($artype=="form"    or $artype=="formdata"){
//print "<br>$maco=$arfrom=";
						$fieltype= $arelem["fieltype"];
						$fielname= $arelem["fielname"];
						$fielcont= $_POST[$fielname];
# 13.03.2009 ПЕТЪК - 
# за новата разновидност - попълване чрез въвеждане във форма, но с предварително съдържание 
$fielvalue= $arelem["fielvalue"];
//var_dump($fielvalue);
if (isset($fielvalue) and !isset($fielcont)){
	$fielcont= $fielvalue;
	$_POST[$fielname]= toutf8($fielvalue);
}else{
}
										if (empty($fielcont)){
											unset($fielcont);
										}else{
										}
//print "[$fieltype][$fielname][$fielcont]";
					# според вида 
					if ($artype=="form"){
						# независима от данните 
								# вземаме последната въведена стойност 
						//		$contre= to1251($fielcont);
						//		$contre= toutf8($fielcont);
								$contre= $fielcont;
//								$contre= (empty($contre)) ? "???" : $contre;
					}else{
						# с нач.стойност от данните - напр.адрес 
						$dataname= $arelem["name"];
						$dataindx= $arelem["indx"];
											# за текущия тип в сесията вече има 2 стойности : 
											#    - id за текущия прочетен запис 
											#    - флаг дали това id е различен от предишния 
																# според флага 
//print "data=[$dataname][$dataindx]";
//print "<br>dataname=$dataname==SESSION=";
//print_r($_SESSION[$dataname]);
//print_r($_SESSION);
//var_dump($_SESSION[$dataname]["changed"]);
																if ($_SESSION[$dataname]["changed"]){
																	# записа е сменен 
//print "<br>$maco=CHANGED=";
//print "[$dataname][$dataindx]";
								# вземаме нач.стойност от данните 
								$contre= ${$dataname}[$dataindx];
								# зареждаме и POST 
								//$_POST[$fielname]= to1251($contre);
								$_POST[$fielname]= toutf8($contre);

																}else{
//print "<br>$maco=fromPOST=";
																	# записа е предишния 
								# вземаме последната стойност от POST 
								# може да са въведени ръчни корекции на началните данни 
								$contre= to1251($fielcont);
//								$contre= (empty($contre)) ? "???" : $contre;
																}
//var_dump($contre);
#---------------------------------------------------------------------------------------
# ВНИМАНИЕ ЛЕПЕНКА. 
# 08.01.2010 - СПЕЦИАЛНО за списък с дължимите суми - Шукри Дервиш Благоевград 
if ($fielname=="spis_sumi"){
	$ssar= explode("\r\n",$contre);
				$ssresu= "";
	foreach($ssar as $sselem){
		list($ss1,$ss2)= explode("|",$sselem);
				$ssresu .= "<tr> <td>$ss1 <td width=10>&nbsp; <td>$ss2";
	}
	$contre= "<table cellspacing=0 cellpadding=0>$ssresu</table>";
//	$contre .= "БАБАБАБАБА";
}else{
}
#---------------------------------------------------------------------------------------
					}
																	#+++++++++++++++ ВРЕМЕННО +++++++++++++
																	# [SPECFLAG] 
															if (isset($arelem["SPECFLAG"])){
																# вече има стойност =1 - липсва в масива с маркерите 
																# ще се изведе в червено 
															}else{
											$arelem["SPECFLAG"]= (empty($contre)) ? 2 : 0;
															}

		#---- стойност чрез функция ----
		}elseif ($artype=="func"){
			eval("\$contre= $arfrom();");
																	#+++++++++++++++ ВРЕМЕННО +++++++++++++
																	# [SPECFLAG] 
											$arelem["SPECFLAG"]= (empty($contre)) ? 2 : 0;

		}else{
		}
//$data[$maco]= array("text"=>$arelem["text"] ,"cont"=>$contre);
	}else{
//$data[$maco]= array();
	# if (isset($arelem)){
	}

//print "<br>END-$maco-CONTRE=";
//var_dump($contre);
	# последен етап 
																	#+++++++++++++++ ВРЕМЕННО +++++++++++++
																	# [SPECFLAG] 
	$data[$maco]= array("text"=>$arelem["text"] ,"cont"=>$contre    ,"SPECFLAG"=>$arelem["SPECFLAG"]);
//	if ($artype=="form"){
	if ($artype=="form"    or $artype=="formdata"){
		$data[$maco]["fieltype"]= $fieltype;
		$data[$maco]["fielname"]= $fielname;
		# специално за полетата тип select 
		$data[$maco]["arname"]= $arelem["arname"];
		# специално за запис в данните 
		$data[$maco]["todata"]= $arelem["todata"];
//				#+++++++++++++++ ВРЕМЕННО +++++++++++++
//		$data[$maco]["SPECFLAG"]= $arelem["SPECFLAG"];
# 17.08.2009 - избор на длъжници и съпрузите им с чекбоксове 
# специално за полетата ajax 
$elemajax= $arelem["ajax"];
if (empty($elemajax)){
}else{
//		include_once $elemajax;
		$data[$maco]["ajax"]= $elemajax;
							# настройки при първото извикване 
//print "cazo6creadocu.inc.php=";
//var_dump($fielname);
//print_rr($_SESSION);
						# името на скрипта да е съгласувано със значението ["ajax"] за полето/полетата 
						# 19.01.2010 - според тага 
//print_rr($_SESSION);
//print_rr($_POST);
							if ($fielname=="EXTRA_spis_banki"){
								include_once "c6bank.ajax.php";
				spoubegi_bank($fielname);
							}elseif ($fielname=="spis_sumi_zapl" or $fielname=="spis_sumi_list" or $fielname=="spis_sumi_delo"){
								include_once "c6sumi.ajax.php";
				spoubegi_sumi($fielname);
							}elseif ($fielname=="spis_sumi_list_2"){
								include_once "c6sumi2.ajax.php";
				spoubegi_sumi2($fielname);
							}else{
								include_once "c6spouse.ajax.php";
				spoubegi_spouse($fielname);
							}
//							spoubegi($fielname);
}
	}else{
	}
//print "<br><br>$maco<br><br>";
//print_r(toutf8($data[$maco]));
//print "<br><br>";

									# край на пропускането за регистрация 
									}
}
					
//print_r(toutf8($data));
//$tpname= "cazo6creadocu.tpl";
$smarty->assign("DOCUTYPE", $idtype);
$smarty->assign("DATA", $data);
//print smdisp($tpname,"iconv");



# проверка за доп.входни полета 
function exfiel($p1){
global $matches;
					$flag= false;
//print "<br>PPP1=$p1";
	foreach($matches[0] as $x1=>$maco){
//print "<br>$maco";
		# има 3 водещи символа, които са пропуснати 
		if (substr($maco,3,strlen($p1))==$p1){
					$flag= true;
					break;
		}else{
		}
	}
//var_dump($flag);
return $flag;
}



# спомагателни функции за недиректни замествания 
function debt1(){
global $rodebt;
//var_dump($rodebt);
	if (isset($rodebt)){
//return $rodebt['name'] ." ЕГН " .$rodebt['egn'];
		$typedebt= $rodebt["idtype"];
		if (0){
		}elseif ($typedebt==1){
//			$txelem= " булстат " .to1251($rodebt["bulstat"]);
			$txelem= " ЕИК " .to1251($rodebt["bulstat"]);
		}elseif ($typedebt==2){
			$txelem= " ЕГН " .to1251($rodebt["egn"]);
//print_rr($rodebt);
//var_dump($txelem);
# 19.01.2011 - за чужденец 
if ($rodebt["t2fo"]){
//			$txelem= " ЛНЧ " .to1251($rodebt["egn"]);
//			$txelem= to1251($rodebt["egn"]);
			$txelem= $rodebt["egn"];
}else{
}
//var_dump($txelem);
		}else{
			$txelem= " ?????? ";
		}
return $rodebt["name"] .$txelem;
	}else{
return "";
	}
}

function debt2(){
global $rodebt;
//var_dump($rodebt);
	if (isset($rodebt)){
return $rodebt['regipers'] ." ЕГН " .$rodebt['regipersegn'];
	}else{
return "";
	}
}

# 04.02.2010 - рожден ден на тате 
# оправена грешка - данните се вземат от $rodebt, а не от $roclai 
function debt3(){
global $rodebt;
//var_dump($rodebt);
//print_r($rodebt);
	if (isset($rodebt)){
		$typeclai= $rodebt["idtype"];
		if (0){
		}elseif ($typeclai==1){
return $rodebt['bulstat'];
		}elseif ($typeclai==2){
return $rodebt['egn'];
		}else{
return "????????";
		}
	}else{
return "";
	}
}

function clai1(){
global $roclai;
//var_dump($rodebt);
	if (isset($roclai)){
		$typeclai= $roclai["idtype"];
		if (0){
		}elseif ($typeclai==1){
return $roclai['bulstat'];
		}elseif ($typeclai==2){
return $roclai['egn'];
		}else{
return $roclai['bulstat'];
		}
	}else{
return "";
	}
}

function clai2(){
global $roclai;
//var_dump($rodebt);
	if (isset($roclai)){
		$typeclai= $roclai["idtype"];
		if (0){
		}elseif ($typeclai==1){
//return "булстат";
return "ЕИК";
		}elseif ($typeclai==2){
return "ЕГН";
		}else{
return $roclai['bulstat'];
		}
	}else{
return "";
	}
}

# 04.06.2009 - име и ЕГН на съпруга, ако длъжника е физич.лице 
function debtsa(){
global $rodebt;
	$txelem= $rodebt["name2"] .", ЕГН " .$rodebt["egn2"];
return $txelem;
}


# януари-2010 - специфични изх.документи от Шукри Дервиш Бл.град 
#-----------------------------------------------------------------------
# молба за образуване 
function molbaob(){
global $DB, $edit;
	$rodocu= $DB->selectRow("
		select docu.serial, docu.year 
		from docusuit
		left join suit on docusuit.idcase=suit.id
		left join docu on docusuit.iddocu=docu.id
		left join aadocutype on docu.idtype=aadocutype.id
		where docusuit.idcase=$edit and aadocutype.mode='crea'
		");
return $rodocu['serial']."/".$rodocu['year'];
}
# общо дълг по делото 
# олихв.суми без лихвите + неолихв. от тип "по изпълн.лист" 
function obshto_dylg(){
global $DB, $edit;
	$suma= $DB->selectCell("
		select sum(amount)
		from subject
		where idcase=$edit and (idtype=1 or (idtype=2 and idsubtype=4))
		");
return number_format($suma,2,".",",");
}
# общо разноски по делото 
# неолихв. от типовете без "по изпълн.лист" 
function obshto_raznos(){
global $DB, $edit;
	$suma= $DB->selectCell("
		select sum(amount)
		from subject
		where idcase=$edit and (idtype=2 and idsubtype<>4)
		");
return number_format($suma,2,".",",");
}
#-----------------------------------------------------------------------
# 21.07.2010 - Дичев - всички такси без/със т.26 - commspec.php $listsubjst 
# практически същото като obshto_raznos() 
function delosumtax(){
global $DB, $edit;
	$suma= $DB->selectCell("
		select sum(amount)
		from subject
		where idcase=$edit and (idtype=2 and idsubtype in (8,12,16,18,20))
		");
return number_format($suma,2,".",",");
}
# за т.26 виж дефинициите 
function delosumtax_t26(){
global $DB, $edit;
//	$suma= delosumtax() + $_SESSION['calctax'];
//var_dump($_SESSION['calctax']);
	$sumtax= delosumtax();
		$sumtax= str_replace(",","",$sumtax);
	$suma= $sumtax + $_SESSION['calctax'];
return number_format($suma,2,".",",");
}
#-----------------------------------------------------------------------


function exnu(){
global $rooffi, $rocase;
	$idtitu= $rocase["idtitu"];
return $rocase['year'] .$rooffi['serial'] . "04" .str_pad($rocase['serial'],5,"0",STR_PAD_LEFT);
}

function delo1(){
global $rocase, $listtitu;
	$idtitu= $rocase["idtitu"];
return $listtitu[$idtitu];
}

function delo2(){
global $rocase, $listsubtit;
	$idsubtit= $rocase["idsubtit"];
return $listsubtit[$idsubtit];
}

# списък на всички длъжници по делото 
function delo3(){
global $edit, $DB;
	$data= $DB->select("select * from debtor where idcase=$edit");
//					$result= "";
//	$text= (count($data)==1) ? "длъжник " : "длъжници ";
//					$result .= $text;
					$listre= array();
	foreach($data as $elem){
		$typedebt= $elem["idtype"];
		if (0){
		}elseif ($typedebt==1){
//			$txelem= " булстат " .to1251($elem["bulstat"]);
			$txelem= " ЕИК " .to1251($elem["bulstat"]);
		}elseif ($typedebt==2){
			$txelem= " ЕГН " .to1251($elem["egn"]);
		}else{
			$txelem= " ?????? ";
		}
# 19.01.2011 - за чужденец 
tranfore($elem);
egnrepl($txelem,$elem);
					$listre[]= to1251($elem["name"]) .$txelem;
	}
	$text= (count($data)==1) ? "длъжник " : "солидарни длъжници ";
	$result= $text .implode(", ",$listre);
return $result;
}

# 09.07.2010 - клонинг за Дичев Списък-Длъжници 
function delodebtlist(){
return delogetlist("debtor","длъжник","длъжници");
}
# 09.07.2010 - клонинг за Дичев Списък-Взискатели 
function deloclailist(){
return delogetlist("claimer","взискател","взискатели");
}
# и за двете функции 
function delogetlist($tabl,$one,$more){
global $edit, $DB;
	$data= $DB->select("select * from $tabl where idcase=$edit");
	$data= dbconv($data);
# 19.01.2011 - за чужденец 
//++++print "<br>data-before<br>";
//++++print_rr($data);
foreach($data as $indx=>$x2){
	tranfore($data[$indx]);
}
//++++print "<br>data-after<br>";
//++++print_rr($data);
					$result= "";
	$text= (count($data)<=1) ? $one : $more;
					$result .= $text ." ";
					$listre= array();
	foreach($data as $elem){
		if ($tabl=="debtor"){
			$cuel= call_user_func("data_debt99one",$elem);
		}else{
			$cuel= call_user_func("data_clai99one",$elem);
		}
					$listre[]= $cuel;
	}
//++++print "<br>listre<br>";
//++++print_rr($listre);
			$listco= count($listre);
			if ($listco<=1){
	$result= $text .$listre[0];
			}else{
				$lastelem= array_pop($listre);
	$result= $text .implode(", ",$listre) ." и " .$lastelem;
			}
return $result;
}


# 13.03.2009 ПЕТЪК - ако няма състав на съда 
function delo4(){
global $rocase;
	$cogrou= $rocase["cogrou"];
	if (empty($cogrou)){
return "";
	}else{
//return toutf8("състав") .$cogrou;
# 11.11.2010 Дичев 
//return "състав " .$cogrou;
return $cogrou." състав";
	}
}

# 01.06.2010 - идващо дело вид 
function delo5(){
global $rocase, $listsort;
	$idtype= $rocase["idsort"];
# 11.11.2010 Дичев 
//return $listsort[$idtype];
//var_dump(toutf8($listsort[$idtype]));
//var_dump(toutf8(mb_strtolower($listsort[$idtype])));
	$liso= toutf8($listsort[$idtype]);
	$lisolo= mb_strtolower($liso,"UTF-8");
	$liso12= tran1251($lisolo);
//print "[$liso][$lisolo][$liso12]";
//return mb_strtolower($listsort[$idtype]);
//return mb_convert_case($listsort[$idtype],MB_CASE_LOWER);
return $liso12;
}
# 01.06.2010 - озбезп.заповед номер 
function delo6(){
global $rocase;
	$obezpe= $rocase["_obezpe_nakaza"];
	$obunse= unserialize($obezpe);
return $obunse["obezpe_nome"];
}
# 01.06.2010 - озбезп.заповед дата 
function delo7(){
global $rocase;
	$obezpe= $rocase["_obezpe_nakaza"];
	$obunse= unserialize($obezpe);
return $obunse["obezpe_date"];
}

# общо неолихвяеми суми 
function neolih_total(){
global $DB;
//global $edit, $listsubjtype_utf8, $listsubjtype2_utf8;
global $edit;
//	$where= "where idcase=$edit";
	//$where= "where idcase=$edit and idtype=2";
# 13.01.2011 месечна неолихв.сума =5 
	$where= "where idcase=$edit and idtype in(2,5)";
	$ardata= $DB->select("select * from subject $where");
//	$ardata= dbconv($ardata);
/*
						$arresu= array();
						$arresu[0]= "";
	foreach($ardata as $arelem){
		$cuid= $arelem["id"];
		$cutype= $arelem["idtype"];
			$txtype= $listsubjtype_utf8[$cutype];
		$cuamou= $arelem["amount"];
			$txamou= number_format($cuamou,2,".",",");
		$cufrom= $arelem["fromdate"];
			$txfrom= substr($cufrom,8,2).".".substr($cufrom,5,2).".".substr($cufrom,0,4);
		$txdesc= $arelem["text"];
//			$txdesc= to1251($txdesc);
		$txot= toutf8("от");
//						$arresu[$cuid]= "$txdesc $txtype $txamou $txot $txfrom";
						$arresu[$cuid]= "$txtype $txamou $txot $txfrom";
	}
//print_r($ardata);
return $arresu;
*/
						$resu= 0;
	foreach($ardata as $arelem){
		$cuamou= $arelem["amount"];
						$resu += $cuamou;
	}
	$txamou= number_format($resu,2,".",",");
return $txamou;
}


# трансформиращи функции 
function tranamou($p1){
return number_format($p1,2,".",",");
}

/*
function trandate($p1){
return substr($p1,8,2).".".substr($p1,5,2).".".substr($p1,0,4);
}
*/
# 01.06.2010 - 
# специална проверка за празна дата, иначе дава .. и не работи при {empty}{/empty} 
# и още стандартна трансформация с функцията 
function trandate($p1){
	if (empty($p1)){
return "";
	}else{
//return substr($p1,8,2).".".substr($p1,5,2).".".substr($p1,0,4);
return bgdatefrom($p1);
	}
}

/*
# псевдо трансформатор - връща текущата дата 
function getdat(){
return date("d.m.Y");
}
*/


# заместители на getselect 
//function subj_getsel(){
function subj_getsel($pain){
global $DB;
global $edit, $listsubjtype_utf8, $listsubjtype2_utf8;
//	$where= "where idcase=$edit";
	$where= "where idcase=$edit and $pain";
	$ardata= $DB->select("select * from subject $where order by id");
//	$ardata= dbconv($ardata);
						$arresu= array();
						$arresu[0]= "";
	foreach($ardata as $arelem){
		$cuid= $arelem["id"];
		$cutype= $arelem["idtype"];
			$txtype= $listsubjtype_utf8[$cutype];
		$cuamou= $arelem["amount"];
			$txamou= number_format($cuamou,2,".",",");
		$cufrom= $arelem["fromdate"];
			$txfrom= substr($cufrom,8,2).".".substr($cufrom,5,2).".".substr($cufrom,0,4);
		$txdesc= $arelem["text"];
//			$txdesc= to1251($txdesc);
		$txot= toutf8("от");
//						$arresu[$cuid]= "$txdesc $txtype $txamou $txot $txfrom";
						$arresu[$cuid]= "$txtype $txamou $txot $txfrom";
	}
//print_r($ardata);
return $arresu;
}

function smetka_getsel($pain){
	$rooffi= getofficerow(0);
	# МНОГО ВАЖНО. getrow вече е направила dbconv=to1251 
	$rooffi= toutf8($rooffi);
//var_dump($rooffi["accolist"]);
//print "<br><br>";
	$unse= unserialize($rooffi["accolist"]);
//print_r($unse);
	if (empty($unse)){
						$arresu[0]= "";
	}else{
						$arresu= array();
						$arresu[0]= "";
		foreach($unse as $arin=>$arelem){
						$arresu[$arin+1]= $arelem["desc"];
		}
# 17.01.2011 - автоматичен избор на сметка - от основ.данни 
if (count($unse)>1){
	$arresu["==sele=="]= $rooffi["accosele"];
}else{
}
	}
//print_r($arresu);
return $arresu;
}

function smetka_getdat($postin){
//var_dump($postin);
	$rooffi= getofficerow(0);
	# МНОГО ВАЖНО. getrow вече е направила dbconv=to1251 
	$rooffi= toutf8($rooffi);
	$unse= unserialize($rooffi["accolist"]);
//print "<br><br>UNSE=";
//var_dump($unse);
//print_r($unse);
	if (empty($unse)){
return array();
	}else{
//print_r($unse[$postin-1]);
return ($unse[$postin-1]);
	}
}

function adv_getsel($pain){
return getselect("regionadv","name");
}

function nap_getsel($pain){
return getselect("regionnap","name");
}

function cyrlat($p1){
	$strcyr= "А^Б^В^Г^Д^Е^Ж^З^И^Й^К^Л^М^Н^О^П^Р^С^Т^У^Ф^Х^Ц^Ч^Ш^Щ^Ъ^Ь^Ю^Я^ ^-^+^*^.^,";
		$arcyr= explode("^",$strcyr);
	$strlat= "A^B^V^G^D^E^J^Z^I^Y^K^L^M^N^O^P^R^S^T^U^F^H^C^DH^SH^SHT^AY^X^YU^YA^_^_^_^_^_^_";
		$arlat= explode("^",$strlat);
	$resu= strtoupper($p1);
	$resu= str_replace($arcyr,$arlat,$resu);
//var_dump($p1);
//var_dump($resu);
return $resu;
}


# 19.01.2011 - за чужденец 
function tranfore(&$rodata){
global $DB;
	$exdata= unserialize($rodata["exdata"]);
//print "<br>tranfore=".$rodata["name"]."<br>";
//var_dump($exdata);
//print_rr($exdata);
//	if ($exdata===false){
	if ($exdata===false or $exdata["t2fo"]==0){
$rodata["t2fo"]= false;
	}else{
$rodata["t2fo"]= ($exdata["t2fo"]==1);
//print "rodata-t2fo=";
//var_dump($rodata["t2fo"]);
$rodata["t2date"]= $exdata["t2date"];
		$coryname= $DB->selectCell("select name from country where code=?"  ,$exdata["t2cory"]);
$rodata["t2cory"]= $coryname;
				$t2date= $rodata["t2date"];
				$t2cory= $rodata["t2cory"];
				$t2egn= $rodata["egn"];
				$newegn= "";
				$newegn .= (empty($t2egn)) ? "" : " с ЛНЧ ".$t2egn;
				$newegn .= (empty($t2date)) ? "" : " дата на раждане ".$t2date;
				$newegn .= (empty($t2cory)) ? "" : " гражданство ".$t2cory;
$rodata["egn"]= $newegn;
//$rodata["egn"]= toutf8($newegn);
//print "<br>----FORE----<br>";
	}
}

# 19.01.2011 - за чужденец 
function egndele(&$p1,$rodata){
	if ($rodata["t2fo"]){
$p1= str_replace("ЕГН","",$p1);
	}else{
	}
}

# 19.01.2011 - за чужденец 
function egnrepl(&$p1,$rodata){
	if ($rodata["t2fo"]){
$p1= str_replace("ЕГН","ЛНЧ",$p1);
	}else{
	}
}


?>