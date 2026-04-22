<?php
# зона-6 : отпечатване съдържанието на съществуващ изходящ документ по делото 
# в шаблона няма форма, няма бутон submit, нито за затваряне 
# източник : cazo6view.ajax.php - разглеждане 
# отгоре : 
#    $edit= case.id 
#    $zone= 6 
#    $func= view 
#  $prnt= документа за отпечатване 

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

				# четем данните за изх.документ 
				$rodocu= getrow("docuout",$prnt);
				//$docont= $rodocu["content"];
				//$docont= toutf8($docont);
				//# 27.04.2010 - ако документа е на Word 
				//# ANGEL REPLACE IN WORD FILE 
				$rodoty= getrow("docutype", $rodocu["iddocutype"]);
				//$arelem= explode(".",$rodoty["filename"]);
				//$filesuff= $arelem[count($arelem)-1];
										# 23.06.2010 - флаг - при изходяване на документ 
										# автоматично да се добавя таксата като предмет на изпълнение 
										# източник : cazo6regi.ajax.php 
										$rooffi= getofficerow(0);
										$regita= $rooffi["isregitax"];
										$isregitax= ($regita<>0);
									$smarty->assign("ISREGITAX", $isregitax);
										# и данните за предмета на изпълнение 
								//		$rot2= toutf8($rodoty);
								//		$exem= toutf8("екз.");
										$rot2= $rodoty;
										$exem= "екз.";
										$postregitext= $rot2["regitext"]." COPIES ".$exem." ".$rot2["text"];
									$smarty->assign("TEMPTEXT", $postregitext);
									$smarty->assign("TEMPMARK", "COPIES");
										$postregitax= $rot2["regitax"];
										if ($postregitax +0==0){
											$flagwilladd= false;
									$smarty->assign("NOADDSUB", true);
										}else{
											$flagwilladd= true;
										}

# таблицата 
$taname= "docuout";
# шаблона 
$tpname= "cazo6prnt.ajax.tpl";
//# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page."&bapaelem=".$bapaelem."&pageelem=".$pageelem);

# съдържанието 
//$cont= $DB->selectCell("select content from $taname where id=?d" ,$prnt);
			# 20.01.2010 ВНИМАНИЕ. ЛЕПЕНКА. 
			# Бл.град Дервиш - Запорно съобщение до банки - при генериране има чекнати банки 
			# - в доп.поле "extra" е списъка с id 
			# Ще извеждаме документ само по този списък. 
$arcont= $DB->selectRow("select content, extra from $taname where id=?d" ,$prnt);
$cont= $arcont["content"];
$extra= $arcont["extra"];

#------------------------------------------------------------------------------------------------------------
# 14.07.2009 - ЛЕПЕНКА специално за Бъзински 
# размножаване на банки за документа Запорно съобщение за банкови сметки = _zb.html 

//											$markbank= "(-[ADRESAT_BANK]-)";
											$markbank= $noregist;
											$newpage= "<!--NewPage-->";
											//$newpage= '<p style="page-break-before: always;">&nbsp;</p>';
											//$newpage= '<div style="page-break-before: always;">&nbsp;</div>';
											//$newpage= '<span style="page-break-before: always;">&nbsp;</span>';
									# 13.11 2009 - чрез Word [doc] 
									if ($GETPARAM["word"]=="yes"){
											$newpage= '<div style="page-break-before: always;">&nbsp;</div>';
//print "changed=<xmp>$newpage</xmp>";
									}else{
									}
											if (strpos($cont,$markbank)===false){
//											if (true){
											}else{

# колко банки на един пас 
$partlimi= 15;
# основните параметри 
$modeel= "edit=".$edit."&zone=".$zone."&func=".$func."&prnt=".$prnt;
# линкове за частите 
			$bankcoun= $DB->selectCell("select count(*) from banklist");
			$partcoun= ceil($bankcoun/$partlimi);
	$arlink= array();
for ($i=1; $i<=$partcoun; $i++){
	$arlink[$i]= geturl($modeel."&part=".$i);
}
$smarty->assign("ARLINK", $arlink);
			
			# според избраната част 
			$part= $GETPARAM["part"];
			if (isset($part)){
//$part= $part +0;
//var_dump($part);
$partbegi= ($part-1)*$partlimi;
//var_dump($partbegi);
$BANKLIMI= "limit $partbegi,$partlimi";
# продължава 
			}else{
print smdisp($tpname,"iconv");
exit;
			}

		# размножаваме за всяка банка 
		# получаваме ново съдържание в $cont 
		include "cazo6bank.php";
											}
# край на лепенката 
#-------------------------------------------------------------------------------------
								
								#---------------------------------------------------------------------------------
								# 06.08.2009 
								# обработка на обект с клонове (КАТ, вписвания, НАП) 
								# - документа ще се размножава за всеки избран клон 
								# има ли маркер за такъв обект 
								$foundmult= preg_match_all($pattmult, $cont, $matchesmult);
