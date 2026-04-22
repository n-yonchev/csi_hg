<?php

				include "common.php";

$arcont= file("_banklist/banklist.txt");
//print_r($arcont);

		$DB->query("truncate table banklist");

foreach($arcont as $elem){
//var_dump($elem);
		$aset= array();
		$aset["name"]= toutf8($elem);
		$DB->query("insert into banklist set ?a"  ,$aset);
//print "<br>" .to1251($elem);
print "<br>" .$elem;
}

print "<br><br>END";

?>