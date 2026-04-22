<?php
# зона-6 : изходящи документи по делото 
# отгоре : 
#    $edit= case.id 
#    $zone= 6 
#    $func= view, modi 
//print "[$edit][$zone][$func]";
//print_r($GETPARAM);
//print session_name()."=".session_id();


/*****						МАСКИРАНО ЗАРАДИ УСКОРЯВАНЕ 					
# 11.11.2016 от Витанов 
# от групов щаблон формирана серия изх.документи с еднакъв тип 
# след това са изтрити документите, а записа за групата остава и виси в делото без документи при отваряне 
# изтриване на всички такива висящи групови записи в изх.документи за текущото дело $edit 
$argr= $DB->selectCol("
		select id
		from docuout
		where regigroup in (
			select regigroup
			from (
				select regigroup, count(*) as coun
				from docuout
				where idcase=?d and regigroup in (
					select regigroup
					from docuout
					where serial=0 and year=0 and regigroup<>0 and idcase=?d
				)
				group by regigroup
				having coun=1
			) as t2
		)
	"  ,$edit,$edit);
//print_rr($argr);
if (empty($argr)){
}else{
	$codegr= implode(",",$argr);
	$DB->query("delete from docuout where id in ($codegr)");
}
#----------------------------------------------------------------------------------------
*****/

											# 18.08.2014 - връчване 
											if (tabexists("post")){
							$ISPOST= true;
							$smarty->assign("ISPOST", true);
												include_once "deli.inc.php";
											}else{
											}

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

# шаблона 
$tpname= "cazo6.tpl";

# мета имена, които се заместват при регистрация 
//$arregistration= array("(-[IZHODQSHT_NOMER]-)","(-[IZHODQSHT_GODINA]-)");
//# 11.05.2009 - специално за Бургас 
//# добавяме и датата - за Бургас се извежда датата вместо годината 
//$arregistration= array("(-[IZHODQSHT_NOMER]-)","(-[IZHODQSHT_GODINA]-)"  ,"(-[IZHODQSHT_DATA]-)");
# 11.05.2009 - специално за Бургас 
# добавяме и датата - за Бургас се извежда датата вместо годината 
# 14.07.2009 - за Бъзински 
# добавяме и банка-адресат - документа ще се размножи за всяка банка от списък 
//$arregistration= array("(-[IZHODQSHT_NOMER]-)","(-[IZHODQSHT_GODINA]-)"  ,"(-[IZHODQSHT_DATA]-)"  ,"(-[ADRESAT_BANK]-)");
/*
# добавяме и клон-КАТ - документа ще се размножава за всеки избран клон 
$arregistration= array("(-[IZHODQSHT_NOMER]-)","(-[IZHODQSHT_GODINA]-)"  ,"(-[IZHODQSHT_DATA]-)"
	,"(-[ADRESAT_BANK]-)" ,"(-[DB_REGIONKAT_CB]-)" ,"(-[DB_REGIONVPI_CB]-)" ,"(-[DB_REGIONNAP_CB]-)" ,"(-[DB_BANKLIST_CB]-)"
//	,"(-[ADRESAT_BANK]-)" ,"(-[DB_REGIONKAT_CB]-)" ,"(-[DB_REGIONVPI_CB]-)" ,"(-[DB_REGIONNAP_CB]-)"
//# 17.08.2009 - добавяме и избор на длъжници и съпрузите им с чекбоксове 
//	,"(-[DLAJNICI_SAPRUZI]-)"
	);
*/
# мета имена, които се заместват при регистрация 
$arregistration= array(
	"(-[IZHODQSHT_NOMER]-)","(-[IZHODQSHT_GODINA]-)"  ,"(-[IZHODQSHT_DATA]-)"
# 10.11.2009 - ВНИМАНИЕ. 
# следващия елемент трябва да съвпада със стринга $noregist 
# при регистрация не се замества - остава същия 
# виж регистрацията - cazo6regi.ajax.php 
	,"(-[ADRESAT_BANK]-)" 
# 10.11.2009 - ВНИМАНИЕ. 
# следващите елементи трябва да съвпадат с елементите от масива $arregioncb, включително подредбата 
# при регистрация не се заместват - остават същите 
# виж регистрацията - cazo6regi.ajax.php 
	,"(-[DB_REGIONKAT_CB]-)" ,"(-[DB_REGIONVPI_CB]-)" ,"(-[DB_REGIONNAP_CB]-)" ,"(-[DB_BANKLIST_CB]-)"
	);
