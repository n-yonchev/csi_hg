<?php
# самостоятелен ajax скрипт, вика се от case.tpl 
# управляващ параметър : 
#     $editarch= $GETPARAM["editarch"] =archive.id 
/*
# 2 варианта : 
#     $editarch=0 - въвеждане група записи от archive за група записи от suit - списък чекбоксове = suit.id 
#     $editarch не е нула - корекция на отделен запис от archive 
*/
# 04.11.2010 - нов подход : 
#     отпада архивирането на група дела с чекбоксове 
#     може да се архивира или корегира архивирането само на отделно дело 
# 2 варианта на управление или-или : 
#     $editarch = archive.id >0 - корекция на архивирането 
#     $toarch = suit.id >0 - архивиране на дело 


/***************************************************************************************
sleep(2);
									session_start();
									include "common.php";

$GETPARAM= getparam();
$editarch= $GETPARAM["editarch"];
print_r($GETPARAM);
//print_r($_POST);
//print_rr($_SERVER);
				if ($editarch==0){
					$listarch= $_SESSION["listarch"];
// Не трябва да трием, защото NyroModal се вика повече от 1 път. 
//					unset($_SESSION["listarch"]);
					if (isset($listarch)){
if (empty($listarch)){
	$smarty->assign("COUNT", 0);
}else{
	$listcase= explode(",",$listarch);
//print_r($listcase);
	$smarty->assign("COUNT", count($listcase));
}
					}else{
//$refe= $_SERVER["HTTP_REFERER"];
$refe= $_SERVER["REQUEST_URI"];
//print $refe;
	print "
<script>
document.location.href='$refe';
</script>
	";
exit;
					}
				}else{
				}
***************************************************************************************/
									
									session_start();
									include "common.php";

$GETPARAM= getparam();
//print_r($GETPARAM);
$editarch= $GETPARAM["editarch"] +0;
$toarch= $GETPARAM["toarch"] +0;

# таблицата 
$taname= "archive";
# шаблона 
$tpname= "casearch.ajax.tpl";
/*
# полетата 
$filist= array(
	"serial"=> array("validator"=>"notzero", "error"=>"немера да не е нулев")
	,"date"=> array("validator"=>"bgdate_valid_notempty", "transformer"=>"getputbgdate")
	,"packet"=> NULL
	,"protocol"=> NULL
	,"documents"=> NULL
	,"volume"=> NULL
	,"year"=> NULL
	,"notes"=> NULL
);
*/
# полетата 
$filist= array(
	"year"=>  array("validator"=>"notzero", "error"=>"годината е задължителна")
	,"getnext"=> array("inactive"=>true)
	,"serial"=> NULL
	,"date"=> array("validator"=>"bgdate_valid_notempty", "transformer"=>"getputbgdate")
	,"protocol"=> NULL
	,"protdate"=> array("validator"=>"bgdate_valid", "transformer"=>"getputbgdate")
	,"notes"=> NULL
);
# константни полета 
					if ($editarch==0){
$ficonst= array("idcase"=>$toarch);
					}else{
$ficonst= array();
					}
# reload - след успешен събмит 
$mode= $GETPARAM["mode"];
$page= $GETPARAM["page"];
$filt= $GETPARAM["filt"];
# връщане отново в главния скрипт index.php 
$relurl= "index.php".geturl("mode=".$mode."&page=".$page."&filt=".$filt);


									# класа за редактиране 
									include_once "edit.class.php";
