<?php

									session_start();
									include_once "common.php";

# входния параметричен стринг 
# зарежда глобален масив $GETPARAM 
$aget= array_keys($_GET);
$aget= rawurldecode($aget[0]);
//var_dump($aget);
if (empty($aget)){
}else{
	$GETPARAM= array();
	parse_str(mycrypt("get",$aget) ,$GETPARAM);
//print mycrypt("get",$aget);
	$mode= $GETPARAM["mode"];
	$edit= $GETPARAM["edit"];
}

print "корекция [$mode][$edit]";

?>