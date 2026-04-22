<?php
# отчет раздел 2 - етап 3 резултат 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $period - периода за отчета 
#    $vari - текущия режим на вторичното меню 
# още отгоре : 
#    $period - периода за отчета 
#    $tarepo - име на таблицата за периода 
#    $peyear, $pemon1, $pemon2 - година, нач, краен месец 
#    $yemon1, $yemon2 - за MySQL нач.краен година-месец yyyy-mm 
//print_rr($GETPARAM);

					# разглеждане на отделно въведено дело 
//print_rr($_POST);
					$rep2case= $_POST["rep2case"];
					if (isset($rep2case)){
						list($r2seri,$r2year)= explode("/",$rep2case);
						if (substr($r2year,0,2)=="20"){
						}else{
							$r2year= "20".$r2year;
						}
//						$r2idcase= $DB->selectCell("select idcase from `$tarepo` where serial=? and year=?"  ,$r2seri,$r2year);
						$r2ro= $DB->selectRow("select idcase,idrepo from `$tarepo` where serial=? and year=?"  ,$r2seri,$r2year);
						$r2idcase= $r2ro["idcase"];
						$r2idrepo= $r2ro["idrepo"];
						if ($r2idcase+0==0){
$_POST["rep2case"]= $rep2case .toutf8(" липсва");
						}else{
$_POST["rep2case"]= "";
$refilt= "`$tarepo`.idcase=$r2idcase";
//$rehead= "данни за дело ".$rep2case;
$rehead= "данни за дело ".$rep2case ."<br>[".$repocode[$r2idrepo]."] " .$viewrepo[$r2idrepo];
$remode= "&idcase=".$r2idcase;
							include_once "rep2deta.php";
return;
						}
//return;
					}else{
					}

					# разглеждане на елемент от групата невлизащи 
					$iderror= $GETPARAM["iderror"];
					if (isset($iderror)){
$refilt= "`$tarepo`.iderror=$iderror";
$rehead= "списък на делата, които не влизат в отчета по причина<br>".$artexter[$iderror];
$remode= "&iderror=".$iderror;
							include_once "rep2deta.php";
return;
					}else{
					}
					# разглеждане на елемент от групата влизащи 
					$idrepo= $GETPARAM["idrepo"];
					if (isset($idrepo)){
$refilt= "`$tarepo`.iderror=0 and `$tarepo`.idrepo=$idrepo";
$rehead= "списък на делата, които влизат в отчета на ред<br>[".$repocode[$idrepo]."] ".$viewrepo[$idrepo];
$remode= "&idrepo=".$idrepo;
							include_once "rep2deta.php";
return;
					}else{
					}


				$modeel= "mode=".$mode ."&period=".$period ."&vari=".$vari;
# обобщени бройки по информ.съобщения за невключени дела 
$listcoun= $DB->selectCol("select iderror as ARRAY_KEY, count(*) from `$tarepo` group by iderror");
				# линкове 
						$erlink= array();
				foreach($listcoun as $indx=>$x2){
						$erlink[$indx]= geturl($modeel."&iderror=".$indx);
				}
//# специално за грешка=4 няма дълж.суми - както за линк без грешка 
//$erlink[4]= geturl($modeel."&idrepo=4");
				$smarty->assign("ERLINK", $erlink);
# сумарни 
		$counin= 0;
		$counout= 0;
//print_rr($listcoun);
foreach($listcoun as $indx=>$elem){
	if ($indx==0){
		$counin += $elem;
	}else{
		$counout += $elem;
	}
}
	$countota= array();
	$countota["in"]= $counin;
	$countota["out"]= $counout;
	$countota["tota"]= $counin+$counout;
$smarty->assign("LISTCOUN", $listcoun);
$smarty->assign("COUNTOTA", $countota);

# обобщени бройки по редове за отчета за включените дела 
//# както и за грешка=4 : няма дълж.суми 
/**/
$listinre= $DB->selectCol("
	select idrepo as ARRAY_KEY, count(*) 
	from `$tarepo` 
	where iderror=0 
	group by idrepo
	");
/**/
/***
$listinre= $DB->selectCol("
	select idrepo as ARRAY_KEY, count(*) 
	from `$tarepo` 
	where iderror=0 or iderror=4
	group by idrepo
	");
$smarty->assign("SPECER", 4);
***/
//print_rr($listinre);
				# линкове 
						$rolink= array();
				foreach($listinre as $indx=>$x2){
						$rolink[$indx]= geturl($modeel."&idrepo=".$indx);
				}
				$smarty->assign("ROLINK", $rolink);
$smarty->assign("LISTINRE", $listinre);
$smarty->assign("ARROTYPE", $arrotype);
$smarty->assign("VIEWREPO", $viewrepo);
$smarty->assign("REPOCODE", $repocode);


# извеждаме 
$smarty->assign("ARMESS", $artexter);
$rep2cont= smdisp("rep2v3.tpl","fetch");

?>
