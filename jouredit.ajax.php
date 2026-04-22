<?php
# 06.05.2009 - дневника на изв.действия - ръчно добавяне/корекция на записи 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $page - текущата страница от списъка 
#    $edit - jour.id за корекция 
//print "correction [$mode][$edit][$page]";
//print_r($GETPARAM);
			# 06.10.2010 - 
			# всяко ръчно добавено действие може да има списък с дела, а не само едно 
			# източник : docuedit.ajax.php 

# таблицата 
$taname= "jour";
# шаблона 
$tpname= "jouredit.ajax.tpl";
# полетата 
$filist= array(
	# 13.02.2012 Дервиш - да се корегира датата на образуване 
	"created"=> array("validator"=>"bgdate_valid_notempty", "error"=>"грешна дата")
	,"descrip"=> array("validator"=>"notempty", "error"=>"описанието е задължително")
	,"person"=> NULL
				# 15.12.2010 - характер на изпълнението за отчета раздел 1 
	,"idchar"=> NULL
//# 09.02.2011 - дали всяко дело да формира отделна позиция в дневника изв.действия 
//	,"isdiff"=> NULL
);
# константни полета 
//$ficonst= array("iduser"=>$iduser);
$ficonst= array();
# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page);
$page= $GETPARAM["page"];
$relurl= geturl("mode=".$mode."&view=".$view."&page=".$page);

# разделител за списъка с дела 
$delimi= " ";



									# класа за редактиране 
									include_once "edit.class.php";
#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";

									# основен входен параметър - 
									# $edit - $taname.id  

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	if ($edit==0){
							#---- полета с автоматично съдържание 
		if (isset($editcasecode)){
			$_POST["tacaselist"]= $editcasecode ." ";
//# 09.02.2011 - дали всяко дело да формира отделна позиция в дневника изв.действия 
//$_POST["isdiff"]= 0;
$smarty->assign("EDITCASECODE",$editcasecode);
		}else{
		}
		# 13.02.2012 Дервиш - да се корегира датата на образуване 
		$_POST["created"]= date("d.m.Y");
	}else{
		$rocont= $DB->selectRow("select * from $taname where id=?" ,$edit);
		foreach($filist as $finame=>$ficont){
			if ($ficont["inactive"]){
			}else{
				$_POST[$finame]= $rocont[$finame];
			}
		}
/*
		# трансформираме заради номера на делото 
		$idca= $rocont["idcase"];
		if ($idca==0){
			$_POST["casenumb"]= "";
		}else{
			$roca= getrow("suit",$idca);
			$_POST["casenumb"]= $roca["serial"]."/".$roca["year"];
		}
*/
				# 06.10.2010 - едно действие - много дела 
				# формираме списъка на делата за textarea 
				$caselistjour= getcaselistjour($edit);
						$case2= array();
				foreach($caselistjour as $elem2){
						$case2[]= $elem2["caseseri"]."/".substr($elem2["caseyear"],2);
				}
				$_POST["tacaselist"]= implode($delimi,$case2);
		# 13.02.2012 Дервиш - да се корегира датата на образуване 
		$_POST["created"]= bgdatefrom($rocont["created"]);
	}

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
											# проверяваме за допълнителни грешки 
											$lister= array();
/*
	# съществува ли делото 
	$casenumb= $_POST["casenumb"];
	list($serial,$year)= explode("/",$casenumb);
	if (empty($casenumb)){
	}else{
		if (substr($year,0,2)=="20"){
		}else{
			$year= "20".$year;
		}
		$myli= $DB->select("select id from suit where serial=?d and year=?d" ,$serial,$year);
		if (count($myli)==0){
											$lister["casenumb"]= "несъществуващо дело";
		}else{
		}
	}
*/
	# съществуват ли делата от списъка 
						$caseer= array();
								$arcaseid= array();
	$arcase= explode($delimi,$_POST["tacaselist"]);
	foreach($arcase as $elem){
		if (empty($elem)){
		}else{
			list($serial,$year)= explode("/",$elem);
			if (sizeof($year) == 4 && substr($year,0,2)=="20"){
			}else{
				$year= "20".$year;
			}
			$myli= $DB->select("select id from suit where serial=?d and year=?d" ,$serial,$year);
			if (count($myli)==0){
						$caseer[]= $elem;
			}else{
//								$arcaseid[]= $myli[0]["id"];
								$myid= $myli[0]["id"];
								# 28.07.2011 
								# за текущото действие може да има много екземпляри на едно дело 
								//if (in_array($myid,$arcaseid)){
								//}else{
									$arcaseid[]= $myid;
								//}
			}
		}
	}

											# според дали има грешка 
/*
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
*/
											if (count($caseer)<>0){
												#---- има ---- 
	$smarty->assign("CASEER",$caseer);
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
//# 09.02.2011 - дали всяко дело да формира отделна позиция в дневника изв.действия 
//		$aset["isdiff"]= (isset($_POST["isdiff"])) ? 1 : 0;
/*
		# трансформираме заради номера на делото 
		unset($aset["casenumb"]);
		if (empty($casenumb)){
			$aset["idcase"]= 0;
		}else{
			$aset["idcase"]= $myli[0]["id"];
		}
*/
							$DB->query("lock tables $taname write, joursuit write");
	# 13.02.2012 Дервиш - да се корегира датата на образуване 
	$aset["created"]= bgdateto($_POST["created"]) ." 00:00:01";
	if ($edit==0){
							#---- полета с автоматично съдържание 
		# нов запис 
//		$edit= $DB->query("insert into $taname set ?a, created=now()" ,$aset);
		$edit= $DB->query("insert into $taname set ?a" ,$aset);
	}else{
							#---- полета с автоматично съдържание 
		# корекция на записа 
		$DB->query("update $taname set ?a where id=?d" ,$aset,$edit);
	}
	
	# синхронизация на групата дела в рефер.таблица joursuit 
	$refelist= $DB->selectCol("select id from joursuit where idjour=?d"  ,$edit);
	foreach($arcaseid as $idcase){
					$uset= array();
					$uset["idjour"]= $edit;
					$uset["idcase"]= $idcase;
		$idrefe= $refelist[0];
		if ($idrefe+0==0){
			$DB->query("insert into joursuit set ?a" ,$uset);
		}else{
			array_shift($refelist);
			$DB->query("update joursuit set ?a where id=?d" ,$uset,$idrefe);
		}
	}
	if (empty($refelist)){
	}else{
		foreach($refelist as $idrefe){
			$DB->query("delete from joursuit where id=?d" ,$idrefe);
		}
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
			if (isset($editcasecode)){
$smarty->assign("EXITCODE", getnyroexit("tjourlink"));
print smdisp($tpname,"iconv");
			}else{
	# redirect 
	reload("parent",$relurl);
			}
}else{
				# 15.12.2010 - характер на изпълнението за отчета раздел 1 
				$smarty->assign("ARCHARTYPENAME", "listchartype_utf8");
	# извеждаме формата 
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


?>