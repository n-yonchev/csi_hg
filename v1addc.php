<?php
# търсене на дело за назначаване към списъка на избран наблюдател 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $page - текущата страница 
#    $viewer - наблюдателя viewer.id 
# $pagecase - текущата страница от списъка с дела 
# $addcas=0 
//print_rr($GETPARAM);

										include_once "v1addcfilt.inc.php";

# таблицата 
$taname= "suit";
# шаблона 
//$tpname= "v1addc.ajax.tpl";
$tpname= "v1addc.tpl";
# полетата 
$filist= array(
	"casenumb"=> NULL
	,"claitext"=> NULL
	,"agentext"=> NULL
);
# константни полета 
//$ficonst= array("iduser"=>$iduser);
$ficonst= array();
# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page."&viewer=".$viewer);
//$relurl= geturl("mode=".$mode."&page=".$page."&viewer=".$viewer."&pagecase=".$pagecase);
	$listpara= "mode=".$mode."&page=".$page."&viewer=".$viewer."&pagecase=".$pagecase;
$relurl= geturl($listpara);
# за скрития линк - чист рефреш 
//print "[$mode][$page][$viewer][$pagecase]";
$smarty->assign("LINKRELO", geturl($listpara."&addcas=0"));

									# класа за редактиране 
									include_once "edit.class.php";
#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
//print_rr($_POST);

									//# основен входен параметър - 
									//# $edit - $taname.id  

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
		# трансформираме заради номера на делото 
		$idca= $rocont["idcase"];
		if ($idca==0){
			$_POST["casenumb"]= "";
		}else{
			$roca= getrow("suit",$idca);
			$_POST["casenumb"]= $roca["serial"]."/".$roca["year"];
		}
	}
*/

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
											# проверяваме за допълнителни грешки 
											//$lister= array();
											$ermess= "";
					$infomess= "";
	# има ли поне 1 попълнено поле 
	$emp1= trim($_POST["claitext"])=="";
	$emp2= trim($_POST["agentext"])=="";
	$emp3= trim($_POST["casenumb"])=="";
	if ($emp1 and $emp2 and $emp3){
											//$lister["claitext"]= "попълни поне 1 поле";
											//$lister["agentext"]= "попълни поне 1 поле";
											//$lister["casenumb"]= "попълни поне 1 поле";
											$ermess= "попълни поне 1 поле";
	}else{
	}
	# какво е въведено 
	$casenumb= trim($_POST["casenumb"]);

	if (empty($casenumb)){
		# въведени са полета за филтър 
										include_once "v1addcfilt.inc.php";
		list($filtclai,$filtagen,$filttext)= getfilters();
		# списъка с дела 
		$mylist= getlist($filtclai,$filtagen,"","limit 1");
		if (empty($mylist)){
					$ermess= "няма дела с $filttext";
		}else{
					$infomess= "ИМА дела с $filttext";
# forcing nyroModal 
$modeel= "viewer=".$viewer ."&clai=".$_POST["claitext"] ."&agen=".$_POST["agentext"];
$nyrolink= geturl($modeel);
$smarty->assign("NYROLINK", $nyrolink);
//				$forcecont= smdisp("finapackauto.tpl","fetch");
//				$smarty->assign("FORCENYRO", $forcecont);
		}

	}else{

		# въведено е дело, съществува ли делото 
		list($serial,$year)= explode("/",$casenumb);
		if (substr($year,0,2)=="20"){
		}else{
			$year= "20".$year;
		}
//		$myli= $DB->select("select id from suit where serial=?d and year=?d" ,$serial,$year);
		$myli= $DB->selectCol("select id from suit where serial=?d and year=?d" ,$serial,$year);
		if (count($myli)==0){
//											$lister["casenumb"]= "несъществуващо дело";
//											$ermess= "несъществуващо дело";
											$ermess= "дело $casenumb не съществува";
		}else{
			# съществува, добавяме го към списъка 
			$adresu= addtolist($viewer,$myli[0]);
			if ($adresu){
					$infomess= "делото $casenumb е добавено към списъка";
			}else{
											$ermess= "дело $casenumb вече е в списъка";
			}
		}

	}
/*
											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
												#---- няма ---- 
							$retucode= 0;
*/
											# според дали има грешка 
											if ($ermess<>""){
												#---- има ---- 
//	$smarty->assign("LISTER",$lister);
	$smarty->assign("ERMESS",$ermess);
							$retucode= 1;
											}else{
												#---- няма ---- 
							$retucode= 0;
/*
		$aset= $ficonst;
		foreach($filist as $finame=>$ficont){
			if ($ficont["inactive"]){
			}else{
				$aset[$finame]= $_POST[$finame];
			}
		}
		# трансформираме заради номера на делото 
		unset($aset["casenumb"]);
		if (empty($casenumb)){
			$aset["idcase"]= 0;
		}else{
			$aset["idcase"]= $myli[0]["id"];
		}
	if ($edit==0){
							#---- полета с автоматично съдържание 
		# нов запис 
		$edit= $DB->query("insert into $taname set ?a, created=now()" ,$aset);
	}else{
							#---- полета с автоматично съдържание 
		# корекция на записа 
		$DB->query("update $taname set ?a where id=?d" ,$aset,$edit);
	}
***/
											# край - според дали има грешка 
											}
	# информ.съобщение 
	$smarty->assign("INFOMESS",$infomess);
	# чистим всички полета 
	$_POST["casenumb"]= "";
	$_POST["claitext"]= "";
	$_POST["agentext"]= "";

//#------ алтернативен submit - само дело 
//}elseif ($mfacproc=="submitsuit"){
//							$retucode= -1;

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
/*
# резултат 
if ($retucode==0){
	# redirect 
	reload("parent",$relurl);
}else{
*/
	# извеждаме формата 
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
//	print smdisp($tpname,"iconv");
	$pagecont= smdisp($tpname,"fetch");
/*
}
*/


?>
