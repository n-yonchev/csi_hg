<?php
# списък с шаблоните на изх.документи 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
# няма страница - всичко на един екран 
//print_rr($GETPARAM);

														# 15.03.2017 подреждане - еднократна подготовка 
														$idso= $DB->selectCell("select idsort from docutype order by idsort limit 1");
														if ($idso==0){
															$ardata= $DB->selectCol("select id as ARRAY_KEY, id from docutype order by text");
															dotysort($ardata);
														}else{
														}
														# формира ранговете за сортиране idsort 
														function dotysort($ardata){
															global $DB;
																	$rang= 0;
																	$step= 3;
															foreach($ardata as $idty=>$x2){
																	$rang += $step;
																$DB->query("update docutype set idsort=$rang where id=?d"  ,$idty);
															}
														}
										
										# 18.08.2014 - връчване 
										include_once "deli.inc.php";
							#------------ ВРЕМЕННО -------------
							$ISPOST= true;
							$smarty->assign("ISPOST", true);
//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];
/*
# текущата страница 
//print_r($GETPARAM);
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;
*/

//# буквата за редактиране - от основ.данни 
//$rooffi= getofficerow($iduser);
//$letedi= $rooffi["letteredit"];

										# 18.08.2014 - връчване 
					# филтър - само типовете с ненулев брой изх.документи 
					$onlycoun= $GETPARAM["onlycoun"];
					if (isset($onlycoun)){
					}else{
						$onlycoun= 0;
					}
					$linkonly0= geturl("mode=$mode&onlycoun=0");
					$linkonly1= geturl("mode=$mode&onlycoun=1");
$smarty->assign("LINKONLY0", $linkonly0);
$smarty->assign("LINKONLY1", $linkonly1);
$smarty->assign("ONLYCOUN", $onlycoun);

# линк след успешен събмит 
//$relurl= geturl("mode=".$mode."&cufilt=".$cufilt);
//$relurl= geturl("mode=".$mode);
$modeel= "mode=".$mode ."&onlycoun=".$onlycoun;
$relurl= geturl($modeel);

									# корекция на избран запис 
									$edit= $GETPARAM["edit"];
									if (isset($edit)){
$FLAGCLON= false;
include_once "outtemedit.ajax.php";
exit;
									}else{
									}

									# корекция на избран запис ИССИ
									$issi= $GETPARAM["issi"];
									if (isset($issi)){
										$edit = $issi;
										$FLAGCLON= false;
										include_once "outtemissi.ajax.php";
										exit;
									}else{
									}

									# клониране на избран запис 
									$clon= $GETPARAM["clon"];
									if (isset($clon)){
$FLAGCLON= true;
	$edit= $clon;
include_once "outtemedit.ajax.php";
exit;
									}else{
									}

									# корекция на html файла за избран запис 
									$html= $GETPARAM["html"];
									if (isset($html)){
$rocont= getrow("docutype",$html);
$smarty->assign("TEMPTEXT", $rocont["text"]);
$htmlname= "outgoing/" .$rocont["filename"];
include_once "outtemhtml.ajax.php";
exit;
									}else{
									}

									# за файловете .doc вместо корекция html 
									# качване на нов файл 
									$uplo= $GETPARAM["uplo"];
									if (isset($uplo)){
//	$edit= $uplo;
include_once "outtemuplo.ajax.php";
exit;
									}else{
									}

							# активиране (показване) на избран запис 
							$acti= $GETPARAM["acti"];
							if (isset($acti)){
$DB->query("update docutype set ishidden=0 where id=$acti");
							}else{
							}
							# деактивиране (скриване) на избран запис 
							$hidd= $GETPARAM["hidd"];
							if (isset($hidd)){
$DB->query("update docutype set ishidden=1 where id=$hidd");
							}else{
							}

														# подреждане на избран запис 
														$sort= $GETPARAM["sort"];
														if (isset($sort)){
include_once "outtemsort.ajax.php";
exit;
														}else{
														}

# списъка 
//$mylist= $DB->select("select * from docutype order by text");
														# 15.03.2017 подреждане 
														$mylist= $DB->select("select * from docutype order by idsort");
