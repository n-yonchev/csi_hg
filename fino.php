<?php
# търсене на дело по номер - филтъра и списъка заедно 
#    вика се в основния прозорец, а не в ajax 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
//print_r($GETPARAM);

									# извеждане списък по въведен номер 
									$seeknome= $GETPARAM["seeknome"];
									if (isset($seeknome)){
										include_once "finolist.php";
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

//print_r($_POST);
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;

#------ submit без формални грешки 
//}elseif ($mfacproc=="submit"){
}elseif ($mfacproc=="submit"){
							$retucode= 0;
	$textnome= $_POST["textnome"];
//var_dump($textnome);
											# проверка за грешки 
											$lister= array();
							list($myseri,$myyear)= explode("/",$textnome);
							if (empty($myyear)){
								$mylist= $DB->select("select * from suit where serial=?" ,$myseri);
								if (count($mylist)==0){
											$lister["textnome"]= "липсва дело с този номер";
								}else{
								}
							}else{
											# 16.04.2009 - съкратен номер на годината 
											if (substr($myyear,0,2)=="20"){
											}else{
												$myyear= "20".$myyear;
											}
								$mylist= $DB->select("select id from suit where serial=? and year=?" ,$myseri,$myyear);
								if (count($mylist)==0){
											$lister["textnome"]= "липсва такова дело/година";
								}else{
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
	#---- 30.09.2009 Т.Софрониев -------------------------------------------
	# идва от диалога "номер дело от-до +enter" - виж main.tpl 
	# източник : case.php 
							//$retucode= 0;
			$textnome= $_POST["textnome"];
/*
	if (empty($textnome)){
					$myseri= "1";
	}else{
				# формираме филтъра за заявката 
				list($ser1,$ser2)= explode("-",$textnome);
				$ser1= $ser1 +0;
				$ser2= $ser2 +0;
				$ser2= ($ser2==0) ? $ser1 : $ser2;
					$myseri= "serial>=$ser1 and serial<=$ser2";
	}
			$mylist= $DB->select("select * from suit where ?s order by year desc, serial desc" ,$myseri);
			print "select * from suit where $myseri order by year desc, serial desc";
print_r($mylist);
*/
	if (empty($textnome)){
	}else{
# redirect 
$relurl= geturl("mode=".$mode."&seeknome=".$textnome);
reload("",$relurl);
return;
	}
			
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
														if (count($mylist)==1){
					#------ директно на единственото дело -----------------------
/*
									# глобален флаг - не са разрешени корекции в делото 
									$FLAGNOCHANGE= true;
									$smarty->assign("FLAGNOCHANGE", true);
*/
					# делото 
					$edit= $mylist[0]["id"];
				# case.id за корекция 
				$GETPARAM["edit"]= $edit;
												# глобален флаг - не са разрешени корекции в делото 
												# но само ако не е на логнатия 
											/*
												$roca= getrow("suit",$edit);
												$FLAGNOCHANGE= ($roca["iduser"]<>$iduser);
												$smarty->assign("FLAGNOCHANGE", $FLAGNOCHANGE);
											*/
												$FLAGNOCHANGE= getnochange($edit);
												# да не се извежда таба с делата 
												$smarty->assign("FLAGNOTABS", true);
					# скрипта за корекция/разглеждане 
					include_once "caseedit.php";
	$pagecont= smdisp("caseedit.tpl","fetch");
//return;
														}else{
					#------ извеждаме списъка дела с номер $myseri - вече се съдържа в масива $mylist --------------------
	# redirect 
	$relurl= geturl("mode=".$mode."&seeknome=".$myseri);
	reload("",$relurl);
														}
}else{
	# извеждаме формата с филтъра 
	$smarty->assign("FILIST", $filist);
	$pagecont= smdisp("finoform.tpl","fetch");
}


?>