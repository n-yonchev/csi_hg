<?php
# корекция на постъпление произволен тип за текущото дело
# източник : 
#    ЧАСТИЧНО finaedit.ajax.php - корекция от финансиста в глав.меню 
# отгоре : 
#    $iduser - логнатия потребител 
#    $edit= case.id 
#    $zone= paym 
# елемент за настройка 
#    $finaedit= finance.id - записа за корекция 
									
									# функции, свързани с финансите 
									include_once "fina.inc.php";

# таблицата 
$taname= "finance";
# шаблона 
$tpname= "cazofinaedit.ajax.tpl";

# полетата 
$filist= array(
	"idtype"=> array("validator"=>"notzero", "error"=>"типа е задължително поле")
	,"inco"=> array("validator"=>"amount", "error"=>"грешна сума")
//	,"descrip"=> array("validator"=>"notempty", "error"=>"описанието е задължително")
	,"descrip"=> NULL
//	,"idcase"=> array("validator"=>"caseexi", "error"=>"несъществуващо дело", "transformer"=>"getputcase")
/*
# специфично за прих.касов ордер 
	,"cashserial"=> array("inactive"=>true)
	,"cashyear"=> array("inactive"=>true)
	,"cashdate"=> array("inactive"=>true)
	,"cashname"=> array("inactive"=>true)
*/
);
# константни полета 
	# деловодителя, делото 
	$ficonst= array("iduser"=>$iduser, "idcase"=>$edit);
//$ficonst= array();

					# допълнителни полета - само за тип=в_брой=ПКО 
					# само за формата : 
					#     getnext  - флаг дали да земе следващия номер 
					#     serinome - въведен номер/година 
					# съответно полета само от данните : 
					#     cashserial, cashyear 
					# за формата и от данните : 
					#     cashdate, cashname 
$curryear= (int) date("Y");					
//var_dump($curryear);
$smarty->assign("CURRYEAR", $curryear);

#----------------- директно редактиране -----------------------
# главна променлива : $finaedit = finance.id = записа за корекция 

									# класа за редактиране 
									# само заради функцията doerrors 
									include_once "edit.class.php";
									
				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
//print_r($_POST);

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	$rocont= $DB->selectRow("select * from $taname where id=?" ,$finaedit);
	foreach($filist as $finame=>$ficont){
//		if ($ficont["inactive"]){
//		}else{
			$_POST[$finame]= $rocont[$finame];
//		}
	}
	if ($finaedit==0){
	}else{
		if ($rocont["idtype"]==2){
			# съществуващ ПКО 
			$_POST{"serinome"}= $rocont["cashserial"];
			$_POST{"cashdate"}= $rocont["cashdate"];
			$_POST{"cashname"}= $rocont["cashname"];
		}else{
		}
	}

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
													# заключваме 
													$DB->query("lock tables $taname write, finahist write");
	# следващия възможен номер за текущ.година 
	$nextcash= getnextcash();
	# заради съхраняване на данните след грешка в полетата за тип=в_брой=ПКО 
	$rocont= $DB->selectRow("select * from $taname where id=?" ,$finaedit);
											# проверяваме за допълнителни грешки 
											$lister= array();
	$descrip= $_POST["descrip"];
	if (empty($descrip)){
											$lister["descrip"]= "описанието е задължително";
	}else{
	}
			# само за тип=в_брой = ПКО 
			$idtype= $_POST["idtype"];
			if ($idtype==2){
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
	# номера за текущ.година 
	# източник : oureedit.ajax.php 
	$getnext= isset($_POST["getnext"]);
	$serinome= $_POST["serinome"];
	if ($getnext){
		# избрано е "вземи следващия изх.номер" 
	}else{
		# въведен е желания изх.номер 
		if (empty($serinome)){
											$lister["serinome"]= "изходящия номер е задължителен";
		}else{
			# дали е правилно цяло число 
			if ((string)((int)$serinome)==$serinome){
				# дали вече не съществува ПКО с този номер за текущата година 
									if ($finaedit==0){
										$exfi= "";
									}else{
										# ако е корекция на съществуващ запис 
										# и да не е текущия запис 
										$exfi= " and id<>$finaedit";
									}
				$mycoun= $DB->selectCell("select count(*) from $taname where cashserial=? and cashyear=? $exfi" ,$serinome,$curryear);
				if ($mycoun==0){
					# дали въведения номер не превишава максималния - следв.възможен 
//					$nextcash= getnextcash();
					if ($serinome+0 <= $nextcash){
					}else{
											$lister["serinome"]= "превишава макс.възможен номер";
					}
				}else{
											$lister["serinome"]= "има касов ордер с този номер";
				}
			}else{
											$lister["serinome"]= "грешен изходящ номер";
			}
		}
	# if ($getnext){
	}
			}else{
			# край само за тип=в_брой = ПКО 
			# if ($idtype==2){
			}
											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
												#---- няма ---- 
							$retucode= 0;

		# подготвяме данните 
		$aset= $ficonst;
		foreach($filist as $finame=>$ficont){
//			if ($ficont["inactive"]){
//			}else{
				$aset[$finame]= $_POST[$finame];
//			}
		}
		# подготвяме допълнит.полета за ПКО 
		if ($idtype==2){
			# типа е в_брой=ПКО 
			$aset["cashyear"]= $curryear;
			$aset["cashdate"]= $cashdate;
			$aset["cashname"]= $cashname;
			if ($getnext){
				# избрано е "вземи следващия изх.номер" 
				# само за нов запис $finaedit==0 
				$aset["cashserial"]= $nextcash;
			}else{
				# въведен е желания изх.номер 
				$aset["cashserial"]= $serinome;
			}
		}else{
			# типа е различен - изчистваме евент.старо съдържание 
			$aset["cashserial"]= "";
			$aset["cashyear"]= "";
			$aset["cashdate"]= "";
			$aset["cashname"]= "";
		}
					
					#---- предварителни действия 
					# записваме сумата с 2 дес.знака 
					$aset["inco"]= number_format($aset["inco"],2,".","");
		# запис 
		if ($finaedit==0){
			# нов запис 
			$finaedit= $DB->query("insert into $taname set ?a, time=now()" ,$aset);
		}else{
			# корекция на записа 
			$DB->query("update $taname set ?a, time=now() where id=?d" ,$aset,$finaedit);
		}
					#---- последващи действия 
					# добавяме новия запис в архива 
					finaarchive($finaedit);
											# според дали има грешка 
											}
													# отключваме 
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
//if ($reedit==0){
if ($retucode==0){

	# redirect 
//	reload("parent",$relurl);
	$smarty->assign("EXITCODE", getnyroexit("tpaymlink"));
	print smdisp($tpname,"iconv");

}else{

							# за избор на "тип" - масива $listfinatype - commspec.php 
							# предаваме името, а не съдържанието на масива 
							$smarty->assign("ARTYPENAME", "listfinatype_utf8");
			# евентуалния следващ номер ПКО за текущата година 
			$smarty->assign("NEXTNUMB", getnextcash());
	# извеждаме формата 
	$smarty->assign("EDIT", $finaedit);
	$smarty->assign("FILIST", $filist);
	$smarty->assign("DATA", $rocont);
	print smdisp($tpname,"iconv");
//	$pagecont= smdisp($tpname,"iconv");
}


?>
