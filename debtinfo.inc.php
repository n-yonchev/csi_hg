<?php
# всичко за проучване на длъжници 


# типове документи 
$arinfotype= array();
$arinfotype[0]= "";
$arinfotype[1]= "ГРАО";
$arinfotype[2]= "заплата";
$arinfotype[3]= "пенсия";
	$arinfotype[4]= "имотен рег";
	$arinfotype[5]= "кадастър";
		$arinfotype[6]= "ЦРОЗ";
$arinfotype_utf8= toutf8($arinfotype);
$smarty->assign("ARINFOTYPE", $arinfotype);
$smarty->assign("ARINFOTYPENAME", "arinfotype_utf8");

# папка за документите 
$prefdocu= "docsinfo/";

# филтър получени документи 
$filtdocu= "debtinfo.attached<>''";
# филтър заявки за документи 
$filtrequ= "debtinfo.attached=''";

# основна завявка 
$mainqu= "
	select debtinfo.*, debtinfo.id as id
		, debtor.name as debtname, debtor.egn as debtegn, debtor.idcase as caseid
		, suit.serial as caseseri, suit.year as caseyear
		, user.name as username
			, t2user.name as t2username
, suit.id as idcase, suit.idstat as idstat, suit.isno18
, if(archive.id is null,0,1) as isarch
	from debtinfo
	left join debtor on debtinfo.iddebtor=debtor.id
	left join suit on debtor.idcase=suit.id
	left join user on suit.iduser=user.id
left join archive on debtor.idcase=archive.idcase
			left join user as t2user on debtinfo.iduser=t2user.id
	";
	
	

#-------------------------------- всичко за филтъра -------------------------------------------
# източник : delifilt.inc.php - документи за връчване 

# сесийни имена 
$sepostname= "dipost";
$secodename= "dicode";
$seviewname= "diview";

# елементи на филтъра 
# - да отговарят на полетата в шаблона debtinfofilt.ajax.tpl 
$arelemfilt= array();
$arelemfilt["peridatecrea"]= array("fiel"=>"date(debtinfo.created)", "text"=>"заявен");
$arelemfilt["peridateatta"]= array("fiel"=>"date(debtinfo.attached)", "text"=>"получен");
$arelemfilt["idinfotype"]= array("fiel"=>"debtinfo.idtype", "text"=>"тип");
$arelemfilt["seriyearcase"]= array("fiel"=>"debtor.idcase", "text"=>"изп.дело");
$arelemfilt["idcaseuser"]= array("fiel"=>"suit.iduser", "text"=>"деловодител");
$arelemfilt["debtcont"]= array("fiel"=>"debtor.name", "text"=>"име длъжник");
$arelemfilt["egncont"]= array("fiel"=>"debtor.egn", "text"=>"ЕГН длъжник");

$smarty->assign("ARELEMFILT", $arelemfilt);


# 24.04.2018 заявка за БНБ - в опашката  
function putbnbqu($iddebt){
global $DB;
						#--------------------------------------------------------------
						# поредния актуален пакет 
									$DB->query("lock tables debt_bnb write, debt_bnbpack write");
						$rolast= $DB->selectRow("select * from debt_bnbpack order by id desc limit 1");
//print_rr($rolast);
						if (empty($rolast["filename"])){
							$idpa2= $rolast["id"];
//var_dump($idpa2);
						}else{
							$idpa2= $DB->query("insert into debt_bnbpack set created=now()");
						}
						#--------------------------------------------------------------
						$aset= array();
							$aset["iddebtor"]= $iddebt;
							$aset["idpack"]= $idpa2;
							$aset["iduser"]= $_SESSION["iduser"];
						$idnew4= $DB->query("insert into debt_bnb set ?a"  ,$aset);
									$DB->query("unlock tables");
return $idnew4;
}


# съдържание за извеждане 
function getviewdocu($viewdocu){
global $prefdocu;
	$contdocu= file_get_contents($prefdocu.$viewdocu.".html");
		$pos1= strpos(strtolower($contdocu),"charset");
		if ($pos1===false){
	$contdocu= "<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\" />
</head>
<body>
$contdocu
</body>
</html>";
		}else{
		}
return $contdocu;
}

# обща проверка 
function checklist(){
global $arelemfilt;
						$lister= array();
						$arcode= array();
						$arview= array();
	foreach($arelemfilt as $elemname=>$x2){
		$postcont= $_POST[$elemname];
//		$mustbeempty= in_array($elemname,$cboxlistelem);
//+++print "<br>checklist=[$elemname][$postcont]";
//		if (empty($postcont) and !$mustbeempty){
		if (empty($postcont)){
		}else{
			$fielname= $x2["fiel"];
//			$resu= checkelem($elemname,$fielname,$mustbeempty);
			$resu= checkelem($elemname,$fielname);
//+++print_ru($resu);
			list($txer,$code,$view)= $resu;
//print "__code=[$code]++view=[$view]";
			if (empty($txer)){
						$arcode[]= $code;
						$arview[$elemname]= $view;
			}else{
						$lister[$elemname]= $txer;
			}
		}
//var_dump($resu);
//print_ru($lister);
	}
return array($lister,$arcode,$arview);
}

