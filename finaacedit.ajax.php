<?php
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $page - текущата страница 
#    $filt - текущия филтър 
# $edit - claim2iban.id за корекция 
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
//$ficonst= array("iduser"=>$iduser);
$ficonst= array();
# reload - след успешен събмит 
$relurl= geturl("mode=".$mode."&page=".$page."&filt=".$filt);

									# класа за редактиране 
									include_once "edit.class.php";

# редактиране 
$obedit= new edit($taname,$edit,$filist,$ficonst);
# действие 
$reedit= $obedit->action();
//var_dump($reedit);

# резултат 
if ($reedit==0){
	# redirect 
	reload("parent",$relurl);
}else{
				# данни за взискателя 
				$roiban= getrow($taname,$edit);
				$roc2= getrow("claim2",$roiban["idclaim2"]);
				$smarty->assign("NAME", $roc2["name"]);
	# извеждаме формата 
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


?>