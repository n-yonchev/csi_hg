<?php
# отчет раздел 1 - избора и формирането заедно 
#    вика се в основния прозорец, а не в ajax 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
//print_r($GETPARAM);

									# формиране отчета за избран период 
									$period= $GETPARAM["period"];
									$create= $GETPARAM["create"];
									if (isset($period)){
										if (isset($create)){
		include_once "rep1crea.php";
# ВНИМАНИЕ. 
# exit - излиза въобще от index.php 
return;
										}else{
		include_once "rep1list.php";
# ВНИМАНИЕ. 
# exit - излиза въобще от index.php 
return;
										}
									}else{
									}
									
# полетата 
$filist= array(
	"period"=> array("validator"=>"notzero", "error"=>"периода е задължителен")
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
//print_r($_POST);

									//# основен входен параметър - 
									//# $edit - $taname.id  

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
/*
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
//var_dump($retucode);
//if ($retucode==0){
if ($retucode==0 or $retucode==2){
//	# redirect 
//	$relurl= geturl("mode=".$mode."&seek=".$textdebt);
//	reload("",$relurl);
					//include_once "finolist.php";
/*
														if (count($mylist)==1){
					#------ директно на единственото дело -----------------------
									# глобален флаг - не са разрешени корекции в делото 
									$FLAGNOCHANGE= true;
									$smarty->assign("FLAGNOCHANGE", true);
					# делото 
					$edit= $mylist[0]["id"];
				# case.id за корекция 
				$GETPARAM["edit"]= $edit;
					# скрипта за корекция/разглеждане 
					include_once "caseedit.php";
	$pagecont= smdisp("caseedit.tpl","fetch");
//return;
														}else{
					#------ извеждаме списъка дела с номер $myseri - вече се съдържа в масива $mylist --------------------
	# redirect 
	$relurl= geturl("mode=".$mode."&seeknome=".$myseri);
	reload("",$relurl);
*/
	# redirect 
	$period= $_POST["period"];
	$relurl= geturl("mode=".$mode."&period=".$period);
	reload("",$relurl);
}else{
				# формираме списък с годините и полугодията им 
				# отгоре : $listyear 
						$arperi= array();
				foreach($listyear as $liel=>$lico){
								if (empty($lico)){
						$arperi[$liel]= $lico;
								}else{
									if (date("Y")==$liel and date("m")<=6){
									}else{
						$arperi[$liel."-2"]= $lico .toutf8(" 2-ро полугодие");
									}
						$arperi[$liel."-1"]= $lico .toutf8(" 1-во полугодие");
//						$arperi[$liel]= $lico .toutf8(" година");
						$arperi[$liel]= $lico .toutf8(" г.");
								}
				}
//print_r($arperi);
				# предаваме името на масива с периодите 
				$smarty->assign("ARPERINAME", "arperi");
	
	# извеждаме формата с филтъра 
	$smarty->assign("FILIST", $filist);
	$pagecont= smdisp("rep1form.tpl","fetch");
}


?>