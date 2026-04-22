<?php
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
# сесийна променлива : 
#     $_SESSION["filtco"] - масив с параметрите на текущия филтър 
# още отгоре : 
#     $CASEALL==true - ако админа е избрал "всички дела" 
# 04.05.2009 - делата са разделени на активни и прекратени 
# още отгоре : 
#     $FILTACTI - код за MySQL-in - според статуса за прекратяване 
//print_rr($GETPARAM);
//print_rr($_SESSION["tabs"]);
//print_rr($_SESSION["filtco"]);
									
	#---- архив --------------------------------------------------------------------------------------------
							# виж casearch.ajax.php - Не трябва да трием там, защото NyroModal се вика повече от 1 път. 
							# затова трием тук 
							unset($_SESSION["listarch"]);

# заради cazobase.php 
if (isset($CASEALL)){
}else{
	$CASEALL= false;
			$_SESSION["FLAGALL"]= false;
}
//var_dump($CASEALL);

										# 11.06.2009 - предупреждение за непълни основни данни 
										include_once "casebase.inc.php";

			#----------------------------------------------------------------------------------------
			# еднократни дневни действия 
# име на файла с датата на последното сканиране 
$hangfilename= "cache/HANGDATE.TXT";
			# дали вече е направено сканирането за днешната дата 
			$currdate= date("Y-m-d");
			if (file_exists($hangfilename)){
				$filedate= file_get_contents($hangfilename);
			}else{
				$filedate= "";
			}
			if ($currdate==$filedate){
			}else{
				# още не е правено 



							#-------------------------------- висящите дела ------------------------------------
							# 04.05.2009 - специален режим за делата със статус висящо - suit.idstat==$indxhang 
							# сканиране на висящите дела 
				# MySQL кодове 
						# датата, която е 30 дена след датата на последния статус 
						$myc1= "date_add(date(suit.timestat), interval 30 day)";
						# дали тази дата е >= на днешната 
						$myc2= "'$currdate' >= ($myc1)";
				# списък на висящите дела, за които е настъпил 30-дневния срок 
				$hanglist= $DB->select("select * from suit where idstat=$indxhang and $myc2");
//print_r($hanglist);
				# има ли  висящи дела, за които е настъпил 30-дневния срок 
				if (count($hanglist)==0){
					# няма 
				}else{
					# има такива висящи дела - за всички корегираме датата на последния статус 
					foreach($hanglist as $hangelem){
						$hatime= $hangelem["timestat"];
						# разлагаме времето 
						list($par1,$par2)= explode(" ",$hatime);
						list($ye,$mo,$da)= explode("-",$par1);
						# определяме датата на последния от веригата 30-дневни срокове, която не надвишава днешната 
						$stampold= mktime(1,1,1, $mo,$da,$ye);
						while (true){
							$da += 30;
							$stampnew= mktime(1,1,1, $mo,$da,$ye);
							$datenew= date("Y-m-d",$stampnew);
							if ($datenew==$currdate){
								$stampresu= $stampnew;
								break;
							}elseif ($datenew<$currdate){
								$stampold= $stampnew;
							}else{
								$stampresu= $stampold;
								break;
							}
						}
						# получихме щампата $stampresu, която не надвишава днешната 
						$dateresu= date("Y-m-d",$stampresu);
						# корегираме записа за текущото дело от списъка с висящите 
						$haid= $hangelem["id"];
						$hset= array();
						$hset["timestat"]= $dateresu;
						$hset["flagstat"]= 1;
						$DB->query("update suit set ?a, lastdocu= now() where id=?d" ,$hset,$haid);
					}
				# край - има ли  висящи дела, за които е настъпил 30-дневния срок 
				}
				
							#-------------------------------- делата със спец.статус на ПДИ ------------------------------------
							# 05.05.2009 - делата, които имат ПДИ, за които не е започнало изпълнението в 7/14 днев.срок 
							# сканиране - източник : inviedit.ajax.php 
							# списък на ПДИ, които имат дата и не е започнало изпълнението им 
							# паралелно титула на делото, за което е текущото ПДИ 
							$inviquery= "select aainvita.* ,suit.id as caseid ,suit.idtitu as casetitu
								from aainvita
								left join docuout on aainvita.iddocuout=docuout.id
								left join suit on docuout.idcase=suit.id
								where aainvita.date<>'' and aainvita.flag=0
								";
							$invilist= $DB->select($inviquery);
//print_r($invilist);
							foreach($invilist as $inelem){
								# срока за добр.изпълнение 
								$casetitu= $inelem["casetitu"];
								$days= $timetitu[$casetitu];
								# определяме крайния срок за започване 
								# за да са изтекли $days пълни дни, приемаме 1-вата секунда на следващия ден за краен срок 
								$indate= $inelem["date"];
								list($da,$mo,$ye)= explode(".",$indate);
								$finistam= mktime(0,0,1, $mo,$da+$days+1,$ye);
								# дали в момента е преминал крайния срок 
								$idca= $inelem["caseid"];
								if (time() > $finistam){
									# да, преминал е - маркираме делото 
														invicaseupdate(2,$idca,true);
								}else{
									# не е преминал 
														# премахва маркирането 
														# за всеки случай при тестовете със стари дати 
														invicaseupdate(0,$idca,true);
								}
							}

							#-------------------------------- временните файлове от кеша ------------------------------------
							# 04.06.2009 - изтриваме временните файлове за http2ps, без тези от днешния ден 
											list($ye,$mo,$da)= explode("-",date("Y-m-d"));
											$currstamp= mktime(0,0,1, $mo,$da,$ye);
							$path= "cache";
							$dire= dir($path);
							while (false !== ($caname= $dire->read())){
								$funame= $path ."/" .$caname;
								if (is_dir($funame)){
								}else{
									if (strlen($caname)==32 and strpos($caname,".")===false){
										if (filemtime($funame)<$currstamp){
											//print "<br>$funame";
											unlink($funame);
										}else{
										}
									}else{
									}
								}
							}
							$dire->close();

							#-------------------------------- временните файлове от кеша ------------------------------------
							# 06.06.2009 - вземаме ОЛП за определене днешната дата от сайта на БНБ и го записваме в таблицата, ако е нов 
															include_once "percfrombnb.inc.php";
//////////////////////							gettodayperc();
//exit;


							#-------------------------------- статистика на постъпленията ------------------------------------
							# 11.02.2010 - брой записи за постъпления по признаци : тип, разпределено, приключено 
//							$qufist= "select concat(idtype,if(rest=0,1,0),isclosed) as ARRAY_KEY, count(*) as coun
//								from finance group by idtype, if(rest=0,1,0), isclosed
//								";
							$qufist= "select concat(if(idcase=0,0,1),if(rest=0,1,0),isclosed,idtype) as ARRAY_KEY, count(*) as coun
								from finance 
								group by if(idcase=0,0,1), if(rest=0,1,0), isclosed, idtype
								";
							$myfist= $DB->select($qufist);
//print_r($myfist);
							$DB->query("insert into finastatis set time=now(), statis=?"  ,serialize($myfist));

				# записваме текущата дата във файла 
				file_put_contents($hangfilename,$currdate);
			}
			#----------------------------------------------------------------------------------------

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

