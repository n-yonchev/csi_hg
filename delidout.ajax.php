<?php
# изх.документи за връчване 
# създаване нов изходящ документ за група маркирани документи 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $vari - вторично меню 
#    $page - текущата страница 
# параметри : 
#    $delidout=0 
# още отгоре : 
#    $modeel - базов стринг за линкове 
#    $relurl - линк за рефреш след приключване 
#    $taname, $tana - таблицата за външните = deliexte 
# маркирани : 
#    $aridpost - масив с документи deliexte.id 

# ВНИМАНИЕ 
# действие : 
#    създаваме нов запис в табл.docuout 
#    за всички маркирани записи от табл.deliexte корегираме указателя iddout към новия запис в docuout 
//print_r($GETPARAM);
//print_rr($aridpost);
//$co2= $DB->selectCell("select count(*) from deliexte");
//var_dump($co2);
//print "<h2>$co2</h2>";


//# таблицата 
//$taname= "post";
# шаблона 
$tpname= "delidout.ajax.tpl";
# полетата 
$filist= array(
/*
	"idpostuser"=> NULL
	,"date1"=>  array("validator"=>"bgdate_valid", "transformer"=>"getputbgdate")
	,"date2"=>  array("validator"=>"bgdate_valid", "transformer"=>"getputbgdate")
	,"date3"=>  array("validator"=>"bgdate_valid", "transformer"=>"getputbgdate")
	,"idpoststat"=> NULL
*/
	"descrip"=>  array("validator"=>"notempty", "error"=>"описанието е задължително")
	,"adresat"=>  array("validator"=>"notempty", "error"=>"адресата е задължителен")
	,"notes"=> NULL
);
# константни полета 
//$ficonst= array("iduser"=>$iduser);
$ficonst= array();
# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page);
//$relurl= geturl("mode=".$mode);

/*****/
									# класа за редактиране 
									include_once "edit.class.php";
# редактиране 
//$obedit= new edit($taname,$edit,$filist,$ficonst);
//$obedit= new edit($taname,0,$filist,$ficonst);
$obedit= new edit("docuout",0,$filist,$ficonst);
$obedit->funcinit= "funcinit";
# действие 
$reedit= $obedit->action();
//var_dump($reedit);

# резултат 
if ($reedit==0){
/******/
//if (isset($_POST["submit"])){
//print "<br>===before===";
//$co2= $DB->selectCell("select count(*) from deliexte");
//print "<h2>$co2</h2>";
				/*
				# формираме масива с данните 
				$aset= array();
				foreach($filist as $finame=>$x2){
					$pocont= $_POST[$finame];
					if (empty($pocont)){
					}else{
						if (substr($finame,0,4)=="date"){
							$pocont= bgdateto($pocont);
						}else{
						}
						$aset[$finame]= $pocont;
					}
				}
				*/
							$DB->query("lock tables docuout write, $taname write");
		# корегираме новия изх.документ 
			$aset= array();
		$aset["serial"]= getnextout();
		$aset["year"]= (int) date("Y");
		$aset["iduserregi"]= $_SESSION["iduser"];
		$aset["isentered"]= 2;
			$iddout= $obedit->paid;
		$DB->query("update docuout set ?a, created=now(), registered=now() where id=?d"  ,$aset,$iddout);
		# корегираме маркираните записи 
		foreach($aridpost as $idpost){
//print "<br>idpost=[$idpost]";
			$DB->query("update $taname set iddout=$iddout where id=?d"  ,$idpost);
		}
							$DB->query("unlock tables");
//$co2= $DB->selectCell("select count(*) from deliexte");
//print "<h2>$co2</h2>";
	# redirect 
	reload("parent",$relurl);
}else{
						/*
							# за избор на призовкар 
							$aruserpost= getselect("postuser","name","1",true);
							//$aruserpost= dbconv($aruserpost);
						$smarty->assign("ARUSERPOST", "aruserpost");
							# за избор на статус 
							$arstatpost= getselect("poststat","name","1",true);
							//$arstatpost= dbconv($arstatpost);
						$smarty->assign("ARSTATPOST", "arstatpost");
						*/
	$smarty->assign("COUN", count($aridpost));
	# извеждаме формата 
//	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


function funcinit($obje){
global $sourname;
	$_POST["adresat"]= toutf8($sourname);
}


?>