<?php
# финансист обслужва ингорираните постъпления - таблица finance2, еднотипна с finance  
# източник : 
#    fina.php - има директно копирани фрагменти, също и от шаблона _fina.tpl 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $page - текущата страница 


# логнатия потребител 
$iduser= @$_SESSION["iduser"];

# текущата страница 
//print_r($GETPARAM);
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;
							
							# 10.05.2010 
							# възстановяване на избран игнориран запис 
							# не е в ajax прозорец 
							$rest= $GETPARAM["rest"];
							if (isset($rest)){
//								include_once "finaigno.ajax.php";
# копираме 
$DB->query("insert into finance select * from finance2 where id=?d"  ,$rest);
# изтриваме 
$DB->query("delete from finance2 where id=?d"  ,$rest);
# reload - след успешен събмит 
$relurl= geturl("mode=".$mode."&page=".$page ."&filtpara=".$filtpara);
# redirect 
reload("",$relurl);
								exit;
							}else{
							}

# СТАНДАРТ 
#-------------------------------------------------------------------------------------------
					# разглеждане на избрано дело без възможност за корекция 
					# - не елемент от списъка, а делото, с което е свързан 
					# източник : case.php 
					$viewcase= $GETPARAM["viewcase"];
					if (isset($viewcase)){
												# глобален флаг - не са разрешени корекции в делото 
												$FLAGNOCHANGE= true;
												//$smarty->assign("FLAGNOCHANGE", $FLAGNOCHANGE);
												# да не се извежда таба с делата 
												$smarty->assign("FLAGNOTABS", true);
# ВНИМАНИЕ. 
# изкуствена стойност - заради caseedit.php 
$edit= $viewcase;
$GETPARAM["edit"]= $edit;
							# скрипта за корекция/разглеждане 
							include_once "caseedit.php";
# назад към списъка с взискатели 
$smarty->assign("PAGEBACK", $page);
$smarty->assign("PAGEBACKTEXT", "назад към списъка постъпления");
	# текст с номера на делото 
	$datacase= getrow("suit",$viewcase);
	$smarty->assign("PAGEDATACASE", $datacase);
//# ВНИМАНИЕ. 
//# URL за връщане е специфичен, не е стандартен 
//# съвпада с $modeel - от параметрите за иконите 
//$smarty->assign("PAGEBACKLINK", geturl("mode=".$mode ."&seek=".$seek ."&page=".$page));
$smarty->assign("PAGEBACKLINK", geturl("mode=".$mode ."&page=".$page));
$pagecont= smdisp("caseedit.tpl","fetch");
return;
					}else{
					}
#-------------------------------------------------------------------------------------------
									
					# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
		
# заявката 
$query= "select finance2.*, finance2.id as id, user.name as finaname
	, suit.id as idcase, suit.serial as caseseri, suit.year as caseyear
			, t2.name as username
	from finance2 
	left join user on finance2.iduser=user.id
	left join suit on finance2.idcase=suit.id
			left join user as t2 on suit.iduser=t2.id
	left join finasource on finance2.id=finasource.idfinance
	";
		
# данните 
		$prefurl= "";
		$baseurl= "mode=".$mode ."&filtpara=".$filtpara;
		$obpagi= new paginator(30, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);

# трансформираме го - параметри за иконите 
//				$modeel= "mode=".$mode ."&page=".$page;
				$modeel= "mode=".$mode ."&page=".$page ."&filtpara=".$filtpara;
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
//	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
				# броя на записите в историята - НЕЕФЕКТИВНО 
				$coun= $DB->selectCell("select count(*) from finahist where idfinance=?d"  ,$idcurr);
				$coun= ($coun==0) ? 0 : $coun-1;
	$mylist[$uskey]["histcoun"]= $coun;
	$mylist[$uskey]["hist"]= geturl($modeel."&hist=".$idcurr);
				# записа с извлечението за текущото постъпление - НЕЕФЕКТИВНО 
				$sour= $DB->selectRow("select * from finasource where idfinance=?d"  ,$idcurr);
				$sour= dbconv($sour);
	$mylist[$uskey]["sour"]= $sour;
				# за разглеждане на назначеното дело 
				# предаваме id на делото 
				$idcase= $uscont["idcase"];
	$mylist[$uskey]["viewcase"]= geturl($modeel."&viewcase=".$idcase);
//				# за назначаване на дело 
//				# предаваме id на постъплението 
//	$mylist[$uskey]["direcase"]= geturl($modeel."&direcase=".$idcurr);
//				# изчисляваме и зареждаме балансовите полета 
//	finacalc($uscont, $mylist[$uskey]);
//				# приключване на постъплението 
//	$mylist[$uskey]["clos"]= geturl($modeel."&clos=".$idcurr);
				# само разглеждане на приключено постъпление 
	$mylist[$uskey]["info"]= geturl($modeel."&info=".$idcurr);
//				# корекция само на датата за погасяване 
//	$mylist[$uskey]["date"]= geturl($modeel."&date=".$idcurr);
//# отпечатване на записа с текущото постъпление 
//# ВНИМАНИЕ - без $modeel - виж шаблона 
//$mylist[$uskey]["prntcode"]= $idcurr +132;
				# 10.05.2010 възстановяване на игнорирано постъпление 
				//$nodist= empty($uscont["toclai"]) and empty($uscont["separa"]) and empty($uscont["separa2"]);
				//if ($uscont["idcase"]==0 or $nodist){
	$mylist[$uskey]["rest"]= geturl($modeel."&rest=".$idcurr);
				//}else{
				//}
}

						# за извеждане на "тип" - масива $listfinatype - commspec.php 
						# предаваме съдържанието на масива 
						$smarty->assign("ARTYPE", $listfinatype2);
# извеждаме 
//		$smarty->assign("MODE", $mode);
		//$smarty->assign("ARFINALINK", getfinalink("mode=".$mode));
//print_r(getfinalink("mode=".$mode));
//$smarty->assign("ADDNEW", $addnew);
//$smarty->assign("COPYFROM", $copyfrom);
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("finarest.tpl","fetch");


?>
