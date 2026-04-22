<?php
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $edit - docuout.id за корекция 
//print "correction [$mode][$edit]";
//print_r($GETPARAM);

# ВНИМАНИЕ.
# данните се записват в таблицата aainvita, а не в docuout 
//# таблицата 
//$taname= "docuout";
# шаблона 
$tpname= "inviedit.ajax.tpl";
# полетата 
$filist= array(
//	"date"=> array("validator"=>"bgdate_valid_notempty")
	"date"=> array("validator"=>"bgdate_valid")
//	,"flag"=> array("transformer"=>"getputcbox")
	,"flag"=> NULL
	,"person"=> NULL
);
# константни полета 
//$ficonst= array("iduser"=>$iduser);
$ficonst= array();
# reload - след успешен събмит 
$relurl= geturl("mode=".$mode."&page=".$page);


									# класа за редактиране 
									include_once "edit.class.php";
#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
//print_r($_POST);

									# основен входен параметър - 
									# $edit = aainvita.iddocuout = $docuout.id  

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
//	if ($edit==0){
//							#---- полета с автоматично съдържание 
//	}else{
		$rocont= $DB->selectRow("select * from aainvita where iddocuout=?" ,$edit);
		$_POST["date"]= bgdatefrom($rocont["date"]);
		$_POST["flag"]= $rocont["flag"];
		$_POST["person"]= $rocont["person"];
//	}

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
											# проверяваме за допълнителни грешки 
											$lister= array();
	$date= $_POST["date"];
	$isbegi= isset($_POST["flag"]) ? 1 : 0;
	if (empty($date) and $isbegi==1){
											$lister["date"]= "невъзможна ситуация";
	}else{
	}
	$person= $_POST["person"];
	if (empty($date)){
	}else{
		if (empty($person)){
											$lister["person"]= "трябва да въведете задълж.лице";
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
							$retucode= 0;
	# за спомагат.таблица aainvita - 
	# ако има запис за тази ПДИ - корегираме го, ако няма - създаваме 
//														$DB->query("lock tables aainvita write");
														$DB->query("lock tables aainvita write, suit write, docuout write");
		$aset= array();
//		$aset["iddocuout"]= $edit;
		$aset["date"]= bgdateto($date);
		$aset["flag"]= $isbegi;
		$aset["person"]= $person;
	$ardata= $DB->select("select id from aainvita where iddocuout=?d" ,$edit);
	if (count($ardata)==0){
		$DB->query("insert into aainvita set ?a, iddocuout=?d" ,$aset,$edit);
	}else{
		$DB->query("update aainvita set ?a where iddocuout=?d" ,$aset,$edit);
	}
//														$DB->query("unlock tables");
/*
	# накрая - евентуално маркираме делото за извеждане с различен цвят 
	# ако за ПДИ не е започнало изпълнението и вече е изтекъл 7/14-днев.срок според титула 
	if (!empty($date) and $isbegi==0){
		# определяме срока - интервала за изчакване в дни 
		$rodo= getrow("docuout",$edit);
			$idca= $rodo["idcase"];
		$roca= getrow("suit",$idca);
		$idti= $roca["idtitu"];
		$days= $timetitu[$idti];
		# определяме крайния срок за започване 
		# за да са изтекли $days пълни дни, приемаме 1-вата секунда на следващия ден за краен срок 
		list($da,$mo,$ye)= explode(".",$date);
		$finistam= mktime(0,0,1, $mo,$da+$days+1,$ye);
		# дали в момента е преминал крайния срок 
		if (time() > $finistam){
			# да, премнинал е - маркираме делото 
			$hset= array();
			$hset["flagstat"]= 2;
			$DB->query("update suit set ?a, lastdocu= now() where id=?d" ,$hset,$idca);
		}else{
			# не е преминал 
		}
	}else{
	}
*/	
	# накрая - евентуално маркираме делото за извеждане с различен цвят 
	# отразява се само в полето flagstat 
	# ако за ПДИ не е започнало изпълнението и вече е изтекъл 7/14-днев.срок според титула - flagstat=2 
						$rodo= getrow("docuout",$edit);
						$idca= $rodo["idcase"];
			$newflag= 0;
			$mustupdate= false;
	if (empty($date)){
		if ($isbegi==0){
			# няма дата, не е започнало изпълнението 
			# тривиално 
		}else{
			# няма дата, започнало е изпълнението 
			# невъзможно 
		}
	}else{
		if ($isbegi==0){
			# има дата, не е започнало изпълнението 
			# само в този случай проверяваме и срока 
						# определяме срока - интервала за изчакване в дни 
						$roca= getrow("suit",$idca);
						$idti= $roca["idtitu"];
						$days= $timetitu[$idti];
						# определяме крайния срок за започване 
						# за да са изтекли $days пълни дни, приемаме 1-вата секунда на следващия ден за краен срок 
//						list($da,$mo,$ye)= explode(".",$date);
						list($ye,$mo,$da)= explode("-",$date);
						$finistam= mktime(0,0,1, $mo,$da+$days+1,$ye);
						# дали в момента е преминал крайния срок 
						if (time() > $finistam){
							# да, преминал е - маркираме делото 
			$newflag= 2;
			$mustupdate= true;
						}else{
							# не е преминал 
						}
		}else{
			# има дата, започнало е изпълнението 
		}
	}
	# променяме флага на делото flagstat - според текущото му състояние 
	# зачитаме само състоянията на флага за ПДИ - 0, 2 
	# текущото може да flagstat=1 - висящо - тогава не го пипаме 
/*
	if ($mustupdate){
	}else{
		$roca= getrow("suit",$idca);
		$flca= $roca["flagstat"];
		if ($flca==0 or $flca==2){
			$mustupdate= true;
		}else{
		}
	}
	if ($mustupdate){
		$hset= array();
		$hset["flagstat"]= $newflag;
		$DB->query("update suit set ?a, lastdocu= now() where id=?d" ,$hset,$idca);
	}else{
	}
*/
	invicaseupdate($newflag,$idca,$mustupdate);
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
	$rodo= getrow("docuout",$edit);
	$smarty->assign("RODO", $rodo);
	# извеждаме формата 
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}



?>
