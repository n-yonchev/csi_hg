<?php
# отпечатване на РАЗХ.касов ордер 
# отгоре : 
#     $prin = razh.id - записа за отпечатване 


# файла с шаблона 
$filete= "outgoing/rko.xml";
# стрингове за заместване 
//$armeta= array("_F_I_R_", "_B_U_L_", "_N_U_M_", "_D_A_T_", "_N_A_M_", "_T_E_X_", "_A_M_O_", "_S_T_R_", "_K_A_S_");
$armeta= array("_F_I_R_", "_B_U_L_", "_N_U_M_", "_D_A_T_", "_N_A_M_", "_T_E_X_"
	, "_A_D_R_", "_P_A_S_", "_R_E_P_", "_L_E_T_"
	, "_A_M_O_", "_S_T_R_", "_K_A_S_");

# четем записа 
$rorazh= getrow("razh",$prin);
									$rorazh= toutf8($rorazh);
$seriyear= $rorazh["cashserial"]."/".$rorazh["cashyear"];
//	list($ye,$mo,$da)= explode("-",$rorazh["date"]);
//$mydate= "$da.$mo.$ye";
$mydate= $rorazh["cashdate"];
$myname= $rorazh["cashname"];
	$myname= stripslashes($myname);
//$mytext= $rorazh["descrip"];
$myamou= $rorazh["amount"];
	$myamouform= number_format($myamou,2,".",",");
$mytext= $rorazh["descrip"];
$myaddr= $rorazh["address"];
$mypass= $rorazh["pass"];
$myrepr= $rorazh["repres"];
$mylett= $rorazh["letter"];
$mycash= $rorazh["cashier"];

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
	$rocase= getrow("suit",$rorazh["idcase"]);
$fullnumb= getfullnumb($rocase);
$mytext= "авансова вноска по изпълнително дело ".$fullnumb;
	$descrip= $rorazh["descrip"];
	$descrip= tran1251($descrip);
//++++	$mytext .= "<br>".$descrip;
	$mytext .= " ".$descrip;
$mytext= toutf8($mytext);
*/

/*
# логнатия = касиер 
$iduser= $_SESSION["iduser"];
$rouser= getrow("user",$iduser);
*/
/***
# събирача на парите = касиер 
$cashiduser= $rorazh["cashiduser"];
$rouser= getrow("user",$cashiduser);
$namecash= toutf8($rouser["name"]);
***/

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
, $myaddr
, $mypass
, $myrepr
, $mylett
	, $myamouform
	, $slovom
	, $mycash
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
ExcelHeader("РКО-".$rorazh["cashserial"]."-".$rorazh["cashyear"].".doc");
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