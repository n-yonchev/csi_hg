<?php
# корекция номерата на фактура и сметка 
//# отгоре : 
//#    $GETPARAM - масив с параметрите от GET 
//#    $mode - текущия режим 
//#    $year - текуща година 
//#    $page - текуща страница 
# управляващ : 
#    $regi = bill.id 
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
$tpname= "finainvoregi.ajax.tpl";
/*
# reload - след успешен събмит 
//$modeel= "mode=".$mode ."&year=".$year."&page=".$page;
$modeel= "mode=".$mode .$CODEBASE ."&page=".$page;
$relurl= geturl($modeel);
# данните 
$roinvo= getrow($taname,$regi);
$smarty->assign("ROINVO",$roinvo);
*/

# полетата 
//$filist= getfilist();
$filist= array(
	"seriinvo" => array("validator"=>"notempty", "error"=>"номера е задължителен")
	,"serial" => array("validator"=>"notempty", "error"=>"номера е задължителен")
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
									# $regi - bill.id на фактурата/сметката 
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
/*
	if ($roinvo["serial"]==0){
//		$maxserinvo= invonextnumb($year);
		$maxserinvo= invonextser();
		$_POST["invoseri"]= $maxserinvo;
	}else{
		$_POST["invoseri"]= $roinvo["serial"];
	}
/////////////////////		$_POST["invodate"]= date("d.m.Y");
*/
		$rocont= $DB->selectRow("select * from $taname where id=?" ,$regi);
		foreach($filist as $fina=>$fico){
			$_POST[$fina]= $rocont[$fina];
		}

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
									$DB->query("lock tables $taname write");
									//$DB->query("lock tables $taname write, invoice write");
											# проверяваме за допълнителни грешки 
											$lister= array();
/***
	# номера 
	$invoseri= $_POST["invoseri"];
	$arseri= $DB->selectCol("select id from invoice where year=?d and serial=?" ,$year,$invoseri);
	if (count($arseri)==0){
	}else{
											$lister["invoseri"]= "номера е зает от друга фактура";
	}
***/
	# номера 
	involister();
/***
	# датата 
	$invodate= bgdateto($_POST["invodate"]);
	if (substr($invodate,0,4)==$year){
	}else{
											$lister["invodate"]= "датата не е от $year год.";
	}
***/
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
		$seriinvo= $_POST["seriinvo"] +0;
	$aset["seriinvo"]= $seriinvo;
//	$aset["date"]= $invodate;
//	if ($regi==0){
//		$regi= $DB->query("insert into $taname set ?a" ,$aset);
//	}else{
		$DB->query("update $taname set ?a where id=?d" ,$aset,$regi);
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
				$arsuma= getsumainvo("invoelem.idinvoice=$regi");
				$smarty->assign("COUN", $arsuma[$regi]["coun"]);
*/
	# извеждаме формата 
//	$smarty->assign("EDIT", $edit);
	$smarty->assign("YEAR", $year);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


?>
