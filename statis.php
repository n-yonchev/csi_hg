<?php
									session_name("mainboss");
									session_start();
									include_once "common.php";
/*
# global constant - office.id 
# TEMPORARY office.id =1 
$idoffice= 1;
*/
$islogged= @$_SESSION["islogged"];
if (isset($islogged)){
}else{
	include "stlogin.php";
exit;
}

$mainmenu["para"]["text"]= "статистика";		$mainmenu["para"]["php"]= "stmain.php";
$mainmenu["fina"]["text"]= "постъпления";		$mainmenu["fina"]["php"]= "stfina.php";
$mainmenu["dout"]["text"]= "изх.документи";		$mainmenu["dout"]["php"]= "stdout.php";
# 10.08.2010 
//$mainmenu["agen"]["text"]= "представители";		$mainmenu["agen"]["php"]= "stagen.php";
//$mainmenu["clai"]["text"]= "взискатели";		$mainmenu["clai"]["php"]= "stclai.php";
$mainmenu["agen"]["text"]= "представители";		$mainmenu["agen"]["php"]= "stagenform.php";
$mainmenu["clai"]["text"]= "взискатели";		$mainmenu["clai"]["php"]= "stclaiform.php";

$mainmenu["strepo"]["text"]= "справки";	$mainmenu["strepo"]["php"]= "strepo.php";

$GETPARAM= getparam();
//print "====STATIS====<br>";
//print_r($GETPARAM);
$mode= $GETPARAM["mode"];
if (isset($mode)){
}else{
	$akey= array_keys($mainmenu);
	$mode= $akey[0];
}

foreach($mainmenu as $inmenu=>$elmenu){
	$mainmenu[$inmenu]["link"]= geturl("mode=$inmenu");
}
					include_once($mainmenu[$mode]["php"]);
$smarty->assign("CONTENT", $pagecont);

$smarty->assign("MAINMENU", $mainmenu);
$smarty->assign("MODE", $mode);
print smdisp("statis.tpl","iconv");



?>
