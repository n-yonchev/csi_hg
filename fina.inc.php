<?php
# функции, свързани с финансите 

# за псевдо взискателите 
$pseuclainame[-3]= "ЧСИ неолих";
$pseuclainame[-2]= "ЧСИ т.26";
$pseuclainame[-1]= "връщане";
$smarty->assign("PSEUCLAINAME", $pseuclainame);
	$pseuclaifiel[-3]= "separa";
	$pseuclaifiel[-2]= "separa2";
	$pseuclaifiel[-1]= "back";

//$BANKTIME= "if(finasource.id is null,finance.time,concat(str_to_date(finasource.date,'%d/%m/%Y'),' ',finasource.hour))";
$BANKTIME= "if(finasource.id is null,finance.time,finasource.timebank)";
$BANKTYPE= "if(finasource.id is null,0,1)";

# 15.05.2012 - пакетни преводи чрез XML файл 
# флаг дали да се включва новия клон 
# резултат - $flagbankmass 
$filebankmass= "bankmass.txt";
if (file_exists($filebankmass)){
	$contubb= file_get_contents($filebankmass);
	$s1= substr($contubb,0,1);
		$flagbankmass= ($s1=="1");
}else{
		$flagbankmass= false;
}
$smarty->assign("FLAGBANKMASS", $flagbankmass);
//var_dump($flagbankmass);


# за извеждане на постъпление - изчислява и зарежда балансовите полета 
# директно зарежда масива на реда - 2-рия параметър 
# ВНИМАНИЕ - масива с реда е параметър "by reference" 
function finacalc($uscont,&$arresu){
				# разпределените суми по взискатели - НЕЕФЕКТИВНО 
				$idcase= $uscont["idcase"];
//var_dump($idcase);
							if (empty($idcase)){
# 23.07.2010 - специално за постъпление без дело 
$arresu["clailist"]= array();
$arresu["claiamou"]= array();
							}else{
				$clailist= getclailist($idcase);
	$arresu["clailist"]= $clailist;
//				$claiamou= unserialize($uscont["toclai"]);
				$claiamou= unsetoclai($uscont["toclai"]);
	$arresu["claiamou"]= $claiamou;
/***
				# общо разпределената сума по всички взискатели 
									$sucl= 0;
				foreach($clailist as $idcl=>$x2){
									$sucl += $claiamou[$idcl];
				}
//var_dump($sucl);
//print "<br>".$uscont["inco"]."===".$uscont["separa"]."===".$sucl;
				# неразпределения остатък 
				$rest= $uscont["inco"] - $uscont["separa"] - $sucl;
	$arresu["rest"]= $rest;
***/
# 01.10.2009 - има отделно поле ["rest"] за неразпределения остатък 
							# if (empty($idcase)){
							}
}

# връща списък на взискателите по делото 
function getclailist($idcase){
if (isset($idcase)){
}else{
	return array();
}
global $DB;
	$claiqu= "select id as ARRAY_KEY, name from claimer where claimer.idcase=$idcase";
	$clailist= $DB->selectCol($claiqu);
	$clailist= dbconv($clailist);
return $clailist;
}

# връща списък на длъцниците по делото 
function getdebtlist($idcase){
if (isset($idcase)){
}else{
	return array();
}
global $DB;
	$claiqu= "select id as ARRAY_KEY, name from debtor where debtor.idcase=$idcase";
	$clailist= $DB->selectCol($claiqu);
	$clailist= dbconv($clailist);
return $clailist;
}

/****
function finaquery(){
global $BANKTIME, $BANKTYPE;
		$query= "select finance.*, finance.id as id, user.name as finaname
			, suit.id as idcase, suit.serial as caseseri, suit.year as caseyear
					, t2.name as username
, $BANKTIME as banktime
, $BANKTYPE as banktype
			from finance 
			left join user on finance.iduser=user.id
			left join suit on finance.idcase=suit.id
					left join user as t2 on suit.iduser=t2.id
left join finasource on finasource.idfinance=finance.id
			";
return $query;
}
****/
									# яну-фев-2010 актуален дълг 
									# доп.поле - кой е заключил делото 
