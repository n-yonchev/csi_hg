<?php
# вика се с ajax от шаблона rep2calc.ajax.tpl 

									session_start();
									include_once "common.php";
//$idcase= $_GET["c"];
//$period= $_GET["p"];
//print "idcase=[$idcase][$period]";

$period= $_GET["p"];
$idcase= $_GET["c"];
$ISLOGTXT= ($_GET["log"]=="yes");
//print $idcase;
	
								include_once "rep2.inc.php";

$DB->query("delete from `$temp4` where idcase=?d"  ,$idcase);

# заради евент.доброволно събрани суми 
$rorepo= $DB->selectRow("select created,voluenddate from `$tarepo` where idcase=?d"  ,$idcase);
$casecreadate= $rorepo["created"];
$voluenddate= $rorepo["voluenddate"];

#------ изчисления за текущото дело ------------------------------
		$edit= $idcase;
								$rocase= getrow("suit",$idcase);
								$_SESSION["extraint"]= $rocase["extraint"];
						include_once "cazobala.php";
//		$resudata= end($balist);
//$baut= print_r(toutf8($resudata),true);
/*
$baut= print_r($balist,true);
$fc= fopen("calcresu.txt","a");
fwrite($fc,"\n"."----------".$edit."=".$rocase["serial"]."/".$rocase["year"]."----------"."\n");
fwrite($fc,"\nextraint=".$rocase["extraint"]."\n");
fwrite($fc,"$baut\n");
fclose($fc);
*/
# записи за всички редове калкулация 
foreach($balist as $elem){
	# изключваме "към момента" 
	if ($elem["oper"]==$IDOPERCURR){
	}else{
			$aset= array();
			$aset["idcase"]= $idcase;
			$aset["idrefe"]= $elem["id"] +0;
			$aset["date"]= $elem["date"];
			$aset["oper"]= $elem["oper"];
			$aset["desc"]= toutf8($elem["desc"]);
			# специално за колоните за отчет-2 
/*
			foreach($elem["rep2plus"] as $inr2=>$cor2){
				$aset["p".$inr2]= $cor2;
			}
			foreach($elem["rep2minu"] as $inr2=>$cor2){
				$aset["m".$inr2]= $cor2;
			}
			foreach($elem["rep2resu"] as $inr2=>$cor2){
				$aset["r".$inr2]= $cor2;
			}
*/
			$aset= $aset + putcol2($elem["rep2plus"],"p");
			$aset= $aset + putcol2($elem["rep2minu"],"m");
			$aset= $aset + putcol2($elem["rep2resu"],"r");
					# специално за олихвяванията 
					if ($elem["oper"]==$IDOPERINTE){
								$sumainte= 0;
						foreach($elem["move"] as $inmo=>$elmo){
							if ($inmo+0==0){
							}else{
								$sumainte += $elmo["perc"];
							}
						}
			$aset["amou"]= $sumainte ."";
					}else{
			$aset["amou"]= $elem["amou"] ."";
					}
		# движенията с минус (за постъпление) - по взискатели 
				if (empty($elem["rep2move"])){
		$aset["rep2move"]= "";
				}else{
		$aset["rep2move"]= serialize($elem["rep2move"]);
				}
		# статус на събирането (погасяването) според датата 
		#    0= не е събиране 
		#    1= преди периода 
		#    2= през периода 
		#    3= след периода 
		if ($aset["oper"]==$OPERMINU){
			$yemo= substr($aset["date"],0,7);
			if ($yemo < $yemon1){
				$idvari= 1;
# събрано преди пер. - само по изп.лист 
$aset["c1paym"]= $aset["m9"] +0;
			}elseif ($yemo > $yemon2){
				$idvari= 3;
			}else{
				$idvari= 2;
/***
# събрано през периода - евент.доброволно 
$mydate= $aset["date"];
$rosuit= $DB->selectRow("select datediff('$mydate',date(created)) as daysdiff, idtitu from suit where id=?d"  ,$idcase);
//print_rr($rosuit);
$daysdiff= $rosuit["daysdiff"];
$suittitu= $rosuit["idtitu"];
	$daysperi= $timerep2[$suittitu];
//print "[$idcase][$daysdiff][$suittitu][$daysperi]";
if ($daysperi>0 and $daysdiff>=0 and $daysdiff<=$daysperi){
//			$aset["m10"]= $aset["amou"];
			$aset["m10"]= $aset["m5"]+$aset["m6"]+$aset["m7"]+$aset["m8"]+$aset["m9"];
}else{
}
***/
# събрано през периода - евент.доброволно 
$mydate= $aset["date"];
//print "[$mydate][$casecreadate][$voluenddate]";
if ($mydate>=$casecreadate and $mydate<=$voluenddate){
			$aset["m10"]= $aset["m5"]+$aset["m6"]+$aset["m7"]+$aset["m8"]+$aset["m9"];
}else{
}
			}
		}else{
				$idvari= 0;
		}
		$aset["idvari"]= $idvari;
		# създаваме записа 
		$DB->query("insert into `$temp4` set ?a"  ,$aset);
	}
}

