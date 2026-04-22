<?php
# отгоре : 
#    $mode - текущия режим 
#    $page - текущата страница 
#    $vari - текущото подменю 
# още : 
#    $filtcode - филтър-1 
#    $toinveiban - iban за евент.назначаване към опис 
#    $flagpack - флаг за евент.назначаване към пакет 
//print_rr($GETPARAM);

//$relurl= geturl("mode=".$mode."&vari=".$vari."&page=".$page);
if (isset($basepara)){
	$baco= $basepara;
}else{
	$baco= "mode=".$mode."&vari=".$vari."&page=".$page;
}
if (isset($v2)){
	$baco .= "&v2=".$v2;
}else{
}
//var_dump($baco);
$relurl= geturl($baco);
/*
									# маркиране като директно преведена - избраното разпределение 
									$mark= $GETPARAM["mark"];
									if (isset($mark)){
//$relurl= geturl("mode=".$mode."&vari=".$vari."&page=".$page);
										include_once "tranmark.ajax.php";
										exit;
									}else{
									}
									# ДЕмаркиране като директно преведена - избраното разпределение 
									$unmark= $GETPARAM["unmark"];
									if (isset($unmark)){
//$relurl= geturl("mode=".$mode."&vari=".$vari."&page=".$page);
										include_once "tranunmark.ajax.php";
										exit;
									}else{
									}
*/
									# корекция на сметката - избраното разпределение 
									$editiban= $GETPARAM["editiban"];
									if (isset($editiban)){
//$relurl= geturl("mode=".$mode."&vari=".$vari."&page=".$page);
										include_once "traniban.ajax.php";
										exit;
									}else{
									}
									# корекция на взискателя/получателя - избраното разпределение 
									$editclai= $GETPARAM["editclai"];
									if (isset($editclai)){
//$relurl= geturl("mode=".$mode."&vari=".$vari."&page=".$page);
										include_once "tranclai.ajax.php";
										exit;
									}else{
									}
									# корекция на основанието - избраното разпределение 
									$edittext= $GETPARAM["edittext"];
									if (isset($edittext)){
//$relurl= geturl("mode=".$mode."&vari=".$vari."&page=".$page);
										include_once "trantext.ajax.php";
										exit;
									}else{
									}
									# корекция на бюдж.данни - избраното разпределение 
									$editbudg= $GETPARAM["editbudg"];
									if (isset($editbudg)){
//$relurl= geturl("mode=".$mode."&vari=".$vari."&page=".$page);
										include_once "tranbudg.ajax.php";
										exit;
									}else{
									}
									# корекция на длъжника - избраното разпределение 
									$editdebt= $GETPARAM["editdebt"];
									if (isset($editdebt)){
//$relurl= geturl("mode=".$mode."&vari=".$vari."&page=".$page);
										include_once "trandebt.ajax.php";
										exit;
									}else{
									}
									# сметката на избраното разпределение - бюджетна или не 
									$accobudg= $GETPARAM["accobudg"];
									if (isset($accobudg)){
//$relurl= geturl("mode=".$mode."&vari=".$vari."&page=".$page);
										include_once "tranaccobudg.ajax.php";
										exit;
									}else{
									}
									# флаг пълно/частично погасяване - избраното разпределение 
									$full= $GETPARAM["full"];
									if (isset($full)){
//$relurl= geturl("mode=".$mode."&vari=".$vari."&page=".$page);
//										include_once "tranaccobudg.ajax.php";
//										exit;
$DB->query("update finatran set isfull=1-isfull where id=?d"  ,$full);
			# основанието 
			updatrantext($full);
									}else{
									}
									# за ръчен превод - отложен/преведен - избраното разпределение 
									$dire= $GETPARAM["dire"];
									if (isset($dire)){
$DB->query("update finatran set idstat=if(idstat=6,9,6), statmodi=now() where id=?d"  ,$dire);

$finance = $DB->select(
	"SELECT f.* 
	FROM finance f
	INNER JOIN finatranrefe ftr ON ftr.idfinance = f.id
	INNER JOIN finatran ft ON ft.id = ftr.idfinatran
	INNER JOIN suit s ON s.id = f.idcase
	INNER JOIN claimer c ON c.id = ft.idclaimer
	WHERE s.epep_case_uid IS NOT NULL AND c.epep_uid IS NOT NULL AND ft.id = ?d
	GROUP BY f.id", $dire
);
$finance = $finance[0];

if($finance) {
	$DB->query("INSERT INTO epep_payments_queue(case_id, finance_id) VALUES (?d, ?d)", $finance['idcase'], $finance['id']);
}
# reload 
reload("",$relurl);
									}else{
									}
									# за изключване/включване в опис - избраното разпределение 
									$noli= $GETPARAM["noli"];
									if (isset($noli)){
$DB->query("update finatran set isnolist=1-isnolist where id=?d"  ,$noli);
# reload 
reload("",$relurl);
									}else{
									}
									# флаг включен/изключен RINGS - избраното разпределение 
									$ring= $GETPARAM["ring"];
									if (isset($ring)){
$DB->query("update finatran set isring=1-isring where id=?d"  ,$ring);
									}else{
									}
									# от коя банка - избраното разпределение 
									$bank= $GETPARAM["bank"];
									if (isset($bank)){
//$DB->query("update finatran set idbank=3-idbank where id=?d"  ,$bank);
$curridbank= $DB->selectCell("select idbank from finatran where id=?d"  ,$bank);
	$arke= array_keys($arbankpaym);
	$indx= array_search($curridbank,$arke);
	if ($indx===false){
$newidbank= $arke[0];
	}else{
		$indx ++;
		if ($indx <= count($arke)-1){
$newidbank= $arke[$indx];
		}else{
$newidbank= $arke[0];
		}
	}
/*
while (true){
	$idbank ++;
	if (isset($arbankpaym[$idbank])){
		break;
	}else{
	}
	if (isset($arbankpaym[$idbank])){
		break;
	}else{
	}
}
*/
$DB->query("update finatran set idbank=$newidbank where id=?d"  ,$bank);
			# основанието 
			updatrantext($bank);
# reload 
reload("",$relurl);
									}else{
									}


