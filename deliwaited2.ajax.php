<?php
# призовки -  изх.документи за връчване с призовкари 
# корекция на група маркирани документи 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $vari - вторично меню 
#    $page - текущата страница 
# параметри : 
#    $deliedit=0 
# още отгоре : 
#    $modeel - базов стринг за линкове 
#    $relurl - линк за рефреш след приключване 
# маркирани : 
#    $aridpost - масив с документи post.id 
//print_r($GETPARAM);
//print_rr($aridpost);


# таблицата 
$taname= "postwait";
# шаблона 
$tpname= "deliwaited2.ajax.tpl";
# полетата 
$filist= array(
//	"adresat"=>  array("validator"=>"notempty", "error"=>"адресата е задължителен")
//	,"date3"=>  array("validator"=>"bgdate_valid", "transformer"=>"getputbgdate")
	"adresat"=>  NULL
	,"address"=>  NULL
	,"idposttype"=> NULL
	,"idpostuser"=> NULL
);
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
$obedit= new edit($taname,0,$filist,$ficonst);
# действие 
$reedit= $obedit->action();
//var_dump($reedit);

# резултат 
if ($reedit==0){
				# формираме масива с данните 
				$aset= array();
				foreach($filist as $finame=>$x2){
					$pocont= $_POST[$finame];
					if (empty($pocont)){
					}else{
						/*
						if (substr($finame,0,4)=="date"){
							$pocont= bgdateto($pocont);
						}else{
						}
						*/
						$aset[$finame]= $pocont;
					}
				}
		# ако метода не е призовкар - нулираме и призовкаря 
		if ($aset["idposttype"]==2){
		}else{
			$aset["idpostuser"]= "";
		}
//print_ru($aridpost);
//print_ru($aset);
				# корегираме маркираните записи 
				foreach($aridpost as $idpost){
//print "<br>[$taname][$idpost]";
//print_ru($aset);
					$DB->query("update $taname set ?a where id=?d"  ,$aset,$idpost);
				}
	# redirect 
	reload("parent",$relurl);
}else{
							/*
							# за избор на призовкар 
							$aruserpost= getselect("postuser","name","1",true);
							//$aruserpost= dbconv($aruserpost);
						$smarty->assign("ARUSERPOST", "aruserpost");
							*/
# за избор на метод - масив с празен елемент 
$listpoty= array(0=>"") + $listtypepost_utf8;
$smarty->assign("ARPOSTTYPENAME", "listpoty");
						/*
							# за избор на статус 
							$arstatpost= getselect("poststat","name","1",true);
							//$arstatpost= dbconv($arstatpost);
						$smarty->assign("ARSTATPOST", "arstatpost");
						*/
	$smarty->assign("COUN", count($aridpost));
	# извеждаме формата 
//	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}

?>