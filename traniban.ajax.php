<?php
# разпределение : корекция на сметката 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $vari - подрежим 
#    $page - текущата страница 
# основен : 
#    $editiban - finatran.id за корекция 
# още отгоре : 
#    $relurl - след успешен събмит 
//print_r($GETPARAM);

# таблицата 
$taname= "finatran";
# шаблона 
$tpname= "traniban.ajax.tpl";
# полетата 
$filist= array(
	"iban"=>  array("validator"=>"notempty", "error"=>"сметката не може да е празна")
//	,"bic"=>  array("validator"=>"notempty", "error"=>"кода не може да е празен")
);
# константни полета 
$ficonst= array();
# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page."&filt=".$filt);
//$relurl= geturl("mode=".$mode."&page=".$page);

# данните 
$rocont= $DB->selectRow("select * from $taname where id=?" ,$editiban);
//print_rr($rocont);
$smarty->assign("ARDATA", $rocont);
$roclai= getrow("claimer",$rocont["idclaimer"]);
$smarty->assign("CLAINAME", $roclai["name"]);
$smarty->assign("CLAIIBAN", $roclai["iban"]);
		$ispostbank= $rocont["idbank"]==$indxbankpost;
$smarty->assign("ISPOSTBANK", $ispostbank);
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
									# $editiban = $taname.id 
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
//	if ($editiban==0){
//	}else{
		//$rocont= $DB->selectRow("select * from $taname where id=?" ,$editiban);
		foreach($filist as $finame=>$ficont){
				$_POST[$finame]= $rocont[$finame];
		}
		if ($ispostbank){
			# име на банк.клон 
			$robank= $DB->selectRow("select * from banklist where $code4bic=?" ,getiban4($rocont["iban"]));
			$robank= arstrip($robank);
			$_POST["bankname"]= $robank["name"];
		}else{
		}
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
								if ($slen<>$ibanslen){
											$lister["iban"]= "съдържа $slen вместо $ibanslen символа";
								}else{
									# IBAN контр.число (2 цифри) 
									$chresu= ibancheck($iban);
									if ($chresu!==true){
										$let2= substr($iban,0,2);
											$lister["iban"]= "грешен IBAN [$let2$chresu]";
									}else{
										$mybicpart= getiban4($iban);
										$roba= $DB->selectRow("select * from banklist where $code4bic=?" ,$mybicpart);
										if (empty($roba)){
											$lister["iban"]= "няма банка с bic=$mybicpart"."xxxx";
										}else{
										}
									}
								}
***/
/*
		$biccslen= 8;
								$bicc= $_POST["bic"];
								$slen= strlen($bicc);
								if ($slen==$biccslen){
								}else{
											$lister["bic"]= "съдържа $slen вместо $biccslen символа";
								}
						if ($ispostbank){
								$bankname= trim($_POST["bankname"]);
								if (empty($bankname)){
											$lister["bankname"]= "за превод от Пощ.банка се изисква банков клон";
								}else{
								}
						}else{
						}
*/
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
//		$DB->query("update $taname set ?a where id=?d" ,$aset,$editiban);
		$DB->query("update $taname set ?a, ibaniser=0 where id=?d" ,$aset,$editiban);
//	}
									# проверка със сметката на взискателя 
									if ($rocont["idclaimer"]<=0){
									}else{
										if ($roclai["iban"]==$_POST["iban"]){
										}else{
	$smarty->assign("NEWBANK", tran1251($roba["name"]));
											$mybicpart= getiban4($roclai["iban"]);
											$roclaibank= $DB->selectRow("select * from banklist where $code4bic=?" ,$mybicpart);
	$smarty->assign("OLDBANK", tran1251($roclaibank["name"]));
							$retucode= -12;
							$smarty->assign("CONF",true);
										}
									}
											# край - според дали има грешка 
											}

#------ submyes потвърждаване 
}elseif ($mfacproc=="submyes"){
							$retucode= 0;
//	updrow("claimer",$rocont["idclaimer"],"iban='".$_POST["iban"]."'");
//		$cset= array("iban"=>$_POST["iban"]);
		$cset= array();
		$cset["iban"]= $_POST["iban"];
//+		$cset["bic"]= $_POST["bic"];
		$DB->query("update claimer set ?a where id=?d" ,$cset,$rocont["idclaimer"]);

#------ submno отказ 
}elseif ($mfacproc=="submno"){
							$retucode= 0;

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
									# 10.04.2013 специално за връщане 
									if ($rocont["idclaimer"]==-1){
										$idcase= $rocont["idcase"];
										$ariban= $DB->select("select name, iban from debtor where idcase=?d"  ,$idcase);
										$ariban= dbconv($ariban);
										$ariban= arstrip($ariban);
	$smarty->assign("ARIBAN", $ariban);
									}else{
									}
	# извеждаме формата 
	$smarty->assign("EDIT", $editiban);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


?>
