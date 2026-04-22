<?php
# отключване на избрано постъпление 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $page - текущата страница от сумите за превод 
# отгоре маневрена : 
#    $unlock - постъплението finance.id 
# управляващи, ако се вика от дело : 
#    $idcase - избраното дело suit.id - отгоре 
#    $idvari - подменю за статуса 
# още отгоре : 
//#    $qutran - базова заявка 
//#    $basefilt - базов филтър 
#    $relurl - линк за връщане към тек.страница 
//#    $codebudg="bud" - код за бюдж.сметка 
//print_rr($GETPARAM);
//var_dump($idcase);


# шаблона 
$tpname= "tranfiunlo.ajax.tpl";

# данните 
$rofina= getrow("finance",$unlock);
$smarty->assign("INCO", $rofina["inco"]);
$rouser= getrow("user",$rofina["lockedby"]);
$smarty->assign("USERNAME", $rouser["name"]);
//print_rr($rofina);

									# класа за редактиране 
									include_once "edit.class.php";

#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
									# основен параметър - 
									# $claimodi = $taname.id 

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;

/*
#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
											# проверяваме за допълнителни грешки 
											$lister= array();
		$ibanslen= 22;
								$iban= $_POST["iban"];
								$slen= strlen($iban);
								if ($slen==$ibanslen){
								}else{
											$lister["iban"]= "съдържа $slen вместо $ibanslen символа";
								}
		$biccslen= 8;
								$bicc= $_POST["bic"];
								$slen= strlen($bicc);
								if ($slen==$biccslen){
								}else{
											$lister["bic"]= "съдържа $slen вместо $biccslen символа";
								}
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
*/

#------ submit обнови 
}elseif ($mfacproc=="submrefr"){
							$retucode= 0;

#------ submit излез 
}elseif ($mfacproc=="submexit"){
							$retucode= 0;

#------ submit отключи и обнови 
}elseif ($mfacproc=="submunlo"){
	updrow("finance",$unlock,"lockedby=0");
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
	# извеждаме формата 
//	$smarty->assign("EDIT", $claimodi);
//	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}

?>