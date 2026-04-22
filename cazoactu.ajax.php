<?php
									session_start();
									include_once "common.php";

/******
# пренасяме целия POST в сесийния масив 
print_rr($_POST);
foreach($_POST as $poname=>$pocont){
	$_SESSION["actucalc"][$poname]= $pocont;
}
//print "SESSION-actucalc==";
//print_r($_SESSION["actucalc"]);

# филтъра
$edit= $_SESSION["actucalc"]["idcase"];
$filter= "where idcase=$edit";

# участващите финансови събития - предмети и постъпления, сортирани по дата 
# $listvali - масив със списъка 
# $cbtemp - шаблон за имената на чекбоксовете 
						include_once "cazoactu.inc.php";
list($listvali,$cbtemp)= getactulist($filter);

# уточняваме флаговете за чекбоксовете 
# източник : cazoactu.php 
foreach($listvali as $elname=>$elem){
	# името на полето 
	$finame= sprintf($cbtemp,$elem["oper"],$elem["id"]);
//	$listvali[$elname]["finame"]= $finame;
//	# преди крайната дата ? 
//	$secont= ($elem["date"]<=$enddate);
	//$newcont= ($_SESSION["actucalc"][$finame]=="yes") ? 1 : 0;
	$newcont= ($_SESSION["actucalc"][$finame]=="yes");
			$_SESSION["actucalc"][$finame]= $newcont;
}
******/

# пренасяме POST в сесийния масив 
print_r($_POST);
foreach($_POST as $poname=>$pocont){
	if ($poname=="enddate"){
		$newcont= bgdateto($pocont);
	}elseif ($poname=="idcase"){
		$newcont= $pocont;
	}else{
//		$newcont= ($pocont=="yes") ? 1 : 0;
		$newcont= ($pocont=="yes");
	}
	$_SESSION["actucalc"][$poname]= $newcont;
}
print_r($_SESSION["actucalc"]);

?>
