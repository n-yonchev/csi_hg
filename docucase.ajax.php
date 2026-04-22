<?php
# ajax отговор на създаване на запис за дело - от списъка с дела на документ 
# вика се в docuedit.ajax.tpl 
# отгоре : 
#     $baseyear 
#     $curryear 

									session_start();
									include_once "common.php";

$GETPARAM= getparam();
# кода на делото от списъка с дела 
$casecode= $GETPARAM["casecode"];

									$DB->query("lock tables suit write");
# проверки и действия 
list($caseri,$cayear)= explode("/",$casecode);
$caseri= $caseri +0;
$cayear= "20".$cayear +0;
					$sptext= "";
					$spclas= "";
if (0){
}elseif ($caseri<1 or $cayear<$baseyear or $cayear>$curryear){
					$sptext= "грешен номер дело";
					$spclas= "e2inva";
}else{
	$mycoun= $DB->selectCell("select count(*) from suit where serial=? and year=?" ,$caseri,$cayear);
	if ($mycoun==0){
		# определяме макс.до момента номер за текущата година 
		$maxser= $DB->selectCell("select serial from suit where year=? order by serial desc limit 1" ,$cayear);
		# ако номера е за текущата година, трябва да не превишава максималния 
		if ($cayear==$curryear and $caseri >= $maxser){
					$sptext= "номера превишава максималния за $cayear год.";
					$spclas= "e2inva";
		}else{
			# създаваме ново дело 
			$casset= array();
			$casset["year"]= $cayear;
			$casset["serial"]= $caseri;
			$DB->query("insert into suit set ?a ,created=now() ,lastdocu=now(),last2=0" ,$casset);
					$sptext= "делото е създадено";
					$spclas= "norm";
		}
	}else{
					$sptext= "делото вече съществува";
					$spclas= "e2exis";
	}
}
									$DB->query("unlock tables");

# връщаме отговора 
$resu= "<span class='$spclas' title='$sptext'> $casecode </span>";
$resu= iconv("windows-1251","UTF-8",$resu);
print $resu;


?>