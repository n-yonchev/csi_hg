<?php
# към регистъра - всички дела на логнатия юзер - резултат 
# отгоре : 
#     $mode - режима 
# още отгоре : 
#     $usnameregi - име на логнатия 
#     $uspref - групово файлово име 
//print_rr($_SESSION);
//print_rr($GETPARAM);
$submod= $GETPARAM["submod"];
									
									# разглеждане на на избрано дело 
									$edit= $GETPARAM["edit"];
									if (isset($edit)){
//var_dump($edit);
# назад към списъка наблюдатели 
$smarty->assign("PAGEBACK", $page);
$smarty->assign("PAGEBACKTEXT", "назад към списъка грешки");
//$smarty->assign("PAGEBACKLINK", geturl("mode=".$mode ."&page=".$page));
//$smarty->assign("PAGEBACKLINK", geturl("mode=".$mode ."&page=".$page ."&flagall=".$flagall."&filtname=".$filtname));
$smarty->assign("PAGEBACKLINK", geturl("mode=".$mode ."&page=".$page ."&submod=".$submod));
										include_once "caseedit.php";
//										exit;
$pagecont= smdisp("caseedit.tpl","fetch");
return;
									}else{
									}


									//include_once "reg2.inc.php";
/***
# логнатия 
$iduser= @$_SESSION["iduser"];
$rouser= getrow("user",$iduser);
$usname= $rouser["name"];
//$uspref= cyrlat($usname) ."_";
$uspref= cyrlat($usname);
//var_dump($uspref);
	$lepref= strlen($uspref);
	$uniq= $uspref;
$smarty->assign("UNIQ", $uniq);
***/

# груповото име 
	$lepref= strlen($uspref);
	$uniq= $uspref;
$smarty->assign("UNIQ", $uniq);

# наличните файлове 
$fnpref= dirname(__FILE__)."/"."regicert/".$uniq;
$arinfo= array();
												$firstmode= "";
			$fitime= $fnpref .".txt";
			if (file_exists($fitime)){
$arinfo["dura"]= file_get_contents($fitime);
				$fsta= filemtime($fitime);
				$ftim= date("d.m.Y H:i:s",$fsta);
//var_dump($ftim);
$arinfo["time"]= $ftim;
				$modeel= "mode=".$mode;
				foreach($arfina as $code=>$fina){
					$fnam= $fnpref .$fina;
//print "<br>".$fnam;
					if (file_exists($fnam)){
//print "=OK";
$arinfo[$code]["link"]= geturl($modeel."&submod=".$code);
												culink($code);
					}else{
//print "=notexi";
					}
				}
			}else{
			}
# грешки в данните от протокола 
												$firstmode= ($firstmode=="ok") ? "" : $firstmode;
$finame= $fnpref .$arfina["ok"];
if (file_exists($finame)){
	$armist= getdataer($finame,false);
	$comist= count($armist);
	if ($comist==0){
		$arinfo["resu"]= array("text"=>"OK");
	}else{
		$arinfo["resu"]= array("text"=>"$comist грешки", "link"=>geturl($modeel."&submod=resu"));
												culink("resu");
	}
}else{
}
//print_rr($arinfo);

//$smarty->assign("ARFINA", $arinfo);
$smarty->assign("ARINFO", $arinfo);

					# втора част - съдържание 
				$submod= $GETPARAM["submod"];
					if (isset($submod)){
					}else{
						if (empty($firstmode)){
				$submod= "ok";
						}else{
				$submod= $firstmode;
						}
					}
//print "submod=[$submod]";
					if (0){
					}elseif (in_array($submod,array("e1","e2","e3"))){
$finame= $fnpref .$arfina[$submod];
$smarty->assign("HETEXT", $arcall[$submod]);
						include_once "regiex.php";
					}elseif ($submod=="resu"){
$finame= $fnpref .$arfina["ok"];
$armist= getdataer($finame,true);
						include_once "regiresu.php";
					}elseif ($submod=="ok"){
$finame= $fnpref .$arfina["ok"];
						include_once "regiok.php";
					}else{
die("regila=1=$submod");
					}
$smarty->assign("SUBMOD", $submod);
//var_dump($submod);

# извеждаме 
$smarty->assign("USNAMEREGI", $usnameregi);
//$smarty->assign("FIRSTMODE", $firstmode);
//$smarty->assign("CODESUB", $codesub);
//$smarty->assign("SUBTEX", $subtex);
$pagecont= smdisp("regila.tpl","fetch");


function culink($p1){
global $firstmode;
	if (empty($firstmode)){
$firstmode= $p1;
	}else{
	}
}

?>