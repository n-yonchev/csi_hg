<?php
# извеждане на ИЗходящ регистър 
# източник : 
#    dore.php - извеждане на входящ регистър 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
//print_r($GETPARAM);

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];
											# 18.08.2014 - връчване 
											if ($ISPOST){
												include_once "deli.inc.php";
												//deliinfo($codein);
											}else{
											}

# текущата страница 
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

# годината  
	unset($listyear[0]);
	$arke= array_keys($listyear);
$year= $GETPARAM["year"];
$year= isset($year) ? $year : $arke[0];
$smarty->assign("YEAR", $year);
//var_dump($year);

									/*
									# корекция на избран запис 
									$edit= $GETPARAM["edit"];
									if (isset($edit)){
										include_once "oureedit.ajax.php";
										exit;
									}else{
									}
									*/

# датата или периода 
$date= $GETPARAM["date"];
$date= isset($date) ? $date : "";
$date2= $GETPARAM["date2"];
$date2= isset($date2) ? $date2 : "";
# и другите елементи на филтъра 
$adre= $GETPARAM["adre"];
$adre= isset($adre) ? $adre : "";
$bele= $GETPARAM["bele"];
$bele= isset($bele) ? $bele : "";
//print "oure=[$date][$date2][$adre][$bele]";


$mode4= "mode=".$mode."&page=".$page."&year=".$year."&date=".$date."&date2=".$date2  ."&adre=".$adre."&bele=".$bele;
$relurl= geturl($mode4);
									
									# корекция на избран запис 
									$edit= $GETPARAM["edit"];
									if (isset($edit)){
										include_once "oureedit.ajax.php";
										exit;
									}else{
									}
									
									# избор на дата 
									$func= $GETPARAM["func"];
									if ($func=="get"){
//				include_once "doredate.ajax.php";
				include_once "ouredate.ajax.php";
exit;
									}else{
									}
									# всички записи без дата 
									//$func= $GETPARAM["func"];
									if ($func=="all"){
				$date= "";
				$date2= "";
				$adre= "";
				$bele= "";
									}else{
									}

# флага за отпечатване 
$prinyes= $GETPARAM["print"];
$flprin= ($prinyes=="yes");
$smarty->assign("FLPRIN", $flprin);

# масива с линкове за годините 
	$baseurl= "mode=".$mode;
		$yearli= array();
foreach ($listyear as $cuyear){
		$yearli[$cuyear]= geturl($baseurl."&year=".$cuyear);
}
$smarty->assign("YEARLIST", $yearli);

# допълнителен филтър за дата, ако е избрана 
/*
if (empty($date)){
		$filtdate= "1";
}else{
	if (empty($date2)){
		$filtdate= "date(docuout.created)='$date'";
	}else{
		$filtdate= "date(docuout.created)>='$date' and date(docuout.created)<='$date2'";
	}
}
*/
if (empty($date)){
		$filtdate= "1";
}else{
	if (empty($date2)){
		$bgdate= bgdateto($date);
		$filtdate= "date(docuout.registered)='$bgdate'";
	}else{
		$bgdate= bgdateto($date);
		$bgdate2= bgdateto($date2);
		$filtdate= "date(docuout.registered)>='$bgdate' and date(docuout.registered)<='$bgdate2'";
	}
}

# още елементи на филтъра - адресат, бележки 
# източник : casefilt.inc.php 
# СТАНДАРТ 
if (empty($adre)){
}else{
			$mycont= $adre;
			$myfiel= "docuout.adresat";
	$mycoreal= mysql_real_escape_string($mycont);
	$mycoreal= mysql_real_escape_string($mycoreal);
	$myco2= "%" .$mycoreal ."%";
	$filtelem= sprintf("upper($myfiel) like upper('%s')"  ,$myco2);
			$filtdate .= " and $filtelem";
}
if (empty($bele)){
}else{
			$mycont= $bele;
			$myfiel= "docuout.notes";
	$mycoreal= mysql_real_escape_string($mycont);
	$mycoreal= mysql_real_escape_string($mycoreal);
	$myco2= "%" .$mycoreal ."%";
	$filtelem= sprintf("upper($myfiel) like upper('%s')"  ,$myco2);
			$filtdate .= " and $filtelem";
}
//var_dump($filtdate);

							# всичко за сканираните вх.документи 
$isdocuout= true;
$smarty->assign("ISDOCUOUT", true);
							include_once "docuedituplo.inc.php";

							# управление на действията 
