<?php
# списък пакети с описи и преводи 
# отгоре : 
#    $mode - текущия режим 
#    $vari - текущото подменю 
#    $page - текущата страница 
//print_rr($GETPARAM);
//print "tranpack";

# текущата страница 
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

//$relurl= geturl("mode=".$mode."&vari=".$vari."&page=".$page);
//$basepara= "mode=".$mode."&vari=".$vari."&page=".$page;
//$relurl= geturl($basepara);
$baco= "mode=".$mode."&vari=".$vari."&page=".$page;
$basepara= $baco;
$relurl= geturl($baco);
$smarty->assign("GOTEXT", "назад към стр. $page от списъка пакети");
$smarty->assign("GOBACK", $relurl);
									# преводите от избран опис от пакета 
									$view= $GETPARAM["view"];
									if (isset($view)){
$basepara .= "&view=".$view;
$relurl= geturl($basepara);
										include_once "traninveview.php";
//										exit;
# не ajax 
return;
									}else{
									}
									# свободните преводи от избран пакет 
									$listfree= $GETPARAM["listfree"];
									if (isset($listfree)){
										include_once "tranpackview.php";
//										exit;
# не ajax 
return;
									}else{
									}
									# смяна статуса на пакета 
									$idpack= $GETPARAM["idpack"];
									if (isset($idpack)){
//										include_once "traninveview.php";
//										exit;
//# не ajax 
//return;
$tostat= $GETPARAM["tostat"];
$DB->query("lock tables tranpack write, traninve write, finance write, finatranrefe write, finatran write, suit write, epep_payments_queue write, claimer write");

if($tostat == 2) {
	$epep_finance = $DB->select(
		"SELECT finance.*, claimer.epep_uid
		FROM finance
		INNER JOIN finatranrefe ON finatranrefe.idfinance = finance.id
		INNER JOIN finatran ON finatran.id = finatranrefe.idfinatran
		INNER JOIN suit ON suit.id = finance.idcase
		INNER JOIN claimer ON claimer.id = finatran.idclaimer
		WHERE suit.epep_case_uid IS NOT NULL AND finatran.idpack = ?d AND claimer.epep_uid IS NOT NULL
		GROUP BY finance.id", $idpack
	);

	foreach($epep_finance as $elem) {
		$DB->query("INSERT INTO epep_payments_queue(finance_id, case_id) VALUES (?d, ?d)", $elem['id'], $elem['idcase']);
	}
}
//updrow("tranpack",$idpack,"idstat=".$tostat);
updrow("tranpack",$idpack,"idstat=$tostat,statmodi=now()");
$DB->query("update traninve set idstat=?d where idpack=?d"  ,$tostat,$idpack);
																$DB->query("unlock tables");
# reload 
reload("",$relurl);
									}else{
									}
									# разглеждане/генериране файл за пакет 
									$filegene= $GETPARAM["filegene"];
									if (isset($filegene)){
										include_once "tranpackfile.php";
//										exit;
# не ajax 
return;
									}else{
									}
									# генериране документ за избран опис от пакета 
									$gene= $GETPARAM["gene"];
									if (isset($gene)){
$basepara .= "&gene=".$gene;
$relurl= geturl($basepara);
										include_once "traninvegene.php";
										exit;
//# не ajax 
//return;
									}else{
									}

# списъка 
		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
		$query= getpackqu("1");
		$prefurl= "";
		$baseurl= "mode=".$mode."&vari=".$vari;
		$obpagi= new paginator(18, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);
//print_rr($mylist);

# трансформираме го - параметри за иконите 
				$modeel= "mode=".$mode."&vari=".$vari."&page=".$page;
							$arin= array();
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
	$mylist[$uskey]["view"]= geturl($modeel."&view=".$idcurr);
	$mylist[$uskey]["filegene"]= geturl($modeel."&filegene=".$idcurr);
	$mylist[$uskey]["linkprnt"]= geturl($modeel."&filegene=".$idcurr ."&prnt=yes");
			foreach($arpacktext as $idstat=>$x2){
	$mylist[$uskey]["tostat".$idstat]= geturl($modeel."&idpack=".$idcurr."&tostat=".$idstat);
			}
							$arin[]= $idcurr;
}
//print_rr($arin);
# брой преводи 
							if (empty($arin)){
$arcoun= array();
							}else{
$codein= implode(",",$arin);
//var_dump($codein);
/*
# общо 
$arcoun= $DB->selectCol("select idpack as ARRAY_KEY, count(*) from finatran where idpack in ($codein) group by idpack");
//print_rr($arcoun);
*/
# извън описи (свободни) 
$arcoun2= $DB->select("select idpack as ARRAY_KEY, count(*) as coun, sum(amount) as sumatota, count(*) as countota
	from finatran 
	where idpack in ($codein) and idinve=0
	group by idpack
	");
$smarty->assign("ARCOUN2", $arcoun2);
		$arlink2= array();
foreach($arcoun2 as $idpack=>$x2){
		$arlink2[$idpack]= geturl($modeel."&listfree=".$idpack);
}
$smarty->assign("ARLINK2", $arlink2);
# включени в описи 
$arinve= $DB->select("
	select traninve.idpack as ARRAY_KEY1, finatran.idinve as ARRAY_KEY2, count(finatran.id) as coun, sum(finatran.amount) as suma
		, tranacco.desc as accodesc
	from finatran 
	left join traninve on finatran.idinve=traninve.id
	left join tranpack on traninve.idpack=tranpack.id
		left join tranacco on traninve.idacco=tranacco.id
	where traninve.idpack in ($codein) and finatran.idinve<>0
	group by traninve.idpack, finatran.idinve
	");
$arinve= dbconv($arinve);
//print_rr($arinve);
						# общия брой преводи по пакети 
						$arcoun= $arcoun2;
foreach($arinve as $idpack=>$elempack){
	foreach($elempack as $idinve=>$coinve){
		$arinve[$idpack][$idinve]["view"]= geturl($modeel."&view=".$idinve);
		$arinve[$idpack][$idinve]["gene"]= geturl($modeel."&gene=".$idinve);
						$arcoun[$idpack]["coun"] += $coinve["coun"];
						$arcoun[$idpack]["sumatota"] += $coinve["suma"];
						$arcoun[$idpack]["countota"] += 1;
	}
}
$smarty->assign("ARINVE", $arinve);
//print_rr($arinve);
							# if (empty($arin)){
							}
//print_rr($arcoun2);
//print_rr($arcoun);
$smarty->assign("ARCOUN", $arcoun);

//# add new link 
//$addnew= geturl($modeel."&edit=0");
//$smarty->assign("ADDNEW", $addnew);

# извеждаме 
$smarty->assign("LIST", $mylist);
$contvari= smdisp("tranpack.tpl","fetch");

?>
