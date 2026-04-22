<?php
# съобщение за заключено дело 
# отгоре : 
#    $lockedby - user.id на автора на заключването 

								include_once "common.php";

$GETPARAM= getparam();
$lockedby= $GETPARAM["lockedby"];

$rouser= getrow("user",$lockedby);
$lockname= $rouser["name"];

$smarty->assign("LOCKNAME", $lockname);
print smdisp("caselocked.ajax.tpl","iconv");

?>
