<?php
# типове входни документи - за статистиката 
# източник : cofrom.php 
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

									# корекция на избран запис 
									$edit= $GETPARAM["edit"];
									if (isset($edit)){
										include_once "aadocuedit.ajax.php";
										exit;
									}else{
									}
									# корекция на избран запис ISSI
									$edit= $GETPARAM["issi"];
									if (isset($edit)){
										include_once "aadocuissi.ajax.php";
										exit;
									}else{
									}
# списъка 
		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
		$query= "select * from aadocutype order by id";
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
	$mylist[$uskey]["issi"]= geturl($modeel."&issi=".$idcurr);
	$isas = $DB->select("select * from issi_docu_incoming where id_docutype = {$uscont['id']}");
	$mylist[$uskey]['isassigned'] = !empty($isas)? 1 : 0;
//	$mylist[$uskey]["view"]= geturl($modeel."&view=".$idcurr);
}

# add new link 
$addnew= geturl($modeel."&edit=0");

# извеждаме 
$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("aadocu.tpl","fetch");

?>