# допълнителни js линкове за секцията head 
//$smarty->assign("HEADJS", array("cluetip.hoverIntent.js","jquery.cluetip.js"));
//$smarty->assign("HEADJS", array("cluetip.hoverIntent.js","jquery.dimensions.js","jquery.cluetip.js"));
								# 18.02.2009 
								# админа може да обслужва ВСИЧКИ дела, а не само своите 
								# ако този скрипт е извикан от caseall.php 
								# отгоре : $CASEALL 
//								if (isset($CASEALL)){
								if ($CASEALL){
									$FILTUSER= "1";
$smarty->assign("VIEWUSERNAME", true);
//# допълнителни js линкове за секцията head 
//$smarty->assign("HEADJS", array("cluetip.hoverIntent.js","jquery.cluetip.js"));
			# 25.02.2009 
			# админа може да смени деловодителя на всяко дело 
		# списък на възможните собственици 
		$userlist= getselect("user","name","inactive=0",true);
//			$userlist= dbconv($userlist);
//print_r($userlist);
$smarty->assign("USERLIST", "userlist");
		# от формата - след евент.смяна на текущия деловодител за избор 
		$ownerpo= $_POST["ownerid"];
			if (isset($ownerpo)){
				$_SESSION["ownerid"]= $ownerpo;
			}else{
			}
		# към формата - текущия деловодител за избор 
		$ownerse= $_SESSION["ownerid"];
			if (isset($ownerse)){
				$_POST["ownerid"]= $ownerse;
			}else{
			}
		# данните за деловодителя за избор 
		$roowner= getrow("user",$ownerse);
$smarty->assign("OWNAME", $roowner["name"]);
								}else{
									$FILTUSER= "suit.iduser=$iduser";
												# 15.06.2010 - флаг - изп.дела нямат постоянни деловодители 
												if ($NOPERMUSER){
									$FILTUSER= "1";
												}else{
												}
								}
								
