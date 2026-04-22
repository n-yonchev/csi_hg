<?php
# корекция на искане за справка от регистъра на длъжниците 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $edit - aadocuc2.id за корекция 
# $reload - след успешен събмит 
//print "correction [$mode][$edit]";
//print_rr($GETPARAM);

# таблицата 
$taname= "aadocuc2";
# шаблона 
$tpname= "cer2edit.ajax.tpl";
/*****
# полетата 
$filist= array(
# docu - като вход.документ 
	"text"=> NULL
	,"from"=>  array("validator"=>"notempty", "error"=>"подателя е задължителен")
	,"notes"=>  NULL
# docuout - като изх.документ 
	,"adresat"=>  array("validator"=>"notempty", "error"=>"адресата е задължителен")
	,"descrip"=>  array("validator"=>"notempty", "error"=>"описанието е задължително")
# aadocucert - като сертификат 
	,"dateapplic"=> array("validator"=>"bgdate_valid_notempty", "transformer"=>"getputbgdate")
//	,"param"=>  array("validator"=>"notempty", "error"=>"съдържанието е задължително")
		,"egn"=> NULL
		,"eik"=> NULL
		,"foname"=> NULL
	,"taxname"=>  array("validator"=>"notempty", "error"=>"платеца е задължителен")
	,"taxdate"=> array("validator"=>"bgdate_valid_notempty", "transformer"=>"getputbgdate")
	,"idtaxbank"=>  array("validator"=>"notzero", "error"=>"банката е задължителна")
	,"taxrefe"=>  array("validator"=>"notempty", "error"=>"реф.номер е задължителен")
);
*****/
# полетата 
$filist= array(
	"idtype"=>  array("validator"=>"notzero", "error"=>"типа е задължителен")
	,"name"=>  array("validator"=>"notempty", "error"=>"името е задължително")
	,"egneik"=> array("validator"=>"notempty", "error"=>"съдържанието е задължително")
	,"isinvo"=>  array("validator"=>"notzero", "error"=>"флага е задължителен")
	,"name2"=>  array("validator"=>"notempty", "error"=>"името е задължително")
	,"idtype2"=>  array("validator"=>"notzero", "error"=>"типа е задължителен")
	,"notes"=>  NULL
);
//print_rr($filist);
# константни полета 
//$ficonst= array("iduser"=>$iduser);
$ficonst= array();
//# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page);

# данните 
$q2= getcertqu() ." where aadocuc2.id=$edit";
//var_dump($q2);
$data= $DB->select($q2);
//print_rr($data);
$rocont= $data[0];
$smarty->assign("DATA", $rocont);
$smarty->assign("D2", tran1251($rocont));
//print "ROCONT=";
//print_rr($rocont);

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
									# $edit - docu.id  
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	if ($edit==0){
		$_POST["idtype"]= 1;
		$_POST["isinvo"]= 0;
		$_POST["idtype2"]= 1;
	}else{
		foreach($filist as $finame=>$ficont){
			$_POST[$finame]= $rocont[$finame];
		}
/*
		$idtype2= $rocont["idtype2"];
		$finame2= $listty[$idtype2];
			$_POST[$finame2]= $rocont["param"];
*/
		$idtype2= $rocont["idtype2"];
			if ($idtype2==1){
		$_POST["egn"]= $rocont["param"];
			}elseif ($idtype2==2){
		$_POST["eik"]= $rocont["param"];
			}else{
			}
		$invodata= $rocont["invodata"];
				if (empty($invodata)){
				}else{
		$arinvo= unserialize($invodata);
		foreach($fiinvo as $finame){
			$_POST[$finame]= $arinvo[$finame];
		}
				}
//				$invodata= serialize($arinvo);
	}
