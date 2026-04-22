<?php
# статистика за година-месец 
# отгоре вар.1 : 
#     $year - годината 
#     $stmont - месеца 
# отгоре вар.2 : 
#     $stperi - периода от 2 дати 
//print_rr($GETPARAM);

											# функциите 
											include_once "statis.inc.php";

# основните параметри 
$smarty->assign("MONT", $stmont);
list($d1,$d2)= explode("^",$stperi);
$smarty->assign("D1", $d1);
$smarty->assign("D2", $d2);

# деловодителите 
$userlist= getselect("user","name","1",true);
	$userlist= tran1251($userlist);
$smarty->assign("USERLIST", $userlist);
//print_rr($userlist);

//# филтъра 
//$filt= "year(finance.time)=$year and month(finance.time)=$mont";
//$filt1= "year(finance.time)=$year and month(finance.time)=$mont";
# данните 
												$suma= array();
												
#--------------------- 1. общ брой дела по деловодители -----------------------------
$que1= "select suit.iduser as iduser
	, count(suit.id) as coun
	from suit
	group by iduser
	";
//print $query;
$lis1= $DB->select($que1);
//print_r($mylist);
//$smarty->assign("DATA", $mylist);

# обработваме данните 
						$lis1out= array();
foreach($lis1 as $elem){
	$cuuser= $elem["iduser"];
		# ВАЖНО. 
		# $cuuser има стойности NULL -1 0 
		$cuuser= $cuuser+0<=0 ? 0 : $cuuser;
//	$cumont= $elem["mont"];
	$cucoun= $elem["coun"];
						$lis1out[$cuuser] += $cucoun;
												$suma[1] += $cucoun;
//print "<br>[$cuuser][$cucoun]=".$suma[1];
}
												$sumamaxind= 1;
//print_r($list2);
//print_r($link);
$smarty->assign("DATA1", $lis1out);
												
#--------------------- 1a. брой дела, образувани към края на срока -----------------------------
# 14.06.2012 - специално за Дервиш 
if (empty($d2)){
	$montend= 12*$year+$stmont;
	$filt2= "12*year(suit.created)+month(suit.created) <= ".$montend;
}else{
	$filt2= "suit.created <= '$d2'";
}
//$filt2= getfilt("suithist.time");
//var_dump($filt2);
$que1a= "select suit.iduser as iduser
	, count(suit.id) as coun
	from suit
where $filt2
	group by iduser
	";
//print $query;
$lis1a= $DB->select($que1a);
//print_rr($lis1a);
//$smarty->assign("DATA", $mylist);

# обработваме данните 
						$lis1out2= array();
foreach($lis1a as $elem){
	$cuuser= $elem["iduser"];
		# ВАЖНО. 
		# $cuuser има стойности NULL -1 0 
		$cuuser= $cuuser+0<=0 ? 0 : $cuuser;
//	$cumont= $elem["mont"];
	$cucoun= $elem["coun"];
						$lis1out2[$cuuser] += $cucoun;
												$suma[2] += $cucoun;
//print "<br>[$cuuser][$cucoun]=".$suma[1];
}
												$sumamaxind= 2;
//print_r($list2);
//print_r($link);
$smarty->assign("DATA1A", $lis1out2);
//print_rr($lis1out2);

