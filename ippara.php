<?php
									
									include_once "edit.class.php";
$filist= array(
	"mail"=>  array("validator"=>"email", "error"=>"invalid")
	,"mes1"=>  array("validator"=>"notempty", "error"=>"empty")
	,"mes2"=>  array("validator"=>"notempty", "error"=>"empty")
	,"from"=>  array("validator"=>"email", "error"=>"invalid")
);
//$relurl= "index.php";

//				if (isset($mfacproc)){
//				}else{
$mfacproc= $mfac->process();
//				}
//print "MFACPROC=[$mfacproc]";

if (0){

}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	$_POST= getipparams();

}elseif ($mfacproc=="submit"){
							$retucode= 0;
	putipparams($_POST);

}elseif ($mfacproc==NULL){
							$retucode= 1;
	doerrors();

}elseif ($mfacproc=="UNKNOWN"){
							$retucode= 2;

}else{
print "<br>error=mfacproc=";
var_dump($mfacproc);
die();
}

if ($retucode==0){
	$pagecont= "data submitted";
}else{
	$smarty->assign("FILIST", $filist);
	$pagecont= smdisp("ippara.tpl","iconv");
}


?>
