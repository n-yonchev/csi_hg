<?php
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

							# всичко за сканираните вх.документи 
							include_once "docuedituplo.inc.php";

# текущата страница 
//print_r($GETPARAM);
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

# общи параметри 
$modeel= "mode=".$mode."&page=".$page;
$relurl= geturl($modeel);
							# управление на действията 
							include_once "docuedituplo2.inc.php";

									# корекция на избран запис 
									$edit= $GETPARAM["edit"];
									if (isset($edit)){
										include_once "docuedit.ajax.php";
										exit;
									}else{
									}
									
				# 13.04 2009 - един документ - много дела 
									# разглеждане на списъка с дела в nyroModal 
									$viewlist= $GETPARAM["viewlist"];
									if (isset($viewlist)){
										include_once "docuviewlist.ajax.php";
										exit;
									}else{
									}
											# 20.04.2015 масово сканиране 
							$modebase= $modeel."&scanmass=yes";
							$scanmasslink= geturl($modeel."&scanmass=yes");
							$smarty->assign("SCANMASSLINK", $scanmasslink);
				$smarty->assign("RELOLINK", $relurl);
											$scanmass= $GETPARAM["scanmass"];
											if (isset($scanmass)){
												include_once "scanmass.ajax.php";
												exit;
											}else{
											}

# списъка 
//$mylist= $DB->select("select * from docu order by year desc, serial desc");
/*
$myquery= "
	select docu.* ,docu.id as id
		,suit.serial as caseseri ,suit.year as caseyear
		,user.name as username
					,u2.name as u2name
	from docu
		left join suit on docu.idcase=suit.id
		left join user on suit.iduser=user.id
					left join user as u2 on docu.iduser=u2.id
	order by docu.year desc, docu.serial desc
	";
*/
				# 13.04 2009 - един документ - много дела 
$myquery= "
	select docu.* ,docu.id as id
					,u2.name as u2name
	from docu
					left join user as u2 on docu.iduser=u2.id
	order by docu.year desc, docu.serial desc
	";

		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
		$query= $myquery;
		$prefurl= "";
		$baseurl= "mode=".$mode;
//		$obpagi= new paginator(18, 8, $query);
		$obpagi= new paginator(200, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);
//print_r(toutf8($mylist));

# трансформираме го - параметри за иконите 
//				$modeel= "mode=".$mode;
				$modeel= "mode=".$mode."&page=".$page;
									$arin= array();
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
				# 13.04.2009 - маскираме спец.символи в коментара 
	$mylist[$uskey]["notes"]= htmlspecialchars( $mylist[$uskey]["notes"] ,ENT_QUOTES);
				# 13.04 2009 - един документ - много дела 
				# добавяме масив със свързаните дела 
				# НЕЕФЕКТИВНО - заявки в цикъл 
/*
				$casequ= "
				select 
					suit.serial as caseseri ,suit.year as caseyear
					,user.name as username
				from docusuit
					left join suit on docusuit.idcase=suit.id
					left join user on suit.iduser=user.id
				where docusuit.iddocu=?d
				order by docusuit.docurange
				";
				$caselist= $DB->select($casequ ,$idcurr);
				$caselist= dbconv($caselist);
*/
				$caselist= getcaselist($idcurr);
	$mylist[$uskey]["caselist"]= $caselist;
				# и броя на делата 
	$mylist[$uskey]["casecoun"]= count($caselist);
				# и линк за разглеждане на списъка в nyroModal 
	$mylist[$uskey]["viewlist"]= geturl($modeel."&viewlist=".$idcurr);
							# сканиран образ 
									$arin[]= $idcurr;
	$mylist[$uskey]["scanuplo"]= geturl($modeel."&scanuplo=".$idcurr);
	$mylist[$uskey]["scanview"]= geturl($modeel."&scanview=".$idcurr);
}
							# брой сканирани образи по вх.документи 
									$codein= implode(",",$arin);
							$arscancoun= getscancoun("iddocu in ($codein)");
//print_rr($arscancoun);
$smarty->assign("ARSCANCOUN", $arscancoun);
											# 20.04.2015 масово сканиране 
											# брой масово сканирани образи по вх.документи 
											if (empty($userprin)){
											}else{
												$armassscancoun= getscancoun("iddocu in ($codein) and ismass=1");
//print_rr($armassscancoun);
												$smarty->assign("ARMASSSCANCOUN", $armassscancoun);
											}

# add new link 
$addnew= geturl($modeel."&edit=0");

				# 13.04 2009 - един документ - много дела 
# допълнителни js линкове за секцията head 
$smarty->assign("HEADJS", array("cluetip.hoverIntent.js","jquery.cluetip.js"));

# флага за образуване - не 
$_SESSION["iscreacase"]= false;

# извеждаме 
$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("docu.tpl","fetch");

# ВНИМАНИЕ. 
# Трябва да е след smdisp, защото след извеждането [display, fetch] 
# обекта $smarty губи назначенията $smarty->assign 
//# допълнителни js линкове за секцията head 
//$smarty->assign("HEADJS", array("_docu.js"));

?>
