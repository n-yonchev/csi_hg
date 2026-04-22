<?php

function getrepo($code){
		$arvari= array();
		$arvari["1,11"]= 71;
		$arvari["1,12"]= 72;
		$arvari["1,71"]= 0;
		$arvari["1,72"]= 0;
		$arvari["1"]= array(71,72);
		$arvari["0,8"]= 0;
		$arvari["0"]= 8;
	$resu= $arvari[$code];
	if (isset($resu)){
	}else{
		$resu= $arvari[substr($code,0,1)];
		if (isset($resu)){
		}else{
var_dump($code);
die("error=getrepo");
		}
	}
return $resu;
}

//$spec1= toutf8("съд");
$spec2= toutf8("община");
//	$spec2base= toutf8("община");

$ups0= "trim(replace(  trim(replace(  trim(replace(trim([NAME]),char(132 using cp1251),''))  ,char(147 using cp1251),''))  ,char(148 using cp1251),''))";
$ups1= "trim(replace(  trim(replace(  trim(replace($ups0,'\\\"',''))  ,'\\\\',''))  ,\"\'\",''))";

$codename= str_replace("[NAME]","claimer.name",$ups1);
$qutran= "
	select $codename as name, suit.idrepo
		, if(instr(lower($codename),'$spec2')=0,0,1) as ismuni
		, count(*) as coun
	from rep2tran
	left join claimer on rep2tran.idclai=claimer.id
	left join suit on rep2tran.idcase=suit.id
	group by $codename, suit.idrepo
	order by $codename, suit.idrepo
[CODELIST]
	";
//$mode= "mode=".$mode;
$modebase= "mode=".$mode."&period=".$period."&vari=".$vari;

									$sear= $GETPARAM["sear"];
									if (isset($sear)){
										//include_once "useredit.ajax.php";
//$smarty->assign("PAGEBACKTEXT", "назад към списъка трансформации");
//$smarty->assign("PAGEBACKLINK", geturl($modeel));
$smarty->assign("PAGEBACKLINK", geturl($modebase));
										include_once "rep2tran2list.php";
														//$edit= $GETPARAM["edit"];
														//if (isset($edit)){
//														if (isset($pagecont)){
														if (isset($rep2cont)){
														}else{
//$pagecont= smdisp("rep2tran2list.tpl","fetch");
$rep2cont= smdisp("rep2tran2list.tpl","fetch");
														}
return;
									}else{
									}

$qu2= str_replace("[CODELIST]","",$qutran);
//$artran= $DB->select($qutran);
$artran= $DB->select($qu2);
$artran= dbconv($artran);
//$artran= arstrip($artran);
				//$modeel= "mode=".$mode;
				$modeel= $modebase;
foreach ($artran as $indx=>$elem){
	$sear= $elem["name"]."^".$elem["idrepo"]."^".$elem["ismuni"];
	$artran[$indx]["sear"]= geturl($modeel."&sear=".toutf8($sear));
		$coderepo= $elem["ismuni"].",".$elem["idrepo"];
		$resurepo= getrepo($coderepo);
	$artran[$indx]["isok"]= ($resurepo===0);
}
$smarty->assign("ARTRAN", $artran);
//print_ru($artran);

$smarty->assign("ARREPO", $viewrepo);
//$pagecont= smdisp("rep2tran2.tpl","fetch");
$rep2cont= smdisp("rep2tran2.tpl","fetch");

?>