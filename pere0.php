<?php
# списък дела за перемция - от Милен 28.03.2017 
# последните ДВЕ години делото да няма 
#     нито постъпления 
#     нито изходени изх.документи от шаблони с флаг docutype.idpere=1 
//print_rr($GETPARAM);
//print_rr($_POST);

//# статус перемирано 
//$idstatpere= 4;
//$smarty->assign("IDSTATPERE", $idstatpere);

//# подготовка 
//# за всички вече перемирани дела - премахваме указателя за разпореждане
//$DB->query("update suit set idor2=0 where idstat in (4)");

													//# 06.04.2016 - всичко за планирането 
													//include_once "taxe.inc.php";
											//include_once "taxe2.inc.php";

# текущата страница 
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

# остав.дни 
$daysrest= $_POST["daysrest"];
if (isset($daysrest)){
	$daysrest += 0;
	outpara($daysrest,$p1inlist,$p1outlist);
	$resupara= inpara();
	list($p1days,$p1inlist,$p1outlist)= $resupara;
	$page= 1;
}else{
}
$_POST["daysrest"]= $p1days +0;

# базов линк за рефреш 
$modeel= "mode=".$mode."&vari=".$vari."&page=".$page;
$relurl= geturl($modeel);

# базов линк за странициране 
$modebase= "mode=".$mode."&vari=".$vari;

# базов линк за връщане на страница 
$modeel= $modebase."&page=".$page;
					
					# разглеждане на избрано дело 
					# източник : case.php 
					$edit= $GETPARAM["edit"];
					if (isset($edit)){
$smarty->assign("NOVARI", true);
												$FLAGNOCHANGE= true;
												$smarty->assign("FLAGNOTABS", true);
							include_once "caseedit.php";
# назад към списъка с дела 
$smarty->assign("PAGEBACKTEXT", "назад към стр.$page от списъка за перемиране");
$smarty->assign("PAGEBACKLINK", geturl($modeel));
$pagecont= smdisp("caseedit.tpl","fetch");
return;
					}else{
					}
# странициране 
$query= "
	select t4.*, t4.idcase as ARRAY_KEY
		$p4sele
	from ($q4) as t4
		left join user on t4.iduser=user.id
	order by t4.idcase
desc
	";
					include "pagi.class.php";
		$prefurl= "";
		$baseurl= $modebase;
		$obpagi= new paginator(28, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$ardata= dbconv($mylist);
					$arin= array();
foreach($ardata as $idcase=>$elem){
					$arin[]= $idcase;
	//$ardata[$idcase]["ordegene"]= geturl($modeel."&ordegene=".$idcase);
	//$ardata[$idcase]["topere"]= geturl($modeel."&topere=".$idcase);
	//$ardata[$idcase]["nopere"]= geturl($modeel."&nopere=".$idcase);
	$ardata[$idcase]["edit"]= geturl($modeel."&edit=".$idcase);
}
$smarty->assign("ARDATA", $ardata);
//print_ru($ardata);
//var_dump($modeel);

# взискатели и длъжници по дела 
					$codein= empty($arin)?"0":implode(",",$arin);
$arclai= $DB->selectCol("select idcase as ARRAY_KEY1, id as ARRAY_KEY2, name from claimer where idcase in ($codein)");
$arclai= dbconv($arclai);
$ardebt= $DB->selectCol("select idcase as ARRAY_KEY1, id as ARRAY_KEY2, name from debtor where idcase in ($codein)");
$ardebt= dbconv($ardebt);
$smarty->assign("ARCLAI", $arclai);
$smarty->assign("ARDEBT", $ardebt);

/*
# данни за изх.документи от разпореждане по делата 
$ardout= $DB->select("
	select txorde.idcase as ARRAY_KEY, txordeelem.id as ARRAY_KEY2
		, docutype.text as dttext
		, docuout.serial as doseri, docuout.year as doyear, docuout.created as docrea
		, docuout.registered as doregi, docuout.regigroup as dogrou
		, txordeelem.p2poin
	from txordeelem
		left join txorde on txordeelem.idorde=txorde.id
		left join suit on txorde.idcase=suit.id
		left join docutype on txordeelem.idpoin=docutype.id
		left join docuout on txordeelem.p2poin=docuout.id
	where txorde.idcase in ($codein) and txordeelem.idorde=suit.idor2
	");
$ardout= dbconv($ardout);
$smarty->assign("ARDOUT", $ardout);
//print_ru($ardout);
*/

					
					# 06.11.2018 - автоматично назначаване на разпореждания за свършване 
					# скрит линк 
					$smarty->assign("TOST16", geturl("mode=st16"));
# извеждане 
					//$smarty->assign("ARSTAT", $listcasestat);
					$smarty->assign("ARSTAT", $viewcasestat);
$pagecont= smdisp("pere0.tpl","fetch");


?>