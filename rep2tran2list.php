<?php

/*
$rotran= explode("^",$sear);
	$name2= $rotran[0];
	$idre2= $rotran[1];
	$ismu2= $rotran[2];
$rot2= tran1251($rotran);
$smarty->assign("NAME", $rot2[0]);
$smarty->assign("IDRE", $rot2[1]);
$smarty->assign("ISMU", $rot2[2]);
*/

$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;
//$modeel= "mode=".$mode."&sear=".$sear."&page=".$page;
$modeel= $modebase."&sear=".$sear."&page=".$page;

#-------------------------------------------------------------------------------------------
					$edit= $GETPARAM["edit"];
					if (isset($edit)){
												//$FLAGNOCHANGE= getnochange($edit);
												$smarty->assign("FLAGNOTABS", true);
							include_once "caseedit.php";
//$smarty->assign("PAGEBACK", $page);
$smarty->assign("PAGEBACKTEXT", "назад към стр.$page от списъка дела");
	$datacase= getrow("suit",$edit);
	$smarty->assign("PAGEDATACASE", $datacase);
//$smarty->assign("PAGEBACKLINK", geturl("mode=".$mode ."&sear=".$sear."&page=".$page));
$smarty->assign("PAGEBACKLINK", geturl($modeel));
$pagecont= smdisp("caseedit.tpl","fetch");
//$rep2cont= smdisp("caseedit.tpl","fetch");
return;
					}else{
					}
#-------------------------------------------------------------------------------------------

$rotran= explode("^",$sear);
	$name2= $rotran[0];
	$idre2= $rotran[1];
	$ismu2= $rotran[2];
$rot2= tran1251($rotran);
$smarty->assign("NAME", $rot2[0]);
$smarty->assign("IDRE", $rot2[1]);
$smarty->assign("ISMU", $rot2[2]);
	
$filtname= "$codename='$name2'";
$filtrepo= "suit.idrepo=$idre2";

#-------------------------------------------------------------------------------------------
					$tranrepo= $GETPARAM["tranrepo"];
					if (isset($tranrepo)){
$artran= $DB->selectCol("
	select rep2tran.idcase
	from rep2tran
	left join claimer on rep2tran.idclai=claimer.id
	left join suit on rep2tran.idcase=suit.id
	where $filtname and $filtrepo
	");
foreach($artran as $idcase){
	updrow("suit",$idcase,"idrepo=$tranrepo");
}
//$rel4= geturl("mode=".$mode);
$rel4= geturl($modebase);
reload("",$rel4);
					}else{
					}
#-------------------------------------------------------------------------------------------

$qucase= "
	select rep2tran.idcase as idcase
		, suit.serial as caseseri ,suit.year as caseyear 
		, suit.idcofrom as casefrom, suit.created as casedate
		, suit.idstat as idstat, suit.timestat as timestat, suit.text as casetext
		, user.name as username
	from rep2tran
	left join claimer on rep2tran.idclai=claimer.id
	left join suit on rep2tran.idcase=suit.id
		left join user on suit.iduser=user.id
	where $filtname and $filtrepo
	order by suit.year, suit.serial
	";
					include "pagi.class.php";
		$prefurl= "";
//		$baseurl= "mode=".$mode."&sear=".$sear;
		$baseurl= $modebase."&sear=".$sear;
		$obpagi= new paginator(20, 8, $qucase);
$arcase= $obpagi->calculate($page, $prefurl, $baseurl);
$arcase= dbconv($arcase);
				$arid= array();
//$modeel= "mode=".$mode."&sear=".$sear."&page=".$page;
foreach($arcase as $indx=>$elem){
	$idcase= $elem["idcase"];
				$arid[]= $idcase;
	$arcase[$indx]["edit"]= geturl($modeel."&edit=".$idcase);
}
				$codein= implode(",",$arid);
				$codein= empty($codein) ? "0" : $codein;
$smarty->assign("ARCASE", $arcase);
//print_ru($arcase);

		$listclai= $DB->select("select idtype, name, idcase as ARRAY_KEY1, id as ARRAY_KEY2 from claimer where idcase in ($codein) order by id");
		$listclai= dbconv($listclai);
$smarty->assign("LISTCLAI", $listclai);
		$listdebt= $DB->select("select idtype, name, idcase as ARRAY_KEY1, id as ARRAY_KEY2 from debtor where idcase in ($codein) order by id");
		$listdebt= dbconv($listdebt);
$smarty->assign("LISTDEBT", $listdebt);

$arfrom= unserialize(file_get_contents(COFROMFILE));
$smarty->assign("ARFROM", $arfrom);
$smarty->assign("ARSTAT", $viewcasestat);
$smarty->assign("ARREPO", $viewrepo);

$coderepo= $ismu2.",".$idre2;
$resurepo= getrepo($coderepo);
if ($resurepo===0){
}else{
	if (is_array($resurepo)){
		$ar2= $resurepo;
	}else{
		$ar2= array($resurepo);
	}
			$arlink= array();
	foreach($ar2 as $newrepo){
			$arlink[$newrepo]= geturl($modeel."&tranrepo=".$newrepo);
	}
	$smarty->assign("ARLINK", $arlink);
}

?>