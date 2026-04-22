<?php
					# съответствие на полетата от finasource с вътр.имена - виж list()= 
					$artabl= array();
					$artabl["date"]= "date";
					$artabl["amount"]= "prih";
					$artabl["desc1"]= "osno";
					$artabl["desc2"]= "nomo";
					$artabl["desc3"]= "docu";

function getxml($filename,$full){
global $DB;
global $artabl;
			/*
					# съответствие на полетата от finasource с вътр.имена - виж list()= 
					$artabl["date"]= "date";
					$artabl["amount"]= "prih";
					$artabl["desc1"]= "osno";
					$artabl["desc2"]= "nomo";
					$artabl["desc3"]= "docu";
			*/
					//# заявка за проверка на дублирането 
					//			$arwh= array();
					//foreach($artabl as $finame=>$x2){
					//			$arwh= $finame."='".."'"
					//}
					//$mysele= "select count(id) as coun from finasource where reference=?";
					# заявка за проверка на дублирането 
					# полетата и съдържанието им трябва да е в същия ред 
					# ВНИМАНИЕ. 
					# няма код на транзакцията, затова използваме всичките полета 
					$mysele= "select count(id) as coun from finasource where date=? and amount=? and desc1=? and desc2=? and desc3=?";
		# четем csv без 1вия ред 
		$arco= file($filename);
//print_rr($arco);
		unset($arco[0]);
		# обработваме - разделителя е ; 
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
		foreach($arco as $elem){
			list($oper,$date,$valo,$prih,$razh,$nomo,$docu,$osno)= explode(";",$elem);
			$oper= trim($oper);
			$date= trim($date);
			$valo= trim($valo);
			$prih= trim($prih);
			$razh= trim($razh);
			$nomo= trim($nomo);
			$docu= trim($docu);
			$osno= trim($osno);
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
//print "<br>BASIC<br>";
//print "[$nomo][$docu][$osno]";
										# елемента от масива с транзакциите 
										$tranelem= array();
												# специално за различаване на формата 
												$tranelem["bank"]= "ccb";
										/*
										foreach($artabl as $finame=>$vaname){
											$tranelem[$finame]= ${$vaname};
										}
										*/
										$tranelem["oper"]= $oper;
										$tranelem["date"]= $date;
										$tranelem["valo"]= $valo;
										$tranelem["prih"]= $prih;
										$tranelem["razh"]= $razh;
										$tranelem["nomo"]= $nomo;
										$tranelem["docu"]= $docu;
										$tranelem["osno"]= $osno;
							$cotot ++;
			if ($prih==0){
				# изходящо 
										$tranelem["status"]= 0;
			}else{
				# входящо 
							$coinp ++;
				# проверяваме за дублиране 
				# ВНИМАНИЕ. 
				# заместването на съдържанието трябва да е в същия ред 
				$mycoun= $DB->selectCell($mysele  ,$date,$prih,toutf8($osno),toutf8($nomo),toutf8($docu));
//print "cyrillic=[".toutf8($osno)."]";
//print "<br>[$mycoun][$prih][$osno]";
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
		# връщаме основните параметри и статистиката с бройките 
		$resu["codub"]= $codub;
		$resu["conew"]= $conew;
		$resu["cotot"]= $cotot;
		$resu["coinp"]= $coinp;
										# връщаме и масива с транзакциите и техните статуси 
										$resu["transtat"]= $artran;

return $resu;
}



/*
# връща запис за табл.finance 
function getfinance($arelem  ,$arorig=array()){
//print "<br>GETFINANCE<br>";
//print_rr($arorig);
	$fset= array();
//					$fset["iduser"]= $_SESSION["iduser"];
						$fset["inco"]= $arorig["amount"];
	$fset["inco"]= str_replace(",","",$fset["inco"]);
	# специфична трансформация само за ЦКБ 
	$fset["inco"]= str_replace("`","",$fset["inco"]);
						$fdes= array();
						$fdes[]= $arorig["desc1"];
						$fdes[]= $arorig["desc2"];
						$fdes[]= $arorig["desc3"];
//						$fdes[]= $arorig["REM_II"]["value"];
					$fset["descrip"]= implode(" ",$fdes);
//var_dump($fset["descrip"]);
//print_rr($fset);
return $fset;
}
*/

# връща запис за табл.finance 
function getfinance($arelem  ,$arorig=array()){
//print "<br>GETFINANCE<br>";
//print_rr($arorig);
	$fset= array();
//					$fset["iduser"]= $_SESSION["iduser"];
						$fset["inco"]= $arorig["prih"];
//	$fset["inco"]= str_replace(",","",$fset["inco"]);
//	# специфична трансформация само за ЦКБ 
//	$fset["inco"]= str_replace("`","",$fset["inco"]);
						$fdes= array();
						$fdes[]= $arorig["osno"];
						$fdes[]= $arorig["nomo"];
						$fdes[]= $arorig["docu"];
//						$fdes[]= $arorig["REM_II"]["value"];
					$fset["descrip"]= implode(" ",$fdes);
//var_dump($fset["descrip"]);
//print_rr($fset);
return $fset;
}

# връща запис за табл.finasource 
function getfinasource($arelem  ,$arorig=array()){
global $artabl;
//print "<br>getfinasource=<br>";
//print_rr($arorig);
		$oset= array();
					$oset["date"]= $arorig["date"];
					//$oset["hour"]= "";
//					$oset["amount"]= $fset["inco"];
					$oset["desc1"]= $arorig["osno"];
					$oset["desc2"]= $arorig["nomo"];
					$oset["desc3"]= $arorig["docu"];
					//$oset["desc4"]= $arorig["REM_II"]["value"];
					//$oset["reference"]= $arorig["REFERENCE"]["value"];
//print_rr($oset);
return $oset;
}


?>
