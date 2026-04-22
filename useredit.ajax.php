<?php
# отгоре : 
#    $mode - текущия режим 
#    $edit - user.id за корекция 
//print "correction [$mode][$edit]";


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


# таблицата 
$taname= "user";
# шаблона 
$tpname= "useredit.ajax.tpl";
# полетата 
$filist= array(
	"name"=>  array("validator"=>"notempty", "error"=>"името не може да е празно")
	,"username"=>  array("validator"=>"notempty", "error"=>"входното име не може да е празно")
	,"password"=>  array("validator"=>"notempty", "error"=>"входната парола не може да е празна")
# списък на правата - косвено определя полето lisrperm 
# - масив от полета checkbox 
	,"listde"=>  array("inactive"=>true)
,"email"=>  array("validator"=>"email_or_empty", "error"=>"грешен email")
,"phone"=> NULL
											# 20.04.2015 масово сканиране 
,"codeprin"=> NULL
);
# константни полета 
$ficonst= array();
# reload - след успешен събмит 
$relurl= geturl("mode=".$mode."&page=".$page);
						
						# за избор на права - масива с правата 
						# предаваме съдържанието на масива 
						$smarty->assign("ARPERM", $listperm);

									# класа за редактиране 
									include_once "edit.class.php";

#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";

# константа - служебна парола 
# 03.11.2009 - трябва да съвпада с правилата за паролата - commvali.php-userpass() 
$workpass= "_I_Q_J_L_R_O_P_G_H_1_g_";

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	if ($edit==0){
							#---- полета с автоматично съдържание 
							# всички права да са чекнати, тоест да участват в списъка 
									$arde= array();
							foreach($listperm as $dein=>$x1){
									$arde[]= $dein;
							}
							$_POST["listde"]= $arde;
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
							#---- полета с автоматично съдържание 
							# списък с правата 
							$mylist= explode(",",$rocont["listperm"]);
							$_POST["listde"]= $mylist;
	}

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
											# проверяваме за допълнителни грешки 
											$lister= array();
			# 30.10.2009 
			# допълнителни правила за паролата : userpass-commvali.php 
			if ($edit==0){
				$passhist= "";
			}else{
				$rocont= $DB->selectRow("select * from $taname where id=?" ,$edit);
				$passhist= $rocont["passhist"];
			}
			$pacode= userpass($_POST["password"], $_POST["username"], $passhist);
			if ($pacode===true){
			}else{
							$lister["password"]= $pacode;
			}
											# дали има поне един елемент от правата 
											if (isset($_POST["listde"])){
											}else{
														$lister["listde"]= "задължително поне едно право";
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
							if ($_POST[$finame]==$workpass){
							}else{
				$aset[$finame]= md5(md5($_POST[$finame]));
							}
						}else{
				$aset[$finame]= $_POST[$finame];
						}
			}
		}
							#---- полета с автоматично съдържание 
							# списък на правата 
							$mylist= implode(",",$_POST["listde"]);
							$aset["listperm"]= $mylist;
	# 30.10.2009 
	# историята 
			if ($passhist==""){
				$arhist= array();
			}else{
				$arhist= unserialize($passhist);
			}
			$cutime= date("Y-m-d H:i:s");
			$arhist[$cutime]= $aset["password"];
							$aset["passhist"]= serialize($arhist);
	# датата на новата парола 
	$pccode= "passcrea=now()";
	# добавяне/корекция 
	if ($edit==0){
							#---- полета с автоматично съдържание 
		# нов запис 
//		$edit= $DB->query("insert into $taname set ?a, created=now()" ,$aset);
		$edit= $DB->query("insert into $taname set ?a, created=now(), $pccode" ,$aset);
	}else{
							#---- полета с автоматично съдържание 
		# корекция на записа 
//		$DB->query("update $taname set ?a where id=?d" ,$aset,$edit);
		$DB->query("update $taname set ?a, $pccode where id=?d" ,$aset,$edit);
	}
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
											# 20.04.2015 масово сканиране 
												include_once "scan.inc.php";
											$aruserprin= getprinsele();
							$smarty->assign("ARUSERPRINNAME", "aruserprin");

	# извеждаме формата 
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
//sdisplay(1, "eeee.html", $tpname);
//print "<xmp>".smdisp($tpname,"iconv")."</xmp>";
	print smdisp($tpname,"iconv");
}


?>