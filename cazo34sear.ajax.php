<?php
# 3-то ниво - 
# извежда списък с намерени взискатели/длъжници по зададен код егн/булстат 
# вика се директно с НЕКРИПТИРАН параметричен низ 

									# вика се самостоятелно, а не с include 
									session_start();
									include_once "common.php";

# ВНИМАНИЕ. 
# Необходима е проверка срещу директно извикване. 

# сесийните параметри 
$iduser= @$_SESSION["iduser"];

//sleep(1);
//print "CAZO34SEAR====";
# входните параметри 
$para= $_GET["para"];
//print $para;
//print_r(parse_url($para));
list($type,$content)= explode("/",$para);
$content= trim($content);
//print "[$type][$content]";

# според типа на търсенето 
if (0){
}elseif ($type=="egn"){
	$idtype= 2;
	$tpname= "cazo34sear2.ajax.tpl";
//	$filist= array("egn","name","address","agent");
//	$filist= array("egn","name","address","agent"   ,"iban","bic");
	# копира и полетата за съпруг 
//	$filist= array("egn","name","address","agent"   ,"iban","bic"   ,"name2","egn2","address2");
	# 08.01.2010 - и полето за коментар 
	$filist= array("egn","name","address","agent"   ,"iban","bic"   ,"name2","egn2","address2"  ,"notes");
							# 03.08.2009 - Бъзински - Софрониев 
							# специално за длъжник физическо лице - търси и в ЕГН на съпруг 
							$filt2= "or lower(debtor.egn2) like lower(?)";
}elseif ($type=="bulstat"){
	$idtype= 1;
	$tpname= "cazo34sear1.ajax.tpl";
//	$filist= array("bulstat","name","address","agent","regidocu","regidate","regicase");
	$filist= array("bulstat","name","address","agent","regidocu","regidate","regicase"   ,"iban","bic");
							# 03.08.2009 - Бъзински - Софрониев 
							$filt2= "";
}else{
die("cazo34sear=type=$type");
}
//var_dump($filt2);
# филтъра 
$mycont= "%".$content."%";
//$filter= "idtype=$idtype and lower($type) like lower($mycont)";
# заявката 
//$data= $DB->select("select * from claimer where idtype=? and $type like ?" ,$idtype,$mycont);
//$data= $DB->select("select * from claimer where idtype=? and lower($type) like lower(?)" ,$idtype,$mycont);
/****
$query= "(
	select claimer.*, claimer.id as id, 'c' as role
	, suit.serial as caseseri, suit.year as caseyear
	from claimer 
	left join suit on claimer.idcase=suit.id
	where claimer.idtype=? and lower(claimer.$type) like lower(?)
		) union	(
	select debtor.*, debtor.id as id, 'd' as role
	, suit.serial as caseseri, suit.year as caseyear
	from debtor 
	left join suit on debtor.idcase=suit.id
	where debtor.idtype=? and lower(debtor.$type) like lower(?)
		)";
****/
		# 26.03.2009 
		# само уникалните по ЕГН/булстат + наименованието + адвоката 
		# вече не участва делото, а само ролята 
		# иначе списъка става много дълъг напр.за ОББ 
$query= "(
	select claimer.*, 'c' as role
	from claimer 
	where claimer.idtype=? and lower(claimer.$type) like lower(?)
	group by name, agent
		) union	(
	select debtor.*, 'd' as role
	from debtor 
	where debtor.idtype=? and ( lower(debtor.$type) like lower(?)
							$filt2 )
	group by name, agent
		)";
//	where debtor.idtype=? and lower(debtor.$type) like lower(?)
//$data= $DB->select($query ,$idtype,$mycont ,$idtype,$mycont);
$data= $DB->select($query ,$idtype,$mycont ,$idtype,$mycont
							,$mycont);
$data= dbconv($data);

# извеждаме страницата 
$smarty->assign("DATA", $data);
$smarty->assign("CODECONT", to1251($content));
$smarty->assign("FILIST", $filist);

$pagecont= smdisp($tpname,"iconv");
print $pagecont;

?>