//		$rocont= $DB->selectRow("select * from aadocucomp where iddocu=?d" ,$edit);
/*****
	if ($edit==0){
		$_POST["dateapplic"]= date("d.m.Y");
		$_POST["taxdate"]= date("d.m.Y");
		$_POST["descrip"]= toutf8("удостоверение за вписване на длъжник");
		$_POST["text"]= toutf8("молба за удостоверение за вписване");;
	}else{
		foreach($filist as $finame=>$ficont){
			$_POST[$finame]= $rocont[$finame];
		}
		$_POST["dateapplic"]= bgdatefrom($rocont["dateapplic"]);
		$_POST["taxdate"]= bgdatefrom($rocont["taxdate"]);
			$idtype2= $rocont["idtype2"];
			$finame2= $listty[$idtype2];
		$_POST[$finame2]= $rocont["param"];
	}
*****/
//print_rr($_POST);

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
											# проверяваме за допълнителни грешки 
											$lister= array();
			$idtype2= $_POST["idtype2"];
			$egn= $_POST["egn"];
			$eik= $_POST["eik"];
			if ($idtype2==1){
				if (empty($egn)){
											$lister["egn"]= "ЕГН е задължителен";
				}else{
					if (preg_match('/^[0-9]{1,}$/',$egn)){
						if (preg_match('/^[0-9]{10}$/',$egn)){
						}else{
											$lister["egn"]= "ЕГН трябва да съдържа точно 10 цифри";
						}
					}else{
											$lister["egn"]= "ЕГН трябва да съдържа само цифри";
					}
				}
			}else{
			}
			if ($idtype2==2){
				if (empty($eik)){
											$lister["eik"]= "ЕИК е задължителен";
				}else{
					if (preg_match('/^[0-9]{1,}$/',$eik)){
					}else{
											$lister["eik"]= "ЕИК трябва да съдържа само цифри";
					}
				}
			}else{
			}
/*
					$idtype= $_POST["idtype"];
					if ($idtype==0){
											$lister["idtype"]= "типа е задължителен";
					}else{
					}
*/
/***
		$egn= trim($_POST["egn"]);
		$eik= trim($_POST["eik"]);
		$foname= trim($_POST["foname"]);
//		if (empty($egn) and empty($eik) and empty($foname)){
		# 25.08.2011 
		$empegn= (empty($egn)) ? 0 : 1;
		$empeik= (empty($eik)) ? 0 : 1;
		$empfon= (empty($foname)) ? 0 : 1;
		$emptysum= $empegn+$empeik+$empfon;
		if ($emptysum==0){
											$lister["egn"]= "ПОНЕ едно от 3-те полета трябва да е попълнено";
											$lister["eik"]= $lister["egn"];
											$lister["foname"]= $lister["egn"];
		}else{
		}
		if (empty($lister)){
			if (empty($egn)){
			}else{
				if (preg_match('/^[0-9]{1,}$/',$egn)){
					if (preg_match('/^[0-9]{10}$/',$egn)){
					}else{
											$lister["egn"]= "ЕГН трябва да съдържа точно 10 цифри";
					}
				}else{
											$lister["egn"]= "ЕГН трябва да съдържа само цифри";
				}
			}
			if (empty($eik)){
			}else{
				if (preg_match('/^[0-9]{1,}$/',$eik)){
				}else{
											$lister["eik"]= "ЕИК трябва да съдържа само цифри";
				}
			}
		}else{
		}
***/
		$idtype= $_POST["idtype"];
		$isinvo= $_POST["isinvo"];
		if ($idtype==1 and $isinvo==1 or $idtype==2){
			foreach($fiinvo as $invoname){
				if (empty($_POST[$invoname])){
											$lister[$invoname]= "съдържанието е задължително";
				}else{
				}
			}
		}else{
		}
											# според дали има грешка 
//print_rr($lister);
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
												#---- няма ---- 
							$retucode= 0;
		$aset= array();
		$aset["iduser"]= $_SESSION["iduser"];
		foreach($filist as $finame=>$x2){
			$aset[$finame]= $_POST[$finame];
		}
		$aset["isinvo"]= ($idtype==2) ? 1 : $aset["isinvo"];
							if ($aset["isinvo"]==0){
		$aset["invodata"]= "";
							}else{
				$arinvo= array();
		foreach($fiinvo as $finame){
			$arinvo[$finame]= $_POST[$finame];
		}
				$invodata= serialize($arinvo);
		$aset["invodata"]= $invodata;
							}
			if ($idtype2==1){
		$aset["param"]= $egn;
			}elseif ($idtype2==2){
		$aset["param"]= $eik;
			}else{
			}
