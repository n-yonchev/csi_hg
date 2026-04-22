<?php
# приходни касови ордери 
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
										include_once "prihedit.ajax.php";
										exit;
									}else{
									}
									# изтриване на избран запис 
									$dele= $GETPARAM["dele"];
									if (isset($dele)){
$DB->query("delete from prih where id=?d"  ,$dele);
									}else{
									}
							# отпечатване ПКО според типа 
							$prin= $GETPARAM["prin"];
							if (isset($prin)){
								list($typesuma,$idsuma)= explode("/",$prin);
								if ($typesuma==1){
									$finaprin= $idsuma;
											include_once "cazofinaprin.ajax.php";
											exit;	
								}elseif ($typesuma==2){
									$prinadva= $idsuma;
											include_once "cazoadvaprin.ajax.php";
											exit;	
								}elseif ($typesuma==3){
									$prin= $idsuma;
											include_once "prihprin.ajax.php";
											exit;	
								}else{
die("prih.prin=$prin");
								}
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
		$filtdate= "t2.cashdate='$d1'";
		$texthead= "на дата ".bgdatefrom($d1);
	}else{
		$filtdate= "t2.cashdate>='$d1' and t2.cashdate<='$d2'";
		$texthead= "през периода ".bgdatefrom($d1)."-".bgdatefrom($d2);
	}
}
$modeel .= "&date=".$date;
$smarty->assign("TEXTHEAD", $texthead);

/***********************
									# всичко за ПКО 
									include_once "prih.inc.php";

# заявка 
//$qucode= str_replace("[FILT]",$filtdate,$c2query);
$qucode= str_replace("[FILT]","1",$c2query);
***********************/

									# всичко за касата (ПКО+РКО) 
									include_once "kasa.inc.php";

# филтри 
$filttype= "t2.typesuma in (1,2,3)";
$filttota= $filttype." and ".$filtdate;
# заявка 
$qucode= str_replace("[FILT]",$filttota,$c2query);

# сумарни 
//$qusuma= str_replace("[FILT]",$filtdate,$c2qusuma);
$qusuma= str_replace("[FILT]",$filttota,$c2qusuma);
$arsuma= $DB->selectRow($qusuma);
$smarty->assign("ARSUMA", $arsuma);
//print_rr($arsuma);

# флаг за изход в Excel 
$prinyes= $GETPARAM["print"];
$flprin= ($prinyes=="yes");
$smarty->assign("FLPRIN", $flprin);

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
//		$obpagi= new paginator(30, 8, $query);
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
				$idcurr= $uscont["idsuma"];
	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
	$mylist[$uskey]["dele"]= geturl($modeel."&dele=".$idcurr);
	$mylist[$uskey]["prin"]= geturl($modeel."&prin=".$uscont["typesuma"]."/".$idcurr);
}
# добави 
$addnew= geturl($modeel."&edit=0");
$smarty->assign("ADDNEW", $addnew);
						}
$smarty->assign("LIST", $mylist);

						if ($flprin){
$pagecont= smdisp("prih.tpl","fetch");
ExcelHeader("списък-ПКО".".xls");
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
$pagecont= smdisp("prih.tpl","fetch");
						}


?>