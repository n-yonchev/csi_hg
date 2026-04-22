<?php

									session_start();
									include_once "common.php";

$idc2= $_GET["p"];
$roc2= getrow("aadocuc2",$idc2);
//print_ru($roc2);
$invodata= unserialize(toutf8($roc2["invodata"]));
//var_dump($invodata);
//print_rr($invodata);
$smarty->assign("INVODATA", tran1251($invodata));

print smdisp("cer2invo.ajax.tpl","iconv");

?>