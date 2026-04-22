<?php
# списък преводи от избран опис 
# отгоре : 
#    $mode - текущия режим 
#    $vari - текущото подменю 
#    $page - текущата страница - от списъка преводи 
# управляващ 
#    $view - избрания опис traninve.id 
//print_rr($GETPARAM);
//var_dump($view);

# данни за описа 
$q2= getinvequ("traninve.id=".$view);
$roinve= $DB->selectRow($q2);
$roinve= dbconv($roinve);
//print_rr($roinve);
$smarty->assign("ROINVE", $roinve);
$smarty->assign("HEADTX", "преводите, включени в описа");

# филтъра 
$filtcode= "finatran.idinve=" .$view;

# ИЗключи ОТ опис 
$smarty->assign("FLCBOX", 2);
	$basepara= $baco ."&view=".$view;
//var_dump($basepara);
$frominve= geturl($basepara."&frominve=yes");
$smarty->assign("FROMINVE", $frominve);

# флагове за колоните за преводи 
$smarty->assign("FLCLAI", 5);
$smarty->assign("FLIBAN", 5);
//$smarty->assign("FLBICC", 5);
$smarty->assign("FLBUAC", 0);
$smarty->assign("FLDEBT", 1);
$smarty->assign("FLFULL", 1);
$smarty->assign("FLRING", 1);
//$smarty->assign("FLBANK", 1);
$smarty->assign("FLBANK", 5);
$smarty->assign("FLTEXT", 1);
$smarty->assign("FLRECI", 1);
//$smarty->assign("FLEDIT", 0);
$smarty->assign("FLBUDG", 1);
//$smarty->assign("FLBACK", 0);
$smarty->assign("FLINVE", 0);
$smarty->assign("FLDIRE", 0);
//////////$smarty->assign("FLCBOX", 1);
		if ($roinve["idstat"]==0){
/////////$smarty->assign("FLCBOX", 2);
		}else{
$smarty->assign("FLDEBT", 5);
$smarty->assign("FLFULL", 5);
$smarty->assign("FLRING", 5);
$smarty->assign("FLBANK", 5);
$smarty->assign("FLTEXT", 5);
$smarty->assign("FLRECI", 5);
$smarty->assign("FLCBOX", 0);
$smarty->assign("FLBUDG", 5);
		}

# извеждане 
include_once "tran2.php";
$smarty->assign("C2VARI", $contvari);
//$contvari= smdisp("tranwait.tpl","fetch");
$contvari= smdisp("traninveview.tpl","fetch");

?>
