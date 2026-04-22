<?php
										# ВНИМАНИЕ.
										# Този скрипт е шунтиран в шаблона case.tpl и не е тестван. 
										# Неговата функция се изпълнява от "добави" в свободните дела 
# 01.06.2009 - добавяне на празно дело без данни и входни документи 
# източник : 
#    oureedit.ajax.php 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $page - текущата страница от списъка 
#    $edit =0 
//print "correction [$mode][$edit][$page]";
//print_r($GETPARAM);

# таблицата 
$taname= "suit";
# шаблона 
$tpname= "caseaddnew.ajax.tpl";
# полетата 
$filist= array(
	"getnext"=> NULL
	,"seriyear"=> NULL
//	,"descrip"=>  array("validator"=>"notempty", "error"=>"описанието е задължително")
//	,"adresat"=>  array("validator"=>"notempty", "error"=>"адресата е задължителен")
//	,"notes"=> NULL
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

									# основен входен параметър - 
									# $edit - $taname.id  

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
/*
	if ($edit==0){
							#---- полета с автоматично съдържание 
	}else{
		$rocont= getrow("docuout",$edit);
//		$rocont= dbconv($rocont);
		$_POST["descrip"]= toutf8($rocont["descrip"]);
		$_POST["adresat"]= toutf8($rocont["adresat"]);
		$_POST["notes"]= toutf8($rocont["notes"]);
$smarty->assign("DOCUNOME",$rocont["serial"]."/".$rocont["year"]);
	}
*/

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
													$DB->query("lock tables suit write, user write, office write");
											# проверяваме за допълнителни грешки 
											$lister= array();
//		if ($edit==0){
			if (isset($_POST["getnext"])){
			}else{
					list($seri,$year)= explode("/",$_POST["seriyear"]);
					$seri= $seri +0;
								if (substr($year,0,2)=="20"){
								}else{
									$year= "20".$year;
								}
					$year= $year +0;
					if ($seri>0 and $year>0){
						# според годината 
						$cuyear= (int) date("Y");
						if($year>$cuyear){
							# годината е след текущата 
											$lister["seriyear"]= "грешнa година";
						}else{
							# годината е равна или по-малка от текущата 
							# не трябва да съществува дело с този номер/година 
							$mycoun= $DB->selectCell("select count(*) from suit where serial=? and year=?" ,$seri,$year);
							if ($mycoun==0){
								if ($year==$cuyear){
									# годината е текущата 
									# номера не трябва да надвишава максималния до момента 
									$sermax= getnextcase();
									if ($seri > $sermax){
											$lister["seriyear"]= "номера превишава макс. за текущата година";
									}else{
											$lister["seriyear"]= "има дело с този номер/година";
									}
								}else{
								}
							}else{
							}
						}
					}else{
											$lister["seriyear"]= "грешен номер/година";
					}
			}
//		}else{
//		}

											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
												#---- няма ---- 
							$retucode= 0;
			# подготвяме съдържанието 
			# източник за сер.номер : cazo6regi.ajax.php 
			$aset= array();
//			$aset["descrip"]= $_POST["descrip"];
//			$aset["adresat"]= $_POST["adresat"];
//			$aset["notes"]= $_POST["notes"];
//		if ($edit==0){
			$aset["year"]= $year;
			if (isset($_POST["getnext"])){
				$aset["serial"]= getnextcase();
			}else{
				$aset["serial"]= $seri;
			}
//		}else{
//		}
		# корекция на записа 
//		if ($edit==0){
			$DB->query("insert into suit set ?a, created=now()" ,$aset);
//		}else{
//			$DB->query("update suit set ?a where id=?d" ,$aset,$edit);
//		}
											# край - според дали има грешка 
											}
													$DB->query("unlock tables");

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
	# извеждаме формата 
	$smarty->assign("NEXTNUMB", getnextcase());
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}



?>