function finaquery(){
		$query= "select finance.*, finance.id as id, user.name as finaname
			, suit.id as idcase, suit.serial as caseseri, suit.year as caseyear
					, t2.name as username
									, t3.name as lockname
			from finance 
			left join user on finance.iduser=user.id
			left join suit on finance.idcase=suit.id
					left join user as t2 on suit.iduser=t2.id
									left join user as t3 on suit.lockedby=t3.id
			left join finasource on finance.id=finasource.idfinance
			";
return $query;
}
# ВНИМАНИЕ. Проблем с ефективността при Бъзински. 
# При наличие на : 
#			left join finasource on finance.id=finasource.idfinance
# При Бъзински вместо "finasource" таблицата е "finaobb" 
# рязко намалява скоростта при заявката за изброяване SQL_CALC_FOUND_ROWS 
# решение : 
# 			да се добави индекс по finasource.idfinance 
/*
function finaquery(){
		$query= "select finance.*, finance.id as id, user.name as finaname
			, suit.id as idcase, suit.serial as caseseri, suit.year as caseyear
					, t2.name as username
			from finance 
			left join user on finance.iduser=user.id
			left join suit on finance.idcase=suit.id
					left join user as t2 on suit.iduser=t2.id
			left join finasource on finance.id=finasource.idfinance
			";
return $query;
}
*/


function finaarchive($myedit){
global $DB;
				# добавяме записа в архива 
				$rofina= getrow("finance",$myedit);
	# ВНИМАНИЕ. 
	# сериализацията на не-Unicode стрингове не работи добре - реже стринга от началото 
	# сериализацията на Unicode стрингове не работи добре - записва невярна дължина на стринга и дава грешка при десериализация 
	# затова ги заместваме с нови функции - commspec.php 
				$DB->query("insert into finahist set idfinance=?d, content=?"  ,$myedit,seriraw($rofina));
}


function banktran($data){
			$trname= array();
			$trname[0]= "date";
			$trname[1]= "hour";
			$trname[3]= "amount";
			$trname[4]= "desc1";
			$trname[5]= "desc2";
			$trname[7]= "desc3";
			$trname[8]= "desc4";
			$trname[9]= "reference";
				$trfunc[0]= "fudate";	$trer[0]= "грешна дата";
				$trfunc[1]= "fuhour";	$trer[2]= "грешен час";
				$trfunc[3]= "fuamou";	//$trer[3]= "грешна сума";
	$fina= "cache/".md5(microtime());
	file_put_contents($fina,$data);
	$arcont= file($fina);
	unlink($fina);
				$resu= array();
	foreach($arcont as $elem){
		$el2= explode("\t",$elem);
						$ar2= array();
		foreach($trname as $ind2=>$nam2){
			$myvalu= trim($el2[$ind2]);
						$ar2[$nam2]= to1251($myvalu);
			$myfunc= $trfunc[$ind2];
			if (isset($myfunc)){
				$fure= call_user_func($myfunc,$myvalu);
				if (is_string($fure)){
						$ar2["error"]= $fure;
				}elseif (is_bool($fure)){
					if ($fure){
					}else{
						$ar2["error"]= $trer[$ind2];
					}
				}else{
die("banktran=1=$myvalu");
				}
			}else{
			}
		}
				$resu[]= $ar2;
	}
return $resu;
}

function fudate($p1){
	list($da,$mo,$ye)= explode("/",$p1);
return checkdate($mo,$da,$ye);
}
function fuhour($p1){
	list($ho,$mi)= explode(":",$p1);
return ($ho>=0 and $ho<=23 and $mi>=0 and $mi<=59);
}
function fuamou($p1){
	$amou= str_replace(",","",$p1);
		$amou2= $amou +0;
		$amoust= $amou2==0 ? "" : number_format($amou2,2,".","");
//		$amou2= $amou2==0 ? "" : $amou2;
//	$amoust= (string)$amou2;
//var_dump($amou);
//var_dump($amoust);
//return ($amou===$amoust and $amou<>"");
	if (0){
	}elseif ($amou==""){
return "ЛИПСВА СУМА";
	}elseif ($amou!==$amoust){
return "грешна сума";
	}else{
return true;
	}
}

