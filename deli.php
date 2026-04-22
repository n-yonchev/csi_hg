<?php
# документи за връчване - главен компонент 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
# параметри : 
#    $vari - вторично меню 
//print "deli=getparam=";
//print_rr($GETPARAM);
//print_rr($_POST);
//print_ru($_SESSION);

									# функции 
									include_once "deli.inc.php";

# за базовия линк 
$modeel= "mode=".$mode;

# дефиниции за вторич.меню 
#-- текстове за методите ниво-1 
//$armeth= $listtypepost;
//unset($armeth[0]);
$armeth= array();
$armeth[11]= "всички методи";
$armeth[2]= $listtypepost[2];
$armeth[1]= $listtypepost[1];
# 28.08.2015 - още 2 метода 
$armeth[3]= $listtypepost[3];
$armeth[4]= $listtypepost[4];
$armeth[9]= $listtypepost[9];
//////$armeth[12]= "без избран метод";
$smarty->assign("ARMETH", $armeth);

#-- основни текстове ниво-2 
	$arvari= array();
$arvari["list_2"]= "документи";
$arvari["list_1"]= "документи";
	$arvari["enve_1"]= "пликове";
	$arvari["send_1"]= "изпращане";
$arvari["list_3"]= "документи";
$arvari["list_4"]= "документи";
$arvari["list_9"]= "документи";
	$arvari["all_11"]= "всички";
	$arvari["filt_11"]= "филтър";
	$arvari["list_11"]= "списък";
	$arvari["exte_11"]= "външни";
	$arvari["pprs_11"]= "чл.417";
//$arvari["nome_12"]= "списък";
//print_ru($arvari);
$smarty->assign("ARVARI", $arvari);

#-- линкове 
			$arvarilink= array();
foreach($arvari as $indx=>$x2){
	list($e1,$e2)= explode("_",$indx);
	$arvarilink[$e2+0][$indx]= geturl($modeel."&vari=$indx");
			# форма за филтъра - forcing 
			if ($indx=="filt_11"){
	$arvarilink[$e2+0][$indx]= geturl($modeel."&vari=".$indx."&force=yes");
			}else{
			}
}
//print_ru($arvarilink);
$smarty->assign("ARVARILINK", $arvarilink);

#-- филтри 
	$arfilt= array();
$arfilt["list_2"]= "post.idposttype=2";
$arfilt["list_1"]= "post.idposttype=1";
$arfilt["list_3"]= "post.idposttype=3";
$arfilt["list_4"]= "post.idposttype=4";
$arfilt["list_9"]= "post.idposttype=9";
	$arfilt["all_11"]= "1";
	$arfilt["filt_11"]= "1";
	$arfilt["list_11"]= "1";
	$arfilt["exte_11"]= "1";
	$arfilt["pprs_11"]= $codeinterest;

# елемент от вторич.меню 
$vari= $GETPARAM["vari"];
if (isset($vari)){
}else{
//	$vari= "sing_2";
	$vari= "all_11";
}
$smarty->assign("VARI", $vari);

# текущата страница 
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

# избрания външен източник 
$idsour= $GETPARAM["idsour"];
$idsour= isset($idsour) ? $idsour : 0;

# филтър от вторич.меню 
$filtvari= $arfilt[$vari];
//var_dump($filtvari);

								# сортировка текст 
								$arsort= array();
								$arsort[1]= "по номер";
								$arsort[2]= "по тип";
								$arsort[3]= "по дело";
								$arsort[4]= "по деловодител";
								# сортировка код 
								$arsortcode= array();
								$arsortcode[1]= "post.created desc, post.id desc";
								$arsortcode[2]= "docutype.text";
								$arsortcode[3]= "suit.year desc, suit.serial desc";
								$arsortcode[4]= "user.name";
								# сортировка линкове 
									$arsortlink= array();
