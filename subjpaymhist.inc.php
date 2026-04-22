<?php

#-----------------------------------------------------------------------------------------------------
# изчисляване на лихва за период 
# параметри - нач.дата, край.дата, сума 
# връща масив, вътре е лихвата 
									# 19.03.2009 
									# специално за лихвения калкулатор - calc.php 
									# - крайната дата не се трансформира с 1 ден назад 
									# допълнителен параметър - флаг дали да се трансформира 
//function calcinte($d1,$d2,$capi){
function calcinte($d1,$d2,$capi     ,$fltran=true){
//+++print "<br>------------calcinte=[$d1][$d2][$capi]------------";
# двумерния масив с периодите и съотв.лихви 
global $arperc;
				# 15.09.2010 
				if (count($arperc)==0){
					$arperc= getpercent();
				}else{
				}
							# ВНИМАНИЕ. 17.12.2009 
							# $arperc[0] - нулевия елемент от лихв.проценти е за периода 01.01.1989-30.06.1992 с лихва=0% 
							# алгоритъма за търсене на начало и край ЦИКЛИ за дати ПРЕДИ и ВЪТРЕ в този период 
							# затова изкуствено настройваме нач.дата към началото на следв.период [1] = 01.07.1992-05.07.1992 = 54% 
							# резултата не се променя, понеже прескачаме периоди с лихва=0% 
//print "<br>d1=[$d1]";
							$begsta= $arperc[1]["begstamp"];
											# 30.09.2010 КРЪПКА - ако няма дата за погасяване 
											if (empty($d1)){
					$d1= date("Y-m-d",$begsta);
											}else{
					list($ye,$mo,$da)= explode("-",$d1);
					$d1sta= mktime(0,0,1,  $mo,$da,$ye);
							if ($d1sta<$begsta){
					$d1= date("Y-m-d",$begsta);
							}else{
							}
											}
//print "[$begsta][$d1]";
	# константа - броя на секундите в денонощие 
	$secday= 86400;
	# броя елементи в масива с лихвите 
	$counperc= count($arperc);
									# 19.03.2009 
									# специално за лихвения калкулатор - calc.php 
									# - крайната дата не се трансформира с 1 ден назад 
									if ($fltran){
# ВНИМАНИЕ. 
# крайната дата участва 2 пъти - като крайна и като начална на следв.период 
# за да избегнем това, трансформираме крайната дата с 1 ден назад 
list($ye,$mo,$da)= explode("-",$d2);
$d2stamp= mktime(0,0,0,  $mo,$da-1,$ye);
$d2= date("Y-m-d",$d2stamp);
									# - крайната дата не се трансформира с 1 ден назад 
									}else{
									}
	
							$arresu= array();
	# общо описание 
	$arresu["descrip"]= array($d1,$d2,$capi);

					# за текущия период на олихвяване 
					$cuperiod= array();
	
	# 1. 
	# търсим първия период, в който попада нач.дата 
	# предишните периоди остават пропуснати 

	#--------------------- 06.10.2009 - ново решение 
	# не използваме крайната щампа на периода - $endstamp 
	list($ye,$mo,$da)= explode("-",$d1);
	$d1stamp= mktime(0,0,0,  $mo,$da,$ye);
	$peindx= getperiindx($d1);
	# нормираме началния щамп 
	$stamp1= max($d1stamp,$arperc[$peindx]["begstamp"]);
	#--------------------- край на новото решение 
	
															# сумираме лихвата от всички подпериоди 
															$totalinte= 0;

	# 2. 
	# търсим периода, в който попада крайната дата 
	# използваме друг индекс - $indx2 
	# започваме от текущия индекс, в който е нач.дата - $peindx 
	# крайната дата може да попада в същия период 
	list($ye,$mo,$da)= explode("-",$d2);
	$d2stamp= mktime(0,0,0,  $mo,$da,$ye);
					$found= false;
					$indx2= $peindx;
										$mycoun= 0;
	while (true){
										$mycoun++;
//										if ($mycoun>400){
										if ($mycoun>4000){
die("stage=2=[$indx2]");
//											break;
										}else{
										}
//print "<br><br>indx2=[$indx2][$peindx][$counperc][$stamp1]";
		$peelem= $arperc[$indx2];
			# уточняваме началото на подпериода 
			if ($indx2==$peindx){
				# още сме в 1-вия период 
				# - вземаме готовия нач.щамп 
			}else{
				# в следващ период 
				# - вземаме текущия нач.щамп 
				$stamp1= $peelem["begstamp"];
			}
//print "<br>s1=[$stamp1]";

	#--------------------- 06.10.2009 - ново решение 
	# не използваме крайната щампа на периода - $endstamp 
//# ВНИМАНИЕ. ЛЕПЕНКА 
//# - заради крайната дата на последния срок, която може да е по-малка от крайната дата на периода 
//if ($indx2 == $counperc-1){
//	$peelem["endstamp"]= $d2stamp;
//}else{
//}
								$lastperi= false;
								if ($indx2 == $counperc-1){
									$lastperi= true;
								}else{
									$indx2next= $indx2 +1;
									$d2next= $arperc[$indx2next]["begstamp"];
									$d2endstamp= $d2next - $secday;
//print "lastperi=[$indx2][$indx2next][$d2next][$d2endstamp]";
									if ($d2stamp >= $d2next){
									}else{
										$lastperi= true;
									}
								}
//		if ($d2stamp >= $peelem["begstamp"] and $d2stamp <= $peelem["endstamp"]){
		if ($lastperi){
			#------ намерихме крайния период ------ 
			# нормираме крайния щамп 
								#--------------------- 06.10.2009 - ново решение 
//			$stamp2= min($d2stamp,$peelem["endstamp"]);
								$stamp2= $d2stamp;
			# формираме данните за текущия период на олихвяване 
//print "<br>BEFORE1=[$stamp1][$stamp2][$secday]";
//print "more=".$peelem["id"]."/".$peelem["begin"].'/'.$peelem["end"];
			$cuperiod= formdata($stamp1, $stamp2, $secday, $indx2, $capi);
//print "<br>CUPERIOD-1<br>";
//var_dump($cuperiod);
# шунт заради началната дата 
if (is_string($cuperiod)){
return $cuperiod;
}else{
}
															# сумираме лихвата от всички подпериоди 
															//+++print "<br>[$totalinte][".$cuperiod["result"]."]";
															//+++print_rr($cuperiod);
															$totalinte += $cuperiod["result"];
															//print "[$totalinte]";
			# добавяме текущия период на олихвяване 
			$arresu["list"][]= $cuperiod;
					$found= true;
//print "<br>break=".$cuperiod["result"]."/".$totalinte;
					break;
		}else{
			#------ текущия период още не е краен ------ 
			# формираме данните за текущия период на олихвяване 
								#--------------------- 06.10.2009 - ново решение 
//			$stamp2= $peelem["endstamp"];
								$stamp2= $d2endstamp;
//print "<br>before2=[$stamp1][$stamp2][$secday]";
//print "more=".$peelem["id"]."/".$peelem["begin"].'/'.$peelem["end"];
			$cuperiod= formdata($stamp1, $stamp2, $secday, $indx2, $capi);
//print "<br>CUPERIOD-2<br>";
//var_dump($cuperiod);
# шунт заради началната дата 
if (is_string($cuperiod)){
return $cuperiod;
}else{
}
															# сумираме лихвата от всички подпериоди 
															//+++print "<br>[$totalinte][".$cuperiod["result"]."]";
															//+++print_rr($cuperiod);
															$totalinte += $cuperiod["result"];
															//print "[$totalinte]";
			# добавяме текущия период на олихвяване 
			$arresu["list"][]= $cuperiod;
					# следващ подпериод 
					$indx2 ++;
					if ($indx2 <= $counperc-1){
					}else{
//print "<br>break=".$cuperiod["result"]."/".$totalinte;
						break;
					}
		}
//print "<br>".$cuperiod["result"]."/".$totalinte;
	}
	#--------------------- край на новото решение 

					if ($found){
					}else{
die("calcinte=3=[$d2]");
					}

	# край - връщаме сумираната лихва за всички подпериоди 
//	$arresu["newinte"]= 0.1 * $capi;
	$arresu["newinte"]= $totalinte;
return $arresu;
}


