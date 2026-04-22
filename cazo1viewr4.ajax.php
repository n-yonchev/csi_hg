<?php
									session_start();
									include_once "common.php";

$idcase= $_GET["e"];
//var_dump($idcase);

$rodata= $DB->selectRow("
	select reg4mess.*, reg4mess.id as id, reg4call.idreg4, reg4call.time 
	from reg4mess 
	left join reg4call on reg4mess.idreg4call=reg4call.id
	where reg4mess.idcase=?d
	",  $idcase);
$rodata= dbconv($rodata);
//print_rr($rodata);

		if (empty($rodata)){
print "ok";
		}else{
$smarty->assign("RODATA", $rodata);
//	$artext= explode("^",$rodata["text"]);
	$art2= explode("^",$rodata["text"]);
				$artext= array();
	foreach($art2 as $elem){
				$artext[]= explode("|",$elem);
	}
$smarty->assign("ARTEXT", $artext);
$copage= smdisp("cazo1viewr4.ajax.tpl","fetch");
print "ok^" .toutf8($copage);
		}

?>