<?php
# нов входящ банков пакет 
# - само upload на XML файл 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $page - текущата страница от списъка 
#    $edit = 0 
//print_r($GETPARAM);

# шаблона 
$tpname= "bapaedit.ajax.tpl";
//# полетата 
//$filist= array(
//	"name"=>  array("validator"=>"notempty", "error"=>"името не може да е празно")
//);
//# константни полета 
//$ficonst= array("idcashpack"=>$edit);
# reload - след успешен събмит 
$relurl= geturl("mode=".$mode."&page=".$page);

# име на полето с файла за upload 
$uploname= "file";
# суфикс на файла 
$filesuff= ".xml";
# вътр.папка за съхраняване на файловете 
$bankdire= "bankxml/";

#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;

#------ submit без формални грешки 
# в случая се изпълнява етап-1 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
		# uploaded file - името е "file" 
										# проверяваме за грешки от трансфера 
										include "commuplo.php";
										# връща стринг с грешка или празен, ако няма грешка 
										$ertext= checkupload($uploname);
/*
		if ($ertext==""){
			# няма грешки 
			$fitemp= $_FILES[$uploname]["tmp_name"];
//			$finame= $_FILES["file"]["name"];
//						# съдържанието на файла - в полето 
//						$_POST["pdfcover"]= file_get_contents($fitemp);
		}else{
			# има грешки 
							$retucode= 1;
$smarty->assign("ERTEXT", $ertext);
		}
*/
		if ($ertext==""){
			# проверяваме суфикса 
			$filename= $_FILES[$uploname]["name"];
			if (substr($filename,-strlen($filesuff))==$filesuff){
			}else{
										$ertext= "файла не е .xml";
			}
		}else{
		}
		if ($ertext==""){
			# няма грешки 
							$retucode= 8;
							# съхраняваме файла 
							$myname= date("Ymd_His_u_").$filename;
//print "[$myname]";
							$savename= $bankdire.$myname;
							$tempname= $_FILES[$uploname]["tmp_name"];
							copy($tempname,$savename);
										# записваме името в сесията 
										# - заради евент.следващ събмит - action 
										$_SESSION["savename"]= $savename;
							#---------------------------------------------------------------
							# получаваме основ.данни и статистиката 
							include('xml.inc.php');
							$arcont = getxml($savename,false);
//print_r($arcont);
							#---------------------------------------------------------------
		}else{
			# има грешки 
							$retucode= 1;
$smarty->assign("ERTEXT", $ertext);
		}

#------ СПЕЦИФИЧЕН submit без формални грешки 
# в случая се изпълнява етап-2 
}elseif ($mfacproc=="action"){
							$retucode= 0;
							#---------------------------------------------------------------
										# вземаме името на съхранения файл от сесията 
										$savename= $_SESSION["savename"];
										# унищожаваме го от сесията 
										unset($_SESSION["savename"]);
							# получаваме основ.данни и масива с транзакциите 
							include('xml.inc.php');
							$arcont = getxml($savename,true);
									# създаваме елемент с името на файла 
									$arname= explode("/",$savename);
									$myname= $arname[count($arname)-1];
//print_r($arcont);
	# ОК 
	# записваме данните за извлечението 
			$artran= $arcont["tran"];
			unset($arcont["tran"]);
	$idbankpack= $DB->query("insert into bankpack set ?a, created=now(),filename=?" ,$arcont,$myname);
	# записваме данните за редовете на извлечението 
	foreach($artran as $eltran){
		$aset= array();
		foreach($eltran as $elname=>$elcont){
			$aset[$elname]= $elcont["value"];
		}
		$DB->query("insert into bank set ?a ,idbankpack=?d" ,$aset,$idbankpack);
	}
	# сканираме всички нови редове 
	# - маркираме дублираните 
	$mylist= $DB->select("select id,REFERENCE from bank where idbankpack=?d" ,$idbankpack);
	foreach($mylist as $myelem){
		$id= $myelem["id"];
		$refe= $myelem["REFERENCE"];
		$reco= $DB->selectCell("select count(id) from bank where REFERENCE=?" ,$refe);
/*
		if (0){
		}elseif ($reco==0){
			$isdubl= 9;
		}elseif ($reco==1){
			$isdubl= 0;
		}else{
			$isdubl= 1;
		}
print "<br>[$id][$refe][$reco][$isdubl]";
*/
//print "<br>[$id][$refe][$reco][$isdubl]";
		# в полето $isdubl записваме броя на повторенията минус 1 
		# за уникалните $isdubl=0 
		$isdubl= $reco -1;
		$DB->query("update bank set isdubl=?d where id=?d" ,$isdubl,$id);
	}
							#---------------------------------------------------------------

#------ submit с формални грешки 
}elseif ($mfacproc==NULL){
//	$smarty->assign("ARCHECKED", $_POST["listcash"]);
							$retucode= 1;
//	doerrors();

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


//var_dump($retucode,$ertext);
				if ($retucode==0){
# redirect 
reload("parent",$relurl);
				}else{
# извеждаме 
//$smarty->assign("LIST", $mylist);
//$pagecont= smdisp("capaedit.ajax.tpl","fetch");
//print $pagecont;
$smarty->assign("DATA", $arcont);
$smarty->assign("VARI", $mfacproc);
print smdisp($tpname,"iconv");
				}


?>
