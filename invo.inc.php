<?php
# всичко за фактура 

# за метод на плащане 
$armeth= array();
$armeth["b"]= "по банков път";
$armeth["c"]= "в брой";
$smarty->assign("ARMETH", $armeth);
	$armeth= toutf8($armeth);
$smarty->assign("ARMETHNAME", "armeth");

# типове фактури 
$arinvotype= array();
$arinvotype[0]= "фактура";
$arinvotype[1]= "проформа фактура";
$arinvotype[2]= "кредитно известие";
$arinvotype[3]= "дебитно известие";
$smarty->assign("ARINVOTYPE", $arinvotype);
	$arinvotypesele= toutf8($arinvotype);
$smarty->assign("ARINVOTYPESELE", "arinvotypesele");
			$arinvo2= $arinvotype;
			unset($arinvo2[1]);
	$arinvo2sele= toutf8($arinvo2);
$smarty->assign("ARINVO2SELE", "arinvo2sele");
#++++++++++++++++++++++++++++++++++++++++++++++++++++
			$arinvo3= array(-1=>"") + $arinvotype + array(9=>"сметка" ,"10"=>"сметка без фактура");
	$arinvo3sele= toutf8($arinvo3);
$smarty->assign("ARINVO3SELE", "arinvo3sele");
#++++++++++++++++++++++++++++++++++++++++++++++++++++



# корегираме данни за платена сума 
function updapaid($modibill){
global $DB;
		$aset= array();
		$aset["paid"]= $_POST["paid"];
		$aset["paidmethod"]= $_POST["paidmethod"];
		$aset["cashiduser"]= $_POST["cashiduser"];
	$DB->query("update bill set ?a where id=?d"  ,$aset,$modibill);
}

/*
function getsumabill($filt){
global $DB;
	$listsuma= $DB->select("
		select billelem.idbill as ARRAY_KEY
			, round(if(bill.isvat=0,1,1.2)*sum(billelem.taxprop+billelem.taxregu+billelem.taxaddi),2) as suma
			, round(if(bill.isvat=0,0,0.2)*sum(billelem.taxprop+billelem.taxregu+billelem.taxaddi),2) as svat
, round(sum(billelem.taxprop+billelem.taxregu+billelem.taxaddi),2) as s0
		from billelem
left join bill on billelem.idbill=bill.id
left join suit on bill.idcase=suit.id
		where $filt 
and bill.id is not null
and bill.serial<>0
and suit.id+0<>0
		group by billelem.idbill
		");
//and bill.idcase<>0
//$smarty->assign("LISTSUMA", $listsuma);
//print_rr($listsuma);
return $listsuma;
}

function getsumainvo($filt){
global $DB;
	$arresu= $DB->select("
		select invoelem.idbill as ARRAY_KEY
			, round(if(bill.isvat=0,1,1.2)*sum(invoelem.quan * invoelem.price),2) as suma
			, round(if(bill.isvat=0,0,0.2)*sum(invoelem.quan * invoelem.price),2) as svat
, round(sum(invoelem.quan * invoelem.price),2) as s0
			, count(invoelem.id) as coun
		from invoelem
		left join bill on invoelem.idbill=bill.id
		where $filt 
and bill.id is not null
and bill.serial=0
and bill.idcase=0
		group by invoelem.idbill
		");
//print_rr($arresu);
return $arresu;
}
*/

