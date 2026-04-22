<?php
							include_once "common.php";

include "regicase.php";
include "regipers.php";
include "regiorig.php";

include "regizip.php";


# 08.10.2010 - заради Регистъра - номер дело 
function regicaseseri($p1){
return str_pad($p1,5,"0",STR_PAD_LEFT);
}

?>