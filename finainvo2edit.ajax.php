<?php
# създаване/корекция на ред от фактура без сметка 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $year - текуща година 
#    $page - текуща страница 
#    $view - фактурата bill.id 
# още отгоре : 
#    $rowedit - реда от фактурата invoelem.id 
//print_r($GETPARAM);


# таблицата 
$taname= "invoelem";
# шаблона 
$tpname= "finainvo2edit.ajax.tpl";
//# reload - след успешен събмит 
//$modeel= "mode=".$mode ."&year=".$year."&page=".$page."&view=".$view;
//$relurl= geturl($modeel);

# данни за фактурата 
$roinvo= getrow("bill",$view);
$smarty->assign("ROINVO", $roinvo);

# полетата 
$filist= array(
	"descrip"=> array("validator"=>"notempty", "error"=>"описанието е задължително")
	,"meas"=> array("validator"=>"notempty", "error"=>"мярката е задължителна")
	,"quan"=> array("validator"=>"integer", "error"=>"грешно количество")
	,"price"=> array("validator"=>"amount", "error"=>"грешна ед.цена")
);
//# константни полета 
//$ficonst= array();

									# класа за редактиране 
									include_once "edit.class.php";

#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";

									# основен параметър - 
									# $rowedit - id на реда от фактурата 
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	if ($rowedit==0){
	}else{
		$rocont= $DB->selectRow("select * from $taname where id=?" ,$rowedit);
		foreach($filist as $finame=>$ficont){
			$_POST[$finame]= $rocont[$finame];
		}
	}

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
											# проверяваме за допълнителни грешки 
											$lister= array();
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
				$aset["idbill"]= $view;
				foreach($filist as $finame=>$ficont){
					$aset[$finame]= $_POST[$finame];
				}
	if ($rowedit==0){
		$rowedit= $DB->query("insert into $taname set ?a" ,$aset);
	}else{
		$DB->query("update $taname set ?a where id=?d" ,$aset,$rowedit);
	}
											# край - според дали има грешка 
											}




#------ submit с формални грешки 
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
//	# redirect 
//	reload("parent",$relurl);
	# рефреш на цялата фактура 
	print "
<script>
$NYROREMOVE
parent.refrow('$view');
parent.refresh('$view');
</script>
	";
}else{
	# извеждаме формата 
	$smarty->assign("EDIT", $rowedit);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
//	$pagecont= smdisp($tpname,"iconv");
}


?>
