<?php
# зона актуален дълг 
# източник : cazobala.php - преизчисляване на погасяването 
# отгоре : 
#    $edit= case.id 
#    $zone= paym 
#    $func= view, modi 
//# елемент за настройка 
//#    $idel - cash.id  
//print session_name()."=".session_id();

# филтъра
$filter= "where idcase=$edit";

/****
# участващи събития 
# източник : cazobala.php 
# обаче участват ВСИЧКИ постъпления, а не само приключените 
$listvali= $DB->select("
	(select id, '3' as oper, fromdate as date, text as descrip, amount as amou from subject $filter and idtype in (1,2,3)) 
	union all
	(select id, '4' as oper, datebala as date, descrip as descrip, inco as amou from finance $filter) 
	");
$listvali= dbconv($listvali);
//print_rr($mylist);
# сортираме - complist2 = точно копие на complist - cazobala.php 
usort($listvali,"complist2");
function complist2($p1,$p2){
	if ($p1["date"]==$p2["date"]){
		if ($p1["oper"]==$p2["oper"]){
								if ($p1["id"]==$p2["id"]){
return 0;
								}else{
return $p1["id"]>$p2["id"] ? 1 : -1;
								}
return 0;
		}else{
return $p1["oper"]<$p2["oper"] ? 1 : -1;
		}
	}else{
return $p1["date"]>$p2["date"] ? 1 : -1;
	}
}
****/

# участващите финансови събития - предмети и постъпления, сортирани по дата 
						include_once "cazoactu.inc.php";
# $listvali - масив със списъка 
# $cbtemp - шаблон за имената на чекбоксовете 
list($listvali,$cbtemp)= getactulist($filter);
//# шаблон за имената на чекбоксовете 
//$cbtemp= "cb_%s_%s";
			# 08.07.2010 - предотвратява въвеждане на празна дата 
			# вместо нея - автоматично днешната - виж шаблона cazoactu.tpl 
			$smarty->assign("ENDDATE", date("d.m.Y"));
											# супер процес - cazoactu.php и cazoactu.ajax.php 
											$supecase= $_SESSION["actucalc"]["idcase"];
//print_r($_SESSION["actucalc"]);
//print "[$supecase][$edit]";
											if ($supecase==$edit){
//print "====CURRENT====";
												#----------------- следващ път за това дело -----------------
											}else{
//print "====FIRST====";
												#----------------- първи път за това дело -----------------
												# нулираме сесийната променлива 
												$_SESSION["actucalc"]= array();
												# попълваме нач.стойности за сесийните променливи и POST полетата 
												$_SESSION["actucalc"]["idcase"]= $edit;
														$enddate= date("Y-m-d");
														//$enddate= date("2009-11-15");
														//$_POST["enddate"]= $enddate;
												$_SESSION["actucalc"]["enddate"]= $enddate;
/*
					foreach($listvali as $elname=>$elem){
						$finame= sprintf($cbtemp,$elem["oper"],$elem["id"]);
	# името на полето 
	$listvali[$elname]["finame"]= $finame;
						if ($elem["date"]<=$enddate){
							$secont= true;
							$pocont= 1;
						}else{
							$secont= false;
							$pocont= 0;
	# извън периода 
	$listvali[$elname]["mode"]= 1;
						}
												$_SESSION["actucalc"][$finame]= $secont;
														$_POST[$finame]= $pocont;
					}
*/
		foreach($listvali as $elname=>$elem){
			$finame= sprintf($cbtemp,$elem["oper"],$elem["id"]);
			$secont= ($elem["date"]<=$enddate);
												$_SESSION["actucalc"][$finame]= $secont;
		}
											# край супер процес 
											}

//print_r($_SESSION);
# проверяваме крайната дата 
$enddate= $_SESSION["actucalc"]["enddate"];
$enddatebg= bgdatefrom($enddate);
//var_dump($enddate);
//var_dump($enddatebg);
$resudate= validator_bgdate_valid_notempty($enddatebg,array());
if ($resudate===true){
}else{
	$smarty->assign("DATETEXT", $resudate[0]);
}
														$_POST["enddate"]= $enddatebg;

//var_dump($enddate);
//var_dump($enddatebg);
//print_r($_SESSION["actucalc"]);
# чекбоксовете 
foreach($listvali as $elname=>$elem){
	# името на полето 
	$finame= sprintf($cbtemp,$elem["oper"],$elem["id"]);
	$listvali[$elname]["finame"]= $finame;
							# да има ли чекбокс 
							$flagcheck= false;
										# ако няма - вида на съобщението 
										$mymode= 0;
	if ($resudate===true){
		# крайната дата е вярна 
/*
		if (empty($elem["date"])){
			# липсва дата на събитието 
										$mymode= 2;
		}else{
			# има дата на събитието 
			if ($elem["oper"]==3){
				# събитието е предмет - задължително участва 
										$mymode= 3;
			}else{
				# събитието е погасяване 
				if ($elem["date"]<=$enddate){
					# датата не е по-късна от кр.дата 
							# ще има чекбокс 
							$flagcheck= true;
				}else{
					# датата е по-късна от кр.дата 
										$mymode= 1;
				}
			}
		}
*/
		if ($elem["oper"]==3){
			# събитието е предмет - задължително участва 
										$mymode= 3;
		}else{
			# събитието е погасяване 
			if (empty($elem["date"])){
				# липсва дата на събитието 
										$mymode= 2;
			}else{
			# има дата на събитието 
				if ($elem["date"]<=$enddate){
					# датата не е по-късна от кр.дата 
							# ще има чекбокс 
							$flagcheck= true;
				}else{
					# датата е по-късна от кр.дата 
										$mymode= 1;
				}
			}
		}
	}else{
		# крайната дата е грешна 
										$mymode= (empty($elem["date"])) ? 2 : 1;
	}
	# според да има ли чекбокс 
//print "<br>finame=[$finame]";
//var_dump($flagcheck);
	if ($flagcheck){
		# ще има чекбокс 
//				# преди крайната дата ? 
//				$secont= ($elem["date"]<=$enddate);
//					if ($secont){
						if ($_SESSION["actucalc"][$finame]){
							# чекнат чекбокс 
							$postcont= 1;
						}else{
							# нечекнат чекбокс 
							$postcont= 0;
						}
												# състоянието на чекбокса - чекнат или не 
												$_POST[$finame]= $postcont;
//print "<br>post=[$finame][$postcont]";
//					}else{
//		# извън периода - няма чекбокс 
//		$listvali[$elname]["mode"]= 1;
//					}
	}else{
		# няма да има чекбокс - крайната дата е грешна или извън периода 
		$listvali[$elname]["mode"]= $mymode;
	}
}
//print_rif($listvali);
//print_rif($_POST);


//print_r($_SESSION["actucalc"]);
# предаваме 
$smarty->assign("IDCASE", $edit);
$smarty->assign("LISTVALI", $listvali);

# различен шаблон 
				if (isset($tpnameactu)){
				}else{
$tpnameactu= "cazoactu.tpl";
				}

								include_once "cazobala.php";
//print_rif($balist);

?>
