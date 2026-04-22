<?php
# отгоре : 
#    $iduser - логнатия потребител 
#    $edit= case.id за модифициране 
#    $zone= 3 
#    $func= modi 
# входни параметри 
# $idel - id на събитието 
$idel= $GETPARAM["idel"];
//print "correction [$edit][$zone][$func]idel=[$idel]";

# таблицата 
$taname= "suitevent";
# шаблона 
$tpname= "cazoevenmodi.ajax.tpl";
//# текст за типа участник 
//$typetext= "ВЗИСКАТЕЛ";
# линк за redirect 
$redilink= array("tevenlink");
//# флаг дали е взискател 
//$isclaimer= true;






						# евентуално изтриване 
						$delrec= $GETPARAM["delrec"];
						if (isset($delrec)){
							include_once "cazoevendele.ajax.php";
exit;
						}else{
						}

# полетата 
$filist= array(
	"date"=>  array("validator"=>"bgdate_valid_notempty", "error"=>"грешна дата")
	,"text"=>  array("validator"=>"notempty", "error"=>"описанието е задължително")
);
# константни полета 
$ficonst= array("idcase"=>$edit);


									# класа за редактиране 
									include_once "edit.class.php";

#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
//var_dump($mfacproc);
//var_dump($mfac->metaForm->MF_POST["submit2"]);
//$sub2= $mfac->metaForm->MF_POST["submit2"];

									# основен входен параметър - 
									# $edit - $idel - id на събитието 
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	if ($idel==0){
							#---- полета с автоматично съдържание 
	}else{
		$rocont= $DB->selectRow("select * from $taname where id=?" ,$idel);
		foreach($filist as $finame=>$ficont){
			$_POST[$finame]= $rocont[$finame];
		}
		# датата 
		$_POST["date"]= bgdatefrom($rocont["date"]);
							#---- полета с автоматично съдържание 
	}

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
											# проверяваме за допълнителни грешки 
											$lister= array();
											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
												#---- няма ---- 
							$retucode= 0;
		$aset= $ficonst;
		foreach($filist as $finame=>$ficont){
			$aset[$finame]= $_POST[$finame];
		}
		# датата 
		$aset["date"]= bgdateto($_POST["date"]);
	if ($idel==0){
							#---- полета с автоматично съдържание 
		# нов запис 
		$idel= $DB->query("insert into $taname set ?a" ,$aset);
	}else{
							#---- полета с автоматично съдържание 
		# корекция на записа 
		$DB->query("update $taname set ?a where id=?d" ,$aset,$idel);
	}
											# край - според дали има грешка 
											}

#------ submit с формални грешки 
}elseif ($mfacproc==NULL){
	# стандартна реакция 
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
//	reload("parent",$relurl);
	$smarty->assign("EXITCODE", getnyroexit($redilink));
	print smdisp($tpname,"iconv");
}else{

	# извеждаме формата 
	$smarty->assign("EDIT", $idel);
	$smarty->assign("FILIST", $filist);
//	$smarty->assign("TYPETEXT", $typetext);
//	$smarty->assign("ISCLAIMER", $isclaimer);
	print smdisp($tpname,"iconv");
//	$pagecont= smdisp($tpname,"iconv");
}







?>