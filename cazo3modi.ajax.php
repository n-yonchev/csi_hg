<?php
# отгоре : 
#    $iduser - логнатия потребител 
#    $edit= case.id за модифициране 
#    $zone= 3 
#    $func= modi 

# входни параметри 
# $idel - id на взискателя/длъжника 
$idel= $GETPARAM["idel"];
//print "correction [$edit][$zone][$func]idel=[$idel]";

# таблицата 
$taname= "claimer";
# шаблона 
$tpname= "cazo34modi.ajax.tpl";
# текст за типа участник 
$typetext= "ВЗИСКАТЕЛ";
# линк за redirect 
//$redilink= array("t3link","t2link");
$redilink= array("t3link","t2link","tadvalink");
# флаг дали е взискател 
$isclaimer= true;

							# общо за взискатели/длъжници 
							include_once "cazo34modi.inc.php";


?>