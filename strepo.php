<?php
# справки за статистиката 
# отгоре : 
#    $mode - текущия режим 
//print_rr($GETPARAM);

$arsubm= array();
$arsubm["rep1"]["text"]= "преведени суми на взискател през месец";		$arsubm["rep1"]["php"]= "strep1.php";
$arsubm["rep2"]["text"]= "преведени и непреведени суми на взискател";	$arsubm["rep2"]["php"]= "strep2.php";
$arsubm["rep2aa"]["text"]= "същото с представител";				$arsubm["rep2aa"]["php"]= "strep2aa.php";
$arsubm["rep3"]["text"]= "дела на взискател с минимална олихвяема сума";		$arsubm["rep3"]["php"]= "strep3.php";
$arsubm["rep4"]["text"]= "дела на взискатели, чието име съдържа въведен текст";	$arsubm["rep4"]["php"]= "strep4.php";
$arsubm["rep5"]["text"]= "преведени на ЧСИ суми през месец";	$arsubm["rep5"]["php"]= "strep5.php";
$arsubm["rep6"]["text"]= "постъпили суми през месец";	$arsubm["rep6"]["php"]= "strep6.php";
$arsubm["rep7"]["text"]= "преведени на взискател/представител за период";	$arsubm["rep7"]["php"]= "strep7.php";
$arsubm["rep9"]["text"]= "висящи дела по ЕГН";	$arsubm["rep9"]["php"]= "strep9.php";
$arsubm["rep10"]["text"]= "неразпределени суми на взискател за период";	$arsubm["rep10"]["php"]= "strep10.php";

$baseurl= "mode=".$mode;
foreach ($arsubm as $suin=>$x2){
	$arsubm[$suin]["subm"]= geturl($baseurl."&subm=".$suin);
}
$smarty->assign("ARSUBM", $arsubm);
//print_rr($arsubm);

									# за избрана справка 
									$subm= $GETPARAM["subm"];
									if (isset($subm)){
										$cuphp= $arsubm[$subm]["php"];
										if (isset($cuphp)){
											include_once $cuphp;
# вика се в глав.прозорец, вмъква се в основната страница
//return;
										}else{
										}
									}else{
									}
# извеждаме 
$smarty->assign("SUBM", $subm);
$smarty->assign("REPOCONT", $repocont);
$pagecont= smdisp("strepo.tpl","fetch");


?>