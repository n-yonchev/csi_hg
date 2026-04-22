<?php
# вика се чрез jQuery.ajax от finainvo.ajax.tpl 

									session_start();
									include_once "common.php";

						//# всичко за фактурата 
						//include_once "invo.inc.php";

$idinvo= $_GET["p"];
//$DB->query("delete from invoelem where idinvoice=?d"  ,$idinvo);
//$DB->query("delete from invoice where id=?d"  ,$idinvo);
$DB->query("delete from billelem where idbill=?d"  ,$idinvo);
$DB->query("delete from invoelem where idbill=?d"  ,$idinvo);
$DB->query("delete from bill where id=?d"  ,$idinvo);

print "ok";

?>