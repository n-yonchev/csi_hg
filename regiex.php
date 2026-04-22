<?php

//$finame= $fnpref .$arfina["ok"];
//var_dump($finame);
$ficont= file_get_contents($finame);
/*
	$fiar= file($finame);
			$ficont= "";
foreach($fiar as $row){
	$row= substr($row,19);
	if (strpos($row,"alert")===false){
	}else{
		$row= "<font color=red>".$row."</font>";
	}
//			$ficont .= $row."<br>";
			$ficont .= $row;
}
*/
			$ficont= tran1251($ficont);
$ficont= "<pre>$ficont</pre>";
//$ficont= nl2br($ficont);
//var_dump($ficont);
$smarty->assign("FICONT", $ficont);

$recont= smdisp("regiex.tpl","fetch");
$smarty->assign("RECONT", $recont);

?>