<?php
#------------------ ЛЕПЕНКА ЗА АДМИНА -----------------------
# само за новите документи и насочените към дела за 2009 год. 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $edit - docu.id за корекция 
# $caseyear= "2009" - година за филтъра на делата 


# шаблона 
$tpname= "docu09edit.ajax.tpl";
# полетата 
$filist= array(
	"caseserial"=>  array("validator"=>"integer", "error"=>"грешен номер дело")
);
# reload - след успешен събмит 
$relurl= geturl("mode=".$mode."&page=".$page);


#----------------- директно редактиране -----------------------

									# класа за редактиране 
									# само заради функцията doerrors 
									include_once "edit.class.php";

# четем документа 
$rodocu= getrow("docu",$edit);
$idcase= $rodocu["idcase"];
# четем и свързаното дело 
$rocase= getrow("suit",$idcase);
$caseserial= $rocase["serial"];
									
				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	if ($idcase==-1){
				#---- документ за ново дело 
				$_POST["caseserial"]= "";
	}else{
				#---- документ за съществуващо дело 
				$_POST["caseserial"]= $caseserial;
	}

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
	$caseserial= $_POST["caseserial"];
											# проверяваме за допълнителни грешки 
											$lister= array();
	if ($idcase==-1){
				#---- документ за ново дело 
				$mycali= $DB->select("select * from suit where serial=? and year=?" ,$caseserial,$caseyear);
				$cocali= count($mycali);
				if ($cocali==0){
					# все още няма дело с този номер/година 
					# създаваме го и насочваме документа към него 
#-----------------------------------------------------------------------------
																$DB->query("lock tables docu write, suit write");
	$aset= array();
	$aset["serial"]= $caseserial;
	$aset["year"]= $caseyear;
$idcasenew= $DB->query("insert into suit set ?a ,created=now() ,lastdocu=now(),last2=0" ,$aset);
	$aset= array();
	$aset["idcase"]= $idcasenew;
$DB->query("update docu set ?a where id=?" ,$aset,$edit);
																$DB->query("unlock tables");
#-----------------------------------------------------------------------------
				}else{
					# вече има дело с този номер/година 
											$lister["caseserial"]= "това дело вече съществува";
				}

	}else{
				#---- документ за съществуващо дело 
				# корегираме директно поредния номер на делото 
#-----------------------------------------------------------------------------
	$aset= array();
	$aset["serial"]= $caseserial;
$DB->query("update suit set ?a where id=?" ,$aset,$idcase);
#-----------------------------------------------------------------------------
	}
											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
												#---- няма ---- 
							$retucode= 0;
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
	reload("parent",$relurl);
}else{
	# извеждаме формата 
$smarty->assign("NEWCASE", ($idcase==-1));
$smarty->assign("CASEYEAR", $caseyear);
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


?>
