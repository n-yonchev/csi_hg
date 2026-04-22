<?php
# корекция съдържанието на файл за изх.шаблон 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $htmlname - името на файла заедно с пътя [outgoing/] 
//print "correction [$mode][$edit][$page]";

# таблицата 
$taname= "docutype";
# шаблона 
$tpname= "outtemhtml.ajax.tpl";
# полетата 
$filist= array(
	"htmlcont"=>  array("validator"=>"notempty", "error"=>"празно съдържание")
);
# константни полета 
//$ficonst= array("iduser"=>$iduser);
$ficonst= array();
# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page);
$relurl= geturl("mode=".$mode);


#----------------- директно редактиране -----------------------

									# класа за редактиране 
									# само заради функцията doerrors 
									include_once "edit.class.php";
									
				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
//var_dump($mfacproc);
//print_r($_POST);

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	$ficont= file_get_contents($htmlname);
	$_POST["htmlcont"]= $ficont;

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
/*
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
							#---- полета с автоматично съдържание 
*/
		# записваме новото съдържание на файла с шаблона 
//		$DB->query("update $taname set ?a where id=?d" ,$aset,$edit);
		file_put_contents($htmlname,$_POST["htmlcont"]);
//											# край - според дали има грешка 
//											}

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
//	$smarty->assign("FLAGCLON", $FLAGCLON);
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


?>