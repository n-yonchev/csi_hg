<?php
# списък на оригиналните постъпления (входящите недублирани преводи) от избрано банково извлечение 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $page - текущата страница - от списъка с извлеченията 
#  $bapaelem - избраното извлечение 
#  $codeneww - MySQL код за нужните записи - входящите недублирани преводи 
//$codeneww= "AMOUNT_C<>'' and isdubl=0";

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

# текущата страница - от списъка с постъпленията 
//print_r($GETPARAM);
$pageelem= $GETPARAM["pageelem"];
$pageelem= isset($pageelem) ? $pageelem : 1;
									
									# статус "маркиран" за избран превод 
									$mark= $GETPARAM["mark"];
									if (isset($mark)){
//										include_once "bapaedit.ajax.php";
//										exit;
										$DB->query("update bank set idclaimer=-1 where id=$mark");
									}else{
									}
									# статус "ненасочен" за избран превод 
									$free= $GETPARAM["free"];
									if (isset($free)){
//										include_once "bapaedit.ajax.php";
//										exit;
										$DB->query("update bank set idclaimer=0 where id=$free");
									}else{
									}
							# назначаване на избран запис - извлечение към взискател от дело 
							# вика се в ajax прозорец 
							$direcase= $GETPARAM["direcase"];
							if (isset($direcase)){
										include_once "bapaelemdire.ajax.php";
										exit;
							}else{
							}
							# корекция на данните за изходящо плащане - само за вече назначено постъпление 
							# вика се в ajax прозорец 
							$editpaym= $GETPARAM["editpaym"];
							if (isset($editpaym)){
										include_once "bapaelemedit.ajax.php";
										exit;
							}else{
							}
/*
							#--------------------------------------------------------------
							# назначаване към дело на избран запис - извлечение 
							# извеждаме в главния прозорец, а не в ajax 
							# източник : case.php - caseedit.php - bapa.php 
							$direcase= $GETPARAM["direcase"];
							if (isset($direcase)){
print "<b>direcase=[$direcase]</b>";
										include_once "bapaelemdire.php";
$smarty->assign("PAGEBACK_DIRE", $pageelem);
	$baseurl= "mode=".$mode ."&page=".$page ."&bapaelem=".$bapaelem ."&pageelem=".$pageelem;
$smarty->assign("PAGEBACKLINK_DIRE", geturl($baseurl));
$pagecont= smdisp("bapaelemdire.tpl","fetch");
//print smdisp("bapaelemdire.tpl","fetch");
return;
//										exit;
							}else{
							}
							#--------------------------------------------------------------
*/

# данни за извлечението 
$roelem= getrow("bankpack",$bapaelem);

# списъка - странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
//		$query= "select * from bank where $codeneww and idbankpack=$bapaelem order by id";
		$query= "select bank.*, bank.id as id
				,suit.serial as caseseri ,suit.year as caseyear
				,claimer.name as clainame
			from bank 
				left join claimer on bank.idclaimer=claimer.id
				left join suit on claimer.idcase=suit.id
			where $codeneww and idbankpack=$bapaelem 
			order by bank.id
			";
		$prefurl= "";
		$baseurl= "mode=".$mode ."&page=".$page ."&bapaelem=".$bapaelem ."&pageelem=".$pageelem;
		$obpagi= new paginator(10, 8, $query);
		# ВНИМАНИЕ. 
		# използваме специалния 4-ти параметър - заради рекурсивното използване 
		$mylist= $obpagi->calculate($pageelem, $prefurl, $baseurl    ,"pageelem");
$mylist= dbconv($mylist);

# трансформираме списъка - параметри за иконите 
//				$modeel= "mode=".$mode ."&page=".$page;
				$modeel= $baseurl;
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
	$mylist[$uskey]["direcase"]= geturl($modeel."&direcase=".$idcurr);
	$mylist[$uskey]["editpaym"]= geturl($modeel."&editpaym=".$idcurr);
	$mylist[$uskey]["mark"]= geturl($modeel."&mark=".$idcurr);
	$mylist[$uskey]["free"]= geturl($modeel."&free=".$idcurr);
}

# извеждаме 
$smarty->assign("HEADDATA", $roelem);
$smarty->assign("DATA", $mylist);


?>
