<?php
# отгоре : 
#    $iduser - логнатия потребител 
#    $edit= case.id за модифициране 
#    $zone= 4 
#    $func= modi 

# входни параметри 
# $idel - id на взискателя/длъжника 
$idel= $GETPARAM["idel"];
//print "correction [$edit][$zone][$func]idel=[$idel]";

# таблицата 
$taname= "debtor";
# шаблона 
$tpname= "cazo34modi.ajax.tpl";
# текст за типа участник 
$typetext= "ДЛЪЖНИК";
# линк за redirect 
$redilink= array("t4link","t2link");
# флаг дали е взискател 
$isclaimer= false;

							# общо за взискатели/длъжници 
							include_once "cazo34modi.inc.php";


?>