<?php
# към регистъра - всички дела по филтър отгоре - формиране и предаване 
# отгоре : 
#     $mode - режима 
# още отгоре : 
#     $usnameregi - име на логнатия 
#     $uspref - групово файлово име 
//print_rr($_SESSION);
//print_rr($GETPARAM);

									//include_once "reg2.inc.php";
/***
# логнатия 
$iduser= @$_SESSION["iduser"];
$rouser= getrow("user",$iduser);
$usname= $rouser["name"];
//$uspref= cyrlat($usname) ."_";
$uspref= cyrlat($usname);
//var_dump($uspref);
***/
# груповото име 
	$lepref= strlen($uspref);
	$uniq= $uspref;
$smarty->assign("UNIQ", $uniq);

# изтриваме старите файлове 
//$path= "register";
//direunlink("register",$uniq,".zip");
//direunlink("regicert",$uniq,".zip");
direunlink("register",$uniq);
direunlink("regicert",$uniq);

# автоматичен линк към "посл.резултат" - съгласувано с менюто index.php 
//$linklast= geturl("mode="."regila");
$linklast= geturl("mode=".$tolast);
$smarty->assign("LINKLAST", $linklast);

# извеждаме 
$smarty->assign("USNAMEREGI", $usnameregi);
//$smarty->assign("ARLINK", $arlink);
//$smarty->assign("CODESUB", $codesub);
//$smarty->assign("SUBTEX", $subtex);
$pagecont= smdisp("regius.tpl","fetch");

?>