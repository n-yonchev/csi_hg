<?php
# отгоре : 
#    $period - периода за отчета 


#-------------- общи константи за отчета -------------------

# $arrotype= списък стойности за полето "ред за отчета", при които делото попада в раздел 2 - всички без 5=обезпеч.мерки 
# трябва да е съгласуван с $listrepo - commspec.php 
//++++$arrotype= array(11,12,  21,22,23,  31,32,33,34,  4);
$arrotype= array(11,12,  71,72,8,  21,22,23,  31,32,33,34,  4);
$mycoderotype= implode(",",$arrotype);

# $mycodestat= списък статуси, при които делото е прекратено за раздел 2 - всички без 0=[празен] и 24=висяшо 
# трябва да е съгласуван с $listcasestat/$viewcasestat - commspec.php 
$arca2= $viewcasestat;
unset($arca2[0]);
unset($arca2[24]);
$arcodestat= array_keys($arca2);
$mycodestat= implode(",",$arcodestat);
//print_rr($arca3);
//var_dump($arcastat);

# $mycodemont - списък с типове предмети на изпълнение, които са месечни 
# трябва да е съгласуван с $listsubjtype - commspec.php 
$arcodemont= array(3,5);
$mycodemont= implode(",",$arcodemont);

# информ.съобщения за невключени дела 
$artexter= array();
$artexter[1]= "реда за отчета не попада в отчета";
$artexter[2]= "прекратени преди периода на отчета";
$artexter[3]= "образувани след периода на отчета";
$artexter[4]= "няма дължими суми по изпълнит.лист";

# операциите при погасяване - от cazobala.php 
$opertext= array();
$opertext[1]= "към.момента";
$opertext[2]= "мес.вноска";
$opertext[3]= "дълг";
$opertext[4]= "погасяване";
$opertext[5]= "олихвяване";
$opertext["ap"]= "аванс.вноска";
	$IDOPERCURR= 1;
	$IDOPERINTE= 5;
$smarty->assign("OPERTEXT", $opertext);
# индекс на операцията за погасяване 
# съгласувано с $balaoper[4]= "погасяване" - cazobala.php 
	$OPERMINU= 4;
$smarty->assign("OPERMINU", $OPERMINU);

# заглавия за колоните 
$textcolo= array();
$textcolo["c5fee"]= "т.26";
//$textcolo["c5dru"]= "дрЧСИ";
$textcolo["c5dru"]= "други";
$textcolo[5]= "такси";
$textcolo[6]= "доп.разн";
$textcolo[7]= "приети.др";
$textcolo[8]= "лихви";
$textcolo[9]= "изп.лист";
//$textcolo[10]= "добров";
$smarty->assign("TEXTCOLO", $textcolo);
				$ar2colospec= array("c5fee","c5dru");	
		$textc2= $textcolo;
//		unset($textc2["c5fee"]);
//		unset($textc2["c5dru"]);
		foreach($textcolo as $coin=>$x2){
			if (in_array($coin,$ar2colospec)){
				unset($textc2[$coin]);
			}else{
			}
		}
$smarty->assign("TEXTCOLOHE", $textc2);

/***
# тип/подтип за дълга - към колони отчет 2 
# съгласувано с $listsubjtype и $listsubjst - commspec.php 
$rep2col= array();
	$rep2col["1/0"]=  "9";
	$rep2col["3/0"]=  "9";
	$rep2col["5/0"]=  "9";
$rep2col["2/4"]=  "9";
$rep2col["2/8"]=  "5";
$rep2col["2/12"]= "5";
$rep2col["2/16"]= "6";
$rep2col["2/18"]= "7";
$rep2col["2/20"]= "7";
	$rep2col["t26"]=  "5";
	$rep2col["lih"]=  "8";
***/

#-------------- актуални променливи за периода -------------------

# текста за периода 
$arpe= explode("-",$period);
$smarty->assign("ARPERI", $arpe);
# име на таблицата с данните 
# година, нач. и краен месец 
if (count($arpe)==2){
	$tarepo= str_replace("-","_",$period);
	$peyear= $arpe[0];
	$pemon1= ($arpe[1]==1) ? 1 : 7;
	$pemon2= ($arpe[1]==1) ? 6 : 12;
}else{
	$tarepo= $period;
	$peyear= $period;
	$pemon1= 1;
	$pemon2= 12;
}
# другите таблици 
		$temp1= $tarepo."_befo";
		$temp2= $tarepo."_duri";
		$temp3= $tarepo."_subj";
//		$temp4= $tarepo."_fina";
		$temp4= $tarepo."_calc";
//var_dump($tarepo);
//print "[$tarepo][$peyear][$pemon1][$pemon2]";
		$fumon1= str_pad($pemon1,2,"0",STR_PAD_LEFT);
		$fumon2= str_pad($pemon2,2,"0",STR_PAD_LEFT);
		$yemon1= "$peyear-$fumon1";
		$yemon2= "$peyear-$fumon2";
