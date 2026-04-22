<?php
# копиране от извлечението на ОББ 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $page - текущата страница 
# $copyfrom==0 
//print "correction [$mode][$edit]";
//print_r($GETPARAM);
//var_dump($copyfrom);

//# таблицата 
//$taname= "finance";
//# шаблона 
//$tpname= "finaedit.ajax.tpl";
# полетата 
$filist= array(
	"bankdata"=> NULL
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

									//# основен входен параметър - 
									//# $copyfrom - $taname.id  

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	/*
	if ($edit==0){
							#---- полета с автоматично съдържание 
	}else{
		$rocont= $DB->selectRow("select * from $taname where id=?" ,$edit);
		foreach($filist as $finame=>$ficont){
			if ($ficont["inactive"]){
			}else{
				$_POST[$finame]= $rocont[$finame];
			}
		}
							#---- полета с автоматично съдържание 
	}
	*/

#------ submit без формални грешки 
# след бутона "трансформирай" 
}elseif ($mfacproc=="transform"){
							$retucode= -2;
	$bankdata= $_POST["bankdata"];
	if (empty($bankdata)){
		$banklist= array();
	}else{
		$banklist= banktran($bankdata);
	}
//	$_POST["bankdata"]= "";

#------ submit без формални грешки 
# след бутона "добави верните" 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
	$bankdata= $_POST["bankdata"];
	if (empty($bankdata)){
							$retucode= -2;
		$_POST["bankdata"]= "";
	}else{
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
	# добавяме серия верни записи 
	$banklist= banktran($bankdata);
//print_r($banklist);
	foreach($banklist as $elem){
		if (isset($elem["error"])){
		}else{
//print_r($elem);
			# верен запис 
			# добавяме запис в основната таблица finance 
					$fset= array();
					$fset["iduser"]= $_SESSION["iduser"];
					$fset["inco"]= $elem["amount"];
						$fset["inco"]= str_replace(",","",$fset["inco"]);
					$fset["descrip"]= $elem["desc1"] ." " .$elem["desc2"] ." " .$elem["desc3"] ." " .$elem["desc4"];
//var_dump($fset["descrip"]);
				# типа е 1=превод 
				$fset["idtype"]= 1;
						$fset= toutf8($fset);
			$idfina= $DB->query("insert into finance set ?a, time=now()"  ,$fset);
							# добавяме записа в архива 
							finaarchive($idfina);
			# добавяме запис в спомагателната таблица finasource 
//print_r($elem);
					$oset= $elem;
					$oset["idfinance"]= $idfina;
						$oset= toutf8($oset);
//print_r($oset);
			$idfihi= $DB->query("insert into finasource set ?a"  ,$oset);
//print "<br>[$idfina][$idfihi]";
		}
	}
	# redirect 
	reload("parent",$relurl);
}else{
	# извеждаме формата 
//	$smarty->assign("EDIT", $edit);
//print_r($banklist);
	$smarty->assign("BANKLIST", $banklist);
	$smarty->assign("FILIST", $filist);
	print smdisp("finacopy.ajax.tpl","iconv");
}


?>