<?php
# вика се чрез jQuery.ajax от tran2.tpl 

									session_start();
									include_once "common.php";

							include_once "tran.inc.php";

//print_rr($_GET);
$lipa= $_GET["p"];

if (empty($lipa)){
									unset($_SESSION["cboxlist"]);
}else{
	$arlipa= explode("/",$lipa);
	array_pop($arlipa);
			$arresu= array();
	foreach($arlipa as $elem){
			$arresu[]= fromcbcode(substr($elem,2));
	}
	$stlipa= implode(",",$arresu);
//var_dump($stlipa);
									$_SESSION["cboxlist"]= $stlipa;
}

/*
# имитация на getpar() 
$s1= substr($succ,1);
		$resupara= array();
		parse_str(mycrypt("get",$s1) ,$resupara);
print_rr($resupara);
*/

//$GETPARAM= getparam();
//print_rr($GETPARAM);
//var_dump($para);
//print "ok^$succ";

print "ok";

?>