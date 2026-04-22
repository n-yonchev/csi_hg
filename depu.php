<?php
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 

# права само за админа 
adminonly();
/*
# текущата страница 
//print_r($GETPARAM);
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;
*/

# общи фрагменти 
//$frjoin= "left join suit on user.id=suit.iduser";
//$frwher= "and suit.id is not null";
$frgrou= "group by user.id";
									# определяне на заместник 
									$edit= $GETPARAM["edit"];
									if (isset($edit)){
										include_once "depuedit.ajax.php";
										exit;
//return;
									}else{
									}
									# прекратяване на заместване 
									$dele= $GETPARAM["dele"];
									if (isset($dele)){
										include_once "depudele.ajax.php";
										exit;
//return;
									}else{
									}

# брой дела по деловодители 
$counlist= $DB->selectCol("select iduser as ARRAY_KEY, count(*) from suit group by iduser");
$smarty->assign("COUNLIST", $counlist);

# списъка - титуляри и заместниците им 
$mylist= $DB->select("
	select user.*, user.id as id
			, t2.name as namedepu, t2.id as isnamedepu, t2depu.id as idconn
	from user
$frjoin
			left join userdepu on user.id=userdepu.iduserorig
			left join user as t2 on userdepu.iduserdepu=t2.id
					left join userdepu as t2depu on user.id=t2depu.iduserdepu
	where 1 $frwher
$frgrou
	order by user.name
	");
/*
		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
		$query= "select * from user order by name";
		$prefurl= "";
		$baseurl= "mode=".$mode;
		$obpagi= new paginator(18, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
*/
$mylist= dbconv($mylist);
//print_rr($mylist);

# трансформираме го - параметри за иконите 
//				$modeel= "mode=".$mode."&page=".$page;
				$modeel= "mode=".$mode;
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
	$mylist[$uskey]["dele"]= geturl($modeel."&dele=".$idcurr);
}

//# add new link 
//$addnew= geturl($modeel."&edit=0");

# извеждаме 
//$smarty->assign("ADDNEW", $addnew);
$smarty->assign("USERLIST", $mylist);
$pagecont= smdisp("depu.tpl","fetch");

?>
