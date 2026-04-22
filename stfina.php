<?php
# състояние на постъпленията към момента 
//print "STFINA";

						# тип - броя, лева 
//print_r($GETPARAM);
						//$GETPARAM= getparam();
						$type= $GETPARAM["type"];
						if (isset($type)){
						}else{
							$type= "count";
						}
						if ($type=="count"){
							$what= "count(finance.id)";
							$whattext= "броя";
						}elseif ($type=="amount"){
							$what= "sum(finance.inco)";
							$whattext= "лева";
						}else{
die("type=[$type]");
						}
							$modeel= "mode=".$mode;
							$arlink= array();
							$arlink["count"]= geturl($modeel."&type=count");
							$arlink["amount"]= geturl($modeel."&type=amount");
						$smarty->assign("ARLINK", $arlink);
						$smarty->assign("TYPE", $type);
						$smarty->assign("WHATTEXT", $whattext);

# общо - насочени-ненасочени 
/*
$que1= "select if(idcase=0,0,1) as ARRAY_KEY, count(*) as coun
	from finance 
	where 1
	group by if(idcase=0,0,1)
	";
$mylist= $DB->selectCol($que1);
*/
//print_r($mylist);
# - всички 
$mylist= getdata(true);
$smarty->assign("DATA", $mylist);
# - само банковите 
$mylist= getdata(false);
$smarty->assign("DATABANK", $mylist);

# насочените по деловодители 
/*
$que2= "select suit.iduser as ARRAY_KEY_1, if(rest=0,1,0) as ARRAY_KEY_2, isclosed as ARRAY_KEY_3, count(*) as coun
	from finance 
	left join suit on finance.idcase=suit.id
	where finance.idcase<>0
	group by suit.iduser, if(rest=0,1,0), isclosed
	";
$mylist= $DB->selectCol($que2);
//print_r($mylist);
*/
# - всички 
$mylist= getdatauser(true);
$smarty->assign("DATAUSER", $mylist);
# - само банковите 
$mylist= getdatauser(false);
$smarty->assign("DATAUSERBANK", $mylist);

# деловодителите в азб.ред 
//$userlist= getselect("user","name","1",false);
		# 24.06.2010 - само деловодителите с дела 
		# ликвидираме деловодителите с празни редове в статистиката 
		$userlist= $DB->selectCol("
			select user.id as ARRAY_KEY, user.name
			from suit
			left join user on suit.iduser=user.id
			where user.id is not null
			group by user.id
			order by user.name
			");
//			where suit.iduser<>0 and user.id is not null
# накрая фиктивния деловодител за сумата 
	$userlist= tran1251($userlist);
$userlist[-1]= "ВСИЧКО";
# 12.05 2011 Бъзински има и дела без деловодител 
//$userlist[0]= "---без деловодител---";
$userlist= array(0=>"[без деловодител]") + $userlist;
$smarty->assign("USERLIST", $userlist);

# линк за отпечатване на текущата страница 
//		$baseurl= "mode=".$mode."&page=".$page."&year=".$year;
		$baseurl= "mode=".$mode."&type=".$type;
$curint= geturl($baseurl."&print=yes");
$smarty->assign("CURINT", $curint);
									
# флага за отпечатване 
$prinyes= $GETPARAM["print"];
$flprin= ($prinyes=="yes");
$smarty->assign("FLPRIN", $flprin);
						
						if ($flprin){
# изход в Excel 
$cont= smdisp("stfina.tpl","fetch");
//ExcelHeader("статистика-$sttext.xls");
ExcelHeader("постъпления-$whattext.xls");
	$outp= "
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\" />
<body>
	$cont
</body>
</html>
	";
//<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
//print $cont;
print $outp;
//exit;
						}else{
# извеждаме 
//$smarty->assign("LIST", $mylist);
$pagecont= smdisp("stfina.tpl","fetch");
						}


# функции с/без филтър за банковите постъпления 
function getdata($fall){
global $DB;
global $what;
	if ($fall){
		$que1= "select if(idcase=0,0,1) as ARRAY_KEY, $what
			from finance 
			group by if(idcase=0,0,1)
			";
	}else{
		$que1= "select if(finance.idcase=0,0,1) as ARRAY_KEY, $what
			from finance 
					left join finasource on finasource.idfinance=finance.id
			where 
					finasource.id is not null
			group by if(finance.idcase=0,0,1)
			";
	}
	$mylist= $DB->selectCol($que1);
return $mylist;
}
function getdatauser($fall){
global $DB;
global $what;
	if ($fall){
		$que2= "select suit.iduser as ARRAY_KEY_1, if(finance.rest=0,1,0) as ARRAY_KEY_2
			, finance.isclosed as ARRAY_KEY_3, $what
			from finance 
			left join suit on finance.idcase=suit.id
			where finance.idcase<>0
			group by suit.iduser, if(finance.rest=0,1,0), finance.isclosed
			";
	}else{
		$que2= "select suit.iduser as ARRAY_KEY_1, if(finance.rest=0,1,0) as ARRAY_KEY_2
			, finance.isclosed as ARRAY_KEY_3, $what
			from finance 
					left join finasource on finasource.idfinance=finance.id
			left join suit on finance.idcase=suit.id
			where finance.idcase<>0
					and finasource.id is not null
			group by suit.iduser, if(finance.rest=0,1,0), finance.isclosed
			";
	}
	$mylist= $DB->selectCol($que2);
//var_dump($fall);
//print "<br>$que2<br>";
//print_r($mylist);
	# сумираме по полета общо за всички деловодители 
							$sumall= array();
	foreach($mylist as $iduser=>$ele1){
		foreach($ele1 as $isrest=>$ele2){
			foreach($ele2 as $isclos=>$ele3){
							$sumall[$isrest][$isclos] += $ele3;
			}
		}
	}
	# записваме сумарния резултат на фиктивен деловодител [-1] 
	$mylist[-1]= $sumall;
return $mylist;
}


?>
