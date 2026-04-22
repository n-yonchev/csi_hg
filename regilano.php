<?php
# към регистъра - всички дела БЕЗ ДЕЛОВОДИТЕЛ - резултат 
# отгоре : 
#     $mode - режима 
//print_rr($_SESSION);
//print_rr($GETPARAM);
									include_once "reg2.inc.php";

# деловодителя 
list($usnameregi,$uspref)= getreginame(0);

# предаваме надолу : 
#     $usname - име на логнатия 
#     $uspref - групово файлово име 

							include "regila.inc.php";



?>