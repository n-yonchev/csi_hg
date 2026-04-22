<?php
# 31.05.2010 - консолидация на взискателите и техните банкови снетки 
# ВНИМАНИЕ. 
#    Създават се нови таблици - claim2, claim2iban 
#    Извън този скрипт има средство за промени в тези таблици 
#    - корекция на имена, добавяне/редактиране на сметки 
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
		';

# чистим новите таблици 
$DB->query("truncate table claim2");
$DB->query("truncate table claim2iban");
# добавяме 4 служебни записа за псевдо взискатели 
# ВНИМАНИЕ. 
# Полето id не е unsigned и получава стойности -3,-2,-1,0 
	$aset= array();
	$aset["id"]= -3;
	$aset["name"]= toutf8("_за ЧСИ неолихвяеми");
$DB->query("insert into claim2 set ?a"  ,$aset);
	$aset= array();
	$aset["id"]= -2;
	$aset["name"]= toutf8("_за ЧСИ т.26");
$DB->query("insert into claim2 set ?a"  ,$aset);
/*
	$aset= array();
	$aset["id"]= -1;
	$aset["name"]= toutf8("_за връщане");
$DB->query("insert into claim2 set ?a"  ,$aset);
	$aset= array();
	$aset["id"]= 0;
	$aset["name"]= toutf8("_");
$DB->query("insert into claim2 set ?a"  ,$aset);
*/

				# премахваме всички видове кавички - още при четенето с MySQL, в PHP не става 
				#  132=„  147=“  148=”  - виж резултата от _abet.php 
				$ups0= "replace(  replace(  replace(trim(name),char(132 using cp1251),'')  ,char(147 using cp1251),'')  ,char(148 using cp1251),'')";
				$ups1= "replace(  replace(  replace($ups0,'\\\"','')  ,'\\\\','')  ,\"\'\",'')";
# полетата от всички записи с взискатели 
//$mylist= $DB->select("select id, idtype, egn, bulstat, name, iban, bic from claimer");
$mylist= $DB->select("select id, idtype, egn, bulstat, $ups1 as name, iban, bic from claimer");
foreach($mylist as $elem){
	$id= $elem["id"];
	$idtype= $elem["idtype"];
//	$name= $elem["name"];
	$iban= $elem["iban"];
	$bic= $elem["bic"];
//$name= stripslashes($elem["name"]);
$name= $elem["name"];
print "<br>[$id] $name";
	if (0){
	}elseif ($idtype==1){
		# юридич.лице - bulstat 
		$bulstat= $elem["bulstat"];
		$idclaim2= doclaim2($elem,"bulstat",$bulstat);
	}elseif ($idtype==2){
		# физич.лице - egn 
		$egn= $elem["egn"];
		$idclaim2= doclaim2($elem,"egn",$egn);
	}elseif ($idtype==3){
		# друго - name 
		$name= $elem["name"];
		$idclaim2= doclaim2($elem,"name",$name);
	}else{
print_rr($elem);
die("type-error");
	}
	#------ claim2iban ------
	if ($iban=="" and $bic==""){
				$idclaim2iban= 0;
	}else{
				$idclaim2iban= $DB->selectCell("
					select id from claim2iban where idclaim2=?d and iban=? and bic=?
					"  ,$idclaim2,$iban,$bic);
				if ($idclaim2iban==0){
					$aset= array();
					$aset["idclaim2"]= $idclaim2;
					$aset["iban"]= $iban;
					$aset["bic"]= $bic;
						$idclaim2iban= $DB->query("insert into claim2iban set ?a"  ,$aset);
				}else{
				}
	}
/*
	#------ записваме новите указатели за взискателя ------
	$aset= array();
	$aset["idclaim2"]= $idclaim2;
	$aset["idclaim2iban"]= $idclaim2iban;
	$DB->query("update claimer set ?a where id=?d"  ,$aset,$id);
print "<br>$id=$idclaim2=$idclaim2iban";
*/
//$name= stripslashes($elem["name"]);
//print "<br>[$id] $name";
}

print "<br><br>OK";


function doclaim2($rocont,$finame,$ficont){
global $DB;
	$idtype= $rocont["idtype"];
	$name= $rocont["name"];
				$idclaim2= $DB->selectCell("select id from claim2 where idtype=?d and $finame=?"  ,$idtype,$ficont);
		if ($idclaim2==0){
			$aset= array();
			$aset["idtype"]= $idtype;
						//$name= trim($name);
						//$name= str_replace('"','',$name);
						//$name= str_replace("\\",'',$name);
						//$name= str_replace('„','',$name);
			/*
						# премахваме всички видове кавички 
						$name= str_replace(
							array('\"', '"', '“', '”')
							,array("","","","")
							,$name);
			*/
			$aset["name"]= $name;
			$aset[$finame]= $ficont;
				$idclaim2= $DB->query("insert into claim2 set ?a"  ,$aset);
print " [$idclaim2] $name";
		}else{
		}
return $idclaim2;
}

?>