$modeso= "mode=".$mode."&vari=".$vari;
								foreach($arsort as $indx=>$elem){
									$arsortlink[$indx]= geturl($modeso."&sort=".$indx);
								}
							# текуща сортировка 
							$sort= $GETPARAM["sort"];
							$sort= isset($sort) ? $sort: 1;
							# текущ код 
							$sortcode= $arsortcode[$sort];
$smarty->assign("ARSORT", $arsort);
$smarty->assign("ARSORTLINK", $arsortlink);
$smarty->assign("SORT", $sort);
									
# корекции 
//++$mode6= "mode=".$mode."&vari=".$vari."&page=".$page;
//$mode6= "mode=".$mode."&vari=".$vari."&page=".$page."&sort=".$sort;
$mode6= "mode=".$mode."&vari=".$vari."&page=".$page."&sort=".$sort."&idsour=".$idsour;
$relu6= geturl($mode6);

# групови корекции 
#---------------------------------------------------------------------------------
$taname= "post";
$relurl= $relu6;
									# nyroModal за корекции на маркирани записи 
									$deliedit= $GETPARAM["deliedit"];
									if (isset($deliedit)){
						$aridpost= $_SESSION["aridpost"];
										include_once "delieditcb.ajax.php";
										exit;
//return;
									}else{
									}
									# nyroModal за изчистване на маркирани записи 
									$deliclear= $GETPARAM["deliclear"];
									if (isset($deliclear)){
						$aridpost= $_SESSION["aridpost"];
										include_once "deliclearcb.ajax.php";
										exit;
//return;
									}else{
									}

#---------------------------------------------------------------------------
							# всичко за сканираните вх.документи 
$isdocuout= true;
$smarty->assign("ISDOCUOUT", true);
							include_once "docuedituplo.inc.php";
							# управление на действията - $modeel участва 
							include_once "docuedituplo2.inc.php";
												
												# разглеждане на сканираните документи за свързан документ - ПДИ 
												$scanview2= $GETPARAM["scanview2"];
												if (isset($scanview2)){
														$scanview= $scanview2;
														include_once "docueditscanview.ajax.php";
														exit;
												}else{
												}
							
							# за сканиране от андроид - HTML5 браузер 
							include_once "a1scan.inc.php";
							
									# nyroModal прозорец за формиране придруж.писмо - $modeel участва 
									$creapp= $GETPARAM["creapp"];
									if (isset($creapp)){
											# придруж.писмо ПП се връчва с призовкар, а не чрез бълг.пощи 
											$_POST_TYPE_2= true;
# reload - след успешен събмит - вече заредено 
										include_once "delicreapp.ajax.php";
										exit;
									}else{
									}
#---------------------------------------------------------------------------

# филтър от формата 
#---------------------------------------------------------------------------------
													$isinte= true;
													$tana= "post";
												include_once "delifilt.inc.php";

									# специфичен филтър - всички изх.документи от избрано дело 
									$tocase= $GETPARAM["tocase"];
									if (isset($tocase)){
										$roc2= getrow("suit",$tocase);
										$cas2= $roc2["serial"]."/".$roc2["year"];
		# директни действия - от експеримент 
		$_SESSION[$sepostname]= array("seriyearcase"=>$cas2);
		$_SESSION[$secodename]= array(0=>"docuout.idcase=$tocase");
		$_SESSION[$seviewname]= array("seriyearcase"=>$cas2);
		# reload 
		$mod2= "mode=deli&vari=filt_11";
		$rel2= geturl($mod2);
		reload("",$rel2);
									}else{
									}
