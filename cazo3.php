<?php
# зона-3 : взискатели по делото 
# отгоре : 
#    $edit= case.id 
#    $zone= 3 
#    $func= view, modi 
# елемент за настройка 
#    $idel - id на взискателя/длъжника 


# таблицата 
$taname= "claimer";
# шаблона 
$tpname= "cazo34view.tpl";
# текст за типа участник 
$listtext= "взискатели";
$listtext2= "взискател";

# за include при корекция 
$modiname= "cazo3modi.ajax.php";
# съобщение при авариен край 
$diemess= "cazo3";

							# общо за взискатели/длъжници 
							include_once "cazo34.inc.php";


?>