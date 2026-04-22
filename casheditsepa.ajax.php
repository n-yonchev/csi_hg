<?php
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $editsepa - cash.id за корекция на заделената сума 
//print "correction [$mode][$editsepa]";
//print_r($GETPARAM);

# таблицата 
$taname= "cash";
# шаблона 
$tpname= "casheditsepa.ajax.tpl";
# полетата 
$filist= array(
	"amountsep"=>  array("validator"=>"amount_or_empty", "error"=>"грешна сума")
//	"amountsep"=>  array("validator"=>"amount", "error"=>"грешна сума")
//	"name"=>  array("validator"=>"notempty", "error"=>"името не може да е празно")
);
# константни полета 
//$ficonst= array("iduser"=>$iduser);
$ficonst= array();
# reload - след успешен събмит 
$relurl= geturl("mode=".$mode."&page=".$page);

									# класа за редактиране 
									include_once "edit.class.php";

# ВАЖНО 
$edit= $editsepa;
# редактиране 
$obedit= new edit($taname,$edit,$filist,$ficonst);
//# добавяме параметри за кеширане 
//$obedit->cachequery= "select id as ARRAY_KEY, name from cofrom order by name";
//$obedit->cachefile= COFROMFILE;
# функция за допълнит.грешки 
$obedit->errorfunc= "funcer";

# действие 
$reedit= $obedit->action();
//var_dump($reedit);

# резултат 
if ($reedit==0){
							# преизчисляваме общата сума на пакета ордери 
							# източник : capaedit.ajax.php 
													# заключваме двете таблици 
													$DB->query("lock tables cash write, cashpack write");
							$rocash= getrow($taname,$editsepa);
							$idcashpack= $rocash["idcashpack"];
							$supack= $DB->selectCell("select sum(amount-amountsep) from cash where idcashpack=?d", $idcashpack);
									$aset= array();
									$aset["amount"]= $supack;
							$DB->query("update cashpack set ?a where id=?d" ,$aset,$idcashpack);
													$DB->query("unlock tables");
	# redirect 
	reload("parent",$relurl);
}else{
	# предаваме общата сума 
	$rocash= getrow($taname,$editsepa);
	$smarty->assign("AMOU", $rocash["amount"]);
	# извеждаме формата 
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
//sdisplay(1, "eeee.html", $tpname);
//print "<xmp>".smdisp($tpname,"iconv")."</xmp>";
	print smdisp($tpname,"iconv");
}




# функция за допълнит.грешки 
# връща NULL или $lister 
function funcer(){
global $taname, $editsepa;
						$lister= array();
		# дали заделената сума е по-малка от общата 
		$rocash= getrow($taname,$editsepa);
		if ( ($_POST["amountsep"]+0) < ($rocash["amount"]+0) ){
		}else{
						$lister["amountsep"]= "заделената сума трябва да е по-малка от общата";
		}
						if (count($lister)==0){
return true;
						}else{
return $lister;
						}
}

?>
