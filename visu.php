<?php
# избор на оформление - skin - css 

# списъка 
$fnam= "css";
$dire= dir($fnam);
//echo "Handle: " . $d->handle . "\n";
//echo "Path: " . $d->path . "\n";
					$listvisu= array();
while (false !== ($entry = $dire->read())) {
	if (is_dir($fnam."/".$entry)){
	}else{
		if (substr($entry,-4)==".css"){
					$listvisu[$entry]= $entry;
		}else{
		}
	}
}
$dire->close();

//print_r($_SESSION);
//print_r($_POST);
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
	$_POST["viname"]= $_SESSION["visuname"];

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
//	$_SESSION["visuname"]= $_POST["viname"];

#------ submit с формални грешки 
}elseif ($mfacproc==NULL){
							$retucode= 1;

#------ автоматичен submit -----------------------------------------------------
}elseif ($mfacproc=="UNKNOWN"){
							$retucode= 2;
//	$_SESSION["visuname"]= $_POST["viname"];

#------ невъзможна грешка от библиотеката 
}else{
print "<br>error=mfacproc=";
var_dump($mfacproc);
die();
}

# прилагаме веднага избраното оформлание 
$_SESSION["visuname"]= $_POST["viname"];
$smarty->assign("VISUNAME", $_SESSION["visuname"]);

	
		# предаваме името, а не съдържанието на масива 
		$smarty->assign("LISTVISUNAME", "listvisu");

# извеждаме 
//$smarty->assign("ADDNEW", $addnew);
//$smarty->assign("LIST", $listvisu);
$pagecont= smdisp("visu.tpl","fetch");

?>