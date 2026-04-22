<?php
# зона-1 : основни параметри на делото 
# отгоре : 
#    $edit= suit.id 
#    $zone= 1 
#    $func= view, modi 
//print session_name()."=".session_id();

									# модификация на избрания запис в тази зона 
									//$view= $GETPARAM["view"];
									if ($func=="modi"){
										include_once "cazo1modi.ajax.php";
										exit;
									}else{
									}

# четем записа 
$rocase= getrow("suit",$edit);
$smarty->assign("EDIT", $edit);

$epep_process = $DB->select(
	"SELECT * 
	FROM epep_files
	WHERE suit_id = ?d", $edit);
$epep_process = dbconv($epep_process);

foreach($epep_process as $key => $item) {
	$epep_process[$key]['fileurl'] = geturl("mode=docu&epep_process=" . $item['id']);
}

// var_dump($epep_process);
$smarty->assign("EPEP_PROCESS", $epep_process);
//print "[$edit][$zone]";
//print_r($rocase);
													# 13.01.2011 - надбавката ОЛП 
													$_SESSION["extraint"]= $rocase["extraint"];
										# 18.04.2011 - да не е празна 
										if ($rocase["extraint"]+0==0){
											$uset= array();
											$uset["extraint"]= 10;
											$DB->query("update suit set ?a where id=?d"  ,$uset,$edit);
													$_SESSION["extraint"]= $uset["extraint"];
										}else{
										}
//var_dump($_SESSION["extraint"]);
/*
# и адвоката 
$roagen= getrow("agent",$rocase["idagent"]);
$rocase["agent"]= $roagen["name"];
*/
# според функцията 
if (0){
}elseif ($func=="view"){
				$editel= "edit=$edit&zone=$zone";
				$urlmod= geturl($editel."&func=modi");
	$tpname= "cazo1view.tpl";
//}elseif ($func=="modi"){
//	$tpname= "cazo1modi.tpl";
}else{
die("cazo1=func=$func");
}

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
				# 16.05.2014 - ЦРД-2014 - тип, вид, произход на вземане 
				$smarty->assign("AR4TYPE", $list4type);
				$smarty->assign("AR4VARI", $list4vari);
				$smarty->assign("AR4ORIG", $list4orig);
# резултата 
//$pagecont= smdisp("cazo1view.tpl","iconv");
				$smarty->assign("URLMOD", $urlmod);
				$smarty->assign("DATA", $rocase);
#---- централен регистър ----
$relin1= geturl($editel."&regi=act1");
//$relin2= geturl($editel."&func=act2");
//$relin3= geturl($editel."&func=act3");
//$smarty->assign("RELINK", array($relin1,$relin2,$relin3));
$smarty->assign("RELINK1", $relin1);

$pagecont= smdisp($tpname,"iconv");

?>