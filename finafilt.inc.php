<?php

$beztip= "--- неопределен ---";
$neizvl= "--- не от извлечение ---";
$unknown= "--- неопределен ---";

$arvaricase[0]= "НЯМА назнач.дело";
$arvaricase[1]= "има назнач.дело";
$arvaricase_utf8= toutf8($arvaricase);

//$arvariexof[0]= "НЯМА сума";
//$arvariexof[1]= "има сума";
$arvariexof[0]= "НЯМА разпред.суми";
$arvariexof[1]= "има разпред.суми";
$arvariexof_utf8= toutf8($arvariexof);

$arvaricomp[0]= "НЕприключени";
$arvaricomp[1]= "приключени";
$arvaricomp[2]= "готови за приключв.";
$arvaricomp_utf8= toutf8($arvaricomp);

$arvariback[0]= "НЯМА за връщане";
$arvariback[1]= "има за връщане";
$arvariback_utf8= toutf8($arvariback);

function finafiltform($type){
//global $smarty;
	if (0){
	}elseif($type==1) {
		# извлечение 
		$list= getselect("finabank","concat(id,'____',date1,'-',date2)","1",false);	
//print_r($list);
		$list[0]= toutf8($GLOBALS["neizvl"]);
		$list= array_reverse($list,true);
	}elseif($type==2) {
		# тип - за select/option - utf8 
		$list= $GLOBALS["listfinatype_utf8"];	
		$list[0]= toutf8($GLOBALS["beztip"]);
	}elseif($type==3) {
		# вариант за дело - за select/option - utf8 
		$list= $GLOBALS["arvaricase_utf8"];	
	}elseif($type==4) {
		# деловодител 
		$list= getselect("user","name","1",true);
		//$list[0]= toutf8("--- неопределен ---");
		$list[0]= toutf8($GLOBALS["unknown"]);
	}elseif($type==5) {
		# вариант за ЧСИ - за select/option - utf8 
		$list= $GLOBALS["arvariexof_utf8"];	
	}elseif($type==6) {
		# вариант за приключване - за select/option - utf8 
		$list= $GLOBALS["arvaricomp_utf8"];	
	}elseif($type==7) {
		# вариант за връщане - за select/option - utf8 
		$list= $GLOBALS["arvariback_utf8"];	
	}else{
die("finafiltform=1=$type");
	}
//print_r($mylist);
return $list;
}

function finafilttext($filtpara){
	list($type,$cont)= explode("/",$filtpara);
	if (0){
	}elseif($type==1) {
		# извлечение 
//		$resu= "само от извлечение " .$cont;
		if ($cont==0){
			$resu= "само " .$GLOBALS["neizvl"];
		}else{
			$resu= "само от извлечение " .$cont;
		}
	}elseif($type==2) {
		# тип - за извеждане - не utf8 
		if ($cont==0){
			$mytext= $GLOBALS["beztip"];
		}else{
			$mytext= $GLOBALS["listfinatype"][$cont];	
		}
		$resu= "само от тип " .$mytext;
	}elseif($type==3) {
		# вариант за дело - за извеждане - не utf8 
		$resu= "само ако " .$GLOBALS["arvaricase"][$cont];	
	}elseif($type==4) {
		# деловодител 
		if ($cont==0){
			$resu= $GLOBALS["unknown"];
		}else{
			$rouser= getrow("user",$cont);
			$resu= $rouser["name"];
		}
		$resu= "само за дела на деловодител " .$resu;
	}elseif($type==5) {
		# вариант за ЧСИ - за извеждане - не utf8 
		$resu= "само ако " .$GLOBALS["arvariexof"][$cont] ." за ЧСИ";	
	}elseif($type==6) {
		# вариант за приключване - за извеждане - не utf8 
		$resu= "само " .$GLOBALS["arvaricomp"][$cont];	
	}elseif($type==7) {
		# вариант за връщане - за извеждане - не utf8 
		$resu= "само " .$GLOBALS["arvariback"][$cont];	
	}else{
die("finafilttext=1=$type");
	}
//print_r($mylist);
return $resu;
}

# кода на филтъра - 
# виж формирането на заявката във finaquery - fina.inc.php 
function finafiltcode($filtpara){
	list($type,$cont)= explode("/",$filtpara);
	if (0){
	}elseif($type==1) {
		# извлечение 
//		$resu= "finasource.idfinabank=$cont";
		if ($cont==0){
			$resu= "(finasource.idfinabank=0 or finasource.idfinabank is null)";
		}else{
			$resu= "finasource.idfinabank=$cont";
		}
	}elseif($type==2) {
		# тип 
		$resu= "finance.idtype=$cont";
	}elseif($type==3) {
		# вариант за дело 
		if ($cont==0){
			$resu= "finance.idcase=0";
		}else{
			$resu= "finance.idcase<>0";
		}
	}elseif($type==4) {
		# деловодител 
//		$resu= "t2.id=$cont";
		if ($cont==0){
			$resu= "t2.id is null";
		}else{
			$resu= "t2.id=$cont";
		}
	}elseif($type==5) {
		# вариант за ЧСИ 
		if ($cont==0){
# 03.11.2009 - вече има 2 полета 
# separa - такси и разноски, неплатени от взискателя 
# separa2 - отделно поле за т.26 
//			$resu= "finance.separa+0=0";
			$resu= "finance.separa+finance.separa2+0=0";
		}else{
//			$resu= "finance.separa+0<>0";
			$resu= "finance.separa+finance.separa2+0<>0";
		}
	}elseif($type==6) {
		# вариант за приключване 
		if ($cont==0){
			$resu= "finance.isclosed<>1";
		}elseif ($cont==1){
			$resu= "finance.isclosed=1";
		}else{
			$resu= "finance.isclosed<>1 and finance.idcase<>0 and finance.rest+0=0";
		}
	}elseif($type==7) {
		# вариант за връщане 
		if ($cont==0){
			$resu= "finance.back+0=0";
		}else{
			$resu= "finance.back+0<>0";
		}
	}else{
die("finafiltcode=1=$type");
	}
//print_r($mylist);
return $resu;
}

?>
