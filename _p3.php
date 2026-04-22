<?php

						include_once "common.php";

$arperc= $DB->select("select * from percent");

$smarty->assign("DATA", $arperc);
print smdisp("_p3.tpl","iconv");

?>