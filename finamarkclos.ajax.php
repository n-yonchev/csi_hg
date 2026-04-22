<?php
# маркиране на постъпление като СТАРО приключено 
# отгоре : 
#    $markclos - finance.id за маркиране 
//print_r($GETPARAM);

# шаблона 
$tpname= "finamarkclos.ajax.tpl";
# полетата 
//$filist= array();
$filist= array(
//	"datebala"=> array("validator"=>"bgdate_valid", "transformer"=>"getputbgdate")
	"datebala"=> array("validator"=>"bgdate_valid")
);
# константни полета 
$ficonst= array();

# reload - след успешен събмит 
		if (isset($relurl)){
		}else{
$relurl= geturl("mode=".$mode."&page=".$page);
		}

									# класа за редактиране 
									include_once "edit.class.php";

#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
//var_dump($mfacproc);

# данните за постъплението 
$rocont= getrow("finance",$markclos);
# данни за делото 
//print_rr(toutf8($viewcasestat));
$rocase= getrow("suit",$rocont["idcase"]);
$smarty->assign("ROCASE", $rocase);
$smarty->assign("ARSTAT", $viewcasestat);

					# 04.10.2011 - нов подход към заключването на постъпление 
					# източник : finaedit.ajax.php 
											include_once "fina.inc.php";
					$toexit= finalock($markclos);
					if ($toexit){
exit;
					}else{
					}
# разпределение на постъплението 
$arfina= gettrandata($markclos);
									include_once "tran.inc.php";
foreach($arfina as $idclai=>$elem){
	if ($idclai>0 and !empty($elem["iban"])){
						# IBAN контр.число (2 цифри) 
						$chresu= ibancheck($elem["iban"]);
						if ($chresu===true){
						}else{
$arfina[$idclai]["ibaniser"]= true;
						}
	}else{
	}
}
$smarty->assign("ARFINA", $arfina);
//print_ru($arfina);

# 13.10.2016 - евент.планирана такса по т.26 
$suma26= $rocont["separa2"] +0;
$smarty->assign("SUMA26", $suma26);
if ($suma26==0){
}else{
	$idd2= $rocont["iddebtor"];
	$rode= getrow("debtor",$idd2);
	$smarty->assign("DEBTNAME", $rode["name"]);
}
//print_rr($_POST);
//print_rr($filist);

/***

								# 28.06.2010 - доп.поле - дата на приключване - в полето timeclosed 
								# Бъзински - за премирането 
								# може да се въвежда еднократно само за стари 
								$flagold= ($rocont["idtype"]==7);
# 12.11.2012 - ОТПАДА 
$flagold= false;
$smarty->assign("FLAGOLD", $flagold);
								if ($flagold){
$filist["dateclos"]= array("validator"=>"bgdate_valid_notempty");
								}else{
								}
//print_rr($_POST);
//print_rr($filist);
***/
									# основен параметър - $markclos = finance.id 
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	$datebala= $rocont["datebala"];
	$_POST["datebala"]= empty($datebala) ? "" : bgdatefrom($datebala);
								/***
								# 28.06.2010 - доп.поле - дата на приключване - в полето timeclosed 
								if ($flagold){
	$timeclosed= $rocont["timeclosed"];
	$dateclos= substr($timeclosed,0,10);
	$_POST["dateclos"]= empty($dateclos) ? "" : bgdatefrom($dateclos);
								}else{
								}
								***/

#------ submit без формални грешки 
# старо приключено 
//}elseif ($mfacproc=="submyes"){
/***
}elseif ($mfacproc=="submclos"){
							$retucode= 0;
	# датата 
	$aset= array();
		$datebala= $_POST["datebala"];
	$aset["datebala"]= empty($datebala) ? "" : bgdateto($datebala);
								# 28.06.2010 - доп.поле - дата на приключване - в полето timeclosed 
								if ($flagold){
		$dateclos= $_POST["dateclos"];
		$bgdateclos= bgdateto($dateclos);
	$codeclos= "timeclosed='$bgdateclos'";
								}else{
	$codeclos= "timeclosed=now()";
								}
	# вдигаме флага 
//	$DB->query("update finance set ?a, isclosed=1, $codeclos where finance.id=?d"  ,$aset,$markclos);
# 12.11.2012 - старо приключено или готово за превод 
$DB->query("update finance set ?a, isclosed=1, istran=2, $codeclos where finance.id=?d"  ,$aset,$markclos);
	# добавяме записа в архива 
	finaarchive($markclos);
***/

#------ submit без формални грешки 
# за превод 
}elseif ($mfacproc=="submtran"){
							$retucode= 0;
	# вдигаме флага 
//	$DB->query("update finance set ?a, isclosed=1, $codeclos where finance.id=?d"  ,$aset,$marktran);
# 12.11.2012 - старо приключено или готово за превод 
$DB->query("update finance set isclosed=0, istran=2, time=now() where finance.id=?d"  ,$markclos);
	# добавяме записа в архива 
//	finaarchive($marktran);
	finaarchive($markclos);

#------ submit с формални грешки 
# - невъзможно в случая 
}elseif ($mfacproc==NULL){
	# стандартна реакция 
							$retucode= 1;
	doerrors();

#------ автоматичен submit -----------------------------------------------------
# - невъзможно в случая 
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
		/*
		 * 19.02.2020 - Simeon - коменираме го, защото ХГ няма разпореждания
		# 13.10.2016 - евент.планирана такса по т.26 
		if ($suma26==0){
		}else{
								include_once "taxe.inc.php";
			# формираме таксата 
			# полето p2poin съдържа постъплението, от което е таксата 
			$tset= array();
			$tset["idtype"]= 3;
		$tset["p2poin"]= $markclos;
//			$tset["idex"]= $_POST["iddebt"];
			$tset["idex"]= $rocont["iddebtor"];
			$tset["code"]= $code26;
			$tset["txquan"]= 1;
//			$tset["txsuma"]= $suma26;
			$tset["txsuma"]= round($suma26/1.2 ,2);
				# ново разпореждане за делото 
				$idc2= $rocont["idcase"];
				$idr2= $DB->selectCell("select max(idrang) from txorde where idcase=?d"  ,$idc2) +1;
					$oset= array();
					$oset["idcase"]= $idc2;
					$oset["idrang"]= $idr2;
				$ido2= $DB->query("insert into txorde set ?a, created=now()"  ,$oset);
			$tset["idorde"]= $ido2;
			$idtxelem= $DB->query("insert into txordeelem set ?a"  ,$tset);
			# общата сума 
			updatxtota($idtxelem);
		}
		*/

					# 04.10.2011 - нов подход към заключването на постъпление 
					# източник : finaedit.ajax.php 
//					finaunlock($edit);
# 12.11.2012 - оправена грешка 
finaunlock($markclos);

							# ако е извикан алтернативно от дело 
							if ($CALLFROMCASE){
				# redirect 
							#---- януари-2010 актуален дълг ----
//				$smarty->assign("EXITCODE", getnyroexit("tpaymlink"));
//							$redilink= array("tpaymlink","tactulink");
							$redilink= array("tpaymlink","tactulink","ttaxelink");
							$smarty->assign("EXITCODE", getnyroexit($redilink));
				print smdisp($tpname,"iconv");
							}else{
	# redirect 
				if (isset($relurltran)){
reload("parent",$relurltran);
				}else{
reload("parent",$relurl);
				}
							}
}else{
	# извеждаме формата 
	$smarty->assign("DATA", $rocont);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
//	$pagecont= smdisp($tpname,"iconv");
}


?>