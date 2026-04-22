<?php
# списък на разпределените суми 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $page - текущата страница 
#    $vari - текущото подменю 
//# $acco = finapack.id за избрания пакет 
//print "acco=$acco";
//print "TRAN<br>";
//print_rr($GETPARAM);
//print_rr($_POST);

								# функции за финансите 
								include_once "fina.inc.php";
if ($flagbankmass){
}else{
$pagecont= "<br><center>функцията е изключена</center>";
return;
}

/***
#--------------------------------------------------------------------------
# защита 
$modeel= "mode=".$mode ."&page=".$page;
$curruser= $_SESSION["iduser"];
									$DB->query("lock tables tranlock write, user read");
									$rouser= getrow("user",$curruser);
	$lockuser= $DB->selectCell("select iduser from tranlock where mode=? and iduser<>?d"  ,$mode,$curruser);
									$rouserlock= getrow("user",$lockuser);
	if ($lockuser==0){
		# няма влязъл юзер 
	}elseif ($rouser["type"]==ADMINTYPE and $rouser["created"]==ADMINSPECTIME){
		# влиза спец.админ - шунт 
$smarty->assign("NAMELOCKED", $rouserlock["name"]);
	}else{
		# има влязъл юзер 
		$forcing= $GETPARAM["forcing"];
		if ($forcing=="yes"){
				$DB->query("update tranlock set mode='', idcase=0 where iduser=?d"  ,$lockuser);
			# предпазва при рефреш на браузера 
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
$contvari= smdisp("tranlocked.tpl","fetch");
# извеждане 
$smarty->assign("CONTVARI", $contvari);
$pagecont= smdisp("tran.tpl","fetch");
return;
		}
	}
									$DB->query("unlock tables");
#--------------------------------------------------------------------------
***/
#--------------------------------------------------------------------------
# защита 
$modeel= "mode=".$mode ."&page=".$page;
$mode2= $mode."=yes";
$curruser= $_SESSION["iduser"];
									$DB->query("lock tables tranlock write, user read");
									$rouser= getrow("user",$curruser);
	$lockuser= $DB->selectCell("select iduser from tranlock where mode=? and iduser<>?d"  ,$mode2,$curruser);
									$rouserlock= getrow("user",$lockuser);
	if ($lockuser==0){
		# няма влязъл юзер 
	}elseif ($rouser["type"]==ADMINTYPE and $rouser["created"]==ADMINSPECTIME){
		# влиза спец.админ - шунт 
$smarty->assign("NAMELOCKED", $rouserlock["name"]);
	}else{
		# има влязъл юзер 
		$forcuser= $GETPARAM["forcuser"];
		if ($forcuser==$lockuser){
				$DB->query("update tranlock set mode='', idcase=0 where iduser=?d"  ,$lockuser);
			# предпазва при рефреш на браузера 
$relurl= geturl($modeel);
reload("",$relurl);
		}else{
			# предупреждение 
			$rouserlock= getrow("user",$lockuser);
				$casedata= array();
			$casedata["lockname"]= $rouserlock["name"];
			$casedata["linkforc"]= geturl($modeel."&forcuser=".$lockuser);
									$DB->query("unlock tables");
$smarty->assign("CASEDATA", $casedata);
$contvari= smdisp("tranlocked.tpl","fetch");
# извеждане 
$smarty->assign("CONTVARI", $contvari);
$pagecont= smdisp("tran.tpl","fetch");
return;
		}
	}
$DB->query("update tranlock set mode=?, idcase=0 where iduser=?d"  ,$mode2,$curruser);
									$DB->query("unlock tables");
#--------------------------------------------------------------------------

						# всичко за преводите 
						include_once "tran.inc.php";

//print_rr($_POST);
//print_rr($GETPARAM);
//print_r($_SESSION);
# подменю 
//$arvari= array();
$arvari[1]= "чакащи <br>преводи";				
//				$arvarifilt[1]= "finatran.idstat in (0,3) and finatran.idinve=0 and finatran.idpack=0";		
				$arvarifilt[1]= "$filtnocase and finatran.idstat in (0,3) and finatran.idinve=0 and finatran.idpack=0";		
//				$arvaritext[1]= " - чакащи";
				$arvaritext[1]= " чакащи електронни преводи";
				$arvaricode[1]= "finatran^co1";
//$arvari[2]= "актуални описи <br>с преводи";		
$arvari[2]= "актуални <br>описи";		
//				$arvarifilt[2]= "(tranpack.idstat is null or tranpack.idstat=0)";
				$arvarifilt[2]= "traninve.idstat=0";
				$arvaritext[2]= "####";