#------ сумирания за текущото дело ------------------------------
# събрани преди периода 
$robefo= $DB->selectRow("select 
	sum(c1paym) as s1paym 
	from `$temp4` 
	where idcase=?d and idvari=?d group by idcase
	"  ,$idcase,1);
$s1paym= $robefo["s1paym"];
# събрани през периода 
$roduri= $DB->selectRow("select 
	sum(m5) as s5, sum(m6) as s6, sum(m7) as s7, sum(m8) as s8, sum(m9) as s9
	, sum(m10) as s10
	from `$temp4` 
	where idcase=?d and idvari=?d group by idcase
	"  ,$idcase,2);
//print_rr($roduri);
//var_dump($idcase);
$s5= $roduri["s5"];
$s6= $roduri["s6"];
$s7= $roduri["s7"];
$s8= $roduri["s8"];
$s9= $roduri["s9"];
$s10= $roduri["s10"];
# според дали делото е прекратено през периода 
$mycodestopduri= "statduri in ($mycodestat)";
$stat2= "if($mycodestopduri,1,0)";
$flagstop= $DB->selectCell("select $stat2 from `$tarepo` where idcase=?d"  ,$idcase);
if ($flagstop==1){
	$stopcode= ", c11diff=round(c3suma-c9,2), c12diff=''";
}else{
	$stopcode= ", c11diff='', c12diff=round(c3suma-c9,2)";
}
# прехвърляме сумите в основната табл. 
$DB->query("update `$tarepo` set 
	c1paym='$s1paym', c5='$s5', c6='$s6', c7='$s7', c8='$s8', c9='$s9',
	c10='$s10',
	c1=round(c1full-c1paym,2), c3suma=round(c1+c2,2) $stopcode,
	c4=round(c5+c6+c7+c8+c9,2)
	where idcase=?d
	"  ,$idcase);

#------ край изчисления за текущото дело ------------------------------

$rocase= getrow("suit",$idcase);
	$cuyear= $rocase["year"];
	$cuseri= $rocase["serial"];
$codecrit= "1000000*year+serial";
$codecu= "1000000*$cuyear+$cuseri";
$mylist= $DB->selectCol("
	select idcase
	from `$tarepo`
	where iderror=0
		and $codecrit >= $codecu
	order by year,serial
	limit 2
	"  ,$cuyear,$cuseri);
//print_rr($mylist);

print "ok"."^".$mylist[0]."^".$mylist[1];



function putcol2($ar1,$pref){
global $ar2colospec;
				$arresu= array();
	if (is_array($ar1)){
		foreach($ar1 as $inr2=>$cor2){
			//if (in_array($inr2,$ar2colospec) and $pref=="m"){
			//}else{
#????????????????????????????????????????
			if (empty($inr2)){
			}else{
				$arresu[$pref.$inr2]= $cor2 +0;
			}
			//}
		}
	}else{
	}
return $arresu;
}


?>