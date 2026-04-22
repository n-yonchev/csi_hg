<?php
# всичко за импорт на xls файл от Банка ДСК 

function getxml($filename,$full){
global $DB;
//global $artabl;
#--- константи 
# кодове с началото на редовете 
#- Opening balance - начало 
$open1= ":60F:";
$open2= ":60M:";
#- Account identification 
$open3= ":25:";
#- Transaction Line - транзакцията 
$code61= ":61:";
#- Details of Payment [free text] - описания 
$min20= "20";
$max27= "27";
#- Closing balance - край 
$clos1= ":62F:";
$clos2= ":62M:";

			/*
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
			*/
# четем целия txt 
$arco= file($filename);
//print_rr($arco);
//		unset($arco[0]);
		# резултата - данните за поредната транзакция 
		$resu= array();
/*
					# броим дублираните и новите транзакции 
					$codub= 0;
					$conew= 0;
							# броим общо и входящите 
							$cotot= 0;
							$coinp= 0;
*/
					# броим дублираните и новите транзакции 
					$resu["codub"]= 0;
					$resu["conew"]= 0;
							# броим общо и входящите 
							$resu["cotot"]= 0;
							$resu["coinp"]= 0;
										# паралелно формираме масив с транзакциите 
										# всяка транзакция има и доп.поле - 
										# статус : 0=разход 1=постъп.дублирано 2=постъп.ново 
										//$artran= array();
				# флаг - обработена ли е поне 1 транзакция 
				$flag1= false;
# цикъл по редовете 
# ВНИМАНИЕ. Асихронна обработка. 
foreach($arco as $elem){
	$elem= trim($elem);
									//$ardesc= array();
//print "<br>$elem";
//var_dump($elem);
	# кода на реда 
	$suopen1= substr($elem,0,strlen($open1));
	$suopen2= substr($elem,0,strlen($open2));
	$suopen3= substr($elem,0,strlen($open3));
	$sucode61= substr($elem,0,strlen($code61));
	$sumin20= substr($elem,0,strlen($min20)) +0;
	$sumax27= substr($elem,0,strlen($max27)) +0;
	$suclos1= substr($elem,0,strlen($clos1));
	$suclos2= substr($elem,0,strlen($clos2));

	# обработваме според кода на реда 
	if (0){

	}elseif($suopen1==$open1 or $suopen2==$open2){
		#---------- начало на обработката ----------
		# $resu : iban, date1, date2, balance1, balance2 
//print "<br>---BEGIN---<br>";
//var_dump($elem);
/*
				$date1= substr($elem,6,6);
		$resu["date1"]= datetran($date1);
				$cucy= substr($elem,12,3);
				$bala1= substr($elem,15);
				$bala1= str_replace(",",".",$bala1);
				$bala1= number-format($bala1,2,".",",");
		$resu["balance1"]= $bala1." ".$cucy;
*/
		list($resu["date1"],$resu["balance1"])= wraptran($elem);

	}elseif($suopen3==$open3){
		#---------- данни за сметката ----------
		# $resu : iban, date1, date2, balance1, balance2 
//print "<br>---Account---<br>";
//var_dump($elem);
		$resu["iban"]= substr($elem,4);

	}elseif($sucode61==$code61){
		#---------- начало на поредна транзакция ----------
				# записваме предишната 
				if ($flag1){
//print "<br>===========end transaction============<br>";
//					$artran= endtran($artran,$ardesc);
					# приключваме поредната транзакция 
					endtran($artran,$ardesc,$resu);
//print "<br>[$date][$dire][$suma][$refe]";
//print_rr($ardesc);
				}else{
				}
				# вече има обработена транзакция 
				$flag1= true;
		# обработваме поредната 
//print "<br>===========begin transaction============<br>";
										# изчистваме транзакцията 
										//$artran= array();
										# изчистваме описанията 
										$ardesc= array();
					$padate= substr($elem,4,6);
//					$ye= substr($padate,0,2);
//					$mo= substr($padate,2,2);
//					$da= substr($padate,4,2);
//				$artran["date"]= "$da.$mo.20$ye";
				$artran["date"]= datetran($padate);
				$artran["dire"]= substr($elem,14,1);
							$osta= substr($elem,15);
							$ind1= strpos($osta,"N");
							if ($ind1===false){
var_dump($elem);
die("error=1");
							}else{
							}
							$ind2= strpos($osta,"//");
							if ($ind2===false){
var_dump($elem);
die("error=2");
							}else{
							}
					$pasuma= substr($osta,0,$ind1);
				$artran["suma"]= str_replace(",",".",$pasuma);
				$artran["refe"]= substr($osta,$ind2+2);
//print "<br>[$date][$dire][$suma][$refe]";

	}elseif($sumin20>=$min20 and $sumax27<=$max27){
		#---------- описанията на поредната транзакция ----------
//print "<br>-------description-----------<br>";
										//$ardesc[$sumin20]= substr($elem,strlen($min20));
		$d1= substr($elem,strlen($min20));
		$d2= iconv("cp866","UTF-8",$d1);
		if (substr($d2,-1)=="+"){
			$d2= trim(substr($d2,0,strlen($d2)-1));
		}else{
		}
										$ardesc[$sumin20]= $d2;

	}elseif($suclos1==$clos1 or $suclos2==$clos2){
		#---------- край на обработката ----------
		# $resu : iban, date1, date2, balance1, balance2 
//print "<br>===========end transaction============<br>";
//print "<br>[$date][$dire][$suma][$refe]";
//print_rr($ardesc);
//					$artran= endtran($artran,$ardesc);
					# приключваме поредната транзакция 
					endtran($artran,$ardesc,$resu);
//print "<br>---END---<br>";
//var_dump($elem);
/*
				$date2= substr($elem,6,6);
				$cucy= substr($elem,12,3);
				$bala2= substr($elem,15);
		$resu["date2"]= datetran($date1);
		$resu["balance2"]= $bala2." ".$cucy;
*/
		list($resu["date2"],$resu["balance2"])= wraptran($elem);
		# край 
//print_rr($resu);
		break;

	}else{
	}

# край на цикъла по редовете 
}
/*
		# връщаме основните параметри и статистиката с бройките 
		$resu["codub"]= $codub;
		$resu["conew"]= $conew;
		$resu["cotot"]= $cotot;
		$resu["coinp"]= $coinp;
										# връщаме и масива с транзакциите и техните статуси 
										$resu["transtat"]= $artran;
*/

//print_rr($resu);
return $resu;
}