//				$arvaricode[2]= "traninve left join tranpack on traninve.idpack=tranpack.id^co2";
				$arvaricode[2]= "traninve^co2";
//$arvari[3]= "актуални пакети <br>с преводи";	
$arvari[3]= "актуални <br>пакети ";	
				$arvarifilt[3]= "tranpack.idstat=0";
				$arvaritext[3]= "####";
				$arvaricode[3]= "tranpack^co3";
/*
$arvari[4]= "други пакети <br>с преводи";	
				$arvarifilt[4]= "tranpack.idstat<>0";
				$arvaritext[4]= "####";
				$arvaricode[4]= "tranpack^co4";
*/
//$arvari[5]= "трансферирани <br>преводи";		$arvarifilt[5]= "1";
$arvari[5]= "приключени <br>преводи";		
						$codecoun= "if(finatran.idinve<>0,traninve.idstat,tranpack.idstat)=2";
				$arvarifilt[5]= "finatran.idstat=0 and (finatran.idinve<>0 or finatran.idpack<>0) and $codecoun";
//				$arvaritext[5]= " - приключени";
				$arvaritext[5]= " приключени електронни преводи";
				$arvaricode[5]= "finatran left join traninve on finatran.idinve=traninve.id left join tranpack on finatran.idpack=tranpack.id^co5";
$smarty->assign("ELECLIMI", 5);

$arvari[6]= "ръчни <br>преводи";				
//				$arvarifilt[6]= "finatran.idstat=9";			
//				$arvaritext[6]= " - директни";
				$arvarifilt[6]= "finatran.idstat in(6,9)";			
//				$arvaritext[6]= " - ръчно преведени";
				$arvaritext[6]= " ръчни преводи";
				$arvaricode[6]= "finatran^co6";

				$arperm[1]= true;
				$arperm[2]= false;
				$arperm[3]= false;
//				$arperm[4]= false;
				$arperm[5]= false;
				$arperm[6]= false;
							$arincl[1]= "tranwait.php";
							$arincl[2]= "traninve.php";
							$arincl[3]= "tranpack.php";
//							$arincl[4]= "tranpack2.php";
//							$arincl[5]= "tranclos.php";
							$arincl[6]= "";
			
			#----------------------------------------------------------------
			# ръчни преводи - 2 подгрупи 
$arvari[11]= "отложени";				
				$arvarifilt[11]= "finatran.idstat=6";			
				$arvaritext[11]= " ръчни отложени преводи";
				$arvaricode[11]= "finatran^co11";
$arvari[12]= "преведени";				
				$arvarifilt[12]= "finatran.idstat=9";			
				$arvaritext[12]= " ръчно преведени";
				$arvaricode[12]= "finatran^co12";
					$arperm[11]= false;
					$arperm[12]= false;
							$arincl[11]= "";
							$arincl[12]= "";
$smarty->assign("DIRELIMI", 10);
			#----------------------------------------------------------------
//print_rr($arvari);
$smarty->assign("ARVARI", $arvari);

# бройки за извеждане 
$myte= "sum(if(%s ,1,0)) as %s";
			$artemp= array();
foreach($arvaricode as $indx=>$cont){
	list($ftyp,$fnam)= explode("^",$cont);
		$fielem= $arvarifilt[$indx];
		$mycode= sprintf($myte,$fielem,$fnam);
			$artemp[$ftyp][]= $mycode;
}
//print_rr($artemp);
			$arcode= array();
foreach($artemp as $type=>$cont){
			$arcode[$type]= implode(", ",$cont);
}
//print_rr($arcode);

			$arvaricoun= array();	
foreach($arcode as $taname=>$selecode){
	$arco= $DB->selectRow("select $selecode from $taname");
	foreach($arco as $myname=>$mycoun){
			$arvaricoun[substr($myname,2)]= $mycoun;	
	}
}
$smarty->assign("ARVARICOUN", $arvaricoun);
//print_rr($arvaricoun);

# главни линкове 
				$modeel= "mode=".$mode;
	$arvarilink= array();
foreach($arvari as $indx=>$x2){
	$arvarilink[$indx]= geturl($modeel."&vari=".$indx);
}
$smarty->assign("ARVARILINK", $arvarilink);

