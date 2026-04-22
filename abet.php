<?php
# азбучник на участниците - физич/юридич взискат/длъжници 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
//print_r($GETPARAM);
//var_dump( $DB->query("set global max_allowed_packet=2000000") );
//$myvari= $DB->query("show variables");
//var_dump($myvari);
//print_r($myvari);
//++++++++$DB->query("set global max_allowed_packet=2000000");

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

# текущата страница 
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

# 08.02.2011 - по години на делата 
# годината  
	unset($listyear[0]);
	$arke= array_keys($listyear);
$year= $GETPARAM["year"];
$year= isset($year) ? $year : $arke[0];
$smarty->assign("YEAR", $year);
//var_dump($year);
# масива с линкове за годините 
	$baseurl= "mode=".$mode;
		$yearli= array();
foreach ($listyear as $cuyear){
		$yearli[$cuyear]= geturl($baseurl."&year=".$cuyear);
}
$smarty->assign("YEARLIST", $yearli);

# флага за отпечатване 
$prinyes= $GETPARAM["print"];
$flprin= ($prinyes=="yes");
$smarty->assign("FLPRIN", $flprin);

# списъка с буквите 
# union distinct 

							# 07.05.2009 - премахваме кавичките в MySQL стринговете 
//							$upsuna= "upper(substring(name,1,1))";
//$upsuna= "upper(  substring(  replace(  replace(  replace(name,'\\\"','')  ,'\\\\','')  ,\"\'\",'')  ,1,1)  )";
							
						//	$ups1= "replace(  replace(  replace(name,'\\\"','')  ,'\\\\','')  ,\"\'\",'')";
						//	$upsuna= "upper(  substring(  $ups1  ,1,1)  )";
							
//							$ups0= "replace(  replace(  replace(trim(name),char(147),'')  ,char(132),'')  ,'148','')";
//							$ups0= "replace(  replace(  replace(trim(name),char(226),'')  ,char(0),'')  ,'=','=')";
//							$ups0= "replace(  replace(  replace(trim(name),'„','')  ,'”','')  ,'=','=')";
						//	$ups0= "replace(  replace(  replace(trim(name),char(132 using cp1251),'')  ,'”','')  ,'=','=')";
				#  132=„  147=“  148=”  - виж резултата от _abet.php 
//				$ups0= "replace(  replace(  replace(trim(name),char(132 using cp1251),'')  ,char(147 using cp1251),'')  ,char(148 using cp1251),'')";
//				$ups1= "replace(  replace(  replace($ups0,'\\\"','')  ,'\\\\','')  ,\"\'\",'')";
$ups0= "trim(replace(  trim(replace(  trim(replace(trim(name),char(132 using cp1251),''))  ,char(147 using cp1251),''))  ,char(148 using cp1251),''))";
$ups1= "trim(replace(  trim(replace(  trim(replace($ups0,'\\\"',''))  ,'\\\\',''))  ,\"\'\",''))";
				$upsuna= "upper(  substring(  $ups1  ,1,1)  )";

