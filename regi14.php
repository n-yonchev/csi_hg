<?php
# отгоре : 
#    $reg4finame= "regi14.txt" - файл с параметри 
#    $reg4delimi= "^" - разделител 
//$reg4finame= "regi14.txt";
//$reg4delimi= "^";


# полетата 
$filist= array(
	"regi14user"=> array("validator"=>"notempty", "error"=>"задължително съдържание")
	,"regi14pass"=> array("validator"=>"notempty", "error"=>"задължително съдържание")
);
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

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
/***
	$_POST["regi14user"]= "";
	$_POST["regi14pass"]= "";
	if (file_exists($reg4finame)){
		$pacont= file_get_contents($reg4finame);
		$crcont= mycrypt("get",$pacont);
		list($_POST["regi14user"],$_POST["regi14pass"])= explode($reg4delimi,$crcont);
	}else{
	}
***/
	list($_POST["regi14user"],$_POST["regi14pass"])= reg4getpara();

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
	$mycont= trim($_POST["regi14user"]) .$reg4delimi .trim($_POST["regi14pass"]);
	$crcont= mycrypt("put",$mycont);
	$resu= file_put_contents($reg4finame,$crcont);
	if ($resu===false){
die("regi14=put");
	}else{
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
	$smarty->assign("OK", true);
}else{
}

//	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
$pagecont= smdisp("regi14.tpl","fetch");


?>