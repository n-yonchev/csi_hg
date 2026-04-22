<?php
# изтриване на финансово постъпление 
# източник : 
#      cazodele.ajax.php - изтриване на елемент от предмета 
# отгоре : 
#    $finadele - dinance.id за изтриване 
# още отгоре : 
#    $taname - таблицата 
#    $redilink - линк за redirect 
//print_r($GETPARAM);
//print_r($_POST);

# таблицата 
$taname= "finance";
# шаблона 
$tpname= "cazofinadele.ajax.tpl";
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
									# $finadele - $taname.id - id на постъплението 
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	# данните за реда 
	$rocont= getrow($taname,$finadele);

#------ submit без формални грешки 
# потвърдено изтриване 
}elseif ($mfacproc=="submyes"){
							$retucode= 0;
										# ВНИМАНИЕ. 17.02.2010 - ограничаваме корекциите на банкови постъпления 
										# забранено е изтриването на банк.постъпление 
					# данните за реда 
					$rocont= getrow($taname,$finadele);
					# 19.09.2012 - Дервиш - забранено само за банк.постъпление, постъпило чрез електронно извлечение 
					$rosour= $DB->selectRow("select * from finasource where idfinance=?d"  ,$finadele);
//										if ($rocont["idtype"]==1){
										if ($rocont["idtype"]==1 and !empty($rosour)){
							$retucode= -2;
							$smarty->assign("NODELETE", true);
#---------------------------------------------------------------
# протоколираме опита за изтриване на банк.постъпление 
//# $finadele=finance.id $iduser=логнатия 
$delefinafile= "cache/DELEFINA.TXT";
$f1= fopen($delefinafile,"a");
		$rouser= getrow("user",$iduser);
	$usname= $rouser["name"];
		$rocase= getrow("suit",$rocont["idcase"]);
	$casecode= $rocase["serial"]."/".$rocase["year"];
	$protcont= date("d.m.Y H:i:s")." [".$finadele."] =".$rocont["inco"]
		." [".$iduser."] ".$usname." [".$rocont["idcase"]."] ".$casecode."\r\n";
fwrite($f1,$protcont);
fclose($f1);
#---------------------------------------------------------------
										}else{
	$DB->query("delete from $taname where id=?" ,$finadele);
										}

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
							#---- януари-2010 актуален дълг ----
//	$redilink= array("tpaymlink");
							$redilink= array("tpaymlink","tactulink");
	$smarty->assign("EXITCODE", getnyroexit($redilink));
	print smdisp($tpname,"iconv");
}else{
	# извеждаме формата 
//	$smarty->assign("TYPETEXT", $typetext);
	$smarty->assign("DATA", $rocont);
//	$smarty->assign("CASECOUN", $casecoun);
//	$smarty->assign("ISCLAIMER", $isclaimer);
	print smdisp($tpname,"iconv");
//	$pagecont= smdisp($tpname,"iconv");
}


?>
