<?php
# отгоре : 
#    $iduser - логнатия потребител 
#    $edit= case.id за модифициране 
#    $zone= 2 
#    $func= modi 
/*@@@
# 08.10.2010 - ново поле exdata заради Регистъра на длъжници/взискатели - предмети на изпълн. 
# сериализиран масив : 
#     [t4type]=$list4type типа 
#     [t4vari]=$list4vari вида 
@@@*/

# входни параметри 
# $idel - subject.id на елемента от предмета на изпълнение 
$idel= $GETPARAM["idel"];
//print "correction [$edit][$zone][$func]idel=[$idel]";

# таблицата 
$taname= "subject";
# шаблона 
$tpname= "cazo2modi.ajax.tpl";
# полетата 
$filist= array(
	"text"=>  array("validator"=>"notempty", "error"=>"описанието не може да е празно")
	,"idtype"=>  array("validator"=>"notzero", "error"=>"типа е задължително поле")
	,"idclaimer"=>  array("validator"=>"notzero", "error"=>"взискателя е задължително поле")
# списък на длъжниците - косвено определя полето listdebtor 
# не участва в записа 
# - масив от полета checkbox 
//	,"listde"=>  array("validator"=>"notempty", "error"=>"няма избран длъжник"
//			,"inactive"=>true)
	,"listde"=>  array("inactive"=>true)
//	,"idsubtype"=>  array("validator"=>"notzero", "error"=>"подтипа е задължително поле")
# 22.05.2009 - Бъзински - дадата се въвежда/корегира в бг формат без календар 
//	,"fromdate"=>  array("validator"=>"bgdate_valid_notempty", "transformer"=>"getputbgdate")
# 22.10.2009 - може да има неолихвяема главница с празна дата 
	,"fromdate"=>  array("validator"=>"bgdate_valid", "transformer"=>"getputbgdate")
# 15.12.2009 - може да има крайна дата (евент.празна) за месечна сума 
	,"todate"=>  array("validator"=>"bgdate_valid", "transformer"=>"getputbgdate")
# 07.07.2009 - финанси и предмет на изпълнение - два нови флага 
# istoclaimer - дали сумата да се превежда на взискателя 
# isintax - дали сумata да се включва в таксата към ЧСИ 
	,"istoclaimer"=> NULL
	,"isintax"=> NULL
					#----- дв-86/17----- 
,"idt2"=>  array("validator"=>"notzero", "error"=>"типа е задължителен")
);
# константни полета 
$ficonst= array("idcase"=>$edit);

						# за избор на длъжници - четем списъка с длъжниците по делото 
						$ardebt= getselect("debtor","name","idcase=$edit",false);
						$ardebt= dbconv($ardebt);
						/*
						# трансформираме кавичките , иначе излиза празно в шаблона 
						foreach($ardebt as $dein=>$deco){
							$ardebt[$dein]= htmlspecialchars($deco,ENT_QUOTES);
						}
						*/
						# трансформираме кавичките, иначе излиза празно в шаблона 
						foreach($ardebt as $dein=>$deco){
//							$ardebt[$dein]= htmlspecialchars($deco,ENT_QUOTES);
								$deco= str_replace("'","",$deco);
								$deco= str_replace('"',"",$deco);
							$ardebt[$dein]= $deco;
						}
						# предаваме съдържанието на масива 
						$smarty->assign("ARDEBT", $ardebt);

						# за избор на взискател - четем списъка с взискатели по делото 
						$arclai= getselect("claimer","name","idcase=$edit",true);

#----------------- директно редактиране -----------------------

									# класа за редактиране 
									# само заради функцията doerrors 
									include_once "edit.class.php";
									
				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
