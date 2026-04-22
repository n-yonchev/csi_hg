<?php
# призовки -  изх.документи за връчване с призовкари 
# корекция на група маркирани документи 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $vari - вторично меню 
#    $page - текущата страница 
# параметри : 
#    $deliwaitclear=0 
# още отгоре : 
#    $modeel - базов стринг за линкове 
#    $relurl - линк за рефреш след приключване 
# маркирани : 
#    $aridpost - масив с документи post.id 
//print_rr($GETPARAM);
//print_rr($aridpost);
//print_rr($_POST);

$submit= $_POST["submit"];
if (isset($submit)){
	$cbfiel= $_POST["cbfiel"];
				# формираме масива с данните 
				$aset= array();
				foreach($cbfiel as $finame){
					$aset[$finame]= "";
				}
		# ако метода не е призовкар - нулираме и призовкаря 
		if ($aset["idposttype"]==2){
		}else{
			$aset["idpostuser"]= "";
		}
				# корегираме маркираните записи 
				foreach($aridpost as $idpost){
//					$DB->query("update postwait set ?a where id=?d"  ,$aset,$idpost);
					updapostwait($aset,$idpost);
				}
# redirect 
	reload("parent",$relurl);
}else{
	$smarty->assign("COUN", count($aridpost));
	# извеждаме формата 
//	$smarty->assign("EDIT", $edit);
//	$smarty->assign("FILIST", $filist);
	print smdisp("deliwaitclear.ajax.tpl","iconv");
}

?>