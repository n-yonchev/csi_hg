<?php
# изтриване на сметка за текущото дело 
# отгоре : 
#     $delebill - bill.id 
//print_r($GETPARAM);

# таблицата 
$taname= "bill";
# шаблона 
$tpname= "cazobilldele.ajax.tpl";
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
									# $delebill - id на събитието 
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	# данните за реда 
		$rocont= getrow($taname,$delebill);
		$roclai= getrow("claimer",$rocont["idclaimer"]);
		$rocont["clainame"]= $roclai["name"];
	$suma= $DB->selectCell("
		select 1.2*sum(taxprop+taxregu+taxaddi) as suma
		from billelem
		where idbill=?d
		group by idbill
		"  ,$delebill);
		$rocont["suma"]= $suma;
	$smarty->assign("ROCONT", $rocont);

#------ submit без формални грешки 
# потвърдено изтриване 
}elseif ($mfacproc=="submyes"){
							$retucode= 0;
	$DB->query("delete from $taname where id=?d" ,$delebill);
	$DB->query("delete from billelem where idbill=?d" ,$delebill);

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
	$redilink= array("tbilllink");
	$smarty->assign("EXITCODE", getnyroexit($redilink));
	print smdisp($tpname,"iconv");
}else{
	# извеждаме формата 
//	$smarty->assign("ISCLAIMER", $isclaimer);
	print smdisp($tpname,"iconv");
//	$pagecont= smdisp($tpname,"iconv");
}


?>
