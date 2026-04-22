<?php
# зона-7 : погасяване на дълга по време 
# източници : 
#    cazo2.php - [дългове] списък предмет на делото
#    cazofina.php - [постъпления] списък постъпления по делото 
# отгоре : 
#    $edit= case.id 
#    $zone= 7 
#    $func= view 
//# елемент за настройка 
//#    $idel - subject.id  
//print_r($GETPARAM);
//print session_name()."=".session_id();
							$arperc= getpercent();
									include_once "subjpaymhist.inc.php";
							print_rr($arperc);
							
# ВНИМАНИЕ. 
# ДЕкоментирай следващия ред за да се изведе подробната таблица в случай на АКТУАЛЕН ДЪЛГ 
//if (1){
# ВНИМАНИЕ. 
# КОМЕНТИРАЙ следващия ред за да се изведе подробната таблица в случай на АКТУАЛЕН ДЪЛГ 
				if (isset($tpnameactu)){
					#----------------------------- яну-фев-2010 - за актуалния дълг -------------------------------
					# шаблона 
					$tpname= $tpnameactu;
# ВНИМАНИЕ. 
# ДЕкоментирай следващия ред за да се изведе подробната таблица в случай на АКТУАЛЕН ДЪЛГ 
//$tpname= "cazobala.tpl";
					# филтър за табл.финанси - участват избраните с чекбокс 
									$acpref= "cb_4_";
														$aclist= array();
//									foreach($_SESSION["actucalc"] as $acname=>$accont){
									# ВАЖНО. директно от стойността на чекбокса 
									foreach($_POST as $acname=>$accont){
										if (substr($acname,0,strlen($acpref))==$acpref){
											if ($accont==1){
														$aclist[]= substr($acname,strlen($acpref));
											}else{
											}
										}else{
										}
									}
									if (count($aclist)==0){
					$filterfinance= "0";
									}else{
					$codelist= implode(",",$aclist);
					$filterfinance= "id in($codelist)";
									}
					# елемента за дълг към момента - въведената крайна дата 
					$cudate= $_SESSION["actucalc"]["enddate"];
							list($cuye,$cumo,$cuda)= explode("-",$cudate);
					$cudatestam= mktime(0,0,1  ,$cumo,$cuda,$cuye);
				}else{
# шаблона 
$tpname= "cazobala.tpl";
# филтър за табл.финанси - участват само приключените постъпления 
$filterfinance= "isclosed=1";
# елемента за дълг към момента - днешната дата 
$cudate= date("Y-m-d");
$cudatestam= time();
				}
//var_dump($filterfinance);
//var_dump($cudate);

# филтъра
$filter= "where idcase=$edit";

# схемата на погасяване 
$rocase= getrow("suit",$edit);
$idpayoff= $rocase["idpayoff"];
$smarty->assign("TEXTPAYOFF", $listpayoff[$idpayoff]);
				# датата на образуване на делото 
				$datecr= $rocase["created"];
				list($date4,$hour4)= explode(" ",$datecr);
				$datecreated= $date4;
				
# за взискател - масив от индекси според схемата 
if (0){
}elseif ($idpayoff==0){
	$arpayoffclai= array("tax","perc","capi");
}elseif ($idpayoff==1){
	$arpayoffclai= array("capi","perc","tax");
}else{
die("cazobala=payoff=$idpayoff");
}
# за ЧСИ - масив от индекси 
$arpayoffexof= array("tax","fee");


# четем водещия списък - дълг и постъпления смесени, подредени по дата 
#     subject - дължимите суми - без тип=4 непарични вземания 
#     finance - постъпленията - само приключените 
/*
$mylist= $DB->select("
	(select id, '3' as oper, fromdate as date from subject $filter and idtype in (1,2,3)) 
	union all
	(select id, '4' as oper, datebala as date from finance $filter and isclosed=1) 
	");
*/
			# 19.07.2010 - участват и вноските по аванс.такси от взискателите 
