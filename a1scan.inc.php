<?php

									# nyroModal прозорец за начало 
									$a1scan= $GETPARAM["a1scan"];
									if (isset($a1scan)){
										//include_once "bpdeliclear.ajax.php";
$idus4= $_SESSION["iduser"];
$a1name= $idus4.".txt";
file_put_contents($a1name,$a1scan);
//$smarty->assign("LINKFINI", $filist);
		$rodout= getrow("docuout",$a1scan);
		$smarty->assign("RODOUT", $rodout);
print smdisp("a1scan.ajax.tpl","iconv");
											exit;
//return;
									}else{
									}

					# приключване на прозореца - ajax 
					$a1= $_GET["a1"];
					if (isset($a1)){
									session_start();
									include_once "common.php";
$idus4= $_SESSION["iduser"];
$a1name= $idus4.".txt";
unlink($a1name);
print "ok";
					}else{
					}

					# проверка за наличие на файла - ajax 
					$c1= $_GET["c1"];
					if (isset($c1)){
									session_start();
									include_once "common.php";
$idus4= $_SESSION["iduser"];
$a1name= $idus4.".txt";
	if (file_exists($a1name)){
print "ok^1";
	}else{
print "ok^0";
	}
					}else{
					}

?>