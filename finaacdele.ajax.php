<?php
# изтриване сметка на взискател 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $page - текущата страница 
#    $filt - текущия филтър 
# $dele - claim2iban.id за изтриване 
//# отгоре - параметри : 
//#    $TABLNAME, $HEADMAIN, $HEADEDIT 
//print_r($GETPARAM);

# таблицата 
$taname= "claim2iban";
# шаблона 
$tpname= "finaacdele.ajax.tpl";
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
									# основен параметър - $dele 
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	# данните за реда 
	$rocont= getrow($taname,$dele);
	$name= $rocont["name"];

#------ submit без формални грешки 
# потвърдено изтриване 
}elseif ($mfacproc=="submyes"){
							$retucode= 0;
	$DB->query("delete from $taname where id=?" ,$dele);

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
	$relurl= geturl("mode=".$mode ."&page=".$page ."&filt=".$filt);
	reload("parent",$relurl);
}else{
				# данни за взискателя 
				$roiban= getrow($taname,$dele);
				$roc2= getrow("claim2",$roiban["idclaim2"]);
				$smarty->assign("NAME", $roc2["name"]);
	# извеждаме формата 
	$smarty->assign("ROCONT", $rocont);
	print smdisp($tpname,"iconv");
}


?>
