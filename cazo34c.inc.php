<?php

										# 08.04.2010 - вече извеждаме радиобутони 
										# предаваме съдържанието на масива 
						# 01.07.2010 оправена важна грешка 
						unset($listmembtype[0]);
										$smarty->assign("ARTYPE", $listmembtype);
//print_rr($listmembtype);
						# заради скриването и показването в шаблона - 
						# предаваме и дължината на масива 
//						$smarty->assign("ARLEN", count($listmembtype_utf8));
						$smarty->assign("ARLEN", count($listmembtype));
	
				# 08.10.2010 - за избор заради Регистъра на длъжници/взискатели 
					//unset($list1type_utf8[0]);
				$smarty->assign("AR1TYPENAME", "list1type_utf8");
				$smarty->assign("AR3TYPENAME", "list3type_utf8");
					//unset($list1stat_utf8[0]);
//@@@				$smarty->assign("AR1STATNAME", "list1stat_utf8");
//					$listcory= getselect("country","name","1",true);
					$listcory= $DB->selectCol("select code as ARRAY_KEY, name from country order by name");
					$listcory= array(""=>"") + $listcory;
				$smarty->assign("ARCORYNAME", "listcory");

# допълнителни js линкове за секцията head 
# - заради търсенето по егн/булстат 
//$smarty->assign("HEADJS", array("ajaxify.js","manageajax.js","_caseedit.js"));
//$smarty->assign("HEADJS", array("jquery.dimentions.js","cluetip.hoverIntent.js","jquery.cluetip.js"));
$smarty->assign("HEADJS", array("jquery.dimentions.js","cluetip.hoverIntent.js","jquery.cluetip.js"  ,"_cazo34modi.js"));

?>