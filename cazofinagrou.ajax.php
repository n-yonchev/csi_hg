<?php
# групово разпределение на постъпления за дело $edit 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $page - текущата страница 
# $edit - делото suit.id 
# $zone==paym - зоната 
# $grdist==yes - самия скрипт 
		# този скрипт се извиква алтернативно от дело - виж cazofina.php 
		# в този случай : 
		#      $CALLFROMCASE===true 
//		#      $editcase - делото = suit.id 
//var_dump($edit);
//+++++print_rr($GETPARAM);
//+++++print_rr($_POST);
//print "edit=[$edit]zone=[$zone]grdist=[$grdist]";

# за линка - разпредели автоматично 
$baselink= "mode=$mode&edit=$edit&zone=$zone&grdist=yes";
$linkauto= geturl($baselink."&auto=yes");
$smarty->assign("LINKAUTO", $linkauto);
//# за линка запиши 
//$linsave= geturl($baselink."&save=yes");
//$smarty->assign("LINKSAVE", $linksave);

#--------------------------------------------------------------------------------------------------------
												$ajaxwait= $GETPARAM["ajaxwait"];
												if ($ajaxwait=="yes"){
$baseur= geturl($baselink);
/*
	print "
<body onload=\"document.location.href='$baseur';\">
WAIT.......
</body>
	";
*/
//$boonlo= "document.location.href='$baseur';";
//$smarty->assign("ONLOAD", $boonlo);
$smarty->assign("BASEUR", $baseur);
print smdisp("cazofigrwait.ajax.tpl","iconv");
exit;
												}else{
												}
#--------------------------------------------------------------------------------------------------------
									
									# функции, свързани с финансите 
									include_once "fina.inc.php";
									include_once "cazoactu.inc.php";

# списък на взискателите 
$clailist= getclailist($edit);
$clailist= $clailist + $pseuclainame;
//print_rr(toutf8($clailist));
	$clailist2= $clailist;
	unset($clailist2[-1]);
//print_rr(toutf8($clailist2));

# данни за погасяването 
//			$filter= "where idcase=$edit";
//list($listvali,$cbtemp)= getactulist($filter);
//print_rr($listvali);
											# супер процес - изчисляваме и зареждаме еднократно данните за погасяването 
											# източник : cazoactu.php 
/****
											$supecase= $_SESSION["groudata"]["idcase"];
//print "[$edit][$supecase]";
											if ($supecase==$edit){
****/
											$auto= $GETPARAM["auto"];
//											if (!($auto=="yes" and count($_POST)==0)){
											if (!($auto<>"yes" and count($_POST)==0)){
												#----------------- следващ път за това дело -----------------
		# данните - от сесията 
		$groudata= $_SESSION["groudata"];
											}else{
												#----------------- първи път за това дело -----------------
//print "=========FIRSTTIME===========";
												//# нулираме сесийната променлива 
												//$_SESSION["groudata"]= array();
						# изчисляваме погасяването 
						include_once "cazobala.php";
//print_rr($balist);
						//$coun= count($balist);
						//$groudata= $balist[$coun];
						$groudata= end($balist);

# трансформираме данните 
$armode= array("plus","minu","resu");
foreach($armode as $modeel){
	$groudata[$modeel][-3]["total"]= $groudata[$modeel][0]["tax"];
	$groudata[$modeel][-2]["total"]= $groudata[$modeel][0]["fee"];
			$suma= 0;
			foreach($clailist2 as $idclai=>$x2){
				$suma += $groudata[$modeel][$idclai]["total"];
			}
			$groudata["suma"][$modeel]= $suma;
}
//print "GROUDATA=";
//print_rr($groudata);
//print "SUMA=";
//print_rr($suma);
//print "==END";
# процентите 
foreach($clailist2 as $idclai=>$x2){
	$c1= $groudata["minu"][$idclai]["total"];
	$c2= $groudata["plus"][$idclai]["total"];
//	$groudata["percpaid"][$idclai]= round(100*$c1/$c2,0);
	$groudata["percpaid"][$idclai]= round(divi(100*$c1,$c2),0);
}
	$c1= $groudata["suma"]["minu"];
	$c2= $groudata["suma"]["plus"];
//	$groudata["percsuma"]= round(100*$c1/$c2,0);
	$groudata["percsuma"]= round(divi(100*$c1,$c2),0);
//$smarty->assign("DATA", $groudata);
//print_rr($groudata);
												# данните - в сесията 
												$_SESSION["groudata"]= $groudata;
												# делото - в сесията 
												$_SESSION["groudata"]["idcase"]= $edit;
											# край супер процес 
											}
