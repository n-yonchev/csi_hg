<?php
# търсене на вх.документ по номер - избора и списъка заедно 
#    вика се в основния прозорец, а не в ajax 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
//print "FDNO=";
//print_r($GETPARAM);

									# извеждане списък по въведен номер 
									$view= $GETPARAM["view"];
									if (isset($view)){
										list($myseri,$myyear)= explode("/",$view);
										if (empty($myyear)){
$filter= "serial=$myseri";
$smarty->assign("FILTTX", "с номер $myseri");
										}else{
$filter= "serial=$myseri and year=$myyear";
$smarty->assign("FILTTX", "$myseri/$myyear");
										}

										include_once "fdxxlist.php";
# ВНИМАНИЕ. 
# exit - излиза въобще от index.php 
return;
									}else{
									}
									
# полетата 
$filist= array(
	"textnome"=> array("validator"=>"notempty", "error"=>"задължително съдържание")
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
	$textnome= $_POST["textnome"];
//var_dump($textnome);
											# проверка за грешки 
											$lister= array();
							list($myseri,$myyear)= explode("/",$textnome);
							if (empty($myyear)){
								$mylist= $DB->select("select * from docu where serial=?" ,$myseri);
								if (count($mylist)==0){
											$lister["textnome"]= "липсва вх.докум. с този номер";
								}else{
																	$seeknome= $myseri;
								}
							}else{
											# 16.04.2009 - съкратен номер на годината 
											if (substr($myyear,0,2)=="20"){
											}else{
												$myyear= "20".$myyear;
											}
								$mylist= $DB->select("select id from docu where serial=? and year=?" ,$myseri,$myyear);
								if (count($mylist)==0){
											$lister["textnome"]= "липсва такъв документ/година";
								}else{
																	$seeknome= "$myseri/$myyear";
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
//	# redirect 
//	$relurl= geturl("mode=".$mode."&seek=".$textdebt);
//	reload("",$relurl);
					//include_once "finolist.php";
	# redirect 
	$relurl= geturl("mode=".$mode."&view=".$seeknome);
	reload("",$relurl);
}else{
	# извеждаме формата с филтъра 
	$smarty->assign("FILIST", $filist);
	$pagecont= smdisp("fdnoform.tpl","fetch");
}


?>