<?php
									# вика се самостоятелно, а не с include 
									session_start();
									include_once "common.php";

# за избор на "идва от" - кеширания UTF-8 масив 
$arfrom= unserialize(file_get_contents(COFROMFILE.SUFFUTF8));
//print_r($arfrom);
/*
# предаваме името, а не съдържанието на масива 
$smarty->assign("ARFROMNAME", "arfrom");

$tpname= "cazo1cofrom.ajax.tpl";
print smdisp($tpname,"iconv");
//print "CAZO1COFROM";
*/

$sele= $_GET["sele"];
$resu= "";
foreach($arfrom as $arindx=>$arcont){
	$codesele= ($arindx==$sele) ? "selected='selected'" : "";
	$resu .= "<option value='$arindx' $codesele>$arcont</option>";
}

//print toutf8($resu);
print $resu;

?>