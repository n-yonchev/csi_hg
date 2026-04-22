<?php
# отчет ВСС по взискатели - странициране, търсене, отваряне надолу, затваряне 
print_rr($GETPARAM);
//print_rr($_POST);


# текущата страница 
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

# филтър - име 
$filtname= $GETPARAM["filtname"];
$filtpost= $_POST["filtname"];
if (isset($filtpost)){
	$filtname= $filtpost;
	$page= 1;
}else{
}
$smarty->assign("FILTNAME", tran1251($filtname));
if (empty($filtname)){
	$whname= "1";
}else{
	$myfilt= "%".$filtname."%";
//		$whname= "(lower(t1.name) like lower('$myfilt') or t1.iden like '$myfilt')";
	if (ctype_digit($filtname)){
		$whname= "lower(t1.iden) like lower('$myfilt')";
	}else{
		$whname= "lower(t1.name) like lower('$myfilt')";
	}
}

# код за взискател 
//$codeclai= "concat(t1.name,'^',t1.iden,'^',t1.idtype)";
$codeclai= "concat(t1.iden,'^',t1.idtype)";

/*
# само несвършени преди периода и образувани през периода 
$filtperi= "tacoun.var1<>'00' and tacoun.var2<>'00'";

# заявката 
$query= "
	select ta.*
		, ta.c1+ta.c2 as c3
		, ta.c1+ta.c2 -ta.c4-ta.c5-ta.c6 as c7
		, ta.c8+ta.c9 as c10
		, ta.c12+ta.c13 as c11
		, (ta.c8+ta.c9)-(ta.c12+ta.c13) as c15
	from (
		select $codeclai as code
			, sum(tacoun.c1) as c1, sum(tacoun.c2) as c2, sum(tacoun.c4) as c4, sum(tacoun.c5) as c5, sum(tacoun.c6) as c6
			, round(sum(round(t2.c1,2)),2) as c8, round(sum(round(t2.c2,2)),2) as c9
			, round(sum(round(t2.c8,2)),2) as c12, round(sum(round(t2.c9,2)),2) as c13, round(sum(round(t2.c11diff,2)),2) as c14
			, count(t1.idcase) as coun
		$qufrom
		where $whname and $filtperi
		group by $codeclai
		order by $codeclai
	) as ta
	";
*/

# заявката 
$codeex= "
		where $whname and $filtperi
		group by $codeclai
		order by t1.name
	";
//		order by $codeclai
$q2= str_replace("[CODEEXTE]",$codeex,$qubase);
$query= str_replace("[CODECLAI]",$codeclai,$q2);
$tafilt= "(ta.c1+ta.c2+ta.c4+ta.c5+ta.c6)<>0 and (ta.c8+ta.c9+ta.c12+ta.c13+ta.c14)<>0";
$query= "$query where $tafilt";

# данни за тек.страница 
$mode2= "mode=".$mode ."&period=".$period ."&vari=".$vari ."&filtname=".$filtname;
					include "pagi.class.php";
		$prefurl= "";
$baseurl= $mode2;
//var_dump($baseurl);
		$obpagi= new paginator(12, 8, $query);
		$ardata= $obpagi->calculate($page, $prefurl, $baseurl);
//print_rr($ardata);
$ardata= dbconv($ardata);

# трансформация 
				$modeel= $mode2 ."&page=".$page;
									$arin= array();
foreach ($ardata as $indx=>$elem){
									$arin[]= "'".$elem["code"]."'";
//	list($name,$iden,$type)= explode("^",$elem["code"]);
	list($iden,$type)= explode("^",$elem["code"]);
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
	$ardata[$indx]["codeut"]= toutf8($elem["code"]);
}
//print_rr($ardata);
									$codein= (empty($arin)) ? "0" : implode(",",$arin);
									$codein= toutf8($codein);
//print_ru($arin);
//var_dump(toutf8($codein));

# детайлни данни 
$ar2= $DB->select("
	select ta.*
		, ta.c1+ta.c2 as c3
		, ta.c1+ta.c2 -ta.c4-ta.c5-ta.c6 as c7
		, ta.c8+ta.c9 as c10
		, ta.c12+ta.c13 as c11
		, (ta.c8+ta.c9)-(ta.c12+ta.c13) as c15
	from (
		select $codeclai as ARRAY_KEY1, t1.idcase as ARRAY_KEY2
			, concat(suit.serial,'/',suit.year) as caye
			, tacoun.c1, tacoun.c2, tacoun.c4, tacoun.c5, tacoun.c6
			, round(t2.c1,2) as c8, round(t2.c2,2) as c9
			, round(t2.c8,2) as c12, round(t2.c9,2) as c13, round(t2.c11diff,2) as c14
		$qufrom
		where $codeclai in ($codein) and $filtperi
/*		order by suit.year, suit.serial		*/
	) as ta
	where $tafilt
	order by ta.year+0, ta.serial+0
	");
//print_rr($ar2);
$ar2= dbconv($ar2);
print "REP3V2.php";
fp($ar2);
$smarty->assign("AR2", $ar2);


# извеждаме 
$smarty->assign("ARDATA", $ardata);
$rep3cont= smdisp("rep3v2.tpl","fetch");

?>