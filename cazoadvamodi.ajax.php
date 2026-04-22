<?php
# отгоре : 
#    $iduser - логнатия потребител 
#    $edit= case.id за модифициране 
#    $zone= adva 
#    $func= modi 
# входни параметри 
# $editadva - claimadva.id на вноската 
//$idel= $GETPARAM["idel"];
//print "correction [$edit][$zone][$func]idel=[$idel]";

# таблицата 
$taname= "claimadva";
# шаблона 
$tpname= "cazoadvamodi.ajax.tpl";
//# флаг дали е взискател 
//$isclaimer= true;
/*
						# евентуално изтриване 
						$delrec= $GETPARAM["delrec"];
						if (isset($delrec)){
							include_once "cazoevendele.ajax.php";
exit;
						}else{
						}
*/
# полетата 
$filist= array(
	"amount"=>  array("validator"=>"amount_not_zero", "error"=>"грешна сума")
	,"date"=>  array("validator"=>"bgdate_valid_notempty", "error"=>"грешна дата")
	,"idclaimer"=>  array("validator"=>"notzero", "error"=>"взискателя е задължително поле")
	,"descrip"=>  NULL
);
# константни полета 
//$ficonst= array("idcase"=>$edit);
$ficonst= array();
					# за плащането 
# текущата година - за ПКО 
$curryear= (int) date("Y");					
$smarty->assign("CURRYEAR", $curryear);


									# класа за редактиране 
									include_once "edit.class.php";

#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}

									# основен входен параметър - 
									# $editadva = claimer.id на вноската 
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	if ($editadva==0){
		$_POST["date"]= date("d.m.Y");
					# за плащането 
					$_POST["cashdate"]= date("d.m.Y");
					$_POST{"cashseri"}= getnextcash();
	}else{
		$rocont= $DB->selectRow("select * from $taname where id=?" ,$editadva);
		foreach($filist as $finame=>$ficont){
			$_POST[$finame]= $rocont[$finame];
		}
		# датата 
		$_POST["date"]= bgdatefrom($rocont["date"]);
					# за плащането 
					$_POST["idpatype"]= ($rocont["iscash"]==1) ? 1 : 2;
					$_POST{"cashseri"}= $rocont["cashserial"];
					$_POST{"cashdate"}= $rocont["cashdate"];
					$_POST{"cashname"}= $rocont["cashname"];
	}

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
													# заключваме 
//													$DB->query("lock tables finance write, claimadva write");
													$DB->query("lock tables finance write, claimadva write, prih write");
											# проверяваме за допълнителни грешки 
											$lister= array();
					# за плащането 
					# източник : finaedit.ajax.php 
					$idpatype= $_POST["idpatype"];
					if ($idpatype==0){
											$lister["idpatype"]= "типа е задължителен";
					}else{
					}
					
									# само ако е в брой 
									if ($idpatype==1){
					
		# датата 
		$cashdate= $_POST["cashdate"];
		$dateresu= validator_bgdate_valid_notempty($cashdate,NULL);
		if ($dateresu !== true){
											$lister["cashdate"]= $dateresu[0];
		}else{
		}
		# вносителя 
		$cashname= $_POST["cashname"];
		if (empty($cashname)){
											$lister["cashname"]= "името е задължително";
		}else{
		}
		# изх.номер 
		$cashseri= $_POST["cashseri"];
		if (empty($cashseri)){
											$lister["cashseri"]= "изходящия номер е задължителен";
		}else{
			# дали е правилно цяло число 
			if ((string)((int)$cashseri)==$cashseri){
					# дали вече не съществува ПКО с този номер за текущата година 
/*
									//if ($edit==0){
									//	$exfi= "";
									//}else{
									//	# ако е корекция на съществуващ запис 
									//	# и да не е текущия запис 
									//	$exfi= " and id<>$edit";
									//}
					$mycoun= $DB->selectCell("select count(*) from claimadva where cashserial=?d and cashyear=?d and id<>?d" 
					,$cashseri,$curryear,$editadva);
					if ($mycoun==0){
					}else{
											$lister["cashseri"]= "има касов ордер с този номер";
					}
*/
//print <<<END
//$curryear===$cashseri===adva$editadva
//END;
				if (iscashseriuniq($curryear, $cashseri, "adva".$editadva)){
				}else{
											$lister["cashseri"]= "има касов ордер с този номер";
				}
			}else{
											$lister["cashseri"]= "грешен изходящ номер";
			}
		}
									}else{
									# край само ако е в брой 
									}
											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
												#---- няма ---- 
							$retucode= 0;
		$aset= $ficonst;
		foreach($filist as $finame=>$ficont){
			$aset[$finame]= $_POST[$finame];
		}
		# датата 
		$aset["date"]= bgdateto($_POST["date"]);
		# описанието 
		$aset["descrip"]= $_POST["descrip"]."";
					# за плащането 
//					$aset["iscash"]= ($idpatype==1);
									if ($idpatype==1){
					# в брой 
					$aset["iscash"]= 1;
					$aset{"cashserial"}= $cashseri;
					$aset{"cashyear"}= $curryear;
					$aset{"cashdate"}= $cashdate;
					$aset{"cashname"}= $cashname;
									}else{
					# по банка 
					$aset["iscash"]= 2;
					$aset{"cashserial"}= 0;
					$aset{"cashyear"}= 0;
					$aset{"cashdate"}= "";
					$aset{"cashname"}= "";
									}
//print_rr($aset);
	if ($editadva==0){
					# събирача 
					$aset["cashiduser"]= $_SESSION["iduser"];
							#---- полета с автоматично съдържание 
# 16.11.2012 
$aset["idclaimer"] += 0;
		# нов запис 
		$editadva= $DB->query("insert into $taname set ?a" ,$aset);
	}else{
							#---- полета с автоматично съдържание 
		# корекция на записа 
		$DB->query("update $taname set ?a where id=?d" ,$aset,$editadva);
	}
											# край - според дали има грешка 
											}
													# отключваме 
													$DB->query("unlock tables");

#------ submit с формални грешки 
}elseif ($mfacproc==NULL){
	# стандартна реакция 
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
	# линк за redirect 
//	$redilink= array("tadvalink","tactulink");
	$redilink= array("tadvalink","tactulink"  ,"tbilllink");
	# redirect 
//	reload("parent",$relurl);
	$smarty->assign("EXITCODE", getnyroexit($redilink));
	print smdisp($tpname,"iconv");
}else{
						# за избор на взискател - четем списъка по делото 
						$arclai= getselect("claimer","name","idcase=$edit",false);
						# предаваме името на масива 
						$smarty->assign("ARCLAINAME", "arclai");
	# извеждаме формата 
	$smarty->assign("EDIT", $editadva);
	$smarty->assign("FILIST", $filist);
//	$smarty->assign("TYPETEXT", $typetext);
//	$smarty->assign("ISCLAIMER", $isclaimer);
	print smdisp($tpname,"iconv");
//	$pagecont= smdisp($tpname,"iconv");
}







?>