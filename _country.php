<?php

									include_once "common.php";

$fromfile= "register/countries.txt";

				$DB->query("truncate table country");
$cont= file($fromfile);
foreach($cont as $elem){
	list($name,$code)= explode(";",$elem);
	$aset= array();
	$aset["code"]= $code;
	$aset["name"]= $name;
				$DB->query("insert into country set ?a"  ,$aset);
}

print "OK";

?>