#--------- 2. брой отваряни собствени дела през периода по деловодители -------------
# само собствените - може друг юзер да е отварял дела на деловодителя - финансист, админ 
$filt2= getfilt("suithist.time");
/*
$que2= "select suithist.iduser as iduser
	, count(suithist.id) as coun
	from suithist
	left join suit on suithist.idcase=suit.id
	where $filt2 and suithist.iduser=suit.iduser
	group by iduser
	";
//	where suithist.iduser=suit.iduser
//print $que2;
//print $query;
*/
		/*
		# ВНИМАНИЕ. Горната заявка е грешна. 
		# За всеки юзер връща общия брой отваряния, тоест едно и също дело може да се среща многократно. 
		# Затова правим заявката на 2 етапа. 
		# - етап-1 : отварянията, които е правил самия деловодител и попадат в периода 
		$que2a= "select suithist.iduser as iduser, suithist.idcase as idcase
			from suithist
			left join suit on suithist.idcase=suit.id
			where $filt2 and suithist.iduser=suit.iduser
			";
		# - етап-2 : броя на отварянията от етап-1 - за всеки деловодител 
		$que2= "select t2.iduser as iduser, count(t2.idcase) as coun
			from ($que2a) as t2
			group by t2.iduser
			";
		*/
		# Втората заявка - НЕ !!! 
		# ВНИМАНИЕ. Първата заявка е грешна. 
		# За всеки юзер връща общия брой отваряния, тоест едно и също дело може да се среща многократно. 
		# Затова правим групирането и по дело, а после за всяко дело броим не бройката, а 1. 
		$que2= "select suithist.iduser as iduser, suithist.idcase as idcase
			, count(suithist.id) as coun
			from suithist
			left join suit on suithist.idcase=suit.id
			where $filt2 and suithist.iduser=suit.iduser
			group by iduser, idcase
			";
$lis2= $DB->select($que2);
//print_r($lis2);
//$smarty->assign("DATA", $mylist);

# обработваме данните 
						$lis2out= array();
foreach($lis2 as $elem){
	$cuuser= $elem["iduser"];
		# ВАЖНО. 
		# $cuuser има стойности NULL -1 0 
		$cuuser= $cuuser+0<=0 ? 0 : $cuuser;
//	$cumont= $elem["mont"];
/*
	$cucoun= $elem["coun"];
						$lis2out[$cuuser] += $cucoun;
												$suma[2] += $cucoun;
*/
						# ВНИМАНИЕ. Броим 1 вместо бройката. 
						$lis2out[$cuuser] += 1;
												$suma[3] += 1;
}
												$sumamaxind= 3;
$smarty->assign("DATA2", $lis2out);

#--------- 3. брой Неотваряни собствени дела през периода по деловодители -------------
//# разлика между общия брой и отваряните през периода 
# разлика между общия брой към края на периода и отваряните през периода 
						$lis3out= array();
foreach($userlist as $userid=>$x2){
//						$lis3out[$userid]= $lis1out[$userid] - $lis2out[$userid];
						$lis3out[$userid]= $lis1out2[$userid] - $lis2out[$userid];
}
//												$suma[4]= $suma[1] - $suma[2];
												$suma[4]= $suma[2] - $suma[3];
												$sumamaxind= 4;
$smarty->assign("DATA3", $lis3out);

#--------- 4. брой собствени дела без движение през периода по деловодители -------------
# включва за периода : 
#     jour - ръчно добавени действия 
#     docu - входени документи 
#     docuout - изходени документи 
#     finance - постъпления 
# ВАЖНО. 
#     не са необходими бройките по отделните елементи, а бройките за всяко дело 
			#------------ 4a. брой ръчно добавени действия - по дела ----------------
/*
			if (isset($stperi)){
$filt4a= "jour.created>='$d1' and jour.created<='$d2'";
			}else{
$filt4a= "year(jour.created)=$year and month(jour.created)=$stmont";
			}
*/
	$filt4a= getfilt("jour.created");
/*
$que4a= "select jour.idcase as idcase
	, count(jour.id) as coun
	from jour
	left join suit on jour.idcase=suit.id
	where $filt4a
	group by idcase
	";
*/
			# 06.10.2010 - 
			# всяко ръчно добавено действие може да има списък с дела, а не само едно 
	$qusub= "select * from jour where $filt4a";
	$que4a= "select joursuit.idcase as idcase, count(t2.id) as coun
		from joursuit
		left join ($qusub) as t2 on joursuit.idjour=t2.id
		left join suit on joursuit.idcase=suit.id
	where t2.id is not null
	group by joursuit.idcase
		";
//print_r($DB->select($que4a));
			#------------ 4b. брой входени документи - по дела ----------------
