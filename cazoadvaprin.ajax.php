<?php
# отпечатване на прих.касов ордер от аванс.такса 
# отгоре : 
#     $prinadva = claim.id - записа за отпечатване 
# източник : 
#     cazoadvaprin.ajax.php - ПКО от постъпление 


# файла с шаблона 
$filete= "outgoing/pko.xml";
# стрингове за заместване 
//$armeta= array("_F_I_R_", "_B_U_L_", "_N_U_M_", "_D_A_T_", "_N_A_M_", "_T_E_X_", "_A_M_O_", "_S_T_R_");
$armeta= array("_F_I_R_", "_B_U_L_", "_N_U_M_", "_D_A_T_", "_N_A_M_", "_T_E_X_", "_A_M_O_", "_S_T_R_", "_K_A_S_");

//# записа за отпечатване - cash.id 
//$idel= $GETPARAM["idel"];
//print "[$func][$idel]";
# четем записа 
$rofina= getrow("claimadva",$prinadva);
									$rofina= toutf8($rofina);
$seriyear= $rofina["cashserial"]."/".$rofina["cashyear"];
//	list($ye,$mo,$da)= explode("-",$rofina["date"]);
//$mydate= "$da.$mo.$ye";
$mydate= $rofina["cashdate"];
$myname= $rofina["cashname"];
	$myname= stripslashes($myname);
//$mytext= $rofina["descrip"];
$myamou= $rofina["amount"];
	$myamouform= number_format($myamou,2,".",",");
/*
# текста = делото 
$mytext= "вноска по изпълнително дело XXXXXXXXXXXX";
$mytext= toutf8($mytext);
*/

# получаваме словом 
//$myam2= round($myamou,4);
$myam2= number_format($myamou,2,".","");
list($c1,$c2)= explode(".",$myam2);
					include_once "SLOVOM.php";
$slovom= slovom($c1,$c2);
									$slovom= toutf8($slovom);

# четем основните данни за ЧСИ 
$rooffi= getofficerow($iduser);
									$rooffi= toutf8($rooffi);
# текста = пълния номер на делото 
//////////////	$rocase= getrow("suit",$rofina["idcase"]);
				# 10.10.2014 ВАЖНА КОРЕКЦИЯ 
				$idclai= $rofina["idclaimer"];
				$roclai= getrow("claimer",$idclai);
				$rocase= getrow("suit",$roclai["idcase"]);
$fullnumb= getfullnumb($rocase);
$mytext= "авансова вноска по изпълнително дело ".$fullnumb;
	$descrip= $rofina["descrip"];
	$descrip= tran1251($descrip);
//++++	$mytext .= "<br>".$descrip;
	$mytext .= " ".$descrip;
$mytext= toutf8($mytext);

/*
# логнатия = касиер 
$iduser= $_SESSION["iduser"];
$rouser= getrow("user",$iduser);
*/
# събирача на парите = касиер 
$cashiduser= $rofina["cashiduser"];
$rouser= getrow("user",$cashiduser);
$namecash= toutf8($rouser["name"]);

# четем шаблона 
$ficont= file_get_contents($filete);
# стойностите за заместване 
/*++++
$arcont= array(
	"<b>".$rooffi["text"]."</b>"
	, "<b>".$rooffi["bulstat"]."</b>"
	, "<b>".$seriyear."</b>"
	, "<b>".$mydate."</b>"
	, "<b>".$myname."</b>"
	, "<b>".$mytext."</b>"
	, "<b>".$myamouform."</b>"
	, "<b>".$slovom."</b>"
	, "<b>".$namecash."</b>"
	);
++++*/
$arcont= array(
	$rooffi["text"]
	, $rooffi["bulstat"]
	, $seriyear
	, $mydate
	, $myname
	, $mytext
	, $myamouform
	, $slovom
	, $namecash
	);
//print_rr($arcont);
# заместваме в шаблона 
$mycont= str_replace($armeta, $arcont, $ficont);
//print_r($arcont);
//print $mycont;

/****
#---------------- извеждаме чрез PDF ---------------- 
# източник : cazo6prnt.ajax.php 
# записваме съдържанието във временен файл 
$fnam= md5(microtime());
$fnam= "cache/".$fnam;
//print $cont;
file_put_contents($fnam, stripslashes($mycont));
# извеждаме страницата за трансформиране в PDF 
//$smarty->assign("URLPAR", urlencode("b3/$fnam"));
		# определяме префикса за абсолютния път - заради локалната поддир. /b3 
		$snam= $_SERVER["SCRIPT_NAME"];
		$anam= explode("/",$snam);
		unset($anam[count($anam)-1]);
		unset($anam[0]);
		$anam[]= $fnam;
		$namresult= implode("/",$anam);
//print $namresult;
$smarty->assign("URLPAR", urlencode($namresult));


# извеждаме 
//$smarty->assign("CONTENT", $mycont);
print smdisp("cazoprinadva.ajax.tpl","iconv");
//print $mycont;
****/

//++++$mycont= tran1251($mycont);
	$style= "
<style>
body, td {font-family:verdana; font-size:8pt;}
</style>
	";
ExcelHeader("ПКОавтакса-".$rofina["cashserial"]."-".$rofina["cashyear"].".doc");
	$outp= "
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\" />
<body>
	$style
	$mycont
</body>
</html>
	";
//<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
//print $cont;
//++++print $outp;
print $mycont;
//exit;


?>