$smarty->assign("DATA", $groudata);
//+++++print_rr($groudata);

# шаблона 
$tpname= "cazofinagrou.ajax.tpl";

# reload - след успешен събмит 
$relurl= geturl("mode=".$mode."&page=".$page);

# ОТНОВО списък на взискателите - cazobala.php е променил съдържанието 
$clailist= getclailist($edit);
$clailist= $clailist + $pseuclainame;
//print_rr(toutf8($clailist));
	$clailist2= $clailist;
	unset($clailist2[-1]);
//print_rr(toutf8($clailist2));

									# класа за редактиране 
									include_once "edit.class.php";
#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
//print_rr($_POST);

if (isset($_POST["listdist"])){
}else{
	$_POST["listdist"]= array();
}

									# основен входен параметър - специфичен подход 

# списъка с постъпления 
$filter= "where finance.idcase=$edit";
$myquery= "select finance.*, finance.id as id
	from finance
	$filter 
	order by finance.id desc
	";
$mylist= $DB->select($myquery);
$mylist= dbconv($mylist);

										# формираме суми по колоните 
										$suma= array();
													# формираме списъка за груп.разпределяне 
													$ardist= array();
# трансформираме данните 
						$arinco= array();
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
						$arinco[$idcurr]= $uscont["inco"];
//print "<br>MYLIST=$idcurr=".$uscont["inco"];
				$norest= $uscont["inco"] - $uscont["rest"];
	# разпределена сума 
	$mylist[$uskey]["norest"]= $norest;
	# статус и трите суми според статуса 
	# статуси : ok+=приключена с дата ok-=приключена без дата di+=за разпред. di-= за разпред. но има разпред.елементи 
	# суми : payd=платена pend=висяща acti=участваща 
										$suma["tota"] += $uscont["inco"];
				if ($uscont["isclosed"]==1){
					if ($uscont["datebala"]==""){
	$mylist[$uskey]["stat"]= "ok-";
	$mylist[$uskey]["pend"]= $uscont["inco"];
										$suma["pend"] += $uscont["inco"];
					}else{
	$mylist[$uskey]["stat"]= "ok+";
	$mylist[$uskey]["payd"]= $uscont["inco"];
										$suma["payd"] += $uscont["inco"];
					}
				}else{
					if ($norest==0){
	# ще има чекбокс 
	$mylist[$uskey]["cb"]= true;
	# състояние на чекбокса 
	if ($mfacproc=="INIT"){
		$_POST["listdist"][]= $idcurr;
	}else{
	}
							if (in_array($idcurr,$_POST["listdist"])){
	$mylist[$uskey]["stat"]= "di+";
	$mylist[$uskey]["acti"]= $uscont["inco"];
										$suma["dist"] += $uscont["inco"];
													$ardist[$idcurr]= $uscont;
							}else{
	$mylist[$uskey]["stat"]= "di+nocb";
	$mylist[$uskey]["pend"]= $uscont["inco"];
							}
					}else{
	$mylist[$uskey]["stat"]= "di-";
	$mylist[$uskey]["pend"]= $uscont["inco"];
										$suma["pend"] += $uscont["inco"];
					}
				}
}
$smarty->assign("LIST", $mylist);
$smarty->assign("SUMA", $suma);
$smarty->assign("ARDIST", $ardist);
//+++++print_rr(toutf8($clailist));
//+++++print_rr(toutf8($clailist2));
$smarty->assign("CLAILIST", $clailist);
$smarty->assign("CLAILIST2", $clailist2);

