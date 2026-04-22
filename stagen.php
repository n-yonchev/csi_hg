<?php
# представители и брой дела за всеки 
# източници : 
#    agent.php - администриране - представители 
#    rep1.php  - отчет раздел 1 

# основните параметри 
		$stmont= $GETPARAM["mont"];
		$stperi= $GETPARAM["peri"];
//print "[$mode][$year][$stmont][$stperi]";
$smarty->assign("MONT", $stmont);
//var_dump($stperi);
list($d1,$d2)= explode("^",$stperi);
$smarty->assign("D1", $d1);
$smarty->assign("D2", $d2);

# филтъра 
$finame= "suit.created";
			if (!empty($stmont)){
$filter= "year($finame)=$year and month($finame)=$stmont";
			}else{
$filter= "$finame>='$d1' and $finame<='$d2'";
			}
//var_dump($filter);
									
# флага за отпечатване 
$prinyes= $GETPARAM["print"];
$flprin= ($prinyes=="yes");
$smarty->assign("FLPRIN", $flprin);
///////////////////////$flprin= false;
						
						if ($flprin){

//	select count(*) as coun, if(agent.id is null,'няма представител',agent.name) as agname
//	select count(*) as coun, if(suit.idagent=0,'няма представител',agent.name) as agname
//	select count(*) as coun, if(agent.name='','няма представител',agent.name) as agname
$mylist= $DB->select("
	select count(*) as coun, agent.name as agname
	from suit
	left join agent on suit.idagent=agent.id
where $filter
	group by suit.idagent
	order by coun desc
	");
$mylist= dbconv($mylist);
$mylist= arstrip($mylist);
//print_rr($mylist);
$smarty->assign("LIST", $mylist);

# изход в Excel 
$cont= smdisp("stagen.tpl","fetch");
ExcelHeader("представители.xls");
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

# URL за вътр.фрейм, който извежда 
//$urlcreate= geturl("mode=".$mode."&print=yes");
$urlcreate= geturl("mode=".$mode."&year=".$year."&mont=".$stmont."&peri=".$stperi."&print=yes");
$smarty->assign("URLCREATE", $urlcreate);
# извеждаме 
//$smarty->assign("LIST", $mylist);
$pagecont= smdisp("stagen.tpl","fetch");

						}


?>
