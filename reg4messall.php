<?php
# отгоре : 
#    $iduser - логнатия деловодител 
//print_rr($GETPARAM);


					# списък дела с грешки 
					$view= $GETPARAM["view"];
					if (isset($view)){
/*
$smarty->assign("PAGEBACK", $page);
$smarty->assign("PAGEBACKTEXT", "назад към стр.$page от списъка дела");
$smarty->assign("PAGEBACKLINK", geturl($modeel));
$pagecont= smdisp("caseedit.tpl","fetch");
*/
			$reg4user= $view;
			$modeel= "mode=".$mode ."&view=".$view;
			include_once "reg4usermess.php";
return;
					}else{
					}

# общ брой дела по деловодители 
$arcase= $DB->selectCol("
	select suit.iduser as ARRAY_KEY, count(*)
	from suit 
	group by suit.iduser
	");
$smarty->assign("ARCASE", $arcase);
//print_ru($arcase);

# брой дела с грешки по деловодители 
$armess= $DB->selectCol("
	select suit.iduser as ARRAY_KEY, count(reg4mess.id)
	from reg4mess 
	left join suit on reg4mess.idcase=suit.id
	group by suit.iduser
	");
$smarty->assign("ARMESS", $armess);
//print_ru($armess);

# деловодители 
$userlist= getselect("user","name","1",true);
$userlist= dbconv($userlist);
$smarty->assign("USERLIST", $userlist);
//print_ru($userlist);

$modeel= "mode=".$mode;
					$arlink= array();
# трансформиране 
foreach ($arcase as $idus=>$x2){
					$arlink[$idus]["view"]= geturl($modeel."&view=".$idus);
}
//print_rr($arlink);
$smarty->assign("ARLINK", $arlink);

# извеждане 
//$smarty->assign("LIST", $mylist);
$pagecont= smdisp("reg4messall.tpl","fetch");


?>