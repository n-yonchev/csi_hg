<?php
# назначаване на постъпление към взискател по дело 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $page - текущата страница от списъка с извлеченията 
#    $bapaelem - текущото извлечение 
#    $pageelem - текущата страница от списъка с постъпления в това извлечение 
#    $direcase - избраното постъпление 
//#  $codeneww - MySQL код за нужните записи - входящите недублирани преводи 

# шаблона 
$tpname= "bapaelemdire.ajax.tpl";
# reload - след успешен събмит 
$relurl= geturl("mode=".$mode."&page=".$page."&bapaelem=".$bapaelem."&pageelem=".$pageelem);

									# ако има избран взискател, назначаваме го за това постъпление 
									# и още - копираме двете забележки към плащането 
									# копираме и IBAN/BIC за плащането 
									$direclai= $GETPARAM["direclai"];
										$roclai= getrow("claimer",$direclai);
										$claiba= $roclai["iban"];
										$clabic= $roclai["bic"];
									if (isset($direclai)){
//										$DB->query("update bank set idclaimer=$direclai where id=$direcase");
						//				$DB->query("update bank set idclaimer=$direclai, payrem1=REM_I, payrem2=REM_II
						//				where id=$direcase");
										$DB->query("update bank 
										set idclaimer=$direclai, payrem1=REM_I, payrem2=REM_II, payiban='$claiba', paybic='$clabic'
										where id=$direcase");
//# redirect 
//reload("parent",$relurl);
//exit;
# ВНИМАНИЕ. 
# Преминаваме не 1 ниво нагоре, а на функцията "editpaym" за избраното постъпление 
# - виж bapaelem.php 
$relurl= geturl("mode=".$mode."&page=".$page."&bapaelem=".$bapaelem."&pageelem=".$pageelem  ."&editpaym=".$direcase);
reload("",$relurl);
exit;
									}else{
									}

# четем данните за постъплението 
$robank= getrow("bank",$direcase);

# текущата страница - от списъка с делата 
//print_r($GETPARAM);
$pagecase= $GETPARAM["pagecase"];
$pagecase= isset($pagecase) ? $pagecase : 1;

#---------------------------------------------------------------------------
# форма за филтъра - директно редактиране 
# съхраняваме параметрите в сесията - индекс DIREFILT 

									# класа за редактиране 
									include_once "edit.class.php";

//# входните полета 
//$fili= array("cano","caye","buls","name");

# текущото състояние на формата 
				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	# копираме стойностите от сесията 
	$_POST= $_SESSION["DIREFILT"];
//	foreach($_SESSION["DIREFILT"] as $fina=>fico){
//		$_POST[$fina]= $fico;
//	}

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
	# натиснат е бутона "търси" 
	# съхраняваме стойностите в сесията 
	$_SESSION["DIREFILT"]= $_POST;

#------ submit с формални грешки 
}elseif ($mfacproc==NULL){
							$retucode= 1;
die("elemdire=1");

#------ автоматичен submit -----------------------------------------------------
}elseif ($mfacproc=="UNKNOWN"){
							$retucode= 2;
die("elemdire=2");

#------ невъзможна грешка от библиотеката 
}else{
print "<br>error=mfacproc=";
var_dump($mfacproc);
die();
}

# край на формата за директно редактиране на филтъра 
#---------------------------------------------------------------------------


# списъка с намерените дела - независимо от статуса на формата 
# вземаме филтрите от сесията 
$direfilt= $_SESSION["DIREFILT"];
				#------ формираме елементите на филтъра 
				# източник : casefilt.php 
									# - в 2 масива 
									# за делата - suit 
									$arcase= array();
											# и за участниците - claimer, debtor 
											$armemb= array();
				# номер дело 
				$cano= $direfilt["cano"] +0;
				if (empty($cano)){
				}else{
									$arcase[]= "suit.serial=$cano";
				}
				# година на дело 
				$caye= $direfilt["caye"] +0;
				if (empty($caye)){
				}else{
									$arcase[]= "suit.year=$caye";
				}
				# егн/булстат на взискател/длъжник 
				$buls= $direfilt["buls"];
				if (empty($buls)){
				}else{
					$myco2= "%" .$buls ."%";
					$_bulstat= "upper(bulstat) like upper('$myco2')";
					$_egn= "upper(egn) like upper('$myco2')";
					$likeelem= "case idtype when 1 then ($_bulstat) when 2 then ($_egn) when 3 then 0 else 0 end";
											$armemb[]= $likeelem;
				}
				# име на взискател/длъжник 
				$name= $direfilt["name"];
				if (empty($name)){
				}else{
					$myco2= "%" .$name ."%";
					$likeelem= "upper(name) like upper('$myco2')";
											$armemb[]= $likeelem;
				}
//print_r($arcase);
//print_r($armemb);
				#------ прилагаме филтрите ----------------
