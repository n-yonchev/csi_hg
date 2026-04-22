<?php
# дела с ЕТ 
# отгоре : 
#    $etfiltuser - филтър за деловодител 
//print_rr($GETPARAM);
//var_dump($etfiltuser);

									# избрано дело - в главния прозорец 
									$idcase= $GETPARAM["idcase"];
									if (isset($idcase)){
										include_once "etlistcase.php";
										//exit;
										return;
									}else{
									}

# списък дела с ЕТ 
$arin= $DB->selectCol("
	select distinct idcase 
	from etlist
	left join suit on etlist.idcase=suit.id
	where $etfiltuser
	");
//print_rr($arin);
			if (empty($arin)){
				$codein= "0";
			}else{
				$codein= implode(",",$arin);
			}
//var_dump($codein);
/*
$arcase= $DB->select("
	select suit.id as ARRAY_KEY, suit.serial as caseri, suit.year as cayear, user.name as usname
							, reg4mess.*, reg4mess.id as id, reg4call.idreg4, reg4call.time 
	from suit
	left join user on suit.iduser=user.id
							left join reg4mess on reg4mess.idcase=suit.id
							left join reg4call on reg4mess.idreg4call=reg4call.id
	where suit.id in ($codein)
	order by suit.year, suit.serial
	");
*/
							# грешките от ЦРД-2014 
							# източник : cazo1viewr4.ajax.php 
$arcase= $DB->select("
	select suit.id as ARRAY_KEY, suit.serial as caseri, suit.year as cayear, user.name as usname
							, reg4mess.text as reg4text
	from suit
	left join user on suit.iduser=user.id
							left join reg4mess on reg4mess.idcase=suit.id
	where suit.id in ($codein)
	order by suit.year, suit.serial
	");
$arcase= dbconv($arcase);

# брой взискатели, длъжници - по дела 
$ar0clai= get0("claimer");
$ar0debt= get0("debtor");
$ar1clai= get1("claimer",$etfiltuser);
//print_rr($ar1clai);
$ar1debt= get1("debtor",$etfiltuser);
//print_rr($ar1debt);

# трансформиране 
$modeel= "mode=$mode";
foreach($arcase as $idcase=>$x2){
	$arcase[$idcase]["link"]= geturl($modeel."&idcase=".$idcase);
		$arcase[$idcase]["c0"]= $ar0clai[$idcase];
		$arcase[$idcase]["d0"]= $ar0debt[$idcase];
		$arcase[$idcase]["c1"]= $ar1clai[$idcase];
		$arcase[$idcase]["d1"]= $ar1debt[$idcase];
				$art2= explode("^",$x2["reg4text"]);
				$artext= array();
			foreach($art2 as $elem){
				$artext[]= explode("|",$elem);
			}
	$arcase[$idcase]["artext"]= $artext;
}
$smarty->assign("ARCASE", $arcase);
//print_ru($arcase);

# извеждане 
$pagecont= smdisp("etlist.tpl","fetch");


# функции 
function get0($tabl){
global $DB;
	$arcoun= $DB->selectCol("
		select idcase as ARRAY_KEY, count(*) 
		from etlist
		where tabl=?
		group by idcase
		"  ,$tabl);
return $arcoun;
}

function get1($tabl,$pafilt){
global $DB;
//global $listmembtype, $list1type, $list3type;
	$ardata= $DB->select("
		select $tabl.idcase, $tabl.idtype, $tabl.exdata
		from $tabl
		left join suit on $tabl.idcase=suit.id
		where $pafilt
		");
//	$ardata= dbconv($ardata);
//	$ardata= arstrip($ardata);
					$arresu= array();
	foreach($ardata as $x1=>$elem){
			$idcase= $elem["idcase"];
			$idtype= $elem["idtype"];
				$arex= unserialize($elem["exdata"]);
				$t1type= $arex["t1type"];
			if ($idtype==1 and $t1type==2){
					$arresu[$idcase] += 1;
			}else{
			}
	}
return $arresu;
}


?>