# текущата страница 
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

# текущия параметър за филтъра 
$filt= $GETPARAM["filt"];
$filt= isset($filt) ? $filt : "all";
$GETPARAM["filt"]= $filt;
	$smarty->assign("FILT", $filt);
//# евент. текущо съдържание на филтъра  
//$filtcont= $GETPARAM["filtcont"];

								# всичко за филтрирането 
								include_once "casefilt.inc.php";

# общ стринг - преход на 1вата станица - 
# за 3-те прехода : филтър-всички, всички-филтър, филтър-друг_филтър 
$mypref= "mode=".$mode ."&page=1";
# за смяна на режима на филтрирането - според тек.параметър 
if (0){
}elseif ($filt=="all"){
	#---- състояние без филтър ---- 
//						unset($_SESSION["filter"]);
	# след въвеждане на филтъра - 
	# ще преминем от всички към филтър - отново на 1ва страница 
	$smarty->assign("FILTYES", geturl($mypref ."&filt=change"));
					# формираме филтъра - по дела 
					# - празен, независимо от текущите параметри 
					$FILT1= "";
}elseif ($filt=="yes"){
	#---- състояние има филтър ---- 
	# след корекция на филтъра - 
	# ще преминем от един филтър към друг - не променяме страницата 
	$smarty->assign("FILTYES", geturl($mypref ."&filt=change"));
	# директно - 
	# ще преминем от филтър към всички - отново на 1ва страница 
	$smarty->assign("FILTALL", geturl($mypref ."&filt=all"));
								
								# за визуализация на филтъра 
								$smarty->assign("FILTVISU", filtvisu());
//print_rr(filtvisu());
					
#----------------------------------- формиране на филтъра ----------------------------------------- 

					# според съдържанието на текущите параметри 
					# формираме филтъра-1 - по дела 
					$FILT1= filtcrea(array(1,2));
//print "<br>";
//print $FILT1;
/*
					# формираме филтъра-2 - по участници 
					$FILT2= filtcrea(array(3));
//print "<br>";
//print $FILT2;
					# формираме заявката за 2-ро ниво - таблиците claimer или debtor или двете 
					if (empty($FILT2)){
					}else{
						$merang= $_SESSION["filtco"]["merang"];
						if (0){
						}elseif ($merang==1){
							$qumemb= "select distinct idcase from claimer where 1 $FILT2";
						}elseif ($merang==2){
							$qumemb= "select distinct idcase from debtor where 1 $FILT2";
						}elseif ($merang==3){
							$qum1= "select idcase from claimer where 1 $FILT2";
							$qum2= "select idcase from debtor where 1 $FILT2";
							$qumemb= "($qum1) union distinct ($qum2)";
						}else{
die("case=merang=$merang");
						}
*/
//print "<br>";
//print $qumemb;
/******
					# формираме филтъра-2 - по участници 
					# отделно за взискател и за длъжник 
										# ВНИМАНИЕ. 06.04.2010 - Софрониев 
										# Вече има отделни полета за взискател и длъжник 
					$FILT2CLAI= filtcrea(array(3));
//var_dump($FILT2CLAI);
					$FILT2DEBT= filtcrea(array(4));
//var_dump($FILT2DEBT);
						if (0){
						}elseif (!empty($FILT2CLAI) and !empty($FILT2DEBT)){
							# попълнени са полета и за взискател, и за длъжник 
							$qum1= "select idcase from claimer where 1 $FILT2CLAI";
							$qum2= "select idcase from debtor where 1 $FILT2DEBT";
							$qumemb= "($qum1) union distinct ($qum2)";
						}elseif (!empty($FILT2CLAI)){
							# попълнени са полета само за взискател 
							$qumemb= "select distinct idcase from claimer where 1 $FILT2CLAI";
						}elseif (!empty($FILT2DEBT)){
							# попълнени са полета само за длъжник 
							$qumemb= "select distinct idcase from debtor where 1 $FILT2DEBT";
						}else{
							# няма попълнени полета нито за взискател, нито за длъжник 
							$qumemb= "";
						}
//var_dump($qumemb);
						if (empty($qumemb)){
							$myin= array();
						}else{
							# резултата от заявката 2-ро ниво 
							# - масив с всички suit.id, които отговарят на филтъра 
							# - независимо дали принадлежат на текущия потребител 
							$myin= $DB->selectCol($qumemb);
						}
//print "<br>array=<br>";
//print_r($myin);
******/
					# формираме филтъра-2 - по участници 
					# отделно за взискател и за длъжник 
										# ВНИМАНИЕ. 06.04.2010 - Софрониев 
										# Вече има отделни полета за взискател и длъжник 
								# 07.04.2010 - оправена стара грешка 
								# когато има условия и по взискател и по длъжник 
								# - не трябва да се прави union на заявките, защото се получава релация ИЛИ вместо И 
								# - трябва да се формира пресечното множество [intersection] на двата списъка с idcase 
					$FILT2CLAI= filtcrea(array(3));
					$quclai= "select distinct idcase from claimer where 1 $FILT2CLAI";
//var_dump($FILT2CLAI);
					$FILT2DEBT= filtcrea(array(4));
					$qudebt= "select distinct idcase from debtor where 1 $FILT2DEBT";
//var_dump($FILT2DEBT);
													# има ли изобщо полета за страните 
													$f2exists= true;
						if (0){
						}elseif (!empty($FILT2CLAI) and !empty($FILT2DEBT)){
							# попълнени са полета и за взискател, и за длъжник 
							$myinclai= $DB->selectCol($quclai);
							$myindebt= $DB->selectCol($qudebt);
									# пресечното множество 
							$myin= array_intersect($myinclai,$myindebt);
						}elseif (!empty($FILT2CLAI)){
							# попълнени са полета само за взискател 
							$myin= $DB->selectCol($quclai);
						}elseif (!empty($FILT2DEBT)){
							# попълнени са полета само за длъжник 
							$myin= $DB->selectCol($qudebt);
						}else{
							# няма попълнени полета нито за взискател, нито за длъжник 
							$myin= array();
													# няма изобщо полета за страните 
													$f2exists= false;
						}
						# получихме резултата от заявките 2-ро ниво 
						# - масив с всички suit.id, които отговарят на филтъра 
						# - независимо дали принадлежат на текущия потребител 
//print "<br>myin=<br>";
//print_r($myin);
//var_dump($f2exists);
						# формираме доп.филтър за главната заявка 
						if (count($myin)==0){
							# няма нито едно suit.id, което отговаря на филтъра 
							# - главната заявка трябва да върне празен резултат 
													# според дали има изобщо полета за страните 
													if ($f2exists){
							# има полета за страните, но няма дела, които отговарят 
							$FILTIN= " and 0";
													}else{
														# изобщо няма полета за страните - 
														# ще действат само останалите елементи на филтъра 
														$FILTIN= " and 1";
													}
						}else{
							# има suit.id, които отговарят на филтъра 
							# - формираме код за mysql in за главната заявка 
							$exin= implode(",",$myin);
							$FILTIN= " and suit.id in ($exin)";
						}
/*
					}
*/

#----------------------------------- край формиране на филтъра ----------------------------------------- 

}elseif ($filt=="change"){
	#---- състояние корекция на филтъра [ajax-форма] ---- 
										include_once "casefilt.ajax.php";
										exit;
}else{
die("case=filt=$filt");
}