function getfinalink($modeel){
				$arresu= array();
	for ($i=1; $i<=9; $i++){
				$arresu[$i]= geturl($modeel."&type=".$i);
	}
return $arresu;
}



#--------------------------------------------------------------------
# 04.10.2011 - нов подход към заключването на постъпление 

function finalock($edit){
global $smarty;
								#------------------------ ЗАКЛЮЧВАНЕ --------------------------
								# проверка дали записа е заключен 
								$rofina= getrow("finance",$edit);
								$lockedby= $rofina["lockedby"];
								$curruser= $_SESSION["iduser"];
//print "[$lockedby][$curruser]";
								if ($lockedby==0 or $lockedby==$curruser){
									# свободен или заключен от логнатия - заключваме го и продължаваме 
									updrow("finance",$edit,"lockedby=".$curruser);
	# за отключването след нормален exit - виж _window.header.tpl 
	$nyremo["idfina"]= $edit;
	$nyremo["idzone"]= "zone".$edit;
	$smarty->assign("NYREMO", $nyremo);
//print_r($smarty->get_template_vars());
return false;
								}else{
									# заключен от друг - съобщение и шунт 
									$rouser= getrow("user",$lockedby);
//print_r($_SERVER);
	$smarty->assign("LOCKNAME", $rouser["name"]);
//	$smarty->assign("URLAGAIN", $_SERVER["HTTP_REFERER"]);
	$smarty->assign("EDIT", $edit);
	print smdisp("finalock.ajax.tpl","iconv");
//	exit;
return true;
								}
}

function finaunlock($edit){
								#------------------------ ЗАКЛЮЧВАНЕ --------------------------
								# отключваме заключения запис 
								updrow("finance",$edit,"lockedby=0");
}


#------------------ за група постъпления --------------------- 
function finalockgr($arfina){
global $smarty;
global $DB;
													$DB->query("lock tables finance write, user write");
	$curruser= $_SESSION["iduser"];
				$flagok= true;
	# проверка дали всички постъпления са НЕзаключени от друг юзер 
	foreach($arfina as $edit){
					$rofina= getrow("finance",$edit);
					$lockedby= $rofina["lockedby"];
//print "[$lockedby][$curruser]";
					if ($lockedby==0 or $lockedby==$curruser){
					}else{
				# има заключено от друг постъпление 
				$flagok= false;
							$rouser= getrow("user",$lockedby);
$smarty->assign("LOCKNAME", $rouser["name"]);
$smarty->assign("EDIT", $edit);
print smdisp("finalockgr.ajax.tpl","iconv");
				break;
					}
	}
	# според резултата 
	if ($flagok){
	}else{
		#---- има заключено от друг постъпление 
													$DB->query("unlock tables");
return true;
	}
	
	#---- всички постъпления са НЕзаключени 
	# списъка в сесията - за отключване след приключване на процеса 
	$codeclosgr= implode(",",$arfina);
	$_SESSION["finaclosgr"]= $codeclosgr;
	# заключваме всички постъпления от списъка 
	$DB->query("update finance set lockedby=?d where id in ($codeclosgr)"  ,$curruser);
	# за отключването след нормален exit - виж _window.header.tpl 
//	$nyremo["idfina"]= 0;
# 28.09.2012 виж finaunlock.ajax.php 
$nyremo["idfina"]= -9;
	$nyremo["idzone"]= "zone0";
	$smarty->assign("NYREMO", $nyremo);
													$DB->query("unlock tables");
return false;
}

function finaunlockgr(){
global $DB;
	# отключваме всички постъпления от списъка 
	$codeclosgr=$_SESSION["finaclosgr"];
	$DB->query("update finance set lockedby=0 where id in ($codeclosgr)");
	# унищожаваме сес.променлива 
	unset($_SESSION["finaclosgr"]);
}


?>
