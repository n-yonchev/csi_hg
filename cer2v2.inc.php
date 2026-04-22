<?php
# действия за справка от регистъра на длъжниците 
# етап-2 : форма - създава входящ и изходящ документ 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
# $modeinc - базов стринг за събмит 
# $reloinc - след успешен събмит - линк за следващ етап 
#    $code - =номер-искане 
#    $vari=2 - текущо действие 
# $roc2 - прочетен ред за искането 
//print_rr($GETPARAM);
//print_rr($_POST);


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
//var_dump($mfacproc);
//print_rr($_POST);
									//# основен входен параметър - 
									//# $edit - docu.id  
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;

	$_POST["from"]= toutf8($roc2["name"]);
	$_POST["text"]= toutf8("искане за справка от ЦРД");
	$_POST["adresat"]= toutf8($roc2["name2"]);
	$_POST["descrip"]= toutf8("справка от ЦРД");
//		$rocont= $DB->selectRow("select * from aadocucomp where iddocu=?d" ,$edit);
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
	# създаваме документите 
	#-- подготовка 
//	$docuyear= (int) date("Y");
	$roaa= $DB->selectRow("select id from aadocutype where mode=?"  ,$MODECERT);
	$ddtype= $roaa["id"];
									$DB->query("lock tables docu write, docuout write, aadocuc2 write");
		# следв.номер входен документ за годината 
		$ser1= $DB->selectCell("select max(serial) from docu where year=?" ,$docuyear);
		$nextser1= $ser1 + 1;
		# следв.номер изходящ документ за годината 
		$ser2= $DB->selectCell("select max(serial) from docuout where year=?" ,$docuyear);
		$nextser2= $ser2 + 1;
	# съдържание за вход.документ docu 
		$aset= array();
	$aset["text"]= $_POST["text"];
	$aset["from"]= $_POST["from"];
//	$aset["notes"]= $_POST["notes"];
	# нов входящ документ 
			$aset["serial"]= $nextser1;
			$aset["year"]= $docuyear;
			$aset["idtype"]= $ddtype;
			$aset["iduser"]= $_SESSION["iduser"];
	$iddocu= $DB->query("insert into docu set ?a, created=now()" ,$aset);
	# съдържание за изх.документ docuout 
		$oset= array();
	$oset["adresat"]= $_POST["adresat"];
	$oset["descrip"]= $_POST["descrip"];
	# нов изходящ документ 
			$oset["serial"]= $nextser2;
			$oset["year"]= $docuyear;
			$oset["isentered"]= 1;
	$iddocuout= $DB->query("insert into docuout set ?a, created=now(), registered=now()" ,$oset);
	# корекция на записа за искането 
		$cset= array();
		$cset["iddocu"]= $iddocu;
		$cset["iddocuout"]= $iddocuout;
//	$DB->query("update aadocuc2 set ?a, lastmodi=now() where id=?d" ,$bset,$rocont["idcert"]);
	$DB->query("update aadocuc2 set ?a where id=?d" ,$cset,$roc2["id"]);
									$DB->query("unlock tables");
											
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
# край - следващ етап 
reload("",$reloinc);
}else{
	# извеждаме формата 
//	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
	print smdisp("cer2v2.inc.tpl","iconv");
}



?>