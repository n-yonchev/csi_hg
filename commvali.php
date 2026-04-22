<?php

#---------------------------- валидиращи функции ----------------------------- 

# масив с изрази за проверка според валидатора 
# ако израза върне true, това е грешка 
$evalvali["notempty"]= '$value==""';
$evalvali["notzero"]= '$value==0';
$evalvali["integer"]= '!(preg_match(\'/^[0-9]+$/\',$value) and $value+0 >0)';
				#---- юни-2008 ------------------------------------
				# цяло число, може и нула, заради общия брой места за Клас 
				# Безсмислица ! 
$evalvali["intezero"]= '!(preg_match(\'/^[0-9]+$/\',$value))';
//$evalvali["email"]= '!(preg_match(\'TPLEMAIL\',$value))';

define("TPLEMAIL", "#^[A-Z0-9._-]{1,}@[A-Z0-9.-]{1,}\.[A-Z]{2,6}$#msi");
$tpem= str_replace("[EEEE]",TPLEMAIL,'!(preg_match(\'[EEEE]\',$value))');
$evalvali["email"]= $tpem;

//$evalvali["uszip"]= '!(preg_match(\'/^[0-9]{5}$/\',$value))';
$evalvali["uszip"]= '!(preg_match(\'#^[0-9]{5}$#msi\',$value))';
/*
# запис за промяна на кредит 
# не нула, без знак или с минус отпред, цяло или с точно 2 дес.знака 
$evalvali["creditrecord"]= '!(preg_match(\'/^[-]?[0-9]+(\.[0-9]{2})?$/\',$value))';
# поле за ползване на кредит 
# не нула, без знак БЕЗ МИНУС отпред, цяло или с точно 2 дес.знака 
$evalvali["creditusage"]= '!(preg_match(\'/^[0-9]+(\.[0-9]{2})?$/\',$value))';
*/
# поле за сума (пари) 
# не нула, без знак БЕЗ МИНУС отпред, цяло или с точно 2 дес.знака 
$evalvali["amount"]= '!(preg_match(\'/^[0-9]+(\.[0-9]{2})?$/\',$value))';
	
# универсален валидатор 
# вика се от отделните валидатори 
function univalidator($namevali,$value,$elempara){
	$exvali= $GLOBALS["evalvali"][$namevali];
//print "<br>univali=[$namevali][$value][$exvali]";
//$elname= $elempara["name"];
//print "<br>univali=[$namevali][$value][$exvali]elname=[$elname]";
	eval("\$result= ($exvali);");
	if ($result){
		$elname= $elempara["name"];
return array($GLOBALS["filist"][$elname]["error"]);
	}else{
return true;
	}
}

# отделни валидатори 
function validator_notempty($value,$elempara){
return univalidator("notempty",$value,$elempara);
}

function validator_notzero($value,$elempara){
return univalidator("notzero",$value,$elempara);
}

function validator_integer($value,$elempara){
return univalidator("integer",$value,$elempara);
}

function validator_intezero($value,$elempara){
return univalidator("intezero",$value,$elempara);
}
/*
function validator_creditrecord($value,$elempara){
return univalidator("creditrecord",$value,$elempara);
}

function validator_creditusage($value,$elempara){
return univalidator("creditusage",$value,$elempara);
}
*/
function validator_amount($value,$elempara){
$resuinte= univalidator("amount",$value,$elempara);
//var_dump($resuinte);
return univalidator("amount",$value,$elempara);
}

function validator_email($value,$elempara){
return univalidator("email",$value,$elempara);
}

function validator_uszip($value,$elempara){
return univalidator("uszip",$value,$elempara);
}

#------------- самостоятелни комплексни валидатори ----------------- 

function validator_date_valid_notempty($value,$elempara){
	if ($value==""){
return array("датата е задължително поле");
	}else{
		if (preg_match('/^\d{4}-\d{2}-\d{2}$/',$value)){
			list($ye,$mo,$da)= explode("-",$value);
			if (checkdate($mo+0,$da+0,$ye+0)){
return true;
			}else{
return array("невъзможна дата");
			}
		}else{
return array("грешна дата");
		}
	}
}

