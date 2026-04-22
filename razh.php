<?php
# разходни касови ордери 
# отгоре : 
#    $iduser - логнатия деловодител 
#    $mode - функция главно меню 
//print_rr($GETPARAM);


# текущата страница 
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

//$modeel= "mode=".$mode ."&filt=".$filt ."&page=".$page;
$modeel= "mode=".$mode ."&page=".$page;
$smarty->assign("MODEEL", $modeel);
$relurl= geturl($modeel);

									# корекция на избран запис 
									$edit= $GETPARAM["edit"];
									if (isset($edit)){
										include_once "razhedit.ajax.php";
										exit;
									}else{
									}
									# изтриване на избран запис 
									$dele= $GETPARAM["dele"];
									if (isset($dele)){
$DB->query("delete from razh where id=?d"  ,$dele);
									}else{
									}
							# отпечатване РКО 
							$prin= $GETPARAM["prin"];
							if (isset($prin)){
										include_once "razhprin.ajax.php";
										exit;	
							}else{
							}

# дата или период 
$date= trim($GETPARAM["date"]);
if (empty($date)){
	$filtdate= "1";
	$texthead= "";
}else{
	list($d1,$d2)= explode("^",$date);
	if (empty($d2)){
		$filtdate= "razh.cashdate='$d1'";
		$texthead= "на дата ".bgdatefrom($d1);
	}else{
		$filtdate= "razh.cashdate>='$d1' and razh.cashdate<='$d2'";
		$texthead= "през периода ".bgdatefrom($d1)."-".bgdatefrom($d2);
	}
}
$modeel .= "&date=".$date;
$smarty->assign("TEXTHEAD", $texthead);

# сумарни 
$arsuma= $DB->selectRow("select sum(amount) as suma1 from razh where $filtdate");
$smarty->assign("ARSUMA", $arsuma);
//print_rr($arsuma);

# флаг за изход в Excel 
$prinyes= $GETPARAM["print"];
$flprin= ($prinyes=="yes");
$smarty->assign("FLPRIN", $flprin);

# заявка 
$qucode= "
	select razh.*, suit.serial as caseri, suit.year as cayear
		,user.name as username
	from razh
	left join suit on razh.idcase=suit.id
	left join user on suit.iduser=user.id
where $filtdate
	order by razh.cashdate desc, razh.id desc
	";

						if ($flprin){
$mylist= $DB->select($qucode);
$mylist= dbconv($mylist);
$mylist= arstrip($mylist);
//print_rr($ardata);
						}else{
# странициране 
					include "pagi.class.php";
		$prefurl= "";
		$baseurl= $modeel;
		$obpagi= new paginator(30, 8, $qucode);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
# линк за изход в Excel 
$curint= geturl($baseurl."&print=yes");
$smarty->assign("CURINT", $curint);

$mylist= dbconv($mylist);
$mylist= arstrip($mylist);
//print_rr($ardata);

# трансформация 
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
	$mylist[$uskey]["dele"]= geturl($modeel."&dele=".$idcurr);
	$mylist[$uskey]["prin"]= geturl($modeel."&prin=".$idcurr);
}

# добави 
$addnew= geturl($modeel."&edit=0");
$smarty->assign("ADDNEW", $addnew);
						}
$smarty->assign("LIST", $mylist);

						if ($flprin){
$pagecont= smdisp("razh.tpl","fetch");
ExcelHeader("списък-РКО".".xls");
	$outp= "
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\" />
<body>
	$pagecont
</body>
</html>
	";
print $outp;
//exit;
						}else{
# извеждане 
$pagecont= smdisp("razh.tpl","fetch");
						}


?>