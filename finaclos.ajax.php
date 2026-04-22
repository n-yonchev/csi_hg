<?php
# приключване на постъпление по текущото дело 
# отгоре : 
#    $clos - finance.id за приключване 
//print_r($GETPARAM);


# шаблона 
$tpname= "finaclos.ajax.tpl";
# полетата 
//$filist= array();
$filist= array(
//	"datebala"=> array("validator"=>"bgdate_valid", "transformer"=>"getputbgdate")
	"datebala"=> array("validator"=>"bgdate_valid")
);
# константни полета 
$ficonst= array();

# reload - след успешен събмит 
$relurl= geturl("mode=".$mode."&page=".$page);

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
$rocont= getrow("finance",$clos);
/***
						# яну-фев-2010 актуален дълг 
						# доп.поле - кой е заключил делото и номера на делото 
						# виж заявката във finaquery-fina.inc.php 
						$rocase= getrow("suit",$rocont["idcase"]);
						$rouser= getrow("user",$rocase["lockedby"]);
						# ако го е заключил логнатия - пропускаме 
						if ($rouser["id"]==$iduser){
						}else{
$smarty->assign("LOCKNAME", $rouser["name"]);
$smarty->assign("LOCKCASE", $rocase["serial"]."/".$rocase["year"]);
						}
***/
					# 04.10.2011 - нов подход към заключването на постъпление 
					# източник : finaedit.ajax.php 
											include_once "fina.inc.php";
					$toexit= finalock($clos);
					if ($toexit){
exit;
					}else{
					}
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
									# основен параметър - $clos = finance.id 
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	$datebala= $rocont["datebala"];
	$_POST["datebala"]= empty($datebala) ? "" : bgdatefrom($datebala);
								# 28.06.2010 - доп.поле - дата на приключване - в полето timeclosed 
								if ($flagold){
	$timeclosed= $rocont["timeclosed"];
	$dateclos= substr($timeclosed,0,10);
	$_POST["dateclos"]= empty($dateclos) ? "" : bgdatefrom($dateclos);
								}else{
								}

#------ submit без формални грешки 
# потвърдено приключване 
}elseif ($mfacproc=="submyes"){
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
/****
	# вдигаме флага 
//var_dump($clos);
//	$DB->query("update finance set ?a, isclosed=1 where id=?" ,$aset,$clos);
									# 05.02.2010 - СТАНДАРТ 
									# паралелно със заявката правим проверка в последния момент дали делото отново не е отворено 
									#     suit.lockedby=0 - не е отворено 
									#     suit.lockedby=$iduser - отворено е от логнатия 
							# 10.02.2010 - записваме и времето на приключване timeclosed 
  
                                     
                                          
                                       
                                                                     
                
  
								# 28.06.2010 - доп.поле - дата на приключване - в полето timeclosed 
	$dbresu= $DB->query("update finance 
		left join suit on finance.idcase=suit.id
		set ?a, isclosed=1, $codeclos
		where finance.id=? and (suit.lockedby=0 or suit.lockedby=$iduser)" 
		,$aset,$clos);
									if ($dbresu==0){
										# заявката няма ефект - делото е отворено преди тази заявка 
										# - извеждаме отново формата с информационно съобщение 
							$retucode= -9;
							$smarty->assign("NOEF", true);
									}else{
										# ОК - заявката вдигна флага 
//print $dbresu;
# 28.01.2010 - динамично преизчисляване на погасяването 
# и текстове за автоматично попълване на дневника изв.действия 
# записваме и времето на приключване на постъплението 
//$DB->query("update finance set ?a, isclosed=1, jourtime=now() where id=?" ,$aset,$clos);
	# добавяме записа в архива 
	finaarchive($clos);
									}
****/

/*
#------ допълнителен бутон 
# отказ 
}elseif ($mfacproc=="submno"){
	# нищо не правим 
							$retucode= 0;
*/
	# вдигаме флага 
	$DB->query("update finance set ?a, isclosed=1, $codeclos where finance.id=?d"  ,$aset,$clos);
	# добавяме записа в архива 
	finaarchive($clos);

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
					# 04.10.2011 - нов подход към заключването на постъпление 
					# източник : finaedit.ajax.php 
//					finaunlock($edit);
# 12.11.2012 - оправена грешка 
finaunlock($clos);

							# ако е извикан алтернативно от дело 
							if ($CALLFROMCASE){
				# redirect 
							#---- януари-2010 актуален дълг ----
//				$smarty->assign("EXITCODE", getnyroexit("tpaymlink"));
							$redilink= array("tpaymlink","tactulink");
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
/*
	# redirect 
	reload("parent",$relurl);
//	$smarty->assign("EXITCODE", getnyroexit($redilink));
//	print smdisp($tpname,"iconv");
*/
}else{
	# извеждаме формата 
	$smarty->assign("DATA", $rocont);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
//	$pagecont= smdisp($tpname,"iconv");
}


?>
