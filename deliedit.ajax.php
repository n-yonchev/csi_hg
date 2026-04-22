<?php
# връчване - корекция на екземпляр 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $vari - вторично меню 
#    $page - текущата страница 
# параметри : 
#    $postedit - post.id 
# още отгоре : 
#    $modeel - базов стринг за линкове 
#    $relu6 - линк за рефреш след приключване 
//#    $isinte - дали е вътрешен 
//print_rr($GETPARAM);
//print_rr($aridpost);
//var_dump($isinte);


# таблицата 
$taname= "post";
# шаблона 
$tpname= "deliedit.ajax.tpl";
# полетата 
$filist= array(
	"idposttype"=> array("validator"=>"notzero", "error"=>"метода е задължителен")
	,"adresat"=>  array("validator"=>"notempty", "error"=>"адресата е задължителен")
//	,"date3"=>  array("validator"=>"bgdate_valid", "transformer"=>"getputbgdate")
	,"address"=>  NULL
	,"notes"=>  NULL
//	,"idposttype"=> NULL
//	,"idpostuser"=> NULL
);

# вътрешен/външен 
$ropost= getrow("post",$postedit);
$isinte= ($ropost["iddocu"]==0);
$smarty->assign("ISINTE", $isinte);
									/**/
									if ($isinte){
									}else{
$filist["iddelisour"]= array("validator"=>"notzero", "error"=>"източника е задължителен");
//$filist["exinfo"]= NULL;
//$filist["date1"]= array("validator"=>"bgdate_valid", "transformer"=>"getputbgdate");
									}
									/**/
# константни полета 
//$ficonst= array("iduser"=>$iduser);
$ficonst= array();
//# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page);
//$relurl= geturl("mode=".$mode);

									# класа за редактиране 
									include_once "edit.class.php";

# редактиране 
//$obedit= new edit($taname,$edit,$filist,$ficonst);
$obedit= new edit($taname,$postedit,$filist,$ficonst);
# действие 
$reedit= $obedit->action();
//var_dump($reedit);

# резултат 
if ($reedit==0){
		/**/
		# само за вътрешен 
		# ако метода не е призовкар - нулираме и призовкаря 
		if ($isinte and $_POST["idposttype"]<>2 and $_POST["idpostuser"]<>0){
					$DB->query("update $taname set idpostuser=0 where id=?d"  ,$postedit);
		}else{
		}
		/**/
	# redirect 
	reload("parent",$relu6);
}else{
									/**/
									if ($isinte){
									}else{
										# за избор на източник 
										$arsourpost= getselect("delisour","name","1",true);
										$smarty->assign("ARSOURPOSTNAME", "arsourpost");
									}
									/*
							# за избор на призовкар 
							$aruserpost= getselect("postuser","name","1",true);
							//$aruserpost= dbconv($aruserpost);
						$smarty->assign("ARUSERPOSTNAME", "aruserpost");
									*/
# за избор на метод - масив с празен елемент 
//$listpoty= array(0=>"") + $listtypepost_utf8;
//$smarty->assign("ARPOSTTYPENAME", "listpoty");
//	$smarty->assign("COUN", count($aridpost));
	# извеждаме формата 
//	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}

?>