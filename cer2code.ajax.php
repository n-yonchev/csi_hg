<?php
# действия с готов номер-искане за справка от регистъра на длъжниците 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $code - =номер-искане 
# $relurl - след успешен събмит 
# $modeel - базов стринг за събмит 
//print_rr($GETPARAM);
//print_rr($_POST);


# нов базов стринг за събмит 
$modealte= $modeel ."&code=".$code;

# параметър с предстоящото действие 
$vari= $GETPARAM["vari"];
						if (isset($vari)){
						}else{
							# НЯМА параметър с предстоящото действие 
# има/няма запис за искането 
$roc2= $DB->selectRow("select * from aadocuc2 where coderequ=?"  ,toutf8($code));
# вариант за предстоящото действие 
if (empty($roc2)){
	$vari= 1;
}else{
	$vari= getvari($roc2);
}
# reload 
$reloalte= geturl($modealte ."&vari=".$vari);
						}


# номер-искане 
$smarty->assign("CODE", $code);
# данни за искането 
$roc2= $DB->selectRow("select * from aadocuc2 where coderequ=?"  ,toutf8($code));
	$roc2= dbconv($roc2);
$smarty->assign("ROC2", $roc2);
$smarty->assign("ISLO", $roc2["islocal"]==1);
	$arinvo= unserialize(toutf8($roc2["invodata"]));
//print_ru($arinvo);
$smarty->assign("INVO", tran1251($arinvo));

# действие 
//print "<h2>$vari</h2>";
if (0){
}elseif($vari==1){
	$modeinc= $modealte ."&vari=1";
	$reloinc= geturl($modealte ."&vari=2");
						include "cer2v1.inc.php";
}elseif($vari==2){
	$modeinc= $modealte ."&vari=2";
	$reloinc= geturl($modealte ."&vari=3");
						include "cer2v2.inc.php";
}elseif($vari==3){
	$modeinc= $modealte ."&vari=3";
	if ($roc2["isinvo"]==0){
				$reloinc= geturl($modealte ."&vari=99");
	}else{
				$reloinc= geturl($modealte ."&vari=4");
	}
						include "cer2v3.inc.php";
}elseif($vari==4){
	$modeinc= $modealte ."&vari=4";
						$reloinc= geturl($modealte ."&vari=99");
						include "cer2v4.inc.php";
}elseif($vari==99){
						include "cer2v99.inc.php";
}else{
die("cer2code=");
var_dump($vari);
}

//# извеждане 
//print smdisp($tpname,"iconv");


?>