<?php
//# отгоре : 
//#    $fielname - име на текстовото поле 
//#    $elemajax - името на този скрипт 

$idchan= $_GET["mychan"];
//print "IDCHAN=";
//var_dump($idchan);
								if (isset($idchan)){

#-------- следващи извиквания с ajax --------------------------------
# корегира списъка с избраните имена и връща ново съдържание на textarea полето 

									session_start();
									include_once "common.php";

$finame= $_GET["mypref"];
								# в масива с директните флагове 
								$_SESSION[$finame]["listflag"][$idchan]= ! $_SESSION[$finame]["listflag"][$idchan];
$result= createar_bank($finame);
print $result;

								}else{

#------- първо извикване с функцията spoubegi() ---------------------------------
# подготвя променливите - сесийни, POST 

								# if (isset($idchan)){
								}


# функция - настройки при първото извикване 
function spoubegi_bank($fielname){
global $DB, $smarty;
	if ($_SESSION[$fielname]===false){

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
$tempcd= '<nobr><input type="checkbox" class="input" name="%s[]" value="%s" label="%s" onclick="listchan(this,\'%s\');"></nobr>';

//		# id на делото 
//		$idcase= $_SESSION["listdebtcase"];
		# четем списъка с банките 
		$mylist= $DB->select("select *, id as ARRAY_KEY from banklist order by id");
		$mylist= dbconv($mylist);
//print_r($mylist);
//var_dump($fielname);
								$ar4name= array();
		foreach($mylist as $myid=>$myelem){
								$ar4name[$myid]= $myelem["name"];
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
			$myname= $elem["name"];
			$myname= nldelete($myname);
											$_POST[$postname][]= $mycode;
//														$artext[]= $myname ." ЕГН " . $ar4egnn[$mycode];
														$artext[]= $myname .$ar4text[$mycode] . $ar4egnn[$mycode];
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
										$myn2= htmlspecialchars($myname,ENT_QUOTES);
							$cuel= sprintf($tempcd  ,$postname,$mycode,$myn2,$fielname);
//							$codecb .= $cuel ." ";
							$codecb .= $cuel ."&nbsp;&nbsp;&nbsp;&nbsp; ";
							$arcodecb[]= $cuel;
		}
		# специално за банките - таблица 
						$inro= 2;
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
														$textresu= toutf8(implode(", ",$artext));
														$rpos= strrpos($textresu,",");
														if ($rpos===false){
														}else{
															$textresu= substr_replace($textresu,toutf8(" и"),$rpos,1);
														}
											# съхраняваме в сесията post променливата за чекбоксовете 
											$_SESSION[$fielname]["postlist"]= $_POST[$postname];
						# предаваме съдържанието на textarea във формата 
						$_POST[$fielname]= $textresu;

	}else{
	}
//var_dump(basename(__FILE__));
	# името на този скрипт - за ajax извикването в шаблона 
	$smarty->assign("AJAXNAME", basename(__FILE__));
}


# функция - формира и връща съдържанието на полето textarea 
function createar_bank($fielname){
								$artextarea= array();
	$arname= $_SESSION[$fielname]["listname"];
//	$aregnn= $_SESSION[$fielname]["listegnn"];
//	$artext= $_SESSION[$fielname]["listtext"];
					$arflag= $_SESSION[$fielname]["listflag"];
//print_r($arname);
//print_r($arpost);
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
		}else{
//print "no";
		}
	}
								$textresu= toutf8(implode(", ",$artextarea));
								$rpos= strrpos($textresu,",");
								if ($rpos===false){
								}else{
									$textresu= substr_replace($textresu,toutf8(" и"),$rpos,1);
								}
	# записите на БД имат \r\n в края 
//	$textresu= str_replace("\r","",$textresu);
//	$textresu= str_replace("\n","",$textresu);
	$textresu= nldelete($textresu);
return $textresu;
}


?>
