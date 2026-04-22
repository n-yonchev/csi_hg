<?php
# корекция на касов пакет - СПЕЦИФИЧЕН ПОДХОД 
#    юзера избира кои прих.ордери да влизат в него 
#    корекцията се прави в табл. с прих.ордери, а не е табл. с пакетите 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $edit - cashpack.id за корекция - избрания касов пакет 
//print_r($GETPARAM);

//# таблицата 
//$taname= "cofrom";
# шаблона 
$tpname= "capaedit.ajax.tpl";
//# полетата 
//$filist= array(
//	"name"=>  array("validator"=>"notempty", "error"=>"името не може да е празно")
//);
//# константни полета 
//$ficonst= array("idcashpack"=>$edit);
# reload - след успешен събмит 
//$relurl= "?".rawurlencode(mycrypt("put","mode=".$mode));
$relurl= geturl("mode=".$mode."&page=".$page);


					# заявката $query - включва само прих.ордери, които :
					#     са вече избрани за този пакет и 
					#     все още свободните, които не влизат в пакет 
					include "cash.inc.php";
//					$query= getcashquery("cash.idcashpack=$edit or cash.idcashpack=0");
## глобален филтър 
$cashfilt= "cash.idcashpack=$edit or cash.idcashpack=0";
					$query= getcashquery($cashfilt);
# списъка 
$mylist= $DB->select($query);
$mylist= dbconv($mylist);



#----------------- директно редактиране -----------------------

									//# класа за редактиране 
									//# само заради функцията doerrors 
									//include_once "edit.class.php";
									
				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
//print_r($_POST);
//print_r($_POST["listcash"]);

# ВНИМАНИЕ. 
# няма списък на полетата $filist, вместо него 
# $_POST["listcash"] ще съдържа списъка на избраните ордери 
# това име да е съгласувано и с шаблона 
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	if ($edit==0){
		# всички свободни ордери ще бъдат чекнати автоматично 
		$arli= array();
		foreach($mylist as $myelem){
			$arli[]= $myelem["id"];
		}
	}else{
		# всички вече избрани ордери ще бъдат чекнати автоматично 
		# всички свободни ордери няма да са чекнати 
		$arli= array();
		foreach($mylist as $myelem){
			$myid= $myelem["id"];
					if ($myelem["idcashpack"]==0){
					}else{
			$arli[]= $myelem["id"];
					}
		}
	}
	$_POST["listcash"]= $arli;
	$smarty->assign("ARCHECKED", $_POST["listcash"]);

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
	# ако няма избрани, POST масива е NULL - корегираме 
	$listcash= $_POST["listcash"];
	if (empty($listcash)){
		# грешка - повтаряме формата 
		$_POST["listcash"]= array();
		$smarty->assign("ARCHECKED", $_POST["listcash"]);
		$smarty->assign("MESSER", "в пакета трябва да има поне един ордер");
	}else{
//		$smarty->assign("ARCHECKED", $_POST["listcash"]);
//print_r($listcash);
		# ОК - край 
		# $listcash съдържа cash.id на всички ордери, избрани за включване в пакета 
		# ще запишем указателя cash.idcashpack на всички избрани 
		# ВНИМАНИЕ. 
		#     Списъка със свободните ордери е един за всички сеанси. 
		#     За избягване на повече от едно назначение на даден ордер - 
		#     Не трябва да има едновременно повече от един (текущия) сеанс 
		#     за назначаване на свободни ордери към пакет. 
//		$incode= implode(",",$listcash);
//																$DB->query("lock tables cash write");
//					$query= getcashquery("cash.idcashpack=$edit or cash.idcashpack=0");
//																$DB->query("unlock tables");
													# заключваме двете таблици 
													$DB->query("lock tables cash write, cashpack write");
		# четем отново ордерите от пакета и свободните - 
		# може да има промяна от предишния събмит 
//		$query= getcashquery("cash.idcashpack=$edit or cash.idcashpack=0");
//		$mylist= $DB->select($query);
		$mylist= $DB->select("select id from cash where $cashfilt");
//		$mylist= dbconv($mylist);
		# формираме 2 отделни списъка с id - за включване и за освобождаване 
					$listincl= array();
					$listfree= array();
		foreach($mylist as $myelem){
			$myid= $myelem["id"];
			if (in_array($myid,$listcash)){
					$listincl[]= $myid;
			}else{
					$listfree[]= $myid;
			}
		}
		$codeincl= implode(",",$listincl);
		$codefree= implode(",",$listfree);
		# общата сума на пакета 
//		$supack= $DB->selectCell("select sum(amount) from cash where id in ($codeincl)");
		$supack= $DB->selectCell("select sum(amount-amountsep) from cash where id in ($codeincl)");
									$aset= array();
									$aset["amount"]= $supack;
					if ($edit==0){
						# създаваме нов пакет 
//													$DB->query("lock tables cashpack write");
									$maxser= $DB->selectCell("select max(serial) from cashpack");
									$aset["serial"]= $maxser + 1;
						$edit= $DB->query("insert into cashpack set ?a, created=now()" ,$aset);
//													$DB->query("unlock tables");
					}else{
						# само сумата на съществуващия пакет 
						$DB->query("update cashpack set ?a where id=?d" ,$aset,$edit);
					}
		# накрая назначаваме самите ордери към пакета 
				$aset= array();
				$aset["idcashpack"]= $edit;
		$DB->query("update cash set ?a where id in ($codeincl)" ,$aset);
		# аналогично освобождаваме от пакета или въобще 
							if (empty($codefree)){
							}else{
				$aset= array();
				$aset["idcashpack"]= 0;
		$DB->query("update cash set ?a where id in ($codefree)" ,$aset);
							}
													# отключваме двете таблици 
													$DB->query("unlock tables");
# redirect 
reload("parent",$relurl);
	}

#------ submit с формални грешки 
}elseif ($mfacproc==NULL){
	$smarty->assign("ARCHECKED", $_POST["listcash"]);
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


# допълнителни js линкове за секцията head 
$smarty->assign("HEADJS", array("cluetip.hoverIntent.js","jquery.cluetip.js"));

# извеждаме 
//$smarty->assign("ADDNEW", $addnew);
//print_r($mylist);
$smarty->assign("LIST", $mylist);
//$pagecont= smdisp("capaedit.ajax.tpl","fetch");
//print $pagecont;
print smdisp($tpname,"iconv");


?>