<?php
# .htaccess time - forbidden ip 
# included by error/iperror1.php 

define("SMARTY_DIR","../smarty/");
define("DKLAB_PREFIX","../");
								
								include "common.php";

$arpara= getipparams();
//					$header= "From: admin@csi.com\r\n";
					$from= $arpara["from"];
					$header= "From: $from\r\n";
	
$mes1= $arpara["mes1"];
$mes1 .= " ip=".$_SERVER["REMOTE_ADDR"];

	mail (
		$to= $arpara["mail"]
		, $subject= $mes1
		, $mailtext= $mes1
					, $header
		)
	or die("mymail");

putiplog(1,0);

print "specific error 1";

?>
