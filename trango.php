<?php
# ВСИЧКИТЕ постъпления по избрано дело 
#    източник : finainvo.php finainvo.inc.php - $filtcase 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $page - текущата страница от сумите за превод 
# управляваща : 
#    $idcase - избраното дело suit.id - отгоре 
#    $idvari - подменю за статуса - маневрена 
# още отгоре : 
//#    $qutran - базова заявка 
//#    $basefilt - базов филтър 
#    $relurl - линк за връщане към тек.страница 
#    $codebudg="bud" - код за бюдж.сметка 
//+print "<br>TRANGO<br>";
//+var_dump($CALLFROMALTE);
//+var_dump($idcase);
//print "tranficase=";
//+print_rr($GETPARAM);
//var_dump($idcase);
/**/
								# функции за финансите 
								include_once "fina.inc.php";
								# всичко за преводите 
								include_once "tran.inc.php";

# текущата страница 
//print_rr($GETPARAM);
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;
$smarty->assign("PAGE", $page);

# линк към списъка 
$baco= "mode=".$mode."&page=".$page;
$lisurl= geturl($baco);
//$smarty->assign("GOTEXT", "постъпления готови за превод [стр.$page]");
$smarty->assign("GOBACK", $lisurl);
#-------------------------------------------------------------------------------------

							# въведено дело 
							$seyefina2= $_POST["seyefina2"];
//+++var_dump($seyefina2);
							if (isset($seyefina2)){
//unset($vari);
				list($myseri,$myyear)= explode("/",$seyefina2);
				if (strlen($myyear)==2){
					$myyear= "20".$myyear;
				}else{
				}
				$idcaseinpu= $DB->selectCell("select id from suit where serial=?d and year=?d"  ,$myseri,$myyear);
				$idcaseinpu += 0;
				if ($idcaseinpu==0){
$smarty->assign("ERCASE", "липсва дело $seyefina2");
unset($idcaseinpu);
				}else{
					$idcase= $idcaseinpu;
					$_POST["seyefina2"]= "";
				}
							}else{
								if ($CALLFROMALTE){
								}else{
					$idcase= $GETPARAM["idcase"];
															$idcasealte= $GETPARAM["idcase"];
								}
							}
//+++var_dump($idcase);
//+++var_dump($idcasealte);

# линк за отклонението 
$modeel= "mode=$mode&page=$page";
//$linkwait= geturl($modeel."&idcase=-1");
$smarty->assign("LINKWAIT", geturl($modeel."&idcase=-1"));
$smarty->assign("LINKASSI", geturl($modeel."&idcase=-2"));
$smarty->assign("LINKDIRE", geturl($modeel."&idcase=-3"));
												# отклонение 
												if (in_array($idcasealte,array(-1,-2,-3))){
$smarty->assign("CASEALTE", $idcasealte);
# флагове за колоните за преводи 
$smarty->assign("FLCLAI", 5);
$smarty->assign("FLIBAN", 5);
//$smarty->assign("FLBICC", 1);
$smarty->assign("FLBUAC", 5);
$smarty->assign("FLDEBT", 5);
$smarty->assign("FLFULL", 5);
$smarty->assign("FLRING", 5);
$smarty->assign("FLBANK", 5);
$smarty->assign("FLTEXT", 5);
$smarty->assign("FLRECI", 5);
$smarty->assign("FLEDIT", 0);
$smarty->assign("FLBUDG", 5);
$smarty->assign("FLINVE", 5);
$smarty->assign("FLDIRE", 0);
//$smarty->assign("FLCBOX", 5);
$smarty->assign("FLCBOX", 0);
													$filtcode= "finatran.iduser=" .$_SESSION["iduser"];
													if ($idcasealte==-1){
														# чакащи 
														$filtcode .= " and finatran.idinve=0 and finatran.idpack=0 and finatran.idstat=0";
$smarty->assign("FLCLAI", 1);
$smarty->assign("FLIBAN", 1);
//$smarty->assign("FLBICC", 1);
$smarty->assign("FLBUAC", 1);
$smarty->assign("FLDEBT", 1);
$smarty->assign("FLFULL", 1);
$smarty->assign("FLRING", 1);
$smarty->assign("FLBANK", 1);
$smarty->assign("FLTEXT", 1);
$smarty->assign("FLRECI", 1);
$smarty->assign("FLEDIT", 0);
$smarty->assign("FLBUDG", 1);
$smarty->assign("FLINVE", 1);
$smarty->assign("FLDIRE", 0);
//$smarty->assign("FLCBOX", 5);
$smarty->assign("FLCBOX", 0);
		$smarty->assign("HEADTX", "моите чакащи електронни преводи");
													}elseif ($idcasealte==-2){
														# назначени към опис/пакет 
														$filtcode .= " and (finatran.idinve<>0 or finatran.idpack<>0) and finatran.idstat=0";
$smarty->assign("FLINVE", 5);
$smarty->assign("FLPACK", 5);
$smarty->assign("FLDIRE", 0);
$smarty->assign("FLCBOX", 0);
		$smarty->assign("HEADTX", "моите назначени електронни преводи");
													}else{
														# ръчни  
//														$filtcode .= " and finatran.idstat=9";
														$filtcode .= " and finatran.idstat in(6,9)";
$smarty->assign("FLINVE", 0);
$smarty->assign("FLDIRE", 5);
//$smarty->assign("FLCBOX", 6);
$smarty->assign("FLCBOX", 0);
		$smarty->assign("HEADTX", "моите ръчни преводи");
													}
													$baco= "mode=".$mode."&page=".$page."&idcase=".$idcase;
													$basepara= $baco;
												include_once "tran2.php";
													$mywaitcont= $contvari;
$smarty->assign("MYWAIT", $mywaitcont);
# извеждане 
$pagecont= smdisp("trango.tpl","fetch");
return;
												}else{
												}

												# отклонение 
												# списъка на готовите 
												if (isset($idcase) or isset($idcasealte)){
												}else{
													include_once "trangolist.php";
$smarty->assign("MYWAIT", $pagecont);
# извеждане 
$smarty->assign("CASEALTE", -9);
$pagecont= smdisp("trango.tpl","fetch");
return;
												}

						# делото 
						include_once "tranfina.inc.php";

# извеждане 
//$smarty->assign("C2VARI", $contvari);
//$contvari= smdisp("traninveview.tpl","fetch");
$pagecont= smdisp("trango.tpl","fetch");


?>