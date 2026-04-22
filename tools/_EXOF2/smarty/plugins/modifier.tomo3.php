<?php
#---- юли-2008 --------------------------------------------
# визуализация на пари, вместо функцията tomoney 

function smarty_modifier_tomo3($p1){
	if ($p1+0==0){
return "";
	}else{
return number_format($p1+0,2  ,".",",");
	}
}

?>