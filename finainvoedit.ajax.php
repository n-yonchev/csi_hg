<?php
# добавяне/корекция на самостоятелна фактура без сметка и несвързана с дело 
#    само при създаване - паралелно въвеждане на списък редове 
//# отгоре : 
//#    $GETPARAM - масив с параметрите от GET 
//#    $mode - текущия режим 
//#    $year - текуща година 
//#    $page - текуща страница 
# още отгоре : 
#    $modeel - стринг за базовия линк 
#    $relurl - базовия линк 
#    $robill - записа за сметката bill.id=$edit 
# още отгоре : 
#    $edit - фактурата bill.id 
#    $CODEBASE - елемента за базовия URL $modeel 
# източник : 
#    cazobillinvo.ajax.php - създаване (добавяне) фактура за сметка 
//print_r($GETPARAM);


# таблицата 
$taname= "bill";
# шаблона 
$tpname= "finainvoedit.ajax.tpl";
/*
# reload - след успешен събмит 
//$modeel= "mode=".$mode ."&year=".$year."&page=".$page;
$modeel= "mode=".$mode .$CODEBASE ."&page=".$page;
$relurl= geturl($modeel);
*/
# полетата 
$filist= getfilist();
# константни полета 
$ficonst= array();
# без номер и дата 
unset($filist["invoseri"]);
/////////////////unset($filist["invodate"]);
$smarty->assign("NOSERI", true);

# пореден номер фактура 
$mxinvo= $DB->selectCell("select max(seriinvo) from bill");
$smarty->assign("MXINVO", $mxinvo +1);

/**/
# евент.проформа 
# източник : cazobillmo1.inc.php 
$roprof= $DB->selectRow("select * from billprof where idbill=?" ,$edit);
//print_rr($roprof);
if (empty($roprof)){
	$mxprof= $DB->selectCell("select max(seriprof) from billprof");
//	$smarty->assign("SERIPROF", $mxprof+1);
	if (isset($_POST["seriprof"])){
	}else{
		$_POST["seriprof"]= $mxprof+1;
	}
	$smarty->assign("SERIPROFEXIS", false);
}else{
	$seriprof= $roprof["seriprof"] +0;
//	$smarty->assign("SERIPROF", $seriprof);
	if (isset($_POST["seriprof"])){
	}else{
		$_POST["seriprof"]= $seriprof;
	}
	$smarty->assign("SERIPROFEXIS", true);
}
/**/
									# класа за редактиране 
									include_once "edit.class.php";

#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
//var_dump($mfacproc);
//print_rr($_POST);
//var_dump($edit);

									# основен параметър - 
									# $edit - id на фактурата 
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	if ($edit==0){
//				$maxserinvo= invonextnumb();
//		$_POST["invoseri"]= $maxserinvo;
		$_POST["invodate"]= date("d.m.Y");
							# само при създаване - редове от фактурата 
							$_POST["desc"][0]= "";
							$_POST["desc"][1]= "";
		# 16.01.2014 сметката на ЧСИ като съставител 
		$_POST["iban"]= $ibaninit;
	}else{
				$rocont= $DB->selectRow("select * from $taname where id=?" ,$edit);
//		$_POST["invoseri"]= $rocont["serial"];
$smarty->assign("SERIINVO",$rocont["seriinvo"]);
		$_POST["invodate"]= bgdatefrom($rocont["date"]);
		$_POST["invoname"]= $rocont["name"];
		$_POST["invoegn"]= $rocont["egn"];
		$_POST["invoeik"]= $rocont["eik"];
		$_POST["invoaddr"]= $rocont["address"];
		$_POST["invopers"]= $rocont["toperson"];
				$_POST["invoisva"]= $rocont["isvat"];
		$_POST["invometh"]= $rocont["paidmethod"];
$_POST["cashiduser"]= $rocont["cashiduser"];
		$_POST["invopaid"]= $rocont["paid"];
		$_POST["idinvotype"]= $rocont["idinvotype"];
		# 16.01.2014 сметката на ЧСИ като съставител 
		$_POST["iban"]= $rocont["iban"];
	}

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
//									$DB->query("lock tables $taname write");
										$DB->query("lock tables $taname write, invoelem write, billprof write");
									//$DB->query("lock tables $taname write, invoice write");
											# проверяваме за допълнителни грешки 
											$lister= array();
				# касиера 
				if ($_POST["invometh"]=="c"){
					if (empty($_POST["cashiduser"])){
											$lister["cashiduser"]= "избора е задължителен";
//$smarty->assign("CASHER",$lister["cashiduser"]);
					}else{
					}
				}else{
				}
	# датата 
	$invodate= bgdateto($_POST["invodate"]);
