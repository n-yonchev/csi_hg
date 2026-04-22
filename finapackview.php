<?php
# списък на делата в избран пакет за превод 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $page - текущата страница 
# $pack = finapack.id за избрания пакет 
//print "pack=$pack";

# назад към текущата страница от списъка 
$smarty->assign("PAGE", $page);
$smarty->assign("PAGEBACKLINK", geturl("mode=".$mode ."&page=".$page));

									# постъпленията от избраното дело 
									$caseid= $GETPARAM["caseid"];
									if (isset($caseid)){
										include_once "finapackcase.ajax.php";
										exit;
									}else{
									}

$smarty->assign("PACKNO", $pack);

# данните 
$mylist= $DB->select("
	select distinct suit.id as caseid
	, suit.serial as caseseri, suit.year as caseyear, suit.created as casecrea
	, user.name as username, cofrom.name as cofrname
	from finatran 
	left join finance on finatran.idfinance=finance.id
	left join suit on finance.idcase=suit.id
	left join user on suit.iduser=user.id
		left join cofrom on suit.idcofrom=cofrom.id
	where finatran.idfinatranpack=?d
	order by suit.year desc, suit.serial desc
	"  ,$pack);
$mylist= dbconv($mylist);

# трансформираме го - параметри за иконите 
				$modeel= "mode=".$mode ."&page=".$page ."&pack=".$pack;
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["caseid"];
	$mylist[$uskey]["caseid"]= geturl($modeel."&caseid=".$idcurr);
			# обща сума 
			$suma= $DB->selectCell("
				select sum(finatran.amount) 
				from finatran 
				left join finance on finatran.idfinance=finance.id
				where finatran.idfinatranpack=?d and finance.idcase=?d
				"  ,$pack,$idcurr);
	$mylist[$uskey]["suma"]= $suma;
//	$mylist[$uskey]["view"]= geturl($modeel."&view=".$idcurr);
//	$mylist[$uskey]["get"]= geturl($modeel."&get=".$idcurr);
//	$mylist[$uskey]["put"]= geturl($modeel."&put=".$idcurr);
}

# добавяне на ново дело към пакета за превод 
//print_rr($_POST);
$packcase= $_POST["packcase"];
if (isset($packcase)){
	list($caseri,$cayear)= explode("/",$packcase);
	if (strlen($cayear)==2){
		$cayear= "20".$cayear;
	}else{
	}
	$mycase= $DB->selectCell("select id from suit where serial=?d and year=?d"  ,$caseri,$cayear);
	if ($mycase==0){
	}else{
		$caseid= $mycase;
# forcing nyroModal 
$modeel= "mode=".$mode ."&page=".$page ."&pack=".$pack;
$link= geturl($modeel."&caseid=".$caseid);
$smarty->assign("LINK", $link);
//$pagecont= smdisp("finapackauto.tpl","fetch");
//print $pagecont;
//exit;
				$forcecont= smdisp("finapackauto.tpl","fetch");
				$smarty->assign("FORCENYRO", $forcecont);
	}
}else{
}

# add new link 
$addnew= geturl($modeel."&caseid=0");

# извеждаме 
$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("finapackview.tpl","fetch");


?>