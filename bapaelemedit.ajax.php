<?php
# корекция на данните за изходящо плащане 
# само ако постъплението вече е назначено към взискател по дело 
# източник : bapaelemdire.ajax.php 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $page - текущата страница от списъка с извлеченията 
#    $bapaelem - текущото извлечение 
#    $pageelem - текущата страница от списъка с постъпления в това извлечение 
#    $editpaym - избраното постъпление 
//#    $direcase - избраното постъпление 

# таблицата 
$taname= "bank";
# шаблона 
$tpname= "bapaelemedit.ajax.tpl";
# reload - след успешен събмит 
$relurl= geturl("mode=".$mode."&page=".$page."&bapaelem=".$bapaelem."&pageelem=".$pageelem);

# полетата 
$filist= array(
	"payiban"=>  array("validator"=>"notempty", "error"=>"IBAN не може да е празен")
	,"paybic"=>  array("validator"=>"notempty", "error"=>"BIC не може да е празен")
	,"payrem1"=>  array("validator"=>"notempty", "error"=>"основание-1 не може да е празно")
	,"payrem2"=> NULL
);
# константни полета 
$ficonst= array();

/*****
									# класа за редактиране 
									include_once "edit.class.php";

# редактиране 
$obedit= new edit($taname,$editpaym,$filist,$ficonst);
# действие 
$reedit= $obedit->action();
//var_dump($reedit);
*****/


									# класа за редактиране 
									include_once "edit.class.php";
#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";

									# основен входен параметър - 
									# $editpaym - $taname.id 
								# в случая не може да е = 0 

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
//	if ($editpaym==0){
//							#---- полета с автоматично съдържание 
//	}else{
		$rocont= $DB->selectRow("select * from $taname where id=?" ,$editpaym);
		foreach($filist as $finame=>$ficont){
			if ($ficont["inactive"]){
			}else{
				$_POST[$finame]= $rocont[$finame];
			}
		}
//							#---- полета с автоматично съдържание 
//	}

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
		$aset= $ficonst;
		foreach($filist as $finame=>$ficont){
			if ($ficont["inactive"]){
			}else{
				$aset[$finame]= $_POST[$finame];
			}
		}
//	if ($editpaym==0){
//							#---- полета с автоматично съдържание 
//		# нов запис 
//		$editpaym= $DB->query("insert into $taname set ?a" ,$aset);
//	}else{
							#---- полета с автоматично съдържание 
		# корекция на записа 
		$DB->query("update $taname set ?a where id=?d" ,$aset,$editpaym);
//	}
											# край - според дали има грешка 
											}

/*
# СПЕЦИФИЧЕН ПОДХОД 
#------ submit2 - запиши с формалните грешки 
}elseif ($mfacproc=="submit2"){
							$retucode= 0;
		$aset= $ficonst;
		foreach($filist as $finame=>$ficont){
			if ($ficont["inactive"]){
			}else{
				$aset[$finame]= $_POST[$finame];
			}
		}
		# корекция на записа 
		$DB->query("update $taname set ?a where id=?d" ,$aset,$editpaym);
*/

#------ submit с формални грешки 
}elseif ($mfacproc==NULL){
//print_r($_POST);
						# ВНИМАНИЕ. СПЕЦИФИЧЕН ПОДХОД. 
						# разклонение за бутона "запиши с грешки" 
						if (isset($_POST["submit2"])){
							# запиши с грешки 
							$retucode= 0;
		$aset= $ficonst;
		foreach($filist as $finame=>$ficont){
			if ($ficont["inactive"]){
			}else{
				$aset[$finame]= $_POST[$finame];
			}
		}
		# корекция на записа 
		$DB->query("update $taname set ?a where id=?d" ,$aset,$editpaym);
						}else{
							# стандартна реакция - има формални грешки 
							$retucode= 1;
	doerrors();
						}

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



# четем данните за постъплението 
$robank= getrow("bank",$editpaym);
$roclai= getrow("claimer",$robank["idclaimer"]);
$rocase= getrow("suit",$roclai["idcase"]);
/*
						
						# за избор на сметка на взискателя 
						$aracco= getselect("debtor","name","1",true);
print_r($aracco);
						# предаваме името на масива 
						$smarty->assign("ARACCO", "aracco");
*/

# резултат 
if ($retucode==0){
	# redirect 
	reload("parent",$relurl);
}else{
	# извеждаме формата 
	//$smarty->assign("CASEDATA", $mylist);
	$smarty->assign("BANKDATA", $robank);
	$smarty->assign("CLAIDATA", $roclai);
	$smarty->assign("CASEDATA", $rocase);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


?>
