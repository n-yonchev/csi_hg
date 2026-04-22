<?php
# приравнява избран адвокат към друг - всички дела преминават към новия 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $page - текущата страница 
#    $filt - текущия филтър 
# $makeeq - agent.id за приравняване 
//print "correction [$mode][$page][$filt][$makeeq]";
//print_r($GETPARAM);

# таблицата 
$taname= "agent";
# шаблона 
$tpname= "agentmakeeq.ajax.tpl";

# адвоката 
$roag= getrow("agent",$makeeq);
$smarty->assign("AGNAME", $roag["name"]);
# броя на делата му 
$agcoun= $DB->selectCell("select count(*) from suit where idagent=?d"  ,$makeeq);
$mytext= ($agcoun==1) ? " дело" : " дела";
$smarty->assign("AGCOUN", $agcoun.$mytext);

/*
# списъка 
$mylist= $DB->select(
	"select suit.*, suit.id as id
	, user.name as username, cofrom.name as coname
	from suit
	left join user on suit.iduser=user.id
	left join cofrom on suit.idcofrom=cofrom.id
	where suit.idagent=?d
	order by suit.year desc, suit.serial desc
	"  ,$makeeq);
$mylist= dbconv($mylist);
						
						# за извеждане на статуса - съдържанието на 1-мерния масив 
						$smarty->assign("ARSTAT", $viewcasestat);
*/

//# полетата 
//$filist= array(
//	"newagent"=>  array("validator"=>"notempty", "error"=>"името е задължително")
//);
//# константни полета 
//$ficonst= array("iduser"=>$iduser);
//$ficonst= array();
# reload - след успешен събмит 
$relurl= geturl("mode=".$mode."&page=".$page."&filt=".$filt);


#----------------- директно редактиране -----------------------

									# класа за редактиране 
									# само заради функцията doerrors 
									include_once "edit.class.php";
									
				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
//var_dump($mfacproc);
//print_r($_POST);

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
																# заключваме 
																$DB->query("lock tables agent write, suit write");
											# масив за грешките 
											$lister= array();
	# проверка за грешки 
	$newagent= $_POST["newagent"];
	$newagent= trim($newagent);
	if (empty($newagent)){
											$lister["newagent"]= "задължително изберете име";
	}else{
		$newidag= $DB->selectCell("select id from agent where name=?"  ,$newagent);
		if ($newidag==0){
											$lister["newagent"]= "в списъка липсва това име";
//		$gset= array();
//		$gset["name"]= $agent;
//		$idag= $DB->query("insert into agent set ?a" ,$gset);
		}elseif ($newidag==$makeeq){
											$lister["newagent"]= "избрахте същия адвокат";
		}else{
		}
	}
											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
												#---- няма ---- 
	# приравняваме 
	$DB->query("update suit set idagent=?d where idagent=?d"  ,$newidag,$makeeq);

											# край според дали има грешка 
											}
																# отключваме 
																$DB->query("unlock tables");

#------ submit с формални грешки 
}elseif ($mfacproc==NULL){
							$retucode= 1;
	doerrors();
	
	# да се извеждат ли във формата дело/година 
	$smarty->assign("ISCASE", $_POST["docutype"]<>9);

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
	# извеждаме формата 
	$smarty->assign("IDMARK", $makeeq);
	$smarty->assign("LIST", $mylist);
	print smdisp($tpname,"iconv");
}


?>