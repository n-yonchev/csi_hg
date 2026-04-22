<?php
									session_start();
									include_once "common.php";

# 2 GET params 
//print_rr($_POST);
$page= $_POST["page"];
$href= $_POST["href"];
	list($ref1,$ref2)= explode("?",$href);
//print "\n$ref1 \n$ref2";

# ==getparam() 
$aget= rawurldecode($ref2);
	$resupara= array();
	parse_str(mycrypt("get",$aget) ,$resupara);
//print_rr($resupara);

# return URL 
				$arpara= array();
foreach($resupara as $code=>$cont){
				$arpara[]= "$code=$cont";
}
				$arpara[]= "page=$page";
$stpara= implode("&",$arpara);
//var_dump($stpara);
$retu= geturl($stpara);
print $retu;

?>