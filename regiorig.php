<?php

									include_once "common.php";

$tofile= "register/origins.csv";

$mylist= $DB->select("
	select subject.text, subject.exdata
		,suit.year as caseyear, suit.serial as caseseri
	from subject
	left join suit on subject.idcase=suit.id
	where suit.id is not null
	order by caseyear, caseseri
	");
//print_rr($mylist);
//$mylist= arstrip($mylist);
						
						$f1= fopen($tofile,"w");
foreach($mylist as $elem){
	$elem= arstrip($elem);
	if (empty($elem["exdata"])){
		$ardata= array();
	}else{
		$ardata= unserialize($elem["exdata"]);
	}
			$aset= array();
			$aset[]= $elem["caseyear"];
			$aset[]= regicaseseri($elem["caseseri"]);
//			$aset[]= $ardata["t4type"];
//			$aset[]= $ardata["t4vari"];
# delault = 1 
$aset[]= empty($ardata["t4type"]) ? 1 : $ardata["t4type"];
$aset[]= empty($ardata["t4vari"]) ? 1 : $ardata["t4vari"];
			$aset[]= $elem["text"];
						fputcsv($f1,$aset);
}
						fclose($f1);

//////print "OK";

?>
