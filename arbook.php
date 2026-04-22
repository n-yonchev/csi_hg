<?php
# архивна книга 
# източник : 
#    oure.php - изходящ регистър 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
//print_r($GETPARAM);

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

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

									# корекция на избран запис 
									$edit= $GETPARAM["edit"];
									if (isset($edit)){
										include_once "archedit.ajax.php";
										exit;
									}else{
									}

/*
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
*/

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

/*
# допълнителен филтър за дата, ако е избрана 
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
*/

/******
# списъка 
# допълнителен филтър : and docuout.serial<>0 and docuout.year<>0 
# включва само изведените 
$myquery= "
	select docuout.* ,docuout.id as id
		,suit.serial as caseseri ,suit.year as caseyear
		,docutype.text as descriptype
	from docuout
		left join suit on docuout.idcase=suit.id
		left join docutype on docuout.iddocutype=docutype.id
	where docuout.year='$year'
		and $filtdate
	and docuout.serial<>0 and docuout.year<>0 
	order by docuout.serial
	";
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
		$mylist= $DB->select($query);
						}else{
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
						}
$mylist= dbconv($mylist);
$mylist= arstrip($mylist);

# добавяме водещи нули за номера - не работи Smarty Plugin 
//$modeel= "mode=".$mode."&page=".$page."&year=".$year;
$modeel= "mode=".$mode."&page=".$page."&year=".$year."&date=".$date."&date2=".$date2  ."&adre=".$adre."&bele=".$bele;
foreach($mylist as $myin=>$myco){
				$idcurr= $myco["id"];
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
}
******/

# списъка 
# допълнителен филтър : and docuout.serial<>0 and docuout.year<>0 
# включва само изведените 
$myquery= "
	select archive.* ,archive.id as id
		,suit.serial as caseseri ,suit.year as caseyear
		,user.name as username
	from archive
		left join suit on archive.idcase=suit.id
		left join user on archive.iduser=user.id
	where archive.year='$year'
	and archive.serial<>0 and archive.year<>0 
	order by archive.serial
	";
		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
		$query= $myquery;
		$prefurl= "";
		$baseurl= "mode=".$mode."&year=".$year;
//		$baseurl= "mode=".$mode."&year=".$year."&date=".$date."&date2=".$date2  ."&adre=".$adre."&bele=".$bele;
								# 23.07.2009 - Бъзински - Т.Софрониев 
								# обратен ред (без отпечатването) и по 200 на страница 
		$obpagi= new paginator(200, 8, $query ." desc");
						if ($flprin){
		$mylist= $DB->select($query);
						}else{
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
						}
$mylist= dbconv($mylist);
$mylist= arstrip($mylist);

/*
//# добавяме водещи нули за номера - не работи Smarty Plugin 
//$modeel= "mode=".$mode."&page=".$page."&year=".$year;
$modeel= "mode=".$mode."&page=".$page."&year=".$year."&date=".$date."&date2=".$date2  ."&adre=".$adre."&bele=".$bele;
foreach($mylist as $myin=>$myco){
				$idcurr= $myco["id"];
//	$mylist[$myin]["serial"]= str_pad($myco["serial"],5,"0",STR_PAD_LEFT);
	$mylist[$myin]["edit"]= geturl($modeel."&edit=".$idcurr);
				# маскираме спец.символи в коментара и др.текст 
	$mylist[$myin]["notes"]= htmlspecialchars( $mylist[$myin]["notes"] ,ENT_QUOTES);
	$mylist[$myin]["protocol"]= htmlspecialchars( $mylist[$myin]["protocol"] ,ENT_QUOTES);
								# заради отпечатването 
	$mylist[$myin]["notes"]= stripslashes($mylist[$myin]["notes"]);
	$mylist[$myin]["protocol"]= stripslashes($mylist[$myin]["protocol"]);
}
//print_rr($mylist);
*/

//print_rr($mylist);
# формираме нов масив 
# вмъкваме редове в зона на липсващи арх.номера 
							$mylist2= array();
									$myseri= $mylist[0]["serial"] +1;
$modeel= "mode=".$mode."&page=".$page."&year=".$year;
foreach($mylist as $myin=>$myco){
									$seri2= $myseri -1;
//print "<br>[$seri2]".$myco["serial"];
									if ($myco["serial"]==$seri2){
									}else{
										$myar= array();
										$myar["serial"]= -1;
										$myar["arch2"]= $seri2;
										$myar["arch1"]= $myco["serial"] +1;
							$mylist2[]= $myar;
									}
							$myseri= $myco["serial"];
							$myar= $myco;
				$idcurr= $myco["id"];
//	$mylist[$myin]["serial"]= str_pad($myco["serial"],5,"0",STR_PAD_LEFT);
	$myar["edit"]= geturl($modeel."&edit=".$idcurr);
				# маскираме спец.символи в коментара и др.текст 
	$myar["notes"]= htmlspecialchars( $mylist[$myin]["notes"] ,ENT_QUOTES);
	$myar["protocol"]= htmlspecialchars( $mylist[$myin]["protocol"] ,ENT_QUOTES);
								# заради отпечатването 
	$myar["notes"]= stripslashes($mylist[$myin]["notes"]);
	$myar["protocol"]= stripslashes($mylist[$myin]["protocol"]);
							$mylist2[]= $myar;
}
									if ($myco["serial"]<=1){
									}else{
										$myar= array();
										$myar["serial"]= -1;
										$myar["arch2"]= $myco["serial"] -1;
										$myar["arch1"]= 1;
							$mylist2[]= $myar;
									}
$mylist= $mylist2;
//print_rr($mylist);

# линк за отпечатване на текущата страница 
		$baseurl= "mode=".$mode."&page=".$page."&year=".$year;
//		$baseurl= "mode=".$mode."&page=".$page."&year=".$year."&date=".$date."&date2=".$date2  ."&adre=".$adre."&bele=".$bele;
$curint= geturl($baseurl."&print=yes");
$smarty->assign("CURINT", $curint);

# параметри за извеждане на датата и бутоните 
//$date= $GETPARAM["date"];
//$date= isset($date) ? $date : "";
		$baseurl= "mode=".$mode."&page=".$page."&year=".$year;
//		$baseurl= "mode=".$mode."&page=".$page."&year=".$year."&date=".$date."&date2=".$date2;
//		$baseurl= "mode=".$mode."&page=".$page."&year=".$year."&date=".$date."&date2=".$date2  ."&adre=".$adre."&bele=".$bele;
////////if (empty($date)){
if ($filtdate=="1"){
	$ardate["linkget"]= geturl($baseurl."&func=get");
}else{
	$ardate["date"]= $date;
	$ardate["date2"]= $date2;
	$ardate["adre"]= tran1251($adre);
	$ardate["bele"]= tran1251($bele);
	$ardate["linkget"]= geturl($baseurl."&func=get");
	$ardate["linkall"]= geturl($baseurl."&func=all");
}
$smarty->assign("DATE", $ardate);
//print_r($ardate);

# add new link 
$addnew= geturl($modeel."&edit=0");

# извеждаме 
$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
$smarty->assign("PAGENO", $page);
						if ($flprin){
//# отпечатване на всички страници чрез PDF 
# отпечатване на всички страници чрез HTML-Excel 
# източник : dore.php 
# съдържанието 
$cont= smdisp("archprnt.tpl","fetch");
ExcelHeader("изходящ-регистър.xls");
	$outp= "
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\" />
<body>
	$cont
</body>
</html>
	";
print $outp;
exit;
						}else{
# извеждане на текущата страница 
$pagecont= smdisp("arbook.tpl","fetch");
						}


?>
