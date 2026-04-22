<?php
# приключване на касов пакет - разнасяне на прих.ордери от избрания пакет 
# извиква се на автоматични пасове, за да се снижи натоварваето на сървъра 
/*
# отгоре : 
#    $iduser - логнатия потребител 
//#    $mode - текущия режим 
//#    $page - текущата страница от списъка 
#    $fini - cashpack.id за приключване - избрания касов пакет 
# опративна променлива 
*/
#    $pass - номера на автоматичния пас 
//print_r($GETPARAM);

# константи 
# броя на ордерите за 1 пас 
$copass= 2;

# шаблона 
$tpname= "capafinidist.ajax.tpl";
									
									session_start();
									include_once "common.php";

# вземаме масива с входните параметри 
$GETPARAM= getparam();
//print_r($GETPARAM);
# избрания касов пакет 
$fini= $GETPARAM["fini"];

# текущия пас 
//print_r($GETPARAM);
$pass= $GETPARAM["pass"];
$pass= isset($pass) ? $pass : 1;

# край на пасовете 
if ($pass==-1){
		print "
<script>
//parent.$('#closeBut').click();
$NYROREMOVE
</script>
		";
exit;
}else{
}
		
		# специфично използваме класа за странициране 
		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
		$query= "select * from cash where idcashpack=$fini";
//		$prefurl= "";
//		$baseurl= "mode=".$mode."&page=".$page."&fini=".$fini."&pass=".$pass;
/*
		$prefurl= "capafinidist.ajax.php";
		$baseurl= "fini=".$fini."&pass=".$pass;
*/
				$prefurl= "";
				$baseurl= "";
				$obpagi= new paginator($copass, 8, $query);
		$mylist= $obpagi->calculate($pass, $prefurl, $baseurl);
		$mylist= dbconv($mylist);
//print_r($mylist);

if ($pass < $obpagi->totpag){
	$nextpass= $pass+1;
	$nexturl= "".geturl("fini=".$fini."&pass=".$nextpass);
	$smarty->assign("LINKNEXT", $nexturl);
		$perc= ($pass-0.5) * $obpagi->perpage / $obpagi->totrec;
		$perc= round(100*$perc,0);
	$smarty->assign("PERC", $perc);
}else{
	$endpass= -1;
	$nexturl= "".geturl("fini=".$fini."&pass=".$endpass);
	$smarty->assign("LINKCLOS", $nexturl);
	$smarty->assign("PERC", 100);
}

//print_r($obpagi);
//print "pass=$pass";

# извеждаме 
sleep(1);
print smdisp($tpname,"iconv");


?>
