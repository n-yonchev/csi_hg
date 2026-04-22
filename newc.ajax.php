<?php
# 23.04.2009 - Бургас - директно въвеждане на дело - за стари дела 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $page - текущата страница от списъка 
#    $edit - suit.id за корекция 
//print "correction [$mode][$edit][$page]";
//print_r($GETPARAM);

# таблицата 
$taname= "suit";
# шаблона 
$tpname= "newc.ajax.tpl";
# полетата 
$filist= array(
	"serial"=>  array("validator"=>"notzero", "error"=>"номера е задължителен")
	,"year"=>  array("validator"=>"notzero", "error"=>"годината е задължителна")
	,"created"=> array("validator"=>"bgdate_valid_notempty")
);
# константни полета 
//$ficonst= array("iduser"=>$iduser);
$ficonst= array();
# reload - след успешен събмит 
$relurl= geturl("mode=".$mode."&page=".$page);

									# класа за редактиране 
									include_once "edit.class.php";

# редактиране 
$obedit= new edit($taname,$edit,$filist,$ficonst);

# специфична функция за състояние INIT 
$obedit->funcinit= "funcinit";
# функция за допълнит.грешки 
$obedit->errorfunc= "funcer";
# действие 
$reedit= $obedit->action();
//var_dump($reedit);

# резултат 
if ($reedit==0){
				# допълнителни корекции на записа - нормалните MySQL дати 
				$crea= $_POST["created"];
				$creacano= bgdateto($crea);
					$aset= array();
					$aset["created"]= $creacano;
					$aset["lastdocu"]= $creacano;
				$DB->query("update suit set ?a where id=?d" ,$aset,$obedit->paid);
	# redirect 
	reload("parent",$relurl);
}else{
						# за избор на година - предаваме името, а не съдържанието на масива 
						# $listyear - отгоре - commspec.php 
							# 13.08.2009 - Софрониев - премахваме текущата година 
							$cuyear= (int) date("Y");
							$cuindx= array_search($cuyear,$listyear);
							if ($cuindx===false){
die("newc.ajax=1");
							}else{
								unset($listyear[$cuindx]);
							}
						$smarty->assign("ARYEARNAME", "listyear");
	# извеждаме формата 
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


# функция за INIT 
function funcinit($obje){
global $DB, $edit;
	if ($edit==0){
		$_POST["serial"]= "";
		$_POST["year"]= "";
		$_POST["created"]= "";
	}else{
		$row= $DB->selectRow("select * from $obje->taname where id=?" ,$obje->paid);
		$_POST["serial"]= $row["serial"];
		$_POST["year"]= $row["year"];
			list($e1,$e2)= explode(" ",$row["created"]);
			list($ye,$mo,$da)= explode("-",$e1);
		$_POST["created"]= "$da.$mo.$ye";
	}
}

# функция за допълнит.грешки 
# връща true или масив с грешки $lister 
function funcer(){
global $DB, $edit;
	$curryear= (int) date("Y");
						$lister= array();
	$poseri= $_POST["serial"];
	$poyear= $_POST["year"];
	$mycoun= $DB->selectCell("select count(*) from suit where serial=? and year=? and id<>?" ,$poseri,$poyear,$edit);
	if ($mycoun==0){
/*
		# определяме макс.до момента номера за текущата година 
		$maxser= $DB->selectCell("select serial from suit where year=? order by serial desc limit 1" ,$poyear);
		# ако номера е за текущата година, трябва да не превишава максималния 
		if ($poyear==$curryear and $poseri >= $maxser){
					$ertext= "превишава макс.номер за $poyear";
					$lister["serial"]= $ertext;
					$lister["year"]= $ertext;
		}else{
		}
*/
		# ако номера е за текущата година, трябва да не превишава максималния 
		if ($poyear==$curryear){
			# определяме макс.до момента номер за текущата година 
			$maxser= getnextcase();
				if ($poseri <= $maxser){
				}else{
					$ertext= "превишава макс.въведен номер за $poyear";
					$lister["serial"]= $ertext;
					$lister["year"]= $ertext;
				}
		}else{
# номера е за минала година 
# 22.12.2009 
# - брой дела за миналите години 
$roof= getofficerow(0);
$arco= unserialize($roof["yearcount"]);
# ако годината е минала и за нея има брой дела 
# проверяваме номера да не надвишава зададения брой 
# източник : docuedit.ajax.php 
		$flspec= false;
if ($poyear<date("Y") and !empty($arco[$poyear])){
	if ($poseri>$arco[$poyear]){
		$flspec= true;
	}else{
	}
}else{
}
if ($flspec){
					$arcoyear= $arco[$poyear];
					$ertext= "превишава макс.допустим номер ($arcoyear) за $poyear";
					$lister["serial"]= $ertext;
					$lister["year"]= $ertext;
}else{
}
#------------------------------------------------------
		}
	}else{
					$ertext= "делото вече съществува";
					$lister["serial"]= $ertext;
					$lister["year"]= $ertext;
	}

					if (count($lister)==0){
return true;
					}else{
return $lister;
					}
}


?>