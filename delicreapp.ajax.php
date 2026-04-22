<?php
# отгоре : 
//#    $modeel - стринг с параметрите 
# параметър : 
#    $creapp - post.id - екземпляр, за който се създава придружит.писмо 
# още : 
#    $relurl - след успешен събмит 
#    $_POST_TYPE_2 - флаг - начално състояние за връчване е призовкар 
//print_ru($GETPARAM);
//var_dump($creapp);
//print_rr($_POST);
//print "[$cutabl][$cucode]";


# полетата 
$filist= array(
	"idrs"=> array("validator"=>"notzero", "error"=>"съда е задължително поле")
	, "date"=> array("validator"=>"bgdate_valid_notempty")
);
//# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page);
						
									# класа за редактиране 
									include_once "edit.class.php";

#----------------- директно редактиране -----------------------

# осн.данни 
$ropost= getrow("post",$creapp);
$iddocuout= $ropost["iddocuout"];
//print_rr(toutf8($ropost));

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
//print_rr($_POST);

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
		# екземпляр 
/*
		list($tacode,$idtana)= explode("^",$creapp);
			$tayear= substr($tacode,0,2);
			$taquar= substr($tacode,2,1);
			$tana= $tapref."20".$tayear."_".$taquar;
		$ro3mon= getrow($tana,$idtana);
//var_dump($_POST_TYPE_2);
//print_ru($ro3mon);
		$idposttype= $ro3mon["idposttype"];
*/
		# начално състояние - избор районен съд 
