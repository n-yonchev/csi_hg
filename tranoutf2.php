<?php
# âñè÷êî çà ôîðìèðàíå íà ÈÇÕ.ÔÀÉË çà ÎÁÁ 


# òðàíñôîðìàöèÿ çà ïîëåòàòà íà ÈÇÕ.ÔÀÉË - ïðåâîäè èçâúí îïèñ 
function filetranfree($ardata,$arbudata){
global $rooffi;
										$sidcred= "IBAN311";
										$sidbudg= "IBAN313";
										$curren= "EUR";
										$rings= "on";
						$arresu= array();
	foreach($ardata as $indx=>$cont){
//print_ru($cont);
		$reelem= array();
										$reelem["CURRENCY"]= $curren;
										//$reelem["RINGS"]= $rings;
//		$reelem["NAME_R"]= $cont["clainame"];
							$reelem["NAME_R"]= charspec($cont["clainame"]);
		$reelem["IBAN_R"]= $cont["iban"];
		$reelem["BIC_R"]= $cont["bic"];
			$amount= $cont["amount"];
			$suma= number_format($amount,2,".","");
		$reelem["JSUM"]= $suma;
							list($text1,$text2)= explode("|",$cont["text"]);
							$reelem["REM_I"]= $text1;
							$reelem["REM_II"]= $text2;
					# äîï.ïîëåòà çà áþäæåòåí 
					$idtranbudget= $cont["idtranbudget"];
					if ($idtranbudget==0){
										$reelem["TRANSID"]= $sidcred;
					}else{
										$reelem["TRANSID"]= $sidbudg;
						$contbu= $arbudata[$idtranbudget];
						$codepaym= $contbu["codepaym"];
		if (empty($codepaym)){
		}else{
			$reelem["PAY_R"]= $codepaym;
		}
						$typedoc= $contbu["typedoc"];
		$reelem["TYPEDOC"]= $typedoc;
						$docdate= $contbu["docdate"];
						$docdate= tranbudgdate($docdate);
		$reelem["DOCDATE"]= $docdate;
						$fromdate= $contbu["fromdate"];
		if (empty($fromdate)){
		}else{
			$reelem["FROMDATE"]= tranbudgdate($fromdate);
		}
						$todate= $contbu["todate"];
		if (empty($todate)){
		}else{
			$reelem["TODATE"]= tranbudgdate($todate);
		}
					# if ($idtranbudget==0){
					}
		# RINGS 
		if ($cont["isring"]==0){
		}else{
			$reelem["RINGS"]= $rings;
		}
					# äåêë.çà ïðîèçõîä 
					if ($amount>30000){
		$reelem["DECL30000"]= "ñúáðàíà ñóìà ïî ÈÄ ".$funu.$rtex;
					}else{
					}
						$arresu[]= $reelem;
	}
return $arresu;
}

# òðàíñôîðìàöèÿ çà ïîëåòàòà çà ÈÇÕ.ÔÀÉË - îò îïèñ 
function filetraninve($ardata){
global $codet26, $codenop;
										$sidcred= "IBAN311";
										//$sidbudg= "IBAN313";
										$curren= "EUR";
										$rings= "on";
						$arresu= array();
	foreach($ardata as $idinve=>$cont){
		$reelem= array();
										$reelem["TRANSID"]= $sidcred;
										$reelem["CURRENCY"]= $curren;
										//$reelem["RINGS"]= $rings;
//		$reelem["NAME_R"]= $cont["accoclai"];
		$reelem["NAME_R"]= $cont["clainame"];
		$reelem["IBAN_R"]= $cont["accoiban"];
		$reelem["BIC_R"]= $cont["accobic"];
			$amount= $cont["suma"];
			$suma= number_format($amount,2,".","");
		$reelem["JSUM"]= $suma;
//			if ($cont["accocode"]=="t26"){
			if ($cont["accocode"]==$codet26 or $cont["accocode"]==$codenop){
				$rtex1= "ÒÀÊÑÈ ÎÒ ÒÒÐ ÊÚÌ Ç×ÑÈ Ñ ÄÄÑ";
//				$rtex2= "ÏÎ ÎÏÈÑ $idinve ÎÒ " .date("d.m.Y");
				$rtex2= "ÏÎ ÎÏÈÑ $idinve ÎÒ " .$cont["dateinve"];
			}else{
				$rtex1= "ÂÍÎÑÊÈ ÏÎ ÈÇÏÚËÍÈÒÅËÍÈ ÄÅËÀ";
//				$rtex2= "ÏÎ ÎÏÈÑ $idinve ÎÒ " .date("d.m.Y");
				$rtex2= "ÏÎ ÎÏÈÑ $idinve ÎÒ " .$cont["dateinve"];
			}
		$reelem["REM_I"]= $rtex1;
		$reelem["REM_II"]= $rtex2;
		# RINGS - íÿìà 
					# äåêë.çà ïðîèçõîä 
					if ($amount>30000){
		$reelem["DECL30000"]= "ñúáðàíà ñóìà ïî ÈÄ ".$funu.$rtex;
					}else{
					}
$reelem["NAME_R"]= charspec($reelem["NAME_R"]);
$reelem["REM_I"]= charspec($reelem["REM_I"]);
$reelem["REM_II"]= charspec($reelem["REM_II"]);
						$arresu[]= $reelem;
	}
return $arresu;
}

# ôîðìèðàíå ÈÇÕ.ÔÀÉË çà ÎÁÁ 
function getoutfile($ardate){
	$arfiel= array(
		"TRANSID","NAME_R","IBAN_R","BIC_R","CURRENCY","JSUM","REM_I","REM_II"  
		,"PAY_R","TYPEDOC","DOCDATE","FROMDATE","TODATE"
		,"RINGS","DECL30000"
		);
	$newline= "\r\n";
								$resucont= "";
	foreach($ardate as $indx=>$elem){
						$elpaym= "";
		foreach($arfiel as $x1=>$fina){
			$elemcont= $elem[$fina];
			if (empty($elemcont)){
			}else{
				$cuel= "<".$fina.">"  .$elemcont  ."</".$fina.">"  .$newline;
						$elpaym .= $cuel;
			}
		}
						$payment= "<PAYMENT>".$newline  .$elpaym  ."</PAYMENT>".$newline;
								$resucont .= $payment;
	}
								$resucont= 
						'<?xml version="1.0" encoding="windows-1251" ?>'.$newline
						.'<PAYMENTS>'.$newline
						.$resucont
						.'</PAYMENTS>'.$newline;
return $resucont;
}


?>