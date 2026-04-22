<?php
									
										$htflag= false;
					$dele= $GETPARAM["dele"];
					if (isset($dele)){
	$DB->query("delete from iplist where id=?" ,$dele);
										$htflag= true;
					}else{
					}

$mfacproc= $mfac->process();

if (0){

}elseif ($mfacproc=="INIT"){
							$retucode= -1;

}elseif ($mfacproc=="submit"){
							$retucode= 0;
	$ipaddr= $_POST["ipaddr"];
	if (empty($ipaddr)){
	}else{
		$DB->query("insert into iplist set ipaddr=?" ,$ipaddr);
	}
	$_POST["ipaddr"]= "";
										$htflag= true;

}elseif ($mfacproc==NULL){
							$retucode= 1;

}elseif ($mfacproc=="UNKNOWN"){
							$retucode= 2;

}else{
print "<br>error=mfacproc=";
var_dump($mfacproc);
die();
}

$mylist= $DB->select("select * from iplist order by ipaddr");
$modeel= "mode=".$mode;
						$htlist= array();
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
	$mylist[$uskey]["dele"]= geturl($modeel."&dele=".$idcurr);
						$htlist[]= $uscont["ipaddr"];
}

$smarty->assign("DATA", $mylist);
$pagecont= smdisp("iplist.tpl","iconv");

										if ($htflag){
						htupda($htlist);
										}else{
										}



function htupda($htlist){
$fnam= ".htaccess";
$mark= "Allow from ";
				# 13.10.2011 
				if (file_exists($fnam)){
	$arco= file($fnam);
	foreach($arco as $arin=>$arel){
		if (substr($arel,0,strlen($mark))==$mark){
			$arco[$arin]= $mark .implode(" ",$htlist) ."\n";
		}else{
		}
	}
	$f1= fopen($fnam,"w");
	flock($f1,LOCK_EX);
			fwrite($f1, implode("",$arco));
	flock($f1,LOCK_UN);
	fclose($f1);
				}else{
				}
}


?>
