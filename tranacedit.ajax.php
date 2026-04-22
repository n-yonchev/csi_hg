<?php
# отгоре : 
#    $mode - текущия режим 
#    $edit - user.id за корекция 
# $relurl - линк след събмит 
//print "correction [$mode][$edit]";

# параметри 
$taname= "tranacco";
$tpname= "tranacedit.ajax.tpl";
# полетата 
$filist= array(
	"iban"=>  array("validator"=>"notempty", "error"=>"сметката не може да е празна")
//	,"bic"=>  array("validator"=>"notempty", "error"=>"кода е задължително поле")
//	,"bic"=>  NULL
	,"bic"=>  array("validator"=>"notempty", "error"=>"кода не може да е празен")
	,"code"=>  array("validator"=>"notempty", "error"=>"типа е задължително поле")
	,"desc"=>  array("validator"=>"notempty", "error"=>"описанието не може да е празно")
);
# константни полета 
$ficonst= array();
/*
# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page);
$relurl= geturl("mode=".$mode);
*/
	
									# класа за редактиране 
									include_once "edit.class.php";

#----------------- директно редактиране -----------------------
				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	if ($edit==0){
	}else{
		$rocont= $DB->selectRow("select * from $taname where id=?" ,$edit);
		foreach($filist as $finame=>$ficont){
				$_POST[$finame]= $rocont[$finame];
		}
	}

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
											# проверяваме за допълнителни грешки 
											$lister= array();
		$ibanslen= 22;
								$iban= $_POST["iban"];
								$slen= strlen($iban);
								if ($slen==$ibanslen){
								}else{
														$lister["iban"]= "съдържа $slen символа. трябва да са $ibanslen";
								}
		$biccslen= 8;
								$bicc= $_POST["bic"];
								$slen= strlen($bicc);
								if ($slen==$biccslen){
								}else{
														$lister["bic"]= "съдържа $slen вместо $biccslen символа";
								}
								$code= $_POST["code"];
								if ($code=="t26" or $code=="nop"){
									$coun= $DB->selectCell("select count(*) from $taname where code=? and id<>?d" ,$code,$edit);
									if ($coun<1){
									}else{
														$lister["code"]= "може да има само 1 сметка ".$araccotype[$code];
									}
								}else{
								}
								$datacode= $DB->selectCell("select code from $taname where iban=? and id<>?d" ,$iban,$edit);
								if (empty($datacode)){
								}else{
									if ($code=="t26" and $datacode=="nop" or $code=="nop" and $datacode=="t26"){
									}else{
														$lister["iban"]= "тази сметка вече е ".$araccotype[$datacode];
									}
								}
											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
												#---- няма ---- 
							$retucode= 0;
		$aset= array();
		foreach($filist as $finame=>$ficont){
				$aset[$finame]= $_POST[$finame];
		}
#------------------------------------------------------------------------------
# 11.09.2017 ВАЖНА КОРЕКЦИЯ 
# кодове за полето tranacco.codeclai - индекс за псевдовзискател 
		$aset["codeclai"]= $araccocode[$pc=$_POST["code"]] +0;
#------------------------------------------------------------------------------
							#---- полета с автоматично съдържание 
	# добавяне/корекция 
	if ($edit==0){
		# нов запис 
		$edit= $DB->query("insert into $taname set ?a" ,$aset);
	}else{
		# корекция на записа 
		$DB->query("update $taname set ?a where id=?d" ,$aset,$edit);
	}
											# край - според дали има грешка 
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
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


?>