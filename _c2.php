<?php

									session_start();
									include_once "common.php";
$GETPARAM= getparam();
$mode= "cer2";
	include "cer2.php";
$smarty->assign("CONTENT", $pagecont);
print smdisp("_c2.tpl","iconv");

?>