//			$iddocuout= $ropost["iddocuout"];
			$idrs= $DB->selectCell("
				select suit.idcofrom
				from docuout
					left join suit on docuout.idcase=suit.id
				where docuout.id=?d
				"  ,$iddocuout);
		$_POST["idrs"]= $idrs;
		# начално състояние - метод за придруж.писмо 
		$_POST["idmeth"]= ($_POST_TYPE_2) ? 2 : 1;
		# начално състояние - дата на връчване 
			$date2= $ropost["date2"];
			if (empty($date2)){
				$date2po= "";
			}else{
				$date2po= bgdatefrom($date2);
			}
		$_POST["date"]= $date2po;
		# начално състояние - длъжник и адрес - от ПДИ 
		$_POST["adresat"]= toutf8($ropost["adresat"]);
//		$_POST["address"]= toutf8($ropost["address"]);
		# записа за длъжника 
		$idde4= $DB->selectCell("select tagcont from postrepl where iddocuout=?d and tag=?"  ,$iddocuout,"debtorid");
		if (empty($idde4)){
			$ro4dout= getrow("docuout",$iddocuout);
			$ro4debt= $DB->selectRow("
				select *
				from debtor
				where idcase=?d
				limit 1
				"  ,$ro4dout["idcase"]);
//var_dump($iddocuout);
//print_rr($ro4debt);
			$ro4debt= dbconv($ro4debt);
		}else{
//			$ro4debt= $DB->selectRow("select * from debtor where id=?d"  ,$idde4);
			$ro4debt= getrow("debtor",$idde4);
		}
		# начално състояние - данни за длъжника - ЕГН/ЕИК и адрес 
		$ro4debt= arstrip($ro4debt);
			$idtype3= $ro4debt["idtype"];
			$egn3= $ro4debt["egn"];
			$eik3= $ro4debt["bulstat"];
		$addr3= $ropost["address"];
		if ($idtype3==2){
			$txde3= "ЕГН ".$egn3." и адрес ".$addr3;
		}else{
			$txde3= "ЕИК ".$eik3." със седалище и адрес на управление ".$addr3;
		}
		$_POST["debtdata"]= toutf8($txde3);
/*
		$idde4= $DB->selectCell("select tagcont from postrepl where iddocuout=?d and tag=?"  ,$iddocuout,"debtorid");
		if (empty($idde4)){
		}else{
			$ro4dout= getrow("docuout",$iddocuout);
			$idde4= $DB->selectCell("
				select id
				from debtor
				where idcase=?d
				limit 1
				"  ,$ro4dout["idcase"]);
		}
		$ro4debt= getrow("debtor",$idde4);
		$id4type= $ro4debt["idtype"];
*/
/*
		# начално състояние - данни за длъжника 
		$idde4= $DB->selectCell("select tagcont from postrepl where iddocuout=?d and tag=?"  ,$iddocuout,"debtorid");
		if (empty($idde4)){
			$ro4dout= getrow("docuout",$iddocuout);
			$ro4debt= $DB->selectCell("
				select id
				from debtor
				where idcase=?d
				limit 1
				"  ,$ro4dout["idcase"]);
		}else{
			$ro4debt= $DB->selectRow("select * from debtor where id=?d"  ,$idde4);
		}
		$d4data= getdebtdata($idde4);
		$_POST["debtdata"]= $d4data;
*/

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;

#------ submit с формални грешки 
}elseif ($mfacproc==NULL){
							$retucode= 1;
	doerrors();

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
					# формираме 
//					include_once "bpcreapp.inc.php";
					bpcreapp($creapp);
	# redirect 
	reload("parent",$relurl);
}else{
										# за избор на съд 
										//$arrs= getselect("cofrom","name","idtype=0",true);
										$mark= toutf8("райо");
										$arrs= $DB->selectCol("
											select id as ARRAY_KEY, name
											from cofrom
											where lower(name) like '%$mark%'
											order by serial
											");
										$smarty->assign("ARRSNAME", "arrs");
						/***
						# за избор на длъжник 
						$rodout= getrow("docuout",$iddocuout);
//print_ru($rodout);
							$idcase= $rodout["idcase"];
						//$rocase= getrow("suit",$idcase);
						$ardebt= getselect("debtor","name","idcase=$idcase",false);
						$ardebt= arstrip($ardebt);
//print_rr($ardebt);
							if (count($ardebt)>1){
										//$smarty->assign("ARDEBT", "ardebt");
										$smarty->assign("ARDEBT", tran1251($ardebt));
		# начално състояние - избор длъжник 
		if ($mfacproc=="INIT"){
//print_ru($ro3mon);
//print_rr($ardebt);
//			$idd3= array_search($ro3mon["adresat"],tran1251($ardebt));
			$idd3= array_search($ropost["adresat"],tran1251($ardebt));
			if ($idd3===false){
				$ak= array_keys($ardebt);
				$_POST["iddebt"]= $ak[0];
			}else{
				$_POST["iddebt"]= $idd3;
			}
		}else{
		}
							}else{
								$akey= array_keys($ardebt);
								$iddebt= $akey[0];
										$smarty->assign("IDDEBT", $iddebt);
							}
							***/

	# извеждаме формата 
//	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
	print smdisp("delicreapp.ajax.tpl","iconv");
}




# формира придруж.писмо 
function bpcreapp($idpost){
global $DB;
//var_dump($codetael);
	# основни данни 
	$roof= getofficerow(0);
	$e_seri= $roof["serial"];
	$e_regi= $roof["region"];
	$e_name= $roof["shortname"];
	$e_addr= $roof["address"];
	# от формата 
		$idrs= $_POST["idrs"];
	$rors= getrow("cofrom",$idrs);
					$rs_name= $rors["name"];
					$rs_addr= $rors["address"];
					$rs_city= $rors["city"];
		$isboss= isset($_POST["isboss"]);
					$text_boss= ($isboss) ? "чрез работодателя" : "";
					$data_deli= $_POST["date"];
/***
		$iddebt= $_POST["iddebt"];
	$rodebt= getrow("debtor",$iddebt);
	$rodebt= arstrip($rodebt);
print_ru($_POST);
print_ru($rodebt);
die("RRRRRRRRRRRRRRRRRRR");
		$idtype3= $rodebt["idtype"];
//		$address3= $rodebt["address"];
		$egn3= $rodebt["egn"];
		$eik3= $rodebt["bulstat"];
***/
									# метод за връчване на ПП 
									$idmeth= $_POST["idmeth"];
	# осн.запис - екземпляр ПДИ 
/*
global $tapref;
	list($tacode,$idtana)= explode("^",$codetael);
		$tayear= substr($tacode,0,2);
		$taquar= substr($tacode,2,1);
		$tana= $tapref."20".$tayear."_".$taquar;
	$ro3mon= getrow($tana,$idtana);
	$ro3mon= arstrip($ro3mon);
//print_ru($ro3mon);
		$asat3= $ro3mon["adresat"];
		$addr3= $ro3mon["address"];
*/
/***
		$ropost= getrow("post",$idpost);
		$ropost= arstrip($ropost);
//print_ru($ropost);
		$asat3= $ropost["adresat"];
		$addr3= $ropost["address"];
					if ($idtype3==2){
						$txde3= " с ЕГН ".$egn3." и адрес ".$addr3;
					}else{
						$txde3= " с ЕИК ".$eik3." със седалище и адрес на управление ".$addr3.",";
					}
//var_dump($idtype3,$adresat,toutf8($txde3));
//die("RRRRRRRRRRRRRRRRRRR");
					$adresat= $asat3.$txde3;
//var_dump(toutf8($asat3),toutf8($txde3));
//var_dump(toutf8($adresat));
//die("TTTTTTTTTTTTTTTTT");
***/
					# адресат за съдържанието на придр.писмо 
					$adresat= $_POST["adresat"] .toutf8(" с ") .$_POST["debtdata"];
					$adresat= tran1251($adresat);
					/*
					$addr6= $_POST["address"];
					$data6= $_POST["debtdata"];
					$adresat= $addr6 .toutf8(" с ") .$data6;
					*/
	# изх.документ [ПДИ] 
global $iddocuout;
					//$iddout= $ro3mon["iddocuout"];
	$rodout= getrow("docuout",$iddocuout);
//print_ru($rodout);
		$ouseri= $rodout["serial"];
		//$ouyear= $rodout["year"];
		$ouregi= bgdatefrom(substr($rodout["registered"],0,10));
					$pdi_nomgod= $ouseri."/".$ouregi;
	# изп.дело 
					$idcase= $rodout["idcase"];
	$rocase= getrow("suit",$idcase);
//print_ru($rocase);
					$codefull= getfullnumb($rocase);
global $listsort;
//print_ru($listsort);
		$idsort= $rocase["idsort"];
		$cogrou= $rocase["cogrou"];
					$rs_delo= $listsort[$idsort]." ".$rocase["conome"]."/".$rocase["coyear"]." г.";
					if (empty($cogrou)){
					}else{
						$rs_delo .= " състав ".$cogrou;
					}
	# 1) нов запис изх.документ - придр.писмо ПП 
											//$DB->query("lock tables docuout write");
			$aset= array();
//print "WWWWWWWWWWWWWWWWWWWWWW";
	$aset["serial"]= getnextout();
//print "/BBBBBBBBBBBBBBBBBBB";
	$aset["year"]= (int) date("Y");
					//$izh_nom= $aset["serial"]."/".$aset["year"];
					$izh_nom= $aset["serial"]."/".date("d.m.Y");
	$aset["idcase"]= $idcase;
//global $bpidtypepp;
//	$aset["iddocutype"]= $bpidtypepp;
					$iddocutype= $DB->selectCell("select id from docutype where mark='pprs'");
	$aset["iddocutype"]= $iddocutype;
	$aset["adresat"]= $rs_name;
					$pptext= "придр.писмо за ПДИ ".$pdi_nomgod;
	$aset["notes"]= $pptext;
	$aset["descrip"]= $pptext;
	$aset["iduserregi"]= $_SESSION["iduser"];
$aset= toutf8($aset);
			$iddocuout= $DB->query("insert into docuout set ?a, created=now(), registered=now()"  ,$aset);
											//$DB->query("unlock tables");
	# заместване 
	$art1= array("_DELO_NOMER_","_IZH_NOMDATA_","_RS_IME_","_RS_ADRES_","_RS_DELO_","_PDI_NOMGOD_","_TEXT_BOSS_","_DATA_DELI_","_ADRESAT_");
	$art2= array($codefull     ,$izh_nom       ,$rs_name  ,$rs_addr    ,$rs_delo   ,$pdi_nomgod   ,$text_boss   ,$data_deli   ,$adresat   );
$art2= toutf8($art2);
	$art3= array("_C_NOM_","_C_RAI_","_C_NAM_","_C_ADR_");
	$art4= array($e_seri  ,$e_regi  ,$e_name  ,$e_addr  );
$art4= toutf8($art4);
//print_rr($art2);
//die("CCCCCCCCCCCCCCCCC");
	# файла с новия изх.документ - придр.писмо ПП 
					$cotemp= file_get_contents("outgoing/pprs.xml");
	$cont= str_replace($art1,$art2,$cotemp);
	$cont= str_replace($art3,$art4,$cont);
					file_put_contents("docs/$iddocuout.doc",$cont);
	# 2) нов екземпляр за връчване 
//global $cutabl;
			$dset= array();
	$dset["iduser"]= $_SESSION["iduser"];
	$dset["iddocuout"]= $iddocuout;
//	$dset["idposttype"]= 1;
	$dset["idposttype"]= $idmeth;
	$dset["adresat"]= $rs_name;
	$dset["address"]= $rs_city." ".$rs_addr;
			$dset["idposttype"]= $_POST["idmeth"];
$dset= toutf8($dset);
											$DB->query("lock tables post write");
//			$taid= $DB->query("insert into post set ?a, created=now()"  ,$dset);
			$taid= postinse($dset);
//print "/HHHHHHHHHHHHHHH";
	# обратна връзка - указател от основния документ ПДИ 
global $creapp;
//	$DB->query("update post set idpp=$taid where id=?d"  ,$creapp);
				$oset= array("idpp"=>$taid);
			postupda($oset,$creapp);
											$DB->query("unlock tables");
}

/*
function getdebtdata($iddebt){
//global $DB;
	$rodebt= getrow("debtor",$iddebt);
//	$rodebt= $DB->selectRow("select * from debtor where id=?d"  ,$idebt);
	$rodebt= arstrip($rodebt);
		$idtype3= $rodebt["idtype"];
		$egn3= $rodebt["egn"];
		$eik3= $rodebt["bulstat"];
		$addr3= $rodebt["address"];
		if ($idtype3==2){
			$txde3= "ЕГН ".$egn3." и адрес ".$addr3;
		}else{
			$txde3= "ЕИК ".$eik3." със седалище и адрес на управление ".$addr3.",";
		}
return toutf8($txde3);
}
*/

?>