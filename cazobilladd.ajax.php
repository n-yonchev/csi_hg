<?php

									session_start();
									include_once "common.php";

# вход 
$code= $_GET["code"];
if ($code==""){
		print "";
exit;
}else{
}
print "
<div style='border: 1px solid black; padding: 10px;'>
";

//$pagecont= "<h1>$code</h1>";
//print $pagecont;
# дефиниции на сметките 
//list($argrou,$ardefi)= getbill();
//$argrou= $_SESSION["billgrou"];
$ardefi= $_SESSION["billdefi"];
$defi= $ardefi[$code];
//print_rr($defi);

$smarty->assign("ARDEFI", $defi);

# от $_POST или не 
$post= $_GET["post"];
					if ($post=="yes"){
$smarty->assign("LISTER", $_SESSION["LISTER"]);
unset($_SESSION["LISTER"]);
foreach($_SESSION["POSTDA"] as $dain=>$daco){
	$_POST[$dain]= $daco;
}
unset($_SESSION["POSTDA"]);
//print "ADDPOST=";
//print_rr($_POST);
					}else{
		$_POST["action"]= $defi["txdesc"];
		$_POST["ground"]= $defi["txgrou"];
				if ($defi["calc"]=="fixi"){
		$_POST["amount"]= $defi["perc"];
				}else{
				}
					}

$pagecont= smdisp("cazobilladd.ajax.tpl","iconv");
print $pagecont;
		
print "
</div>
";

?>