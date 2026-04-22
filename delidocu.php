<?php
# призовки -  изх.документи за връчване с призовкари 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
# параметри : 
#    $vari - вторично меню 
# още : 
#    $filt - има ли филтър 
#    $page - текущата страница 
//print_rr($GETPARAM);

							
# текущия филтър 
$filt= $GETPARAM["filt"];
					//$filt= "yes";
$isfilt= ($filt=="yes");
$smarty->assign("ISFILT", $isfilt);

# текущата страница 
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

# за линковете 
$modeel= "mode=".$mode."&vari=".$vari."&filt=".$filt."&page=".$page;
$relurl= geturl($modeel);

# линкове за филтъра 
	$linkfiltedit= geturl($modeel."&filtedit=yes");
$smarty->assign("LINKFILTEDIT", $linkfiltedit);
	$linkfiltno= geturl($modeel."&filtno=yes");
$smarty->assign("LINKFILTNO", $linkfiltno);

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
$mode2= "mode=".$mode."&vari=".$vari."&filt=yes"."&page=1";
$relu2= geturl($mode2);
														# всичко за филтъра 
														include_once "delifilt.inc.php";
										include_once "delifiltedit.ajax.php";
										exit;
//return;
									}else{
									}
									# директно изчистване на филтъра 
									$filtno= $GETPARAM["filtno"];
									if (isset($filtno)){
//										include_once "delifiltedit.ajax.php";
//										exit;
//return;
$mode2= "mode=".$mode."&vari=".$vari."&filt=no"."&page=1";
$relu2= geturl($mode2);
reload("",$relu2);
									}else{
									}

# филтър за списъка 
if ($isfilt){
								# всичко за филтъра 
								include_once "delifilt.inc.php";
//print_ru($_SESSION);
	$filtse= $_SESSION[$secodename];
//var_dump($filtse);
	if (isset($filtse)){
		$filtcurr= implode(" and ",$filtse);
//var_dump($filtcurr);
								# за визуализиране 
								$arviewfilt= $_SESSION[$seviewname];
//print_ru($arviewfilt);
								$smarty->assign("ARVIEWFILT", $arviewfilt);
	}else{
		$filtcurr= "1";
	}
}else{
		$filtcurr= "1";
}
if (empty($filtcurr)){
		$filtcurr= "1";
}else{
}
//var_dump($filtcurr);
//		$filtcurr= "1";

# списъка 
		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
# филтър - само от тип призовкар 
$filtstat= "post.status=2";
		$query= "select post.*, post.id as id
				, postout._docu as docutext
				, postuser.name as pouser, poststat.name as postat
			from post
			left join postout on post.idpostout=postout.id
			left join postuser on post.idpostuser=postuser.id
			left join poststat on post.idpoststat=poststat.id
						left join docuout on postout.iddocuout=docuout.id
/*** left join docutype on docuout.iddocutype=docutype.id ***/
						left join suit on docuout.idcase=suit.id
			where $filtstat and $filtcurr
and docuout.id is not null
			order by post.id desc
			";
		$prefurl= "";
		$baseurl= "mode=".$mode."&vari=".$vari."&filt=".$filt;
		$obpagi= new paginator(20, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);

# трансформираме го - параметри за иконите 
//				$modeel= "mode=".$mode."&page=".$page;
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
	$mylist[$uskey]["adresat"]= noquotes($uscont["adresat"]);
	$mylist[$uskey]["adres"]= noquotes($uscont["adres"]);
//	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
}
//print_ru($mylist);
/*
# add new link 
$addnew= geturl($modeel."&edit=0");
$smarty->assign("ADDNEW", $addnew);
*/
# линк за прозореца за корекции 
$linkedit= geturl($modeel."&deliedit=0");
$smarty->assign("LINKEDIT", $linkedit);
# линк за прозореца за изчистване 
$linkclear= geturl($modeel."&deliclear=0");
$smarty->assign("LINKCLEAR", $linkclear);

# извеждаме 
$smarty->assign("LIST", $mylist);
$varipagecont= smdisp("delidocu.tpl","fetch");

?>