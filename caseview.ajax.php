<?php
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $view - case.id за разглеждане 
//print "correction [$mode][$edit]";

# таблицата 
$taname= "suit";
# шаблона 
$tpname= "caseview.ajax.tpl";
# полетата 
$filist= array(
	"text"=>  array("validator"=>"notempty", "error"=>"описанието не може да е празно")
	,"idcofrom"=>  array("validator"=>"notzero", "error"=>"\"идва от\" е задължително")
);
# константни полета 
$ficonst= array("iduser"=>$iduser);
# reload - след успешен събмит 
//$relurl= "?".rawurlencode(mycrypt("put","mode=".$mode));
$relurl= geturl("mode=".$mode);

									# класа за редактиране 
									include_once "edit.class.php";

# редактиране 
$obedit= new edit($taname,$view,$filist,$ficonst);
$reedit= $obedit->action();
//var_dump($reedit);

# резултат 
if ($reedit==0){
	# redirect 
	reload("parent",$relurl);
}else{
	# извеждаме формата 
							# за избор на "идва от" - кеширания масив 
							$arfrom= unserialize(file_get_contents(COFROMFILE));
							# предаваме името, а не съдържанието на масива 
							$smarty->assign("ARFROMNAME", "arfrom");
	$smarty->assign("view", $view);
	$smarty->assign("FILIST", $filist);
//sdisplay(1, "eeee.html", $tpname);
	print smdisp($tpname,"iconv");
}


?>