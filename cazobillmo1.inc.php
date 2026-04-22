<?php
#----------------------------- ниво сметка ---------------------------------------------
# отгоре : 
#    $edit= case.id 
//#    $zone= bill 
#    $relurl - рефреш 
# управляващ : 
#    $modibill = bill.id 
//var_dump($modibill);
//print_rr($GETPARAM);


//# фактурата 
//$idinvo= $DB->selectCell("select id from invoice where idbill=?d"  ,$modibill);
# таблицата 
$taname= "bill";
//# шаблона 
//$tpname= "cazobillmodi.ajax.tpl";

# полетата 
$filist= array(
//	"date"=>  array("validator"=>"bgdate_valid_notempty", "error"=>"грешна дата")
	"date"=> NULL
//	,"idclaimer"=>  array("validator"=>"notzero", "error"=>"взискателя е задължително поле")
	,"name"=> NULL
//	,"name"=>  array("validator"=>"notempty", "error"=>"името не може да е празно")
	,"egn"=> NULL
	,"eik"=> NULL
	,"address"=> NULL
# 29.02.2012 високосна - флаг за ДДС 
	,"isvat"=> NULL
# 03.04.2012 индекс на шаблона 
//	,"idtemp"=> NULL
# 20.06.2012 тип фактура 
	,"idinvotype"=> NULL
# 20.06.2012 МОЛ 
	,"toperson"=> NULL
# 16.01.2014 флаг да се извежда длъжника 
	,"isdebtor"=> NULL
# 16.01.2014 сметката на ЧСИ като съставител 
	,"iban"=> array("validator"=>"notempty", "error"=>"IBAN за фактурата е задължителен")
);
# константни полета 
$ficonst= array("idcase"=>$edit);

#----------------- директно редактиране -----------------------
/*
				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
var_dump($mfacproc);
//var_dump($mfac->metaForm->MF_POST["submit2"]);
//$sub2= $mfac->metaForm->MF_POST["submit2"];
print_rr($_POST);
*/
//$mfacproc= $mfac->process();
//var_dump($mfacproc);

# поредни номера на документите 
		$smarty->assign("DATE1", date("d.m.Y"));
		# поредни номера 
//		$mxinvo= $DB->selectCell("select max(serial) from invoice");
		$mxinvo= $DB->selectCell("select max(seriinvo) from bill");
		$mxbill= $DB->selectCell("select max(serial) from bill");
		$smarty->assign("MXINVO", $mxinvo +1);
		$smarty->assign("MXBILL", $mxbill +1);
# резервирани номера на документите 
				$rorese= $DB->selectRow("select * from bill where idcase=0 and serial<>0 and name='' limit 1");
//print_rr($rorese);
							if (empty($rorese)){
							}else{
				$smarty->assign("RESEINVO", $rorese["seriinvo"]);
				$smarty->assign("RESEBILL", $rorese["serial"]);
				$smarty->assign("DATE2", bgdatefrom($rorese["date"]));
							}
//print_rr($smarty->get_template_vars());

/**/
# евент.проформа 
$roprof= $DB->selectRow("select * from billprof where idbill=?" ,$modibill);
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
//print_rr($smarty->get_template_vars());
//print "POST==";
//print_rr($_POST);
/*
# списък на сметките за фактура 
$aracco= getaccolist();
///print_rr($aracco);
list($araccosele,$ibaninit)= getaccosele($aracco);
//print_rr($araccosele);
$smarty->assign("ARSELENAME", "araccosele");
*/
									
									# основен входен параметър - 
									# $modibill - id на сметката 
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	if ($modibill==0){
							#---- полета с автоматично съдържание 
//		$_POST["date"]= date("d.m.Y");
		$_POST["isvat"]= 1;
		# 16.01.2014 сметката на ЧСИ като съставител 
		$_POST["iban"]= $ibaninit;
							#++++++++++++++++++++++++++++++++++++++
							//$_POST["typecrea"]= 3;
	}else{
		$rocont= $DB->selectRow("select * from $taname where id=?" ,$modibill);
$rocont= arstrip($rocont);
		foreach($filist as $finame=>$ficont){
			$_POST[$finame]= $rocont[$finame];
		}
		# датата 
		$_POST["date"]= bgdatefrom($rocont["date"]);
		//$_POST["isvat"]= $rocont["isvat"];
//			$roinvo= $DB->selectRow("select * from invoice where id=?" ,$idinvo);
//		$_POST["toperson"]= $roinvo["toperson"];
		//$_POST["toperson"]= $rocont["toperson"];
							#---- полета с автоматично съдържание 

//print_rr($_POST);
	}


