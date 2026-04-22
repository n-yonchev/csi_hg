<?php
# списък на разпределените суми в избран пакет за превод - групирани по сметки 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $page - текущата страница 
# $acco = finatranpack.id за избрания пакет 
//print "acco=$acco";

# назад към текущата страница от списъка 
$smarty->assign("PAGE", $page);
$smarty->assign("PAGEBACKLINK", geturl("mode=".$mode ."&page=".$page));

									/**/
									# корекция на сметката за избраното разпределение 
									$edit= $GETPARAM["edit"];
									if (isset($edit)){
										include_once "finapackaccoedit.ajax.php";
										exit;
									}else{
									}
									# маркиране като преведен на подмножество от избрания пакет 
									# - всички разпределения за избрана сметка 
									$mark= $GETPARAM["mark"];
									if (isset($mark)){
										include_once "finapackmark.ajax.php";
										exit;
									}else{
									}
									/**/

$smarty->assign("PACKNO", $acco);

				# предварително автоматично определяне на сметката за превод 
				# само за разпределенията от пакета 
				# - само за псевдо взискателите -3 и -2 (без -1 =връщане) 
				# - само ако още не е определена и не е платено 
				$worklist= $DB->select("
					select finatran.id as id
						, finatran.idclaimer as idc2, claim2iban.iban as iban, claim2iban.bic as bic
					from finatran
					left join claim2 on finatran.idclaimer=claim2.id
						left join claim2iban on claim2iban.idclaim2=claim2.id
					where finatran.idfinatranpack=?d and finatran.idclaimer in (-3,-2) 
						and finatran.idclaim2=0 and finatran.iban='' and finatran.isdone=0
					"  ,$acco);
				foreach($worklist as $elem){
					$id= $elem["id"];
						$aset= array();
						$aset["idclaim2"]= $elem["idc2"];
						$aset["iban"]= $elem["iban"];
						$aset["bic"]= $elem["bic"];
					$DB->query("update finatran set ?a where id=?d"  ,$aset,$id);
				}

# данните 
/*
$mylist= $DB->select("
	select finatran.*, finatran.id as id
	, suit.serial as caseseri, suit.year as caseyear
	, user.name as username, claimer.name as clainame
	, claim2.name as clai2name, claim2iban.descrip as descrip
	from finatran 
	left join finance on finatran.idfinance=finance.id
	left join suit on finance.idcase=suit.id
	left join user on suit.iduser=user.id
	left join claimer on finatran.idclaimer=claimer.id
		left join claim2 on finatran.idclaim2=claim2.id
		left join claim2iban on finatran.iban=claim2iban.iban and finatran.bic=claim2iban.bic
	where finatran.idfinatranpack=?d
	order by iban
	"  ,$acco);
*/
$mylist= $DB->select("
	select finatran.*, finatran.id as id
			,finatran.idfinatranpack as idfinatranpack
			,finatran.idclaim2 as idclaim2
			,finatran.iban as iban
			,finatran.bic as bic
				, concat(finatran.iban,'/',finatran.bic) as account
				, if(claim2iban.id is null,1,0) as mistacco
	, suit.serial as caseseri, suit.year as caseyear
	, user.name as username, claimer.name as clainame
	, claim2.name as clai2name, claim2iban.descrip as descrip
	from finatran 
	left join finance on finatran.idfinance=finance.id
	left join suit on finance.idcase=suit.id
	left join user on suit.iduser=user.id
	left join claimer on finatran.idclaimer=claimer.id
		left join claim2 on finatran.idclaim2=claim2.id
		left join claim2iban on finatran.iban=claim2iban.iban and finatran.bic=claim2iban.bic
	where finatran.idfinatranpack=?d
	order by concat(finatran.iban,'/',finatran.bic)
	"  ,$acco);
$mylist= dbconv($mylist);

# трансформираме го - параметри за иконите 
				$modeel= "mode=".$mode ."&page=".$page ."&acco=".$acco;
						# суми по сметките 
						$sulist= array();
								# брой неплатени разпределения по сметките 
								$nodone= array();
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
						$account= $uscont["account"];
						$sulist[$account] += $uscont["amount"];
								$nodone[$account] += ($uscont["isdone"]==0) ? 1 : 0;
	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
						$markcode= $uscont["idfinatranpack"]."^".$uscont["idclaim2"]."^".$uscont["iban"]."^".$uscont["bic"];
	$mylist[$uskey]["mark"]= geturl($modeel."&mark=".$markcode);
//	$mylist[$uskey]["view"]= geturl($modeel."&view=".$idcurr);
//	$mylist[$uskey]["get"]= geturl($modeel."&get=".$idcurr);
//	$mylist[$uskey]["put"]= geturl($modeel."&put=".$idcurr);
}
						$smarty->assign("SULIST", $sulist);
								$smarty->assign("NODONE", $nodone);
//print_rr($sulist);

# add new link 
$addnew= geturl($modeel."&caseid=0");

						# псевдо взискателите 
//						$psclai= array();
//						$psclai[-3]= "за ЧСИ неолихв";
//						$psclai[-2]= "за ЧСИ т.26";
//						$psclai[-1]= "за връщане";
//						$smarty->assign("PSCLAI", $psclai);
											include_once "fina.inc.php";
						$smarty->assign("PSCLAI", $pseuclainame);
# извеждаме 
$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("finapackacco.tpl","fetch");


?>