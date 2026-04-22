<?php
# избрано постъпление или списък постъпления : 
# включване на консолидирани разпределения към списъка за превод 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $page - текущата страница 
#    $idcase - делото suit.id 
//#    $idcase - избраното дело suit.id - отгоре 
#    $idvari - подменю за статуса - маневрена 
# управляваща : 
#    $topaym - постъплението finance.id ИЛИ 
#    $_SESSION["cboxlist"] - списък постъпления раделител="," префикс="cb" 
# още отгоре : 
#    $qutran - базова заявка 
#    $basefilt - базов филтър 
#    $relurl - линк за връщане към тек.страница 
#    $codebudg="bud" - код за бюдж.сметка 
//print_rr($GETPARAM);
//var_dump($idcase);
//print_rr($_POST);
//print_rr($_SESSION);

# делото 
$rocase= getrow("suit",$idcase);
$smarty->assign("ROCASE", $rocase);

# методи 
$armeth= array();
$armeth[0]= "Е";
$armeth[1]= "отложен";
$armeth[2]= "преведен";
$smarty->assign("ARMETH", $armeth);
$smarty->assign("COUNMETH", count($armeth));
	$arstat= array();
	$arstat[0]= 0;
	$arstat[1]= 6;
	$arstat[2]= 9;

# масив с постъпления 
if ($topaym==0){
	$cblist= $_SESSION["cboxlist"];
//////print "cblist=[$cblist]";
						//unset($_SESSION["cboxlist"]);
//	$arfina= explode(",",$cblist);
	$arfina= explode(",",$cblist);
				$ar2= array();
	foreach($arfina as $elem){
				$ar2[]= substr($elem,2);
	}
	$codein= implode(",",$ar2);
}else{
//////print "topaym=[$topaym]";
//	$arfina= array($topaym);
	$codein= $topaym;
}

# списъка с постъпленията 
//$qutranlist= "$qutran where finance.id in ($codein) order by finance.created desc, finance.id";
$qutranlist= "$qutran where $basefilt and finance.id in ($codein) order by finance.created desc, finance.id";
$mylist= $DB->select($qutranlist);
$mylist= dbconv($mylist);
$smarty->assign("LIST", $mylist);
//$smarty->assign("CBTOPAYM", geturl($modeel."&topaym=0"));
//////print_rr($mylist);
# първия длъжник 
$iddebtfirst= $DB->selectCell("select debtor.id from debtor where debtor.idcase=?d order by debtor.id limit 1"  ,$idcase);

# директно край 
if (isset($_POST["submit2"])){
	# redirect 
	reload("parent",$relurl);
}else{
}

# проверка 
if (isset($_POST["submit"])){
						$arclai= array();
//$toform= TRUE;
	foreach($mylist as $elem){
		$idfina= $elem["id"];
		$ardata= gettrandata($idfina);
		foreach($ardata as $idclai=>$e2){
			if ($idclai>0 and $e2["isbudg"]==1){
						$arclai[]= $idclai;
			}else{
			}
		}
	}
							$lister= array();
	foreach($arclai as $idclai){
			#--- дати 
			foreach(array("docdate","fromdate","todate") as $finame){
				$datename= "budg_".$idclai."_".$finame ."";
				$datecont= $_POST[$datename];
//print "<br>[$datename][$datecont]";
						$resudate= validator_bgdate_valid($datecont,"?");
						if ($resudate===true){
						}else{
							$lister[$datename]= $resudate[0];
						}
			}
	}
	#--- дата погасяване 
	$datebala= $_POST["datebala"];
	$resudate= validator_bgdate_valid($datebala,"?");
	if ($resudate===true){
	}else{
							$lister["datebala"]= $resudate[0];
	}
							if (empty($lister)){
			$toform= false;
							}else{
			$toform= true;
$smarty->assign("LISTER",$lister);
							}
}else{
	$_POST["datebala"]= date("d.m.Y");
			$toform= true;
}