# ВНИМАНИЕ. 
# Всички релации на условията са ИЛИ = OR 
				# източник : case.php 
				# първо втория филтър - от подчинените таблици 
				if (empty($armemb)){
//					$filt2= "";
//+++++							$FILTIN= " or 0";
							$FILTIN= "";
												$nothing2= true;
				}else{
//					$filt2= implode(" and ",$armemb);
					$filt2= implode(" or ",$armemb);
							$qum1= "select idcase from claimer where $filt2";
							$qum2= "select idcase from debtor where $filt2";
							$qumemb= "($qum1) union distinct ($qum2)";
						# резултата от заявката 2-ро ниво 
						# - масив с всички дела [suit.id], които отговарят на филтъра 
						$myin= $DB->selectCol($qumemb);
						# формираме доп.филтър за главната заявка 
						if (count($myin)==0){
							# няма нито едно suit.id, което отговаря на филтъра 
							# - главната заявка трябва да върне празен резултат 
//							$FILTIN= " and 0";
//+++++							$FILTIN= " or 0";
							$FILTIN= "";
												//$nothing2= true;
						}else{
							# има suit.id, които отговарят на филтъра 
							# - формираме код за mysql in за главната заявка 
							$exin= implode(",",$myin);
//							$FILTIN= " and suit.id in ($exin)";
//+++++							$FILTIN= " or suit.id in ($exin)";
							$FILTIN= " and suit.id in ($exin)";
						}
				}
				# след него първия филтър - от основната таблица 
				if (empty($arcase)){
//++++++					$filt1= " 0";
					$filt1= " 1";
												$nothing1= true;
				}else{
					# ВНИМАНИЕ. 
					# Тук участват номера на делото и годината, затова релацията е and 
//+++					$filt1= implode(" or ",$arcase);
					$filt1= implode(" and ",$arcase);
				}
//print "filt1=[$filt1]";
//print "filtin=[$FILTIN]";

# странициране заедно с dbsimple [dklab] 
# използваме вече формираните стрингове $FILT1, $FILTIN 
					include "pagi.class.php";
												//var_dump($nothing1);
												//var_dump($nothing2);
												if ($nothing1===true and $nothing2===true){
$query= "select * from suit order by id";
												}else{
$query= "select * from suit where $filt1 $FILTIN order by id";
												}
//		$prefurl= "";
//		$baseurl= "mode=".$mode ."&filt=".$filt;
//print "[$mode][$page][$bapaelem][$pageelem][$direcase]";
$prefurl= "";
$baseurl= "mode=".$mode."&page=".$page."&bapaelem=".$bapaelem."&pageelem=".$pageelem."&direcase=".$direcase;
		$obpagi= new paginator(10, 8, $query);
//		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
		# ВНИМАНИЕ. 
		# използваме специалния 4-ти параметър - заради рекурсивното използване 
		$mylist= $obpagi->calculate($pagecase, $prefurl, $baseurl    ,"pagecase");
$mylist= dbconv($mylist);

										if (empty($mylist)){
										}else{
#---- формираме масиви за взискателите и длъжниците 
# списък - id на делата от страницата 
		$arid= array();
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
		$arid[]= $idcurr;
}
		$codein= implode(",",$arid);
# заявките 
$qucode= "select id,idcase ,idtype,egn,bulstat,name from %s where idcase in ($codein)";
$qudebt= sprintf($qucode,"debtor");
$quclai= sprintf($qucode,"claimer");
$mydebt= $DB->select($qudebt);
	$mydebt= dbconv($mydebt);
$myclai= $DB->select($quclai);
	$myclai= dbconv($myclai);
# трансформираме списъка на взискателите 
# добавяме линк за иконата, с която се насочва към този взискател 
				$modeel= $baseurl;
foreach ($myclai as $indx=>$mycont){
				$idclai= $mycont["id"];
	$myclai[$indx]["direclai"]= geturl($modeel."&direclai=".$idclai);
}
# групираме данните в 2-мерни масиви - по дела 
		$cadebt= array();
foreach($mydebt as $indx=>$cont){
	$mycase= $cont["idcase"];
		$cadebt[$mycase][]= $cont;
}
		$caclai= array();
foreach($myclai as $indx=>$cont){
	$mycase= $cont["idcase"];
		$caclai[$mycase][]= $cont;
}
										# if (empty($mylist)){
										}
# за извеждане 
$smarty->assign("ARDEBT", $cadebt);
$smarty->assign("ARCLAI", $caclai);



# извеждаме 
							# за извеждане на "идва от" - кеширания масив 
							$arfrom= unserialize(file_get_contents(COFROMFILE));
							# предаваме съдържанието 
							$smarty->assign("ARFROM", $arfrom);
						# за избор на година [caye] - предаваме името, а не съдържанието на масива 
						# $listyear - отгоре - commspec.php 
						$smarty->assign("ARYEARNAME", "listyear");

# извеждаме формата 
$smarty->assign("CASEDATA", $mylist);
$smarty->assign("HEADDATA", $robank);
print smdisp($tpname,"iconv");


?>
