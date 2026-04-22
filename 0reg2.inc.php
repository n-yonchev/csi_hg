<?php

#------------------------------- подготовка ---------------------------------

$topref= "register/";
	$namecase= "cases.csv";
	$namepers= "persons.csv";
	$nameorig= "origins.csv";
$namezip= "zip.zip";



function putcases($cond1,$cond2){
global $DB;
//global $uniqname, $topref, $namecase;
//		$tofile= $topref.$uniqname."_".$namecase;
		$tofile= gettofile("namecase");
#--------------------------------------------------------------
$statlist= array();
$statlist["term"]= array(123,124,125,126,127,128,129);
$statlist["fini"]= array(16,121,122);
//$statlist["cont"]= array(8,24);
$statlist["sent"]= array(201,202);

$mylist= $DB->select("
	select id, year, serial, date(created) as casedate
	from suit
	where $cond1
	order by year, serial
	");
/*
$mystat= $DB->select("
	select idstat, date(time) as statdate
		,idcase as ARRAY_KEY1, id as ARRAY_KEY2
	from suitstathist
	where $cond2
	order by time
	"  ,$edit);
*/
$mystat= $DB->select("
	select suitstathist.idstat, date(suitstathist.time) as statdate
		,suitstathist.idcase as ARRAY_KEY1, suitstathist.id as ARRAY_KEY2
	from suitstathist
		left join suit on suitstathist.idcase=suit.id
	where $cond2
	order by time
	"  ,$edit);
//print_rr($mylist);
//$mylist= arstrip($mylist);
						
						$f1= fopen($tofile,"w");
foreach($mylist as $elem){
//	$elem= arstrip($elem);
					$aset= array();
					$aset[]= $elem["year"];
					$aset[]= regicaseseri($elem["serial"]);
					$aset[]= $elem["casedate"];
							$arwork= array();
	$idcase= $elem["id"];
	if (isset($mystat[$idcase])){
//print_rr($mystat[$idcase]);
		$oldstat= 0;
		foreach($mystat[$idcase] as $elstat){
			$idstat= $elstat["idstat"];
			$statdate= $elstat["statdate"];
			foreach($statlist as $statlistcode=>$statlistelem){
				if (in_array($idstat,$statlistelem)){
							$arwork[$statlistcode]= $statdate;
				}else{
				}
			}
			# спряно[8] - > висящо[24] 
			if ($oldstat==8 and $idstat==24){
				# възобновено 
							$arwork["cont"]= $statdate;
			}else{
			}
			$oldstat= $idstat;
		}
	}else{
	}
					$aset[]= $arwork["term"];
					$aset[]= $arwork["fini"];
					$aset[]= $arwork["cont"];
					$aset[]= $arwork["sent"];
						fputcsv($f1,$aset);
}
						fclose($f1);
#--------------------------------------------------------------
}



function putpersons($cond1){
global $DB;
//global $uniqname, $topref, $namepers;
//		$tofile= $topref.$uniqname."_".$namepers;
		$tofile= gettofile("namepers");

#--------------------------------------------------------------
		# от основ.данни - флаг дали в данните за регистъра да участват взискателите
		$rooffi= getofficerow($iduser);
		$isregiclai= ($rooffi["isregiclai"]<>0);

						$f1= fopen($tofile,"w");
		if ($isregiclai){
outper("claimer",0  ,$cond1,$f1);
		}else{
		}
outper("debtor",1  ,$cond1,$f1);
						fclose($f1);
#--------------------------------------------------------------
}

function outper($taname,$actype  ,$cond1,$f1){
global $DB;
//global $f1;
	$w1= sprintf($cond1,$taname);
	$mylist= $DB->select("
		select $taname.idtype, $taname.egn, $taname.bulstat, $taname.name, $taname.exdata
			,suit.year as caseyear, suit.serial as caseseri
		from $taname
		left join suit on $taname.idcase=suit.id
		where suit.id is not null
			and $w1
		order by caseyear, caseseri
		");
//print_rr($mylist);
//$mylist= arstrip($mylist);
	foreach($mylist as $elem){
		$elem= arstrip($elem);
//		$ardata= unserialize($elem["exdata"]);
		if (empty($elem["exdata"])){
			$ardata= array();
		}else{
			$ardata= unserialize($elem["exdata"]);
		}
			$aset= array();
			$aset[]= $elem["caseyear"];
			$aset[]= regicaseseri($elem["caseseri"]);
			$aset[]= $actype;
		$idtype= $elem["idtype"];
		if ($idtype==1){
			$aset[]= "";
			$aset[]= $elem["bulstat"];
			$aset[]= "";
			$aset[]= "";
			$aset[]= "";
			$aset[]= $elem["name"];
# default=3 юр.лице със стопанска цел 
//			$aset[]= $ardata["t1type"];
			$aset[]= isset($ardata["t1type"]) ? $ardata["t1type"] : 3;
			$aset[]= "";
			$aset[]= "";
			$aset[]= "";
# default=0 активен 
//			$aset[]= $ardata["t1stat"];
			$aset[]= isset($ardata["t1stat"]) ? $ardata["t1stat"] : 0;
		}elseif ($idtype==2){
			$aset[]= $elem["egn"];
			$aset[]= "";
					$arwork= explode(" ",$elem["name"]);
								$arname= array("","","");
								$inname= 0;
					foreach($arwork as $elna){
						if ($elna==""){
						}else{
								if ($inname==2){
									if ($arname[2]==""){
										$arname[2]= $elna;
									}else{
										$arname[2] .= (" ".$elna);
									}
								}else{
									$arname[$inname]= $elna;
									$inname ++;
								}
						}
					}
			$aset[]= $arname[0];
			$aset[]= $arname[1];
			$aset[]= $arname[2];
			$aset[]= "";
					if ($ardata["t2et"]==0){
			$aset[]= 1;
					}else{
			$aset[]= 2;
					}
					if ($ardata["t2fo"]==0){
			$aset[]= "";
			$aset[]= 0;
			$aset[]= "";
					}else{
			$aset[]= $ardata["t2cory"];
//			$aset[]= "country";
			$aset[]= 1;
			$aset[]= bgdateto($ardata["t2date"]);
					}
			$aset[]= 0;		// физ.лице=активен ? 
		}else{
			$aset[]= "";
			$aset[]= "";
			$aset[]= "";
			$aset[]= "";
			$aset[]= "";
			$aset[]= $elem["name"];
			$aset[]= $ardata["t3type"];
			$aset[]= "";
			$aset[]= "";
			$aset[]= "";
			$aset[]= 0;		// други=активен ? 
		}
						fputcsv($f1,$aset);
	}
}



function putorigins($cond1){
global $DB;
//global $uniqname, $topref, $nameorig;
//		$tofile= $topref.$uniqname."_".$nameorig;
		$tofile= gettofile("nameorig");
#--------------------------------------------------------------
$mylist= $DB->select("
	select subject.text, subject.exdata
		,suit.year as caseyear, suit.serial as caseseri
	from subject
	left join suit on subject.idcase=suit.id
	where suit.id is not null
		and $cond1
	order by caseyear, caseseri
	");
//print_rr($mylist);
//$mylist= arstrip($mylist);
						
						$f1= fopen($tofile,"w");
foreach($mylist as $elem){
	$elem= arstrip($elem);
	if (empty($elem["exdata"])){
		$ardata= array();
	}else{
		$ardata= unserialize($elem["exdata"]);
	}
			$aset= array();
			$aset[]= $elem["caseyear"];
			$aset[]= regicaseseri($elem["caseseri"]);
//			$aset[]= $ardata["t4type"];
//			$aset[]= $ardata["t4vari"];
# delault = 1 
$aset[]= empty($ardata["t4type"]) ? 1 : $ardata["t4type"];
$aset[]= empty($ardata["t4vari"]) ? 1 : $ardata["t4vari"];
			$aset[]= $elem["text"];
						fputcsv($f1,$aset);
}
						fclose($f1);
#--------------------------------------------------------------
}



function putzip(){
global $DB;
global $uniqname, $topref;
global $namecase, $namepers, $nameorig;
global $namezip;
							include_once($topref."CreateZip.class.php");
$createZipFile=new CreateZipFile;

#--------------------------------------------------------------
		$fromfile= gettofile("namecase");
$cont= file_get_contents($fromfile);
$createZipFile->addFile($cont,$namecase);
unset($cont);
		$fromfile= gettofile("namepers");
$cont= file_get_contents($fromfile);
$createZipFile->addFile($cont,$namepers);
unset($cont);
		$fromfile= gettofile("nameorig");
$cont= file_get_contents($fromfile);
$createZipFile->addFile($cont,$nameorig);
unset($cont);
#--------------------------------------------------------------

		$zipName= gettofile("namezip");

$fd= fopen($zipName, "wb");
$out= fwrite($fd,$createZipFile->getZippedfile());
fclose($fd);
}



function gettofile($fnam){
global $uniqname, $topref;
global $namecase, $namepers, $nameorig;
global $namezip;
//	$tofile= $topref.$uniqname."_".$fnam;
	$tofile= $topref.$uniqname."_".${$fnam};
return $tofile;
}



#------------------------------- предаване ---------------------------------

# резулт.заглавия 
$arcall= array();
$arcall["e1"]= "грешка-1";
$arcall["e2"]= "грешка-2";
$arcall["e3"]= "грешка-3";
$arcall["ok"]= "резултат";
# резулт.файлове 
$arfina= array();
$arfina["e1"]= "_err1.txt";
$arfina["e2"]= "_fault.txt";
$arfina["e3"]= "_error.txt";
$arfina["ok"]= "_result.txt";
# резулт.текстове 
$armess= array();
$armess["e1"]= "ERR1";
$armess["e2"]= "FAULT";
$armess["e3"]= "ERROR";
$armess["ok"]= "OK";

function toregi($code,$name,$para){
global $DB;
//				$rooffi= getofficerow(0);
//				$code= $rooffi["serial"];
	$pref= dirname(__FILE__);
//	$pref .=  "/regicert"."/registry-enforcer-" .$code;
	$pref .=  "/regicont"."/registry-enforcer-" .$code;
	$cert = $pref .'.crt';
	$private = $pref .'.key';
	$cacert = $pref .'.p12';
//var_dump($cacert);
		$urlwsdl = 'https://registry.bcpea.org/soap.php?wsdl';
		$url = 'https://registry.bcpea.org/soap.php';
	ini_set("soap.wsdl_cache_enabled", "0");

global $client;
	$client= new nusoap_client($urlwsdl, true);
//var_dump($client);
	$client->response_timeout = 3000;
	$client->timeout = 3000;
$certRequest = array(
      'sslcertfile' => $cert
      ,'sslcacert' => $cacert
      ,'sslkeyfile' => $private
      ,'verifyhost' => 0
      ,'verifypeer' => 0
);
	$result= $client->setCredentials(null, null, 'certificate', $certRequest);
//print_rr($client);
	$err = $client->getError();
//++++++++++++++$err= "MYER=NENO";
	if($err){
$retu= array("e1"=>$err);
	}else{
		$result = $client->call($name,$para);
		if ($client->fault) {
$retuelem= print_r($result,true);
$retuelem= "<pre>" .$retuelem ."</pre>";
$retu= array("e2"=>$retuelem);
		}else{
		    $err = $client->getError();
		    if ($err) {
$retu= array("e3"=>$err);
		    }else{
//$retuelem= print_r($result,true);
$retuelem= $result;
//$retuelem= "<pre>" .$retuelem ."</pre>";
$retu= array("ok"=>$retuelem);
		    }
		} 
	}
//print_rr($client->operations);
return $retu;

}


# копие от cazo6creadocu.inc.php 
function cyrlat($p1){
//				$resu= strtoupper($p1);
//				$resu= tran1251(mb_strtoupper($p1,"utf-8"));
				$resu= mb_strtoupper($p1);
//print "CYRLAT==";
//var_dump($p1);
//var_dump($resu);
	$strcyr= "А^Б^В^Г^Д^Е^Ж^З^И^Й^К^Л^М^Н^О^П^Р^С^Т^У^Ф^Х^Ц^Ч^Ш^Щ^Ъ^Ь^Ю^Я^я^ ^-^+^*^.^,";
		$arcyr= explode("^",$strcyr);
	$strlat= "A^B^V^G^D^E^J^Z^I^Y^K^L^M^N^O^P^R^S^T^U^F^H^C^DH^SH^SHT^AY^X^YU^YA^YA^_^_^_^_^_^_";
		$arlat= explode("^",$strlat);
	$resu= str_replace($arcyr,$arlat,$resu);
//var_dump($p1);
//var_dump($resu);
return $resu;
}

# 04.04.2011 - връща имена за работа с регистъра 
function getreginame($iduser){
	if ($iduser==0){
		$usname= "без деловодител";
		$uspref= "NOUSER";
	}else{
		$rouser= getrow("user",$iduser);
		$usname= "с деловодител " .$rouser["name"];
		$uspref= cyrlat($rouser["name"]);
	}
return array($usname,$uspref);
}


# отделен процес 
function regiexec($serial,$namezi,$uniqname){
//$p1= popen("start regi.bat ".escapeshellarg("$serial $namezi") ,"r");
//$p1= popen("start regi.bat $serial $namezi $uniqname" ,"r");
$_SESSION["beginregi"]= time();
					$htho= $_SERVER["HTTP_HOST"];
					if ($htho=="lh" or $htho=="localhost"){
$p1= popen("start regi.bat $serial $namezi $uniqname" ,"r");
//print "windows";
pclose($p1);
					}else{

#=================================================================================
$outname= "regicert/STD_OUT.TXT";
$errname= "regicert/STD_ERR.TXT";
$arpipe = array(
//  0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
//	1 => array("file", "regicert/STD_OUT.TXT", "a"),  // stdout is a pipe that the child will write to
	1 => array("file", $outname, "a"),  // stdout is a FILE that the child will write to
	2 => array("file", $errname, "a") // stderr is a file to write to
);
//$cwd = '/tmp';
//$env = array('some_option' => 'aeiou');
$f1= fopen($outname,"a");
fwrite($f1,"----------------".date("d.m.Y H:i:s")." before\n\n");
//++++++++++++++++++$process = proc_open("/bin/sh regi.sh $serial $namezi $uniqname", $arpipe, $pipes);
$process = proc_open("/bin/sh regi.sh $serial $namezi $uniqname > /dev/null &", $arpipe, $pipes);
fwrite($f1,"----------------".date("d.m.Y H:i:s")." AFTER\n\n");
//fclose($f1);
if (is_resource($process)){
				//echo stream_get_contents($pipes[2]);
				//fclose($pipes[2]);
//sleep(2);
fwrite($f1,"----------------".date("d.m.Y H:i:s")." before return\n\n");
	$return_value= proc_close($process);
//	echo "command returned $return_value\n";
fwrite($f1,"----------------".date("d.m.Y H:i:s")." return=$return_value\n\n");
}else{
}
fclose($f1);
$f1= fopen($outname,"a");
fwrite($f1,"----------------".date("d.m.Y H:i:s")."----------------\n\n");
fclose($f1);
#=================================================================================

					}
}




#------------------------------- помощни ---------------------------------

# изтриване на файлове 
function direunlink($path,$uniq,$suff=""){
	$leuniq= strlen($uniq);
	$dire= dir($path);
	while (false !== ($caname= $dire->read())){
		$funame= $path ."/" .$caname;
		if (is_dir($funame)){
		}else{
							if (empty($suff)){
								$flunli= true;
							}else{
								$flunli= substr($caname,-strlen($suff))==$suff;
							}
//			if (substr($caname,0,$leuniq)==$uniq and substr($caname,-strlen($suff))==$suff){
			if (substr($caname,0,$leuniq)==$uniq and $flunli){
//						$cuindx= substr($caname,$lepref);
//						$cuindx= substr($cuindx,0,strlen($caname)-4);
//						$arzipp[$cuindx]= substr($caname,$lepref);
						unlink($funame);
			}else{
			}
		}
	}
$dire->close();
}


# редове за грешки в протокола 
function getdataer($finame,$isfull){
global $DB;
							$quda= "
								select suit.id as id, user.name as name 
								from suit
								left join user on suit.iduser=user.id
								where suit.serial=?d and suit.year=?d
								";
	$fiar= file($finame);
								$arresu= array();
	foreach($fiar as $row){
		$row= substr($row,19);
		if (strpos($row,"alert")===false){
		}else{
			$row2= "<font color=red>".$row."</font>";
						$arelem= array();
				if ($isfull){
						$arelem[0]= $row2;
																	$cayear= "";
																	$caseri= "";
											$ar1= explode(";",$row);
											foreach($ar1 as $e1){
												$ar2= explode(":",$e1);
												foreach($ar2 as $ind2=>$e2){
													if (strpos($e2,"year")===false){
													}else{
																	$cayear= $ar2[$ind2+1];
													}
													if (strpos($e2,"execcasenumber")===false){
													}else{
																	$caseri= $ar2[$ind2+1];
													}
												}
											}
																	$caseri= $caseri +0;
																	//$cayear= $cayear +0;
//						$arelem[1]= "xxxx";
						$arelem[1]= "$caseri/$cayear";
											$roda= $DB->selectRow($quda  ,$caseri,$cayear);
//print_rr($roda);
						$arelem[2]= $roda["name"];
						$arelem[3]= $roda["id"];
				}else{
				}
								$arresu[]= $arelem;
		}
	}
return $arresu;
}


?>