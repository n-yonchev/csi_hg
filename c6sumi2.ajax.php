<?php
//# отгоре : 
//#    $fielname - име на текстовото поле 
//#    $elemajax - името на този скрипт 

$idchan= $_GET["mychan"];
//print "IDCHAN=";
//var_dump($idchan);
//print_rr($_POST);
//print_rr($_SESSION);
								if (isset($idchan)){

#-------- следващи извиквания с ajax --------------------------------
# корегира списъка с избраните имена и връща ново съдържание на textarea полето 

									session_start();
									include_once "common.php";

$finame= $_GET["mypref"];
//print "FINAME=[$finame]";
								# в масива с директните флагове 
								$_SESSION[$finame]["listflag"][$idchan]= ! $_SESSION[$finame]["listflag"][$idchan];
$result= createar_sumi2($finame);
print $result;

								}else{

#------- първо извикване с функцията spoubegi() ---------------------------------
# подготвя променливите - сесийни, POST 

								# if (isset($idchan)){
								}


# функция - настройки при първото извикване 
function spoubegi_sumi2($fielname){
global $DB, $smarty;
	if ($_SESSION[$fielname]===false){

		# името на 2-рото поле 
		# зависимо от имената на полетата - напр. "SPIS_SUMI_LIST" и "TOTAL_SUMI_LIST" 
		# - виж cazo6creadocudefi.inc.php 
		$arfi= explode("_",$fielname);
		$arfi[0]= "total";
		$fielname2= implode("_",$arfi);

# константи - 
# флагове според името на полето - масив от елементи : 
#   [0]= влизат ли длъжниците 
#   [1]= влизат ли съпрузите 
#   [2]= да има ли доп.текст - длъжник, - съпруг 
$arflag["spis_banki"]= array(true,true,true);
//$arflag["dlajnici_sapruzi"]= array(true,true,true);
//$arflag["dlajnici"]= array(true,false,false);
//$arflag["sapruzi"]= array(false,true,false);
# шаблон за елемент checkbox 
# ВНИМАНИЕ. checkbox-onchange не работи в IE 
//$tempcd= '<nobr><input type="checkbox" class="input" name="listdebt[]" value="%s" label="%s" onchange="listchan(this);"></nobr>';
//$tempcd= '<nobr><input type="checkbox" class="input" name="%s[]" value="%s" label="%s" onclick="listchan(this,\'%s\');"></nobr>';
$tempcd= '<nobr><input type="checkbox" class="input" name="%s[]" value="%s" label="%s" onclick="listchan(this,\'%s\',\'%s\');"></nobr>';

//		# id на делото 
//		$idcase= $_SESSION["listdebtcase"];
# id на делото - от сесията 
$idcase= $_SESSION["IDCASECREA"];
		//# четем всички дължими суми за делото 
		//$mylist= $DB->select("select * from subject where idcase=$idcase");
										# 15.09.2010 
										# четем само предметите олихвяема и неолихвяема - без месечни и непарични 
										//$filt2= "idtype<>4";
										$filt2= "idtype in (1,2)";
		$mylist= $DB->select("select * from subject where idcase=$idcase and $filt2");
		$mylist= dbconv($mylist);
/*
		# четем списъка с банките 
		$mylist= $DB->select("select *, id as ARRAY_KEY from banklist order by id");
		$mylist= dbconv($mylist);
*/
//print_r($mylist);
//var_dump($fielname);
								$ar4name= array();
		foreach($mylist as $myid=>$myelem){
/*
//								$ar4name[$myid]= number_format($myelem["amount"],2,".",",")." лв ".$myelem["text"];
//								$ar4name[$myid] .= type1ext($myelem);
							$idty= $myelem["idtype"];
							$ar4name[$myid]= number_format($myelem["amount"],2,".",",")." лв ";
							$ar4name[$myid] .= $listsubjtype[$idty] ." ";
							$ar4name[$myid] .= $myelem["text"];
								if ($myelem["idtype"]==1){
								//	$ar4name[$myid] .= " ведно със законната лихва, считано";
								}else{
								}
*/
							$ar4name[$myid]= formelem($myelem,true);
							//+++$ar4name[]= formelem($myelem,true);
/*
			# лихвата за олихв.сума 
			if ($myelem["idtype"]==1){
			//	$ar4name[$myid] .= " ведно със законната лихва, считано";
							$ar4name[$myid."inte"]= "лихва за сума ".$myelem["amount"];
							//$ar4name[$myid+100000000]= "лихва за сума ".$myelem["amount"];
							//+++$ar4name[]= "лихва за сума ".$myelem["amount"];
			}else{
			}
*/
		}
//print_r($ar4name);

														# 15.09.2010 
														# заради функцията addhistelem 
														//$arperc= getpercent();
//														include "subjpaymhist.inc.php";
								# ако има олихвяема сума- добавяме елемент със сумарната лихва 
								# източник : cazo2.php 
								foreach ($mylist as $uskey=>$uscont){
									$idcurr= $uscont["id"];
									# не е include_once - за да се изпълни многократно в цикъла 
									include "cazo2.inc.php";
								}
								# получихме общата главница в сесията 
								$intereca= $_SESSION["intereca"];
//var_dump($intereca);
								if ($intereca+0 ==0){
								}else{
		$ar4name[]= "$intereca лв лихва ";
		$mylist[]= array("amount"=>$intereca, "text"=>"лихва", "fromdate"=>false);
								}
	
		# масива с имената - в сесията 
		$_SESSION[$fielname]["listname"]= $ar4name;

		# $fielname е post името на textarea със съдържанието - списъка с имена 
		# формираме post името на полето с чекбоксове 
		$postname= "post_".$fielname;
		
		# формираме html код за списъка с чекбоксове 
//							$codecb= "";
							$arcodecb= array();
											# паралелно формираме съдържанието на post променливата за чекбоксовете 
											# - всички са чекнати 
											$_POST[$postname]= array();
														# паралелно формираме масив с имената - за съдържанието на textarea полето с имената 
														# - всички влизат 
														$artext= array();
//		foreach($ar4name as $mycode=>$myname){
		foreach($mylist as $mycode=>$elem){
//print "<br>mycode=[$mycode]/".$elem["amount"]."/".$elem["text"];
//			$myname= $elem["amount"]." лв ".$elem["text"];
/*
			$myname= number_format($elem["amount"],2,".",",")." лв ".$elem["text"];
															$myname2= $myname;
								//if ($elem["idtype"]==1){
								//	$myname .= " ведно със законната лихва, считано от "
								//	.bgdatefrom($elem["fromdate"])." г. до окончателното й изплащане";
								//}else{
								//}
								$myname .= type1ext($elem);
			$myname= nldelete($myname);
*/
			//$myname= formelem($elem,false);
			$myname= formelem($elem,true);
															$myname2= $myname;
											$_POST[$postname][]= $mycode;
//														$artext[]= $myname ." ЕГН " . $ar4egnn[$mycode];
														//$artext[]= $myname .$ar4text[$mycode] . $ar4egnn[$mycode];
														$artext[]= $myname .$ar4text[$mycode];
																# и още - сесиен масив с директни флагове 
																$_SESSION[$fielname]["listflag"][$mycode]= true;
/*
			# евентуално допълваме името с текста 
			if ($istext){
				if (substr($mycode,-2)=="sp"){
					$myname .= " - съпруг";
				}else{
					$myname .= " - длъжник";
				}
			}else{
			}
*/
										# заради кавичките в името на юридич.лице 
										//$myn2= htmlspecialchars($myname,ENT_QUOTES);
										$myn2= htmlspecialchars($myname2,ENT_QUOTES);
//							$cuel= sprintf($tempcd  ,$postname,$mycode,$myn2,$fielname);
							$cuel= sprintf($tempcd  ,$postname,$mycode,$myn2,$fielname  ,$fielname2);
//							$codecb .= $cuel ." ";
							$codecb .= $cuel ."&nbsp;&nbsp;&nbsp;&nbsp; ";
							$arcodecb[]= $cuel;
		}
		# специално за банките - таблица 
						$inro= 1;
						$curo= $inro-1;
				$codecb= "";
				$codecb .= "<table cellspacing=0 cellpadding=0>";
		foreach($arcodecb as $elem){
						$curo ++;
						if ($curo % $inro ==0){
				$codecb .= "<tr>";
						}else{
						}
				$codecb .= "<td>$elem";
		}
				$codecb .= "</table>";
//print "<xmp>$codecb</xmp>";
		
/*
		# име на smarty променливата за кода - трябва да е съгласувано с шаблона cazo6crea.ajax.tpl 
		$smarcodecb= "SMAR".$fielname;
		# предаваме html кода в шаблона 
		$smarty->assign($smarcodecb, $codecb);
//							$cblist[$fielname]= $codecb;
//							$smarty->assign("CBLIST", $cblist);
$_SESSION[$fielname]["code"]= $codecb;
$smvars= $smarty->get_template_vars();
print_r($smvars);
*/
		# предаваме html кода в шаблона - става косвено чрез сесийна променлива 
		# - директно не работи - виж коментиран код в шаблона cazo6crea.ajax.tpl 
		$_SESSION[$fielname]["code"]= $codecb;
														# формираме съдържанието на textarea полето с имената 
														/*
														$textresu= toutf8(implode(", ",$artext));
														$rpos= strrpos($textresu,",");
														if ($rpos===false){
														}else{
															$textresu= substr_replace($textresu,toutf8(" и"),$rpos,1);
														}
														*/
														$textresu= toutf8(implode("\r\n",$artext));
											# съхраняваме в сесията post променливата за чекбоксовете 
											$_SESSION[$fielname]["postlist"]= $_POST[$postname];
#------ РЕЗУЛТАТА ------
						# предаваме съдържанието на textarea във формата 
						$_POST[$fielname]= $textresu;
//print_r($artext);
					# и съдържанието на сумата - влизат всички елементи 
							$arflag= array();
							foreach($artext as $arin=>$x2){
								$arflag[$arin]= true;
							}
					$_POST[$fielname2]= calctota($artext,$arflag);

	}else{
	}
//var_dump(basename(__FILE__));
	# името на този скрипт - за ajax извикването в шаблона 
	$smarty->assign("AJAXNAME", basename(__FILE__));
	# js код за тоталната сума 
/*****
				$jscode= '
document.getElementById("vnes_suma").onkeyup= sync;
var v1= $("#total_sumi_list").attr("value");
var v2= $("#total_sumi_delo").attr("value");
var v3= $("#vnes_suma").attr("value");
//alert(v1+"/"+v2);
	jQuery.ajax({
		url: "c6sumicalc.ajax.php?v1="+v1+"&v2="+v2+"&v3="+v3,
		success: function(data){
			var ardata= data.split("^");
			$("#total_sumi").attr("value",ardata[0]);
			$("#osta_suma").attr("value",ardata[1]);
		}
	});
				';
*****/
	$smarty->assign("SUMATOTA", $jscode);
}


