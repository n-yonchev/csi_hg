<?php
# към регистъра - всички дела БЕЗ ДЕЛОВОДИТЕЛ - формиране и предаване 
# отгоре : 
#     $mode - режима 
//print_rr($_SESSION);
//print_rr($GETPARAM);
									include_once "reg2.inc.php";

# деловодителя 
list($usnameregi,$uspref)= getreginame(0);
# за линка към посл.резултат 
$tolast= "regilano";
# израз за филтрите по дела 
$_SESSION["coderegiuser"]= "=0";

# предаваме надолу : 
#     $usname - име на логнатия 
#     $uspref - групово файлово име 

							include "regius.inc.php";

?>