# форма или край 
if (!$toform){
						# сметките за ЧСИ : неолихв, т.26 
						$arspec= getarspec();
	# след събмит 
# данни за кантората 
$rooffi= getofficerow(0);
								$DB->query("lock tables finance write, finatran write, finatranrefe write, tranbudget write
								, claimer write, tranacco write
								, debtor read, suit read, epep_payments_queue write");
								$arfinatran= array();
											$arfinatranrefe= array();
		foreach($mylist as $elem){
			$idfina= $elem["id"];
			$ardata= gettrandata($idfina);
			foreach($ardata as $idclai=>$e2){
											$arfinatranrefe[$idclai][]= array("idfina"=>$idfina,"suma"=>$e2["suma"]);
//print "<br>[$idfina][$idclai]";
								$arfinatran[$idclai]["amount"] += $e2["suma"];
								$arfinatran[$idclai]["iban"]= $e2["iban"] ."";
//+								$arfinatran[$idclai]["bic"]= $e2["bic"] ."";
								//$arfinatran[$idclai]["idcase"]= $e2["idcase"];
								$arfinatran[$idclai]["idcase"]= $idcase;
//print "===[$idfina][$idclai]";
//								$arfinatran[$idclai]["iddebtor"]= $elem["iddebtor"];
								$arfinatran[$idclai]["iddebtor"]= $iddebtfirst;
								$arfinatran[$idclai]["idbank"]= $_POST["idbank_".$idclai];
								$arfinatran[$idclai]["isfull"]= isset($_POST["isfull_".$idclai]) ? 1:0;
								$arfinatran[$idclai]["isring"]= isset($_POST["isring_".$idclai]) ? 1:0;
							# етап-5 03.10.2012 
//							$arfinatran[$idclai]["idstat"]= ($_POST["iselec_".$idclai]==1) ? 0:9;
//							$arfinatran[$idclai]["idstat"]= ($_POST["iselec_".$idclai]==1) ? 0:6;
							$arfinatran[$idclai]["idstat"]= $arstat[$pm=$_POST["idmeth_".$idclai]];
							$arfinatran[$idclai]["iduser"]= $_SESSION["iduser"];
					if ($e2["isbudg"]==0){
					}else{
						# нов бюджетен 
						$bset= getbset($idclai);
						$idbudg= $DB->query("insert into tranbudget set ?a"  ,$bset);
								$arfinatran[$idclai]["idtranbudget"]= $idbudg;
					}
			# foreach($ardata as $idclai=>$e2){
			}
//print "<br>arfinatran=$idclai";
//print_rr($arfinatran[$idclai]);
		# foreach($mylist as $elem){
		}
				$arid= array();
//print "<br>ARFINATRAN=";
//print_rr($arfinatran);
		foreach($arfinatran as $idclai=>$datafina){
			$datafina["idclaimer"]= $idclai;
						if (isset($arspec[$idclai])){
							$datafina["iban"]= $arspec[$idclai]["iban"];
//+							$datafina["bic"]= $arspec[$idclai]["bic"];
						}else{
						}
//var_dump($idclai);
//print_rr($datafina);
						# име на взискателя 
						if ($datafina["idclaimer"]==-1){
							# връщане - длъжника 
							$rodebt= getrow("debtor",$datafina["iddebtor"]);
					$clainame= $rodebt["name"];
						}elseif ($datafina["idclaimer"]==-2){
							# ЧСИ т.26 - име ЧСИ 
					$clainame= "ЧСИ ".$rooffi["shortname"];
						}elseif ($datafina["idclaimer"]==-3){
							# ЧСИ неолихв - име ЧСИ 
					$clainame= "ЧСИ ".$rooffi["shortname"];
						}else{
							# нормално - взискателя 
							$roclai= getrow("claimer",$datafina["idclaimer"]);
					$clainame= $roclai["name"];
						}
					$clainame= charspec($clainame);
//var_dump(toutf8($clainame));
			$datafina["clainame"]= toutf8($clainame);
# 03.11.2012 предпазва от грешка - дела без длъжници [делба] 
$datafina["iddebtor"]= $datafina["iddebtor"]+0;
			# IBAN контр.число (2 цифри) 
			$chresu= ibancheck($datafina["iban"]);
$datafina["ibaniser"]= ($chresu===true ? 0 : 1);
			# нов запис за превод 
//print_rr($datafina);
			$idfinatran= $DB->query("insert into finatran set ?a, created=now(),statmodi=now()"  ,$datafina);
			# основанието 
			updatrantext($idfinatran);
				$arid[$idclai]= $idfinatran;
		}
		foreach($arfinatranrefe as $idclai=>$datarefe){
			foreach($datarefe as $e3){
				$refset= array();
				$refset["idfinance"]= $e3["idfina"];
				$refset["suma"]= $e3["suma"];
				$refset["idfinatran"]= $arid[$idclai];
				$DB->query("insert into finatranrefe set ?a"  ,$refset);
			}
		}
		foreach($mylist as $elem){
			$idfina= $elem["id"];
			$DB->query("update finance set isclosed=1, timeclosed=now(), istran=1, datebala=? where finance.id=?d"  
			,bgdateto($datebala),$idfina);
		}
								$DB->query("unlock tables");
//++$smarty->assign("LISTDATA", $listdata);
//print_rr(toutf8($listdata));
//////	$retucode= 0;
						$retucode= 0;
}else{
	# начало - форма 
						$retucode= 12;
	# списъка с разпределенията 
//++					$listdata= array();
							# паралелно консолидация по взискатели 
							$arcons= array();
		foreach($mylist as $elem){
			$idfina= $elem["id"];
			$ardata= gettrandata($idfina);
//++					$listdata[$idfina]= $ardata;
//////var_dump($idfina);
//////print_rr(toutf8($ardata));
							foreach($ardata as $idclai=>$e2){
								$arcons[$idclai]["suma"] += $e2["suma"];
								$arcons[$idclai]["clainame"]= $e2["clainame"];
								$arcons[$idclai]["iban"]= $e2["iban"];
						# IBAN контр.число (2 цифри) 
						$chresu= ibancheck($e2["iban"]);
						if ($chresu===true){
						}else{
								$arcons[$idclai]["ibaniser"]= true;
						}
//+								$arcons[$idclai]["bic"]= $e2["bic"];
								$arcons[$idclai]["isbudg"]= $e2["isbudg"];
								# етап-5 03.10.2012 
//								$arcons[$idclai]["iselec"]= 1;
								$arcons[$idclai]["idmeth"]= 0;
							}
		}
//++$smarty->assign("LISTDATA", $listdata);
//print_rr(toutf8($listdata));
							ksort($arcons);
		$smarty->assign("ARCONS", $arcons);
//////print_rr(toutf8($arcons));
}

#----------------- край на директното редактиране -----------------------
# резултат 
if ($retucode==0){
	# redirect 
	reload("parent",$relurl);
}else{
	# извеждаме формата 
//	$smarty->assign("EDIT", $claimodi);
//	$smarty->assign("FILIST", $filist);
	print smdisp("tranfitopaym.ajax.tpl","iconv");
}


function getbset($idclai){
	# полета за бюдж.данни 
	$arbuname= array("codepaym","typedoc","docdate","fromdate","todate");
		$bset= array();
	foreach($arbuname as $finame){
		if (strpos($finame,"date")===false){
			$bset[$finame]= $_POST["budg_".$idclai."_".$finame] ."";
		}else{
			$mydate= $_POST["budg_".$idclai."_".$finame];
			$bset[$finame]= (empty($mydate)) ? "" : bgdateto($mydate);
		}
	}
return $bset;
}


?>