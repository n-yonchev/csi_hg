<?php
# списък на фактури/сметки за делото 
# отгоре : 
#    $edit= case.id 
#    $zone= bill 
//print_rr($GETPARAM);

# основните параметри 
$tpname= "cazobill.tpl";
$modeel= "edit=$edit&zone=$zone";

						# всичко за фактурата 
						include_once "invo.inc.php";

//# reload - след успешен събмит 
//$modeel= "mode=".$mode .$CODEBASE ."&page=".$page;
//$relurl= geturl($modeel);

									# отпечатване на фактура 
									$prininvo= $GETPARAM["prininvo"];
									if (isset($prininvo)){
							$prin= $prininvo;
										include "finainvoprin.ajax.php";
										exit;
									}else{
									}
							
									# отпечатване на сметка 
									$prinbill= $GETPARAM["prinbill"];
									if (isset($prinbill)){
										include "cazobillprin.ajax.php";
										exit;
									}else{
									}
							
									# отпечатване на РКО 
									$prinrazh= $GETPARAM["prinrazh"];
									if (isset($prinrazh)){
							$prin= $prinrazh;
										include_once "razhprin.ajax.php";
										exit;
									}else{
									}

# списъка на сметките 
$mylist= $DB->select("select bill.* ,bill.id as id, bill.id as ARRAY_KEY
		, billprof.seriprof
	from bill
		left join billprof on billprof.idbill=bill.id
	where bill.idcase=$edit
	order by bill.id
	");
$mylist= dbconv($mylist);
$mylist= arstrip($mylist);
//print_r($mylist);

# списъка на сумите по сметки 
$listsuma= getsumabill("bill.idcase=$edit");

foreach($listsuma as $key => $item) {
	if($mylist[$key]['date'] < ($euro_first_year+1) . '-01-01') {
		foreach($item as $k => $i) {
			$listsuma[$key][$k] = round($i * $lev_to_euro_multiplier, 2);
		}
	}
}

$smarty->assign("LISTSUMA", $listsuma);
//print_rr($listsuma);
					$tosuma= 0;
					$vasuma= 0;
foreach($listsuma as $idbill=>$s1){
					$tosuma += $s1["suma"];
					$vasuma += $s1["svat"];
}
$artota= array(1=>$tosuma, 2=>$vasuma);
$smarty->assign("ARTOTA", $artota);

# трансформираме списъка - параметри за иконите 
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
	$mylist[$uskey]["prinbill"]= geturl($modeel."&prinbill=".$idcurr."&print=yes");
	$mylist[$uskey]["prininvo"]= geturl($modeel."&prininvo=".$idcurr);
//	foreach($arinvotype as $indx=>$elem){
//		$mylist[$uskey]["prin".$indx]= geturl($modeel."&invobillprin=".$uscont["idinvo"]."&type=".$indx);
//	}
}

					# РКО за делото 
					$arrazh= $DB->select("
						select razh.*
						from razh
						where razh.idcase=?d
						order by razh.cashdate desc, razh.id desc
						"  ,$edit);
					$arrazh= dbconv($arrazh);
					foreach ($arrazh as $uskey=>$uscont){
								$idcurr= $uscont["id"];
						$arrazh[$uskey]["prinrazh"]= geturl($modeel."&prinrazh=".$idcurr);
					}
					$smarty->assign("ARRAZH", $arrazh);
//print_rr($arrazh);
					

# извеждаме 
$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
$pagecont= smdisp($tpname,"iconv");


?>