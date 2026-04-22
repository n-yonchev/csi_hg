<?php
# отгоре : 
#    $CODEFILT - код за филтъра 
#    $CODEBASE - код за $baseurl 
# $ISADD - да се добавя ли сметка/фактура за дело 
#    $rocase - записа за делото suit.id=$edit 
# $vari = year, date, case, name, type 
//var_dump($vari);
//# $year - годината, ако $vari=="year" 
//print "codefilt=[$CODEFILT]";
//print_rr($GETPARAM);


# текущата страница 
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

						# всичко за фактурата 
						include_once "invo.inc.php";

/*++++++++++++++
	# за избор на тип 
	$artypesele= toutf8($arinvotype);
//	$artypesele= array(-1=>"") + $artypesele;
	$artypesele= array(-1=>"") + $artypesele + array(9=>toutf8("сметка"));
$smarty->assign("ARTYPESELE", "artypesele");
++++++++++++++*/

/******
									# изходяване на избрания запис 
									$regi= $GETPARAM["regi"];
									if (isset($regi)){
										include "finainvoregi.ajax.php";
										exit;
									}else{
									}
******/


# reload - след успешен събмит 
$modeel= "mode=".$mode .$CODEBASE ."&page=".$page;
$relurl= geturl($modeel);
									# изтриване фактура/сметка 
									$dele= $GETPARAM["dele"];
									if (isset($dele)){
										include "finainvodele.ajax.php";
										exit;
									}else{
									}
							
							# изход в word на целия списък 
							$word= $GETPARAM["word"];
							$exce= $GETPARAM["exce"];

							# показване списък с редове на фактура без сметка 
							$view= $GETPARAM["view"];
							if (isset($view)){
								include "finainvo2.ajax.php";
								exit;
							}else{
							}
									# добавяне/корекция на самостоятелна фактура без сметка и несвързана с дело 
									$edit= $GETPARAM["edit"];
									if (isset($edit)){
										include "finainvoedit.ajax.php";
										exit;
									}else{
									}

									# отпечатване на фактура 
									$prin= $GETPARAM["prin"];
									if (isset($prin)){
										include "finainvoprin.ajax.php";
										exit;
									}else{
									}
							
							# отпечатване на сметка 
							$prinbill= $GETPARAM["prinbill"];
							if (isset($prinbill)){
								include "cazobillprin.ajax.php";
//								include "cazobp.ajax.php";
								exit;
							}else{
							}

									# корекция номер фактура 
									$seriinvoedit= $GETPARAM["seriinvoedit"];
									if (isset($seriinvoedit)){
										include "finaseriinvo.ajax.php";
										exit;
									}else{
									}
									# корекция номер сметка 
									$seribilledit= $GETPARAM["seribilledit"];
									if (isset($seribilledit)){
										include "finaseribill.ajax.php";
										exit;
									}else{
									}

									# създаване празни записи 
									$create= $GETPARAM["create"];
									if ($create=="yes"){
/*
# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&year=".$year."&page=".$page);
$modeel= "mode=".$mode .$CODEBASE ."&page=".$page;
$relurl= geturl($modeel);
*/
										include "finainvocrea.ajax.php";
										exit;
									}else{
									}
									
							# 15.05.2013 трансформиране проформа в нормална 
							$proftonorm= $GETPARAM["proftonorm"];
							if (isset($proftonorm)){
								include "finatonorm.ajax.php";
								exit;
							}else{
							}
									# корекция фактура за кред.известие 
									$editcredmess= $GETPARAM["editcredmess"];
									if (isset($editcredmess)){
										include "finacredmess.ajax.php";
										exit;
									}else{
									}
									
# запис за евент.модификация 
$modibill= $GETPARAM["modibill"];
$robill= getrow("bill",$modibill);
# делото $edit 
if (isset($filtcase)){
	$edit= $filtcase;
//	$robill= $DB->selectRow("select * from bill where idcase=?d"  ,$edit);
//	$robill= dbconv($robill);
}else{
//	$robill= getrow("bill",$modibill);
	$edit= $robill["idcase"] +0;
}
//print_rr($robill);

#------ сметка/фактура ---------------
									# модификация на избрания запис 
//									$modibill= $GETPARAM["modibill"];
									if (isset($modibill)){
/*
	$modeel= "mode=".$mode .$CODEBASE ."&page=".$page;
//var_dump($modeel);
	$relurl= geturl($modeel);
*/
										# $edit = делото suit.id 
										include "cazobillmodi.ajax.php";
										exit;
									}else{
									}

