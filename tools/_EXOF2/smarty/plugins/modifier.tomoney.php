<?php
#---- юли-2008 --------------------------------------------
# визуализация на пари, вместо функцията tomoney 

function smarty_modifier_tomoney($p1,$p2=2){
    return number_format($p1+0,$p2);
}
/*
function smarty_modifier_tomoney2($p1){
	if ($p1+0==0){
return "-" ."&nbsp;&nbsp;";
	}else{
return number_format($p1,2);
	}
}
*/
?>