/*
									# разглеждане на избран запис 
									$view= $GETPARAM["view"];
									if (isset($view)){
										include_once "caseview.ajax.php";
										exit;
									}else{
									}
*/
					
					# прозорец с въпрос за безусловно отключване 
					$gounlock= $GETPARAM["gounlock"];
					if (isset($gounlock)){
include_once "casegoun.ajax.php";
exit;
					}else{
					}
					
					# премахване текущия таб от списъка 
					$goout= $GETPARAM["goout"];
/*
# абсолютно същите действия при unlock - 
# админа отключва дело, независимо кой го е заключил 
$unlock= $GETPARAM["unlock"];
$goout= (isset($unlock)) ? $unlock : $goout;
*/
//print_r($GETPARAM);

/*************************
					if (isset($goout)){
	# 17.02.2010 - десен клик за затваряне на всички дела 
	if ($goout=="all"){
print "OUTALL";
	}else{
						unset($_SESSION["tabs"][$goout]);
												# 18.02.2009 
												# заключване на делата и в БД - табл. suit 
										# отключваме делото от таба в БД 
										$DB->query("update suit set lockedby=0 where id=?" ,$goout);
						# след премахването - 
						# пренасочваме към страницата от списъка с дела 
						$redilink= geturl("mode=".$mode ."&page=".$page ."&filt=".$filt);
reload("",$redilink);
return;
	}
					}else{
					}
*************************/
# ВНИМАНИЕ. 17.02.2010 
# отключването на делото вече е на ajax - виж шаблона tabslist.tpl и casegoout.ajax.php 
					
					# корекция на избран запис 
					$edit= $GETPARAM["edit"];
					if (isset($edit)){
	# 01.06.2009 - добавя празно дело 
	if ($edit==0){
include_once "caseaddnew.ajax.php";
exit;
	}else{
	}
						# четем съдържанието 
						$rocase= getrow("suit",$edit);
														# 26.02.2009 
														# дали деловодител на делото е логнатия потребител 
														# а също и ако е логнат админа 
														$idowner= $rocase["iduser"];
//														if ($idowner==$iduser){
//														if ($idowner==$iduser    or isset($CASEALL)){
														if ($idowner==$iduser    or $CASEALL){
															# да - деловодител е логнатия потребител  
						
									# 18.02.2009 
									# заключване на делата и в БД - табл. suit 
						# проверяваме дали записа не е заключен от друг потребител 
						$lockedby= $rocase["lockedby"];
						if ($lockedby==0 or $lockedby==$iduser){
							# не е заключен от друг 
							# - извеждаме избраното дело 
#++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
										# маркираме го като viewed 
										$DB->query("update suit set last2=1 where id=?" ,$edit);
							include_once "caseedit.php";
$smarty->assign("PAGEBACK", $page);
//print "mode=".$mode ."&page=".$page;
$smarty->assign("PAGEBACKLINK", geturl("mode=".$mode ."&page=".$page ."&filt=".$filt));
$pagecont= smdisp("caseedit.tpl","fetch");
return;
#++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
						}else{
							# заключен е от друг 
							# - извеждаме отново страницата със списъка, но със съобщение за забраната 
/*
							$rouser= getrow("user",$lockedby);
							$lockname= $rouser["name"];
$smarty->assign("LOCKNAME", $lockname);
//$pagecont= smdisp("caselocked.tpl","fetch");
//return;
*/
$smarty->assign("HEADJS", array("_caselock.js"));
$smarty->assign("LINKLOCK", geturl("lockedby=".$lockedby));
						# край на проверката дали записа не е заключен от друг потребител 
						}
														}else{
															# не - деловодител е друг потребител  
												# 15.06.2010 - флаг - изп.дела нямат постоянни деловодители 
												if ($NOPERMUSER){
#------ КОПИРАН КОД ----------------------------
$lockedby= $rocase["lockedby"];
if ($lockedby==0 or $lockedby==$iduser){
	# не е заключен от друг - извеждаме делото 
#++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//print "NOPERMUSER";
										# маркираме го като viewed 
										$DB->query("update suit set last2=1 where id=?" ,$edit);
							include_once "caseedit.php";
$smarty->assign("PAGEBACK", $page);
//print "mode=".$mode ."&page=".$page;
$smarty->assign("PAGEBACKLINK", geturl("mode=".$mode ."&page=".$page ."&filt=".$filt));
$pagecont= smdisp("caseedit.tpl","fetch");
return;
#++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
}else{
	# заключен от друг - съобщение за забрана 
	$smarty->assign("HEADJS", array("_caselock.js"));
	$smarty->assign("LINKLOCK", geturl("lockedby=".$lockedby));
}
												}else{
#------ СТАРИЯ КОД ----------------------------
$smarty->assign("HEADJS", array("_caseowne.js"));
$smarty->assign("LINKOWNE", geturl("ownerid=".$idowner));
												}
														# край на проверката дали деловодител на делото е логнатия потребител 
														}
					}else{
					}


