<?php
# списък преводи, директно включени в избран пакет 
# отгоре : 
#    $mode - текущия режим 
#    $vari - текущото подменю 
#    $page - текущата страница - от списъка преводи 
# управляващ 
#    $listfree - избрания paket tranpack.id 
//print_rr($GETPARAM);
//var_dump($view);


# данни за пакета 
$ropack= getrow("tranpack",$listfree);
$smarty->assign("ROPACK", $ropack);
//$basepara .= "&listfree=".$listfree;
//$relurl= geturl($basepara);
$filtcode= "finatran.idpack=$listfree and finatran.idinve=0";
//$smarty->assign("HEADTX", "от пакет $listfree - свободни");
$smarty->assign("HEADTX", "преводите, директно включени в пакета");
# ИЗключи ОТ ПАКЕТ 
$smarty->assign("FLCBOX", 4);
//	$bapara= $baco ."&view=".$listfree;
	$basepara .= "&listfree=".$listfree;
//////////////////////////////var_dump($basepara);
$frompack= geturl($basepara."&frompack=yes");
$smarty->assign("FROMPACK", $frompack);

# флагове за колоните за преводи 
$smarty->assign("FLCLAI", 5);
$smarty->assign("FLIBAN", 5);
//$smarty->assign("FLBICC", 5);
$smarty->assign("FLBUAC", 0);
$smarty->assign("FLDEBT", 1);
$smarty->assign("FLFULL", 1);
$smarty->assign("FLRING", 1);
$smarty->assign("FLBANK", 1);
$smarty->assign("FLTEXT", 1);
$smarty->assign("FLRECI", 1);
$smarty->assign("FLBUDG", 1);
//$smarty->assign("FLBACK", 0);
$smarty->assign("FLINVE", 0);
$smarty->assign("FLDIRE", 0);
//////////$smarty->assign("FLCBOX", 1);
		if ($ropack["idstat"]==0){
/////////$smarty->assign("FLCBOX", 2);
		}else{
$smarty->assign("FLDEBT", 5);
$smarty->assign("FLFULL", 5);
$smarty->assign("FLRING", 5);
$smarty->assign("FLBANK", 5);
$smarty->assign("FLTEXT", 5);
$smarty->assign("FLRECI", 5);
$smarty->assign("FLBUDG", 5);
$smarty->assign("FLCBOX", 0);
		}
# извеждане 
include_once "tran2.php";
$smarty->assign("C2VARI", $contvari);
//$contvari= smdisp("tranwait.tpl","fetch");
$contvari= smdisp("tranpackfree.tpl","fetch");


?>