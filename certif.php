<?php
# само специални входни документи - молби за удостоверение за вписване в регистъра на длъжниците 
# източник : docu.php 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $page= текущата страница от списъка 

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

# текущата страница 
//print_r($GETPARAM);
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

# константа - aadocutype.mode за удостоверение 
$MODECERT= "cere";

									# корекция на избран запис 
									$edit= $GETPARAM["edit"];
									if (isset($edit)){
										include_once "certifedit.ajax.php";
										exit;
									}else{
									}
/*
									# разглеждане/отпечатване на избрания запис 
									$princert= $GETPARAM["princert"];
									if (isset($princert)){
										include "certifprin.ajax.php";
										exit;
									}else{
									}
*/
							# към регистъра - искане за заявление (queryDebtor) 
							# резултат - ???????? 
							$view= $GETPARAM["view"];
							if (isset($view)){
$tpname= "certifview.ajax.tpl";
								include "certifview.ajax.php";
								exit;
							}else{
							}
# 05.10.2011 нов подход заради двойния рефреш в nyroModal 
# към регистъра - искане за заявление (queryDebtor) 
$tose= $GETPARAM["tose"];
if (isset($tose)){
//	include "certiftose.ajax.php";
$view= $tose;
$tpname= "certiftose.ajax.tpl";
	include "certifview.ajax.php";
	exit;
}else{
}
					# 15.07.2011 
					# само резултата от послед.обръщения към сървъра (queryDebtor) 
					$resp= $GETPARAM["resp"];
					if (isset($resp)){
						include "certifresp.ajax.php";
						exit;
					}else{
					}
							# извеждане на word файл за избрания запис 
							$word= $GETPARAM["word"];
							if (isset($word)){
								include "certifword.ajax.php";
								exit;
							}else{
							}

# списъка 
$filter= "aadocutype.mode='$MODECERT'";
/*
$myquery= "
	select docu.* ,docu.id as id
			,aadocucert.* ,aadocucert.id as idcert
					,u2.name as u2name
					,u3.name as lastname
	from docu
			left join aadocutype on docu.idtype=aadocutype.id
			left join aadocucert on aadocucert.iddocu=docu.id
					left join user as u2 on docu.iduser=u2.id
					left join user as u3 on aadocucert.iduser=u3.id
	where $filter
	order by docu.year desc, docu.serial desc
	";
*/
$myquery= getcertqu() ." where $filter order by docu.year desc, docu.serial desc";

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
//	$mylist[$uskey]["prin"]= geturl($modeel."&princert=".$idcurr);
	$mylist[$uskey]["view"]= geturl($modeel."&view=".$idcurr);
$mylist[$uskey]["tose"]= geturl($modeel."&tose=".$idcurr);
	$mylist[$uskey]["resp"]= geturl($modeel."&resp=".$idcurr);
	$mylist[$uskey]["word"]= geturl($modeel."&word=".$idcurr);
				# 13.04.2009 - маскираме спец.символи в коментара 
	$mylist[$uskey]["notes"]= htmlspecialchars( $mylist[$uskey]["notes"] ,ENT_QUOTES);
}
//print_rr($mylist);

//				# 13.04 2009 - един документ - много дела 
//# допълнителни js линкове за секцията head 
//$smarty->assign("HEADJS", array("cluetip.hoverIntent.js","jquery.cluetip.js"));

//							# за текста на статуса - масива $liststatcomp - commspec.php 
//							# предаваме съдържанието на масива 
//							$smarty->assign("ARSTAT", $liststatcomp);

# add new link 
$addnew= geturl($modeel."&edit=0");

# извеждаме 
$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("certif.tpl","fetch");


function getcertqu(){
return "
	select docu.* ,aadocucert.* 
			,docu.id as id ,aadocucert.id as idcert
					,u2.name as u2name
					,u3.name as lastname
			,docuout.id as iddocuout
			,docuout.adresat as adresat ,docuout.descrip as descrip 
			,docuout.serial as seriout ,docuout.year as yearout ,date(docuout.created) as dateout
					,aadocutype.id as ddtype
	from docu
			left join aadocutype on docu.idtype=aadocutype.id
			left join aadocucert on aadocucert.iddocu=docu.id
					left join user as u2 on docu.iduser=u2.id
					left join user as u3 on aadocucert.iduser2=u3.id
			left join docuout on aadocucert.iddocuout=docuout.id
";
}

?>
