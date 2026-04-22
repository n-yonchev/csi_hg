<?php
# отгоре : 
#    $edit= case.id 
//#    $zone= bill 
# управляващ : 
#    $modibill = bill.id 
# още отгоре : 
#    $modeel - стринг за базовия линк 
#    $relurl - базовия линк 
#    $robill - записа за сметката bill.id=$modibill 
//print "modibill=A=[$modibill]";
//$idel= $GETPARAM["idel"];
//print "correction [$edit][$zone][$modibill]";
//print_rr($_POST);
//print_rr($GETPARAM);

# резултатни полета 
$resufiel= array();
$resufiel[1]= "taxprop";
$resufiel[2]= "taxregu";
$resufiel[3]= "taxaddi";

//# таблицата 
//$taname= "bill";
# шаблона 
$tpname= "cazobillmodi.ajax.tpl";
# линк за redirect 
/*
				if (isset($zone)){
$redilink= array("tbilllink");
$smarty->assign("URLREFRESH", $redilink[0]);
				}else{
				}
*/
/*
# reload - след успешен събмит 
$basepara= "mode=".$mode."&year=".$year."&page=".$page;
			if (isset($filtcase)){
$basepara= $basepara .= "&filtcase=".$filtcase;
			}else{
			}
$relurl= geturl($basepara);
*/
# данните 
$smarty->assign("ROBILL", $robill);
//print_rr($robill);

# дефиниции на сметките 
//unset($_SESSION["billgrou"]);
if (isset($_SESSION["billgrou"]) and isset($_SESSION["billdefi"])){
}else{
	list($argrou,$ardefi)= getbill();
	$_SESSION["billgrou"]= $argrou;
	$_SESSION["billdefi"]= $ardefi;
}
//print_rr($_SESSION["billgrou"]);
//print_rr($_SESSION["billdefi"]);

