<?php
# адвокат autocomplete - само бройката 

									session_start();
									include_once "common.php";

/***
$word= $_GET["q"];
							if ($word==" "){
//$mylist= $DB->select("select id, name from agent order by name");
$mycoun= $DB->selectCell("select count(*) from agent");
							}else{
$wordlowe= strtolower($word);
# ВНИМАНИЕ. Специфичен подход за кирилица 
$wordconv= mb_strtolower($word,"UTF-8"); 
# ВНИМАНИЕ. СТРАНЕН ЕФЕКТ на jquery.autocomplete 
# Ако стринга е на кирилица, дължината му е двойна, затова делим на 2. 
if ($wordlowe==$wordconv){
	$txword= $wordlowe;
	$leword= strlen($wordlowe);
}else{
	$txword= $wordconv;
	$leword= (int)(strlen($wordconv)/2);
}
//print "[$leword][$txword]";

//$mylist= $DB->select("select id, name from agent where lower(name) like lower(?) order by name"  ,"%".$txword."%");
$mycoun= $DB->selectCell("select count(*)from agent where lower(name) like lower(?)"  ,"%".$txword."%");
							# if (empty(trim($word))){
							}
***/
/*
		$arresu= array();
foreach($mylist as $elem){
		$arresu[]= $elem["name"]."|".$elem["id"];
}

print implode("\r\n",$arresu);
*/
									$word= $_GET["q"];
									$flagcoun= true;
								include_once "finapaauto.inc.php";
									# получихме $mycoun 

			if ($mycoun==0){
print toutf8("няма записи");
			}elseif ($mycoun==1){
print toutf8("1 запис");
			}else{
print $mycoun .toutf8(" записа");
			}

?>
