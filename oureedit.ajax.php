<?php
# 06.05.2009 - изходящ регистър - ръчно добавяне/корекция на записи 
# източник : 
#    cazo6regi.ajax.php 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $page - текущата страница от списъка 
#    $edit - docuout.id за корекция 
# още отгоре : 
#    $year - годината на изх.регистър 
//print "correction [$mode][$edit][$page]";
//print_rr($GETPARAM);

# таблицата 
$taname= "docuout";
# шаблона 
$tpname= "oureedit.ajax.tpl";
# полетата 
$filist= array(
	"getnext"=> NULL
	,"serinome"=> NULL
# 02.06.2009 - има и указател към дело, вкл. динамично образуване 
,"caseseri"=> NULL
,"caseyear"=> NULL
//,"flagcrea"=> NULL
	,"descrip"=>  array("validator"=>"notempty", "error"=>"описанието е задължително")
	,"adresat"=>  array("validator"=>"notempty", "error"=>"адресата е задължителен")
	,"notes"=> NULL
);
#------------------------------------------------------------------------------------------
								# 07.04.2010 - само ако има ограничена корекция 
								$ofro= getofficerow(0);
								$isdocuoutlimi= $ofro["isdocuoutlimi"];
								if ($isdocuoutlimi){
										# 16.03.2010 - за съществуващ документ - редуцираме полетата според датата 
										if ($edit==0){
										}else{
											$roco= getrow($taname,$edit);
											$datc= substr($roco["registered"],0,10);
											if ($datc==date("Y-m-d")){
											}else{
# полетата 
$filist= array(
	"notes"=>  NULL
);
# шаблона 
$tpname= "oureedit2.ajax.tpl";
											}
										}
								}else{
								}
#------------------------------------------------------------------------------------------

# константни полета 
//$ficonst= array("iduser"=>$iduser);
$ficonst= array();
# reload - след успешен събмит 
$relurl= geturl("mode=".$mode."&page=".$page);



									# класа за редактиране 
									include_once "edit.class.php";
#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";

									# основен входен параметър - 
									# $edit - $taname.id  

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	if ($edit==0){
							#---- полета с автоматично съдържание 
	}else{
		$rocont= getrow("docuout",$edit);
//		$rocont= dbconv($rocont);
		$_POST["descrip"]= toutf8($rocont["descrip"]);
		$_POST["adresat"]= toutf8($rocont["adresat"]);
		$_POST["notes"]= toutf8($rocont["notes"]);
$smarty->assign("DOCUNOME",$rocont["serial"]."/".$rocont["year"]);
# 02.06.2009 - има и указател към дело, вкл. динамично образуване 
# вземаме номера и годината 
		$idcase= $rocont["idcase"];
		if ($idcase==0){
		}else{
			$rocase= getrow("suit",$idcase);
			$_POST["caseseri"]= $rocase["serial"];
			$_POST["caseyear"]= $rocase["year"];
		}
	}
# 30.03.2010 - да е чекнат в началото 
$_POST["getnext"]= 1;

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
//													$DB->query("lock tables docuout write, user write, office write");
													$DB->query("lock tables docuout write, suit write, user write, office write");
											# проверяваме за допълнителни грешки 
											$lister= array();
		if ($edit==0){
			if (isset($_POST["getnext"])){
			}else{
					$serinome= $_POST["serinome"];
					# дали е правилно цяло число 
					if ((string)((int)$serinome)==$serinome){
						# дали вече не съществува документ с този номер за текущата година 
						$mycoun= $DB->selectCell("select count(*) from docuout where serial=? and year=?" ,$serinome,$year);
						if ($mycoun==0){
							# дали въведения номер не превишава максималния 
//							$maxout= getnextout();
							$maxout= getnext2();
outnext("oureedit/1/check-errors",$maxout);
							if ($serinome+0 <= $maxout){
							}else{
											$lister["serinome"]= "превишава макс.възможен номер";
							}
						}else{
											$lister["serinome"]= "има документ с този номер";
						}
					}else{
											$lister["serinome"]= "грешен номер";
					}
			}
		}else{
		}
