<?php
# преди зона-1 : съобщение за непълно въведени основни данни 
# само извеждане, без корекция 
# отгоре : 
#    $edit= case.id 
#    $zone= base 
//print session_name()."=".session_id();

										# 11.06.2009 - предупреждение за непълни основни данни 
										include_once "casebase.inc.php";

# четем записа 
$rocase= getrow("suit",$edit);

# флагове от сесията 
$flagall= $_SESSION["FLAGALL"];
$flagyesstat= $_SESSION["FLAGYESSTAT"];

$epep_link = $rocase['epep_case_uid'];
$smarty->assign("EPEP_LINK", $epep_link);
/*
var_dump($isbasestatus);
var_dump($flagall);
var_dump($FLAGNOCHANGE);
var_dump($flagyesstat);
var_dump($rocase["basestatus"]);
*/
											if ($isbasestatus){
if ($flagall or $FLAGNOCHANGE){
	if ($flagyesstat===true){
		$smarty->assign("BASESTATUS", $rocase["basestatus"]);
	}else{
	}
}else{
	$smarty->assign("BASESTATUS", $rocase["basestatus"]);
}
											}else{
											}

# извеждаме 
$pagecont= smdisp("cazobase.tpl","iconv");

?>
