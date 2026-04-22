<?php
# служебно образуване на дела за текущата година 
# източник : baseyear.ajax.php - за минали години 

								include_once "common.php";
/*
# 20.09.2010 - Дичев 
$year= 2010;
$coun= 863;
*/
/***
# 14.02.2011 - Каримов Самоков 
$year= 2011;
$coun= 72;
***/
# 25.02.2011 - Недялков Костинброд 
$year= 2011;
$coun= 90;

							$coinse= 0;
		for ($myse=1; $myse<=$coun; $myse++){
//			if (in_array($myse,$mylist)){
//			}else{
				$iset= array();
				$iset["serial"]= $myse;
				$iset["year"]= $year;
				$iset["created"]= "$year-01-01";
				$iset["creainfo"]= "/1";
				$DB->query("insert into suit set ?a"  ,$iset);
							$coinse ++;
//			}
		}

print "year=$year suit=$coinse";

?>
