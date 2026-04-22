<?php

									session_start();
									include_once "common.php";

$GEPA= getparam();
$caseid= $GEPA["edit"];
//print_r($GEPA);

			# 17.02.2010 - десен клик за затваряне на всички дела 
			if (isset($caseid)){
			}else{
//print toutf8("затвори ВСИЧКИ дела");
exit;
			}

$rocase= getrow("suit",$caseid);
$smarty->assign("DATA", $rocase);
			# деловодителя 
$rouser= getrow("user",$rocase["iduser"]);
$smarty->assign("USERNAME", $rouser["name"]);
			

/*
# за избор на длъжник - четем списъка с длъжниците по делото 
$ardebt= getselect("debtor","name","idcase=$caseid",false);
# предаваме името, а не съдържанието на масива 
$smarty->assign("ARLIST", "ardebt");

# извеждаме формата за избор на длъжник 
print smdisp("cazofinadebt.ajax.tpl","iconv");
*/

# извеждаме основни данни за дело 
# източник : cazo1.php 

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
/*
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

# извеждаме 
print smdisp("tabs.ajax.tpl","iconv");

?>