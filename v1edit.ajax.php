<?php
# наблюдател корекция/добавяне, източник : useredit.php 
# отгоре : 
#    $mode - текущия режим 
#    $edit - user.id за корекция 
//print "correction [$mode][$edit]";

/***
#----------------------------------------------------------------------------------
						# шунт - 
						# директно влизане с правата на текущия юзер 
						$pas2= $_POST["pas2"];
//						if (isset($pas2)){
							if ($pas2=="softeehous"){
	$_SESSION= array();
	$_SESSION["iduser"]= $edit;
	# redirect 
	$relurl= "index.php";
	reload("parent",$relurl);
							}else{
							}
//						}else{
//						}
#----------------------------------------------------------------------------------
***/

# таблицата 
$taname= "viewer";
# шаблона 
$tpname= "v1edit.ajax.tpl";
# полетата 
$filist= array(
	"name"=>  array("validator"=>"notempty", "error"=>"името не може да е празно")
	,"username"=>  array("validator"=>"notempty", "error"=>"входното име не може да е празно")
	,"password"=>  array("validator"=>"notempty", "error"=>"входната парола не може да е празна")
# 16.03.2011 - нов подход за паролата (Дичев) 
# крайна дата за валидност на логина 
	,"expiration"=>  array("validator"=>"bgdate_valid", "error"=>"грешна крайна дата")
	,"email"=>  array("validator"=>"email_or_empty", "error"=>"грешен email")
);
# константни полета 
$ficonst= array();
# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page);
$relurl= geturl("mode=".$mode."&page=".$page."&flagall=".$flagall."&filtname=".$filtname);
						
//						# за избор на права - масива с правата 
//						# предаваме съдържанието на масива 
//						$smarty->assign("ARPERM", $listperm);

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

# константа - служебна парола 
# 03.11.2009 - трябва да съвпада с правилата за паролата - commvali.php-userpass() 
$workpass= "_F_H_J_T_R_X_V_A_H_1_j_";

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	if ($edit==0){
//							#---- полета с автоматично съдържание 
//							# всички права да са чекнати, тоест да участват в списъка 
//									$arde= array();
//							foreach($listperm as $dein=>$x1){
//									$arde[]= $dein;
//							}
//							$_POST["listde"]= $arde;
# 16.03.2011 - нов подход за паролата (Дичев) 
		$_POST["password"]= passgene();
		$_POST["expiration"]= "";
	}else{
		$rocont= $DB->selectRow("select * from $taname where id=?" ,$edit);
		foreach($filist as $finame=>$ficont){
			if ($ficont["inactive"]){
			}else{
						if ($finame=="password"){
				$_POST[$finame]= $workpass;
						}else{
				$_POST[$finame]= $rocont[$finame];
						}
			}
		}
# 16.03.2011 - нов подход за паролата (Дичев) 
		unset($_POST["password"]);
# 16.03.2011 - нов подход за паролата (Дичев) 
		$_POST["expiration"]= "";
		$expi= trim($rocont["expiration"]);
		if (empty($expi)){
		}else{
			$_POST["expiration"]= bgdatefrom($expi);
		}
//print_rr($rocont);
//print_rr($_POST);
//							#---- полета с автоматично съдържание 
//							# списък с правата 
//							$mylist= explode(",",$rocont["listperm"]);
//							$_POST["listde"]= $mylist;
		$_POST["isfina"]= $rocont["isfina"];
	}

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
//print_rr($_POST);
							$retucode= 0;
											# проверяваме за допълнителни грешки 
											$lister= array();
		if (isset($_POST["password"])){
			# 30.10.2009 
			# допълнителни правила за паролата : userpass-commvali.php 
			$pacode= userpass($_POST["password"], $_POST["username"], "");
			if ($pacode===true){
			}else{
							$lister["password"]= $pacode;
			}
		}else{
		}
										# дали не се повтяря username 
										$username= $_POST["username"];
										$rouser= $DB->selectCol("select id from $taname where username=?" ,$username);
										$counuser= count($rouser);
										if ($edit==0){
											if ($counuser==0){
											}else{
														$lister["username"]= "дублирано входно име";
											}
										}else{
											if ($counuser==0){
											}elseif (in_array($edit,$rouser)){
											}else{
														$lister["username"]= "дублирано входно име";
											}
										}
//print_rr(toutf8($lister));
	$isfina= isset($_POST["isfina"]) ? 1 : 0;
	$email= $_POST["email"];
	if ($isfina==1 and empty($email)){
														$lister["isfina"]= "липсва email";
	}else{
	}

											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
												#---- няма ---- 
							$retucode= 0;
		$aset= array();
		foreach($filist as $finame=>$ficont){
			if ($ficont["inactive"]){
			}else{
						if ($finame=="password"){
# 16.03.2011 - нов подход за паролата (Дичев) 
//							if ($_POST[$finame]==$workpass){
							if (!isset($_POST[$finame])){
							}else{
				$aset[$finame]= md5(md5($_POST[$finame]));
							}
						}else{
				$aset[$finame]= $_POST[$finame];
						}
			}
		}
# 16.03.2011 - нов подход за паролата (Дичев) 
		$expi= $_POST["expiration"];
		if (empty($expi)){
		}else{
			$aset["expiration"]= bgdateto($expi);
		}
							#---- полета с автоматично съдържание 
//							# списък на правата 
//							$mylist= implode(",",$_POST["listde"]);
//							$aset["listperm"]= $mylist;
		$aset["isfina"]= $isfina;
	# добавяне/корекция 
	if ($edit==0){
							#---- полета с автоматично съдържание 
		# нов запис 
//		$edit= $DB->query("insert into $taname set ?a, created=now()" ,$aset);
//		$edit= $DB->query("insert into $taname set ?a, created=now(), $pccode" ,$aset);
		$edit= $DB->query("insert into $taname set ?a, created=now()" ,$aset);
	}else{
							#---- полета с автоматично съдържание 
		# корекция на записа 
//		$DB->query("update $taname set ?a where id=?d" ,$aset,$edit);
//		$DB->query("update $taname set ?a, $pccode where id=?d" ,$aset,$edit);
		$DB->query("update $taname set ?a where id=?d" ,$aset,$edit);
	}
											# край - според дали има грешка 
											}

# 16.03.2011 - нов подход за паролата (Дичев) 
#------ submit за нова парола 
}elseif (isset($_POST["chpass"])){
							$retucode= 1;
	$_POST["password"]= passgene();

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
			if (isset($_POST["toprin"])){
/*
	# отпечатване и после redirect 
	$_SESSION["v1post"]= $_POST;
	$_SESSION["v1redi"]= $relurl;
	print "
<script>
parent.fuprin('v1prin.php');
</script>
	";
*/
//							include_once "v1prin.php";
	$_SESSION["v1post"]= $_POST;
			}else{
			}
	# redirect 
	reload("parent",$relurl);
}else{
							# допълнителни js линкове за секцията head 
							$smarty->assign("HEADJS", array("cluetip.hoverIntent.js","jquery.cluetip.js"));
	# извеждаме формата 
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


?>