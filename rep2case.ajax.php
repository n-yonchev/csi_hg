<?php
									session_start();
									include_once "common.php";
$idcase= $_GET["c"];
$period= $_GET["p"];
//print "idcase=[$idcase][$period]";
								include_once "rep2.inc.php";

# дължими суми = предмети 
# отгоре филтри за табл.subject : 
#    $filtsubj1 - типа/подтипа да са по изп.лист - за кол.1 и 2 
#    $filtsubj2 - само включените дела 
//#    $filtsubj3 - само предмети с НЕприсъединен взискател 
#    $filtsubj3 - взискателя за предмета да е или първичен взискател, или не НАП/община 
$mylist= $DB->select("
	select subject.id as idsubj, subject.idcase, subject.idtype, subject.idsubtype
		, subject.amount, subject.text, subject.fromdate, subject.todate, subject.idclaimer
, claimer.name as clainame
			, if($filtsubj1 ,1,0) as ok1
			, if($filtsubj3 ,1,0) as ok2
		, `$temp3`.rep2amou
		, if(subject.idtype in ($mycodemont) ,1,0) as ismont
		, $mycodefielname as debtfiname
	from subject 
		left join `$tarepo` on subject.idcase=`$tarepo`.idcase
		left join claimer on subject.idclaimer=claimer.id
		left join `$temp3` on subject.id=`$temp3`.idsubj
	where subject.idcase=?d 
/*	order by subject.id */
	order by subject.fromdate
	"  ,$idcase);
//var_dump($filtsubj3);
//print_rr($mylist);
					$arsuma= array();
foreach($mylist as $indx=>$elem){
			$debtfiname= $elem["debtfiname"];
			$rep2amou= $elem["rep2amou"];
	$mylist[$indx][$debtfiname]= $rep2amou;
			$idcase= $elem["idcase"];
//					$arsuma[$idcase][$debtfiname] += $rep2amou;
					$arsuma[$debtfiname] += $rep2amou;
					$arsuma[$debtfiname]= round($arsuma[$debtfiname],2);
}	
$mylist= dbconv($mylist);
$smarty->assign("LIST", $mylist);
$smarty->assign("ARSUMA", $arsuma);
//print_rr($arsuma);

# събрани суми = калкулация на погасяването 
$mycalc= $DB->select("select `$temp4`.*, `$temp4`.id as id
	from `$temp4`
	where `$temp4`.idcase=?d 
	order by `$temp4`.id
	"  ,$idcase);
$mycalc= dbconv($mycalc);
//print_rr($mycalc);
					$sucalc= array();
//					$arfina= array("c1paym","c5","c6","c7","c8","c9","c10");
foreach($mycalc as $myin=>$myel){
			if (empty($myel["rep2move"])){
	unset($mycalc[$myin]["rep2move"]);
			}else{
	$mycalc[$myin]["rep2move"]= unserialize($myel["rep2move"]);
			}
					/*
					$sucalc["c1paym"] += $myel["c1paym"];
					$sucalc["c5"] += $myel["c5"];
					$sucalc["c6"] += $myel["c6"];
					$sucalc["c7"] += $myel["c7"];
					$sucalc["c8"] += $myel["c8"];
					$sucalc["c9"] += $myel["c9"];
					$sucalc["c10"] += $myel["c10"];
					*/
/*
					foreach($arfina as $fina){
						$sucalc[$fina] += $myel[$fina];
						$sucalc[$fina]= round($sucalc[$fina],2);
					}
*/
}
//print_rr($mycalc);
$smarty->assign("CALC", $mycalc);
$smarty->assign("SUCALC", $sucalc);
//print_rr($sucalc);
$smarty->assign("AREMPTY", array());

/*
# текстове за операциите - от cazobala.php 
$opertext= array();
$opertext[1]= "към.момента";
$opertext[2]= "мес.вноска";
$opertext[3]= "дълг";
$opertext[4]= "погасяване";
$opertext[5]= "олихвяване";
$opertext["ap"]= "аванс.вноска";
$smarty->assign("OPERTEXT", $opertext);

# индекс на операцията за погасяване 
# съгласувано с $balaoper[4]= "погасяване" - cazobala.php 
		$operminu= 4;
$smarty->assign("OPERMINU", $operminu);
*/

# от cazobala.php - взискателите 
$clailist= $DB->selectCol("select id as ARRAY_KEY, name from claimer where idcase=?d"  ,$idcase);
$clailist= dbconv($clailist);
	$clailist[0]= "ЧСИ";
$smarty->assign("CLAILIST", $clailist);

# общите суми за делото 
$calcsuma= $DB->selectRow("select * from `$tarepo` where idcase=?d"  ,$idcase);
//	$calcsuma["c1full"] += 10;
//	$calcsuma["c2"] += 10;
$smarty->assign("CALCSUMA", $calcsuma);
//print_rr($calcsuma);

						# тип - кратко, подтип - кратко 
						$smarty->assign("ARTYPE", $listsubjtype2);
						$smarty->assign("ARSUBT", $listsubjst2);
print smdisp("rep2case.ajax.tpl","iconv");

?>