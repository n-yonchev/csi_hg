<?php
# корекция на сметка за избрано разпределение 
# вариант 1 - от взискателя по делото 
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
$tpname= "finapaedit1.ajax.tpl";
/*
# reload - след успешен събмит 
$relurl= geturl("mode=".$mode."&page=".$page."&acco=".$acco);
*/
/*
# полетата 
$filist= array(
//	"iban"=>  array("validator"=>"notempty", "error"=>"полето не може да е празно")
//	,"bic"=>  array("validator"=>"notempty", "error"=>"полето не може да е празно")
	"iban"=>  NULL
	,"bic"=>  NULL
//	,"descrip"=>  array("validator"=>"notempty", "error"=>"полето не може да е празно")
//	,"descrip"=>  NULL
);
*/
# полетата 
$filist= array(
	"idiban"=>  NULL
);
# константни полета 
//$ficonst= array("iduser"=>$iduser);
$ficonst= array();

/***
									# класа за редактиране 
									include_once "edit.class.php";

# редактиране 
$obedit= new edit($taname,$edit,$filist,$ficonst);
# действие 
$reedit= $obedit->action();
//var_dump($reedit);
//print_rr($_POST);

# резултат 
if ($reedit==0){
	# redirect 
	reload("parent",$relurl);
}else{
		# сметка на взискателя от делото 
		$claiba= $roclai["iban"];
		$clabic= $roclai["bic"];
		if (empty($claiba) and empty($clabic)){
			$smarty->assign("CLAACC", "");
		}else{
			$smarty->assign("CLAACC", $claiba."/".$clabic);
		}
		# тип на връзката - според типа на взискателя 
		$claitype= $roclai["idtype"];
		if (0){
		}elseif ($claitype==1){
			$cofiel= "bulstat";
			$cocont= $roclai["bulstat"];
						$cotext= "булстат";
						$cotype= "юрид.лице";
		}elseif ($claitype==2){
			$cofiel= "egn";
			$cocont= $roclai["egn"];
						$cotext= "егн";
						$cotype= "физич.лице";
		}elseif ($claitype==3){
			$cofiel= "name";
						$cotext= "име";
						$cotype= "друг тип";
						# четем името с премахване на кавичките 
						# източник : _claim2.php 
			# премахваме всички видове кавички - още при четенето с MySQL, в PHP не става 
			#  132=„  147=“  148=”  - виж резултата от _abet.php 
			$ups0= "replace(  replace(  replace(trim(name),char(132 using cp1251),'')  ,char(147 using cp1251),'')  ,char(148 using cp1251),'')";
			$ups1= "replace(  replace(  replace($ups0,'\\\"','')  ,'\\\\','')  ,\"\'\",'')";
						$cocont= $DB->selectCell("select $ups1 as name from claimer where id=?d"  ,$idclaimer);
//var_dump($cocont);
//						$cocont= dbconv($cocont);
//var_dump($cocont);
		}else{
die("fipaac=type=$claitype");
		}
		$smarty->assign("COTEXT", $cotext);
		$smarty->assign("COTYPE", $cotype);
		$smarty->assign("COCONT", tran1251($cocont));
		# връзка със собственици на сметки и сметките им 
		$aclist= $DB->select("
			select claim2iban.*, claim2iban.id as id, claim2.name as c2name
			from claim2iban
			left join claim2 on claim2iban.idclaim2=claim2.id
			where $cofiel=?
			"  ,$cocont);
		$aclist= dbconv($aclist);
		$smarty->assign("ACLIST", $aclist);
//print_rr($aclist);
	# извеждаме формата 
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
//	print smdisp($tpname,"iconv");
$formcont= smdisp($tpname,"fetch");
//print "<pre>";
//print $formcont;
//print "</pre>";

}
***/

									# класа за редактиране 
									include_once "edit.class.php";
#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
//var_dump($mfacproc);

									# основен входен параметър - 
									# $edit - $taname.id  

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	$_POST[idiban]= 0;
/*
	if ($edit==0){
							#---- полета с автоматично съдържание 
	}else{
		$rocont= $DB->selectRow("select * from $taname where id=?" ,$edit);
		foreach($filist as $finame=>$ficont){
			if ($ficont["inactive"]){
			}else{
				$_POST[$finame]= $rocont[$finame];
			}
		}
							#---- полета с автоматично съдържание 
	}
*/

