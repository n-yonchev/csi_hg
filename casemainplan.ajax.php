<?php
									session_start();
									include_once "common.php";

/******
$edit= $_GET["para"];
//print $edit;
						
$mainplan= $_SESSION["mainplan"][$edit];
			# 04.10.2010
			if (isset($mainplan)){
			}else{
				$mainplan= "var1";
			}
if ($mainplan == "var1"){
	$newplan= "var2";
}else{
	$newplan= "var1";
}
******/

# 04.10.2010
$edit= $_GET["para"];
$plan= $_GET["plan"];
if ($plan == "var1"){
	$newplan= "var2";
}else{
	$newplan= "var1";
}

$_SESSION["mainplan"][$edit]= $newplan;
print "$edit/$newplan";
//print_r($_SERVER);

//$relurl= $_SERVER["HTTP_REFERER"];
//header("Location: $relurl");
/*
		print "
<script>
document.location.reload();
</script>
		";
*/

?>
