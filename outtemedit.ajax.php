<?php
# корекция на основните данни за изх.шаблон 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $edit - id за корекция 
# $FLAGCLON - дали е клониране или само редактиране 
#    $relurl - линк след събмит 
//print "correction [$mode][$edit][$page]";

# таблицата 
$taname= "docutype";
# шаблона 
$tpname= "outtemedit.ajax.tpl";
# полетата 
$filist= array(
	"text"=>  array("validator"=>"notempty", "error"=>"описанието е задължително")
	,"adresat"=> NULL
//	,"filename"=> array("validator"=>"notempty", "error"=>"името на файла е задължително")
);

# константни полета 
//$ficonst= array("iduser"=>$iduser);
$ficonst= array();
# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page);
//$relurl= geturl("mode=".$mode);

# име на полето с файла за upload 
$uploname= "file";
# вътр.папка за съхраняване на файловете 
//$filedire= "outgoing/";
$filedire= $preftemp;
# записа 
$rodoty= getrow($taname,$edit);

						if ($FLAGCLON){
$filist["filename"]= array("validator"=>"notempty", "error"=>"името на файла е задължително");
						}else{
						}
										# 23.06.2010 - флаг - при изходяване на документ 
										# автоматично да се добавя таксата като предмет на изпълнение
										$rooffi= getofficerow(0);
										$regita= $rooffi["isregitax"];
										$isregitax= ($regita<>0);
						if ($isregitax){
$filist["regitext"]= array("validator"=>"notempty", "error"=>"текста е задължителен");
$filist["regitax"]=  array("validator"=>"amount", "error"=>"грешна такса");
$filist["regitax_1"]=  null;
$filist["regitax_2"]=  null;
$filist["regitax_3"]=  null;
$filist["regitax_4"]=  null;

						}else{
						}
											# 18.08.2014 - връчване 
											if ($ISPOST){
$filist["postadresat"]= NULL;
$filist["postaddress"]= NULL;
$filist["idposttype"]= NULL;
									include_once "deli.inc.php";
									$smarty->assign("ARTYPENAME", "listtypepost_utf8_2");
											}else{
											}
											
									# разглеждане шаблона 
									$viewtemp= $GETPARAM["viewtemp"];
									if (isset($viewtemp)){
											$filename= $rodoty["filename"];
											$realname= $filedire.$filename;
										$filecont= file_get_contents($realname);
											$arname= explode(".",$realname);
										$suffix= $arname[count($arname)-1];
										if (0){
										}elseif($suffix=="html"){
//print $filecont;
print '
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
'  .$filecont;
										}elseif($suffix=="xml"){
header("Content-Disposition: attachment; filename=$filename");
print $filecont;
										}else{
print "<h3>$suffix</h3> invalid file type";
										}
return;
									}else{
									}
														
/*
# константни полета 
//$ficonst= array("iduser"=>$iduser);
$ficonst= array();
# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page);
$relurl= geturl("mode=".$mode);

# име на полето с файла за upload 
$uploname= "file";
# вътр.папка за съхраняване на файловете 
$filedire= "outgoing/";
*/

#----------------- директно редактиране -----------------------

									# класа за редактиране 
									# само заради функцията doerrors 
									include_once "edit.class.php";
									
				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
//var_dump($mfacproc);
//print_rr($_POST);

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
		$rocont= $DB->selectRow("select * from $taname where id=?" ,$edit);
		foreach($filist as $finame=>$ficont){
				$_POST[$finame]= $rocont[$finame];
		}
	$smarty->assign("TEMPTEXT", to1251($rocont["text"]));
//	$_POST["mark"]= $rocont["mark"];
	$_POST["isinvi"]= ($rocont["mark"]=="pdi") ? 1 : 0;

