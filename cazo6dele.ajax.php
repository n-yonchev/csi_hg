<?php
# зона-6 : ИЗТРИВАНЕ на съществуващ изходящ документ по делото 
# източник : cazo6regi.ajax.php - регистрация (извеждане) 
# отгоре : 
#    $edit= case.id 
#    $zone= 6 
#    $func= view 
#  $dele= документа за изтриване 
//print_r($GETPARAM);

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

# АВТОМАТИЧЕН ИЗХОД веднага след извеждане на страницата 
$tpname= "cazo6dele.ajax.tpl";
//$smarty->assign("ASET", $aset);
//print "<center><h2>".toutf8("изтрит")."</h2></center>";
	# js код за задръжка  и изход с рефреш 
	# в основния прозорец, а не в родителския 
	# източник : getnyroexit-common.php 
	$jstime= "
<script>
var tout= setTimeout(\"myfunc()\",1000);
function myfunc (){
//clearTimeout(tout);
//parent.$('#closeBut').click();
$NYROREMOVE
parent.$('#t6link').click();
}
</script>
	";
	# redirect 
//	$smarty->assign("ASET", $aset);
	$smarty->assign("JSTIME", $jstime);
print smdisp($tpname,"iconv");


?>
