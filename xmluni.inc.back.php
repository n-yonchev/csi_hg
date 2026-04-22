<?php

function getxml($filename,$full){
global $DB;
	# за всеки ред - масива с полетата и eval изразите 
	$arfiel= array(
		"inco" => "\$elem['MovementAmount']['value']"
		,"date" => "substr(\$elem['ProcessTimestamp']['value'],0,10)"
		,"hour" => "substr(\$elem['ProcessTimestamp']['value'],11)"
		,"refe" => "\$elem['DocRegNumber']['value']"
		,"desc1" => "\$elem['MovementDocument']['Description1']['value']"
		,"desc2" => "\$elem['MovementDocument']['Description2']['value']"
		,"desc" => "\$eldata['desc1'].' '.\$eldata['desc2']"
		,"type" => "\$elem['MovementType']['value']"
		);
//					include('xml2array.php');
					include('xml2array.class.php');

	# трансформираме xml в масив 
	$xml = new XML2Array;
	$filecont= file_get_contents($filename);
	$arcont = $xml->parse($filecont);
//print_rr($arcont);
	
//	$armove= $arcont["CAPAccounts"]["ArrayOfAPAccount"]["ArrayOfAPAccount"]["BankAccount"]["Movements"];
	# същинските данни с редовете 
	//$armove= $arcont["CAPAccounts"]["ArrayOfAPAccounts"]["APAccount"]["BankAccount"]["Movements"]["ArrayOfMovements"]["BankAccountMovement"];
    $armove= $arcont["CAPAccounts"]["ArrayOfAPAccounts"]["APAccount"]["BankAccount"]["BankAccountMovements"]["ArrayOfBankAccountMovements"]["BankAccountMovement"];
//print_rr($armove);
						$ardata= array();
	# трансформация 
	foreach($armove as $elem){
							$eldata= array();
		foreach($arfiel as $finame=>$codeeval){
//print "<br>\$ficont= $codeeval";			
			eval("\$ficont= $codeeval;");
			$ficont= trim($ficont);
			$ficont= str_replace("\r","",$ficont);
			$ficont= str_replace("\n","",$ficont);
							$eldata[$finame]= $ficont;
		}
/*
		# приход/разход 
		if ($eldata["type"]=="2"){
							$eldata["prih"]= $eldata["inco"];
							$eldata["razh"]= "";
		}else{
							$eldata["prih"]= "";
							$eldata["razh"]= $eldata["inco"];
		}
*/
						$ardata[]= $eldata;
	}
//print_rr($ardata);

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
//var_dump($artran);
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
*/
# получихме масива $ardata 

		# обработваме масива 
		$resu= array();
					# броим дублираните и новите транзакции 
					$codub= 0;
					$conew= 0;
							# броим общо и входящите 
							$cotot= 0;
							$coinp= 0;
										# паралелно формираме масив с транзакциите 
										# всяка транзакция има и доп.поле - 
										# статус : 0=разход 1=постъп.дублирано 2=постъп.ново 
										$artran= array();
		foreach ($ardata as $elindx=>$eltran){
							#--- предварителни трансформации 
							# приход/разход 
							if ($eltran["type"]=="2"){
								//$eltran["prih"]= $eltran["inco"];
								$eltran["prih"]= number_format($eltran["inco"] ,2,".","");
								$eltran["razh"]= "";
							}else{
								$eltran["prih"]= "";
								//$eltran["razh"]= $eltran["inco"];
								$eltran["razh"]= number_format($eltran["inco"] ,2,".","");
							}
							# датата 
							$eltran["date"]= bgdatefrom($eltran["date"]);
							//# сумата 
							//$eltran["prih"]= number_format($eltran["prih"] ,2,".","");
										
										# елемента от масива с транзакциите 
										$tranelem= $eltran;
												# специално за различаване на формата 
												$tranelem["bank"]= "uni";
							$cotot ++;
//			if ($prih==0){
//			if ($dire<>$inpust){
			if ($eltran["type"]<>"2"){
				# изходящо 
										$tranelem["status"]= 0;
			}else{
				# входящо 
							$coinp ++;
				//# проверяваме за дублиране 
				//# ВНИМАНИЕ. 
				//# заместването на съдържанието трябва да е в същия ред 
				//$mycoun= $DB->selectCell($mysele  ,$date,$prih,toutf8($osno),toutf8($nomo),toutf8($docu));
				# проверяваме за дублиране - чрез кода на транзакцията 
				$mysele= "select count(id) as coun from finasource where reference=?";
				$mycoun= $DB->selectCell($mysele  ,$eltran["refe"]);
				if ($mycoun==0){
					# нов запис 
					$conew ++;
										$tranelem["status"]= 2;
				}else{
					# дублиран запис 
					$codub ++;
										$tranelem["status"]= 1;
				}
			}
										# елемента от масива с транзакциите 
										$artran[]= $tranelem;
		}
		# ще върнем основните параметри и статистиката с бройките 
		$resu["codub"]= $codub;
		$resu["conew"]= $conew;
		$resu["cotot"]= $cotot;
		$resu["coinp"]= $coinp;
													# 20.07.2009 - статус на транзакцията 
													# връщаме масива с транзакциите - всяка има и статус 
													$resu["transtat"]= $artran;
	# заглавните данни 
	$arhead= $arcont["CAPAccounts"]["ArrayOfAPAccounts"]["APAccount"]["BankAccount"];
//print_r($arhead);
		$resu["iban"]= $arhead["IBAN"]["value"];

//print_r($resu);
return $resu;
}



# връща запис за табл.finance 
function getfinance($arelem  ,$arorig=array()){
//print "<br>GETFINANCE<br>";
//print_rr($arorig);
	$fset= array();
			//$fset["inco"]= $arorig["suma"];
			$fset["inco"]= $arorig["prih"];
						//$fdes= array();
						//$fdes[]= $arorig["osno"];
						//$fdes[]= $arorig["nomo"];
						//$fdes[]= $arorig["docu"];
//			$fset["descrip"]= $arorig["osno"];
			$fset["descrip"]= $arelem["desc"];
//var_dump($fset["descrip"]);
//print_rr($fset);
return $fset;
}

# връща запис за табл.finasource 
function getfinasource($arelem  ,$arorig=array()){
//global $artabl;
//print "<br>getfinasource=<br>";
//print_rr($arorig);
//print_rr($arelem);
		$oset= array();
//	$oset["date"]= $arorig["date"];
//	$oset["desc1"]= $arorig["osno"];
	$oset["date"]= $arelem["date"];
	$oset["hour"]= $arelem["hour"];
	$oset["desc1"]= $arelem["desc"];
	$oset["reference"]= $arelem["refe"];
//					$oset["desc2"]= $arorig["nomo"];
//					$oset["desc3"]= $arorig["docu"];
//print_rr($oset);
return $oset;
}


?>
