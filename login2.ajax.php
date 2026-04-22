<?php
# 02.11.2009 - смяна на паролата на всеки 2 месеца 
# $_SESSION["iduser"] - юзера 

									session_start();
									include_once "common.php";
									
									# класа за редактиране 
									include_once "edit.class.php";
# полетата 
$filist= array(
	"cupass"=> array("validator"=>"notempty", "error"=>"текущата парола не може да е празна")
	,"pass1"=> array("validator"=>"notempty", "error"=>"новата парола не може да е празна")
	,"pass2"=> NULL
);

# юзера 
$iduser= $_SESSION["iduser"];
$rouser= getrow("user",$iduser);
$smarty->assign("USERNAME", $rouser["name"]);

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

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
											# проверяваме за допълнителни грешки 
											$lister= array();
					# дали текущата парола съвпада с БД 
					$cupass= $_POST["cupass"];
					$cupass= md5(md5($cupass));
					if ($cupass==$rouser["password"]){
					}else{
											$lister["cupass"]= "текущата парола е грешна";
					}
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
					# новата парола 
					$aset["password"]= md5(md5($pass1));
					# историята 
							$pahist= unserialize($rouser["passhist"]);
							$cutime= date("Y-m-d H:i:s");
							$pahist[$cutime]= $aset["password"];
					$aset["passhist"]= serialize($pahist);
					# датата на новата парола 
					$pccode= "passcrea=now()";
				# обновяваме записа за юзера 
				$DB->query("update user set ?a, $pccode where id=?d" ,$aset,$iduser);
//	reload("","login.ajax.php");
	# имитираме нормалния вход 
	$_POST["username"]= $rouser["username"];
	$_POST["password"]= toutf8($pass1);
	$mfacproc= "submit";
	include "login.ajax.php";
}else{
//						# допълнителни js линкове за секцията head 
//						$smarty->assign("HEADJS", "_login2.ajax.js");
						# допълнителни js линкове за секцията head 
						$smarty->assign("HEADJS", array("_login2.ajax.js","cluetip.hoverIntent.js","jquery.cluetip.js"));
	# извеждаме 
	//$smarty->assign("USERLISTNAME", "userlist");
	$smarty->assign("FILIST", $filist);
	print smdisp("login2.ajax.tpl","iconv");
}


?>
