<?php
# 06.05.2009 - РКО - ръчно добавяне/корекция на записи 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
# $relurl - след успешен събмит 
//#    $page - текущата страница от списъка 
//#    $edit - jour.id за корекция 
//print_r($GETPARAM);


# таблицата 
$taname= "razh";
# шаблона 
$tpname= "razhedit.ajax.tpl";
# полетата 
$filist= array(
	"amount"=> array("validator"=>"amount_not_zero", "error"=>"грешна сума")
	,"cashdate"=> array("validator"=>"bgdate_valid_notempty", "error"=>"грешна дата")
	,"cashname"=> array("validator"=>"notempty", "error"=>"името е задължително")
	,"descrip"=> NULL
	,"address"=> NULL
	,"pass"=> NULL
	,"repres"=> NULL
	,"letter"=> NULL
	,"cashier"=> array("validator"=>"notempty", "error"=>"името е задължително")
);
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

# записа 
$rocont= $DB->selectRow("select * from $taname where id=?" ,$edit);
$razhnumb= $rocont["cashserial"]."/".$rocont["cashyear"];
$smarty->assign("RAZHNUMB", $razhnumb);

									# основен входен параметър - 
									# $edit - $taname.id  
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	if ($edit==0){
		$_POST["cashdate"]= date("d.m.Y");
		# касиера 
		$cashier= $DB->selectCell("select name from user where id=?" ,$_SESSION["iduser"]);
		$_POST["cashier"]= $cashier;
	}else{
//		$rocont= $DB->selectRow("select * from $taname where id=?" ,$edit);
		foreach($filist as $finame=>$ficont){
			$_POST[$finame]= $rocont[$finame];
		}
		$_POST["cashdate"]= bgdatefrom($_POST["cashdate"]);
		# трансформираме заради номера на делото 
		$idca= $rocont["idcase"];
		if ($idca==0){
			$_POST["casenumb"]= "";
		}else{
			$roca= getrow("suit",$idca);
			$_POST["casenumb"]= $roca["serial"]."/".$roca["year"];
		}
	}

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
													# заключваме 
													$DB->query("lock tables $taname write, suit write");
											# проверяваме за допълнителни грешки 
											$lister= array();
	# съществува ли делото 
	$casenumb= $_POST["casenumb"];
	list($serial,$year)= explode("/",$casenumb);
	if (empty($casenumb)){
	}else{
		if (substr($year,0,2)=="20"){
		}else{
			$year= "20".$year;
		}
		$myli= $DB->select("select id from suit where serial=?d and year=?d" ,$serial,$year);
		if (count($myli)==0){
											$lister["casenumb"]= "несъществуващо дело";
		}else{
		}
	}
			# правилната година 
			if ($edit==0){
				$yearcont= date("Y") +0;
			}else{
				$yearcont= $rocont["cashyear"] +0;
			}
				$bgdate= bgdateto($_POST["cashdate"]);
			$yeardate= substr($bgdate,0,4) +0;
			if ($yearcont==$yeardate){
			}else{
											$lister["cashdate"]= "датата трябва да е през $yearcont год.";
			}
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
	$aset["cashdate"]= bgdateto($_POST["cashdate"]);
		if (empty($casenumb)){
		}else{
	$aset["idcase"]= $myli[0]["id"];
		}
	if ($edit==0){
				$nextcash= getnextcashrazh();
			$aset["cashserial"]= $nextcash;
				$curryear= (int) date("Y");					
			$aset["cashyear"]= $curryear;
		$edit= $DB->query("insert into $taname set ?a" ,$aset);
	}else{
		$DB->query("update $taname set ?a where id=?d" ,$aset,$edit);
	}
											# край - според дали има грешка 
											}
													# отключваме 
													$DB->query("unlock tables");

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
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


?>