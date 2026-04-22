<?php

session_start();
include_once "common.php";

$log = $_GET['log'];

$query = "SELECT * FROM issi_log WHERE id={$log}";

$logData = $DB->select($query)[0];
$logData = dbconv($logData);

$smarty->assign('LOG', $logData);

print smdisp("issilogmsg.ajax.tpl","iconv");