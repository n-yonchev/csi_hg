<?php
# автоматично отпечатване на ред от банково извлечение 
# - вика се самостоятелно във вътр.фрейм - виж _fina.tpl 

									session_start();
									include_once "common.php";
						
						# за извеждане на "тип" - масива $listfinatype - commspec.php 
						# предаваме съдържанието на масива 
						$smarty->assign("ARTYPE", $listfinatype);
/*
$GETPARAM= getparam();
//print_r($GETPARAM);
$prnt= $GETPARAM["prnt"];
*/

$para= $_GET["para"];
$palist= explode("/",$para);
unset($palist[count($palist)-1]);
							$content= "";
							$first= 2;
foreach($palist as $indx=>$prnt){
//var_dump($prnt);
/*
	if ($prnt==0){
		continue;
	}else{
	}
*/
	$prnt= $prnt -132;

	$rofina= getrow("finance",$prnt);
	$rouser= getrow("user",$rofina["iduser"]);
	$rocase= getrow("suit",$rofina["idcase"]);
		$rocaseuser= getrow("user",$rocase["iduser"]);

	$smarty->assign("ROFINA", $rofina);
	$smarty->assign("ROUSER", $rouser);
	$smarty->assign("ROCASE", $rocase);
	$smarty->assign("ROCASEUSER", $rocaseuser);
	
	$robank= $DB->selectRow("select * from finasource where idfinance=?d" ,$prnt);
	if (empty($robank)){
	}else{
		$smarty->assign("ROBANK", $robank);
		$smarty->assign("ROOPNAME", getrow("finasource", $robank['id'])['op_name']); // 23.01.2024 Принтиране на новото поле "op_name"
	}
							$first= 3-$first;
//print "<br>".$indx."/".(count($palist)-1);
							if ($indx==count($palist)-1){
								$first= 0;
							}else{
							}
$smarty->assign("FIRST", $first);
							$content .= smdisp("finaprnt.tpl","fetch");
}
// var_dump($robank['op_name']);

$smarty->assign("CONTENT", $content);
print smdisp("_print.tpl","iconv");

?>
