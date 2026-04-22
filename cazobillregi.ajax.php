<?php
# номериране на сметка за текущото дело 
# отгоре : 
#     $regibill - bill.id 
//print_r($GETPARAM);

# таблицата 
$taname= "bill";
# шаблона 
$tpname= "cazobillregi.ajax.tpl";
# полетата 
$filist= array(
	"getnext"=> NULL
	,"serial"=> NULL
);
# константни полета 
$ficonst= array();

									# класа за редактиране 
									include_once "edit.class.php";

#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
			
			$rooffi= getofficerow($iduser);
			$billpa= $rooffi["billparams"];
			if (empty($billpa)){
				$billnumber= 0;
			}else{
				$billpa= toutf8($billpa);
				$arbill= unserialize($billpa);
				$billnumber= $arbill["number"];
			}
//var_dump($billnumber);
									# основен параметър - 
									# $regibill - id на сметката 
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	$rocont= getrow($taname,$regibill);
	$serial= $rocont["serial"];
	if ($serial==0){
		$_POST["getnext"]= 1;
	}else{
		$_POST["serial"]= $serial;
	}
/*
	# данните за реда 
		$rocont= getrow($taname,$regibill);
		$roclai= getrow("claimer",$rocont["idclaimer"]);
		$rocont["clainame"]= $roclai["name"];
	$suma= $DB->selectCell("
		select 1.2*sum(taxprop+taxregu+taxaddi) as suma
		from billelem
		where idbill=?d
		group by idbill
		"  ,$regibill);
		$rocont["suma"]= $suma;
	$smarty->assign("ROCONT", $rocont);
*/

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
									$DB->query("lock tables $taname write");
											# проверяваме за допълнителни грешки 
											$lister= array();
	$isnext= isset($_POST["getnext"]);
	if ($isnext){
/*
					$nextnumb= $DB->selectCell("select max(serial) from bill");
		if ($nextnumb==0){
			$nextnumb= $billnumber;
		}else{
			$nextnumb ++;
		}
*/
		$nextnumb= getnextnumb($billnumber);
	}else{
		$nextnumb= $_POST["serial"] +0;
		if ($nextnumb==0){
											$lister["serial"]= "грешен номер";
		}elseif ($nextnumb < $billnumber){
											$lister["serial"]= "номера да не е < $billnumber";
		}else{
			$coun= $DB->selectCell("select count(id) from $taname where serial=?d and id<>?d"  ,$nextnumb,$regibill);
			if ($coun==0){
			}else{
											$lister["serial"]= "номера е зает от друга сметка";
			}
		}
	}
											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
												#---- няма ---- 
							$retucode= 0;
	$DB->query("update bill set serial=?d where id=?d"  ,$nextnumb,$regibill);
											# край - според дали има грешка 
											}
									$DB->query("unlock tables");




#------ submit с формални грешки 
# - невъзможно в случая 
}elseif ($mfacproc==NULL){
//	# стандартна реакция 
							$retucode= 1;
//	doerrors();

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
	# redirect 
	$redilink= array("tbilllink");
	$smarty->assign("EXITCODE", getnyroexit($redilink));
	print smdisp($tpname,"iconv");
}else{
	# извеждаме формата 
//					$nextnumb= $DB->selectCell("select max(serial) from bill");
//					$smarty->assign("NEXTNUMB", $nextnumb +1);
		$nextnumb= getnextnumb($billnumber);
					$smarty->assign("NEXTNUMB", $nextnumb);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
//	$pagecont= smdisp($tpname,"iconv");
}


function getnextnumb($billnumber){
global $DB;
					$nextnumb= $DB->selectCell("select max(serial) from bill");
		if ($nextnumb==0){
			$nextnumb= $billnumber==0 ? 1 : $billnumber;
		}else{
			$nextnumb ++;
		}
return $nextnumb;
}

?>
