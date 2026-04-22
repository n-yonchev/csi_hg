<?php
# зона-6 : създаване на нов изходящ документ по делото 
# отгоре : 
#    $edit= case.id 
#    $zone= 6 
#    $func= view 
#  $docu= 0 
//print_r($GETPARAM);
//print "<br>";
//print_r($_POST);

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

# id на делото - в сесията 
$_SESSION["IDCASECREA"]= $edit;

# таблицата 
$taname= "docuout";
# шаблона 
$tpname= "cazo6crea.ajax.tpl";
//# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page."&bapaelem=".$bapaelem."&pageelem=".$pageelem);

//# полетата 
//$filist= array(
//	"iddocutype"=>  array("validator"=>"notzero", "error"=>"типа е задължителен")
//);
# константни полета 
$ficonst= array();
$ficonst["idcase"]= $edit;

										# функции за връчване - заместване на тагове 
										include_once "cazo6regi2.inc.php";


									# класа за редактиране 
									include_once "edit.class.php";

#----------------- директно редактиране -----------------------
# СПЕЦИФИЧЕН СЦЕНАРИЙ 
#    - има автоматичен събмит 
#    - не са необходими кодове за връщане 

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";

									# основен входен параметър - $docu= 0
									# в случая не може да е <> 0 

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							//$retucode= -1;
# 17.08.2009 - избор на длъжници и съпрузите им с чекбоксове 
# начало - нулираме сесийния списък с избраните 
			include_once "cazo6creadocudefi.inc.php";
//var_dump($arsource);
# 17.08.2009 - избор на длъжници и съпрузите им с чекбоксове 
# дефинираме сесийно променливи за избора 
							#-- id на делото - в сесията 
							$_SESSION["listdebtcase"]= $edit;
//							$_SESSION["listdebtfiel"]= $fielname;
					#-- за всички маркери с дефиниран [ajax] - сесийна променлива 
					# индекс= името на полето във формата [filename] 
					# стойност= false - начално значение 
					foreach($arsource as $soelem){
						$soajax= $soelem["ajax"];
						$sofiel= $soelem["fielname"];
						if (isset($soajax)){
							$_SESSION[$sofiel]= false;
						}else{
						}
					}