#---------------------------------------------------------------------------------
# 04.09.2009 - Софрониев - филтър - търсене в делата по номер от-до за тек.година 
# източник : newc.php - същото за свободните дела 
			$serifiltpara= $GETPARAM["serifiltpara"];
			$serifiltpost= $_POST["serifilt"];
//print "[$serifiltpara][$serifiltpost]";
			if (isset($serifiltpost)){
				$serifiltpara= $serifiltpost;
			}else{
			}
//var_dump($serifiltpara);
//print "filter=[$textfilt]";
$_POST["serifilt"]= $serifiltpara;
/*
					# филтър за заявката 
					$filtseri= "";
$mark= "serifilt";
if (strpos($serifiltpara,$mark)===0){
		# нормализираме стринга за текущия филтър 
		$serifiltpara= substr($serifiltpara,strlen($mark));
					$_POST["serifilt"]= $serifiltpara;
		# формираме филтъра 
		if (empty($serifiltpara)){
//			$filtseri= "";
		}else{
//		# нулираме другия филтър 
//		$textfilt= "";
//		$_POST["textfilt"]= "";
				# анализ на филтъра 
				list($ser1,$ser2)= explode("-",$serifiltpara);
				$ser1= $ser1 +0;
				$ser2= $ser2 +0;
				$ser2= ($ser2==0) ? $ser1 : $ser2;
					$filtseri= "and suit.serial>=$ser1 and suit.serial<=$ser2";
		}
}else{
}
*/
//var_dump($filtseri);
if (empty($serifiltpara)){
					$filtseri= "";
}else{
				# формираме филтъра за заявката 
				list($ser1,$ser2)= explode("-",$serifiltpara);
				$ser1= $ser1 +0;
				$ser2= $ser2 +0;
				$ser2= ($ser2==0) ? $ser1 : $ser2;
					$filtseri= "and suit.serial>=$ser1 and suit.serial<=$ser2";
}
#---------------------------------------------------------------------------------



