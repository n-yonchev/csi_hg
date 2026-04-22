<?php

$uniq= $GETPARAM["uniq"];
$view= $GETPARAM["view"];
//var_dump($view);
//print_rr($GETPARAM);

/*
	$arview["e1"]= "_err1.txt";
	$arview["fa"]= "_fault.txt";
	$arview["er"]= "_error.txt";
	$arview["re"]= "_result.txt";
*/
											#---- само за временен тест ----
//											$uniq= "t1";
											#-------------------------------
$fina= $uniq.$arfina[$view];
$smarty->assign("FINA", toutf8($arcall[$view])." ($uniq)");

		if ($view=="ok"){
$c1= file("regicert/".$fina);
			$cont= "";
foreach($c1 as $row){
	if (strpos($row,"alert")===false){
	}else{
		$row= "<font color=red>".$row."</font>";
	}
			$cont .= $row."<br>";
}
		}else{
$cont= file_get_contents("regicert/".$fina);
$cont= nl2br($cont);
		}
$smarty->assign("CONT", $cont);

print smdisp("regimode.ajax.tpl","fetch");

?>