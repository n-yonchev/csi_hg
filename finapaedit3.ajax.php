<?php
# корекция на сметка за избрано разпределение 
# вариант 3 - нова сметка и нов собственик 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $page - текущата страница от списъка пакети 
#    $acco = finapack.id за избрания пакет 
# $edit = finatran.id за избраното разпределение 
//print "correction [$mode][$edit]";
//print_r($GETPARAM);

# таблицата 
$taname= "finatran";
# шаблона 
$tpname= "finapaedit3.ajax.tpl";
/*
# reload - след успешен събмит 
$relurl= geturl("mode=".$mode."&page=".$page."&acco=".$acco);
*/
# полетата 
$filist= array(
	"c2name"=>  array("validator"=>"notempty", "error"=>"името не може да е празно")
	,"iban"=>  array("validator"=>"notempty", "error"=>"iban не може да е празен")
	,"bic"=>  NULL
	,"descrip"=>  NULL
);
# константни полета 
//$ficonst= array("iduser"=>$iduser);
$ficonst= array();

									# класа за редактиране 
									include_once "edit.class.php";

#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
//var_dump($mfacproc);
//print_rr($_POST);

									# основен входен параметър - 
									# $edit - $taname.id - за избраното разпределение 
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
											# проверяваме за допълнителни грешки 
											$lister= array();
	# дублиран собстветник 
	$c2name= $_POST["c2name"];
	$c2name= trim($c2name);
	$c2coun= $DB->selectCell("select count(*) from claim2 where name=?"  ,$c2name);
	if ($c2coun==0){
	}else{
											$lister["c2name"]= "този собственик вече съществува";
	}
	# дублиран iban 
	$iban= $_POST["iban"];
	$iban= trim($iban);
	$ibcoun= $DB->selectCell("select count(*) from claim2iban where iban=?"  ,$iban);
	if ($ibcoun==0){
	}else{
											$lister["iban"]= "този iban вече съществува";
	}
	# булстат и егн попълнени едновременно 
	$bulstat= $_POST["bulstat"];
	$bulstat= trim($bulstat);
	$egn= $_POST["egn"];
	$egn= trim($egn);
	if (!empty($bulstat) and !empty($egn)){
											$lister["bulstat"]= "въведи или булстат, или егн";
											$lister["egn"]= "въведи или булстат, или егн";
	}else{
	}
											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
												#---- няма ---- 
							$retucode= 0;
	# добавяме новия собственик 
		$aset= array();
		$aset["name"]= $_POST["c2name"];
		$aset["bulstat"]= $_POST["bulstat"];
		$aset["egn"]= $_POST["egn"];
				if (empty($bulstat)){
					if (empty($egn)){
		$aset["idtype"]= 3;
					}else{
		$aset["idtype"]= 2;
					}
				}else{
		$aset["idtype"]= 1;
				}
	$idclaim2= $DB->query("insert into claim2 set ?a"  ,$aset);
	# добавяме новата сметка 
		$aset= array();
		$aset["iban"]= $_POST["iban"];
		$aset["bic"]= $_POST["bic"];
		$aset["descrip"]= $_POST["descrip"];
		$aset["idclaim2"]= $idclaim2;
	$DB->query("insert into claim2iban set ?a"  ,$aset);
	# определяме новата сметка за превод на избраното разпределение 
		$aset= array();
		$aset["idclaim2"]= $idclaim2;
		$aset["iban"]= $_POST["iban"];
		$aset["bic"]= $_POST["bic"];
	$DB->query("update finatran set ?a where id=?d"  ,$aset,$edit);

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
//print_rr($_POST);
	reload("parent",$relurl);
}else{
	# извеждаме формата 
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
//	print smdisp($tpname,"iconv");
$formcont= smdisp($tpname,"fetch");
}


?>
