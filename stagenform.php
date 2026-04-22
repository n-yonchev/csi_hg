<?php
# представители и брой дела за всеки - формата 
# източник : stmain.php 
# отгоре : 
#    $mode - текущия режим 
//print "====stagenform====<br>";
//print_rr($GETPARAM);

					# форма за избор на година/месец или период 
					include_once "stform.inc.php";

									# детайлни справки 
									$stmont= $GETPARAM["mont"];
//var_dump($stmont);
									if (isset($stmont)){
										include_once "stagen.php";
# вика се в глав.прозорец, вмъква се в основната страница
return;
									}else{
									}
									# за период 
									$stperi= $GETPARAM["peri"];
//var_dump($stperi);
									if (isset($stperi)){
											include_once "stagen.php";
# вика се в глав.прозорец, вмъква се в основната страница
return;
									}else{
									}

#----------------------------------------------------------------------------------
# формата за евент.период 
				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
//print_r($_POST);
if (0){
#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	$_POST["period"]= "1.1.$year-31.12.$year";
#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
#------ submit с формални грешки 
}elseif ($mfacproc==NULL){
							$retucode= 1;
	doerrors();
#------ автоматичен submit -----------------------------------------------------
}elseif ($mfacproc=="UNKNOWN"){
							$retucode= 2;
											# проверяваме за допълнителни грешки 
							$txer= "";
	list($date1,$date2)= explode("-",$_POST["period"]);
	$bgdate1= bgdateto($date1);
//var_dump($bgdate1);
	list($ye,$mo,$da)= explode("-",$bgdate1);
//print "[$ye][$mo][$da]";
	if (checkdate($mo+0,$da+0,$ye+0)){
		if (empty($date2)){
		}else{
			$bgdate2= bgdateto($date2);
			list($ye,$mo,$da)= explode("-",$bgdate2);
			if (checkdate($mo+0,$da+0,$ye+0)){
				if ($bgdate1>=$bgdate2){
							$txer= "грешен период";
				}else{
				}
			}else{
							$txer= "грешна кр.дата";
			}
//print "[$bgdate1][$bgdate2]";
		}
	}else{
							$txer= "грешна нач.дата";
	}
$smarty->assign("TXER", $txer);
	if (empty($txer)){
							$retucode= 0;
	}else{
	}
#------ невъзможна грешка от библиотеката 
}else{
print "<br>error=mfacproc=";
var_dump($mfacproc);
die();
}

# резултат 
if ($retucode==0){
	if (empty($date2)){
		$bgdate2= $bgdate1;
	}else{
	}
	# redirect 
	$relurl= geturl("mode=".$mode."&peri=".$bgdate1."^".$bgdate2);
	reload("",$relurl);
}else{
}


# извеждаме 
//$smarty->assign("ADDNEW", $addnew);
//$smarty->assign("LIST", $mylist);
$pagecont= smdisp("stmain.tpl","fetch");


?>
