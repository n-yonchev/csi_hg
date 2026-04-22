<?php
# статистика - форма за избор на година/месец или период 
# източник : stmain.php 

# годината  
	unset($listyear[0]);
	$arke= array_keys($listyear);
$year= $GETPARAM["year"];
$year= isset($year) ? $year : $arke[0];
$smarty->assign("YEAR", $year);
//var_dump($year);
//print_r($listyear);

# масива с линкове за годините 
	$baseurl= "mode=".$mode;
		$yearli= array();
foreach ($listyear as $cuyear){
		$yearli[$cuyear]= geturl($baseurl."&year=".$cuyear);
}
$smarty->assign("YEARLIST", $yearli);
//print_r($yearli);




# деловодителите 
$userlist= getselect("user","name","1",true);
	$userlist= tran1251($userlist);
$smarty->assign("USERLIST", $userlist);
//print_r($userlist);

# месеците 
$montlist= array(1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10,11=>11,12=>12);
$smarty->assign("MONTLIST", $montlist);

# формираме линковете за месец и месец-деловодител 
# всички линкове - не само тези, за които има данни 
			$modeel= "mode=".$mode."&year=".$year;
			$linkmont= array();
			$link= array();
foreach($montlist as $cumont=>$x2){
	foreach($userlist as $cuuser=>$x2){
			$linkmont[$cumont]= geturl($modeel."&mont=".$cumont);
			$link[$cuuser][$cumont]= geturl($modeel."&user=".$cuuser."&mont=".$cumont);
	}
}
$smarty->assign("LINK", $link);
$smarty->assign("LINKMONT", $linkmont);


?>
