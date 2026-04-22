<?php
# отгоре : 
#    $iduser - логнатия потребител 
#    $edit= case.id за модифициране 
#    $zone= paym 
#    $func= modi 

# входни параметри 
# $idel - cash.id на прих.касов ордер 
$idel= $GETPARAM["idel"];
//print "correction [$edit][$zone][$func]idel=[$idel]";
//print_r($GETPARAM);

# шаблона 
$tpname= "cazopaymdist.ajax.tpl";
# константни полета 
$ficonst= array("idcase"=>$edit);


# данните от прих.ордер (сумата) 
$rocash= getrow("cash",$idel);
# по дълга на кой длъжник 
$rodebt= getrow("debtor",$rocash["iddebtor"]);
# предаваме ги 
$smarty->assign("HEADDATA", array("amou"=>$rocash["amount"], "name"=>$rodebt["name"]));

#---- основни параметри при празпределението 
# сума за разпределение 
$distamou= $rocash["amount"];
# id на длъжника 
$iddebtor= $rocash["iddebtor"];
//print "[$distamou][$iddebtor]";

							# четем списъка с лихвените проценти по периоди 
							$arperc= $DB->select("select * from percent order by id");
				
												# всички функции за финансовата история 
												# необходими за subjpaymhist.php 
												include_once "subjpaymhist.inc.php";

# етап-1 : --------------------------
# формираме списък с предметите на изпълнение по текущото дело с 2 условия - $myli2 
#     - които са парични : 
#         idtype= 1= еднократна олихв.сума 2= неолихвяема 3=месечна олихв. 
#     - и по които длъжник е нашия 
$mysubj= $DB->select("select * from subject where idcase=$edit order by id");
$mysubj= dbconv($mysubj);
# подбираме само паричните, по които длъжник е нашия 
			$artype= array(1,2,3);
			$myli2= array();
												# паралелно формираме масив с общите суми, подлежи на погасяване 
												# по типове погасяване 
												# индекси : 1=неолихв. 2=лихви 3=главници 
												$suplan= array();
foreach($mysubj as $myin=>$myco){
	$arlide= explode(",",$myco["listdebtor"]);
	if (in_array($myco["idtype"],$artype) and in_array($iddebtor,$arlide)){
						# изчисляваме натрупания дълг по текущия предмет вкл.лихвите 
						# източник : subjpaymhist.php 
						# ВНИМАНИЕ. 
						#     Имената са част от интерфейса, тези имена са задължителни. 
							# $arperc - двумерен масив с лихвените проценти по периоди 
							# $subj   - subject.id - текущия предмет на изп. 
							# $mylist - двумерен масив с плащанията по този предмет - от dbsimple 
							# $ismonthly - флаг - дали дълга е с месечна периодичност - мес.вноски 
							#      приемаме, че вноската се прави на 1во число всеки месец 
							# $rosubj - записа с предмета на изпълнение 
						# източник : subjpaym.php 
							$subj= $myco["id"];
							$rosubj= getrow("subject",$subj);
//print_r($rosubj);
							$subjtype= $rosubj["idtype"];
							$mylist= $DB->select("select * from payment where idsubj=$subj order by id");
							$mylist= dbconv($mylist);
//var_dump($subjtype);
							if ($subjtype==1 or $subjtype==3){
								# олихвяема сума 
								$ismonthly= ($subjtype==3);
												# не е include_once - за да се изпълни многократно в цикъла 
												include "subjpaymhist.php";
								# получихме $lastcapi, $lastinte 
								$myco["lastcapi"]= $lastcapi;
								$myco["lastinte"]= $lastinte;
												# сумираме към масива с подлежащите на погасяване 
												$suplan[3] += $lastcapi;
												$suplan[2] += $lastinte;
							}else{
#--------- ТРЯБВА ДА ИМА АНАЛОГИЧНО ИЗЧИСЛЕНИЕ И ЗА ТИП НЕОЛИХВ.СУМА --------------------
# временно слагаме самата начална сума 
$planamou= $myco["amount"];
$myco["lastamou"]= $planamou;
												# сумираме към масива с подлежащите на погасяване 
												$suplan[1] += $planamou;
							}
			# попълваме резулт.масив - с поредно индексиране 
//			$myli2[$myin]= $myco;
			$myli2[]= $myco;
	}else{
	}
}
//print_r($myli2);
$smarty->assign("DATA", $myli2);

# етап-2 : --------------------------
# формираме масив с макс.възможните суми за погасяване - $sumaxi 
# и паралелен масив със съотношението макс.възможна / подлежаща - $sucoef 
# по типове погасяване 
# индекси : 1=неолихв. 2=лихви 3=главници 
												$sumaxi= array();
														$sucoef= array();
$realamou= $distamou;
$flagok= false;
			# трябва да погасяваме в нарастващ ред на типовете : 1=неолихв. 2=лихви 3=главници 
			# тип=1=неолихвяеми е с най-висок приоритет 
			# затова задължително сортираме в нарастващ ред на индексите 
			# в противен случай ще се запази случайния ред при формирането на масива 
			asort($suplan);
