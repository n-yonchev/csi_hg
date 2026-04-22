<?php
# отгоре : 
#    $iduser - логнатия потребител 
#    $edit= case.id за модифициране 
#    $zone= paym 
#    $func= modi 

# входни параметри 
# $idel - cash.id на прих.касов ордер 
$idel= $GETPARAM["idel"];
//print "correction [$edit][$zone][$func]idel=[$idel]";

# таблицата 
$taname= "cash";
# шаблона 
$tpname= "cazopaymmodi.ajax.tpl";
# полетата 
$filist= array(
	"amount"=>  array("validator"=>"amount", "error"=>"грешна сума")
	,"date"=>  array("validator"=>"notempty", "error"=>"датата е задължителна")
	,"name"=>  array("validator"=>"notempty", "error"=>"вносителя е задължителен")
	,"text"=>  array("validator"=>"notempty", "error"=>"описанието е задължително")
	,"iddebtor"=>  array("validator"=>"notzero", "error"=>"длъжника е задължителен")
//	,"idclaimer"=>  array("validator"=>"notzero", "error"=>"взискателя е задължително поле")
//	,"listde"=>  array("inactive"=>true)
//	,"idsubtype"=>  array("validator"=>"notzero", "error"=>"подтипа е задължително поле")
);
# константни полета 
$ficonst= array("idcase"=>$edit);

						# за избор на длъжници - четем списъка с длъжниците по делото 
						$ardebt= getselect("debtor","name","idcase=$edit",true);
						//$ardebt= dbconv($ardebt);
//						# предаваме съдържанието на масива 
//						$smarty->assign("ARDEBT", $ardebt);
						# предаваме името на масива 
						$smarty->assign("ARDEBTNAME", "ardebt");


#----------------- директно редактиране -----------------------

									# класа за редактиране 
									include_once "edit.class.php";

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	if ($idel==0){
							#---- полета с автоматично съдържание 
							# днешна дата 
							$_POST["date"]= date("Y-m-d");
							# ако има само един длъжник - назначаваме го директно 
							if (count($ardebt)==2){
								$arke= array_keys($ardebt);
								$_POST["iddebtor"]= $arke[1];
							}else{
							}
	}else{
		$rocont= $DB->selectRow("select * from $taname where id=?" ,$idel);
		foreach($filist as $finame=>$ficont){
			if ($ficont["inactive"]){
			}else{
				$_POST[$finame]= $rocont[$finame];
			}
		}
							#---- полета с автоматично съдържание 
							# статични полета 
							$smarty->assign("SERIYEAR",$rocont["serial"]."/".$rocont["year"]);
							$smarty->assign("DATE",$rocont["date"]);
	}

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
											# проверяваме за допълнителни грешки 
											$lister= array();

											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
												#---- няма ---- 
							$retucode= 0;
		$aset= $ficonst;
		foreach($filist as $finame=>$ficont){
			if ($ficont["inactive"]){
			}else{
				$aset[$finame]= $_POST[$finame];
			}
		}
	if ($idel==0){
							#---- полета с автоматично съдържание 
							# пореден номер и година - годината е от датата 
							$myyear= substr($_POST["date"],0,4);
													$DB->query("lock tables $taname write");
							$maxser= $DB->selectCell("select max(serial) from $taname where year=?" ,$myyear);
							$aset["serial"]= $maxser + 1;
							$aset["year"]= $myyear;
		# нов запис 
		$idel= $DB->query("insert into $taname set ?a, created=now()" ,$aset);
													$DB->query("unlock tables");
	}else{
							#---- полета с автоматично съдържание 
		# корекция на записа 
		$DB->query("update $taname set ?a where id=?d" ,$aset,$idel);
	}
											# край - според дали има грешка 
											}

#------ submit с формални грешки 
}elseif ($mfacproc==NULL){
							$retucode= 1;
	doerrors();

#------ автоматичен submit -----------------------------------------------------
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
//	$smarty->assign("EXITCODE", getnyroexit("tpaymlink"));
							#---- януари-2010 актуален дълг ----
							$redilink= array("tpaymlink","tactulink");
							$smarty->assign("EXITCODE", getnyroexit($redilink));
	print smdisp($tpname,"iconv");
}else{
/*
						# предаваме името, а не съдържанието на масива 
						$smarty->assign("ARCLAINAME", "arclai");
							# за избор на "тип" - масива $listsubjtype - commspec.php 
							# предаваме името, а не съдържанието на масива 
							$smarty->assign("ARTYPENAME", "listsubjtype_utf8");
							# за евент.избор на "подтип" - масива $listsubjst - commspec.php 
							# предаваме името, а не съдържанието на масива 
							$smarty->assign("ARSTNAME", "listsubjst_utf8");
*/
	# извеждаме формата 
	$smarty->assign("EDIT", $idel);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
//	$pagecont= smdisp($tpname,"iconv");
}


?>