//								if (strpos($cont,$noregistkat)===false){
//var_dump($matchesmult);
								if (empty($matchesmult[0])){
									# няма маркер 
								}else{
									# има маркер за обект с клонове - винаги маркера е само един 
									$branstri= $matchesmult[0][0];
									$brans2= $branstri;
									$brans2= str_replace("(-[","",$brans2);
									$brans2= str_replace("]-)","",$brans2);
//var_dump($brans2);
									# разбиваме стринга 
									list($par1,$tablname,$par3)= explode("_",$brans2);
									# заради case sensitivity in Linux 
									$tablname= strtolower($tablname);
									# проверяваме 
									if ($par1=="DB"){
									}else{
die("6prnt=1");
									}
									if ($par3=="CB"){
									}else{
die("6prnt=3");
									}
																		# 28.04.2010 - 
																		# в изх.документ с много адресати - отделен номер за всеки адресат 
																		include_once "cazo6bran.inc.php";
									# преди или след submit 
									$branlist= $_POST["branlist"];
									if (isset($branlist)){
										# след submit 
										# - опрелеляме броя на екземплярите за всеки клон 
										$councopy= $arregioncb[$branstri];
										$councopy= ($councopy==0) ? 1 : $councopy;
										$coun2= $councopy -1;
# - размножаваме документа за всеки избран клон 
//print_r($branlist);
			$newcont= "";
	$isfirst= true;;
foreach($branlist as $branid){
//	$robran= getrow($tablname,$branid);
	$robran= $DB->selectRow("select name from $tablname where id=?d"  ,$branid);
	$branname= $robran["name"];
//	$branname= toutf8($branname);
//var_dump($branname);
	$docu2= str_replace($branstri, $branname, $cont);
	if ($isfirst){
		$isfirst= false;
	}else{
			$newcont .= $newpage;
	}
			$newcont .= $docu2;
										# допълнителните екземпляри 
										for ($i=1; $i<=$coun2; $i++){
			$newcont .= ($newpage .$docu2);
										}
}
$cont= $newcont;
# премахваме всички тагове <html> и </html> 
# много важно, иначе излиза само 1-вата страница 
$cont= str_replace("<html>","",$cont);
$cont= str_replace("</html>","",$cont);
//print "<xmp>$cont</xmp>";
# продължаваме с формирането на PDF 
									
										
										# 23.06.2010 - флаг - при изходяване на документ 
										# автоматично да се добавя таксата като предмет на изпълнение 
										if ($isregitax and $flagwilladd){
													include_once "cazo6tax.inc.php";
											insertsubject($prnt);
										}else{
										}

									}else{
										# преди submit - подготвяме масива с клоновете 
										
												# 23.06.2010 - флаг - при изходяване на документ 
												# автоматично да се добавя таксата като предмет на изпълнение
												if ($isregitax){
	$_POST["regitext"]= str_replace("COPIES","1", toutf8($postregitext));
	$_POST["regitax"]= $postregitax;
												}else{
												}
																		# 28.04.2010 - 
																		# в изх.документ с много адресати - отделен номер за всеки адресат 
																		$arbran= getbranlist($tablname,$extra);
$smarty->assign("ARBRAN", $arbran);
# колко записа в една колона 
$smarty->assign("COUNTPERCOL", 20);
										# - извеждаме формата 
print smdisp($tpname,"iconv");
exit;
									}
								}
//exit;
								#---------------------------------------------------------------------------------

# записваме съдържанието във временен файл 
$fnam= md5(microtime());
$fnam= "cache/".$fnam;
//print $cont;
//file_put_contents($fnam, stripslashes($cont));
		# подготвяме съдържанието 
		$cont= stripslashes($cont);
		# абсолютен адрес на логото <img= src="http://......"> 
		$cont= logotran($cont);
# записваме файла 
file_put_contents($fnam, $cont);
//file_put_contents($fnam, toutf8($cont));

# формираме футера 
$rooffi= getofficerow(1);
//$footer= "<div style='text-align: left;'><font face='Times New Roman' style='font-size: 8pt;'><i>АДРЕС НА КАНТОРАТА " .$rooffi["address"] ." <br /> тел.: 056/82 00 80</i></font></div>";
$footer= "<div style='text-align: center;'><font face='Times New Roman' style='font-size: 10pt;'>АДРЕС НА КАНТОРАТА " 
	.$rooffi["address"] ."</font></div>";
$footer= toutf8($footer);
$footer= stripslashes($footer);
$smarty->assign("FOOTER", urlencode($footer));

# извеждаме страницата за трансформиране в PDF 
//$smarty->assign("URLPAR", urlencode("b3/$fnam"));
		# определяме префикса за абсолютния път - заради локалната поддир. /b3 
		$snam= $_SERVER["SCRIPT_NAME"];
		$anam= explode("/",$snam);
		unset($anam[count($anam)-1]);
		unset($anam[0]);
		$anam[]= $fnam;
		$namresult= implode("/",$anam);
//print $namresult;

//var_dump($GETPARAM["word"]);
				if ($GETPARAM["word"]=="yes"){
#--------------------------------------------------------------------
# 13.11.2009 - този код е за Word трансформация 
			$smarty->assign("WORDTRAN", true);
$smarty->assign("URLPAR", urlencode($fnam));
print smdisp($tpname,"iconv");
#--------------------------------------------------------------------

				}else{

#--------------------------------------------------------------------
# 13.11.2009 - този код е за PDF трансформация чрез http2ps 
$smarty->assign("URLPAR", urlencode($namresult));
print smdisp($tpname,"iconv");
#--------------------------------------------------------------------

				# if ($GETPARAM["word"=="yes"]){
				}

//print "<h2>$prnt</h2>";


?>
