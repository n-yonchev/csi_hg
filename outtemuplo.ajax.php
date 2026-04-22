<?php
# upload на doc файл за избран изх.шаблон 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $uplo - id за корекция 
# още отгоре : 
#    $cufilt - текущия филтър 
#    $relurl - линк след успешен събмит 
//print "correction [$mode][$uplo][$page]";

# таблицата 
$taname= "docutype";
# шаблона 
$tpname= "outtemuplo.ajax.tpl";
# полетата 
/*
$filist= array(
	"text"=>  array("validator"=>"notempty", "error"=>"описанието е задължително")
	,"adresat"=> NULL
//	,"filename"=> array("validator"=>"notempty", "error"=>"името на файла е задължително")
);
*/
$filist= array();
# константни полета 
//$ficonst= array("iduser"=>$iduser);
$ficonst= array();
# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page);
//$relurl= geturl("mode=".$mode);

# име на полето с файла за upload 
$uploname= "file";
# вътр.папка за съхраняване на файловете 
$filedire= "outgoing/";


#----------------- директно редактиране -----------------------

									# класа за редактиране 
									# само заради функцията doerrors 
									include_once "edit.class.php";
									# управляваща променлива - $uplo вместо $edit 

# четем предварително записа 
$rocont= $DB->selectRow("select * from $taname where id=?" ,$uplo);
$smarty->assign("TEMPTEXT", to1251($rocont["text"]));
$smarty->assign("FILENAME", to1251($rocont["filename"]));
									
				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
//var_dump($mfacproc);
//print_r($_POST);

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
//		$rocont= $DB->selectRow("select * from $taname where id=?" ,$uplo);
//		foreach($filist as $finame=>$ficont){
//				$_POST[$finame]= $rocont[$finame];
//		}
	//$smarty->assign("TEMPTEXT", to1251($rocont["text"]));
	//$smarty->assign("FILENAME", to1251($rocont["filename"]));
//	$_POST["mark"]= $rocont["mark"];

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
											# проверяваме за допълнителни грешки 
											$lister= array();
		# uploaded file - името е "file" 
										# проверяваме за грешки от трансфера 
										include "commuplo.php";
										# връща стринг с грешка или празен, ако няма грешка 
										$ertext= checkupload($uploname);
		if ($ertext==""){
			# няма грешки 
					# изтриваме стария физич.файл 
					$servname= $rocont["filename"];
					if (empty($servname)){
					}else{
						$servname= $filedire .tran1251($servname);
						unlink($servname);
					}
							# съхраняваме новия файл 
							$filename= $_FILES[$uploname]["name"];
								//$filename= to1251($filename);
							$savename= $filedire .tran1251($filename);
							$tempname= $_FILES[$uploname]["tmp_name"];
							$resucopy= copy($tempname,$savename);
if ($resucopy===false){
die("outtemuplo=1");
}else{
}
		}else{
			# има грешки 
							$retucode= 1;
											$lister[""]= "error";
$smarty->assign("ERTEXT", $ertext);
		}
											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
												#---- няма ---- 
							$retucode= 0;
//		$aset= $ficonst;
//		foreach($filist as $finame=>$ficont){
//				$aset[$finame]= $_POST[$finame];
//		}
							#---- полета с автоматично съдържание 
//							if ($uplo==0){
//		# добавяне на нов запис 
//		$aset["filename"]= $filename;
//		$uplo= $DB->query("insert into $taname set ?a, created=now(), mark=?s" ,$aset,$_POST["mark"]);
//							}else{
		# корекция на записа 
		$aset= array();
		$aset["filename"]= $filename;
		$DB->query("update $taname set ?a where id=?d" ,$aset,$uplo);
//							}
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
	reload("parent",$relurl);
}else{
	# извеждаме формата 
//	$smarty->assign("FLAGCLON", $FLAGCLON);
	$smarty->assign("EDIT", $uplo);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


?>