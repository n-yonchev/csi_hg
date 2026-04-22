<?php
# към регистъра - всички дела - формиране и предаване 
# отгоре : 
#     $mode - режима 
//print_rr($_SESSION);
//print_rr($GETPARAM);
									include_once "reg2.inc.php";

# деловодителя 
//list($usname,$uspref)= getreginame(0);
$usnameregi= "НА КАНТОРАТА";
$uspref= "ALL";
# за линка към посл.резултат 
$tolast= "regilafu";
# израз за филтрите по дела 
$_SESSION["coderegiuser"]= ">=0";

# предаваме надолу : 
#     $usname - име на логнатия 
#     $uspref - групово файлово име 

							include "regius.inc.php";

?>