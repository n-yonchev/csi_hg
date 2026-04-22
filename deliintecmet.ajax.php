<?php
									session_start();
									include_once "common.php";
								include_once "deli.inc.php";
$idtana= $_GET["para"];

$modeel= $_SESSION["deliinte_modeel"];
$tana= $_SESSION["deliinte_tana"];

	$cutype= $DB->selectCell("select idposttype from $tana where id=?d"  ,$idtana);
	$list2= array(0=>"няма назначен") + $listtypepost;
//$smarty->assign("ARLIST", $list2);

			$arlink= array();
foreach($list2 as $indx=>$text){
	if ($indx==$cutype){
		$culink= "";
	}else{
		$culink= geturl($modeel."&chmeth=".$idtana."&tometh=".$indx);
	}
			$arlink[$culink]= $text;
}
$smarty->assign("ARLINK", $arlink);
//print_ru($arlink);

print smdisp("deliintecmet.tpl","iconv");

?>