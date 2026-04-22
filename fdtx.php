<?php
# търсене на вх.документ по текст - избора и списъка заедно 
#    вика се в основния прозорец, а не в ajax 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 


									# извеждане списък по въведен филтър 
									$view= $GETPARAM["view"];
									if (isset($view)){
#---- СТАНДАРТ -----------------------------------------------------------------------------------------------------------
								# ВНИМАНИЕ. 
								# стринговете в данните съдържат спец.символи - единични/двойни кавички, tab, newline и др. 
								# трябва да може да търсим в тях и ако стринга за критерия съдържа кавички 
								# при записа на стринга dbsimple е направила трансформация с mysql_real_escape_string 
								# трябва да направим подобна трансформация и за критерия 
					# ВАЖНО. 
					# 1. правим две, а не една трансформация - за MySQL-dbsimple и за like 
					# 2. заместваме с функцията sprintf - тя екранира коректно и двата вида кавички 
					$text1= $view;
					$text2= mysql_real_escape_string($text1);
					$text3= mysql_real_escape_string($text2);
					$text4= "%" .$text3 ."%";
					# елементи на филтъра 
					# - за описанието 
					$eltext= sprintf("upper(%s) like upper('%s')"  ,"docu.text",$text4);
					# - за подател 
					$elfrom= sprintf("upper(%s) like upper('%s')"  ,"docu.from",$text4);
					# - за бележки 
					$elnotes= sprintf("upper(%s) like upper('%s')"  ,"docu.notes",$text4);
# филтъра 
$filter= "$eltext or $elfrom or $elnotes";
$smarty->assign("FILTTX", "съдържащи текст \"".to1251($view)."\"");
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
	"textseek"=>       array("validator"=>"notempty", "error"=>"задължително съдържание")
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
	$textseek= $_POST["textseek"];

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
	$relurl= geturl("mode=".$mode."&view=".$textseek);
	reload("",$relurl);
}else{
	# извеждаме формата с филтъра 
	$smarty->assign("FILIST", $filist);
	$pagecont= smdisp("fdtxform.tpl","fetch");
}


?>