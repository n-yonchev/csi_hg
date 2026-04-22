<?php

define("OKPASSWORD","softeehous");

//									include_once "common.php";
$relurl= "ipcont.php";
$mfacproc= $mfac->process();
//var_dump($mfacproc);
if (0){
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
}elseif ($mfacproc=="submit"){
							$retucode= 0;
}elseif ($mfacproc=="UNKNOWN"){
							$retucode= 2;
}else{
print "<br>error=mfacproc=";
var_dump($mfacproc);
die();
}

if ($retucode==0 or $retucode==2){
	if ($_POST["code"]==OKPASSWORD){
		$_SESSION["islogged"]= 1;
	}else{
# mail ...............................
exit;
	}
	reload("",$relurl);
}else{
	print smdisp("iplogin.tpl","iconv");
}

?>
