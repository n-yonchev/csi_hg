<?php

function getfilt($p1){
global $stperi, $d1, $d2, $year, $stmont;
			if (isset($stperi)){
return "$p1>='$d1' and $p1<='$d2'";
			}else{
return "year($p1)=$year and month($p1)=$stmont";
			}
}

?>