# да не се замества при регистрация 
$noregist= "(-[ADRESAT_BANK]-)";
/*
	# и още да не се замества при регистрация 
	$noregistkat= "(-[DB_REGIONKAT_CB]-)";
	# и още да не се замества при регистрация 
	$noregistvpi= "(-[DB_REGIONVPI_CB]-)";
	# и още да не се замества при регистрация 
	$noregistnap= "(-[DB_REGIONNAP_CB]-)";
*/
# регулярен израз за стринг - обект с клонове (КАТ, вписвания, НАП) 
# документа ще се размножи за всеки клон от списъка, списъка е от таблица в БД 
$pattmult= '|' .'\(\-\[' .'DB_.+?' .'\]\-\)' .'|';
					# специален управляващ масив за списъци, извеждани чрез избор на чекбоксове 
					# тези маркери не се заместват при регистрация=изходяване 
					# индекс= маркера, значение= брой екземпляри за всеки клон 
					$arregioncb= array();
					$arregioncb["(-[DB_REGIONKAT_CB]-)"]= 2;
					$arregioncb["(-[DB_REGIONVPI_CB]-)"]= 2;
					$arregioncb["(-[DB_REGIONNAP_CB]-)"]= 1;
$arregioncb["(-[DB_BANKLIST_CB]-)"]= 1;

//printarr($_SERVER);
							# отпечатване на избран изх.документ 
							# отнася се само за изведените (регистрираните) 
							# вика се в ajax прозорец 
							$prnt= $GETPARAM["prnt"];
							if (isset($prnt)){
/*											
#------------------------------------------------------------------------------------------------------------
# 14.07.2009 - ЛЕПЕНКА специално за Бъзински 
# размножаване на банки за документа Запорно съобщение за банови сметки = _zb.html 

# съдържанието 
$cont= $DB->selectCell("select content from docuout where id=?d" ,$prnt);
											$markbank= "(-[ADRESAT_BANK]-)";
											$newpage= "<!--NewPage-->";
											//$newpage= '<p style="page-break-before: always;">&nbsp;</p>';
											//$newpage= '<div style="page-break-before: always;">&nbsp;</div>';
											//$newpage= '<span style="page-break-before: always;">&nbsp;</span>';
											if (strpos($cont,$markbank)===false){
//											if (true){
# НОРМАЛНО ПРЕДИ ЛЕПЕНКАТА 
include_once "cazo6prnt.ajax.php";
exit;
											}else{
											}
# край на лепенката 
#-------------------------------------------------------------------------------------
*/

include_once "cazo6prnt.ajax.php";
exit;

							}else{
							}
			# отпечатване група мултиплицирани документи 
# 04.01.2011 важи само за html, не и за xml/word 
			$mult= $GETPARAM["mult"];
			if (isset($mult)){
include_once "cazo6mult.ajax.php";
exit;
			}else{
			}
							# разглеждане на избран изх.документ 
							# отнася се само за изведените (регистрираните) 
							# вика се в ajax прозорец 
							$view= $GETPARAM["view"];
							if (isset($view)){
										include_once "cazo6view.ajax.php";
										exit;
							}else{
							}
							# корекция на избран изх.документ 
							# вика се в ajax прозорец 
							$docu= $GETPARAM["docu"];
							if (isset($docu)){
								if ($docu==0){
									# създаване нов документ 
										include_once "cazo6crea.ajax.php";
										exit;
								}else{
									# корекция на съществуващ документ 
										include_once "cazo6edit.ajax.php";
										exit;
								}
							}else{
							}
						# 28.06.2010 - директно добавяне+извеждане 
						# както в справки - изх.регистър - добави 
							# вика се в ajax прозорец 
							$direadd= $GETPARAM["direadd"];
							if (isset($direadd)){
				$FROMCASE= true;
				$smarty->assign("FROMCASE", true);
									$rocase= getrow("suit",$edit);
//				$smarty->assign("CASESERI", $rocase["serial"]);
//				$smarty->assign("CASEYEAR", $rocase["year"]);
				$_POST["caseseri"]= $rocase["serial"];
				$_POST["caseyear"]= $rocase["year"];
									$editold= $edit;
				$edit= 0;
				$year= (int) date("Y");
										include_once "oureedit.ajax.php";
										exit;
							}else{
							}
							
