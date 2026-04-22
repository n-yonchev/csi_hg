<?php
# вход.документи, само за старите дела, групирани по дела 
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

/*
# списъка 
//$mylist= $DB->select("select * from docu order by year desc, serial desc");
$myquery= "
	select docu.* ,docu.id as id
		,suit.serial as caseseri ,suit.year as caseyear
		,user.name as username
	from docu
		left join suit on docu.idcase=suit.id
		left join user on suit.iduser=user.id
	order by docu.year desc, docu.serial desc
	";
*/
# списък на старите дела 
$myquery= "select id,serial,year from suit where iduser=-1 order by year desc, serial desc";
		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
		$query= $myquery;
		$prefurl= "";
		$baseurl= "mode=".$mode;
		$obpagi= new paginator(12, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);
//print_r($mylist);
# списък с id на делата от текущата страница 
			$arin= array();
foreach($mylist as $myelem){
			$arin[]= $myelem["id"];
}
//print_r($arin);
# списък на документите по делата от тек.страница 
			if (empty($arin)){
$whcode= "";
			}else{
$incode= implode(",",$arin);
$whcode= "where idcase in ($incode)";
			}
$doculist= $DB->select("select * from docu $whcode order by year desc, serial desc");
$doculist= dbconv($doculist);
//var_dump($whcode);
//print_r($doculist);
# групираме документите по дела 
					$ardocu= array();
foreach($doculist as $docuelem){
	$idcase= $docuelem["idcase"];;
					$ardocu[$idcase][]= $docuelem;
}


# извеждаме 
$smarty->assign("LISTDOCU", $ardocu);
$smarty->assign("LISTCASE", $mylist);
$pagecont= smdisp("oldc.tpl","fetch");

?>
