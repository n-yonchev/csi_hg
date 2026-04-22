<?php
# 11.06.2010 
# - разнасяне на разпределенията за всяко постъпление 
# от полето finance.toclai в нова таблица finatran 
# ВНИМАНИЕ. 
#    Запълва  се новa таблицa - finatran 
#    Извън този скрипт има средство за промени в тази таблица 
#    - добавяне/редактиране на сметки iban, bic, idclaim2, пакет за превод idfinatranpack, флага за преведена isdone 
# Поради което : 
#    Скрипта да се изпълни еднократно. 
# Възможни са следващи изпълнения, но 
#    Всяко следващо изпълнение ще унищожи евентуалните промени в таблиците 

									include "common.php";
		print '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body style="font: normal 8pt verdana">
<style>
td {font: normal 8pt verdana; border-bottom: 1px solid black;}
</style>
		';

# чистим новата таблица 
$DB->query("truncate table finatran");

			$arfina= array();
			$arfina["separa"]= -3;
			$arfina["separa2"]= -2;
			$arfina["back"]= -1;

# четем данните 
# само типовете 1=банково, 2=в.брой, 7=старо 
# без типа 9=директно.взискателя 
# само неприключените 
$mylist= $DB->select("select id, separa, separa2, back, toclai from finance where idtype in (1,2,7) and isclosed=0");
					print "<table>";
									$nome= 0;
# действие 
foreach($mylist as $elem){
									$nome ++;
									if ($nome % 30 ==1){
					print "<tr bgcolor='#dddddd'>";
						print "
					<td> no
					<td> id
					<td> separa
					<td> separa2
					<td> back
					<td> toclai
					<td> finatran
						";
									}else{
									}
					print "<tr>";
	$id= $elem["id"];
	$separa= $elem["separa"];
	$separa2= $elem["separa2"];
	$back= $elem["back"];
	$toclai= $elem["toclai"];
						print "
					<td> $nome
					<td bgcolor='#dddddd'> $id
					<td> $separa
					<td> $separa2
					<td> $back
					<td>
						";
	$artoclai= unsetoclai($toclai);
	foreach($artoclai as $idclai=>$clamou){
						print "
					<font color=red>[$idclai]</font>=$clamou <br>
						";
	}
									//$coun= count($artoclai);
									//if ($coun>1){
									//	print "<h1>$coun</h1>";
									//}else{
									//}
						print "<td>";
				# нови записи - псевдо взискатели 
				foreach($arfina as $finame=>$ficode){
					$ficont= $elem[$finame];
					if ($ficont==0){
					}else{
							$aset= array();
							$aset["idfinance"]= $id;
							$aset["idclaimer"]= $ficode;
							$aset["amount"]= $ficont;
						$newid= $DB->query("insert into finatran set ?a, created=now()"  ,$aset);
						print "[$newid]=".$aset["idfinance"]."=<font color=red>[".$aset["idclaimer"]."]</font>=".$aset["amount"] ."<br>";
					}
				}
				# нови записи - взискатели 
				foreach($artoclai as $idclai=>$clamou){
					$ficont= $clamou;
					if ($ficont==0){
					}else{
							$aset= array();
							$aset["idfinance"]= $id;
							$aset["idclaimer"]= $idclai;
							$aset["amount"]= $ficont;
						$newid= $DB->query("insert into finatran set ?a, created=now()"  ,$aset);
						print "[$newid]=".$aset["idfinance"]."=<font color=red>[".$aset["idclaimer"]."]</font>=".$aset["amount"] ."<br>";
					}
				}
}
					print "</table>";

print "<br>OK";

?>
