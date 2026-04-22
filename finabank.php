<?php
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
									
									# функции, свързани с финансите 
									include_once "fina.inc.php";

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

# текущата страница 
//print_r($GETPARAM);
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

/*
# MySQL код за броячите - по типове 
$codetota= "1";
$codeinpu= "AMOUNT_C<>''";
$codeneww= "AMOUNT_C<>'' and isdubl=0";
$codefree= "AMOUNT_C<>'' and isdubl=0 and idclaimer=-1";
$codenotd= "AMOUNT_C<>'' and isdubl=0 and idclaimer=0";
*/
									# корекция на избран запис 
									# важи само за нов запис - $edit==0 
									$edit= $GETPARAM["edit"];
									if (isset($edit)){
										include_once "finabankedit.ajax.php";
										exit;
									}else{
									}
								/*
								# списък на преводите за избран запис - извлечение 
								# извеждаме в главния прозорец, а не в ajax 
								# източник : case.php - caseedit.php 
								$bapaelem= $GETPARAM["bapaelem"];
								if (isset($bapaelem)){
$smarty->assign("PAGEBACK", $page);
//print "mode=".$mode ."&page=".$page;
//$smarty->assign("PAGEBACKLINK", geturl("mode=".$mode ."&page=".$page ."&filt=".$filt));
$smarty->assign("PAGEBACKLINK", geturl("mode=".$mode ."&page=".$page));
										include_once "bapaelem.php";
		# ВНИМАНИЕ. 
		# ако вътрешния скрипт $bapaelemdire.php вече е формирал съдържанието 
		if (isset($pagecont)){
		}else{
$pagecont= smdisp("bapaelem.tpl","fetch");
		}
return;
//										exit;
								}else{
								}
								*/

									# редовете на избран запис - извлечение 
									$viewrows= $GETPARAM["viewrows"];
									if (isset($viewrows)){
										include_once "finarows.ajax.php";
										exit;
									}else{
									}

# списъка 
		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
		$query= "select * from finabank order by id desc";
/*
		$query= "select cash.*, cash.id as id
			,debtor.name as debtname ,suit.serial as suseri ,suit.year as suyear
			from cash 
			left join debtor on cash.iddebtor=debtor.id
			left join suit on debtor.idcase=suit.id
			order by date desc
			";
*/
		$prefurl= "";
		$baseurl= "mode=".$mode;
		$obpagi= new paginator(12, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);

/*
# списък на всички id 
		$inlist= array();
foreach($mylist as $myelem){
		$inlist[]= $myelem["id"];
}
		$incode= implode(",",$inlist);
# MySQL код за принадлежност към списъка 
		if ($incode==""){
$codein= "1";
		}else{
$codein= "idbankpack in ($incode)";
		}
# MySQL код за филтрите 
$filttota= "$codein and $codetota";
$filtinpu= "$codein and $codeinpu";
$filtneww= "$codein and $codeneww";
$filtfree= "$codein and $codefree";
$filtnotd= "$codein and $codenotd";
# общ шаблон на заявка за брояч 
$qutemp= "select idbankpack as ARRAY_KEY, count(id) from bank where %s group by idbankpack";

# заявките за броячи 
$arcoun= array();
$arcoun["tota"]= $DB->selectCol(sprintf($qutemp,$filttota));
$arcoun["inpu"]= $DB->selectCol(sprintf($qutemp,$filtinpu));
$arcoun["neww"]= $DB->selectCol(sprintf($qutemp,$filtneww));
$arcoun["free"]= $DB->selectCol(sprintf($qutemp,$filtfree));
$arcoun["notd"]= $DB->selectCol(sprintf($qutemp,$filtnotd));
//print_r($arcoun);
*/

# трансформираме списъка - параметри за иконите 
# - списък на преводите за избран запис - важи само за съществуващ - $edit<>0 
				$modeel= "mode=".$mode ."&page=".$page;
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
//	$mylist[$uskey]["bapaelem"]= geturl($modeel."&bapaelem=".$idcurr);
	$mylist[$uskey]["viewrows"]= geturl($modeel."&viewrows=".$idcurr);
//	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
//	$mylist[$uskey]["fini"]= geturl($modeel."&fini=".$idcurr);
//	$mylist[$uskey]["view"]= geturl($modeel."&view=".$idcurr);
}
//print_r($mylist);

# допълнителни js линкове за секцията head 
$smarty->assign("HEADJS", array("cluetip.hoverIntent.js","jquery.cluetip.js"));

# add new link 
$addnew= geturl($modeel."&edit=0");
									# за извеждане на банка 
									$smarty->assign("BANKLIST", $listxmltype);
									

# извеждаме 
$smarty->assign("ADDNEW", $addnew);
//$smarty->assign("ARCOUN", $arcoun);
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("finabank.tpl","fetch");

?>
