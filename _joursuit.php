<?php
# 06.10.2010 - синхронизация 
# в дневника на изв.действия ръчно добавените действия може да имат списък с дела, а не само едно 
# формира се референтна табл.joursuit 

								include_once "common.php";

		$DB->query("truncate table joursuit");

$mylist= $DB->selectCol("select idcase, id as ARRAY_KEY from jour");
foreach($mylist as $idjour=>$idcase){
		$aset= array();
		$aset["idjour"]= $idjour;
		$aset["idcase"]= $idcase;
		$DB->query("insert into joursuit set ?a"  ,$aset);
}

print "OK";

?>