# списъка - по времето на последния постъпил входен документ - в обратен ред 
		# странициране заедно с dbsimple [dklab] 
		# използваме вече формираните стрингове $FILT1, $FILTIN 
					include "pagi.class.php";
//		$query= "select * from suit where iduser=$iduser order by lastdocu desc";
								# 18.02.2009 
								# админа може да обслужва ВСИЧКИ дела, а не само своите 
								# - админа ще вижда и колона "потребител" - деловодителя на делото
								# - за админа делата ще са подредени по години и номера в намаляващ ред 
//$query= "select * from suit where suit.iduser=$iduser $FILT1 $FILTIN order by lastdocu desc";
//								if (isset($CASEALL)){
								if ($CASEALL){
$orby= "suit.year desc, suit.serial desc";
								}else{
//$orby= "suit.lastdocu desc";
# 29.10.2009 - Софрониев 
# и тук вече сортираме в обр.ред на година, номер 
$orby= "suit.year desc, suit.serial desc";
								}
													/*
												# 12.03.2009 
												# ВРЕМЕННО при внедряването има голям брой кухи дела без съдържание 
												# затова изключваме делата без нито един входен документ 
												$ext1= "left join docu on docu.idcase=suit.id";
												$ext2= "and docu.id is not null";
													*/
											# 26.07.2010 - използват се в viewecase.php - дела на наблюдател 
											if (isset($ext1) and isset($ext2)){
											}else{
												$ext1= "";
												$ext2= "";
											}
//$query= "select suit.*, suit.id as id
//print "filtuser=[$FILTUSER]";
					# ВНИМАНИЕ. 01.04.2010 - Софрониев 
					# Вече няма значение кой е логнатия юзер - търси в делата на всички юзери 
//					# само ако специалния филтър от формата има поне 1 елемент 
//					if (empty($FILT1) and empty($FILTIN)){
					# само ако филтъра от формата има поне 1 елемент 
					if (empty($FILT1) and !$f2exists){
					}else{
						$FILTUSER= "1";
					}