//print_r($_POST);

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	if ($idel==0){
							#---- полета с автоматично съдържание 
							# всички длъжници да са чекнати, тоест да участват в списъка 
									$arde= array();
							foreach($ardebt as $dein=>$x1){
									$arde[]= $dein;
							}
							$_POST["listde"]= $arde;
							# ако има само един взискател - назначаваме го директно 
							if (count($arclai)==2){
								$arke= array_keys($arclai);
								$_POST["idclaimer"]= $arke[1];
							}else{
							}
		$_POST["isintax"]= 1;
					#----- дв-86/17----- 
		$_POST["idt2"]= 0;
	}else{
		$rocont= $DB->selectRow("select * from $taname where id=?" ,$idel);
//print_r($rocont);
		foreach($filist as $finame=>$ficont){
			if ($ficont["inactive"]){
			}else{
				$_POST[$finame]= $rocont[$finame];
			}
		}
		# флаговете 
		$_POST["istoclaimer"]= $rocont["istoclaimer"]==0 ? 0 : 1;
		$_POST["isintax"]= $rocont["isintax"]==0 ? 0 : 1;
//print_r($_POST);
							#---- полета с автоматично съдържание 
							# списък с id на длъжниците по текущия елемент на предмета 
							$mylist= explode(",",$rocont["listdebtor"]);
							$_POST["listde"]= $mylist;
						#---- пренасяме и условните полета 
						$_POST["amount"]= $rocont["amount"];
//						$_POST["fromdate"]= $rocont["fromdate"];
# 22.05.2009 - Бъзински - дадата се въвежда/корегира в бг формат без календар 
$_POST["fromdate"]= getputbgdate("get",$idel,"fromdate",$rocont);
# 15.12.2009 - може да има крайна дата (евент.празна) за месечна сума 
$_POST["todate"]= getputbgdate("get",$idel,"todate",$rocont);
						$_POST["idsubtype"]= $rocont["idsubtype"];
/*@@@
		# 08.10.2010 - заради Регистъра на длъжници/взискатели - предмети на изпълн. 
		$ardata= unserialize($rocont["exdata"]);
		$_POST["t4type"]= $ardata["t4type"];
		$_POST["t4vari"]= $ardata["t4vari"];
@@@*/
	}

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
											# проверяваме за допълнителни грешки 
											# ако типа е сума 
											$lister= array();
							/**/
							$idtype= $_POST["idtype"];
											if ($idtype==1 or $idtype==2 or $idtype==3){
												$amount= $_POST["amount"];
# ВНИМАНИЕ. 
# ЛИПСВАТ Формални проверки за сума и дата. 
												# празна сума 
												if (empty($amount)){
													$lister["amount"]= "сумата не може да е празна";
												}else{
												}
												# грешна сума 
												# източник : commvali-univalidator 
														$value= $amount;
														$exvali= $GLOBALS["evalvali"]["amount"];
														eval("\$result= ($exvali);");
														if ($result){
													$lister["amount"]= "грешна сума";
														}else{
														}
												# датата 
												$fromdate= $_POST["fromdate"];
			# 06.11.2009 
			# празна дата може да има само за тип=1=олихвяема 
			if (empty($fromdate) and $idtype<>1){
													$lister["fromdate"]= "датата не може да е празна";
			}else{
				# крайната дата 
				# 15.12.2009 - може да има крайна дата (евент.празна) за месечна сума 
//				if (empty($todate) and $idtype<>3){
//													$lister["todate"]= "крайната дата не може да е празна";
												$todate= $_POST["todate"];
				if (empty($todate)){
				}else{
					# дали периода е верен 
					$myfrom= bgdateto($fromdate);
					$myto= bgdateto($todate);
					if ($myfrom<$myto){
					}else{
													$lister["todate"]= "периода е грешен";
					}
				}
			}
											/*
												# празна дата 
												if (empty($fromdate)){
													$lister["fromdate"]= "датата не може да е празна";
												}else{
													# грешна дата 
													list($myye,$mymo,$myda)= explode("-",$fromdate);
													if (checkdate($mymo+0,$myda+0,$myye+0)===false){
														$lister["fromdate"]= "грешна дата";
													}else{
													}
												}
											*/
# 22.05.2009 - Бъзински - дадата се въвежда/корегира в бг формат без календар 
/*
												$resudate= validator_date_valid_notempty($fromdate,"*");
												if ($resudate===true){
												}else{
														$lister["fromdate"]= $resudate[0];
												}
*/
								# 02.10.2009 
								# нач.дата да е преди или равна на днешната дата 
								$posteddate= getputbgdate("put",$idel,"fromdate",$_POST);
								$currentdate= date("Y-m-d");
								if ($posteddate <= $currentdate){
								}else{
//														$lister["fromdate"]= "не е ПРЕДИ днешната дата";
														$lister["fromdate"]= "тази дата е СЛЕД днешната";
								}
												# ако типа =2 =неолихв. - дали има подтип 
												if ($idtype==2){
													$idsubtype= $_POST["idsubtype"];
													if (empty($idsubtype)){
														$lister["idsubtype"]= "подтипа е задължителен";
													}else{
														# тип=неолихв подтип=аванс.такса - не участва в сумата за т.26 
														if ($idsubtype==8 and isset($_POST["isintax"])){
															$lister["isintax"]= "подтип аванс.такса НЕ участва в т.26";
														}else{
														}
													}
												}else{
												}
											
											}else{
											}
							/**/
											/***
											if (isset($_POST["listde"])){
											}else{
														$lister["listde"]= "задължително поне един длъжник";
											}
											***/
					#----- дв-86/17----- 
					# отгоре : $arsu2nodebt, $arsu2adva 
					$islistde= (isset($_POST["listde"]));
					$idt2= $_POST["idt2"];
					# тип : такса НЕ за сметка на длъжника 
					if (in_array($idt2,$arsu2nodebt)){
						if ($islistde){
														$lister["listde"]= "не трябва да има длъжници";
						}else{
						}
					}else{
						if ($islistde){
						}else{
														$lister["listde"]= "задължително поне един длъжник";
						}
					}
					# тип : авансова такса 
					if (in_array($idt2,$arsu2adva)){
						if (isset($_POST["isintax"])){
														$lister["isintax"]= "аванс.такса не може да участва за т.26";
						}else{
						}
					}else{
					}