#------ submit без формални грешки 
# общи данни за сметката 
//}elseif ($mfacproc=="submit"){
}elseif (isset($_POST["submit"])){
							$retucode= 0;
									$DB->query("lock tables bill write, billelem write, billprof write");
											# проверяваме за допълнителни грешки 
											$lister= array();
/*
					# лепенка 
				$idclaimer= $_POST["idclaimer"];
					if ($idclaimer==0){
						$lister= $smarty->get_template_vars("LISTER");
						$lister["idclaimer"]= "взискателя е задължително поле";
					}else{
					}
*/
					# лепенка 
				$typecrea= $_POST["typecrea"];
					if (empty($typecrea) and $modibill==0){
						$lister["typecrea"]= "варианта е задължителен";
					}else{
					}
				$date= $_POST["date"];
					$resudate= validator_bgdate_valid_notempty($date,"?");
					if ($resudate===true){
					}else{
						$lister["date"]= $resudate[0];
					}
				$name= trim($_POST["name"]);
					if (empty($name)){
						$lister["name"]= "името не може да е празно";
					}else{
					}
				$egn= $_POST["egn"];
				$eik= $_POST["eik"];
					if (empty($egn) and empty($eik) or !empty($egn) and !empty($eik)){
						$lister["egn"]= "попълнете или ЕГН или ЕИК";
						$lister["eik"]= "попълнете или ЕГН или ЕИК";
					}else{
					}
				if ($modibill==0 and $_POST["vari"]==2){
					$rorese= $DB->selectRow("select * from bill where idcase=0 and serial<>0 and name='' limit 1");
//print_rr($rorese);
					if (empty($rorese)){
						$lister["vari"]= "няма записи със запазени номера";
					}else{
					}
				}else{
				}
//	$smarty->assign("LISTER", $lister);
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
			$aset[$finame]= $_POST[$finame];
		}
		# датата 
		$aset["date"]= bgdateto($_POST["date"]);
		# ддс 
		$aset["isvat"]= isset($_POST["isvat"]) ? 1 : 0;
		# 16.01.2014 флаг да се извежда длъжника 
		$aset["isdebtor"]= isset($_POST["isdebtor"]) ? 1 : 0;
		//# адрес 
		//$aset["address"]= $addracti;
//print_rr($aset);
//die;
		//# тип фактура 
		//$aset["idinvotype"]= $_POST["idinvotype"];
//print $modibill;
//print_rr($aset);
									//$DB->query("lock tables invoice write, bill write, billelem write");