#---- групово разпределяне ------------------------------------
# $clailist - включен е елемента "връщане" 
# резултати : 
#     $distsuma[$idclai] - сумарен ред - по взискатели 
#     $distdata[$idfina][$idclai] - таблицата - по постъпления и взискатели 
			
#---- 1. разпределяне на общата постъпила сума по взискатели 
# резултат : 
#     $distsuma[$idclai] - сумарен ред - по взискатели 
			$mode= $_POST["mode"];
//			if ($mode=="amount"){
			if ($mode=="amount" or $mode=="save"){
//print "=HAND=";
				# след ръчна корекция на разпределянето 
					$distsuma= array();
				foreach($clailist as $idclai=>$x2){
					$distsuma[$idclai]= $_POST["am".$idclai];
				}
			}else{
//print "=AUTOOOO=";
				# автоматично разпределяне 
				$distsuma= distauto();
			}
//++++print "<br>DISTSUMA=";
//++++print_rr($distsuma);
$smarty->assign("DISTSUMA", $distsuma);

#---- 2. получихме изчислени суми за всеки взискател 
# разпределяме по постъпления всяка изчислена сума за даден взискател 
# резултат : 
#     $distdata[$idfina][$idclai] - таблицата - по постъпления и взискатели 
#     $idfina - постъплението finance.id 
#-- относит.коеф. по постъпления - само чекнатите 
//print "LISTDIST=";
//print_rr($_POST["listdist"]);
						# последното постъпление 
						$lastfina= 0;
		$percfina= array();
foreach ($mylist as $uskey=>$uscont){
				$idfina= $uscont["id"];
						$lastfina= $idfina;
	if (in_array($idfina,$_POST["listdist"])){
		$percfina[$idfina]= divi($uscont["inco"],$suma["dist"]);
	}else{
	}
}
//print_rr($percfina);
#-- разпределяме по постъпления 
		$distdata= array();
foreach($clailist as $idclai=>$x2){
								# послед.постъпление е разлика 
								$sumaclai= 0;
	foreach ($mylist as $uskey=>$uscont){
				$idfina= $uscont["id"];
		if ($idfina==$lastfina){
			$distdata[$idfina][$idclai]= $distsuma[$idclai] - $sumaclai; 
		}else{
			$resu= $distsuma[$idclai] * $percfina[$idfina];
			$resu= round($resu,2);
								$sumaclai += $resu;
			$distdata[$idfina][$idclai]= $resu;
		}
	}
}
$smarty->assign("DISTDATA", $distdata);

# съхраняване и край 
# източник : finaedit.ajax.php 
if ($mode=="save"){
											# съществува ли таблицата finatran в БД ? 
											$finatran_exists= tabexists("finatran");
//print "DISTDATA=";
//print_rr($distdata);
	foreach($_POST["listdist"] as $idfina){
//print "<br>idfina=[$idfina]";
		$distelem= $distdata[$idfina];
//print_rr($distelem);
		# последно изравняване 
		$sumadist= array_sum($distelem);
//var_dump($sumadist);
		$sucorr= $arinco[$idfina] - $sumadist;
			$sucorr= round($sucorr,2);
//var_dump($sucorr);
		foreach($distelem as $idwork=>$elem){
			if ($elem>0){
				$distelem[$idwork]= round($elem+$sucorr ,2);
				break;
			}else{
			}
		}
		# съхраняване 
						$aset= array();
								$arclai= array();
								$suclai= 0;
		foreach($distelem as $idwork=>$elem){
			$roelem= round($elem +0 ,2);
			if ($idwork==-3){
						$aset["separa"]= $roelem;
			}elseif ($idwork==-2){
						$aset["separa2"]= $roelem;
			}elseif ($idwork==-1){
						$aset["back"]= $roelem;
			}else{
								$arclai[$idwork]= (string)$roelem;
								$suclai += $roelem;
			}
		}
//var_dump($suclai);
//var_dump($arinco[$idfina]);
//print_rr($arclai);
						$aset["toclai"]= serialize($arclai);
						$aset["rest"]= 
							round($arinco[$idfina],2) 
							- round($aset["separa"],2) 
							- round($aset["separa2"],2) 
							- round($aset["back"],2) 
							- round($suclai,2);
						$aset["rest"]= (string) round($aset["rest"],2);
//print_rr($aset);
		$DB->query("update finance set ?a, time=now() where id=?d" ,$aset,$idfina);
		# в архива 
						include_once "fina.inc.php";
		finaarchive($idfina);
															#------- само ако съществува таблицата finatran ------ 
															if ($finatran_exists){
										#---- запис във finatran - виж finaedit.ajax.php ----
															}else{
															}
	}
//print "====END====";
	# redirect 
	$redilink= array("tpaymlink","tactulink");
	$smarty->assign("EXITCODE", getnyroexit($redilink));
	print smdisp($tpname,"iconv");
}else{
}


