<?php
# отчет раздел 2 - етап 1 подготовка 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $vari - текущия режим на вторичното меню 
# още отгоре : 
#    $period - периода за отчета 
#    $tarepo - име на таблицата за периода 
#       $temp1/$temp2 - таблици с посл.статуси преди/през периода 
#       $temp3 - таблица с предметите 
#    $peyear, $pemon1, $pemon2 - година, нач, краен месец 
#    $yemon1, $yemon2 - за MySQL нач.краен година-месец yyyy-mm 
//print_rr($GETPARAM);

ini_set("memory_limit","128M");

											# 05.07.2013 - разделено на стъпки заради времето 
											$step= $GETPARAM["step"];
//print_rr($GETPARAM);
											if (isset($step)){
											}else{
												$step= 0;
											}
						$nextstep= $step +1;
//var_dump($nextstep);
//#					$smarty->assign("STEP", $step);
					$smarty->assign("STEP", $nextstep);
						$nextbase= "mode=".$mode."&period=".$period."&vari=".$vari;
						$urlnextstep= geturl($nextbase."&step=".$nextstep);
					$smarty->assign("NEXTURL", $urlnextstep);

											if ($step==0){

//#					$smarty->assign("NODISPLAY", true);

											}elseif ($step==1){

# нови таблици : YEMO_befo YEMO_duri
# по дела - последен статус преди и през периода 
//+++$qucode= "select idcase as ARRAY_KEY, idstat, max(time) as timestat from suitstathist where [FILT] group by idcase";
		//+++$qucode= "select idcase, idstat, max(time) as timestat from suitstathist where [FILT] group by idcase";
		$qucode= "select idcase, max(concat(time,'^',idstat)) as timestat from suitstathist where [FILT] group by idcase";
$fibefo= "substring(time,1,7)<'$yemon1'";
$fiduri= "substring(time,1,7)>='$yemon1' and substring(time,1,7)<='$yemon2'";
$qubefo= str_replace("[FILT]",$fibefo,$qucode);
$quduri= str_replace("[FILT]",$fiduri,$qucode);
//+++$listbefo= $DB->select($qubefo);
		//$temp1= $tarepo."_befo";
		//$temp2= $tarepo."_duri";
		//$temp3= $tarepo."_subj";
//print "<br>[$temp1][$temp2]";
/*
		$DB->query("drop table if exists `$temp1`");
		$DB->query("create table `$temp1` $qubefo");
//print_rr($listbefo);
//+++$listduri= $DB->select($quduri);
		$DB->query("drop table if exists `$temp2`");
		$DB->query("create table `$temp2` $quduri");
//print_rr($listduri);
*/
		creafrom("20_befo", $temp1, "/*temporary*/");
$DB->query("insert into `$temp1` $qubefo");
		creafrom("20_befo", $temp2, "/*temporary*/");
$DB->query("insert into `$temp2` $quduri");
											
											}elseif ($step==2){

# нова таблица : YEMO 
# извадка за всички дела 
			$codetitu= "";
foreach($timerep2 as $indx=>$elem){
			$codetitu .= "when $indx then $elem ";
}
$codetitu= "case idtitu $codetitu else 0 end";
//var_dump($codetitu);
//$listfiel= "idcase,serial,year,iduser,created,idrepo";
//$listfi2= "id as idcase,serial,year,iduser,created,idrepo";
////$listfiel= "idcase,serial,year,iduser,created,idrepo  ,idtitu,voludays,voluenddate";
////$listfi2= "id as idcase,serial,year,iduser,created,idrepo  ,idtitu ,$codetitu as voludays ,adddate(date(created),voludays) as voluenddate";
$listfiel= "idcase,serial,year,iduser,created,idrepo  ,idtitu,voludays";
$listfi2= "id as idcase,serial,year,iduser,created,idrepo  ,idtitu ,$codetitu as voludays";
		creafrom("20_rep2", $tarepo, "");
$DB->query("insert into `$tarepo` ($listfiel) select $listfi2 from suit");
$DB->query("update `$tarepo` set voluenddate=adddate(date(created),voludays)");
# зареждаме последните статуси 
/*+++
$DB->query("update `$tarepo` as t1
	left join `$temp1` as t2befo on t1.idcase=t2befo.idcase
	left join `$temp2` as t2duri on t1.idcase=t2duri.idcase
	set 
	t1.statbefo=t2befo.idstat
	,t1.timebefo=t2befo.timestat
	,t1.statduri=t2duri.idstat
	,t1.timeduri=t2duri.timestat
	");
+++*/
$DB->query("update `$tarepo` as t1
	left join `$temp1` as t2befo on t1.idcase=t2befo.idcase
	left join `$temp2` as t2duri on t1.idcase=t2duri.idcase
	set 
	t1.statbefo=substring(t2befo.timestat,21)
	,t1.timebefo=substring(t2befo.timestat,1,19)
	,t1.statduri=substring(t2duri.timestat,21)
	,t1.timeduri=substring(t2duri.timestat,1,19)
	");
											
											}elseif ($step==3){

# зареждаме флагове за невключените дела 
$code1er= "idrepo not in ($mycoderotype)";
$code2er= "statbefo in ($mycodestat)";
$code3er= "substring(created,1,7)>'$yemon2'";
//$code4er= "c1full=''";
//$codeider= "iderror=(case when $code1er then 1 when $code2er then 2 when $code3er then 3 when $code4er then 4 else iderror end)";
$codeider= "iderror=(case when $code1er then 1 when $code2er then 2 when $code3er then 3 else iderror end)";
$DB->query("update `$tarepo` set $codeider");

# нова таблица : YEMO_subj 
# предметите : - само по изп.дела, само за включените дела, само за неприсъед.взискател 
# отгоре филтри за табл.subject : 
#    $filtsubj1 - типа/подтипа да са по изп.лист - за кол.1 и 2 
#    $filtsubj2 - само включените дела 
#    $filtsubj3 - само предмети с НЕприсъединен взискател 
/*
	# филтър : типа/подтипа да са по изп.лист - за кол.1 и 2 
	$filtsubj1= "subject.idtype in (1,3,5) or subject.idtype=2 and subject.idsubtype=4";
	# филтър : само включените дела 
//	$filtsubj2= "`$tarepo`.idcase is not null";
	$filtsubj2= "`$tarepo`.iderror=0";
	# филтър : само предмети с НЕприсъединен взискател 
	$filtsubj3= "claimer.isjoin=0";
*/
											
											}elseif ($step==4){

#-----------------------------------------------------------------------------------------------------------
# 08.07.2013 
												$grou= $GETPARAM["grou"];
												if (isset($grou)){
															$grcoun= 20000;
															$grbegi= ($grou-1)*$grcoun;
$lis4= $DB->select("
	select subject.id as idsubj, subject.idcase, subject.idtype, subject.idsubtype
		, subject.amount, subject.fromdate, subject.todate, subject.idclaimer
		, claimer.isjoin, subject.amount as rep2amou
	from subject 
		left join `$tarepo` on subject.idcase=`$tarepo`.idcase
		left join claimer on subject.idclaimer=claimer.id
	where ($filtsubj1) and ($filtsubj2) and ($filtsubj3)
												limit $grbegi,$grcoun
	");
foreach($lis4 as $elem){
	$DB->query("insert into `$temp3` set ?a"  ,$elem);
}
//print "<br>lis4=$grou=$grbegi=".count($lis4);
													if (empty($lis4)){
//					$smarty->assign("NODISPLAY", true);
													}else{
/*
						$nextgrou= $grou +1;
					$smarty->assign("GROU", $grou);
						$urlnextgrou= geturl($nextbase."&step=".$step."&grou=".$nextgrou);
					$smarty->assign("NEXTURL", $urlnextgrou);
*/
					nextgrou($nextbase,$step,$grou);
													}
												}else{
//#													$grou= 1;
													$grou= 0;
		creafrom("20_subj", $temp3, "/*temporary*/");
					nextgrou($nextbase,$step,$grou);
												}
#-----------------------------------------------------------------------------------------------------------
//															$grcoun= 20000;
//															$grbegi= ($grou-1)*$grcoun;

/***
$qusubj= "
	select subject.id as idsubj, subject.idcase, subject.idtype, subject.idsubtype
		, subject.amount, subject.fromdate, subject.todate, subject.idclaimer
		, claimer.isjoin, subject.amount as rep2amou
	from subject 
		left join `$tarepo` on subject.idcase=`$tarepo`.idcase
		left join claimer on subject.idclaimer=claimer.id
	where ($filtsubj1) and ($filtsubj2) and ($filtsubj3)
												limit $grbegi,$grcoun
	";
***/
//////////////////////////		creafrom("20_subj", $temp3, "/*temporary*/");
/*****
$codep2= "
	from subject 
		left join `$tarepo` on subject.idcase=`$tarepo`.idcase
		left join claimer on subject.idclaimer=claimer.id
	where ($filtsubj1) and ($filtsubj2) and ($filtsubj3)
												limit $grbegi,$grcoun
	";
					$ardata4= $DB->selectCol("select subject.id $codep2");
					$coun4= count($ardata4);
var_dump($grou);
var_dump($coun4);
$qusubj= "
	select subject.id as idsubj, subject.idcase, subject.idtype, subject.idsubtype
		, subject.amount, subject.fromdate, subject.todate, subject.idclaimer
		, claimer.isjoin, subject.amount as rep2amou
$codep2
	";
$DB->query("insert into `$temp3` $qusubj");
$lis4= $DB->select("
	select subject.id as idsubj, subject.idcase, subject.idtype, subject.idsubtype
		, subject.amount, subject.fromdate, subject.todate, subject.idclaimer
		, claimer.isjoin, subject.amount as rep2amou
	from subject 
		left join `$tarepo` on subject.idcase=`$tarepo`.idcase
		left join claimer on subject.idclaimer=claimer.id
	where ($filtsubj1) and ($filtsubj2) and ($filtsubj3)
												limit $grbegi,$grcoun
	");
foreach($lis4 as $elem){
	$DB->query("insert into `$temp3` set ?a"  ,$elem);
}
												if (empty($lis4)){
					$smarty->assign("NODISPLAY", true);
												}else{
					nextgrou($nextbase,$step,$grou);
												}
*****/

											}elseif ($step==5){

#-----------------------------------------------------------------------------------------------------------
# 08.07.2013 
												$grou= $GETPARAM["grou"];
												if (isset($grou)){
															$grcoun= 5000;
															$grbegi= ($grou-1)*$grcoun;
# четем поредната група id на дела 
$arcase= $DB->selectCol("
	select distinct `$temp3`.idcase 
	from `$temp3`
	order by `$temp3`.idcase 
												limit $grbegi,$grcoun
	");
													if (empty($arcase)){
//					$smarty->assign("NODISPLAY", true);
													}else{
					$codecase= implode(",",$arcase);
# четем избраните предмети - по дела 
$lis3= $DB->select("
	select `$temp3`.idcase as ARRAY_KEY1, `$temp3`.idsubj as ARRAY_KEY2
		, `$temp3`.*, `$tarepo`.created as casecrea
	from `$temp3`
		left join `$tarepo` on `$temp3`.idcase=`$tarepo`.idcase
					where `$temp3`.idcase in ($codecase)
	");
//print "<br>lis3=$grou=$grbegi=".count($lis3);
# попълваме дълж.суми - колони c1full, c2 - според кога е образувано делото 
foreach($lis3 as $idcase=>$ar1){
//print_rr($ar1);
/***
	list($fusuma,$casecrea)= calcfusuma($ar1);
	$creabefo= substr($casecrea,0,7)<"$yemon1";
//print "<br>$idcase=".$casecrea."=".$yemon1;
//var_dump($creabefo);
***/
	list($fusuma,$debtfiname)= calcfusuma($ar1);
		$aridca= array_keys($ar1);
		$idca1= $aridca[0];
		$casecrea= $ar1[$idca1]["casecrea"];
	$creabefo= substr($casecrea,0,7)<"$yemon1";
	if ($creabefo){
		$finame= "c1full";
	}else{
		$finame= "c2";
	}
//print "<br>idcase=[$idcase]fusuma=[$fusuma]debtfiname=[$debtfiname]casecrea=[$casecrea]finame=[$finame]";
	$DB->query("update `$tarepo` set $finame='$fusuma' where idcase=$idcase");
}
					nextgrou($nextbase,$step,$grou);
													}
												}else{
//#													$grou= 1;
													$grou= 0;
					nextgrou($nextbase,$step,$grou);
												}
#-----------------------------------------------------------------------------------------------------------
												/*
												$grou= $GETPARAM["grou"];
												if (isset($grou)){
												}else{
													$grou= 1;
												}
															$grcoun= 20000;
															$grbegi= ($grou-1)*$grcoun;
												*/

/*
# четем избраните предмети - по дела 
$lis3= $DB->select("
	select `$temp3`.idcase as ARRAY_KEY1, `$temp3`.idsubj as ARRAY_KEY2
		, `$temp3`.*, `$tarepo`.created as casecrea
	from `$temp3`
		left join `$tarepo` on `$temp3`.idcase=`$tarepo`.idcase
	");
# попълваме дълж.суми - колони c1full, c2 - според кога е образувано делото 
foreach($lis3 as $idcase=>$ar1){
//print_rr($ar1);
	list($fusuma,$casecrea)= calcfusuma($ar1);
	$creabefo= substr($casecrea,0,7)<"$yemon1";
//print "<br>$idcase=".$casecrea."=".$yemon1;
//var_dump($creabefo);
	if ($creabefo){
		$finame= "c1full";
	}else{
		$finame= "c2";
	}
	$DB->query("update `$tarepo` set $finame='$fusuma' where idcase=$idcase");
}
*/
//print "<br>aaaaaaaaaaaaaaaaaaaaaaaaa";
//var_dump($grbegi);
												/*****
# четем избраните предмети - по дела 
$lis3= $DB->select("
	select `$temp3`.idcase as ARRAY_KEY1, `$temp3`.idsubj as ARRAY_KEY2
		, `$temp3`.*
		, `$tarepo`.created as casecrea
		, $mycodefielname as debtfiname
	from `$temp3`
		left join `$tarepo` on `$temp3`.idcase=`$tarepo`.idcase
												limit $grbegi,$grcoun
	");
//print "<br>count-lis3=".count($lis3);
//print_rr($lis3);
//print "<br>bbbbbbbbbbbbbbbbbbbbbbbb";
# попълваме за всяко дело общо дълж.суми - колони c1full, c2 - според кога е образувано делото 
foreach($lis3 as $idcase=>$ar1){
//print_rr($ar1);
	list($fusuma,$debtfiname)= calcfusuma($ar1);
	$DB->query("update `$tarepo` set $debtfiname='$fusuma' where idcase=$idcase");
}
var_dump($grou);
var_dump(count($lis3));
												if (empty($lis3)){
					$smarty->assign("NODISPLAY", true);
												}else{
					nextgrou($nextbase,$step,$grou);
												}
												*****/

											}elseif ($step==6){

//print "<br>ccccccccccccccccccccc";
# зареждаме отделен флаг за невключените дела - за грешка=4 няма дълж.суми 
$code4er= "c1full='' and c2=''";
$DB->query("update `$tarepo` set iderror=4 where iderror=0 and $code4er");

/*
#-------------------------- постъпления ---------------------------------
# нова таблица : YEMO_fina 
# постъпленията : - само приключените, само за включените дела, [??????? само за неприсъед.взискател] 
# отгоре филтри за табл.subject : 
#    $filtfina1 - само приключените погасявания 
#    $filtfina2 - само за включените дела 
//#    $filtfina3 - само за предмети с НЕприсъединен взискател 

$qufina= "
	select finance.id as idfina, finance.idcase
		, finance.inco, finance.toclai, finance.timeclosed, finance.dateinco
	from finance 
		left join `$tarepo` on finance.idcase=`$tarepo`.idcase
	where ($filtfina1) and ($filtfina2) and ($filtfina3)
	";
$listfina= "idfina,idcase,inco,toclai,timeclosed,dateinco";
//$listfina2= "id as idcase,serial,year,iduser,created,idrepo";
		creafrom("20_fina", $temp4, "");
$DB->query("insert into `$temp4` ($listfina) $qufina");
#-------------------------- край постъпления ---------------------------------
*/

											}elseif ($step==7){

											}else{
//print "EEEEEEEEEEEEEEND";
					$smarty->assign("ISEND", true);
											}


# извеждаме 
$rep2cont= smdisp("rep2v1.tpl","fetch");



/*
function creafrom($tasour,$taresu,$extra=""){
global $DB;
//print "<br>creafrom=[$tasour][$taresu]";
	$arctab= $DB->query("show create table `$tasour`");
	$ctcode= $arctab[0]["Create Table"];
//print_rr($arctab);
//var_dump($ctcode);
	$DB->query("drop table if exists `$taresu`");
//	$DB->query("create $extra table `$taresu` select * from `$tasour`");
	$ctcode= str_replace("`$tasour`","`$taresu`",$ctcode);
	$DB->query($ctcode);
}
*/

# сумарен дълг по изп.лист от предметите за дадено дело 
function calcfusuma($ardata){
global $arcodemont;
					$suma= 0;
		$debtfiname="";
	foreach($ardata as $idsubj=>$elem){
//////print_rr($elem);
		$debtfiname= $elem["debtfiname"];
		$ismont= in_array($elem["idtype"],$arcodemont);
		if ($ismont){
			# месечен дълг 
			$sumont= calcmont($elem);
global $DB, $temp3;
$DB->query("update `$temp3` set rep2amou=? where idsubj=?d"  ,$sumont,$idsubj);
					$suma += $sumont;
		}else{
			# НЕ месечен дълг 
					$suma += $elem["amount"];
		}
	}
return array($suma,$debtfiname);
}


# изислява сумарен дълг по месечните типове 
function calcmont($elem){
global $yemon2;
//print "==MONTHLY";
			# нач.дата на дълга 
			$date1= trim($elem["fromdate"]);
			if (empty($date1)){
				$date1= $elem["casecrea"];
			}else{
			}
			# крайна дата на периода 
			list($ye2,$mo2)= explode("-",$yemon2);
			if ($mo2==6){
				$da2= 30;
			}elseif ($mo2==12){
				$da2= 31;
			}else{
die("rep2v1=$yemon2");
			}
			$date2peri= "$ye2-$mo2-$da2";
			# крайна дата на дълга 
			$date2= trim($elem["todate"]);
			if (empty($date2)){
				$date2= $date2peri;
			}else{
				$date2= ($date2<=$date2peri) ? $date2 : $date2peri;
			}
//print "dates=[$date1][$date2]";
		# брой цели месеци за дълга 
		list($ye1,$mo1,$da1)= explode("-",$date1);
		list($ye2,$mo2,$da2)= explode("-",$date2);
		$cmon1= 12*$ye1 + $mo1;
		$cmon2= 12*$ye2 + $mo2;
		$mocoun= $cmon2 - $cmon1 -1;
//print "mocoun=[$cmon1][$cmon2][$mocoun]";
		# сумите 
		$montam= $elem["amount"];
		$sum1= sumreduce($montam,$date1,"toend");
		$sum2= $mocoun * $montam;
		$sum3= sumreduce($montam,$date2,"frombegin");
		$resu= $sum1 +$sum2 +$sum3;
//print "sumas= [$sum1][$sum2][$sum3][$resu]";
return $resu;
}


?>
