<?php

//$finame= $fnpref .$arfina["ok"];
//var_dump($finame);
//$ficont= file_get_contents($finame);

			$ficont= "";
						if (file_exists($finame)){
$fiar= file($finame);
//			$ficont= "";
foreach($fiar as $row){
	$row= substr($row,19);
	if (strpos($row,"alert")===false){
	}else{
		$row= "<font color=red>".$row."</font>";
	}
//			$ficont .= $row."<br>";
			$ficont .= $row;
}

			$ficont= tran1251($ficont);
$ficont= nl2br($ficont);
//var_dump($ficont);
						}else{
//			$ficont= "";
						# if (file_exists($finame)){
						}

$smarty->assign("FICONT", $ficont);
$recont= smdisp("regiok.tpl","fetch");
$smarty->assign("RECONT", $recont);

?>