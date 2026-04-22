<?php
#----- дв-86/17----- 
//print_rr($GETPARAM);

#------ трансформация на предмети според дв-86/17 --------------------------

# глобални константи 
$x2_vat_coef= 1.2;
//$x2_vat_text= "+ддс";
$smarty->assign("X2VATTEXT", "+ддс");

# типове 
$arsu2type= array();
	$arsu2type["a"]= "общи типове";
$arsu2type[0]= "неопределен";
$arsu2type[4]= "задължение";
$arsu2type[8]= "такса НЕ за сметка на длъжника";
	$arsu2type["b"]= "такси за сметка на длъжника, които УЧАСТВАТ в изчисляване на лимита";
$arsu2type[12]= "пропорц.такса за опис (т.20)";
$arsu2type[16]= "друга пропорционална такса";
$arsu2type[20]= "друга проста такса";
	$arsu2type["c"]= "такси и разноски за сметка на длъжника, които НЕ УЧАСТВАТ в изчисляване на лимита";
//$arsu2type[24]= "такса за администриране на жалби срещу ЧСИ (по т.5)";
//$arsu2type[28]= "такса за уведомяване на присъед.взискател (по т.8)";
$arsu2type[24]= "такса за администриране на жалби срещу ЧСИ";
$arsu2type[28]= "такса за уведомяване на присъед.взискател";
$arsu2type[32]= "такса за присъединяване на взискател (т.11)";
$arsu2type[36]= "разноски по изпълнението (т.31)";
$smarty->assign("ARSU2TYPE", $arsu2type);

					# еднократно автоматична трансформация 
					$x2conotz= $DB->selectCell("select count(*) from subject where idcase=?d and idt2<>0"  ,$edit);
					if ($x2conotz==0){
						# всички предмети са без трансформиран тип 
						# трансформираме типа за някои комбинации от параметри 
						# - виж типове и подтипове в commspec.php 
						$arx2data= $DB->select("select id as ARRAY_KEY,idtype,idsubtype,isintax from subject where idcase=?d and idt2=0"  ,$edit);
						foreach($arx2data as $x2id=>$elem){
										$idt2= 0;
							$x2ty= $elem["idtype"];
							$x2st= $elem["idsubtype"];
							$x2is= $elem["isintax"];
							if (0){
							}elseif(($x2ty==1 or $x2ty==3) and $x2is==1){
								# тип= олихвяема или мес.олихв.сума т.26=участва - задължение 
										$idt2= 4;
							}elseif($x2ty==2 and $x2st==4 and $x2is==1){
								# тип= неолихвяема подтип= поИзпЛист т.26=участва - задължение 
										$idt2= 4;
							}elseif($x2ty==2 and $x2st==16 and $x2is==0){
								# тип= неолихвяема подтип= доп.разноски т.26=НЕучаства - разноски по изпълн 
										$idt2= 36;
							}else{
							}
										if ($idt2==0){
										}else{
						$DB->query("update subject set idt2=?d where id=?d"  ,$idt2,$x2id);
										}
						}
					}else{
					}

# списъци с типове - за проверка при корекции 
$arsu2nodebt= array(8);
$arsu2adva= array(12,16,20,  24,28,32,36);
$su2inve= 12;
									
# типове за визуализация 
#   0 - неопределен 
#   3 - задължение (не дълг) 
#   6 - такса участва 
#   9 - не участва 
$arsu4t= array();
$arsu4t[0]= 0;
$arsu4t[4]= 3;
$arsu4t[8]= 9;
$arsu4t[12]= 6;
$arsu4t[16]= 6;
$arsu4t[20]= 6;
$arsu4t[24]= 9;
$arsu4t[28]= 9;
$arsu4t[32]= 9;
$arsu4t[36]= 9;
$smarty->assign("ARSU4T", $arsu4t);


#------ за изчисленията според дв-86/17 --------------------------

