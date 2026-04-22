<?php
					# източник : caseeditzone.php 
									session_start();
									include_once "common.php";

					$smarty->assign("CASEALL", $CASEALL);
					$smarty->assign("FLAGNOCHANGE", $FLAGNOCHANGE);

# делото 
$edit= $_GET["edit"];
//var_dump($edit);
# различен шаблон 
$tpnameactu= "cazoactuinfo.tpl";
			
			# изчисляваме 
			include "cazoactu.php";

# извеждаме 
print $pagecont;

?>
