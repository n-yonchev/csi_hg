<?php

# четем основните данни за ЧСИ 
$rooffi= getofficerow($iduser);
										include_once "invo2.inc.php";

//function invoprin($invobillprin,$invotext){
function invoprin($invobillprin){
global $DB;
global $arinvotype, $armeth;

#--- параметри за заместване 
# фактура 
//		$roinvo= getrow("invoice",$invobillprin);
		$roinvo= getrow("bill",$invobillprin);
		$roinvo= toutf8($roinvo);
# шаблона 
				# 29.02.2012 - флаг за ДДС 
				if ($roinvo["isvat"]==0){
					if (empty($roinvo["egn"])){
$nameinvo= "outgoing/INVO4.xml";
					}else{
$nameinvo= "outgoing/INVO2.xml";
					}
				}else{
					if (empty($roinvo["egn"])){
$nameinvo= "outgoing/INVO.xml";
					}else{
$nameinvo= "outgoing/INVO3.xml";
					}
				}

//var_dump($nameinvo);
$continvo= file_get_contents($nameinvo);

$arinvo= array();
//$arinvo["INVOTEXT"]= $invotext;
		$type= $roinvo["idinvotype"];
		$invotext= toutf8(strtoupper($arinvotype[$type]));
									# 22.01.2014 фактура за кред.известие 
									if ($type==2){
		$crtext= toutf8(" към фактура ").$roinvo["credmess"];
		$invotext .= $crtext;
									}else{
									}
$arinvo["INVOTEXT"]= $invotext;
//$arinvo["INVONUMB"]= $roinvo["serial"];
			if ($type==1){
				# номер проформа 
				$roprof= $DB->selectRow("select * from billprof where idbill=?" ,$invobillprin);
$serinumb= $roprof["seriprof"];
			}else{
$serinumb= $roinvo["seriinvo"];
			}
$arinvo["INVONUMB"]= str_pad($serinumb  ,10,"0",STR_PAD_LEFT);
//$arinvo["INVODATE"]= bgdatefrom($roinvo["date"]);
$arinvo["INVODATE"]= bgdatefrom($roinvo["dateinvo"]);
$arinvo["INVOMETH"]= $armeth[$inme=$roinvo["paidmethod"]];
# получател 
/*
$arinvo["TONAME"]= $roinvo["toname"];
$arinvo["TOEIK"]= $roinvo["toeik"];
$arinvo["TOVATEIK"]= "BG".$roinvo["toeik"];
$arinvo["TOADDR"]= $roinvo["toaddr"];
$arinvo["TOPERS"]= $roinvo["toperson"];
*/
$arinvo["TONAME"]= $roinvo["name"];
					if (empty($roinvo["egn"])){
$arinvo["TOEIK"]= $roinvo["eik"];
					}else{
$arinvo["TOEIK"]= $roinvo["egn"];
					}
					if (empty($roinvo["egn"])){
$arinvo["TOVATEIK"]= "BG".$arinvo["TOEIK"];
					}else{
$arinvo["TOVATEIK"]= "";
					}
$arinvo["TOADDR"]= $roinvo["address"];
$arinvo["TOPERS"]= $roinvo["toperson"];
# доставчик 
		$rooffi= getofficerow(0);
		$rooffi= toutf8($rooffi);
$arinvo["FROMNAME"]= $rooffi["shortname"];
$arinvo["FROMEIK"]= $rooffi["bulstat"];
$arinvo["FROMVATEIK"]= "BG".$rooffi["bulstat"];
$arinvo["FROMPERS"]= $rooffi["invopers"];
		$billpa= unserialize($rooffi["billparams"]);
$arinvo["FROMADDR"]= $billpa["address"];
$arinvo["FROMBANK"]= $billpa["bank"];
$arinvo["FROMBIC"]= $billpa["bic"];
$arinvo["FROMIBAN"]= $billpa["iban"];
							# 16.01.2014 избор на сметка на ЧСИ като съставител 
						global $aracco;
							$iban= $roinvo["iban"];
							if (empty($iban) or $iban==$billpa["iban"]){
							}else{
$arinvo["FROMIBAN"]= $iban;
$arinvo["FROMBANK"]= $aracco[$iban]["bank"];
$arinvo["FROMBIC"]= $aracco[$iban]["bic"];
							}
							# 16.01.2014 извеждане на длъжника 
							$isdebtor= ($roinvo["isdebtor"]<>0);
							if ($isdebtor){
$idcase= $roinvo["idcase"];
$rodebt= $DB->selectRow("select * from debtor where idcase=?d order by id limit 1"  ,$idcase);
$rodebt= dbconv($rodebt);
$rodebt= arstrip($rodebt);
$rocase= getrow("suit",$idcase);
$mycase= $rocase["serial"]."/".$rocase["year"];
if ($rodebt["idtype"]==1){
	$mytx= "ЕИК ".$rodebt["bulstat"];
}else{
	$mytx= "ЕГН ".$rodebt["egn"];
}
$mydebt= "длъжник ".$rodebt["name"]." ".$mytx." изп.дело ".$mycase;
$arinvo["DEBTOR"]= toutf8($mydebt);
							}else{
$arinvo["DEBTOR"]= "";
							}
# рекапитулация 
//if ($roinvo["idcase"]==0){
if ($roinvo["serial"]==0){
	# фактура без сметка 
	$arsuma= getsumainvo("invoelem.idbill=$invobillprin");
	$invosuma= $arsuma[$invobillprin]["suma"];
}else{
	# фактура от сметка 
	$invosuma= $DB->selectCell("
		select sum(billelem.taxprop+billelem.taxregu+billelem.taxaddi) 
		from billelem
		where billelem.idbill=?d
		"  ,$invobillprin);
//		"  ,$roinvo["idbill"]);
}
	$invosuma= round($invosuma,2);
				# 29.02.2012 - флаг за ДДС 
				if ($roinvo["isvat"]==0){
		$invovat= 0;
				}else{
		$invovat= 0.2 * $invosuma;
	$invovat= round($invovat,2);
				}
		$invotota= $invosuma + $invovat;
	$invotota= round($invotota,2);
	$arinvo["SUMA"]= number_format($invosuma ,2,".",",");
	$arinvo["VAT"]= number_format($invovat ,2,".",",");
	$arinvo["TOTAL"]= number_format($invotota ,2,".",",");
# редове 
//		$robill= getrow("bill",$roinvo["idbill"]);
//$idbill= $roinvo["idbill"];
$idbill= $invobillprin;
//var_dump($idbill);
//if ($idbill==0){
//if ($roinvo["idcase"]==0){
if ($roinvo["serial"]==0){
		# фактура без сметка - много редове 
		# източник : certifword.ajax.php - извеждане на удостоверение за вписване 
	$c1= $continvo;
//		$trow= gettrow($c1,"<w:tr>","</w:tr>","RN");
		$trow= gettrow($c1,"<w:tr","</w:tr>","RN");
//var_dump($trow);
				$realcont= "";
		$arelem= $DB->select("select * from invoelem where idbill=?d order by id"  ,$invobillprin);
//		$arelem= dbconv($arelem);
//print_rr($arelem);
						$cunu= 0;
						$invosuma= 0;
		foreach($arelem as $elem){
//print_rr($elem);
			$mytrow= $trow;
						$cunu ++;
			$mytrow= str_replace("RN",$cunu,$mytrow);
			$mytrow= str_replace("RDESC",$elem["descrip"],$mytrow);
			$mytrow= str_replace("RDIMM",$elem["meas"],$mytrow);
					$quan= $elem["quan"];
//					$quan= number_format($quan,2  ,".",",");
			$mytrow= str_replace("RQUAN",$quan,$mytrow);
					$pric= $elem["price"];
					$xxpric= number_format($pric,2  ,".",",");
			$mytrow= str_replace("RPRICE",$xxpric,$mytrow);
					$amou= $quan * $pric;
					$xxamou= number_format($amou,2  ,".",",");
			$mytrow= str_replace("RAMOU",$xxamou,$mytrow);
				$realcont .= $mytrow;
						$invosuma += $amou;
		}
	$c1= str_replace($trow,$realcont,$c1);
	$continvo= $c1;
	$arinvo["SUMA"]= number_format($invosuma ,2,".",",");
				# 29.02.2012 - флаг за ДДС 
				if ($roinvo["isvat"]==0){
						$invovat= 0;
				}else{
						$invovat= 0.2 * $invosuma;
				}
	$arinvo["VAT"]= number_format($invovat ,2,".",",");
						$invotota= $invosuma + $invovat;
	$arinvo["TOTAL"]= number_format($invotota ,2,".",",");
}else{
		# фактура от сметка - всички редове от сметката 
//$desc= sprintf($tempdesc ,$robill["serial"] ,bgdatefrom($robill["date"]) ,getfullnumb($rocase));
		$robill= getrow("bill",$idbill);
		$rocase= getrow("suit",$robill["idcase"]);
				$tempdimm= "бр.";
				$tempquan= "1";
				$tempdesc= " - %s от ТТР по изп.дело " .getfullnumb($rocase);
		$arelem= $DB->select("select billelem.* ,billelem.id as id
			from billelem
			where billelem.idbill=?d
			order by billelem.level, billelem.id
			"  ,$idbill);
		$arelem= dbconv($arelem);
		# източник : certifword.ajax.php - извеждане на удостоверение за вписване 
	$c1= $continvo;
//		$trow= gettrow($c1,"<w:tr>","</w:tr>","RN");
		$trow= gettrow($c1,"<w:tr","</w:tr>","RN");
//var_dump($trow);
				$realcont= "";
//		$arelem= $DB->select("select * from invoelem where idinvoice=?d"  ,$invobillprin);
//		$arelem= dbconv($arelem);
//print_rr($arelem);
						$cunu= 0;
						$invosuma= 0;
		foreach($arelem as $elem){
//print_rr($elem);
			$mytrow= $trow;
						$cunu ++;
			$mytrow= str_replace("RN",$cunu,$mytrow);
						$mydesc= $elem["action"];
						$mydesc .= sprintf($tempdesc ,$elem["ground"]);
			$mytrow= str_replace("RDESC",$mydesc,$mytrow);
			$mytrow= str_replace("RDIMM",$tempdimm,$mytrow);
					$quan= $tempquan;
			$mytrow= str_replace("RQUAN",$quan,$mytrow);
					$pric= $elem["taxprop"]+$elem["taxregu"]+$elem["taxaddi"];
					$xxpric= number_format($pric,2  ,".",",");
			$mytrow= str_replace("RPRICE",$xxpric,$mytrow);
					$amou= $quan * $pric;
					$xxamou= number_format($amou,2  ,".",",");
			$mytrow= str_replace("RAMOU",$xxamou,$mytrow);
				$realcont .= toutf8($mytrow);
						$invosuma += $amou;
		}
	$c1= str_replace($trow,$realcont,$c1);
	$continvo= $c1;
	$arinvo["SUMA"]= number_format($invosuma ,2,".",",");
				# 29.02.2012 - флаг за ДДС 
				if ($roinvo["isvat"]==0){
						$invovat= 0;
				}else{
						$invovat= 0.2 * $invosuma;
				}
	$arinvo["VAT"]= number_format($invovat ,2,".",",");
						$invotota= $invosuma + $invovat;
	$arinvo["TOTAL"]= number_format($invotota ,2,".",",");
}

# словом 
					include_once "SLOVOM.php";
	$myslov= number_format($invotota,2,".","");
	list($c1,$c2)= explode(".",$myslov);
	if(strtotime($roinvo['date']) < strtotime('2026-01-01')) {
		$slovom= slovom($c1,$c2, ' лева и ', 'ст.');
	} else {
		$slovom= slovom($c1,$c2);
	}
	$slovom= toutf8($slovom);
$arinvo["TEXTTO"]= $slovom;
	$myslov= number_format($invovat,2,".","");
	list($c1,$c2)= explode(".",$myslov);
	if(strtotime($roinvo['date']) < strtotime('2026-01-01')) {
		$slovom= slovom($c1,$c2, ' лева и ', 'ст.');
	} else {
		$slovom= slovom($c1,$c2);
	}
	$slovom= toutf8($slovom);
$arinvo["TEXTVA"]= $slovom;

# заместваме 
			$ar1= array();
			$ar2= array();
foreach($arinvo as $taco=>$tant){
			$ar1[]= $taco;
			$ar2[]= $tant;
}
$continvo= str_replace($ar1,$ar2,$continvo);

# специална трансформация 
$continvo= str_replace("\n","\r\n",$continvo);
$continvo= stripslashes($continvo);

return $continvo;
}


function gettrow($cont,$temp1,$temp2,$sear){
			$found= false;
			$wc2= $cont;
//print "<br><br><xmp>$wc2</xmp>";
	while(true){
		$p1= strpos($wc2,$temp1);
//var_dump($p1);
		if ($p1===false){
			break;
		}else{
			$wc2= substr($wc2,$p1);
			$p2= strpos($wc2,$temp2);
			if ($p2===false){
die("trow=1=$p1");
			}else{
				$mywc= substr($wc2,0,$p2);
//print "<br><br><xmp>$mywc</xmp>";
				$mypos= strpos($mywc,$sear);
				if ($mypos===false){
					$wc2= substr($wc2,$p2+strlen($temp2));
				}else{
$temptr= substr($wc2,0,$p2+strlen($temp2));
$found= true;
					break;
				}
			}
		}
	}
	if ($found){
	}else{
die("trow=2");
	}
//return toutf8($temptr);
return $temptr;
}

?>