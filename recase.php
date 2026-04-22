<?php
# извеждане на регистър на заведените дела
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

# допълнителен филтър за дата, ако е избрана 
if (empty($date)){
		$filtdate= "1";
}else{
	if (empty($date2)){
		$bgdate= bgdateto($date);
		$filtdate= "date(suit.created)='$bgdate'";
	}else{
		$bgdate= bgdateto($date);
		$bgdate2= bgdateto($date2);
		$filtdate= "date(suit.created)>='$bgdate' and date(suit.created)<='$bgdate2'";
	}
}

# списъка 
$myquery= "
	select suit.* ,suit.id as id
	from suit
	where suit.year='$year'
		and $filtdate
	order by suit.serial 
	";
		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
		$query= $myquery;
		$prefurl= "";
//		$baseurl= "mode=".$mode."&year=".$year;
		$baseurl= "mode=".$mode."&year=".$year."&date=".$date."&date2=".$date2;
		$obpagi= new paginator(200, 8, $query);
						if ($flprin){
		$mylist= $DB->select($query);
						}else{
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
						}
$mylist= dbconv($mylist);
$mylist= arstrip($mylist);

# четем данните за кантората 
$rooffi= getofficerow(1);
$smarty->assign("ROOFFI", $rooffi);

													# резултатен масив с датите на специфичните статуси 
													# индекс= групов статус : 1=спиране 2=възобнов 3=свършване 4=прекратяв 5=изпращане на друг 
													# съдърж= датата на преминаване към този статус 
													$arstatdate= array();
													# списъци  за трансформация на статуса от данните в съотв.групов статус 
													# статусите от данните - виж commspec.php - 2-мерен масив $listcasestat 
													$transtat[1]= array(8);
													$transtat[2]= array();
													$transtat[3]= array(16);
													$transtat[4]= array_keys($lica1);
													$transtat[5]= array_keys($lica2);
												# текстове за извеждан на груп.статуси 
												$txtranstat[1]= "дата на спиране";
												$txtranstat[2]= "дата на възобновяване";
												$txtranstat[3]= "дата на свършване";
												$txtranstat[4]= "дата на прекратяване";
												$txtranstat[5]= "дата на изпращане";
												$smarty->assign("TXTRANSTAT", $txtranstat);
# обработваме списъка 
foreach($mylist as $myin=>$myco){
					# id на делото 
					$idcase= $myco["id"];
	# пълния номер на делото 
	$mylist[$myin]["fullnumb"]= getfullnumb($myco);
/*
	# молбата за образуване 
	# ВНИМАНИЕ. 
	# приемаме за молба първия физически запис от подчинените входящи документи 
					# един документ - много дела 
					# източник : commspec.php - function get_docu_of_case() 
					# НЕЕФЕКТИВНО 
					$docuqu= "select 
							docu.id as doc1id, docu.serial as doc1seri, docu.year as doc1year, docu.created as doc1crea 
						from docusuit
							left join docu on docusuit.iddocu=docu.id
						where docusuit.idcase=?
						order by docu.id
						limit 1
						";
					$doculist= $DB->select($docuqu ,$idcase);
					$ardocu["seri"]= $doculist[0]["doc1seri"];
					$ardocu["year"]= $doculist[0]["doc1year"];
					$ardocu["crea"]= $doculist[0]["doc1crea"];
***/
	# молбата за образуване 
	# търсим молбата за образуване сред всички вх.документи : docu.idtype=4=aadocutype.id aadocutype.mode="crea" 
	# ако няма молба (старо дело) - празни данни 
					$docuqu= "select 
							docu.id as doc1id, docu.serial as doc1seri, docu.year as doc1year, docu.created as doc1crea 
						from docusuit
							left join docu on docusuit.iddocu=docu.id
							left join aadocutype on docu.idtype=aadocutype.id
						where docusuit.idcase=?
							and aadocutype.mode=?
						order by docu.id
						limit 1
						";
					$doculist= $DB->select($docuqu ,$idcase,"crea");
						$ardocu= array();
					if (empty($doculist)){
					}else{
						$ardocu["seri"]= $doculist[0]["doc1seri"];
						$ardocu["year"]= $doculist[0]["doc1year"];
						$ardocu["crea"]= $doculist[0]["doc1crea"];
					}
/*******************************/
	$mylist[$myin]["firstdocu"]= $ardocu;
													# статуса от данните на делото 
													$idstat= $myco["idstat"];
													# ако делото е със специфичен статус - зареждаме съотв.дата 
													if (empty($idstat)){
													}else{
														foreach($transtat as $indx2=>$list2){
															if (array_search($idstat,$list2)===false){
															}else{
	$mylist[$myin]["statdate"]["indx"]= $indx2;
	$mylist[$myin]["statdate"]["time"]= $myco["timestat"];
																break;
															}
														}
													}
}

# филтър по делата за списъците взискатели и длъжници 
# обхваща : годината, периода ако има, но не и страницата ако е постранично 
$filcladeb= "suit.year='$year' and $filtdate";

# всички взискатели за делата от списъка 
$liscla= getcladeb("claimer",$filcladeb);
		$dataclai= array();
# формираме масив по дела 
foreach($liscla as $myin=>$myco){
					# id на делото 
					$idcase= $myco["idcase"];
	$dataclai[$idcase][]= $myco;
}
$smarty->assign("DATACLAI", $dataclai);

# всички длъжници за делата от списъка 
$lisdeb= getcladeb("debtor",$filcladeb);
		$datadebt= array();
# формираме масив по дела 
foreach($lisdeb as $myin=>$myco){
					# id на делото 
					$idcase= $myco["idcase"];
	$datadebt[$idcase][]= $myco;
}
$smarty->assign("DATADEBT", $datadebt);

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
						
						# източник : cazo1.php 
							# за извеждане на "идва от" - кеширания масив 
							$arfrom= unserialize(file_get_contents(COFROMFILE));
							# предаваме съдържанието 
							$smarty->assign("ARFROM", $arfrom);
						# за извеждане на "вид" - масива $listsort - commspec.php 
						# предаваме съдържанието на масива 
						$smarty->assign("ARSORT", $listsort);
							# за извеждане на "произход на вземането" - четем от таблицата 
							$arclaiorig= getselect("claimorigin","name","",false);
							$arclaiorig= dbconv($arclaiorig);
							# предаваме съдържанието на масива 
							$smarty->assign("ARCLAIORIG", $arclaiorig);

# извеждаме 
//$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
$smarty->assign("PAGENO", $page);
						
						if ($flprin){
//# отпечатване на всички страници чрез PDF 
# отпечатване на всички страници чрез HTML-Excel 
# източник : cazo6prnt.ajax.php 
# съдържанието 
$cont= smdisp("recaseprnt.tpl","fetch");
ExcelHeader("заведени-дела.xls");
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
$pagecont= smdisp("recase.tpl","fetch");
						}



# връща данни за взискатели и длъжници за делата от списъка 
function getcladeb($taname,$filter){
global $DB;
//	$myquery= "select idcase, idtype, egn, bulstat, name from ? where ?";
//	$mylist= $DB->select($myquery  ,$taname,$filter);
//	$myquery= "select idcase, idtype, egn, bulstat, name from $taname where $filter";
//	$mylist= $DB->select($myquery);
	$myquery= "select idcase, idtype, egn, bulstat, name 
, address
		from $taname 
		left join suit on $taname.idcase=suit.id
		where $filter
		";
	$mylist= $DB->select($myquery);
	$mylist= dbconv($mylist);
	$mylist= arstrip($mylist);
return $mylist;
}

?>
