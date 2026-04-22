<?php
# login time - forbidden ip 
# included by login.ajax.php 

//define("SMARTY_DIR","../smarty/");
//define("DKLAB_PREFIX","../");
								
//								include "common.php";

$arpara= getipparams();
//					$header= "From: admin@csi.com\r\n";
					$from= $arpara["from"];
					$header= "From: $from\r\n";
	
$mes1= $arpara["mes2"];
$mes1 .= " ip=".$_SERVER["REMOTE_ADDR"];

	mail (
		$to= $arpara["mail"]
		, $subject= $mes1
		, $mailtext= $mes1
					, $header
		)
	or die("mymail");

//putiplog(1,0);
putiplog(2,$idus);

print "specific error 2";

?>
