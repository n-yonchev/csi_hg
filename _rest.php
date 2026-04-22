<?php
# 01.10.2009 
# масова проверка на полето finance.rest - неразпределен остатък 

									include_once "common.php";

$mode= $_GET["mode"];
if (isset($mode)){
}else{
	$mode= "view";
}
print "<a href='?mode=view'>view</a>";
print "&nbsp;&nbsp;";
print "<a href='?mode=update'>update</a>";
print "&nbsp;&nbsp;";
print "<a href='?mode=viewall'>viewall</a>";
print "<h3>$mode</h3>";

$mylist= $DB->select("select finance.*
	, suit.serial as caseri, suit.year as cayear
	, finabank.id as idbank
	from finance 
	left join suit on finance.idcase=suit.id
	left join finasource on finasource.idfinance=finance.id
	left join finabank on finasource.idfinabank=finabank.id
	");

						print "<style>td{font:normal 8pt verdana;border}</style>";
						print "<table border=1>";
foreach($mylist as $elem){
	$idcurr= $elem["id"];
	$toclai= $elem["toclai"];
						$suclai= 0;
	if (empty($toclai)){
	}else{
//			$arclam= unserialize($toclai);
			$arclam= unsetoclai($toclai);
//print "<br>";
//print_r($arclam);
			foreach($arclam as $clamou){
						$suclai += $clamou;
			}
			$suclai= round($suclai,2);
	}
//	$rest= $elem["inco"] - $elem["separa"] - $suclai;
	# 06.11.2009 има още separa2 
	$rest= $elem["inco"] - $elem["separa"] - $elem["separa2"] - $suclai;
	$rest= round($rest,2);
/*
	$rest= number_format($rest,2,".","");
print "<br>[$idcurr]=$rest";
	$DB->query("update finance set rest='$rest' where id=$idcurr");
*/
	if ($rest == -0){
		$rest= 0;
	}else{
	}
														if ($mode=="viewall"){
															$flag= true;
														}else{
															$flag= ($rest != $elem["rest"]);
														}
														if ($flag){
						print "<tr>"; 
						print "<td>".$elem["id"];
						print "<td bgcolor='#dddddd'>".$elem["inco"];
						print "<td>".$elem["idtype"];
	$ficode= ($elem["idbank"]==0) ? "-" : "bank/".$elem["idbank"];
						print "<td>".$ficode;
	$cacode= ($elem["idcase"]==0) ? "-" : $elem["caseri"]."/".$elem["cayear"];
						print "<td>".$cacode;
						print "<td bgcolor='#dddddd'>".$elem["separa"];
						print "<td bgcolor='#dddddd'>".$elem["separa2"];
						print "<td bgcolor='#dddddd'>".$suclai;
	$iscl= ($elem["isclosed"]==1) ? "closed" : "-";				
						print "<td>".$iscl;
						print "<td>".$elem["rest"];
	if ($rest==$elem["rest"]){
	}else{
						print "<td><font color=red>".$rest."</font>";
	}
#-------------- update -----------------------------
			if ($mode=="update"){
$rest= number_format($rest,2,".","");
//print "<br>[$idcurr]=$rest";
$DB->query("update finance set rest='$rest' where id=$idcurr");
			}else{
			}
#--------------------------------------------------
														}else{
														# if ($flag){
														}
}
						print "</table>";

?>
