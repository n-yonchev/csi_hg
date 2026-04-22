<?php
# извежда списък събирачи и събрани пари в-брой - за всички филтри 
# източник : fdxxlist.php 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
# и още отгоре : 
#    $view - кода на филтъра за параметрите 
#   	 $filter - готовия филтър 
//print_r($GETPARAM);
//var_dump($view);

/*****
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

# текущата страница 
//print_r($GETPARAM);
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

//#------- прилагаме филтъра ------- 
//$filter= "year=$view";
# списъка 
		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
		$query= "select docu.*, docu.id as id
				,user.name as u2name
			from docu
				left join user on docu.iduser=user.id
			where $filter 
			order by docu.year desc, docu.serial desc
			";
		$prefurl= "";
//		$baseurl= "mode=".$mode;
		$baseurl= "mode=".$mode."&view=".$view;
		$obpagi= new paginator(20, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);
*****/
									/***
									# списък суми за избран събирач 
									$pers= $GETPARAM["pers"];
									if (isset($pers)){
										include_once "finacashlist.ajax.php";
										exit;
									}else{
									}
									***/

# списъка според филтъра - без странициране 
# finance.cashiduser - събирача 
	# само постъпления в-брой 
	$filttype= "finance.idtype=2";
/*
$mylist= $DB->select("
	select sum(finance.inco) as suma
		,suit.serial as caseseri ,suit.year as caseyear 
	from finance
		left join suit on finance.idcase=suit.id
		left join user on suit.iduser=user.id
			left join user as t2user on finance.iduser=user.id
	where $filttype and $filter
	group by t2user.id
	");
*/
$mylist= $DB->select("
	select sum(finance.inco) as suma
		, t2user.id as idperson, t2user.name as person
	from finance
	left join user as t2user on finance.cashiduser=t2user.id
	where $filttype and $filter
	group by t2user.id
	");
$mylist= dbconv($mylist);

/****
# трансформираме го - параметри за иконите 
//				$modeel= "mode=".$mode ."&seeknome=".$seeknome ."&page=".$page;
				$modeel= "mode=".$mode ."&view=".$view ."&page=".$page;
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
//				$mycase= $uscont["idcase"];
	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
				# 13.04.2009 - маскираме спец.символи в коментара 
	$mylist[$uskey]["notes"]= htmlspecialchars( $mylist[$uskey]["notes"] ,ENT_QUOTES);
				# 13.04 2009 - един документ - много дела 
				# добавяме масив със свързаните дела 
				# НЕЕФЕКТИВНО - заявки в цикъл 
				$caselist= getcaselist($idcurr);
	$mylist[$uskey]["caselist"]= $caselist;
				# и броя на делата 
	$mylist[$uskey]["casecoun"]= count($caselist);
				# и линк за разглеждане на списъка в nyroModal 
	$mylist[$uskey]["viewlist"]= geturl($modeel."&viewlist=".$idcurr);
}
//print_r($mylist);

//# add new link 
//$addnew= geturl($modeel."&edit=0");

				# 13.04 2009 - един документ - много дела 
# допълнителни js линкове за секцията head 
$smarty->assign("HEADJS", array("cluetip.hoverIntent.js","jquery.cluetip.js"));
****/

# трансформираме го - параметри за иконите 
				$modeel= "mode=".$mode ."&view=".$view;
foreach ($mylist as $uskey=>$uscont){
				$idpers= $uscont["idperson"] +0;
				# и линк за разглеждане на списъка в nyroModal 
	$mylist[$uskey]["pers"]= geturl($modeel."&pers=".$idpers);
}
//print_r($mylist);
//print_rr($_SESSION);

# извеждаме 
//$smarty->assign("YEAR", $view);
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("finacashpers.tpl","fetch");

?>
