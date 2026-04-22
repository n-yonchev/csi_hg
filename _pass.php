<?php
/*
$hist["2009-03-03 12:55:23"]= md5(md5("VELI09slav"));
$hist["2009-07-07 12:15:53"]= md5(md5("veli09SLAV"));
print serialize($hist);
*/
									include_once "common.php";
/*
					$yebegi= 2009;
					$mobegi= 9;	
					$dabegi= 3;
						$dastep= 1;
						$hostep= 1;
						$mistep= 7;
						$sestep= 12;
*/					
			$secostep= 87567;
			$seco= 0;
$mylist= $DB->select("select * from user");
foreach($mylist as $elem){
	$userid= $elem["id"];
			$seco += $secostep;
					$cutime= mktime(1,11,$seco, 9,3,2009);
					$mytime= date("Y-m-d H:i:s",$cutime);
			$aset= array();
			$aset["passcrea"]= $mytime;
					$arhist= array();
					$arhist[$mytime]= $elem["password"];
			$aset["passhist"]= serialize($arhist);
print "<br>[$userid][$mytime]".$elem["password"];
	$DB->query("update user set ?a where id=?d" ,$aset,$userid);
}

?>