#------ корекция взискатели ---------------
							# $edit = делото suit.id 
							$claimodi= $GETPARAM["claimodi"];
							if (isset($claimodi)){
# източници : cazo3.php cazo3modi.ajax.php 
$taname= "claimer";
$tpname= "cazo34modi.ajax.tpl";
$listtext= "взискатели";
$listtext2= "взискател";
$diemess= "cazo3";
	$func= "modi";
	$idel= $claimodi;
	$typetext= "ВЗИСКАТЕЛ";
	$isclaimer= true;
$smarty->assign("TANAME", $taname);
/*
	$modeel= "mode=".$mode .$CODEBASE ."&page=".$page;
	$relurl= geturl($modeel);
*/
								include "cazo34modi.inc.php";
								exit;
							}else{
							}

#------ корекция длъжници ---------------
							# $edit = делото suit.id 
							$debtmodi= $GETPARAM["debtmodi"];
							if (isset($debtmodi)){
# източници : cazo3.php cazo3modi.ajax.php 
$taname= "debtor";
$tpname= "cazo34modi.ajax.tpl";
$listtext= "длъжници";
$listtext2= "длъжник";
$diemess= "cazo4";
	$func= "modi";
	$idel= $debtmodi;
	$typetext= "ДЛЪЖНИК";
	$isclaimer= false;
$smarty->assign("TANAME", $taname);
/*
	$modeel= "mode=".$mode .$CODEBASE ."&page=".$page;
	$relurl= geturl($modeel);
*/
								include "cazo34modi.inc.php";
								exit;
							}else{
							}

# заявката 
/*
$query= "
	select invoice.*, invoice.id as id
		, bill.serial as billseri
, if(bill.id is null,invoice.date,bill.date) as date
, if(bill.id is null,invoice.isvat,bill.isvat) as idvat
, if(bill.id is null,invoice.toname,bill.name) as name
		, bill.paid as paid
, if(bill.id is null,invoice.paidmethod,bill.paidmethod) as paidmethod
, if(bill.id is null,invoice.idinvotype,bill.idinvotype) as idinvotype
		, suit.serial as caseseri, suit.year as caseyear
		, user.name as username
	from invoice
	left join bill on invoice.idbill=bill.id
	left join suit on bill.idcase=suit.id
		left join user on suit.iduser=user.id
	where $CODEFILT
	order by if(invoice.serial=0,invoice.id,0) desc, invoice.serial desc
	";
//	order by invoice.serial desc
*/
$query= "
	select bill.*, bill.id as id, bill.serial as seribill
		, bill.seriinvo as seriinvo
, suit.id+0 as idcase
, billprof.seriprof
		, suit.serial as caseseri, suit.year as caseyear
		, user.name as username
								, t2user.name as cashname
	from bill
	left join suit on bill.idcase=suit.id
		left join user on suit.iduser=user.id
					left join billprof on billprof.idbill=bill.id
								left join user as t2user on bill.cashiduser=t2user.id
	where $CODEFILT
	order by bill.seriinvo desc
	";
//	order by bill.id desc

# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
		$prefurl= "";
//		$baseurl= "mode=".$mode ."&year=".$year ."&page=".$page;
//		$baseurl= "mode=".$mode ."&year=".$year;
		$baseurl= "mode=".$mode .$CODEBASE;
		$obpagi= new paginator(20, 8, $query);
							if ($word=="yes" or $exce=="yes"){
		$mylist= $DB->select($query);
							}else{
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
							}
$mylist= dbconv($mylist);
//print_rr($mylist);
/***/
# общо за целия списък 
//$ar1= getsumainvo("invoice.year=$year");
//$ar2= getsu2bill("invoice.year=$year");
//++++$ar1= getsumainvo($CODEFILT);
//++++$ar2= getsu2bill($CODEFILT);
//print_rr($ar2);
$ar1= getsumainvo($CODEFILT);
$ar2= getsumabill($CODEFILT);
	$arsuyear= array();
