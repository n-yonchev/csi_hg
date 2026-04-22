<?php

# ВНИМАНИЕ. 31.08.2009 
# втория параметър винаги е false, никъде не се вика с true 
function getxml($filename,$full){
global $DB;

/*
#---- ОББ ----
	# масива с таговете и полетата 
	$arfiel= array(
		"IBAN_S" => "iban"
		,"FROM_ST_DATE" => "date1"
		,"TILL_ST_DATE" => "date2"
		,"OPEN_BALANCE" => "balance1"
		,"CLOSE_BALANCE" => "balance2"
		);
*/
#---- Алианц ----
	# масива с таговете и полетата 
	$arfiel= array(
		"accountid" => "iban"
		,"datefrom" => "date1"
		,"dateto" => "date2"
		,"balancestart" => "balance1"
		,"balanceend" => "balance2"
		);
					
//					include('xml2array.php');
					include('xml2array.class.php');

//print "<br>======GETXML======$filename<br>";
	# трансформираме xml в масив 
	$xml = new XML2Array;
	$filecont= file_get_contents($filename);
	$arcont = $xml->parse($filecont);
//print_r($arcont);

/*	
	# полетата с основните параметри на извлечението (пакета) 
	$arstat= $arcont["STATEMENT"];
//print_r($arstat);
			$resu= array();
	foreach($arfiel as $arname=>$myname){
			$resu[$myname]= $arstat[$arname]["value"];
	}
	
	# транзакциите - според режима 
	$artran= $arstat["TRANSACTION"];
*/
	
	# $arstat - полетата с основните параметри на извлечението (пакета) 
	$arstat= $arcont["STATEMENTS"]["attr"];
	# $resu - резултата 
			$resu= array();
	foreach($arfiel as $arname=>$myname){
			$resu[$myname]= $arstat[$arname];
	}
	# $artran -  транзакциите 
	$ar2= $arcont["STATEMENTS"]["STATEMENT"];
//print_r($ar2);
			$artran= array();
	foreach($ar2 as $elem){
			$artran[]= $elem["attr"];
	}
//print_r($artran);
//var_dump($artran);

	# останалия резултат - според флага 
	if ($full){
		# ще върнем основните параметри и масива с транзакциите 
		$resu["tran"]= $artran;
	}else{
//		$mysele= "select count(id) as coun from bank where REFERENCE=?";
		$mysele= "select count(id) as coun from finasource where reference=?";
		# само броим дублираните и новите транзакции 
					$codub= 0;
					$conew= 0;
							# броим още : общо и входящите 
							$cotot= 0;
							$coinp= 0;
													# 20.07.2009 - статус на транзакцията 
													# паралелно формираме масив с транзакциите - всяка транзакция има доп.поле 
													# - статус : 0=разход 1=постъп.дублирано 2=постъп.ново
		foreach ($artran as $elindx=>$eltran){
							$cotot ++;
/*
#---- ОББ ----
			$trancode= $eltran["REFERENCE"]["value"];
			$amouinpu= $eltran["AMOUNT_C"]["value"];
*/
#---- Алианц ----
			$trancode= $eltran["reference"];
			$amouinpu= $eltran["amount"];
			# само кредитните преводи 
			$amouinpu= ($eltran["dtkt"]=="K") ? $amouinpu : "";
													# 20.07.2009 - статус на транзакцията 
													$artran[$elindx]["status"]= 0;
			if ($amouinpu==""){
			}else{
							$coinp ++;
				$mycoun= $DB->selectCell($mysele ,$trancode);
				if ($mycoun==0){
					$conew ++;
													# 20.07.2009 - статус на транзакцията 
													$artran[$elindx]["status"]= 2;
				}else{
					$codub ++;
													# 20.07.2009 - статус на транзакцията 
													$artran[$elindx]["status"]= 1;
				}
			}
		}
		# ще върнем основните параметри и статистиката с бройките 
		$resu["codub"]= $codub;
		$resu["conew"]= $conew;
		$resu["cotot"]= $cotot;
		$resu["coinp"]= $coinp;
													# 20.07.2009 - статус на транзакцията 
													# връщаме масива с транзакциите - всяка има и статус 
													$resu["transtat"]= $artran;
	}

return $resu;
}




# връща запис за табл.finance 
function getfinance($arelem){
	$fset= array();
//					$fset["iduser"]= $_SESSION["iduser"];
						$fset["inco"]= $arelem["amount"];
					$fset["inco"]= str_replace(",","",$fset["inco"]);
						$fdes= array();
						$fdes[]= $arelem["trname"];
						$fdes[]= $arelem["trcode"];
						$fdes[]= $arelem["contragent"];
						$fdes[]= $arelem["rem_i"];
						$fdes[]= $arelem["rem_ii"];
						$fdes[]= $arelem["rem_iii"];
					$fset["descrip"]= implode(" ",$fdes);
//var_dump($fset["descrip"]);
return $fset;
}

# връща запис за табл.finasource 
function getfinasource($arelem){
					$oset= array();
//						# указател към основ.запис - постъплението 1:1 
//						$oset["idfinance"]= $idfina;
//						# указател към извлечението много:1 
//						$oset["idfinabank"]= $idbankpack;
			# $arelem["valuedate"] = не се използва 
					//$oset["date"]= $arelem["POST_DATE"];
					//$oset["hour"]= $arelem["TIME"];
					# датата и часа - от [datetime] 
					list($oset["date"],$oset["hour"])= explode(" ",$arelem["datetime"]);
//					$oset["amount"]= $fset["inco"];
					# текстовите полета 
					$oset["desc1"]= $arelem["trname"]." ".$arelem["trcode"];
					$oset["desc2"]= $arelem["contragent"];
					$oset["desc3"]= $arelem["rem_i"]." ".$arelem["rem_ii"];
					$oset["desc4"]= $arelem["rem_iii"];
					# кода на транзакцията 
					$oset["reference"]= $arelem["reference"];
return $oset;
}

?>
