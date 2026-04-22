<?php
# документи за връчване - вътрешни за въведено дело 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
# параметри : 
#    $vari - вторично меню = case_[suit.id] 
//print_rr($GETPARAM);


# делото $idcase 
list($pref,$idcase)= explode("_",$vari);
//print "idcase=[$idcase]";

# назад към списъка 
$smarty->assign("ISBACKPAGE", true);

#--------------------------------------------------------------------------------
# източник : tranfina.inc.php 
# данни за делото 
$rocase= getrow("suit",$idcase);
$rouser= getrow("user",$rocase["iduser"]);
$rocase["username"]= $rouser["name"];
							# за извеждане на "идва от" - кеширания масив 
							$arfrom= unserialize(file_get_contents(COFROMFILE));
							$smarty->assign("ARFROM", $arfrom);
							# за извеждане на "титул"  
							$smarty->assign("ARTITU", $listtitu);
							# за извеждане на "вид" 
							$smarty->assign("ARSORT", $listsort);
							# за извеждане на "текущ статус" 
							$smarty->assign("ARSTAT", $viewcasestat);
							# за извеждане на "произход на вземането" 
							$roorig= getrow("claimorigin",$rocase["idclaimorig"]);
$rocase["origtext"]= $roorig["name"];
$smarty->assign("DATACASE", $rocase);
					