# проверка на елемент 
//function checkelem($elemname,$fielname,$mustbeempty){
function checkelem($elemname,$fielname){
//global $arelemfilt, $tana, $listtypepost;
global $DB;
		if (0){

		}elseif ($elemname=="peridatecrea"){
$resu= checkperiod($_POST["peridatecrea"],$fielname);
return $resu;

		}elseif ($elemname=="peridateatta"){
$resu= checkperiod($_POST["peridateatta"],$fielname);
return $resu;

		}elseif ($elemname=="idinfotype"){
				$elemcont= $_POST[$elemname];
					$txer= "";
					$code= "$fielname=$elemcont";
					$view= $GLOBALS["arinfotype"][$elemcont];
return array($txer,$code,$view);

		}elseif ($elemname=="seriyearcase"){
				$seriyearcase= $_POST["seriyearcase"];
				list($caseri,$cayear)= explode("/",$seriyearcase);
				if (strlen($cayear)==2){
					$cayear= "20".$cayear;
				}else{
				}
/*
				$idcase= $DB->selectCell("select id from suit where serial=?d and year=?d"  ,$caseri,$cayear);
				if ($idcase+0==0){
					$txer= "няма такова дело";
				}else{
					$txer= "";
					$code= "$fielname=$idcase";
					$view= $seriyearcase;
				}
*/
				$iduser4= $_SESSION["iduser"];
				$roc4= $DB->selectRow("select id,iduser from suit where serial=?d and year=?d"  ,$caseri,$cayear);
//print "<br>case=[$caseri][$cayear]";
//print_rr($roc4);
					$idcase4= $roc4["id"];
					$idcaseuser4= $roc4["iduser"];
//print "<br>user=[$iduser4][$idcaseuser4]";
				$idcase4 += 0;
				if ($idcase4==0){
					$txer= "няма такова дело";
				}elseif (!$GLOBALS["logisinfo"] and $iduser4<>$idcaseuser4){
					$txer= "чуждо дело";
				}else{
					$txer= "";
					$code= "$fielname=$idcase4";
					$view= $seriyearcase;
				}
return array($txer,$code,$view);

		}elseif ($elemname=="idcaseuser"){
				$elemcont= $_POST[$elemname];
					$txer= "";
					$code= "$fielname=$elemcont";
						$rouser= getrow("user",$elemcont);
					$view= $rouser["name"];
return array($txer,$code,$view);

		}elseif ($elemname=="debtcont"){
				$elemcont= $_POST[$elemname];
					$txer= "";
					$code= "upper($fielname) like upper('%$elemcont%')";
					$view= tran1251($elemcont);
return array($txer,$code,$view);

		}elseif ($elemname=="egncont"){
				$elemcont= $_POST[$elemname];
					$txer= "";
//					$code= "upper($fielname) like upper('%$elemcont%')";
					$code= "debtor.idtype=2 and upper($fielname) like upper('%$elemcont%')";
					$view= tran1251($elemcont);
return array($txer,$code,$view);

# край 
		}else{
die("checkelem=1");
var_dump($elemname);
		}
return NULL;
}


# проверка на дата/период 
function checkperiod($pericode,$fielname){
	list($date1,$date2)= explode("-",$pericode);
	$mydate1= bgdateto($date1);
//var_dump($mydate1);
	list($ye,$mo,$da)= explode("-",$mydate1);
//print "[$ye][$mo][$da]";
							$txer= "";
	if (checkdate($mo+0,$da+0,$ye+0)){
		if (empty($date2)){
		}else{
			$mydate2= bgdateto($date2);
			list($ye,$mo,$da)= explode("-",$mydate2);
			if (checkdate($mo+0,$da+0,$ye+0)){
				if ($mydate1>=$mydate2){
							$txer= "грешен период";
				}else{
				}
			}else{
							$txer= "грешна кр.дата";
			}
//print "[$mydate1][$mydate2]";
		}
	}else{
							$txer= "грешна нач.дата";
	}
	if ($txer==""){
						$bg1= bgdatefrom($mydate1);
		if (empty($date2)){
			$code= "$fielname='$mydate1'";
			$view= $bg1;
		}else{
						$bg2= bgdatefrom($mydate2);
//			$code= "$fielname>='$mydate1' and $fielname<='$mydate2'";
			$code= "$fielname<>'' and $fielname>='$mydate1' and $fielname<='$mydate2'";
			$view= $bg1."-".$bg2;
		}
//return array($code,$view);
	}else{
//return $txer;
	}
return array($txer,$code,$view);
}


?>