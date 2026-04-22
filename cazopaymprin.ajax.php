<?php
# отпечатване на прих.касов ордер 

/*
										$idel= $_GET["idel"];
										if (isset($idel)){

													session_start();
													include_once "common.php";
*/

# файла с шаблона 
//$filete= "docum/pko.htm";
$filete= "outgoing/pko.htm";
# стрингове за заместване 
$armeta= array("_F_I_R_", "_B_U_L_", "_N_U_M_", "_D_A_T_", "_N_A_M_", "_T_E_X_", "_A_M_O_", "_S_T_R_");

# записа за отпечатване - cash.id 
$idel= $GETPARAM["idel"];
//print "[$func][$idel]";
# четем записа 
$rocash= getrow("cash",$idel);
									$rocash= toutf8($rocash);
$seriyear= $rocash["serial"]."/".$rocash["year"];
	list($ye,$mo,$da)= explode("-",$rocash["date"]);
$mydate= "$da.$mo.$ye";
$myname= $rocash["name"];
$mytext= $rocash["text"];
$myamou= $rocash["amount"];
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

# четем шаблона 
$ficont= file_get_contents($filete);
# стойностите за заместване 
$arcont= array(
	"<b>".$rooffi["text"]."</b>"
	, "<b>".$rooffi["bulstat"]."</b>"
	, "<b>".$seriyear."</b>"
	, "<b>".$mydate."</b>"
	, "<b>".$myname."</b>"
	, "<b>".$mytext."</b>"
	, "<b>".$myamouform."</b>"
	, "<b>".$slovom."</b>"
	);
# заместваме в шаблона 
$mycont= str_replace($armeta, $arcont, $ficont);
//print_r($arcont);
//print $mycont;

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
print smdisp("cazopaymprin.ajax.tpl","iconv");
//print $mycont;

/*
										}else{

# записа за отпечатване - cash.id 
$idel= $GETPARAM["idel"];
# извеждаме 
//$smarty->assign("CONTENT", $mycont);
$smarty->assign("IDEL", $idel);
print smdisp("cazopaymprin.ajax.tpl");

										# if ($_GET["print"]=="yes"){
										}
*/


?>