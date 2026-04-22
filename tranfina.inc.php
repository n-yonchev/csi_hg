<?php
# отгоре : 
#     $idcase - делото 
//print "TRANFINAAAAAAAAAA";
//print_rr($GETPARAM);

#--------------------------------------------------------------------------
# защита за дело $idcase, източник : tran.php  
$modeel= "mode=".$mode ."&page=".$page ."&idcase=".$idcase;
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
	}
# регистрираме влезлия юзер 
		if ($rouser["type"]==ADMINTYPE and $rouser["created"]==ADMINSPECTIME){
		}else{
$DB->query("update tranlock set mode=?, idcase=?d where iduser=?d"  ,$mode,$idcase,$curruser);
		}
									$DB->query("unlock tables");
#--------------------------------------------------------------------------

# филтър за делото 
$filtcase= "finance.idcase=$idcase";
//////print "idcase=[$idcase]";

# линкове за подменюто 
$baco= "mode=$mode&page=$page&idcase=$idcase";
					# специално за извикването от finaus.php 
					if (isset($idsub2)){
$baco .= "&idsub2=$idsub2";
					}else{
					}
			$arsubm= array();
foreach($arfinastat2 as $indx=>$text){
			$arsubm[$indx]["text"]= $text;
			$arsubm[$indx]["link"]= geturl($baco."&idvari=".$indx);
}
$smarty->assign("ARSUBM", $arsubm);
# бройки 
//$arcoun= $DB->selectCol("select $finastatcode as ARRAY_KEY, count(*) from finance where $filtcase group by $finastatcode");
$arcoun= $DB->selectCol("
	select $finastatcode as ARRAY_KEY, count(*) 
	from finance 
	left join finasource on finance.id=finasource.idfinance
	where $filtcase 
	group by $finastatcode
	");
$sucase= array_sum($arcoun);
$arcoun[0]= $sucase;
$smarty->assign("ARCOUN", $arcoun);
//print "arcoun=";
//print_rr($arcoun);

# текущото подменю 
												//if($CALLFROMALTE){
												//}else{
$idvari= $GETPARAM["idvari"];
if (isset($idvari)){
}else{
	foreach($arcoun as $idvari=>$cucoun){
		if ($cucoun==0){
		}else{
			break;
		}
	}
}
												//}
$smarty->assign("IDVARI", $idvari);
# филтър подменю 
$smarty->assign("HEADTX", $arfinastat2[$idvari]);
if ($idvari==0){
	$filtvari= "1";
}else{
	$filtvari= "$finastatcode=$idvari";
}

# основен списък параметри 
$modeel= "mode=$mode&page=$page&idcase=$idcase&idvari=$idvari";
					# специално за извикването от finaus.php 
					if (isset($idsub2)){
$modeel .= "&idsub2=$idsub2";
					}else{
					}
# за връщане 
$relurl= geturl($modeel);
									# корекция на сметката за избран взискател 
									$claimodi= $GETPARAM["claimodi"];
									if (isset($claimodi)){
//$relurl= geturl("mode=".$mode."&vari=".$vari."&page=".$page);
										include_once "tranfiedit.ajax.php";
										exit;
									}else{
									}
									# сметката за избран взискател - бюджетна или не 
									$budgmodi= $GETPARAM["budgmodi"];
									if (isset($budgmodi)){
//$relurl= geturl("mode=".$mode."&vari=".$vari."&page=".$page);
										include_once "tranfibudg.ajax.php";
										exit;
									}else{
									}
									# избрано постъпление - отключване 
									$unlockfina= $GETPARAM["unlockfina"];
									if (isset($unlockfina)){
//$relurl= geturl("mode=".$mode."&vari=".$vari."&page=".$page);
$unlock= $unlockfina;
										include_once "tranfiunlo.ajax.php";
										exit;
									}else{
									}
									# към списъка с преводи - избрано постъпление или списък 
									$topaym= $GETPARAM["topaym"];
									if (isset($topaym)){
//$relurl= geturl("mode=".$mode."&vari=".$vari."&page=".$page);
										include_once "tranfitopaym.ajax.php";
										exit;
									}else{
									}
									# изключваме от списъка с преводи - избрано постъпление [или списък - НЕ] 
									$tofina= $GETPARAM["tofina"];
									if (isset($tofina)){
//$relurl= geturl("mode=".$mode."&vari=".$vari."&page=".$page);
										include_once "tranfitofina.ajax.php";
										exit;
									}else{
									}
									# приключване постарому на избрано постъпление 
									$clos= $GETPARAM["clos"];
									if (isset($clos)){
$relurltran= $relurl;
										include_once "finaclos.ajax.php";
										exit;
									}else{
									}

# 12.11.2012 - старо приключено или готово за превод 
	# маркиране като старо приключено 
	$markclos= $GETPARAM["markclos"];
	if (isset($markclos)){
		include_once "finamarkclos.ajax.php";
		exit;
	}else{
	}
# 22.11.2012 - старо приключено или готово за превод 
	# ДЕмаркиране като старо приключено - изравнено 
	$demarkclos= $GETPARAM["demarkclos"];
	if (isset($demarkclos)){
//		include_once "finamarkclos.ajax.php";
//		exit;
$DB->query("update finance set isclosed=0, istran=0, timeclosed='', time=now() where finance.id=?d"  ,$demarkclos);
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

# данни за делото 
$rocase= getrow("suit",$idcase);
$rouser= getrow("user",$rocase["iduser"]);
$rocase["username"]= $rouser["name"];
							# за извеждане на "идва от" - кеширания масив 
							$arfrom= unserialize(file_get_contents(COFROMFILE));
							$smarty->assign("ARFROM", $arfrom);
							# за извеждане на "титул"  
							$smarty->assign("ARTITU", $listtitu);
							# за извеждане на "вид" 
							$smarty->assign("ARSORT", $listsort);
							# за извеждане на "текущ статус" 
							$smarty->assign("ARSTAT", $viewcasestat);
							# за извеждане на "произход на вземането" 
							$roorig= getrow("claimorigin",$rocase["idclaimorig"]);
$rocase["origtext"]= $roorig["name"];
$smarty->assign("DATACASE", $rocase);

					# последните дела 
//					$bapa= "mode=$mode&page=$page";
					$bapa= "mode=trango&page=$page";
//print "<br>bapa=[$bapa]<br>";
					$caselink= geturl($bapa."&idcase=".$idcase);
					$_SESSION["lastcase"][$idcase]= array("caselink"=>$caselink, "caseseri"=>$rocase["serial"], "caseyear"=>$rocase["year"]);
					if (count($_SESSION["lastcase"])>5){
						$arke= array_keys($_SESSION["lastcase"]);
						$ckey= $arke[0];
						unset($_SESSION["lastcase"][$ckey]);
					}else{
					}
$smarty->assign("CURRCASE", $idcase);
					
# взискатели по делото 
					//$modeel= "mode=$mode&page=$page&idcase=$idcase";
//	$clailist= $DB->select("select * from claimer where idcase=?d"  ,$idcase);
					# предварително уточняване iban 
					$DB->query("update claimer set iban=replace(iban,' ','') where idcase=?d"  ,$idcase);
					$codejoin= sprintf($bictempjoin,"claimer.iban");
/*
	$clailist= $DB->select("
		select claimer.*, claimer.id as id
			, if(tranacco.code='$codebudg',1,0) as isbudg
			, if(tranacco.code='$codelist',1,0) as islist
			, banklist.name as bankname, banklist.bic as bic
		from claimer 
		left join tranacco on claimer.iban=tranacco.iban
					$codejoin
		where idcase=?d
		order by claimer.id
		"  ,$idcase);
*/
	# 15.02.2018 след грешка при Милен 
	$clailist= $DB->select("
		select claimer.*, claimer.id as id
			, if(tranacco.code='$codebudg',1,0) as isbudg
			, if(tranacco.code='$codelist',1,0) as islist
			, banklist.name as bankname, banklist.bic as bic
		from claimer 
left join finatran on finatran.idclaimer=claimer.id
		left join tranacco on claimer.iban=tranacco.iban
					$codejoin
where claimer.idcase=?d
		order by claimer.id
		"  ,$idcase);
$clailist= dbconv($clailist);
//print "clailist=";
//print_rr(toutf8($clailist));
foreach($clailist as $indx=>$cont){
	$clailist[$indx]["address"]= nl2br($cont["address"]);
	$clailist[$indx]["claimodi"]= geturl($modeel."&claimodi=".$cont["id"]);
	$clailist[$indx]["budgmodi"]= geturl($modeel."&budgmodi=".$cont["id"]);
						# IBAN контр.число (2 цифри) 
						$chresu= ibancheck($cont["iban"]);
						if ($chresu===true){
						}else{
	$clailist[$indx]["ibaniser"]= true;
						}
}
$smarty->assign("CLAILIST", $clailist);
# длъжници по делото 
	$debtlist= $DB->select("select debtor.id as ARRAY_KEY, debtor.* from debtor where debtor.idcase=?d order by debtor.id"  ,$idcase);
$debtlist= dbconv($debtlist);
foreach($debtlist as $indx=>$cont){
	$debtlist[$indx]["address"]= nl2br($cont["address"]);
						# IBAN контр.число (2 цифри) 
						$chresu= ibancheck($cont["iban"]);
						if ($chresu===true){
						}else{
	$debtlist[$indx]["ibaniser"]= true;
						}
}
//////print_rr($debtlist);
$smarty->assign("DEBTLIST", $debtlist);
$arke= array_keys($debtlist);
$smarty->assign("DEBTINDX", $arke[0]);

# списъка с постъпленията 
//$qutranlist= "$qutran where $basefilt and $filtcase order by finance.created desc, finance.id";
//$qutranlist= "$qutran where $filtcase and $filtvari order by finance.created desc, finance.id";
$qutranlist= "$qutran where $filtcase and $filtvari order by finance.id desc";
//print "qutranlist=[$qutranlist]";
$mylist= $DB->select($qutranlist);
$mylist= dbconv($mylist);
foreach($mylist as $indx=>$cont){
	$mylist[$indx]["topaym"]= geturl($modeel."&topaym=".$cont["id"]);
	$mylist[$indx]["unlockfina"]= geturl($modeel."&unlockfina=".$cont["id"]);
	$mylist[$indx]["tofina"]= geturl($modeel."&tofina=".$cont["id"]);
	$mylist[$indx]["clos"]= geturl($modeel."&clos=".$cont["id"]);
# 12.11.2012 - старо приключено или готово за превод 
	$mylist[$indx]["markclos"]= geturl($modeel."&markclos=".$cont["id"]);
	$mylist[$indx]["demarkclos"]= geturl($modeel."&demarkclos=".$cont["id"]);
# 14.03.2013 КРЪПКА върни на деловодителя за корекция 
	$mylist[$indx]["finaback"]= geturl($modeel."&finaback=".$cont["id"]);
}
//$smarty->assign("LIST", $mylist);
$smarty->assign("CBTOPAYM", geturl($modeel."&topaym=0"));
//print "mylist=";
//print_rr(toutf8($mylist));

# списъка с разпределенията 
					$listdata= array();
					$listdatacoun= array();
								$arid= array();
foreach($mylist as $indx=>$elem){
			$idfina= $elem["id"];
								$arid[]= $idfina;
	$ardata= gettrandata($idfina);
/*
					$listdata[$idfina]= $ardata;
//					$listdatacoun[$idfina]= count($ardata);
					$mycoun= count($ardata);
					$mycoun= ($mycoun==0) ? 1 : $mycoun;
					$listdatacoun[$idfina]= $mycoun;
*/
//////var_dump($idfina);
//////print_rr(toutf8($ardata));
#-------------------------------------------
				$flag= true;
	foreach($ardata as $idclai=>$e2){
		if ($idclai<=0 and $idclai<>-1){
		}else{
//			if (empty($e2["iban"]) or empty($e2["bic"])){
			if (empty($e2["iban"])){
				$flag= false;
				break;
			}else{
						# IBAN контр.число (2 цифри) 
						$chresu= ibancheck($e2["iban"]);
						if ($chresu===true){
						}else{
$ardata[$idclai]["ibaniser"]= true;
						}
			}
		}
	}
	$mylist[$indx]["flag"]= $flag;
#-------------------------------------------
					$listdata[$idfina]= $ardata;
//print_ru($ardata);
					$mycoun= count($ardata);
					$mycoun= ($mycoun==0) ? 1 : $mycoun;
					$listdatacoun[$idfina]= $mycoun;
}
/*
print "<br>MYLIST===============";
print_ru($mylist);
print "<br>LISTDATA===============";
print_ru($listdata);
*/
$smarty->assign("LIST", $mylist);
$smarty->assign("LISTDATA", $listdata);
$smarty->assign("LISTDATACOUN", $listdatacoun);

# доп.данни от списъка с преводи 
								if (empty($arid)){
									$codein= "0";
								}else{
									$codein= implode(",",$arid);
								}
//var_dump($codein);
$exlist= $DB->select("select $qurefe where finatranrefe.idfinance in ($codein) order by finatran.id");
$smarty->assign("EXLIST", $exlist);
//print_rr($exlist);
# доп.данни - приключени постъпления чрез преводи 
$enddlist= $DB->select("select $quendd where finatranrefe.idfinance in ($codein) $quenddgr");
$smarty->assign("ENDDLIST", $enddlist);
//print_rr($enddlist);

# флагове изключване 
						$arfinaex= array();
foreach($exlist as $idfina=>$e2){
				$isexclude= true;
	foreach($e2 as $idclai=>$elem){
		if ($elem["idstat"]==9 or $elem["idinvestat"]<>0 or $elem["idpackstat"]<>0 or $elem["idinvepackstat"]<>0){
				$isexclude= false;
				break;
		}else{
		}
	}
						$arfinaex[$idfina]= $isexclude;;
}
$smarty->assign("ARFINAEX", $arfinaex);
//print_rr($arfinaex);

# флагове 
$smarty->assign("ISTOPAYM", $aristopaym[$idvari]);
$smarty->assign("EXCOLO", $arexcolo[$idvari]);

#++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++



?>