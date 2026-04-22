<?php
# постъпленията, готови за приключване 
#    източник : fina.php 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $page - текущата страница 
#    $codebudg="bud" - код за бюдж.сметка 
//print_rr($GETPARAM);
//print_rr($_POST);

								# функции за финансите 
								include_once "fina.inc.php";
if ($flagbankmass){
}else{
$pagecont= "<br><center>функцията е изключена</center>";
return;
}
								# всичко за преводите 
								include_once "tran.inc.php";

$modeel= "mode=".$mode ."&page=".$page;
$relurl= geturl($modeel);
									# към списъка с преводи - списък постъпления 
									$topaym= $GETPARAM["topaym"];
									# корекция на сметката за избран взискател 
									$claimodi= $GETPARAM["claimodi"];

									# отклонения 
									if (isset($topaym) or isset($claimodi)){
										# обща защита - отделна подготовка 
										if (isset($topaym)){
$cblist= $_SESSION["cboxlist"];
$arfina= explode(",",$cblist);
	$idfina= substr($arfina[0],2);
$rofina= getrow("finance",$idfina);
	$idcase= $rofina["idcase"];
										}else{
										}
										if (isset($claimodi)){
$roclai= getrow("claimer",$claimodi);
	$idcase= $roclai["idcase"];
										}else{
										}
										# обща защита 
//var_dump($idcase);
////$modeel= "mode=".$mode ."&page=".$page;
////$relurl= geturl($modeel);

#--------------------------------------------------------------------------
# защита за дело $idcase, източник : tranfina.inc.php 
//$modeel= "mode=".$mode ."&page=".$page ."&idcase=".$idcase;
$curruser= $_SESSION["iduser"];
									$DB->query("lock tables tranlock write, user read");
									$rouser= getrow("user",$curruser);
	$lockuser= $DB->selectCell("select iduser from tranlock where iduser<>?d and mode=? and idcase=?d"  ,$curruser,$mode,$idcase);
									$rouserlock= getrow("user",$lockuser);
//print "[$curruser][$lockuser]";
	if ($lockuser==0){
		# няма влязъл друг юзер 
	}elseif ($rouser["type"]==ADMINTYPE and $rouser["created"]==ADMINSPECTIME){
		# влиза спец.админ - шунт 
$smarty->assign("NAMELOCKED", $rouserlock["name"]);
	}else{
		# има влязъл друг юзер 
									$DB->query("unlock tables");
$rouserlock= getrow("user",$lockuser);
$lockname= $rouserlock["name"];
		print toutf8("
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
</head>
<div align=center style='background-color:skyblue;font:normal 10pt verdana;padding:10px;'>
делото е заето от 
<br>
$lockname
<br>
</div>
		");
reload("parent",$relurl);
exit;
/***
		$forcing= $GETPARAM["forcing"];
		if ($forcing=="yes"){
				$DB->query("update tranlock set mode='', idcase=0 where iduser=?d"  ,$lockuser);
			# предпазва от forcing при рефреш на браузера 
$relurl= geturl($modeel);
reload("",$relurl);
		}else{
			# предупреждение 
			$rouserlock= getrow("user",$lockuser);
				$casedata= array();
			$casedata["lockname"]= $rouserlock["name"];
			$casedata["linkforc"]= geturl($modeel."&forcing=yes");
									$DB->query("unlock tables");
$smarty->assign("CASEDATA", $casedata);
			$rocase= getrow("suit",$idcase);							
$smarty->assign("ROCASE", $rocase);
$contvari= smdisp("trancaselocked.tpl","fetch");
# извеждане 
$smarty->assign("CONTVARI", $contvari);
$pagecont= smdisp("trango.tpl","fetch");
return;
		}
***/
	}
# регистрираме влезлия юзер 
		if ($rouser["type"]==ADMINTYPE and $rouser["created"]==ADMINSPECTIME){
		}else{
$DB->query("update tranlock set mode=?, idcase=?d where iduser=?d"  ,$mode,$idcase,$curruser);
		}
									$DB->query("unlock tables");
$smarty->assign("FROMLISTTOPAYM", true);
#--------------------------------------------------------------------------

										# отделни отклонения 
										if (isset($topaym)){
											include_once "tranfitopaym.ajax.php";
											exit;
										}else{
										}
										if (isset($claimodi)){
											include_once "tranfiedit.ajax.php";
											exit;
										}else{
										}

									# край отклонения 
									# if (isset($topaym) or isset($claimodi)){
									}else{
									}

# отделно отклонение 
# 14.03.2013 КРЪПКА върни на деловодителя за корекция 
									$finaback= $GETPARAM["finaback"];
									if (isset($finaback)){
$DB->query("update finance set isclosed=0, istran=0, time=now() where finance.id=?d"  ,$finaback);
reload("",geturl($modeel));
									}else{
									}
						


# списъка със странициране 
					include "pagi.class.php";
$qutranpage= "$qutran where $basefilt order by finance.time, finance.id";
//$qutranpage= "$qutran where $basefilt order by finance.idcase, finance.time, finance.id";
		$prefurl= "";
//		$baseurl= "mode=".$mode ."&filtpara=".$filtpara;
		$baseurl= "mode=".$mode;
//@@@		$obpagi= new paginator(24, 8, $qutranpage);
		$obpagi= new paginator(60, 8, $qutranpage);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);