# изкуствено - за ново зареждане 
}elseif ($mfacproc=="s2"){
							$retucode= -10;

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
											# проверяваме за допълнителни грешки 
											$lister= array();
			# дали описанието е уникален текст 
			$text= $_POST["text"];
						if ($FLAGCLON){
			$coun= $DB->selectCell("select count(*) from $taname where text=?s" ,$text);
						}else{
			$coun= $DB->selectCell("select count(*) from $taname where text=?s and id<>?d" ,$text,$edit);
						}
			if ($coun==0){
			}else{
											$lister["text"]= "това описание не е уникално";
			}
			# дали файловото име е уникално 
						if ($FLAGCLON){
			$filename= $_POST["filename"];
			$coun= $DB->selectCell("select count(*) from $taname where filename=?s" ,$filename);
			if ($coun==0){
			}else{
											$lister["filename"]= "това име не е уникално";
			}
						}else{
						}
	if ($edit==0){
		# uploaded file - името е "file" 
										# проверяваме за грешки от трансфера 
										include "commuplo.php";
										# връща стринг с грешка или празен, ако няма грешка 
										$ertext= checkupload($uploname);
		if ($ertext==""){
			# няма грешки 
							# съхраняваме файла 
							$filename= $_FILES[$uploname]["name"];
								//$filename= to1251($filename);
							$savename= $filedire .to1251($filename);
							$tempname= $_FILES[$uploname]["tmp_name"];
							copy($tempname,$savename);
		}else{
			# има грешки 
							$retucode= 1;
											$lister[""]= "error";
$smarty->assign("ERTEXT", $ertext);
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
		$aset= $ficonst;
		foreach($filist as $finame=>$ficont){
				$aset[$finame]= $_POST[$finame];
		}
							#---- полета с автоматично съдържание 
		$aset["mark"]= isset($_POST["isinvi"]) ? "pdi" : "";
						if ($FLAGCLON){
		# създаваме клонинг 
		#--- копираме съдържанието на html файла 
		$rocont= $DB->selectRow("select * from $taname where id=?" ,$edit);
//		$nam1= "outgoing/" .$rocont["filename"];
//		$nam2= "outgoing/" .$filename;
		$nam1= $filedire .$rocont["filename"];
		$nam2= $filedire .$filename;
//			$nam1= '"'.$nam1.'"';
//			$nam2= '"'.$nam2.'"';
			$nam1= to1251($nam1);
			$nam2= to1251($nam2);
//print "[$nam1][$nam2]";
		copy($nam1,$nam2);
		#--- създаваме и нов запис за клонинга 
//		$edit= $DB->query("insert into $taname set ?a, created=now()" ,$aset);
//		$edit= $DB->query("insert into $taname set ?a, created=now(), mark=?s" ,$aset,$_POST["mark"]);
		$edit= $DB->query("insert into $taname set ?a, created=now()" ,$aset);
						}else{
							if ($edit==0){
		# добавяне на нов запис 
		$aset["filename"]= $filename;
		$edit= $DB->query("insert into $taname set ?a, created=now()" ,$aset);
							}else{
		# корекция на записа 
		$DB->query("update $taname set ?a where id=?d" ,$aset,$edit);
							}
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
						# тагове 
//						$rodoty= getrow($taname,$edit);
					$smarty->assign("FILENAME", $rodoty["filename"]);
					/***
						$resutags= gettags($rodoty["filename"]);
					$smarty->assign("ARTAGS", $resutags);
					***/
#----------------------------------------
			# тагове 
			$resutags= gettags($rodoty["filename"]);
						# зареждаме флага ismult 
						if (empty($resutags)){
							$ismult= 0;
						}else{
							$ismult= 1;
						}
						$DB->query("update docutype set ismult=?d where id=?d"  ,$ismult,$edit);
				# зареждаме флага isbank 
				if (!empty($resutags) and in_array("DB_BANKLIST_CB",$resutags)){
					$isbank= 1;
				}else{
					$isbank= 0;
				}
				$DB->query("update docutype set isbank=?d where id=?d"  ,$isbank,$edit);
#----------------------------------------
						$mode2= "mode=".$mode."&edit=".$edit;
					$smarty->assign("VIEWTEMP", geturl($mode2."&viewtemp=".$edit));
			# помощен списък параметри на връчване 
			$arhelp= $DB->select("
				select * from docutype_deli
				where adresat<>'' or idposttype<>0 or postadresat<>'' or postaddress<>''
				order by text
				");
			$arhelp= dbconv($arhelp);
			$arhelp= arstrip($arhelp);
			foreach($arhelp as $indx=>$elem){
				$arhelp[$indx]["adresat"]= trancont($elem["adresat"]);
				$arhelp[$indx]["postadresat"]= trancont($elem["postadresat"]);
				$arhelp[$indx]["postaddress"]= trancont($elem["postaddress"]);
				$arhelp[$indx]["code"]= $elem["adresat"]."^".$elem["idposttype"]."^".$elem["postadresat"]."^".$elem["postaddress"];
			}
			$smarty->assign("ARHELP", $arhelp);
	# извеждаме формата 
	$smarty->assign("FLAGCLON", $FLAGCLON);
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}

function trancont($p1){
return str_replace(array("(-","-)"),array("",""),$p1);
}

?>