function validator_bgdate_valid_notempty($value,$elempara){
	if ($value==""){
return array("датата е задължително поле");
	}else{
//		if (preg_match('/^\d{4}-\d{2}-\d{2}$/',$value)){
			list($da,$mo,$ye)= explode(".",$value);
								# 05.11.2009 - Софрониев 
								$da= trim($da);
								$mo= trim($mo);
								$ye= trim($ye);
/*
			if ($ye>=2000){
			}else{
return array("грешна година");
			}
*/
						#-------------------------------------
						# 19.11.2009 
						$yelen= strlen($ye);
						if ($yelen==4){
						}elseif ($yelen==2){
							$ye= "20" .$ye;
						}else{
return array("грешна година");
						}
						#-------------------------------------
			if (checkdate($mo+0,$da+0,$ye+0)){
return true;
			}else{
return array("невъзможна дата");
			}
//		}else{
//return array("грешна дата");
//		}
	}
}

function validator_bgdate_valid($value,$elempara){
	if ($value==""){
//return array("датата е задължително поле");
return true;
	}else{
			list($da,$mo,$ye)= explode(".",$value);
								# 05.11.2009 - Софрониев 
								$da= trim($da);
								$mo= trim($mo);
								$ye= trim($ye);
/*
			if ($ye>=2000){
			}else{
return array("грешна година");
			}
*/
						#-------------------------------------
						# 19.11.2009 
						$yelen= strlen($ye);
						if ($yelen==4){
						}elseif ($yelen==2){
							$ye= "20" .$ye;
						}else{
return array("грешна година");
						}
						#-------------------------------------
			if (checkdate($mo+0,$da+0,$ye+0)){
return true;
			}else{
return array("невъзможна дата");
			}
	}
}

function validator_integer_or_empty($value,$elempara){
	if ($value==""){
return true;
	}else{
		$resuinte= univalidator("integer",$value,$elempara);
		if ($resuinte){
return true;
		}else{
$elname= $elempara["name"];
return array($GLOBALS["filist"][$elname]["error"]);
		}
	}
}

function validator_amount_or_empty($value,$elempara){
	if ($value==""){
return true;
	}else{
		$resuinte= univalidator("amount",$value,$elempara);
//var_dump($resuinte);
# ВНИМАНИЕ. 
# оправи и на другите комплексни валидатори ===true 
# иначе непразния стринг минава като че няма грешка 
		if ($resuinte===true){
return true;
		}else{
$elname= $elempara["name"];
return array($GLOBALS["filist"][$elname]["error"]);
		}
	}
}
function validator_amount_not_zero($value,$elempara){
/*
	if ($value==""){
return true;
	}else{
*/
		$resuinte= univalidator("amount",$value,$elempara);
//var_dump($resuinte);
# ВНИМАНИЕ. 
# оправи и на другите комплексни валидатори ===true 
# иначе непразния стринг минава като че няма грешка 
		if ($resuinte===true and $value+0<>0){
return true;
		}else{
$elname= $elempara["name"];
return array($GLOBALS["filist"][$elname]["error"]);
		}
//	}
}

function validator_percent_or_empty($value,$elempara){
	if ($value==""){
return true;
	}else{
		$resuinte= univalidator("integer",$value,$elempara);
		if ($resuinte and $value<100){
return true;
		}else{
$elname= $elempara["name"];
return array($GLOBALS["filist"][$elname]["error"]);
		}
	}
}

function validator_email_or_empty($value,$elempara){
	if ($value==""){
return true;
	}else{
		$resuinte= univalidator("email",$value,$elempara);
		if ($resuinte===true){
return true;
		}else{
$elname= $elempara["name"];
return array($GLOBALS["filist"][$elname]["error"]);
		}
	}
}

function validator_caseexi($value,$elempara){
global $DB;
//	if ($value==""){
	if (empty($value)){
return true;
	}else{
				list($caseri,$cayear)= explode("/",$value);
				if (substr($cayear,0,2)=="20"){
				}else{
					$cayear= "20" .$cayear;
				}
				$coun= $DB->selectCell("select count(*) from suit where serial=?d and year=?d"  ,$caseri,$cayear);
		if ($coun==1){
return true;
		}elseif ($coun==0){
$elname= $elempara["name"];
return array($GLOBALS["filist"][$elname]["error"]);
		}else{
die("caseexi=$coun");
		}
	}
}

