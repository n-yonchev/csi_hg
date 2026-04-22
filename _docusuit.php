<?php
# 13.04 2009 
# един документ - много дела 
# формираме референтната таблица 

						include "common.php";

				$DB->query("truncate table docusuit");
$lidocu= $DB->select("select * from docu order by id");
foreach($lidocu as $lielem){
	if ($lielem["idcase2"] >0){
print $lielem["id"] ." ";
				$DB->query("insert into docusuit set iddocu=?, idcase=?" ,$lielem["id"],$lielem["idcase2"]);
	}else{
	}
}

?>
