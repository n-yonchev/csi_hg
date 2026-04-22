<?php
# синхронизиращ скрипт за полето suit.created 
# нормалния формат е MySQL = yyyy-mm-dd 
# в някои записи се съхраняваше в бг формат = dd.mm.yyyy 
# причина : вземане свободно дело от деловодител 
# виж cazo1modi.ajax.php - коментара от 17.12.2009 

						include_once "common.php";

$que1= "select id, created from suit where substring(created,1,2)<>'20' or substring(created,1,3)='20.'";
$mylist= $DB->select($que1);
						print "count=".count($mylist);
foreach($mylist as $elem){
	$currid= $elem["id"];
	$created= $elem["created"];
						print "<br>[$currid]    $created   -    ";
	$newc= bgdateto($created);
						print "$newc";
	$DB->query("update suit set created='$newc' where id=$currid");
						print "     OK";
}

?>
