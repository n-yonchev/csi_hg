<?php
# upload на сканиран файл за група документи 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $page - текущата страница от списъка 
# още : 
#    $relurl - линк за рефреш на глав.страница 
#    $ardocuuplo - масив с docu.id за свързване със сканирания файл 
#    $_SESSION["ardocuuplo"] - за унищожаване след приключване 
# константи отгоре [docuedituplo.inc.php] : 
#    $uploname= "file";   име на полето с файла за upload 
#    $filedire= "incoming/";   вътр.папка за съхраняване на файловете 
//#    $filesuff= ".pdf";   суфикс на сканираните файлове 
//print_rr($ardocuuplo);
//var_dump($modeel);
//var_dump($editcasecode);


//# таблицата 
//$taname= "docutype";
# шаблона 
$tpname= "docuedituplo.ajax.tpl";
# полетата 
$filist= array();
# константни полета 
$ficonst= array();
//# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page);
/*
# име на полето с файла за upload 
$uploname= "file";
# вътр.папка за съхраняване на файловете 
$filedire= "incoming/";
$filesuff= ".pdf";
*/
		/*
		# има ли текущ файл 
		if (count($ardocuuplo)==1){
$docuid= $ardocuuplo[0];
$savename= $filedire.$docuid.$filesuff;
if (file_exists($savename)){
	$smarty->assign("ISFILE",true);
}else{
}
		}else{
		}
		*/


#----------------- директно редактиране -----------------------

									# класа за редактиране 
									# само заради функцията doerrors 
									include_once "edit.class.php";
									# управляваща променлива - $uplo вместо $edit 
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

#------ submit без формални грешки 
//}elseif ($mfacproc=="submit"){
# качване на файл 
}elseif ($mfacproc=="submyes"){
							$retucode= 0;
											# проверяваме за допълнителни грешки 
											$lister= array();
		# uploaded file - името е "file" 
										# проверяваме за грешки от трансфера 
										include "commuplo.php";
										# връща стринг с грешка или празен, ако няма грешка 
										$ertext= checkupload($uploname);
//										$ertext= checkupload($uploname  ,&$fierro);
/*
		if (empty($ertext) or $fierro==4){
			# няма грешки 
			if ($fierro==4){
				# няма upload-нат файл 
			}else{
				# има файл 
			}
*/
		if ($ertext==""){
/***
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
die("docuedituplo=1");
}else{
}
***/
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
				/*
				foreach ($ardocuuplo as $elem){
					# изтриваме стария физич.файл 
					$servname= $filedire .tran1251($elem);
					if (file_exists($servname)){
						unlink($servname);
					}else{
					}
					# съхраняваме новия файл 
//					$filename= $_FILES[$uploname]["name"];
//					$savename= $filedire .tran1251($filename);
					$savename= $filedire .$elem.$filesuff;
					$tempname= $_FILES[$uploname]["tmp_name"];
					$resucopy= copy($tempname,$savename);
if ($resucopy===false){
die("docuedituplo=1=[$tempname][$savename]");
}else{
}
				}
				*/
				# обработка по списъка 
				docuuploaction($ardocuuplo);
											# край - според дали има грешка 
											}

#------ допълнителен бутон 
# затваряне без качване 
}elseif ($mfacproc=="submno"){
							$retucode= 0;

#------ допълнителен бутон 
# изтриване текущия файл 
}elseif ($mfacproc=="submdele"){
	unlink($savename);
							$retucode= 0;

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
							# унищожаване след приключване 
							unset($_SESSION["ardocuuplo"]);
			if (isset($editcasecode)){
//$smarty->assign("EXITCODE", getnyroexit("t5link"));
$smarty->assign("EXITCODE", getnyroexit($zoscan));
print smdisp($tpname,"iconv");
			}else{
reload("parent",$relurl);
//exit;
			}
//	# redirect 
//	reload("parent",$relurl);
}else{
	# извеждаме формата 
							# списък входящи номера 
							$incode= implode(",",$ardocuuplo);
									if (empty($incode)){
										$incode= "0";
									}else{
									}
//////							$arinco= $DB->selectCol("select concat(serial,'/',year) from docu where id in ($incode)");
							$arinco= $DB->selectCol("select concat(serial,'/',year) from $tabasescan where id in ($incode)");
							$smarty->assign("ARINCO", $arinco);
//	$smarty->assign("EDIT", $uplo);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}

?>