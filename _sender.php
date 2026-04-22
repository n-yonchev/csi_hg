<?php

				include "common.php";

$data= $DB->selectCol("select distinct `from` from docu");

		$DB->query("truncate table sender");
				//$data2= array();
foreach($data as $elem){
		$DB->query("insert into sender set name='$elem'");
print "<br>" .to1251($elem);
				//$data2[]= '"'.$elem.'"';;
}

				//$data3= implode(",<br>",$data2);
				//print to1251($data3);

print "<br><br>END";

?>