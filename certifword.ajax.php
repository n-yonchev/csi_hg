<?php
# извеждане на удостоверение за вписване 
# отгоре : 
#    $mode= режима в глав.меню 
#    $page= текущата страница от списъка 
# управляващ : 
#    $word - молбата за удостоверение docu.id, удостоверението е в aadocucert 
//print_r($GETPARAM);
//print "[$mode][$page][$princert]";

									session_start();
									include_once "common.php";

# данните 
$myquery= getcertqu() ." where iddocu=$word";
$data= $DB->select($myquery);
//$data= tran1251($data);
//print_rr($data);

# основни данни 
$rooffi= getofficerow(0);
$rooffi= toutf8($rooffi);
//print_rr($rooffi);

/*
# отговора 
$certdata= $_SESSION["REGICERTIF"];
//print_rr($certdata);
unset($_SESSION["REGICERTIF"]);
*/
# отговора 
$certdata=  unserialize($data[0]["response"]);
//$smarty->assign("QURESU", tran1251($response["QueryResult"]));
# шаблона 
$namecert= "outgoing/REGI.xml";
$contcert= file_get_contents($namecert);

# заместваме 
$artags["REGISHORT"]= $rooffi["shortname"];
$artags["REGINUMB"]= $rooffi["serial"];
$artags["REGIZONE"]= $rooffi["region"];
$artags["REGIADDR"]= $rooffi["address"];

$artags["REGIOUTNUMB"]= $data[0]["seriout"];
$artags["REGIOUTDATE"]= bgdatefrom($data[0]["dateout"]);

$artags["REGIPERS"]= $data[0]["adresat"];
$artags["REGIIDEN"]= $data[0]["param"];

$artags["REGICURRTIME"]= $certdata["created_at"];
$artags["REGITOTALCOUNT"]= number_format($certdata["execcasetotalcount"]  ,0,".",",");
									include_once "SLOVOM.php";
		$slov= slovom($certdata["execcasetotalcount"] ,0);
		$slov= substr($slov,0,strlen($slov)-12);
		$slov= toutf8($slov);
$artags["REGISLOVOM"]= $slov;
		$reginu= $DB->selectCell("select count(*) from aadocucert where id<?d"  ,$data[0]["idcert"]);
$artags["REGICERTNUMB"]= $reginu +1;
//$artags["REGICERTNUMB"]= $data[0]["idcert"];
//print_rr($artags);

			$ar1= array();
			$ar2= array();
foreach($artags as $taco=>$tant){
//	$contcert= str_replace($taco,$tant,$contcert);
			$ar1[]= $taco;
			$ar2[]= $tant;
}
$contcert= str_replace($ar1,$ar2,$contcert);

	$beg1= "BEGAAA";
	$end1= "ENDAAA";
	$beg2= "BEGBBB";
	$end2= "ENDBBB";
$arcase= $certdata["QueryResult"];
//print_rr($arcase);
////////$arcase= array();
$c1= $contcert;
if (count($arcase)==0){
	$c1= preg_replace("/$beg2(.*)$end2/si", "", $c1);
	$c1= str_replace($beg1,"",$c1);
	$c1= str_replace($end1,"",$c1);
}else{
	$c1= preg_replace("/$beg1(.*)$end1/si", "", $c1);
	$c1= str_replace($beg2,"",$c1);
	$c1= str_replace($end2,"",$c1);
		$trow= gettrow($c1,"<w:tr>","</w:tr>","CASEAA");
//var_dump($trow);
				$realcont= "";
		foreach($arcase as $caelem){
			$mytrow= $trow;
			$mytrow= str_replace("CASEAA",$caelem["enforcerdesc"],$mytrow);
			$mytrow= str_replace("CASEBB",$caelem["execcasefullnumber"],$mytrow);
			$mytrow= str_replace("CASECC",$caelem["persondesc"],$mytrow);
			$mytrow= str_replace("CASEDD",$caelem["caseoriginsdesc"],$mytrow);
				$realcont .= $mytrow;
		}
	$c1= str_replace($trow,$realcont,$c1);
}
$contcert= $c1;

# 10.05.2011 
$contcert= str_replace("\n","\r\n",$contcert);
$contcert= stripslashes($contcert);

# изход в Word 
ExcelHeader("удостоверение.doc");
print $contcert;



function gettrow($cont,$temp1,$temp2,$sear){
			$found= false;
			$wc2= $cont;
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