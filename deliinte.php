<?php
# документи за връчване - вътрешни от избрано тримесечие 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
# параметри : 
#    $vari - вторично меню = inte_yyyy_q 
//print_ru($GETPARAM);


# текущата страница 
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

# текущия филтър 
$filt= $GETPARAM["filt"];
					//$filt= "yes";
$isfilt= ($filt=="yes");
$smarty->assign("ISFILT", $isfilt);

# таблицата за тримесечието 
$tana= $artabl[$vari];
# визуално 
list($pref,$p2,$p3)= explode("_",$vari);
$smarty->assign("HEAD", $p2."-".$p3);

# за линка - само визуално 
$varitt= $GETPARAM["varitt"];

# за базовия линк 
$modeel= "mode=".$mode."&vari=".$vari."&filt=".$filt."&page=".$page  ."&varitt=".$varitt;
$_SESSION["deliinte_modeel"]= $modeel;
$_SESSION["deliinte_tana"]= $tana;

# за рефреш 
$relurl= geturl($modeel);

# за връщане след въвеждане на дело 
$mode2= "mode=".$mode."&vari=".$vari."&filt=".$filt."&page=".$page  ."&varitt=".$varitt;
$_SESSION["backpage"]= $page;
$_SESSION["backlink"]= geturl($mode2);

									# директно промяна метода за избран запис 
									$chmeth= $GETPARAM["chmeth"];
									if (isset($chmeth)){
										$tometh= $GETPARAM["tometh"];
		$cset= array();
			$cset["idposttype"]= $tometh;
		if ($cutype==2){
		}else{
			$cset["idpostuser"]= 0;
			$cset["date1"]= "";
			$cset["date2"]= "";
			$cset["date3"]= "";
			$cset["idpoststat"]= 0;
		}
$DB->query("update $tana set ?a where id=?d"  ,$cset,$chmeth);
# redirect 
reload("",$relurl);

									}else{
									}

# таблицата 
$taname= $tana;
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
									
									# nyroModal прозорец за корекция на филтъра 
									$filtedit= $GETPARAM["filtedit"];
//									if (isset($filtedit)){
									if ($filtedit=="yes"){
//$mode2= "mode=".$mode."&vari=".$vari."&filt=yes"."&page=1"  ."&varitt=".$varitt;
$mode2= "mode=".$mode."&vari=".$vari."&filt=yes"."&page=1";
$relu2= geturl($mode2);
														# всичко за филтъра 
														include_once "delifilt.inc.php";
										$isinte= true;
										include_once "delifiltedit.ajax.php";
										exit;
//return;
									}else{
									}
					
					# директно установяване на частичен филтър 
					# - виж delifiltedit.ajax.php 
					$varitype= $GETPARAM["varitype"];
					# автоматично за тримесечие - само в началото 
					if (isset($filt) or isset($varitype)){
					}else{
						$varitype= 2;
					}
					# установяване 
					if (isset($varitype)){
														# всичко за филтъра 
														include_once "delifilt.inc.php";
			$_POST= array();
			$_POST["idposttype"]= $varitype;
			$_POST["submit"]= "subm";
			$resu= checklist();
			list($lister,$arcode,$arview)= $resu;
//print_ru($resu);
				$_SESSION[$sepostname]= $_POST;
				$_SESSION[$secodename]= $arcode;
				$_SESSION[$seviewname]= $arview;
//$mode2= "mode=".$mode."&vari=".$vari."&filt=yes"."&page=1"  ."&varitt=".$varitype;
$mode2= "mode=".$mode."&vari=".$vari."&filt=yes"."&page=1"  ."&varitt=".$varitype;
$relu2= geturl($mode2);
reload("",$relu2);
					}else{
					}
					# за линка - само визуално 
//					$varitt= $GETPARAM["varitt"];
					if (isset($varitt) and $varitt<>0){
$smarty->assign("VARITT", $varitt);
					}else{
					}
									
									# директно изчистване на филтъра 
									$filtno= $GETPARAM["filtno"];
									if (isset($filtno)){
//										include_once "delifiltedit.ajax.php";
//										exit;
//return;
//$mode2= "mode=".$mode."&vari=".$vari."&filt=no"."&page=1"  ."&varitt=".$varitt;
$mode2= "mode=".$mode."&vari=".$vari."&filt=no"."&page=1";
$relu2= geturl($mode2);
# redirect 
reload("",$relu2);
									}else{
									}
									
									# директно влизане в делото - виж deli.php 
									$tocase= $GETPARAM["tocase"];
									if (isset($tocase)){
							$_SESSION["caseinpu"]= $tocase;
//=$mode2= "mode=".$mode."&vari=".$vari."&filt=".$filt."&page=".$page  ."&varitt=".$varitt;
//=					$_SESSION["backpage"]= $page;
//=					$_SESSION["backlink"]= geturl($mode2);
$rel4= geturl("mode=".$mode."&vari=".$cocase.$tocase);
reload("",$rel4);
									}else{
									}

# филтър за списъка 
		$filtcurr= "1";
