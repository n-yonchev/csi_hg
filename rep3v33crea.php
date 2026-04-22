<?php
# отчет ВСС сумарно в 1 ред - формиране в iframe frarep 

								include_once "rep2.inc.php";
								include_once "rep3.inc.php";

# заявката 
/*
$codeex= "where $filtperi";
$q2= str_replace("[CODEEXTE]",$codeex,$qubase);
$query= str_replace("[CODECLAI]","'c'",$q2);
*/
$codein= $_SESSION["REP3CODEIN"];
$codesu= "where $filtmain and $filtperi and $codeclai in ($codein)";
$q2= str_replace("[CODEEXTE]",$codesu,$qubase);
$query= str_replace("[CODECLAI]","'c'",$q2);
//$tafilt= "(ta.c1+ta.c2+ta.c4+ta.c5+ta.c6)<>0 and (ta.c8+ta.c9+ta.c12+ta.c13+ta.c14)<>0";
//$arsuma= $DB->selectRow("$query where $tafilt");
//$smarty->assign("ARSUMA", $arsuma);
//print_rr($arsuma);

# данните 
$ardata= $DB->select($query);
//print_rr($ardata);
$ardata= dbconv($ardata);
$smarty->assign("ARDATA", $ardata);

# съдържанието 
$cont= smdisp("rep3crea.tpl","fetch");

# извеждаме 
ExcelHeader("rep3-$period.xls");
	
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

?>