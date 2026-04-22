<?php
# $action 
#    =getlis - списъка с делата 
#    =clear  - изчисти + списъка 
#    =begin  - 

									session_start();
									include_once "common.php";
//$idcase= $_GET["c"];
//$period= $_GET["p"];
//print "idcase=[$idcase][$period]";

$GETPARAM= getparam();
//print_rr($GETPARAM);
$mode= $GETPARAM["mode"];
$period= $GETPARAM["period"];
$vari= $GETPARAM["vari"];
								include_once "rep2.inc.php";

/*
$modeel= "mode=".$mode ."&period=".$period ."&vari=".$vari;
			if (isset($stepview)){
$gurl= geturl($modeel."&step=$stepview");
			}else{
								sleep(2);
				$newstep= $step +1;
if ($newstep>10){
die("END.PROCESS");
}else{
}
$gurl= geturl($modeel."&stepview=$newstep");
			}
$smarty->assign("STEPVIEW", $stepview);
$smarty->assign("GURL", $gurl);
*/
					
# всички дела, които влизат в отчета - по години 
$mylist= $DB->selectCol("
	select year as ARRAY_KEY1, serial as ARRAY_KEY2, idcase
	from `$tarepo`
	where iderror=0
	order by year,serial
	");
//print_rr($mylist);
$smarty->assign("LIST", $mylist);

# таблицата с калкулации 
						if ($action=="clear"){
	creafrom("20_calc", $temp4, "");
						}else{

if (tabexists($temp4)){
}else{
	creafrom("20_calc", $temp4, "");
}
						}
					
# всички дела, за които вече са направени изчисленията 
$calclist= $DB->selectCol("
	select distinct idcase as ARRAY_KEY, 0 
	from `$temp4`
	order by idcase
	");
//print_rr($mylist);
$smarty->assign("CALCLIST", $calclist);

# първото дело от списъка 
				# 15.06.2011 - заради Каримов - няма дела за отчета 
				if (empty($mylist)){
$smarty->assign("IDBEGI", -1);
				}else{
$ark1= array_keys($mylist);
$key1= $ark1[0];
$ark2= array_keys($mylist[$key1]);
$key2= $ark2[0];
$smarty->assign("IDBEGI", $mylist[$key1][$key2]);
				}

# извеждане 
$smarty->assign("PERIOD", $period);
print smdisp("rep2calc.ajax.tpl","iconv");


?>