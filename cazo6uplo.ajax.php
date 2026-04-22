<?php
# зона-6 : upload на външен файл като изходящ документ 
# източник : 
#    finabankedit.ajax.php - качване на банково извлечение 
# отгоре : 
#    $zone= 6 
#    $func= view 
#  $uplo= docuout.id - за кой изх.документ е файла 
//print_r($GETPARAM);

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

# шаблона 
$tpname= "cazo6uplo.ajax.tpl";
//# полетата 
//$filist= array(
//	"name"=>  array("validator"=>"notempty", "error"=>"името не може да е празно")
//);
//# константни полета 
//$ficonst= array("idcashpack"=>$edit);
//# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page);

# име на полето с файла за upload 
$uploname= "file";
//# суфикс на файла 
//$filesuff= ".xml";
# вътр.папка за съхраняване на файловете 
$filedire= "files/";

#----------------- директно редактиране -----------------------

# четем данните за изх.документ 
//$rocont= $DB->selectRow("select filename, filenameserv from docuout where id=?" ,$uplo);
$rocont= $DB->selectRow("select * from docuoutfile where iddocuout=?d" ,$uplo);
$rocont= dbconv($rocont);
//print_r($rocont);

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
		$smarty->assign("FILENAME", $rocont["filename"]);

#------ submit без формални грешки 
# в случая се изпълнява етап-1 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
		# uploaded file - името е "file" 
										# проверяваме за грешки от трансфера 
										include "commuplo.php";
										# връща стринг с грешка или празен, ако няма грешка 
										$ertext= checkupload($uploname);
		if ($ertext==""){
			# няма грешки 
//							$retucode= 8;
							# съхраняваме файла 
			$filename= $_FILES[$uploname]["name"];
//							$myname= date("Ymd_His_u_").$filename;
							$mystam= date("Ymd_His_u_");
							$myname= $mystam.$filename;
//print "[$myname]";
							$savename= $filedire.to1251($myname);
							$tempname= $_FILES[$uploname]["tmp_name"];
							copy($tempname,$savename);
	# евент.изтриваме стария физич.файл 
//var_dump($rocont["filenameserv"]);
//	$servname= $filedire.$rocont["filenameserv"];
	$servname= $rocont["prefix"].$rocont["filename"];
//var_dump($servname);
	if (empty($servname)){
	}else{
		$servname= $filedire.$servname;
		unlink($servname);
	}
			# записваме информацията в таблицата 
			$aset= array();
			$aset["filename"]= $filename;
			$aset["prefix"]= $mystam;
/*
			if ($uplo==0){
				$aset["idcase"]= $edit;
				$uplo= $DB->query("insert into docuout set ?a, created=now()" ,$aset);
			}else{
				$DB->query("update docuout set ?a where id=?d" ,$aset,$uplo);
			}
*/
													$DB->query("lock tables docuout write, docuoutfile write");
			if ($uplo==0){
				$outset= array();
				$outset["idcase"]= $edit;
				$uplo= $DB->query("insert into docuout set ?a, created=now()" ,$outset);
					$aset["iddocuout"]= $uplo;
				$DB->query("insert into docuoutfile set ?a" ,$aset);
			}else{
				if (count($rocont)==0){
					$aset["iddocuout"]= $uplo;
					$DB->query("insert into docuoutfile set ?a" ,$aset);
				}else{
					$DB->query("update docuoutfile set ?a where iddocuout=?d" ,$aset,$uplo);
				}
			}
													$DB->query("unlock tables");
		}else{
			# има грешки 
							$retucode= 1;
$smarty->assign("ERTEXT", $ertext);
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
	$smarty->assign("EXITCODE", getnyroexit("t6link"));
	print smdisp($tpname,"iconv");
//	# redirect 
//	reload("parent",$relurl);
}else{
	# извеждаме формата 
//	$smarty->assign("EDIT", $edit);
//	$smarty->assign("NEXTNUMB", getnextout());
	$smarty->assign("VARI", $mfacproc);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


?>