# функция - формира и връща съдържанието на полето textarea 
function createar_sumi2($fielname){
								$artextarea= array();
	$arname= $_SESSION[$fielname]["listname"];
//	$aregnn= $_SESSION[$fielname]["listegnn"];
//	$artext= $_SESSION[$fielname]["listtext"];
					$arflag= $_SESSION[$fielname]["listflag"];
//print_r($arname);
//print_r($arpost);
													//$total= 0;
	foreach($arname as $mycode=>$myname){
//print "mycode[$mycode]arpost=";
//print_r($arpost);
		if ($arflag[$mycode]){
//print "yes";
										# заради кавичките в името на юридич.лице 
										$myn2= stripslashes($myname);
//								$artext[]= $myn2 ." ЕГН " . $aregnn[$mycode];
//								$artextarea[]= $myn2 .$artext[$mycode] . $aregnn[$mycode];
								$artextarea[]= $myn2;
//var_dump((float)$myn2);
												//$myto= str_replace(",","",$myn2);
												//$myto= (float) $myto;
												//	$total += $myto;
		}else{
//print "no";
		}
	}
								/*
								$textresu= toutf8(implode(", ",$artextarea));
								$rpos= strrpos($textresu,",");
								if ($rpos===false){
								}else{
									$textresu= substr_replace($textresu,toutf8(" и"),$rpos,1);
								}
								*/
														$textresu= toutf8(implode("\r\n",$artextarea));
	# записите на БД имат \r\n в края 
//	$textresu= str_replace("\r","",$textresu);
//	$textresu= str_replace("\n","",$textresu);
//	$textresu= nldelete($textresu);
//return $textresu;
													//$stot= number_format($total,2,".",",");
													# сумата 
													$stot= calctota($arname,$arflag);
#------ РЕЗУЛТАТА ------
return $textresu ."^" .$stot;
}

