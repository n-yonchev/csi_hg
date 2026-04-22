<?php

$uniq= date("Ymd_His");
//var_dump($uniq);
$smarty->assign("UNIQ", $uniq);

							include_once "regi.inc.php";

									$view= $GETPARAM["view"];
									if (isset($view)){
										include_once "regimode.ajax.php";
										exit;
									}else{
									}
							

$modeel= "mode=".$mode ."&uniq=".$uniq;
				$arlink= array();
		foreach($arcall as $code=>$x2){
				$arlink[$code]= geturl($modeel."&view=".$code);
		}
$smarty->assign("ARLINK",$arlink);
$smarty->assign("ARCALL",$arcall);

$pagecont= smdisp("regi.tpl","fetch");

?>