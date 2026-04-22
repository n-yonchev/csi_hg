<?php
# 04.05.2009 - делата са разделени на активни и прекратени 
# активните (непрекратени) дела 
# отгоре : 
#     $codeinterm - код за MySQL-in - списък със статуси за прекратените дела 
//print_rr($_SESSION);

$FILTACTI= "not in ($codeinterm)";
$smarty->assign("FLAGACTI", true);

						include "case.php";

?>
