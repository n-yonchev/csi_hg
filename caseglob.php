<?php
# извеждане на глобален списък дело - деловодител 
# източник : 
#    oure.php - извеждане на изходящ регистър 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
# няма страница - всичко е на един екран 
//print_r($GETPARAM);

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

//# текущата страница 
//$page= $GETPARAM["page"];
//$page= isset($page) ? $page : 1;

# шаблона 
$tpname= "caseglob.tpl";

# годината  
	unset($listyear[0]);
	$arke= array_keys($listyear);
$year= $GETPARAM["year"];
$year= isset($year) ? $year : $arke[0];
$smarty->assign("YEAR", $year);
//var_dump($year);

									# евент.отпечатване на текущ.година 
									$print= $GETPARAM["print"];
									if ($print=="yes"){
									}else{

# масива с линкове за годините 
	$baseurl= "mode=".$mode;
		$yearli= array();
foreach ($listyear as $cuyear){
		$yearli[$cuyear]= geturl($baseurl."&year=".$cuyear);
}
$smarty->assign("YEARLIST", $yearli);

# линк за отпечатване на текущата година 
$prntlink= geturl($baseurl."&year=".$year."&print=yes");
$smarty->assign("PRNTLINK", $prntlink);
									}

							$DB->query("lock tables suit write");
# макс.номер за годината 
$maxserial= $DB->selectCell("select max(serial) from suit where year=?d" ,$year);
# четем всички дела за годината 
$mydata= $DB->selectCol("select serial as ARRAY_KEY, iduser from suit where year=?d order by serial" ,$year);
							$DB->query("unlock tables");
//$mydata= dbconv($mydata);
//print_r($mydata);

# фиктивен поледен елемент 
# за да не приключваме послед.елемент веднага след цикъла 
$mydata[$maxserial+1]= -88;
# специален индекс за липсващо дело/дела 
$indxmiss= -7;

# формираме списъка за извеждане 
# изброителен цикъл от номер=1 до фиктив.последен 
			$xxuser= -99;
			$arresu= array();
for($i=1; $i<=$maxserial+1; $i++){
	$cuuser= $mydata[$i];
	if (isset($cuuser)){
	}else{
		$cuuser= $indxmiss;
	}
	if ($cuuser==$xxuser){
	}else{
			# приключваме стария елемент 
			if (isset($newserial)){
				$ar2= array();
				$ar2["ser1"]= $newserial;
				$ar2["ser2"]= $i-1;
				$ar2["iduser"]= $newuser;
				$arresu[]= $ar2;
//print "<br>current===";
//print_r($ar2);
			}else{
			}
			# започваме новия елемент 
			$newserial= $i;
			$newuser= $cuuser;
			# сменяме текущия юзер 
			$xxuser= $cuuser;
	}
}
//print_r($arresu);
								# имената на юзерите 
								$userlist= getselect("user","name","1",false);
								$userlist= dbconv($userlist);
							# заради икономия на място - само първото име и 1-вата буква от следващото 
							foreach($userlist as $usin=>$usco){
								$ar2= explode(" ",$usco);
								$userlist[$usin]= $ar2[0].substr($ar2[1],0,1);
							}
								# специален елемент за липсващи дела 
								$userlist[$indxmiss]= "липсват дела";
$smarty->assign("USERLIST", $userlist);

# извеждане 
$smarty->assign("ARLIST", $arresu);

									# евент.отпечатване на текущ.година 
									$print= $GETPARAM["print"];
									if ($print=="yes"){
# колко реда в колона 
$rowspc= $_POST["rowspc"];
//var_dump($rowspc);
$smarty->assign("ROWSPC", $rowspc);
/*
$content= smdisp($tpname,"fetch");
$smarty->assign("CONTENT", $content);
print smdisp("_print.tpl","iconv");
*/
/**/
# doc download 
$cont= smdisp($tpname,"fetch");
ExcelHeader("разпределение-$year.xls");
	$outp= "
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\" />
<body>
	$cont
</body>
</html>
	";
print $outp;
/**/
									}else{
# нормално извеждане 
$pagecont= smdisp($tpname,"fetch");
									}


?>
