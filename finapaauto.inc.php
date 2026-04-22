<?php
# отгоре : 
# $flagcoun 
#    =true  - autocomplete - за бройките 
#    =false - нормална заявка - за списъка 
# $word - фразата за търсене 

/*
$word= $_GET["q"];
		# ВАЖНО. 
		
		if (isset($word)){
		}else{
$word= $_POST["filtname"];
		}
*/
	/*
	if ($flagcoun){
$word= $_GET["q"];
	}else{
$word= $_POST["filtname"];
	}
	*/

							if ($word==" "){
//$mylist= $DB->select("select id, name from agent order by name");
	if ($flagcoun){
$mycoun= $DB->selectCell("select count(*) from claim2iban");
	}else{
$mylist= $DB->select("select * from claim2iban");
$mylist= dbconv($mylist);
	}
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
//print "[$word][$wordlowe][$leword][$txword]";

//$mylist= $DB->select("select id, name from agent where lower(name) like lower(?) order by name"  ,"%".$txword."%");
$mycode= "
	left join claim2iban on claim2iban.idclaim2=claim2.id
	where lower(claim2.name) like lower(?)
	";
	if ($flagcoun){
$mycoun= $DB->selectCell("select count(*) from claim2 $mycode"  ,"%".$txword."%");
	}else{
//$mylist= $DB->select("select claim2iban.*, claim2iban.id as id, claim2.name as c2name from claim2iban $mycode"  ,"%".$txword."%");
$mylist= $DB->select("select claim2iban.*, claim2iban.id as id, claim2.name as c2name, claim2.id as c2id from claim2 $mycode"  ,"%".$txword."%");
$mylist= dbconv($mylist);
	}
							# if (empty(trim($word))){
							}

?>
