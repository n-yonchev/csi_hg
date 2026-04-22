<?php
# корекция на ранговете за сортиране idsort за изх.шаблон 
# отгоре осн.параметър : 
#    $sort - docutype.id за корекция 
# още отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $relurl - линк след събмит 

														
# шаблона за преместване 
$rodoty= getrow("docutype",$sort);

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
//print_rr($_POST);

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
							//$retucode= 2;
							$retucode= 0;
	# корегираме ранга за сортиране 
	$arlist= $DB->selectCol("select id as ARRAY_KEY, idsort from docutype");
			$idchosen= $_POST["iddoty"];
			$idsortchosen= $arlist[$idchosen];
	$arlist[$sort]= $idsortchosen -1;
	asort($arlist,SORT_NUMERIC);
			dotysort($arlist);

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
	$smarty->assign("RODOTY", $rodoty);
				# списъка шаблони 
				$ardata= $DB->selectCol("select id as ARRAY_KEY, text from docutype order by idsort");
				foreach($ardata as $idty=>$cont){
					$ardata[$idty]= stripslashes($cont);
				}
	$smarty->assign("ARDATANAME", "ardata");
	print smdisp("outtemsort.ajax.tpl","iconv");
}


?>