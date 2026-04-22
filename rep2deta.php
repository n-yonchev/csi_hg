<?php
# отчет раздел 2 - етап 2 резултат - извеждане на група дела 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $period - периода за отчета 
#    $vari - текущия режим на вторичното меню 
# още отгоре : 
#    $period - периода за отчета 
#    $tarepo - име на таблицата за периода 
#       $temp1/$temp2 - таблици с посл.статуси преди/през периода 
#       $temp3 - таблица с предметите 
#    $peyear, $pemon1, $pemon2 - година, нач, краен месец 
#    $yemon1, $yemon2 - за MySQL нач.краен година-месец yyyy-mm 
# още отгоре : 
#    $rehead - заглавен текст 
#    $refilt - филтъра 
#    $remode - допълнение за базовия линк 
//print "REFILT=[$refilt]";

//$mylist= $DB->select("select * from `$tarepo` where $refilt order by year, serial");
//print "COUNT=".count($mylist);
//$smarty->assign("DATA", $mylist);

# варианти подсписъци 
	$artex2= array();
	$artex2["all"]= "всички";
	$artex2["befoyes"]= "ф1а";
	$artex2["befono"]=  "ф1б";
	$artex2["duriyes"]= "ф2а";
	$artex2["durino"]=  "ф2б";
$smarty->assign("ARTEX2", $artex2);
	$artit2= array();
	$artit2["all"]= "всички дела";
	$artit2["befoyes"]= "само образувани ПРЕДИ периода и ПРЕКРАТЕНИ през периода";
	$artit2["befono"]=  "само образувани ПРЕДИ периода и ПРОДЪЛЖАВАЩИ след периода";
	$artit2["duriyes"]= "само образувани ПРЕЗ периода и ПРЕКРАТЕНИ през периода";
	$artit2["durino"]=  "само образувани ПРЕЗ периода и ПРОДЪЛЖАВАЩИ след периода";
$smarty->assign("ARTIT2", $artit2);
				$modeel= "mode=".$mode ."&period=".$period ."&vari=".$vari .$remode;
	$arlin2= array();
foreach ($artex2 as $ekey=>$x2){
	$arlin2[$ekey]= geturl($modeel."&sublis=".$ekey);
}
$smarty->assign("ARLIN2", $arlin2);
# текущия подсписък 
//print_r($GETPARAM);
$sublis= $GETPARAM["sublis"];
$sublis= isset($sublis) ? $sublis : "all";
$smarty->assign("SUBLIS", $sublis);

# текущата страница 
//print_r($GETPARAM);
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
//$query= "select * from `$tarepo` where $refilt order by year, serial";
/*+++
$query= "select `$tarepo`.* 
		, `$temp1`.idstat as statbefo, `$temp1`.timestat as timebefo
		, `$temp2`.idstat as statduri, `$temp2`.timestat as timeduri
	from `$tarepo` 
		left join `$temp1` on `$tarepo`.idcase=`$temp1`.idcase
		left join `$temp2` on `$tarepo`.idcase=`$temp2`.idcase
	where $refilt 
	order by `$tarepo`.year, `$tarepo`.serial
	";
+++*/
# образувано преди периода 
$mycodecreabefo= "substring(`$tarepo`.created,1,7) < '$yemon1'";
$stat1= "if($mycodecreabefo,1,0)";
# прекратено през периода 
$mycodestopduri= "statduri in ($mycodestat)";
$stat2= "if($mycodestopduri,1,0)";
# доп.филтър според подсписъка 
	$arfil2= array();
	$arfil2["all"]= "1";
	$arfil2["befoyes"]= "$stat1=1 and $stat2=1";
	$arfil2["befono"]=  "$stat1=1 and $stat2=0";
	$arfil2["duriyes"]= "$stat1=0 and $stat2=1";
	$arfil2["durino"]=  "$stat1=0 and $stat2=0";
$filter2= $arfil2[$sublis];
		$arindx= array();
		$arindx["all"]= "x";
		$arindx["befoyes"]= "x11";
		$arindx["befono"]=  "x10";
		$arindx["duriyes"]= "x01";
		$arindx["durino"]=  "x00";
$smarty->assign("ARINDX", $arindx);
# сборните суми 
$arfiel= array("c1full","c2","c1paym","c1","c3suma","c4","c5","c6","c7","c8","c9","c10","c11diff","c12diff");
			$arcode= array();
foreach($arfiel as $elem){
			$arcode[]= "sum($elem) as sum_$elem";
}
			$mycode= implode(",",$arcode);
