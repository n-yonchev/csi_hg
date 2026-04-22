<?php
# отгоре : 
#    $mode - текущия режим 
#    $page - текущата страница 
#    $vari - текущото подменю 
# още : 
#    $filtcode - филтър-1 
#    $toinveiban - iban за евент.назначаване към опис 
#    $flagpack - флаг за евент.назначаване към пакет 
# $codepost - код за пакетите на Пощ.банка [бюджетни или не] 
//var_dump($flagpack);
//print "<br>".$filtcode;
//print "toinveiban=[$toinveiban]";
//print_rr($GETPARAM);
//var_dump($codepost);


# специално за бюдж.пакети на Пощ.банка 
$ar2isbudg["s5"]= "bud";

			include_once "tranclon.inc.php";
#    $baco - базов стринг за линковете 

# данните 
		# странициране заедно с dbsimple [dklab] 
					include_once "pagi.class.php";
$query= getmainqu($filtcode);
					$prefurl= "";
//					$baseurl= "mode=".$mode ."&filt=".$filt;
					//$baseurl= "mode=".$mode;
					$baseurl= $baco;
//					$obpagi= new paginator(18, 8, $query);
					$obpagi= new paginator(30, 8, $query);
					$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);
/*
foreach($mylist as $indx=>$cont){
						# IBAN контр.число (2 цифри) 
						$chresu= ibancheck($cont["iban"]);
						if ($chresu===true){
						}else{
	$mylist[$indx]["ibaniser"]= true;
						}
print "<br>".$cont["iban"];
var_dump($chresu);
}
*/
//print_ru($mylist);
# глобална сума 
$mainsuma= getmainsuma($filtcode);
$smarty->assign("MAINSUMA", $mainsuma);

					# бюдж.сметки 
					$arbudg= getarbudg();
# трансформираме го - параметри за иконите 
//				$modeel= "mode=".$mode ."&page=".$page ."&acco=".$acco;
			/*
				$modeel= "mode=".$mode ."&vari=".$vari."&page=".$page;
				if (isset($v2)){
					$modeel .= "&v2=".$v2;
				}else{
				}
			*/
				$modeel= $baco;
								$arid= array();
								$arcase= array();
												$aridfina= array();
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
												$aridfina[]= $idcurr;
						//$account= $uscont["account"];
						//$sulist[$account] += $uscont["amount"];
						//		$nodone[$account] += ($uscont["isdone"]==0) ? 1 : 0;
/*
	$mylist[$uskey]["mark"]= geturl($modeel."&mark=".$idcurr);
	$mylist[$uskey]["unmark"]= geturl($modeel."&unmark=".$idcurr);
*/
	$mylist[$uskey]["editiban"]= geturl($modeel."&editiban=".$idcurr);
			$isbudg= in_array($uscont["iban"],$arbudg);
			if ($isbudg){
	$mylist[$uskey]["editbudg"]= geturl($modeel."&editbudg=".$idcurr);
								$arid[]= $uscont["idtranbudget"];
			}else{
			}
//								$arcase[]= $uscont["idcase"];
								$arcase[]= $uscont["idcase"] +0;
//var_dump($uscont["idcase"]);
	$mylist[$uskey]["cbcode"]= tocbcode($idcurr);
	$mylist[$uskey]["accobudg"]= geturl($modeel."&accobudg=".$idcurr);
	$mylist[$uskey]["full"]= geturl($modeel."&full=".$idcurr);
	$mylist[$uskey]["dire"]= geturl($modeel."&dire=".$idcurr);
	$mylist[$uskey]["noli"]= geturl($modeel."&noli=".$idcurr);
	$mylist[$uskey]["ring"]= geturl($modeel."&ring=".$idcurr);
	$mylist[$uskey]["bank"]= geturl($modeel."&bank=".$idcurr);
	$mylist[$uskey]["editdebt"]= geturl($modeel."&editdebt=".$idcurr);
					# връщане 
					if ($uscont["idclaimer"]==-1){
						$cucase= $uscont["idcase"];
						$coundebt= $DB->selectCell("select count(*) from debtor where idcase=?d"  ,$cucase);
	$mylist[$uskey]["coundebt"]= $coundebt;
					}else{
					}
	$mylist[$uskey]["gotocase"]= geturl($modeel."&idcase=".$uscont["idcase"]);
	$mylist[$uskey]["edittext"]= geturl($modeel."&edittext=".$idcurr);
	$mylist[$uskey]["editclai"]= geturl($modeel."&editclai=".$idcurr);
			$mylist[$uskey]["artext"]= explode("|",$uscont["text"]);
					$cotext= $uscont["text"];
					if ($uscont["idbank"]==$indxbankpost){
						$lenco= strlen($cotext);
						$flag= ($lenco<=70);
					}else{
						list($t1,$t2)= explode("|",$cotext);
						$len1= strlen($t1);
						$len2= strlen($t2);
						$flag= (($len1<=35) and ($len2<=35));
					}