#-----------------------------------------------------------------------------------------------------
# формираме данните за текущия период на олихвяване 
function formdata ($stamp1, $stamp2, $secday, $indx2, $capi){
//print "<br>formdata=stamp=[$stamp1][$stamp2]";
global $arperc;
				# 15.09.2010 
				if (count($arperc)==0){
					$arperc= getpercent();
				}else{
				}
# полето с лихв.процент вече е определено според валутата $type 
global $percname;
if (empty($percname)){
	$percname= "bnb";
}else{
}
//print_rr($arperc);
//print "<br>formdata=[$stamp1][$stamp2][$secday]";
//print "<br>formdata=[".date("Y-m-d",$stamp1)."][".date("Y-m-d",$stamp2)."]";
				$difstamp= $stamp2 - $stamp1 + $secday;
//				if ($difstamp<=0){
# 18.08.2009 - открита грешка - Бъзински 
# датата за олихвяема сума е днешната - има 0 дни разлика 
				if ($difstamp<0){
//die("calcinte=2=[$difstamp]");
$myda1= date("Y-m-d",$stamp1);
$myda2= date("Y-m-d",$stamp2);
//die("formdata=2=[$difstamp]");
die("formdata=2=[$myda1][$myda2][$difstamp]");
				}else{
				}
//				$daycou= (int) ($difstamp / $secday);
//				$daycou= ($difstamp / $secday);
$daycou= round( ($difstamp / $secday) ,0);
			$cuperiod["stamp1"]= $stamp1;
			$cuperiod["stamp2"]= $stamp2;
						$cuperiod["d1"]= date("d.m.Y",$stamp1);
						$cuperiod["d2"]= date("d.m.Y",$stamp2);
			$cuperiod["days"]  = $daycou;
# 08.06.2009 - добавяме още 3 валути и съответни лихвени нива 
# полето с лихв.процент вече е определено според валутата $type 
# индекса "bnb" за масива - остава 
//			$cuperiod["bnb"]   = $arperc[$indx2]["bnb"];
$percvalu= $arperc[$indx2][$percname];
$percvalu= $percvalu +0;
//$cuperiod["bnb"]   = $arperc[$indx2][$percname];
# има пропуски в периодите за конкретната валута 
# вместо нула, вземаме ненулевата лихва за най-близкия предишен период 
//if ($percvalu==0){
# 07.10.2010 - Дичев дата=14.06.1991 
if ($percvalu==0 and $indx2<>0){
			$workindx= $indx2;
					$datevalu= $arperc[$workindx]["begin"];
										$mycoun= 0;
	while (true){
										$mycoun++;
//										if ($mycoun>400){
										if ($mycoun>4000){
die("formdata=percvalu=[$workindx][$indx2]");
//											break;
										}else{
										}
			$workindx --;
		$percvalu= $arperc[$workindx][$percname];
		$percvalu= $percvalu +0;
					if ($workindx==0){
# шунт заради началната дата 
return "няма лихви преди ".$datevalu;
					}else{
					}
		if ($percvalu==0){
		}else{
			break;
		}
	}
}else{
}
# готово, присвояваме 
$cuperiod["bnb"]= $percvalu;
						# изчисления 
//						$zakono= $cuperiod["bnb"] + 10;
													# 13.01.2011 - надбавката ОЛП 
													$extraint= $_SESSION["extraint"] +0;
													if((strtotime("2026-01-01") <= $stamp1) && $extraint == 10) {
														$extraint = 8;
													}
													if ($extraint==0){
die("extra=int=perc");
													}else{
													}
//var_dump($_SESSION["extraint"]);
													$zakono= $cuperiod["bnb"] + $extraint;
						$dnevna= $zakono / 360;
							$dnevna= round($dnevna,6);
						$result= $capi * $dnevna * 0.01 * $daycou;
							$result= round($result,2);
			$cuperiod["zakono"] = $zakono;
			$cuperiod["dnevna"] = $dnevna;
			$cuperiod["result"] = $result;
return $cuperiod;
}