//		$modeel= "mode=".$mode ."&page=".$page ."&filtpara=".$filtpara;
$modeel= "mode=".$mode ."&page=".$page;

# подготовка 
			$arcase= array();
			$arfina= array();
			$artran= array();
foreach($mylist as $indx=>$elem){
			$idfina= $elem["id"];
			$idcase= $elem["idcase"];
				if (isset($arcase[$idcase])){
				}else{
			$arcase[$idcase]= array("caseseri"=>$elem["caseseri"], "caseyear"=>$elem["caseyear"], "username"=>$elem["username"]);
				}
			$arfina[$idcase][$idfina]= $elem;
//			$artran[$idcase]= $ardata;
							# 14.03.2013 КРЪПКА върни на деловодителя за корекция 
							$arfina[$idcase][$idfina]["finaback"]= geturl($modeel."&finaback=".$idfina);
	$ardata= gettrandata($idfina);
//print_ru($ardata);
	foreach($ardata as $idclai=>$elem){
			$artran[$idcase][$idclai]["suma"] += $elem["suma"];
			$artran[$idcase][$idclai]["clainame"]= $elem["clainame"];
$artran[$idcase][$idclai]["claimodi"]= geturl($modeel."&claimodi=".$idclai);
			$artran[$idcase][$idclai]["iban"]= $elem["iban"];
						# IBAN контр.число (2 цифри) 
						$chresu= ibancheck($elem["iban"]);
						if ($chresu===true){
						}else{
			$artran[$idcase][$idclai]["ibaniser"]= true;
						}
	}
}
//print_ru($artran);
								$arcaid= array();
foreach($arcase as $idcase=>$elem){
								$arcaid[]= $idcase;
			$arcase[$idcase]["link"]= geturl($modeel."&idcase=".$idcase);
}
$smarty->assign("ARCASE", $arcase);
$smarty->assign("ARFINA", $arfina);
$smarty->assign("ARTRAN", $artran);

								if (empty($arcaid)){
									$codein= "0";
								}else{
									$codein= implode(",",$arcaid);
								}
# заключени дела 
$arlock= $DB->selectCol("
	select tranlock.idcase as ARRAY_KEY, user.name 
	from tranlock
	left join user on tranlock.iduser=user.id
	where tranlock.mode=?
	",  $mode);
$arlock= dbconv($arlock);
$smarty->assign("ARLOCK", $arlock);

# линк - към списък преводи 
$smarty->assign("CBTOPAYM", geturl($modeel."&topaym=0"));


# извеждане 
//$smarty->assign("LIST", $mylist);
$pagecont= smdisp("trangolist.tpl","fetch");

?>