<?php
# списък на всички сметки 
# източник : 
#    arch.php - архивна книга 
//# отгоре глобално : 
//#    $logisadmin = (smarty)LOGGEDISADMIN - флаг дали логнатия е админ 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
//print_r($GETPARAM);
//print_rr($smarty->get_template_vars());
//var_dump($logisadmin);
//print_rr($_SERVER);

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];
$smarty->assign("LOGGEDID", $iduser);

# текущата страница 
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

									# разглеждане/отпечатване на избрания запис 
									$prinbill= $GETPARAM["prinbill"];
									if (isset($prinbill)){
										include "cazobillprin.ajax.php";
										exit;
									}else{
									}
# списъка 
# допълнителен филтър : and bill.serial<>0 
/*
$myquery= "
	select bill.* ,bill.id as id ,claimer.name as clainame
		, suit.serial as caseseri, suit.year as caseyear, user.name as username
	from bill
	left join claimer on bill.idclaimer=claimer.id
	left join suit on bill.idcase=suit.id
	left join user on suit.iduser=user.id
	where bill.serial<>0
	order by bill.serial
	";
*/
$myquery= "
	select bill.* ,bill.id as id ,bill.name as persname
		, suit.serial as caseseri, suit.year as caseyear, user.name as username
	from bill
	left join suit on bill.idcase=suit.id
	left join user on suit.iduser=user.id
	where bill.serial<>0
	order by bill.serial
	";

		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
		$query= $myquery;
		$prefurl= "";
//		$baseurl= "mode=".$mode."&year=".$year."&onlyuser=".$onlyuser;
//		$baseurl= "mode=".$mode."&year=".$year;
//		$baseurl= "mode=".$mode."&year=".$year."&date=".$date."&date2=".$date2  ."&adre=".$adre."&bele=".$bele;
		$baseurl= "mode=".$mode;
								# 23.07.2009 - Бъзински - Т.Софрониев 
								# обратен ред (без отпечатването) и по 200 на страница 
		$obpagi= new paginator(30, 8, $query ." desc");
/****
						if ($flprin){
		$mylist= $DB->select($query);
						}else{
****/
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
//						}
$mylist= dbconv($mylist);
$mylist= arstrip($mylist);
//print_rr($mylist);

# списъка на сумите по сметки 
							$arin= array();
foreach($mylist as $myin=>$myco){
				$idcurr= $myco["id"];
//print "<br>";
//var_dump($idcurr);
							$arin[]= $idcurr;
}
							if (count($arin)==0){
								$incode= "0";
							}else{
								$incode= implode(",",$arin);
							}
$listsuma= $DB->selectCol("select 1.2*sum(billelem.taxprop+billelem.taxregu+billelem.taxaddi) as suma
		,billelem.idbill as ARRAY_KEY
	from billelem
	where billelem.idbill in ($incode)
	group by billelem.idbill
	");
$smarty->assign("LISTSUMA", $listsuma);
//print_rr($listsuma);

# формираме нов масив 
# вмъкваме редове в зона на липсващи арх.номера 
							$mylist2= array();
									$myseri= $mylist[0]["serial"] +1;
//$modeel= "mode=".$mode."&year=".$year."&onlyuser=".$onlyuser."&page=".$page;
$modeel= "mode=".$mode."&page=".$page;
foreach($mylist as $myin=>$myco){
									$seri2= $myseri -1;
//print "<br>[$seri2]".$myco["serial"];
									if ($myco["serial"]==$seri2){
									}else{
										$myar= array();
										$myar["serial"]= -1;
										$myar["arch2"]= $seri2;
										$myar["arch1"]= $myco["serial"] +1;
										$myar["archcoun"]= $myar["arch2"] - $myar["arch1"] +1;
							$mylist2[]= $myar;
									}
							$myseri= $myco["serial"];
							$myar= $myco;
				$idcurr= $myco["id"];
	$myar["prinbill"]= geturl($modeel."&prinbill=".$idcurr);
							$mylist2[]= $myar;
}
									if ($myco["serial"]<=1){
									}else{
										$myar= array();
										$myar["serial"]= -1;
										$myar["arch2"]= $myco["serial"] -1;
										$myar["arch1"]= 1;
										$myar["archcoun"]= $myar["arch2"] - $myar["arch1"] +1;
							$mylist2[]= $myar;
									}
$mylist= $mylist2;
//print_rr($mylist);

//print_rr($smarty->get_template_vars());
# извеждаме 
//$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
$smarty->assign("PAGENO", $page);
# извеждане на текущата страница 
$pagecont= smdisp("bill.tpl","fetch");
//						}


?>
