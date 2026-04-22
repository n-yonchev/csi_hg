<?php

									session_start();
									include_once "common.php";
									include_once "reg2.inc.php";
$idcase= $_GET["s"];
//var_dump($idcase);

$uniq= $idcase;
$uniqname= $uniq;
direunlink("register",$uniq);
direunlink("regicert",$uniq);

//putcases("id=".$idcase, "suitstathist.idcase=".$idcase);
putcases("id=".$idcase, "suitstathist.idcase=".$idcase);
putpersons("suit.id=".$idcase);
putorigins("suit.id=".$idcase);
putzip();

$rooffi= getofficerow(0);
$code= $rooffi["serial"];
$znam= gettofile("namezip");
//$namezi= "../" .$namezi;
//print "$code\n$znam\n$uniq\n";

							include_once "regicert/nusoap.php";

	$bcon= file_get_contents($znam);
	$base= base64_encode($bcon);
$arresu= toregi($code,"syncAction", array('data' => $base));
//print_rr($arresu);
	$recode= key($arresu);
	$recont= $arresu[$recode];
//	$mess= $armess[$recode];
//	$fina= $uniq .$arfina[$recode];
//	file_put_contents($fina,$recont);
	$mess= $arcall[$recode];
$smarty->assign("MESS", $mess);
//var_dump($recont);
//		$recont= tran1251($recont);
//		$recont= toutf8($recont);
//		$recont= nl2br($recont);
//var_dump($recont);
	if ($recode=="ok"){
/***/
					$ficont= "";
//		$fiar= file($finame);
//$recont= substr($recont,0,214)."\n"."123456789012345678901234567890alert\n".substr($recont,214);
		$fiar= explode("\n",$recont);
//print_rr($fiar);
		foreach($fiar as $row){
			$row= substr($row,19);
			if (strpos($row,"alert")===false){
			}else{
				$row= "<font color=red>".$row."</font>";
$smarty->assign("ISALER", true);
			}
					$ficont .= $row ."\n";
		}
		$ficont= tran1251($ficont);
		$ficont= nl2br($ficont);
//var_dump($ficont);
$smarty->assign("FICONT", $ficont);
/***/
/*
			if (strpos($recont,"alert")===false){
$smarty->assign("ISALER", true);
			}else{
			}
$smarty->assign("FICONT", $recont);
*/
	}else{
$smarty->assign("ERCONT", $recont);
	}
/*
$client= $GLOBALS["client"];
$fidebug= $uniq ."_debug.txt";
file_put_contents($fidebug,$client->debug_str,ENT_QUOTES);
*/

$tpname= "cazo34regito.ajax.tpl";
print smdisp($tpname,"iconv");

?>