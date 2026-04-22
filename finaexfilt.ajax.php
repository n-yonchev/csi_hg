<?php

									session_start();
									include "common.php";

$para= $_GET["para"];
//print $para;
//var_dump($para);
								if ($para=="clear"){
									unset($_SESSION["exfilt"]);
//print "clear-filt";
								}else{

/*
list($exsum1,$exsum2,$exdat1,$exdat2,$exdesc)= explode("^",$para);
$exfilt["exsum1"]= $exsum1;
$exfilt["exsum2"]= $exsum2;
$exfilt["exdat1"]= $exdat1;
$exfilt["exdat2"]= $exdat2;
$exfilt["exdesc"]= $exdesc;
//print_r($exfilt);
*/
$ar1= explode("^",$para);
				$exfilt= array();
foreach($ar1 as $elem){
	list($finame,$ficont)= explode("=",$elem);
				$exfilt[$finame]= $ficont;
}
//print_rr($exfilt);

				$erlist= array();

# суми проверка 
$sum1resu= validator_amount_or_empty($exfilt["exsum1"],NULL);
if ($sum1resu === true){
}else{
				$erlist[]= "exsum1";
}
$sum2resu= validator_amount_or_empty($exfilt["exsum2"],NULL);
if ($sum2resu === true){
}else{
				$erlist[]= "exsum2";
}

# дати проверка 
$dat1resu= validator_bgdate_valid($exfilt["exdat1"],NULL);
if ($dat1resu === true){
}else{
				$erlist[]= "exdat1";
}
$dat2resu= validator_bgdate_valid($exfilt["exdat2"],NULL);
if ($dat2resu === true){
}else{
				$erlist[]= "exdat2";
}

# дело/год проверка 
if (empty($exfilt["excase"])){
}else{
	list($myseri,$myyear)= explode("/",$exfilt["excase"]);
	if ((string)(int)$myseri==$myseri){
		if (empty($myyear)){
		}else{
			if ((string)(int)$myyear==$myyear){
			}else{
				$erlist[]= "excase";
			}
		}
	}else{
				$erlist[]= "excase";
	}
}

# резултат - филтъра или отговор-грешка 
				if (empty($erlist)){
					$_SESSION["exfilt"]= $exfilt;
				}else{
print implode("/",$erlist);
				}

								# if ($para=="clear"){
								}

?>
