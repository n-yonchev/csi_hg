<?php
# общ календар на събитията - от всички дела 

# броя събития по месеци 
//$codemont= "concat(year(date),'-',month(date))";
$codemont= "date_format(date,'%Y-%m')";
$mylist= $DB->selectCol("select $codemont as ARRAY_KEY, count(*) from suitevent group by $codemont");
//print_rr($mylist);

									if (empty($mylist)){
$smarty->assign("ARCOUN", array());
									}else{
$smarty->assign("ARCOUN", $mylist);

# обхвата на месеците 
//$limo= $DB->select("select min(substr(date,0,7)) as minmon, max(substr(date,0,7)) as maxmon from suitevent");
//$minmon= $limo["minmon"];
//$maxmon= $limo["maxmon"];
$limo= $DB->selectRow("select min(date) as minmon, max(date) as maxmon from suitevent");
//print_rr($limo);
	list($ye1,$mo1,$da1)= explode("-",$limo["minmon"]);
//$minmon= "$ye-$mo";
	list($ye2,$mo2,$da2)= explode("-",$limo["maxmon"]);
//$maxmon= "$ye-$mo";
//print "[$minmon][$maxmon]";
//die();

						# функциите за календара на събитията 
						include_once "cale.inc.php";
# имената на месеците 
$moname= getmoname();

# масива за избор на месец 
					$armo= array();
								$imon= 0;
	$cuye= $ye2;
	$cumo= $mo2;
while (true){
	$cumo= str_pad($cumo,2,"0",STR_PAD_LEFT);
	$elmo= "$cuye-$cumo";
//print "<br>$elmo";
					$armo[$elmo]= $moname[$cumo]."-".$cuye;
	if ($cuye==$ye1 and $cumo==$mo1){
		break;
	}else{
	}
	$cumo --;
	if ($cumo==0){
		$cumo= 12;
		$cuye --;
	}else{
	}
								$imon ++;
								if ($imon>120){
									break;
								}else{
								}
}
//print_rr($armo);
/*
# текущия месец 
$currmont= date("Y-m");
						include_once "cale.inc.php";
$listeven= getevents($currmont);
$smarty->assign("LISTEVEN", $listeven);
*/
# списъка за месеца вдясно 
$maxmon= "$ye2-$mo2";
$smarty->assign("CUMONT", $maxmon);
$listeven= getevents($maxmon);
$smarty->assign("LISTEVEN", $listeven);

									# if (empty($mylist)){
									}

							//# за избор на месец - името на масива 
							//$armo_utf8= toutf8($armo);
							//$smarty->assign("ARMONAME", "armo_utf8");
							# за избор на месец 
							$smarty->assign("ARMO", $armo);
# извеждаме 
$pagecont= smdisp("cale.tpl","fetch");

?>
