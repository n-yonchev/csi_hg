<?php
# генериране XLS файл за избран опис 
# отгоре : 
#    $mode - текущия режим 
#    $vari - текущото подменю 
#    $page - текущата страница - от списъка пакети 
# управляващ 
#    $gene- избрания опис traninve.id 
//# още : 
//#    $basepara - базовите параметри 
//print_rr($GETPARAM);

# данни за кантората 
$rooffi= getofficerow(0);
$smarty->assign("CSINAME", $rooffi["shortname"]);
$smarty->assign("CSINUMB", $rooffi["serial"]);

# данни за описа 
$q2= getinvequ("traninve.id=".$gene);
$roinve= $DB->selectRow($q2);
$roinve= dbconv($roinve);
//print_rr($roinve);
$smarty->assign("ROINVE", $roinve);
$smarty->assign("INVEDATE", date("d.m.Y"));
//$smarty->assign("ISUSER", $roinve["codeacco"]==$codet26);
$smarty->assign("ISUSER", ($roinve["codeacco"]==$codet26 or $roinve["codeacco"]==$codenop));

# преводите от описа 
$filtcode= "finatran.idinve=$gene";
$query= getmainqu($filtcode);
$mylist= $DB->select($query);
$mylist= dbconv($mylist);
$mylist= arstrip($mylist);
//	print_rr($mylist);
$smarty->assign("LIST", $mylist);

# извеждане 
$cont= smdisp("traninvegene.tpl","fetch");
ExcelHeader(toutf8("опис$gene.xls"));
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