# дефиниции на шаблоните на сметките 
if (isset($_SESSION["tempgrou"]) and isset($_SESSION["tempdefi"])){
}else{
	list($argroutemp,$ardefitemp)= gettemp();
	$argroutemp= array(0=>"") + $argroutemp;
	$_SESSION["tempgrou"]= $argroutemp;
	$_SESSION["tempdefi"]= $ardefitemp;
}
$argroutemp= $_SESSION["tempgrou"];
$smarty->assign("ARTEMP", "argroutemp");
//print_rr($_SESSION["tempgrou"]);
//print_rr($_SESSION["tempdefi"]);

						# евентуално изтриване 
						$deleelem= $GETPARAM["deleelem"];
						if (isset($deleelem)){
//							include_once "cazoevendele.ajax.php";
//exit;
$DB->query("delete from billelem where id=?d"  ,$deleelem);
		$topart2= true;
		$mfacproc=="=NOT=";
														$flagpaid= true;
//# корегираме основните данни за сметката 
//updapaid($modibill);
						}else{
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
//print_rr($_POST);

														//if ($GETPARAM["topart2"]=="yes"){
														//}else{
								
								if (0){
//								}elseif(isset($_POST["submit"]) or $mfacproc=="INIT"){
//#--------- корекция на сметка ---------------------------------------------
//include_once "cazobillmo1.inc.php";
								}elseif($mfacproc=="INIT"){
		# четем основ.данни, източник : cazobillmo1.inc.php 
		$rocont= $DB->selectRow("select * from bill where id=?" ,$modibill);
		$rocont= arstrip($rocont);
		$_POST= $rocont;
		$_POST["date"]= bgdatefrom($rocont["date"]);
/***
		# основните данни, източник : cazobillmo1.inc.php 
		$_POST= $robill;
//		$_POST["date"]= bgdatefrom($robill["date"]);
***/
									if ($GETPARAM["topart2"]=="yes"){
/*
		# четем основ.данни, източник : cazobillmo1.inc.php 
		$rocont= $DB->selectRow("select * from bill where id=?" ,$modibill);
		$rocont= arstrip($rocont);
		$_POST= $rocont;
		$_POST["date"]= bgdatefrom($rocont["date"]);
*/
#--------- корекция на ред от сметка ---------------------------------------------
include_once "cazobillmo2.inc.php";
		$topart2= true;
									}else{
#--------- корекция основни данни на сметка ---------------------------------------------
include_once "cazobillmo1.inc.php";
									}
								}elseif(isset($_POST["submit"])){
#--------- корекция основни данни на сметка ---------------------------------------------
include_once "cazobillmo1.inc.php";
								}elseif(isset($_POST["subm2"])){
#--------- корекция на ред от сметка ---------------------------------------------
include_once "cazobillmo2.inc.php";
		$topart2= true;
														$flagpaid= true;
								}elseif(isset($_POST["subm4"])){
#--------- запиши платена сума по сметка ---------------------------------------------
include_once "cazobillmo2.inc.php";
		$topart2= true;
								}elseif(isset($_POST["submmove"])){
#--------- преместване на ред ---------------------------------------------
include_once "cazobillmo3.inc.php";
		$topart2= true;
//								}elseif(isset($_POST["submit"]) or $mfacproc=="INIT"){
//#--------- корекция на сметка ---------------------------------------------
//include_once "cazobillmo1.inc.php";
								}else{
die("cazobillmodi=1");
								}
														//}
			# общи данни 
			$ar2= getsumabill("billelem.idbill=$modibill");
			$suma= $ar2[$modibill]["suma"];
			$svat= $ar2[$modibill]["svat"];
			$stot= $suma - $svat;
# кредитни известия 
if ($suma<0){
	$suma= -$suma;
	$svat= -$svat;
	$stot= -$stot;
}else{
}
		$smarty->assign("ARSUMA", array("suma"=>$suma, "svat"=>$svat, "stot"=>$stot));
					# при празна платена сума в данните 
					if($mfacproc=="INIT" and $robill["paid"]+0==0){
														$flagpaid= true;
					}else{
					}

														# нова платена сума 
														if ($flagpaid){
											$_POST["paid"]= $suma;
														}else{
														}

	# списък на редовете 
								if ($modibill==0){
								}else{
	$mylist= $DB->select("select billelem.* ,billelem.id as id
		from billelem
		where billelem.idbill=?d
		order by billelem.level, billelem.id
		"  ,$modibill);
	$mylist= dbconv($mylist);
# трансформираме списъка - параметри за иконите 
///////////////$modeel= "edit=$edit&zone=$zone&modibill=$modibill";
//////$modeel= "mode=$mode&edit=$edit&zone=$zone&modibill=$modibill";
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
	$mylist[$uskey]["deleelem"]= geturl($modeel."&modibill=".$modibill."&deleelem=".$idcurr);
//	$mylist[$uskey]["deleelem"]= geturl($basepara."&deleelem=".$idcurr);
}
$smarty->assign("LISTELEM", $mylist);
//var_dump($modibill);
//print_rr($mylist);
								}
	
				/*
						# за избор на взискател - четем списъка по делото 
						$arclai= getselect("claimer","name","idcase=$edit",true);
						# предаваме името на масива 
						$smarty->assign("ARCLAINAME", "arclai");
				*/
						# за избор на взискател/длъжник - четем заедно с данните 
						$codelist= "id, egn, bulstat, name, address";
						$arclai= $DB->select("select $codelist from claimer where idcase=$edit");
							$arclai= arstrip($arclai);
						$ardebt= $DB->select("select $codelist from debtor where idcase=$edit");
							$ardebt= arstrip($ardebt);
									$arnameclai= array();
											$arnamedata= array();
											$arnamedata[""]= "^^^^^^^^";
						tranlist($arclai,"c","arnameclai");
									$arnamedebt= array();
						tranlist($ardebt,"d","arnamedebt");
//print_rr($arnamedata);
						$arnamedata= tran1251($arnamedata);
											$smarty->assign("ARNAMEDATA", $arnamedata);
//print_rr(toutf8($arnamedata));
						$arname= array(""=>"");
						$arname[toutf8("взискатели")]= $arnameclai;
						$arname[toutf8("длъжници")]= $arnamedebt;
						# предаваме името на масива 
						$smarty->assign("ARNAME", "arname");

	# дефиниции на сметките 
//	list($argrou,$ardefi)= getbill();
	$argrou= $_SESSION["billgrou"];
	$ardefi= $_SESSION["billdefi"];
	# select/option 2 нива 
			$arbilltype= array(""=>"");
	foreach($ardefi as $defiindx=>$deficont){
		$pref= substr($defiindx,0,1);
		$txpref= $argrou[$pref];
//			$arbilltype[$txpref][$defiindx]= $deficont["txdesc"];
/*
		$worddesc= wordwrap($deficont["txdesc"],170,"^");
		$ar2= explode("^",$worddesc);
//			$arbilltype[$txpref][$defiindx]= $ar2[0];
			$arbilltype[$txpref][$defiindx]= $deficont["txgrou"] ." " .$ar2[0];
*/
			//$arbilltype[$txpref][$defiindx]= $deficont["txgrou"] ." " .$deficont["txdesc"];
# 28.02.2014 - скъсяване заради select/option 
			////////$arbilltype[$txpref][$defiindx]= $deficont["txgrou"] ." " .$deficont["txdesc"];
			$arbilltype[$txpref][$defiindx]= mb_substr($deficont["txgrou"] ." " .$deficont["txdesc"] ,0,130,"UTF-8");
	}
//print_rr($arbilltype);
						# за избор на тип на евент. нов ред 
						$smarty->assign("ARTYPENAME", "arbilltype");
	$smarty->assign("MODIBILL",$modibill);
//print_rr($arbilltype);

# линк за redirect 
$smarty->assign("URLREFRESH", $modeel);
//$smarty->assign("URLREFRESH", $basepara);
								
								if(isset($_POST["subm4"]) and empty($lister)){
//								if(isset($_POST["subm4"])){
# корегираме основните данни за сметката 
updapaid($modibill);
# рефреш 
reload("parent",geturl($modeel));
								}else{
								}

							# за избор на касиер 
							$userlist= getselect("user","name","1",true);
							$smarty->assign("USERLISTNAME", "userlist");
	# извеждаме формата 
	$smarty->assign("EDIT", $modibill);
	$smarty->assign("FILIST", $filist);
//print "SMARTY-2=";
//print_rr($smarty->get_template_vars());
							//if ($topart2 or $GETPARAM["topart2"]=="yes"){
							if ($topart2){
$smarty->assign("TOGGPARA",2);
							}else{
							}
										#++++++++++++++++++++++++++++++++++
										$arcrea= array();
										//$arcrea[1]= "само фактура";
										$arcrea[2]= "само сметка";
										$arcrea[3]= "фактура и сметка";
										//$arcrea_utf8= toutf8($arcrea);
										//$smarty->assign("ARCREANAME", "arcrea_utf8");
										$smarty->assign("ARCREA", $arcrea);
	print smdisp($tpname,"iconv");
//}


function tranlist($arcont,$letter,$nameresu){
global $arnamedata;
global ${$nameresu};
	foreach($arcont as $elem){
		$cuin= $letter.$elem["id"];
		$addr= str_replace(array("\r","\n"),array(" "," "),$elem["address"]);
				${$nameresu}[$cuin]= $elem["name"];
						$arnamedata[$cuin]= $elem["egn"]."^".$elem["bulstat"]
//						."^".addslashes(addslashes($elem["name"]))."^".addslashes(addslashes($addr));
						."^".addslashes(trandoqu($elem["name"]))."^".addslashes(trandoqu($addr));
	}
}

function trandoqu($p1){
return str_replace('"','\"',$p1);
}


?>