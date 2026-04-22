<?php
# вътрешни документи за връчване - по въведен списък - таблица delilist 
# източник : deliinte.php - вътр.документи за връчване от избрано тримесечие 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
# параметри : 
#    $vari - вторично меню = list_ 
//print_ru($GETPARAM);
//print_rr($_POST);


# за базовия линк 
//$modeel= "mode=".$mode."&vari=".$vari."&filt=".$filt."&page=".$page  ."&varitt=".$varitt;
$modeel= "mode=".$mode."&vari=".$vari."&page=".$page;
									
									# директно нулиране на списъка 
									$delelist= $GETPARAM["delelist"];
									if (isset($delelist)){
//				$_SESSION[$selistname]= array();
$DB->query("truncate table delilist");
$rel4= geturl($modeel);
reload("",$rel4);
									}else{
									}
# добавяне към списъка 
$doutinpu= $_POST["doutinpu"];
//var_dump($doutinpu);
if (isset($doutinpu)){
	# въведения номер/год 
	list($doseri,$doyear)= explode("/",$doutinpu);
							# алтернативно - от баркод скенера 
							if (empty($doyear)){
								/*
								$doyear= substr($doutinpu,-2);
								$doseri= substr($doutinpu,0,strlen($doutinpu)-2);
								*/
								$doseri= substr($doutinpu,0,10);
									$doseri +=0;
								$doyear= substr($doutinpu,10,2);
$_POST["doutinpu"]= "$doseri/$doyear";
							}else{
							}
	if (substr($doyear,0,2)=="20"){
	}else{
		$doyear= "20".$doyear;
	}
	$iddout= $DB->selectCell("select id from docuout where serial=?d and year=?d"  ,$doseri,$doyear);
//print "[$doseri][$doyear]";
//var_dump($iddout);
	if ($iddout==0){
//$smarty->assign("ERDOUT", "няма такъв");
$smarty->assign("ERDOUT", "$doseri/$doyear липсва");
unset($_POST["doutinpu"]);
unset($iddout);
	}else{
		$filtinpu= "docuout.id=$iddout";
		$uniqname= getuniontab($filtinpu);
		$aruniq= $DB->selectRow("select iddocuout from `$uniqname`");
//print_ru($aruniq);
		if (empty($aruniq)){
//$smarty->assign("ERDOUT", "отсъства");
$smarty->assign("ERDOUT", "$doseri/$doyear отсъства");
unset($_POST["doutinpu"]);
unset($iddout);
		}else{
			# добавяме 
//			$_SESSION[$selistname][]= $iddout;
//			array_unshift($_SESSION[$selistname], $iddout);
$DB->query("insert into delilist set iddocuout=?d",  $iddout);
unset($_POST["doutinpu"]);
		}
	}
}else{
}

				#==================== ВРЕМЕННО =============================
//				$_SESSION[$selistname]= array(304046,304053,304062,304092);
# списъка с docuout.id 
//$arlist= $_SESSION[$selistname];
$arlist= $DB->selectCol("select iddocuout from delilist order by id");
if (empty($arlist)){
	$incode= "0";
}else{
	$incode= implode(",",$arlist);
}
$filtlist= "docuout.id in ($incode)";

# текущата страница 
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

/*
# за базовия линк 
//$modeel= "mode=".$mode."&vari=".$vari."&filt=".$filt."&page=".$page  ."&varitt=".$varitt;
$modeel= "mode=".$mode."&vari=".$vari."&page=".$page;
*/
# за рефреш 
$relurl= geturl($modeel);

//# таблицата 
//$taname= $tana;
									# nyroModal прозорец за корекции на маркирани записи 
									$deliedit= $GETPARAM["deliedit"];
									if (isset($deliedit)){
						$aridpost= $_SESSION["aridpost"];
										include_once "deliedit.ajax.php";
										exit;
//return;
									}else{
									}
									# nyroModal прозорец за изчистване на маркирани записи 
									$deliclear= $GETPARAM["deliclear"];
									if (isset($deliclear)){
						$aridpost= $_SESSION["aridpost"];
										include_once "deliclear.ajax.php";
										exit;
//return;
									}else{
									}
									
									# директно влизане в делото - виж deli.php 
									$tocase= $GETPARAM["tocase"];
									if (isset($tocase)){
							$_SESSION["caseinpu"]= $tocase;
//print "mode=".$mode."&vari=".$cocase.$tocase;
$rel4= geturl("mode=".$mode."&vari=".$cocase.$tocase);
reload("",$rel4);
									}else{
									}

#-------------------- източник : delicase.php - за отделно дело ---------------------------
# участват записи от всички тримесечни таблици 

