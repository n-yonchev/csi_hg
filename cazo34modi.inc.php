<?php
# отгоре : 
#    $edit= case.id 
#    $zone= зоната =3,4 
#    $func= view, modi 
#    $idel - id на взискателя/длъжника 
# още отгоре : 
#    $taname - таблицата 
#    $tpname - шаблона 
#    $typetext - текст за типа участник 
#    $redilink - линк за redirect 
#    $isclaimer - флаг дали е взискател 
//print "[$taname][$tpname][$typetext][$redilink]";

# 08.10.2010 - ново поле exdata заради Регистъра на длъжници/взискатели 
# сериализиран масив : 
# тип=1 юридическо 
#     [t1type]=$list1type типа 
//@@@#     [t1stat]=$list1stat статуса 
#     [t1fo]=0,1 чуждестранно 
#        [t1cory] код на държавата 
# тип=2 физическо 
//@@@#     [t2et]=0,1 едноличен търговец 
#     [t2fo]=0,1 чужд гражданин 
//@@@#        [t2date] рожд.дата 
#        [t2cory] код на държавата 
# тип=3 други 
#     [t3type]=$list3type типа 

						# евентуално изтриване 
						$delrec= $GETPARAM["delrec"];
						if (isset($delrec)){
							# общо за взискатели/длъжници 
							include_once "cazo34dele.ajax.php";
exit;
						}else{
						}

		# дефиниции на полетата 
		include_once "cazo34a.inc.php";

				# функция за формиране на данни за взискател/длъжник 
				include_once "cazo34d.php";

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
//var_dump($idel);

									# основен входен параметър - 
									# $idel - $taname.id - id на взискателя/длъжника 
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	if ($idel==0){
/*
							#---- полета с автоматично съдържание 
									# 23.07.2009 - Бъзински - Т.Софрониев 
									# ако е нов запис за длъжник - автоматично физич.лице 
									if ($diemess=="cazo4"){
							$_POST["idtype"]= 2;
									}else{
									}
*/
							#---- полета с автоматично съдържание - за нов запис 
							# 08.04.2010 - вече извеждаме радиобутони - затова е задължително да има съдържание 
							# - иначе назначава грешката на несъществуващо поле 
							# нов запис взискател - юрид.лице 
							# нов запис длъжник - физ.лице
									if ($diemess=="cazo4"){
							$_POST["idtype"]= 2;
									}else{
							$_POST["idtype"]= 1;
									}
							# юрид.лице - подтип=търговец 
							$_POST["t1type"]= 3;
	}else{
		$rocont= $DB->selectRow("select * from $taname where id=?" ,$idel);
		$rocont= arstrip($rocont);
//print_rr($rocont);
		foreach($filist as $finame=>$ficont){
			if ($ficont["inactive"]){
			}else{
				$_POST[$finame]= $rocont[$finame];
			}
		}
		# 08.10.2010 - заради Регистъра на длъжници/взискатели 
		$ardata= unserialize($rocont["exdata"]);
		if ($rocont{"idtype"}==1){
			$_POST["t1type"]= $ardata["t1type"];
//@@@			$_POST["t1stat"]= $ardata["t1stat"];
			$_POST["t1fo"]= $ardata["t1fo"];
			$_POST["t1cory"]= $ardata["t1cory"];
		}elseif ($rocont{"idtype"}==2){
//@@@			$_POST["t2et"]= $ardata["t2et"];
			$_POST["t2fo"]= $ardata["t2fo"];
//@@@			$_POST["t2date"]= $ardata["t2date"];
			$_POST["t2cory"]= $ardata["t2cory"];
		}else{
			$_POST["t3type"]= $ardata["t3type"];
			$_POST["buls2"]= $rocont["bulstat"];
		}
							#---- полета с автоматично съдържание 
			//# 20.04.2011 - флаг присъединен взискател 
			//if ($isclaimer){
			//	$_POST["isjoin"]= $rocont[$finame];
			//}else{
			//}
	}

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
		include_once "cazo34b.inc.php";

											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
												#---- няма ---- 
							$retucode= 0;
		# запис в БД 
		put34();
											# край - според дали има грешка 
											}

#------ допълнителен бутон - запиши с грешки СПЕЦИФИЧНО - виж шаблона 
# - заради ЕГН 
}elseif ($mfacproc=="submit2"){
	# специфична реакция - записваме с грешка, както ако няма грешки 
							$retucode= 0;
	# запис в БД 
	put34();

#------ submit с формални грешки 
}elseif ($mfacproc==NULL){
	# стандартна реакция 
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
	# redirect 
//	reload("parent",$relurl);
/**************************************************
								# 17.05.2011 - директно цялото дело към регистъра 
								if ($isclaimer){
	$smarty->assign("EXITCODE", getnyroexit($redilink));
	print smdisp($tpname,"iconv");
								}else{
	$nyex= getnyroexit($redilink);
	$nyex= str_replace($NYROREMOVE,"",$nyex);
//print "<xmp>$nyex</xmp>";
	$smarty->assign("EXITCODE", $nyex);
	$smarty->assign("ONLOAD", "document.location.href='cazo34regito.ajax.php?s=$edit';");
	print smdisp("cazo34regito.ajax.tpl","iconv");
								}
**************************************************/
				
				#-----------------------------------------------------------------------------
				# 07.06.2012 - Бъзински - НЕ СЕ ПРЕДАВА КЪМ РЕГИСТЪРА, регистъра е блокирал 
				#-----------------------------------------------------------------------------
	if (isset($relurl)){
reload("parent",$relurl);
	}else{
				$smarty->assign("EXITCODE", getnyroexit($redilink));
				print smdisp($tpname,"iconv");
	}

}else{

		include_once "cazo34c.inc.php";

//print "[$idel][$tpname]";
	# извеждаме формата 
	$smarty->assign("EDIT", $idel);
	$smarty->assign("FILIST", $filist);
	$smarty->assign("TYPETEXT", $typetext);
	$smarty->assign("ISCLAIMER", $isclaimer);
	print smdisp($tpname,"iconv");
//	$pagecont= smdisp($tpname,"iconv");
}




# отделна функция за запис в БД 
function put34(){
global $DB;
//global $ficonst, $filist;
global $idel, $taname;
	$aset= getdata34($_POST);
	if ($idel==0){
							#---- полета с автоматично съдържание 
		# нов запис 
		$idel= $DB->query("insert into $taname set ?a" ,$aset);
	}else{
							#---- полета с автоматично съдържание 
		# корекция на записа 
		$DB->query("update $taname set ?a where id=?d" ,$aset,$idel);
	}
}


?>