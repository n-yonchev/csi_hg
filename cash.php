<?php
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
									/**/
									# корекция на заделената сума за избран запис 
									$editsepa= $GETPARAM["editsepa"];
									if (isset($editsepa)){
										include_once "casheditsepa.ajax.php";
										exit;
									}else{
									}
									/**/

# списъка 
		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
//		$query= "select * from cash order by date desc";
/*
		$query= "select cash.*, cash.id as id
			,debtor.name as debtname ,suit.serial as suseri ,suit.year as suyear
			from cash 
			left join debtor on cash.iddebtor=debtor.id
			left join suit on debtor.idcase=suit.id
			order by date desc
			";
*/
					# получаваме заявката $query - всички прих.ордери 
					include "cash.inc.php";
					$query= getcashquery();
		$prefurl= "";
		$baseurl= "mode=".$mode;
		$obpagi= new paginator(8, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);

# трансформираме го - параметри за иконите 
				$modeel= "mode=".$mode ."&page=".$page;
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
//	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
	$mylist[$uskey]["editsepa"]= geturl($modeel."&editsepa=".$idcurr);
//	$mylist[$uskey]["acti"]= geturl($modeel."&acti=".$idcurr);
//	$mylist[$uskey]["inac"]= geturl($modeel."&inac=".$idcurr);
}

//# add new link 
//$addnew= geturl($modeel."&edit=0");

# извеждаме 
//$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("cash.tpl","fetch");

?>
