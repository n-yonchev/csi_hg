<?php


# 19.07.2010 - участват и вноските по аванс.такси от взискателите 
function complist($p1,$p2){
	if ($p1["date"]==$p2["date"]){
		if ($p1["oper"]==="ap"){
			if ($p2["oper"]==="ap"){
return 0;
			}else{
				if ($p2["oper"]>=4){
return 1;
				}else{
return -1;
				}
			}
		}else{
			if ($p2["oper"]==="ap"){
				if ($p1["oper"]>=4){
return -1;
				}else{
return 1;
				}
			}else{
				if ($p1["oper"]==$p2["oper"]){
return 0;
				}else{
return $p1["oper"]>$p2["oper"] ? -1 : 1;
				}
			}
		}
	}else{
return $p1["date"]>$p2["date"] ? 1 : -1;
	}
}
//oubali();

# функция - добавя елемент към списъка, евент. и за олихвяване 
function addelem($elem){
global $balist, $isperc;
//global $balist, $elem, $uscont, $isperc;
//				$elem["date"]= $p1date;
							# добавяме елемента за дълг 
							$balist[]= $elem;
//print "<br>----------- elem-begin ------------<br>";
//print_r($elem);
//print "<br>----------- elem-end ------------<br>";
	# и евентуално елемент за олихвяване 
	# независимо дали предишната сума е дълг или постъпление 
	if ($isperc){
											# копираме в нов масив 
											# оставяме съдържанието на елемента - без движението 
											# движението ще бъде по лихва и ще се изчисли след сортировката по дата 
											#   - признак за изчисляване : [amou]=="no" 
											#   - за идентификация на бъдещото движение добавяме и id на взискателя 
											$e2= $elem + array();
											unset($e2["move"]);
global $idclai;
											$e2["idclai"]= $idclai;
										$e2["oper"]= 5;
										$e2["desc"]= "";
										$e2["amou"]= "no";
							$balist[]= $e2;
	}else{
	}
}


# аритметика с масиви 
#    $arfirst - първичен масив - by reference ! 
#    $action - действие + или - 
#    $arsecond - вторичен масив 
# не връща резултат, първичния масив е променен 
function araction(&$arfirst,$action,$arsecond){
//print "<br>----------------";
	foreach($arsecond as $idclai=>$arclai){
										if (is_array($arclai)){
		foreach($arclai as $vaname=>$vacont){
			if ($action=="-"){
				$vacont= - $vacont;
			}else{
			}
//+++			$arfirst[$idclai][$vaname] += $vacont;
			$arfirst[$idclai][$vaname] += round($vacont,2);
		}
										}else{
			$vacont= $arclai;
			if ($action=="-"){
				$vacont= - $vacont;
			}else{
			}
//+++			$arfirst[$idclai] += $vacont;
			$arfirst[$idclai] += round($vacont,2);
										}
	}
//return $arfirst;
}


# формираме колоните "общо" - за всеки взискател 
function puttotal($bain,$nameto){
global $balist;
//	foreach($balist as $bain=>$baelem){
		$baelem= $balist[$bain];
		if (isset($baelem[$nameto])){
			foreach($baelem[$nameto] as $idclai=>$claielem){
													if (is_array($claielem)){
								$sumtotal= 0;
				foreach($claielem as $content){
								$sumtotal += $content;
				}
								$balist[$bain][$nameto][$idclai]["total"]= $sumtotal;
													}else{
													}
			}
		}else{
		}
//	}
}

