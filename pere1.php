<?php

						$gevari= $_GET["v"];
						if (isset($gevari)){
									session_start();
									include_once "common.php";
								include "pere2.inc.php";
							$geid= $_GET["i"];
$resupara= inpara();
list($p1days,$p1inlist,$p1outlist)= $resupara;
//var_dump($p1days);
if ($gevari==1){
	$arid= $p1inlist;
}else{
	$arid= $p1outlist;
}
$indx= array_search($geid,$arid);
if ($indx===false){
	$arid[]= $geid;
	$o2dire= "1";
}else{
	unset($arid[$indx]);
	$o2dire= "0";
}
if ($gevari==1){
	$p1inlist= $arid;
}else{
	$p1outlist= $arid;
}
//var_dump($p1days);
outpara($p1days,$p1inlist,$p1outlist);
print "ok^$geid^$o2dire^".count($arid);
return;
						}else{
						}

if ($vari==1){
	$query= "
		select id as ARRAY_KEY, name as text
		from aadocutype
		";
	$dbname= "aadocutype";
	$smarty->assign("HEPERE", "списък на типовете входящи документи");
	$p1name= "p1inlist";
}else{
	$query= "
		select id as ARRAY_KEY, text
		from docutype
		where ishidden=0
		order by idsort
		";
	$dbname= "docutype";
	$smarty->assign("HEPERE", "списък на изходящите шаблони");
	$p1name= "p1outlist";
}

$ardata= $DB->selectCol($query);
$ardata= dbconv($ardata);
$smarty->assign("ARDATA", $ardata);
//print_rr($ardata);

$arid= ${$p1name};
//$p1cont= ${$p1name};
//$arid= (empty($p1cont)) ? array() : explode($delilist,$p1cont);
$smarty->assign("ARID", $arid);
//var_dump($p1cont);
//var_dump($arid);
//print_rr($arid);

# извеждане 
$pagecont= smdisp("pere1.tpl","fetch");

?>