# групи дела - коеф.за максимума на задължението спрямо МРЗ 
# група 8 - задължение над 45 МРЗ 
# определя се в коя група попада всяко дело според задължението 
$arx2gr= array();
$arx2gr[1]= 0.1;
$arx2gr[2]= 0.2;
$arx2gr[3]= 0.5;
$arx2gr[4]= 1;
$arx2gr[5]= 2;
$arx2gr[6]= 3;
$arx2gr[7]= 45;
# $arx2gr[8]= над 45 МРЗ 
			$arx2grvisu= array();
			$arx2grvisu[1]= "до 10 % МРЗ";
			$arx2grvisu[2]= "10-20 % МРЗ";
			$arx2grvisu[3]= "20-50 % МРЗ";
			$arx2grvisu[4]= "50-100 % МРЗ";
			$arx2grvisu[5]= "1-2 МРЗ";
			$arx2grvisu[6]= "2-3 МРЗ";
			$arx2grvisu[7]= "3-45 МРЗ";
			$arx2grvisu[8]= "над 45 МРЗ";
$smarty->assign("ARX2GRVISU", $arx2grvisu);

# индекси и имена на параметри 
#   all - всички такси заСмДлъж 
#   prop - всички пропорц.такси заСмДлъж 
#   debt - задължение 
#   inve - такса за опис (списък) - пропорц.такса заСмДлъж 
#   t26 - т.26  - пропорц.такса заСмДлъж 
# mins - МРЗ 
/*
$arx2text= array();
$arx2text["all"]=  "всички такси заСмДлъж";
$arx2text["prop"]= "пропорц.такси заСмДлъж";
$arx2text["debt"]= "задължение";
$arx2text["inve"]= "такса опис заСмДлъж";
$arx2text["t26"]=  "точка 26";
$smarty->assign("ARX2TEXT", $arx2text);
*/
$arx2text= array();
$arx2text["all"]=  "всички такси";
$arx2text["prop"]= "пропорц.такси";
$arx2text["debt"]= "задължение";
$arx2text["inve"]= "такса опис";
$arx2text["t26"]=  "точка 26";
$smarty->assign("ARX2TEXT", $arx2text);

/***
# ограничения - схеми за изчисляване на максимума 
#   [елемент] : [максимум на кой параметър] [аргумент за формулата] [формула] 
$arx2calc= array();
# при задължение до 3 МРЗ - параметър : всички такси 
$arx2calc["g1"]= array("all", "mins", "*0.3", "макс.30% от МРЗ");
$arx2calc["g2"]= array("all", "mins", "*0.4", "макс.40% от МРЗ");
$arx2calc["g3"]= array("all", "mins", "*0.5", "макс.50% от МРЗ");
$arx2calc["g4"]= array("all", "mins", "*0.7", "макс.70% от МРЗ");
$arx2calc["g5"]= array("all", "mins", "*0.8", "макс.80% от МРЗ");
$arx2calc["g6"]= array("all", "mins", "*0.9", "макс.90% от МРЗ");
# за всички - параметър : всички проп.такси 
$arx2calc["10pc"]= array("prop", "debt", "/10", "макс.1/10 от задълж");
# при задължение над 45 МРЗ (група 8) - параметър : всички проп.такси 
$arx2calc["g8"]= array("prop", "debt", "/15", "макс.1/15 от задълж");
# за всички - параметър : такса за опис 
$arx2calc["inve"]= array("inve", "t26", "/2", "макс.1/2 от т.26");
***/
# ограничения - схеми за изчисляване на максимума 
#   [елемент] : [максимум на кой параметър] [аргумент за формулата] [формула] [текст] [начисляване ддс] 
$arx2calc= array();
# при задължение до 3 МРЗ - параметър : всички такси 
$arx2calc["g1"]= array("all", "mins", "*0.3", "макс.30% от МРЗ", false);
$arx2calc["g2"]= array("all", "mins", "*0.4", "макс.40% от МРЗ", false);
$arx2calc["g3"]= array("all", "mins", "*0.5", "макс.50% от МРЗ", false);
$arx2calc["g4"]= array("all", "mins", "*0.7", "макс.70% от МРЗ", false);
$arx2calc["g5"]= array("all", "mins", "*0.8", "макс.80% от МРЗ", false);
$arx2calc["g6"]= array("all", "mins", "*0.9", "макс.90% от МРЗ", false);
# за всички - параметър : всички проп.такси 
$arx2calc["10pc"]= array("prop", "debt", "/10", "макс.1/10 от задълж", true);
# при задължение над 45 МРЗ (група 8) - параметър : всички проп.такси 
$arx2calc["g8"]= array("prop", "debt", "/15", "макс.1/15 от задълж", true);
# за всички - параметър : такса за опис 
$arx2calc["inve"]= array("inve", "t26", "/2", "макс.1/2 от т.26", false);

