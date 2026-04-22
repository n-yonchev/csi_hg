<?php
# специфично - само за ПДИ - покана за добров.изпълнение 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
# още отгоре : 
//# ВНИМАНИЕ - ЗАВИСИМОСТ ОТ БД 
//#    $IDINVITA - docutype.id за ПДИ като тип изх.документ 
//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

# текущата страница 
//print_r($GETPARAM);
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

									# корекция на избран запис 
									$edit= $GETPARAM["edit"];
									if (isset($edit)){
										include_once "inviedit.ajax.php";
										exit;
									}else{
									}
# списъка 
		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
# условия за фразата where : 
#    изх.документ да е ПДИ 
#    изх.документ да е изведен 
#    изх.документ да е от дело на логнатия 
# условие за ПДИ 
#    ПДИ вече се маркират чрез полето mark=pdi 
/*
$arpdii= $DB->selectCol("select id from docutype where mark='pdi'");
$pdlist= implode(",",$arpdii);
$pdlist= "0," .$pdlist;
//print "[$pdlist]";
*/
$pdlist= getpdlist();
		# заявката 
//		$query= "select docuout.*, docuout.id as id, docuout.serial as serial, docuout.year as year, docuout.created as created
		$query= "select docuout.*, docuout.id as id, docuout.serial as serial, docuout.year as year, docuout.registered as created
			,suit.serial as caseseri ,suit.year as caseyear ,suit.idtitu as casetitu
			,aainvita.date as date ,aainvita.flag as flag ,aainvita.person as person
			from docuout
			left join suit on docuout.idcase=suit.id
				left join aainvita on aainvita.iddocuout=docuout.id
where docuout.iddocutype in ($pdlist) and docuout.serial<>0 and docuout.year<>0
				and suit.iduser=$iduser
			order by docuout.id
			";
//			where docuout.iddocutype=$IDINVITA and docuout.serial<>0 and docuout.year<>0
		$prefurl= "";
		$baseurl= "mode=".$mode;
		$obpagi= new paginator(18, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);

# трансформираме го - параметри за иконите 
				$modeel= "mode=".$mode ."&page=".$page;
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
//	$mylist[$uskey]["view"]= geturl($modeel."&view=".$idcurr);
}

//# add new link 
//$addnew= geturl($modeel."&edit=0");

							# за извеждане на изпълн.титул на делото - съдържанието на масива 
							$smarty->assign("LISTTITU", $listtitu);
							# за извеждане на срока за ПДИ - според изпълн.титул на делото - съдържанието на масива 
							$smarty->assign("TIMETITU", $timetitu);
# извеждаме 
//$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("invi.tpl","fetch");

?>
