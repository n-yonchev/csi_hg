<?php
# списък описи с преводи 
# отгоре : 
#    $mode - текущия режим 
#    $vari - текущото подменю 
#    $page - текущата страница 
//# още : 
//#    $filtcode - филтър-1 
//print $filtcode;
//print_rr($GETPARAM);

# текущата страница 
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

//$relurl= geturl("mode=".$mode."&vari=".$vari."&page=".$page);
$baco= "mode=".$mode."&vari=".$vari."&page=".$page;
$relurl= geturl($baco);
$smarty->assign("GOTEXT", "назад към стр. $page от списъка описи");
$smarty->assign("GOBACK", $relurl);
/*
									# смяна статуса на описа 
									$idinve= $GETPARAM["idinve"];
									if (isset($idinve)){
//										include_once "traninveview.php";
//										exit;
//# не ajax 
//return;
$tostat= $GETPARAM["tostat"];
updrow("traninve",$idinve,"idstat=".$tostat);
									}else{
									}
*/
									# смяна статуса на описа 
									$tostat= $GETPARAM["tostat"];
									if (isset($tostat)){
//										include_once "traninveview.php";
//										exit;
//# не ajax 
//return;
$idinve= $GETPARAM["idinve"];
//updrow("traninve",$idinve,"idstat=".$tostat);
updrow("traninve",$idinve,"idstat=$tostat,statmodi=now()");
# reload 
reload("",$relurl);
									}else{
									}
									# изключване описа от пакет 
									$exde= $GETPARAM["exde"];
									if (isset($exde)){
//										include_once "traninveview.php";
//										exit;
//# не ajax 
//return;
//$tostat= $GETPARAM["tostat"];
updrow("traninve",$exde,"idpack=0");
									}else{
									}
									# разглеждане на избран опис 
									$view= $GETPARAM["view"];
									if (isset($view)){
//var_dump($modeel);
										include_once "traninveview.php";
//										exit;
# не ajax 
return;
									}else{
									}

/**/
#---------------------------------------------------------------------------------
# назначаване към пакет - избрания опис 
//# назначаване към пакет - избрания опис и включените в него преводи 
			$topack= $GETPARAM["topack"];
			if (isset($topack)){
# за кой опис 
			$idinve= $GETPARAM["idinve"];
				if ($topack==0){
# нов пакет 
					# банката за новия пакет 
					$rotran= getrow("traninve",$idinve);
					$packbank= $rotran["idbank"];
//$topack= $DB->query("insert into tranpack set idbank=$packbank, created=now()");
$topack= $DB->query("insert into tranpack set idbank=$packbank, created=now(), iduser=?d"  ,$_SESSION["iduser"]);
				}else{
				}
////# за кой опис 
////			$idinve= $GETPARAM["idinve"];
//print "[$topack][$idinve]";
/**/
//# код за подзаявка за врем.таблица при назначаване 
//$workcode= getworkcode("finatran.idinve=".$idinve);
									# дава грешка, че finatran не е заключена ??? 
									//$DB->query("lock tables finatran write, traninve write");
/***
# назначаване преводите 
$aset= array();
$aset["idpack"]= $topack;
$DB->query("
	update finatran 
	set ?a
	where id in (
$workcode
	)
"  ,$aset);
***/
													$DB->query("lock tables tranpack write, traninve write");
							$ropack= getrow("tranpack",$topack);
							if ($ropack["idstat"]==0){
# назначаване описа 
$iset= array();
$iset["idpack"]= $topack;
$DB->query("update traninve set ?a where id=?d"  ,$iset,$idinve);
									//$DB->query("unlock tables");
/**/
# reload 
$gpar= $GETPARAM;
unset($gpar["topack"]);
	unset($gpar["idinve"]);
unset($gpar["v2"]);
		$newlis= "";
foreach($gpar as $name=>$cont){
		$newlis .= "&$name=$cont";
}
$newlis= substr($newlis,1);
$newurl= geturl($newlis);
	print "
<script>
document.location.href='$newurl';
</script>
	";
/**/
							}else{
$smarty->assign("PACKER", "пакет $topack вече е заключен");
							}
													$DB->query("unlock tables");
			}else{
			}
#---------------------------------------------------------------------------------
/**/

# списъка 
		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
		$query= getinvequ("1");
		$prefurl= "";
		$baseurl= "mode=".$mode."&vari=".$vari;
		$obpagi= new paginator(18, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);
//print_rr($mylist);

# трансформираме го - параметри за иконите 
				$modeel= "mode=".$mode."&vari=".$vari."&page=".$page;
							$arin= array();
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
	$mylist[$uskey]["view"]= geturl($modeel."&view=".$idcurr);
	$mylist[$uskey]["exde"]= geturl($modeel."&exde=".$idcurr);
			foreach($arpacktext as $idstat=>$x2){
	$mylist[$uskey]["tostat".$idstat]= geturl($modeel."&idinve=".$idcurr."&tostat=".$idstat);
			}
							$arin[]= $idcurr;
}
//print_rr($arin);

# бройки преводи 
							if (empty($arin)){
$arcoun= array();
							}else{
$codein= implode(",",$arin);
//var_dump($codein);
//$arcoun= $DB->selectCol("select idinve as ARRAY_KEY, count(*) from finatran where idinve in ($codein) group by idinve");
$arcoun= $DB->select("select idinve as ARRAY_KEY, count(*) as coun, sum(amount) as suma from finatran where idinve in ($codein) group by idinve");
							}
//print_rr($arcoun);
$smarty->assign("ARCOUN", $arcoun);

# свободните пакети 
$arpack= getpackacti("");
//print_rr($arpack);

# линкове за серията пакети за всеки опис 
$baco= "mode=".$mode."&vari=".$vari."&page=".$page;
								$arpacklink= array();
foreach ($mylist as $uskey=>$uscont){
				$idinve= $uscont["id"];
				$idinvebank= $uscont["idbank"];
//print "<br>idinve=[$idinve]";
				$arlink= array();
	foreach($arpack as $idpack=>$cont){
		if ($cont["idbank"]==$idinvebank){
				$arlink[$idpack]["coun"]= $cont["coun"];
				$arlink[$idpack]["idbank"]= $cont["idbank"];
				$arlink[$idpack]["link"]= geturl($baco."&idinve=".$idinve."&topack=".$idpack);
		}else{
		}
	}
				$arlink[0]["link"]= geturl($baco."&idinve=".$idinve."&topack=0");
								$arpacklink[$idinve]= $arlink;
}
$smarty->assign("ARPACKLINK", $arpacklink);
//print_rr($arpacklink);

//# add new link 
//$addnew= geturl($modeel."&edit=0");
//$smarty->assign("ADDNEW", $addnew);


# извеждаме 
$smarty->assign("LIST", $mylist);
$contvari= smdisp("traninve.tpl","fetch");

?>
