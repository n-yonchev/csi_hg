<?php
#----------------------------- преместване ред от сметка ---------------------------------------------
# отгоре : 
#    $edit= case.id 
#    $zone= bill 
# управляващ : 
#    $modibill = bill.id 

# вземи това id 
$getme= $_POST["getme"];
# спусни го преди това id 
$putme= $_POST["putme"];
//print "[$getme][$putme]";
					if ($getme==0 or $putme==$getme){
					}else{

$mylist= $DB->selectCol("select id from billelem where idbill=?d order by level"  ,$modibill);
//print_rr($mylist);
			$arid= array();
				$rang= 0;
foreach($mylist as $cuid){
	if (0){
	}elseif ($cuid==$getme){
	}elseif ($cuid==$putme){
				$rang ++;
			$arid[$getme]= $rang;
				$rang ++;
			$arid[$cuid]= $rang;
	}else{
				$rang ++;
			$arid[$cuid]= $rang;
	}
}
//print_rr($arid);
foreach($arid as $cuid=>$leve){
	$DB->query("update billelem set level=?d where id=?d"  ,$leve,$cuid);
}
					}

$_POST["getme"]= 0;
$_POST["putme"]= 0;

?>