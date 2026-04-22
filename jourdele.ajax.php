<?php
# 06.05.2009 - дневника на изв.действия - изтриване на ръчно добавени записи 
# отгоре : 
#    $dele= записа за изтриване 
//print_r($GETPARAM);

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

//# таблицата 
//$taname= "docuout";
# шаблона 
$tpname= "jourdele.ajax.tpl";
# полетата 
$filist= array();
# константни полета 
//$ficonst= array("iduser"=>$iduser);
$ficonst= array();
# reload - след успешен събмит 
$relurl= geturl("mode=".$mode."&page=".$page);


									# класа за редактиране 
									include_once "edit.class.php";
#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";

									//# основен входен параметър - 
									//# $edit - $taname.id  

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	# данните за записа 
	$rojour= getrow("jour",$dele);
	$smarty->assign("JOURDATA", $rojour);

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
	# изтриваме документа 
	$DB->query("delete from jour where id=?" ,$dele);
			# 06.10.2010 - 
			# всяко ръчно добавено действие може да има списък с дела, а не само едно 
			# изтриваме и списъка с делата 
	$DB->query("delete from joursuit where idjour=?" ,$dele);

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
/*
	# redirect 
//	reload("parent",$relurl);
	$smarty->assign("EXITCODE", getnyroexit("t6link"));
	print smdisp($tpname,"iconv");
*/
	# redirect 
	reload("parent",$relurl);
}else{
	# извеждаме формата 
//	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


?>
