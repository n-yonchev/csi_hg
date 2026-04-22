<?php
# документи за връчване с призовкари - чакащи документи 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $vari - вторично меню 
# параметри : 
#    $page - текущата страница 
//print_rr($GETPARAM);


# текущата страница 
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

# за базовия линк 
$modeel= "mode=".$mode."&vari=".$vari."&page=".$page;
$relurl= geturl($modeel);

# за връщане след въвеждане на дело 
$mode2= "mode=".$mode."&vari=".$vari."&filt=".$filt."&page=".$page  ."&varitt=".$varitt;
$_SESSION["backpage"]= $page;
$_SESSION["backlink"]= geturl($mode2);

# тип - вътрешни=0 външни=1 
list($x1,$mytype)= explode("_",$vari);
$isinte= ($mytype==0);
$smarty->assign("ISINTE", $isinte);

# според типа 
if ($isinte){
	$filtwait= "postwait.iddocu=0 and $filtdout";
	$groufiel= "postwait.iddocuout";
	$totabl= $cutabl;
//	$arunset= array("id","isdubl","exinfo","iddocu","iddelisour");
}else{
	$filtwait= "postwait.iddocu<>0";
	$groufiel= "postwait.iddocu";
	$totabl= "deliexte";
//	$arunset= array("id","isdubl","iddocuout","idposttype");
}
$arunset= getunset($isinte);
//var_dump($totabl);
//var_dump($filtwait);

/***
									# nyroModal прозорец за корекции на маркирани записи 
									$deliwaitedit= $GETPARAM["deliwaitedit"];
									if (isset($deliwaitedit)){
						$aridpost= $_SESSION["aridpost"];
										include_once "deliwaitedit.ajax.php";
										exit;
//return;
									}else{
									}
***/
									# nyroModal прозорец за прехвърляне на маркирани записи 
									$deliwaitcopy= $GETPARAM["deliwaitcopy"];
									if (isset($deliwaitcopy)){
						$aridpost= $_SESSION["aridpost"];
										include_once "deliwaitcopy.ajax.php";
										exit;
//return;
									}else{
									}
									# директно дублиране на избран запис 
									$deliwaitdubl= $GETPARAM["deliwaitdubl"];
									if (isset($deliwaitdubl)){
//$rowait= getrow("postwait",$deliwaitdubl);
//var_dump($deliwaitdubl);
$rowait= $DB->selectRow("select * from postwait where id=?d"  ,$deliwaitdubl);
	unset($rowait["id"]);
	$rowait["isdubl"]= 1;
//print_rr($rowait);
//$newid= $DB->query("insert into postwait set ?a"  ,$rowait);
$newid= insepostwait($rowait,false);
//var_dump($newid);
# redirect 
reload("",$relurl);
									}else{
									}
									# директно изтриване на дублиран запис 
									$deliwaitdele= $GETPARAM["deliwaitdele"];
									if (isset($deliwaitdele)){
$DB->query("delete from postwait where id=?d"  ,$deliwaitdele);
# redirect 
reload("",$relurl);
									}else{
									}

									# nyroModal прозорец за корекции на избран запис 
									$deliwaitedit= $GETPARAM["deliwaitedit"];
									if (isset($deliwaitedit)){
										include_once "deliwaitedit.ajax.php";
										exit;
//return;
									}else{
									}
									
									# директно влизане в делото - виж deli.php 
									$tocase= $GETPARAM["tocase"];
									if (isset($tocase)){
							$_SESSION["caseinpu"]= $tocase;
//$mode2= "mode=".$mode."&vari=".$vari."&filt=".$filt."&page=".$page  ."&varitt=".$varitt;
//=					$_SESSION["backpage"]= $page;
//=					$_SESSION["backlink"]= $relurl;
$rel4= geturl("mode=".$mode."&vari=".$cocase.$tocase);
reload("",$rel4);
									}else{
									}

		# заявка - по изходящ/входящ документ 
		$query= "select distinct $groufiel as ARRAY_KEY
				, postwait.created
				, docuout.serial as d2seri, docuout.year as d2year, docuout.id as iddout
