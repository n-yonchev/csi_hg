<?php
# корекция на сметка за избрано разпределение 
# вариант 2 - от произволен собственик 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $page - текущата страница от списъка пакети 
#    $acco = finapack.id за избрания пакет 
# $edit = finatran.id за избраното разпределение 
//print "correction [$mode][$edit]";
//print_r($GETPARAM);

# таблицата 
$taname= "finatran";
# шаблона 
$tpname= "finapaedit2.ajax.tpl";
/*
# reload - след успешен събмит 
$relurl= geturl("mode=".$mode."&page=".$page."&acco=".$acco);
*/
# полетата 
$filist= array(
	"filtname"=>  NULL
	,"idiban"=>  NULL
);
# константни полета 
//$ficonst= array("iduser"=>$iduser);
$ficonst= array();

									# класа за редактиране 
									include_once "edit.class.php";
#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
//var_dump($mfacproc);
//print_rr($_POST);

									# основен входен параметър - 
									# $edit - $taname.id  

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	$_POST[idiban]= 0;

//#------ submit без формални грешки 
//}elseif ($mfacproc=="submit"){
#------ submit без формални грешки или автоматично 
# странно : $mfacproc==NULL след клик на бутона submit 
}elseif ($mfacproc=="submit" or $mfacproc=="UNKNOWN" or $mfacproc==NULL){
/**********
	if (isset($_POST["submit"])){
		# въведена нова сметка за собственик 
							$retucode= 0;
		$idclaim2= $_POST["idclaim2"];
		$iban= $_POST["iban"];
			$iban= trim($iban);
		$bic= $_POST["bic"];
		$descrip= $_POST["descrip"];
		# проверка за празен и дублиран iban 
		if (empty($iban)){
							$retucode= 2;
			$smarty->assign("IBANER", "iban не може да е празен");
		}else{
			$ibancoun= $DB->selectCell("select count(*) from claim2iban where iban=?"  ,$iban);
			if ($ibancoun==0){
						# новата сметка е ОК - записваме данните 
							$aset= array();
							$aset["idclaim2"]= $idclaim2;
							$aset["iban"]= $iban;
							$aset["bic"]= $bic;
							$aset["descrip"]= $descrip;
						$DB->query("insert into claim2iban set ?a"  ,$aset);
						# определяме новата сметка за превод на избраното разпределение 
							$aset= array();
							$aset["idclaim2"]= $idclaim2;
							$aset["iban"]= $iban;
							$aset["bic"]= $bic;
						$DB->query("update finatran set ?a where id=?d"  ,$aset,$edit);
			}else{
							$retucode= 2;
				$smarty->assign("IBANER", "този iban вече съществува");
			}
		}
	}else{
		# НЯМА въведена нова сметка за собственик 
		if (isset($_POST["idiban"])){
			# автоматичен събмит на сметка 
							$retucode= 0;
				# записваме сметката на разпределението 
				$idiban= $_POST["idiban"] +0;
				if ($idiban==0){
					# не е избрана сметка 
				}else{
					# избрана е сметка на собственик 
					$rotran= getrow("claim2iban",$idiban);
							$aset= array();
							$aset["iban"]= $rotran["iban"];
							$aset["bic"]= $rotran["bic"];
							$aset["idclaim2"]= $rotran["idclaim2"];
					$DB->query("update $taname set ?a where id=?d"  ,$aset,$edit);
				}
		}else{
			# автоматичен събмит на името 
							$retucode= 2;
							# в този случай - filtname +enter 
		}
	# КРАЙ въведена нова сметка за собственик 
	}
**********/

		if (isset($_POST["idiban"])){
			# автоматичен събмит на сметка 
							$retucode= 0;
				#-----------------------------------------------------
				# записваме сметката на разпределението 
				$idiban= $_POST["idiban"] +0;
				if ($idiban==0){
					# не е избрана сметка 
				}else{
					# избрана е сметка на собственик 
					$rotran= getrow("claim2iban",$idiban);
							$aset= array();
							$aset["iban"]= $rotran["iban"];
							$aset["bic"]= $rotran["bic"];
							$aset["idclaim2"]= $rotran["idclaim2"];
					$DB->query("update $taname set ?a where id=?d"  ,$aset,$edit);
				}
				#-----------------------------------------------------
		}else{
			# НЯМА автоматичен събмит на сметка 
			if (isset($_POST["submit"])){
				# въведена нова сметка за собственик 
							$retucode= 0;
				#-----------------------------------------------------
				$idclaim2= $_POST["idclaim2"];
				$iban= $_POST["iban"];
					$iban= trim($iban);
				$bic= $_POST["bic"];
				$descrip= $_POST["descrip"];
				# проверка за празен и дублиран iban 
				if (empty($iban)){
							$retucode= 2;
					$smarty->assign("IBANER", "iban не може да е празен");
				}else{
					$ibancoun= $DB->selectCell("select count(*) from claim2iban where iban=?"  ,$iban);
					if ($ibancoun==0){
						# новата сметка е ОК - записваме данните 
							$aset= array();
							$aset["idclaim2"]= $idclaim2;
							$aset["iban"]= $iban;
							$aset["bic"]= $bic;
							$aset["descrip"]= $descrip;
						$DB->query("insert into claim2iban set ?a"  ,$aset);
						# определяме новата сметка за превод на избраното разпределение 
							$aset= array();
							$aset["idclaim2"]= $idclaim2;
							$aset["iban"]= $iban;
							$aset["bic"]= $bic;
						$DB->query("update finatran set ?a where id=?d"  ,$aset,$edit);
					}else{
							$retucode= 2;
						$smarty->assign("IBANER", "този iban вече съществува");
					}
				}
				#-----------------------------------------------------
			}else{
				# автоматичен събмит на името 
							$retucode= 2;
							# в този случай - filtname +enter 
			}
		}


//#------ submit с формални грешки 
//}elseif ($mfacproc==NULL){
//							$retucode= 1;
//	doerrors();
							//# в този случай - не е избран вариант 
							//# все едно - reload 
							//$retucode= 0;

//#------ автоматичен submit -----------------------------------------------------
//}elseif ($mfacproc=="UNKNOWN"){
//							$retucode= 2;
//							# в този случай - filtname +enter 

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
//print_rr($_POST);
	reload("parent",$relurl);
}else{
	# извеждаме формата 
			$filtname= $_POST["filtname"];
			if (empty($filtname)){
			}else{
									$word= $_POST["filtname"];
									$flagcoun= false;
								include_once "finapaauto.inc.php";
									# получихме $mylist
//print_rr($mylist);
									$c2list= array();
						# формираме списък на собствениците - за select/option 
						foreach($mylist as $elem){
							$c2id= $elem["c2id"];
									$c2list[$c2id]= $elem["c2name"];
						}
//print_rr(toutf8($c2list));
									$c2list= toutf8($c2list);
						$smarty->assign("C2LIST", "c2list");
	$smarty->assign("POSTNAME", tran1251($filtname));
	$smarty->assign("ACLIST", $mylist);
			}
	
	# извеждаме формата 
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
//	print smdisp($tpname,"iconv");
$formcont= smdisp($tpname,"fetch");
}

/*
				# записваме сметката на разпределението 
				$idiban= $_POST["idiban"] +0;
				if ($idiban==0){
					# не е избрана сметка 
				}elseif ($idiban== -1){
					# избрана е сметката на взискателя от делото 
					$rotran= getrow($taname,$edit);
					$roclai= getrow("claimer",$rotran["idclaimer"]);
							$aset= array();
							$aset["iban"]= $roclai["iban"];
							$aset["bic"]= $roclai["bic"];
							$aset["idclaim2"]= 0;
					$DB->query("update $taname set ?a where id=?d"  ,$aset,$edit);
				}else{
					# избрана е сметка на собственик с идентификация на взискателя 
					$rotran= getrow("claim2iban",$idiban);
							$aset= array();
							$aset["iban"]= $rotran["iban"];
							$aset["bic"]= $rotran["bic"];
							$aset["idclaim2"]= $rotran["idclaim2"];
					$DB->query("update $taname set ?a where id=?d"  ,$aset,$edit);
				}
*/

?>