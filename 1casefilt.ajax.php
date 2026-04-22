<?php
# въвеждане/корекция на филтър за списък дела 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим на глав.меню   =="case" 
#    $filt - режим за филтъра   =="change" 
//#    $filtcont - евент.съдържание на филтъра 
#    $page - към коя страница на списъка да преминем след submit 
# сесията : 
#    ["filtco"] - масив с полетата от филтъра 

# шаблона 
$tpname= "casefilt.ajax.tpl";
								# всичко за филтъра по делата 
								include_once "casefilt.inc.php";
								$filist= $filterlist;


# константни полета 
$ficonst= array("iduser"=>$iduser);

# reload - след успешен събмит 
$relurl= geturl("mode=".$mode ."&page=".$page ."&filt=yes");

#----------------- директно редактиране -----------------------

									# класа за редактиране 
									# само заради функцията doerrors 
									include_once "edit.class.php";
									
				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
//		$_POST["filtco"]= $_SESSION["filter"];
		$_POST= $_SESSION["filtco"];
							# 09.07.2009 - без jscalendar 
							$exafte= $_POST["exafte"];
							$_POST["exafte"]= empty($exafte) ? $exafte : bgdatefrom($exafte);
							$exbefo= $_POST["exbefo"];
							$_POST["exbefo"]= empty($exbefo) ? $exbefo : bgdatefrom($exbefo);
											
		
#------ submit за изчистване на полетата 
}elseif ($mfacproc=="clear"){
							$retucode= 1;
		unset($_SESSION["filtco"]);
		unset($_POST);
		
#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
											# проверяваме за допълнителни грешки 
											$lister= array();
											
									#---------------------------------------------------------------
									# датите - създадено след и преди 
									$exafte= $_POST["exafte"];
									$exbefo= $_POST["exbefo"];
							# 09.07.2009 - без jscalendar 
							# - формална проверка на датите 
							$resuafte= validator_bgdate_valid($exafte,"");
							$resubefo= validator_bgdate_valid($exbefo,"");
								$datevali= true;
							if ($resuafte===true){
							}else{
								$datevali= false;
											$lister["exafte"]= $resuafte[0];
							}
							if ($resubefo===true){
							}else{
								$datevali= false;
											$lister["exbefo"]= $resubefo[0];
							}
							# - проверка на периода 
							if ($datevali){
								$exafte= empty($exafte) ? $exafte : bgdateto($exafte);
								$exbefo= empty($exbefo) ? $exbefo : bgdateto($exbefo);
									if (!empty($exafte) and !empty($exbefo) and $exafte>$exbefo){
											$lister["exafte"]= "грешен период";
											$lister["exbefo"]= "грешен период";
									}else{
									}
							}else{
							}
/*
									# ако има поле от група-3 [участници], трябва да е избран обхват 
											$yes3= false;
									foreach($_POST as $poname=>$pocont){
//print "<br> $poname";
										if ($filist[$poname]["group"]==3 and !$filist[$poname]["spec"] and !empty($pocont)){
											$yes3= true;
											break;
										}else{
										}
									}
									if ($yes3 and $_POST["merang"]==0){
											$lister["merang"]= "избери обхват";
									}else{
									}
*/
					# ВНИМАНИЕ. 06.04.2010 - Софрониев 
					# Вече има отделни полета за взискател и длъжник 
					# - няма избор на обхват 
									#---------------------------------------------------------------
											
											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
							$retucode= 1;
	$smarty->assign("LISTER",$lister);
											}else{
												#---- няма ---- 
							$retucode= 0;
//		$_SESSION["filter"]= $_POST["filtco"];
							# 09.07.2009 - без jscalendar 
							//$_POST["exafte"]= empty($exafte) ? $exafte : bgdateto($exafte);
							//$_POST["exbefo"]= empty($exbefo) ? $exbefo : bgdateto($exbefo);
							$_POST["exafte"]= $exafte;
							$_POST["exbefo"]= $exbefo;
		$_SESSION["filtco"]= $_POST;
											# край - според дали има грешка 
											}

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
	# redirect 
	reload("parent",$relurl);
}else{

						# за избор на година [exyear] - предаваме името, а не съдържанието на масива 
						# $listyear - отгоре - commspec.php 
						$smarty->assign("ARYEARNAME", "listyear");
/*
						# за избор на "идва от" - кеширания UTF-8 масив 
						$arfrom= unserialize(file_get_contents(COFROMFILE.SUFFUTF8));
						# предаваме името, а не съдържанието на масива 
						$smarty->assign("ARFROMNAME", "arfrom");
*/
			# за избор на "идва от" - option/optgroup - името на масива 
			$arfrom= selcofrom();
			$smarty->assign("ARFROMNAME", "arfrom");
						# за избор на "титул" - масива $listtitu - commspec.php 
						# предаваме името, а не съдържанието на масива 
						$smarty->assign("ARTITUNAME", "listtitu_utf8");
//						# за избор на "подтитул" - масива $listsubtit - commspec.php 
//						# предаваме името, а не съдържанието на масива 
//						$smarty->assign("ARSUBTNAME", "listsubtit_utf8");
						# за избор на "вид дело" - масива $listsort - commspec.php 
						# предаваме името, а не съдържанието на масива 
						$smarty->assign("ARSORTNAME", "listsort_utf8");

						# за избор на обхват на участниците - предаваме името, а не съдържанието на масива 
						# $listcaserang - отгоре - commspec.php 
						$smarty->assign("ARRANGNAME", "listcaserang_utf8");
						# за избор на тип за участник - предаваме името, а не съдържанието на масива 
						# $listmembtype - отгоре - commspec.php 
						$smarty->assign("ARTYPENAME", "listmembtype_utf8");

								# 17.04.2009 - за избор на деловодител 
								# не може да се филтрират делата, които нямат деловодител 
								$userlist= getselect("user","name","1",true);
								# предаваме името, а не съдържанието на масива 
								$smarty->assign("ARUSERNAME", "userlist");

						# 26.05.2009 - добавяме и ред за отчета, текущ статус и характер на изпълнението 
						# не може да се филтрират делата, за които съответния указател е нулев 
						# предаваме името, а не съдържанието на масива 
						$smarty->assign("ARREPONAME", "listrepo_utf8");
						$smarty->assign("ARSTATNAME", "listcasestat_utf8");
						$smarty->assign("ARCHARNAME", "listchartype_utf8");

	# извеждаме формата 
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


?>