/*
# доп.текст за олихвяема сума 
function type1ext($ardata){
		if ($ardata["idtype"]==1){
			$resu= " ведно със законната лихва, считано от "
			.bgdatefrom($ardata["fromdate"])." г. до окончателното й изплащане";
		}else{
			$resu= "";
		}
return $resu;
}
*/

# доп.текст за олихвяема сума 
function formelem($ardata,$flag){
global $listsubjtype;
//print_rr($ardata);
		$idty= $ardata["idtype"];
		$result= number_format($ardata["amount"],2,".",",")." лв ";
			if ($flag){
		$result .= $listsubjtype[$idty] ." ";
			}else{
			}
		$result .= $ardata["text"];
			if ($ardata["fromdate"]===false){
			}else{
		$result .= " от " .bgdatefrom($ardata["fromdate"]);
			}
/*
			# лихвата за олихв.сума 
			if ($ardata["idtype"]==1){
			//	$ar4name[$myid] .= " ведно със законната лихва, считано";
							//$ar4name[$myid."inte"]= "лихва за сума ".$myelem["amount"];
							//$ar4name[$myid+100000000]= "лихва за сума ".$myelem["amount"];
							//+++$ar4name[]= "лихва за сума ".$myelem["amount"];
		$result .= " и лихвата към нея ";
			}else{
			}
*/
return $result;
}

# изчисляваме сума по списък в textarea 
function calctota($ardata,$arflag){
								$total= 0;
	foreach($ardata as $mycode=>$myname){
		if ($arflag[$mycode]){
							$myto= str_replace(",","",$myname);
							$myto= (float) $myto;
								$total += $myto;
		}else{
		}
	}
								$stot= number_format($total,2,".",",");
return $stot;
}


?>
