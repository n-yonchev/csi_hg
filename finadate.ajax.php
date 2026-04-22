<?php
# корекция на датата за погасяването - за приключено постъпление по текущото дело 
# източник : 
#    finaclos.ajax.php - приключване на постъпление 
# отгоре : 
#    $date- finance.id за корекция 
//print_r($GETPARAM);


# таблицата 
$taname= "finance";
# шаблона 
$tpname= "finadate.ajax.tpl";
# полетата 
//$filist= array();
$filist= array(
//	"datebala"=> array("validator"=>"bgdate_valid", "transformer"=>"getputbgdate")
//	"datebala"=> array("validator"=>"bgdate_valid")
	# февр.2020 - актуален дълг 
	# дата може и да е празна 
//	"datebala"=> array("validator"=>"bgdate_valid_notempty", "transformer"=>"getputbgdate")
	"datebala"=> array("validator"=>"bgdate_valid", "transformer"=>"getputbgdate")
);
# константни полета 
$ficonst= array();

# reload - след успешен събмит 
$relurl= geturl("mode=".$mode."&page=".$page);

# данните за постъплението 
$rocont= getrow("finance",$date);

									# класа за редактиране 
									include_once "edit.class.php";

# редактиране 
$obedit= new edit($taname,$date,$filist,$ficonst);
# действие 
$reedit= $obedit->action();


# резултат 
//if ($retucode==0){
if ($reedit==0){
	# добавяме записа в архива 
	finaarchive($date);
							# ако е извикан алтернативно от дело 
							if ($CALLFROMCASE){
				# redirect 
							#---- януари-2010 актуален дълг ----
//				$smarty->assign("EXITCODE", getnyroexit("tpaymlink"));
							$redilink= array("tpaymlink","tactulink");
							$smarty->assign("EXITCODE", getnyroexit($redilink));
				print smdisp($tpname,"iconv");
							}else{
	# redirect 
	reload("parent",$relurl);
							}
}else{
	# извеждаме формата 
	$smarty->assign("DATA", $rocont);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
//	$pagecont= smdisp($tpname,"iconv");
}


?>
