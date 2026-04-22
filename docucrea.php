<?php

$mode= "docu";
$modeel= "mode=".$mode;

# add new link 
$addnew= geturl($modeel."&edit=0");
						# допълнителни js линкове за секцията head 
						$smarty->assign("HEADJS", array("_docucrea.js"));
# флага за образуване - да 
$_SESSION["iscreacase"]= true;

# извеждаме 
$smarty->assign("ADDNEW", $addnew);
$pagecont= smdisp("docucrea.tpl","fetch");

?>
