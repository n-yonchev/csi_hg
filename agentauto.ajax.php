<?php
# адвокат autocomplete 
									session_start();
									include_once "common.php";

$word= $_GET["q"];
		$idmark= $_GET["idmark"];
							if ($word==" "){
//$mylist= $DB->selectCol("select name from product order by name");
$mylist= $DB->select("select id, name from agent order by name");
							}else{
$wordlowe= strtolower($word);
//$word= strtolower($_GET["q"]);
//+++$wordconv= mb_convert_case($word, MB_CASE_LOWER, "UTF-8"); 
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

//$mylist= $DB->selectCol("select name from product where lower(substring(name,1,?d))=? order by name"  ,$leword,$txword);
//$mylist= $DB->select("select id, name from agent where lower(substring(name,1,?d))=? order by name"
//,$leword,$txword);
$mylist= $DB->select("select id, name from agent where lower(name) like lower(?) order by name"  ,"%".$txword."%");
//print_r($mylist);
//$mylist= $DB->selectCol("select name from product");
//$mylist= dbconv($mylist);
							# if (empty(trim($word))){
							}
# списък id 
				$arid= array();
foreach($mylist as $elem){
				$arid[]= $elem["id"];
}
# броя дела 
if (empty($arid)){
	$arcoun= array();
}else{
				$codein= implode(",",$arid);
	$arcoun= $DB->selectCol("select count(*),idagent as ARRAY_KEY from suit where idagent in ($codein) group by idagent");
}

//foreach($mylist as $arin=>$arel){
//	$mylist[$arin]= stripslashes($arel);
//}
		$arresu= array();
foreach($mylist as $elem){
//		$arresu[]= $elem["name"]."|".$elem["id"];
//				if ($elem["id"]==$idmark){
//		$arresu[]= "<font color=red>".stripslashes($elem["name"])."</font>" ."|".$elem["id"];
//				}else{
	$idcurr= $elem["id"];
	$cucoun= $arcoun[$idcurr];
//		$arresu[]= stripslashes($elem["name"]) ."|".$elem["id"];
		$arresu[]= stripslashes($elem["name"]) ."|".$idcurr ."|".$cucoun;
//				}
}

print implode("\r\n",$arresu);

?>