/*
$mylist= $DB->select("
	(select id, '3' as oper, fromdate as date from subject $filter and idtype in (1,2,3)) 
	union all
	(select id, '4' as oper, datebala as date from finance $filter and $filterfinance) 
	");
*/
# 21.09.2010 - ограничаваме с въведената крайна дата от актуалния дълг 
/****
			$mylist= $DB->select("
				(select id, '3' as oper, fromdate as date from subject $filter and idtype in (1,2,3)) 
				union all
				(select id, '4' as oper, datebala as date from finance $filter and $filterfinance) 
				union all
				(select claimadva.id as id, 'ap' as oper, claimadva.date as date
		from claimadva 
		left join claimer on claimadva.idclaimer=claimer.id
		where claimer.idcase=$edit
				) 
				");
****/
# 13.01.2011 - месечна неолихвяема сума =5 
//				(select id, '3' as oper, fromdate as date from subject $filter and idtype in (1,2,3)
			$mylist= $DB->select("
				(select id, '3' as oper, fromdate as date from subject $filter and idtype in (1,2,3  ,5)
and fromdate<='$cudate') 
				union all
				(select id, '4' as oper, datebala as date from finance $filter and $filterfinance 
and datebala<='$cudate') 
				union all
				(select claimadva.id as id, 'ap' as oper, claimadva.date as date
		from claimadva 
		left join claimer on claimadva.idclaimer=claimer.id
		where claimer.idcase=$edit
and claimadva.date<='$cudate') 
				");

//print_rr($mylist);
# четем пълните данни в отделни масиви 
$lis1= $DB->select("select *, id as ARRAY_KEY from subject $filter");
//print_rr($lis1);
$lis2= $DB->select("select *, id as ARRAY_KEY from finance $filter");
//print_rr($lis2);
			# 19.07.2010 - участват и вноските по аванс.такси от взискателите 
$lis3= $DB->select("select *, claimadva.id as ARRAY_KEY 
	from claimadva 
	left join claimer on claimadva.idclaimer=claimer.id
	where claimer.idcase=$edit
	");
$lis3= dbconv($lis3);
//print_rr($lis2);
# четем имената на взискателите 
$clailist= $DB->selectCol("select id as ARRAY_KEY, name from claimer where idcase=?d"  ,$edit);
$clailist= dbconv($clailist);
	# добавяме и самия ЧСИ 
	$clailist[0]= "ЧСИ";
$smarty->assign("CLAILIST", $clailist);

# има ли поне една олихвяема сума - дълг от тип 1=олихвяема или 3=месечна 
# служи за флаг - дали да се вмъкват редове за олихвяване 
												# ВНИМАНИЕ 12.10.2009 
												# формираме и допълнителни глобални флагове - 
												#    $flagtoclaimer - да се превежда ли на взискателя 
												#    $flagintax - да участва ли в сумата за т.26 
												# особености :
												#    - стойността се определя от последния запис за олихвяема/месечна сума 
												#    - важи за всички олихвяеми суми 
												# Това е коректно, ако има само една олихвяема/месечна сума 
												//$flagtoclaimer= 0;
												//$flagintax= 0;
				$isperc= false;
foreach($lis1 as $ele1){
	$idty= $ele1["idtype"];
//print "<br>IDTY=";
//var_dump($idty);
# 22.10.2009 - ако началната дата е празна - 
# това е неолихв.главница = неолихвяема сума 
$emptyfromdate= empty($ele1["fromdate"]);
$type1_olih= ($idty==1 and !$emptyfromdate);
$type1_neolih= ($idty==1 and $emptyfromdate);
//	if ($idty==1 or $idty==3){
//	if ($idty==1 and !$emptyfromdate or $idty==3){
	if ($type1_olih or $idty==3){
				$isperc= true;
												$flagtoclaimer= $ele1["istoclaimer"];
												$flagintax= $ele1["isintax"];
		break;
	}else{
	}
}
//var_dump($flagtoclaimer);
//var_dump($flagintax);

# формираме нов трансформиран списък 
							$balist= array();
# датата : $elem["date"] : формат MySQL yyyy-mm-dd 
# операцията : $elem["oper"] : 2=мес.вноска 3=дълг 4=постъпление 5=олихвяване 6=към.момента 
# операциите 3 и 4 да съвпадат с полето oper от заявката 
						# движение и резултата - индекси на колоните 
//						# capi=главница perc=лихва pay=неолихвяема tax=такса/разноска fee=хонорар ЧСИ т.26 
						# capi=главница perc=лихва tax=неолихвяема fee=хонорар ЧСИ т.26 
$balaoper[1]= "към.момента";
$balaoper[2]= "мес.вноска";
$balaoper[3]= "дълг";
$balaoper[4]= "погасяване";
$balaoper[5]= "олихвяване";
//$balaoper[4]= "към.момента";
			# 19.07.2010 - участват и вноските по аванс.такси от взискателите 
			# поредност : 1, 2, 3, ap, 4, 5 
$balaoper["ap"]= "аванс.вноска";
$smarty->assign("ARBALAOPER", $balaoper);

							# добавяме елемента за дълг към момента - днешната дата 
//$cudate= date("Y-m-d");
# крайната дата се определя в началото - 
# според дали изчисляваме актуален дълг 
//$cudatestam= time();
/**/
				# подготвяме съдържанието - към момента 
				$elem= array();
				$elem["date"]= $cudate;
				$elem["oper"]= 1;
				$elem["desc"]= "";
							addelem($elem);
/**/
# цикъл по наличните елементи дълг и погасяване 
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
//print "<br>USCONT===";
//print_rr($uscont);
	$oper= $uscont["oper"];

	if ($oper==3){
#---- дължима сума ---------------------------------
/***
						#--------------------------------------------------
						# 11.02.2011 КРЪПКА. 
						$uscodate= $uscont["date"];
						if (empty($uscodate)){
							if (0){
							}elseif ($type=="toend"){
global $rocase;
								if (isset($rocase)){
print "<br>rocase=toend=OK=";
//print_rr($rocase);
									$uscodate= substr( $rocase["created"] ,0,10);
print "$uscodate";
								}else{
print "<br>rocase=toend=notset";
								}
							}elseif ($type=="frombegin"){
									$uscodate= date("Y-m-d");
print "<br>rocase=frombegin=$uscodate";
							}else{
die("sumreduce=type=$type");
							}
						}else{
						# if (empty($uscodate)){
						}
						$uscont["date"]= $uscodate;
						#--------------------------------------------------
***/
				# подготвяме съдържанието 
				$elem= array();
													$elem["id"]= $idcurr;
				$elem["date"]= $uscont["date"];
				$elem["oper"]= $oper;
//print_rr($lis1[$idcurr]);
					$ind1= $lis1[$idcurr]["idtype"];
					$ind2= $lis1[$idcurr]["idsubtype"];
//print "[$ind1][$ind2]";
					if (empty($ind2)){
						$desc= $listsubjtype2[$ind1];
					}else{
						$desc= $listsubjtype2[$ind1] ."/" .$listsubjst2[$ind2];
					}
				$elem["desc"]= $desc;
/*
# 22.10.2009 - ако началната дата е празна - 
# това е неолихв.главница = неолихвяема сума 
# за трансформиране на текста 
if (empty($elem["date"])){
				$elem["desctran"]= true;
}else{
}
*/
					$amou= $lis1[$idcurr]["amount"];
		$elem["amou"]= $amou;
									# 16.12.2009 
									# ако дължимата сума е месечна, редуцираме я само за 1-вия месец - според броя на дните 
//									if ($oper=="3" and $lis1[$idcurr]["idtype"]==3){
									# 13.01.2011 - месечна неолихвяема сума =5 
									if ($oper=="3" and ($lis1[$idcurr]["idtype"]==3 or $lis1[$idcurr]["idtype"]==5)){
/*
		list($frye,$frmo,$frda)= explode("-",$lis1[$idcurr]["fromdate"]);
		$daycount= cal_days_in_month(CAL_GREGORIAN, $frmo, $frye);
		$dayrest= $daycount - $frda;
		$sumrest= $amou/$daycount * $dayrest;
		$elem["amou"]= round($sumrest,2);
*/
//++++++++print "<br>balamain=1";
//		$elem["amou"]= sumreduce($amou,$lis1[$idcurr]["fromdate"],"toend");
		$trandate= gettrandate($lis1[$idcurr]["fromdate"],"toend");
					$uscont["date"]= $trandate;
		$elem["amou"]= sumreduce($amou,$trandate,"toend");
//++++++++print "<br>begin-reduce=".$elem["amou"];
									}else{
									}
//						# взискателя 
//						$idclai= $lis1[$idcurr]["idclaimer"];
						# към взискателя или към ЧСИ - според флага 
						//$idclai= ($lis1[$idcurr]["istoclaimer"]==0) ? 0 : $lis1[$idcurr]["idclaimer"];
												# ВНИМАНИЕ 12.10.2009 
												# ако е неолихв.сума - според флага от записа 
												# ако е олихвяема сума - според допълнителния глобален флаг 
												#    $flagtoclaimer - да се превежда ли на взискателя 
# 22.10.2009 - ако началната дата е празна - 
# това е неолихв.главница = неолихвяема сума 
//$emptyfromdate= empty($lis1[$idcurr]["fromdate"]);
$emptyfromdate= empty($elem["date"]);
$type1_olih= ($ind1==1 and !$emptyfromdate);
$type1_neolih= ($ind1==1 and $emptyfromdate);
//print "<br>fromdate=".$lis1[$idcurr]["fromdate"]."|amou=".$amou;
//var_dump($type1_neolih);
//print "<br>";
//												if ($ind1==2){
# за трансформиране на текста 
//if ($type1_olih){
if ($type1_neolih){
				$elem["desctran"]= true;
}else{
}
												//if ($ind1==2 or $type1_neolih){
									# 13.01.2011 месечна неолихв.сума =5 
												if ($ind1==2 or $ind1==5 or $type1_neolih){
						$myflag= $lis1[$idcurr]["istoclaimer"];
						$nameto= "tax";
												}else{
						$myflag= $flagtoclaimer;
						$nameto= "capi";
												}
						$idclai= ($myflag==0) ? 0 : $lis1[$idcurr]["idclaimer"];
//						# олихвяема или неолихвяема 
//						$nameto= ($ind1==2) ? "tax" : "capi";
# 19.07.2010 - участват и вноските по аванс.такси от взискателите 
# вече няма флаг "да се превежда ли на взискателя" 
# 29.07.2010 - директен шунт 
# САМО ако сумата е неолихвяема и аванс.такса - НЕ се превежда на взискателя 
# всички останали случаи - се превежда на взискателя 
//$idclai= $lis1[$idcurr]["idclaimer"];
if ($ind1==2 and $ind2==8){
	$idclai= 0;
}else{
	$idclai= $lis1[$idcurr]["idclaimer"];
}
//print "<br>[$amou][$ind1][$ind2][$idclai][$myflag][$type1_neolih]][$flagtoclaimer]";
						# движението 
//						$elem["move"][$idclai]["capi"]= $amou;
# 13.01.2011 - месечна неолихвяема сума =5 
//						$elem["move"][$idclai][$nameto]= $amou;
$elem["move"][$idclai][$nameto]= $elem["amou"];
						# сумата за формиране на т.26 - според флага 
						//$taxamount= ($lis1[$idcurr]["isintax"]==0) ? 0 : $amou;
												# ВНИМАНИЕ 12.10.2009 
												# ако е олихвяема сума - според допълнителния глобален флаг 
												#    $flagintax - да участва ли в сумата за т.26 
//												if ($ind1==2){
						# 19.10.2010 Бургас 174/08 повече от 1 олихв.сума 
						$myflag= $lis1[$idcurr]["isintax"];
												/*
												if ($ind1==2 or $type1_neolih){
						$myflag= $lis1[$idcurr]["isintax"];
												}else{
						$myflag= $flagintax;
												}
												*/
# 13.01.2011 - месечна неолихвяема сума =5 
//						$taxamount= ($myflag==0) ? 0 : $amou;
$taxamount= ($myflag==0) ? 0 : $elem["amou"];
						$elem["move"]["taxamo"]= $taxamount;
# 22.10.2009 - ако началната дата е празна - 
# това е неолихв.главница = неолихвяема сума 
#---- специфична трансформация ---- преди записа в масива 
# понеже елемента трябва да има дата - ако е дълг с празна дата, записваме датата на образуване на делото 
if ($emptyfromdate){
	$elem["date"]= $datecreated;
}else{
}
							# добавяме елемента за дълг 
							addelem($elem);

//print_rr($balist);
#---- специфична трансформация ---- след записа в масива 
# ако току-що е добавен елемент за олихвяване - изтриваме го 
//if ($emptyfromdate and $isperc){
if ($type1_neolih and $isperc){
//print "<br>EMPTY";
//print_rr($balist[count($balist)-1]);
//print_rr($balist);
	# 05.07.2010 - оправена важна грешка 
	//+++++++++++++++++++++++++++++++++++++++++++unset($balist[count($balist)-1]);
	array_pop($balist);
}else{
}

		# ако елемента е месечна сума - добавяме още елементи дълг за всеки месец 
		# всяка дата е 1-во число на месеца 
		# начало - датата на дълга невключително 
		# край - днешна дата - невключително 
//		if ($lis1[$idcurr]["idtype"]==3){
# 13.01.2011 - месечна неолихвяема сума =5 
//print "IDCURR=";
//var_dump($lis1[$idcurr]["idtype"]);
/***
#--------------------------------------------------
						# 11.02.2011 КРЪПКА. 
						$uscodate= $uscont["date"];
						if (empty($uscodate)){
							if (0){
							}elseif ($type=="toend"){
global $rocase;
								if (isset($rocase)){
print "<br>rocase=toend=OK=";
//print_rr($rocase);
									$uscodate= substr( $rocase["created"] ,0,10);
print "$uscodate";
								}else{
print "<br>rocase=toend=notset";
								}
							}elseif ($type=="frombegin"){
									$uscodate= date("Y-m-d");
print "<br>rocase=frombegin=$uscodate";
							}else{
die("sumreduce=type=$type");
							}
						}else{
						# if (empty($uscodate)){
						}
						$uscont["date"]= $uscodate;
#--------------------------------------------------
***/
		if ($lis1[$idcurr]["idtype"]==3 or $lis1[$idcurr]["idtype"]==5){
			list($ye,$mo,$da)= explode("-",$uscont["date"]);
//			$stam= mktime(0,0,1  ,$mo,$da,$ye);
									# 15.12.2009 - вече има евент.крайна дата за мес.вноски 
					/*
									$todate= $lis1[$idcurr]["todate"];
									if (empty($todate)){
									}else{
										list($toye,$tomo,$toda)= explode("-",$todate);
										$cudatestam= mktime(0,0,1  ,$tomo,$toda,$toye);
									}
					*/
									# 21.09.2010 
									$todate= $lis1[$idcurr]["todate"];
									if (empty($todate)){
										$tostam= $cudatestam;
									}else{
										list($toye,$tomo,$toda)= explode("-",$todate);
										$tostam= mktime(0,0,1  ,$tomo,$toda,$toye);
										if ($cudatestam < $tostam){
											$tostam= $cudatestam;
										}else{
										}
									}
									# 16.12.2009 - разлагаме крайната дата на ден, месец, година 
//									$arda= getdate($cudatestam);
									$arda= getdate($tostam);
									$endateda= $arda["mday"];
									$endatemo= $arda["mon"];
									$endateye= $arda["year"];
//print "<br>[$endateda][$endatemo][$endateye]";
			while (true){
				$mo ++;
//++++++++print "<br>mystam=[$mo][$ye]";
				$mystam= mktime(0,0,1  ,$mo,1,$ye);
//				if ($mystam < $cudatestam){
				if ($mystam < $tostam){
					$mystamdate= date("Y-m-d",$mystam);
							# добавяме елемента за мес.вноска 
				# подготвяме съдържанието 
				$elem= array();
				$elem["date"]= $mystamdate;
				$elem["oper"]= 2;
				$elem["desc"]= $desc;
		$elem["amou"]= $amou;
									# 16.12.2009 
									# ако това е последния месец за месечната сума, редуцираме дълга според броя на дните 
									$arda= getdate($mystam);
									$mymont= $arda["mon"];
									$myyear= $arda["year"];
//print "<br>dates=[$mymont][$endatemo][$myyear][$endateye]";
									if ($mymont==$endatemo and $myyear==$endateye){
//print "=REDUCE";
/*
		$daycount= cal_days_in_month(CAL_GREGORIAN, $mymont, $myyear);
		$dayrest= $endateda;
//print "=[$daycount][$dayrest]";
		$sumrest= $amou/$daycount * $dayrest;
		$elem["amou"]= round($sumrest,2);
*/
//++++++++print "<br>balamain=2";
//		$elem["amou"]= sumreduce($amou,"$myyear-$mymont-$endateda","frombegin");
		$trandate= gettrandate("$myyear-$mymont-$endateda","frombegin");
		$elem["amou"]= sumreduce($amou,$trandate,"frombegin");
//++++++++print "<br>end-reduce=".$elem["amou"];
									}else{
									}
//print "<br>elem-amou=".$elem["amou"];
//		$elem["taxamount"]= $taxamount;
# 13.01.2011 - месечна неолихвяема сума =5 
$taxamount= ($myflag==0) ? 0 : $elem["amou"];
		$elem["move"]["taxamo"]= $taxamount;
						# движение 
//							$idclai= $lis1[$idcurr]["idclaimer"];
										# 13.01.2011 - месечна неолихвяема сума =5 
//						$elem["move"][$idclai]["capi"]= $amou;
										if ($lis1[$idcurr]["idtype"]==5){
											$elem["move"][$idclai]["tax"]= $elem["amou"];
										}else{
						$elem["move"][$idclai]["capi"]= $elem["amou"];
										}
							# добавяме елемента за дълг 
							addelem($elem);
				}else{
					break;
				}
			# end while 
			}
		}else{
		}
	}elseif ($oper==4){
#---- постъпление ---------------------------------
/*
		$elem["amou"]= $lis2[$idcurr]["inco"];
		$elem["idtype"]= $lis2[$idcurr]["idtype"];
*/
				# подготвяме съдържанието 
				$elem= array();
													$elem["id"]= $idcurr;
									$elem["separa"]= $lis2[$idcurr]["separa"];
									$elem["separa2"]= $lis2[$idcurr]["separa2"];
//									$elem["toclai"]= unserialize($lis2[$idcurr]["toclai"]);
									$elem["toclai"]= unsetoclai($lis2[$idcurr]["toclai"]);
				$elem["date"]= $uscont["date"];
				$elem["oper"]= $oper;
					$ind1= $lis2[$idcurr]["idtype"];
					$desc= $listfinatype2[$ind1];
//					$desc= $listfinatype[$ind1];
				$elem["desc"]= $desc;
					$amou= $lis2[$idcurr]["inco"];
		$elem["amou"]= $amou;
							# добавяме елемента за постъпление 
							addelem($elem);
	}elseif ($oper=="ap"){
#---- вноска по аванс.такси от взискателите -------------------------
			# 19.07.2010 - участват и вноските по аванс.такси от взискателите 
			$elem["id"]= $idcurr;
			$elem["date"]= $uscont["date"];
			$elem["oper"]= $oper;
//			$elem["desc"]= "вноска аванс.такси";
			$elem["desc"]= $lis3[$idcurr]["descrip"];
					$amou= $lis3[$idcurr]["amount"];
			$elem["amou"]= $amou;
					# движението 
					# изваждаме сумата от ЧСИ неолихв. 
					# добавяме сумата към Взискателя неолихв. 
					$idc2= $lis3[$idcurr]["idclaimer"];
			$elem["move"][0]["tax"]= -$amou;
			$elem["move"][$idc2]["tax"]= $amou;
							# добавяме елемента за постъпление 
							addelem($elem);
	}else{
die("cazobala=1=$oper");
	}
}

# сортираме в нарастващ ред на датите 
# подчинен критерий - обратен ред на операцията за еднаква дата 3=олихв 2=постъп 1=дълг 0=мес.вноска -1=към.момента 
								# последен критерий - id от съотв.таблица - възх.ред 
//print_rr($balist);
//ksort($mylist);
//oubali();
usort($balist,"complist");
//foreach($balist as $baelem){
//	print "<br>".$baelem["date"].'/'.$baelem["oper"];
//}
//print_rr($balist);

/*-----------------------------
# 19.07.2010 - участват и вноските по аванс.такси от взискателите 
function complist($p1,$p2){
	if ($p1["date"]==$p2["date"]){
		if ($p1["oper"]==="ap"){
			if ($p2["oper"]==="ap"){
return 0;
			}else{
				if ($p2["oper"]>=4){
return 1;
				}else{
return -1;
				}
			}
		}else{
			if ($p2["oper"]==="ap"){
				if ($p1["oper"]>=4){
return -1;
				}else{
return 1;
				}
			}else{
				if ($p1["oper"]==$p2["oper"]){
return 0;
				}else{
return $p1["oper"]>$p2["oper"] ? -1 : 1;
				}
			}
		}
	}else{
return $p1["date"]>$p2["date"] ? 1 : -1;
	}
}
-----------------------------*/
//oubali();

/*
# премахваме 1-вия елемент, ако той е за олихвяване 
if ($balist[0]["oper"]==5){
	unset($balist[0]);
}else{
}
*/
# за всяка дата оставяме само един елемент за олихвяване 
# ако първите няколко елемента са за олихвяване - остава само един 
			$bal2= array();
	$xxdate= "";
	$cuoper= -1;
foreach($balist as $elem){
	$date= $elem["date"];
	$oper= $elem["oper"];
	if ($date==$xxdate and $oper==$cuoper and $oper==5){
	}else{
			$bal2[]= $elem;
		$xxdate= $date;
		$cuoper= $oper;
	}
}
$balist= $bal2;
//print_r($mylist);
//print_rr($balist);
//oubali();

# премахваме 1-вия елемент, ако той е за олихвяване 
if ($balist[0]["oper"]==5){
	unset($balist[0]);
}else{
}
//oubali();
/*
#---- за дължимите суми ---------------------------------
						# за извеждане на тип - кратко 
						# предаваме съдържанието на масива 
						$smarty->assign("ARTYPE", $listsubjtype2);
						# за извеждане на подтип - кратко 
						# предаваме съдържанието на масива 
						$smarty->assign("ARSUBT", $listsubjst2);
#---- за постъпленията ---------------------------------
						# за извеждане на тип - кратко 
						# предаваме съдържанието на масива 
						$smarty->assign("ARFINATYPE", $listfinatype2);
*/
//print_rr($balist);

# глобално изчисляване - в реда на периодите 
#   [move]= движение 
#   [plus]= натрупан дълг 
#   [minu]= натрупано погасяване 
#   [resu]= резултат - текущ дълг 
#     [percpaid] - % на погасяване 
								# масиви за натрупването и разликата 
								$accuplus= array();
								$accuminu= array();
								$accuresu= array();
foreach($balist as $bain=>$elem){
//print_rr($elem);
	$oper= $elem["oper"];
	$amou= $elem["amou"];
//print "<br>[$oper][$amou]";
//print "<br>".$elem["date"]."[$oper]";
	if (0){
	}elseif ($oper==1){
		#--- към момента --- 
	}elseif ($oper==2){
		#--- месечна вноска --- 
								araction($accuplus,"+",$elem["move"]);
								$balist[$bain]["direction"]= "+";
//print "<br>================$oper=AFTER<br>";
//print_r($accuplus);
	}elseif ($oper==3){
		#--- дълг --- 
								araction($accuplus,"+",$elem["move"]);
								$balist[$bain]["direction"]= "+";
//print "<br>================$oper=AFTER<br>";
//print_r($accuplus);
	}elseif ($oper==4){
//print "<br>POSTAP=".$elem["amou"]."/".$elem["separa"]."/".$elem["separa2"];
		#--- постъпление --- 
			# разнасяме към ЧСИ 
#+++++++++++++++++++++++++++++++++++++++++++++++++
# да има 2 елемента - tax=таксите fee=т.26 
//			$balist[$bain]["move"][0]["fee"]= $elem["separa"];
											//payoffdist($balist,$bain,0,$arpayoffexof,$elem["separa"]);
									/*
									# 06.11.2009 - разпределената сума за ЧСИ вече не се разнася по масива с индекси [tax][fee] 
									# имаме 2 отделни суми - съотв. separa, separa2 
									# затова правим изкуствено разнасяне по массив с 1 елемент - 2 пъти за 2те полета 
									payoffdist($balist,$bain,0,array("tax"),$elem["separa"]);
									payoffdist($balist,$bain,0,array("fee"),$elem["separa2"]);
									*/
											# 06.11.2009 - разпределената сума за ЧСИ вече не се разнася по масива с индекси [tax][fee] 
											# имаме 2 отделни суми - съотв. separa, separa2 
											# затова ги вписваме в движението директно и поотделно 
											$balist[$bain]["move"][0]["tax"]= $elem["separa"];
											$balist[$bain]["move"][0]["fee"]= $elem["separa2"];

			# разнасяме към взискателите 
//print_rif($elem["toclai"]);
//print_r($elem["toclai"]);
			foreach($elem["toclai"] as $idclai=>$moneclai){
#+++++++++++++++++++++++++++++++++++++++++++++++++
# за всеки взискател да се раздели на части - такси, неолих, лихва, главница 
//				$balist[$bain]["move"][$idclai]["tax"]= $moneclai;
											payoffdist($balist,$bain,$idclai,$arpayoffclai,$moneclai);
			}
//print_rr($balist[$bain]["move"]);
								araction($accuminu,"+",$balist[$bain]["move"]);
								$balist[$bain]["direction"]= "-";
	}elseif ($oper==5){
		#--- олихвяване --- 
								# флаг за разшифроване на лихвата 
								$balist[$bain]["move"]["intelink"]= true;
			if ($amou=="no"){
					$elemprev= $balist[$bain -1];
					if (isset($elemprev)){
				$d1= $elemprev["date"];
					}else{
die("cazobala=4=$bain=$oper");
					}
				$d2= $elem["date"];
				# изчисляваме лихвата за периода - за всички взискатели 
				# главниците - от последното текущо състояние - [resu] от предишния елемент 
				$myresu= $elemprev["resu"];
				if (isset($myresu)){
												# паралелно изчисляваме общата лихва за всички взискатели 
												$sumainte= 0;
//print "<br>--------sumainte";
					foreach($myresu as $idclai=>$elemresu){
												# пропускаме условните взискатели [taxamo] и [intelink] 
												# ВНИМАНИЕ. релацията е ===, за да не се обработи $idclai===0 [ЧСИ] 
												if ($idclai==="taxamo" or $idclai==="intelink"){
													continue;
												}else{
												}
//printf("edit=%s\n", $edit);
						$arinte= calcinte($d1,$d2,$elemresu["capi"]);
						$newinte= $arinte["newinte"];
//print_rr($arinte);
//print "<br>INTE=[$d1][$d2][$newinte]";
												$sumainte += $newinte;
						# записваме резултата 
//print "<br>[$bain][move][$idclai][perc]= $newinte";
						$balist[$bain]["move"][$idclai]["perc"]= $newinte;
//						$balist[$bain]["move"][$idclai]["arinte"]= $arinte;
						# записваме параметрите, с които е изчислена лихвата 
						# - за разшифроване по заявка 
						$balist[$bain]["para"][$idclai]= array($d1,$d2,$elemresu["capi"]);
					}
												# ВНИМАНИЕ 12.10.2009 
												# определяме дали общата лихва участва в сумата за т.26 
												# - според допълнит.глобален флаг $flagintax - да участва ли в сумата за т.26 
//print "<br>sumainte=$sumainte";
												if ($flagintax){
//print "=[$bain][move][taxamo]=$sumainte";
						$balist[$bain]["move"]["taxamo"]= $sumainte;
												}else{
												}
				}else{
die("cazobala=5=$bain=$oper");
				}
			}else{
die("cazobala=3$bain==$oper");
			}
			//# СПЕЦИФИЧНО 
			//# нулираме сумата за формиране на т.26 
			//$balist[$bain]["move"]["taxamo"]= 0;
//								araction($accuplus,"+",$elem["move"]);
								araction($accuplus,"+",$balist[$bain]["move"]);
								$balist[$bain]["direction"]= "+";
	}elseif ($oper=="ap"){
#---- вноска по аванс.такси от взискателите -------------------------
			# 19.07.2010 - участват и вноските по аванс.такси от взискателите 
//						$elem["move"]["taxamo"]= 0;
//print "[$bain]-move-taxamo===0";
						$balist[$bain]["move"]["taxamo"]= 0;
								araction($accuplus,"+",$balist[$bain]["move"]);
								$balist[$bain]["direction"]= "+";
	}else{
die("cazobala=2=$bain=$oper");
	}
				# изчисляваме и записваме таксата по т.26 
//				$sum26= $balist[$bain]["plus"]["taxamo"];
				$sum26= $accuplus["taxamo"];
				$tax26= calctax($sum26);
				//$tax26 *= 1.2;
				//$tax26= round($tax26,2);
//				$balist[$bain]["plus"][0]["fee"]= $tax26;
				$accuplus[0]["fee"]= $tax26;
				
						# съхраняваме в текущия елемент 
						$balist[$bain]["plus"]= $accuplus;
						$balist[$bain]["minu"]= $accuminu;
							$arresu= array();
							araction($arresu,"+",$accuplus);
							araction($arresu,"-",$accuminu);
						$balist[$bain]["resu"]= $arresu;
//print "<br>------end------";
}

# 22.12.2009 - ВАЖНО 
# премахваме елементите за олихвяване, в които няма движение 
# причина за възникване : 
#     преди да се появил първия олихвяем елемент е имало неолихвяем 
#     заедно с неолихвяемия за неговата дата вече е създаден елемент за олихвяване в addelem() 

						$bali2= array();
foreach($balist as $bain=>$elem){
	$elemoper= $elem["oper"];
	$elemmove= $elem["move"];
//print_rr($elemmove);
//print $elem["oper"];
	if ($elemoper==5 and isset($elemmove["intelink"])){
				$sumaperc= 0;
		foreach($elemmove as $idclai=>$claielem){
//print $claielem["perc"];
				$sumaperc += $claielem["perc"];
		}
		$flagput= ($sumaperc<>0);
	}else{
		$flagput= true;
	}
	if ($flagput){
						$bali2[$bain]= $elem;
	}else{
	}
//var_dump($sumaperc);
//var_dump($flagput);
}
$balist= $bali2;

/*
				# формираме колоните "общо" - за всеки взискател 
				puttotal("move");
				puttotal("plus");
				puttotal("minu");
				puttotal("resu");
*/
				# формираме колоните "общо" 
				# по блокове [move][plus][minu][resu] и по взискатели 
				foreach($balist as $bain=>$baelem){
					puttotal($bain,"move");
					puttotal($bain,"plus");
					puttotal($bain,"minu");
					puttotal($bain,"resu");
						# за текущия блок - 
						# процентите на погасяване - по взискатели 
						putpercpaid($bain,"plus","minu");
		# 18.11.2009 
		# само за блока [resu] - общата сума на актуалния дълг 
								$tosu= 0;
//print "<br>-----------------[$bain]";
		foreach($balist[$bain]["resu"] as $idclai=>$claielem){
//print "<br>idclai=[$idclai]";
//print "<br>";
			if (is_array($claielem)){
								$tosu += $claielem["total"];
//print_rr($claielem);
			}else{
//print "===NO";
			}
//print "<br>add=".$claielem["total"]."/tosu=[$tosu]";
//print "<br>tosu=[$tosu]";
		}
		$balist[$bain]["tosuma"]= $tosu;
				# foreach($balist as $bain=>$baelem){
				}
//++++++++++++++++++++++++++++++++++++++++++++++++++print_rr($balist);

# извеждаме 
//$smarty->assign("ADDNEW", $addnew);
//$smarty->assign("LIST", $mylist);
//print_rr($balist);
//print_rif($balist);
$smarty->assign("LIST", $balist);
				//# 01.10.2010 - последния елемент - заради акт.дълг 
				//$smarty->assign("LISTACTU", end($balist));
				# 01.10.2010 - индекса на последния елемент - заради акт.дълг 
				$akey= array_keys($balist);
//				$smarty->assign("LASTINDX", end($akey));
//$pagecont= smdisp($tpname,"iconv");




/*-----------------------------
# функция - добавя елемент към списъка, евент. и за олихвяване 
function addelem($elem){
global $balist, $isperc;
//global $balist, $elem, $uscont, $isperc;
//				$elem["date"]= $p1date;
							# добавяме елемента за дълг 
							$balist[]= $elem;
//print "<br>----------- elem-begin ------------<br>";
//print_r($elem);
//print "<br>----------- elem-end ------------<br>";
	# и евентуално елемент за олихвяване 
	# независимо дали предишната сума е дълг или постъпление 
	if ($isperc){
											# копираме в нов масив 
											# оставяме съдържанието на елемента - без движението 
											# движението ще бъде по лихва и ще се изчисли след сортировката по дата 
											#   - признак за изчисляване : [amou]=="no" 
											#   - за идентификация на бъдещото движение добавяме и id на взискателя 
											$e2= $elem + array();
											unset($e2["move"]);
global $idclai;
											$e2["idclai"]= $idclai;
										$e2["oper"]= 5;
										$e2["desc"]= "";
										$e2["amou"]= "no";
							$balist[]= $e2;
	}else{
	}
}


# аритметика с масиви 
#    $arfirst - първичен масив - by reference ! 
#    $action - действие + или - 
#    $arsecond - вторичен масив 
# не връща резултат, първичния масив е променен 
function araction(&$arfirst,$action,$arsecond){
//print "<br>----------------";
	foreach($arsecond as $idclai=>$arclai){
										if (is_array($arclai)){
		foreach($arclai as $vaname=>$vacont){
			if ($action=="-"){
				$vacont= - $vacont;
			}else{
			}
//+++			$arfirst[$idclai][$vaname] += $vacont;
			$arfirst[$idclai][$vaname] += round($vacont,2);
		}
										}else{
			$vacont= $arclai;
			if ($action=="-"){
				$vacont= - $vacont;
			}else{
			}
//+++			$arfirst[$idclai] += $vacont;
			$arfirst[$idclai] += round($vacont,2);
										}
	}
//return $arfirst;
}


# формираме колоните "общо" - за всеки взискател 
function puttotal($bain,$nameto){
global $balist;
//	foreach($balist as $bain=>$baelem){
		$baelem= $balist[$bain];
		if (isset($baelem[$nameto])){
			foreach($baelem[$nameto] as $idclai=>$claielem){
													if (is_array($claielem)){
								$sumtotal= 0;
				foreach($claielem as $content){
								$sumtotal += $content;
				}
								$balist[$bain][$nameto][$idclai]["total"]= $sumtotal;
													}else{
													}
			}
		}else{
		}
//	}
}

# формираме процентите на погасяване - по взискатели 
function putpercpaid($bain,$nam1,$nam2){
global $balist;
		$baelem= $balist[$bain];
		$con1= $baelem[$nam1];
		$con1= (isset($con1)) ? $con1 : array();
		$con2= $baelem[$nam2];
		$con2= (isset($con2)) ? $con2 : array();
			# заради пълния списък на индексите - възложителите 
			$wor1= $con1 + $con2; 
//print_rr($wor1);
//print_rr($con1);
//print_rr($con2);
//print "<br>$bain";
//print_rr(array_keys($con1));
//print_rr(array_keys($con2));
		foreach($wor1 as $idclai=>$x2){
//print "<br>$bain=idclai=[$idclai]";
									# пропускаме условните взискатели [taxamo] и [intelink] 
									# ВНИМАНИЕ. релацията е ===, за да не се обработи $idclai===0 [ЧСИ] 
									if ($idclai==="taxamo" or $idclai==="intelink"){
										continue;
									}else{
									}
			$percpaid= diviperc($con2[$idclai]["total"],$con1[$idclai]["total"]);
								$balist[$bain]["percpaid"][$idclai]= $percpaid;
//print "<br>[$bain][percpaid][$idclai]=$percpaid";
		}
}

# процент чрез деление 
function diviperc($p1,$p2){
//var_dump($p1);
//var_dump($p2);
	if ($p2+0==0){
return "???";
	}else{
return round(100*$p1/$p2);
	}
}


# разнасяне на сума по масив от индекси - до изчерпването й 
#      $balist  - входен и резултатен масив с данни 
#      $bain    - 1-вичния му индекс 
#      $idclai  - 2-ричния му индекс - взискателя
#      $arindex - масива с индекси 
#      $amount  - сумата за разнасяне 
function payoffdist(&$balist,$bain,$idclai,$arindex,$amount){
	if ($amount+0 ==0){
return;
	}else{
	}
//print_r($arindex);
//print "<br>------------------razpred=[$amount][$idclai]";
				$cuam= $amount;
	foreach($arindex as $currindx){
//					$elemprev= $balist[$bain -1];
		$resuelem= $balist[$bain-1]["resu"][$idclai][$currindx];
		$mini= min($cuam+0,$resuelem+0);
//print "<br>payoffdist=[$currindx][$idclai][$resuelem][$cuam][$mini]";
//print "<br>value=[$bain][move][$idclai][$currindx]= $mini";
$balist[$bain]["move"][$idclai][$currindx]= $mini;
				$cuam -= $mini;
//print "mini=[$mini]";
	}
//print_r($balist[$bain]["move"]);
	if ($cuam<=0){
	}else{
# 18.12.2009 
# оправена важна грешка - добавяме, а не присвояваме остатъка 
# - виж дело 4909/2009 Бъзински 
$currindx= $arindex[count($arindex)-1];
//$balist[$bain]["move"][$idclai][$currindx]= $cuam;
$balist[$bain]["move"][$idclai][$currindx] += $cuam;
	}
}

# само за тестване 
function oubali(){
global $balist;
print "<br>------balist------";
	foreach($balist as $indx=>$elem){
		$oper= $elem["oper"];
		$date= $elem["date"];
		$amou= $elem["amou"];
		$id= $elem["id"];
print "<br>$indx= [$amou][$oper][$date][$id]";
	}
}
-----------------------------*/


?>
