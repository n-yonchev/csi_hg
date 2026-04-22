<?php
# маркиране на разпределение като преведено 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $page - текущата страница 
# още отгоре : 
#    $mark - finatran.id за маркиране 
//print_r($GETPARAM);

# таблицата 
$taname= "finatran";
# шаблона 
$tpname= "finasumamark.ajax.tpl";
# полетата 
$filist= array();
# константни полета 
$ficonst= array();
# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page."&filt=".$filt);
$relurl= geturl("mode=".$mode."&page=".$page);

									# класа за редактиране 
									include_once "edit.class.php";

#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
									# основен параметър - 
									# $mark - $taname.id - id нза маркиране 
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	//# данните за реда 
	//$rocont= getrow($taname,$mark);
	//$text= $rocont["text"];

#------ submit без формални грешки 
# потвърдено изтриване 
}elseif ($mfacproc=="submyes"){
							$retucode= 0;
	$DB->query("update $taname set isdone=1 where id=?" ,$mark);

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
	reload("parent",$relurl);
}else{
				
				#---- заглавни данни ----
				# данни за разпределението 
					$rotran= getrow($taname,$mark);
//				$smarty->assign("SUMA", $rotran["amount"]);
				$smarty->assign("ROTRAN", $rotran);
					# взискателя 
					$roclai= getrow("claimer",$rotran["idclaimer"]);
//print_rr($roclai);
												$idclaimer= $rotran["idclaimer"];
															include_once "fina.inc.php";
							# псевдо взискатели 
							if ($idclaimer<0){
				$smarty->assign("CLAINAME", $pseuclainame[$idclaimer]);
							}else{
				$smarty->assign("CLAINAME", $roclai["name"]);
							}
					# делото 
					$rofina= getrow("finance",$rotran["idfinance"]);
					$rocase= getrow("suit",$rofina["idcase"]);
				$smarty->assign("SUIT", $rocase["serial"]."/".$rocase["year"]);
					# деловодителя
					$rouser= getrow("user",$rocase["iduser"]);
				$smarty->assign("USERNAME", $rouser["name"]);
	# извеждаме формата 
	$smarty->assign("EDIT", $mark);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


?>
