<?php
#----------------------------- ниво ред от сметка ---------------------------------------------
# отгоре : 
#    $edit= case.id 
#    $zone= bill 
# управляващ : 
#    $modibill = bill.id 
//print "modibill=mo2=[$modibill]";
//print "correction [$edit][$zone][$func]idel=[$idel]";
//print "===POST===";
//print_rr($_POST);

# таблицата 
$taname= "billelem";
//# шаблона 
//$tpname= "cazobillmodi.ajax.tpl";

/*
# полетата 
$filist= array(
	"codetype"=>  array("validator"=>"notzero", "error"=>"типа е задължителен")
	,"action"=>  array("validator"=>"notempty", "error"=>"действието е задължително поле")
	,"ground"=>  array("validator"=>"notempty", "error"=>"основанието е задължително поле")
	,"interest" => NULL
	,"amount" => NULL
);
# константни полета 
$ficonst= array("idbill"=>$modibill);
*/

# полетата 
$filist= array(
	"paid"=>  array("validator"=>"amount_or_empty", "error"=>"грешна сума")
	,"paidmethod"=> NULL
	,"cashiduser"=> NULL
);

#----------------- директно редактиране -----------------------
									//# основен входен параметър - 
									//# $modibill - id на сметката 
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){

/******
#------ submit без формални грешки 
# добавяне ред 
}elseif ($mfacproc=="subm2"){
//							$retucode= 0;
							$retucode= -6;
	$aset= array();
	$aset["idbill"]= $modibill;
	foreach(array("codetype","action","ground","interest") as $name){
		$aset[$name]= $_POST[$name];
	}
	$DB->query("insert into billelem set ?a"  ,$aset);

#------ submit с формални грешки 
}elseif ($mfacproc==NULL){
	# стандартна реакция 
							$retucode= 1;
	doerrors();
******/

#------ автоматичен submit -----------------------------------------------------
}elseif ($mfacproc=="UNKNOWN" or $mfacproc==NULL){
							$retucode= 2;
						$lister= array();
	
												if (isset($_POST["subm2"])){
													# добавяне ред 
	
	#------------------------ формални проверки -------------------------
	# действие 
	$action= trim($_POST["action"]);
	if (empty($action)){
						$lister["action"]= "действието е задължително";
	}else{
	}
	# основание 
	$ground= trim($_POST["ground"]);
	if (empty($ground)){
						$lister["ground"]= "основанието е задължително";
	}else{
	}
	# мат.интерес 
	$interest= $_POST["interest"];
	if (isset($interest)){
		$interest= trim($interest);
				if ($interest==""){
						$lister["interest"]= "мат.интерес е задължителен";
				}else{
					# имитация на validator_amount, univalidator 
					$exvali= $evalvali["amount"];
					$value= $interest;
					eval("\$result= ($exvali);");
					if ($result){
						$lister["interest"]= "грешна сума за мат.интерес";
					}else{
					}
				}
	}else{
	}
	# директна сума 
	$amount= $_POST["amount"];
	if (isset($amount)){
		$amount= trim($amount);
				if ($amount==""){
						$lister["amount"]= "сумата е задължителна";
				}else{
					# имитация на validator_amount, univalidator 
					$exvali= $evalvali["amount"];
					$value= $amount;
					eval("\$result= ($exvali);");
					if ($result){
						$lister["amount"]= "грешна сума";
					}else{
					}
				}
	}else{
	}
												}elseif (isset($_POST["subm4"])){
													# запиши платена сума 
				$ar2= getsumabill("billelem.idbill=$modibill");
				$suma= $ar2[$modibill]["suma"];
# кредитни известия 
if ($suma<0){
	$suma= -$suma;
}else{
}
				if ($_POST["paid"] > $suma){
						$lister["paid"]= "платената сума надвишава сумата всичко";
$smarty->assign("PAIDER",$lister["paid"]);
				}else{
				}
				# касиера 
				if ($_POST["paidmethod"]=="c"){
					if (empty($_POST["cashiduser"])){
						$lister["cashiduser"]= "избора е задължителен";
$smarty->assign("CASHER",$lister["cashiduser"]);
					}else{
					}
				}else{
				}
												}else{
													# if (isset($_POST["subm2"])){
													}

//var_dump($lister);
						if (empty($lister)){
												if (isset($_POST["subm4"])){
												}else{
	#----------------------- добавяме ред ---------------------------
	addbillelem($modibill,$resufiel,$amount);
//	# корегираме основните данни за сметката 
//	updapaid($modibill);
	# нулираме типа 
	$_POST["codetype"]= "";
												}
						}else{
//print "===LISTER===";
//print_rr($lister);
//	$smarty->assign("LISTER", $lister);
	$smarty->assign("FLAGER", true);
	$_SESSION["LISTER"]= $lister;
	$_SESSION["POSTDA"]= $_POST;
						}

#------ невъзможна грешка от библиотеката 
}else{
print "<br>error=mfacproc=";
var_dump($mfacproc);
die();
}
//var_dump($retucode);

#----------------- край на директното редактиране -----------------------

/***
# 21.05.2012 - КРЪПКА за платената сума - Петя Бъзински 
var_dump($modibill);
if ($modibill==0){
}else{
	# само след корекция 
			# източник : cazobillregi.ajax.php - изходяване 
			# общо дълж.сума по сметката 
			$ar1= getsumabill("billelem.idbill=$modibill");
			$suma1= $ar1[$modibill]["suma"];
	updrow("bill",$modibill,"paid=$suma1");
var_dump($suma1);
}
***/


?>