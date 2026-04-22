<?php
//# корекция статуса на жалба - еднократно, после не може да се променя 
# 21.02.2011 - дати на всички възможни статуси в последователен ред 
# източник : aadocuedit.ajax.php 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $edit - docu.id за корекция 
//print "correction [$mode][$edit]";
//print_r($GETPARAM);

//# таблицата 
//$taname= "aadocutype";
# шаблона 
$tpname= "aacompedit.ajax.tpl";
/*++++
# полетата 
$filist= array(
	"idstatus"=>  array("validator"=>"notzero", "error"=>"статуса е задължителен")
//	"name"=>  array("validator"=>"notempty", "error"=>iconv("windows-1251","UTF-8","името не може да е празно"))
);
++++*/
# полетата 
	$filist= array();
foreach($liststatfiel as $fina){
	$filist[$fina]= array("validator"=>"bgdate_valid", "transformer"=>"getputbgdate");
}
//# бележки 
//$filist["notes"]= NULL;
//print_rr($filist);
# константни полета 
//$ficonst= array("iduser"=>$iduser);
$ficonst= array();
# reload - след успешен събмит 
$relurl= geturl("mode=".$mode."&page=".$page);

# документа 
$rodocu= getrow("docu",$edit);
$smarty->assign("DOCU", $rodocu);
# жалбата 
		$rocont= $DB->selectRow("select * from aadocucomp where iddocu=?d" ,$edit);
$rouser= getrow("user",$rocont["iduser"]);
		$rocont["username"]= $rouser["name"];
$smarty->assign("ROCONT", $rocont);


									# класа за редактиране 
									include_once "edit.class.php";
#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
//var_dump($mfacproc);
//print_rr($_POST);

									# основен входен параметър - 
									# $edit - $taname.id  
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
//		$rocont= $DB->selectRow("select * from aadocucomp where iddocu=?d" ,$edit);
		foreach($filist as $finame=>$ficont){
			$fivalu= $rocont[$finame];
			$_POST[$finame]= empty($fivalu) ? "" : bgdatefrom($fivalu);
		}
	# бележки по жалбата 
	$_POST["notes"]= $rocont["notes"];
//print_rr($_POST);

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
											# проверяваме за допълнителни грешки 
											$lister= array();
		foreach($filist as $fina=>$x2){
//			$em{$fina}= empty($_POST[$fina]);
//var_dump($em{$fina});
			${"em$fina"}= empty($_POST[$fina]);
//var_dump(${"em$fina"});
		}
//var_dump($emdate2);
//var_dump($emdate4);
//var_dump($emdate6);
//var_dump($emdate8);
		if ($emdate4){
		}else{
			if ($emdate2){
											$lister["date2"]= "попълни датата на приемане";
			}else{
			}
		}
		if ($emdate6 and $emdate8){
		}elseif (!$emdate6 and !$emdate8){
											$lister["date6"]= "или удовлетворена, или НЕудовл.";
											$lister["date8"]= "или удовлетворена, или НЕудовл.";
		}else{
			if ($emdate4){
											$lister["date4"]= "трябва да има дата на таксата";
			}else{
			}
			if ($emdate2){
											$lister["date2"]= "трябва да има дата на приемане";
			}else{
			}
		}
							if (count($lister)==0){
					$begidate= "0000-00-00";
		foreach($filist as $fina=>$x2){
			$pofina= $_POST[$fina];
//print "pofina=[$pofina]";
			if (empty($pofina)){
			}else{
				$bgfina= bgdateto($pofina);
//print "bgfina=[$bgfina]";
				if ($bgfina >= $begidate){
					$begidate= $bgfina;
				}else{
											$lister[$fina]= "грешна последователност на дати";
					break;
				}
			}
		}
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
							$DB->query("lock tables aadocucomp write");
		$aset= array();
		$aset["iddocu"]= $edit;
//		$aset["idstatus"]= $_POST["idstatus"];
		$aset["iduser"]= $iduser;
				foreach($filist as $fina=>$x2){
					$pofina= $_POST[$fina];
					if (empty($pofina)){
		$aset[$fina]= "";
					}else{
		$aset[$fina]= bgdateto($pofina);
					}
				}
	$coun= $DB->selectCell("select count(*) from aadocucomp where iddocu=?d" ,$edit);
//var_dump($edit);
//var_dump($coun);
	# бележки по жалбата 
	$aset["notes"]= $_POST["notes"];
	if ($coun==0){
		$DB->query("insert into aadocucomp set ?a, created=now()" ,$aset);
	}else{
//											$lister["idstatus"]= "вече е променен";
		$DB->query("update aadocucomp set ?a, created=now() where iddocu=?d" ,$aset,$edit);
	}
							$DB->query("unlock tables");
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

#----------------- край на директното редактиране -----------------------


# резултат 
if ($retucode==0){
	# redirect 
	reload("parent",$relurl);
}else{
							# за избор на "тип" - масива $liststatcomp - commspec.php 
							# предаваме името, а не съдържанието на масива 
							$smarty->assign("ARSTATNAME", "liststatcomp_utf8");
	# извеждаме формата 
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


?>