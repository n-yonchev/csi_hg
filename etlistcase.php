<?php
# ЕТ - за въведено дело 
# източник : napcase.php 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
# параметри : 
#    $etfiltuser - филтър за деловодител 
#    $idcase - делото suit.id 
//print_rr($GETPARAM);


# база 
$modeel= "mode=$mode&idcase=$idcase";

							# корекция взискател 
							$claimodi= $GETPARAM["claimodi"];
							if (isset($claimodi)){
# източници : finainvi.inc.php cazo3.php cazo3modi.ajax.php 
	$edit= $idcase;
	$relurl= geturl($modeel);
$taname= "claimer";
$tpname= "cazo34modi.ajax.tpl";
$listtext= "взискатели";
$listtext2= "взискател";
$diemess= "cazo3";
	$func= "modi";
	$idel= $claimodi;
	$typetext= "ВЗИСКАТЕЛ";
	$isclaimer= true;
$smarty->assign("TANAME", $taname);
								include "cazo34modi.inc.php";
								exit;
							}else{
							}

							# корекция длъжник 
							$debtmodi= $GETPARAM["debtmodi"];
							if (isset($debtmodi)){
# източници : finainvi.inc.php cazo3.php cazo3modi.ajax.php 
	$edit= $idcase;
	$relurl= geturl($modeel);
$taname= "debtor";
$tpname= "cazo34modi.ajax.tpl";
$listtext= "длъжници";
$listtext2= "длъжник";
$diemess= "cazo4";
	$func= "modi";
	$idel= $debtmodi;
	$typetext= "ДЛЪЖНИК";
	$isclaimer= false;
$smarty->assign("TANAME", $taname);
								include "cazo34modi.inc.php";
								exit;
							}else{
							}

							# изтриване взискател 
							$claidele= $GETPARAM["claidele"];
							if (isset($claidele)){
$DB->query("delete from claimer where id=?d"  ,$claidele);
							}else{
							}
							# изтриване длъжник 
							$debtdele= $GETPARAM["debtdele"];
							if (isset($debtdele)){
$DB->query("delete from debtor where id=?d"  ,$debtdele);
							}else{
							}

# данни за делото 
$rocase= getrow("suit",$idcase);
$rouser= getrow("user",$rocase["iduser"]);
$rocase["username"]= $rouser["name"];


							# за извеждане на "идва от" - кеширания масив 
							$arfrom= unserialize(file_get_contents(COFROMFILE));
							$smarty->assign("ARFROM", $arfrom);
							# за извеждане на "титул"  
							$smarty->assign("ARTITU", $listtitu);
							# за извеждане на "вид" 
							$smarty->assign("ARSORT", $listsort);
							# за извеждане на "текущ статус" 
							$smarty->assign("ARSTAT", $viewcasestat);
/*
							# за извеждане на "произход на вземането" 
							$roorig= getrow("claimorigin",$rocase["idclaimorig"]);
$rocase["origtext"]= $roorig["name"];
*/
				# полета за вземане - ЦРД-2014 
				$smarty->assign("AR4TYPENAME", $list4type);
				$smarty->assign("AR4VARINAME", $list4vari);
				$smarty->assign("AR4ORIGNAME", $list4orig);
$smarty->assign("DATACASE", $rocase);

# взискатели 
$clailist= $DB->select("
	select claimer.*, claimer.id as id
				, if(etlist.id is null,0,1) as isform
	from claimer
				left join etlist on claimer.id=etlist.idmemb and etlist.tabl='claimer'
	where claimer.idcase=?d
	"  ,$idcase);
$clailist= dbconv($clailist);
$clailist= arstrip($clailist);
foreach($clailist as $indx=>$elem){
		$idtype= $elem["idtype"];
	$clailist[$indx]["type"]= $listmembtype[$idtype];
		$ardata= unserialize($elem["exdata"]);
		$t1type= $ardata["t1type"];
	if ($idtype==1){
		$clailist[$indx]["subt"]= $list1type[$t1type];
	}elseif ($idtype==3){
		$clailist[$indx]["subt"]= $list3type[$t1type];
	}else{
	}
	$clailist[$indx]["claimodi"]= geturl($modeel."&claimodi=".$elem["id"]);
	$clailist[$indx]["claidele"]= geturl($modeel."&claidele=".$elem["id"]);
}
$smarty->assign("CLAILIST", $clailist);
$smarty->assign("CLAICREA", geturl($modeel."&claimodi=0"));
//print_ru($clailist);

# изтрити взискатели - бивши ЕТ 
$arclai0= $DB->select("
	select etlist.*
	from etlist
		left join claimer on claimer.id=etlist.idmemb and etlist.tabl='claimer'
	where etlist.idcase=?d and etlist.tabl='claimer' and claimer.id is null
	"  ,$idcase);
$arclai0= dbconv($arclai0);
$arclai0= arstrip($arclai0);
$smarty->assign("ARCLAI0", $arclai0);
//print_ru($arclai0);

# длъжници 
$debtlist= $DB->select("
	select debtor.*, debtor.id as id
				, if(etlist.id is null,0,1) as isform
	from debtor
				left join etlist on debtor.id=etlist.idmemb and etlist.tabl='debtor'
	where debtor.idcase=?d
	"  ,$idcase);
$debtlist= dbconv($debtlist);
$debtlist= arstrip($debtlist);
foreach($debtlist as $indx=>$elem){
		$idtype= $elem["idtype"];
	$debtlist[$indx]["type"]= $listmembtype[$idtype];
		$ardata= unserialize($elem["exdata"]);
		$t1type= $ardata["t1type"];
	if ($idtype==1){
		$debtlist[$indx]["subt"]= $list1type[$t1type];
	}elseif ($idtype==3){
		$debtlist[$indx]["subt"]= $list3type[$t1type];
	}else{
	}
	$debtlist[$indx]["debtmodi"]= geturl($modeel."&debtmodi=".$elem["id"]);
	$debtlist[$indx]["debtdele"]= geturl($modeel."&debtdele=".$elem["id"]);
}
$smarty->assign("DEBTLIST", $debtlist);
$smarty->assign("DEBTCREA", geturl($modeel."&debtmodi=0"));
//print_ru($debtlist);

# изтрити длъжници - бивши ЕТ 
$ardebt0= $DB->select("
	select etlist.*
	from etlist
		left join debtor on debtor.id=etlist.idmemb and etlist.tabl='debtor'
	where etlist.idcase=?d and etlist.tabl='debtor' and debtor.id is null
	"  ,$idcase);
$ardebt0= dbconv($ardebt0);
$ardebt0= arstrip($ardebt0);
$smarty->assign("ARDEBT0", $ardebt0);

# указанието 
$txcont= file_get_contents("ET.TXT");
$txcont= str_replace("--","<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$txcont);
$smarty->assign("TXCONT", $txcont);

# извеждане 
$smarty->assign("IDCASE", $idcase);
$pagecont= smdisp("etlistcase.tpl","fetch");

?>