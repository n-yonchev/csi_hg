<?php
# извежда списък вх.документи - за всички филтри 
# източник : docu.php 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
# и още отгоре : 
#    $filter - готовия филтър 
//print_r($GETPARAM);
//var_dump($view);

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

# извеждаме 
//$smarty->assign("YEAR", $view);
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("fdxxlist.tpl","fetch");
//$pagecont= smdisp("docu.tpl","fetch");

?>