//							$mode4= "mode=".$mode."&page=".$page."&year=".$year."&date=".$date."&date2=".$date2  ."&adre=".$adre."&bele=".$bele;
//							$modeel= "mode=".$mode."&page=".$page."&year=".$year."&date=".$date."&date2=".$date2;
							$modeel= $mode4;
							include_once "docuedituplo2.inc.php";

										/*+++
										# всичко за връчването 
										include_once "deli.inc.php";
										+++*/

# списъка 
# допълнителен филтър : and docuout.serial<>0 and docuout.year<>0 
# включва само изведените 
$myquery= "
	select docuout.* ,docuout.id as id
		,suit.serial as caseseri ,suit.year as caseyear
		,if(docutype.textout='',docutype.text,docutype.textout) as descriptype
,user.name as userregi, docuout.iduserregi, docuout.registered
	from docuout
		left join suit on docuout.idcase=suit.id
		left join docutype on docuout.iddocutype=docutype.id
left join user on docuout.iduserregi=user.id
	where docuout.year='$year'
		and $filtdate
	and docuout.serial<>0 and docuout.year<>0 
	order by docuout.serial
	";
//		,docutype.text as descriptype
		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
		$query= $myquery;
		$prefurl= "";
//		$baseurl= "mode=".$mode."&year=".$year;
		$baseurl= "mode=".$mode."&year=".$year."&date=".$date."&date2=".$date2  ."&adre=".$adre."&bele=".$bele;
								# 23.07.2009 - Бъзински - Т.Софрониев 
								# обратен ред (без отпечатването) и по 200 на страница 
		$obpagi= new paginator(200, 8, $query ." desc");
						if ($flprin){
						}else{
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
//						# if ($flprin){
//						}
$mylist= dbconv($mylist);
$mylist= arstrip($mylist);

# добавяме водещи нули за номера - не работи Smarty Plugin 
//$modeel= "mode=".$mode."&page=".$page."&year=".$year;
$modeel= "mode=".$mode."&page=".$page."&year=".$year."&date=".$date."&date2=".$date2  ."&adre=".$adre."&bele=".$bele;
$mylist= tranlist($mylist,$modeel);
						# if ($flprin){
						}


# линк за отпечатване на текущата страница 
//		$baseurl= "mode=".$mode."&page=".$page."&year=".$year;
		$baseurl= "mode=".$mode."&page=".$page."&year=".$year."&date=".$date."&date2=".$date2  ."&adre=".$adre."&bele=".$bele;
$curint= geturl($baseurl."&print=yes");
$smarty->assign("CURINT", $curint);

# параметри за извеждане на датата и бутоните 
//$date= $GETPARAM["date"];
//$date= isset($date) ? $date : "";
//		$baseurl= "mode=".$mode."&page=".$page."&year=".$year;
//		$baseurl= "mode=".$mode."&page=".$page."&year=".$year."&date=".$date."&date2=".$date2;
		$baseurl= "mode=".$mode."&page=".$page."&year=".$year."&date=".$date."&date2=".$date2  ."&adre=".$adre."&bele=".$bele;
////////if (empty($date)){
if ($filtdate=="1"){
	$ardate["linkget"]= geturl($baseurl."&func=get");
}else{
//	$ardate["date"]= $date;
//	$ardate["date2"]= $date2;
	$ardate["date"]= bgdatefrom($bgdate);
	$ardate["date2"]= bgdatefrom($bgdate2);
	$ardate["adre"]= tran1251($adre);
	$ardate["bele"]= tran1251($bele);
	$ardate["linkget"]= geturl($baseurl."&func=get");
	$ardate["linkall"]= geturl($baseurl."&func=all");
}
$smarty->assign("DATE", $ardate);
//print_rr($ardate);

# add new link 
$addnew= geturl($modeel."&edit=0");

# извеждаме 
$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
$smarty->assign("PAGENO", $page);
						
