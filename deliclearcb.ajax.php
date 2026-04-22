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
#    $taname - таблицата 
# маркирани : 
#    $aridpost - масив с документи post.id 
/*
# алтернативно извикване - за списък - от delilist.php 
#    $taname==NULL 
#    $aridpost съдържа елементи пример deli_2012_4^297357 = тримес.таблица ^ id в нея 
*/
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
				# корегираме маркираните записи 
				foreach($aridpost as $idpost){
												/*
												if (isset($tana)){
					$DB->query("update $tana set ?a where id=?d"  ,$aset,$idpost);
												}else{
										list($ta2,$id2)= explode("^",$idpost);
										$DB->query("update $ta2 set ?a where id=?d"  ,$aset,$id2);
												}
												*/
					$DB->query("update $taname set ?a where id=?d"  ,$aset,$idpost);
				}
# redirect 
	reload("parent",$relurl);
}else{
	$smarty->assign("COUN", count($aridpost));
	# извеждаме формата 
//	$smarty->assign("EDIT", $edit);
//	$smarty->assign("FILIST", $filist);
	print smdisp("deliclearcb.ajax.tpl","iconv");
}

?>