# ВНИМАНИЕ. един вх.документ - много дела = вх.документ ще бъде размножен 
$filt4b= getfilt("docu.created");
$que4b= "select docusuit.idcase as idcase
	, count(docu.id) as coun
	from docusuit
	left join suit on docusuit.idcase=suit.id
	left join docu on docusuit.iddocu=docu.id
	where $filt4b 
	group by idcase
	";
//print_r($DB->select($que4b));
			#------------ 4c. брой изходени документи - по дела ----------------
# само документи с изх.номер/година 
$filt4c= "docuout.serial<>0 and docuout.year<>0";
$filt4cc= getfilt("docuout.registered");
$que4c= "select docuout.idcase as idcase
	, count(docuout.id) as coun
	from docuout
	left join suit on docuout.idcase=suit.id
	where $filt4c and $filt4cc 
	group by idcase
	";
//print_r($DB->select($que4c));
			#------------ 4d. брой постъпления - по дела ----------------
//$filt4d= "year(finance.time)=$year and month(finance.time)=$stmont";
$filt4d= getfilt("finance.time");
$que4d= "select finance.idcase as idcase
	, count(finance.id) as coun
	from finance
	left join suit on finance.idcase=suit.id
	where $filt4d
	group by idcase
	";
//print_r($DB->select($que4d));
			#------------ 4. общата заявка - по дела ----------------
//$filt4= "year(finance.time)=$year and month(finance.time)=$stmont";
$que4= "select suit.iduser as iduser, suit.id as idcase
	, ta.coun as acoun, tb.coun as bcoun, tc.coun as ccoun, td.coun as dcoun
	from suit
	left join ($que4a) as ta on suit.id=ta.idcase
	left join ($que4b) as tb on suit.id=tb.idcase
	left join ($que4c) as tc on suit.id=tc.idcase
	left join ($que4d) as td on suit.id=td.idcase
	";
//	, cast(ta.coun+tb.coun+tc.coun+td.coun as unsigned) as suma
//where ta.coun<>0 and tb.coun<>0 and tc.coun<>0 and td.coun<>0
//where ta.coun is not null and tb.coun is not null and tc.coun is not null and td.coun is not null
$lis4= $DB->select($que4);
//print_r($lis4);
			#------------ 4. преброяваме делата - по юзери ----------------
			# за всеки юзер - преброяваме делата, по които всички броячи са нулеви 
# обработваме данните 
						$lis4out= array();
foreach($lis4 as $elem){
	$cuuser= $elem["iduser"];
		# ВАЖНО. 
		# $cuuser има стойности NULL -1 0 
		$cuuser= $cuuser+0<=0 ? 0 : $cuuser;
//	$cumont= $elem["mont"];
//	$cucoun= $elem["coun"];
//print_r($elem);
		$sumacoun= $elem["acoun"] + $elem["bcoun"] + $elem["ccoun"] + $elem["dcoun"];
		if ($sumacoun==0){
//print "<br>---------------------OK-------------------";
						$lis4out[$cuuser] += 1;
												$suma[5] += 1;
		}else{
		}
}
												$sumamaxind= 5;
$smarty->assign("DATA4", $lis4out);

#--------- 5. брой изходени документи през периода по деловодители -------------
# само документи с изх.номер/година 
$filt5= "docuout.serial<>0 and docuout.year<>0";
$filt5a= getfilt("docuout.registered");
$que5= "select suit.iduser as iduser
	, count(docuout.id) as coun
	from docuout
	left join suit on docuout.idcase=suit.id
	where $filt5 and $filt5a 
	group by iduser
	";
$lis5= $DB->select($que5);
//print "<br>------ 6 ------<br>";
//print_rr($lis5);

# обработваме данните 
						$lis5out= array();
foreach($lis5 as $elem){
	$cuuser= $elem["iduser"];
		# ВАЖНО. 
		# $cuuser има стойности NULL -1 0 
		$cuuser= $cuuser+0<=0 ? 0 : $cuuser;
//	$cumont= $elem["mont"];
	$cucoun= $elem["coun"];
						$lis5out[$cuuser] += $cucoun;
												$suma[6] += $cucoun;
}
												$sumamaxind= 6;