//#------ submit без формални грешки 
//}elseif ($mfacproc=="submit"){
#------ submit без формални грешки или автоматично 
}elseif ($mfacproc=="submit" or $mfacproc=="UNKNOWN"){
							$retucode= 0;
/*
											# проверяваме за допълнителни грешки 
											$lister= array();

											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
												#---- няма ---- 
							$retucode= 0;
		$aset= $ficonst;
		foreach($filist as $finame=>$ficont){
			if ($ficont["inactive"]){
			}else{
				$aset[$finame]= $_POST[$finame];
			}
		}
	if ($edit==0){
							#---- полета с автоматично съдържание 
		# нов запис 
		$edit= $DB->query("insert into $taname set ?a" ,$aset);
	}else{
							#---- полета с автоматично съдържание 
		# корекция на записа 
		$DB->query("update $taname set ?a where id=?d" ,$aset,$edit);
	}
											# край - според дали има грешка 
											}
*/
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

#------ submit с формални грешки 
}elseif ($mfacproc==NULL){
//							$retucode= 1;
//	doerrors();
							# в този случай - не е избран вариант 
							# все едно - reload 
							$retucode= 0;

//#------ автоматичен submit -----------------------------------------------------
//}elseif ($mfacproc=="UNKNOWN"){
//							$retucode= 2;

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
/**/
		# сметка на взискателя от делото 
		$claiba= $roclai["iban"];
		$clabic= $roclai["bic"];
		# тип на връзката - според типа на взискателя 
		$claitype= $roclai["idtype"];
		if (0){
		}elseif ($claitype==1){
			$cofiel= "bulstat";
			$cocont= $roclai["bulstat"];
						$cotext= "булстат";
						$cotype= "юрид.лице";
		}elseif ($claitype==2){
			$cofiel= "egn";
			$cocont= $roclai["egn"];
						$cotext= "егн";
						$cotype= "физич.лице";
		}elseif ($claitype==3){
			$cofiel= "name";
						$cotext= "име";
//						$cotype= "друг тип";
						$cotype= "друг";
						# четем името с премахване на кавичките 
						# източник : _claim2.php 
			# премахваме всички видове кавички - още при четенето с MySQL, в PHP не става 
			#  132=„  147=“  148=”  - виж резултата от _abet.php 
			$ups0= "replace(  replace(  replace(trim(name),char(132 using cp1251),'')  ,char(147 using cp1251),'')  ,char(148 using cp1251),'')";
			$ups1= "replace(  replace(  replace($ups0,'\\\"','')  ,'\\\\','')  ,\"\'\",'')";
						$cocont= $DB->selectCell("select $ups1 as name from claimer where id=?d"  ,$idclaimer);
//var_dump($cocont);
//						$cocont= dbconv($cocont);
//var_dump($cocont);
		}else{
/////////die("fipaac=type=$claitype");
# за псевдо взискателите 
$cofiel= "name";
		}
		$smarty->assign("COTEXT", $cotext);
		$smarty->assign("COTYPE", $cotype);
		$smarty->assign("COCONT", tran1251($cocont));
		# връзка със собственици на сметки и сметките им 
		$aclist= $DB->select("
			select claim2iban.*, claim2iban.id as id, claim2.name as c2name
			from claim2iban
			left join claim2 on claim2iban.idclaim2=claim2.id
			where $cofiel=?
			"  ,$cocont);
		$aclist= dbconv($aclist);
//		$smarty->assign("ACLIST", $aclist);
		# добавяме и сметката на взискателя 
					$cele= array();
					$cele["id"]= -1;
					$cele["iban"]= $claiba;
					$cele["bic"]= $clabic;
		array_unshift($aclist,$cele);
		# коя сметка е чекната 
		foreach($aclist as $indx=>$elem){
			$flag= ($elem["iban"]==$rotran["iban"] and $elem["bic"]==$rotran["bic"]);
			$aclist[$indx]["flag"]= $flag;
		}
		$smarty->assign("ACLIST", $aclist);
//print_rr($aclist);
//print_rr($aclist);
/**/
	# извеждаме формата 
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
//	print smdisp($tpname,"iconv");
$formcont= smdisp($tpname,"fetch");
}


?>