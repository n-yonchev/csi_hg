<?php
#---- юни-2010 --------------------------------------------
# визуализация на цяло число с разделител за хиляди 

function smarty_modifier_tointe($p1){
	if ($p1+0==0){
return "";
	}else{
return number_format($p1+0,0  ,".",",");
	}
}

?>