//print "FLAG=";
//var_dump($flag);
			$mylist[$uskey]["flagtext"]= $flag;
# получател 
					$lereci= strlen($uscont["clainame"]);
	$mylist[$uskey]["flagreci"]= ($lereci<=35);
	$mylist[$uskey]["debtname"]= charspec($uscont["debtname"]);
//print "<br>$lereci=".toutf8($mylist[$uskey]["clainame"]);
					/*
					$arusna= explode(" ",$uscont["usernametran"]);
					for($i=1;$i<count($arusna);$i++){
						$arusna[$i]= substr($arusna[$i],0,1);
					}
	$mylist[$uskey]["usernametran"]= implode("",$arusna);
					*/
					$arusna= explode(" ",$uscont["usernametran"]);
						$ar2= array();
					foreach($arusna as $elem){
						$ar2[]= substr($elem,0,1);
					}
	$mylist[$uskey]["usnatran"]= implode("",$ar2);
}
//print_rr(toutf8($mylist));
//print_rr($arid);
							if (empty($arid)){
							}else{
								$codearid= implode(",",$arid);
//print "codearid=[$codearid]";
# доп.данни за бюджетните 
//$arbufiel= array("typedoc","docdate","fromdate","todate","iddebtor");
$arbudata= $DB->select("
	select tranbudget.id as ARRAY_KEY, tranbudget.*, debtor.name as debtname
	from tranbudget
	left join debtor on tranbudget.iddebtor=debtor.id
	where tranbudget.id in ($codearid)
	");
//print_rr($arbudata);
$arbudata= dbconv($arbudata);
$arbudata= arstrip($arbudata);
foreach($arbudata as $indx=>$cont){
/*
	$isempty= false;
	foreach($arbufiel as $fina){
		if (empty($cont[$fina])){
			$isempty= true;
			break;
		}else{
		}
	}
	$arbudata[$indx]["isempty"]= $isempty;
*/
	$arbudata[$indx]["isempty"]= ($cont["typedoc"]=='' or $cont["docdate"]=='');
}
$smarty->assign("ARBUDATA", $arbudata);
//print_rr($arbudata);
							# if (empty($arid)){
							}
# доп. данни за консолидир.суми 
												$codeidfina= implode(",",$aridfina);
												if (empty($codeidfina)){
													$codeidfina= "0";
												}else{
												}
$arrefe= $DB->select("
	select finatranrefe.idfinatran as ARRAY_KEY1, finatranrefe.id as ARRAY_KEY2
		, finatranrefe.suma as suma, finance.inco as inco
				, finance.idtype as idtype
				, finasource.idfinabank, finasource.date as finadate, finasource.hour as finahour
				, finabank.codebank as codebank
	from finatranrefe
	left join finance on finatranrefe.idfinance=finance.id
				left join finasource on finance.id=finasource.idfinance
				left join finabank on finasource.idfinabank=finabank.id
	where finatranrefe.idfinatran in ($codeidfina)
	");
$smarty->assign("ARREFE", $arrefe);
//print_rr($arrefe);
				$arrefecoun= array();
foreach($arrefe as $idtran=>$elem){
				$arrefecoun[$idtran]= count($elem);
}
$smarty->assign("ARREFECOUN", $arrefecoun);

# текстове за тип, банка 
$smarty->assign("ARTYPE", $listfinatype2);
$smarty->assign("ARBANK", $listxmltype);

							# брой длъжници по дела 
//print_rr($arcase);
							if (empty($arcase)){
							}else{
								$codecase= implode(",",$arcase);
$arcoundebt= $DB->selectCol("
	select debtor.idcase as ARRAY_KEY, count(debtor.id) as coun
	from debtor
	where debtor.idcase in ($codecase)
	group by debtor.idcase
	");
//print_rr($arcoundebt);
$smarty->assign("ARCOUNDEBT", $arcoundebt);
							# if (empty($arcase)){
							}

//# add new link 
//$addnew= geturl($modeel."&caseid=0");

/****
							if ($isperm){
# разрешени за превод 
$argo= $DB->select("
	select tranprep.idfinance as ARRAY_KEY, sum(amount) as suma
		, suit.serial as caseseri, suit.year as caseyear
		, user.name as username
	from tranprep
	left join finance on tranprep.idfinance=finance.id
	left join suit on finance.idcase=suit.id
	left join user on suit.iduser=user.id
	group by tranprep.idfinance
	order by tranprep.created desc
	");
$argo= dbconv($argo);
foreach ($argo as $idfina=>$uscont){
	$argo[$idfina]["gofina"]= geturl($modeel."&gofina=".$idfina);
	$argo[$idfina]["gotran"]= geturl($modeel."&gotran=".$idfina);
}
//print_rr($argo);
$smarty->assign("ARGO", $argo);

$argodata= $DB->select("
	select tranprep.idfinance as ARRAY_KEY1, tranprep.id as ARRAY_KEY2
		, tranprep.idclaimer as idclaimer, tranprep.amount as amount
		, claimer.name as clainame
	from tranprep
	left join claimer on tranprep.idclaimer=claimer.id
	");
$argodata= dbconv($argodata);
$argodata= arstrip($argodata);
//print_rr($argodata);
$smarty->assign("ARGODATA", $argodata);
							}else{
							# if ($isperm){
							}
****/
						# псевдо взискателите 
											include_once "fina.inc.php";
						$smarty->assign("PSCLAI", $pseuclainame);

# линкове за евент.описи за назначаване към опис 
				if (empty($toinveiban)){
				}else{
$arinve= $DB->select("
	select traninve.id as ARRAY_KEY, t2.coun, traninve.idbank
	from traninve
	left join tranacco on traninve.idacco=tranacco.id
	left join tranpack on traninve.idpack=tranpack.id
	left join (
		select idinve, count(*) as coun
		from finatran 
		left join traninve on finatran.idinve=traninve.id
		left join tranacco on traninve.idacco=tranacco.id
		where finatran.idinve<>0 and tranacco.iban='$toinveiban'
		group by finatran.idinve
	) as t2 on traninve.id=t2.idinve
where traninve.idstat=0 and traninve.idacco=?d and (tranpack.idstat=0 or tranpack.idstat is null)
	order by traninve.id desc
	"  ,$v2);
//^	"  ,$toinveiban);
//^where traninve.idstat=0 and tranacco.iban=? and (tranpack.idstat=0 or tranpack.idstat is null)
//where tranacco.iban=? and (tranpack.idstat=0 or tranpack.idstat is null)
//print_rr($arinve);
foreach($arinve as $idinve=>$cont){
	$arinve[$idinve]["link"]= geturl($baco."&toinve=".$idinve);
}
	$arinve[0]["link"]= geturl($baco."&toinve=iban$toinveiban");
$smarty->assign("ARINVE", $arinve);
//print_rr($arinve);
# включи в опис 
//$smarty->assign("FLCBOX", 1);
//$smarty->assign("FLCBOX", 5);
				# if (empty($toinveiban)){
				}

# линкове за евент.пакети за назначаване към пакет 
				if ($flagpack){
$arpack= getpackacti($codepost);
foreach($arpack as $idpack=>$cont){
	$arpack[$idpack]["link"]= geturl($baco."&topack=".$idpack);
}
	$arpack[0]["link"]= geturl($baco."&topack=0");
$smarty->assign("ARPACK", $arpack);
//print_rr($arpack);
				}else{
				# if (empty($flagpack)){
				}
/*
# линк за изключване от опис 
$frominve= geturl($modeel."&frominve=yes");
$smarty->assign("FROMINVE", $frominve);
*/

# трансформ обратно в чакащи 
//			if ($vari==6){
			if ($vari==6 or $vari==11 or $vari==12){
# ръчни преводи - демаркиране обратно в чакащи 
/*
$basepara .= "&listfree=".$listfree;
//////////////////////////////var_dump($basepara);
$frompack= geturl($basepara."&frompack=yes");
$smarty->assign("FROMPACK", $frompack);
*/
//var_dump($modeel);
$demarkdire= geturl($modeel."&demarkdire=yes");
$smarty->assign("DEMARKDIRE", $demarkdire);
			}else{
# чакащи - маркиране като ръчни преводи 
$markdire= geturl($modeel."&markdire=yes");
$smarty->assign("MARKDIRE", $markdire);
			}

# извеждаме 
$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
////////$pagecont= smdisp("tran2.tpl","fetch");
$contvari= smdisp("tran2.tpl","fetch");


?>