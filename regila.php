<?php
# към регистъра - всички дела на логнатия юзер - резултат 
# отгоре : 
#     $mode - режима 
//print_rr($_SESSION);
//print_rr($GETPARAM);
									include_once "reg2.inc.php";

# логнатия юзер 
list($usnameregi,$uspref)= getreginame($_SESSION["iduser"]);

# предаваме надолу : 
#     $usname - име на логнатия 
#     $uspref - групово файлово име 

							include "regila.inc.php";



?>