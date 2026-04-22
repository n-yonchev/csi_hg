<?php
#------------------ ЛЕПЕНКА ЗА АДМИНА -----------------------
# само новите документи и насочените към дела за 2009 год. 
# източник : docu.php 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

# текущата страница 
//print_r($GETPARAM);
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

# година за филтъра на делата 
$caseyear= "2009";

									# корекция на избран запис 
									$edit= $GETPARAM["edit"];
									if (isset($edit)){
										include_once "docu09edit.ajax.php";
										exit;
									}else{
									}

# списъка 
//$mylist= $DB->select("select * from docu order by year desc, serial desc");
$myquery= "
	select docu.* ,docu.id as id
		,suit.serial as caseseri ,suit.year as caseyear
		,user.name as username
	from docu
		left join (select * from suit where year=$caseyear) as suit on docu.idcase=suit.id
		left join user on suit.iduser=user.id
	where docu.idcase=-1 or suit.id is not null
	order by docu.year desc, docu.serial desc
	";
		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
		$query= $myquery;
		$prefurl= "";
		$baseurl= "mode=".$mode;
		$obpagi= new paginator(18, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);

# трансформираме го - параметри за иконите 
//				$modeel= "mode=".$mode;
				$modeel= "mode=".$mode."&page=".$page;
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
//	$mylist[$uskey]["acti"]= geturl($modeel."&acti=".$idcurr);
//	$mylist[$uskey]["inac"]= geturl($modeel."&inac=".$idcurr);
}

# add new link 
$addnew= geturl($modeel."&edit=0");

//# допълнителни js линкове за секцията head 
//$smarty->assign("HEADJS", array("_docu.js"));

# извеждаме 
$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("docu09.tpl","fetch");

# ВНИМАНИЕ. 
# Трябва да е след smdisp, защото след извеждането [display, fetch] 
# обекта $smarty губи назначенията $smarty->assign 
//# допълнителни js линкове за секцията head 
//$smarty->assign("HEADJS", array("_docu.js"));

?>