#---- рекапитулация след груп.разпределяне ------------------------------------
# $clailist2 - НЕ Е включен е елемента "връщане" 
# резултат : 
#     $recadata[$mode][$idclai] - таблицата - по показатели и взискатели 
#     показатели : 
#         minuex - доп.погасени в резултат на груп.разпределяне 
#         minu2  - общо погасени = към.момента + групово 
#         resu2  - нови актуални дългове 
#         proc2  - нови % погасяване 
//#     $recasuma[$mode] - сумарен ред - по показатели 
//++++print "<br>clailist2-menuex=";
//++++print_rr($clailist2);
		$recadata= array();
foreach($clailist2 as $idclai=>$x2){
			# 31.01.2011 
			# ЧСИ неолихвяема се погасява максимално с предимство 
			# специално за ЧСИ неолихвяема 
			if ($idclai==$inexof){
				$recadata["minuex"][$idclai]= $maxtotaexof;
			}else{
		$recadata["minuex"][$idclai]= $distsuma[$idclai];
			}
		$recadata["minu2"][$idclai]= $groudata["minu"][$idclai]["total"] + $recadata["minuex"][$idclai];
		$recadata["resu2"][$idclai]= $groudata["plus"][$idclai]["total"] - $recadata["minu2"][$idclai];
}
//		$recasuma= array();
foreach($clailist2 as $idclai=>$x2){
		$recadata["suma"]["minuex"] += $recadata["minuex"][$idclai];
		$recadata["suma"]["minu2"] += $recadata["minu2"][$idclai];
		$recadata["suma"]["resu2"] += $recadata["resu2"][$idclai];
}
# процентите 
foreach($clailist2 as $idclai=>$x2){
	$c1= $recadata["minu2"][$idclai];
	$c2= $groudata["plus"][$idclai]["total"];
//	$recadata["perc"][$idclai]= round(100*$c1/$c2,0);
	$recadata["perc"][$idclai]= round(divi(100*$c1,$c2),0);
}
	$c1= $recadata["suma"]["minu2"];
	$c2= $groudata["suma"]["plus"];
//	$recadata["percsuma"]= round(100*$c1/$c2,0);
	$recadata["percsuma"]= round(divi(100*$c1,$c2),0);
//print "<br>RECADATA=";
//print_rr($recadata);
$smarty->assign("RECADATA", $recadata);
//$smarty->assign("RECASUMA", $recasuma);
#--------------------------------------------------------------

						# за извеждане на "тип" - масива $listfinatype - commspec.php 
						# предаваме съдържанието на масива 
						$smarty->assign("ARTYPE", $listfinatype2);

# допълнителни js линкове за секцията head 
$smarty->assign("HEADJS", array("_cazofigr.js","cluetip.hoverIntent.js","jquery.cluetip.js"));

	# извеждаме формата 
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
//print_rr($smarty->get_template_vars());
	print smdisp($tpname,"iconv");




