<?php
# извежда списък с делата за избран адвокат 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $page - текущата страница 
#    $filt - текущия филтър 
# $listcase - agent.id за списъка с дела 
//print "correction [$mode][$edit]";
//print_r($GETPARAM);

# таблицата 
$taname= "agent";
# шаблона 
$tpname= "agentlistcase.ajax.tpl";

# адвоката 
$roag= getrow("agent",$listcase);
$smarty->assign("AGNAME", $roag["name"]);

# списъка 
$mylist= $DB->select(
	"select suit.*, suit.id as id
	, user.name as username, cofrom.name as coname
	from suit
	left join user on suit.iduser=user.id
	left join cofrom on suit.idcofrom=cofrom.id
	where suit.idagent=?d
	order by suit.year desc, suit.serial desc
	"  ,$listcase);
$mylist= dbconv($mylist);
						
						# за извеждане на статуса - съдържанието на 1-мерния масив 
						$smarty->assign("ARSTAT", $viewcasestat);
$smarty->assign("LIST", $mylist);
print smdisp($tpname,"iconv");

?>