//	if (substr($invodate,0,4)==$year){
	if (isset($year)){
		if (substr($invodate,0,4)==$year){
		}else{
											$lister["invodate"]= "датата не е от $year год.";
		}
	}else{
	}
		# ЕГН, ЕИК 
		$egn= $_POST["invoegn"];
		$eik= $_POST["invoeik"];
			if (empty($egn) and empty($eik) or !empty($egn) and !empty($eik)){
											$lister["invoegn"]= "попълнете или ЕГН или ЕИК";
											$lister["invoeik"]= "попълнете или ЕГН или ЕИК";
			}else{
			}
						#------------------------------------------------------------
						# само при създаване - редове от фактурата 
						if ($edit==0){
													$arp2= array();
																			$sum1= 0;
							foreach($_POST["desc"] as $poindx=>$x2){
								$desc= $_POST["desc"][$poindx];
								$meas= $_POST["meas"][$poindx];
								$quan= $_POST["quan"][$poindx];
								$pric= $_POST["pric"][$poindx];
																			$sum1 += round($quan*$pric,2);
													$toarp2= true;
								if ($poindx==0){
														$arp2["desc"][]= "";
														$arp2["meas"][]= "";
														$arp2["quan"][]= "";
														$arp2["pric"][]= "";
								}else{
									if (empty($desc) and empty($meas) and empty($quan) and empty($pric)){
//print "<br>empty=$poindx";
													$toarp2= false;
									}else{
													if ($toarp2){
														$arp2["desc"][]= $desc;
														$arp2["meas"][]= $meas;
														$arp2["quan"][]= $quan;
														$arp2["pric"][]= $pric;
													}else{
													}
										# грешки в реда 
										$cuindx= count($arp2["desc"]) -1;
										if (empty($arp2["desc"][$cuindx])){
											$lister["desc_".$cuindx]= "описанието е задължително";
										}else{
										}
										if (empty($arp2["meas"][$cuindx])){
											$lister["meas_".$cuindx]= "мярката е задължителна";
										}else{
										}
										$quanresu= validator_integer($arp2["quan"][$cuindx],NULL);
										if ($quanresu === true){
										}else{
											$lister["quan_".$cuindx]= "грешно количество";
										}
										$pricresu= validator_amount($arp2["pric"][$cuindx],NULL);
										if ($pricresu === true){
										}else{
											$lister["pric_".$cuindx]= "грешна ед.цена";
										}
									}
								}
							}
																			$sum1 *= (isset($_POST["invoisva"]))?1.2:1;
																			$sum1= round($sum1,2);
//							$_POST= $arp2;
							unset($_POST["desc"]);
							unset($_POST["meas"]);
							unset($_POST["quan"]);
							unset($_POST["pric"]);
							$_POST= $_POST + $arp2;
//print "<br>post-after=";
//print_rr($_POST);
						}else{
						}
//print_rr($lister);
						#------------------------------------------------------------
											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
												#---- няма ---- 
							$retucode= 0;
//	$DB->query("update bill set serial=?d where id=?d"  ,$nextnumb,$invobill);
//		invoinse(0  ,$year);
	# добавяне/корекция 
			$aset= array();
			$aset["date"]= $invodate;
			$aset["dateinvo"]= $invodate;
//			$aset["seriinvo"]= ???????????????????????????????????????????;
			$aset["name"]= $_POST["invoname"];
			$aset["egn"]= $_POST["invoegn"];
			$aset["eik"]= $_POST["invoeik"];
			$aset["address"]= $_POST["invoaddr"];