# взискатели по делото 
	$clailist= $DB->select("
		select claimer.*, claimer.id as id
		from claimer 
		where idcase=?d
		order by claimer.id
		"  ,$idcase);
$clailist= dbconv($clailist);
foreach($clailist as $indx=>$cont){
	$clailist[$indx]["address"]= nl2br($cont["address"]);
}
$smarty->assign("CLAILIST", $clailist);
# длъжници по делото 
	$debtlist= $DB->select("
		select debtor.id as ARRAY_KEY, debtor.* 
		from debtor 
		where debtor.idcase=?d 
		order by debtor.id"  
		,$idcase);
$debtlist= dbconv($debtlist);
foreach($debtlist as $indx=>$cont){
	$debtlist[$indx]["address"]= nl2br($cont["address"]);
}
//////print_rr($debtlist);
$smarty->assign("DEBTLIST", $debtlist);
#--------------------------------------------------------------------------------


/*
# текущата страница 
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

# текущия филтър 
$filt= $GETPARAM["filt"];
					//$filt= "yes";
$isfilt= ($filt=="yes");
$smarty->assign("ISFILT", $isfilt);

# таблицата за тримесечието 
$tana= $artabl[$vari];
# визуално 
list($pref,$p2,$p3)= explode("_",$vari);
$smarty->assign("HEAD", $p2."-".$p3);
*/

# за базовия линк 
$modeel= "mode=".$mode."&vari=".$vari."&filt=".$filt."&page=".$page;
//$_SESSION["deliinte_modeel"]= $modeel;
//$_SESSION["deliinte_tana"]= $tana;

# за рефреш 
$relurl= geturl($modeel);

#------ за чакащи документи - източник : deliwait.php -------------------------------------------------------
							# директно прехвърляне в норм.списък на избран чакащ запис 
							# източник : deliwaitcopy.ajax.php 
							$waittonorm= $GETPARAM["waittonorm"];
							if (isset($waittonorm)){
	$fromtabl= "postwait";
	$totabl= $cutabl;
									$DB->query("lock tables $fromtabl write, $totabl write");
	$arunset= getunset(true);
					# прехвърляме чакащия запис 
					$rowait= $DB->selectRow("select * from $fromtabl where id=?d"  ,$waittonorm);
						foreach($arunset as $fime){
							unset($rowait[$fime]);
						}
					$DB->query("insert into $totabl set ?a"  ,$rowait);
					# изтриваме чакащия запис 
					$DB->query("delete from $fromtabl where id=?d"  ,$waittonorm);
									$DB->query("unlock tables");
# redirect 
reload("",$relurl);
							}else{
							}

									# директно дублиране на избран запис 
									$deliwaitdubl= $GETPARAM["deliwaitdubl"];
									if (isset($deliwaitdubl)){
$rowait= $DB->selectRow("select * from postwait where id=?d"  ,$deliwaitdubl);
	unset($rowait["id"]);
	$rowait["isdubl"]= 1;
$newid= insepostwait($rowait,false);
//var_dump($newid);
# redirect 
reload("",$relurl);
									}else{
									}
									# директно изтриване на дублиран запис 
									$deliwaitdele= $GETPARAM["deliwaitdele"];
									if (isset($deliwaitdele)){
$DB->query("delete from postwait where id=?d"  ,$deliwaitdele);
# redirect 
reload("",$relurl);
									}else{
									}

									# nyroModal прозорец за корекции на избран запис 
									$deliwaitedit= $GETPARAM["deliwaitedit"];
									if (isset($deliwaitedit)){
$isinte= true;
$smarty->assign("ISINTE", $isinte);
										include_once "deliwaitedit.ajax.php";
										exit;
//return;
									}else{
									}

#------ за нормални вътрешни документи - източник : deliinte.php -------------------------------------------------------
									# nyroModal прозорец за корекции на маркирани записи 
									$tana= $GETPARAM["tana"];
									if (isset($tana)){
										$taid= $GETPARAM["taid"];
//						$aridpost= $_SESSION["aridpost"];
//						$aridpost= array($taid);
//$smarty->assign("NOMESS", true);
$isinte= true;
										include_once "delieditcase.ajax.php";
										exit;
//return;
									}else{
									}


# списък на изходените документи по делото 
$filtdout= "docuout.serial<>0 and docuout.year<>0";
$ardout= $DB->select("
	select docuout.id as ARRAY_KEY
		, docuout.registered as d2regi, docuout.serial as d2seri, docuout.year as d2year, docuout.id as iddout
, $docucode
		, docutype.text as d2text, docutype.isbank, docutype.idposttype as d2posttype
		, user.name as d2userregi
	from docuout
		left join docutype on docuout.iddocutype=docutype.id 
		left join user on docuout.iduserregi=user.id
$doculink
	where docuout.idcase=?d
and $filtdout
	order by docuout.id desc
	"  ,$idcase);
$ardout= dbconv($ardout);
//$smarty->assign("ARDOUT", $ardout);

# временна обединена таблица 
$uniqname= getuniontab("docuout.idcase=$idcase");
//$ar2= $DB->select("select * from `$uniqname`");
//print_ru($ar2);

# екземплярите за връчване от нея 
$ardeli= $DB->select("
	select t1.iddocuout as ARRAY_KEY1, concat(t1.tana,'^',t1.taid) as ARRAY_KEY2
		, t1.*, 0 as iswait
		, postuser.name as pouser, poststat.name as postat
	from `$uniqname` as t1
		left join postuser on t1.idpostuser=postuser.id
		left join poststat on t1.idpoststat=poststat.id
	");
$ardeli= dbconv($ardeli);

# екземплярите за връчване от чакащите 
$arwait= $DB->select("
	select t1.iddocuout as ARRAY_KEY1, concat('wait','^',t1.id) as ARRAY_KEY2
		, t1.*, t1.id as idwait, 1 as iswait
		, postuser.name as pouser, '' as postat
	from postwait as t1
		left join docuout on t1.iddocuout=docuout.id
		left join postuser on t1.idpostuser=postuser.id
	where docuout.idcase=?d
	"  ,$idcase);
$arwait= dbconv($arwait);

# обединяваме 
foreach ($arwait as $key1=>$x2){
	foreach ($x2 as $key2=>$uscont){
		$ardeli[$key1][$key2]= $arwait[$key1][$key2];
	}
}
//print_ru($ardeli);

# трансформация 
foreach ($ardeli as $key1=>$x2){
	foreach ($x2 as $key2=>$uscont){
		$ardeli[$key1][$key2]["adresat"]= noquotes($uscont["adresat"]);
		$ardeli[$key1][$key2]["address"]= noquotes($uscont["address"]);
			if ($uscont["iswait"]==0){
				$tana= $uscont["tana"];
				$taid= $uscont["taid"];
		$ardeli[$key1][$key2]["deliedit"]= geturl($modeel  ."&tana=".$tana."&taid=".$taid);
			}else{
				$idwait= $uscont["idwait"];
		$ardeli[$key1][$key2]["waittonorm"]= geturl($modeel."&waittonorm=".$idwait);
		$ardeli[$key1][$key2]["deliwaitedit"]= geturl($modeel."&deliwaitedit=".$idwait);
		$ardeli[$key1][$key2]["deliwaitdubl"]= geturl($modeel."&deliwaitdubl=".$idwait);
		$ardeli[$key1][$key2]["deliwaitdele"]= geturl($modeel."&deliwaitdele=".$idwait);
			}
	}
}
//print_ru($ardeli);
$smarty->assign("ARDELI", $ardeli);
# брой екземпляри за всеки изх.документ 
foreach ($ardout as $uskey=>$uscont){
	$ardout[$uskey]["coun"]= count($ardeli[$uskey]);
}
$smarty->assign("ARDOUT", $ardout);

/*
# линк за прозореца за корекции 
$linkedit= geturl($modeel."&deliedit=0");
$smarty->assign("LINKEDIT", $linkedit);
# линк за прозореца за изчистване 
$linkclear= geturl($modeel."&deliclear=0");
$smarty->assign("LINKCLEAR", $linkclear);
*/
# линкове за филтъра 
	$linkfiltedit= geturl($modeel."&filtedit=yes");
$smarty->assign("LINKFILTEDIT", $linkfiltedit);
	$linkfiltno= geturl($modeel."&filtno=yes");
$smarty->assign("LINKFILTNO", $linkfiltno);


# извеждаме 
$smarty->assign("LIST", $mylist);
$varipagecont= smdisp("delicase.tpl","fetch");


?>