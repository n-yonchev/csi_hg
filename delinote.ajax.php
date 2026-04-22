<?php
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $postnote - post.id за корекция 
# още отгоре : 
#    $modeel - базов стринг за линкове 
#    $relu6 - линк за рефреш след приключване 
//print_r($GETPARAM);

# таблицата 
$taname= "post";
# шаблона 
$tpname= "delinote.ajax.tpl";
# полетата 
$filist= array(
	"notes"=> NULL
);
# константни полета 
$ficonst= array();
/*
# reload - след успешен събмит 
//$relurl= "?".rawurlencode(mycrypt("put","mode=".$mode));
$relurl= geturl("mode=".$mode."&page=".$page);
*/

									# класа за редактиране 
									# основен паранетър - $postnote 
									include_once "edit.class.php";

# редактиране 
$obedit= new edit($taname,$postnote,$filist,$ficonst);

# действие 
$reedit= $obedit->action();
//var_dump($reedit);

# резултат 
if ($reedit==0){
	# redirect 
	reload("parent",$relu6);
}else{
	# извеждаме формата 
	$smarty->assign("EDIT", $postnote);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


?>