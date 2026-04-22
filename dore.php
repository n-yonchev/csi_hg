<?php
# извеждане на входящ регистър 
# източник : 
#    docu.php - обслужване на вход.докуметни 
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

							# всичко за сканираните вх.документи 
							include_once "docuedituplo.inc.php";

# годината  
	unset($listyear[0]);
	$arke= array_keys($listyear);
$year= $GETPARAM["year"];
$year= isset($year) ? $year : $arke[0];
$smarty->assign("YEAR", $year);
//var_dump($year);

# датата или периода 
$date= $GETPARAM["date"];
$date= isset($date) ? $date : "";
$date2= $GETPARAM["date2"];
$date2= isset($date2) ? $date2 : "";

									# избор на дата 
									$func= $GETPARAM["func"];
									if ($func=="get"){
				include_once "doredate.ajax.php";
exit;
									}else{
									}
									# всички записи без дата 
									//$func= $GETPARAM["func"];
									if ($func=="all"){
				$date= "";
				$date2= "";
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

							# управление на действията 
							$modeel= "mode=".$mode."&page=".$page."&year=".$year."&date=".$date."&date2=".$date2;
							include_once "docuedituplo2.inc.php";

# допълнителен филтър за дата, ако е избрана 
/*
if (empty($date)){
		$filtdate= "1";
}else{
	if (empty($date2)){
		$filtdate= "date(docu.created)='$date'";
	}else{
		$filtdate= "date(docu.created)>='$date' and date(docu.created)<='$date2'";
	}
}
*/
if (empty($date)){
		$filtdate= "1";
}else{
	if (empty($date2)){
		$bgdate= bgdateto($date);
		$filtdate= "date(docu.created)='$bgdate'";
	}else{
		$bgdate= bgdateto($date);
		$bgdate2= bgdateto($date2);
		$filtdate= "date(docu.created)>='$bgdate' and date(docu.created)<='$bgdate2'";
	}
}

# списъка 
/*
$myquery= "
	select docu.* ,docu.id as id
		,suit.serial as caseseri ,suit.year as caseyear
	from docu
		left join suit on docu.idcase=suit.id
	where docu.year='$year'
		and $filtdate
	order by docu.serial 
	";
*/
				# 13.04 2009 - един документ - много дела 
$myquery= "
	select docu.* ,docu.id as id
	from docu
	where docu.year='$year'
		and $filtdate
	order by docu.serial 
	";
		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
		$query= $myquery;
		$prefurl= "";
//		$baseurl= "mode=".$mode."&year=".$year;
		$baseurl= "mode=".$mode."&year=".$year."&date=".$date."&date2=".$date2;
		$obpagi= new paginator(18, 8, $query);
						if ($flprin){
		$mylist= $DB->select($query);
						}else{
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
						}
$mylist= dbconv($mylist);
$mylist= arstrip($mylist);

									# за сканирания образ 
									$arin= array();
# добавяме водещи нули за номера - не работи Smarty Plugin 
foreach($mylist as $myin=>$myco){
	$mylist[$myin]["serial"]= str_pad($myco["serial"],5,"0",STR_PAD_LEFT);
				# 13.04.2009 - маскираме спец.символи в коментара 
	$mylist[$myin]["text"]= htmlspecialchars( $mylist[$myin]["text"] ,ENT_QUOTES);
	$mylist[$myin]["from"]= htmlspecialchars( $mylist[$myin]["from"] ,ENT_QUOTES);
	$mylist[$myin]["notes"]= htmlspecialchars( $mylist[$myin]["notes"] ,ENT_QUOTES);
				# 13.04 2009 - един документ - много дела 
				# добавяме масив - списък на свързаните дела 
				# НЕЕФЕКТИВНО - заявки в цикъл 
					$arlis2= "";
				$caselist= getcaselist($myco["id"]);
				foreach($caselist as $cael){
					$arlis2[]= $cael["caseseri"] ."/" .$cael["caseyear"];
				}
	$mylist[$myin]["caselist"]= $arlis2;
								# заради отпечатването 
	$mylist[$myin]["text"]= stripslashes($mylist[$myin]["text"]);
	$mylist[$myin]["from"]= stripslashes($mylist[$myin]["from"]);
	$mylist[$myin]["notes"]= stripslashes($mylist[$myin]["notes"]);
							# сканиран образ 
				$idcurr= $myco["id"];
									$arin[]= $idcurr;
	$mylist[$myin]["scanuplo"]= geturl($modeel."&scanuplo=".$idcurr);
	$mylist[$myin]["scanview"]= geturl($modeel."&scanview=".$idcurr);
}
							# брой сканирани образи по вх.документи 
									$codein= implode(",",$arin);
							$arscancoun= getscancoun("iddocu in ($codein)");
//print_rr($arscancoun);
$smarty->assign("ARSCANCOUN", $arscancoun);


# линк за отпечатване на текущата страница 
//		$baseurl= "mode=".$mode."&page=".$page."&year=".$year;
		$baseurl= "mode=".$mode."&page=".$page."&year=".$year."&date=".$date."&date2=".$date2;
$curint= geturl($baseurl."&print=yes");
$smarty->assign("CURINT", $curint);

# параметри за извеждане на датата и бутоните 
//$date= $GETPARAM["date"];
//$date= isset($date) ? $date : "";
//		$baseurl= "mode=".$mode."&page=".$page."&year=".$year;
		$baseurl= "mode=".$mode."&page=".$page."&year=".$year."&date=".$date."&date2=".$date2;
if (empty($date)){
	$ardate["linkget"]= geturl($baseurl."&func=get");
}else{
	$ardate["date"]= $date;
	$ardate["date2"]= $date2;
	$ardate["linkget"]= geturl($baseurl."&func=get");
	$ardate["linkall"]= geturl($baseurl."&func=all");
}
$smarty->assign("DATE", $ardate);

# извеждаме 
//$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
$smarty->assign("PAGENO", $page);
						
						if ($flprin){
//# отпечатване на всички страници чрез PDF 
# отпечатване на всички страници чрез HTML-Excel 
# източник : cazo6prnt.ajax.php 
# съдържанието 
$cont= smdisp("doreprnt.tpl","fetch");
/*
$cont= smdisp("dorepdf.tpl","iconv");
//print "<xmp>$cont</xmp>";
# записваме съдържанието във временен файл 
$fnam= md5(microtime());
$fnam= "cache/".$fnam;
file_put_contents($fnam, stripslashes($cont));
# футера 
$footer= "ФУТЕРА НА ТОЗИ ДОКУМЕНТ";
$footer= toutf8($footer);
$smarty->assign("FOOTER", urlencode($footer));
		# определяме префикса за абсолютния път - заради локалната поддир. /b3 
		$snam= $_SERVER["SCRIPT_NAME"];
		$anam= explode("/",$snam);
		unset($anam[count($anam)-1]);
		unset($anam[0]);
		$anam[]= $fnam;
		$namresult= implode("/",$anam);
# отпечатваме 
$smarty->assign("URLPAR", urlencode($namresult));
print smdisp("doreprnt.ajax.tpl","iconv");
*/
ExcelHeader("входящ-регистър.xls");
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
exit;
						}else{
# извеждане на текущата страница 
$pagecont= smdisp("dore.tpl","fetch");
						}


?>
