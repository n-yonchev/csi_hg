<?php
# към регистъра - всички дела на логнатия юзер - формиране и предаване 
# отгоре : 
#     $mode - режима 
//print_rr($_SESSION);
//print_rr($GETPARAM);

/*
# логнатия юзер 
$iduser= @$_SESSION["iduser"];
$rouser= getrow("user",$iduser);
$usname= $rouser["name"];
//$uspref= cyrlat($usname) ."_";
$uspref= cyrlat($usname);
//var_dump($uspref);
*/
									include_once "reg2.inc.php";

# логнатия юзер 
list($usnameregi,$uspref)= getreginame($_SESSION["iduser"]);
# за линка към посл.резултат 
$tolast= "regila";
# израз за филтрите по дела 
	$iduser= @$_SESSION["iduser"];
	if ($iduser==0){
die("regiustose=1");
	}else{
	}
$_SESSION["coderegiuser"]= "=$iduser";

# предаваме надолу : 
#     $usname - име на логнатия 
#     $uspref - групово файлово име 

							include "regius.inc.php";

?>