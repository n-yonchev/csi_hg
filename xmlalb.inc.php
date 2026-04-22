<?php
/*
					# съответствие на полетата от finasource с вътр.имена - виж list()= 
					$artabl= array();
					$artabl["date"]= "date";
					$artabl["amount"]= "prih";
					$artabl["desc1"]= "osno";
					$artabl["desc2"]= "nomo";
					$artabl["desc3"]= "docu";
*/
# таблица за месеците 
$mota= array();
$mota["Jan"]= "01";
$mota["Feb"]= "02";
$mota["Mar"]= "03";
$mota["Apr"]= "04";
$mota["May"]= "05";
$mota["Jun"]= "06";
$mota["Jul"]= "07";
$mota["Aug"]= "08";
$mota["Sep"]= "09";
$mota["Oct"]= "11";
$mota["Nov"]= "11";
$mota["Dec"]= "12";

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
					# заявка за проверка на дублирането - по кода на транзакцията 
					$mysele= "select count(id) as coun from finasource where reference=?";
		# четем csv без 1вия ред 
		$arco= file($filename);
//print_rr($arco);
		unset($arco[0]);
//print_rr($arco);
		# обработваме - разделителя е , 
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
//$myroww= explode(",",$elem);
//print_r($myroww);
			list($valo,$date,$suma,$dire,$d1,$refe,$d2,$sequ)= explode(",",$elem);
			$valo= trim($valo);
			$date= trim($date);
			$suma= trim($suma);
			$dire= trim($dire);
			$d1= trim($d1);
			$refe= trim($refe);
			$d2= trim($d2);
			$sequ= trim($sequ);
					# специфична трансформация на датите 
					$valo= datetran($valo);
					$date= datetran($date);
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
//print "<br>BASIC<br>";
//print "[$nomo][$docu][$osno]";
										# елемента от масива с транзакциите 
										$tranelem= array();
												# специално за различаване на формата 
												$tranelem["bank"]= "alb";
										/*
										foreach($artabl as $finame=>$vaname){
											$tranelem[$finame]= ${$vaname};
										}
										*/
										$tranelem["valo"]= $valo;
										$tranelem["date"]= $date;
										$tranelem["suma"]= $suma;
										$tranelem["dire"]= $dire;
										$tranelem["d1"]= $d1;
										$tranelem["refe"]= $refe;
										$tranelem["d2"]= $d2;
										$tranelem["sequ"]= $sequ;
												# доп.полета - приход/разход 
												if ($dire=="C"){
										$tranelem["prih"]= $suma;
										$tranelem["razh"]= "";
												}else{
										$tranelem["prih"]= "";
										$tranelem["razh"]= $suma;
												}
							$cotot ++;
//			if ($prih==0){
			if ($dire<>"C"){
				# изходящо 
										$tranelem["status"]= 0;
			}else{
				# входящо 
							$coinp ++;
				# проверяваме за дублиране 
				# 2 полета - за уникалност - полето "refe" е дублирано 
				$mycoun= $DB->selectCell($mysele  ,refeuniq($refe,$sequ));
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

//print_r($resu);
return $resu;
}



# връща запис за табл.finance 
function getfinance($arelem  ,$arorig=array()){
//print "<br>GETFINANCE<br>";
//print_rr($arorig);
	$fset= array();
				$fset["inco"]= $arorig["suma"];
						$fdes= array();
						$fdes[]= $arorig["d1"];
						$fdes[]= $arorig["d2"];
//						$fdes[]= $arorig["docu"];
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
					$oset["desc1"]= $arorig["d1"];
					$oset["desc2"]= $arorig["d2"];
					//$oset["desc3"]= $arorig["docu"];
					//$oset["desc4"]= $arorig["REM_II"]["value"];
		# 2 полета - за уникалност - полето "refe" е дублирано 
		$oset["reference"]= refeuniq($arorig["refe"],$arorig["sequ"]);
//print_rr($oset);
return $oset;
}


# специфична трансформация на датите 
function datetran($p1){
global $mota;
	$da= substr($p1,8,2);
	$mo= $mota[substr($p1,4,3)];
	$ye= substr($p1,-4);
return "$da.$mo.$ye";
}

# 2 полета - за уникалност - полето "refe" е дублирано 
function refeuniq($p1,$p2){
return $p1."-".$p2;
}


?>
