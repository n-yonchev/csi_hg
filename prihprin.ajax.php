<?php
# отпечатване ръчно въведен ПКО
# отгоре : 
#     $prin = prih.id - записа за отпечатване 
# източник : 
#     cazoadvaprin.ajax.php - ПКО от аванс.такса 


# файла с шаблона 
$filete= "outgoing/pko.xml";
# стрингове за заместване 
//$armeta= array("_F_I_R_", "_B_U_L_", "_N_U_M_", "_D_A_T_", "_N_A_M_", "_T_E_X_", "_A_M_O_", "_S_T_R_");
$armeta= array("_F_I_R_", "_B_U_L_", "_N_U_M_", "_D_A_T_", "_N_A_M_", "_T_E_X_", "_A_M_O_", "_S_T_R_", "_K_A_S_");

# четем записа 
$roprih= getrow("prih",$prin);
									$roprih= toutf8($roprih);
$seriyear= $roprih["cashserial"]."/".$roprih["cashyear"];
//$mydate= $roprih["cashdate"];
$mydate= bgdatefrom($roprih["cashdate"]);
$myname= $roprih["cashname"];
	$myname= stripslashes($myname);
$myamou= $roprih["amount"];
	$myamouform= number_format($myamou,2,".",",");

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
/*
# текста = пълния номер на делото 
//////////////	$rocase= getrow("suit",$roprih["idcase"]);
				# 10.10.2014 ВАЖНА КОРЕКЦИЯ 
				$idclai= $roprih["idclaimer"];
				$roclai= getrow("claimer",$idclai);
				$rocase= getrow("suit",$roclai["idcase"]);
$fullnumb= getfullnumb($rocase);
$mytext= "авансова вноска по изпълнително дело ".$fullnumb;
	$descrip= $roprih["descrip"];
	$descrip= tran1251($descrip);
//++++	$mytext .= "<br>".$descrip;
	$mytext .= " ".$descrip;
$mytext= toutf8($mytext);
*/

# основание 
$mytext= $roprih["descrip"];
# касивера 
$namecash= $roprih["cashname"];

/*
# логнатия = касиер 
$iduser= $_SESSION["iduser"];
$rouser= getrow("user",$iduser);
# събирача на парите = касиер 
$cashiduser= $roprih["cashiduser"];
$rouser= getrow("user",$cashiduser);
$namecash= toutf8($rouser["name"]);
*/

# четем шаблона 
$ficont= file_get_contents($filete);
# стойностите за заместване 
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
	$style= "
<style>
body, td {font-family:verdana; font-size:8pt;}
</style>
	";
ExcelHeader("ПКОръч-".$roprih["cashserial"]."-".$roprih["cashyear"].".doc");
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