<?php
# игнориране на постъпление - преместваме го в таблицата finance2 
#    - копие на табл.finance с важни разлики : 
#    - полето id не е uato_increment и не е primary key 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $page - текущата страница 
# $igno - finance.id за игнориране 

# таблицата 
$taname= "finance";
# шаблона 
$tpname= "finaigno.ajax.tpl";
# полетата 
$filist= array();
# константни полета 
$ficonst= array();
# reload - след успешен събмит 
$relurl= geturl("mode=".$mode."&page=".$page);

									# класа за редактиране 
									include_once "edit.class.php";
#----------------- директно редактиране -----------------------
# главна променлива : $igno = finance.id = записа за игнориране 

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
//print_r($_POST);

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	//if ($igno==0){
	//}else{
	//}

#------ submit без формални грешки 
# = игнорирай 
}elseif ($mfacproc=="submit"){
		# копираме 
		$DB->query("insert into finance2 select * from finance where id=?d"  ,$igno);
		# изтриваме 
		$DB->query("delete from finance where id=?d"  ,$igno);
							$retucode= 0;

#------ алтернативен submit 
# = откажи 
}elseif ($mfacproc=="submit2"){
							$retucode= 0;

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
	# извеждаме формата 
									$rofina= getrow("finance",$igno);
									$smarty->assign("DATA", $rofina);
//	$smarty->assign("EDIT", $igno);
	$smarty->assign("FILIST", $filist);
//print_r($smarty->get_template_vars());
	print smdisp($tpname,"iconv");
}


?>