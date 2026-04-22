<?php
# архивирани дела на логнатия деловодител 
# източник : 
#    arch.php - архивна книга 
# отгоре глобално : 
#    $logisadmin = (smarty)LOGGEDISADMIN - флаг дали логнатия е админ 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
//print_r($GETPARAM);
//print_rr($smarty->get_template_vars());
//var_dump($logisadmin);

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];
$smarty->assign("LOGGEDID", $iduser);

# годината  
	unset($listyear[0]);
	$arke= array_keys($listyear);
$year= $GETPARAM["year"];
$year= isset($year) ? $year : $arke[0];
$smarty->assign("YEAR", $year);
//var_dump($year);

# деловодителя 
$onlyuser= $GETPARAM["onlyuser"];
$onlyuser= isset($onlyuser) ? $onlyuser : 1;
			if ($logisadmin){
$onlyuser= 0;
			}else{
			}
$smarty->assign("ONLYUSER", $onlyuser);
	$modeonly= "mode=".$mode."&year=".$year;
$smarty->assign("LINKONLY", geturl($modeonly."&onlyuser=1"));
$smarty->assign("LINKALL", geturl($modeonly."&onlyuser=0"));
	$rouser= getrow("user",$_SESSION["iduser"]);
$smarty->assign("USERNAME", $rouser["name"]);

# текущата страница 
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

									# корекция на избран запис 
									$edit= $GETPARAM["edit"];
									if (isset($edit)){
										include_once "archedit.ajax.php";
										exit;
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

# филтър за деловодителя 
if ($onlyuser==0){
	$filtuser= "1";
}else{
	$filtuser= "suit.iduser=".$_SESSION["iduser"];
}

# списъка 
# допълнителен филтър : and archive.serial<>0 and archive.year<>0 
$myquery= "
	select archive.* ,archive.id as id
		,suit.serial as caseseri ,suit.year as caseyear
		,user.name as username
				,suit.iduser as t2userid ,t2user.name as t2username
	from archive
		left join suit on archive.idcase=suit.id
		left join user on archive.iduser=user.id
				left join user as t2user on suit.iduser=t2user.id
	where archive.year='$year'
	and archive.serial<>0 and archive.year<>0 
and $filtuser
	order by archive.serial
	";
		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
		$query= $myquery;
		$prefurl= "";
		$baseurl= "mode=".$mode."&year=".$year."&onlyuser=".$onlyuser;
//		$baseurl= "mode=".$mode."&year=".$year;
//		$baseurl= "mode=".$mode."&year=".$year."&date=".$date."&date2=".$date2  ."&adre=".$adre."&bele=".$bele;
								# 23.07.2009 - Бъзински - Т.Софрониев 
								# обратен ред (без отпечатването) и по 200 на страница 
		$obpagi= new paginator(30, 8, $query ." desc");
						if ($flprin){
		$mylist= $DB->select($query);
						}else{
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
						}
$mylist= dbconv($mylist);
$mylist= arstrip($mylist);

//print_rr($mylist);
# формираме нов масив 
# вмъкваме редове в зона на липсващи арх.номера 
							$mylist2= array();
									$myseri= $mylist[0]["serial"] +1;
$modeel= "mode=".$mode."&year=".$year."&onlyuser=".$onlyuser."&page=".$page;
foreach($mylist as $myin=>$myco){
									$seri2= $myseri -1;
//print "<br>[$seri2]".$myco["serial"];
									if ($myco["serial"]==$seri2){
									}else{
										$myar= array();
										$myar["serial"]= -1;
										$myar["arch2"]= $seri2;
										$myar["arch1"]= $myco["serial"] +1;
										$myar["archcoun"]= $myar["arch2"] - $myar["arch1"] +1;
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
										$myar["archcoun"]= $myar["arch2"] - $myar["arch1"] +1;
							$mylist2[]= $myar;
									}
$mylist= $mylist2;
//print_rr($mylist);
# линк за отпечатване на текущата страница 
		$baseurl= "mode=".$mode."&year=".$year."&onlyuser=".$onlyuser."&page=".$page;
//		$baseurl= "mode=".$mode."&page=".$page."&year=".$year;
//		$baseurl= "mode=".$mode."&page=".$page."&year=".$year."&date=".$date."&date2=".$date2  ."&adre=".$adre."&bele=".$bele;
$curint= geturl($baseurl."&print=yes");
$smarty->assign("CURINT", $curint);

/*
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
*/

# add new link 
$addnew= geturl($modeel."&edit=0");

//print_rr($smarty->get_template_vars());
# извеждаме 
$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
$smarty->assign("PAGENO", $page);
						if ($flprin){
# отпечатване на всички страници чрез HTML-Excel 
# източник : oure.php 
# съдържанието 
$cont= smdisp("archprnt.tpl","fetch");
ExcelHeader("архивна-книга-$year.xls");
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
$pagecont= smdisp("arch.tpl","fetch");
						}


?>
