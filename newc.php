<?php
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
# източник : docu.php - входящи документи 

# ВНИМАНИЕ. 
# 17.08.2009 - Софрониев - включваме и делата с iduser=-1 - във всички заявки ! 

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

# текущата страница 
//print_r($GETPARAM);
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

# 22.05.2009 - Бъзински - разделение по години 
# годината  
	unset($listyear[0]);
	$arke= array_keys($listyear);
$year= $GETPARAM["year"];
$year= isset($year) ? $year : $arke[0];
$smarty->assign("YEAR", $year);
//var_dump($year);

# 03.06.2009 - флаг - дали след вземане на дело да премине директно към въвеждане на основ.данни 
$ofro= getofficerow(0);
$isdirect= $ofro["isdirect"];
//var_dump($isdirect);

# 23.04.2009 - Бургас - директно въвеждане/корекция на дело - за стари дела 
									$edit= $GETPARAM["edit"];
									if (isset($edit)){
										include_once "newc.ajax.php";
										exit;
									}else{
									}
# 03.06.2009 - флаг - дали след вземане на дело да премине директно към въвеждане на основ.данни 
# само назначаваме деловодител на делото без въвеждане на основ.данни 
									$getcase= $GETPARAM["getcase"];
									if (isset($getcase)){
$DB->query("update suit set iduser=?d, lastdocu=now() where id=?d" ,$iduser,$getcase);
									}else{
									}
			# 29.05.2009 - Бъзински - вземане на група дела 
$prefmult= "group";
$smarty->assign("PREFMULT", $prefmult);
			foreach($_POST as $pona=>$x2){
				if (strpos($pona,$prefmult)===0){
					$idmult= substr($pona,strlen($prefmult));
					$DB->query("update suit set iduser=?d, lastdocu=now() where id=?d" ,$iduser,$idmult);
				}else{
				}
			}
//print_r($_POST);

											# вариант на заявката 
											$quvari= 0;

#---------------------------------------------------------------------------------
# 02.06.2009 - филтър - текст за търсене в документите само за свободните дела 
# източници : 
#     fdtx.php - търсене на вх.документ по текст 
#     fdxxlist.php - извежда списък вх.документи - за всички филтри 
$textfilt= $_POST["textfilt"];
//print "filter=[$textfilt]";
//if (empty($textfilt)){
//}else{
$mark= "textfilt";
if (strpos($textfilt,$mark)===0){
		# нормализираме стринга за текущия филтър 
		$textfilt= substr($textfilt,strlen($mark));
		$_POST["textfilt"]= $textfilt;
											# вариант на заявката 
											if (empty($textfilt)){
												$quvari= 0;
											}else{
												$quvari= 1;
											}
		# нулираме стринга за другия филтър 
		$freeserifilt= "";
		$_POST["freeserifilt"]= "";
					# ВАЖНО. 
					# 1. правим две, а не една трансформация - за MySQL-dbsimple и за like 
					# 2. заместваме с функцията sprintf - тя екранира коректно и двата вида кавички 
					$text1= $textfilt;
					$text2= mysql_real_escape_string($text1);
					$text3= mysql_real_escape_string($text2);
					$text4= "%" .$text3 ."%";
					# елементи на филтъра 
					# - за описанието 
					$eltext= sprintf("upper(%s) like upper('%s')"  ,"docu.text",$text4);
					# - за подател 
					$elfrom= sprintf("upper(%s) like upper('%s')"  ,"docu.from",$text4);
					# - за бележки 
					$elnotes= sprintf("upper(%s) like upper('%s')"  ,"docu.notes",$text4);
		# филтъра за документите 
		$filtdocu= "$eltext or $elfrom or $elnotes";
		# филтъра за делата 
		$filtcase= "suit.iduser<=0 and suit.year='$year'";
		# създаваме временна таблица 
		# съдържа suit.id на делата, които са свободни 
		# и имат поне един документ, който отговаря на текстовия филтър
		$tempname= md5(microtime());
		$qudocusuit= "select distinct suit.id as caseid
			from docusuit
				left join docu on docusuit.iddocu=docu.id
				left join suit on docusuit.idcase=suit.id
			where $filtdocu and $filtcase
			";
		$DB->query("create temporary table `$tempname` $qudocusuit");
}else{
}
#---------------------------------------------------------------------------------

#---------------------------------------------------------------------------------
# 14.08.2009 - Софрониев - филтър - търсене в делата по номер от-до за тек.година 
$freeserifilt= $_POST["freeserifilt"];
//print "filter=[$textfilt]";
$mark= "freeserifilt";
if (strpos($freeserifilt,$mark)===0){
		# нормализираме стринга за текущия филтър 
		$freeserifilt= substr($freeserifilt,strlen($mark));
		$_POST["freeserifilt"]= $freeserifilt;
											# вариант на заявката 
											if (empty($freeserifilt)){
												$quvari= 0;
											}else{
												$quvari= 2;
											}
		# нулираме другия филтър 
		$textfilt= "";
		$_POST["textfilt"]= "";
				# анализ на филтъра 
				list($ser1,$ser2)= explode("-",$freeserifilt);
				$ser1= $ser1 +0;
				$ser2= $ser2 +0;
				$ser2= ($ser2==0) ? $ser1 : $ser2;
		# филтър за номерата 
		$filtseri= "serial>=$ser1 and serial<=$ser2";
}else{
}
#---------------------------------------------------------------------------------


# 22.05.2009 - Бъзински - разделение по години 
# масива с линкове за годините 
	$baseurl= "mode=".$mode;
		$yearli= array();
