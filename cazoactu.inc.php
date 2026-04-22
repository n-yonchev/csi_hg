<?php

# участващи финансови събития - предмети и постъпления, сортирани по дата 
# източник : cazobala.php 
# обаче участват ВСИЧКИ постъпления, а не само приключените 
# добавяме и поле за остатък - заради извеждането - предупреждение за неразпределено постъпление 
function getactulist($filter){
global $DB;
	$listvali= $DB->select("
		(select id, '3' as oper, fromdate as date, text as descrip, amount as amou, 0 as rest
			from subject $filter and idtype in (1,2,3)) 
		union all
		(select id, '4' as oper, datebala as date, descrip, inco as amou, rest 
			from finance $filter) 
		");
	$listvali= dbconv($listvali);
//print_rr($mylist);
	# сортираме - complist2 = точно копие на complist - cazobala.php 
	usort($listvali,"complist2");
# шаблон за имената на чекбоксовете 
$cbtemp= "cb_%s_%s";
return array($listvali,$cbtemp);
}

function complist2($p1,$p2){
	if ($p1["date"]==$p2["date"]){
		if ($p1["oper"]==$p2["oper"]){
								if ($p1["id"]==$p2["id"]){
return 0;
								}else{
return $p1["id"]>$p2["id"] ? 1 : -1;
								}
return 0;
		}else{
return $p1["oper"]<$p2["oper"] ? 1 : -1;
		}
	}else{
return $p1["date"]>$p2["date"] ? 1 : -1;
	}
}

?>
