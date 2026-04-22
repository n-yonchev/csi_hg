<?php
									session_name("specadmin");
									session_start();
									include_once "common.php";

# global constant - office.id 
# TEMPORARY office.id =1 
$idoffice= 1;

$islogged= @$_SESSION["islogged"];
if (isset($islogged)){
}else{
//	redirect("iplogin.php");
	include "iplogin.php";
exit;
}

$mainmenu["para"]["text"]= "parameters";		$mainmenu["para"]["php"]= "ippara.php";
$mainmenu["list"]["text"]= "list";				$mainmenu["list"]["php"]= "iplist.php";
$mainmenu["stat"]["text"]= "statistics";		$mainmenu["stat"]["php"]= "ipstat.php";

$GETPARAM= getparam();
//print_r($GETPARAM);
$mode= $GETPARAM["mode"];
if (isset($mode)){
}else{
	$akey= array_keys($mainmenu);
	$mode= $akey[0];
}

$arpa= getipparams();
$arturn["acti"]= $arpa["acti"];
$arturn["on"]=  geturl("mode=$mode"."&turn=on");
$arturn["off"]= geturl("mode=$mode"."&turn=off");

														# 30.10.2009 - манипулираме файла .htaccess 
														$htacname= ".htaccess";
														$tempname= "HTACCESS.TXT";
					$turn= $GETPARAM["turn"];
					if (isset($turn)){
						if (0){
						}elseif($turn=="on"){
//							$arpa["acti"]= 1;
							$ipacti= 1;
							$arturn["acti"]= 1;
														# 30.10.2009 - създаваме .htaccess 
												$mylist= $DB->selectCol("select ipaddr from iplist");
												$iplist= implode(" ",$mylist);
											$psel= $_SERVER["PHP_SELF"];
											$arpsel= explode("/",$psel);
											unset($arpsel[count($arpsel)-1]);
											$basepath= implode("/",$arpsel);
														$htcont= file_get_contents($tempname);
														$htcont= str_replace("[IPLIST]",$iplist,$htcont);
														$htcont= str_replace("[BASEPATH]",$basepath,$htcont);
														file_put_contents($htacname,$htcont);
						}elseif($turn=="off"){
//							$arpa["acti"]= 0;
							$ipacti= 0;
							$arturn["acti"]= 0;
														# 30.10.2009 - унищожаваме .htaccess 
														@unlink($htacname) or die("htac missing");
						}else{
die("ipcont=error=1=$turn");
						}
//						putipparams($arpa);
						putipactive($ipacti);
					}else{
					}
$smarty->assign("TURN", $arturn);

foreach($mainmenu as $inmenu=>$elmenu){
	$mainmenu[$inmenu]["link"]= geturl("mode=$inmenu");
}
					include_once($mainmenu[$mode]["php"]);
$smarty->assign("CONTENT", $pagecont);

$smarty->assign("MAINMENU", $mainmenu);
$smarty->assign("MODE", $mode);
print smdisp("ipmain.tpl","iconv");



?>
