<?php
# касов журнал - всички ПКО и РКО 
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

/*****
							# отпечатване РКО 
							$prin= $GETPARAM["prin"];
							if (isset($prin)){
										include_once "razhprin.ajax.php";
										exit;	
							}else{
							}
*****/

							include_once "kasa.inc.php";

# сумарни 
$qusuma= str_replace("[FILT]",$filtdate,$c2qusuma);
$arsuma= $DB->selectRow($qusuma);
$smarty->assign("ARSUMA", $arsuma);
//print_rr($arsuma);

# заявка 
$qucode= str_replace("[FILT]",$filtdate,$c2query);

# флаг за изход в Excel 
$prinyes= $GETPARAM["print"];
$flprin= ($prinyes=="yes");
$smarty->assign("FLPRIN", $flprin);

						if ($flprin){
$mylist= $DB->select($qucode);
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
						}
$mylist= dbconv($mylist);
$mylist= arstrip($mylist);
$smarty->assign("LIST", $mylist);
//print_rr($mylist);

/*
# трансформация 
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
	$mylist[$uskey]["prin"]= geturl($modeel."&prin=".$idcurr);
}

# добави 
$addnew= geturl($modeel."&edit=0");
$smarty->assign("ADDNEW", $addnew);
*/

						if ($flprin){
$pagecont= smdisp("kasa.tpl","fetch");
ExcelHeader("каса-журнал".".xls");
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
$pagecont= smdisp("kasa.tpl","fetch");
						}


?>