//------ 24.03.2009 ------ ТОВА Е ВРЕМЕННО СЪДЪРЖАНИЕ С РЪЧЕН ИЗХОДЯЩ НОМЕР----------------------------------
# корекциите обхващат : 
#     cazo6.php 
#     cazo6regi.ajax.php 
#     cazo6regi.ajax.tpl 
# старите НОРМАЛНИ варианти са с префикс "7" 
							# извеждане (регистрация) на избран изх.документ 
							# изх.номер се въвежда ръчно 
							$regi= $GETPARAM["regi"];
							if (isset($regi)){
										include_once "cazo6regi.ajax.php";
return;
							}else{
							}
//------ 24.03.2009 ------ КРАЙ НА ВРЕМЕННОТО СЪДЪРЖАНИЕ С РЪЧЕН ИЗХОДЯЩ НОМЕР----------------------------------
							
							# изтриване на избран изх.документ 
							# - аналогично за извеждане (регистрация) 
							$dele= $GETPARAM["dele"];
							if (isset($dele)){
$edit= $DB->query("delete from docuout where id=?d" ,$dele);
# 10.04.2013 изтрива директно след предупреждение javascript-confirm 
//										include_once "cazo6dele.ajax.php";
print "ok";
										exit;
							}else{
							}
							
#------ 10.08.2009 ------ файл с външен документ - upload, download, delete -----------------------------------
					# upload 
					$uplo= $GETPARAM["uplo"];
					if (isset($uplo)){
include_once "cazo6uplo.ajax.php";
exit;
					}else{
					}
					# download 
					$down= $GETPARAM["down"];
					if (isset($down)){
include_once "cazo6down.ajax.php";
exit;
					}else{
					}
					# delete 
					$defi= $GETPARAM["defi"];
					if (isset($defi)){
include_once "cazo6defi.ajax.php";
exit;
					}else{
					}
					
							#------ 04.08.2010 - смяна на делото [Бургас] ------
							$tocase= $GETPARAM["tocase"];
							if (isset($tocase)){
		include_once "cazo6to.ajax.php";
		exit;
							}else{
							}

							# всичко за сканираните вх.документи 
$smarty->assign("ISINCASE", true);
$isdocuout= true;
$smarty->assign("ISDOCUOUT", true);
							include_once "docuedituplo.inc.php";
							
# специфичен параметър - вътре в делото 
$modeel= "edit=".$edit."&func=".$func."&zone=".$zone;
//$modeel= "mode="."docu"."&page="."1";
$editcasecode= "A";
							# управление на действията по сканирането 
							include_once "docuedituplo2.inc.php";


# четем списъка с документите - само за делото 
//$mylist= $DB->select("select * from docuout where idcase=? order by id desc" ,$edit);
/*
	$query= "select docuout.*, docuout.id as id, docutype.filename as filename, docutype.text as typetext
		from docuout 
		left join docutype on docuout.iddocutype=docutype.id
		where idcase=? order by id desc";
*/
/*
	$query= "select docuout.*, docuout.id as id, docuout.content as content
			, docutype.text as typetext, docutype.type as prnttype
		from docuout 
		left join docutype on docuout.iddocutype=docutype.id
		where idcase=? order by id desc";
*/
		/*
	$query= "select docuout.*, docuout.id as id, docuout.content as content
			, docutype.text as typetext, docutype.type as prnttype, docutype.filename as finame
			, docuoutfile.filename as filename
		from docuout 
		left join docutype on docuout.iddocutype=docutype.id
		left join docuoutfile on docuoutfile.iddocuout=docuout.id
		where idcase=? order by id desc";
		*/
						# 30.04.2010 - вече има размножаване по адресати 
						# всички размножени документи заедно с оригинала имат еднаква група regigroup 
	$query= "select docuout.*, docuout.id as id, docuout.content as content
			, docutype.text as typetext, docutype.type as prnttype, docutype.filename as finame
			, docuoutfile.filename as filename
,user.name as userregi, docuout.iduserregi, docuout.registered
		from docuout 
		left join docutype on docuout.iddocutype=docutype.id
		left join docuoutfile on docuoutfile.iddocuout=docuout.id
left join user on docuout.iduserregi=user.id
		where idcase=? 
		order by docuout.created desc, docuout.id desc";
