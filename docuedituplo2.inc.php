<?php

//print "uplo2.inc=";
//var_dump($editcasecode);
												#-------------------------- сканиран документ ----------------------------
												# upload на сканиран файл при добавяне документ или група документи 
												$ardocuuplo= $_SESSION["ardocuuplo"];
//var_dump($modeel);
//print_rr($ardocuuplo);
$epep_process = $GETPARAM["epep_process"];
if (isset($epep_process)){
	include_once "epep_process_file.php";
	exit;
}


												if (isset($ardocuuplo)){
													$uplo= $GETPARAM["uplo"];
/***/
													if ($uplo=="yes"){
														include_once "docuedituplo.ajax.php";
														exit;
													}else{
//$modeel= "mode=".$mode."&page=".$page;
$linkdocuuplo= geturl($modeel ."&uplo=yes");
$smarty->assign("LINKDOCUUPLO", $linkdocuuplo);
													}
/***/
														/*
														include_once "docuedituplo.ajax.php";
														exit;
														*/
												}else{
												}
/***
												# разглеждане на сканиран документ 
												$scanview= $GETPARAM["scanview"];
												if (isset($scanview)){
$scanname= $filedire.$scanview.$filesuff;
$contdocu= file_get_contents($scanname);
header("Content-type: application/pdf");
print $contdocu;
exit;
												}else{
												}
***/
												# разглеждане на сканираните документи за избран вх.документ [$scanview] 
												$scanview= $GETPARAM["scanview"];
												if (isset($scanview)){
														include_once "docueditscanview.ajax.php";
														exit;
												}else{
												}
												# upload на единичен сканиран файл за единичен документ 
												$scanuplo= $GETPARAM["scanuplo"];
												if (isset($scanuplo)){
//$modeel= "mode=".$mode."&page=".$page;
//$relurl= geturl($modeel);
$ardocuuplo= array($scanuplo);
														include_once "docuedituplo.ajax.php";
														exit;
												}else{
												}
												#------------------------------------------------------------------------------


?>