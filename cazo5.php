<?php
# зона-5 : входящи документи по делото 
# отгоре : 
#    $edit= case.id 
#    $zone= 5 
#    $func= view, modi 
//print "[$edit][$zone][$func]";
//print session_name()."=".session_id();
//print_rr($GETPARAM);
											
											# 20.04.2015 масово сканиране 
										$rouser= getrow("user",$_SESSION["iduser"]);
										$arperm= explode(",",$rouser["listperm"]);
											$coprin= trim($rouser["codeprin"]);
											if (array_search(2,$arperm)!==false and $coprin<>""){
												$userprin= $coprin;
											}else{
												$userprin= "";
											}
											$smarty->assign("USERPRIN", $userprin);

//									# НЯМА модификация на избрания запис в тази зона 
									# модификация на избрания запис в тази зона 
									$addnew= $GETPARAM["addnew"];
									if (isset($addnew)){
						$rocase= getrow("suit",$edit);
						$editcasecode= $rocase["serial"]."/".substr($rocase["year"],2);
						$edit= 0;
										include_once "docuedit.ajax.php";
										exit;
									}else{
									}

							# всичко за сканираните вх.документи 
$smarty->assign("ISINCASE", true);
							include_once "docuedituplo.inc.php";
							
# специфичен параметър - вътре в делото 
$modeel= "edit=".$edit."&func=".$func."&zone=".$zone;
//$modeel= "mode="."docu"."&page="."1";
$editcasecode= "A";
											/**/
											# 20.04.2015 масово сканиране 
							$modebase= $modeel."&scanmass=yes";
							$scanmasslink= geturl($modeel."&scanmass=yes");
							$smarty->assign("SCANMASSLINK", $scanmasslink);
//				$smarty->assign("RELOLINK", $relurl);
											$scanmass= $GETPARAM["scanmass"];
											if (isset($scanmass)){
				$SMFROMCASE= true;
				$smarty->assign("SMFROMCASE", $SMFROMCASE);
												include_once "scanmass.ajax.php";
												exit;
											}else{
											}
											/**/

							# управление на действията 
							include_once "docuedituplo2.inc.php";

# четем списъка с документите - само за делото 
//$mylist= $DB->select("select * from docu where idcase=? order by year desc, serial desc" ,$edit);
//$mylist= dbconv($mylist);
						# 13.04 2009 - един документ - много дела 
						# получаваме всички данни за документите по това дело 
						$mylist= get_docu_of_case($edit);
									
								$arin= array();
//$modeel= "mode="."docu"."&page="."1";
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
	$mylist[$uskey]["editdocu"]= geturl($modeel."&editdocu=".$idcurr);
							# сканиран образ 
									$arin[]= $idcurr;
	$mylist[$uskey]["scanuplo"]= geturl($modeel."&scanuplo=".$idcurr);
							//$scanname= $filedire.$idcurr.$filesuff;
							//if (file_exists($scanname)){
	$mylist[$uskey]["scanview"]= geturl($modeel."&scanview=".$idcurr);
							//}else{
							//}
}
//print_r($mylist);
							# брой сканирани образи по вх.документи 
									$codein= implode(",",$arin);
							$arscancoun= getscancoun("iddocu in ($codein)");
							/*
							$arscancoun= $DB->selectCol("
								select iddocu as ARRAY_KEY, count(*) 
								from docuscan 
								where iddocu in ($codein) group by iddocu
								");
							*/
//print_rr($arscancoun);
$smarty->assign("ARSCANCOUN", $arscancoun);

# основните параметри 
//$modeel= "edit=$edit&zone=$zone&func=modi";
$modeel= "edit=".$edit."&zone=".$zone."&func=".$func;
# add new link 
$addnew= geturl($modeel."&addnew=0");
$smarty->assign("ADDNEW", $addnew);

# резултата 
//				$smarty->assign("URLMOD", $urlmod);
				$smarty->assign("LIST", $mylist);
$pagecont= smdisp("cazo5view.tpl","iconv");

?>