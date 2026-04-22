<?php
# разглеждане данни за избрано съдилище 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
# $view - cofrom.id за разглеждане 

$rofrom= getrow("cofrom",$view);
$roform= dbconv($rofrom);

$smarty->assign("DATA", $rofrom);
print smdisp("cofromview.ajax.tpl","iconv");

?>
