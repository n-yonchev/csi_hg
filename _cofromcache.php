<?php

//define("SMARTY_DIR","../../smarty/");
//define("DKLAB_PREFIX","../../");
//								include "../../common.php";

//define("SMARTY_DIR","../smarty/");
//define("DKLAB_PREFIX","../");
//								include "../common.php";

define("SMARTY_DIR","smarty/");
//define("DKLAB_PREFIX","");
								include "common.php";

define("SUFFUTF8","_utf8");
$filename= "cache/_cofrom";
//$query= "select id as ARRAY_KEY, name from cof2 order by id";
//$query= "select id as ARRAY_KEY, name from cofrom order by id";
$query= "select id as ARRAY_KEY, name from cofrom order by serial, id";

# UTF-8 
$ardata= $DB->selectCol($query);
$ardata= array(0=>"") + $ardata;
	file_put_contents($filename.SUFFUTF8,serialize($ardata));
# windows-1251 
$ardata= dbconv($ardata);
	file_put_contents($filename,serialize($ardata));

							$serial= -1;
							foreach($ardata as $arin=>$x2){
								$serial ++;
								$DB->query("update cofrom set serial=?d where id=?d" ,$serial,$arin);
							}

print "OK";

?>