# сесийното име на масива с параметрите за отпечатване 
$separana= "OUREPARA";
//unset($_SESSION[$separana]);
						if ($flprin){
#-----------------------------------------------------------------------
# принтиране = изход в Ексел 
//#---- линк за отпечатване на текущата страница 
//		$baseurl= "mode=".$mode."&page=".$page."&year=".$year."&date=".$date."&date2=".$date2  ."&adre=".$adre."&bele=".$bele;
//$curint= geturl($baseurl."&print=yes");
//$smarty->assign("CURINT", $curint);
#--- константи 
															# брой записи за един пас 
															$steplen= 1000;
# сесийното име на масива с параметрите 
$separana= "OUREPARA";
					$ourepara= $_SESSION[$separana];
//print_rr($ourepara);
					//$ourepara= $_SESSION[$separana];
//print_rr($ourepara);
if (isset($ourepara)){
	# пореден пас с данни 
//			$steplen= $ourepara["steplen"];
			$cupass= $ourepara["indx"];
			$txpref= $ourepara["filepref"];
			$txsuff= $ourepara["filesuff"];
												if ($cupass<0){
					$cupass= -$cupass;
					unset($_SESSION[$separana]);
#+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
				# извеждаме хедъра 
ExcelHeader("изходящ-регистър.xls");
	print "
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\" />
<body>
	";
					$_SESSION[$separana]["code"]= "begin";
					$cont= smdisp("oureprnt.tpl","fetch");
print $cont;
				# извеждаме врем.файлове 
				$lastpass= $cupass -1;
				for ($ipas=1; $ipas<=$lastpass; $ipas++){
					$txname= $txpref .$ipas .$txsuff;
					$cont= file_get_contents($txname);
print $cont;
					# итриваме врем.файл 
					unlink($txname);
				}
				# извеждаме футера 
					$_SESSION[$separana]["code"]= "end";
					$cont= smdisp("oureprnt.tpl","fetch");
print $cont;
	print "
</body>
</html>
	";
exit;
#+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
												}else{
												}
			$totarec= $ourepara["tota"];
			$nextpass= $cupass +1;
//var_dump($cupass);
					$_SESSION[$separana]["indx"]= $nextpass;
			$begi= ($cupass-1)*$steplen;
//print "[$cupass][$begi][$steplen][$proc]";
	$mylist= $DB->select($query ." limit $begi,$steplen");
									//$txpref= $ourepara["filepref"];
									//$txsuff= $ourepara["filesuff"];
	if (empty($mylist)){
		# няма данни - приключване 
					//unset($_SESSION[$separana]);
					$_SESSION[$separana]["indx"]= -$cupass;
/*
	print "
<script>
parent.prinfini();
</script>
	";
*/
		# затваряме вътр.фрейм 
		$smarty->assign("LINK", $curint);
		$smarty->assign("FINI", true);
		print smdisp("_passprin.tpl","iconv");
	}else{
		# има данни - извеждаме паса 
		$mylist= dbconv($mylist);
		$mylist= arstrip($mylist);
		$mylist= tranlist($mylist,"");
		$smarty->assign("LIST", $mylist);
	$cont= smdisp("oureprnt.tpl","fetch");
//print $cont;
									$txname= $txpref .$cupass .$txsuff;
					//sleep(2);
		file_put_contents($txname, $cont);
/*
	print "
<body onload='document.location.href=\"$curint\";'>
<h4>$cupass<h4>
</body>
	";
*/
			# процента 
			$proc= round( 100 * ($nextpass*$steplen/$totarec) ,0);
			$proc= ($proc>100) ? 100 : $proc;
		$smarty->assign("LINK", $curint);
//		$smarty->assign("TEXT", "пас $nextpass $proc %");
		$smarty->assign("TEXT", "$proc %");
		print smdisp("_passprin.tpl","iconv");
	}
}else{
	# начало 
	$cupass= 0;
	$nextpass= 1;
			$arpara= array();
//			$arpara["steplen"]= $passreco;
			$arpara["indx"]= $nextpass;
			$arpara["code"]= "process";
			# общия брой записи 
				$rows= $DB->selectPage($totalRows,$query ." limit 1,1");
			$arpara["tota"]= $totalRows;
			# процента 
			$proc= round( 100 * ($nextpass*$steplen/$totalRows) ,0);
			$proc= ($proc>100) ? 100 : $proc;
			# имена за веригата от временни файлове 
				$txpref= "cache/" .md5(microtime()) ."_";
				$txsuff= ".data";
			$arpara["filepref"]= $txpref;
			$arpara["filesuff"]= $txsuff;
					$_SESSION[$separana]= $arpara;
/*
	print "
<body onload='document.location.href=\"$curint\";'>
<h4>START<h4>
</body>
	";
*/
	$smarty->assign("LINK", $curint);
//	$smarty->assign("TEXT", "пас $nextpass $proc %");
	$smarty->assign("TEXT", "$proc %");
	print smdisp("_passprin.tpl","iconv");
//	$cont= smdisp("oureprnt.tpl","fetch");
//	print $cont;
}
exit;
#-----------------------------------------------------------------------

						}else{
# изчистваме масива с параметрите за отпечатване 
unset($_SESSION[$separana]);
# извеждане на текущата страница 
$pagecont= smdisp("oure.tpl","fetch");
						# if ($flprin){
						}



