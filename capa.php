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
									# разглеждане съдържанието на избран запис 
									$view= $GETPARAM["view"];
									if (isset($view)){
										include_once "capaview.ajax.php";
										exit;
									}else{
									}
									# корекция на избран запис 
									$edit= $GETPARAM["edit"];
									if (isset($edit)){
										include_once "capaedit.ajax.php";
										exit;
									}else{
									}
									# приключване на избран запис 
									$fini= $GETPARAM["fini"];
									if (isset($fini)){
										include_once "capafini.ajax.php";
										exit;
									}else{
									}
									/**/

# списъка 
		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
		$query= "select * from cashpack order by serial desc";
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

# трансформираме го - параметри за иконите 
				$modeel= "mode=".$mode ."&page=".$page;
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
	$mylist[$uskey]["fini"]= geturl($modeel."&fini=".$idcurr);
	$mylist[$uskey]["view"]= geturl($modeel."&view=".$idcurr);
}

# add new link 
$addnew= geturl($modeel."&edit=0");

# извеждаме 
$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("capa.tpl","fetch");

?>
