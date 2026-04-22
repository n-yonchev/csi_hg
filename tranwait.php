<?php
# чакащи преводи - подменю-2 
# отгоре : 
#    $mode - текущия режим 
#    $page - текущата страница 
#    $vari - текущото подменю 
# още : 
#    $filtcode - филтър-1 
//print_rr($GETPARAM);

			$arv2flag= array();		

$arv2["s1"]= "всички";			
		$arv2filt["s1"]= "1";		
		$arv2topa["s1"]= false;		
			$arv2flag["s1"]= array();		

$arv2["s3"]= "проблемни";		
		$arv2filt["s3"]= "$codeisnorm and $codeprob";		
		$arv2topa["s3"]= false;		
//			$arv2flag["s3"]= array("FLBACK"=>0);		
			$arv2flag["s3"]= array();		
$smarty->assign("INDXPROB", "s3");
		
//$arv2["s4"]= "други готови";			
$arv2["s4"]= "кредитни";			
		$arv2filt["s4"]= "$codeisnorm and !($codeprob) and !($codeisinve) and !($codeisbudg)";		
		$arv2topa["s4"]= true;		
//			$arv2flag["s4"]= array("FLBACK"=>0,"FLINVE"=>0,"FLBUDG"=>0);		
//^			$arv2flag["s4"]= array("FLINVE"=>0,"FLBUDG"=>0);		
			$arv2flag["s4"]= array("FLINVE"=>1,"FLBUDG"=>0);		

//$arv2["s5"]= "готови бюджетни";			
$arv2["s5"]= "бюджетни";			
//		$arv2filt["s5"]= "$codeisnorm and !($codeprob) and $codeisbudg and !($codebudgprob)";		
		$arv2filt["s5"]= "$codeisnorm and !($codeprob) and !($codeisinve) and $codeisbudg";		
		$arv2topa["s5"]= true;		
//			$arv2flag["s5"]= array("FLBACK"=>0,"FLINVE"=>0);		
			$arv2flag["s5"]= array("FLINVE"=>0);		
		# специално за бюдж.пакети на Пощ.банка 
		$ar2isbudg["s5"]= "bud";

# общи бройки 
$temp= "sum(if(%s,1,0)) as coun%s";
		$arcode= array();
foreach($arv2 as $indx=>$x2){
		$arcode[]= sprintf($temp,$arv2filt[$indx],$indx);
}
//print_rr($arcode);
$stcode= implode(",",$arcode);
//print "tranwait=filtcode=";
//var_dump($filtcode);
					$codejoin= sprintf($bictempjoin,"finatran.iban");
$arcoun= $DB->selectRow("
	select $stcode
	from finatran
	left join tranbudget on finatran.idtranbudget=tranbudget.id
					$codejoin
$codetranacco
where $filtcode
	");

# бройки готови за описи 
					$codejoin= sprintf($bictempjoin,"finatran.iban");
$ardata= $DB->select("
	select tranacco.id as ARRAY_KEY, tranacco.desc as text, count(*) as coun
	from finatran
$codetranacco
	left join tranbudget on finatran.idtranbudget=tranbudget.id
					$codejoin
where $filtcode and $codeisnorm and $codeisinve and !($codeprob)
group by tranacco.id
	");
$ardata= dbconv($ardata);
//print "ARDATA=";
//print_ru($ardata);

# линкове - готови за опис 
				$modeel= "mode=".$mode."&vari=".$vari;
		$arv2link= array();
foreach($arv2 as $indx=>$text){
		$arv2link[$indx]= array("text"=>$text, "coun"=>$arcoun["coun".$indx],"link"=>geturl($modeel."&v2=".$indx));
}
$smarty->assign("ARV2LINK", $arv2link);
		$arv2linkinve= array();
foreach($ardata as $idacco=>$cont){
		$arv2linkinve[$idacco]= array("text"=>$cont["text"], "coun"=>$cont["coun"],"link"=>geturl($modeel."&v2=".$idacco));
}
$smarty->assign("ARV2LINKINVE", $arv2linkinve);
# сценарий 
$arscen= array();
	$arscen[]= "=0";
$arscen[]= "s1";
# ВЪРНАТИ ОТПАДАТ 
/////////////////////////$arscen[]= "s2";
$arscen[]= "s3";
	$arscen[]= "=0end";
	$arscen[]= "=1";
	$arscen[]= "=1end";
	$arscen[]= "=2";
$arscen[]= "s4";
$arscen[]= "s5";
	$arscen[]= "=2end";
$smarty->assign("ARSCEN", $arscen);
//print_rr($arscen);

# текущото подменю-2 
$v2= $GETPARAM["v2"];
//print_rr($GETPARAM);
//var_dump($v2);
	$ak= array_keys($arv2);
$v2= isset($v2) ? $v2: $ak[0];
//var_dump($v2);
$smarty->assign("V2", $v2);
$smarty->assign("HEAD2TX", $arv2text[$v2]);
//print "v2=[$v2]";

# извеждане 
		if (substr($v2,0,1)=="s"){
			$filt2code= $arv2filt[$v2];
# флаг към пакет 
$flagpack= $arv2topa[$v2];
		}else{
//						$arv2flag[$v2]= array("FLBACK"=>0,"FLINVE"=>0,"FLBUDG"=>0);		
//^						$arv2flag[$v2]= array("FLINVE"=>0,"FLBUDG"=>0);		
						$arv2flag[$v2]= array("FLINVE"=>1,"FLBUDG"=>0);		
			$roacco= getrow("tranacco",$v2);
			$myiban= $roacco["iban"];
//^			$filt2code= "$codeisnorm and $codeisinve and !($codeprob)" ." and finatran.iban='$myiban'";
			$filt2code= "$codeisnorm and $codeisinve and !($codeprob)" ." and tranacco.id=$v2";
# флаг към опис 
$toinveiban= $myiban;
$smarty->assign("TOINVEIBAN", $toinveiban);
		}
//print "<br>[$filt2code]";
$filtcode .= " and ".$filt2code;

# флагове за колоните 
foreach($arv2flag[$v2] as $name=>$cont){
	$smarty->assign($name,$cont);
}
# код за пакети на Пощ.банка - бюджетни или не 
$codepost= $ar2isbudg[$v2] ."";


# извеждане 
include_once "tran2.php";
$smarty->assign("C2VARI", $contvari);
$contvari= smdisp("tranwait.tpl","fetch");


?>