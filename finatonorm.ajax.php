<?php
# превръщане проформа фактура в нормална 
# отгоре : 
#    $edit= case.id 
# управляващ : 
#    $proftonorm = bill.id 
# още отгоре : 
#    $modeel - стринг за базовия линк 
#    $relurl - базовия линк 
#    $robill - записа за сметката bill.id=$modibill 


# данните 
	$robill= getrow("bill",$proftonorm);
$smarty->assign("ROBILL", $robill);
	$seriprof= $DB->selectCell("select seriprof from billprof where idbill=?d",  $proftonorm);
$smarty->assign("SERIPROF", $seriprof);
	if ($robill["idcase"]==0){
		$sumabill= getsumainvo("invoelem.idbill=$proftonorm");
	}else{
		$sumabill= getsumabill("billelem.idbill=$proftonorm");
	}
//print_rr($sumabill);
$smarty->assign("SUMABILL", $sumabill[$proftonorm]["suma"]);
										$DB->query("lock tables bill write");
	$mxinvo= $DB->selectCell("select max(seriinvo) from bill");
	$nextinvo= $mxinvo+1;
$smarty->assign("SERIINVONEXT", $nextinvo);

# действие 
				$submit= $_POST["submit"];
				if (isset($submit)){
# корекции 
	$aset= array();
	$aset["idinvotype"]= 0;
		if ($robill["seriinvo"]==0){
	$aset["seriinvo"]= $nextinvo;
    $aset["date"]= date("Y-m-d");
		}else{
		}
$DB->query("update bill set ?a where id=?d" ,$aset,$proftonorm);
										$DB->query("unlock tables");
# рефреш 
reload("parent",geturl($modeel));
				}else{

										$DB->query("unlock tables");
# извеждаме 
print smdisp("finatonorm.ajax.tpl","iconv");
				
				}


?>