/*
								$xxpa= "";
								$xxty= "";
			foreach($listty as $fitype=>$finame){
				$ficont= $_POST[$finame];
				if (empty($ficont)){
				}else{
								$xxpa= $ficont;
								$xxty= $fitype;
				}
			}
		$aset["param"]= $xxpa;
		$aset["idtype2"]= $xxty;
*/
	if ($edit==0){
		$edit= $DB->query("insert into $taname set ?a, islocal=1, created=now(), lastmodi=now()" ,$aset);
	}else{
		$DB->query("update $taname set ?a, islocal=1, lastmodi=now() where id=?d" ,$aset,$edit);
	}
	
/*****
	# текущата година 
	$docuyear= (int) date("Y");
					$roaa= $DB->selectRow("select id from aadocutype where mode=?"  ,$MODECERT);
	$ddtype= $roaa["id"];
	# начало 
	if ($edit==0){
							$DB->query("lock tables docu write, docuout write, aadocucert write");
		# следв.номер входен документ за годината 
		$ser1= $DB->selectCell("select max(serial) from docu where year=?" ,$docuyear);
		$nextser1= $ser1 + 1;
		# следв.номер изходящ документ за годината 
		$ser2= $DB->selectCell("select max(serial) from docuout where year=?" ,$docuyear);
		$nextser2= $ser2 + 1;
	}else{
	}
	# съдържание за вход.документ docu 
		$aset= array();
	$aset["text"]= $_POST["text"];
	$aset["from"]= $_POST["from"];
	$aset["notes"]= $_POST["notes"];
	# съдържание за сертификата aadocucert 
		$bset= array();
	$bset["iduser2"]= $_SESSION["iduser"];
	$bset["dateapplic"]= bgdateto($_POST["dateapplic"]);
	$bset["taxname"]= $_POST["taxname"];
	$bset["taxdate"]= bgdateto($_POST["taxdate"]);
	$bset["idtaxbank"]= $_POST["idtaxbank"];
	$bset["taxrefe"]= $_POST["taxrefe"];
								$xxpa= "";
								$xxty= "";
			foreach($listty as $fitype=>$finame){
				$ficont= $_POST[$finame];
				if (empty($ficont)){
				}else{
								$xxpa= $ficont;
								$xxty= $fitype;
				}
			}
	$bset["param"]= $xxpa;
	$bset["idtype2"]= $xxty;
//print_rr($bset);
	# съдържание за изх.документ docuout 
		$oset= array();
	$oset["adresat"]= $_POST["adresat"];
	$oset["descrip"]= $_POST["descrip"];
	# запис/корекция 
	if ($edit==0){
			$aset["serial"]= $nextser1;
			$aset["year"]= $docuyear;
			$aset["idtype"]= $ddtype;
			$aset["iduser"]= $_SESSION["iduser"];
		$edit= $DB->query("insert into docu set ?a, created=now()" ,$aset);
			$oset["serial"]= $nextser2;
			$oset["year"]= $docuyear;
			$oset["isentered"]= 1;
		$iddocuout= $DB->query("insert into docuout set ?a, created=now(), registered=now()" ,$oset);
			$bset["iddocu"]= $edit;
			$bset["iddocuout"]= $iddocuout;
		$idcert= $DB->query("insert into aadocucert set ?a, lastmodi=now()" ,$bset);
	}else{
		$DB->query("update docu set ?a where id=?d" ,$aset,$edit);
		$DB->query("update docuout set ?a where id=?d" ,$oset,$rocont["iddocuout"]);
		$DB->query("update aadocucert set ?a, lastmodi=now() where id=?d" ,$bset,$rocont["idcert"]);
	}
*****/
	# край 
	if ($edit==0){
							$DB->query("unlock tables");
	}else{
	}
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
/*****
						$arbank= getselect("banklist","name","1",true);
						$smarty->assign("ARBANKNAME", "arbank");
*****/
							# за радиобутона - 1=юридическо 2=физическо 
							# предаваме съдържанието на масива 
/*
						unset($listmembtype[0]);
						unset($listmembtype[3]);
							$smarty->assign("ARTYPE", $listmembtype);
*/
						/*
							$listpatype= array();
							$listpatype[1]= "физическо лице";
							$listpatype[2]= "юридическо лице";
							$smarty->assign("ARTYPE", $listpatype);
						*/
//var_dump($smarty->get_template_vars('LISTER'));
	# извеждаме формата 
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


?>