<?php
# съобщение за друг деловодител на дело 
//# отгоре : 
//#    $ownerid - user.id на деловодителя 

								include_once "common.php";

$GETPARAM= getparam();
$ownerid= $GETPARAM["ownerid"];

$rouser= getrow("user",$ownerid);
$ownename= $rouser["name"];

$smarty->assign("OWNENAME", $ownename);
print smdisp("casenotowner.ajax.tpl","iconv");

?>
