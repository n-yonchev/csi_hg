<?php
# отчет - формиране 

/***
					#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
$codein= $_SESSION["REP3CODEIN"];
					if (isset($codein)){
					}else{
$smarty->assign("NOSESS", true);
					}
***/

		if (file_exists($creaname1) and file_exists($creaname2)){
		}else{
$smarty->assign("NOSESS", true);
		}

# извеждаме 
$rep2cont= smdisp("rep3v3.tpl","fetch");

?>