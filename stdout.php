<?php
# изведени изходящи документи - по деловодители и флаг ръчно въведени 

# код за ръчно въведените 
$codeente= "if(docuout.isentered=1,1,0)";
# данните 
//$mylist= $DB->select("select suit.iduser as ARRAY_KEY
$mylist= $DB->select("select if(suit.iduser is null,-9,suit.iduser) as ARRAY_KEY
	, count(docuout.id) as coun, sum($codeente) as ente
	from docuout
	left join suit on docuout.idcase=suit.id
	where docuout.serial<>0 and docuout.year<>0
	group by suit.iduser
	");
$mylist= dbconv($mylist);
//print_r($mylist);

# сумираме и добавяме общ ред 
				$arsuma= array();
foreach($mylist as $elem){
				$arsuma["coun"] += $elem["coun"];
				$arsuma["ente"] += $elem["ente"];
}
$mylist[-1]= $arsuma;

# деловодителите в азб.ред и общия ред 
$aruser= getselect("user","name","1",true);
	$aruser= tran1251($aruser);
//$aruser[0]= "от ненасочени дела";
$aruser[0]= "от дела без деловодител";
//$aruser[NULL]= "от ненасочени дела";
	//$aruser= array(NULL=>"от ненасочени дела") + $aruser;
	$aruser= array(-9=>"ненасочени към дела") + $aruser;
$aruser[-1]= "ВСИЧКО";

# линк за отпечатване на текущата страница 
//		$baseurl= "mode=".$mode."&page=".$page."&year=".$year;
		$baseurl= "mode=".$mode;
$curint= geturl($baseurl."&print=yes");
$smarty->assign("CURINT", $curint);
									
# флага за отпечатване 
$prinyes= $GETPARAM["print"];
$flprin= ($prinyes=="yes");
$smarty->assign("FLPRIN", $flprin);

# извеждаме 
$smarty->assign("DATA", $mylist);
$smarty->assign("USERLIST", $aruser);
						
						if ($flprin){
# изход в Excel 
$cont= smdisp("stdout.tpl","fetch");
//ExcelHeader("статистика-$sttext.xls");
ExcelHeader("изх.документи.xls");
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
//exit;
						}else{
# извеждаме 
//$smarty->assign("DATA", $mylist);
//$smarty->assign("USERLIST", $aruser);
$pagecont= smdisp("stdout.tpl","fetch");
						}


?>
