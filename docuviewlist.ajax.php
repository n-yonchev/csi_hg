<?php
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $viewlist - docu.id за разглеждане на списъка с дела 
//print "correction [$mode][$viewlist][$page]";

# източник : docu.php - заявката в цикъл 
/*
				$casequ= "
				select 
					suit.serial as caseseri ,suit.year as caseyear
					,user.name as username
				from docusuit
					left join suit on docusuit.idcase=suit.id
					left join user on suit.iduser=user.id
				where docusuit.iddocu=?d
				order by docusuit.docurange
				";
				$caselist= $DB->select($casequ ,$viewlist);
				$caselist= dbconv($caselist);
*/
$caselist= getcaselist($viewlist);

$rodocu= getrow("docu",$viewlist);
$smarty->assign("DOCU", $rodocu);

$smarty->assign("LIST", $caselist);
print smdisp("docuviewlist.ajax.tpl","iconv");

?>
