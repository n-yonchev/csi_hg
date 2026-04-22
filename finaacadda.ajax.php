<?php
# добавяне сметка за взискател 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $page - текущата страница 
#    $filt - текущия филтър 
# $adda - взискателя claim2.id, а не id на сметката 
//print "correction [$mode][$edit]";
//print_r($GETPARAM);

# таблицата 
$taname= "claim2iban";
# шаблона 
$tpname= "finaacedit.ajax.tpl";
# полетата 
$filist= array(
	"iban"=>  array("validator"=>"notempty", "error"=>"полето не може да е празно")
	,"bic"=>  array("validator"=>"notempty", "error"=>"полето не може да е празно")
//	,"descrip"=>  array("validator"=>"notempty", "error"=>"полето не може да е празно")
	,"descrip"=>  NULL
);
# константни полета 
$ficonst= array("idclaim2"=>$adda);
//$ficonst= array();
# reload - след успешен събмит 
$relurl= geturl("mode=".$mode."&page=".$page."&filt=".$filt);

									# класа за редактиране 
									include_once "edit.class.php";

# редактиране 
$obedit= new edit($taname,0,$filist,$ficonst);
# действие 
$reedit= $obedit->action();
//var_dump($reedit);

# резултат 
if ($reedit==0){
	# redirect 
	reload("parent",$relurl);
}else{
				# данни за взискателя 
//				$roiban= getrow($taname,$edit);
//				$roc2= getrow("claim2",$roiban["idclaim2"]);
				$roc2= getrow("claim2",$adda);
				$smarty->assign("NAME", $roc2["name"]);
	# извеждаме формата 
	$smarty->assign("EDIT", 0);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


?>