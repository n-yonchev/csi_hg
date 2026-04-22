<?php
# създаване серия празни сметки и фактури 
# отгоре : 
#    $mode - текущия режим 
#    $year - текуща година 
#    $page - текуща страница 
# още : 
#    $relurl - линк след успешен събмит 



//# таблицата 
//$taname= "user";
# шаблона 
$tpname= "finainvocrea.ajax.tpl";
# полетата 
$filist= array(
	"invocoun"=> array("validator"=>"integer", "error"=>"грешен брой")
	,"invodate"=> array("validator"=>"bgdate_valid_notempty")
);
# константни полета 
$ficonst= array();
//# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page);

									# класа за редактиране 
									include_once "edit.class.php";

#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;

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
							$retucode= -2;
	$invodate= $_POST["invodate"];
		$mydate= bgdatefrom(bgdateto($invodate));
//	$mxinvo= $DB->selectCell("select max(serial) from invoice");
	$mxinvo= $DB->selectCell("select max(seriinvo) from bill");
	$mxbill= $DB->selectCell("select max(serial) from bill");
		$smarty->assign("DATE", $mydate);
		$smarty->assign("MXINVO", $mxinvo);
		$smarty->assign("MXBILL", $mxbill);
											# край - според дали има грешка 
											}

#------ submyes за потвърждаване 
}elseif ($mfacproc=="submyes"){

	$invocoun= $_POST["invocoun"];
	$invodate= $_POST["invodate"];
//print "[$invocoun][$invodate]";
//										$DB->query("lock tables bill write, invoice write");
										$DB->query("lock tables bill write");
//	$mxinvo= $DB->selectCell("select max(serial) from invoice");
	$mxinvo= $DB->selectCell("select max(seriinvo) from bill");
	$mxbill= $DB->selectCell("select max(serial) from bill");
	# създаваме 
	$billset= array();
	$billset["date"]= bgdateto($invodate);
	$billset["dateinvo"]= bgdateto($invodate);
	$billset["isvat"]= 1;
	for ($i=1; $i<=$invocoun; $i++){
			$mxbill ++;
			$mxinvo ++;
			$billset["serial"]= $mxbill;
			$billset["seriinvo"]= $mxinvo;
		$DB->query("insert into bill set ?a"  ,$billset);
	}
										$DB->query("unlock tables");
							$retucode= 0;

#------ submno за отказ 
}elseif ($mfacproc=="submno"){
							$retucode= 0;

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

#----------------- край на директното редактиране -----------------------

//var_dump($retucode);
# резултат 
if ($retucode==0){
	# redirect 
	reload("parent",$relurl);
}else{
	# извеждаме формата 
//	$smarty->assign("EDIT", $edit);
	$smarty->assign("RETUCODE",$retucode);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


?>