# формираме процентите на погасяване - по взискатели 
function putpercpaid($bain,$nam1,$nam2){
global $balist;
		$baelem= $balist[$bain];
		$con1= $baelem[$nam1];
		$con1= (isset($con1)) ? $con1 : array();
		$con2= $baelem[$nam2];
		$con2= (isset($con2)) ? $con2 : array();
			# заради пълния списък на индексите - възложителите 
			$wor1= $con1 + $con2; 
//print_rr($wor1);
//print_rr($con1);
//print_rr($con2);
//print "<br>$bain";
//print_rr(array_keys($con1));
//print_rr(array_keys($con2));
		foreach($wor1 as $idclai=>$x2){
//print "<br>$bain=idclai=[$idclai]";
									# пропускаме условните взискатели [taxamo] и [intelink] 
									# ВНИМАНИЕ. релацията е ===, за да не се обработи $idclai===0 [ЧСИ] 
									if ($idclai==="taxamo" or $idclai==="intelink"){
										continue;
									}else{
									}
			$percpaid= diviperc($con2[$idclai]["total"],$con1[$idclai]["total"]);
								$balist[$bain]["percpaid"][$idclai]= $percpaid;
//print "<br>[$bain][percpaid][$idclai]=$percpaid";
		}
}

# процент чрез деление 
function diviperc($p1,$p2){
//var_dump($p1);
//var_dump($p2);
	if ($p2+0==0){
return "???";
	}else{
return round(100*$p1/$p2);
	}
}


# разнасяне на сума по масив от индекси - до изчерпването й 
#      $balist  - входен и резултатен масив с данни 
#      $bain    - 1-вичния му индекс 
#      $idclai  - 2-ричния му индекс - взискателя
#      $arindex - масива с индекси 
#      $amount  - сумата за разнасяне 
function payoffdist(&$balist,$bain,$idclai,$arindex,$amount){
	if ($amount+0 ==0){
return;
	}else{
	}
//print_r($arindex);
//print "<br>------------------razpred=[$amount][$idclai]";
				$cuam= $amount;
	foreach($arindex as $currindx){
//					$elemprev= $balist[$bain -1];
		$resuelem= $balist[$bain-1]["resu"][$idclai][$currindx];
		$mini= min($cuam+0,$resuelem+0);
//print "<br>payoffdist=[$currindx][$idclai][$resuelem][$cuam][$mini]";
//print "<br>value=[$bain][move][$idclai][$currindx]= $mini";
$balist[$bain]["move"][$idclai][$currindx]= $mini;
				$cuam -= $mini;
//print "mini=[$mini]";
	}
//print_r($balist[$bain]["move"]);
	if ($cuam<=0){
	}else{
# 18.12.2009 
# оправена важна грешка - добавяме, а не присвояваме остатъка 
# - виж дело 4909/2009 Бъзински 
$currindx= $arindex[count($arindex)-1];
//$balist[$bain]["move"][$idclai][$currindx]= $cuam;
$balist[$bain]["move"][$idclai][$currindx] += $cuam;
	}
}

# само за тестване 
function oubali(){
global $balist;
print "<br>------balist------";
	foreach($balist as $indx=>$elem){
		$oper= $elem["oper"];
		$date= $elem["date"];
		$amou= $elem["amou"];
		$id= $elem["id"];
print "<br>$indx= [$amou][$oper][$date][$id]";
	}
}




# трансформира липсваща дата 
function gettrandate($uscodate,$type){
						#--------------------------------------------------
						# 11.02.2011 КРЪПКА. 
//						$uscodate= $uscont["date"];
						if (empty($uscodate)){
							if (0){
							}elseif ($type=="toend"){
global $rocase;
								if (isset($rocase)){
//++++++++print "<br>rocase=toend=OK=";
//print_rr($rocase);
									$uscodate= substr( $rocase["created"] ,0,10);
//++++++++print "$uscodate";
								}else{
//++++++++print "<br>rocase=toend=notset";
								}
							}elseif ($type=="frombegin"){
									$uscodate= date("Y-m-d");
//++++++++print "<br>rocase=frombegin=$uscodate";
							}else{
die("gettrandate=type=$type");
							}
						}else{
						# if (empty($uscodate)){
						}
//						$uscont["date"]= $uscodate;
						#--------------------------------------------------
return $uscodate;
}


?>
