<?php
# отгоре : 
//# post - таблицата за тримесечието 


# сесийни имена 
$sepostname= "delipost";
$secodename= "delicode";
$seviewname= "deliview";

# елементи на филтъра 
# - да отговарят на полетат в шаблона delifiltedit.ajax.tpl 
$arelem= array();
$arelem["idposttype"]= array("fiel"=>"post.idposttype", "text"=>"метод");
//+++$arelem["idpostuser"]= array("fiel"=>"post.idpostuser", "text"=>"призовкар");
$arelem["peridate1"]=  array("fiel"=>"date(post.date1)", "text"=>"взет");
$arelem["peridate2"]=  array("fiel"=>"date(post.date2)", "text"=>"връчен");
$arelem["peridate3"]=  array("fiel"=>"date(post.date3)", "text"=>"върнат");
$arelem["idpoststat"]= array("fiel"=>"post.idpoststat", "text"=>"статус");
//++++$arelem["seridocu"]=   array("fiel"=>"post.ser", "text"=>"номер док.");
//++++$arelem["yeardocu"]=   array("fiel"=>"post.year", "text"=>"година");
$arelem["seridocuout"]= array("fiel"=>"docuout.serial", "text"=>"номер изх.док.");
$arelem["yeardocuout"]= array("fiel"=>"docuout.year", "text"=>"година изх.док.");
$arelem["listdocuout"]= array("fiel"=>"docuout.serial", "text"=>"изх.номера");
//++++$arelem["peridateregi"]=  array("fiel"=>"date(post.addtime)", "text"=>"изходен");
$arelem["peridateregi"]=  array("fiel"=>"date(post.created)", "text"=>"изходен");
$arelem["asatcont"]=   array("fiel"=>"post.adresat", "text"=>"адресат");
//$arelem["addrcont"]=   array("fiel"=>"post.adres", "text"=>"адрес");
$arelem["addrcont"]=   array("fiel"=>"post.address", "text"=>"адрес");
//++++$arelem["idposttype"]=   array("fiel"=>"docuout.iddocutype", "text"=>"тип док.");
$arelem["iddocutype"]=   array("fiel"=>"docuout.iddocutype", "text"=>"тип док.");
$arelem["seriyearcase"]=   array("fiel"=>"docuout.idcase", "text"=>"изп.дело");
$arelem["idcaseuser"]= array("fiel"=>"suit.iduser", "text"=>"деловодител");
# само за входящ документ 
$arelem["desccont"]= array("fiel"=>"docu.text", "text"=>"описание");
$arelem["fromcont"]= array("fiel"=>"docu.from", "text"=>"подател");
$arelem["notecont"]= array("fiel"=>"docu.notes", "text"=>"бележки");
$arelem["exincont"]= array("fiel"=>"deliexte.exinfo", "text"=>"доп.инфо");
$arelem["seridocu"]=   array("fiel"=>"docu.serial", "text"=>"номер изх.док.");
$arelem["yeardocu"]=   array("fiel"=>"docu.year", "text"=>"година изх.док.");

$smarty->assign("ARELEM", $arelem);


#------------------- функции за проверка ---------------------

function checklist(){
global $arelem;
	$cboxlistelem= $_POST["cboxlistelem"];
	if (isset($cboxlistelem)){
	}else{
		$cboxlistelem= array();
	}
						$lister= array();
						$arcode= array();
						$arview= array();
	foreach($arelem as $elemname=>$x2){
//print_ru($x2);
		$postcont= $_POST[$elemname];
		$mustbeempty= in_array($elemname,$cboxlistelem);
//print "<br>checklist=[$elemname][$postcont]";
		if (empty($postcont) and !$mustbeempty){
		}else{
			$fielname= $x2["fiel"];
			$resu= checkelem($elemname,$fielname,$mustbeempty);
			list($txer,$code,$view)= $resu;
//print "__code=[$code]++view=[$view]";
			if (empty($txer)){
						$arcode[]= $code;
						$arview[$elemname]= $view;
			}else{
						$lister[$elemname]= $txer;
			}
/*
			if (is_array($resu)){
//						$lister= $lister + $resu;
						list($arcode,$arview)= $resu;
			}else{
						$lister= $lister + $resu;
			}
*/
		}
//var_dump($resu);
//print_ru($lister);
	}
return array($lister,$arcode,$arview);
}