foreach($ar1 as $ardata){
	$arsuyear["suma"] += $ardata["suma"];
	$arsuyear["svat"] += $ardata["svat"];
	$arsuyear["s0"] += $ardata["s0"];
}
foreach($ar2 as $ardata){
	$arsuyear["suma"] += $ardata["suma"];
	$arsuyear["svat"] += $ardata["svat"];
	$arsuyear["s0"] += $ardata["s0"];
}
//print_rr($arsuyear);
$smarty->assign("ARSUYEAR", $arsuyear);
/***/

//$modeel= "mode=".$mode ."&year=".$year."&page=".$page;
$modeel= "mode=".$mode .$CODEBASE ."&page=".$page;
//var_dump($modeel);
/*
# списък на сметките за фактура - $ibaninit - глобалния iban за сметките и фактурите 
$aracco= getaccolist();
list($araccosele,$ibaninit)= getaccosele($aracco);
$smarty->assign("ARACCO", tran1251($araccosele));
*/

# трансформираме списъка 
										$arcase= array();
foreach ($mylist as $uskey=>$uscont){
//	$idbill= $uscont["idbill"];
//	$idinvo= $uscont["id"];
	$idbill= $uscont["id"];
	$idcase= $uscont["idcase"];
										if ($idcase+0==0){
										}else{
											$arcase[]= $idcase;
										}
							$iban= $uscont["iban"];
							if ($iban==$ibaninit){
		$mylist[$uskey]["iban"]= "";
							}else{
							}
//print "<br>idbill=[$idbill]idcase=[$idcase]<br>";
//	if ($idcase==0){
	if ($uscont["serial"]==0){
		$arsuma= getsumainvo("invoelem.idbill=$idbill");
//var_dump($idbill);
//print_rr($arsuma);
		$mylist[$uskey]["suma"]= $arsuma[$idbill]["suma"];
		$mylist[$uskey]["svat"]= $arsuma[$idbill]["svat"];
$mylist[$uskey]["s0"]= $arsuma[$idbill]["s0"];
		$mylist[$uskey]["coun"]= $arsuma[$idbill]["coun"];
$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idbill);
	}else{
//++++		$arsuma= getsu2bill("billelem.idbill=$idbill");
		$arsuma= getsumabill("billelem.idbill=$idbill");
//var_dump($idbill);
//print_rr($arsuma);
		$mylist[$uskey]["suma"]= $arsuma[$idbill]["suma"];
		$mylist[$uskey]["svat"]= $arsuma[$idbill]["svat"];
$mylist[$uskey]["s0"]= $arsuma[$idbill]["s0"];
$mylist[$uskey]["modibill"]= geturl($modeel."&modibill=".$idbill);
	}
				# кредитни известия 
				if ($mylist[$uskey]["suma"]<0){
$mylist[$uskey]["paid"]= -$mylist[$uskey]["paid"];
				}else{
				}
//	$idinvo= $uscont["id"];
//	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idinvo);
	$mylist[$uskey]["dele"]= geturl($modeel."&dele=".$idbill);
	$mylist[$uskey]["regi"]= geturl($modeel."&regi=".$idbill);
	$mylist[$uskey]["view"]= geturl($modeel."&view=".$idbill);
$mylist[$uskey]["prin"]= geturl($modeel."&prin=".$idbill);
$mylist[$uskey]["prinbill"]= geturl($modeel."&prinbill=".$idbill."&print=yes");
					//$mylist[$uskey]["prinbill"]= $modeel."&prinbill=".$idbill."&print=yes";
					//////$mylist[$uskey]["prinbill"]= "prinbill=".$idbill."&print=yes";
$mylist[$uskey]["seriinvoedit"]= geturl($modeel."&seriinvoedit=".$idbill);
$mylist[$uskey]["seribilledit"]= geturl($modeel."&seribilledit=".$idbill);
					# 15.05.2013 трансформиране проформа в нормална 
					$mylist[$uskey]["proftonorm"]= geturl($modeel."&proftonorm=".$idbill);
//	foreach($arinvotype as $indx=>$elem){
//		$mylist[$uskey]["prin".$indx]= geturl($modeel."&prin=".$idbill."&type=".$indx);
//	}
	$mylist[$uskey]["prntcode"]= $idbill +157;
	$mylist[$uskey]["prntcodebill"]= "bill".($idbill +19);
$mylist[$uskey]["editcredmess"]= geturl($modeel."&editcredmess=".$idbill);
}
$mylist= arstrip($mylist);
//print_rr($mylist);
										if (empty($arcase)){
											$codein= "0";
										}else{
											$codein= implode(",",$arcase);
										}
