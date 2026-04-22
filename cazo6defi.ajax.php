<?php
# изтриване на външен файл като изходящ документ по текущото дело 
# отгоре : 
#    $zone= 6 
#    $func= view 
#  $defi= docuout.id - за кой изх.документ е файла 
//print_r($GETPARAM);

# таблицата 
$taname= "docuoutfile";
# шаблона 
$tpname= "cazo6defi.ajax.tpl";
//# полетата 
//$filist= array();
//# константни полета 
//$ficonst= array();
# вътр.папка за съхраняване на файловете 
$filedire= "files/";

									# класа за редактиране 
									include_once "edit.class.php";

#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
									# основен параметър - 
									# $defi - socuout.id 
# данните за изх.документ 
/*
$rocont= getrow($taname,$defi);
//print_r($rocont);
//$rocont= dbconv($rocont);
//print_r($rocont);
*/
$myqu= "select docuoutfile.* 
	, docuout.serial as serial, docuout.year as year
	from docuoutfile 
	left join docuout on docuoutfile.iddocuout=docuout.id
	where docuoutfile.iddocuout=?d
	";
$rocont= $DB->selectRow($myqu ,$defi);
$rocont= dbconv($rocont);

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	$smarty->assign("FILENAME", $rocont["filename"]);

#------ submit без формални грешки 
# потвърдено изтриване 
}elseif ($mfacproc=="submyes"){
							$retucode= 0;
	# изтриваме физич.файл 
//	$servname= $filedire.$rocont["filenameserv"];
	$servname= $filedire.$rocont["prefix"].$rocont["filename"];
	unlink($servname);
//	unlink(toutf8($servname));
//var_dump(toutf8($servname));
/*
	if ($rocont["serial"]==0 and $rocont["year"]==0){
		# документа няма изх.номер - трием целия запис 
		$DB->query("delete from $taname where id=?" ,$defi);
	}else{
		# документа има изх.номер - премахваме само името на файла 
		$aset= array();
		$aset["filename"]= "";
		$aset["filenameserv"]= "";
		$DB->query("update $taname set ?a where id=?" ,$aset,$defi);
	}
*/
													//$DB->query("lock tables docuout write, docuoutfile write");
	if ($rocont["serial"]==0 and $rocont["year"]==0){
		# документа няма изх.номер - трием записите и в двете таблици 
		$DB->query("delete from $taname where iddocuout=?d" ,$defi);
//		$DB->query("delete from docuout where id=?d" ,$defi);
	}else{
		# документа има изх.номер - премахваме запис само в табл. с името на файла 
		$DB->query("delete from $taname where iddocuout=?d" ,$defi);
	}
													//$DB->query("unlock tables");

#------ допълнителен бутон 
# отказ 
}elseif ($mfacproc=="submno"){
							$retucode= 0;

#------ submit с формални грешки 
# - невъзможно в случая 
}elseif ($mfacproc==NULL){
//	# стандартна реакция 
							$retucode= 1;
//	doerrors();

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
//	reload("parent",$relurl);
	$smarty->assign("EXITCODE", getnyroexit("t6link"));
	print smdisp($tpname,"iconv");
}else{
	# извеждаме формата 
//	$smarty->assign("EDIT", $idel);
//	$smarty->assign("FILIST", $filist);
//	$smarty->assign("ISCLAIMER", $isclaimer);
	print smdisp($tpname,"iconv");
//	$pagecont= smdisp($tpname,"iconv");
}


?>