function checkelem($elemname,$fielname,$mustbeempty){
global $arelem, $listtypepost;
global $DB;
//print "<br>checkelem=[$elemname][$fielname][$mustbeempty]";
		if (0){

		}elseif ($elemname=="idposttype"){
			if ($mustbeempty){
					$txer= "";
					$code= "$fielname=0";
					$view= "няма";
			}else{
				$elemcont= $_POST[$elemname];
					$txer= "";
					$code= "$fielname=$elemcont";
					$view= $listtypepost[$elemcont];
			}
return array($txer,$code,$view);

/*+++
		}elseif ($elemname=="idpostuser"){
			if ($mustbeempty){
					$txer= "";
					$code= "$fielname=0";
					$view= "няма";
			}else{
				$elemcont= $_POST[$elemname];
					$txer= "";
					$code= "$fielname=$elemcont";
						$ropouser= getrow("postuser",$elemcont);
					$view= $ropouser["name"];
			}
return array($txer,$code,$view);
+++*/

		}elseif ($elemname=="peridate1"){
			//if ($mustbeempty){
			//}else{
			//}
$resu= checkperiod($_POST["peridate1"],$fielname,$mustbeempty);
return $resu;

		}elseif ($elemname=="peridate2"){
			//if ($mustbeempty){
			//}else{
			//}
$resu= checkperiod($_POST["peridate2"],$fielname,$mustbeempty);
return $resu;

		}elseif ($elemname=="peridate3"){
			//if ($mustbeempty){
			//}else{
			//}
$resu= checkperiod($_POST["peridate3"],$fielname,$mustbeempty);
return $resu;

		}elseif ($elemname=="idpoststat"){
			if ($mustbeempty){
					$txer= "";
					$code= "$fielname=0";
					$view= "няма";
			}else{
				$elemcont= $_POST[$elemname];
					$txer= "";
					$code= "$fielname=$elemcont";
						$ropostat= getrow("poststat",$elemcont);
					$view= $ropostat["name"];
			}
return array($txer,$code,$view);

		}elseif ($elemname=="seridocuout"){
			if ($mustbeempty){
					$txer= "";
					$code= "docuout.id is null";
					$view= "липсващ";
			}else{
				$elemcont= $_POST[$elemname];
/*
				$coun= $DB->selectCell("select count(*) from post where ser=?d"  ,$elemcont);
//print "<br>delifilt=[$elemname][$elemcont][$coun]";
				if ($coun==0){
					$txer= "няма призовка с този номер";
				}else{
					$txer= "";
					$code= "$fielname=$elemcont";
					$view= $elemcont;
				}
*/
				$iddout= $DB->selectCell("
					select docuout.id
					from docuout 
					where docuout.serial=?
					"  ,$elemcont);
//print "<br>delifilt=[$elemname][$elemcont][$coun]";
				if ($iddout==0){
					$txer= "няма изх.документ с този номер";
				}else{
					$txer= "";
					$code= "$fielname=$elemcont";
					$view= $elemcont;
				}
			}
return array($txer,$code,$view);

		}elseif ($elemname=="yeardocuout"){
			if ($mustbeempty){
					$txer= "";
					$code= "docuout.year=0";
					$view= "няма";
			}else{
				$elemcont= $_POST[$elemname];
/*
				$coun= $DB->selectCell("select count(*) from post where year=?d"  ,$elemcont);
				if ($coun==0){
					$txer= "няма изх.документи от тази година";
				}else{
					$txer= "";
					$code= "$fielname=$elemcont";
					$view= $elemcont;
				}
*/
				$iddout= $DB->selectCell("
					select docuout.id
					from docuout 
					where docuout.year=?
					"  ,$elemcont);
//print "<br>delifilt=[$elemname][$elemcont][$coun]";
				if ($iddout==0){
					$txer= "няма изх.документ от тази година";
				}else{
					$txer= "";
					$code= "$fielname=$elemcont";
					$view= $elemcont;
				}
			}
return array($txer,$code,$view);

		}elseif ($elemname=="listdocuout"){
/*
			if ($mustbeempty){
					$txer= "";
					$code= "suit.iduser=0";
					$view= "липсващ";
			}else{
*/
				$elemcont= $_POST[$elemname];
				$arcont= explode(" ",$elemcont);
						$ar2= array();
				foreach($arcont as $elem){
					$elem= trim($elem);
					if (empty($elem)){
					}else{
						$ar2[]= $elem;
					}
				}
				$stcode= implode(",",$ar2);
					$txer= "";
					$code= "$fielname in ($stcode)";
					$view= $stcode;
//			}
return array($txer,$code,$view);

		}elseif ($elemname=="peridateregi"){
			//if ($mustbeempty){
			//}else{
			//}
$resu= checkperiod($_POST["peridateregi"],$fielname,$mustbeempty);
return $resu;

		}elseif ($elemname=="asatcont"){
			if ($mustbeempty){
					$txer= "";
					$code= "$fielname=''";
					$view= "няма";
			}else{
				$elemcont= $_POST[$elemname];
					$txer= "";
					$code= "upper($fielname) like upper('%$elemcont%')";
					$view= tran1251($elemcont);
			}
return array($txer,$code,$view);

		}elseif ($elemname=="addrcont"){
			if ($mustbeempty){
					$txer= "";
					$code= "$fielname=''";
					$view= "няма";
			}else{
				$elemcont= $_POST[$elemname];
					$txer= "";
					$code= "upper($fielname) like upper('%$elemcont%')";
					$view= tran1251($elemcont);
			}
return array($txer,$code,$view);

//		}elseif ($elemname=="idposttype"){
		}elseif ($elemname=="iddocutype"){
			if ($mustbeempty){
					$txer= "";
					$code= "$fielname=0";
					$view= "няма";
			}else{
				$elemcont= $_POST[$elemname];
					$txer= "";
					$code= "$fielname=$elemcont";
						$rodocutype= getrow("docutype",$elemcont);
					$view= $rodocutype["text"];
			}
return array($txer,$code,$view);

		}elseif ($elemname=="seriyearcase"){
			if ($mustbeempty){
					$txer= "";
					$code= "suit.id is null";
					$view= "липсващо";
			}else{
				$seriyearcase= $_POST["seriyearcase"];
				list($caseri,$cayear)= explode("/",$seriyearcase);
				if (strlen($cayear)==2){
					$cayear= "20".$cayear;
				}else{
				}
				$idcase= $DB->selectCell("select id from suit where serial=?d and year=?d"  ,$caseri,$cayear);
				if ($idcase+0==0){
					$txer= "няма такова дело";
				}else{
					$txer= "";
					$code= "$fielname=$idcase";
					$view= $seriyearcase;
				}
			}
return array($txer,$code,$view);

		}elseif ($elemname=="idcaseuser"){
			if ($mustbeempty){
					$txer= "";
					$code= "suit.iduser=0";
					$view= "липсващ";
			}else{
				$elemcont= $_POST[$elemname];
					$txer= "";
					$code= "$fielname=$elemcont";
						$rouser= getrow("user",$elemcont);
					$view= $rouser["name"];
			}
return array($txer,$code,$view);

# само за входящ документ 

		}elseif ($elemname=="desccont" or $elemname=="fromcont" or $elemname=="notecont" or $elemname=="exincont"){
			if ($mustbeempty){
					$txer= "";
					$code= "$fielname=''";
					$view= "няма";
			}else{
				$elemcont= $_POST[$elemname];
					$txer= "";
					$code= "upper($fielname) like upper('%$elemcont%')";
					$view= tran1251($elemcont);
			}
return array($txer,$code,$view);

		}elseif ($elemname=="seridocu"){
			if ($mustbeempty){
					$txer= "";
					$code= "docu.id is null";
					$view= "липсващ";
			}else{
				$elemcont= $_POST[$elemname];
				$iddocu= $DB->selectCell("
					select docu.id
					from docu 
					where docu.serial=?
					"  ,$elemcont);
//print "<br>delifilt=[$elemname][$elemcont][$coun]";
				if ($iddocu==0){
					$txer= "няма вх.документ с този номер";
				}else{
					$txer= "";
					$code= "$fielname=$elemcont";
					$view= $elemcont;
				}
			}
return array($txer,$code,$view);

		}elseif ($elemname=="yeardocu"){
			if ($mustbeempty){
					$txer= "";
					$code= "docu.year=0";
					$view= "няма";
			}else{
				$elemcont= $_POST[$elemname];
				$iddocu= $DB->selectCell("
					select docu.id
					from docu 
					where docu.year=?
					"  ,$elemcont);
//print "<br>delifilt=[$elemname][$elemcont][$coun]";
				if ($iddocu==0){
					$txer= "няма вх.документ от тази година";
				}else{
					$txer= "";
					$code= "$fielname=$elemcont";
					$view= $elemcont;
				}
			}
return array($txer,$code,$view);

# край 
		}else{
die("checkelem=1");
var_dump($elemname);
		}
return NULL;
}

function checkperiod($pericode,$fielname,$mustbeempty){
				if ($mustbeempty){
					$txer= "";
					$code= "$fielname=''";
					$view= "няма дата";
return array($txer,$code,$view);
				}else{
				}
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
			$code= "$fielname>='$mydate1' and $fielname<='$mydate2'";
			$view= $bg1."-".$bg2;
		}
//return array($code,$view);
	}else{
//return $txer;
	}
return array($txer,$code,$view);
}


?>