#------ submit без формални грешки 
//}elseif ($mfacproc=="submit"){
}elseif ($mfacproc=="subm"){
							//$retucode= 0;
					
					ercheck();

#------ submit2 - създай документа 
//}elseif ($mfacproc=="submit2"){
}elseif ($mfacproc=="subm2"){
							//$retucode= 4;
					
					$flok= ercheck();
					if ($flok){
					
#-------------------------------------------------------------------------------
#------ формираме съдържание на новия документ 
# четем шаблона 
$iddocutype= $_POST["iddocutype"];
$rodoty= getrow("docutype", $iddocutype);
			# 27.04.2010 - за документ на Word 
			$arelem= explode(".",$rodoty["filename"]);
			$filesuff= $arelem[count($arelem)-1];
$fnam= OUTDIR.$rodoty["filename"];
$cont= file_get_contents($fnam);
			#---08.01.2010---------------------------------------------
/*
			$incpat= dirname(__FILE__);
			$smarty->assign("INCPAT", "$incpat/outgoing/");
//print $incpat;
//var_dump($fnam);
			$cont= smdisp("$incpat/$fnam","fetch");
//print "<xmp>$cont</xmp>";
print $cont;
//die();
*/
//print $cont;
//die();
			$cont= readtemphtml($fnam);
//print $cont;
//die();
			#----------------------------------------------------------
		$aset= $ficonst;
		$aset["iddocutype"]= $iddocutype;
//		$aset["content"]= $cont;
										# получаваме параметрите за заместване 
										# масива $data [метаиме] = масив( [text]=> [cont]=> ) 
										# също управляващия масив $arrepl 
//print $cont;
//die();
										include_once "cazo6creadocu.inc.php";
								# формираме масиви за заместване 
												$armeta= array();
												$artent= array();
//print_r(toutf8($data));
//print_r($data);
								foreach($data as $dain=>$daco){
									if (count($daco)==0){
									}else{
												$armeta[]= $dain;
												# ВНИМАНИЕ. 
												# проверката на типа е много важна. 
												$mytype= $arrepl[$dain]["type"];
//print "<br>[$dain][$mytype][$myflag]";
												if (0){
												}elseif (empty($mytype)){
													$artent[]= $daco["cont"];
												}elseif ($mytype=="form"){
					# 13.03.2009 ПЕТЪК - 
					# заради новите редове в полетата textarea 
					$fieltype= $arrepl[$dain]["fieltype"];
					if ($fieltype=="tear"){
//						$aset["content"]= nl2br($aset["content"]);
//						$artent[]= nl2br(toutf8($daco["cont"]));
										# 27.04.2010 - за документ на Word 
										if ($filesuff=="html"){
						$artent[]= nl2br($daco["cont"]);
										}else{
						$artent[]= wordnewline($daco["cont"]);
										}
					}elseif ($fieltype=="select"){
						$myindx= $daco["cont"];
						$mynaou= $arrepl[$dain]["arnameout"];
						$artent[]= ${$mynaou}[$myindx];
					}else{
													$artent[]= $daco["cont"];
					}
/*
	# трансформираме новите редове 
$content= $aset["content"];
	$content= str_replace("\r\n","<br>",$content);
	$content= str_replace("\n\r","<br>",$content);
	$content= str_replace("\n","<br>",$content);
	$content= str_replace("\r","<br>",$content);
$aset["content"]= $content;
*/
												}elseif ($mytype=="formdata"){
//													$artent[]= toutf8($daco["cont"]);
																	# 27.04.2010 - за документ на Word 
																	if ($filesuff=="html"){
													$artent[]= toutf8(nl2br($daco["cont"]));
																	}else{
													$artent[]= toutf8(wordnewline($daco["cont"]));
																	}
												}elseif ($mytype=="cbox"){
													# 12.12.2013 - чекбоксове за искане до НАП 
													$myfielname= $arrepl[$dain]["fielname"];
													$artent[]= (isset($_POST[$myfielname])) ? "--- " : "";
												}else{
													$artent[]= toutf8($daco["cont"]);
												}
			# 08.05.2009 - полета за пренасяне в таблицата 
			if ($daco["todata"]){
				$myfiel= $daco["fielname"];
				if (0){
				}elseif ($myfiel=="adresat"){
					$aset["adresat"]= toutf8($daco["cont"]);
				}else{
die("cazo6crea=todata=$myfiel");
				}
			}else{
			}
									}
								}
//print_r($armeta);
//print_r($artent);
//print $cont;
		//# заместваме метаимената 
		//$aset["content"]= str_replace($armeta, $artent, $cont);
		# заместваме метаимената 
//print $cont;
//die();
		$cont= str_replace($armeta, $artent, $cont);
									
#----------------------------------------------------------------------------------
# 04.09.2009 - нов тип заместване : {empty}{маркер}съдържание{/empty} 
# премахваме съдържанието между таговете, ако съдържанието на маркера е празно 
							# регулярния израз за търсене 
							$rbeg= "{empty}";
							$rend= "{/empty}";
//							$pattern= '|' .$rbeg .'.+?' .$rend .'|';
											# 27.04.2010 - 
											# i= insensitive, s= на повече от един ред 
											$pattern= '|' .$rbeg .'.+?' .$rend .'|is';
							# търсим 
							$found= preg_match_all($pattern, $cont, $matches);
							# цикъл за всички намерени стрингове 
							foreach($matches[0] as $x1=>$maco){
//print "<br>$maco";
								#--- за текущия стринг 
								# отделяме маркера 
								$blen= strlen($rbeg) +1;
								$mac2= substr($maco,$blen);
								$pos2= strpos($mac2,"}");
								$cumark= substr($mac2,0,$pos2);
//print "[$cumark]";
								# съдържанието за заместване на маркера 
								$emmark= "(-[" .$cumark ."]-)";
								$emindx= array_search($emmark,$armeta);
								if ($emindx===false){
die("cazo6crea=emindx=$cumark");
								}else{
									$emcont= $artent[$emindx];
//print "[$emcont]";
								}
								# според съдържанието на маркера 
//								if (empty($emcont)){
								if (empty($emcont)    or $emcont=="0.00"){
									# празно съдържание на маркера 
									# ще премахнем целия текст заедно с таговете {empty}{маркер} текст {/empty} 
									$newcont= "";
								}else{
									# има съдържание на маркера 
									# ще оставим текста, но премахваме самите тагове {empty}{маркер} текст {/empty} 
									$newcont= $maco;
									$newcont= str_replace($rbeg,"",$newcont);
									$newcont= str_replace($rend,"",$newcont);
									$newcont= str_replace("{".$cumark."}","",$newcont);
								}
								# заместваме за текущия стринг 
		$cont= str_replace($maco, $newcont, $cont);
							# край на цикъла за всички намерени стрингове 
							}
#----------------------------------------------------------------------------------
									
		# абсолютен адрес на логото <img= src="http://......"> 
		$cont= logotran($cont);
		# подготвяме масива 
		$aset["content"]= $cont;

//print $aset["content"];
//print_rr($GLOBALS);
//var_dump($fielname);
//var_dump($postname);
//print_rr($_POST);
//print_rr($_SESSION);
# 20.01.2010 ВНИМАНИЕ. ЛЕПЕНКА. 
# Записваме в доп.поле "extra" списъка с чекнатите чекбоксове - банки и съпрузи 
# Бл.град Дервиш - Чекнатите банки са необходими за процеса на отпечатване - Запорно съобщение до банки 
/*
# сесийното име да е съгласувано с $postname - c6spouse.ajax.php, c6bank.ajax.php 
		# $fielname е post името на textarea със съдържанието - списъка с имена 
		# формираме post името на полето с чекбоксове 
		$postname= "post_".$fielname;
//print "postname=[$postname]";
		$expost= $_POST[$postname];
*/
# Първото POST име, което има префикс EXTRA 
		$popref= "EXTRA";
		$poname= "";
foreach($_POST as $inpost=>$x2){
	if (substr($inpost,0,strlen($popref))==$popref){
		$poname= "post_".$inpost;
		break;
	}else{
	}
}
		$expost= $_POST[$poname];
//var_dump($expost);
		if (isset($expost)){
			if (is_array($expost)){
$aset["extra"]= serialize($expost);
			}else{
$aset["extra"]= $expost;
			}
		}else{
		}

#-------------------------------------------------------------------------------
# добавяме новия запис за документ 
//print_r($aset);
//print_ru($rodoty);
//print_ru($rodebt);
//die("GGGGGGGGGGGGGGGGGGG");
						# 27.04.2010 - за документ на Word 
						# ANGEL WORD DOCUMENT
						if ($filesuff=="html"){
						}else{
							$wordcont= $aset["content"];
							unset($aset["content"]);
						}
$editpaym= $DB->query("insert into $taname set ?a ,created=now()" ,$aset);
//var_dump($editpaym);
										
										# 17.03.2017 - запомняме тагове и съдържания за връчването 
										//print_rr($armeta);
										//print_rr($artent);
													function t2regi($fina){
													global $DB, $rodoty, $editpaym;
														$a2conttag= trim($rodoty[$fina]);
														if (empty($a2conttag)){
														}else{
															$a2resu= tranpost(toutf8($a2conttag));
																$rset= array();
																$rset["iddocuout"]= $editpaym;
																$rset["tag"]= $fina;
																$rset["tagcont"]= $a2resu;
															$DB->query("insert into postrepl set ?a"  ,$rset);
														}
													}
										t2regi("adresat");
										t2regi("postadresat");
										t2regi("postaddress");
										# запомняме длъжника за ПДИ - заради евент.придруж.писмо до РС за чл.417 
										if ($rodoty["mark"]=="pdi" and !empty($rodebt)){
																$rset= array();
																$rset["iddocuout"]= $editpaym;
																$rset["tag"]= "debtorid";
																$rset["tagcont"]= $rodebt["id"]+0;
															$DB->query("insert into postrepl set ?a"  ,$rset);
										}else{
										}

						# 27.04.2010 - за документ на Word 
						# ANGEL WORD DOCUMENT
						if ($filesuff=="html"){
						}else{
	$wordname= "docs/".$editpaym.".doc";
//var_dump($wordname);
//$rpat= realpath(dirname($wordname));
//var_dump($rpat);
	$fh= fopen($wordname, 'w+');
//var_dump($fh);
	$fw= fwrite($fh, $wordcont);
//var_dump($fw);
	$fc= fclose($fh);
//var_dump($fc);
	$cm= chmod($wordname, 0777);
//var_dump($cm);
//$w2= file_get_contents($wordname);
//$w2co= strlen($w2);
//print "length=$w2co";
						}

# линк за redirect 
$redilink= "t6link";
# redirect 
$smarty->assign("EXITCODE", getnyroexit($redilink));
					
					}else{
					# if ($flok){
					}

#------ submit с формални грешки 
	# невъзможно - няма списък с полета 
}elseif ($mfacproc==NULL){
							//$retucode= 1;
	doerrors();

#------ автоматичен submit -----------------------------------------------------
}elseif ($mfacproc=="UNKNOWN"){
	# автоматичен събмит след избор на типа 
							//$retucode= 2;
//	doerrors();
					
					ercheck();

#------ невъзможна грешка от библиотеката 
}else{
print "<br>error=mfacproc=";
var_dump($mfacproc);
die();
}