# филтър от формата 
$filtform= "1";
# филтър визуализация 
$arviewfilt= $_SESSION[$seviewname];
$smarty->assign("ARVIEWFILT", $arviewfilt);
//print_ru($arviewfilt);
								# управление за филтъра 
								if ($vari=="filt_11"){
									$force= $GETPARAM["force"];
									if ($force=="yes"){
										# отваряме форма за филтър в nyroModal 
$mode2= "mode=".$mode."&vari=".$vari;
$relu2= geturl($mode2);
										include_once "delifiltedit.ajax.php";
										exit;
									}else{
										# зареждаме филтъра за списък 
$filtse= $_SESSION[$secodename];
//print_rr($filtse);
//										$filtform= implode(" and ",$filtse);
												# 28.08.2015 
												if (empty($filtse)){
										$filtform= "1";
												}else{
										$filtform= implode(" and ",$filtse);
												}
									}
								}else{
//unset($_SESSION[$secodename]);
								}


# списък - обработка 
#---------------------------------------------------------------------------------
						if($vari=="list_11"){
$mode4= "mode=".$mode."&vari=".$vari;
									# директно нулиране на списъка 
									$delelist= $GETPARAM["delelist"];
									if (isset($delelist)){
$DB->query("truncate table postlist");
$rel4= geturl($mode4);
reload("",$rel4);
									}else{
									}
			# линк за нулиране на списъка 
			$linkdelelist= geturl($mode4."&delelist=yes");
			$smarty->assign("LINKDELELIST", $linkdelelist);
# добавяне към списъка 
$doutinpu= $_POST["doutinpu"];
//var_dump($doutinpu);
if (isset($doutinpu)){
	# въведения номер/год 
									# алтернативно - номер плик 
									if (substr($doutinpu,0,1)=="#"){
										$iden2= substr($doutinpu,1) +0;
										$roen2= getrow("postenve",$iden2);
										if (empty($roen2)){
$smarty->assign("ERDOUT", "плик #$iden2 липсва");
unset($_POST["doutinpu"]);
unset($iden2);
										}else{
											$ardoutlist= $DB->selectCol("select iddocuout from postlist");
											$ardoutpost= $DB->selectCol("select iddocuout from post where idenve=?d"  ,$iden2);
											foreach($ardoutpost as $iddo2){
												if (in_array($iddo2,$ardoutlist)){
												}else{
													$DB->query("insert into postlist set iddocuout=?d",  $iddo2);
												}
											}
unset($_POST["doutinpu"]);
$rel4= geturl($mode4);
reload("",$rel4);
										}
									}else{
	# изх.документ/година 
	list($doseri,$doyear)= explode("/",$doutinpu);
							/*
							# алтернативно - от баркод скенера 
							if (empty($doyear)){
								$doseri= substr($doutinpu,0,10);
									$doseri +=0;
								$doyear= substr($doutinpu,10,2);
$_POST["doutinpu"]= "$doseri/$doyear";
							}else{
							}
							*/
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
/***
		$filtinpu= "docuout.id=$iddout";
		$uniqname= getuniontab($filtinpu);
		$aruniq= $DB->selectRow("select iddocuout from `$uniqname`");
//print_ru($aruniq);
		if (empty($aruniq)){
//$smarty->assign("ERDOUT", "отсъства");
***/
		$ardout= $DB->selectRow("select iddocuout from post where iddocuout=?d"  ,$iddout);
		if (empty($ardout)){
$smarty->assign("ERDOUT", "$doseri/$doyear отсъства");
unset($_POST["doutinpu"]);
unset($iddout);
		}else{
			$coundout= $DB->selectCell("select count(*) from postlist where iddocuout=?d"  ,$iddout);
			if ($coundout==0){
				# добавяме 
//			$_SESSION[$selistname][]= $iddout;
//			array_unshift($_SESSION[$selistname], $iddout);
				$DB->query("insert into postlist set iddocuout=?d",  $iddout);
				unset($_POST["doutinpu"]);
$rel4= geturl($mode4);
reload("",$rel4);
			}else{
$smarty->assign("ERDOUT", "$doseri/$doyear вече е в списъка");
unset($_POST["doutinpu"]);
unset($iddout);
			}
		}
	}
									# край алтернативно - номер плик 
									# if (substr($doutinpu,0,1)=="#"){
									}
}else{
}
						}else{
						# if($vari=="list_11"){
						}
