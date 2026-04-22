<?php
# отгоре : 
#    $mode - текущия режим 
#    $dele - user.id - титулярния деловодител 
#        този юзер се замества от друг, прекратяваме това заместване 
//print "correction [$mode][$dele]";

# данните за титуляра 
$rouser= getrow("user",$dele);
$smarty->assign("NAMEORIG", $rouser["name"]);
# данни за заместника му 
$iddepu= $DB->selectCell("select iduserdepu from userdepu where iduserorig=?d"  ,$dele);
$rouser= getrow("user",$iddepu);
$smarty->assign("NAMEDEPU", $rouser["name"]);
//print $dele;
//var_dump($iddepu);
				# брой дела за възстановявяне 
				$coun= $DB->selectCell("select count(*) from suit where iduser2=?d"  ,$dele);
$smarty->assign("COUNORIG",$coun);

# таблицата 
$taname= "userdepu";
# шаблона 
$tpname= "depudele.ajax.tpl";
# полетата 
/*
$filist= array(
	"name"=>  array("validator"=>"notempty", "error"=>"името не може да е празно")
	,"username"=>  array("validator"=>"notempty", "error"=>"входното име не може да е празно")
	,"password"=>  array("validator"=>"notempty", "error"=>"входната парола не може да е празна")
# списък на правата - косвено определя полето lisrperm 
# - масив от полета checkbox 
	,"listde"=>  array("inactive"=>true)
);
*/
$filist= array();
# константни полета 
$ficonst= array();
# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page);
$relurl= geturl("mode=".$mode);

									# класа за редактиране 
									include_once "edit.class.php";

#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
//print_rr($_POST);

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
/*
//	if ($dele==0){
		$_POST["iduserdepu"]= $iddepu;
//	}else{
//		$rocont= $DB->selectRow("select * from $taname where id=?" ,$dele);
//	}
*/

#------ submit без формални грешки 
/*
}elseif ($mfacproc=="submit"){
							$retucode= 0;
											# проверяваме за допълнителни грешки 
											$lister= array();
											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
												#---- няма ---- 
							$retucode= -2;
	$smarty->assign("ACTION",true);
		$iduserdepu= $_POST["iduserdepu"];
		$rodepu= getrow("user",$iduserdepu);
	$smarty->assign("NAMEDEPU",$rodepu["name"]);
		$rodepuold= getrow("user",$iddepu);
	$smarty->assign("NAMEDEPUOLD",$rodepuold["name"]);
//print_rr($rodepu);
											# край - според дали има грешка 
											}
*/

#------ submit без формални грешки 
# потвърдено заместване 
}elseif ($mfacproc=="submyes"){
							$retucode= 0;
//	$DB->query("delete from $taname where id=?" ,$dele);
															$DB->query("lock tables userdepu write, suit write");
		# изтриваме записа за заместването 
		$DB->query("delete from $taname where iduserorig=?d" ,$dele);
				# възстановяваме делата на титулярния деловодител 
				$bset= array();
				$bset["iduser"]= $dele;
				$bset["iduser2"]= 0;
						# ВАЖНО. Отключваме евент.заключените дела от заместника. 
						# Иначе са възможни проблеми при отварянето им от титлуряра. 
				$bset["lockedby"]= 0;
				$DB->query("update suit set ?a where iduser2=?d" ,$bset,$dele);
															$DB->query("unlock tables");

#------ допълнителен бутон 
# отказ от заместване 
}elseif ($mfacproc=="submno"){
							$retucode= 0;

#------ submit с формални грешки 
}elseif ($mfacproc==NULL){
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

# резултат 
if ($retucode==0){
	# redirect 
	reload("parent",$relurl);
}else{
							//# допълнителни js линкове за секцията head 
							//$smarty->assign("HEADJS", array("cluetip.hoverIntent.js","jquery.cluetip.js"));
	# извеждаме формата 
	$smarty->assign("EDIT", $dele);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


?>