//									$DB->query("lock tables bill write, billelem write");
//$iset= array();
//$iset["toperson"]= $_POST["toperson"];
	if ($modibill==0){
#++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
												$typecrea= $_POST["typecrea"];
				# номерата - според варианта 
				if ($_POST["vari"]==1){
											if ($typecrea==1){
					$aset["seriinvo"]= invonextser();
					$aset["dateinvo"]= $aset["date"];
					$aset["serial"]= -1;
											}elseif ($typecrea==2){
					$aset["serial"]= billnextser();
											}elseif ($typecrea==3){
					$aset["seriinvo"]= invonextser();
					$aset["dateinvo"]= $aset["date"];
					$aset["serial"]= billnextser();
											}else{
die("cazobillmo=typecrea=[$typecrea]");
											}
							# нова проформа фактура не получава номер-фактура 
							if ($_POST["idinvotype"]==1){
					$aset["seriinvo"]= 0;
							}else{
							}
$modibill= $DB->query("insert into $taname set ?a" ,$aset);
				}else{
					$aset["serial"]= $rorese["serial"];
					$aset["seriinvo"]= $rorese["seriinvo"];
$modibill= $rorese["id"];
$DB->query("update $taname set ?a where id=?d" ,$aset,$modibill);
				}
#++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
							$retucode= -21;
	}else{
		# корекция на записа 
		$DB->query("update $taname set ?a where id=?d" ,$aset,$modibill);
	}
	# корекция евент.проформа 
	if ($_POST["idinvotype"]==1){
		$pset= array();
		$pset["idbill"]= $modibill;
		$pset["seriprof"]= $_POST["seriprof"];
		if (empty($roprof)){
			$DB->query("insert into billprof set ?a" ,$pset);
		}else{
			$DB->query("update billprof set ?a where id=?d" ,$pset,$roprof["id"]);
		}
	}else{
	}
	
				#-----------------------------------------------------------
				# 03.04.2012 редовете за избрания шаблон 
				$idtemp= $_POST["idtemp"];
//var_dump($idtemp);
				if ($idtemp==0){
				}else{
					foreach($_SESSION["tempdefi"][$idtemp] as $codeelem){
//print "<br>codeelem=[$codeelem]";
						$_POST["codetype"]= $codeelem;
						$_POST["action"]= $_SESSION["billdefi"][$codeelem]["txdesc"];
						$_POST["ground"]= $_SESSION["billdefi"][$codeelem]["txgrou"];
						$_POST["interest"]= "";
							$amount= $_SESSION["billdefi"][$codeelem]["perc"];
						addbillelem($modibill,$resufiel,$amount);
//							$retucode= -22;
					}
				}
				#-----------------------------------------------------------
	# брой редове 
	$coun= $DB->selectcell("select count(*) from billelem where idbill=?d"  ,$modibil);
//print "coun=[$coun]";
	if ($coun==0){
				$retucode= -21;
	}else{
	}
//									$DB->query("unlock tables");
											# край - според дали има грешка 
											}
									$DB->query("unlock tables");

#------ submit с формални грешки 
}elseif ($mfacproc==NULL){
	# стандартна реакция 
							$retucode= 1;
	doerrors();
/*
					# лепенка 
					$idclaimer= $_POST["idclaimer"];
					if ($idclaimer==0){
						$lister= $smarty->get_template_vars("LISTER");
						$lister["idclaimer"]= "взискателя е задължително поле";
	$smarty->assign("LISTER", $lister);
					}else{
					}
*/
//print "SMARTY=";
//print_rr($smarty->get_template_vars());

#------ автоматичен submit -----------------------------------------------------
}elseif ($mfacproc=="UNKNOWN"){

#------ невъзможна грешка от библиотеката 
}else{
print "<br>error=mfacproc=";
var_dump($mfacproc);
die();
}

#----------------- край на директното редактиране -----------------------

$smarty->assign("VARI", $mfacproc);
//var_dump($modibill);
//var_dump($retucode);
# добавена е нова сметка 
if ($retucode== -21){
//////////////////////////	$modeel= "edit=".$edit."&zone=".$zone."&modibill=".$modibill;
/////////////	$modeel= "mode=$mode&edit=$edit&zone=$zone&modibill=$modibill";
//	$smarty->assign("TOGGPARA",2);
//print "modibill=end=[$modibill]";
	//$topart2= true;
					$modeel .= "&modibill=".$modibill."&topart2=yes";
					$relurl= geturl($modeel);
					reload("",$relurl);
}elseif ($retucode==0){
	# redirect 
//	reload("parent",$relurl);
}else{
}


?>