if ($isfilt){
								# всичко за филтъра 
								include_once "delifilt.inc.php";
//print_ru($_SESSION);
	$filtse= $_SESSION[$secodename];
//var_dump($filtse);
	if (isset($filtse)){
		$filtcurr= implode(" and ",$filtse);
								# за визуализиране 
								$arviewfilt= $_SESSION[$seviewname];
//print_ru($arviewfilt);
								$smarty->assign("ARVIEWFILT", $arviewfilt);
	}else{
//		$filtcurr= "1";
	}
}else{
}

/*
# текущата страница 
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;
*/

$perpage= 20;
							#----------------------------------------------------------------
							# спец.филтър - записи с грешна дата 
# ВНИМАНИЕ. Само за 2013 година 
							if ($isfilt){
							}else{
$filterdate= "year($tana.date1)<>2013 or year($tana.date2)<>2013 or year($tana.date3)<>2013";
$couner= $DB->selectCell("select count(*) from $tana where $filterdate");
if ($couner==0){
}else{
	$smarty->assign("COUNER", $couner);
		$linkfiltdate= geturl($modeel."&filtdate=yes");
	$smarty->assign("LINKFILTDATE", $linkfiltdate);
}
									# директно прилагане на филтъра 
									$filtdate= $GETPARAM["filtdate"];
									if ($filtdate=="yes"){
$filtcurr= $filterdate;
$perpage= $couner;
									}else{
									}
							#----------------------------------------------------------------
							}

# заявка 
		$query= "select $tana.*, $tana.id as id
				, postuser.name as pouser, poststat.name as postat
				, docuout.serial as d2seri, docuout.year as d2year, docuout.id as iddout
, $docucode
				, docutype.text as d2text
				, suit.serial as caseseri, suit.year as caseyear, suit.id as caseid
				, user.name as caseuser
						, t2user.name as deliuser
			from $tana
			left join postuser on $tana.idpostuser=postuser.id
			left join poststat on $tana.idpoststat=poststat.id
				left join docuout on $tana.iddocuout=docuout.id
				left join docutype on docuout.iddocutype=docutype.id 
				left join suit on docuout.idcase=suit.id
				left join user on suit.iduser=user.id
$doculink
						left join user as t2user on $tana.iduser=t2user.id
where $filtdout and $filtcurr
and $filtnobank
			order by $tana.created desc, $tana.id desc
			";
//			where $filtstat and $filtcurr
//and $filtdout

# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
		$prefurl= "";
//		$baseurl= "mode=".$mode."&vari=".$vari."&filt=".$filt;
//		$baseurl= "mode=".$mode."&vari=".$vari."&codetabl=".$codetabl."&filt=".$filt;
		$baseurl= "mode=".$mode."&vari=".$vari."&filt=".$filt  ."&varitt=".$varitt;
//		$obpagi= new paginator(20, 8, $query);
		$obpagi= new paginator($perpage, 8, $query);
$t1= time();
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$t2= time();
$mylist= dbconv($mylist);
$t3= time();
$ta= $t2-$t1;
$tb= $t3-$t2;
//var_dump($ta);
//var_dump($tb);
							

# трансформираме го - параметри за иконите 
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
	$mylist[$uskey]["adresat"]= noquotes($uscont["adresat"]);
	$mylist[$uskey]["address"]= noquotes($uscont["address"]);
	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
	$mylist[$uskey]["chmeth"]= geturl($modeel."&chmeth=".$idcurr);
				$caseid= $uscont["caseid"];
	$mylist[$uskey]["tocase"]= geturl($modeel."&tocase=".$caseid);
}

# линк за прозореца за корекции 
$linkedit= geturl($modeel."&deliedit=0");
$smarty->assign("LINKEDIT", $linkedit);
# линк за прозореца за изчистване 
$linkclear= geturl($modeel."&deliclear=0");
$smarty->assign("LINKCLEAR", $linkclear);

# линкове за филтъра 
	$linkfiltedit= geturl($modeel."&filtedit=yes");
$smarty->assign("LINKFILTEDIT", $linkfiltedit);
	$linkfiltno= geturl($modeel."&filtno=yes");
$smarty->assign("LINKFILTNO", $linkfiltno);

/*
# текущия вариант за частич.филтър 
$varitt= $GETPARAM["varitt"];
if (isset($varitt) and $varitt<>0){
}else{
	$varitt= 2;
}
//print "<br>varitt=[$varitt]";
$smarty->assign("VARITT", $varitt);
*/
# линкове за частични филтри - методите на връчване 
			$arvaritype= array();
$ar2= $listtypepost;
unset($ar2[0]);
unset($ar2[9]);
foreach($ar2 as $idtype=>$x2){
	$arvaritype[$idtype]= geturl($modeel."&varitype=".$idtype);
}
//print_rr($arvaritype);
$smarty->assign("ARVARITYPE", $arvaritype);


# извеждаме 
$smarty->assign("LIST", $mylist);
$varipagecont= smdisp("deliinte.tpl","fetch");


?>