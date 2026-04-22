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

									include_once "subjpaymhist.inc.php";
							$arperc= getpercent();
							
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
								#~~~~~~ 09.05.2011 за отчет раздел 2 ~~~~~~~~~~~~~~~~~~~ 
								# аналогични индекси за колоните 
if (0){
}elseif ($idpayoff==0){
	$arpayoffclai= array("tax","perc","capi");
//								$ar2payoff= array(5,6,7  ,8,9);
								//$ar2payoff= array("c5dru","c5fee",6,7  ,8,9);
}elseif ($idpayoff==1){
	$arpayoffclai= array("capi","perc","tax");
//								$ar2payoff= array(9,8  ,5,6,7);
								//$ar2payoff= array(9,8  ,"c5dru","c5fee",6,7);
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
#=========================================================================
# 18.03.2015 предварителна проверка за грешна дата 
# преди да възникне грешка formdata=2 [die - subjpaymhist.inc.php] 
										//$stamp1= 0;
					foreach($lis1 as $ind1=>$ele1){
						$fro1= trim(substr($ele1["fromdate"],0,10));
//file_put_contents("sudate.txt","\n---date=$fro1",FILE_APPEND );
						if (empty($fro1)){
						}else{
							$err1= false;
							if (substr($fro1,4,1)=="-" and substr($fro1,7,1)=="-"){
								list($god1,$mes1,$den1)= explode("-",$fro1);
//file_put_contents("sudate.txt","\nelem=[$god1][$mes1][$den1]",FILE_APPEND );
								if (checkdate($mes1,$den1,$god1)){
//file_put_contents("sudate.txt","\nYES",FILE_APPEND );
									/***
									$sta1= mktime(0,0,1  ,$mes1,$den1,$god1);
									if ($sta1>=$stamp1){
										$stamp1= $sta1;
//file_put_contents("sudate.txt","\nstamp=OK",FILE_APPEND );
									}else{
//file_put_contents("sudate.txt","\nstamp=ERROR",FILE_APPEND );
										$err1= true;
									}
									***/
								}else{
//file_put_contents("sudate.txt","\nNOOOOOO",FILE_APPEND );
										$err1= true;
								}
							}else{
										$err1= true;
							}
							if ($err1){
$des1= $rocase["serial"]."/".$rocase["year"];
$tex1= tran1251($ele1["text"]);
$amo1= $ele1["amount"];
print (toutf8("
	ГРЕШНА ДАТА на предмет в дело $des1 
	\nКОРЕГИРАЙ датата за \"$tex1\" на стойност $amo1
	"));
//die;
							}else{
							}
						}
					}
#=========================================================================
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
//print "<br>OPER=$oper<br>";
	if ($oper==3){
#---- дължима сума ---------------------------------
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
		$elem["amou"]= $amou +0;
#----- дв-86/17----- 
$amo2= $lis1[$idcurr]["amo2"];
if ($_SESSION["iscasetran"] and $amo2<>""){
		$elem["amouorig"]= $amou +0;
		$elem["amou"]= $amo2 +0;
}else{
}
									# 16.12.2009 
									# ако дължимата сума е месечна, редуцираме я само за 1-вия месец - според броя на дните 
//									if ($oper=="3" and $lis1[$idcurr]["idtype"]==3){
												#~~~~~~ 09.05.2011 за отчет раздел 2 ~~~~~~~~~~~~~~~~~~~ 
												$mesevnos= false;
									# 13.01.2011 - месечна неолихвяема сума =5 
									if ($oper=="3" and ($lis1[$idcurr]["idtype"]==3 or $lis1[$idcurr]["idtype"]==5)){
												#~~~~~~ 09.05.2011 за отчет раздел 2 ~~~~~~~~~~~~~~~~~~~ 
												$mesevnos= true;;
/*
		list($frye,$frmo,$frda)= explode("-",$lis1[$idcurr]["fromdate"]);
		$daycount= cal_days_in_month(CAL_GREGORIAN, $frmo, $frye);
		$dayrest= $daycount - $frda;
		$sumrest= $amou/$daycount * $dayrest;
		$elem["amou"]= round($sumrest,2);
*/
		
# 14.02.2011 - специално за месечна неолихвяема сума 
		//$elem["amou"]= sumreduce($amou,$lis1[$idcurr]["fromdate"],"toend");
		$trandate= gettrandate($lis1[$idcurr]["fromdate"],"toend");
					$uscont["date"]= $trandate;
		$elem["amou"]= sumreduce($amou,$trandate,"toend");
# 14.02 2011 ----------------------------------------
//print "<br>begin-reduce=".$elem["amou"];
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
#~~~~~~ 09.05.2011 за отчет раздел 2 ~~~~~~~~~~~~~~~~~~~ 
# колоната за отчет-2 и движението за нея 
												if ($mesevnos){
					$elem["oper"]= 2;
												}else{
												}
$r2col= getr2col($ind1,$ind2);
$elem["rep2plus"][$r2col] += $elem["amou"];
#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 
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
# 14.02.2011 - специално за месечна неолихвяема сума 
		//$elem["amou"]= sumreduce($amou,"$myyear-$mymont-$endateda","frombegin");
		$trandate= gettrandate("$myyear-$mymont-$endateda","frombegin");
		$elem["amou"]= sumreduce($amou,$trandate,"frombegin");
# 14.02 2011 ----------------------------------------
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
#~~~~~~ 09.05.2011 за отчет раздел 2 ~~~~~~~~~~~~~~~~~~~ 
# колоната за отчет-2 и движението за нея 
$r2col= getr2col($ind1,$ind2);
$elem["rep2plus"][$r2col] += $elem["amou"];
#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 
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
			# подготвяме съдържанието 
			$elem= array();
//print "<br>----BEGIN----<br>";
//print_rr($elem);
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
//print "<br>----before----<br>";
//print_rr($elem);
							# добавяме елемента за постъпление 
							addelem($elem);
//print "<br>----after----<br>";
//print_rr($elem);
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
/****
function complist($p1,$p2){
	if ($p1["date"]==$p2["date"]){
//		if ($p1["oper"]==$p2["oper"]){
		if ($p1["oper"]===$p2["oper"]){
								if ($p1["id"]==$p2["id"]){
return 0;
								}else{
return $p1["id"]>$p2["id"] ? 1 : -1;
								}
return 0;
		}else{
//return $p1["oper"]<$p2["oper"] ? 1 : -1;
#--------------------------------------------------------------
# поредност : 1, 2, 3, ap, 4, 5  
				if ($p1["oper"]==="ap"){
					if ($p2["oper"]>=4){
return -1;
					}else{
return 1;
					}
				}else{
return $p1["oper"]<$p2["oper"] ? 1 : -1;
				}
				if ($p2["oper"]==="ap"){
					if ($p1["oper"]>=4){
return 1;
					}else{
return -1;
					}
				}else{
return $p1["oper"]<$p2["oper"] ? 1 : -1;
				}
#--------------------------------------------------------------
		}
	}else{
return $p1["date"]>$p2["date"] ? 1 : -1;
	}
}
****/
//print_rr($balist);
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
//~~~~~~~~~~~~~~~~~~~~~~~~print_rr($balist);

#----------------------------- глобално изчисляване - в реда на периодите ---------------------
#   [move]= движение 
#   [plus]= натрупан дълг 
#   [minu]= натрупано погасяване 
#   [resu]= резултат - текущ дълг 
#     [percpaid] - % на погасяване 

								# масиви за натрупването и разликата 
								$accuplus= array();
								$accuminu= array();
								$accuresu= array();
#~~~~~~ 09.05.2011 за отчет раздел 2 ~~~~~~~~~~~~~~~~~~~ 
# масив с натрупан резултат по колони 
$ar2result= array();
# и функция за натрупването 
function put2result($dire,$ar2){
global $ar2result;
//print "<br>AR2=";
//var_dump($ar2);
	if (is_array($ar2)){
		foreach($ar2 as $ind2=>$con2){
//print "<br>put2=[$ind2][$con2]";
			if ($ind2+0==0){
			}else{
				if ($dire=="+"){
					$ar2result[$ind2] += $con2;
				}else{
					$ar2result[$ind2] -= $con2;
				}
			}
		}
//				$ar2result[5]= $ar2["c5dru"] + $ar2["c5fee"];
				if ($dire=="+"){
					$ar2result["c5dru"] += $ar2["c5dru"];
					$ar2result["c5fee"]= $ar2["c5fee"];
				}else{
					$ar2result["c5dru"] -= $ar2["c5dru"];
					$ar2result["c5fee"] -= $ar2["c5fee"];
				}
				$ar2result[5]= $ar2result["c5dru"] + $ar2result["c5fee"];
	}else{
	}
}
#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 

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
#~~~~~~ 09.05.2011 за отчет раздел 2 ~~~~~~~~~~~~~~~~~~~ 
/*****
# определяме общата погасена сума за всички взискатели 
			$rep2tota= 0;
foreach($balist[$bain]["move"] as $idclai=>$claicont){
	foreach($claicont as $ind3=>$con3){
//print "<br>$ind3=$con3";
			$rep2tota += $con3;
	}
}
//var_dump($rep2tota);
# аналогично разпределяме погасената сума за отчет 2 - няма взискатели 
payoffrep2($balist,$bain,$ar2payoff,$rep2tota);
//print_rr($balist[$bain]["move"]);
*****/
rep2moveclai($balist,$bain);
#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 
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
//print "<br>sumainte=[$bain][move][taxamo]=$sumainte";
						$balist[$bain]["move"]["taxamo"]= $sumainte;
												}else{
												}
#~~~~~~ 09.05.2011 за отчет раздел 2 ~~~~~~~~~~~~~~~~~~~ 
# записваме олихвяването в движението 
$r2col= getr2col("lih","");
//$balist[$bain]["rep2plus"][$r2col] += $sumainte;
//print "<br>$bain-rep2plus-$r2col-before=" .$balist[$bain]["rep2plus"][$r2col];
$balist[$bain]["rep2plus"][$r2col]= $sumainte;
//print "<br>$bain-rep2plus-$r2col-after=" .$balist[$bain]["rep2plus"][$r2col];
#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 
				}else{
die("cazobala=5=$bain=$oper");
				}
			}else{
die("cazobala=3=$bain==$oper");
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
				//$tax26= calctax($sum26);
							#----- дв-86/17----- 
							$tax26= calctax($sum26,$edit);
//print "<br>tax26=[$tax26]sum26=[$sum26]";
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
#~~~~~~ 09.05.2011 за отчет раздел 2 ~~~~~~~~~~~~~~~~~~~ 
# записваме т.26 в движението 
$r2col= getr2col("t26","");
//print "<br>TAX26=$bain-rep2plus-$r2col-before=" .$balist[$bain]["rep2plus"][$r2col];
//$balist[$bain]["rep2plus"][$r2col] += $tax26;
//print "<br>TAX26=$bain-rep2plus-$r2col-after=" .$balist[$bain]["rep2plus"][$r2col];
# ВНИМАНИЕ. специфично изчисляване : предиш.салдо за т.26 + разлика 
		$t26curr= $balist[$bain]["plus"][0]["fee"];
		$t26prev= $balist[$bain-1]["plus"][0]["fee"];
	$t26diff= $t26curr - $t26prev;
	$t26diff= round($t26diff,2);
		$t26prevbala= $balist[$bain-1]["rep2resu"]["c5fee"];
	$tax26resu= $t26prevbala + $t26diff;
//print "<br>T26=[$bain][$t26curr][$t26prev][$t26diff][$t26prevbala][$tax26resu]";
//$balist[$bain]["rep2plus"][$r2col] += $tax26resu;
$balist[$bain]["rep2plus"][$r2col]= $tax26resu;
# натрупваме резултата 
put2result("+",$balist[$bain]["rep2plus"]);
put2result("-",$balist[$bain]["rep2minu"]);
# присвояваме натрупания масив 
$balist[$bain]["rep2resu"]= $ar2result;
#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 
# край на цикъла foreach($balist as $bain=>$elem){
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
//~~~~~~~~~~~~~~~~~~~~~~~print_rr($balist);

//print_rr(toutf8($balist));
				# евент.извеждаме протокол balist.txt - rep2calc2.ajax.php 
				if ($ISLOGTXT){
					$baut= print_r(toutf8($balist),true);
					file_put_contents("balist.txt",$baut);
				}else{
				}

# извеждаме 
//$smarty->assign("ADDNEW", $addnew);
//$smarty->assign("LIST", $mylist);
$smarty->assign("LIST", $balist);
				//# 01.10.2010 - последния елемент - заради акт.дълг 
				//$smarty->assign("LISTACTU", end($balist));
				# 01.10.2010 - индекса на последния елемент - заради акт.дълг 
				$akey= array_keys($balist);
				$smarty->assign("LASTINDX", end($akey));
//print_rr(toutf8($balist[end($akey)]));
		# 30.01.2018 актуален дълг - списък елементи 
		$acdeli= getacdebt_list($balist[end($akey)]);
		$smarty->assign("ACDEBT_LIST", $acdeli);
$pagecont= smdisp($tpname,"iconv");



# 30.01.2018 актуален дълг - списък елементи 
function getacdebt_list($arp1){
	$artx= array();
	$artx["capi"]= "главница";
	$artx["perc"]= "законна лихва към ".date("d.m.Y");
	$artx["nop"]= "неолихвяема сума";
	$artx["tax"]= "такси";
	$artx= $artx;
		$txsuff= " €";
		$txtota= "общо ";
				//$resu= "";
				$arelem= array();
	foreach($arp1["resu"] as $indx=>$cont){
		if (is_int($indx)){
//				$resu .= ",".$indx;
			if ($indx==0){
				$arelem["tax"]= $cont["total"];
			}else{
				$arelem["capi"] += $cont["capi"];
				$arelem["perc"] += $cont["perc"];
				$arelem["nop"] += $cont["tax"];
			}
		}else{
		}
	}
//print_rr($arelem);
				$arresu= array();
	foreach($artx as $code=>$text){
		$cuelem= $arelem[$code];
//print toutf8("<br>[$code][$text][$cuelem]");
//		if (isset($cuelem)){
		if ($cuelem+0<>0){
				$arresu[]= $text." ".number_format($cuelem,2).$txsuff;
		}else{
		}
	}
	$suto= number_format($arp1["tosuma"],2);
	$arresu[]= $txtota.$suto.$txsuff;
	$resu= implode(", ",$arresu);
return $resu;
}


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
#~~~~~~ 09.05.2011 за отчет раздел 2 ~~~~~~~~~~~~~~~~~~~ 
# премахваме и елемента за колоната отчет-2 
unset($e2["rep2plus"]);
unset($e2["rep2minu"]);
//////unset($e2["rep2resu"]);
#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 
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

/*
#~~~~~~ 09.05.2011 за отчет раздел 2 ~~~~~~~~~~~~~~~~~~~ 
# аналогично разпределяме погасената сума за отчет 2 - няма взискатели 
function payoffrep2(&$balist,$bain,$arindex,$amount){
	if ($amount+0 ==0){
return;
	}else{
	}
				$cuam= $amount;
//print "<br>CUAM=[$cuam]";
	foreach($arindex as $currindx){
		$resuelem= $balist[$bain-1]["rep2resu"][$currindx];
//print "<br>resuelem=[$resuelem][$bain][$currindx]";
		$mini= min($cuam+0,$resuelem+0);
//print "<br>MINI=[$mini]";
$balist[$bain]["rep2minu"][$currindx]= $mini;
				$cuam -= $mini;
	}
	if ($cuam<=0){
	}else{
$currindx= $arindex[count($arindex)-1];
# добавяме, а не присвояваме остатъка 
$balist[$bain]["rep2mini"][$currindx] += $cuam;
	}
$balist[$bain]["rep2minu"][5]= $balist[$bain]["rep2minu"]["c5dru"] + $balist[$bain]["rep2minu"]["c5fee"];
//print "<br>BALIST-BAIN=";
//print_rr($balist[$bain]["move"]);
}
*/

#~~~~~~ 09.05.2011 за отчет раздел 2 ~~~~~~~~~~~~~~~~~~~ 
# специфично разпределяне на постъпление по взискатели 
//function rep2move(&$balist,$bain,$arindex,$amount){
function rep2moveclai(&$balist,$bain){
# схема за ЧСИ 
$ardist0= array(
	"fee"=> "c5fee"
	,"tax"=> array(6,7)
	);
# схема за взискател 
$ardistclai= array(
	"capi"=> 9
	,"perc"=> 8
# [9] - неолихв.главница(дълг), неолихв.мес.вноска 
	,"tax"=> array("c5dru",6,7  ,9)
	);
						$arresu= array();
	$arbase= $balist[$bain-1]["rep2resu"];
//print "<br>ARBASE=";
//print_rr($arbase);
	foreach($balist[$bain]["move"] as $claiid=>$claico){
		if ($claiid+0 >0){
			# взискател 
			$arresu[$claiid]= rep2distclai($claico,$ardistclai,$arbase);
		}elseif ($claiid+0 ===0){
			# ЧСИ 
			$arresu[$claiid]= rep2distclai($claico,$ardist0,$arbase);
		}else{
			# други = intelink, taxamo 
		}
	}
$balist[$bain]["rep2move"]= $arresu;
	# сумираме постъплението общо без взискатели 
	foreach($balist[$bain]["rep2move"] as $idclai=>$clelem){
		foreach($clelem as $r2code=>$r2cont){
			$balist[$bain]["rep2minu"][$r2code] += $r2cont;
		}
	}
	$balist[$bain]["rep2minu"][5]= $balist[$bain]["rep2minu"]["c5dru"] + $balist[$bain]["rep2minu"]["c5fee"];
}

function rep2distclai($claico,$ardist,$arbase){
//print "<br>rep2distclai=";
//print_rr($claico);
//print_rr($ardist);
//print_rr($arbase);
				$arre= array();
	foreach($ardist as $in1=>$distel){
		$claielem= $claico[$in1];
//print "<br>---[$in1][$claielem][$distel]";
		if (is_array($distel)){
//				$arre= $arre + rep2po($claielem,$distel,$arbase);
				$arreex= rep2po($claielem,$distel,$arbase);
			foreach($arreex as $in2=>$co2){
				$arre[$in2] += $co2;
			}
		}else{
				$arre[$distel]= $claielem;
				$arbase[$distel] -= $claielem;
		}
	}
//print "<br>result=";
//print_rr($arre);
return $arre;
}

function rep2po($amount,$arindex,$arbase){
//print "<br>rep2po=";
//var_dump($amount);
//print_rr($arindex);
//print_rr($arbase);
	if ($amount+0 ==0){
return array();
	}else{
	}
						$ar2= array();
				$cuam= $amount;
//print "<br>CUAM=[$cuam]";
	foreach($arindex as $currindx){
		$resuelem= $arbase[$currindx];
//print "<br>resuelem=[$resuelem][$currindx]";
		$mini= min($cuam+0,$resuelem+0);
//print "<br>[$cuam][$resuelem]MINI=[$mini]";
						$ar2[$currindx] += $mini;
				$cuam -= $mini;
	}
//print "<br>ar2-a";
//print_rr($ar2);
	if ($cuam<=0){
	}else{
$currindx= $arindex[count($arindex)-1];
# добавяме, а не присвояваме остатъка 
//$balist[$bain]["rep2mini"][$currindx] += $cuam;
						$ar2[$currindx] += $cuam;
//print "<br>ar2-bbb";
//print_rr($ar2);
	}
return $ar2;
}
#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 


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


# 14.02.2011 - специално за месечна неолихвяема сума 
# трансформира липсваща дата 
function gettrandate($uscodate,$type){
						#--------------------------------------------------
						# 11.02.2011 КРЪПКА. 
//						$uscodate= $uscont["date"];
						if (empty($uscodate)){
							if (0){
							}elseif ($type=="toend"){
global $rocase;
								if (isset($rocase)){
//++++++++print "<br>rocase=toend=OK=";
//print_rr($rocase);
									$uscodate= substr( $rocase["created"] ,0,10);
//++++++++print "$uscodate";
								}else{
//++++++++print "<br>rocase=toend=notset";
								}
							}elseif ($type=="frombegin"){
									$uscodate= date("Y-m-d");
//++++++++print "<br>rocase=frombegin=$uscodate";
							}else{
die("gettrandate=type=$type");
							}
						}else{
						# if (empty($uscodate)){
						}
//						$uscont["date"]= $uscodate;
						#--------------------------------------------------
return $uscodate;
}

?>
