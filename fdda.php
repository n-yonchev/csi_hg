<?php
# търсене на вх.документ по дата/период - избора и списъка заедно 
#    вика се в основния прозорец, а не в ajax 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 


									# извеждане списък по въведен филтър 
									$view= $GETPARAM["view"];
									if (isset($view)){
										list($d1cano,$d2cano)= explode("^",$view);
											list($ye,$mo,$da)= explode("-",$d1cano);
											$d1bg= "$da.$mo.$ye";
											list($ye,$mo,$da)= explode("-",$d2cano);
											$d2bg= "$da.$mo.$ye";
										if (empty($d2cano)){
# филтъра 
$filter= "date(docu.created)='$d1cano'";
$smarty->assign("FILTTX", "създадени на $d1bg");
										}else{
# филтъра 
$filter= "date(docu.created)>='$d1cano' and date(docu.created)<='$d2cano'";
$smarty->assign("FILTTX", "създадени от $d1bg до $d2bg");
										}
										include_once "fdxxlist.php";
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
	"date1"=> array("validator"=>"bgdate_valid_notempty")
	,"date2"=> array("validator"=>"bgdate_valid")
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
	$date1= $_POST["date1"];
		list($da,$mo,$ye)= explode(".",$date1);
		$da= str_pad($da,2,"0",STR_PAD_LEFT);
		$mo= str_pad($mo,2,"0",STR_PAD_LEFT);
		$d1cano= "$ye-$mo-$da";
	$date2= $_POST["date2"];
				if (empty($date2)){
		$d2cano= "";
				}else{
		list($da,$mo,$ye)= explode(".",$date2);
		$da= str_pad($da,2,"0",STR_PAD_LEFT);
		$mo= str_pad($mo,2,"0",STR_PAD_LEFT);
		$d2cano= "$ye-$mo-$da";
											# проверка за грешки 
											$lister= array();
					if ($d1cano <= $d2cano){
					}else{
											$lister["date1"]= "грешен период";
											$lister["date2"]= "грешен период";
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
					if (empty($d2cano)){
						$view= $d1cano;
					}else{
						$view= "$d1cano^$d2cano";
					}
	$relurl= geturl("mode=".$mode."&view=".$view);
	reload("",$relurl);
}else{
	# извеждаме формата с филтъра 
	$smarty->assign("FILIST", $filist);
	$pagecont= smdisp("fddaform.tpl","fetch");
}


?>