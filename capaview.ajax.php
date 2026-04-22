<?php
# разглеждане на касов пакет 
# източник : capaedit.ajax.php - корекция на касов пакет 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
//#    $edit - cashpack.id за разглеждане - избрания касов пакет 
# фундаментална променлива 
#    $view - cashpack.id за разглеждане - избрания касов пакет 
//print_r($GETPARAM);

# шаблона 
$tpname= "capaview.ajax.tpl";
//# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page);


					# заявката $query 
					# - включва само прих.ордери, които са избрани за този пакет 
					include "cash.inc.php";
//					$query= getcashquery("cash.idcashpack=$edit or cash.idcashpack=0");
## глобален филтър 
$cashfilt= "cash.idcashpack=$view";
					$query= getcashquery($cashfilt);
# списъка 
$mylist= $DB->select($query);
$mylist= dbconv($mylist);


# извеждаме 
//$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
print smdisp($tpname,"iconv");


?>