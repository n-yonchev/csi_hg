<?php
# 21.04.2010 - за банковите постъпления, на които още не са назначени дела 
# - автоматично зареждаме делото от текстовото описание, ако е възможно 
# източник : finabankedit.ajax.php 

									include_once "common.php";

# стринг за търсене в пълния номер на делото 
# - виж cazo6creadocu.inc.php - function exnu 
$rooffi= getofficerow(0);
$mymark= $rooffi['serial']."04";
										$lemark= strlen($mymark);

$mylist= $DB->select("select id,time,inco,descrip from finance where idtype=1 and idcase=0 order by id");
//$mylist= dbconv($mylist);
							print '
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
							';
							print "<style>td{font:normal 8pt verdana; border-bottom: 1px solid black}</style>";
							print "<table align=center>";
																$totcou= 0;
																$updcou= 0;
foreach($mylist as $elem){
	$myid= $elem["id"];
	$mydesc= $elem["descrip"];
																$totcou ++;
							print "<tr>";
							print "<td valign=top>"."[".$myid."]";
							print "<td valign=top>".$elem["inco"];
							print "<td valign=top>".$elem["time"]."&nbsp;&nbsp;";
							print "<td valign=top>".$mydesc;

#--------------------------------------------------------------------------------------------------------
# източник : finabankedit.ajax.php 
										$mydesc= $elem["descrip"];
										$myindx= strpos($mydesc,$mymark);
//var_dump($myindx);
										if ($myindx===false){
										}else{
											$myseri= substr($mydesc,$myindx+$lemark,5);
											$myyear= substr($mydesc,$myindx-4,4);
//print "\r\n[$mydesc]\r\n[$myseri][$myyear]";
//print "\r\n[$myseri][$myyear]";
												$ser1= $myseri +0;
												$ser2= str_pad($ser1,5,"0",STR_PAD_LEFT);
//print "\r\n[$ser2][$myseri]";
//print "\r\nbegin";
//var_dump($ser2);
//var_dump($myseri);
											# ВНИМАНИЕ. === макар че и 2та аргумента са стрингове 
											# проблема на == е в евентуално различната дължина 
											if ($ser2===$myseri){
//print "\r\n[$ser2]equalto[$myseri]";
												$myarca= $DB->selectCol("select id from suit where serial=?d and year=?d"  ,$myseri+0,$myyear+0);
												if (empty($myarca)){
												}else{
													$myidcase= $myarca[0];
//print "\r\n[$mydesc]\r\n[$myseri][$myyear]";
//print "idcase=[$myidcase]";
							print "<td valign=top><font color=red>[".$myidcase."]</font>";
							print "<td valign=top><font color=red>".($myseri+0)."/".($myyear+0)."</font>";
																$updcou ++;
					$fset= array();
					$fset["idcase"]= $myidcase;
# ВНИМАНИЕ. 
# статуса idauto става 2 
					$fset["isauto"]= 2;
		$DB->query("update finance set ?a where id=?d"  ,$fset,$myid);
												}
											}else{
											}
										}
#--------------------------------------------------------------------------------------------------------

}
							print "<tr>";
							print "<td valign=top><font color=red size=+1>".$totcou."</font>";
							print "<td valign=top><font color=red size=+1>".$updcou."</font>";
							print "</table>";
							print '
</body>
</html>
							';


?>