# списък на изходените документи от списъка 
$filtdout= "docuout.serial<>0 and docuout.year<>0";
/***
$ardout= $DB->select("
	select docuout.id as ARRAY_KEY
		, docuout.registered as d2regi, docuout.serial as d2seri, docuout.year as d2year
		, docutype.text as d2text, docutype.isbank, docutype.idposttype as d2posttype
		, user.name as d2userregi
, docuout.idcase as caseid
, suit.serial as caseseri, suit.year as caseyear
, u2.name as username
	from docuout
		left join docutype on docuout.iddocutype=docutype.id 
		left join user on docuout.iduserregi=user.id
left join suit on docuout.idcase=suit.id 
left join user  as u2 on suit.iduser=u2.id
	where $filtlist
and $filtdout
	order by docuout.id desc
	");
***/
$ardout= $DB->select("
	select docuout.id as ARRAY_KEY
		, docuout.registered as d2regi, docuout.serial as d2seri, docuout.year as d2year, docuout.id as iddout
, $docucode
		, docutype.text as d2text, docutype.isbank, docutype.idposttype as d2posttype
		, user.name as d2userregi
, docuout.idcase as caseid
, suit.serial as caseseri, suit.year as caseyear
, u2.name as username
	from delilist
		left join docuout on delilist.iddocuout=docuout.id 
		left join docutype on docuout.iddocutype=docutype.id 
		left join user on docuout.iduserregi=user.id
			left join suit on docuout.idcase=suit.id 
			left join user  as u2 on suit.iduser=u2.id
$doculink
	where $filtdout
	order by delilist.id desc
	");
$ardout= dbconv($ardout);
//print_ru($ardout);
//$smarty->assign("ARDOUT", $ardout);
//print_ru($ardout);

# временна обединена таблица 
$uniqname= getuniontab($filtlist);
//$ar2= $DB->select("select * from `$uniqname`");
//print_rr($ar2);

# екземплярите за връчване от нея 
$ardeli= $DB->select("
	select t1.iddocuout as ARRAY_KEY1, concat(t1.tana,'^',t1.taid) as ARRAY_KEY2
		, t1.*, 0 as iswait
		, postuser.name as pouser, poststat.name as postat
	from `$uniqname` as t1
		left join postuser on t1.idpostuser=postuser.id
		left join poststat on t1.idpoststat=poststat.id
	");
$ardeli= dbconv($ardeli);
//print "ARDELI=========";
//print_ru($ardeli);

#------------------------------------------------------------------------------------------

# за връщане след въвеждане на дело 
//$mode2= "mode=".$mode."&vari=".$vari."&filt=".$filt."&page=".$page  ."&varitt=".$varitt;
$_SESSION["backpage"]= $page;
//$_SESSION["backlink"]= geturl($mode2);
$_SESSION["backlink"]= geturl($modeel);

# трансформация 
foreach ($ardeli as $key1=>$x2){
	foreach ($x2 as $key2=>$uscont){
		$ardeli[$key1][$key2]["adresat"]= noquotes($uscont["adresat"]);
		$ardeli[$key1][$key2]["address"]= noquotes($uscont["address"]);
			if ($uscont["iswait"]==0){
				$tana= $uscont["tana"];
				$taid= $uscont["taid"];
//		$ardeli[$key1][$key2]["deliedit"]= geturl($modeel  ."&tana=".$tana."&taid=".$taid);
			}else{
/*
				$idwait= $uscont["idwait"];
		$ardeli[$key1][$key2]["waittonorm"]= geturl($modeel."&waittonorm=".$idwait);
		$ardeli[$key1][$key2]["deliwaitedit"]= geturl($modeel."&deliwaitedit=".$idwait);
		$ardeli[$key1][$key2]["deliwaitdubl"]= geturl($modeel."&deliwaitdubl=".$idwait);
		$ardeli[$key1][$key2]["deliwaitdele"]= geturl($modeel."&deliwaitdele=".$idwait);
*/
			}
	}
}
//print_ru($ardeli);
$smarty->assign("ARDELI", $ardeli);
# брой екземпляри за всеки изх.документ 
foreach ($ardout as $uskey=>$uscont){
	$ardout[$uskey]["coun"]= count($ardeli[$uskey]);
				$caseid= $uscont["caseid"];
	# линк към делото 
	$ardout[$uskey]["tocase"]= geturl($modeel."&tocase=".$caseid);
}
$smarty->assign("ARDOUT", $ardout);
//print "ARDOUT=========";
//print_ru($ardout);

# линк за прозореца за корекции 
$linkedit= geturl($modeel."&deliedit=0");
$smarty->assign("LINKEDIT", $linkedit);
# линк за прозореца за изчистване 
$linkclear= geturl($modeel."&deliclear=0");
$smarty->assign("LINKCLEAR", $linkclear);
			# линк за нулиране на списъка 
			$linkdelelist= geturl($modeel."&delelist=yes");
			$smarty->assign("LINKDELELIST", $linkdelelist);
/*
# линкове за филтъра 
	$linkfiltedit= geturl($modeel."&filtedit=yes");
$smarty->assign("LINKFILTEDIT", $linkfiltedit);
	$linkfiltno= geturl($modeel."&filtno=yes");
$smarty->assign("LINKFILTNO", $linkfiltno);
*/


# извеждаме 
//$smarty->assign("LIST", $mylist);
$smarty->assign("ISLIST", true);
$varipagecont= smdisp("delicase.tpl","fetch");

?>