# връща запис за табл.finance 
function getfinance($arelem  ,$arorig=array()){
//print "<br>GETFINANCE<br>";
//print_rr($arorig);
	$fset= array();
			$fset["inco"]= $arelem["prih"];
						//$fdes= array();
						//$fdes[]= $arorig["osno"];
						//$fdes[]= $arorig["nomo"];
						//$fdes[]= $arorig["docu"];
//						$fdes[]= $arorig["REM_II"]["value"];
//					$fset["descrip"]= implode(" ",$fdes);
			$fset["descrip"]= $arelem["desc1"]." ".$arelem["desc2"]." ".$arelem["desc3"]." ".$arelem["desc4"];
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
					$oset["desc1"]= $arelem["desc1"];
					$oset["desc2"]= $arelem["desc2"];
					$oset["desc3"]= $arelem["desc3"];
					$oset["desc4"]= $arelem["desc4"];
		$oset["hour"]= $arorig["hour"];
		$oset["reference"]= $arorig["refe"];
//print_rr($oset);
return $oset;
}


# приключване на поредната транзакция 
function endtran(&$artran,$ardesc,&$resu){
global $DB;
								# специално за различаване на формата 
								$artran["bank"]= "dsk";
	# евентуално час 
	if (substr($ardesc[22],-3,1)==":"){
		$artran["hour"]= substr($ardesc[22],-5);
	}else{
	}
	# описанията 
	$artran["desc1"]= $ardesc[20];
	$artran["desc2"]= $ardesc[21];
	$artran["desc3"]= $ardesc[22];
		unset($ardesc[20]);
		unset($ardesc[21]);
		unset($ardesc[22]);
	$artran["desc4"]= implode(" ",$ardesc);
										# статуса 
										$artran["status"]= 0;
												$resu["cotot"] ++;
	# доп.полета - приход/разход 
	if ($artran["dire"]=="C"){
		$artran["prih"]= $artran["suma"];
		$artran["razh"]= "";
												$resu["coinp"] ++;
			# само за прихода 
			# проверяваме за дублиране - чрез кода на транзакцията 
			$mysele= "select count(id) as coun from finasource where reference=?";
			$mycoun= $DB->selectCell($mysele  ,$artran["refe"]);
		if ($mycoun==0){
										# нов запис 
										$artran["status"]= 2;
												$resu["conew"] ++;
		}else{
										# дублиран запис 
										$artran["status"]= 1;
												$resu["codub"] ++;
		}
	}else{
		$artran["prih"]= "";
		$artran["razh"]= $artran["suma"];
	}
	
	# накрая 
	# добавяме поредната транзакция към масива с транзакциите 
	$resu["transtat"][]= $artran;

//print_rr($artran);
//return $artran;
}

# трансформация на дата 
function datetran($padate){
		$ye= substr($padate,0,2);
		$mo= substr($padate,2,2);
		$da= substr($padate,4,2);
	$resu= "$da.$mo.20$ye";
return $resu;
}

# трансформация на нач. и крайния запис 
function wraptran($elem){
		$resu= array();
				$date1= substr($elem,6,6);
		$resu[0]= datetran($date1);
				$cucy= substr($elem,12,3);
				$bala1= substr($elem,15);
				$bala1= str_replace(",",".",$bala1);
				$bala1= number_format($bala1,2,".",",");
		$resu[1]= $bala1." ".$cucy;
return $resu;
}


?>
