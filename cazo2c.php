<?php
# вика се в iframe id="framinpu" 
									
									session_start();
									include_once "common.php";

$GETPARAM= getparam();
//print_rr($GETPARAM);
//print_rr($_POST);
list($tax2,$idx2,$fix2,$origx2)= explode("/",$GETPARAM["linkinpu"]);
$rocont= getrow($tax2,$idx2);
//print_rr($rocont);

if (!empty($_POST)){
									$txer= "";
	$cox2= trim($_POST["amou"]);
				if ($cox2==""){
				}else{
					$exvali= $evalvali["amount"];
					$value= $cox2;
					eval("\$result= ($exvali);");
					if ($result){
									$txer= "грешна сума";
					}else{
						if ($cox2+0 <= $origx2+0){
						}else{
									$txer= "надвишава оригиналната $origx2";
						}
					}
				}
	$smarty->assign("TXER", $txer);
				if (!empty($txer)){
				}else{
	$DB->query("update $tax2 set $fix2='$cox2' where id=?d"  ,$idx2);
//print "updated";

	#----- дв-86/17----- 
	# ВНИМАНИЕ, t2link трябва да е последна зона  
# рефреш на зоните - от cazo2modi.ajax.php 
	print "
<script>
parent.refr4();
</script>
	";
/***
	print "
<script>
parent.$('#tadvalink').click();
parent.$('#tactulink').click();
parent.$('#t2link').click();
</script>
	";
***/
/*
	$redilink= array("t2link","tactulink","tadvalink");
	$smarty->assign("EXITCODE", getnyroexit($redilink));
*/
				}
}else{
//	$rocont= getrow($tax2,$idx2);
//print_rr($rocont);
	$_POST["amou"]= $rocont[$fix2];
}

//print_rr($GETPARAM);
//print_rr($_POST);
print smdisp("cazo2c.tpl","iconv");

?>