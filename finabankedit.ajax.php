<?php
# добавяне на извлечение 
# - само upload на XML файл 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $page - текущата страница от списъка 
#    $edit = 0 
//print_r($GETPARAM);

# шаблона 
$tpname= "finabankedit.ajax.tpl";
# полетата 
$filist= array(
# 31.08.2009 - за банковите извлечения - тип xml формат = банка 
	"xmlsuffix"=> array("validator"=>"notempty", "error"=>"банката е задължително поле")
);
//# константни полета 
//$ficonst= array("idcashpack"=>$edit);
# reload - след успешен събмит 
$relurl= geturl("mode=".$mode."&page=".$page);

# име на полето с файла за upload 
$uploname= "file";
/*
# суфикс на файла 
//$filesuff= ".xml";
$filesuff= array(".xml",".csv",".xls",".txt");
$filesufflen= 4;
*/
# вътр.папка за съхраняване на файловете 
$bankdire= "bankxml/";

									# класа за редактиране 
									include_once "edit.class.php";
#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
//print_rr($_POST);

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;

#------ submit без формални грешки 
# в случая се изпълнява етап-1 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
		# uploaded file - името е "file" 
										# проверяваме за грешки от трансфера 
										include "commuplo.php";
										# връща стринг с грешка или празен, ако няма грешка 
										$ertext= checkupload($uploname);
		if ($ertext==""){
			# проверяваме суфикса 
			$filename= $_FILES[$uploname]["name"];
//			if (substr($filename,-strlen($filesuff))==$filesuff){
//var_dump(substr($filename,-$filesufflen));
//			if (in_array(substr($filename,-$filesufflen),$filesuff)){
$codebank= $_POST["xmlsuffix"];
$mysuff= $listxmlsuff[$codebank];
$mysufflen= strlen($mysuff);
			if (strtolower(substr($filename,-$mysufflen))==$mysuff){
			}else{
//										$ertext= "файла не е .xml";
									//	$ertext= "недопустим тип на файла";
										$ertext= "файла не е от тип ".$mysuff;
			}
		}else{
		}
		if ($ertext==""){
			# няма грешки 
							$retucode= 8;
							# съхраняваме файла 
							$myname= date("Ymd_His_u_").$filename;
//print "[$myname]";
							$savename= $bankdire.$myname;
							$tempname= $_FILES[$uploname]["tmp_name"];
							copy($tempname,$savename);
										# записваме името в сесията 
										# - заради евент.следващ събмит - action 
										$_SESSION["savename"]= $savename;
							#---------------------------------------------------------------
							# получаваме основ.данни и статистиката 
//							include('xml.inc.php');
								# скрипта за обработка на xml - според типа (банката) 
								# заради функцията getxml 
								include('xml'.$_POST["xmlsuffix"].'.inc.php');
							$arcont = getxml($savename,false);
//print_r($arcont);
							#---------------------------------------------------------------
		}else{
			# има грешки 
							$retucode= 1;
$smarty->assign("ERTEXT", $ertext);
		}