//			and (docuout.regigroup=0 or docuout.regigroup<>0 and docuout.serial=0)
$mylist= $DB->select($query ,$edit);
$mylist= dbconv($mylist);
//print_r($mylist);
/****
						# 30.04.2010 - вече има размножаване по адресати 
						# мин. и макс. номера за всяка група 
						$q2= "select min(serial) as min, max(serial) as max, year, count(id) as coun, regigroup as ARRAY_KEY
							from docuout
							where idcase=?d and regigroup<>0 and serial<>0
							group by regigroup
							";
						$mygr= $DB->select($q2 ,$edit);
//print_r($mygr);
						//$mygr= dbconv($mygr);
						
						//ANGEL DOBAVENO NA 07.10.2010 - GENERETE WORD COMBINE FILE
						$main_dir_work = getcwd();
						foreach($mygr as $key_angel => $value_angel) {
							unset($k_angel);
							for($i_angel=$value_angel['min'];$i_angel<=$value_angel['max'];$i_angel++) {
								$q_angel = "SELECT * FROM docuout WHERE serial='".$i_angel."' AND year='".$value_angel['year']."'";
								$info_id = $DB->select($q_angel, $edit);
								$k_angel[] = $main_dir_work."/docs/".$info_id[0]['id'].".doc";
							}
							combinedocs($k_angel, $main_dir_work."/outgoing/emptydoc.doc", $main_dir_work."/docs/".$key_angel);
						}

						//END ANGEL DOBAVENO NA 07.10.2010
****/

						# 30.04.2010 - вече има размножаване по адресати 
						# мин. и макс. номера за всяка група 
						$q2= "select min(docuout.serial) as min, max(docuout.serial) as max, docuout.year
						, count(docuout.id) as coun, docuout.regigroup as ARRAY_KEY
			,lower(substring(docutype.filename,-4)) as docusuff
							from docuout
			left join docutype on docuout.iddocutype=docutype.id
							where idcase=?d and regigroup<>0 and serial<>0
							group by regigroup
							";
						$mygr= $DB->select($q2 ,$edit);
////print_rr($mygr);
						//$mygr= dbconv($mygr);
						
/*****************************************************************
						//ANGEL DOBAVENO NA 07.10.2010 - GENERETE WORD COMBINE FILE
						$main_dir_work = getcwd();
						foreach($mygr as $key_angel => $value_angel) {
//			print "<br>".$value_angel["docusuff"];
			if ($value_angel["docusuff"]==".xml"){
							unset($k_angel);
							for($i_angel=$value_angel['min'];$i_angel<=$value_angel['max'];$i_angel++) {
								$q_angel = "SELECT * FROM docuout WHERE serial='".$i_angel."' AND year='".$value_angel['year']."'";
								$info_id = $DB->select($q_angel, $edit);
								$k_angel[] = $main_dir_work."/docs/".$info_id[0]['id'].".doc";
							}
							//++++combinedocs($k_angel, $main_dir_work."/outgoing/emptydoc.doc", $main_dir_work."/docs/".$key_angel);
			}else{
			}
						}

						//END ANGEL DOBAVENO NA 07.10.2010
*****************************************************************/
				$smarty->assign("GRLIST", $mygr);

# основните параметри 
//$modeel= "edit=$edit&zone=$zone&func=modi";
$modeel= "edit=".$edit."&zone=".$zone."&func=".$func;
# add new link 
$addnew= geturl($modeel."&docu=0");

# буквата за редактиране - от основ.данни 
$rooffi= getofficerow($iduser);
$letdoc= $rooffi["letterdocu"];
$smarty->assign("LETDOC", $letdoc);

# трансформираме списъка - параметри за иконите 
//				$modeel= $baseurl;
									$arin= array();
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
	$mylist[$uskey]["docu"]= geturl($modeel."&docu=".$idcurr);
	$mylist[$uskey]["prnt"]= geturl($modeel."&prnt=".$idcurr);
									# 13.11.2009 - извеждане чрез Word doc файл 
	$mylist[$uskey]["prnt"]= geturl($modeel."&prnt=".$idcurr."&word=no");
									$mylist[$uskey]["word"]= geturl($modeel."&prnt=".$idcurr."&word=yes");
	$mylist[$uskey]["view"]= geturl($modeel."&view=".$idcurr);
						# 28.06.2010 - директно добавяне+извеждане 
						$mylist[$uskey]["dire"]= geturl($modeel."&dire=".$idcurr);
	$mylist[$uskey]["regi"]= geturl($modeel."&regi=".$idcurr);
	$mylist[$uskey]["dele"]= geturl($modeel."&dele=".$idcurr);
			# за документ на Word 
				$arelem= explode(".",$uscont["finame"]);
				$filesuff= $arelem[count($arelem)-1];
	$mylist[$uskey]["suff"]= $filesuff;
	# флаг - има ли в шаблона поне един маркер за изходящ номер 