//var_dump($FILTUSER);
//var_dump($FILT1);
//var_dump($FILTIN);
$query= "select distinct suit.id as id, suit.*
				, user.name as username
	from suit 
				left join user on suit.iduser=user.id
												$ext1
	where $FILTUSER $FILT1 $FILTIN 
	and suit.idstat $FILTACTI
$filtseri
												$ext2
	order by $orby
	";
//print "filter=$FILTUSER $FILT1 $FILTIN and suit.idstat $FILTACTI";
//print "FILTIN=$FILTIN";
//print "<br>$query";
		$prefurl= "";
		$baseurl= "mode=".$mode ."&filt=".$filt;
# 04.09.2009 - Софрониев - филтър - търсене в делата по номер от-до за тек.година 
if (empty($serifiltpara)){
}else{
		$baseurl .= "&serifiltpara=".$serifiltpara;
}
//var_dump($baseurl);
		$obpagi= new paginator(80, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);
							
							# за извеждане на "идва от" - кеширания масив 
							$arfrom= unserialize(file_get_contents(COFROMFILE));
							# предаваме съдържанието 
							$smarty->assign("ARFROM", $arfrom);
						# 03.05.2009 
						# за извеждане на статуса - съдържанието на 1-мерния масив 
						$smarty->assign("ARSTAT", $viewcasestat);

# базов URL за иконите 
$modeel= "mode=".$mode ."&page=".$page ."&filt=".$filt;

	#---- архив --------------------------------------------------------------------------------------------
						# 12.04.2010 - данните за архива 
						# съществува ли таблицата с архива 
						$dbindx= "Tables_in_exof";
						$arctab= "archive";
						$listtabl= $DB->query("show tables");
									$flagarchive= false;
						foreach($listtabl as $elem){
							if ($elem[$dbindx]==$arctab){
									$flagarchive= true;
								break;
							}else{
							}
						}
//var_dump($flagarchive);
$smarty->assign("FLAGARCHIVE", $flagarchive);
$smarty->assign("LINKARCHIVE", geturl($modeel ."&editarch=0"));
	#------------------------------------------------------------------------------------------------
	
# трансформираме го - параметри за иконите 
//				# базов URL за иконите 
//				$modeel= "mode=".$mode ."&page=".$page ."&filt=".$filt;
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
						# 03.05.2009 - за историята на статусите 
						# НЕЕФЕКТИВНО - циклична заявка към БД 
						$quhi= "select suitstathist.* ,user.name as username
							from suitstathist 
							left join user on suitstathist.iduser=user.id
							where suitstathist.idcase=?d";
						$stathist= $DB->select($quhi ,$idcurr);
						$stathist= dbconv($stathist);
//print "====".$uscont["serial"]."/".$uscont["year"]."====<br>";
//print_rr(tran1251($stathist));
	$mylist[$uskey]["hist"]= $stathist;
	$mylist[$uskey]["histcoun"]= count($stathist);
//print "<br>$idcurr";
//print_r($stathist);
												# 18.02.2009 
												# заключване на делата и в БД - табл. suit 
									# за иконата - дали текущото дело е заключено - да/не, от логнатия, от друг юзер 
									$lockedby= $uscont["lockedby"];
									/*
									if ($lockedby==0 or $lockedby==$iduser){
									}else{
										$rouser= getrow("user",$lockedby);
										$lockname= $rouser["name"];
	$mylist[$uskey]["lockname"]= $lockname;
									}
									*/
									if ($lockedby==0){
									}elseif ($lockedby==$iduser){
			# заключено от текущия юзер, клик върху иконата ще го отключи 
			#  линк - за отключване и премахване текущия таб от списъка - източник : caseedit.php 
	$mylist[$uskey]["lockmy"]= geturl($modeel ."&goout=$idcurr");
									}else{
										$rouser= getrow("user",$lockedby);
										$lockname= $rouser["name"];
	$mylist[$uskey]["lockname"]= $lockname;
										# 18.02.2009 
										# админа може да обслужва ВСИЧКИ дела, а не само своите 
												# линк - ако е админ, ще може да отключи делото, независимо кой го е заключил 
//												if (isset($CASEALL)){
												if ($CASEALL){
	$mylist[$uskey]["gounlock"]= geturl($modeel ."&gounlock=$idcurr");
												}else{
												}
									}