$smarty->assign("DATA5", $lis5out);
//print "<br>------ 6 ------<br>";
//print_rr($lis5out);
//var_dump($suma[6]);

#--------- 6. брой входени документи по делата на деловодителя през периода по деловодители -------------
# ВНИМАНИЕ. един вх.документ - много дела = вх.документ ще бъде размножен 
//$filt6= "year(docu.created)=$year and month(docu.created)=$stmont";
$filt6= getfilt("docu.created");
$que6= "select suit.iduser as iduser
	, count(docu.id) as coun
	from docusuit
	left join suit on docusuit.idcase=suit.id
	left join docu on docusuit.iddocu=docu.id
	where $filt6 
	group by iduser
	";
$lis6= $DB->select($que6);

# обработваме данните 
						$lis6out= array();
foreach($lis6 as $elem){
	$cuuser= $elem["iduser"];
		# ВАЖНО. 
		# $cuuser има стойности NULL -1 0 
		$cuuser= $cuuser+0<=0 ? 0 : $cuuser;
//	$cumont= $elem["mont"];
	$cucoun= $elem["coun"];
						$lis6out[$cuuser] += $cucoun;
												$suma[7] += $cucoun;
}
												$sumamaxind= 7;
$smarty->assign("DATA6", $lis6out);
//print "<br>LIS6OUT<br>";
//print_rr($lis6out);
//dump($suma[7]);

#--------- 7. брой извършени действия по делата на деловодителя през периода по деловодители -------------
# включва за периода : 
#     jour - ръчно добавени действия 
//#     docu - входени документи [индекс=6] 
#     docuout - изходени документи [индекс=5] 
#     finance - постъпления 
			#------------ 7a. брой ръчно добавени действия ----------------
//$filt7a= "year(jour.created)=$year and month(jour.created)=$stmont";
	$filt7a= getfilt("jour.created");
/*
$que7a= "select suit.iduser as iduser
	, count(jour.id) as coun
	from jour
	left join suit on jour.idcase=suit.id
	where $filt7a
	group by iduser
	";
*/
			# 06.10.2010 - 
			# всяко ръчно добавено действие може да има списък с дела, а не само едно 
	$qusub= "select * from jour where $filt7a";
	$que7a= "select suit.iduser as iduser, count(t2.id) as coun
		from joursuit
		left join ($qusub) as t2 on joursuit.idjour=t2.id
		left join suit on joursuit.idcase=suit.id
	where t2.id is not null
	group by suit.iduser
		";
$lis7a= $DB->select($que7a);

# обработваме данните 
			#------------ 7. общо за 2-та етапа ----------------
						$lis7out= array();
foreach($lis7a as $elem){
	$cuuser= $elem["iduser"];
		# ВАЖНО. 
		# $cuuser има стойности NULL -1 0 
		$cuuser= $cuuser+0<=0 ? 0 : $cuuser;
	$cucoun= $elem["coun"];
						$lis7out[$cuuser] += $cucoun;
												$suma[8] += $cucoun;
}
			#------------ 7b. брой финансови постъпления ----------------
//$filt7b= "year(finance.time)=$year and month(finance.time)=$stmont";
$filt7b= getfilt("finance.time");
$que7b= "select suit.iduser as iduser
	, count(finance.id) as coun
	from finance
	left join suit on finance.idcase=suit.id
	where $filt7b
	group by iduser
	";
$lis7b= $DB->select($que7b);

# обработваме данните 
//						$lis7out= array();
foreach($lis7b as $elem){
	$cuuser= $elem["iduser"];
		# ВАЖНО. 
		# $cuuser има стойности NULL -1 0 
		$cuuser= $cuuser+0<=0 ? 0 : $cuuser;
	$cucoun= $elem["coun"];
						$lis7out[$cuuser] += $cucoun;
												$suma[8] += $cucoun;
}
			#------------ 7. общо за 2-та етапа ----------------
