<?php
# към регистъра - всички дела на логнатия юзер - грешки в предадените данни 
# отгоре : 
#     $mode - режима 
#     $submod - подрежима 
//print_rr($_SESSION);
//print_rr($GETPARAM);

$modeel= "mode=".$mode ."&page=".$page ."&submod=".$submod;
foreach($armist as $indx=>$elem){
	$armist[$indx][3]= geturl($modeel ."&edit=".$elem[3]);
}

$armist= tran1251($armist);
$smarty->assign("ARMIST", $armist);

# извеждаме 
$recont= smdisp("regiresu.tpl","fetch");
$smarty->assign("RECONT", $recont);


?>