# списък ограничения по групи 
$arx2list= array();
$arx2list[1]= array("inve","g1","10pc");
$arx2list[2]= array("inve","g2","10pc");
$arx2list[3]= array("inve","g3","10pc");
$arx2list[4]= array("inve","g4","10pc");
$arx2list[5]= array("inve","g5","10pc");
$arx2list[6]= array("inve","g6","10pc");
$arx2list[7]= array("inve",     "10pc");
$arx2list[8]= array("inve","g8"       );

# сценарий за извеждане по редове 
$arx2scen= array("inve","prop","all","t26");

#------ функции за изчисленията според дв-86/17 --------------------------

# връща изчислени междинни параметри на делото 
function x2get_para($ardata,$x2_t26_inpu){
global $calctax;
					$arx2para= array();
					$arx2para["t26"]= $calctax;
					$arx2para["mins"]= $_SESSION["minsal"];
								$arx2parainpu= array();
								$arx2parainpu["t26"]= $x2_t26_inpu;
	foreach($ardata as $elem){
		$idt2= $elem["idt2"];
		$capi= $elem["capital"];
		$ires= $elem["interest"];
								$amo2= trim($elem["amo2"]);
$amo33= $amo2;
								$amo2= ($amo2=="") ? $capi : $amo2;
//print "<br>getpara=[$idt2][$capi][$amo33][$amo2]";
		if (0){
		}elseif($idt2==4){
			# задължение 
					$arx2para["debt"] += ($capi+$ires+0);
		}elseif($idt2==12){
			# пропорц.такса за опис 
					$arx2para["prop"] += $capi;
					$arx2para["all"] += $capi;
								$arx2parainpu["prop"] += $amo2;
								$arx2parainpu["all"] += $amo2;
		}elseif($idt2==16){
			# друга пропорц.такса 
					$arx2para["prop"] += $capi;
					$arx2para["all"] += $capi;
								$arx2parainpu["prop"] += $amo2;
								$arx2parainpu["all"] += $amo2;
		}elseif($idt2==20){
			# проста такса 
					$arx2para["all"] += $capi;
								$arx2parainpu["all"] += $amo2;
		}else{
		}
	}
	# добавяме т.26 към пропорц и всичките такси 
	$arx2para["prop"] += $arx2para["t26"];
	$arx2para["all"] += $arx2para["t26"];
								$arx2parainpu["prop"] += $arx2parainpu["t26"];
								$arx2parainpu["all"] += $arx2parainpu["t26"];
	# закръгляване 
	$arx2para["debt"]= round($arx2para["debt"],2);
	$arx2para["prop"]= round($arx2para["prop"],2);
	$arx2para["all"]= round($arx2para["all"],2);
								$arx2parainpu["prop"]= round($arx2parainpu["prop"],2);
								$arx2parainpu["all"]= round($arx2parainpu["all"],2);
return array($arx2para,$arx2parainpu);
}

function x2get_inve($idcase){
global $DB, $su2inve;
	$arin= $DB->select("select amount as orig, amo2 as inpu, concat('subject/',id,'/amo2') as code from subject where idcase=?d and idt2=?d"  ,$idcase,$su2inve);
return $arin;
}

function x2get_t26($idcase){
global $calctax;
	$rocase= getrow("suit",$idcase);
	$cont26= $rocase["t26"];
	$ar26= array("orig"=>$calctax,"inpu"=>$cont26, "code"=>"suit/$idcase/t26");
return $ar26;
}

# връща в коя група попада делото 
function x2get_group($debt,$minsal){
global $arx2gr;
//	$minsal= $_SESSION["minsal"];
	if (empty($minsal)){
/////////////////////var_dump($minsal);
die("error-minsal");
	}else{
	}
			$idgr= 0;
	foreach($arx2gr as $i2=>$coef2){
		$uplimi= round($minsal*$coef2,2);
//print "<br>[$i2][$coef2][$uplimi][$debt]";
		if ($debt<=$uplimi){
			$idgr= $i2;
			break;
		}else{
		}
	}
	if ($idgr==0){
			$idgr= count($arx2gr)+1;
	}else{
	}
return $idgr;
}


?>