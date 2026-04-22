<?php

									include_once "common.php";

# допълнителни js линкове за секцията head 
$smarty->assign("HEADJS", "_login.js");

# извеждаме 
$smarty->assign("METACONT", $metacont);
print smdisp("viewlogi.tpl","iconv");

?>



