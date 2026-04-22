<?php
# избор на дата за евент.филтър 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
# още отгоре : 
#    $year - годината 
#    $page - страницата от списъка 
#    $date, $date2 - евентуално вече избрана дата 

//# таблицата 
//$taname= "subject";
# шаблона 
//$tpname= "doredate.ajax.tpl";
$tpname= "ouredate.ajax.tpl";
# полетата 
/*
$filist= array(
	"date"=>  array("validator"=>"date_valid_notempty")
	,"date2"=>  NULL
);
*/
$filist= array(
//	"date"=> array("validator"=>"bgdate_valid_notempty")
	"date"=> array("validator"=>"bgdate_valid")
	,"date2"=> array("validator"=>"bgdate_valid")
	,"adre"=> NULL
	,"bele"=> NULL
);
# константни полета 
//$ficonst= array("idcase"=>$edit);
$ficonst= array();

#----------------- директно редактиране -----------------------

									# класа за редактиране 
									# само заради функцията doerrors 
									include_once "edit.class.php";
									
				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
//print_r($_POST);
//print "ouredate=[$date][$date2][$adre][$bele]";

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	$_POST["date"]= $date;
	$_POST["date2"]= $date2;
	$_POST["adre"]= $adre;
	$_POST["bele"]= $bele;

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
											# проверяваме за допълнителни грешки 
											$lister= array();
	$date= $_POST["date"];
	$date2= $_POST["date2"];
			if (empty($date2)){
			}else{
				$bgdate= bgdateto($date);
				list($ye,$mo,$da)= explode("-",$bgdate);
				if ($ye<>$year){
											$lister["date"]= "грешна година";
				}else{
				}
			}
			if (empty($date2)){
			}else{
				$bgdate= bgdateto($date);
				$bgdate2= bgdateto($date2);
				list($ye,$mo,$da)= explode("-",$bgdate);
				if ($ye<>$year){
											$lister["date"]= "грешна година";
				}else{
				}
				list($ye,$mo,$da)= explode("-",$bgdate2);
//				if ($ye<2000){
//print "[$year][$ye][$mo][$da]";
				if ($ye<>$year){
											$lister["date2"]= "грешна година";
				}elseif (!checkdate($mo+0,$da+0,$ye+0)){
											$lister["date2"]= "невъзможна дата";
				}elseif ($bgdate>=$bgdate2){
											$lister["date2"]= "грешен период";
				}else{
				}
			}
											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
												#---- няма ---- 
//	$date= $_POST["date"];
//	$date2= $_POST["date2"];
	//$bgdate= bgdateto($date);
	//$bgdate2= bgdateto($date2);
							$retucode= 0;
											# край - според дали има грешка 
											}

#------ submit с формални грешки 
}elseif ($mfacproc==NULL){
							$retucode= 1;
	doerrors();

#------ автоматичен submit -----------------------------------------------------
}elseif ($mfacproc=="UNKNOWN"){
							$retucode= 2;

#------ невъзможна грешка от библиотеката 
}else{
print "<br>error=mfacproc=";
var_dump($mfacproc);
die();
}

# резултат 
if ($retucode==0){

	# нов филтър - започваме от първата страница 
//	$baseurl= "mode=".$mode."&page=".$page."&year=".$year;
	$baseurl= "mode=".$mode."&page=1"."&year=".$year;
//	$relurl= geturl($baseurl."&date=".$date."&date2=".$date2);
	$relurl= geturl($baseurl."&date="  .$date."&date2=".$date2  ."&adre=".$_POST["adre"]."&bele=".$_POST["bele"]);
	# redirect 
	reload("parent",$relurl);

}else{

	# извеждаме формата 
//	$smarty->assign("EDIT", $idel);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");

}


?>
