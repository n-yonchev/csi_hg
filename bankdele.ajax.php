<?php
# изтриване на банка 
# отгоре : 
#    $dele - id за изтриване 
//print_r($GETPARAM);

# таблицата 
$taname= "banklist";
# шаблона 
$tpname= "bankdele.ajax.tpl";
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
	$relurl= geturl("mode=".$mode);
	reload("parent",$relurl);
}else{
	# извеждаме формата 
	$smarty->assign("NAME", $name);
	print smdisp($tpname,"iconv");
}


?>