//			$aset["paid"]= ??????????????;
			$aset["isvat"]= isset($_POST["invoisva"]) ? 1 : 0;
			$aset["paidmethod"]= $_POST["invometh"];
	$aset["cashiduser"]= $_POST["cashiduser"];
			$aset["toperson"]= $_POST["invopers"];
			$aset["paid"]= $_POST["invopaid"];
			$aset["idinvotype"]= $_POST["idinvotype"];
					# 16.01.2014 сметката на ЧСИ като съставител 
					$aset["iban"]= $_POST["iban"];
	if ($edit==0){
									# 15.05.2013 нова проформа фактура не получава номер-фактура 
									if ($_POST["idinvotype"]==1){
									}else{
		$mxinvo= $DB->selectCell("select max(seriinvo) from bill");
		$aset["seriinvo"]= $mxinvo +1;
									}
						#------------------------------------------------------------
						# само при създаване - редове от фактурата 
//										$DB->query("lock tables $taname write, invoelem write");
		$edit= $DB->query("insert into $taname set ?a" ,$aset);
							foreach($_POST["desc"] as $poindx=>$x2){
								$desc= $_POST["desc"][$poindx];
								$meas= $_POST["meas"][$poindx];
								$quan= $_POST["quan"][$poindx];
								$pric= $_POST["pric"][$poindx];
								if ($poindx==0){
								}else{
									if (empty($desc) and empty($meas) and empty($quan) and empty($pric)){
									}else{
			$bset= array();
			$bset["idbill"]= $edit;
			$bset["descrip"]= $desc;
			$bset["meas"]= $meas;
			$bset["quan"]= $quan;
			$bset["price"]= $pric;
		$DB->query("insert into invoelem set ?a" ,$bset);
									}
								}
							}
//										$DB->query("unlock tables");
//# временно 
//$retucode= 99;
						#------------------------------------------------------------
	}else{
		$DB->query("update $taname set ?a where id=?d" ,$aset,$edit);
	}
	# корекция евент.проформа 
	if ($_POST["idinvotype"]==1){
		$pset= array();
		$pset["idbill"]= $edit;
		$pset["seriprof"]= $_POST["seriprof"];
		if (empty($roprof)){
			$DB->query("insert into billprof set ?a" ,$pset);
		}else{
			$DB->query("update billprof set ?a where id=?d" ,$pset,$roprof["id"]);
		}
	}else{
	}
											# край - според дали има грешка 
											}
									$DB->query("unlock tables");


#------ submit с формални грешки 
//# - невъзможно в случая 
}elseif ($mfacproc==NULL){
	# стандартна реакция 
							$retucode= 1;
	doerrors();

#------ автоматичен submit -----------------------------------------------------
# - невъзможно в случая 
}elseif ($mfacproc=="UNKNOWN"){
							$retucode= 2;

#------ невъзможна грешка от библиотеката 
}else{
print "<br>error=mfacproc=";
var_dump($mfacproc);
die();
}

#----------------- край на директното редактиране -----------------------
//var_dump($retucode);
#---------------------------------------
function getsutota($edit,$sum1){
	if ($edit==0){
		$sumatota= $sum1;
	}else{
		$arsuma= getsumainvo("invoelem.idbill=$edit");
		$sumatota= $arsuma[$edit]["suma"];
		if ($sumatota<0){
			$sumatota= -$sumatota;
		}else{
		}
	}
return $sumatota;
}
#---------------------------------------

//print_rr($_POST);
					# общата сума 
					$sumatota= getsutota($edit,$sum1);
							if ($sumatota+0 < $_POST["invopaid"]+0){
$retucode= -31;
$smarty->assign("PAIDER", true);
							}else{
							}
# резултат 
if ($retucode==0){
/*
	# redirect 
	$redilink= array("tbilllink");
	$smarty->assign("EXITCODE", getnyroexit($redilink));
	print smdisp($tpname,"iconv");
*/
	# redirect 
	reload("parent",$relurl);
}else{
					# общата сума 
					$sumatota= getsutota($edit,$sum1);
/*
					$arsuma= getsumainvo("invoelem.idbill=$edit");
					$sumatota= $arsuma[$edit]["suma"];
var_dump($sumatota);
if ($sumatota<0){
	$sumatota= -$sumatota;
}else{
}
var_dump($sumatota);
*/
					$sumatota= number_format($sumatota,2  ,".",",");
//					$sumatota= getsumainvoview($edit);
					$smarty->assign("SUMATOTA", $sumatota);
							# за избор на касиер 
							$userlist= getselect("user","name","1",true);
							$smarty->assign("USERLISTNAME", "userlist");
	# извеждаме формата 
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
//print_rr($_POST);
	print smdisp($tpname,"iconv");
//	$pagecont= smdisp($tpname,"iconv");
}


?>
