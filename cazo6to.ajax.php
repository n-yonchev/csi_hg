<?php
# 04.08.2010 - смяна на делото за документа [Бургас] 
# отгоре : 
#    $zone= 6 
#    $func= view 
#  $tocase= docuout.id - за кой изх.документ се еменя делото 
//print_r($GETPARAM);
//print_rr($_POST);
//print "tocase=[$tocase]";

# таблицата 
$taname= "docuout";
# шаблона 
$tpname= "cazo6to.ajax.tpl";
# полетата 
$filist= array(
	"idcase"=> array("validator"=>"caseexi", "error"=>"несъществуващо дело", "transformer"=>"getputcase")
	,"date"=> array("validator"=>"bgdate_valid_notempty")
	,"adresat"=>  array("validator"=>"notempty", "error"=>"адресата е задължителен")
	,"iddocutype"=> NULL
);
//# константни полета 
//$ficonst= array();

									# класа за редактиране 
									include_once "edit.class.php";

#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
									# основен параметър - 
									# $tocase - socuout.id 
# данните за изх.документ 
$rocont= getrow($taname,$tocase);
$rotype= getrow("docutype",$rocont["iddocutype"]);
$smarty->assign("DOCUTYPE", $rotype["text"]);
	$docuseri= $rocont["serial"];
	$docuyear= $rocont["year"];
	if (empty($docuseri) and empty($docuyear)){
	}else{
$smarty->assign("DOCUSERI", $docuseri);
$smarty->assign("DOCUYEAR", $docuyear);
	}

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
//	$smarty->assign("FILENAME", $rocont["filename"]);
	$_POST["date"]= bgdatefrom(substr($rocont["created"],0,10));
	$_POST["adresat"]= arstrip(toutf8($rocont["adresat"]));
	$_POST["iddocutype"]= $rocont["iddocutype"];

#------ submit без формални грешки 
# въведено новото дело 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
											# проверяваме за допълнителни грешки 
											$lister= array();
	$idcase= $_POST["idcase"];
	if (empty($idcase)){
											$lister["idcase"]= "няма въведено дело";
	}else{
	}
											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
		# определяме назначеното дело 
		# имитация на idcase-put-transformer 
		$idcase= call_user_func($filist["idcase"]["transformer"],"put",$tocase,"idcase",$_POST);
		# няма грешка, сменяме делото 
		$DB->query("update $taname set idcase=?d where id=?d"  ,$idcase,$tocase);
											}
#------ submit без формални грешки 
# изтриване на документа 
}elseif ($mfacproc=="delete"){
							$retucode= 0;
		$DB->query("delete from $taname where id=?d"  ,$tocase);

#------ submit без формални грешки 
# корегирана дата 
}elseif ($mfacproc=="subm2"){
							$retucode= 0;
		$date= bgdateto($_POST["date"]);
//		$DB->query("update $taname set created=?, registered=? where id=?d"  ,$date,$date,$tocase);
			$dset= array();
			$dset["created"]= $date;
			$dset["registered"]= $date;
			$dset["adresat"]= $_POST["adresat"];
			$dset["iddocutype"]= $_POST["iddocutype"];
		$DB->query("update $taname set ?a where id=?d"  ,$dset,$tocase);

#------ submit с формални грешки 
# - невъзможно в случая 
}elseif ($mfacproc==NULL){
	# стандартна реакция 
							$retucode= 1;
	doerrors();

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
//	reload("parent",$relurl);
	$smarty->assign("EXITCODE", getnyroexit("t6link"));
	print smdisp($tpname,"iconv");
}else{
	# извеждаме формата 
								$textcode= "if(substring(filename,-5)='.html',text,concat('^^^',text))";
						$ardocutype= getselect("docutype",$textcode,"ishidden=0",true);
													$ardo2= array();
								foreach($ardocutype as $indx=>$cont){
									if (substr($cont,0,3)=="^^^"){
//										$ardocutype[$indx]= "<font color=blue>".substr($cont,3)."</font>";
//										$ardocutype[$indx]= "<span style='background-color:blue'>".substr($cont,3)."</span>";
										$ardocutype[$indx]= substr($cont,3);
													$ardo2[$indx]= true;
									}else{
									}
								}
								$smarty->assign("ARDOCUTYPE", tran1251($ardocutype));
													$smarty->assign("ARDOWORD", $ardo2);
//	$smarty->assign("EDIT", $idel);
	$smarty->assign("FILIST", $filist);
//	$smarty->assign("ISCLAIMER", $isclaimer);
	print smdisp($tpname,"iconv");
//	$pagecont= smdisp($tpname,"iconv");
}


?>