/*
			# добавяме и входените документи [индекс=6] 
			foreach($lis6out as $cuuser=>$elem){
						$lis7out[$cuuser] += $elem;
												$suma[7] += $elem;
			}
*/
			# добавяме и изходените документи [индекс=5] 
			foreach($lis5out as $cuuser=>$elem){
						$lis7out[$cuuser] += $elem;
												$suma[8] += $elem;
			}
												$sumamaxind= 8;
$smarty->assign("DATA7", $lis7out);

#--------- 8. обща СУМА на дълга (БЕЗ периода) по делата на деловодителя по деловодители -------------
# сума, а не брояч 
# ВНИМАНИЕ. 
#    сумата е към настоящия момент, а не към края на избрания месец 
#    без лихвите и без т.26 
#    за месечните суми се взема само 1 брой 
//$filt8= "docuout.serial<>0 and docuout.year<>0";
/*----*/
$filt8= "1";
				# 15.12.2009 - преизчисляваме мес.суми според срока 
				# два етапа и две обработки 
				#     1) досегашната, но без мес.суми - сумарно по деловодители 
				#     2) само мес.суми - не сумарно, а всички мес.суми за всеки деловодител 
$filt8= "subject.idtype<>3";
$que8= "select suit.iduser as iduser
	, sum(subject.amount) as coun
	from subject
	left join suit on subject.idcase=suit.id
	where $filt8 
	group by iduser
	";
$lis8= $DB->select($que8);

# обработваме данните 
						$lis8out= array();
foreach($lis8 as $elem){
	$cuuser= $elem["iduser"];
		# ВАЖНО. 
		# $cuuser има стойности NULL -1 0 
		$cuuser= $cuuser+0<=0 ? 0 : $cuuser;
//	$cumont= $elem["mont"];
	$cucoun= $elem["coun"];
						$lis8out[$cuuser] += $cucoun;
												$suma[9] += $cucoun;
}
				# етап-2 - само мес.суми - не сумарно, а всички мес.суми за всеки деловодител 
$que8a= "select suit.iduser as iduser, subject.amount, subject.fromdate, subject.todate, subject.id as id
	from subject
	left join suit on subject.idcase=suit.id
	where subject.idtype=3
	";
$lis8a= $DB->select($que8a);
//						print $lis8out[1];
foreach($lis8a as $elem){
	$cuuser= $elem["iduser"];
		# ВАЖНО. 
		# $cuuser има стойности NULL -1 0 
		$cuuser= $cuuser+0<=0 ? 0 : $cuuser;
	# изчисляваме общата сума на дълга от мес.сума - без лихвите 
	# = броя на дните /30 * мес.сума 
	# броя на дните = закръгления брой секунди, броя секунди = разликата между врем.щампи 
	//$cucoun= $elem["coun"];
	$toda= $elem["todate"];
//print "<br>".$elem["id"]."=[".$elem["fromdate"]."][$toda]";
	if (empty($toda)){
		$tostam= time();
	}else{
		list($toye,$tomo,$toda)= explode("-",$toda);
		$tostam= mktime(0,0,1  ,$tomo,$toda,$toye);
	}
//print "/tostam=[$tostam]";
	list($fromye,$frommo,$fromda)= explode("-",$elem["fromdate"]);
	$fromstam= mktime(0,0,1  ,$frommo,$fromda,$fromye);
	$secnumber= $tostam - $fromstam;
	# константа - броя на секундите в денонощие 
	$secday= 86400;
	$daynumber= round($secnumber/$secday);
	$cucoun= round($daynumber/30*$elem["amount"] ,2);
//print "<br>".$elem["id"]."=[$cuuser][$daynumber][$cucoun]";
						$lis8out[$cuuser] += $cucoun;
												$suma[9] += $cucoun;
}
//						print $lis8out[1];
				# приключваме глав.етап 8 
												$sumamaxind= 9;
$smarty->assign("DATA8", $lis8out);
/*****/

