<?php
#---- юли-2008 --------------------------------------------
# визуализация на пари, вместо функцията tomoney 

function smarty_modifier_t2($p1){
    return number_format($p1,2);
}

?>