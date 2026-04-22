<?php
# редове на фактура без сметка 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $year - текуща година 
#    $page - текуща страница 
# още отгоре : 
#    $view - фактурата bill.id 
#    $CODEBASE - елемента за базовия URL $modeel 
//print_rr($GETPARAM);

									# модификация на избрания запис 
									$rowedit= $GETPARAM["rowedit"];
									if (isset($rowedit)){
										include "finainvo2edit.ajax.php";
										exit;
									}else{
									}
								/*
									# изтриване на избрания запис 
									$rowdele= $GETPARAM["rowdele"];
									if (isset($rowdele)){
										include "finainvo2dele.ajax.php";
										exit;
									}else{
									}
								*/

# данни за фактурата 
$roinvo= getrow("bill",$view);
$smarty->assign("NOSERI", $roinvo["serial"]==0);

# списъка редове 
$mylist= $DB->select("select * from invoelem where idbill=?d order by id"  ,$view);
$mylist= dbconv($mylist);

//$modeel= "mode=".$mode ."&year=".$year."&page=".$page."&view=".$view;
$modeel= "mode=".$mode .$CODEBASE ."&page=".$page."&view=".$view;
# трансформираме списъка 
foreach ($mylist as $uskey=>$uscont){
	$idinvoelem= $uscont["id"];
	$mylist[$uskey]["rowedit"]= geturl($modeel."&rowedit=".$idinvoelem);
	$mylist[$uskey]["rowdele"]= geturl($modeel."&rowdele=".$idinvoelem);
//	$mylist[$uskey]["rowview"]= geturl($modeel."&view=".$idinvoelem);
}


# add new link 
$addnew= geturl($modeel."&rowedit=0");

# извеждаме 
$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
//$pagecont= smdisp("finainvoview.tpl","fetch");
print smdisp("finainvo2.ajax.tpl","iconv");


?>