# 24.02.2009 - временна лепенка в началото на внедряването 
# списък на входящите документи за текущото дело 
# НЕЕФЕКТИВНО - циклична заявка към БД 
//						if (isset($CASEALL)){
						if ($CASEALL){
//	$ardocu= $DB->selectCol("select concat(serial,'/',year) from docu where idcase=?", $idcurr);
							/*
	$ardocu= $DB->select("select * from docu where idcase=?", $idcurr);
	$ardocu= dbconv($ardocu);
							*/
							# 13.04 2009 - един документ - много дела 
							# получаваме всички данни за документите по това дело 
							$ardocu= get_docu_of_case($idcurr);
//print "<br>$idcurr";
//print_r($ardocu);
	$mylist[$uskey]["listdocu"]= $ardocu;
						}else{
						}
										# 11.06.2009 - предупреждение за непълни основни данни 
										basecheck($uscont);
	$mylist[$uskey]["basecoun"]= $uscont["basestatus"];
	#---- архив --------------------------------------------------------------------------------------------
						# 12.04.2010 - данните за архива - само ако съществува таблицата с архива 
						# НЕЕФЕКТИВНО - циклична заявка към БД 
						if ($flagarchive){
//							$roarch= $DB->selectRow("select * from archive where idcase=?d" ,$idcurr);
							$roarch= $DB->selectRow("
								select archive.*, archive.id as id, user.name as username
								from archive 
								left join user on archive.iduser=user.id
								where archive.idcase=?d
								" ,$idcurr);
							$roarch= dbconv($roarch);
	$mylist[$uskey]["archive"]= $roarch;
							if (empty($roarch)){
								# дали има неприключени постъпления за това дело 
								$notclosed= $DB->selectCell(
								"select count(id) from finance where isclosed=0 and idcase=?d"  ,$idcurr);
							}else{
								$notclosed= -1;
							}
	$mylist[$uskey]["notclosed"]= $notclosed;
//	$mylist[$uskey]["editarch"]= geturl($modeel ."&editarch=$idcurr");
										if ($roarch["id"]+0==0){
	$mylist[$uskey]["toarch"]= geturl($modeel ."&toarch=".$idcurr);
										}else{
	$mylist[$uskey]["editarch"]= geturl($modeel ."&editarch=".$roarch["id"]);
										}
						}else{
						}
	#------------------------------------------------------------------------------------------------
	# 23.07.2010 - променен шаблон Бъзински 
	# списък с взискатели и длъжници - НЕЕФЕКТИВНО 
	if ($ISFILTACTION){
		$listclai= $DB->select("select idtype, egn,bulstat,name from claimer where idcase=?d"  ,$idcurr);
		$listclai= dbconv($listclai);
$mylist[$uskey]["listclai"]= $listclai;
		$listdebt= $DB->select("select idtype, egn,bulstat,name from debtor where idcase=?d"  ,$idcurr);
		$listdebt= dbconv($listdebt);
$mylist[$uskey]["listdebt"]= $listdebt;
//var_dump($idcurr);
//print_rr($listclai);
//print_rr($listdebt);
	}else{
	}
	#------------------------------------------------------------------------------------------------
}
//print_rr($mylist);
							
//							# за извеждане списъка с отворените табове 
//							$smarty->assign("TABSLIST", $_SESSION["tabs"]);
									# трансформираме линковете в масива $_SESSION["tabs"] 
									# - заради актуалното състояние на параметъра $filt 
									updatabslist();
									# за извеждане списъка с отворените табове 
									$smarty->assign("TABSLIST", $_SESSION["tabs"]);

# add new link 
$addnew= geturl($modeel."&edit=0");
			
//			# 17.02.2010 - десен клик за затваряне на всички дела 
//			$smarty->assign("OUTALL", geturl($modeel ."&goout=all"));

# извеждаме 
$smarty->assign("ADDNEW", $addnew);
$smarty->assign("CASELIST", $mylist);
				if (isset($tplnam)){
$pagecont= smdisp($tplnam,"fetch");
				}else{
$pagecont= smdisp("case.tpl","fetch");
				}

?>
