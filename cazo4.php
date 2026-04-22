<?php
# зона-4 : длъжници по делото 
# отгоре : 
#    $edit= case.id 
#    $zone= 3 
#    $func= view, modi 
# елемент за настройка 
#    $idel - id на взискателя/длъжника 


# таблицата 
$taname= "debtor";
# шаблона 
$tpname= "cazo34view.tpl";
# текст за типа участник 
$listtext= "длъжници";
$listtext2= "длъжник";

# за include при корекция 
$modiname= "cazo4modi.ajax.php";
# съобщение при авариен край 
$diemess= "cazo4";

							# общо за взискатели/длъжници 
							include_once "cazo34.inc.php";


?>