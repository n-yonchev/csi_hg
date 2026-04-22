<?php
# разглеждане на серия сканирани образи за избран вх.документ 
# извежда се в отделен прозорец window.open в нормално обкръжение 
# отгоре : 
#    $modeel - за базов линк 
#    $scanview= docu.id 
//print_rr($GETPARAM);

									//session_start();
									include_once "common.php";

									# изтриване на изображение 
									$idscandele= $GETPARAM["idscandele"];
									if (isset($idscandele)){
//$DB->query("delete from docuscan where id=?d"  ,$idscandele);
$DB->query("delete from $tascan where id=?d"  ,$idscandele);
$smarty->assign("ISRELO", true);
									}else{
									}
									
# заглавни данни 
												if (!$isdocuout){
$ardata= $DB->select("
	select docu.serial as docuseri, docu.year as docuyear
		, suit.serial as caseseri, suit.year as caseyear
		, user.name as username
	from docusuit
	left join docu on docusuit.iddocu= docu.id
	left join suit on docusuit.idcase= suit.id
	left join user on suit.iduser=user.id
	where docusuit.iddocu=?d
	"  ,$scanview);
//	where docusuit.iddocu=?d and docusuit.idcase=?d
//	"  ,$scanview,$edit);
$smarty->assign("COUNCASE", count($ardata));
					if (count($ardata)==0){
	$rodata= $DB->selectRow("
		select docu.serial as docuseri, docu.year as docuyear from docu where id=?d
		"  ,$scanview);
					}else{
	$rodata= $ardata[0];
	$rodata= dbconv($rodata);
					}
												}else{
					$rodata= $DB->selectRow("
						select docuout.serial as docuseri, docuout.year as docuyear 
							, suit.serial as caseseri, suit.year as caseyear
							, user.name as username
						from docuout 
							left join suit on docuout.idcase=suit.id
							left join user on suit.iduser=user.id
						where docuout.id=?d
						"  ,$scanview);
					$rodata= dbconv($rodata);
$smarty->assign("COUNCASE", 1);
												}
$smarty->assign("RODATA", $rodata);
	
//$arscancoun= getscancoun("iddocu=$scanview");
# списък изображения 
/*
$arscan= $DB->select("
	select docuscan.*, docuscan.id as id ,user.name as username
	from docuscan 
		left join user on docuscan.iduser=user.id
	where iddocu=?d 
	order by docuscan.id
	"  ,$scanview);
*/
$arscan= $DB->select("
	select $tascan.*, $tascan.id as id ,user.name as username
	from $tascan 
		left join user on $tascan.iduser=user.id
	where iddocu=?d 
	order by $tascan.id
	"  ,$scanview);
$coun= count($arscan);
$arscan= dbconv($arscan);
# текущо изображение 
$cuindx= $GETPARAM["cuindx"];
if (isset($cuindx)){
}else{
	$cuindx= 0;
}

# за изтриване на текущото - чрез параметър docuscan.id 
$idscan= $arscan[$cuindx]["id"];
$linkdele= geturl($modeel."&scanview=".$scanview."&idscandele=".$idscan);
$smarty->assign("LINKDELE", $linkdele);
# списъка 
foreach($arscan as $indx=>$elem){
	$arscan[$indx]["link"]= geturl($modeel."&scanview=".$scanview."&cuindx=".$indx);
}

# МИМЕ тип на файла 
$suffix= $arscan[$cuindx]["suffix"];
//var_dump($suff);
$suffmime= $armime[$suffix];
		if (isset($suffmime)){
		}else{
$smarty->assign("NOVIEWTYPE", $suffix);
		}
# извеждане 
$smarty->assign("IDDOCU", $scanview);
$smarty->assign("CUINDX", $cuindx);
$smarty->assign("ARSCAN", $arscan);
print smdisp("docueditscanview.tpl","iconv");

?>