# добавяне елемент [ред] към историята 
# $type 
#       = 0 - начало 
#       = 1 - олихвяване 
//#       = 2 - погасяване 
//#       = 3 - месечна вноска 
#       = 2 - месечна вноска 
#       = 3 - погасяване 
function addhistelem ($date, $type, $tocapi, $tointe){
global $arhist;
global $lastdate, $lastcapi, $lastinte;
//print "<br>addhistelem=[$date][$type][$tocapi][$tointe]";
	if (0){
	
	#-------------------- начало ----------------------- 
	}elseif ($type==0){
			$arelem= array();
					$arelem["date"]= $date;
					$arelem["text"]= "начало";
					$arelem["capi"]= $tocapi;
					$arelem["inte"]= $tointe;
//			# резултата 
//			$arelem["resucapi"]= $lastcapi + $arelem["capi"];
//			$arelem["resuinte"]= $lastinte + $arelem["inte"];
	
	#-------------------- олихвяване ----------------------- 
	}elseif ($type==1){
			$arelem= array();
					$arelem["date"]= $date;
					$arelem["text"]= "олихвяване";
						$arelem["flag"]= "a";
						$arelem["open"]= "yes";
										# изчисляваме лихвата за периода 
										$arinte= calcinte($lastdate, $arelem["date"], $lastcapi);
										$newinte= $arinte["newinte"];
										$arelem["listperi"]= $arinte;
					$arelem["capi"]= 0;
					$arelem["inte"]= $newinte;
//			# резултата 
//			$arelem["resucapi"]= $lastcapi + $arelem["capi"];
//			$arelem["resuinte"]= $lastinte + $arelem["inte"];
	
	#-------------------- мес.вноска ----------------------- 
	}elseif ($type==2){
			$arelem= array();
					$arelem["date"]= $date;
					$arelem["text"]= "мес.вноска";
					$arelem["capi"]= $tocapi;
					$arelem["inte"]= $tointe;
						$arelem["flag"]= "c";
//			# резултата 
//			$arelem["resucapi"]= $lastcapi + $arelem["capi"];
//			$arelem["resuinte"]= $lastinte + $arelem["inte"];;
	
	#-------------------- погасяване ----------------------- 
	}elseif ($type==3){
			$arelem= array();
					$arelem["date"]= $date;
					$arelem["text"]= "погасяване";
					$arelem["capi"]= $tocapi;
					$arelem["inte"]= $tointe;
						$arelem["flag"]= "b";
//			# резултата 
//			$arelem["resucapi"]= $lastcapi + $arelem["capi"];
//			$arelem["resuinte"]= $lastinte + $arelem["inte"];;

	}else{
die("addhist=type=$type");
	}

#------ за всички типове ------
			# резултата 
			$arelem["resucapi"]= $lastcapi + $arelem["capi"];
			$arelem["resuinte"]= $lastinte + $arelem["inte"];
			# добавяме елемента към историята 
			$arhist[]= $arelem;
										# датата, главницата и лихвата за следв.пас 
										$lastdate= $arelem["date"];
										$lastcapi= $arelem["resucapi"];
										$lastinte= $arelem["resuinte"];
return $arelem;
}