#---------------------------------------------------------------------------------

									# nyroModal корекции на избран запис 
									$postedit= $GETPARAM["postedit"];
									if (isset($postedit)){
										include_once "deliedit.ajax.php";
										exit;
									}else{
									}
									# nyroModal корекция на забележка 
									$postnote= $GETPARAM["postnote"];
									if (isset($postnote)){
										include_once "delinote.ajax.php";
										exit;
									}else{
									}
									# директно дублиране на избран запис 
									$postdubl= $GETPARAM["postdubl"];
									if (isset($postdubl)){
$rowait= $DB->selectRow("select * from post where id=?d"  ,$postdubl);
	unset($rowait["id"]);
						unset($rowait["date1"]);
						unset($rowait["date2"]);
						unset($rowait["date3"]);
						unset($rowait["idpoststat"]);
				unset($rowait["notes"]);
				unset($rowait["idpp"]);
	$rowait["isdubl"]= 1;
//$newid= insepostwait($rowait,false);
postinse($rowait,false);
reload("",$relu6);
									}else{
									}
									# директно изтриване на дублиран запис 
									$postdele= $GETPARAM["postdele"];
									if (isset($postdele)){
$DB->query("delete from post where id=?d"  ,$postdele);
reload("",$relu6);
									}else{
									}

# бройки 
				$arcode= array();
foreach($arfilt as $code=>$elem){
				$arcode[]= "sum(if($elem,1,0)) as $code";
}
//print_rr($arcode);
				$codecoun= implode(",",$arcode);
