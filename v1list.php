<?php
# дела на избран наблюдател 
# източник : case.php 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $page - текущата страница от списъка на наблюдателите 
# $viewer - наблюдателя viewer.id 
# $delall=0 - признак за действието "изтрий всички" 

# данни за наблюдателя 
$roview= getrow("viewer",$viewer);
$smarty->assign("ROVIEW", $roview);
# брой дела на наблюдателя 
$vicoun= $DB->selectCell("select count(distinct idcase) from viewersuit where idviewer=?d"  ,$viewer);

# текущата страница от списъка дела на наблюдателя - $pagecase 
//print_r($GETPARAM);
$pagecase= $GETPARAM["pagecase"];
$pagecase= isset($pagecase) ? $pagecase : 1;

#--------------- действия -------------------------------------------------------------

									# добави дело/дела към списъка на наблюдателя 
									$addcas= $GETPARAM["addcas"];
									if (isset($addcas)){
# назад към списъка наблюдатели 
$smarty->assign("PAGEBACK2", $page);
$smarty->assign("PAGEBACKTEXT2", "назад към списъка от $vicoun дела на наблюдателя ".$roview["name"]);
//$smarty->assign("PAGEBACKLINK2", geturl("mode=".$mode ."&page=".$page ."&viewer=".$viewer));
$smarty->assign("PAGEBACKLINK2", geturl("mode=".$mode ."&page=".$page  ."&viewer=".$viewer ."&flagall=".$flagall."&filtname=".$filtname));
//$pagecont= smdisp("v1addc.tpl","fetch");
										//include_once "v1addc.ajax.php";
										include_once "v1addc.php";
//										exit;
return;
									}else{
									}

# ИЗключваме само маркираните дела 
//print_rr($_POST);
$marklist= $_POST["marklist"];
if (isset($marklist)){
	foreach($marklist as $elem){
		$DB->query("delete from viewersuit where idcase=?d and idviewer=?d"  ,$elem,$viewer);
	}
}else{
}

# ИЗключваме ВСИЧКИ дела от списъка 
//print_rr($_POST);
					$delall= $GETPARAM["delall"];
					if (isset($delall)){
$DB->query("delete from viewersuit where idviewer=?d"  ,$viewer);
					}else{
					}

#--------------- край на действията -------------------------------------------------------------

# списъка по страници - страницата е $pagecase 
$filter= "viewersuit.id is not null and viewersuit.idviewer=$viewer";
				if (class_exists("paginator")){
				}else{
					include "pagi.class.php";
				}
$query= "select distinct suit.id as id, suit.*
				, user.name as username
					, agent.name as agenname
	from suit 
				left join user on suit.iduser=user.id
					left join agent on suit.idagent=agent.id
				left join viewersuit on suit.id=viewersuit.idcase
	where $filter
	order by suit.year desc, suit.serial desc
	";
		$prefurl= "";
//		$baseurl= "mode=".$mode ."&page=".$page ."&viewer=".$viewer;
		$baseurl= "mode=".$mode ."&page=".$page ."&viewer=".$viewer ."&flagall=".$flagall."&filtname=".$filtname;
		$obpagi= new paginator(30, 8, $query);
//		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
		# ВНИМАНИЕ. 4-ти параметър - променлива за номера на страницата 
		$mylist= $obpagi->calculate($pagecase, $prefurl, $baseurl  ,"pagecase");
$mylist= dbconv($mylist);

# базов URL за иконите 
//$modeel= "mode=".$mode ."&page=".$page ."&viewer=".$viewer ."&pagecase=".$pagecase;
$modeel= "mode=".$mode ."&page=".$page ."&viewer=".$viewer ."&pagecase=".$pagecase  ."&flagall=".$flagall."&filtname=".$filtname;
# трансформираме списъка - параметри за иконите 
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
	$mylist[$uskey]["dele"]= geturl($modeel."&dele=".$idcurr);
}
//print_rr($mylist);
		
		# списъка с взискатели за всички дела на наблюдателя 
		$listclai= $DB->selectCol("
			select claimer.idcase as ARRAY_KEY1, claimer.id as ARRAY_KEY2, claimer.name
			from claimer
			left join viewersuit on claimer.idcase=viewersuit.idcase and viewersuit.idviewer=?d
			where viewersuit.id is not null
			"  ,$viewer);
		$listclai= dbconv($listclai);
$smarty->assign("LISTCLAI",$listclai);

							# за извеждане на "идва от" - кеширания масив 
							$arfrom= unserialize(file_get_contents(COFROMFILE));
							# предаваме съдържанието 
							$smarty->assign("ARFROM", $arfrom);
						# 03.05.2009 
						# за извеждане на статуса - съдържанието на 1-мерния масив 
						$smarty->assign("ARSTAT", $viewcasestat);

# общия брой дела от всички страници 
$counto= $DB->selectCell("
	select count(*) from viewersuit where idviewer=$viewer
	");
$smarty->assign("COUNTO", $counto);


# addcas link - добави дело/дела 
$addcas= geturl($modeel."&addcas=0");

# линк изтрий всички дела от списъка 
//$linkdelall= geturl($baselink."&delcall=0");
$linkdelall= geturl($modeel."&delall=0");
$smarty->assign("LINKDELALL", $linkdelall);
			
# извеждаме 
$smarty->assign("ADDCAS", $addcas);
$smarty->assign("CASELIST", $mylist);
$pagecont= smdisp("v1list.tpl","fetch");

?>
