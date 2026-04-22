<?php
# 05.10.2010 - профил на логнатия юзер 
# източници : login2.ajax.php, useredit.ajax.php 
# вика се директно в прозорец 

									session_start();
									include_once "common.php";

//print "USERPROF.AJAX";
# логнатия юзер 
$iduser= @$_SESSION["iduser"];
if (isset($iduser)){
}else{
//	redirect("login.php");
	print "
<script>
parent.document.location.href= 'login.php';
</script>
	";
exit;
}
//$iduser= $_SESSION["iduser"];
$rouser= getrow("user",$iduser);
$smarty->assign("USERNAME", $rouser["name"]);
									
									# класа за редактиране 
									include_once "edit.class.php";
# полетата 
$filist= array(
	"pass1"=> array("validator"=>"notempty", "error"=>"новата парола не може да е празна")
	,"pass2"=> NULL
	,"mainplan"=> NULL
);

# константа - служебна парола 
# 03.11.2009 - трябва да съвпада с правилата за паролата - commvali.php-userpass() 
$workpass= "_I_Q_J_L_R_O_P_G_H_1_g_";


				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
//print_r($_POST);


# обработка на формата 
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	$_POST= array();
	$_POST["pass1"]= $workpass;
	$_POST["pass2"]= $workpass;
	$_POST["mainplan"]= $rouser["mainplan"];

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
											# проверяваме за допълнителни грешки 
											$lister= array();
/*
					# дали текущата парола съвпада с БД 
					$cupass= $_POST["cupass"];
					$cupass= md5(md5($cupass));
					if ($cupass==$rouser["password"]){
					}else{
											$lister["cupass"]= "текущата парола е грешна";
					}
*/
					# дали двете нови пароли съвпадат 
					$pass1= $_POST["pass1"];
					$pass2= $_POST["pass2"];
					if ($pass1==$pass2){
						# съвпадат 
						# дали новата парола отговаря на правилата - userpass-commvali.php 
						# източник : useredit.ajax.php 
						$passhist= $rouser["passhist"];
						$pacode= userpass($pass1, $rouser["username"], $passhist);
						if ($pacode===true){
						}else{
											$lister["pass1"]= $pacode;
											$lister["pass2"]= $pacode;
						}
					}else{
											$lister["pass1"]= "новите пароли не съвпадат";
											$lister["pass2"]= "новите пароли не съвпадат";
					}
											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
												#---- няма ---- 
							$retucode= 0;
											}

#------ submit с формални грешки 
}elseif ($mfacproc==NULL){
							$retucode= 1;
	doerrors();

#------ автоматичен submit 
}elseif ($mfacproc=="UNKNOWN"){
							$retucode= 2;

#------ невъзможна грешка от библиотеката 
}else{
print "<br>error=mfacproc=";
var_dump($mfacproc);
die();
}

# ако всичко е ОК 
if ($retucode==0){
					# подготвяме записа за юзера 
					$aset= array();
$aset["mainplan"]= $_POST["mainplan"];
					# за новата парола 
					if ($_POST["pass1"]==$workpass){
						$pccode= "";
					}else{
						# смяна на паролата 
						$aset["password"]= md5(md5($pass1));
						# историята 
							$pahist= unserialize($rouser["passhist"]);
							$cutime= date("Y-m-d H:i:s");
							$pahist[$cutime]= $aset["password"];
						$aset["passhist"]= serialize($pahist);
						# датата на новата парола 
						$pccode= ",passcrea=now()";
					}
				# обновяваме записа за юзера 
				$DB->query("update user set ?a $pccode where id=?d" ,$aset,$iduser);
/*
//	reload("","login.ajax.php");
	# имитираме нормалния вход 
	$_POST["username"]= $rouser["username"];
	$_POST["password"]= toutf8($pass1);
	$mfacproc= "submit";
	include "login.ajax.php";
*/
	print "
<script>
parent.document.location.reload();
</script>
	";
exit;
}else{
						# за избор на изгледа 
						$armainplan= array();
							$armainplan[""]= "";
							//$armainplan["1"]= "в 2-3 колони";
							//$armainplan["2"]= "в една колона";
							$armainplan["1"]= "вар.1 - шахматно";
							$armainplan["2"]= "вар.2 - вертикално";
						$armainplan= toutf8($armainplan);
						$smarty->assign("ARPLANNAME", "armainplan");
//						# допълнителни js линкове за секцията head 
//						$smarty->assign("HEADJS", "_login2.ajax.js");
						# допълнителни js линкове за секцията head 
						//$smarty->assign("HEADJS", array("_login2.ajax.js","cluetip.hoverIntent.js","jquery.cluetip.js"));
						$smarty->assign("HEADJS", array("cluetip.hoverIntent.js","jquery.cluetip.js"));
	# извеждаме 
	//$smarty->assign("USERLISTNAME", "userlist");
	$smarty->assign("FILIST", $filist);
	print smdisp("userprof.ajax.tpl","iconv");
}


?>
