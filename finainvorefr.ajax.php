<?php
# вика се чрез jQuery.ajax от finainvo.tpl 

									session_start();
									include_once "common.php";

						# всичко за фактурата 
						include_once "invo.inc.php";

$idinvo= $_GET["p"];

$arsuma= getsumainvo("invoelem.idbill=$idinvo");
	$suma= $arsuma[$idinvo]["suma"];
$suma= ($suma+0==0) ? "" : number_format($suma,2  ,".",",");
	$svat= $arsuma[$idinvo]["svat"];
$svat= ($svat+0==0) ? "" : number_format($svat,2  ,".",",");
	$coun= $arsuma[$idinvo]["coun"];
$coun= ($coun+0==0) ? "" : $coun;

print "$idinvo^$suma^$svat^$coun";

?>