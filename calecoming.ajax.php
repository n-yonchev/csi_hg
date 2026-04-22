<?php
# предстоящи събития в близките 10 дни 

									session_start();
									include_once "common.php";

$GETPARAM= getparam();
$dat1= $GETPARAM["dat1"];
$dat2= $GETPARAM["dat2"];

//$mylist= $DB->select("select * from suitevent where date>=? and date<=?"  ,$dat1,$dat2);
									# 15.06.2010 - флаг - изп.дела нямат постоянни деловодители 
									# източник : index.php 
									$rooffi= getofficerow($iduser);
									$NOPERMUSER= ($rooffi["isnopermuser"]<>0);
				$smarty->assign("NOPERMUSER", $NOPERMUSER);
							# 29.09.2010 - рожден ден 
							# само от делата на логнатия или от всички дела 
							$filteven= ($NOPERMUSER) ? "1" : "suit.iduser=?d";
/*
$mylist= $DB->select("
		select suitevent.*, suit.serial as caseseri, suit.year as caseyear
		, user.name as username
		from suitevent 
		left join suit on suitevent.idcase=suit.id
		left join user on suit.iduser=user.id
where date>=? and date<=? and suit.iduser=?d
		order by suitevent.date
		"  ,$dat1,$dat2,$_SESSION["iduser"]);
*/
$mylist= $DB->select("
		select suitevent.*, suit.serial as caseseri, suit.year as caseyear
		, user.name as username
		from suitevent 
		left join suit on suitevent.idcase=suit.id
		left join user on suit.iduser=user.id
where date>=? and date<=? and $filteven
		order by suitevent.date
		"  ,$dat1,$dat2,$_SESSION["iduser"]);
$mylist= dbconv($mylist);
$smarty->assign("LIST", $mylist);

		$smarty->assign("HEADJS", array("_calecoming.js"));
print smdisp("calecoming.ajax.tpl","iconv");

?>