/*
				$fnam= OUTDIR.$uscont["filename"];
				$cont= file_get_contents($fnam);
*/
	if ($filesuff=="html"){
				$cont= $uscont["content"];
//$mylist[$uskey]["exis"]= true;
	}else{
		# ANGEL SOURCE CONTENT FROM WORD FILE 
		$docname = "docs/".$idcurr.".doc";
		if (file_exists($docname)){
			$cont = file_get_contents($docname);
//$mylist[$uskey]["exis"]= true;
$mylist[$uskey]["contword"]= $cont;
		}else{
//$mylist[$uskey]["exis"]= false;
//$mylist[$uskey]["contword"]= "x";
		}
//print "[$idcurr]";
//var_dump($cont);
	}
							$flag= false;
				foreach($arregistration as $reco){
					if (strpos($cont,$reco)!==false){
							$flag= true;
//print "<br>".toutf8($uscont["typetext"])."=".$reco;
//var_dump($flag);
							break;
					}else{
					}
				}
	$mylist[$uskey]["izho"]= $flag;
			# за файл с външен документ 
	$mylist[$uskey]["uplo"]= geturl($modeel."&uplo=".$idcurr);
	$mylist[$uskey]["down"]= geturl($modeel."&down=".$idcurr);
	$mylist[$uskey]["defi"]= geturl($modeel."&defi=".$idcurr);
			# за отпечатване група мултиплицирани документи 
	$mylist[$uskey]["mult"]= geturl($modeel."&mult=".$idcurr);
	# 04.08.2010 - смяна на делото [Бургас] 
	$mylist[$uskey]["tocase"]= geturl($modeel."&tocase=".$idcurr);
							# сканиран образ 
									$arin[]= $idcurr;
	$mylist[$uskey]["scanuplo"]= geturl($modeel."&scanuplo=".$idcurr);
	$mylist[$uskey]["scanview"]= geturl($modeel."&scanview=".$idcurr);
}
							# брой сканирани образи по вх.документи 
											if (empty($arin)){
												$codein= "1";
											}else{
												$codein= implode(",",$arin);
											}
							$arscancoun= getscancoun("iddocu in ($codein)");
//print_rr($arscancoun);
$smarty->assign("ARSCANCOUN", $arscancoun);

# за качване на външен файл без съществуващ документ 
$addnewfile= geturl($modeel."&uplo=0");
						# 28.06.2010 - директно добавяне+извеждане 
						$direadd= geturl($modeel."&direadd=0");
	$smarty->assign("DIREADD", $direadd);

											# 18.08.2014 - връчване 
											if ($ISPOST){
												deliinfo($codein);
/***
			$ardeli= $DB->select("
				select post.iddocuout as ARRAY_KEY1, post.id as ARRAY_KEY2
					, post.*
					, poststat.name as statname
					, if($codepostempty,1,0) as nopostdata
					, if(post.idpoststat=0 or post.idposttype=poststat.idtype,0,1) as isertype
				from post
					left join poststat on post.idpoststat=poststat.id 
				where post.iddocuout in ($codein)
				");
			$ardeli= dbconv($ardeli);
//print_ru($ardeli);
			$smarty->assign("ARDELI", $ardeli);
						$ardelimeth= $DB->selectCol("
							select post.iddocuout as ARRAY_KEY, if(count(distinct post.idposttype)<=1 ,post.idposttype,-1)
							from post
							where post.iddocuout in ($codein)
							group by post.iddocuout
							");
//print_ru($ardelimeth);
						$smarty->assign("ARDELIMETH", $ardelimeth);
						$ardelinoda= $DB->selectCol("
							select post.iddocuout as ARRAY_KEY, if(sum(if($codepostempty,0,1))=0,0,1)
							from post
							where post.iddocuout in ($codein)
							group by post.iddocuout
							");
//print_ru($ardelinoda);
						$smarty->assign("ARDELINODA", $ardelinoda);
***/
											}else{
											}

# извеждаме 
	$smarty->assign("ADDNEWFILE", $addnewfile);
	$smarty->assign("ADDNEW", $addnew);
	$smarty->assign("LIST", $mylist);
$pagecont= smdisp($tpname,"iconv");

?>