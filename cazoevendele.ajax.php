<?php
# изтриване на събитие за текущото дело 
# отгоре : 
#    $delrec - id за изтриване 
# още отгоре : 
#    $taname - таблицата 
#    $redilink - линк за redirect 
# $idel - id на събитието 
//print_r($GETPARAM);

# таблицата 
$taname= "suitevent";
# шаблона 
$tpname= "cazoevendele.ajax.tpl";
# полетата 
$filist= array();
# константни полета 
$ficonst= array();

									# класа за редактиране 
									include_once "edit.class.php";

#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
									# основен параметър - 
									# $delrec - $idel - id на събитието 
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	# данните за реда 
	$rocont= getrow($taname,$delrec);
	$text= $rocont["text"];

#------ submit без формални грешки 
# потвърдено изтриване 
}elseif ($mfacproc=="submyes"){
							$retucode= 0;
	$DB->query("delete from $taname where id=?" ,$delrec);

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
	$redilink= array("t2link","tevenlink");
	$smarty->assign("EXITCODE", getnyroexit($redilink));
	print smdisp($tpname,"iconv");
}else{
	# извеждаме формата 
//	$smarty->assign("EDIT", $idel);
//	$smarty->assign("FILIST", $filist);
//	$smarty->assign("TYPETEXT", $typetext);
	$smarty->assign("TEXT", $text);
//			$smarty->assign("CASECOUN", $casecoun);
//	$smarty->assign("ISCLAIMER", $isclaimer);
	print smdisp($tpname,"iconv");
//	$pagecont= smdisp($tpname,"iconv");
}


?>
