<?php
# дела с непълни основни данни за логнатия деловодител и избрана година 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

# годината  
	unset($listyear[0]);
	$arke= array_keys($listyear);
//$year= $GETPARAM["year"];
							$view= $GETPARAM["view"];
							# разлагаме основния параметър на деловодител и година 
							list($myuser,$year)= explode("^",$view);
$year= isset($year) ? $year : $arke[0];
//$smarty->assign("YEAR", $year);
//var_dump($year);

							# деловодителя 
							$idcaseuser= $iduser;
							# годината 
							$caseyear= $year;
$smarty->assign("YEAR", $caseyear);
							# флаг за списъка с годините 
$smarty->assign("YEARFLAG", true);
									
									# извеждаме списъка с дела 
									include_once "comple.inc.php";

?>
