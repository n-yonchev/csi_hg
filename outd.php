<?php
#------------------ ЛЕПЕНКА ЗА АДМИНА -----------------------
# всички регистрирани изходящи документи 
# източник : cazo6.php docu09.php 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

# текущата страница 
//print_r($GETPARAM);
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

# СТАНДАРТ 
#-------------------------------------------------------------------------------------------
					# разглеждане на избрано дело без възможност за корекция 
					# - не елемент от списъка, а делото, с което е свързан 
					# източник : case.php 
					$edit= $GETPARAM["edit"];
					if (isset($edit)){
												# глобален флаг - не са разрешени корекции в делото 
												$FLAGNOCHANGE= true;
$smarty->assign("FLAGNOCHANGE", true);
							# скрипта за корекция/разглеждане 
							include_once "caseedit.php";
# назад към списъка  
$smarty->assign("PAGEBACK", $page);
$smarty->assign("PAGEBACKTEXT", "назад към списъка документи");
	# текст с номера на делото 
	$datacase= getrow("suit",$edit);
	$smarty->assign("PAGEDATACASE", $datacase);
# ВНИМАНИЕ. 
# URL за връщане е специфичен, не е стандартен 
# съвпада с $modeel - от параметрите за иконите 
$smarty->assign("PAGEBACKLINK", geturl("mode=".$mode ."&page=".$page));
$pagecont= smdisp("caseedit.tpl","fetch");
return;
					}else{
					}
#-------------------------------------------------------------------------------------------

							# разглеждане на избран изх.документ 
							# отнася се само за изведените (регистрираните) 
							# вика се в ajax прозорец 
							$view= $GETPARAM["view"];
							if (isset($view)){
										include_once "cazo6view.ajax.php";
# за да не излиза главния header 
exit;
							}else{
							}
							
							# изтриване на избран изх.документ 
							# - аналогично за извеждане (регистрация) 
							$dele= $GETPARAM["dele"];
							if (isset($dele)){
//$edit= $DB->query("delete from docuout where id=?d" ,$dele);
										include_once "outddele.ajax.php";
exit;
							}else{
							}

							# всичко за сканираните вх.документи 
$isdocuout= true;
$smarty->assign("ISDOCUOUT", true);
							include_once "docuedituplo.inc.php";

							# управление на действията 
//							$mode4= "mode=".$mode."&page=".$page."&year=".$year."&date=".$date."&date2=".$date2  ."&adre=".$adre."&bele=".$bele;
//							$modeel= "mode=".$mode."&page=".$page."&year=".$year."&date=".$date."&date2=".$date2;
//							$modeel= $mode4;
						$modeel= "mode=".$mode."&page=".$page;
							include_once "docuedituplo2.inc.php";

# списъка 
//$mylist= $DB->select("select * from docu order by year desc, serial desc");
/*
$myquery= "
	select docu.* ,docu.id as id
		,suit.serial as caseseri ,suit.year as caseyear
		,user.name as username
	from docu
		left join (select * from suit where year=$caseyear) as suit on docu.idcase=suit.id
		left join user on suit.iduser=user.id
	where docu.idcase=-1 or suit.id is not null
	order by docu.year desc, docu.serial desc
	";
*/
	$query= "select docuout.*, docuout.id as id, docuout.content as content
				,docutype.text as typetext, docutype.filename as finame
				,suit.serial as caseseri ,suit.year as caseyear ,user.name as ownernam
				,suit.id as caseid
		from docuout 
		left join docutype on docuout.iddocutype=docutype.id
				left join suit on docuout.idcase=suit.id
				left join user on suit.iduser=user.id
		order by year desc, serial desc
		";
		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
//		$query= $myquery;
		$prefurl= "";
		$baseurl= "mode=".$mode;
		$obpagi= new paginator(18, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);

# буквата за редактиране - от основ.данни 
$rooffi= getofficerow($iduser);
$letdoc= $rooffi["letterdocu"];
$smarty->assign("LETDOC", $letdoc);

# трансформираме го - параметри за иконите 
//				$modeel= "mode=".$mode;
				$modeel= "mode=".$mode."&page=".$page;
											$arin= array();
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
											$arin[]= $idcurr;
	$mylist[$uskey]["view"]= geturl($modeel."&view=".$idcurr);
	$mylist[$uskey]["dele"]= geturl($modeel."&dele=".$idcurr);
	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$uscont["caseid"]);
			# 22.10.2010 Дичев - за документ на Word 
				$arelem= explode(".",$uscont["finame"]);
				$filesuff= $arelem[count($arelem)-1];
	$mylist[$uskey]["suff"]= $filesuff;
								# сканиран образ 
								$arin[]= $idcurr;
	$mylist[$uskey]["scanuplo"]= geturl($modeel."&scanuplo=".$idcurr);
	$mylist[$uskey]["scanview"]= geturl($modeel."&scanview=".$idcurr);
}
											if (empty($arin)){
												$codein= "1";
											}else{
												$codein= implode(",",$arin);
											}
							# брой сканирани образи по вх.документи 
							$arscancoun= getscancoun("iddocu in ($codein)");
//print_rr($arscancoun);
global $DB, $smarty;
$smarty->assign("ARSCANCOUN", $arscancoun);

//# add new link 
//$addnew= geturl($modeel."&edit=0");

//# допълнителни js линкове за секцията head 
//$smarty->assign("HEADJS", array("_docu.js"));

# извеждаме 
//$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("outd.tpl","fetch");

//$pagecont= "<center><h2>разработва се ...</h2></center>";

?>
