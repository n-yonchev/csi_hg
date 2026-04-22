<?php
# зона : бележки по делото 
# отгоре : 
#    $edit= case.id 
#    $zone= "note" 
#    $func= view, modi 
//print session_name()."=".session_id();

									# модификация на избрания запис в тази зона 
									//$view= $GETPARAM["view"];
									if ($func=="modi"){
										include_once "cazonotemodi.ajax.php";
										exit;
									}else{
									}

# четем записа 
$rocase= getrow("suit",$edit);
//print "[$edit][$zone]";
//print_r($rocase);

# според функцията 
if (0){
}elseif ($func=="view"){
				$editel= "edit=$edit&zone=$zone";
				$urlmod= geturl($editel."&func=modi");
	$tpname= "cazonoteview.tpl";
//}elseif ($func=="modi"){
//	$tpname= "cazo1modi.tpl";
}else{
die("cazo1=func=$func");
}

				/*
							# за извеждане на "идва от" - кеширания масив 
							$arfrom= unserialize(file_get_contents(COFROMFILE));
							# предаваме съдържанието 
							$smarty->assign("ARFROM", $arfrom);
						# за извеждане на "титул" - масива $listtitu - commspec.php 
						# предаваме съдържанието на масива 
						$smarty->assign("ARTITU", $listtitu);
						# за извеждане на "вид" - масива $listsort - commspec.php 
						# предаваме съдържанието на масива 
						$smarty->assign("ARSORT", $listsort);
							# за извеждане на "ред за отчета" 
							# предаваме съдържанието на разгърнатия масив 
							$smarty->assign("ARREPO", $viewrepo);
							# за извеждане на "текущ статус" 
							# предаваме съдържанието на разгърнатия масив 
							$smarty->assign("ARSTAT", $viewcasestat);
							# за извеждане на "характер на изпълнението" 
							# предаваме съдържанието на разгърнатия масив 
							$smarty->assign("ARCHAR", $listchartype);
						# за извеждане на "схема на погасяване" - масива $lispayoff - commspec.php 
						# предаваме съдържанието на масива 
						$smarty->assign("ARPAYOFF", $listpayoff);
							# за извеждане на "произход на вземането" 
							$roorig= getrow("claimorigin",$rocase["idclaimorig"]);
							$rocase["origtext"]= $roorig["name"];
				*/
# резултата 
//$pagecont= smdisp("cazo1view.tpl","iconv");
				$smarty->assign("URLMOD", $urlmod);
				$smarty->assign("DATA", $rocase);
$pagecont= smdisp($tpname,"iconv");

?>