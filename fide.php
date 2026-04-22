<?php
# търсене на дело по длъжник - филтъра и списъка заедно 
#    вика се в основния прозорец, а не в ajax 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 


									# извеждане списък по въведен филтър 
									$seek= $GETPARAM["seek"];
//var_dump($seek);
									if (isset($seek)){
										include_once "fidelist.php";
# ВНИМАНИЕ. 
# exit - излиза въобще от index.php 
return;
									}else{
									}
									
//# таблицата 
//$taname= "office";
//# шаблона 
//$tpname= "base.tpl";
# полетата 
$filist= array(
	"textdebt"=>       array("validator"=>"notempty", "error"=>"задължително съдържание")
);
# константни полета 
//$ficonst= array("iduser"=>$iduser);
$ficonst= array();
//# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode);


									# класа за редактиране 
									include_once "edit.class.php";
#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";

									//# основен входен параметър - 
									//# $edit - $taname.id  

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
	$textdebt= $_POST["textdebt"];
//var_dump($textdebt);
/*
	if (empty($textdebt)){
# ВНИМАНИЕ. 
# Не възниква формална грешка от FormPersister. ЗАЩО ? 
		# извеждаме отново формата с филтъра 
		$smarty->assign("FILIST", $filist);
		$pagecont= smdisp("fideform.tpl","fetch");
	}else{
		# redirect 
		$relurl= geturl("mode=".$mode."&seek=".$textdebt);
		reload("",$relurl);
	}
*/

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
	$relurl= geturl("mode=".$mode."&seek=".$textdebt);
	reload("",$relurl);
}else{
	# извеждаме формата с филтъра 
	$smarty->assign("FILIST", $filist);
	$pagecont= smdisp("fideform.tpl","fetch");
}


?>