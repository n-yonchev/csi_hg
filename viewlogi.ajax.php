<?php
# логин 
# директно използване на формата 

								session_name("PHPID");
									session_start();
									include_once "common.php";
									
									# класа за редактиране 
									include_once "edit.class.php";
# полетата 
$filist= array(
	"username"=>  array("validator"=>"notempty", "error"=>"името не може да е празно")
	,"password"=>  array("validator"=>"notempty", "error"=>"паролата не може да е празна")
);

#---- константи 
# reload URL 
$relurl= "view.php";

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";

//# във всички случаи - списъка 
//$userlist= getselect("user","name","inactive=0",false);

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
				# 26.03.2009 - IP statistics 
				$errtype= 0;
				$idus= 0;
											# проверяваме за допълнителни грешки 
											$lister= array();
											# дали съвпадат username, password 
											$username= $_POST["username"];
											$password= $_POST["password"];
											$mdpass= md5(md5($password));
											$rouser= $DB->selectCol("select id from viewer where username=? and password=?" ,$username,$mdpass);
											$counuser= count($rouser);
												if ($counuser==0){
														$lister["username"]= "грешни входни данни";
														$lister["password"]= "грешни входни данни";
				# 26.03.2009 - IP statistics 
				$errtype= 3;
												}elseif ($counuser>1){
														$lister["username"]= "дублирани входни данни";
														$lister["password"]= "дублирани входни данни";
				# 26.03.2009 - IP statistics 
				$idus= $rouser[0];
				$errtype= 3;
												}else{
													$idus= $rouser[0];
													$rowork= $DB->selectCol("select inactive from viewer where id=?d" ,$idus);
									//var_dump($idus);
									//print_r($rowork);
													if ($rowork[0]==0){
													}else{
														$lister["username"]= "неактивен потребител";
														$lister["password"]= "неактивен потребител";
				# 26.03.2009 - IP statistics 
				$errtype= 3;
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
											}

#------ submit с формални грешки 
}elseif ($mfacproc==NULL){
							$retucode= 1;
	doerrors();
				# 26.03.2009 - IP statistics 
				$errtype= 3;

#------ автоматичен submit 
}elseif ($mfacproc=="UNKNOWN"){
							$retucode= 2;

#------ невъзможна грешка от библиотеката 
}else{
print "<br>error=mfacproc=";
var_dump($mfacproc);
die();
}

/*
# във всички случаи - след събмит 
$iduser= $_POST["iduser"];
if ($iduser){
									# създаваме сесия чак тук 
									session_start();
	$_SESSION["iduser"]= $iduser;
	reload("parent",$relurl);
}else{
}
*/
			# 26.03.2009 - IP control 
			#----------------------------------------------------------------------
			if ($mfacproc=="INIT"){
			}else{
//				$rooffi= getofficerow($iduser);
//				list($ipacti,$ipmail,$ipmes1,$ipmes2)= explode("^",$rooffi["ipparams"]);
//				if ($ipacti==0){
				$arpa= getipparams();
				if ($arpa["acti"]==0){
//					$err2= 0;
				}else{
#------ проверка в таблицата с ip -----------------------------------
# резултат : $errtype= 2;
											//$_SERVER["REMOTE_ADDR"]= "192.168.21.45";
$ipaddr= $_SERVER["REMOTE_ADDR"];
/****
$ipcoun= $DB->selectCell("select count(*) from iplist where ipaddr=?" ,$ipaddr);
if ($ipcoun==0){
****/
														# 30.10.2009 - 
														# проверяваме IP и неговите 3 по-старши мрежи 
					$ipfound= false;
														while (true){
//print "[$ipaddr]";
									$ipco= $DB->selectCell("select count(*) from iplist where ipaddr=?" ,$ipaddr);
									if ($ipco==0){
										$myposi= strrpos($ipaddr,".");
										if ($myposi===false){
											# няма по-старша - IP не е намерено 
											break;
										}else{
											# формираме по-старшата мрежа 
											$ipaddr= substr($ipaddr,0,$myposi);
											# продължаваме цикъла с проверката 
										}
									}else{
					$ipfound= true;
										break;
									}
														}
if ($ipfound===false){
				$errtype= 2;
							# отгоре имаме : $errtype, $idus 
							include_once "iperror2.php";
				exit;
}else{
}
				}
# в протокола 
# отгоре имаме : $errtype, $idus 
putiplog($errtype,$idus);
			}
			#----------------------------------------------------------------------

# ако всичко е ОК 
if ($retucode==0){
									//# създаваме сесия чак тук 
									//session_start();
	$iduser= $rouser[0];
	$_SESSION["iduser"]= $iduser;

/*	
#----------------------------------------------------------------------------------
# 02.11.2009 - смяна на паролата на всеки 2 месеца 
$rous= getrow("user",$iduser);
if ($rous["type"]==ADMINTYPE and $rous["created"]==ADMINSPECTIME){
}else{
	$passcrea= $rous["passcrea"];
	if ($passcrea==""){
//die("pass.crea");
reload("","login2.ajax.php");
	}else{
		list($usdate,$ushour)= explode(" ",$passcrea);
		list($usye,$usmo,$usda)= explode("-",$usdate);
//print"[$usye][$usmo][$usda]";
		$lastdate= mktime(0,0,1, $usmo+2,$usda,$usye);
//var_dump(time());
//var_dump($lastdate);
		if (time()<=$lastdate){
		}else{
reload("","login2.ajax.php");
		}
	}
}
#----------------------------------------------------------------------------------

												# 18.02.2009 
												# заключване на делата и в БД - табл. suit 
								# записваме в сесията всички заключени дела от логнатия юзер 
								# източник : caseedit.php -  записване делото в списъка с отворените табове 
								$datalock= $DB->select("select * from suit where lockedby=?" ,$iduser);
								foreach($datalock as $ellock){
											$idlock= $ellock["id"];
									$mytext= $ellock["serial"]."/".$ellock["year"];
//									$editel= "mode=$mode&page=$page&filt=$filt&edit=$edit";
											# ВНИМАНИЕ. 
											# елементите да са съгласувани с константите в index.php и др. 
											$editel= "mode=case&edit=$idlock";
									$mylink= geturl($editel ."");
	$_SESSION["tabs"][$idlock]= array("text"=>$mytext, "link"=>$mylink, "mark"=>($iduser<>$ellock["iduser"]) );
								}
*/
	reload("parent",$relurl);
}else{

						# допълнителни js линкове за секцията head 
						$smarty->assign("HEADJS", "_login.ajax.js");
	# извеждаме 
	//$smarty->assign("USERLISTNAME", "userlist");
	$smarty->assign("FILIST", $filist);
	print smdisp("viewlogi.ajax.tpl","iconv");
}



?>
