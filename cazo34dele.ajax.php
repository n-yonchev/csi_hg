<?php
# изтриване на взискател/длъжник по текущото дело 
# източник : 
#      cazo34modi.inc.php - корекция на взискател/длъжник 
# отгоре : 
#    $delrec - id за изтриване 
# още отгоре : 
#    $taname - таблицата 
//#    $tpname - шаблона 
#    $typetext - текст за типа участник 
#    $redilink - линк за redirect 
#    $isclaimer - флаг дали е взискател 
//print_r($GETPARAM);

# шаблона 
$tpname= "cazo34dele.ajax.tpl";
# полетата 
$filist= array();
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
									# основен параметър - 
									# $delrec - $taname.id - id на взискателя/длъжника 
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	# данните за участника 
	$rocont= getrow($taname,$delrec);
	$name34= $rocont["name"];
	# всички предмети по делото 
	$idcase= $rocont["idcase"];
	$mylist= $DB->select("select * from subject where idcase=?" ,$idcase);
	$mylist= dbconv($mylist);
	# в колко предмета участва този участник 
						$casecoun= 0;
	foreach ($mylist as $elem){
		if ($isclaimer){
			if ($elem["idclaimer"]==$delrec){
						$casecoun ++;
			}else{
			}
		}else{
			$myde= explode(",",$elem["listdebtor"]);
			if (in_array($delrec,$myde)){
						$casecoun ++;
			}else{
			}
		}
	}

#------ submit без формални грешки 
# потвърдено изтриване 
}elseif ($mfacproc=="submyes"){
							$retucode= 0;
	$DB->query("delete from $taname where id=?" ,$delrec);

#------ допълнителен бутон 
# отказ 
}elseif ($mfacproc=="submno"){
//	# специфична реакция - записваме с грешка, както ако няма грешки 
							$retucode= 0;
//	# запис в БД 
//	put34();

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
//	reload("parent",$relurl);
/**/
	$smarty->assign("EXITCODE", getnyroexit($redilink));
	print smdisp($tpname,"iconv");
/**/
/***
								if ($isclaimer or $mfacproc=="submno"){
	$smarty->assign("EXITCODE", getnyroexit($redilink));
	print smdisp($tpname,"iconv");
								}else{
								# 31.05.2011 - директно цялото дело към регистъра 
	print smdisp($tpname,"iconv");
	$nyex= getnyroexit($redilink);
	$nyex= str_replace($NYROREMOVE,"",$nyex);
//print "<xmp>$nyex</xmp>";
	$smarty->assign("EXITCODE", $nyex);
	$smarty->assign("ONLOAD", "document.location.href='cazo34regito.ajax.php?s=$edit';");
	print smdisp("cazo34regito.ajax.tpl","iconv");
								}
***/
}else{
	# извеждаме формата 
//	$smarty->assign("EDIT", $idel);
//	$smarty->assign("FILIST", $filist);
	$smarty->assign("TYPETEXT", $typetext);
			$smarty->assign("NAME", $name34);
			$smarty->assign("CASECOUN", $casecoun);
//	$smarty->assign("ISCLAIMER", $isclaimer);
	print smdisp($tpname,"iconv");
//	$pagecont= smdisp($tpname,"iconv");
}


?>
