<?php
//print $period;

								include_once "commform.php";
								include_once "rep2.inc.php";

/***
# данните 
$ardata= $DB->select("select idrepo as ARRAY_KEY
	, round(sum(c1),2) as s1, round(sum(c2),2) as s2
	, round(sum(c5),2) as s5, round(sum(c6),2) as s6, round(sum(c7),2) as s7, round(sum(c8),2) as s8, round(sum(c9),2) as s9
	, round(sum(c10),2) as s10, round(sum(c11diff),2) as s11, round(sum(c12diff),2) as s12
	from `$tarepo` 
	group by idrepo
	");
//print_rr($ardata);
//$smarty->assign("DATA", $ardata);
			# буква=колона и поле 
			$arlett= array();
			$arlett["C"]= "s1";
			$arlett["D"]= "s2";
			$arlett["G"]= "s5";
			$arlett["H"]= "s6";
			$arlett["I"]= "s7";
			$arlett["J"]= "s8";
			$arlett["K"]= "s9";
			$arlett["L"]= "s10";
			$arlett["M"]= "s11";
			$arlett["N"]= "s12";
***/

# данните 
$ardata= $DB->select("select idrepo as ARRAY_KEY
	, round(sum(c1),2) as s1, round(sum(c2),2) as s2
	, round(sum(c5),2) as s5, round(sum(c6),2) as s6, round(sum(c7),2) as s7, round(sum(c8),2) as s8, round(sum(c9),2) as s9
	, round(sum(c10),2) as s10, round(sum(c11diff),2) as s11, round(sum(c12diff),2) as s12
, round(sum(c6),2)+round(sum(c7),2) as new5
	from `$tarepo` 
	group by idrepo
	");
//print_rr($ardata);
//$smarty->assign("DATA", $ardata);
			# буква=колона и поле 
			$arlett= array();
			$arlett["C"]= "s1";
			$arlett["D"]= "s2";
$arlett["G"]= "new5";
$arlett["H"]= "s8";
$arlett["I"]= "s9";
$arlett["J"]= "s11";
$arlett["K"]= "s12";
			//$arlett["L"]= "s10";
			//$arlett["M"]= "s11";
			//$arlett["N"]= "s12";

/***
# попълваме според шифрите на редовете - виж commspec.php-$repocode и rep2crea.tpl 
	$arcont= array();
popudata($arcont,7,11);
popudata($arcont,8,12);
	popudata($arcont,10,21);
	popudata($arcont,11,22);
	popudata($arcont,12,23);
popudata($arcont,14,31);
popudata($arcont,15,32);
popudata($arcont,16,33);
popudata($arcont,17,34);
	popudata($arcont,18,4);
$smarty->assign("ARCONT", $arcont);
***/

# попълваме според шифрите на редовете - виж commspec.php-$repocode и rep2crea.tpl 
		$arcont= array();
#-- държ.органи 
popudata($arcont,8,11);
popudata($arcont,9,12);
#-- общини 
popudata($arcont,11,71);
popudata($arcont,12,72);
#-- съдилища 
popudata($arcont,13,8);
#-- юрид.лица и търговци 
popudata($arcont,15,21);
popudata($arcont,16,22);
popudata($arcont,17,23);
#-- граждани 
popudata($arcont,19,31);
popudata($arcont,20,32);
popudata($arcont,21,33);
popudata($arcont,22,34);
#-- чуждестр,решения 
popudata($arcont,23,4);
		$smarty->assign("ARCONT", $arcont);
//print "<br>------ARCONT------";
//print_rr($arcont);
//fp($arcont);
file_put_contents($creaname2, serialize($arcont));

/***
				# резултатен масив за формулите 
				$arform= array();
# формули в колоните 
# ВНИМАНИЕ. колоните преди редовете 
	$colrange= "C-N";
formcol($arform,"6",array("7","+","8"),$colrange);
formcol($arform,"9",array("10","+","11","+","12"),$colrange);
formcol($arform,"13",array("14","+","15","+","16","+","17"),$colrange);
formcol($arform,"5",array("6","+","9","+","13","+","18"),$colrange);
//print_rr($arform);
# формули в редовете 
# ВНИМАНИЕ. редовете след колоните 
	$rowrange= "5-18";
formrow($arform,"E",array("C","+","D"),$rowrange);
	# май-2011 последните 2 колони не се изчисляват, а се зареждат 
//formrow($arform,"N",array("E","-","M"),$rowrange);
formrow($arform,"F",array("G","+","H","+","I","+","J","+","K"),$rowrange);
//print_r($arform);
$smarty->assign("ARFORM", $arform);
***/

				# резултатен масив за формулите 
				$arform= array();
# формули в колоните 
# ВНИМАНИЕ. колоните преди редовете 
	$colrange= "C-K";
formcol($arform,"7",array("8","+","9"),$colrange);
formcol($arform,"10",array("11","+","12"),$colrange);
formcol($arform,"14",array("15","+","16","+","17"),$colrange);
formcol($arform,"18",array("19","+","20","+","21","+","22"),$colrange);
formcol($arform,"6",array("7","+","10","+","13"),$colrange);
formcol($arform,"5",array("6","+","14","+","18","+","23"),$colrange);
//print_rr($arform);
# формули в редовете 
# ВНИМАНИЕ. редовете след колоните 
	$rowrange= "5-23";
formrow($arform,"E",array("C","+","D"),$rowrange);
	# май-2011 последните 2 колони не се изчисляват, а се зареждат 
//formrow($arform,"N",array("E","-","M"),$rowrange);
formrow($arform,"F",array("G","+","H","+","I"),$rowrange);
//print_r($arform);
$smarty->assign("ARFORM", $arform);

# масив с буквите за колоните 
list($first,$last)= explode("-",$colrange);
$ordfir= ord($first);
$ordlas= ord($last);
					$arcols= array();
for ($curr=$ordfir; $curr<=$ordlas; $curr++){
	$chrcurr= chr($curr);
					$arcols[]= $chrcurr;
}
//print_rr($arcols);
$smarty->assign("ARCOLS", $arcols);

# съдържанието 
$cont= smdisp("rep2crea.tpl","fetch");

# извеждаме 
ExcelHeader("rep2-$period.xls");
	
	$outp= "
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\" />
<body>
	$cont
</body>
</html>
	";

print $outp;



# попълваме според шифрите на редовете - виж commspec.php-$repocode и rep2crea.tpl 
function popudata(&$arcont,$rownum,$idrepo){
global $ardata, $arlett;
//print "<br>popudata=[$rownum]=idrepo=[$idrepo]";
		foreach($arlett as $colo=>$fiel){
//print "<br>colo=[$colo][$fiel]==".$e2[$fiel];
			$arcont[$rownum][$colo]= str_replace(".",",",  $ardata[$idrepo][$fiel]  );
//print "____arcont=[$rownum][$colo]=".$ardata[$idrepo][$fiel];
		}
}

?>
