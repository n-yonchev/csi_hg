<?php

				# 09.03.2010 - доп.филтър директно в заглавната зона 
				# предава се чрез ajax и сесията (finaexfilt.ajax.php), а не чрез форма 
				$exfilt= $_SESSION["exfilt"];
//var_dump($exfilt);
//print_rr($exfilt);
$exfiltcode= "1";
						# нулираме поста 
						$_POST= array();
				if (isset($exfilt)){

#------------------------------- след ajax submit -----------------------------------
//print "AFTER-AJAX-SUBMIT";
//print_rr($exfilt);
//					unset($_SESSION["exfilt"]);
					foreach($exfilt as $exname=>$excont){
						$_POST[$exname]= $excont;
					}

# сумите 
$exsum1= $exfilt["exsum1"];
if (empty($exsum1)){
}else{
	$exfiltcode .= " and finance.inco>=$exsum1";
}
$exsum2= $exfilt["exsum2"];
if (empty($exsum2)){
}else{
	$exfiltcode .= " and finance.inco<=$exsum2";
}

# датите 
	$subd= "substring(finasource.date,1,2)";
	$subm= "substring(finasource.date,4,2)";
	$suby= "substring(finasource.date,7,4)";
	$dat2= "concat($suby,'-',$subm,'-',$subd)";
	$dat1= "substring(finance.time,1,10)";
	$codedate= "if(finasource.id is null, $dat1, $dat2)";
$exdat1= $exfilt["exdat1"];
if (empty($exdat1)){
}else{
	list($da,$mo,$ye)= explode(".",$exdat1);
	$da= str_pad($da,2,"0",STR_PAD_LEFT);
	$mo= str_pad($mo,2,"0",STR_PAD_LEFT);
	$mydat1= "$ye-$mo-$da";
	$exfiltcode .= " and $codedate >= '$mydat1'";
}
$exdat2= $exfilt["exdat2"];
if (empty($exdat2)){
}else{
	list($da,$mo,$ye)= explode(".",$exdat2);
	$da= str_pad($da,2,"0",STR_PAD_LEFT);
	$mo= str_pad($mo,2,"0",STR_PAD_LEFT);
	$mydat2= "$ye-$mo-$da";
	$exfiltcode .= " and $codedate <= '$mydat2'";
}

# описанието 
$exdesc= $exfilt["exdesc"];
if (empty($exdesc)){
}else{

					# източник : fdtx.php 
					# ВАЖНО. 
					# 1. правим две, а не една трансформация - за MySQL-dbsimple и за like 
					# 2. заместваме с функцията sprintf - тя екранира коректно и двата вида кавички 
					$text1= $exdesc;
					$text2= mysql_real_escape_string($text1);
					$text3= mysql_real_escape_string($text2);
					$text4= "%" .$text3 ."%";
					# елементи на филтъра 
					# - за описанието 
					$eldesc= sprintf("upper(%s) like upper('%s')"  ,"finance.descrip",$text4);

	$exfiltcode .= " and $eldesc";
}

# дело/год 
$excase= $exfilt["excase"];
if (empty($excase)){
}else{
	list($myseri,$myyear)= explode("/",$excase);
	if (empty($myyear)){
$exfiltcode .= " and suit.serial=$myseri";
	}else{
		if (substr($myyear,0,2)=="20"){
		}else{
			$myyear= "20".$myyear;
		}
$exfiltcode .= " and suit.serial=$myseri and suit.year=$myyear";
	}
}

#---- полетата select-option ---------------------------------
# типа 
codeseleop("e1type",2);
# назначено дело 
codeseleop("e1dire",3);
# деловодител 
codeseleop("e1user",4);
# за ЧСИ 
codeseleop("e1sepa",5);
# приключване 
codeseleop("e1clos",6);
# връщане 
codeseleop("e1back",7);

				}else{

#------------------------------- преди ajax submit -----------------------------------

				# if (isset($exfilt)){
				}

//print "post=";
//print_rr($_POST);
//print "exfilt=";
//print_rr($exfilt);
# формираме списъците за избор 
$arvari= array();
# ВНИМАНИЕ. 
# празен елемент отпред на всеки списък - без филтър 
$emar= array(-1=>"");
	# типа 
	$exartype= finafiltform(2);
$exartype= $emar+$exartype;
$smarty->assign("ARTYPENAME", "exartype");
	# назначено дело 
	$exardire= finafiltform(3);
$exardire= $emar+$exardire;
$smarty->assign("ARDIRENAME", "exardire");
	# деловодител 
	$exaruser= finafiltform(4);
$exaruser= $emar+$exaruser;
print_r($aruser);
$smarty->assign("ARUSERNAME", "exaruser");
	# за ЧСИ 
	$exarsepa= finafiltform(5);
$exarsepa= $emar+$exarsepa;
$smarty->assign("ARSEPANAME", "exarsepa");
	# приключване 
	$exarclos= finafiltform(6);
$exarclos= $emar+$exarclos;
$smarty->assign("ARCLOSNAME", "exarclos");
	# връщане 
	$exarback= finafiltform(7);
$exarback= $emar+$exarback;
$smarty->assign("ARBACKNAME", "exarback");


function codeseleop($finame,$fiindx){
global $exfiltcode, $exfilt;
	$ficont= $exfilt[$finame];
//print "<br>codeseleop=$ficont=$finame";
	if ($ficont==-1){
	}else{
		$recode= finafiltcode("$fiindx/$ficont");
		$exfiltcode .= " and $recode";
	}
}


?>