#----------------- край на директното редактиране -----------------------


										# параметрите за заместване 
											if ($_POST["iddocutype"]==0){
# 10.03.2009 - само изх.номер за старите дела 
# да се извежда чекбокса "само вземи изх.номер" 
$smarty->assign("ONLYGET", true);
											}else{
//										include_once "cazo6creadocu.inc.php";
# 10.03.2009 - само изх.номер за старите дела 
if (isset($_POST["onlyserial"])){
	# чекнат е чекбокса "само вземи изходящ номер" 
	# създаваме нов документ с изх.номер и празно съдържание 
	$aset= $ficonst;
	$aset["iddocutype"]= $_POST["iddocutype"];
	$aset["content"]= "";
			# определяме поредния изходящ номер за текущата година 
/*
			# източник : cazo6.php 
			$myyear= (int) date("Y");
													$DB->query("lock tables docuout write");
			$maxser= $DB->selectCell("select max(serial) from docuout where year=?d" ,$myyear);
	$aset["serial"]= $maxser + 1;
*/
			# източник : cazo6regi.ajax.php 
													$DB->query("lock tables docuout write, user write, office write");
	$aset["serial"]= getnextout();
outnext("cazo6crea",$aset["serial"]);
	$aset["year"]= (int) date("Y");
	# новия запис 
//	$DB->query("insert into $taname set ?a ,created=now()" ,$aset);
			# 23.02.2010 - запомняме и времето на регистрация 
	$DB->query("insert into $taname set ?a ,created=now(), registered=now()" ,$aset);
													$DB->query("unlock tables");
# линк за redirect 
$redilink= "t6link";
# redirect 
$smarty->assign("EXITCODE", getnyroexit($redilink));
}else{
										# заместваме и продължаваме с формата 
										include_once "cazo6creadocu.inc.php";
}
											}

						# за избор на тип документ - четем списъка с типовете 
