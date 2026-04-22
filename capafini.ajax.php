<?php
# приключване на касов пакет - СПЕЦИФИЧЕН ПОДХОД 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $fini - cashpack.id за приключване - избрания касов пакет 
//print_r($GETPARAM);

# шаблона 
$tpname= "capafini.ajax.tpl";
# reload - след успешен събмит 
$relurl= geturl("mode=".$mode);

# данните за пакета 
$ropack= getrow("cashpack",$fini);
$smarty->assign("DATA", $ropack);

# евент.приключване 
if (isset($_POST["submit"])){
	$aset= array();
	$aset["idstatus"]= 1;
//	$DB->query("update cashpack set ?a, finished=now() where id=?d" ,$aset,$fini);
							# разнасяне на прих.ордери от избрания пакет 
							//include_once "capafinidist.ajax.php";
							//exit;
							reload("","capafinidist.ajax.php".geturl("fini=".$fini));
//# redirect 
//reload("parent",$relurl);
}else{
}


# извеждаме 
print smdisp($tpname,"iconv");


?>
