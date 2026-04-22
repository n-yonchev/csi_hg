<?php
# призовки -  изх.документи за връчване с призовкари 
# корекция на чакащ документ 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $vari - вторично меню 
#    $page - текущата страница 
# параметри : 
#    $deliwaitedit документа postwait.id 
# още отгоре : 
#    $modeel - базов стринг за линкове 
#    $relurl - линк за рефреш след приключване 
#    $isinte - дали е вътрешен 
//print_rr($GETPARAM);
//print_rr($aridpost);
//var_dump($isinte);


# таблицата 
$taname= "postwait";
# шаблона 
$tpname= "deliwaitedit.ajax.tpl";
# полетата 
$filist= array(
	"adresat"=>  array("validator"=>"notempty", "error"=>"адресата е задължителен")
//	,"date3"=>  array("validator"=>"bgdate_valid", "transformer"=>"getputbgdate")
	,"address"=>  NULL
	,"idposttype"=> NULL
	,"idpostuser"=> NULL
);
									if ($isinte){
									}else{
$filist["iddelisour"]= array("validator"=>"notzero", "error"=>"източника е задължителен");
$filist["exinfo"]= NULL;
									}
# константни полета 
//$ficonst= array("iduser"=>$iduser);
$ficonst= array();
# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page);
//$relurl= geturl("mode=".$mode);

									# класа за редактиране 
									include_once "edit.class.php";

# редактиране 
//$obedit= new edit($taname,$edit,$filist,$ficonst);
$obedit= new edit($taname,$deliwaitedit,$filist,$ficonst);
# действие 
$reedit= $obedit->action();
//var_dump($reedit);

# резултат 
if ($reedit==0){
		# само за вътрешен 
		# ако метода не е призовкар - нулираме и призовкаря 
		if ($isinte and $_POST["idposttype"]<>2 and $_POST["idpostuser"]<>0){
					$DB->query("update $taname set idpostuser=0 where id=?d"  ,$deliwaitedit);
		}else{
		}
	# redirect 
	reload("parent",$relurl);
}else{
									if ($isinte){
									}else{
										# за избор на източник 
										$arsourpost= getselect("delisour","name","1",true);
										$smarty->assign("ARSOURPOSTNAME", "arsourpost");
									}
							# за избор на призовкар 
							$aruserpost= getselect("postuser","name","1",true);
							//$aruserpost= dbconv($aruserpost);
						$smarty->assign("ARUSERPOSTNAME", "aruserpost");
# за избор на метод - масив с празен елемент 
$listpoty= array(0=>"") + $listtypepost_utf8;
$smarty->assign("ARPOSTTYPENAME", "listpoty");
//	$smarty->assign("COUN", count($aridpost));
	# извеждаме формата 
//	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}

?>