function getsumabill($filt){
global $DB;
	$codecred= "if(bill.idinvotype=2,-1,1)";
	$listsuma= $DB->select("
		select billelem.idbill as ARRAY_KEY
			, round(sum(if(bill.isvat=0,1,1.2)*$codecred*(billelem.taxprop+billelem.taxregu+billelem.taxaddi)),2) as suma
			, round(sum(if(bill.isvat=0,0,0.2)*$codecred*(billelem.taxprop+billelem.taxregu+billelem.taxaddi)),2) as svat
, round(sum($codecred*(billelem.taxprop+billelem.taxregu+billelem.taxaddi)),2) as s0
		from billelem
left join bill on billelem.idbill=bill.id
left join suit on bill.idcase=suit.id
		where $filt 
and bill.id is not null
and bill.serial<>0
and suit.id+0<>0
		group by billelem.idbill
		");
//--			, round(if(bill.isvat=0,1,1.2)*$codecred*sum(billelem.taxprop+billelem.taxregu+billelem.taxaddi),2) as suma
//--			, round(if(bill.isvat=0,0,0.2)*$codecred*sum(billelem.taxprop+billelem.taxregu+billelem.taxaddi),2) as svat
//--, round($codecred*sum(billelem.taxprop+billelem.taxregu+billelem.taxaddi),2) as s0
//and bill.idcase<>0
//$smarty->assign("LISTSUMA", $listsuma);
//print_rr($listsuma);
return $listsuma;
}

function getsumainvo($filt){
global $DB;
	$codecred= "if(bill.idinvotype=2,-1,1)";
	$arresu= $DB->select("
		select invoelem.idbill as ARRAY_KEY
			, round(sum(if(bill.isvat=0,1,1.2)*$codecred*invoelem.quan * invoelem.price),2) as suma
			, round(sum(if(bill.isvat=0,0,0.2)*$codecred*invoelem.quan * invoelem.price),2) as svat
, round(sum($codecred*invoelem.quan * invoelem.price),2) as s0
			, count(invoelem.id) as coun
		from invoelem
		left join bill on invoelem.idbill=bill.id
		where $filt 
and bill.id is not null
and bill.serial=0
and bill.idcase=0
		group by invoelem.idbill
		");
//--			, round(if(bill.isvat=0,1,1.2)*$codecred*sum(invoelem.quan * invoelem.price),2) as suma
//--			, round(if(bill.isvat=0,0,0.2)*$codecred*sum(invoelem.quan * invoelem.price),2) as svat
//--, round($codecred*sum(invoelem.quan * invoelem.price),2) as s0
//print_rr($arresu);
return $arresu;
}
/*
function getsumainvoview($idbill){
	$arsuma= getsumainvo("invoelem.idbill=$idbill");
	$sumatota= $arsuma[$idbill]["suma"];
	$sumatota= number_format($sumatota,2  ,".",",");
return $sumatota;
}
*/

function getfilist(){
	$filist["invoseri"]= array("validator"=>"notempty", "error"=>"номера е задължителен");
	$filist["invodate"]= array("validator"=>"bgdate_valid_notempty");
$filist["invoisva"]= NULL;
	$filist["invoname"]= array("validator"=>"notempty", "error"=>"името е задължително");
//	$filist["invoegn"]= array("validator"=>"notempty", "error"=>"идент.номер е задължителен");
//	$filist["invoeik"]= array("validator"=>"notempty", "error"=>"идент.номер е задължителен");
$filist["invoegn"]= NULL;
$filist["invoeik"]= NULL;
	$filist["invoaddr"]= array("validator"=>"notempty", "error"=>"адреса е задължителен");
//	$filist["invopers"]= array("validator"=>"notempty", "error"=>"МОЛ е задължително");
$filist["invopers"]= NULL;
$filist["invometh"]= array("validator"=>"notempty", "error"=>"избора е задължителен");
# 16.01.2014 сметката на ЧСИ като съставител 
$filist["iban"]= array("validator"=>"notempty", "error"=>"IBAN за фактурата е задължителен");
return $filist;
}

//++++function invopost($rocont,$invobase){
function invopost($rocont){
							//$arinvo["serial"]= $maxserinvo;
//							$_POST["invoseri"]= $maxserinvo;
					$_POST["invoseri"]= invonextser();
						$_POST["invodate"]= date("d.m.Y");
					$rocont= toutf8($rocont);
						$_POST["invoname"]= $rocont["name"];
						$_POST["invoeik"]= (empty($rocont["eik"])) ? $rocont["egn"] : $rocont["eik"];
						$_POST["invoaddr"]= $rocont["address"];
					$_POST["invoisva"]= $rocont["isvat"];
					$_POST["invometh"]= $rocont["paidmethod"];
}

function invonextser(){
global $DB;
	$nextnumb= $DB->selectCell("select max(seriinvo) from bill");
return $nextnumb+1;
}

function billnextser(){
global $DB;
	$nextnumb= $DB->selectCell("select max(serial) from bill");
return $nextnumb+1;
}

function invoinse($regibill  ,$myyear=NULL){
global $DB;
	$aset= array();
//	$aset["serial"]= $_POST["invoseri"];
	$aset["serial"]= $_POST["invoseri"] +0;
				if (isset($myyear)){
				}else{
		$myyear= (int) date("Y");
				}
	$aset["year"]= $myyear;
	$aset["date"]= bgdateto($_POST["invodate"]);
	$aset["idbill"]= $regibill;
	$aset["toname"]= $_POST["invoname"];
	$aset["toeik"]= $_POST["invoeik"];
	$aset["toaddr"]= $_POST["invoaddr"];
	$aset["toperson"]= $_POST["invopers"];
$aset["isvat"]= isset($_POST["invoisva"]) ? 1 : 0;
	$aset["paidmethod"]= $_POST["invometh"];
		$DB->query("insert into invoice set ?a"  ,$aset);
}

function involister($idbill){
global $DB, $smarty;
global $lister;
		# номера на фактурата 
		$seriinvo= $_POST["seriinvo"] +0;
		if ($seriinvo==0){
//+++++++++++++++++++++++											$lister["seriinvo"]= "грешен номер фактура";
		}else{
			if (isset($_POST["seriinvoconf"])){
			}else{
				$coun= $DB->selectCell("select count(id) from bill where seriinvo=?d and id<>?d"  ,$seriinvo,$idbill);
				if ($coun==0){
					$invonextser= invonextser();
					$seriinvodiff= $seriinvo - $invonextser;
					if ($seriinvodiff > 0){
	$smarty->assign("SERIINVODIFF",$seriinvodiff);
	$smarty->assign("INVOMAXSER",$invonextser-1);
											$lister["yyyy"]= "yyyy";
					}else{
					}
				}else{
											$lister["seriinvo"]= "номера е зает от друга фактура";
				}
			}
		}
}

function billlister($idbill){
global $DB, $smarty;
global $lister;
		# номера на сметката 
		$serial= $_POST["serial"] +0;
		if ($serial==0){
//++++++++++++++++++++											$lister["serial"]= "грешен номер сметка";
		}else{
			if (isset($_POST["sericonf"])){
			}else{
				$coun= $DB->selectCell("select count(id) from bill where serial=?d and id<>?d"  ,$serial,$idbill);
				if ($coun==0){
					$billnextser= billnextser();
					$seridiff= $serial - $billnextser;
					if ($seridiff > 0){
	$smarty->assign("SERIDIFF",$seridiff);
	$smarty->assign("BILLMAXSER",$billnextser-1);
											$lister["yyyy"]= "yyyy";
					}else{
					}
				}else{
											$lister["serial"]= "номера е зает от друга сметка";
				}
			}
		}
}


#---------------------------- само за сметките ---------------------------------

# дефиниции на сметките 
function getbill(){
	$arcont= file("SMET.TXT");
//	$arcont= tran1251($arcont);
	$arcont= toutf8($arcont);
//print_rr($arcont);
							$argrou= array();
							$ardefi= array();
	foreach($arcont as $elcont){
		$elcont= trim($elcont);
		if (empty($elcont)){
		}else{
			$ar2= explode("\t",$elcont);
			if (substr($ar2[0],0,1)=="="){
				$pref= substr($ar2[0],1);
				$nextistext= false;
							$argrou[$pref]= $ar2[1];
			}else{
				$arpara= explode("\t",$elcont);
				if ($nextistext){
							$ardefi[$code]["txdesc"]= $arpara[0];
					$nextistext= false;
				}else{
					$code= $pref."^".$arpara[0];
							$ardefi[$code]["txgrou"]= $arpara[1];
							$ardefi[$code]["calc"]= $arpara[2];
							$ardefi[$code]["perc"]= $arpara[3];
							$ardefi[$code]["mini"]= $arpara[4];
							$ardefi[$code]["maxi"]= $arpara[5];
					$nextistext= true;
				}
			}
		}
	}
//print_rr($argrou);
//print_rr($ardefi);
return array($argrou,$ardefi);
}

# дефиниции на шаблоните за сметките 
function gettemp(){
	$arcont= file("SMETTEMP.TXT");
//	$arcont= tran1251($arcont);
	$arcont= toutf8($arcont);
//print_rr($arcont);
							$argrou= array();
							$ardefi= array();
	foreach($arcont as $elcont){
		$elcont= trim($elcont);
		if (empty($elcont)){
		}else{
			$ar2= explode("\t",$elcont);
			if (substr($ar2[0],0,1)=="="){
				$pref= substr($ar2[0],1);
							$argrou[$pref]= $ar2[1];
			}else{
							$ardefi[$pref]= $ar2;
			}
		}
	}
//print_rr($argrou);
//print_rr($ardefi);
return array($argrou,$ardefi);
}

function addbillelem($modibill,$resufiel,$amount){
global $DB;
//print "---POST---";
//print_rr($_POST);
//var_dump($amount);
	$aset= array();
	$aset["idbill"]= $modibill;
//	foreach(array("codetype","action","ground","interest","amount") as $name){
	foreach(array("codetype","action","ground","interest") as $name){
		$aset[$name]= trim($_POST[$name]);
	}
					# резултатните полета 
					foreach ($resufiel as $finame){
						$aset[$finame]= "";
					}
					$codetype= $_POST["codetype"];
					$arcont= $_SESSION["billdefi"][$codetype];
//var_dump($codetype);
						$calc= $arcont["calc"];
						$perc= $arcont["perc"];
						$mini= $arcont["mini"];
						$maxi= $arcont["maxi"];
//print "<br>[$codetype][$calc][$perc][$amount][$mini][$maxi]";
					if (0){
					}elseif ($calc=="proc"){
						$amou= 0.01 * $perc * $aset["interest"];
					}elseif ($calc=="fixi"){
						$amou= $amount;
					}elseif ($calc=="inpu"){
						$amou= $amount;
					}else{
die("cazobillmodi=2=$calc");
					}
					if (empty($mini)){
					}else{
						$amou= ($amou<$mini) ? $mini : $amou;
					}
					if (empty($maxi)){
					}else{
						$amou= ($amou>$maxi) ? $maxi : $amou;
					}
					$indgroup= $codetype +0;
//var_dump($indgroup);
//var_dump($amou);
					$finame= $resufiel[$indgroup];
					$aset[$finame]= $amou;
	$aset["level"]= 99;
//print "===ASET===";
//print_rr($aset);
	# добавяме записа 
	$DB->query("insert into billelem set ?a"  ,$aset);
}


?>