# 08.02.2011 - по години на делата 
/***
$mylist= $DB->select("
	(select distinct $upsuna as letter from claimer) 
	union distinct
	(select distinct $upsuna as letter from debtor) 
	order by letter
	");
***/
$claisuit= "left join suit on claimer.idcase=suit.id where suit.year=$year";
$debtsuit= "left join suit on debtor.idcase=suit.id where suit.year=$year";
$mylist= $DB->select("
	(select distinct $upsuna as letter from claimer	$claisuit) 
	union distinct
	(select distinct $upsuna as letter from debtor $debtsuit) 
	order by letter
	");
//print_rr($mylist);
$mylist= dbconv($mylist);
# 08.02.2011 - по години на делата 
//$baseurl= "mode=".$mode;
$baseurl= "mode=".$mode ."&year=".$year;
# линкове за буквите - без страница 
foreach($mylist as $myin=>$myco){
	$mylist[$myin]["link"]= geturl($baseurl ."&lett=".$myco["letter"]);
$mylist[$myin]["ord"]= ord($myco["letter"]);
}
$smarty->assign("LETTLIST", $mylist);
//file_put_contents("lettlist.txt",print_r($mylist,true));
//print_rr_file($mylist,"lettlist.txt");

# текущата буква 
$lett= $GETPARAM["lett"];
$lett= isset($lett) ? $lett : $mylist[0]["letter"];
$lettutf8= toutf8($lett);
$smarty->assign("CULETT", $lett);
//print toutf8($lett);

# списъка 
//# union all 
//$mylist= $DB->select("select * from cofrom order by name");
		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
//		$query= "select * from cofrom order by name";
//		$query= "select * from claimer order by name";
//		$query= "(select *, 1 as source from claimer) union (select *, 2 as source from debtor) order by name";
					# ВНИМАНИЕ. 
					# Ще страницираме по консолидирани записи, а не по детайлни. 
					#     консолидираме еднаквите записи за отделно юрид/физич лице 
					#     критерий за еднаквост - идентификатора + името 
					# Затова извличаме данните на 2 етапа. 
/*
		$query= "
(select *, 1 as source, $sufi from claimer left join suit on claimer.idcase=suit.id where $upsuna='$lettutf8') 
union all
(select *, 2 as source, $sufi from debtor  left join suit on debtor.idcase=suit.id  where $upsuna='$lettutf8') 
order by name
		";
*/
# етап-1 : консолидирани записи и странициране 
$mycrit1= "case idtype when 1 then bulstat when 2 then egn when 3 then 'other' else 'other' end";
# името - премахваме интервалите и трансформираме малките букви към главни 
							# 07.05.2009 - премахваме кавичките в MySQL стринговете 
//$mycrit2= "upper(replace(name,' ',''))";
							$mycrit2= "upper(replace(  $ups1  ,' ',''))";
# MySQL код за критерия за еднаквост, наричаме го маркер 
# името на 1во място, заради азбучния ред 
$mycrit= "concat($mycrit2,$mycrit1)";

# 08.02.2011 - по години на делата 
/***
		$query= "
(select distinct $mycrit as marker from claimer %s) 
union distinct
(select distinct $mycrit as marker from debtor %s) 
order by marker
		";
$filt= "where $upsuna='$lettutf8'";
***/
$clais2= "left join suit on claimer.idcase=suit.id";
$debts2= "left join suit on debtor.idcase=suit.id";
$codeyear= "suit.year=$year";
		$query= "
(select distinct $mycrit as marker from claimer $clais2 %s) 
union distinct
(select distinct $mycrit as marker from debtor $debts2 %s) 
order by marker
		";
$filt= "where $upsuna='$lettutf8' and $codeyear";

# 08.02.2011 - по години на делата 
# избягваме твърде дълга заявка MySQL 
$uniqname= md5(microtime());
//$qutemp= "create temporary table `$uniqname` $query";
//var_dump($qutemp);
$codeindx= "alter table `$uniqname` add index marker (marker)";
$flagtemp= true;

						if ($prinyes=="yesall"){
							# всички записи - разпечатване на целия азбучник 
		$query= sprintf($query ,"","");
//		$mylist= $DB->select($query);
$qutemp= "create temporary table `$uniqname` $query";
$mylist= $DB->select($qutemp);
$DB->query($codeindx);
						}elseif ($prinyes=="yes"){
							# всички записи за буквата - разпечатване на буква 
		$query= sprintf($query ,$filt,$filt);
//		$mylist= $DB->select($query);
$qutemp= "create temporary table `$uniqname` $query";
$mylist= $DB->select($qutemp);
$DB->query($codeindx);
						}else{
							# само 1 страница за буква - извеждане на буква 
$flagtemp= false;
		$query= sprintf($query ,$filt,$filt);
		$prefurl= "";
# 08.02.2011 - по години на делата 
//		$baseurl= "mode=".$mode ."&lett=".$lett;
$baseurl= "mode=".$mode ."&year=".$year ."&lett=".$lett;
		$obpagi= new paginator(16, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
						}

if ($flagtemp){
}else{
		# получихме списък с уникалните маркери за текущата страница 
		# формираме съответен код за MySQL in 
		$arin= array();
		foreach($mylist as $mycont){
			$arin[]= "'".$mycont["marker"]."'";
		}
		$codein= implode(",",$arin);
		$codein= empty($codein) ? "''" : $codein;
//var_dump($codein);
}

# етап-2 : всички детайлни записи за консолидираните от текущата страница 
					$sufi= "suit.serial as serial, suit.year as year";
/***
		$mylist= $DB->query("
(select claimer.*, $ups1 as name2, 1 as source, $sufi, $mycrit as marker from claimer left join suit on claimer.idcase=suit.id where $mycrit in ($codein)) 
union all
(select debtor.*,  $ups1 as name2, 2 as source, $sufi, $mycrit as marker from debtor  left join suit on debtor.idcase=suit.id  where $mycrit in ($codein)) 
order by marker
		");
***/
# 08.02.2011 - по години на делата 
if ($flagtemp){
//var_dump($uniqname);
/******
$uniq3= $uniqname."-main";
$temp3= "create temporary table `$uniq3`";
//		left join `$uniqname` as t4 on $mycrit=t4.marker
//	where $codeyear and t4.marker is not null
		$my3= $DB->query("
$temp3
(select claimer.*, $ups1 as name2, 1 as source, $sufi, $mycrit as marker 
	from claimer left join suit on claimer.idcase=suit.id 
	where $codeyear 
) 
union all
(select debtor.*,  $ups1 as name2, 2 as source, $sufi, $mycrit as marker 
	from debtor left join suit on debtor.idcase=suit.id  
	where $codeyear 
) 
order by marker
		");
		$mylist= $DB->query("
select t3.*
from `$uniq3` as t3
left join `$uniqname` as t4 on $mycrit=t4.marker
where t4.marker is not null
order by marker
		");
******/
		/******
		$mylist= $DB->query("
(select claimer.*, $ups1 as name2, 1 as source, $sufi, $mycrit as marker 
	from claimer 
		left join suit on claimer.idcase=suit.id 
		left join `$uniqname` on $mycrit=`$uniqname`.marker
	where $codeyear and `$uniqname`.marker is not null
) 
union all
(select debtor.*,  $ups1 as name2, 2 as source, $sufi, $mycrit as marker 
	from debtor 
		left join suit on debtor.idcase=suit.id  
		left join `$uniqname` on $mycrit=`$uniqname`.marker
	where $codeyear and `$uniqname`.marker is not null
) 
order by marker
		");
		******/

		$uniq3= $uniqname."-main3";
		$DB->query("
create temporary table `$uniq3`
	select claimer.*, $ups1 as name21, 1 as source, $sufi, $mycrit as marker 
	from claimer 
		left join suit on claimer.idcase=suit.id 
		left join `$uniqname` on $mycrit=`$uniqname`.marker
	where $codeyear and `$uniqname`.marker is not null
		");
		$uniq4= $uniqname."-main4";
		$DB->query("
create temporary table `$uniq4`
	select debtor.*, $ups1 as name21, 1 as source, $sufi, $mycrit as marker 
	from debtor 
		left join suit on debtor.idcase=suit.id 
		left join `$uniqname` on $mycrit=`$uniqname`.marker
	where $codeyear and `$uniqname`.marker is not null
		");

		$mylist= $DB->query("
(select * from `$uniq3`) 
union all
(select * from `$uniq4`) 
order by marker
		");
$mylist= dbconv($mylist);

/************************************************/
}else{
		$mylist= $DB->query("
(select claimer.*, $ups1 as name21, 1 as source, $sufi, $mycrit as marker 
	from claimer left join suit on claimer.idcase=suit.id 
	where $mycrit in ($codein) and $codeyear
) 
union all
(select debtor.*,  $ups1 as name21, 2 as source, $sufi, $mycrit as marker 
	from debtor  left join suit on debtor.idcase=suit.id  
	where $mycrit in ($codein) and $codeyear
)
order by marker
		");
$mylist= dbconv($mylist);
//print_r($mylist);
//print_r(dbconv($mylist));
}

//# консолидираме еднаквите записи за отделно юрид/физич лице 
//# критерий за еднаквост - идентификатора + името 
# подготвяме за извеждане 
# - консолидираме детайлните записи с еднакъв маркер 
				# резултатен масив 
				$tranlist= array();
				# главен индекс - критерия 
				# индекс [suit] - подмасив за ролята и делото 
				# индекс [addr] - подмасив с адресите 
foreach($mylist as $myin=>$myco){
	# идентификатора - според типа 
	$idtype= $myco["idtype"];
	if (0){
	}elseif ($idtype==1){
		$iden= $myco["bulstat"];
//		$iden2= $iden;
	}elseif ($idtype==2){
		$iden= $myco["egn"];
//		$iden2= $iden;
	}elseif ($idtype==3){
		$iden= "";
//		$iden2= "other";
	}else{
die("abet=1=$idtype");
	}
//	# името - премахваме интервалите и трансформираме малките букви към главни 
//	$name21= strtoupper(str_replace(" ","",$myco["name"]));
//	# критерия 
//	$crit= $iden2 .$name21;
	# критерия 
	$crit= $myco["marker"];
				# типа, идентификатора, името 
				$tranlist[$crit]["type"]= $idtype;
				$tranlist[$crit]["iden"]= $iden;
				$tranlist[$crit]["text"]= $myco["name"];
													# първата буква 
//													$tranlist[$crit]["lett"]= strtoupper(substr($myco["name2"],0,1));
//													$tranlist[$crit]["lett"]= strtoupper(substr($myco["name21"],0,1));
													$tranlist[$crit]["lett"]= substr(trim($crit),0,1);
				# добавяме елемент в подмасива с роли и дела 
					$sub2["role"]= $myco["source"];
					$sub2["seri"]= $myco["serial"];
					$sub2["year"]= $myco["year"];
				$tranlist[$crit]["suit"][]= $sub2;
	# адресите - записваме в подмасива само уникалните адреси 
	# разделяме адресите в масив 
	$address= $myco["address"];
		$delimi= "[_NEW_LINE_]";
	$address= str_replace("\n",$delimi,$address);
	$address= str_replace("\r",$delimi,$address);
	$arad= explode($delimi,$address);
//print_r($arad);
	# за всеки отделен адрес от масива 
	foreach($arad as $arcont){
		if (empty($arcont)){
		}else{
			# добавяме адреса към подмасива с адреси 
			# - само ако е уникален 
			if (!isset($tranlist[$crit]["addr"])){
				$tranlist[$crit]["addr"][]= $arcont;
			}elseif (array_search($arcont, $tranlist[$crit]["addr"])===false){
				$tranlist[$crit]["addr"][]= $arcont;
			}else{
			}
		}
	}
}
//print_r($tranlist);

//# линк за отпечатване на текущата страница 
# 08.02.2011 - по години на делата 
//		$baseurl= "mode=".$mode ."&page=".$page ."&lett=".$lett;
$baseurl= "mode=".$mode ."&year=".$year ."&lett=".$lett ."&page=".$page;
# линк за отпечатване на целия азбучник 
$curint= geturl($baseurl."&print=yes");
$smarty->assign("CURINT", $curint);
		$curintall= geturl($baseurl."&print=yesall");
		$smarty->assign("CURINTALL", $curintall);

# извеждаме 
//$smarty->assign("ADDNEW", $addnew);
//$smarty->assign("LIST", $mylist);
			$tranlist= arstrip($tranlist);
$smarty->assign("LIST", $tranlist);
$smarty->assign("PAGENO", $page);
//$pagecont= smdisp("abet.tpl","fetch");
//print_rr($tranlist);
//file_put_contents("tranlist.txt",print_r($tranlist,true));
//print_rr_file($tranlist,"tranlist.txt");
						
						if (isset($prinyes)){
# 08.02.2011 - по години на делата 
//$fina= ($prinyes=="yesall") ? "азбучник" : "азбучник-буква-$lett";
$fina= ($prinyes=="yesall") ? "азбучник-$year" : "азбучник-$year-$lett";
# отпечатване на всички страници чрез HTML-Excel 
# източник : cazo6prnt.ajax.php 
# съдържанието 
$cont= smdisp("abetprnt.tpl","fetch");
//ExcelHeader("азбучник.xls");
ExcelHeader(trim($fina).".xls");
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
exit;
						}else{
# извеждане на текущата страница 
$pagecont= smdisp("abet.tpl","fetch");
						}

?>