# 02.06.2009 - има и указател към дело, вкл. динамично образуване 
# проверяваме дали съществува такова дело 
		$caseseri= $_POST["caseseri"];
		if (empty($caseseri)){
		}else{
			$caseyear= $_POST["caseyear"];
			# има ли дело с този номер/година 
			$mycase= $DB->select("select id from suit where serial=? and year=?" ,$caseseri,$caseyear);
			if (isset($_POST["flagcrea"])){
				# ще създаваме делото 
				if (count($mycase)==0){
					# все още няма дело с този номер/година 
					# ако годината е текущата, номера да не превишава максималния 
					$cuyear= (int) date("Y");
					if($caseyear==$cuyear){
						$sermax= getnextcase();
						if ($caseseri > $sermax){
											$lister["caseseri"]= "номера превишава макс. за текущата година";
						}else{
						}
					}else{
					}
				}else{
					# вече има дело с този номер/година 
				}
			}else{
				# само проверяваме 
				if (count($mycase)==0){
											$lister["caseseri"]= "липсва такова дело";
											$lister["caseyear"]= "липсва такова дело";
									$smarty->assign("CBCREACASE",true);
				}else{
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
			# подготвяме съдържанието 
			# източник за сер.номер : cazo6regi.ajax.php 
//													$DB->query("lock tables docuout write");
//													$DB->query("lock tables docuout write, user write, office write");
			$aset= array();
			$aset["descrip"]= $_POST["descrip"];
			$aset["adresat"]= $_POST["adresat"];
			$aset["notes"]= $_POST["notes"];
		if ($edit==0){
			$aset["year"]= $year;
			if (isset($_POST["getnext"])){
//				$aset["serial"]= getnextout();
				$aset["serial"]= getnext2();
outnext("oureedit/2/aset-data",$aset["serial"]);
			}else{
				$aset["serial"]= $serinome;
			}
		}else{
		}
# 02.06.2009 - има и указател към дело, вкл. динамично образуване 
# евентуален указател към делото 
		if (empty($caseseri)){
			$aset["idcase"]= 0;
		}else{
			$aset["idcase"]= $mycase[0]["id"];
			if (isset($_POST["flagcrea"])){
				# ще създаваме делото 
				if (count($mycase)==0){
					# все още няма дело с този номер/година 
					# създаваме делото 
						$sset= array();
						$sset["serial"]= $caseseri;
						$sset["year"]= $caseyear;
					$newcas= $DB->query("insert into suit set ?a, created=now(), lastdocu=now()" ,$sset);
					$aset["idcase"]= $newcas;
				}else{
				}
			}else{
			}
		}
//print "[$edit]";
//print_rr($_POST);
//print_rr($aset);
		# корекция на записа за изх.документ 
		if ($edit==0){
//			$DB->query("insert into docuout set ?a, created=now(), isentered=1" ,$aset);
# 12.07.2011 - юзер, който изходява 
$aset["iduserregi"]= $_SESSION["iduser"];
			# 23.02.2010 - запомняме и времето на регистрация 
			$DB->query("insert into docuout set ?a, created=now(), registered=now(), isentered=1" ,$aset);
outnext("oureedit/insert",$aset["serial"]);
		}else{
			$DB->query("update docuout set ?a where id=?d" ,$aset,$edit);
//outnext("oureedit/update",$aset["serial"]);
		}
//													$DB->query("unlock tables");
											# край - според дали има грешка 
											}
													$DB->query("unlock tables");

#------ submit с формални грешки 
}elseif ($mfacproc==NULL){
							$retucode= 1;
	doerrors();

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
						# 28.06.2010 - СЛЕД директно добавяне+извеждане 
						# както в справки - изх.регистър - добави 
						if ($FROMCASE){
	# redirect 
	$smarty->assign("EXITCODE", getnyroexit("t6link"));
print smdisp($tpname,"iconv");
						}else{
	# redirect 
	reload("parent",$relurl);
						}
}else{
						# за избор на година - предаваме името, а не съдържанието на масива 
						# $listyear - отгоре - commspec.php 
						$smarty->assign("ARYEARNAME", "listyear");
	# извеждаме формата 

//	$smarty->assign("NEXTNUMB", getnextout());
	$smarty->assign("NEXTNUMB", getnext2());
outnext("oureedit/3/to-form",$smarty->get_template_vars("NEXTNUMB"));
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


# 25.02.2016 
# заместител на getnextout-commspec.php - не за текущата година, а за годината от $GETPARAM 
function getnext2(){
global $DB;
global $GETPARAM;
	$myyear= (int) $GETPARAM["year"];
	if (empty($myyear)){
		$myyear= date("Y");
	}else{
	}
	$maxser= $DB->selectCell("select max(serial) from docuout where year=?" ,$myyear);
	$doutseri= $maxser + 1;
return $doutseri;
}


?>