//var_dump($codein);
# списък взискатели 
$arclai= $DB->selectCol("select idcase as ARRAY_KEY1, id as ARRAY_KEY2, name from claimer where idcase in ($codein)");
$arclai= dbconv($arclai);
$arclai= arstrip($arclai);
$smarty->assign("ARCLAI", $arclai);
//print_ru($arclai);

# доп.трансформация - вмъкваме елементи за пропуснати номера 
						$ar2= array();
						$mybase= 0;
foreach ($mylist as $uskey=>$uscont){
//	$myseri= $uscont["serial"];
	$myseri= $uscont["seriinvo"];
	if ($myseri==0){
	}else{
		if ($mybase==0){
		}else{
			$mydiff= $mybase - $myseri;
			if ($mydiff==1){
			}else{
					if ($vari=="year" or $vari=="date"){
# 29.01.2013 - П.Дочева 
# филтъра е за година, липсващите номера може да са заети, но с дати от друга година 
			$coexis= 0;
			$conote= 0;
for ($cuseri=$myseri+1; $cuseri<$mybase; $cuseri++){
//print "[$cuseri]";
	$cuid= $DB->selectCell("select id from bill where seriinvo=?d"  ,$cuseri);
	if ($cuid==0){
			$conote ++;
	}else{
			$coexis ++;
	}
}
			if ($conote==0){
			}else{
				$ar2[]= array("id"=>0, "diff"=>$conote);
			}
			if ($coexis==0){
			}else{
				if ($vari=="year"){
					$ar2[]= array("id"=>0, "diffyear"=>$coexis);
				}else{
					$ar2[]= array("id"=>0, "diffdate"=>$coexis);
				}
			}
					}else{
# филтъра е различен от година 
						$ar2[]= array("id"=>0, "diff"=>$mydiff-1);
					}
			}
		}
						$mybase= $myseri;
	}
						$ar2[]= $uscont;
}
$mylist= $ar2;
//print_rr($mylist);

# add new link 
$addnew= geturl($modeel."&edit=0");
$addnewbill= geturl($modeel."&modibill=0");

# word link 
$wordlink= geturl($modeel."&word=yes");
$smarty->assign("WORDLINK", $wordlink);
$excelink= geturl($modeel."&exce=yes");
$smarty->assign("EXCELINK", $excelink);

# линк създаване на празни 
$crealink= geturl($modeel."&create=yes");
$smarty->assign("CREALINK", $crealink);

												# взискатели и длъжници 
												# $edit = делото suit.id 
												if (isset($filtcase)){
	$clailist= $DB->select("select * from claimer where idcase=?d"  ,$edit);
$clailist= dbconv($clailist);
foreach($clailist as $indx=>$cont){
	$clailist[$indx]["claimodi"]= geturl($modeel."&claimodi=".$cont["id"]);
}
$smarty->assign("CLAILIST", $clailist);
$smarty->assign("CLAICREA", geturl($modeel."&claimodi=0"));
	$debtlist= $DB->select("select * from debtor where idcase=?d"  ,$edit);
$debtlist= dbconv($debtlist);
foreach($debtlist as $indx=>$cont){
	$debtlist[$indx]["debtmodi"]= geturl($modeel."&debtmodi=".$cont["id"]);
}
$smarty->assign("DEBTLIST", $debtlist);
$smarty->assign("DEBTCREA", geturl($modeel."&debtmodi=0"));
												}else{
												}

# извеждаме 
$smarty->assign("LINKREFR", geturl($modeel));
$smarty->assign("ADDNEW", $addnew);
$smarty->assign("ADDNEWBILL", $addnewbill);
$smarty->assign("LIST", $mylist);

							if ($word=="yes" or $exce=="yes"){
								if ($word=="yes"){
			$wordcont= smdisp("finainvoword.tpl","fetch");
			ExcelHeader("списък_фактури_".date("dmY_Hi").".doc");
								}else{
$smarty->assign("ISEXCE", true);
			$wordcont= smdisp("finainvoword.tpl","fetch");
			ExcelHeader("списък_фактури_".date("dmY_Hi").".xls");
								}
	$outp= "
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\" />
<body>
	$wordcont
</body>
</html>
	";
print $outp;
exit;
							}else{

$pagecont= smdisp("finainvo.tpl","fetch");

							}


?>