<?php
# корекци€ на сметка за избрано разпределение - управление на режимите 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущи€ режим 
#    $page - текущата страница от списъка пакети 
#    $acco = finapack.id за избрани€ пакет 
# $edit = finatran.id за избраното разпределение 
//print "correction [$mode][$edit]";
//print_rr($GETPARAM);

# режими 
	$modetext= array();
	$modetext[1]= "от взискател€ по делото";	$modein[1]= "finapaedit1.ajax.php";
	$modetext[2]= "от други собственици";		$modein[2]= "finapaedit2.ajax.php";
	$modetext[3]= "нова сметка/собственик";		$modein[3]= "finapaedit3.ajax.php";
$smarty->assign("MODETEXT", $modetext);
# $vari - маневрен параметър за тек.режим 
$vari= $GETPARAM["vari"];
if (isset($vari)){
}else{
	$vari= 1;
}
$smarty->assign("VARI", $vari);
# линкове за режимите 
	$balink= "mode=".$mode ."&page=".$page ."&acco=".$acco ."&edit=".$edit;
	$modelink= array();
foreach($modetext as $indx=>$x2){
	$modelink[$indx]= geturl($balink."&vari=".$indx);
}
$smarty->assign("MODELINK", $modelink);
//print_rr($modelink);

# таблицата 
$taname= "finatran";
//# шаблона 
//$tpname= "finapackaccoedit.ajax.tpl";
# reload - след успешен събмит 
$relurl= geturl("mode=".$mode."&page=".$page."&acco=".$acco);
				
				#---- заглавни данни ----
				# данни за разпределението 
					$rotran= getrow($taname,$edit);
//				$smarty->assign("SUMA", $rotran["amount"]);
				$smarty->assign("ROTRAN", $rotran);
					# взискател€ 
					$roclai= getrow("claimer",$rotran["idclaimer"]);
//print_rr($roclai);
												$idclaimer= $rotran["idclaimer"];
															include_once "fina.inc.php";
							# псевдо взискатели 
							if ($idclaimer<0){
				$smarty->assign("CLAINAME", $pseuclainame[$idclaimer]);
							}else{
				$smarty->assign("CLAINAME", $roclai["name"]);
							}
					# делото 
					$rofina= getrow("finance",$rotran["idfinance"]);
					$rocase= getrow("suit",$rofina["idcase"]);
				$smarty->assign("SUIT", $rocase["serial"]."/".$rocase["year"]);
					# деловодител€
					$rouser= getrow("user",$rocase["iduser"]);
				$smarty->assign("USERNAME", $rouser["name"]);

//var_dump($vari);
				include_once($modein[$vari]);

$smarty->assign("FORMCONT", $formcont);
print smdisp("finapackaccoedit.ajax.tpl","iconv");



/*****
# полетата 
$filist= array(
//	"iban"=>  array("validator"=>"notempty", "error"=>"полето не може да е празно")
//	,"bic"=>  array("validator"=>"notempty", "error"=>"полето не може да е празно")
	"iban"=>  NULL
	,"bic"=>  NULL
//	,"descrip"=>  array("validator"=>"notempty", "error"=>"полето не може да е празно")
//	,"descrip"=>  NULL
);
# константни полета 
//$ficonst= array("iduser"=>$iduser);
$ficonst= array();

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
				# данни за разпределението 
					$rotran= getrow($taname,$edit);
				$smarty->assign("SUMA", $rotran["amount"]);
					# взискател€ 
					$roclai= getrow("claimer",$rotran["idclaimer"]);
//print_rr($roclai);
												$idclaimer= $rotran["idclaimer"];
				$smarty->assign("CLAINAME", $roclai["name"]);
					# делото 
					$rofina= getrow("finance",$rotran["idfinance"]);
					$rocase= getrow("suit",$rofina["idcase"]);
				$smarty->assign("SUIT", $rocase["serial"]."/".$rocase["year"]);
					# деловодител€
					$rouser= getrow("user",$rocase["iduser"]);
				$smarty->assign("USERNAME", $rouser["name"]);
	
		# сметка на взискател€ от делото 
		$claiba= $roclai["iban"];
		$clabic= $roclai["bic"];
		if (empty($claiba) and empty($clabic)){
			$smarty->assign("CLAACC", "");
		}else{
			$smarty->assign("CLAACC", $claiba."/".$clabic);
		}
		# тип на връзката - според типа на взискател€ 
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
			#  132=Д  147=У  148=Ф  - виж резултата от _abet.php 
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
	print smdisp($tpname,"iconv");
}
*****/


?>