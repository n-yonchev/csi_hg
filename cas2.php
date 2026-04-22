<?php
# 04.05.2009 - делата са разделени на активни и прекратени 
# прекратените (неактивни) дела 
# отгоре : 
#     $codeinterm - код за MySQL-in - списък със статуси за прекратените дела 

$FILTACTI= "in ($codeinterm)";
$smarty->assign("FLAGACTI", false);
						
						include "case.php";

?>
