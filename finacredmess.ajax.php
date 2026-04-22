<?php
# корекция фактура за кред.известие 
# управляващ : 
#    $editcredmess = bill.id за корекция 
# още отгоре : 
#    $relurl - базовия линк 
//print_rr($GETPARAM);


# таблицата 
$taname= "bill";
# шаблона 
$tpname= "finacredmess.ajax.tpl";
# полетата 
$filist= array(
	"credmess"=> NULL
);
# константни полета 
//$ficonst= array("iduser"=>$iduser);
$ficonst= array();

									# класа за редактиране 
									include_once "edit.class.php";

# редактиране 
$obedit= new edit($taname,$editcredmess,$filist,$ficonst);

# действие 
$reedit= $obedit->action();
//var_dump($reedit);

# резултат 
if ($reedit==0){
	# redirect 
	reload("parent",$relurl);
}else{
	# извеждаме формата 
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


?>