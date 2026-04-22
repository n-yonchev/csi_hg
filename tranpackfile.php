<?php
# разглеждане/генериране редовете за ИЗХ.ФАЙЛ по избран пакет 
# отгоре : 
#    $mode - текущия режим 
#    $vari - текущото подменю 
#    $page - текущата страница - от списъка пакети 
# управляващ 
#    $filegene- избрания пакет tranpack.id 
# още : 
#    $basepara - базовите параметри 
//print_rr($GETPARAM);


# данни за пакета 
$smarty->assign("IDPACK", $filegene);
$ropack= getrow("tranpack",$filegene);
$idbank= $ropack["idbank"];
$smarty->assign("IDBANK", $idbank);
$smarty->assign("PACKCREA", $ropack["created"]);
									
									# според банката 
						$tpname= "tranoutf$idbank.tpl";
									include_once "tranoutf$idbank.php";

//$smarty->assign("ROPACK", $ropack);
# данни за кантората 
$rooffi= getofficerow(0);

# описите от пакета 
$filtlistcode= "finatran.idinve<>0 and finatran.idpack=0 and traninve.idpack=$filegene";
				$codejoin= sprintf($bictempjoin,"tranacco.iban");
$arinve= $DB->select("
	select finatran.idinve as ARRAY_KEY1, sum(finatran.amount) as suma
		, tranacco.iban as accoiban, tranacco.bic as accobic, tranacco.desc as accoclai, tranacco.code as accocode
				, banklist.name as bankname
				, finatran.clainame as clainame
				, date_format(traninve.created,'%d.%m.%Y') as dateinve
	from finatran 
	left join traninve on finatran.idinve=traninve.id
	left join tranpack on traninve.idpack=tranpack.id
		left join tranacco on traninve.idacco=tranacco.id
				$codejoin
	where $filtlistcode
	group by finatran.idinve
	");
$arinve= dbconv($arinve);
# ИЗХ.ФАЙЛ за тях 
$listinve= filetraninve($arinve);
////////print_rr(toutf8($listinve));

# директно включените преводи 
$filtcode= "finatran.idinve=0 and finatran.idpack=$filegene";
$query= getmainqu($filtcode);
$mylist= $DB->select($query);
$mylist= dbconv($mylist);
$mylist= arstrip($mylist);
////////print_ru($mylist);
# обща сума 
$datasuma= $DB->selectRow("select sum(amount) as suma, count(*) as coun from finatran where $filtcode");
# и сумите от пакетите 
foreach($arinve as $idinve=>$elem){
	$datasuma["suma"] += $elem["suma"];
	$datasuma["coun"] += 1;
}
$smarty->assign("SUMATOTA", $datasuma);

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
# ИЗХ.ФАЙЛ за директно включените 
$listfree= filetranfree($mylist,$arbudata);
//	print_rr($listfree);

# общ ИЗХ.ФАЙЛ 
//$xmlist= $listinve + $listfree; 
$filelist= array_merge($listinve,$listfree);
//$smarty->assign("LIST", $filelist);

//print_rr(tran1251($filelist));
//print_rr($filelist);
//print_rr(toutf8($filelist));

							# извеждане или ИЗХ.ФАЙЛ или отпечатване 
							$create= $GETPARAM["create"];
							$prnt= $GETPARAM["prnt"];
							if (isset($create)){
//OutfHeader("pack$filegene.xml");
OutfHeader("pack$filegene.".$arbankpaymsuff[$idbank]);
$xmlcont= getoutfile($filelist);
print $xmlcont;
# край 
exit;
							}elseif (isset($prnt)){
								include_once "tranpackprnt.php";
# край 
exit;
							}else{
							
# линк за формиране ИЗХ.ФАЙЛ и за отпечатване 
$basecrea= $basepara ."&filegene=".$filegene ."&create=yes";
$linkcrea= geturl($basepara ."&filegene=".$filegene ."&create=yes");
$linkprnt= geturl($basepara ."&filegene=".$filegene ."&prnt=yes");
$smarty->assign("LINKCREA", $linkcrea);
$smarty->assign("LINKPRNT", $linkprnt);
//var_dump($basepara);

# извеждаме 
//$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $filelist);
////////$pagecont= smdisp("tran2.tpl","fetch");
//$contvari= smdisp("tranpackfile.tpl","fetch");
$contvari= smdisp($tpname,"fetch");

							}

?>