<?php
# източник : agentautocoun.ajax.php 
# име наблюдател autocomplete - само бройката 

									session_start();
									include_once "common.php";

$word= $_GET["q"];
							if ($word==" "){
$mycoun= $DB->selectCell("select count(*) from viewer");
							}else{
$wordlowe= strtolower($word);
$wordconv= mb_strtolower($word,"UTF-8"); 
if ($wordlowe==$wordconv){
	$txword= $wordlowe;
	$leword= strlen($wordlowe);
}else{
	$txword= $wordconv;
	$leword= (int)(strlen($wordconv)/2);
}
//print "[$leword][$txword]";

$mycoun= $DB->selectCell("select count(*)from viewer where lower(name) like lower(?)"  ,"%".$txword."%");
							# if (empty(trim($word))){
							}

			if ($mycoun==0){
print toutf8("няма записи");
			}elseif ($mycoun==1){
print toutf8("1 запис");
			}else{
print $mycoun .toutf8(" записа");
			}

?>
