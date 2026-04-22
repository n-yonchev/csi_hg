<?php
# към регистъра - всички дела на логнатия юзер - предаване 
# отгоре : 
#     $mode - режима 
#     $codesub= tose 
# още отгоре : 
#     $uniq - префикс за файловите имена 
//print_rr($_GET);
//var_dump($uniq);
//	$leuniq= strlen($uniq);

# изтриваме старите файлове 
//$path= "register";
//direunlink("register",$uniq,".zip");
//direunlink("regicert",$uniq,".zip");
direunlink("register",$uniq);
direunlink("regicert",$uniq);

//$smarty->assign("ARCALL",$arcall);
$subcont= smdisp("regiustose.tpl","fetch");



function direunlink($path,$uniq,$suff=""){
	$leuniq= strlen($uniq);
	$dire= dir($path);
	while (false !== ($caname= $dire->read())){
		$funame= $path ."/" .$caname;
		if (is_dir($funame)){
		}else{
							if (empty($suff)){
								$flunli= true;
							}else{
								$flunli= substr($caname,-strlen($suff))==$suff;
							}
//			if (substr($caname,0,$leuniq)==$uniq and substr($caname,-strlen($suff))==$suff){
			if (substr($caname,0,$leuniq)==$uniq and $flunli){
//						$cuindx= substr($caname,$lepref);
//						$cuindx= substr($cuindx,0,strlen($caname)-4);
//						$arzipp[$cuindx]= substr($caname,$lepref);
						unlink($funame);
			}else{
			}
		}
	}
$dire->close();
}

?>