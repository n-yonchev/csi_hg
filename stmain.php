<?php
# начало на статистиката - сборна таблица с линкове 
# отгоре : 
#    $mode - текущия режим 
//print_r($GETPARAM);

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

									# детайлни справки 
									$stuser= $GETPARAM["user"];
									$stmont= $GETPARAM["mont"];
									if (isset($stmont)){
										if (isset($stuser)){
											include_once "stusermont.php";
# вика се в глав.прозорец, вмъква се в основната страница
return;
										}else{
											include_once "stmont.php";
# вика се в глав.прозорец, вмъква се в основната страница
return;
										}
									}else{
									}
									# за период 
									$stperi= $GETPARAM["peri"];
									if (isset($stperi)){
											include_once "stmont.php";
# вика се в глав.прозорец, вмъква се в основната страница
return;
									}else{
									}

#----------------------------------------------------------------------------------
# формата за евент.период 
				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
//print_r($_POST);
if (0){
#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	$_POST["period"]= "1.1.$year-31.12.$year";
#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
#------ submit с формални грешки 
}elseif ($mfacproc==NULL){
							$retucode= 1;
	doerrors();
#------ автоматичен submit -----------------------------------------------------
}elseif ($mfacproc=="UNKNOWN"){
							$retucode= 2;
											# проверяваме за допълнителни грешки 
							$txer= "";
	list($date1,$date2)= explode("-",$_POST["period"]);
	$bgdate1= bgdateto($date1);
//var_dump($bgdate1);
	list($ye,$mo,$da)= explode("-",$bgdate1);
//print "[$ye][$mo][$da]";
	if (checkdate($mo+0,$da+0,$ye+0)){
		if (empty($date2)){
		}else{
			$bgdate2= bgdateto($date2);
			list($ye,$mo,$da)= explode("-",$bgdate2);
			if (checkdate($mo+0,$da+0,$ye+0)){
				if ($bgdate1>=$bgdate2){
							$txer= "грешен период";
				}else{
				}
			}else{
							$txer= "грешна кр.дата";
			}
//print "[$bgdate1][$bgdate2]";
		}
	}else{
							$txer= "грешна нач.дата";
	}
$smarty->assign("TXER", $txer);
	if (empty($txer)){
							$retucode= 0;
	}else{
	}
#------ невъзможна грешка от библиотеката 
}else{
print "<br>error=mfacproc=";
var_dump($mfacproc);
die();
}

# резултат 
if ($retucode==0){
	if (empty($date2)){
		$bgdate2= $bgdate1;
	}else{
	}
	# redirect 
	$relurl= geturl("mode=".$mode."&peri=".$bgdate1."^".$bgdate2);
	reload("",$relurl);
}else{
}
#----------------------------------------------------------------------------------

# филтъра 
$filt= "year(finance.time)=$year";
# данните 
/******
//$query= "select suit.iduser as ARRAY_KEY_1, month(finance.time) as ARRAY_KEY_2
$query= "select if(suit.iduser+0<=0,0,suit.iduser) as ARRAY_KEY_1, month(finance.time) as ARRAY_KEY_2
	, count(finance.id) as coun
	from finance
	left join suit on finance.idcase=suit.id
	where $filt
	group by suit.iduser, month(finance.time)
	";
//print $query;
$mylist= $DB->selectCol($query);
******/

/*********************************************
		# ВАЖНО. горната заявка не работи добре. 
		# suit.iduser as ARRAY_KEY_1 има стойности NULL -1 0 
$query= "select suit.iduser as iduser, month(finance.time) as mont
	, count(finance.id) as coun
	from finance
	left join suit on finance.idcase=suit.id
	where $filt
	group by iduser, mont
	";
//print $query;
$mylist= $DB->select($query);
//print_r($mylist);
//$smarty->assign("DATA", $mylist);

# обработваме данните 
						$list2= array();
foreach($mylist as $elem){
	$cuuser= $elem["iduser"];
		# ВАЖНО. 
		# $cuuser има стойности NULL -1 0 
		$cuuser= $cuuser+0<=0 ? 0 : $cuuser;
	$cumont= $elem["mont"];
	$cucoun= $elem["coun"];
						$list2[$cuuser][$cumont] += $cucoun;
}
//print_r($list2);
//print_r($link);
$smarty->assign("DATA", $list2);

# сумарните ред и колона 
					$suuser= array();
					$sumont= array();
//foreach($mylist as $iduser=>$datauser){
foreach($list2 as $iduser=>$datauser){
	foreach($datauser as $idmont=>$coun){
					$suuser[$iduser] += $coun;
					$sumont[$idmont] += $coun;
	}
}
# и тоталната сума 
					$sutota= 0;
foreach($sumont as $coun){
					$sutota += $coun;
}
$smarty->assign("SUUSER", $suuser);
$smarty->assign("SUMONT", $sumont);
$smarty->assign("SUTOTA", $sutota);
*********************************************/

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

# извеждаме 
//$smarty->assign("ADDNEW", $addnew);
//$smarty->assign("LIST", $mylist);
$pagecont= smdisp("stmain.tpl","fetch");

?>