function tranlist($mylist,$modeel){
											$arin= array();
	foreach($mylist as $myin=>$myco){
				$idcurr= $myco["id"];
											$arin[]= $idcurr;
		$mylist[$myin]["serial"]= str_pad($myco["serial"],5,"0",STR_PAD_LEFT);
		$mylist[$myin]["edit"]= geturl($modeel."&edit=".$idcurr);
				# 21.06.2009 - маскираме спец.символи в коментара и др.текст 
		$mylist[$myin]["notes"]= htmlspecialchars( $mylist[$myin]["notes"] ,ENT_QUOTES);
		$mylist[$myin]["adresat"]= htmlspecialchars( $mylist[$myin]["adresat"] ,ENT_QUOTES);
		$mylist[$myin]["descrip"]= htmlspecialchars( $mylist[$myin]["descrip"] ,ENT_QUOTES);
								# заради отпечатването 
		$mylist[$myin]["notes"]= stripslashes($mylist[$myin]["notes"]);
		$mylist[$myin]["adresat"]= stripslashes($mylist[$myin]["adresat"]);
		$mylist[$myin]["descrip"]= stripslashes($mylist[$myin]["descrip"]);
								# сканиран образ 
//				$idcurr= $myco["id"];
//								$arin[]= $idcurr;
		$mylist[$myin]["scanuplo"]= geturl($modeel."&scanuplo=".$idcurr);
		$mylist[$myin]["scanview"]= geturl($modeel."&scanview=".$idcurr);
	}
											if (empty($arin)){
												$codein= "1";
											}else{
												$codein= implode(",",$arin);
											}
							# брой сканирани образи по вх.документи 
//									$codein= implode(",",$arin);
							$arscancoun= getscancoun("iddocu in ($codein)");
//print_rr($arscancoun);
global $DB, $smarty;
$smarty->assign("ARSCANCOUN", $arscancoun);
											
											# 18.08.2014 - връчване 
											global $ISPOST;
											if ($ISPOST){
												//include_once "deli.inc.php";
												deliinfo($codein);
											}else{
											}

/*+++
#------------------------------------------------------------------------------------------
# данни за връчване, източник : cazo6.php 
global $DB, $smarty;
//										# всичко за връчването 
//										include_once "deli.inc.php";
	# чакащи, ако има 
	$arwaitmeth= $DB->selectCol("
		select docuout.id as ARRAY_KEY, t2.idposttype
		from docuout
			left join postwait as t2 on t2.iddocuout=docuout.id
		where docuout.id in ($codein)
		");
	$smarty->assign("ARWAITMETH", $arwaitmeth);
//print_rr($arwaitmeth);
	
//					# списък таблици с вътрешни документи за връчване 
//					$artabl= getartabl();
global $artabl;
//print_rr($artabl);
					# временна обединена таблица 
					$uniqname= getuniontab("docuout.id in ($codein)");
	# метод на връчване - за всички документи 
	$ardelimeth= $DB->selectCol("
		select docuout.id as ARRAY_KEY, t2.idposttype
		from docuout
			left join `$uniqname` as t2 on t2.iddocuout=docuout.id
		where docuout.id in ($codein)
		");
	$smarty->assign("ARDELIMETH", $ardelimeth);
	# данни за връчването 
	$ardelilist= $DB->select("
		select docuout.id as ARRAY_KEY, docuout.serial as outseri, docuout.year as outyear
					, t2.idposttype
			, max(t2.idpostuser) as maxiduser
			, max(t2.date1) as maxdate1
			, max(t2.date2) as maxdate2
			, max(t2.date3) as maxdate3
			, max(t2.idpoststat) as maxidstat
		from docuout
			left join `$uniqname` as t2 on t2.iddocuout=docuout.id
		where docuout.id in ($codein)
and t2.idposttype=2
		group by docuout.id
having maxiduser<>0 or maxdate1<>'' or maxdate2<>'' or maxdate3<>'' or maxidstat<>0
		");
	$smarty->assign("ARDELILIST", $ardelilist);
//print_rr($ardelilist);
#------------------------------------------------------------------------------------------
+++*/

return $mylist;
}


?>