# код за подзаявка за врем.таблица при назначаване 
$workcode= getworkcode($filtcode);
//var_dump($workcode);

#---------------------------------------------------------------------------------
# включване към опис 
			$toinve= $GETPARAM["toinve"];
//print "toinve=[$toinve]";
//print "filtcode=[$filtcode]";
			if (isset($toinve)){
					# списъка finatran.id 
					$cboxlist= $_SESSION["cboxlist"];
					if (isset($cboxlist)){
//$workcode= $cboxlist;
$incode= $cboxlist;
					}else{
$arid= $DB->selectCol($workcode);
$incode= implode(",",$arid);
					}
				if (substr($toinve,0,4)=="iban"){
					# за новия опис 
#-- iban 
$toinveiban= substr($toinve,4);
					#-- списъка преводи 
					$arin= explode(",",$incode);
//					$rotran= getrow("finatran",$arin[0]);
					#-- съдържание на 1-вия превод 
					$rotran= $DB->selectRow("
						select finatran.idbank, finatran.iban, tranacco.id as idacco
						from finatran 
$codetranacco
						where finatran.id=?d
						"  ,$arin[0]);
					#-- банката 
					$invebank= $rotran["idbank"];
					#-- id на спец.сметка 
					$inveacco= $rotran["idacco"];
					#-- iban на превода == iban за новия опис 
					$traniban= $rotran["iban"];
		if (empty($inveacco)){
die("tran2=$toinveiban");
		}elseif ($toinveiban<>$traniban){
die("tran3=$toinveiban=$traniban");
		}else{
		}
					# създаваме новия опис 
//					$toinve= $DB->query("insert into traninve set idacco=$inveacco, idbank=$invebank, created=now()");
					$toinve= $DB->query("insert into traninve set idacco=$inveacco, idbank=$invebank, created=now(), iduser=?d"  ,$_SESSION["iduser"]);
				}else{
				}
													//$DB->query("lock tables traninve write, finatran write");
													$DB->query("lock tables traninve write, finatran write, tranacco write, tranbudget write");
							$roinve= getrow("traninve",$toinve);
							if ($roinve["idstat"]==0){
$aset= array();
$aset["idinve"]= $toinve;
/****
$DB->query("
	update finatran 
	set ?a
	where id in (
$workcode
	)
"  ,$aset);
****/
// НЕ СТАВА. грешка table finatran not locked 
#--------------------------------------------
# алтернативен подход 
/*
var_dump($workcode);
$arid= $DB->selectCol($workcode);
print_rr($arid);
		if (empty($arid)){
$incode= "0";
		}else{
$incode= implode(",",$arid);
		}
*/
$DB->query("
	update finatran 
	set ?a
	where id in (
$incode
	)
"  ,$aset);
#--------------------------------------------
# reload 
reload("",$relurl);
							}else{
$smarty->assign("INVEER", "опис $toinve вече е заключен");
							}
													$DB->query("unlock tables");
//# reload 
//reload("",$relurl);
			}else{
			}

#---------------------------------------------------------------------------------
# изключване от опис 
			$frominve= $GETPARAM["frominve"];
//			if ($frominve=="yes"){
			if (isset($frominve)){
//print "<h3>EXCLUDE</h3>";
				$cboxlist= $_SESSION["cboxlist"];
				if (isset($cboxlist)){
$workcode= $cboxlist;
				}else{
				}
$aset= array();
$aset["idinve"]= 0;
$DB->query("
	update finatran 
	set ?a
	where id in (
$workcode
	)
"  ,$aset);
# reload 
reload("",$relurl);
			}else{
			}

#---------------------------------------------------------------------------------
# включване към пакет 
			$topack= $GETPARAM["topack"];
//print "topack=[$topack]";
//print "filtcode=[$filtcode]";
			if (isset($topack)){
					# списъка finatran.id 
					$cboxlist= $_SESSION["cboxlist"];
					if (isset($cboxlist)){
//$workcode= $cboxlist;
$incode= $cboxlist;
					}else{
$arid= $DB->selectCol($workcode);
$incode= implode(",",$arid);
					}
				if ($topack==0){
//$toinveiban= substr($toinve,4);
					# банката за новия пакет 
					$arin= explode(",",$incode);
					$rotran= getrow("finatran",$arin[0]);
					$packbank= $rotran["idbank"];
					//echo "fuck: $packbank"; print_r($rotran);print_r($arin);print_r($_SESSION); echo "$incode";
					# само за Пощ.банка - кода на пакета - бюджетен или не 
					if ($packbank==$indxbankpost){
						$idbudg= $rotran["idtranbudget"];
						$packcode= ($idbudg==0) ? "" : $codebankpost;
					}else{
						$packcode= "";
					}
# нов пакет 
//$topack= $DB->query("insert into tranpack set idbank=$packbank, code='$packcode', created=now()");
$topack= $DB->query("insert into tranpack set `idbank`=$packbank, `code`='$packcode', `created`=now(), `iduser`=?d"  ,$_SESSION["iduser"]);
				}else{
				}
													$DB->query("lock tables tranpack write, finatran write, tranacco write, tranbudget write");
							$ropack= getrow("tranpack",$topack);
							if ($ropack["idstat"]==0){
$aset= array();
$aset["idpack"]= $topack;
/***
$DB->query("
	update finatran 
	set ?a
	where id in (
$workcode
	)
"  ,$aset);
***/
// НЕ СТАВА. грешка table finatran not locked 
#--------------------------------------------
# алтернативен подход 
/*
$arid= $DB->selectCol($workcode);
//print_rr($arid);
		if (empty($arid)){
$incode= "0";
		}else{
$incode= implode(",",$arid);
		}
*/
$DB->query("
	update finatran 
	set ?a
	where id in (
$incode
	)
"  ,$aset);
#--------------------------------------------
# reload 
reload("",$relurl);
							}else{
$smarty->assign("PACKER", "пакет $topack вече е заключен");
							}
													$DB->query("unlock tables");
			}else{
			}

#---------------------------------------------------------------------------------
# изключване от пакет 
			$frompack= $GETPARAM["frompack"];
//			if ($frompack=="yes"){
			if (isset($frompack)){
				$cboxlist= $_SESSION["cboxlist"];
//print "[$frompack][$cboxlist]";
				if (isset($cboxlist)){
$workcode= $cboxlist;
				}else{
				}
$aset= array();
$aset["idpack"]= 0;
$DB->query("
	update finatran 
	set ?a
	where id in (
$workcode
	)
"  ,$aset);
# reload 
reload("",$relurl);
			}else{
			}

#---------------------------------------------------------------------------------
# маркиране като отложени ръчни преводи 
			$markdire= $GETPARAM["markdire"];
//			if ($frompack=="yes"){
			if (isset($markdire)){
				$cboxlist= $_SESSION["cboxlist"];
//print "[$markdire][$cboxlist]";
				if (isset($cboxlist)){
$workcode= $cboxlist;
				}else{
				}
$aset= array();
//$aset["idstat"]= 9;
$aset["idstat"]= 6;
$DB->query("
	update finatran 
	set ?a, statmodi=now()
	where id in (
$workcode
	)
"  ,$aset);
# reload 
reload("",$relurl);
			}else{
			}

#---------------------------------------------------------------------------------
# демаркиране обратно в чакащи 
			$demarkdire= $GETPARAM["demarkdire"];
//			if ($frompack=="yes"){
			if (isset($demarkdire)){
				$cboxlist= $_SESSION["cboxlist"];
//print "[$demarkdire][$cboxlist]";
				if (isset($cboxlist)){
$workcode= $cboxlist;
				}else{
				}
$aset= array();
$aset["idstat"]= 0;
$DB->query("
	update finatran 
	set ?a, statmodi=now()
	where id in (
$workcode
	)
"  ,$aset);
# reload 
reload("",$relurl);
			}else{
			}


?>