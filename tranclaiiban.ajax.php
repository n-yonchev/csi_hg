<?php

									session_start();
									include_once "common.php";

$text= strtolower($_GET["q"]);
	$lentext= strlen($text);
$eik= $_GET["eik"];
if (trim($eik)==""){
print toutf8("няма сметки за този ЕИК||");
exit;
}else{
}

									include_once "tran.inc.php";
//					$codejoin= sprintf($bictempjoin,"claimer.iban");
					# 15.02.2018 след грешка при Милен 
					$codejoin= sprintf($bictj2,"claimer.iban");
$listiban= $DB->select("
	select claimer.iban, suit.serial as caseseri, suit.year as caseyear
					, replace(banklist.name,'\"','') as bankname
	from claimer 
	left join suit on claimer.idcase=suit.id
					$codejoin
	where claimer.bulstat=? and lower(substring(claimer.iban,1,?d))=? and (claimer.iban<>'')
	group by claimer.iban
	"  ,$eik,$lentext,$text);

		$arresu= array();
foreach($listiban as $elem){
//		$arresu[]= $elem["iban"]."|".$elem["bic"]."|".$elem["caseseri"]."/".$elem["caseyear"];
		$arresu[]= $elem["iban"]."|".$elem["bankname"]."|".$elem["caseseri"]."/".$elem["caseyear"];
}

print implode("\r\n",$arresu);

?>