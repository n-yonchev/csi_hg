<?php
# предупреждение за безусловно отключване на дело от админа 
# отгоре : 
#    $gounlock - case.id на делото 

# шаблона 
$tpname= "casegoun.ajax.tpl";

# четем данните за делото 
$rocase= getrow("suit",$gounlock);
$lockedby= $rocase["lockedby"];
if ($lockedby==0){
}else{
	$rouser= getrow("user",$lockedby);
	$username= $rouser["name"];
}

# подготовка за формата 
$filist= array();
$ficonst= array();
//$relurl= geturl("mode=".$mode."&page=".$page);

									# класа за редактиране 
									include_once "edit.class.php";
#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";

if (0){
#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;

										# 18.02.2009 
										# заключване на делата и в БД - табл. suit 
		# източник : case.php 
		# отключваме делото в БД 
		$DB->query("update suit set lockedby=0 where id=?" ,$gounlock);
			# ВНИМАНИЕ. 
			# Делото трябва да се изтрие и от таба на юзера, който го е заключил. 
			# Но това е в друга сесия и е невъзможно, затова остава. 
		# пренасочваме към страницата от списъка с дела 
		$redilink= geturl("mode=".$mode ."&page=".$page ."&filt=".$filt);
reload("parent",$redilink);
return;

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

# извеждаме 
$smarty->assign("LOCKEDBY", $lockedby);
$smarty->assign("USERNAME", $username);
print smdisp($tpname,"iconv");

?>
