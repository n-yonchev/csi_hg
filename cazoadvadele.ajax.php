<?php
# изтриване на аванс.вноска за текущото дело 
# отгоре : 
#     $deleadva - claimadva.id на събитието 
//print_r($GETPARAM);

# таблицата 
$taname= "claimadva";
# шаблона 
$tpname= "cazoadvadele.ajax.tpl";
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
									# $deleadva - id на събитието 
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	# данните за реда 
		$rocont= getrow($taname,$deleadva);
		$roclai= getrow("claimer",$rocont["idclaimer"]);
		$rocont["clainame"]= $roclai["name"];
	$smarty->assign("ROCONT", $rocont);

#------ submit без формални грешки 
# потвърдено изтриване 
}elseif ($mfacproc=="submyes"){
							$retucode= 0;
	$DB->query("delete from $taname where id=?" ,$deleadva);

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
	$redilink= array("t2link","tadvalink");
	$smarty->assign("EXITCODE", getnyroexit($redilink));
	print smdisp($tpname,"iconv");
}else{
	# извеждаме формата 
//	$smarty->assign("EDIT", $deleadva);
//	$smarty->assign("FILIST", $filist);
//	$smarty->assign("TYPETEXT", $typetext);
//	$smarty->assign("TEXT", $text);
//			$smarty->assign("CASECOUN", $casecoun);
//	$smarty->assign("ISCLAIMER", $isclaimer);
	print smdisp($tpname,"iconv");
//	$pagecont= smdisp($tpname,"iconv");
}


?>
