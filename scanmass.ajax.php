<?php
# списък масово сканирани документи на текущия юзер
# отгоре : 
//#     $mode - текущ режим от глав.меню 
//#     $page - текуща страница от спис.вход.документи 
#     $modebase - базови параметри за URL 
//#     $scanmasslink - линк за рефреш на този списък 
//print_rr($GETPARAM);

									include_once "scan.inc.php";

												# разглеждане на сканиран образ за избран вх.документ [$scanv2] 
												$scanv2= $GETPARAM["scanv2"];
												if (isset($scanv2)){
														//include_once "docueditscanv2.ajax.php";
ini_set("memory_limit","128M");
$scanname= $scanpath_inp .$scanv2."." .$scansuff;
$scancont= file_get_contents($scanname);
header("Content-type: $scansuff");
print $scancont;
														exit;
												}else{
												}

									# приемане 
									$ok= $GETPARAM["ok"];
									if (isset($ok)){
												$DB->query("lock tables scanlist write, docuscan write");
										$arid= explode(",",$ok);
										foreach($arid as $okid){
$newid= $DB->query("insert into docuscan set time=now()");
					$ider= 0;
$roscan= getrow("scanlist",$okid);
$iddocu= $roscan["iddocu"];
$fullname_inp= $scanpath_inp .$iddocu ."." .$scansuff;
//var_dump($fullname_inp);
if (file_exists($fullname_inp)){
	$ficont= file_get_contents($fullname_inp);
	if ($ficont===false){
					$ider= 2;
	}else{
		$fullname_out= $scanpath_out .$newid ."." .$scansuff;
		$bytes= file_put_contents($fullname_out,$ficont);
		if ($bytes===false){
					$ider= 3;
		}else{
//chown($fullname_inp, 666);
			$resudele= @unlink($fullname_inp);
			if ($resudele===false){
					$ider= 4;
			}else{
				# готово 
			}
		}
	}
}else{
					$ider= 1;
}
					if ($ider==0){
						$aset= array();
						$aset["iddocu"]= $iddocu;
						$aset["suffix"]= $scansuff;
						$aset["iduser"]= $_SESSION["iduser"];
						$aset["ismass"]= 1;
//$DB->query("insert into docuscan set ?a, time=now()"  ,$aset);
$DB->query("update docuscan set ?a where id=?d"  ,$aset,$newid);
$DB->query("delete from scanlist where id=?d"  ,$okid);
					}else{
$DB->query("delete from docuscan where id=?d"  ,$newid);
						$DB->query("update scanlist set ider=$ider where id=?d"  ,$okid);
					}
										# foreach($arid as $okid){
										}
												$DB->query("unlock tables");
									}else{
									}
									
									# отхвърляне
									$cancel= $GETPARAM["cancel"];
									if (isset($cancel)){
										$arid= explode(",",$cancel);
										foreach($arid as $cancelid){
$DB->query("delete from scanlist where id=?d"  ,$cancelid);
										}
									}else{
									}

# извеждане 
$arscan= getscanlist($_SESSION["iduser"]);
									$aridscan= array();
foreach($arscan as $indx=>$elem){
	$idscan= $elem["idscan"];
	$arscan[$indx]["ok"]= geturl($modebase."&ok=".$idscan);
	$arscan[$indx]["cancel"]= geturl($modebase."&cancel=".$idscan);
				$iddocu= $elem["iddocu"];
				$caselist= getcaselist($iddocu);
	$arscan[$indx]["caselist"]= $caselist;
	$arscan[$indx]["casecoun"]= count($caselist);
									$aridscan[]= $idscan;
	$arscan[$indx]["scanv2"]= geturl($modebase."&scanv2=".$iddocu);
}
//print_ru($arscan);
									$listscan= implode(",",$aridscan);
									$okall= geturl($modebase."&ok=".$listscan);
									$cancelall= geturl($modebase."&cancel=".$listscan);
$smarty->assign("OKALL", $okall);
$smarty->assign("CANCELALL", $cancelall);
							//$codein= implode(",",$arin);
							//$arscancoun= getscancoun("iddocu in ($codein)");
//print_rr($arscancoun);
//$smarty->assign("ARSCANCOUN", $arscancoun);

$smarty->assign("LIST", $arscan);
print smdisp("scanmass.ajax.tpl","iconv");


?>