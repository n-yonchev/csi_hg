<?php
# действия с готов номер-искане за справка от регистъра на длъжниците 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $codeto - =номер-искане 
# $reload - след успешен събмит 
# $modeel - базов стринг за събмит 
#    $arresu - данните от сървъра 
//print_rr($GETPARAM);
//print_rr($_POST);
#-------------------------------------------------------------------
# форма - създава входящ и изходящ документ 
#-------------------------------------------------------------------


# полетата 
$filist= array(
	"from"=> array("validator"=>"notempty", "error"=>"съдържанието е задължително")
	,"text"=> array("validator"=>"notempty", "error"=>"съдържанието е задължително")
	,"adresat"=> array("validator"=>"notempty", "error"=>"съдържанието е задължително")
	,"descrip"=> array("validator"=>"notempty", "error"=>"съдържанието е задължително")
);
//print_rr($filist);
# константни полета 
//$ficonst= array("iduser"=>$iduser);
$ficonst= array();

									# класа за редактиране 
									include_once "edit.class.php";
#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
var_dump($mfacproc);
print_rr($_POST);
									//# основен входен параметър - 
									//# $edit - docu.id  
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;

	$_POST["from"]= toutf8($arresu["payeename"]);
	$_POST["text"]= toutf8("искане за справка от ЦРД");
	$_POST["adresat"]= toutf8($arresu["querypersonname"]);
	$_POST["descrip"]= toutf8("справка от ЦРД");
				/*
	if ($edit==0){
		$_POST["idtype"]= 1;
		$_POST["isinvo"]= 0;
		$_POST["idtype2"]= 1;
	}else{
		foreach($filist as $finame=>$ficont){
			$_POST[$finame]= $rocont[$finame];
		}
		$idtype2= $rocont["idtype2"];
			if ($idtype2==1){
		$_POST["egn"]= $rocont["param"];
			}elseif ($idtype2==2){
		$_POST["eik"]= $rocont["param"];
			}else{
			}
		$invodata= $rocont["invodata"];
		$arinvo= unserialize($invodata);
		foreach($fiinvo as $finame){
			$_POST[$finame]= $arinvo[$finame];
		}
				$invodata= serialize($arinvo);
	}
				*/
//		$rocont= $DB->selectRow("select * from aadocucomp where iddocu=?d" ,$edit);
/*****
	if ($edit==0){
		$_POST["dateapplic"]= date("d.m.Y");
		$_POST["taxdate"]= date("d.m.Y");
		$_POST["descrip"]= toutf8("удостоверение за вписване на длъжник");
		$_POST["text"]= toutf8("молба за удостоверение за вписване");;
	}else{
		foreach($filist as $finame=>$ficont){
			$_POST[$finame]= $rocont[$finame];
		}
		$_POST["dateapplic"]= bgdatefrom($rocont["dateapplic"]);
		$_POST["taxdate"]= bgdatefrom($rocont["taxdate"]);
			$idtype2= $rocont["idtype2"];
			$finame2= $listty[$idtype2];
		$_POST[$finame2]= $rocont["param"];
	}
*****/
//print_rr($_POST);

#------ submit без формални грешки 
}elseif ($mfacproc=="createdoc"){
							$retucode= 0;
											# проверяваме за допълнителни грешки 
											$lister= array();
											# според дали има грешка 
//print_rr($lister);
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
												#---- няма ---- 
							$retucode= 0;
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
//	reload("parent",$relurl);
}else{
	# извеждаме формата 
//	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
//	print smdisp($tpname,"iconv");
}



?>