$mylist= dbconv($mylist);
//print_rr(toutf8($mylist));
//print_ru($mylist);

# трансформираме го - параметри за иконите 
//				$modeel= "mode=".$mode;
//				$modeel= "mode=".$mode."&page=".$page;
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
	$mylist[$uskey]["issi"]= geturl($modeel."&issi=".$idcurr);
	$mylist[$uskey]["clon"]= geturl($modeel."&clon=".$idcurr);
	$mylist[$uskey]["html"]= geturl($modeel."&html=".$idcurr);
	$mylist[$uskey]["acti"]= geturl($modeel."&acti=".$idcurr);
	$mylist[$uskey]["hidd"]= geturl($modeel."&hidd=".$idcurr);
				$arelem= explode(".",$uscont["filename"]);
				$filesuff= $arelem[count($arelem)-1];
	$mylist[$uskey]["suff"]= $filesuff;
	$mylist[$uskey]["uplo"]= geturl($modeel."&uplo=".$idcurr);
	$isas = $DB->select("select * from issi_docu_outgoing where id_docutype = {$uscont['id']}");
	$mylist[$uskey]['isassigned'] = !empty($isas)? 1 : 0;
/***
			# тагове 
			$resutags= gettags($uscont["filename"]);
	$mylist[$uskey]["artags"]= $resutags;
						# зареждаме флага ismult 
						if (empty($resutags)){
							$ismult= 0;
						}else{
							$ismult= 1;
						}
						$DB->query("update docutype set ismult=?d where id=?d"  ,$ismult,$idcurr);
				# зареждаме флага isbank 
				if (!empty($resutags) and in_array("DB_BANKLIST_CB",$resutags)){
					$isbank= 1;
				}else{
					$isbank= 0;
				}
				$DB->query("update docutype set isbank=?d where id=?d"  ,$isbank,$idcurr);
	$mylist[$uskey]["ismult"]= $ismult;
***/
														# 15.03.2017 подреждане 
	$mylist[$uskey]["sort"]= geturl($modeel."&sort=".$idcurr);
}

# add new link 
$addnew= geturl($modeel."&edit=0");

//				# 13.04 2009 - един документ - много дела 
//# допълнителни js линкове за секцията head 
//$smarty->assign("HEADJS", array("cluetip.hoverIntent.js","jquery.cluetip.js"));

# буквата за редактиране - от основ.данни 
$rooffi= getofficerow($iduser);
$letedi= $rooffi["letteredit"];
$smarty->assign("LETEDI", $letedi);
										# 23.06.2010 - флаг - при изходяване на документ 
										# автоматично да се добавя таксата като предмет на изпълнение
										$rooffi= getofficerow(0);
										$regita= $rooffi["isregitax"];
										$isregitax= ($regita<>0);
									$smarty->assign("ISREGITAX", $isregitax);
										# 18.08.2014 - брой изх.документи 
									$arcoun= $DB->selectCol("select iddocutype as ARRAY_KEY, count(*) from docuout group by iddocutype");
									$smarty->assign("ARCOUN", $arcoun);
										//# 18.08.2014 - връчване 
										//include_once "deli.inc.php";
# извеждаме 
$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("outtem.tpl","fetch");


# връща списък с важните тагове 
# източник : _mult1.php 
function gettags($filename){
global $listspectags, $preftemp;
//	$outdir= "outgoing/";
//	$armark= array("DB_BANKLIST_CB", "DB_REGIONKAT_CB", "DB_REGIONVPI_CB", "DB_REGIONNAP_CB", "ADRESAT_BANK", "ADV_NAME", "NAP_NAME");
//	$armark= $listspectags + array(11=>"ADV_NAME", 12=>"NAP_NAME");
	$armark= $listspectags;
//print_rr($armark);
//	$realname= $outdir.$filename;
	$realname= $preftemp.$filename;
//print "<br>$realname";
//			if (file_exists($realname)){
			if (file_exists($realname) and !empty($filename)){
//print "=yes";
								$artags= array();
				$cont= file_get_contents($realname);
				foreach($armark as $mark){
					if (strpos($cont,$mark)===false){
					}else{
								$artags[]= $mark;
					}
				}
			}else{
return false;
			}
return $artags;
}

?>
