<?php

											# 10.02.2009 
											# временно решение - лихви и такса за ЧСИ - без плащанията 
											# лихвата за типове олихвяема/месечна сума 
											# източник : cazopaymdist.php 
//print_rr($uscont);
											$idtype= $uscont["idtype"];
//											if (in_array($idtype,array(1,3))){
# 22.10.2009 - ако началната дата е празна - 
# това е неолихв.главница = неолихвяема сума 
$emptyfromdate= empty($uscont["fromdate"]);
$type1_olih= ($idtype==1 and !$emptyfromdate);
$type1_neolih= ($idtype==1 and $emptyfromdate);
//											if ($idtype==1 or $idtype==3){
//											if ($idtype==1 and !$emptyfromdate or $idtype==3){
											if ($type1_olih or $idtype==3){
				#------------------------------------------------------------------------------------------
						# ВНИМАНИЕ. 
						#     Имената са част от интерфейса, тези имена са задължителни. 
							# $arperc - двумерен масив с лихвените проценти по периоди 
							# $subj   - subj.id - текущия предмет на изп. 
							# $mylist - двумерен масив с плащанията по този предмет - от dbsimple 
							# $ismonthly - флаг - дали дълга е с месечна периодичност - мес.вноски 
							#      приемаме, че вноската се прави на 1во число всеки месец 
							# $rosubj - записа с предмета на изпълнение 
				# съхраняваме интерфейсните променливи 
				$xxsubj= $subj;
				$xxmylist= $mylist;
				$xxismonthly= $ismonthly;
				$xxrosubj= $rosubj;
				# присвояваме интерфейсните променливи 
							$subj= $idcurr;
											# ВНИМАНИЕ. ВРЕМЕННО РЕШЕНИЕ. 
											# НЯМА ПЛАЩАНИЯ. 
											$mylist= array();
//							$ismonthly= ($idtype==3);
# 13.01.2011 - месечна неолихвяема сума =5 
$ismonthly= ($idtype==3 or $idtype==5);
							$rosubj= $uscont;
											# не е include_once - за да се изпълни многократно в цикъла 
											include "subjpaymhist.php";
//print "<br>cazo2.inc=[$lastinte][$lastcapi]";
											# получихме : 
											#    $lastcapi= дължима главница общо към момента 
											#    $lastinte= дължима лихва общо към момента 
				# възстановяваме интерфейсните променливи 
				$subj= $xxsubj;
				$mylist= $xxmylist;
				$ismonthly= $xxismonthly;
				$rosubj= $xxrosubj;
																# сумираме общо главница/лихва за всички предмети 
																$capireca += $lastcapi;
																$intereca += $lastinte;
																		# 08.09.2009 сумираме за формиране на т.26 
																		if ($uscont["isintax"]==1){
																			$taxareca += ($lastcapi + $lastinte);
																		}else{
																		}
				#------------------------------------------------------------------------------------------
	$mylist[$uskey]["capital"]= $lastcapi;
	$mylist[$uskey]["interest"]= $lastinte;
# 22.10.2009 - ако началната дата е празна - 
# това е неолихв.главница = неолихвяема сума 
//											}elseif ($idtype==2){
//											}elseif ($idtype==2 or $idtype==1 and $emptyfromdate){
											//}elseif ($idtype==2 or $type1_neolih){
									# 13.01.2011 - месечна неолихвяема сума =5 
											}elseif ($idtype==2 or $idtype==5 or $type1_neolih){
												# допълнение за неолихвяема сума 
												# само представяме сумата като главница 
												$lastcapi= $uscont["amount"];
	$mylist[$uskey]["capital"]= $lastcapi;
																# и сумираме като главница 
																$capireca += $lastcapi;
																		# 08.09.2009 сумираме за формиране на т.26 
																		if ($uscont["isintax"]==1){
																			$taxareca += $lastcapi;
																		}else{
																		}
											}else{
											}


?>
