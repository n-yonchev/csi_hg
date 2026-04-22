<?php
# клонинг на caseedit.php - за наблюдател 
//print "viewcaseedit=";
//print session_name();
//print "=viewcaseedit";

# изгледа 
$_SESSION["mainplan"][$edit]= "var2";
$smarty->assign("MAINPLAN", $mainplan);

# за рефреша 
$relurl= $_SERVER["REQUEST_URI"];
$smarty->assign("RELURL", $relurl);

# не са разрешени корекции в делото 
$FLAGNOCHANGE= true;
$smarty->assign("FLAGNOCHANGE", $FLAGNOCHANGE);

# да не се извеждат табовете - СПЕЦ.ФЛАГ 
//$FLAGYESSTAT= fasle;
//$smarty->assign("FLAGYESSTAT", $FLAGYESSTAT);
//$_SESSION["FLAGYESSTAT"]= $FLAGYESSTAT;
$_SESSION["VIEWFLAG_NOTABS"]= true;

# да не се корегират постъпленията - СПЕЦ.ФЛАГ 
//$smarty->assign("FINALOGGED", false);
$_SESSION["VIEWFLAG_FINANOEDIT"]= true;

# основните линкове 
# източник : caseedit.php 
//			$editel= "edit=$edit&func=view";
			# за наблюдател - и сес.име 
			$editel= "edit=$edit&func=view&sena=$view_sess_name";
$urllis["base"]= geturl($editel."&zone=base");
$urllis[1]= geturl($editel."&zone=1");
$urllis[2]= geturl($editel."&zone=2");
$urllis[3]= geturl($editel."&zone=3");
$urllis[4]= geturl($editel."&zone=4");
$urllis["paym"]= geturl($editel."&zone=paym");
					#---- януари-2010 актуален дълг ----
					$urllis["actu"]= geturl($editel."&zone=actu");
$urllis[5]= geturl($editel."&zone=5");
$urllis[6]= geturl($editel."&zone=6");
# 07.08.2009 - извадка от журнала - дневник на изв.действия 
$urllis["jour"]= geturl($editel."&zone=jour");

#---- 07.07.2009 финансов баланс [погасяване] ---- 
$urllis[7]= geturl($editel."&zone=7");
# 12.03.2010 зона-бележки и зона-събития - не се извикват 
$urllis["note"]= geturl($editel."&zone=note&noaction=yes");
$urllis["even"]= geturl($editel."&zone=even&noaction=yes");
# 18.07.2010 аванс.вноски от взиск. 
$urllis["adva"]= geturl($editel."&zone=adva");
//printarr($urllis);

# допълнителни js линкове за секцията head 
$smarty->assign("HEADJS", array("ajaxify.js","manageajax.js","_caseedit.js"));

# извеждаме 
$smarty->assign("EDIT", $edit);
$smarty->assign("URLLIS", $urllis);
$smarty->assign("DATA", $rocase);

//print "viewcaseedit=SESSION=";
//print_rr($_SESSION);
//print "=SESSION=viewcaseedit";

?>