//print "[$yemon1][$yemon2]";

/***
# филтри за табл.subject - $filtsubj1 $filtsubj2 $filtsubj3 
	# филтър-1 : типа/подтипа да са по изп.лист - за кол.1 и 2 
	$filtsubj1= "subject.idtype in (1,3,5) or subject.idtype=2 and subject.idsubtype=4";
	# филтър-2 : само включените дела 
//	$filtsubj2= "`$tarepo`.idcase is not null";
	$filtsubj2= "`$tarepo`.iderror=0";
	# филтър-3 : само предмети с НЕприсъединен взискател 
	$filtsubj3= "claimer.isjoin=0";
***/
		# 25.02.2016 - след писмо от Дичев за изключване на НАП/общини като вторичен взискател 
		# филтри за табл.subject - $filtsubj1 $filtsubj2 $filtsubj3 
		# филтър-1 за кол.1 и 2 : всички олихв.суми и неолихв.от подтип изп.лист, акт или наказ.постановл. 
//	$filtsubj1= "subject.idtype in (1,3,5) or subject.idtype=2 and subject.idsubtype=4";
		$filtsubj1= "subject.idtype in (1,3,5) or subject.idtype=2 and subject.idsubtype in (4,30,34)";
		# филтър-2 : само включените дела 
		$filtsubj2= "`$tarepo`.iderror=0";
		# филтър-3 : взискателя за предмета да е или първичен взискател, или не НАП/община 
//	$filtsubj3= "claimer.isjoin=0";
							$nap1tx= toutf8("нап");
							$nap2tx= toutf8("национална агенция");
							$nap3tx= toutf8("напоителни");
							$nap4tx= toutf8("община");
		$filtsubj3= "
claimer.id in 
	(select min(id) from claimer as t2 where t2.idcase=claimer.idcase)
or !(
	(claimer.idtype=1 or claimer.idtype=3) 
	and (
		(lower(claimer.name) like '%$nap1tx%' or lower(claimer.name) like '%$nap2tx%') and (lower(claimer.name) not like '%$nap3tx%')
		or
		lower(name) like '%$nap4tx%'
	)
)
			";

# MySQL код - в коя колона на отчета да се запише дълж.сума - кол.1а или кол.2 
//$mycodefielname= "if(substring(`$tarepo`.created,1,7)<'$yemon1' ,'c1full','c2') as debtfiname";
$mycodefielname= "if(substring(`$tarepo`.created,1,7)<'$yemon1' ,'c1full','c2')";

# филтри за табл.finance - $filtfina1 $filtfina2 $filtfina3 
	# филтър-1 : само приключените погасявания 
	$filtfina1= "finance.isclosed=1";
	# филтър-2 : само за включените дела 
	$filtfina2= "`$tarepo`.iderror=0";
// ????????????????????
//	# филтър-3 : само за предмети с НЕприсъединен взискател 
//	$filtfina3= "claimer.isjoin=0";
	$filtfina3= "1";


function creafrom($tasour,$taresu,$extra=""){
global $DB;
//print "<br>creafrom=[$tasour][$taresu]";
	$arctab= $DB->query("show create table `$tasour`");
	$ctcode= $arctab[0]["Create Table"];
//print_rr($arctab);
//var_dump($ctcode);
	$DB->query("drop table if exists `$taresu`");
//	$DB->query("create $extra table `$taresu` select * from `$tasour`");
	$ctcode= str_replace("`$tasour`","`$taresu`",$ctcode);
	$DB->query($ctcode);
}


function nextgrou($nextbase,$step,$grou){
global $smarty;
						$nextgrou= $grou +1;
//					$smarty->assign("GROU", $grou);
$smarty->clear_assign("STEP");
					$smarty->assign("STEP", $step);
$smarty->clear_assign("GROU");
					$smarty->assign("GROU", $nextgrou);
						$urlnextgrou= geturl($nextbase."&step=".$step."&grou=".$nextgrou);
$smarty->clear_assign("NEXTURL");
					$smarty->assign("NEXTURL", $urlnextgrou);
}


/*
# връща статус на погасяването според датата 
#    1= преди периода 
#    2= през периода 
#    3= след периода 
function getpayvari($date){
global $yemon1, $yemon2;
	$yemo= substr($date,0,7);
	if ($yemo < $yemon1){
return 1;
	}elseif ($yemo > $yemon2){
return 3;
	}else{
return 2;
	}
}
*/
/***
function getr2col($p1,$p2){
global $rep2col;
	$p1 += 0;
	$p2 += 0;
	$ind2= $p1+'/'+$p2;
return $rep2col[$ind2];
}
***/

?>