foreach($suplan as $inplan=>$coplan){
	$sumini= min($realamou,$coplan);
												$sumaxi[$inplan]= $sumini;
														$flzero= ($suplan[$inplan]==0);
														$sucoef[$inplan]= $flzero ? 0 : $sumaxi[$inplan] / $suplan[$inplan];
	$realamou -= $sumini;
	if ($realamou<=0){
		$flagok= true;
		break;
	}else{
	}
}
if ($flagok){
}else{
	# сумата за разпределение надвишава общия дълг 
	$smarty->assign("TEXTMESS", "сумата за разпределение надвишава общия дълг");
}
//print_r($suplan);
//print_r($sumaxi);

# етап-3 : --------------------------
# за всеки предмет на изпълнение определяме реалната сума за погасяване според типа 
# формираме масив с 2 индекса : 
#     инд.1= типа погасяване 1=неолихв. 2=лихви 3=главници 
#     инд.2= subject.id - предмета на изпълнение 
#     съдържание= разпределената сума за погасяване 
					$sudist= array();
										# при умножаването по коефициента се получават суми, 
										# които изискват закръгляване до стотинки 
										# закръгляването може да доведе до несъвпадение на крайната сума 
										# затова последната сума за погасяване от всеки тип 
										# определяме не чрез коефициента, 
										# а като разлика между макс.възможната и натрупаната до момента 
										# за опростяване приемаме за последна всяка сума от даден тип, 
										# която след натрупване или покрива максималната, или се различава малко от нея 
										# приемаме малкото отклонение = 10 стотинки 
										$step= 0.10;
										# натрупани суми по типове = 1,2,3 
										$suaccu= array();
foreach($myli2 as $myin=>$myco){
	$idsubj= $myco["id"];
	# тип=1 - неолихяв. 
	if (isset($myco["lastamou"])){
//					$sudist[1][$idsubj]= $myco["lastamou"] * $sucoef[1];
					$suwork= $myco["lastamou"] * $sucoef[1];
					$suwork= round($suwork,2);
										$suaccu[1] += $suwork;
										$suwork= getsudiff($suwork,1);
					$sudist[1][$idsubj]= $suwork;
	}else{
	}
	# тип=2 - лихва 
	if (isset($myco["lastinte"])){
//					$sudist[2][$idsubj]= $myco["lastinte"] * $sucoef[2];
					$suwork= $myco["lastinte"] * $sucoef[2];
					$suwork= round($suwork,2);
										$suaccu[2] += $suwork;
										$suwork= getsudiff($suwork,2);
					$sudist[2][$idsubj]= $suwork;
	}else{
	}
	# тип=3 - главница 
	if (isset($myco["lastcapi"])){
//					$sudist[3][$idsubj]= $myco["lastcapi"] * $sucoef[3];
					$suwork= $myco["lastcapi"] * $sucoef[3];
					$suwork= round($suwork,2);
										$suaccu[3] += $suwork;
										$suwork= getsudiff($suwork,3);
					$sudist[3][$idsubj]= $suwork;
	}else{
	}
}
$smarty->assign("SUDIST", $sudist);




#----------------- край на директното редактиране -----------------------
/*
# резултат 
if ($retucode==0){
	# redirect 
	$smarty->assign("EXITCODE", getnyroexit("tpaymlink"));
	print smdisp($tpname,"iconv");
}else{
	# извеждаме формата 
	$smarty->assign("EDIT", $idel);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
//	$pagecont= smdisp($tpname,"iconv");
}
*/
						# за извеждане на тип - пълно 
						# предаваме съдържанието на масива 
						$smarty->assign("ARTYPE", $listsubjtype);
						# за извеждане на взискател - четем списъка с взискатели по делото 
						$arclai= getselect("claimer","name","idcase=$edit",false);
						$arclai= dbconv($arclai);
						# предаваме съдържанието на масива 
						$smarty->assign("ARCLAI", $arclai);

# допълнителни js линкове за секцията head 
//$smarty->assign("HEADJS", array("jquery.dimentions.js","cluetip.hoverIntent.js","jquery.cluetip.js"  ,"_cazo34modi.js"));
$smarty->assign("HEADJS", array("cluetip.hoverIntent.js","jquery.cluetip.js"));

	# извеждаме формата 
	$smarty->assign("EDIT", $idel);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");




# връща трансформирана сума за погасяване от даден тип 
function getsudiff($suma,$type){
global $step, $suaccu, $sumaxi;
	$diff= $suaccu[$type] - $sumaxi[$type];
	# ако натрупаната сума е по-голяма от максималната, приспадаме разликата 
	if ($diff > 0){
		$suaccu[$type]= $sumaxi[$type];
return $suma - $diff;
	# ако натрупаната сума е по-малка от максималната, но с не-повече от малкото отклонение $step, 
	# допълваме с разликата 
	}elseif ($diff<0 and $diff>=-$step){
return $suma - $diff;
	}else{
return $suma;
	}
}

?>
