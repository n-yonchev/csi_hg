<?php
# отчет ВСС по взискатели - избор на съдилища 
# списък взискатели със стринг "съд" - с чекбоксове, без страници 
//print_rr($GETPARAM);
//print_rr($_POST);


# базов линк 
$modeel= "mode=".$mode ."&period=".$period ."&vari=".$vari;

/*
# код за взискател 
//$codeclai= "concat(t1.name,'^',t1.iden,'^',t1.idtype)";
$codeclai= "concat(t1.iden,'^',t1.idtype)";
*/

# филтър за ненулеви колони 
$tafilt= "(ta.c1+ta.c2+ta.c4+ta.c5+ta.c6)<>0 and (ta.c8+ta.c9+ta.c12+ta.c13+ta.c14)<>0";


									# списък дела на избран взискател 
									$code= $GETPARAM["code"];
									if (isset($code)){
/*
$smarty->assign("PAGEBACKTEXT", "назад към списъка взискатели");
$smarty->assign("PAGEBACKLINK", geturl($modeel));
*/
										include_once "rep3v22list.php";
return;
									}else{
									}

# заявката 
$codeex= "
		where $filtmain and $filtperi
		group by $codeclai
		order by t1.name
	";
//		order by $codeclai
$q2= str_replace("[CODEEXTE]",$codeex,$qubase);
$query= str_replace("[CODECLAI]",$codeclai,$q2);
//$tafilt= "(ta.c1+ta.c2+ta.c4+ta.c5+ta.c6)<>0 and (ta.c8+ta.c9+ta.c12+ta.c13+ta.c14)<>0";
$query= "$query where $tafilt";

# данни 
//print toutf8(str_replace(array("\t"),array("&nbsp;&nbsp;&nbsp;&nbsp;"),nl2br($query)));
$ardata= $DB->select($query);
$ardata= dbconv($ardata);
//print_ru($ardata);

# трансформация 
//$modeel= "mode=".$mode2 ."&period=".$period ."&vari=".$vari;
									//$arin= array();
							$arcode= array();
foreach ($ardata as $indx=>$elem){
	$code= $elem["code"];
									//$arin[]= "'".$code."'";
							$arcode[]= $code;
//	list($name,$iden,$type)= explode("^",$elem["code"]);
//	list($iden,$type)= explode("^",$elem["code"]);
//print "<br>($iden)($type)($code)";
	list($iden,$type)= explode("^",$code);
	if ($type==2){
		$egn= $iden;
		$eik= "";
	}else{
		$egn= "";
		$eik= $iden;
	}
//	$ardata[$indx]["name"]= $name;
	$ardata[$indx]["eik"]= $eik;
	$ardata[$indx]["egn"]= $egn;
	$ardata[$indx]["type"]= $type;
//	$ardata[$indx]["codeut"]= toutf8($elem["code"]);
	$ardata[$indx]["link"]= geturl($modeel."&code=".$code);
}
									//$codein= (empty($arin)) ? "0" : implode(",",$arin);
									//$codein= toutf8($codein);
//print_ru($ardata);
//print $codein;

/*
# само в началото - всички чекбоксове маркирани 
if (empty($_POST)){
	foreach($arcode as $e2co){
		$_POST["codelist"][]= $e2co;
	}
}else{
}
*/

/*
var_dump($_SESSION["REP3CODELIST"]);
print"<br><br>";
var_dump($_POST["codelist"]);
# текущия избор на чекбоксове 
$coli= $_SESSION["REP3CODELIST"];
if (isset($coli)){
		$_POST["codelist"]= $coli;
}else{
}
# само в началото - всички чекбоксове маркирани 
if (isset($_POST["codelist"])){
}else{
	foreach($arcode as $e2co){
		$_POST["codelist"][]= $e2co;
	}
}
*/

# текущия избор на чекбоксове 
$polist= $_POST["codelist"];
$selist= $_SESSION["REP3CODELIST"];
if (isset($polist)){
}else{
	if (isset($selist)){
		$_POST["codelist"]= $selist;
	}else{
		# в началото - всички чекбоксове маркирани 
		foreach($arcode as $e2co){
			$_POST["codelist"][]= $e2co;
		}
	}
}

# списък с маркираните за in() 
$codelist= $_POST["codelist"];
$codelist= (isset($codelist)) ? $codelist : array();
						$arin= array();
foreach($codelist as $e4co){
						$arin[]= "'".$e4co."'";
}
						$codein= (empty($arin)) ? "0" : implode(",",$arin);
$_SESSION["REP3CODEIN"]= $codein;
$_SESSION["REP3CODELIST"]= $codelist;

# сумарни данни за маркираните 
$codesu= "where $filtmain and $filtperi and $codeclai in ($codein)";
$q2= str_replace("[CODEEXTE]",$codesu,$qubase);
$query= str_replace("[CODECLAI]",$codeclai,$q2);
//$tafilt= "(ta.c1+ta.c2+ta.c4+ta.c5+ta.c6)<>0 and (ta.c8+ta.c9+ta.c12+ta.c13+ta.c14)<>0";
$arsuma= $DB->selectRow("$query where $tafilt");
$smarty->assign("ARSUMA", $arsuma);
//print_rr($arsuma);


# извеждаме 
$smarty->assign("ARDATA", $ardata);
$rep2cont= smdisp("rep3v22.tpl","fetch");

?>