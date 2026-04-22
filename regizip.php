<?php

$regidire= "register/";
$zipName= $regidire."register.zip";

							include_once($regidire."CreateZip.class.php");
$createZipFile=new CreateZipFile;
//$createZipFile->addDirectory($regidire);

$fnam= "cases.csv";
$cont= file_get_contents($regidire.$fnam);
$createZipFile->addFile($cont, $fnam);
unset($cont);

$fnam= "persons.csv";
$cont= file_get_contents($regidire.$fnam);
$createZipFile->addFile($cont, $fnam);
unset($cont);

$fnam= "origins.csv";
$cont= file_get_contents($regidire.$fnam);
$createZipFile->addFile($cont, $fnam);
unset($cont);

$fd= fopen($zipName, "wb");
$out= fwrite($fd,$createZipFile->getZippedfile());
fclose($fd);

//$createZipFile->forceDownload($zipName);
$filename= basename($zipName);
//	header("Content-type: application/vnd.ms-word");
header('Content-Type: application/octet-stream');
	header("Content-Disposition: attachment; filename=$filename" );
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
	header("Pragma: public");
//print file_get_contents($zipName);
readfile("$zipName");

?>