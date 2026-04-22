<?php
# отчет раздел 2 - избора и формирането заедно 
#    вика се в основния прозорец, а не в ajax 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
//print_rr($GETPARAM);

									# формиране отчета за избран период 
									$period= $GETPARAM["period"];
									$create= $GETPARAM["create"];
//print "period=[$period][$create]";
									if (isset($period)){
										if (isset($create)){
		include_once "rep2crea.php";
# ВНИМАНИЕ. 
# exit - излиза въобще от index.php 
return;
										}else{
		include_once "rep2list.php";
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
	$pagecont= smdisp("rep2form.tpl","fetch");
}


?>