#------ СПЕЦИФИЧЕН submit без формални грешки 
# в случая се изпълнява етап-2 
}elseif ($mfacproc=="action"){
							$retucode= 0;
	# ОК 
	# съхраняваме данните за извлечението 
							#---------------------------------------------------------------
										# вземаме името на съхранения файл от сесията 
										$savename= $_SESSION["savename"];
										# унищожаваме го от сесията 
										unset($_SESSION["savename"]);
							# получаваме основ.данни и масива с транзакциите 
//							include('xml.inc.php');
								# скрипта за обработка на xml - според типа (банката) 
								# заради функциите getxml, getfinance 
								include('xml'.$_POST["xmlsuffix"].'.inc.php');
//							$arcont = getxml($savename,true);
													# 20.07.2009 - статус на транзакцията 
													# вземаме масива с транзакциите - всяка има и статус 
							$arcont = getxml($savename,false);
//print "EDIT=====";
//print_r($arcont);
							$artranstat= $arcont["transtat"];
									# създаваме елемент с името на файла 
									$arname= explode("/",$savename);
									$myname= $arname[count($arname)-1];
//print_rr($artranstat);
//print_r($arcont);
	# записваме общите данни за извлечението 
				$aset= $arcont;
				unset($aset["transtat"]);
	# суфикс на банката 
	$codebank= $_POST["xmlsuffix"];
				$aset["codebank"]= $codebank;
//print_r($aset);
	$idbankpack= $DB->query("insert into finabank set ?a, created=now(),filename=?" ,$aset,$myname);
										# 21.04.2010 - автоматично зареждаме делото, ако е възможно 
										# - виж cazo6creadocu.inc.php - function exnu 
										$rooffi= getofficerow(0);
										$mymark= $rooffi['serial']."04";
//var_dump($mymark);
	# добавяме само новите редове от извлечението 
	foreach($artranstat as $arelem){
						$arorig= $arelem;
//print_rr($arorig);
		$arelem= tran1251($arelem);
//print_rr($arelem);
		if ($arelem["status"]==2){
			# добавяме запис за постъпление - в основната таблица finance 
/*
					$fset= array();
					$fset["iduser"]= $_SESSION["iduser"];
						$fset["inco"]= $arelem["AMOUNT_C"]["value"];
					$fset["inco"]= str_replace(",","",$fset["inco"]);
						$fdes= array();
						$fdes[]= $arelem["TR_NAME"]["value"];
						$fdes[]= $arelem["NAME_R"]["value"];
						$fdes[]= $arelem["REM_I"]["value"];
						$fdes[]= $arelem["REM_II"]["value"];
					$fset["descrip"]= implode(" ",$fdes);
//var_dump($fset["descrip"]);
*/
//			$fset= getfinance($arelem);
			$fset= getfinance($arelem  ,$arorig);
					# създател е логнатия юзер 
					$fset["iduser"]= $_SESSION["iduser"];
					# типа е 1=превод 
					$fset["idtype"]= 1;
										# 21.04.2010 - автоматично зареждаме делото, ако е възможно 
										# - виж cazo6creadocu.inc.php - function exnu 
										//$mymark= $rooffi['serial']."04";
//var_dump($mymark);
										$lemark= strlen($mymark);
										$mydesc= $fset["descrip"];
										$myindx= strpos($mydesc,$mymark);
//var_dump($myindx);
										if ($myindx===false){
										}else{
											$myseri= substr($mydesc,$myindx+$lemark,5);
											$myyear= substr($mydesc,$myindx-4,4);
//print "\r\n[$mydesc]\r\n[$myseri][$myyear]";
//print "\r\n[$myseri][$myyear]";
												$ser1= $myseri +0;
												$ser2= str_pad($ser1,5,"0",STR_PAD_LEFT);
//print "\r\n[$ser2][$myseri]";
//print "\r\nbegin";
//var_dump($ser2);
//var_dump($myseri);
											# ВНИМАНИЕ. === макар че и 2та аргумента са стрингове 
											# проблема на == е в евентуално различната дължина 
											if ($ser2===$myseri){
//print "\r\n[$ser2]equalto[$myseri]";
												$myarca= $DB->selectCol("select id from suit where serial=?d and year=?d"  ,$myseri+0,$myyear+0);
												if (empty($myarca)){
												}else{
													$myidcase= $myarca[0];
//print "\r\n[$mydesc]\r\n[$myseri][$myyear]";
//print "idcase=[$myidcase]";
					$fset["idcase"]= $myidcase;
					$fset["isauto"]= 1;
												}
											}else{
											}
										}
#-------------------------------------------------------------
# ВНИМАНИЕ. 16.02.2010 - оправена важна грешка 
# при създаване на нов запис за банково постъпление остатъка [rest] оставаше празен 
# трябва да е равен на цялата постъпила сума [inco] 
$fset["rest"]= number_format($fset["inco"] ,2,".","");
#-------------------------------------------------------------
				# трансформираме 
				$fset= toutf8($fset);
										#=================================================
										# 11.01.2011 попълваме още полета 
										# създаваме записа чак по-долу 
/*
			$idfina= $DB->query("insert into finance set ?a, time=now()"  ,$fset);
							# добавяме записа в архива 
							finaarchive($idfina);
*/
										#=================================================
			# добавяме запис в спомагателната таблица finasource 
//print_r($elem);
			$oset= getfinasource($arelem  ,$arorig);
						# указател към основ.запис - постъплението 1:1 
						$oset["idfinance"]= $idfina;
						# указател към извлечението много:1 
						$oset["idfinabank"]= $idbankpack;
						# сумата 
						$oset["amount"]= $fset["inco"];
# 14.01.2010 - доп.поле timebank - банковото време в MySQL формат 
list($da,$mo,$ye)= explode("/",$oset["date"]);
			# 03.06.2010 - специфично за ЦКБ, Общинска 
			if (strpos($oset["date"],"/")===false){
list($da,$mo,$ye)= explode(".",$oset["date"]);
$da= str_pad($da,2,"0",STR_PAD_LEFT);
$mo= str_pad($mo,2,"0",STR_PAD_LEFT);
			}else{
			}
$oset["timebank"]= "$ye-$mo-$da ".$oset["hour"];
				# трансформираме 
				$oset= toutf8($oset);
//print_r($oset);
			$idfihi= $DB->query("insert into finasource set ?a"  ,$oset);
										#=================================================
										# 11.01.2011 попълваме още полета 
										#-- дата на постъпление 
										$fset["dateinco"]= "$ye-$mo-$da";
										#-- длъжника, ако има назначено дело и единствен длъжник 
										$mycase= $fset["idcase"] +0;
										if ($mycase==0){
										}else{
											$ardebt= $DB->selectCol("select id from debtor where idcase=?d"  ,$mycase);
											if (count($ardebt)==1){
												$fset["iddebtor"]= $ardebt[0];
											}else{
											}
										}
										
			# създаваме записа 
			$idfina= $DB->query("insert into finance set ?a, time=now()"  ,$fset);
										# 13.04.2011 КРЪПКА Дичев времето на създаване 
										$ro5= getrow("finance",$idfina);
										if (isset($ro5["created"])){
			$DB->query("update finance set created=now() where id=?d" ,$idfina);
										}else{
										}
			# добавяме записа в архива 
			finaarchive($idfina);
			# трансформираме новия запис в спомагат.таблица 
			$DB->query("update finasource set idfinance=$idfina where id=$idfihi");
										#=================================================
		}else{
		}
	}
	# съхраняваме всичките редове от извлечението - всеки със статус 
	$sericont= serialize($artranstat);
	$seriname= $savename .".ser";
	file_put_contents($seriname,$sericont);
							#---------------------------------------------------------------

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


//var_dump($retucode,$ertext);
				if ($retucode==0){
# redirect 
reload("parent",$relurl);
				}else{
							# за избор на "тип XML" (банка) - масива $listxmltype - commspec.php 
							# предаваме името, а не съдържанието на масива 
//							$smarty->assign("ARXMLNAME", "listxmltype_utf8");
							# включваме само банките от списъка в основ.данни 
										$rooffi= getofficerow(0);
										$oflist= $rooffi["banklist"];
										$arlist= explode(",",$oflist);
													$arbanklist= array();
										foreach($arlist as $code){
													$arbanklist[$code]= $listxmltype_utf8[$code];
										}
							$smarty->assign("ARXMLNAME", "arbanklist");
# извеждаме 
//$smarty->assign("LIST", $mylist);
//$pagecont= smdisp("capaedit.ajax.tpl","fetch");
//print $pagecont;
$smarty->assign("FILIST", $filist);
$smarty->assign("DATA", $arcont);
$smarty->assign("VARI", $mfacproc);
print smdisp($tpname,"iconv");
				}


?>
