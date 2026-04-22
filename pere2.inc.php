<?php

# 29.11.2018 параметрите са в текстов файл 
$filepara= "PERE.TXT";
$delipara= "\r\n";
$delilist= ",";

function inpara(){
global $filepara, $delipara, $delilist;
	if (file_exists($filepara)){
		$pacont= file_get_contents($filepara);
		list($a1,$a2list,$a3list)= explode($delipara,$pacont);
		$ar2= s2ar($a2list);
		$ar3= s2ar($a3list);
	}else{
//outpara("45","","");
outpara("45",array(),array());
return inpara();
	}
return array($a1,$ar2,$ar3);
}

function outpara($a1,$ar2,$ar3){
global $filepara, $delipara, $delilist;
	$a2list= ar2s($ar2);	
	$a3list= ar2s($ar3);	
		$pacont= implode($delipara,array($a1,$a2list,$a3list));
	$resu= file_put_contents($filepara,$pacont);
	if ($resu===false){
die("error=outpara");
	}else{
	}
return;
}

function s2ar($p1stri){
global $filepara, $delipara, $delilist;
	$arid= (empty($p1stri)) ? array() : explode($delilist,$p1stri);
return $arid;
}

function ar2s($p1ar){
global $filepara, $delipara, $delilist;
	$stri= (empty($p1ar) ? "" : implode($delilist,$p1ar));
return $stri;
}


?>