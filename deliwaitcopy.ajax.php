<?php
# призовки -  изх.документи за връчване с призовкари 
# прехвърляне маркираните документи в нормалния списък 
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
#    $arunset - масив с полета за игнориране 
# $totabl - таблица, към която ще прехвърляме 
# маркирани : 
#    $aridpost - масив с документи post.id 
//print_r($GETPARAM);
//print_rr($aridpost);
//print_rr($_POST);
//var_dump($totabl);


# таблицата 
$taname= "postwait";
# шаблона 
$tpname= "deliwaitcopy.ajax.tpl";

# трансформираме списъка маркирани 
			$ar2= array();
foreach($aridpost as $elem){
	if (substr($elem,0,2)=="cg"){
	}else{
			$ar2[]= $elem;
	}
}
$aridpost= $ar2;
//print_rr($aridpost);

# резултат 
if (isset($_POST["submyes"])){
/***/
//print_ru($aridpost);
//print_ru($aset);
									$DB->query("lock tables $taname write, $totabl write");
																						# timing 
																						function tm($p1){
																							file_put_contents("waitcopy.txt", $p1."\r\n", FILE_APPEND | LOCK_EX);
																						}
																						tm("\r\n".date("d.m.Y H:i:s"));
				# прехвърляме маркираните записи 
				foreach($aridpost as $idpost){
//print "<br>[$taname][$idpost]";
//print_ru($aset);
																				$t1= time();
					$rowait= $DB->selectRow("select * from $taname where id=?d"  ,$idpost);
//						unset($rowait["id"]);
//						unset($rowait["isdubl"]);
						foreach($arunset as $fime){
							unset($rowait[$fime]);
						}
																				$t2= time();
																				$int1= $t2-$t1;
																						tm("[$idpost] sele $taname =$int1");
					$DB->query("insert into $totabl set ?a"  ,$rowait);
																				$int2= time()-$t2;
																						tm("[$idpost] inse $totabl =$int2");
				}
				# изтриваме маркираните записи 
				foreach($aridpost as $idpost){
																				$t1= time();
					$DB->query("delete from $taname where id=?d"  ,$idpost);
																				$int2= time()-$t2;
																						tm("[$idpost] dele $taname =$int2");
				}
									$DB->query("unlock tables");
/***/
	# redirect 
	reload("parent",$relurl);
}elseif (isset($_POST["submno"])){
	# redirect 
	reload("parent",$relurl);
}else{
	$smarty->assign("COUN", count($aridpost));
	# извеждаме формата 
//	$smarty->assign("EDIT", $edit);
//	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}

?>