, $docucode
				, docutype.text as d2text
				, suit.serial as caseseri, suit.year as caseyear, suit.id as caseid
				, user.name as caseuser
						, t2user.name as deliuser
						, postuser.name as pouser
				, docu.serial as d1seri, docu.year as d1year
				, docu.text as docutext, docu.from as docufrom, docu.notes as docunote
			from postwait
				left join docuout on postwait.iddocuout=docuout.id
				left join docutype on docuout.iddocutype=docutype.id 
				left join suit on docuout.idcase=suit.id
				left join user on suit.iduser=user.id
						left join user as t2user on postwait.iduser=t2user.id
						left join postuser on postwait.idpostuser=postuser.id
				left join docu on postwait.iddocu=docu.id
$doculink
			where $filtwait
and $filtnobank
			order by postwait.created desc, postwait.id desc
			";

# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
		$prefurl= "";
//		$baseurl= "mode=".$mode."&vari=".$vari."&filt=".$filt;
		$baseurl= $modeel."&filt=".$filt;
		$obpagi= new paginator(20, 8, $query);
//		$obpagi= new paginator(10, 8, $query);
//$t1= time();
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);
//print_ru($mylist);

# списък изходящи/входящи документи 
if (empty($mylist)){
	$codein= "0";
}else{
	$arin= array_keys($mylist);
	$codein= implode(",",$arin);
}

		# детайлен списък документи и данни 
		$query= "select distinct $groufiel as ARRAY_KEY1, postwait.id as ARRAY_KEY2
				, postwait.idposttype, postwait.adresat, postwait.address, postwait.exinfo, postwait.isdubl
				, postuser.name as pouser, delisour.name as sourname
			from postwait
				left join postuser on postwait.idpostuser=postuser.id
				left join delisour on postwait.iddelisour=delisour.id
			where $groufiel in ($codein)
			";
$mydata= $DB->select($query);
$mydata= dbconv($mydata);
//print_ru($mydata);

# трансформираме го - параметри за иконите 
foreach ($mydata as $uskey=>$x2){
	foreach ($x2 as $idwait=>$uscont){
		$mydata[$uskey][$idwait]["adresat"]= noquotes($uscont["adresat"]);
		$mydata[$uskey][$idwait]["address"]= noquotes($uscont["address"]);
		$mydata[$uskey][$idwait]["deliwaitedit"]= geturl($modeel."&deliwaitedit=".$idwait);
		$mydata[$uskey][$idwait]["deliwaitdubl"]= geturl($modeel."&deliwaitdubl=".$idwait);
		$mydata[$uskey][$idwait]["deliwaitdele"]= geturl($modeel."&deliwaitdele=".$idwait);
//				$caseid= $uscont["caseid"];
//		$mydata[$uskey][$idwait]["tocase"]= geturl($modeel."&tocase=".$caseid);
	}
}
//print_ru($mydata);

# бройки детайлни документи 
foreach($mylist as $uskey=>$uscont){
	$mylist[$uskey]["coun"]= count($mydata[$uskey]);
				$caseid= $uscont["caseid"];
	$mylist[$uskey]["tocase"]= geturl($modeel."&tocase=".$caseid);
}
//print_ru($mylist);
//$t2= time();
//$ta= $t2-$t1;
//var_dump($ta);

# линк за прозореца за корекции 
$linkcopy= geturl($modeel."&deliwaitcopy=0");
$smarty->assign("LINKCOPY", $linkcopy);
/*
# линк за прозореца за изчистване 
$linkclear= geturl($modeel."&deliwaitclear=0");
$smarty->assign("LINKCLEAR", $linkclear);
*/

# извеждаме 
$smarty->assign("LIST", $mylist);
$smarty->assign("DATA", $mydata);
$varipagecont= smdisp("deliwait.tpl","fetch");


?>