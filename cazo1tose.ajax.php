<?php

									session_start();
									include_once "common.php";

$idcase=$_GET["e"];
							
						include_once $reg4path."reg4.inc.php";
						reg4start($idcase);

print "ok^$idcase";

?>