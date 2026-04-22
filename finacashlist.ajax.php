<?php
# списък по дела на събраните пари в-брой от избран събирач 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
//# 	 $filter - готовия филтър за период 
# още отгоре : 
#    $pers - user.id на събирача 
# $fielem - finance.cashdate в MySQL формат 
//print_r($GETPARAM);
//var_dump($_SESSION["finacashview"]);

$view= $_SESSION["finacashview"];
////////unset($_SESSION["finacashview"]);
$filter= viewaction($view,$fielem);								

# само постъпления в-брой 
$filttype= "finance.idtype=2";
# само от избрания събирач 
$filtpers= "finance.cashiduser=$pers";

# списъка 
$mylist= $DB->select("
	select finance.*, finance.id as id, $fielem as cashdate
		, suit.serial as caseseri, suit.year as caseyear, user.name as username
	from finance
	left join suit on finance.idcase=suit.id
	left join user on suit.iduser=user.id
	where $filter and $filttype and $filtpers
	order by $fielem
	");
$mylist= dbconv($mylist);

# извеждаме 
	$rouser= getrow("user",$pers);
$smarty->assign("NAME", $rouser["name"]);
$smarty->assign("LIST", $mylist);
print smdisp("finacashlist.ajax.tpl","iconv");


?>