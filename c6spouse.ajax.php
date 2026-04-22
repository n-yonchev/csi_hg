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
//print_r($_SESSION[$finame]["postlist"]);
//print "[$idchan][$finame]";
/***
	$idposi= array_search($idchan,$_SESSION[$finame]["postlist"]);
	if ($idposi===false){
//print "no";
		$_SESSION[$finame]["postlist"][]= $idchan;
	}else{
//print "yes";
		unset($_SESSION[$finame]["postlist"][$idposi]);
	}
//print_r($_SESSION[$finame]["postlist"]);
***/
								# в масива с директните флагове 
								$_SESSION[$finame]["listflag"][$idchan]= ! $_SESSION[$finame]["listflag"][$idchan];
$result= createar_spouse($finame);
print $result;

								}else{

#------- първо извикване с функцията spoubegi() ---------------------------------
# подготвя променливите - сесийни, POST 

								# if (isset($idchan)){
								}


# функция - настройки при първото извикване 
function spoubegi_spouse($fielname){
global $DB, $smarty;
	if ($_SESSION[$fielname]===false){

//					$_SESSION["listdebtspou"]= true;
//		$_SESSION["listdebtfiel"]= $fielname;
//		$_SESSION["listdebtajax"]= $elemajax;
		
# константи - 
# флагове според името на полето - масив от елементи : 
#   [0]= влизат ли длъжниците 
#   [1]= влизат ли съпрузите 
#   [2]= да има ли доп.текст - длъжник, - съпруг 
$arflag["dlajnici_sapruzi"]= array(true,true,true);
$arflag["dlajnici"]= array(true,false,false);
$arflag["sapruzi"]= array(false,true,false);
# шаблон за елемент checkbox 
# ВНИМАНИЕ. checkbox-onchange не работи в IE 
//$tempcd= '<nobr><input type="checkbox" class="input" name="listdebt[]" value="%s" label="%s" onchange="listchan(this);"></nobr>';
$tempcd= '<nobr><input type="checkbox" class="input" name="%s[]" value="%s" label="%s" onclick="listchan(this,\'%s\');"></nobr>';

		# id на делото 
		$idcase= $_SESSION["listdebtcase"];
		# четем длъжниците по делото 
		$mylist= $DB->select("select *, id as ARRAY_KEY from debtor where idcase=$idcase order by id");
		$mylist= dbconv($mylist);
//print_r($mylist);
		# флаговете - според името на полето - кои имeна влизат 
		$myflag= $arflag[$fielname];
		if (isset($myflag)){
						list($isdebt,$isspou,$istext)= $myflag;
		}else{
die("spoubegi_spouse=1=$fielname");
		}
		
		# формираме масив с имената за списъка 
		# индекс= id[sp], съдърж=името 
								$ar4name= array();
								$ar4egnn= array();
								$ar4text= array();
		foreach($mylist as $myelem){
				$idtype= $myelem["idtype"];
				$iddebt= $myelem["id"];
					$iddebtsp= $iddebt."sp";
//				$name= $myelem["name"];
//					$namesp= $myelem["name2"];
//			# само физич.лица 
			if ($idtype==2){
				# физич.лице 
								if ($isdebt){
									$ar4name[$iddebt]= $myelem["name"];
									$ar4egnn[$iddebt]= $myelem["egn"];
									$ar4text[$iddebt]= " ЕГН ";
								}else{
								}
//				if (empty($namesp)){
				if (empty($myelem["name2"])){
				}else{
								if ($isspou){
									$ar4name[$iddebtsp]= $myelem["name2"];
									$ar4egnn[$iddebtsp]= $myelem["egn2"];
									$ar4text[$iddebtsp]= " ЕГН ";
								}else{
								}
				}
			}else{
				# юридич.лице 
								if ($isdebt){
									$ar4name[$iddebt]= $myelem["name"];
									$ar4egnn[$iddebt]= $myelem["bulstat"];
									$ar4text[$iddebt]= " ЕИК ";
								}else{
								}
			}
		}
		# масива с имената - в сесията 
		$_SESSION[$fielname]["listname"]= $ar4name;
		# също и масива с ЕГН - в сесията 
		$_SESSION[$fielname]["listegnn"]= $ar4egnn;
		# също и масива с текстовете - в сесията 
		$_SESSION[$fielname]["listtext"]= $ar4text;
		
		# $fielname е post името на textarea със съдържанието - списъка с имена 
		# формираме post името на полето с чекбоксове 
		$postname= "post_".$fielname;
		
		# формираме html код за списъка с чекбоксове 
							$codecb= "";
											# паралелно формираме съдържанието на post променливата за чекбоксовете 
											# - всички са чекнати 
											$_POST[$postname]= array();
														# паралелно формираме масив с имената - за съдържанието на textarea полето с имената 
														# - всички влизат 
														$artext= array();
		foreach($ar4name as $mycode=>$myname){
											$_POST[$postname][]= $mycode;
//														$artext[]= $myname ." ЕГН " . $ar4egnn[$mycode];
														$artext[]= $myname .$ar4text[$mycode] . $ar4egnn[$mycode];
																# и още - сесиен масив с директни флагове 
																$_SESSION[$fielname]["listflag"][$mycode]= true;
			# евентуално допълваме името с текста 
			if ($istext){
				if (substr($mycode,-2)=="sp"){
					$myname .= " - съпруг";
				}else{
					$myname .= " - длъжник";
				}
			}else{
			}
										# заради кавичките в името на юридич.лице 
										$myn2= htmlspecialchars($myname,ENT_QUOTES, "cp1251");
							$cuel= sprintf($tempcd  ,$postname,$mycode,$myn2,$fielname);
//							$codecb .= $cuel ." ";
							$codecb .= $cuel ."&nbsp;&nbsp;&nbsp;&nbsp; ";
		}
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
function createar_spouse($fielname){
								$artextarea= array();
	$arname= $_SESSION[$fielname]["listname"];
	$aregnn= $_SESSION[$fielname]["listegnn"];
	$artext= $_SESSION[$fielname]["listtext"];
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
								$artextarea[]= $myn2 .$artext[$mycode] . $aregnn[$mycode];
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
return $textresu;
}


?>