/*@@@
				# 08.10.2010 - заради Регистъра на длъжници/взискатели - предмети на изпълн. 
				$t4type= $_POST["t4type"];
				if ($t4type==0){
														$lister["t4type"]= "типа вземане е задължителен";
				}else{
				}
				$t4vari= $_POST["t4vari"];
				if ($t4vari==0){
														$lister["t4vari"]= "вида вземане е задължителен";
				}else{
				}
@@@*/

											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
												#---- няма ---- 
							$retucode= 0;
//		$aset= array();
		$aset= $ficonst;
		foreach($filist as $finame=>$ficont){
			if ($ficont["inactive"]){
			}else{
				$aset[$finame]= $_POST[$finame];
			}
		}
		# флаговете 
		$aset["istoclaimer"]= isset($_POST["istoclaimer"]) ? 1 : 0;
		$aset["isintax"]= isset($_POST["isintax"]) ? 1 : 0;
							#---- полета с автоматично съдържание 
							# списък с id на длъжниците по текущия елемент на предмета 
							/***
							$mylist= implode(",",$_POST["listde"]);
							$aset["listdebtor"]= $mylist;
							***/
					#----- дв-86/17----- 
					if (in_array($idt2,$arsu2nodebt)){
							$aset["listdebtor"]= "";
					}else{
							$mylist= implode(",",$_POST["listde"]);
							$aset["listdebtor"]= $mylist;
					}
						#---- пренасяме и условните полета 
						$aset["amount"]= $_POST["amount"];
//						$aset["fromdate"]= $_POST["fromdate"];
# 22.05.2009 - Бъзински - дадата се въвежда/корегира в бг формат без календар 
$aset["fromdate"]= getputbgdate("put",$idel,"fromdate",$_POST);
$aset["todate"]= getputbgdate("put",$idel,"todate",$_POST);
						$aset["idsubtype"]= $_POST["idsubtype"];
/*@@@
				# 08.10.2010 - заради Регистъра на длъжници/взискатели - предмети на изпълн. 
				$ardata= array();
				$ardata["t4type"]= $_POST["t4type"];
				$ardata["t4vari"]= $_POST["t4vari"];
				$aset["exdata"]= serialize($ardata);
@@@*/
				
	if ($idel==0){
		$idel= $DB->query("insert into $taname set ?a" ,$aset);
	}else{
		$DB->query("update $taname set ?a where id=?d" ,$aset,$idel);
	}
											# според дали има грешка 
											}

#------ submit с формални грешки 
}elseif ($mfacproc==NULL){
							$retucode= 1;
	doerrors();

#------ автоматичен submit -----------------------------------------------------
}elseif ($mfacproc=="UNKNOWN"){
							$retucode= 2;

#------ невъзможна грешка от библиотеката 
}else{
print "<br>error=mfacproc=";
var_dump($mfacproc);
die();
}

#----------------- край на директното редактиране -----------------------

/*
# редактиране 
//$obedit= new edit($taname,$edit,$filist,$ficonst);
$obedit= new edit($taname,$idel,$filist,$ficonst);
$reedit= $obedit->action();
//var_dump($reedit);
*/

# резултат 
//if ($reedit==0){
if ($retucode==0){

	# redirect 
//	reload("parent",$relurl);
//	$smarty->assign("EXITCODE", getnyroexit("t2link"));
//	$redilink= array("t2link","t7link");
					#---- януари-2010 актуален дълг ----
//	$redilink= array("t2link");
					# 19.07.2010 аванс.такси рекапитулация 
//	$redilink= array("t2link","tactulink");
	$redilink= array("t2link","tactulink","tadvalink");
	$smarty->assign("EXITCODE", getnyroexit($redilink));
	print smdisp($tpname,"iconv");

}else{

//						# за избор на взискател - четем списъка с взискатели по делото 
//						$arclai= getselect("claimer","name","idcase=$edit",true);
						//# обръщаме в UTF-8 
						//$arclai= toutf8($arclai);
						# предаваме името, а не съдържанието на масива 
						$smarty->assign("ARCLAINAME", "arclai");
							# за избор на "тип" - масива $listsubjtype - commspec.php 
							# предаваме името, а не съдържанието на масива 
							$smarty->assign("ARTYPENAME", "listsubjtype_utf8");
							# за евент.избор на "подтип" - масива $listsubjst - commspec.php 
							# предаваме името, а не съдържанието на масива 
							$smarty->assign("ARSTNAME", "listsubjst_utf8");
/*@@@
				# 08.10.2010 - заради Регистъра предмети на изпълнение - типове и видове вземания 
					unset($list4type_utf8[0]);
				$smarty->assign("AR4TYPENAME", "list4type_utf8");
					unset($list4vari_utf8[0]);
				$smarty->assign("AR4VARINAME", "list4vari_utf8");
@@@*/
//				# jscalendar 
//				$smarty->assign("CALEINIT",CALEINIT);

	# извеждаме формата 
	$smarty->assign("EDIT", $idel);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
//	$pagecont= smdisp($tpname,"iconv");
}


?>