<?php

# събитията
function getevents($yemo){
global $DB, $smarty;
	$codemont= "date_format(date,'%Y-%m')";
	$mylist= $DB->select("
		select suitevent.*, suit.serial as caseseri, suit.year as caseyear
		, user.name as username
		from suitevent 
		left join suit on suitevent.idcase=suit.id
		left join user on suit.iduser=user.id
		where $codemont=?
		order by suitevent.date
		",  $yemo);
	$mylist= dbconv($mylist);
							# 06.07.2010 - ЛЕПЕНКА 
							foreach($mylist as $myin=>$myco){
								$mylist[$myin]["text"]= stripslashes($myco["text"]);
							}
	$smarty->assign("DATA", $mylist);
		list($ye,$mo)= explode("-",$yemo);
		$gmon= getmoname();
		$yemotext= $gmon[$mo]."-".$ye;
	$smarty->assign("YEMO", $yemotext);

//return "<h2>$yemo</h2>";
$pagec2= smdisp("cale.inc.tpl","fetch");
return $pagec2;
}

# имената на месеците 
function getmoname(){
	$moname= array();
	$moname["01"]= "януари";
	$moname["02"]= "февруари";
	$moname["03"]= "март";
	$moname["04"]= "април";
	$moname["05"]= "май";
	$moname["06"]= "юни";
	$moname["07"]= "юли";
	$moname["08"]= "август";
	$moname["09"]= "септември";
	$moname["10"]= "октомври";
	$moname["11"]= "ноември";
	$moname["12"]= "декември";
return $moname;
}

?>
