<?php


# име на полето с файла за upload 
$uploname= "file";
# вътр.папка за съхраняване на файловете 
$filedire= "incoming/";
//# суфикс на сканираните файлове 
//$filesuff= ".pdf";

# таблицата 
$tascan= "docuscan";
# базова таблица 
$tabasescan= "docu";
# зона за рефреш 
$zoscan= "t5link";
							if ($isdocuout){
$filedire= "outscan/";
$tascan= "docuoutscan";
$tabasescan= "docuout";
$zoscan= "t6link";
							}else{
							}
$smarty->assign("ZOSCAN", $zoscan);

# MIME типове 
$armime["pdf"]= "application/pdf";
$armime["gif"]= "image/gif";
$armime["png"]= "image/png";
$armime["jpg"]= "image/jpg";
$armime["doc"]= "application/msword";
$armime["xls"]= "application/vnd.ms-excel";

# обработка на сканиран upload-нат файл 
function docuuploaction($ardocuuplo){
global $uploname, $filedire;
global $DB;
	$tempname= $_FILES[$uploname]["tmp_name"];
	$origname= $_FILES[$uploname]["name"];
		$arname= explode(".",$origname);
	$suffix= $arname[count($arname)-1];
				foreach ($ardocuuplo as $elem){
					# запис в референтната таблица 
					$aset= array();
					$aset["iddocu"]= $elem;
					$aset["suffix"]= $suffix;
					$aset["iduser"]= $_SESSION["iduser"];
global $tascan;
//					$iddocuscan= $DB->query("insert into docuscan set ?a, time=now()"  ,$aset);
					$iddocuscan= $DB->query("insert into $tascan set ?a, time=now()"  ,$aset);
					# съхраняваме новия файл 
	$savename= $filedire.$iddocuscan.".".$suffix;
					$resucopy= copy($tempname,$savename);
	if ($resucopy===false){
	die("docuedituplo=1=[$tempname][$savename]");
	}else{
	}
				}
}

function getscancoun($codewhe){
global $DB;
						$codewhe= str_replace("in ()","in (0)",$codewhe);
global $tascan;
		$arscancoun= $DB->selectCol("
			select iddocu as ARRAY_KEY, count(*) 
			from $tascan
			where $codewhe
			group by iddocu
			");
//			from docuscan 
return $arscancoun;
}


?>