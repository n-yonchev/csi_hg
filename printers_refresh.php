<?php
include_once "scan.inc.php";
$printers_list = getprinsele();
$printers_list = dbconv($printers_list);
array_shift($printers_list);

$refresh_message = "";

$refresh= $GETPARAM["refresh"];
if (isset($refresh)){

    exec("cancel " . $refresh . " 2>&1", $ares, $retu);
    exec("/usr/sbin/cupsenable " . $refresh . " 2>&1", $ares, $retu);
    // var_dump($ares, $retu);

    $refresh_message = "Опашката на принтер " . $printers_list[$refresh] . " беше успешно изчистена";
}

$smarty->assign('REFRESH_MESSAGE', $refresh_message);

$base_url = "mode=" . $mode;
foreach($printers_list as $key=>$printer) {
    $printers_list[$key] = array(
        "name" => $printer,
        "refresh_url" => geturl($base_url . "&refresh=" . $key)
    );
}

$smarty->assign('PRINTERS', $printers_list);

$pagecont= smdisp("printers_refresh.tpl","fetch");


?>