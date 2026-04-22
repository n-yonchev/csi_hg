<?php
# разпределение : корекция на взискател/получател 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $vari - подрежим 
#    $page - текущата страница 
# основен : 
#    $editclai - finatran.id за корекция 
# още отгоре : 
#    $relurl - след успешен събмит 
//print_r($GETPARAM);

# таблицата 
$taname= "finatran";
# шаблона 
$tpname= "tranclai.ajax.tpl";
# полетата 
$filist= array(
	"clainame"=>  array("validator"=>"notempty", "error"=>"не може да е празно")
//	,"text1"=>  array("validator"=>"notempty", "error"=>"не може да е празно")
//	,"text2"=>  array("validator"=>"notempty", "error"=>"не може да е празно")
);
# константни полета 
$ficonst= array();
# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page."&filt=".$filt);
//$relurl= geturl("mode=".$mode."&page=".$page);

# данните 
$rocont= $DB->selectRow("select * from $taname where id=?" ,$editclai);
$smarty->assign("ARDATA", $rocont);
/*
$roclai= getrow("claimer",$rocont["idclaimer"]);
$smarty->assign("CLAINAME", $roclai["name"]);
$smarty->assign("CLAIIBAN", $roclai["iban"]);
		$ispostbank= $rocont["idbank"]==$indxbankpost;
$smarty->assign("ISPOSTBANK", $ispostbank);
*/
//print_rr($roclai);

									# класа за редактиране 
									include_once "edit.class.php";

#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
									# основен параметър - 
									# $editclai = $taname.id 
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
//	if ($editclai==0){
//	}else{
		//$rocont= $DB->selectRow("select * from $taname where id=?" ,$editclai);
		foreach($filist as $finame=>$ficont){
				$_POST[$finame]= $rocont[$finame];
		}
		$_POST["clainame"]= $rocont["clainame"];
//	}
											# проверяваме за допълнителни грешки 
											$lister= array();
							include "tranclaier.inc.php";
	$smarty->assign("LISTER",$lister);

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
											# проверяваме за допълнителни грешки 
											$lister= array();
							include "tranclaier.inc.php";
											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
												#---- няма ---- 
							$retucode= 0;
	# добавяне/корекция 
		$aset= array();
		//foreach($filist as $finame=>$ficont){
		//		$aset[$finame]= $_POST[$finame];
		//}
		$aset["clainame"]= $clainame;
//							#---- полета с автоматично съдържание 
//	if ($editclai==0){
//		# нов запис 
//		$editclai= $DB->query("insert into $taname set ?a" ,$aset);
//	}else{
		# корекция на записа 
		$DB->query("update $taname set ?a where id=?d" ,$aset,$editclai);
//	}
											# край - според дали има грешка 
											}

#------ submit с формални грешки 
}elseif ($mfacproc==NULL){
							$retucode= 1;
	doerrors();

#------ автоматичен submit -----------------------------------------------------
# - невъзможно в случая 
}elseif ($mfacproc=="UNKNOWN"){
							$retucode= 2;

#------ невъзможна грешка от библиотеката 
}else{
print "<br>error=mfacproc=";
var_dump($mfacproc);
die();
}

#----------------- край на директното редактиране -----------------------
# резултат 
if ($retucode==0){
	# redirect 
	reload("parent",$relurl);
}else{
	# извеждаме формата 
	$smarty->assign("EDIT", $editclai);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


?>
