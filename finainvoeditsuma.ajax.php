<?php
# вика се чрез jQuery.ajax от finainvoedit.ajax.tpl 

									session_start();
									include_once "common.php";

						//# всичко за фактурата 
						//include_once "invo.inc.php";

$para= $_GET["p"];
//var_dump($para);
list($vatval,$st1,$st2)= explode("^",$para);
$vatcoe= ($vatval==1) ? 1.20 : 1;
$ar1= explode(",",$st1);
$ar2= explode(",",$st2);
				$suma= 0;
foreach($ar1 as $indx=>$elem){
	$c1= $elem +0;
	$c2= $ar2[$indx] +0;
				$suma += $c1 * $c2;
}
$suma= $vatcoe * $suma;
$suma= round($suma,2);
$sumaform= number_format($suma,2  ,".",",");
print "ok^$sumaform^$suma";

/*
$arsuma= getsumainvo("invoelem.idbill=$idinvo");
	$suma= $arsuma[$idinvo]["suma"];
$suma= ($suma+0==0) ? "" : number_format($suma,2  ,".",",");
	$svat= $arsuma[$idinvo]["svat"];
$svat= ($svat+0==0) ? "" : number_format($svat,2  ,".",",");
	$coun= $arsuma[$idinvo]["coun"];
$coun= ($coun+0==0) ? "" : $coun;

print "$idinvo^$suma^$svat^$coun";
*/

?>