#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";

									# основен входен параметър - 
									# $editarch = $taname.id 
									# алтернативно : $toarch=suit.id 

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
//	if ($edit==0){
	if ($editarch==0){
		$rocont= $DB->selectRow("
			select serial as caseseri, year as caseyear
			from suit 
			where id=?d
			" ,$toarch);
$smarty->assign("ROCONT", $rocont);
		$_POST["year"]= date("Y") +0;
		$_POST["getnext"]= 1;
		$_POST["date"]= date("d.m.Y");
	}else{
//		$rocont= $DB->selectRow("select * from $taname where id=?" ,$editarch);
		$rocont= $DB->selectRow("
			select $taname.*, $taname.id as id, user.name as username
			, suit.serial as caseseri, suit.year as caseyear
			from $taname 
			left join user on $taname.iduser=user.id
			left join suit on $taname.idcase=suit.id
			where $taname.id=?
			" ,$editarch);
$smarty->assign("ROCONT", $rocont);
		foreach($filist as $finame=>$ficont){
			if ($ficont["inactive"]){
			}else{
				$_POST[$finame]= $rocont[$finame];
			}
							if (isset($ficont["transformer"])){
								$resufunc= call_user_func($ficont["transformer"],"get",$editarch,$finame,$rocont);
			$_POST[$finame]= $resufunc;
							}else{
							}
		}
	}

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
													$DB->query("lock tables $taname write");
							$retucode= 0;
											# проверяваме за допълнителни грешки 
											$lister= array();
	$year= $_POST["year"];
	$getnext= $_POST["getnext"];
	$serial= $_POST["serial"];
	if (isset($getnext)){
	}else{
			$arseri= $DB->selectCol("select id from $taname where year=?d and serial=?d and id<>?d"  ,$year,$serial,$editarch);
			if (count($arseri)==0){
			}else{
											$lister["serial"]= "за $year година има друго дело с този арх.номер";
			}
	}
											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
												#---- няма ---- 
							$retucode= 0;
		$aset= $ficonst;
		foreach($filist as $finame=>$ficont){
			if ($ficont["inactive"]){
			}else{
				$aset[$finame]= $_POST[$finame];
			}
							if (isset($ficont["transformer"])){
								$resufunc= call_user_func($ficont["transformer"],"put",0,$finame,$_POST);
								if ($resufunc===false){
		unset($aset[$finame]);
								}else{
		$aset[$finame]= $resufunc;
								}
							}else{
							}
		}
		# юзера, който архивира 
		$aset["iduser"]= $_SESSION["iduser"];
//	if ($edit==0){
	if ($editarch==0){
							#---- полета с автоматично съдържание 
/*
		# серия нови записи 
		foreach($listcase as $idcase){
			$aset["idcase"]= $idcase;
			$editarch= $DB->query("insert into $taname set ?a" ,$aset);
		}
*/
					# защита от автоматично повторение с NyroModal 
					$arcase= $DB->selectCol("select id from $taname where year=?d and idcase=?d"  ,$year,$toarch);
					if (count($arcase)==0){
		if (isset($getnext)){
			$maxnum= $DB->selectCell("select max(serial) from archive where year=?d"  ,$year);
			$aset["serial"]= $maxnum +1;
		}else{
		}
		$aset["idcase"]= $toarch;
		$editarch= $DB->query("insert into $taname set ?a, time=now()" ,$aset);
					}else{
		$editarch= $arcase[0];
					}
	}else{
							#---- полета с автоматично съдържание 
		# корекция на записа 
		$DB->query("update $taname set ?a, time=now() where id=?d" ,$aset,$editarch);
	}
											# край - според дали има грешка 
											}
													$DB->query("unlock tables");

#------ submit с формални грешки 
}elseif ($mfacproc==NULL){
							$retucode= 1;
	doerrors();


#------ изтриване 
}elseif ($mfacproc=="delete"){
							$retucode= 0;
		$DB->query("delete from $taname where id=?d" ,$editarch);

#------ отказ от изтриване 
}elseif ($mfacproc=="cancel"){
							$retucode= 0;

#------ автоматичен submit -----------------------------------------------------
}elseif ($mfacproc=="UNKNOWN"){
							$retucode= 2;

#------ невъзможна грешка от библиотеката 
}else{
print "<br>error=mfacproc=";
var_dump($mfacproc);
die();
}

#----------------- край на директното редактиране -----------------------

# резултат 
if ($retucode==0){
	# redirect 
//var_dump($relurl);
	reload("parent",$relurl);
}else{
						# за избор на година [exyear] - предаваме името, а не съдържанието на масива 
						# $listyear - отгоре - commspec.php 
						$smarty->assign("ARYEARNAME", "listyear");
	# извеждаме формата 
	$smarty->assign("EDIT", $editarch);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


?>
