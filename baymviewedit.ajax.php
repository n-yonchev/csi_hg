<?php
# корекция на данните за изходящо плащане 
# АНАЛОГ НА bapaelemedit.php 
#    но без бутона "запиши с грешки" 
#    редактирането е кратко 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $page - текущата страница от списъка с извлеченията 
//#    $bapaelem - текущото извлечение 
#  $viewlist - all/ready - списъка включва всички/само готовите 
#    $pageelem - текущата страница от списъка с постъпления в това извлечение 
#    $editpaym - избраното плащане 

# таблицата 
$taname= "bank";
# шаблона 
$tpname= "bapaelemedit.ajax.tpl";
# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page."&bapaelem=".$bapaelem."&pageelem=".$pageelem);
$relurl= geturl("mode=".$mode."&page=".$page   ."&viewlist=".$viewlist."&pageelem=".$pageelem);

# полетата 
$filist= array(
	"payiban"=>  array("validator"=>"notempty", "error"=>"IBAN не може да е празен")
	,"paybic"=>  array("validator"=>"notempty", "error"=>"BIC не може да е празен")
	,"payrem1"=>  array("validator"=>"notempty", "error"=>"основание-1 не може да е празно")
	,"payrem2"=> NULL
);
# константни полета 
$ficonst= array();

/*****/
									# класа за редактиране 
									include_once "edit.class.php";

# редактиране 
$obedit= new edit($taname,$editpaym,$filist,$ficonst);
# действие 
$reedit= $obedit->action();
//var_dump($reedit);
/*****/


# резултат 
//if ($retucode==0){
if ($reedit==0){
	# redirect 
	reload("parent",$relurl);
}else{

# четем данните за постъплението 
$robank= getrow("bank",$editpaym);
$roclai= getrow("claimer",$robank["idclaimer"]);
$rocase= getrow("suit",$roclai["idcase"]);
						
/*
						# за избор на сметка на взискателя 
						$claitype= $roclai["idtype"];
						if ($claitype==1){
							$field= "bulstat";
						}elseif ($claitype==2){
							$field= "egn";
						}else{
die("claitype=$claitype");
						}
						$aracco= getselect("debtor","name","1",true);
print_r($aracco);
						# предаваме името на масива 
						$smarty->assign("ARACCO", "aracco");
*/

	# извеждаме формата 
	//$smarty->assign("CASEDATA", $mylist);
	$smarty->assign("BANKDATA", $robank);
	$smarty->assign("CLAIDATA", $roclai);
	$smarty->assign("CASEDATA", $rocase);
	$smarty->assign("FILIST", $filist);
# без бутона "запиши с грешки" 
$smarty->assign("NOSUB2", true);
	print smdisp($tpname,"iconv");
}


?>