$arsuma= $DB->selectRow("
	select $mycode
	from `$tarepo` 
	where $refilt 
		and $filter2
	");
$smarty->assign("ARSUMA", $arsuma);
//print_rr($arsuma);

# масив за вторичен филтър по колона 
# индексите и текстовете да съвпадат с тези в шаблона rep2deta.tpl 
//$arf2= array("all","c1full","c1paym","c1","c2","c3suma","c9","c11diff","c12diff");
		$arf2= array();
		$arf2["all"]= "";
	$arf2["c1full"]= "кол.[1a]";
	$arf2["c1paym"]= "кол.[1b]";
	$arf2["c1"]= "кол.1";
	$arf2["c2"]= "кол.2";
	$arf2["c3suma"]= "кол.3";
	$arf2["c9"]= "кол.9";
	$arf2["c11diff"]= "кол.11";
	$arf2["c12diff"]= "кол.12";
		$arf2["c5"]= "кол.5";
		$arf2["c6"]= "кол.6";
		$arf2["c7"]= "кол.7";
		$arf2["c8"]= "кол.8";
		$arf2["c4"]= "кол.4";
		$arf2["c10"]= "кол.10";
$smarty->assign("ARF2", $arf2);
		$arlinkf2= array();
$baseurl= "mode=".$mode ."&period=".$period ."&vari=".$vari .$remode ."&sublis=".$sublis;
foreach($arf2 as $colucode=>$x2){
		$arlinkf2[$colucode]= geturl($baseurl."&f2=".$colucode);
}
$smarty->assign("ARLINKF2", $arlinkf2);
# код на вторич.филтър 
$f2= $GETPARAM["f2"];
$f2= isset($f2) ? $f2 : "all";
$smarty->assign("CURRF2", $f2);
# формираме вторич.филтър по колона 
if ($f2=="all"){
	$filt2= "1";
}else{
	$filt2= "`$tarepo`.$f2+0<>0";
}

# заявката 
$query= "select `$tarepo`.* 
		, substring(`$temp1`.timestat,21) as statbefo, substring(`$temp1`.timestat,1,19) as timebefo
		, substring(`$temp2`.timestat,21) as statduri, substring(`$temp2`.timestat,1,19) as timeduri
		, $stat1 as stat1
		, $stat2 as stat2
	from `$tarepo` 
		left join `$temp1` on `$tarepo`.idcase=`$temp1`.idcase
		left join `$temp2` on `$tarepo`.idcase=`$temp2`.idcase
	where $refilt 
		and $filter2
and $filt2
	order by `$tarepo`.year, `$tarepo`.serial
	";

# странициране 
		$prefurl= "";
//		$baseurl= "mode=".$mode;
//$baseurl= "mode=".$mode ."&period=".$period ."&vari=".$vari .$remode;
//$baseurl= "mode=".$mode ."&period=".$period ."&vari=".$vari .$remode ."&sublis=".$sublis;
$baseurl= "mode=".$mode ."&period=".$period ."&vari=".$vari .$remode ."&sublis=".$sublis  ."&f2=".$f2;
//var_dump($baseurl);
		$obpagi= new paginator(18, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);
//print_rr($mylist);

# бройки по филтрите 
$statcode= "concat('x',$stat1,$stat2)";
$arcoun= $DB->selectCol("
	select count(*), $statcode as ARRAY_KEY
	from `$tarepo` 
		left join `$temp1` on `$tarepo`.idcase=`$temp1`.idcase
		left join `$temp2` on `$tarepo`.idcase=`$temp2`.idcase
	where $refilt 
	group by $statcode
	");
//print_rr($arcoun);
		$ctot= 0;
foreach($arcoun as $co){
		$ctot += $co;
}
$arcoun["x"]= $ctot;
$smarty->assign("ARCOUN", $arcoun);

					# редове за отчета - commspec.php 
					$smarty->assign("ARREPO", $viewrepo);
					# статусите - commspec.php 
					$smarty->assign("ARSTAT", $viewcasestat);
					# титулите - commspec.php 
					$smarty->assign("ARTITU", $listtitu);
		# js линкове за cluetip 
		$smarty->assign("HEADJS", array("cluetip.hoverIntent.js","jquery.cluetip.js"));

# извеждаме 
$smarty->assign("DATA", $mylist);
$smarty->assign("REHEAD", $rehead);
$smarty->assign("PERIOD", $period);
			if (isset($iderror)){
				# специално за грешка=4 няма дълж.суми - както за линк без грешка 
				if ($iderror==4){
//$rep2cont= smdisp("rep2deta.tpl","fetch");
$tpname= "rep2deta.tpl";
				}else{
//$rep2cont= smdisp("rep2derr.tpl","fetch");
$tpname= "rep2derr.tpl";
				}
			}elseif (isset($idrepo)){
//$rep2cont= smdisp("rep2deta.tpl","fetch");
$tpname= "rep2deta.tpl";
$smarty->assign("ISSUMA", true);
			}else{
				# избрано дело 
				if ($mylist[0]["iderror"]==0){
//$rep2cont= smdisp("rep2deta.tpl","fetch");
$tpname= "rep2deta.tpl";
				}else{
$smarty->assign("ARTEXTER", $artexter);
					# специално за грешка=4 няма дълж.суми - както за линк без грешка 
					if ($mylist[0]["iderror"]==4){
//$rep2cont= smdisp("rep2deta.tpl","fetch");
$tpname= "rep2deta.tpl";
					}else{
//$rep2cont= smdisp("rep2derr.tpl","fetch");
$tpname= "rep2derr.tpl";
					}
				}
			}
$rep2cont= smdisp($tpname,"fetch");

?>