//						$ardocutype= getselect("docutype","text","1",true);
						# - само активните записи 
//						$ardocutype= getselect("docutype","text","ishidden=0",true);
								$textcode= "if(substring(filename,-5)='.html',text,concat('^^^',text))";
						//$ardocutype= getselect("docutype",$textcode,"ishidden=0",true);
														# 15.03.2017 подреждане 
						$ardocutype= $DB->selectCol("select id as ARRAY_KEY, $textcode from docutype where ishidden=0 order by idsort");
						$ardocutype= array(0=>"") + $ardocutype;
													$ardo2= array();
								foreach($ardocutype as $indx=>$cont){
									if (substr($cont,0,3)=="^^^"){
//										$ardocutype[$indx]= "<font color=blue>".substr($cont,3)."</font>";
//										$ardocutype[$indx]= "<span style='background-color:blue'>".substr($cont,3)."</span>";
										$ardocutype[$indx]= substr($cont,3);
														$ardocutype[$indx]= stripslashes($ardocutype[$indx]);
													$ardo2[$indx]= true;
									}else{
									}
								}
								$smarty->assign("ARDOCUTYPE", tran1251($ardocutype));
													$smarty->assign("ARDOWORD", $ardo2);
						//$ardocutype= dbconv($ardocutype);
						# предаваме името на масива 
						$smarty->assign("ARDOCUTYPENAME", "ardocutype");

# извеждаме 
//print_r($_POST);
//$smarty->assign("FILIST", $filist);
print smdisp($tpname,"iconv");



# проверка за грешки 
function ercheck(){
global $smarty;
	$lister= array();
									# типа на документа 
									if ($_POST["iddocutype"]==0){
										$lister["iddocutype"]= "типа е задължителен";
									}else{
									}
									
									# според дали има грешка 
									if (count($lister)<>0){
	$smarty->assign("LISTER",$lister);
return false;
									}else{
return true;
									}
}


# 27.04.2010 - за документ на Word 
# ANGEL - SMQNA NA NOVI REDOVE S WORD ML TAG
function wordnewline($p1){
	$wordcont= $p1;
	$wordcont= str_replace("\r\n","; ",$wordcont);
	$wordcont= str_replace("\n\r","; ",$wordcont);
	$wordcont= str_replace("\r"  ,"; ",$wordcont);
	$wordcont= str_replace("\n"  ,"; ",$wordcont);
return $wordcont;
}

?>