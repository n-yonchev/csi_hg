<?php
# смяна на длъжник за постъпление 
# ако делото има >1 длъжник и постъплението е приключено 
# вика се от cazofina.tpl 

									session_start();
									include_once "common.php";

# параметъра - finance.id 
$GEPA= getparam();
$finaid= $GEPA["finaid"];
//$refe= $GEPA["refe"];
//	$refe= rawurlencode($refe);
//print "[$finaid][$refe]";
//print_r($GEPA);

				$debtnewid= $_POST["debtnewid"];
				if (isset($debtnewid)){
					# сменяме длъжника 
					$DB->query("update finance set iddebtor=$debtnewid where id=$finaid");

# reload на целия главен прозорец 
# CASEREFELINK се формира в caseedit.php 
$refe= $_SESSION["CASEREFELINK"];
	print "
<script>
window.location.href='index.php$refe';
</script>
	";

				}else{

# четем постъплението - определяме делото 
$rofina= getrow("finance",$finaid);
$caseid= $rofina["idcase"];

# за избор на длъжник - четем списъка с длъжниците по делото 
$ardebt= getselect("debtor","name","idcase=$caseid",false);
# предаваме името, а не съдържанието на масива 
$smarty->assign("ARLIST", "ardebt");

# извеждаме формата за избор на длъжник 
print smdisp("cazofinadebt.ajax.tpl","iconv");

				}

?>