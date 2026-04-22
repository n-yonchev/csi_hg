<?php
# 3-то ниво - 
# финансовата история на текущия предмет на изпълнение 
# вика се с include от subjpaym.php 
# отгоре : 
#     $subj - subj.id - текущия предмет на изп. 
#     $mylist - двумерен масив с плащанията по този предмет - от dbsimple 
#     $arperc - двумерен масив с лихвените проценти по периоди 
#     $ismonthly - флаг - дали дълга е с месечна периодичност - мес.вноски 
#          приемаме, че вноската се прави на 1во число всеки месец 
#     $rosubj - записа с предмета на изпълнение 

# 13.01.2011 - месечна неолихвяема сума =5 
$ismonthly= ($rosubj["idtype"]==3 or $rosubj["idtype"]==5);
//print_rr($rosubj);
//var_dump($ismonthly);

# флага за отпечатване 
$prinyes= $GETPARAM["print"];
$flprin= ($prinyes=="yes");
$smarty->assign("FLPRIN", $flprin);


#------ ЕТАП 1 -------------------------------------------------------------------------- 
# формираме 3-мерен работен масив : 
#     индекс-1 : дата 
#     индекс-2 : тип трансформация за тази дата 
#         = 0 - само запис (начало) 
#         = 1 - олихвяване 
#         = 2 - месечна вноска 
#         = 3 - погасяване 
#    съдържание : асоц.масив с елементи : трансформация на главницата, трансформация на лихвата 
				$arwork= array();

# начало - само нач.дата на предмета 
//$rosubj= getrow("subject",$subj);
$begdate= $rosubj["fromdate"];
						if ($ismonthly){
							# 16.12.2009 
							# за месечна сума - частична сума за 1-вия месец 
							$fisuma= sumreduce($rosubj["amount"],$begdate,"toend");
							//$arwork[$begdate][1]= NULL;
							$arwork[$begdate][2]= array($fisuma, 0);
						}else{
							# друга - немесечна сума 
				# трансформации : 
				#    по главницата = плюс сумата на предмета 
				#    по лихвата = 0 
				$arwork[$begdate][0]= array($rosubj["amount"], 0);
						}
# край - олихвяване до днешна дата 
$enddate= date("Y-m-d");
				# трансформации : изчисляват се 
				$arwork[$enddate][1]= NULL;
//print_rr($arwork);
# всички плащания 
# - за всяко плащане формираме 2 елемента : олихвяване до датата и самото погасяване 
//print "MYLIST=";
//print_rr($mylist);
foreach($mylist as $pael){
	# пас-1 : олихвяването до датата на плащане 
				# трансформации : изчисляват се 
				$arwork[$pael["date"]][1]= NULL;
	# пас-2 : погасяването 
				# трансформации : 
				#    по главницата = минус въведеното 
				#    по лихвата = минус въведеното 
				$arwork[$pael["date"]][3]= array( - $pael["tocapi"], - $pael["tointe"]);
}

#------ ЕТАП 2 -------------------------------------------------------------------------- 
# само при месечни вноски 
# - добавяме вноски на всички 1-ви числа на месеците между началото и края 
# - за начало вземаме следв.месец, за край - точния месец 
# - за всяка вноска формираме 2 елемента : олихвяване до датата и самото погасяване 
if ($ismonthly){
	list($begye,$begmo,$begda)= explode("-",$begdate);
	list($endye,$endmo,$endda)= explode("-",$enddate);
							# 15.12.2009 - вече има евент.крайна дата при мес.вноска 
							$todate= $rosubj["todate"];
//print "todate=[$todate]";
							if (empty($todate)){
							}else{
								$enddate= $todate;
								list($endye,$endmo,$endda)= explode("-",$todate);
//print "enddate=[$enddate]";
							}
			$currye= $begye;
			$currmo= $begmo;
//print "<br>date=[$begdate][$enddate]";
	while (true){
			$currmo ++;
			if ($currmo<=12){
			}else{
				$currmo= 1;
				$currye ++;
			}
			$currmo= str_pad($currmo,2,"0",STR_PAD_LEFT);
			$currye= str_pad($currye,2,"0",STR_PAD_LEFT);
//print "<br>[$currmo-$currye]";
		$currdate= "$currye-$currmo-01";
		if ($currdate <= $enddate){
	# пас-1 : олихвяването до датата на вноската 
				# трансформации : изчисляват се 
				$arwork[$currdate][1]= NULL;
	# пас-2 : вноската 
				# трансформации : 
				#    по главницата = плюс сумата на предмета 
				#    по лихвата = 0 
				$arwork[$currdate][2]= array($rosubj["amount"], 0);
							# 16.12.2009 
							# ако е последния месец за месечна сума - частична сума за дълга 
							if ($currmo==$endmo and $currye==$endye){
								$ensuma= sumreduce($rosubj["amount"],"$endye-$endmo-$endda","frombegin");
				$arwork[$currdate][2]= array($ensuma, 0);
							}else{
							}
//print "<br>$currdate";
//print_rr($arwork[$currdate]);
		}else{
			break;
		}
	}
//print_rr($arwork);
	$fstamp= mktime(0,0,0,  $mo+1,1,$ye);
	$firstnext= date("Y-m-d",$fstamp);
}else{
}

#------ ЕТАП 3 -------------------------------------------------------------------------- 
# сортираме раб.масив в нарастващ ред на датите - 1во ниво 
//print "<br>HIST===";
//print_rr($arwork);
ksort($arwork);
//print_r($arwork);

#------ ЕТАП 4 -------------------------------------------------------------------------- 
# за всяка дата : 
#    сортираме типовете (2ро ниво) в нарастващ ред 
#    премахваме дублирането на елементи от еднакъв тип 
#        - възможно е дублиране за типа олихвяване 
foreach($arwork as $arindx=>$arelem){
	# сортираме 
	ksort($arelem);
	# премахваме дублирането 
				$newelem= array();
						$previn= -9;
	foreach($arelem as $in2=>$el2){
		if ($in2==$previn){
		}else{
				$newelem[$in2]= $el2;
						$previn= $in2;
		}
	}
	# обновяваме елемента 
	$arwork[$arindx]= $newelem;
}
//print_r($arwork);

#------ ЕТАП 5 -------------------------------------------------------------------------- 
# формираме масив с финансовата история 
# всеки елемент от раб.масив формира ред от историята 
					# историята 
					$arhist= array();
										# глобални променливи 
										$lastdate= "";
										$lastcapi= 0;
										$lastinte= 0;
//print_r($arwork);
//print_rr($arwork);
foreach($arwork as $cudate=>$dateelem){
	foreach($dateelem as $cutype=>$elem2){
		$resuelem= addhistelem ($cudate, $cutype, $elem2[0], $elem2[1]);
	}
}


# общ дълг към момента 
$totalamo= $lastcapi + $lastinte;
$smarty->assign("TOTALAMO", $totalamo);

# назначаваме 
$smarty->assign("ARHIST", $arhist);

# формираме визуалното съдържание 
# без UTF8 трансформация 
//$subjhist= smdisp("subjpaymhist.tpl","iconv");
$subjhist= smdisp("subjpaymhist.tpl","fetch");

# линк за отпечатване на текущата страница 
		$baseurl= "subj=".$subj;
$curint= geturl($baseurl."&print=yes");
$smarty->assign("CURINT", $curint);
//print_r($GETPARAM);

# за извеждането 
$smarty->assign("SUBJHIST", $subjhist);


?>
