<?php
# маркиране като преведен на подмножество от избрания пакет 
# - всички разпределения от пакета, които са за избрана сметка 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $page - текущата страница 
# $acco - избрания пакет = finatranpack.id за 
# още отгоре : 
#    $mark - маркираното подмножество = finatranpack.id = finatran.idfinatranpack 
//print_r($GETPARAM);

# разделяме параметрите на подмножеството 
# $idfinatranpack = finatranpack.id = finatran.idfinatranpack 
list($idfinatranpack,$idclaim2,$iban,$bic)= explode("^",$mark);
$smarty->assign("PACKNO", $idfinatranpack);
$smarty->assign("IBAN", $iban);
$smarty->assign("BIC", $bic);

//# таблицата 
//$taname= "finatran";
# шаблона 
$tpname= "finapackmark.ajax.tpl";
# полетата 
$filist= array();
# константни полета 
$ficonst= array();
# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page."&filt=".$filt);
$relurl= geturl("mode=".$mode."&page=".$page."&acco=".$acco);

									# класа за редактиране 
									include_once "edit.class.php";

#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
									# основен параметър - 
									# $mark - $taname.id - id нза маркиране 
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	//# данните за реда 
	//$rocont= getrow($taname,$mark);
	//$text= $rocont["text"];

#------ submit без формални грешки 
}elseif ($mfacproc=="submyes"){
							$retucode= 0;
				
													# заключваме 
													$DB->query("lock tables finatran write, finance write");
	# маркираме като преведени всички разпределения от пакета, 
	# които са за избраната сметка 
	$DB->query("update finatran set isdone=1 where idfinatranpack=?d and idclaim2=?d and iban=? and bic=?" 
	,$idfinatranpack,$idclaim2,$iban,$bic);
				#-------- реверсивно обновяване ------------------------------------------------------
				# ВАЖНО. 
				# за всички разпределения, които подлежат на маркиране 
				# проверяваме и евентуално маркираме цялото постъпление като приключено 
				$finalist= $DB->selectCol(
					"select idfinance from finatran where idfinatranpack=?d and idclaim2=?d and iban=? and bic=?" 
					,$idfinatranpack,$idclaim2,$iban,$bic);
				foreach($finalist as $idfi){
					$finacoun= $DB->selectCell("select count(*) from finatran where idfinance=?d and isdone=0"  ,$idfi);
					if ($finacoun==0){
						# за постъплението няма непреведени разпределения 
						# - маркираме го автоматично цялото като приключено 
						$DB->query("update finance set isclosed=1, timeclosed=now() where id=?"  ,$idfi);
					}else{
					}
				}
				
				#--------------------------------------------------------------------------------------
													# отключваме 
													$DB->query("unlock tables");

#------ допълнителен бутон 
# отказ 
}elseif ($mfacproc=="submno"){
							$retucode= 0;

#------ submit с формални грешки 
# - невъзможно в случая 
}elseif ($mfacproc==NULL){
//	# стандартна реакция 
							$retucode= 1;
//	doerrors();

#------ автоматичен submit -----------------------------------------------------
# - невъзможно в случая 
}elseif ($mfacproc=="UNKNOWN"){
							$retucode= 2;

#------ невъзможна грешка от библиотеката 
}else{
print "<br>error=mfacproc=";
var_dump($mfacproc);
die();
}

#----------------- край на директното редактиране -----------------------
# резултат 
if ($retucode==0){
	# redirect 
	reload("parent",$relurl);
}else{
				#---- заглавни данни ----
				# собственика на сметката 
					$roclai= getrow("claim2",$idclaim2);
				$smarty->assign("CLAINAME", $roclai["name"]);
	# извеждаме формата 
//	$smarty->assign("EDIT", $mark);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


?>
