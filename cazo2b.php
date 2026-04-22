<?php
#----- дв-86/17----- 
# отгоре : $mylist, $edit 
//print_rr($GETPARAM);

									# действие 
									$idel= $GETPARAM["idel"];
									$tran2= $GETPARAM["tran2"];
									if (isset($tran2)){
									}else{
# автоматично задейства корекция 
#    $edit - делото suit.id 
$idsub2= $DB->selectCell("select id from subject where idcase=?d and idt2=0 order by id"  ,$edit);
if (empty($idsub2)){
						$_SESSION["iscasetran"]= true;
}else{
	$forclink= geturl($modeel."&idel=".$idsub2);
	$smarty->assign("FORCLINK", $forclink);
						$_SESSION["iscasetran"]= false;
}
									}
									
									if ($func=="modi"){
									}else{
									
#------ действия според дв-86/17 --------------------------
# отгоре : $mylist, $calctax 
									
									/*
									# корекция въвед.сума 
									$linkinpu= $GETPARAM["linkinpu"];
									if ($func=="linkinpu"){
print_rr($GETPARAM);
										//include_once $modiname;
										exit;
									}else{
									}
									*/

# параметри т.26 
$arx2t26= x2get_t26($edit);
	$x2_t26_inpu= trim($arx2t26["inpu"]);
	$x2_t26_inpu= ($x2_t26_inpu=="") ? $arx2t26["orig"] : $x2_t26_inpu;
//$arx2t26["inpu"]= $x2_t26_inpu;
				//@@@@@@@@@@@@@@@@@@@print "<br>------arx2t26------";
				//@@@@@@@@@@@@@@@@@@@print_rr(toutf8($arx2t26));

# общи параметри 
//$arx2para= x2get_para($mylist);
list($arx2para,$arx2parainpu)= x2get_para($mylist,$x2_t26_inpu);
//print_rr(toutf8($mylist));
				//@@@@@@@@@@@@@@@@@@@@@@print "<br>------arx2para------";
				//@@@@@@@@@@@@@@@@@@@@@@print_rr(toutf8($arx2para));
				//@@@@@@@@@@@@@@@@@@@@@@print "<br>------arx2parainpu------";
				//@@@@@@@@@@@@@@@@@@@@@@print_rr(toutf8($arx2parainpu));

# параметри описи 
$arx2inve= x2get_inve($edit);
//////print_rr($arx2inve);

/*****
# параметри т.26 
$arx2t26= x2get_t26($edit);
//////print_rr($arx2t26);
$arx2parainpu["t26"]= $arx2t26["inpu"];
print "<br>------arx2parainpu------";
print_rr(toutf8($arx2parainpu));
*****/

# група на делото 
//$x2grou= x2get_group(35023);
$x2grou= x2get_group($arx2para["debt"],$arx2para["mins"]);
	$arx2para["idgrou"]= $x2grou;
///////////////////////////var_dump($x2grou);

# участващи параметри според ограниченията за групата 
$arx2li= $arx2list[$x2grou];
if (isset($arx2li)){
}else{
	var_dump($x2grou);
	die("cazo2bgr");
}
			$arx2p2= array();
					# отделно т.26 
					$e1x2= "t26";
						$ar4base= $arx2t26;
						$ar4base["text"]= $arx2text[$e1x2];
						//$ar4base["limitext"]= "не";
						$ar4base["pn"]= $e1x2;
						if ($ar4base["inpu"]==""){
			$ar4base["rese"]= "";
						}else{
			$ar4base["rese"]= round($ar4base["orig"] - $ar4base["inpu"] ,2);
						}
$arx2p2[$e1x2]= array($ar4base);
			//$arx2base= array();
foreach($arx2li as $codepara){
//////print "<br>ARX2LI-codepara=$codepara";
	//$e1x2= $arx2calcvisu[$codepara][0];
	//$e2x2= $arx2calcvisu[$codepara][1];
	$e1x2= $arx2calc[$codepara][0];
	$e2x2= $arx2calc[$codepara][3];
				# таван 
				$cop2= $arx2calc[$codepara][1];
				$form= $arx2calc[$codepara][2];
										# начисляване ддс 
										$isvatt= $arx2calc[$codepara][4];
//$contp2= $arx2para[$cop2];
//$contp2= $arx2parainpu[$cop2];
					$c2para= $arx2para[$cop2];
					$c2inpu= trim($arx2parainpu[$cop2]);
					$contp2= ($c2inpu=="") ? $c2para : $c2inpu;
//print "<br>x2p2=[$codepara][$cop2][$form][$c2para][$c2inpu]";
//$form2= $x2_vat_coef."*".$contp2.$form;
										# начисляване ддс 
										$form2= $contp2.$form;
										if ($isvatt){
											$form2= $x2_vat_coef."*".$form2;
										}else{
										}
//print "<br>";
//var_dump($c2para,$c2inpu,$form2);
eval("\$contlimi= ($form2);");
$contlimi= round($contlimi,2);
	if ($e1x2=="inve"){
		foreach($arx2inve as $id2=>$co2){
						$ar4base= $co2;
						//$ar4base["ta"]= "subject";
						//$ar4base["id"]= $id2;
						$ar4base["text"]= $arx2text[$e1x2];
			$ar4base["form"]= $form;
			$ar4base["formargu"]= $contp2;
						$ar4base["limitext"]= $e2x2;
						$ar4base["limi"]= $contlimi;
										# начисляване ддс 
										$ar4base["isvatt"]= $isvatt;
						$ar4base["pn"]= $e1x2;
							$minirese= min($ar4base["orig"],$ar4base["limi"]);
						if ($ar4base["inpu"]==""){
			$ar4base["rese"]= round($minirese ,2);
						}else{
			$ar4base["rese"]= round($minirese-$ar4base["inpu"] ,2);
						}
$arx2p2["inve"][]= $ar4base;
		}
	}else{
//		$e1x2= $arx2calcvisu[$codepara][0];
//		$e2x2= $arx2calcvisu[$codepara][1];
						$ar4base= array();
						$ar4base["orig"]= $arx2para[$e1x2];
		if ($e1x2=="prop" or $e1x2=="all"){
						$ar4base["inpu"]= $arx2parainpu[$e1x2];
		}else{
		}
						$ar4base["text"]= $arx2text[$e1x2];
			$ar4base["form"]= $form;
			$ar4base["formargu"]= $contp2;
						$ar4base["limitext"]= $e2x2;
						$ar4base["limi"]= $contlimi;
										# начисляване ддс 
										$ar4base["isvatt"]= $isvatt;
						$ar4base["pn"]= $e1x2;
$arx2p2[$e1x2]= array($ar4base);
	}
}
				//@@@@@@@@@@@@@@@@@@@@@@print "<br>------arx2pa------";
				//@@@@@@@@@@@@@@@@@@@@@@print_rr(toutf8($arx2p2));

# данни за извеждане според групата и сценария 
			$arx2visu= array();
foreach($arx2scen as $codepara){
//////print "<br>code=".$codepara;
	if(isset($arx2p2[$codepara])){
			$arx2visu[$codepara]= $arx2p2[$codepara];
	}else{
	};
}
//print_rr(toutf8($arx2visu));
# линкове за корекция 
foreach($arx2visu as $codepara=>$arx2){
	foreach($arx2 as $indx=>$elem){
		$codex2= $elem["code"];
		if (isset($codex2)){
			$codex2 .= ("/".$elem["orig"]);
$arx2visu[$codepara][$indx]["code"]= $codex2;
$arx2visu[$codepara][$indx]["linkinpu"]= geturl($modeel."&linkinpu=$codex2");
		}else{
		}
		$limix2= $elem["limi"];
		if (isset($limix2)){
//$arx2visu[$codepara][$indx]["okflag"]= ($elem["inpu"]<=$limix2);
			$inputran= ($elem["inpu"]=="") ? $elem["orig"] : $elem["inpu"];
$arx2visu[$codepara][$indx]["okflag"]= ($inputran<=$limix2);
		}else{
		}
	}
}

# глобален резерв за т.26 
					$arw2= array();
# евент.резерв пропорционални 
$ar2x2prop= $arx2visu["prop"][0];
//print_rr($ar2x2prop);
					if (isset($ar2x2prop)){
$min2p= $ar2x2prop["limi"] - $ar2x2prop["inpu"];
						$arw2[]= $min2p;
					}else{
					}
# евент.резерв всички 
$ar2x2all= $arx2visu["all"][0];
					if (isset($ar2x2all)){
$min2a= $ar2x2all["limi"] - $ar2x2all["inpu"];
						$arw2[]= $min2a;
					}else{
					}
# резерв т.26 
$ar2x2t26= $arx2visu["t26"][0];
											$x4_orig= $ar2x2t26["orig"];
											$x4_inpu= trim($ar2x2t26["inpu"]);
											$x4_cont= ($x4_inpu==="" ? $x4_orig : $x4_inpu);
$min2t= $x4_orig - $x4_cont +0;
						$arw2[]= $min2t;
# допълнителни елементи 
			$arw2[]= 999999999;
			$arw2[]= 999999999;
//print_rr($arw2);
											# минимума - резерв т.26 
											$x4_t26_rese= min($arw2);
$arx2visu["t26"][0]["rese2"]= $x4_t26_rese;
											# за евент.трансформация на т.26 
											$x4_t26_setto= $x4_cont + $x4_t26_rese;
											$x4_t26_setto= round($x4_t26_setto,2);
$arx2visu["t26"][0]["setto"]= $x4_t26_setto;
					$smarty->assign("T26SETTO", "$edit/$x4_t26_setto");

# масива с параметрите 
$smarty->assign("ARX2VISU", $arx2visu);
					////////////////////////print_rr(toutf8($arx2visu));

# извеждаме 
//print_rr($arx2para);
$smarty->assign("ARX2PARA", $arx2para);

									# if ($func=="modi"){
									}



?>