<?php
# взискател от постъпление : сметката бюджетна или не 
# източник : tranaccobudg.ajax.php 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $page - текущата страница 
#    $idcase - делото suit.id 
# основен : 
#    $budgmodi - claimer.id за корекция 
# още отгоре : 
#    $relurl - след успешен събмит 
//print_r($GETPARAM);

# таблицата 
$taname= "tranacco";
# шаблона 
$tpname= "tranaccobudg.ajax.tpl";
# полетата 
$filist= array(
	"desc"=> NULL
);
# константни полета 
$ficonst= array("code"=>"bud");
# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page."&filt=".$filt);
//$relurl= geturl("mode=".$mode."&page=".$page);

# предварително 
//	$rotran= getrow("finatran",$accobudg);
	$rotran= getrow("claimer",$budgmodi);
	$iban= $rotran["iban"];
	$bic= $rotran["bic"];
$smarty->assign("IBAN", $iban);
$smarty->assign("BIC", $bic);
	$roacco= $DB->selectRow("select * from tranacco where iban=?"  ,$iban);
	$roacco= dbconv($roacco);
//print_rr($roacco);
$smarty->assign("ARDATA", $roacco);
$smarty->assign("ISBUDG", $roacco["code"]=="bud");

									# класа за редактиране 
									include_once "edit.class.php";

#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
									# основен параметър - 
									# $budgmodi = claimer.id 
									# $iban = claimer.iban = tranacco.iban 
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
/*
//	if ($accobudg==0){
//	}else{
		$rocont= $DB->selectRow("select * from $taname where id=?" ,$accobudg);
		foreach($filist as $finame=>$ficont){
				$_POST[$finame]= $rocont[$finame];
		}
//	}
*/

#------ submit без формални грешки 
# добавяне към списъка 
}elseif ($mfacproc=="submyes"){
							$retucode= 0;
											# проверяваме за допълнителни грешки 
											$lister= array();
								$desc= trim($_POST["desc"]);
								if (empty($desc)){
											$lister["desc"]= "описанието не може да е празно";
								}else{
								}
											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
												#---- няма ---- 
							$retucode= 0;
//		$aset= array();
		$aset= $ficonst;
		foreach($filist as $finame=>$ficont){
				$aset[$finame]= $_POST[$finame];
		}
							#---- полета с автоматично съдържание 
/*
	# добавяне/корекция 
//	if ($accobudg==0){
//		# нов запис 
//		$accobudg= $DB->query("insert into $taname set ?a" ,$aset);
//	}else{
		# корекция на записа 
		$DB->query("update $taname set ?a where id=?d" ,$aset,$accobudg);
//	}
*/
	# добавяне/корекция 
		$aset["iban"]= $iban;
		$aset["bic"]= $bic;
	$DB->query("insert into $taname set ?a" ,$aset);
											# край - според дали има грешка 
											}

#------ submit без формални грешки 
# изтриване от списъка 
}elseif ($mfacproc=="submno"){
							$retucode= 0;
	$DB->query("delete from $taname where iban=?" ,$iban);

#------ submit с формални грешки 
}elseif ($mfacproc==NULL){
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
	# извеждаме формата 
//	$smarty->assign("EDIT", $budgmodi);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


?>
