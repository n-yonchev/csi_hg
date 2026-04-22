<?php
									session_start();
									include_once "common.php";

# параметъра 
//$type= $_GET["type"];
//$mode= $_GET["mode"];
$GEPA= getparam();
$type= $GEPA["type"];
$mode= $GEPA["mode"];
						$mont= $GEPA["mont"];
//print "[$type][$mode]";

# пренасочваме 
$filtpara= $_POST["filtpara"];
if (isset($filtpara)){
//				$modeel= "mode=".$mode ."&page=".$page;
				//$filtelem= "$type"."/".$filtpara;
				//$modeel= "mode=".$mode ."&filtpara=".$type."/".$filtpara;
//				$modeel= "mode=".$mode;
				$modeel= "mode=".$mode ."&mont=".$mont;
				$redirurl= geturl($modeel ."&filtpara=".$type."/".$filtpara);
	print "
<script>
window.location.href='index.php$redirurl';
</script>
	";
return;
}else{
}

				# функции, свързани с филтрите 
				include_once "finafilt.inc.php";

# извеждаме форма за избор 
$list= finafiltform($type);
							# предаваме името, а не съдържанието на масива 
							$smarty->assign("ARLIST", "list");

$smarty->assign("TYPE", $type);
//$smarty->assign("LIST", $mylist);
print smdisp("finafilt.ajax.tpl","iconv");

?>
