<?php
# разпределение : корекция на бюджетни данни 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $vari - подрежим 
#    $page - текущата страница 
# основен : 
#    $editbudg - finatran.id на записа, който сочи чрез idtranbudget към tranbudget.id за корекция 
# още отгоре : 
#    $relurl - след успешен събмит 
//print_r($GETPARAM);
//print_rr($_POST);

			# основен параметър 
			$rotran= getrow("finatran",$editbudg);
			$edit2= $rotran["idtranbudget"];
			$recocoun= $DB->selectCell("select count(*) from tranbudget where id=?" ,$edit2);
			$notexist= ($recocoun==0);
//print "[$editbudg][$edit2]";
			# делото 
/*
			$rofina= getrow("finance",$rotran["idfinance"]);
			$idcase= $rofina["idcase"];
*/
			$idcase= $rotran["idcase"];
//var_dump($idcase);
//			# таблицата 
			$taname= "tranbudget";
			# префикс за полетата в шаблона 
			$pref= "budg__";
			$lepref= strlen($pref);
			# полета с дата 
			$ardate= array("docdate","fromdate","todate");
# шаблона 
$tpname= "tranbudg.ajax.tpl";
# полетата 
$filist= array(
	$pref."codepaym"=> NULL
	,$pref."typedoc"=> NULL
	,$pref."docdate"=>  array("validator"=>"bgdate_valid")
	,$pref."fromdate"=> array("validator"=>"bgdate_valid")
	,$pref."todate"=>   array("validator"=>"bgdate_valid")
//	,$pref."iddebtor"=> array("validator"=>"notzero", "error"=>"длъжника е задължителен")
);
# константни полета 
$ficonst= array();
# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page."&filt=".$filt);
//$relurl= geturl("mode=".$mode."&page=".$page);

									# класа за редактиране 
									include_once "edit.class.php";

#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
//print_rr($filist);
//print_rr($_POST);
									# основен параметър - 
									# $edit2 = $taname.id 
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	if ($edit2==0){
	}else{
		$rocont= $DB->selectRow("select * from $taname where id=?" ,$edit2);
//print_rr($rocont);
		foreach($filist as $finame=>$ficont){
			$name2= substr($finame,$lepref);
			$ficont= $rocont[$name2];
			if (in_array($name2,$ardate)){
				$_POST[$finame]= empty($ficont) ? "" : bgdatefrom($ficont);
			}else{
				$_POST[$finame]= $ficont;
			}
		}
	}
//print_rr($_POST);

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
		$aset= array();
/*
		foreach($filist as $finame=>$ficont){
				$aset[$finame]= $_POST[$finame];
		}
*/
		foreach($filist as $finame=>$ficont){
			$name2= substr($finame,$lepref);
			$ficont= $_POST[$finame];
			if (in_array($name2,$ardate)){
				$aset[$name2]= empty($ficont) ? "" : bgdateto($ficont);
			}else{
				$aset[$name2]= $ficont;
			}
//print "<br>[$finame][$name2][$ficont]";
		}
//print_rr($aset);
							#---- полета с автоматично съдържание 
	# добавяне/корекция 
//	if ($edit2==0){
	if ($notexist){
		# нов запис 
		$edit2= $DB->query("insert into $taname set ?a" ,$aset);
		# указателя към него 
		updrow("finatran",$editbudg,"idtranbudget=".$edit2);
	}else{
		# корекция на записа 
		$DB->query("update $taname set ?a where id=?d" ,$aset,$edit2);
	}
											# край - според дали има грешка 
											}

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
					# за избор на длъжник 
					$ardebt= getselect("debtor","name","idcase=".$idcase,false);
//					$ardebt= dbconv($ardebt);
$smarty->assign("ARDEBTNAME", "ardebt");
	# извеждаме формата 
	$smarty->assign("EDIT", $edit2);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


?>
