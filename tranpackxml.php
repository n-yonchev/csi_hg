<?php
# разглеждане/генериране редовете за XML по избран пакет 
# отгоре : 
#    $mode - текущия режим 
#    $vari - текущото подменю 
#    $page - текущата страница - от списъка пакети 
# управляващ 
#    $xmlgen- избрания пакет tranpack.id 
# още : 
#    $basepara - базовите параметри 
//print_rr($GETPARAM);


//# данни за пакета 
//$ropack= getrow("tranpack",$xmlgen);
//$smarty->assign("ROPACK", $ropack);
$smarty->assign("IDPACK", $xmlgen);
# данни за кантората 
$rooffi= getofficerow(0);

# описите от пакета 
$filtlistcode= "finatran.idinve<>0 and finatran.idpack=0 and traninve.idpack=$xmlgen";
$arinve= $DB->select("
	select finatran.idinve as ARRAY_KEY1, sum(finatran.amount) as suma
		, tranacco.iban as accoiban, tranacco.bic as accobic, tranacco.desc as accoclai, tranacco.code as accocode
	from finatran 
	left join traninve on finatran.idinve=traninve.id
	left join tranpack on traninve.idpack=tranpack.id
		left join tranacco on traninve.idacco=tranacco.id
	where $filtlistcode
	group by finatran.idinve
	");
$arinve= dbconv($arinve);
//print_rr($arinve);
//foreach($arinve as $idinve=>$eleminve){
//	$arinve[$idpack][$idinve]["link"]= geturl($modeel."&view=".$idinve);
//}
# XML за тях 
$listinve= xmltraninve($arinve);

# директно включените преводи 
$filtcode= "finatran.idinve=0 and finatran.idpack=$xmlgen";
$query= getmainqu($filtcode);
$mylist= $DB->select($query);
$mylist= dbconv($mylist);
$mylist= arstrip($mylist);
//	print_rr($mylist);

# директно включени - доп.данни за бюджетните 
$arbudata= $DB->select("
	select tranbudget.id as ARRAY_KEY, tranbudget.*
	from tranbudget
	left join finatran on finatran.idtranbudget=tranbudget.id
	left join tranpack on finatran.idpack=tranpack.id
	where $filtcode
	");
//print_rr($arbudata);
$arbudata= dbconv($arbudata);
$arbudata= arstrip($arbudata);
//$smarty->assign("ARBUDATA", $arbudata);
# XML за директно включените 
$listfree= xmltranfree($mylist,$arbudata);
//	print_rr($listfree);

# общ XML 
//$xmlist= $listinve + $listfree; 
$xmlist= array_merge($listinve,$listfree); 
//$smarty->assign("LIST", $xmlist);

							# извеждане или XML 
							$create= $GETPARAM["create"];
							if (isset($create)){
XmlHeader("pack$xmlgen.xml");
$xmlcont= getxmlubb($xmlist);
print $xmlcont;
# край 
exit;
							}else{
							
# линк за формиране XML 
$basecrea= $basepara ."&xmlgen=".$xmlgen ."&create=yes";
$linkcrea= geturl($basecrea);
$smarty->assign("LINKCREA", $linkcrea);

# извеждаме 
//$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $xmlist);
////////$pagecont= smdisp("tran2.tpl","fetch");
$contvari= smdisp("tranpackxml.tpl","fetch");

							}


/*
$cont= "ФАЙЛА БАНКА";

ExcelHeader("за банката.xml");
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
*/

?>