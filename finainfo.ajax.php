<?php
# разглеждане на приключено постъпление по текущото дело 
# отгоре : 
#    $info - finance.id 
//print_r($GETPARAM);

# шаблона 
$tpname= "finainfo.ajax.tpl";

# данните за постъплението 
$rocont= getrow("finance",$info);
$idcase= $rocont["idcase"];

# за взискателите 
	$clailist= getclailist($idcase);
	$smarty->assign("CLAILIST", $clailist);
//$rocont["claiamou"]= unserialize($rocont["toclai"]);
$rocont["claiamou"]= unsetoclai($rocont["toclai"]);

# свързаните данни 
	$rocase= getrow("suit",$idcase);
$rocont["caseseri"]= $rocase["serial"];
$rocont["caseyear"]= $rocase["year"];
			
# изчисляваме и зареждаме балансовите полета 
finacalc($rocont, $rocont);

							# за извеждане на "тип" - масива $listfinatype - commspec.php 
							# предаваме съдържанието на масива 
							$smarty->assign("ARTYPE", $listfinatype);

# извеждаме 
$smarty->assign("DATA", $rocont);
print smdisp($tpname,"iconv");

?>