foreach ($listyear as $cuyear){
		$yearli[$cuyear]= geturl($baseurl."&year=".$cuyear);
}
$smarty->assign("YEARLIST", $yearli);

#-----------------------------------------------------------------------------------------
# 05.03.2009 нова концепция 
# водеща таблица е делата, а не документите 
# източник : caseall.php, case.php 
					# 18.02.2009 
					# променен филтър за документ за ново дело - делото съществува, но няма юзер 
//$query= "select * from suit where iduser=0 order by year desc, serial desc";
//$query= "select * from suit where iduser=0 order by year, serial";
# 22.05.2009 - Бъзински - разделение по години 
//if (empty($textfilt)){
//if (empty($textfilt) and empty($serifilt)){
											# според варианта на заявката 
if ($quvari==0){
	$query= "select * from suit where iduser<=0 and year='$year' order by year, serial";
}elseif ($quvari==1){
	# 02.06.2009 - филтър - текст за търсене в документите само за свободните дела 
	$query= "select *, suit.id as id 
		from suit
				left join `$tempname` as t2 on suit.id=t2.caseid
		where iduser<=0 and year='$year' 
				and t2.caseid is not null
		order by suit.year, suit.serial
		";
}elseif ($quvari==2){
	$query= "select * from suit where iduser<=0 and year='$year' and $filtseri order by year, serial";
}else{
die("newc=1=$quvari");
}
//var_dump($quvari);
//var_dump($query);
		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
		$prefurl= "";
//		$baseurl= "mode=".$mode;
//		$baseurl= "mode=".$mode  ."&page=".$page;
# 22.05.2009 - Бъзински - разделение по години 
		$baseurl= "mode=".$mode ."&year=".$year ."&page=".$page;
		$obpagi= new paginator(20, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);
//print_r($mylist);

							#-----------------------------------------------------------------------------------------------
							# 22.05.2009 - Бъзински - за бърза навигация - 
							# $page = текущата страница 
							# допълнителен списък с линкове към страници напред и назад от текущата със стъпка $pagestep 
							# $pagecoun - дължина на списъка в двете посоки 
							# източник : класа pagi.class.php 
							$pagestep= 4;
							$pagecoun= 5;
												$navilist= array();
							for ($i=-$pagecoun; $i<=$pagecoun; $i++){
								$cupa= $page + $i*$pagestep;
//print "====[$cupa][$obpagi->totpag]";
								if ($cupa>=1 and $cupa<=$obpagi->totpag){
									$begi= ($cupa-1) * $obpagi->perpage;
									$limi= "limit $begi,1";
									$myro= $DB->select($obpagi->quex ." ".$limi);
									$myse= $myro[0]["serial"];
//print "=[$cupa][$myse]";
												# индекс= началния.сер.номер на страницата 
												# съдърж= линка към страницата 
												# PANONAME вече е дефинирано 
												$navilist[$myse]= $prefurl .geturl($baseurl."&".PANONAME."=$cupa");
								}else{
								}
							}
							$smarty->assign("NAVILIST", $navilist);
							$smarty->assign("CURRSERI", $mylist[0]["serial"]);
							#-----------------------------------------------------------------------------------------------

# трансформираме го - параметри за иконите 
//				$modeel= "mode=".$mode;
				# фиксираме зона=1 и модификация 
//				$modeel= "zone=1&func=modi";
				$modeel= "zone=1&func=modi" ."&page=".$page;
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
					# 18.02.2009 
					# вече има създадено дело и е свързано с този документ 
					# делото няма назначен юзер, ще назначим логнатия 
					# ВНИМАНИЕ. 
					#    1. префикса вече е символа @, а не минус, защото docu.idcase= -1 е за стари дела 
					#    2. предаваме suit.id, а не docu.id 
	$mylist[$uskey]["newcase"]= geturl($modeel."&edit="."@".$idcurr);
# 03.06.2009 - флаг - дали след вземане на дело да премине директно към въвеждане на основ.данни 
//print "[$isdirect]";
if ($isdirect==0){
}else{
	unset($mylist[$uskey]["newcase"]);
	$mylist[$uskey]["getcase"]= geturl($modeel."&getcase=".$idcurr);
}
			# само заради Бургас -  корекция за номер, година, дата 
	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
			# списък на входящите документи за текущото дело 
			# НЕЕФЕКТИВНО - циклична заявка към БД 
//			$ardocu= $DB->select("select * from docu where idcase=?", $idcurr);
/*
						# 13.04 2009 - един документ - много дела 
						$ardocu= $DB->select("
					select docu.*, docu.id as id
					from docusuit
					left join docu on docusuit.iddocu=docu.id
					where docusuit.idcase=?
						", $idcurr);
			$ardocu= dbconv($ardocu);
*/
						# 13.04 2009 - един документ - много дела 
						# получаваме всички данни за документите по това дело 
						$ardocu= get_docu_of_case($idcurr);
	$mylist[$uskey]["listdocu"]= $ardocu;
/**/
			# ЛЕПЕНКА - заради предварително създадените празни дела 
			# засега нямат документи - създаваме по 1 празен документ 
			if (count($ardocu)==0){
//	$mylist[$uskey]["listdocu"]= array(array("serial"=>"x", "year"=>"x"));
	$mylist[$uskey]["listdocu"]= array(array("serial"=>"", "year"=>""));
			}else{
			}
/**/
//	$mylist[$uskey]["coundocu"]= count($ardocu);
}
//print_r($mylist);
#-----------------------------------------------------------------------------------------


# 23.04.2009 - Бургас - директно въвеждане на дело - за стари дела 
# add new link 
$addnew= geturl($modeel."&edit=0");

# извеждаме 
$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("newc.tpl","fetch");

?>