# 06.10.2009 - ново решение 
# не използваме крайната щампа на периода - $endstamp 
# връща индекса на периода, в който попада зададена дата 
function getperiindx($date){
global $arperc;
				# 15.09.2010 
				if (count($arperc)==0){
					$arperc= getpercent();
				}else{
				}
//print "<br>-----------ARPERC----------------<br>=".count($arperc);
//print_r($arperc);
//print "<br>------date=[$date]";
	list($ye,$mo,$da)= explode("-",$date);
	$stamp= mktime(0,0,0,  $mo,$da,$ye);
					$peindx= 0;
					$pelast= count($arperc) -1;
										$mycoun= 0;
	while (true){
										$mycoun++;
//										if ($mycoun>400){
										if ($mycoun>4000){
die("getperi=3=[$date]");
//											break;
										}else{
										}
//var_dump($peindx);
		$peelem= $arperc[$peindx];
//$pe= $peelem["begstamp"];
//print "<br>[$peindx][$stamp][$pe]";
		if ($stamp >= $peelem["begstamp"]){
					if (0){
					}elseif ($peindx < $pelast){
						$peindx ++;
					}elseif ($peindx == $pelast){
						break;
					}else{
die("getperi=1=[$date]");
					}
		}else{
					if (0){
					}elseif ($peindx <= 0){
die("getperi=2=[$date]");
					}else{
						$peindx --;
						break;
					}
		}
	}
/*
$xid= $arperc[$peindx]["id"];
$xbe= $arperc[$peindx]["begin"];
$xen= $arperc[$peindx]["end"];
$xbn= $arperc[$peindx]["bnb"];
print "<br>[$xid][$xbe][$xen][$xbn]";
*/
return $peindx;
}


?>