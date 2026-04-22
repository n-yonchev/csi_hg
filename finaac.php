<?php
# сметки на взискателите 
# източник : agent.php - списък на представителите 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

# текущата страница 
//print_rr($_POST);
//print_r($GETPARAM);
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;
//print_r($_SESSION);

# филтъра 
$filt= $GETPARAM["filt"];
$filtpost= $_POST["filtag"];
if (isset($filtpost)){
	$filt= $filtpost;
	$page= 1;
}else{
}
$smarty->assign("FILT", tran1251($filt));

									# корекция на избрана сметка 
									$edit= $GETPARAM["edit"];
									if (isset($edit)){
										include_once "finaacedit.ajax.php";
										exit;
									}else{
									}
									
									# изтриване на избрана сметка 
									$dele= $GETPARAM["dele"];
									if (isset($dele)){
										include_once "finaacdele.ajax.php";
										exit;
									}else{
									}

									# добавяне на сметка за избран взискател 
									$adda= $GETPARAM["adda"];
									if (isset($adda)){
										include_once "finaacadda.ajax.php";
										exit;
									}else{
									}
									
									/*
									
									# извеждане списъка с делата за избран запис (адвокат) 
									$listcase= $GETPARAM["listcase"];
									if (isset($listcase)){
										include_once "finaaclistcase.ajax.php";
										exit;
									}else{
									}
									
									# приравняване на избрания адвокат към друг 
									$makeeq= $GETPARAM["makeeq"];
									if (isset($makeeq)){
										include_once "finaacmakeeq.ajax.php";
										exit;
									}else{
									}
									*/
									
# списъка 
		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
if (empty($filt)){
	$where= "1";
}else{
	$myfilt= "%".$filt."%";
	$where= "lower(name) like lower('$myfilt')";
}
		$query= "select * from claim2 where $where order by name";
		$prefurl= "";
//		$baseurl= "mode=".$mode;
		$baseurl= "mode=".$mode ."&filt=".$filt;
		$obpagi= new paginator(18, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);
/*
# броя на делата по адвокати 
		$arin= array();
foreach ($mylist as $uscont){
				$idcurr= $uscont["id"];
		$arin[]= $idcurr;
}
$codein= implode(",",$arin);
$arcoun= $DB->selectCol("select count(*), idagent as ARRAY_KEY from suit group by idagent");
$smarty->assign("ARCOUN", $arcoun);
*/
# трансформираме го - параметри за иконите 
				$modeel= "mode=".$mode ."&page=".$page ."&filt=".$filt;
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
//	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
//	$mylist[$uskey]["dele"]= geturl($modeel."&dele=".$idcurr);
//	$mylist[$uskey]["listcase"]= geturl($modeel."&listcase=".$idcurr);
//	$mylist[$uskey]["makeeq"]= geturl($modeel."&makeeq=".$idcurr);
				$arac= $DB->select("select id,iban,bic,descrip from claim2iban where idclaim2=?d"  ,$idcurr);
				$arac= dbconv($arac);
				foreach($arac as $aind=>$acon){
					$arac[$aind]["edit"]= geturl($modeel."&edit=".$acon["id"]);
					$arac[$aind]["dele"]= geturl($modeel."&dele=".$acon["id"]);
				}
	$mylist[$uskey]["listac"]= $arac;
				$coac= count($arac);
				$coac= ($coac==0) ? 1 : $coac;
	$mylist[$uskey]["counac"]= $coac;
	$mylist[$uskey]["adda"]= geturl($modeel."&adda=".$idcurr);
}

//# add new link 
//$addnew= geturl($modeel."&edit=0");
					# допълнителни js линкове за секцията head - autocomplete 
					$headlist= "
<script type='text/javascript' src='autocomp/jquery.bgiframe.min.js'></script>
<script type='text/javascript' src='autocomp/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='autocomp/thickbox-compressed.js'></script>
<script type='text/javascript' src='autocomp/jquery.autocomplete.js'></script>
<link rel='stylesheet' type='text/css' href='autocomp/jquery.autocomplete.css' />
					";
					$smarty->assign("HEADLIST", $headlist);

				# за извеждане на типа 
				$artype[1]= "юрид";
				$artype[2]= "физ";
				$artype[3]= "др";
				$smarty->assign("ARTYPE", $artype);
# извеждаме 
//$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("finaac.tpl","fetch");

?>
