<?php
# разпределение : корекция на длъжника 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $vari - подрежим 
#    $page - текущата страница 
# основен : 
#    $editdebt - finatran.id за корекция 
# още отгоре : 
#    $relurl - след успешен събмит 
//print_r($GETPARAM);

# таблицата 
$taname= "finatran";
# шаблона 
$tpname= "trandebt.ajax.tpl";
# полетата 
$filist= array(
	"iddebtor"=>  array("validator"=>"notzero", "error"=>"длъжника е задължителен")
);
# константни полета 
$ficonst= array();
# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page."&filt=".$filt);
//$relurl= geturl("mode=".$mode."&page=".$page);

# данните 
$rocont= $DB->selectRow("select * from $taname where id=?" ,$editdebt);
$smarty->assign("ARDATA", $rocont);
//$rofina= getrow("finance",$rocont["idfinance"]);
	$rorefe= $DB->selectRow("select * from finatranrefe where idfinatran=?" ,$editdebt);
$rofina= getrow("finance",$rorefe["idfinance"]);

									# класа за редактиране 
									include_once "edit.class.php";

#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
									# основен параметър - 
									# $editdebt = $taname.id 
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
//	if ($editdebt==0){
//	}else{
		//$rocont= $DB->selectRow("select * from $taname where id=?" ,$editdebt);
		foreach($filist as $finame=>$ficont){
				$_POST[$finame]= $rocont[$finame];
		}
//	}

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
											# проверяваме за допълнителни грешки 
											$lister= array();
/*
		$ibanslen= 22;
								$iban= $_POST["iban"];
								$slen= strlen($iban);
								if ($slen==$ibanslen){
								}else{
											$lister["iban"]= "съдържа $slen вместо $ibanslen символа";
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
		$aset= array();
		foreach($filist as $finame=>$ficont){
				$aset[$finame]= $_POST[$finame];
		}
							#---- полета с автоматично съдържание 
	# добавяне/корекция 
//	if ($editdebt==0){
//		# нов запис 
//		$editdebt= $DB->query("insert into $taname set ?a" ,$aset);
//	}else{
				# само за връщане - корекция и на получател и основание 
				$idclaimer= $rocont["idclaimer"];
				if ($idclaimer==-1){
					$rodebt= getrow("debtor",$aset["iddebtor"]);
					$debtname= $rodebt["name"];
					$debtname= charspec($debtname);
		$aset["clainame"]= toutf8($debtname);
				}else{
				}
		# корекция на записа 
		$DB->query("update $taname set ?a where id=?d" ,$aset,$editdebt);
		# корекция на основанието 
		updatrantext($editdebt);
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
					# за избор на длъжник 
					$ardebt= $DB->selectCol("select id as ARRAY_KEY, name from debtor where idcase=?d order by id"  ,$rofina["idcase"]);
//					$ardebt= $DB->selectCol("select id as ARRAY_KEY, concat(name,if(iban='','',concat(' [',iban,']'))) 
//						from debtor where idcase=?d order by id"  ,$rofina["idcase"]);
					$ardebt= arstrip($ardebt);
					$smarty->assign("ARDEBTNAME", "ardebt");
	# извеждаме формата 
	$smarty->assign("EDIT", $editdebt);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


?>
