<?php
# взискатели и брой дела за всеки 
# източници : 
#    stagen.php+tpl - представители и брой дела 
//print "----stclai----<br>";
//print_rr($GETPARAM);
//print "[$mode][$year][$stmont][$stperi]";

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
//var_dump($flprin);
$smarty->assign("FLPRIN", $flprin);
///////////////////////$flprin= false;
						
						if ($flprin){

# данните 
$codeclai= "case 
	when claimer.idtype=1 then concat(claimer.idtype,'^',claimer.bulstat) 
	when claimer.idtype=2 then concat(claimer.idtype,'^',claimer.egn) 
	else concat(claimer.idtype,'^',claimer.name) 
	end";
/*
$mylist= $DB->select("
	select count(claimer.*) as coun, claimer.idtype, claimer.name, $codeclai as codeclai
	from claimer
	group by $codeclai
	order by coun desc
	");
*/
$mylist= $DB->select("
	select count(claimer.id) as coun, claimer.idtype, claimer.name, $codeclai as codeclai
	from claimer
left join suit on claimer.idcase=suit.id
where $filter
	group by $codeclai
	order by coun desc
	");
foreach ($mylist as $uskey=>$uscont){
	list($idtype,$iden)= explode("^",$uscont["codeclai"]);
	if ($idtype==1){
		$buls= $iden;
		$egnn= "";
	}elseif ($idtype==2){
		$buls= "";
		$egnn= $iden;
	}else{
		$buls= "";
		$egnn= "";
	}
	$mylist[$uskey]["bulstat"]= $buls;
	$mylist[$uskey]["egn"]= $egnn;
}
$mylist= dbconv($mylist);
$mylist= arstrip($mylist);
//print_rr($mylist);
$smarty->assign("LIST", $mylist);

# изход в Excel 
$cont= smdisp("stclai.tpl","fetch");
ExcelHeader("взискатели.xls");
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
$pagecont= smdisp("stclai.tpl","fetch");

						}


?>
