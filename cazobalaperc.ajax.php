<?php
# изчислява и извежда детайлен списък с лихвени периоди 
# източник : calc.php 
									session_start();
									include_once "common.php";

# параметъра 
$para= $_GET["para"];
//print $para;

# изчисляваме лихвата - true= крайната дата се връща с ден назад 
list($d1,$d2,$amou)= explode("^",$para);
									include_once "subjpaymhist.inc.php";
							$arperc= getpercent();
$arinte= calcinte($d1,$d2,$amou  ,true);
# списъка с периодите 
$intelist= $arinte["list"];
$smarty->assign("INTELIST", $intelist);

$smarty->assign("PERCTEXT", "ОЛП");
//$pagecont= smdisp("calc.tpl","fetch");
$pagecont= smdisp("_calcperc.tpl","iconv");
print $pagecont;

?>