# текущото подменю 
$vari= $GETPARAM["vari"];
$vari= isset($vari) ? $vari: 1;
$filtcode= $arvarifilt[$vari];
$smarty->assign("HEADTX", $arvaritext[$vari]);
$isperm= $arperm[$vari];
//print "vari=[$vari]";

									# въведено дело 
									$caseyear= $_POST["caseyear"];
									if (isset($caseyear)){
//unset($vari);
				list($myseri,$myyear)= explode("/",$caseyear);
				if (strlen($myyear)==2){
					$myyear= "20".$myyear;
				}else{
				}
				$idcaseinpu= $DB->selectCell("select id from suit where serial=?d and year=?d"  ,$myseri,$myyear);
				$idcaseinpu += 0;
									}else{
$idcaseinpu= $GETPARAM["idcase"];
$rocase= getrow("suit",$idcaseinpu);
$myseri= $rocase["serial"];
$myyear= $rocase["year"];
									}
//print_rr($_POST);
//print_rr($GETPARAM);
//print "tran=idcaseinpu=";
//var_dump($idcaseinpu);
									# въведено дело или след рефреш за дело 
									if (isset($idcaseinpu)){
unset($vari);
$filtcode= "suit.id=$idcaseinpu";
$smarty->assign("HEADTX", "от дело $myseri/$myyear");
# постъпления от избраното дело 
$arfina= $DB->select("
	select distinct finance.id as ARRAY_KEY
		, finance.inco, finance.dateinco, finance.timeclosed
	from finance
	where finance.idcase=?d
	"  ,$idcaseinpu);
$arfina= dbconv($arfina);
$smarty->assign("ARFINA", $arfina);
# статусите на разпределенията 
$arin= array_keys($arfina);
//$smarty->assign("ISFINA", true);
$isperm= true;
										$_POST["caseyear"]= "";
									}else{
									}
$smarty->assign("VARI", $vari);
$smarty->assign("ISPERM", $isperm);

# текущата страница 
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

# флагове за колоните за преводи 
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
//$smarty->assign("FLBACK", 1);
$smarty->assign("FLINVE", 1);
//$smarty->assign("FLDIRE", 1);
$smarty->assign("FLDIRE", 0);
//$smarty->assign("FLCBOX", 1);
$smarty->assign("FLCBOX", 5);
			if ($vari==6 or $vari==11 or $vari==12){
# само за ръчно преведените 
$smarty->assign("FLCLAI", 5);
$smarty->assign("FLIBAN", 5);
//$smarty->assign("FLBICC", 5);
$smarty->assign("FLBUAC", 0);
$smarty->assign("FLDEBT", 5);
$smarty->assign("FLFULL", 5);
$smarty->assign("FLRING", 5);
$smarty->assign("FLBANK", 5);
$smarty->assign("FLTEXT", 5);
$smarty->assign("FLRECI", 5);
$smarty->assign("FLBUDG", 5);
//$smarty->assign("FLBACK", 0);
$smarty->assign("FLINVE", 0);
$smarty->assign("FLDIRE", 1);
$smarty->assign("FLCBOX", 6);
			}else{
			}
//			if ($vari==5){
//# само за приключените 
			if ($vari==5 or isset($idcaseinpu)){
# само за приключените и преводите по дело 
$smarty->assign("FLCLAI", 5);
$smarty->assign("FLIBAN", 5);
//$smarty->assign("FLBICC", 5);
$smarty->assign("FLBUAC", 0);
$smarty->assign("FLDEBT", 5);
$smarty->assign("FLFULL", 5);
$smarty->assign("FLRING", 5);
$smarty->assign("FLBANK", 5);
$smarty->assign("FLTEXT", 5);
$smarty->assign("FLRECI", 5);
$smarty->assign("FLBUDG", 5);
//$smarty->assign("FLBACK", 0);
$smarty->assign("FLINVE", 5);
$smarty->assign("FLPACK", 5);
					if ($vari==5){
$smarty->assign("FLDIRE", 0);
					}else{
$smarty->assign("FLDIRE", 1);
					}
$smarty->assign("FLCBOX", 0);
			}else{
			}

# 18.09.2017 ВНИМАНИЕ - странна грешка при Милен 
# - дублирани записи с finatran.idcase=0 
$filtcode .= " and $filtnocase";

# избрано подменю 
//var_dump($vari);
$currincl= $arincl[$vari];
//var_dump($currincl);
if (empty($currincl)){
			include_once "tran2.php";
}else{
			include_once "$currincl";
}
			
			# спец.отклонение 
			if (isset($idcaseinpu)){
				$idcase= $idcaseinpu;
				$idvari= 2;
$CALLFROMALTE= true;
$smarty->assign("CALLFROMALTE", $CALLFROMALTE);
//				include_once "tranfi.php";
				include_once "trango.php";
$contvari= $pagecont;
			}else{
			}

# извеждане 
$smarty->assign("CONTVARI", $contvari);
$pagecont= smdisp("tran.tpl","fetch");

?>