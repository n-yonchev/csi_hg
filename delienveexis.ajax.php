<?php
# екземпляри от документи за връчване - включване на екземпляр в съществуващ плик 
# параметър : 
#    $toexi - екземпляра за включване post.id 
# отгоре : 
#    $modeel - базов линк 
//#    $relurl - за рефреш 
//var_dump($modebase);
//print "toexi=[$toexi]";
//print_rr($GETPARAM);


						# директно включване към избрания плик 
						$envechos= $GETPARAM["envechos"];
						if (isset($envechos)){
$idenve2= $DB->selectCell("select idenve from post where id=?d"  ,$toexi);
$DB->query("update post set idenve=$envechos where id=?d"  ,$toexi);
	tranenve1($envechos,$toexi);
	if ($idenve2==0){
	}else{
		tranenve0($idenve2);
	}
reload("parent",geturl($modeel));
						}else{
						}

# данни за екземпляра 
$ropost= $DB->selectRow("
	select post.adresat, post.address
		, docuout.serial as d2seri, docuout.year as d2year
	from post
	left join docuout on post.iddocuout=docuout.id
	where post.id=?d
	"  ,$toexi);
$ropost= dbconv($ropost);
$smarty->assign("ROPOST", $ropost);

# списък неизпратени пликове 
$arenve= getenvelist("postenve.idstat=0");

# линкове 
# бройки екземпляри по пликове 
				$arcoun= array();
				$arlink= array();
foreach($arenve as $idenve=>$x2){
	$c2= count($x2);
				$arcoun[$idenve]= ($c2==0)?1:$c2;
				$arlink[$idenve]= geturl($modeel."&toexi=".$toexi."&envechos=".$idenve);
}
$smarty->assign("ARCOUN", $arcoun);
$smarty->assign("ARLINK", $arlink);
//print_rr($arlink);


# извеждаме формата 
$smarty->assign("ARENVE", $arenve);
print smdisp("delienveexis.ajax.tpl","iconv");

?>