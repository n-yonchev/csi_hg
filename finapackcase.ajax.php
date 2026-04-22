<?php
# списък на постъпленията от избрано дело в избран пакет за превод 
# в прозорец nyroModal
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $page - текущата страница 
# $pack = finapack.id за избрания пакет 
# $caseid = suit.id за избраното дело 


# заглавни данни 
$smarty->assign("PACKNO", $pack);
	$rocase= getrow("suit",$caseid);
	$rouser= getrow("user",$rocase["iduser"]);
	$rocase["username"]= $rouser["name"];
$smarty->assign("ROCASE", $rocase);
# взискателите за делото 
						include_once "fina.inc.php";
$clailist= getclailist($caseid);
# и псевдо взискателите 
foreach($pseuclainame as $psindx=>$psname){
	$clailist[$psindx]= $psname;
}
ksort($clailist);
$smarty->assign("CLAILIST", $clailist);


# данните 
/*
$mylist= $DB->select("
	select distinct suit.id as caseid, finatran.*, finatran.id as id
	, suit.serial as caseseri, suit.year as caseyear, suit.created as casecrea
	, user.name as username, cofrom.name as cofrname
	from finatran 
	left join finance on finatran.idfinance=finance.id
	left join suit on finance.idcase=suit.id
	left join user on suit.iduser=user.id
		left join cofrom on suit.idcofrom=cofrom.id
	where finatran.idfinatranpack=?d and finance.idacase=?d
	order by suit.year desc, suit.serial desc
	"  ,$pack);
*/
/*
$mylist= $DB->select("
	select finatran.*, finatran.id as id
	, finance.inco as inco, finance.idtype as idtype, finance.descrip as descrip
		, debtor.name as debtname
	from finatran 
	left join finance on finatran.idfinance=finance.id
		left join debtor on finance.iddebtor=debtor.id
	where finatran.idfinatranpack=?d and finance.idcase=?d
	order by finance.id desc
	"  ,$pack,$caseid);
*/
#-- всички постъпления по делото, независимо че са към различни пакети 
$mylist= $DB->select("
	select distinct finance.id as finaid
	, finance.inco as inco, finance.idtype as idtype, finance.descrip as descrip
	, finance.rest as rest, finance.isclosed as isclosed
		, debtor.name as debtname
	from finatran 
	left join finance on finatran.idfinance=finance.id
		left join debtor on finance.iddebtor=debtor.id
	where finance.idcase=?d
	order by finance.id desc
	"  ,$caseid);
$mylist= dbconv($mylist);
//print_rr($mylist);

#-- данните за всички постъпления по делото 
$mydata= $DB->select("
	select idfinance as ARRAY_KEY1, idclaimer as ARRAY_KEY2
	,finatran.* ,finatran.id as id 
	from finatran 
	left join finance on finatran.idfinance=finance.id
	where finance.idcase=?d
	"  ,$caseid);
$mydata= dbconv($mydata);
//print_rr($mydata);

/*
# трансформираме го - параметри за иконите 
				$modeel= "mode=".$mode ."&page=".$page ."&pack=".$pack ."&caseid=".$caseid;
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["finaid"];
//	$mylist[$uskey]["finaid"]= geturl($modeel."&finaid=".$idcurr);
//	$mylist[$uskey]["view"]= geturl($modeel."&view=".$idcurr);
//	$mylist[$uskey]["get"]= geturl($modeel."&get=".$idcurr);
//	$mylist[$uskey]["put"]= geturl($modeel."&put=".$idcurr);
}
*/
#-- специфичен масив за чекбоксовете 
#   [постъпление][взискател] = [съдържание] 
							$cbcode= array();
foreach ($mylist as $uskey=>$uscont){
				# индекс-1 
				$finaid= $uscont["finaid"];
	$isclosed= $uscont["isclosed"];
	$rest= $uscont["rest"];
//				$arpack= array();
	foreach ($clailist as $clid=>$clname){
				# индекс-2 
				$mypack= $mydata[$finaid][$clid]["idfinatranpack"];
				$myamou= $mydata[$finaid][$clid]["amount"];
				$myid= $mydata[$finaid][$clid]["id"];
//		if ($isclosed==1 or $rest+0<>0){
		if ($isclosed==1 or $rest+0<>0 or $myamou+0==0){
//print "<br>[$finaid][$clid][$isclosed][$rest][$myamou]";
//				$arpack[$clid]= ($eldata==0) ? "" : $eldata;
							$cbcode[$finaid][$clid]= ($mypack==0) ? "" : $mypack;
		}else{
			if ($mypack==0){
				# няма назначен пакет 
							$cbcode[$finaid][$clid]= array($myid,"");
			}elseif ($mypack==$pack){
				# назначен e текущия пакет 
							$cbcode[$finaid][$clid]= array($myid,"checked");
			}else{
				# назначен e друг пакет 
							$cbcode[$finaid][$clid]= $mypack;
			}
		}
	}
}
$smarty->assign("CBCODE", $cbcode);
//print_r($cbcode);
//print_rr($_POST);

//											$listfinatran= $_POST["listfinatran"];
//											if (isset($listfinatran)){
											if (isset($_POST["submit"])){
			$listfinatran= $_POST["listfinatran"];
			if (isset($listfinatran)){
			}else{
				$listfinatran= array();
			}
# обработваме чекбоксовете 
//print_rr($listfinatran);
foreach($cbcode as $finaid=>$e1){
	foreach($e1 as $clid=>$e2){
		if (is_array($e2)){
			$myid= $e2[0];
			$ischecked= in_array($myid,$listfinatran);
			$mypack= ($ischecked) ? $pack : 0;
			$DB->query("update finatran set idfinatranpack=?d where id=?d"  ,$mypack,$myid);
		}else{
		}
	}
}
# reload 
//$modeel= "mode=".$mode ."&page=".$page ."&pack=".$pack ."&caseid=".$caseid;
$relurl= geturl("mode=".$mode ."&page=".$page ."&pack=".$pack);
reload("parent",$relurl);
											
											}else{

# извеждаме формата 
//# add new link 
//$addnew= geturl($modeel."&view=0");
						# за извеждане на "тип" - масива $listfinatype - commspec.php 
						# предаваме съдържанието на масива 
						$smarty->assign("ARTYPE", $listfinatype2);

# извеждаме 
//$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
$smarty->assign("DATA", $mydata);
print smdisp("finapackcase.ajax.tpl","iconv");
											
											# if (isset($listfinatran)){
											}


?>