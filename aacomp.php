<?php
# само входните документи, които са жалби 
#    обслужва се статуса на жалбата 
# източник : docu.php 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

//# ВНИМАНИЕ. константа, зависима от данните 
//# трябва да е съгласувана с id на записа за жалба в табл. aaducutype 
//$TYPECOMP= 2;

# текущата страница 
//print_r($GETPARAM);
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

									# корекция на избран запис 
									$edit= $GETPARAM["edit"];
									if (isset($edit)){
										include_once "aacompedit.ajax.php";
										exit;
									}else{
									}
									
				# 13.04 2009 - един документ - много дела 
									# разглеждане на списъка с дела в nyroModal 
									$viewlist= $GETPARAM["viewlist"];
									if (isset($viewlist)){
										include_once "docuviewlist.ajax.php";
										exit;
									}else{
									}

# списъка 
$filter= "docu.idtype=$TYPECOMP";
				# 13.04 2009 - един документ - много дела 
$myquery= "
	select docu.* ,docu.id as id ,docu.created as docucrea
					,u2.name as u2name
			,aadocucomp.idstatus as status ,aadocucomp.created as created
			,aadocucomp.id as idcomp
			,aadocucomp.date2 as date2 ,aadocucomp.date4 as date4 ,aadocucomp.date6 as date6 ,aadocucomp.date8 as date8 
			,aadocucomp.notes as notes
			,u3.name as statname
	from docu
					left join user as u2 on docu.iduser=u2.id
			left join aadocucomp on aadocucomp.iddocu=docu.id
			left join user as u3 on aadocucomp.iduser=u3.id
	where $filter
	order by docu.year desc, docu.serial desc
	";

		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
		$query= $myquery;
		$prefurl= "";
		$baseurl= "mode=".$mode;
//		$obpagi= new paginator(18, 8, $query);
		$obpagi= new paginator(200, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);
//print_rr(toutf8($mylist));

# трансформираме го - параметри за иконите 
//				$modeel= "mode=".$mode;
				$modeel= "mode=".$mode."&page=".$page;
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
				# 13.04.2009 - маскираме спец.символи в коментара 
	$mylist[$uskey]["notes"]= htmlspecialchars( $mylist[$uskey]["notes"] ,ENT_QUOTES);
				# 13.04 2009 - един документ - много дела 
				# добавяме масив със свързаните дела 
				# НЕЕФЕКТИВНО - заявки в цикъл 
				$caselist= getcaselist($idcurr);
	$mylist[$uskey]["caselist"]= $caselist;
				# и броя на делата 
	$mylist[$uskey]["casecoun"]= count($caselist);
				# и линк за разглеждане на списъка в nyroModal 
	$mylist[$uskey]["viewlist"]= geturl($modeel."&viewlist=".$idcurr);
//$mylist[$uskey]["status"] += 0;
		# последния статус 
		if ($uscont["idcomp"]==0){
	$mylist[$uskey]["currstat"]= 0;
		}else{
			foreach(array_reverse($liststatfiel,true) as $fiindx=>$finame){
				$cudate= $uscont[$finame];
				if (empty($cudate)){
				}else{
	$mylist[$uskey]["currstat"]= $fiindx;
	$mylist[$uskey]["currdate"]= $cudate;
					break;
				}
			}
		}
}
//print_rr($mylist);

//# add new link 
//$addnew= geturl($modeel."&edit=0");

				# 13.04 2009 - един документ - много дела 
# допълнителни js линкове за секцията head 
$smarty->assign("HEADJS", array("cluetip.hoverIntent.js","jquery.cluetip.js"));

							# за текста на статуса - масива $liststatcomp - commspec.php 
							# предаваме съдържанието на масива 
							$smarty->assign("ARSTAT", $liststatcomp);
# извеждаме 
//$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("aacomp.tpl","fetch");

?>
