<?php
# зона-плащане : прих.касови ордери по делото - списък 
# източник : cazo2.php 
# отгоре : 
#    $edit= case.id 
#    $zone= paym 
#    $func= view, modi 
# елемент за настройка 
#    $idel - cash.id  


# таблицата 
$taname= "cash";
# шаблона 
$tpname= "cazopaymview.tpl";

# съобщение при авариен край 
$diemess= "cazopaym";
							# за include при корекция 
							$modiname= "cazopaymmodi.ajax.php";
							# за include при отпечатване 
							$prinname= "cazopaymprin.ajax.php";
							# за include при разпределение на парите 
							$distname= "cazopaymdist.ajax.php";

									# модификация на избрания запис в тази зона 
									if ($func=="modi"){
										include_once $modiname;
										exit;
									}else{
									}
									# отпечатване на избрания запис 
									if ($func=="prin"){
										include_once $prinname;
										exit;
									}else{
									}
									# разпределение на парите от избрания запис 
									if ($func=="dist"){
										include_once $distname;
										exit;
									}else{
									}
/*
# според функцията 
if (0){
}elseif ($func=="view"){
//				$editel= "edit=$edit&zone=$zone";
//				$urlmod= geturl($editel."&func=modi");
				//$editel= "edit=$edit&zone=$zone&func=modi";
				//# add new link 
				//$addnew= geturl($modeel."&idel=0");
	//$tpname= "cazo3view.tpl";
//}elseif ($func=="modi"){
//	$tpname= "cazo3modi.tpl";
}else{
die("$diemess=func=$func");
}
*/

/*
# основните параметри - за модификация 
$modeel= "edit=$edit&zone=$zone&func=modi";
# основните параметри - за отпечатване 
$prinel= "edit=$edit&zone=$zone&func=prin";
# основните параметри - за разпределение 
$prinel= "edit=$edit&zone=$zone&func=prin";
*/
# основните параметри 
$modeel= "edit=$edit&zone=$zone";
# add new link 
$addnew= geturl($modeel."&func=modi&idel=0");

# списъка 
$filter= "where idcase=$edit";
$mylist= $DB->select("select * from $taname $filter order by id desc");
$mylist= dbconv($mylist);

# трансформираме го - параметри за иконите 
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
//	$mylist[$uskey]["edit"]= geturl($modeel."&idel=".$idcurr);
//	$mylist[$uskey]["prin"]= geturl($prinel."&idel=".$idcurr);
	$mylist[$uskey]["edit"]= geturl($modeel."&func=modi&idel=".$idcurr);
	$mylist[$uskey]["prin"]= geturl($modeel."&func=prin&idel=".$idcurr);
	$mylist[$uskey]["dist"]= geturl($modeel."&func=dist&idel=".$idcurr);
//				# списъка с длъжниците за текущия елемент 
//				# масив с debtor.id 
//	$mylist[$uskey]["listde"]= explode(",",$uscont["listdebtor"]);
}
/*
						# за извеждане на взискател - четем списъка с взискатели по делото 
						$arclai= getselect("claimer","name","idcase=$edit",false);
						$arclai= dbconv($arclai);
						# предаваме съдържанието на масива 
						$smarty->assign("ARCLAI", $arclai);
				# за извеждане на отделен длъжник - четем списъка с длъжници по делото 
				$ardebt= getselect("debtor","name","idcase=$edit",false);
				$ardebt= dbconv($ardebt);
				# предаваме съдържанието на масива 
				$smarty->assign("ARDEBT", $ardebt);
						# за извеждане на тип - кратко 
						# предаваме съдържанието на масива 
						$smarty->assign("ARTYPE", $listsubjtype2);
						# за извеждане на подтип - кратко 
						# предаваме съдържанието на масива 
						$smarty->assign("ARSUBT", $listsubjst2);
*/

# резултата 
$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
//$smarty->assign("LISTTEXT", $listtext);
$pagecont= smdisp($tpname,"iconv");


?>