<?php
# екземпляри от документи за връчване - отпечатване плик с/без известие - iframe 
# отгоре : 
#    $prnt - плика postenve.id 
#    $isenveonly - флаг само плик 
//#    $modebase= "mode=".$mode."&vari=".$vari; 
//# локални параметри : 
//#    $v3 - меню 3-то ниво 
//#    $page - текуща страница 
//var_dump($modebase);
//print_rr($GETPARAM);


# данни за ЧСИ 
$rooffi= getofficerow(0);
$smarty->assign("ROOFFI", $rooffi);

# данни за плика 
$roenve= getrow("postenve",$prnt);
	$roenve["adresat"]= noquotes($roenve["adresat"]);
	$roenve["address"]= noquotes($roenve["address"]);
$smarty->assign("ARENVE", $roenve);
$ardout= $DB->select("
	select concat(docuout.serial,'/',docuout.year) as doutinfo, concat(suit.serial,'/',suit.year) as caseinfo
	from post
	left join docuout on post.iddocuout=docuout.id
	left join suit on docuout.idcase=suit.id
	where post.idenve=?d
	"  ,$prnt);
$ardout= dbconv($ardout);
$smarty->assign("ARDOUT", $ardout);

//$smarty->assign("ISBIGE", $rodata["isbige"]<>0);
print smdisp("delisendprnt.tpl","fetch");

?>