<?php

									session_start();
									include_once "common.php";

$smarty->assign("V1POST", tran1251($_SESSION["v1post"]));
unset($_SESSION["v1post"]);

		$roof= getofficerow($iduser);
		$smarty->assign("SERIAL", $roof["serial"]);
		$smarty->assign("SHNAME", $roof["shortname"]);
		
$content= smdisp("v1prin.tpl","fetch");
$smarty->assign("CONTENT", $content);

print smdisp("_print.tpl","iconv");

?>