#--------- 9. обща събрана СУМА през периода по делата на деловодителя по деловодители -------------
#--------- 10. събрана СУМА за ЧСИ през периода по делата на деловодителя по деловодители -------------
# сума, а не брояч - в единна заявка 
# ВНИМАНИЕ. 
#    желаното разпределение е а)по делата и б)по такси и разноски, но са необходими доп.уточнения 
//$filt9= "year(finance.time)=$year and month(finance.time)=$stmont";
									/*
									# 15.04.2010 - Бъзински - влизат само : 
									#    тип=1 - банка, само ако има връзка с банк.постъпления 
									#    тип=2 - в-брой 
									$typefilt= "(finance.idtype=2 or finance.idtype=1 and finasource.id is not null)";
									$typelink= "left join finasource on finasource.idfinance=finance.id";
									*/
						include_once "stmont.inc.php";
$filt9= getfilt("finance.time");
$que9= "select suit.iduser as iduser
	, sum(finance.inco) as coun
	, sum(finance.separa+finance.separa2) as coun2
	from finance
	left join suit on finance.idcase=suit.id
									$typelink
	where $filt9 
									and $typefilt
	group by iduser
	";
$lis9= $DB->select($que9);
//print_rr($lis9);

# обработваме данните 
						$lis9out= array();
						$lis10out= array();
foreach($lis9 as $elem){
	$cuuser= $elem["iduser"];
		# ВАЖНО. 
		# $cuuser има стойности NULL -1 0 
		$cuuser= $cuuser+0<=0 ? 0 : $cuuser;
//	$cumont= $elem["mont"];
	$cucoun= $elem["coun"];
						$lis9out[$cuuser] += $cucoun;
												$suma[10] += $cucoun;
	$cucoun2= $elem["coun2"];
						$lis10out[$cuuser] += $cucoun2;
												$suma[11] += $cucoun2;
}
												$sumamaxind= 11;
$smarty->assign("DATA9", $lis9out);
$smarty->assign("DATA10", $lis10out);
//print_rr($lis9out);

#---------------------------------------------------------------------------------

												# формираме масив със сумите с плътни индекси 
															$arsuma= array();
												for($indx=1; $indx<=$sumamaxind; $indx++){
															$arsuma[$indx]= $suma[$indx];
												}
												$smarty->assign("ARSUMA", $arsuma);
												//$smarty->assign("SUMAMAXIND", $sumamaxind);
//print_rr($suma);
//print_rr($arsuma);
//var_dump($sumamaxind);
#---------------------------------------------------------------------------------

# линк за отпечатване на текущата страница 
//		$baseurl= "mode=".$mode."&page=".$page."&year=".$year;
			if (isset($stperi)){
		$baseurl= "mode=".$mode."&peri=".$d1."^".$d2;
			}else{
		$baseurl= "mode=".$mode."&year=".$year."&mont=".$stmont;
			}
$curint= geturl($baseurl."&print=yes");
$smarty->assign("CURINT", $curint);

# линкове за деловодителите 
			$userlink= array();
									# и за 2-рия линк - бонуси 
									$userlink2= array();
foreach($userlist as $usin=>$x2){
			$userlink[$usin]= geturl($baseurl."&user=".$usin);
									$userlink2[$usin]= geturl($baseurl."&user=".$usin);
}
$smarty->assign("USERLINK", $userlink);
									$smarty->assign("USERLINK2", $userlink2);
									
# флага за отпечатване 
$prinyes= $GETPARAM["print"];
$flprin= ($prinyes=="yes");
$smarty->assign("FLPRIN", $flprin);
						
						if ($flprin){
# изход в Excel 
$cont= smdisp("stmont.tpl","fetch");
//ExcelHeader("статистика-$stmont-$year.xls");
			if (isset($stperi)){
$sttext= "период";
			}else{
$sttext= "$stmont-$year";
			}
ExcelHeader("статистика-$sttext.xls");
	$outp= "
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\" />
<body>
	$cont
</body>
</html>
	";
//<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
//print $cont;
print $outp;
//exit;
						}else{
# извеждаме 
//$smarty->assign("ADDNEW", $addnew);
//$smarty->assign("LIST", $mylist);
$pagecont= smdisp("stmont.tpl","fetch");
						}

?>