/*
# брои екземплярите 
$arcoun= $DB->selectRow("
	select $codecoun 
	from post 
	left join docuout on post.iddocuout=docuout.id
	left join docutype on docuout.iddocutype=docutype.id 
	");
*/
# брои изх.документи 
$arcoun= $DB->selectRow("
	select $codecoun 
	from (select distinct iddocuout, idposttype from post as t2) as post
	left join docuout on post.iddocuout=docuout.id
	left join docutype on docuout.iddocutype=docutype.id 
					left join suit on docuout.idcase=suit.id
	");
//print_rr($arcoun);

# бройки - изключения 
#?????????????????????????????????????????????????????????
$arcoun["filt_11"]= 0;
//$arcoun["list_11"]= 0;
$arcoun["list_11"]= $DB->selectCell("select count(*) from postlist");
$arcoun["exte_11"]= $DB->selectCell("select count(*) from post where iddocu<>0");
$smarty->assign("ARCOUN", $arcoun);
//print_rr($arcoun);

//# филтър от формата 
//#???????????????????????????????????????????????????????????????????
//$filtform= "1";
								# управление за външни 
								if ($vari=="exte_11"){
										include_once "deliexte.php";
//										exit;
										return;
								}else{
								}


# филтър само по пощата 
$codepostonly= "post.idposttype=1";
$filtbase= "$filtdout and $codepostonly";

# пликове обработка 
if ($vari=="enve_1"){
	$modebase= "mode=".$mode."&vari=".$vari;
	include_once "delienve.php";
	$smarty->assign("CONT3", $cont3);
	$pagecont= smdisp("deli.tpl","fetch");
	return;
}else{
}

# изпращане обработка 
if ($vari=="send_1"){
	$modebase= "mode=".$mode."&vari=".$vari;
	include_once "delisend.php";
	$smarty->assign("CONT3", $cont3);
	$pagecont= smdisp("deli.tpl","fetch");
	return;
}else{
}


		# заявката 
						if($vari=="list_11"){
		$query= "select postlist.iddocuout as iddout from postlist order by id";
$smarty->assign("ISLIST", true);
						}else{
/***
		$query= "
			select distinct docuout.id as iddout
			from post
			left join poststat on post.idpoststat=poststat.id
				left join docuout on post.iddocuout=docuout.id
				left join docutype on docuout.iddocutype=docutype.id 
					left join suit on docuout.idcase=suit.id
					left join user on suit.iduser=user.id
		where $filtdout and $filtvari and $filtform
order by $sortcode
			";
***/
		$query= "
			select distinct docuout.id as iddout
			from post
			left join poststat on post.idpoststat=poststat.id
				left join docuout on post.iddocuout=docuout.id
				left join docutype on docuout.iddocutype=docutype.id 
					left join suit on docuout.idcase=suit.id
					left join user on suit.iduser=user.id
		where $filtdout and $filtvari and $filtform
order by $sortcode
			";
//			order by post.created desc, post.id desc
						}
		# странициране 
					include "pagi.class.php";
		$prefurl= "";
//		$baseurl= "mode=".$mode."&vari=".$vari."&filt=".$filt  ."&varitt=".$varitt;
//		$baseurl= "mode=".$mode."&vari=".$vari."&filt=".$filt;
		//++$baseurl= "mode=".$mode."&vari=".$vari;
		$baseurl= "mode=".$mode."&vari=".$vari."&sort=".$sort;
						/*
						$action= $GETPARAM["action"];
						if (isset($action)){
		$baseurl .= "&action=".$action;
						}else{
						}
						*/
		$obpagi= new paginator(20, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
		$mylist= dbconv($mylist);
//print_ru($mylist);

# списък id изх.документи 
			$arid= array();
foreach($mylist as $elem){
			$arid[]= $elem["iddout"];
}
			if (empty($arid)){
				$codedout= "0";
			}else{
				$codedout= implode(",",$arid);
			}
//var_dump($codedout);

# списък изх.документи 
$ardout= $DB->select("
	select docuout.id as ARRAY_KEY
		, docuout.serial as d2seri, docuout.year as d2year
		, docutype.text as d2text
, docutype.ismult as d2ismult
		, suit.id as idcase
		, suit.serial as caseri, suit.year as cayear
		, user.name as username
, if($codeinterest,1,0) as isinterest
, cofrom.name as rsname
, suit.idtitu as casetitu, suit.idsubtit as casesubt
				, docuout.id as iddout
, (select count(*) from docuoutscan where iddocu=docuout.id) as coundout
	from docuout
		left join docutype on docuout.iddocutype=docutype.id 
		left join suit on docuout.idcase=suit.id
		left join user on suit.iduser=user.id
				left join post on post.iddocuout=docuout.id
						left join cofrom on suit.idcofrom=cofrom.id
	where docuout.id in ($codedout)
	order by $sortcode, docuout.created desc
	");
//	order by docuout.created desc
$ardout= dbconv($ardout);

# трансформиране 
$modeel= "mode=".$mode."&vari=".$vari."&page=".$page."&sort=".$sort;
foreach($ardout as $iddout=>$elem){
	$ardout[$iddout]["scanuplo"]= geturl($modeel."&scanuplo=".$iddout);
	$ardout[$iddout]["scanview"]= geturl($modeel."&scanview=".$iddout);
	$ardout[$iddout]["a1scan"]= geturl($modeel."&a1scan=".$iddout);
	$ardout[$iddout]["tocase"]= geturl($modeel."&tocase=".$elem["idcase"]);
}
$smarty->assign("ARDOUT", $ardout);
//print_ru($ardout);

# списък екземпляри 
							# паралелно - данни за ПДИ, ако текущия запис е ПридрПисмо 
$arpost= $DB->select("
	select post.iddocuout as ARRAY_KEY1, post.id as ARRAY_KEY2
		, post.*
		, poststat.name as statname, poststat.idtype as pstype
		, user.name as postuser
		, if($codepostempty,1,0) as nopostdata
		, if(post.idpoststat=0 or post.idposttype=poststat.idtype,0,1) as isertype
							, p2.id as p2id, p2.idposttype as idmeth
							, d2.serial as doutseri, d2.created as doutcrea
	from post
		left join poststat on post.idpoststat=poststat.id 
		left join user on post.iduser=user.id 
							left join post as p2 on post.idpp=p2.id 
							left join docuout as d2 on p2.iddocuout=d2.id 
	where post.iddocuout in ($codedout)
	order by post.created desc
	");
$arpost= dbconv($arpost);

# трансформиране 
//++$modeel= "mode=".$mode."&vari=".$vari."&page=".$page;
//$modeel= "mode=".$mode."&vari=".$vari."&page=".$page."&sort=".$sort;
								$arid= array();
								//$aridpp= array();
foreach($arpost as $iddout=>$x2){
	foreach($x2 as $idpost=>$elem){
								$arid[]= $idpost;
							//if (empty($elem["idpp"])){
							//}else{
							//	$aridpp[]= $elem["idpp"];
							//}
		$arpost[$iddout][$idpost]["postedit"]= geturl($modeel."&postedit=".$idpost);
		$arpost[$iddout][$idpost]["postdubl"]= geturl($modeel."&postdubl=".$idpost);
		$arpost[$iddout][$idpost]["postdele"]= geturl($modeel."&postdele=".$idpost);
		$arpost[$iddout][$idpost]["postnote"]= geturl($modeel."&postnote=".$idpost);
		$arpost[$iddout][$idpost]["creapp"]= geturl($modeel."&creapp=".$idpost);
	}
}
$smarty->assign("ARPOST", $arpost);
//print_ru($arpost);
								$codein= (empty($arid)) ? "0" : implode(",",$arid);
								//$codeinpp= (empty($aridpp)) ? "0" : implode(",",$aridpp);
//var_dump($codein);
//var_dump($codeinpp);

# данни за всички ПридрПисма - индекс post.idpp 
$arpp= $DB->select("
	select post.idpp as ARRAY_KEY
		, docuout.serial as doutseri, docuout.created as doutcrea
		, post.idposttype as idmeth
	from post
		left join docuout on post.iddocuout=docuout.id 
	where post.idpp in ($codein)
	");
$arpp= dbconv($arpp);
$smarty->assign("ARPP", $arpp);
//print_rr($arpp);

# брой екземпляри по изх.документи 
			$arpostcoun= array();
foreach($arpost as $iddout=>$elem){
			$arpostcoun[$iddout]= count($elem);
}
$smarty->assign("ARPOSTCOUN", $arpostcoun);
//print_ru($arpostcoun);

/*
$varipagecont= smdisp("delilist.tpl","fetch");
//$varipagecont= $vari."==??????????????????????";
# извеждаме 
$smarty->assign("VARIPAGE", $varipagecont);
$pagecont= smdisp("deli.tpl","fetch");
*/

# линк за прозореца за корекции 
$linkedit= geturl($modeel."&deliedit=0");
$smarty->assign("LINKEDIT", $linkedit);
# линк за прозореца за изчистване 
$linkclear= geturl($modeel."&deliclear=0");
$smarty->assign("LINKCLEAR", $linkclear);

							# текстове титул и подтитул на делото 
							$smarty->assign("ARTITU", $listtitu);
							$smarty->assign("ARSUBT", $listsubtit);
			# буквата за редактиране - от основ.данни 
			$rooffi= getofficerow($iduser);
			$letdoc= $rooffi["letterdocu"];
			$smarty->assign("LETDOC", $letdoc);
//print_ru($mylist);

# буквата за редактиране - от основ.данни 
$rooffi= getofficerow($iduser);
$letdoc= $rooffi["letterdocu"];
$smarty->assign("LETDOC", $letdoc);
/*
# 18.10.2018 призовкар - списък на призовкарите 
$aruserpost= getselect("poststat","name","idtype=21",false);
$aruserpost= dbconv($aruserpost);
$smarty->assign("ARUSERPOST", $aruserpost);
*/

# извеждаме 
$pagecont= smdisp("deli.tpl","fetch");

?>