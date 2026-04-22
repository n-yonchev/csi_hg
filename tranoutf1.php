<?php
# всичко за формиране на ИЗХ.ФАЙЛ за Пощ.банка 


# трансформация за полетата на ИЗХ.ФАЙЛ - преводи извън опис 
function filetranfree($ardata,$arbudata){
global $rooffi;
										$code= "DP";
										$taxt= "002";
										$rings= "";
						$arresu= array();
	foreach($ardata as $indx=>$cont){
		$reelem= array();
					$reelem["code"]= $code;
		$nameto= $cont["clainame"];
$nameto= charspec($nameto);
					$reelem["nameto"]= $nameto;
		$bicto= $cont["bic"];
					$reelem["bicto"]= $bicto;
		$ibanto= $cont["iban"];
					$reelem["ibanto"]= $ibanto;
		$bankto= $cont["bankname"];
$bankto= charspec($bankto);
					$reelem["bankto"]= $bankto;
			$amount= $cont["amount"];
			$suma= number_format($amount,2,".","");
					$reelem["suma"]= $suma;
		$textto= $cont["text"];
$textto= charspec($textto);
					$reelem["textto"]= $textto;
		# тип документ - няма 
					$reelem["type"]= "";
		# RINGS 
		if ($cont["isring"]==0){
		}else{
					$reelem["ring"]= $rings;
		}
		# тип такси 
					$reelem["taxt"]= $taxt;
		# дата изпълнение - няма 
					$reelem["date"]= "";
						$arresu[]= $reelem;
	}
return $arresu;
}

# трансформация за полетата за ИЗХ.ФАЙЛ - от опис 
function filetraninve($ardata){
global $codet26, $codenop;
										$code= "DP";
										$taxt= "002";
										$rings= "";
										//$curren= "BGN";
										//$rings= "on";
						$arresu= array();
	foreach($ardata as $idinve=>$cont){
//$cont= tran1251($cont);
//print "<br>CONT=";
//print_rr($cont);
		$reelem= array();
					$reelem["code"]= $code;
//		$nameto= $cont["accoclai"];
		$nameto= $cont["clainame"];
$nameto= charspec($nameto);
					$reelem["nameto"]= $nameto;
		$bicto= $cont["accobic"];
					$reelem["bicto"]= $bicto;
		$ibanto= $cont["accoiban"];
					$reelem["ibanto"]= $ibanto;
		$bankto= $cont["bankname"];
$bankto= charspec($bankto);
					$reelem["bankto"]= $bankto;
			$amount= $cont["suma"];
			$suma= number_format($amount,2,".","");
					$reelem["suma"]= $suma;
//			if ($cont["accocode"]=="t26"){
			if ($cont["accocode"]==$codet26 or $cont["accocode"]==$codenop){
				$rtex1= "ТАКСИ ОТ ТТР КЪМ ЗЧСИ С ДДС";
//				$rtex2= "ПО ОПИС $idinve ОТ " .date("d.m.Y");
				$rtex2= "ПО ОПИС $idinve ОТ " .$cont["dateinve"];
			}else{
				$rtex1= "ВНОСКИ ПО ИЗПЪЛНИТЕЛНИ ДЕЛА";
//				$rtex2= "ПО ОПИС $idinve ОТ " .date("d.m.Y");
				$rtex2= "ПО ОПИС $idinve ОТ " .$cont["dateinve"];
			}
					$reelem["textto"]= "$rtex1 $rtex2";
		# тип документ - няма 
					$reelem["type"]= "";
		# RINGS - няма 
					$reelem["ring"]= "";
		# тип такси 
					$reelem["taxt"]= $taxt;
		# дата изпълнение - няма 
					$reelem["date"]= "";
						$arresu[]= $reelem;
	}
return $arresu;
}

# формиране ИЗХ.ФАЙЛ за Пощ.банка 
function getoutfile($ardate){
global $rooffi;
global $DB;
	$arfiel= array(
		"code","nameto","bicto","ibanto","bankto","suma","textto"
		,"type","ring","taxt","date"
		);
	$newline= "\r\n";
								$resucont= "";
								$sumacont= 0;
								$councont= 0;
	foreach($ardate as $indx=>$elem){
		$elem= toutf8($elem);
						//$arrow= array();
						$conrow= "";
		foreach($arfiel as $x1=>$fina){
			$elemcont= $elem[$fina];
						//$arrow[]= $elemcont;
						$conrow .= $elemcont .";";
		}
			//$crow= implode(";",$arrow);
								//$resucont .= $crow .$newline;
								$resucont .= $conrow .$newline;
								$sumacont += $elem["suma"];
								$councont ++;
//						$payment= "<PAYMENT>".$newline  .$elpaym  ."</PAYMENT>".$newline;
//								$resucont .= $payment;
	}
#------------------------ водещ ред --------------------------- 
	$sumatota= number_format($sumacont,2,".","");
						$code1= "OMP";
						$code2= "DP";
						$curren= "EUR";
						$currdate= date("Ymd");
						$ctrlcode= "";
	$roacco= $DB->selectRow("select * from tranacco where code='pos'");
	$iban= $roacco["iban"];
	$bic= $roacco["bic"];
	$name= "ЧСИ ".$rooffi["serial"]." ".$rooffi["shortname"];
						$row1= "$code1;$code2;$currdate;$bic;$iban;$name;$curren;$sumatota;$councont;$ctrlcode;" .$newline;
						$row1= toutf8($row1);
	$result= $row1.$resucont;
	$result= tran1251($result);
return $result;
}


?>