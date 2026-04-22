<?php
# избрано постъпление : изключване на разпределенията от списъка за превод 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $page - текущата страница 
#    $idcase - делото suit.id 
//#    $idcase - избраното дело suit.id - отгоре 
#    $idvari - подменю за статуса - маневрена 
# управляваща : 
#    $tofina - постъплението finance.id 
# още отгоре : 
#    $qutran, $qurefe - базови заявки 
#    $basefilt - базов филтър 
#    $relurl - линк за връщане към тек.страница 
#    $codebudg="bud" - код за бюдж.сметка 
//print_rr($GETPARAM);
//var_dump($tofina);
//print_rr($_POST);


#------ подготовка ------
										$DB->query("lock tables 
										finance write, finatran write, finatranrefe write, tranbudget write
										, suit read, user read, finasource read, finabank read, user as t3 read
										, traninve read, tranpack read, tranpack as tp2 read
										, debtor read, claimer read
										");
	# данни за постъплението 
	$datafina= $DB->selectRow("$qutran where finance.id=?d"  ,$tofina);
	$datafina= dbconv($datafina);
	$smarty->assign("DATAFINA", $datafina);
//print_rr(toutf8($datafina));
	# длъжник за постъплението 
	$rodebt= getrow("debtor",$datafina["iddebtor"]);
	$smarty->assign("DEBTNAME", $rodebt["name"]);
//print_rr(toutf8($rodebt));
	# списъка с разпределенията 
//	$artran= gettrandata($tofina);
/*
	$artran= $DB->select("
		select finatranrefe.suma
			, finatran.amount, finatran.idbank, finatran.idclaimer as idclai
			, claimer.name as clainame
		from finatranrefe
		left join finatran on finatranrefe.idfinatran=finatran.id
		left join claimer on finatran.idclaimer=claimer.id
		where finatranrefe.idfinance=?d
		"  ,$tofina);
*/
	$artran= $DB->select("
		select finatranrefe.suma, claimer.name as clainame
		, $qurefe
		left join claimer on finatran.idclaimer=claimer.id
		where finatranrefe.idfinance=?d
		order by finatran.idclaimer
		"  ,$tofina);
	$artran= dbconv($artran);
	foreach($artran as $idfina=>$e2){
		foreach($e2 as $idclai=>$elem){
			if ($idclai<0){
				$artran[$idfina][$idclai]["clainame"]= $pseuclainame[$idclai];
			}else{
			}
		}
	}
	$smarty->assign("ARTRAN", $artran);
//var_dump($tofina);
//print_rr(toutf8($artran));
	# флаг за изключване 
/*
						$arfinaex= array();
	foreach($exlist as $idfina=>$e2){
				$isexclude= true;
		foreach($e2 as $idclai=>$elem){
			if ($elem["idstat"]==9 or $elem["idinvestat"]<>0 or $elem["idpackstat"]<>0 or $elem["idinvepackstat"]<>0){
				$isexclude= false;
				break;
			}else{
			}
		}
						$arfinaex[$idfina]= $isexclude;;
	}
	$smarty->assign("ARFINAEX", $arfinaex);
//print_rr($arfinaex);
*/
				$isexclude= true;
	foreach($artran[$tofina] as $idclai=>$elem){
		if ($elem["idstat"]==9 or $elem["idinvestat"]<>0 or $elem["idpackstat"]<>0 or $elem["idinvepackstat"]<>0){
				$isexclude= false;
				break;
		}else{
		}
	}
	$smarty->assign("ISEXCLUDE", $isexclude);


# действие 
if (isset($_POST["submit"])){
	# след събмит 
	if ($isexclude){
#----------------------- ПРИКЛЮЧВАНЕ -------------------------------
# корекции в табл. finance, finatran, finatranrefe, tranbudget
/**/
/*
$DB->query("
	delete tranbudget
	from finatran
	left join tranbudget on finatran.idtranbudget=tranbudget.id
	where finatran.idfinance=?d and tranbudget.id is not null
	"  ,$tofina);
*/
$DB->query("
	delete tranbudget
	from finatranrefe
	left join finatran on finatranrefe.idfinatran=finatran.id
	left join tranbudget on finatran.idtranbudget=tranbudget.id
	where finatranrefe.idfinance=?d and tranbudget.id is not null
	"  ,$tofina);
/***
$DB->query("
	delete finatran
	from finatranrefe
	left join finatran on finatranrefe.idfinatran=finatran.id
	where finatranrefe.idfinance=?d 
	"  ,$tofina);
***/
$arfinatran= $DB->selectCol("select idfinatran from finatranrefe where idfinance=?d"  ,$tofina);
if (empty($arfinatran)){
	$codein= "0";
}else{
	$codein= implode(",",$arfinatran);
}
$DB->query("delete from finatranrefe where idfinance=?d"  ,$tofina);
$DB->query("
	update finatran 
	left join (
		select idfinatran, round(sum(suma),2) as sutran
		from finatranrefe
		where idfinatran in ($codein)
		group by idfinatran
		) as t2 on finatran.id=t2.idfinatran
	set finatran.amount=t2.sutran
	where finatran.id in ($codein)
	");
$DB->query("delete from finatran where id in ($codein) and amount+0=0");
$DB->query("update finance set isclosed=0, timeclosed='', istran=0 where id=?d"  ,$tofina);
//die("FFFFFFFFFFFFFFFFFFFFFFFFFF");
#-------------------------------------------------------------------
/**/
						$retucode= 0;
	}else{
//						$retucode= 0;
						$retucode= -1;
	}
}else{
	# начало - форма 
						$retucode= 12;
}

# резултат 
if ($retucode==0){
										$DB->query("unlock tables");
	# redirect 
	reload("parent",$relurl);
}else{
	# извеждаме формата 
	$smarty->assign("TOFINA", $tofina);
	print smdisp("tranfitofina.ajax.tpl","iconv");
}
										$DB->query("unlock tables");


?>