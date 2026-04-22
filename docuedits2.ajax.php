<?php
# разглеждане на избран сканиран образ за избран вх.документ 
# извежда се в iframe -  БЕЗ нормалното обкръжение 

									//session_start();
									include_once "common.php";
$scanview= $_GET["p1"];
$cuindx= $_GET["p2"];
//$arscan= $DB->select("select * from docuscan where iddocu=?d order by id"  ,$scanview);
			$p3= $_GET["p3"];
			if (isset($p3)){
//				$tafrom= "docuoutscan";
				$isdocuout= true;
			}else{
//				$tafrom= "docuscan";
				$isdocuout= false;
			}
							# всичко за сканираните вх.документи 
							include_once "docuedituplo.inc.php";

$arscan= $DB->select("select * from $tascan where iddocu=?d order by id"  ,$scanview);

				$idscan= $arscan[$cuindx]["id"];
				$suffix= $arscan[$cuindx]["suffix"];
$scanname= $filedire.$idscan.".".$suffix;
//var_dump($scanname);
$contdocu= file_get_contents($scanname);
//header("Content-type: application/$suffix");
/*
				$suffmime= $armime[$suffix];
				if (isset($suffmime)){
header("Content-type: $suffmime");
print $contdocu;
				}else{
print toutf8("<center>тип на файла <font size=+1>$suffix</font> не може да сe изобрази</center>");
				}
*/
				$suffmime= $armime[$suffix];
header("Content-type: $suffmime");
print $contdocu;

?>