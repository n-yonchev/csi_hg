<?php
# специален компонент за архив 
# източник : case.php 

						# съществува ли таблицата с архива 
						$dbindx= "Tables_in_exof";
						$arctab= "archive";
						$listtabl= $DB->query("show tables");
									$flagarchive= false;
						foreach($listtabl as $elem){
							if ($elem[$dbindx]==$arctab){
									$flagarchive= true;
								break;
							}else{
							}
						}
//var_dump($flagarchive);
$smarty->assign("FLAGARCHIVE", $flagarchive);

function getarchdata($idcurr){
global $DB;
						if ($GLOBALS["flagarchive"]){
							$roarch= $DB->selectRow("
								select archive.*, archive.id as id, user.name as username
								from archive 
								left join user on archive.iduser=user.id
								where archive.idcase=?d
								" ,$idcurr);
							$roarch= dbconv($roarch);
						}else{
							$roarch= array();
						}
return $roarch;
}


?>
