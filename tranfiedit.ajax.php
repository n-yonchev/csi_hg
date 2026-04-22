<?php
# взискател от постъпление : корекция на сметката 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $page - текущата страница 
#    $idcase - делото suit.id 
# основен : 
#    $claimodi - claimer.id за корекция 
# още отгоре : 
//#    $codebudg="bud" - код за бюдж.сметка 
#    $relurl - след успешен събмит 
//print_r($GETPARAM);

# таблицата 
$taname= "claimer";
# шаблона 
$tpname= "tranfiedit.ajax.tpl";
# полетата 
$filist= array(
	"iban"=>  array("validator"=>"notempty", "error"=>"сметката не може да е празна")
//	,"bic"=>  array("validator"=>"notempty", "error"=>"кода не може да е празен")
//	,"bic"=>  NULL
);
# константни полета 
$ficonst= array();
# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page."&filt=".$filt);
//$relurl= geturl("mode=".$mode."&page=".$page);

//# код за бюдж.сметка 
//$codebudg= "bud";
# данните 
$roclai= getrow("claimer",$claimodi);
$smarty->assign("CLAINAME", $roclai["name"]);
	$eik= $roclai["bulstat"];
$smarty->assign("EIK", $eik);
/*
if (empty($eik)){
}else{
	# всички уникални сметки 
	$listiban= $DB->select("
		select claimer.id as ARRAY_KEY, claimer.iban, claimer.bic, suit.serial as caseseri, suit.year as caseyear
		from claimer 
		left join suit on claimer.idcase=suit.id
		where claimer.bulstat=? and (claimer.iban<>'' or claimer.bic<>'')
		group by claimer.iban, claimer.bic
		"  ,$eik);
//$smarty->assign("LISTIBANNAME", "listiban");
$smarty->assign("LISTIBAN", $listiban);
}
*/

									# класа за редактиране 
									include_once "edit.class.php";

#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
//print_rr($_POST);
									# основен параметър - 
									# $claimodi = $taname.id 
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
//	if ($editiban==0){
//	}else{
		//$rocont= $DB->selectRow("select * from $taname where id=?" ,$editiban);
		foreach($filist as $finame=>$ficont){
				$_POST[$finame]= $roclai[$finame];
		}
		# име на банк.клон 
		$robank= $DB->selectRow("select * from banklist where $code4bic=?" ,getiban4($roclai["iban"]));
		$robank= arstrip($robank);
		$_POST["bankname"]= $robank["name"];
//	}

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
											# проверяваме за допълнителни грешки 
											$lister= array();
								$iban= $_POST["iban"];
								$ermess= ibanerror($iban);
								if (empty($ermess)){
								}else{
											$lister["iban"]= $ermess;
								}
/***
		$ibanslen= 22;
								$iban= $_POST["iban"];
								$slen= strlen($iban);
								if ($slen==$ibanslen){
									$mybicpart= getiban4($iban);
									$roba= $DB->selectRow("select * from banklist where $code4bic=?" ,$mybicpart);
									if (empty($roba)){
											$lister["iban"]= "няма банка с bic=$mybicpart"."xxxx";
									}else{
									}
								}else{
											$lister["iban"]= "съдържа $slen вместо $ibanslen символа";
								}
						# IBAN контр.число (2 цифри) 
						$chresu= ibancheck($iban);
						if ($chresu===true){
						}else{
											$lister["iban"]= "грешен IBAN [$chresu]";
						}
***/
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
		foreach($filist as $finame=>$ficont){
				$aset[$finame]= $_POST[$finame];
		}
							#---- полета с автоматично съдържание 
//	if ($editiban==0){
//		# нов запис 
//		$editiban= $DB->query("insert into $taname set ?a" ,$aset);
//	}else{
		# корекция на записа 
		$DB->query("update $taname set ?a where id=?d" ,$aset,$claimodi);
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
	$smarty->assign("EDIT", $claimodi);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


?>
