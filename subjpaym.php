<?php
# 3-то ниво - 
# обслужва плащанията за отделен предмет за текущото дело 
#    - едновременно списъка и корекциите - триене и промяна на елемент 
# вика се директно с криптиран параметричен низ 

									# вика се самостоятелно, а не с include 
									session_start();
									include_once "common.php";
# сесийните параметри 
$iduser= @$_SESSION["iduser"];

//sleep(1);
# вземаме масива с входните параметри 
$GETPARAM= getparam();
//print_r($GETPARAM);

# входни параметри 
# предмета на изпълнение 
$subj= $GETPARAM["subj"];
# плащането по предмета 
$edit= $GETPARAM["edit"];

							# четем списъка с лихвените проценти по периоди 
							$arperc= $DB->select("select * from percent order by id");

#--------------------------------------- списъка с плащания ------------------------------------------
# източник : cazo2.php 

# таблицата 
$taname= "payment";
# шаблона 
$tpname= "subjpaymview.tpl";

# за include при корекция 
$modiname= "subjpaymmodi.ajax.php";
# съобщение при авариен край 
$diemess= "subjpaym";

									# модификация на избрания елемент от списъка 
									# ако има параметър $edit 
									if (isset($edit)){
										include_once $modiname;
										exit;
									}else{
									}

# основните параметри 
$modeel= "subj=$subj";
# add new link 
$addnew= geturl($modeel."&edit=0");

# списъка 
$filter= "where idsubj=$subj";
$mylist= $DB->select("select * from $taname $filter order by id");
$mylist= dbconv($mylist);

# трансформираме го - параметри за иконите 
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
}

#-------------------------- списъка с финансовата история - олихвяване ---------------------
# важи само за типове - олихвяема и месечна сума 
$rosubj= getrow("subject",$subj);
//print $rosubj["idtype"];
$subjtype= $rosubj["idtype"];
if ($subjtype==1 or $subjtype==3){
				$ismonthly= ($subjtype==3);
				include_once "subjpaymhist.inc.php";
				include_once "subjpaymhist.php";
}else{
}

/*
# извеждаме 
$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
$pagecont= smdisp($tpname,"iconv");

//print $pagecont;
								# заради отпечатване във вътр.фрейм 
								if ($GETPARAM["print"]=="yes"){
$smarty->assign("CONTENT", $pagecont);
print smdisp("_print.tpl","fetch");
								}else{
print $pagecont;
								}
*/
								# заради отпечатване във вътр.фрейм 
								if ($GETPARAM["print"]=="yes"){
										# делото 
										$idcase= $rosubj["idcase"];
										# данните за предмета 
										$smarty->assign("DATASUBJ", $rosubj);
										# осигуряваме и данните за делото 
										$rocase= getrow("suit",$idcase);
										$smarty->assign("DATACASE", $rocase);
//								print_r($rocase);
											# за извеждане на "идва от" - кеширания масив 
											$arfrom= unserialize(file_get_contents(COFROMFILE));
											$smarty->assign("ARFROM", $arfrom);
											# за избор на "титул" - масива $listtitu - commspec.php 
											$smarty->assign("ARTITU", $listtitu);
											# за избор на "вид" - масива $listsort - commspec.php 
											$smarty->assign("ARSORT", $listsort);
											# за извеждане типа на предмета - пълно 
											$smarty->assign("ARTYPE", $listsubjtype);
										# за извеждане на взискател - четем списъка с взискатели по делото 
										$arclai= getselect("claimer","name","idcase=$idcase",false);
										$arclai= dbconv($arclai);
										$smarty->assign("ARCLAI", $arclai);
										# списъка с длъжници по предмета 
										$smarty->assign("DEBTLIST", explode(",",$rosubj["listdebtor"]));
										# за извеждане на отделен длъжник - четем списъка с длъжници по делото 
										$ardebt= getselect("debtor","name","idcase=$idcase",false);
										$ardebt= dbconv($ardebt);
										$smarty->assign("ARDEBT", $ardebt);
								}else{
								}
# извеждаме 
$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
//$pagecont= smdisp($tpname,"iconv");
//print $pagecont;
$pagecont= smdisp($tpname,"fetch");
								# заради отпечатване във вътр.фрейм 
								if ($GETPARAM["print"]=="yes"){
$smarty->assign("CONTENT", $pagecont);
print smdisp("_print.tpl","iconv");
								}else{
print toutf8($pagecont);
								}

?>
