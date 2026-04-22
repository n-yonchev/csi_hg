<?php
# корекция номера на сметка 
# управляващ : 
#    $seribilledit = bill.id за корекция 
# още отгоре : 
#    $modeel - стринг за базовия линк 
#    $relurl - базовия линк 
#    $robill - записа за сметката bill.id=$modibill 
# още отгоре : 
#    $CODEBASE - елемента за базовия URL $modeel 
//print_rr($GETPARAM);


# таблицата 
$taname= "bill";
# шаблона 
$tpname= "finaseribill.ajax.tpl";
/*
# reload - след успешен събмит 
//$modeel= "mode=".$mode ."&year=".$year."&page=".$page;
$modeel= "mode=".$mode .$CODEBASE ."&page=".$page;
$relurl= geturl($modeel);
# данните 
$roinvo= getrow($taname,$seribilledit);
$smarty->assign("ROINVO",$roinvo);
*/

# полетата 
//$filist= getfilist();
$filist= array(
//+++++++++++++++++++	"serial" => array("validator"=>"notempty", "error"=>"номера е задължителен")
	"serial" => NULL
//	,"serial" => array("validator"=>"notempty", "error"=>"номера е задължителен")
//////////////////////	,"invodate" => array("validator"=>"bgdate_valid_notempty")
	);

# константни полета 
$ficonst= array();

									# класа за редактиране 
									include_once "edit.class.php";

#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";

									# основен параметър - 
									# $seribilledit - bill.id на фактурата/сметката 
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
		$rocont= $DB->selectRow("select * from $taname where id=?" ,$seribilledit);
		/*
		foreach($filist as $fina=>$fico){
			$_POST[$fina]= $rocont[$fina];
		}
		*/
		$serial= $rocont["serial"];
		if ($serial<=0){
			$_POST["serial"]= billnextser();
		}else{
			$_POST["serial"]= $serial;
		}

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
									$DB->query("lock tables $taname write");
									//$DB->query("lock tables $taname write, invoice write");
											# проверяваме за допълнителни грешки 
											$lister= array();
	# номера 
	billlister($seribilledit);
											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
												#---- няма ---- 
							$retucode= 0;
	# добавяне/корекция 
	$aset= array();
		$serial= $_POST["serial"] +0;
	$aset["serial"]= $serial;
					#++++++++++++++++++++++++++++++++++++++++++++
					if ($serial==0){
						$robill= getrow("bill",$seribilledit);
						if ($robill["seriinvo"]==0){
	$aset["serial"]= -1;
						}else{
						}
					}else{
					}
					#++++++++++++++++++++++++++++++++++++++++++++
//	$aset["date"]= $invodate;
//	if ($seribilledit==0){
//		$seribilledit= $DB->query("insert into $taname set ?a" ,$aset);
//	}else{
		$DB->query("update $taname set ?a where id=?d" ,$aset,$seribilledit);
//	}
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

# резултат 
if ($retucode==0){
	# redirect 
	reload("parent",$relurl);
}else{
/*
				# брой редове във фактурата 
				$arsuma= getsumainvo("invoelem.idinvoice=$seribilledit");
				$smarty->assign("COUN", $arsuma[$seribilledit]["coun"]);
*/
	# извеждаме формата 
//	$smarty->assign("EDIT", $edit);
	$smarty->assign("YEAR", $year);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


?>