#--- дата, която се въвежда/корегира в бг формат [d.m.y], а се съхранява в MySQL [yyyy-mm-dd] 
# get : mysql -> bg 
# put : обратно 
function getputbgdate($dire,$paid,$finame,$ardata){
	$value= $ardata[$finame];
//print "[$dire][$paid][$finame][$value]";
	if (0){
	}elseif ($dire=="get"){
		if (empty($value)){
return "";
		}else{
			$mydate= substr($value,0,10);
			list($ye,$mo,$da)= explode("-",$mydate);
//print "[$ye][$mo][$da]";
			$da= $da +0;
			$mo= $mo +0;
return "$da.$mo.$ye";
		}
	}elseif ($dire=="put"){
		if (empty($value)){
return "";
		}else{
			list($da,$mo,$ye)= explode(".",$value);
								# 05.11.2009 - Софрониев 
								$da= trim($da);
								$mo= trim($mo);
								$ye= trim($ye);
//print "[$value][$ye][$mo][$da]";
			$da= str_pad($da,2,"0",STR_PAD_LEFT);
			$mo= str_pad($mo,2,"0",STR_PAD_LEFT);
//			if (substr($ye,0,2)=="20"){
			if (strlen($ye)==4){
			}else{
				$ye= "20" .$ye;
			}
return "$ye-$mo-$da";
		}
	}else{
die("GPbgdate=$dire");
	}
}

#--- дело, въвежда се номер/година, а се съхранява suit.id 
# get : mysql suit.id -> номер/година 
# put : обратно 
function getputcase($dire,$paid,$finame,$ardata){
global $DB;
	$value= $ardata[$finame];
//print "[$dire][$paid][$finame][$value]";
	if (0){
	}elseif ($dire=="get"){
		if (empty($value)){
return "";
		}else{
			$rocase= getrow("suit",$value);
return $rocase["serial"] ."/" .$rocase["year"];
		}
	}elseif ($dire=="put"){
		if (empty($value)){
return "";
		}else{
			list($caseri,$cayear)= explode("/",$value);
			if (substr($cayear,0,2)=="20"){
			}else{
				$cayear= "20" .$cayear;
			}
			$caid= $DB->selectCell("select id from suit where serial=?d and year=?d"  ,$caseri,$cayear);
return $caid;
		}
	}else{
die("GPcase=$dire");
	}
}

/*
#--- checkbox =1,0 
# get : 1/0 от даните стават on/[space] 
# put : обратно 
function getputcbox($dire,$paid,$finame,$ardata){
	$value= $ardata[$finame];
	if (0){
	}elseif ($dire=="get"){
		if ($value+0==0){
return "0";
		}else{
//return "on";
return "1";
		}
	}elseif ($dire=="put"){
		if (isset($value)){
return 1;
		}else{
return 0;
		}
	}else{
die("GPcbox=dire=$dire");
	}
}
*/


# 30.10.2009 
# допълнителни правила за паролата 
function userpass($pass,$user,$passhist){
//			$pass= $_POST["password"];
			# да има минимум 6 символа 
			if (strlen($pass)<6){
return "съдържа по-малко от 6 символа";
			}else{
				# да е различна от username 
//				if ($pass==$_POST["username"]){
				if ($pass==$user){
return "съвпада с входното име";
				}else{
					# да съдържа поне 1 главна буква 
					$inlist= passlist($pass,"ABCDEFGHIJKLMNOPQRSTUVWXYZАБВГДЕЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЬЮЯ");
					if (!$inlist){
return "не съдържа поне 1 главна буква";
					}else{
						# да съдържа поне 1 малка буква 
						$inlist= passlist($pass,"abcdefghijklmnopqrstuvwxyzабвгдежзийклмнопрстуфхцчшщъьюя");
						if (!$inlist){
return "не съдържа поне 1 малка буква";
						}else{
							# да съдържа поне 1 цифра 
							$inlist= passlist($pass,"0123456789");
							if (!$inlist){
return "не съдържа поне 1 цифра";
							}else{
							}
						}
					}
				}
			}
	# формално е ОК
	# проверяваме да не повтаря минала парола от историята 
	if (empty($passhist)){
return true;
	}else{
		$arhist= unserialize($passhist);
		if (in_array(md5(md5($pass)),$arhist)){
return "съвпада със стара парола";
		}else{
		}
return true;
	}
}

function passlist($pass,$list){
	$arpass= str_split($pass);
	foreach($arpass as $elem){
		if (strpos($list,$elem)===false){
		}else{
return true;
		}
	}
return false;
}


?>
