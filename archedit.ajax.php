<?php
# корекция на архивирано дело 
# източник : 
#    casearch.ajax.php - самостоятелен ajax скрипт - архивиране на изп.дело 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим - архивна книга 
#    $year - годината на арх.книга 
#    $page - текущата страница 
# още (евентуално) отгоре : 
#    $onlyuser - флаг =0/1 за филтъра 
# управляващ параметър 
#    $edit - archive.id за корекция, =0 нов арх.номер 
//print "correction [$mode][$year][$page][$edit]";


# таблицата 
$taname= "archive";
# шаблона 
$tpname= "archedit.ajax.tpl";
# полетата 
$filist= array(
//	"year"=>  array("validator"=>"notzero", "error"=>"годината е задължителна")
//	"seriyear"=>  array("inactive"=>true, "validator"=>"notemty", "error"=>"изп.дело е задължително")
	"seriyear"=> array("inactive"=>true)
	,"getnext"=> array("inactive"=>true)
	,"serial"=> NULL
	,"date"=> array("validator"=>"bgdate_valid_notempty", "transformer"=>"getputbgdate")
	,"protocol"=> NULL
	,"protdate"=> array("validator"=>"bgdate_valid", "transformer"=>"getputbgdate")
	,"notes"=> NULL
);
/*
# константни полета 
					if ($editarch==0){
$ficonst= array("idcase"=>$toarch);
					}else{
$ficonst= array();
					}
# reload - след успешен събмит 
$mode= $GETPARAM["mode"];
$page= $GETPARAM["page"];
//$filt= $GETPARAM["filt"];
# връщане отново в главния скрипт index.php 
//$relurl= "index.php".geturl("mode=".$mode."&page=".$page."&filt=".$filt);
$relurl= "index.php".geturl("mode=".$mode."&page=".$page);
*/

# константни полета 
$ficonst= array();
# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&year=".$year."&page=".$page);
$relurl= geturl("mode=".$mode."&year=".$year."&onlyuser=".$onlyuser."&page=".$page);


									# класа за редактиране 
									include_once "edit.class.php";
#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
		
$rocont= $DB->selectRow("
			select $taname.*, $taname.id as id, user.name as username
			, suit.serial as caseseri, suit.year as caseyear
			from $taname 
			left join user on $taname.iduser=user.id
			left join suit on $taname.idcase=suit.id
			where $taname.id=?
			" ,$edit);
$smarty->assign("ROCONT", $rocont);

									# основен входен параметър - 
									# $edit = $taname.id 

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
//	if ($edit==0){
	if ($edit==0){
/*
		$rocont= $DB->selectRow("
			select serial as caseseri, year as caseyear
			from suit 
			where id=?d
			" ,$toarch);
$smarty->assign("ROCONT", $rocont);
		$_POST["year"]= date("Y") +0;
		$_POST["getnext"]= 1;
		$_POST["date"]= date("d.m.Y");
*/
	}else{
//		$rocont= $DB->selectRow("select * from $taname where id=?" ,$edit);
/*
		$rocont= $DB->selectRow("
			select $taname.*, $taname.id as id, user.name as username
			, suit.serial as caseseri, suit.year as caseyear
			from $taname 
			left join user on $taname.iduser=user.id
			left join suit on $taname.idcase=suit.id
			where $taname.id=?
			" ,$edit);
$smarty->assign("ROCONT", $rocont);
*/
		foreach($filist as $finame=>$ficont){
			if ($ficont["inactive"]){
			}else{
				$_POST[$finame]= $rocont[$finame];
			}
							if (isset($ficont["transformer"])){
								$resufunc= call_user_func($ficont["transformer"],"get",$edit,$finame,$rocont);
			$_POST[$finame]= $resufunc;
							}else{
							}
		}
//		$_POST["seriyear"]= $rocont["caseseri"]."/".$rocont["caseyear"];
	}

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
													$DB->query("lock tables $taname write, suit write, user write");
							$retucode= 0;
											# проверяваме за допълнителни грешки 
											$lister= array();
//	$year= $_POST["year"];
	$seriyear= $_POST["seriyear"];
	$getnext= $_POST["getnext"];
	$serial= $_POST["serial"];
	if ($edit==0){
		list($caseri,$cayear)= explode("/",$seriyear);
		if (empty($caseri)){
											$lister["seriyear"]= "липсва номер на изп.дело";
		}elseif (empty($cayear)){
											$lister["seriyear"]= "липсва година на изп.дело";
		}else{
			if (substr($cayear,0,2)=="20"){
			}else{
				$cayear= "20".$cayear;
			}
			$rocase= $DB->selectRow("select id,iduser from suit where serial=?d and year=?d"  ,$caseri,$cayear);
			$caseid= $rocase["id"];
			$userid= $rocase["iduser"];
			if ($caseid==0){
											$lister["seriyear"]= "несъществуващо изп.дело";
			}else{
				$arwork= $DB->select("select serial,year from archive where idcase=?d"  ,$caseid);
				if (count($arwork)<>0){
					$archno= $arwork[0]["serial"]."/".$arwork[0]["year"];
											$lister["seriyear"]= "изп.дело вече има арх.номер $archno";
				}else{
								if ($NOPERMUSER or $logisadmin){
								}else{
					if ($userid==$_SESSION["iduser"]){
					}else{
						$rouser= getrow("user",$userid);
						$usname= $rouser["name"];
											$lister["seriyear"]= "изп.дело е на деловодител $usname";
								}
					}
				}
			}
		}
		if (isset($getnext)){
		}else{
			if ($serial==0){
											$lister["serial"]= "въведи желания арх.номер";
			}else{
				$arseri= $DB->selectCol("select id from $taname where year=?d and serial=?d and idcase<>?d"  ,$year,$serial,$caseid);
//print "[$year][$serial][$edit]";
//print_rr($arseri);
				if (count($arseri)==0){
				}else{
											$lister["serial"]= "за $year година има друго дело с този арх.номер";
				}
			}
		}
	}else{
		if (isset($getnext)){
		}else{
			$arseri= $DB->selectCol("select id from $taname where year=?d and serial=?d and id<>?d"  ,$year,$serial,$edit);
//print "[$year][$serial][$edit]";
//print_rr($arseri);
			if (count($arseri)==0){
			}else{
											$lister["serial"]= "за $year година има друго дело с този арх.номер";
			}
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
	if ($edit==0){
							#---- полета с автоматично съдържание 
					# защита от автоматично повторение с NyroModal 
//					$arcase= $DB->selectCell("select id from $taname where year=?d and idcase=?d"  ,$year,$toarch);
//					$arcase= $DB->selectCol("select id from $taname where year=?d and serial=?d and idcase<>?d"  ,$year,$serial,$caseid);
					$arcase= $DB->selectCol("select id from $taname where year=?d and serial=?d"  ,$year,$serial);
					if (count($arcase)==0){
		if (isset($getnext)){
			$maxnum= $DB->selectCell("select max(serial) from archive where year=?d"  ,$year);
			$aset["serial"]= $maxnum +1;
		}else{
		}
//		$aset["idcase"]= $toarch;
		$aset["idcase"]= $caseid;
		$aset["year"]= $year;
//print_rr($aset);
		$edit= $DB->query("insert into $taname set ?a, time=now()" ,$aset);
					}else{
		$edit= $arcase[0];
					}
	}else{
							#---- полета с автоматично съдържание 
		# корекция на записа 
		$DB->query("update $taname set ?a, time=now() where id=?d" ,$aset,$edit);
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
		$DB->query("delete from $taname where id=?d" ,$edit);

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
	$smarty->assign("YEAR", $year);
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


?>
