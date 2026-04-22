<?php
# брой извърш.действия по деловодители за въведена дата 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
# параметър : 
#   $date - датата 

# полетата 
$filist= array(
	"date"=> array("validator"=>"bgdate_valid_notempty")
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
//print_rr($_POST);

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	$_POST["date"]= date("d.m.Y");
							$retucode= 0;

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;

											# проверка за грешки 
											$lister= array();
											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
												#---- няма ---- 
							$retucode= 0;
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

#----------------- край на директното редактиране -----------------------

# резултат 
if ($retucode==0){
	# деловодителите 
	$aruser= $DB->selectCol("
		select id as ARRAY_KEY, name
		from user
		order by name
		");
	$aruser= dbconv($aruser);
//	$aruser= array(0=>"") + $aruser;
//print_rr($aruser);
$smarty->assign("ARUSER", $aruser);
	# датата 
	$mydate= bgdateto($_POST["date"]);
//var_dump($mydate);
	# входящи документи 
	$ardocu= $DB->selectCol("
		select iduser as ARRAY_KEY, count(id) as coun
		from docu
		where date(created)=?
		group by iduser
		"  ,$mydate);
//print_rr($ardocu);
$smarty->assign("ARDOCU", $ardocu);
	# изходени изходящи документи 
	$ardout= $DB->selectCol("
		select suit.iduser as ARRAY_KEY, count(docuout.id) as coun
		from docuout
		left join suit on docuout.idcase=suit.id
		where docuout.serial<>0 and date(docuout.registered)=?
		group by suit.iduser
		"  ,$mydate);
$smarty->assign("ARDOUT", $ardout);
	# извърш.действия въведени ръчно 
	$arjour= $DB->selectCol("
		select suit.iduser as ARRAY_KEY, count(joursuit.id) as coun
		from joursuit
		left join jour on joursuit.idjour=jour.id
		left join suit on joursuit.idcase=suit.id
		where date(jour.created)=?
		group by suit.iduser
		"  ,$mydate);
$smarty->assign("ARJOUR", $arjour);
}else{
}

# извеждаме 
$smarty->assign("FILIST", $filist);
$pagecont= smdisp("presen.tpl","fetch");


?>