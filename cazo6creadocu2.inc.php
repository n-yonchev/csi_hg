<?php

	# 11.11.2009 - 
	# специално за списък с дължимите суми за длъжник - маркер DLUJNIK_SUMI 
	# делото = $edit, длъжника = $postcont 
	# $listsubjtype = масива с текстовете за типовете суми, индекса= типа 
//+++print "roname=[$roname]";
//+++	if ($roname=="rodebt"){

//print "DEEEEEE";
//		$debtsumi["text"]= "Сумите на Длъжника";
# шаблони по типове 
//$artemp[1]= "олихвяема сума за [DESC] в размер на [SUMA] €, считано от [DATE], заедно с лихвата, която до момента е [INTE] €";
$artemp[1]= "олихвяема сума за [DESC] в размер на [SUMA] €, ведно със законовата лихва от [DATE], която до момента е [INTE] €";
$artemp[2]= "неолихвяема сума за [DESC] в размер на [SUMA] €";
# 31.01.2011 - мес.нолихвяема сума 
//$artemp[3]= "месечна сума за [DESC] в размер на [SUMA] € от [DATE], която до момента възлиза на [CAPI] €, ведно със законовата лихва, която до момента е [INTE] €";
$artemp[3]= "месечна олихвяема сума за [DESC] в размер на [SUMA] € от [DATE], която до момента възлиза на [CAPI] €, ведно със законовата лихва, която до момента е [INTE] €";
$artemp[5]= "месечна неолихвяема сума за [DESC] в размер на [SUMA] €";
$artemp[4]= "непарични вземания за [DESC]";
# за неолихвяема главница 
$artemp[99]= "неолихвяема главница за [DESC] в размер на [SUMA] €";
					
# списък на всички дългове за делото 
$sulist= $DB->select("select * from subject where idcase=$edit");
$sulist= dbconv($sulist);
//print "[$postcont]";
//print_r($sulist);
						#-------------------------------------------------------------------------------------------
						# подготовка за изчисляване лихвите и главниците 
						# източник : cazo2.php 
											# четем списъка с лихвените проценти по периоди 
											$arperc= getpercent();
											# функциите за изчисляване 
											include_once "subjpaymhist.inc.php";
											# днешната дата 
											$currdate= date("Y-m-d");
																# общо главница/лихва за всички предмети 
																$capireca= 0;
																$intereca= 0;
																		# 08.09.2009 общо сума за формиране на т.26 
																		$taxareca= 0;
									$arsu1[0]= "[DESC]";
									$arsu1[1]= "[SUMA]";
									$arsu1[2]= "[DATE]";
									$arsu1[3]= "[INTE]";
									$arsu1[4]= "[CAPI]";
						#-------------------------------------------------------------------------------------------
											
				$arsuresu= array();
													$sutotal= 0;
foreach($sulist as $suelem){
//print "<br>id=".$suelem["id"];
/*
#---- АКО Т.26 Е ВЪРХУ ТОТАЛНАТА СУМА ----
						#-------------------------------------------------------------------------------------------
						# изчисляваме лихвата и само за месечни - общата главница 
						# източник : cazo2.php 
							# подготовка за поредния елемент 
							$uscont= $suelem;
						# не е include_once - за да се изпълни многократно в цикъла 
						include "cazo2.inc.php";
						# получихме - $lastcapi = общата главница $lastinte = общата лихва 
//print "<br>[$lastinte][$lastcapi][$taxareca]";
						#--------------------------------------------------------------------------------------------------
*/
			# ако длъжника е в списъка с длъжници 
			$suarde= explode(",",$suelem["listdebtor"]);
			if (in_array($postcont,$suarde)){
#---- АКО Т.26 Е ВЪРХУ СУМАТА САМО НА ТЕКУЩИЯ ВЗИСКАТЕЛ ----
						#-------------------------------------------------------------------------------------------
						# изчисляваме лихвата и само за месечни - общата главница 
						# източник : cazo2.php 
							# подготовка за поредния елемент 
							$uscont= $suelem;
						# не е include_once - за да се изпълни многократно в цикъла 
						include "cazo2.inc.php";
						# получихме - $lastcapi = общата главница $lastinte = общата лихва 
//print "<br>[$lastinte][$lastcapi][$taxareca]";
						#--------------------------------------------------------------------------------------------------
							$arsu2= array();
							$arsu2[0]= $suelem["text"];
//var_dump($suelem["amount"]);
//							$arsu2[1]= number_format($suelem["amount"],2,".",",");
# 09.07.2010 - даваше грешка, ако е празно 
$arsu2[1]= number_format($suelem["amount"]+0,2,".",",");
							$arsu2[2]= bgdatefrom($suelem["fromdate"]);
				# присвояваме за заместване - независимо от типa 
				$arsu2[3]= number_format($lastinte,2,".",",");
				$arsu2[4]= number_format($lastcapi,2,".",",");
	# типа на дълга 
	$sutype= $suelem["idtype"];
	if ($sutype==1 and empty($suelem["fromdate"])){
		$sutype= 99;
	}else{
	}
				# сумираме според типа 
				if (0){
				}elseif ($sutype==1){
													$sutotal += $suelem["amount"]+$lastinte;
				}elseif ($sutype==99){
													$sutotal += $suelem["amount"];
				}elseif ($sutype==2){
													$sutotal += $suelem["amount"];
				}elseif ($sutype==3){
													$sutotal += $lastcapi+$lastinte;
# 31.01.2011 - мес.нолихвяема сума 
				}elseif ($sutype==5){
													$sutotal += $lastcapi;
				}elseif ($sutype==4){
				}else{
die("crdocu=1=$sutype");
				}
				
				# в масива с елементите на текста 
				$arsuresu[]= str_replace($arsu1,$arsu2,$artemp[$sutype]);
			}else{
			}
}
						#-------------------------------------------------------------------------------------------
						# накрая - т.26 и общата дължима сума 
						# източник : cazo2.php 
						# ВНИМАНИЕ. 
						#    т.26 се изчислява върху сумата от всички дългове, независимо от длъжника 
						#    обаче сумата за длъжника е само от неговите дългове + т.26 
											//# общо главници и лихви 
											//$recasum= $capireca + $intereca;
											# формираме т.26 
											//$calctax= calctax($taxareca);
															#----- дв-86/17----- 
															$calctax= calctax($taxareca,$edit);
//print "[$calctax][$taxareca][$edit]";
											# и общата дължима сума 
											//$recatot= $recasum + $calctax;
											$recatot= $sutotal + $calctax;
$tempto26= "както и дължима сума по т.26 в размер на [SUMA26] €";
$temptota= "или общо дължима сума в размер на [SUMATO] €";
						$sutax2= number_format($calctax,2,".",",");
						$sutot2= number_format($recatot,2,".",",");
				$arsuresu[]= str_replace("[SUMA26]",$sutax2,$tempto26);
				$arsuresu[]= str_replace("[SUMATO]",$sutot2,$temptota);
						#-------------------------------------------------------------------------------------------

# резултата 
$debtsumi["text"]= implode(", ",$arsuresu);

//+++	}else{
//+++	}

?>