function distauto(){
global $clailist2, $groudata, $suma;
			# 31.01.2011 
			# ЧСИ неолихвяема се погасява максимално с предимство 
			$inexof= -3;
$GLOBALS["inexof"]= $inexof;
			# макс.възможна сума за погасяване на ЧСИ олихвяема 
//			$maxtotaexof= min( $groudata["plus"][$inexof]["total"] ,$suma["dist"] );
			$toexof= $groudata["plus"][$inexof]["total"] - $groudata["minu"][$inexof]["total"];
			$maxtotaexof= min($toexof, $suma["dist"]);
$GLOBALS["maxtotaexof"]= $maxtotaexof;
				$c2inex= $clailist2[$inexof];
			unset($clailist2[$inexof]);
/*
print "<br>";
print "sumadist1=".$suma["dist"];
$suma["dist"] -= $minutota;
print "sumadist2=".$suma["dist"];
print "<br>";
*/
				//$groudata["minu"][-3]["total"] += $minutota;
//++++print "<br>MAXTOTAEXOF=$maxtotaexof<br>";
//			$groudata["minu"][-3]["total"]= $minutota;
			//$suma["dist"] -= $groudata["minu"][-3]["total"];
			//unset($clailist2[-3]);
/***
print "GROUDATA=";
print_rr($groudata);
print "SUMA=";
print_rr($suma);
//print "==END";
***/
	# индекс за връщане 
	$inback= -1;
	# общо - дължима, погасена и за груп.разпределяне 
	$sugrou= $suma["dist"];
			# 31.01.2011 
			# ЧСИ неолихвяема се погасява максимално с предимство 
			$sugrou -= $maxtotaexof;
//++++print "<br>sugrou=";
//++++var_dump($sugrou);
				$sudebt= 0;
				$supayd= 0;
	foreach($clailist2 as $idclai=>$x2){
//var_dump($groudata["percpaid"][$idclai]);		
		if ($groudata["percpaid"][$idclai] >=100){
//print "<br>percover=$idclai=".toutf8($x2);
		}else{
//print "<br>percOK=$idclai=".toutf8($x2);
				$sudebt += $groudata["plus"][$idclai]["total"];
				$supayd += $groudata["minu"][$idclai]["total"];
		}
	}
//++++print "<br>sudebt=[$sudebt]supaid=[$supayd]sugrou=[$sugrou]";
	# нов баланс 
	$sutota= $supayd + $sugrou;
	$suover= $sutota - $sudebt;
		$suover= round($suover,2);
//++++print "sutota=[$sutota]suover=[$suover]";
	# разпределяне 
					$distsuma= array();
	if ($suover >=0){
					$distsuma[$inback]= $suover;
		# изчисляване глобален коефициент на погасяване - 
		# само за взискателите с погасяване под 100 % 
		foreach($clailist2 as $idclai=>$x2){
			if ($groudata["percpaid"][$idclai] >=100){
			}else{
				$suplus= $groudata["plus"][$idclai]["total"];
				$suminu= $groudata["minu"][$idclai]["total"];
				$suresu= $suplus - $suminu;
					$distsuma[$idclai]= $suresu;
			}
		}
//print "<br>DISTSUMA-OVER";
//print_rr($distsuma);
	}else{
		# получаваме глобален коефициент на погасяване - 
		# само за взискателите с погасяване под 100 % 
//		$topart= divi($sutota,$sudebt);
			//# 31.01.2011 
			//# ЧСИ неолихвяема се погасява максимално с предимство 
			//# изчисляваме коефициента без макс.възможната сума за ЧСИ неолихвяема 
//		$topart= divi($sutota-$maxtotaexof,$sudebt);
		$topart= divi($sutota,$sudebt);
		$toperc= $topart *100;
//++++print "<br>CALCRESU=$sutota=$sudebt=$topart";
//++++var_dump($toperc);

		# цикъл за избор на взискатели за разпределянето 
		$arclaidist= array_keys($clailist2);
//++++print "ARCLAIDIST=INIT=";
//++++print_rr($arclaidist);
											$whcoun= 0;
		while (true){
//++++print "<h3>$toperc</h3>";
		
								# $arclaidist - взискателите, участващи в разпределянето 
								$ar2= array();
								# $toperc - последно изчисления коеф. на погасяване 
				$sudebt= 0;
				$supayd= 0;
								# последния от взискателите 
								$idclailast= -99;
								# флаг - има ли взискатели с по-голям коеф. - няма да участват 
								$flagover= false;
//++++print "<br>ARCLAIDISTTTTTTT=";
//++++print_rr($arclaidist);
			foreach($arclaidist as $x1=>$idclai){
//++++print "<br>CURR2=$idclai=".$groudata["percpaid"][$idclai]."=".$toperc;
				if ($groudata["percpaid"][$idclai] > round($toperc)){
//++++print "=OVER";
								$flagover= true;
				}else{
//								$arclaidist[]= $idclai;
								$ar2[]= $idclai;
								$idclailast= $idclai;
				$sudebt += $groudata["plus"][$idclai]["total"];
				$supayd += $groudata["minu"][$idclai]["total"];
				}
			}
//++++print "<br>while=sudebt=[$sudebt]supaid=[$supayd]sugrou=[$sugrou]";
			# нов глобален коефициент на погасяване 
			$sutota= $supayd + $sugrou;
//			$topart= divi($sutota,$sudebt);
			//# 31.01.2011 
			//# ЧСИ неолихвяема се погасява максимално с предимство 
			//# изчисляваме коефициента без макс.възможната сума за ЧСИ неолихвяема 
//		$topart= divi($sutota-$maxtotaexof,$sudebt);
		$topart= divi($sutota,$sudebt);
			$toperc= $topart *100;
//++++print "<br>newcoef=[$sutota][$maxtotaexof][$sudebt]=[$toperc]";
//print "<br>CALCRESU2=$sutota=$sudebt=$topart";
//var_dump($idclailast);

								if ($flagover){
								}else{
									break;
								}
											$whcoun ++;
											if ($whcoun>100){
die("cazofigr=1");
												break;
											}else{
											}
								# $arclaidist - взискателите, участващи в разпределянето 
								$arclaidist= $ar2;
		# край на цикъла за избор на взискатели за разпределянето 
		}
/*
if ($idclailast==-99){
die("cazofigr=2");
}else{
}
*/
//++++print "<br>ARCLAIDIST_END=";
//++++print_rr($arclaidist);


		# окончателно разпределяне по взискатели 
						$clsuma= 0;
		foreach($arclaidist as $x1=>$idclai){
//++++print "<br>IDCLAI==";
//++++var_dump($idclai);
			if ($idclai==$idclailast){
					$distsuma[$idclai]= $sugrou - $clsuma;
//++++print "<br>RESU2LAST=$idclai=[$sugrou][$clsuma]";
/****
			# 31.01.2011 
			# ЧСИ неолихвяема се погасява максимално с предимство 
			# специално за ЧСИ неолихвяема 
			}elseif ($idclai==$inexof){
				$clresu= $maxtotaexof;
print "<br>RESU2EXOF=$idclai=[$clplus][$topart][$clresu]";
					$distsuma[$idclai]= $clresu;
						$clsuma += $clresu;
****/
			}else{
				$clplus= $groudata["plus"][$idclai]["total"];
				$clresu= $topart * $clplus;
				$clresu= round($clresu,2) - $groudata["minu"][$idclai]["total"];
//++++print "<br>RESU2=$idclai=[$clplus][$topart][$clresu]";
					$distsuma[$idclai]= $clresu;
						$clsuma += $clresu;
			}
		}
		#-----------------------------------------------------------------------
	}
//print "ARCLAILIST=";
//print_rr($arclaidist);
//print "DISTSUMA=";
//print_rr($distsuma);
//print "==END";
			# 31.01.2011 
			# ЧСИ неолихвяема се погасява максимално с предимство 
			# добавяме елемента за ЧСИ неолихвяема 
			$distsuma[$inexof]= $maxtotaexof;
			$clailist2[$inexof]= $c2inex;
//++++print "<br>DISTSUMA-AUTOOOOO=";
//++++print_rr($distsuma);
return $distsuma;
}

function divi($p1,$p2){
	if ($p2+0==0){
return 0;
	}else{
return $p1/$p2;
	}
}


?>
