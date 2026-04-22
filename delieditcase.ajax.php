<?php
# изх.документи за връчване 
# корекция на ИЗБРАН единичен документ 
# източник : deliedit.ajax.php - корекция на група документи 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $vari - вторично меню 
#    $page - текущата страница 
# параметри : 
#    $deliedit=0 
# още отгоре : 
#    $modeel - базов стринг за линкове 
#    $relurl - линк за рефреш след приключване 
#    $taname, $tana - таблицата 
# $taid - записа 
//# маркирани : 
//#    $aridpost - масив с документи post.id 
//print_r($GETPARAM);
//print_rr($aridpost);


# таблицата 
$taname= $tana;
# шаблона 
$tpname= "delieditcase.ajax.tpl";
# полетата 
$filist= array(
	"idpostuser"=> NULL
	,"date1"=>  array("validator"=>"bgdate_valid", "transformer"=>"getputbgdate")
	,"date2"=>  array("validator"=>"bgdate_valid", "transformer"=>"getputbgdate")
	,"date3"=>  array("validator"=>"bgdate_valid", "transformer"=>"getputbgdate")
	,"idpoststat"=> NULL
);
# константни полета 
//$ficonst= array("iduser"=>$iduser);
$ficonst= array();
# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page);
//$relurl= geturl("mode=".$mode);

									# класа за редактиране 
									include_once "edit.class.php";
# редактиране 
//$obedit= new edit($taname,$edit,$filist,$ficonst);
$obedit= new edit($taname,$taid,$filist,$ficonst);
//print_rr($obedit);
# действие 
$reedit= $obedit->action();
//var_dump($reedit);

# резултат 
if ($reedit==0){

/*****
if (isset($_POST["submit"])){
//print "<br>===before===";
//$co2= $DB->selectCell("select count(*) from deliexte");
//print "<h2>$co2</h2>";
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
				# корегираме маркираните записи 
				foreach($aridpost as $idpost){
//print "<br>idpost=[$idpost]";
					$DB->query("update $taname set ?a where id=?d"  ,$aset,$idpost);
				}
//$co2= $DB->selectCell("select count(*) from deliexte");
//print "<h2>$co2</h2>";
******/
		# само за вътрешен 
		# ако метода не е призовкар - нулираме и призовкаря 
		if ($isinte and $_POST["idposttype"]<>2 and $_POST["idpostuser"]<>0){
					$DB->query("update $taname set idpostuser=0 where id=?d"  ,$tana);
		}else{
		}
	# redirect 
	reload("parent",$relurl);
}else{
							/*
							# за избор на призовкар 
							$aruserpost= getselect("postuser","name","1",true);
							//$aruserpost= dbconv($aruserpost);
						$smarty->assign("ARUSERPOST", "aruserpost");
							*/
							# за избор на статус 
							$arstatpost= getselect("poststat","name","1",true);
							//$arstatpost= dbconv($arstatpost);
						$smarty->assign("ARSTATPOST", "arstatpost");
//	$smarty->assign("COUN", count($aridpost));
	# извеждаме формата 
//	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}

?>