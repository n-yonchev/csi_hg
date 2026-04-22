<?php
# служебно образуване на дела за минали години 
# източник : _creasuit.php - служебно образуване на дела за текущата година 
# източник : baseyear.ajax.php - за минали години 
# 14.02.2011 
#    - за всички минали години според бройките в office.yearcount 
#    - ако сер.номер на делото вече съществува - не се създава 
# може да се пуска многократно 

								include_once "common.php";

/***
# 20.09.2010 - Дичев 
$year= 2010;
$coun= 863;

print "year=$year suit=$coinse";
***/

$rooffi= getofficerow(1);
$yeco= $rooffi["yearcount"];
if (empty($yeco)){
	$arcoun= array();
}else{
	$arcoun= unserialize($yeco);
}

foreach($arcoun as $year=>$coun){
	$coin= creayear($year,$coun);
print "<br>$year=$coun=$coin";
}

function creayear($year,$coun){
global $DB;
	$mylist= $DB->selectCol("select serial from suit where year=?d"  ,$year);
							$coinse= 0;
		for ($myse=1; $myse<=$coun; $myse++){
			if (in_array($myse,$mylist)){
			}else{
				$iset= array();
				$iset["serial"]= $myse;
				$iset["year"]= $year;
				$iset["created"]= "$year-01-01";
				$iset["creainfo"]= "/1";
				$DB->query("insert into suit set ?a"  ,$iset);
							$coinse ++;
			}
		}

return $coinse;
}

?>
