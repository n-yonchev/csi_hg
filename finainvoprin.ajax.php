<?php
# отпечатване на фактура от глобалния списък 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $year - текуща година 
#    $page - текуща страница 
# параметри : 
#    $prin - фактурата invoice.id 
//print_r($GETPARAM);

$invobillprin= $prin;
include_once "cazobillinvoprin.ajax.php";

?>