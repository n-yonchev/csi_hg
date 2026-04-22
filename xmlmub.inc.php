<?php
# всичко за импорт на xls файл от Общинска банка 

	# масива за откриване на заглавните данни 
	# индекс - име на полето 
	# съдържание : 
	#    индекс за търсене 
	#    стринг за търсене 
	#    индекс за извличане съдържанието на полето 
	$arfiel= array(
		"iban" => array(0, "Номер на банкова сметка", 4)
//		,"date1" => array(0, "Прериод от - до", 4)
//		,"date2" => array(0, "Прериод от - до", 4)
		,"date" => array(0, "Прериод от - до", 4, "funcdate")
		,"balance1" => array(0, "Салдо в началото на периода", 4, "funcsuma")
//		,"balance2" => array(0, "Номер на банкова сметка", 4)
		);
	$arfiel= toutf8($arfiel);

function getxml($filename,$full){
global $DB;
//global $artabl;
global $arfiel;
#--- константи 
# пътя за класа за четене от excel 
$expath= "excel_reader/";
# за ред с данни - в датата 
$indate= toutf8("г.");
# стринг за входящо постъпление 
$inpust= toutf8("Kt");
					//# заявка за проверка на дублирането 
					//			$arwh= array();
					//foreach($artabl as $finame=>$x2){
					//			$arwh= $finame."='".."'"
					//}
					//$mysele= "select count(id) as coun from finasource where reference=?";
				//	# заявка за проверка на дублирането 
				//	# полетата и съдържанието им трябва да е в същия ред 
				//	# ВНИМАНИЕ. 
				//	# няма код на транзакцията, затова използваме всичките полета 
				//	$mysele= "select count(id) as coun from finasource where date=? and amount=? and desc1=? and desc2=? and desc3=?";
# четем целия xls 
$arco= file_get_contents($filename);
//print_rr($arco);
//		unset($arco[0]);

# подготовка за трансформацията xls - масив 
require_once $expath .'CompoundDocument.inc.php';
require_once $expath .'BiffWorkbook.inc.php';
$doc = new CompoundDocument ('utf-8');
		$doc->parse ($arco);
$wb = new BiffWorkbook ($doc);
$wb->parse();

# трансформираме xls в масив - само 1вата страница 
				# само 1вата страница 
				$flag= false;
foreach ($wb->sheets as $sheetName=>$sheet){
				if ($flag){
					break;
				}else{
					$flag= true;
				}
								$shcont= array();
	for ($row=0; $row<$sheet->rows(); $row ++){
		for ($col=0; $col<$sheet->cols(); $col ++){
			if (!isset ($sheet->cells [$row][$col])) continue;
			$cell = $sheet->cells [$row][$col];
//echo is_null ($cell->value) ? '' : "<br>[$row][$col]=".$cell->value;
								$shcont[$row][$col]= $cell->value;
		}
	}
								//print_rr($shcont);
}
# получихме масива $shcont 

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
	foreach($shcont as $elem){
/*
			list($oper,$date,$valo,$prih,$razh,$nomo,$docu,$osno)= explode(";",$elem);
			$oper= trim($oper);
			$date= trim($date);
			$valo= trim($valo);
			$prih= trim($prih);
			$razh= trim($razh);
			$nomo= trim($nomo);
			$docu= trim($docu);
			$osno= trim($osno);
*/
		# различаваме ред с данни по датата 
		$codate= $elem[0];
//print "<br>CODATE=$codate";
		list($par1,$par2)= explode(" ",$codate);
		if ($par2==$indate){
//print "=OK=$par1";
//print "<br>$par1";
			#--- ОК - зареждаме полетата 
			# датата 
			$date= trim($par1);
			# кода на транзакцията [бордеро номер] 
			$codetran= $elem[2];
			$codetran= trim($codetran);
			# основанието 
			$osno= $elem[4];
			$osno= trim($osno);
			# валутата 
			$cucy= $elem[8];
			$cucy= trim($cucy);
			# сумата 
			$suma= $elem[9];
			$suma= trim($suma);
			# посоката =Dt/Kt интересуват ни Kt=входящи 
			$dire= $elem[11];
			$dire= trim($dire);
			# вальор - дата 
			$valo= $elem[12];
			$valo= trim($valo);
				list($par1,$par2)= explode(" ",$valo);
			$valo= $par1;
			# салдо - не ни интересува 
			$sald= $elem[14];
			$sald= trim($sald);
/*	
					# специфична трансформация само за ЦКБ 
					# ако в текста има " - те са представени като "", а целия текст е заграден в други " 
					# затова ги премахваме изобщо 
					$nomo= str_replace("\"","",$nomo);
					$docu= str_replace("\"","",$docu);
					$osno= str_replace("\"","",$osno);
					# премахваме и единичната кавичка ' 
						$nomo= str_replace("'","",$nomo);
						$docu= str_replace("'","",$docu);
						$osno= str_replace("'","",$osno);
			# трансформации в сумата 
			$prih= str_replace(",","",$prih);
			# специфична трансформация само за ЦКБ 
			$prih= str_replace("`","",$prih);
*/
			#--- специфични трансформации 
			# премахваме кавичките в основанието 
			$osno= str_replace("\"","",$osno);
			$osno= str_replace("'","",$osno);
			# в сумата запетаята става точка 
			$suma= str_replace(",",".",$suma);
/*****
print "<br>suma=";
for($i=0; $i<strlen($sald); $i++){
	$lett= substr($sald,$i,1);
	print "<br>$lett=" .ord($lett);
}
print "<br>suma-end";
*****/
			# установено експериментално 
			# в сумата и салдото chr(160) беше разделител на хилядите - премахваме го 
			$suma= str_replace(chr(160),"",$suma);
										
										# елемента от масива с транзакциите 
										$tranelem= array();
												# специално за различаване на формата 
												$tranelem["bank"]= "mub";
										$tranelem["date"]= $date;
										$tranelem["codetran"]= $codetran;
										$tranelem["osno"]= $osno;
										$tranelem["cucy"]= $cucy;
										$tranelem["suma"]= $suma;
										$tranelem["dire"]= $dire;
												# доп.полета - приход/разход 
												if ($dire==$inpust){
										$tranelem["prih"]= $suma;
										$tranelem["razh"]= "";
												}else{
										$tranelem["prih"]= "";
										$tranelem["razh"]= $suma;
												}
										$tranelem["valo"]= $valo;
										$tranelem["sald"]= $sald;
							$cotot ++;
//			if ($prih==0){
			if ($dire<>$inpust){
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
				$mycoun= $DB->selectCell($mysele  ,$codetran);
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
		}else{
			# реда не е с данни, търсим заглавни данни за индексите 
			# $resu : iban, date1, date2, balance1, balance2 
			foreach($arfiel as $finame=>$fidefi){
				list($ind1,$sfin,$ind2,$usfu)= $fidefi;
//print "<br>$finame=$usfu=$sfin";
//print "<br>ELEM-IND1=" .$elem[$ind1];
				if ($elem[$ind1]==$sfin){
					$e2= $elem[$ind2];
					if (empty($usfu)){
								$resu[$finame]= $e2;
					}else{
//print "<br><br>FINAME=$finame---------------<br>";
//print_rr($resu);
						//call_user_func($usfu, $e2,$resu);
						$resu= call_user_func($usfu, $e2,$resu);
//print_rr($resu);
					}
				}else{
				}
			}
		# край if ($par2==$indate){
		}
	}
# връщаме основните параметри и статистиката с бройките 
		$resu["codub"]= $codub;
		$resu["conew"]= $conew;
		$resu["cotot"]= $cotot;
		$resu["coinp"]= $coinp;
										# връщаме и масива с транзакциите и техните статуси 
										$resu["transtat"]= $artran;

return $resu;
}

# трансформиращи функции за заглавните данни 
# ВНИМАНИЕ. масива $resu се предава by reference 
//function funcdate($p1, &$resu){
function funcdate($p1, $resu){
	list($d1,$d2)= explode("-",$p1);
	$d1= trim($d1);
	$d2= trim($d2);
	list($par1,$par2)= explode(" ",$d1);
$resu["date1"]= $par1;
	list($par1,$par2)= explode(" ",$d2);
$resu["date2"]= $par1;
return $resu;
}
//function funcsuma($p1, &$resu){
function funcsuma($p1, $resu){
	//list($d1,$d2)= explode("-",$p1);
	//$d1= trim($d1);
	//$d2= trim($d2);
			# в сумата запетаята става точка 
			$p1= str_replace(",",".",$p1);
			# установено експериментално 
			# в сумата и салдото chr(160) беше разделител на хилядите - премахваме го 
			$p1= str_replace(chr(160),"",$p1);
$resu["balance1"]= $p1;
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
			$fset["descrip"]= $arelem["osno"];
//var_dump($fset["descrip"]);
//print_rr($fset);
return $fset;
}

# връща запис за табл.finasource 
function getfinasource($arelem  ,$arorig=array()){
//global $artabl;
//print "<br>getfinasource=<br>";
//print_rr($arorig);
		$oset= array();
//	$oset["date"]= $arorig["date"];
//	$oset["desc1"]= $arorig["osno"];
	$oset["date"]= $arelem["date"];
	$oset["desc1"]= $arelem["osno"];
	$oset["reference"]= $arelem["codetran"];
//					$oset["desc2"]= $arorig["nomo"];
//					$oset["desc3"]= $arorig["docu"];
//print_rr($oset);
return $oset;
}


?>
