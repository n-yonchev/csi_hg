<?php
# отгоре : 
#    $mode - текущия режим 
#    $edit - user.id за корекция 
//print "correction [$mode][$edit]";

# данните за титуляра 
$rouser= getrow("user",$edit);
$smarty->assign("NAMEORIG", $rouser["name"]);
# данни за заместника му 
$iddepu= $DB->selectCell("select iduserdepu from userdepu where iduserorig=?d"  ,$edit);
//print $edit;
//var_dump($iddepu);

# таблицата 
$taname= "userdepu";
# шаблона 
$tpname= "depuedit.ajax.tpl";
# полетата 
/*
$filist= array(
	"name"=>  array("validator"=>"notempty", "error"=>"името не може да е празно")
	,"username"=>  array("validator"=>"notempty", "error"=>"входното име не може да е празно")
	,"password"=>  array("validator"=>"notempty", "error"=>"входната парола не може да е празна")
# списък на правата - косвено определя полето lisrperm 
# - масив от полета checkbox 
	,"listde"=>  array("inactive"=>true)
);
*/
$filist= array();
# константни полета 
$ficonst= array();
# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page);
$relurl= geturl("mode=".$mode);

									# класа за редактиране 
									include_once "edit.class.php";

#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
//print_rr($_POST);

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
//	if ($edit==0){
		$_POST["iduserdepu"]= $iddepu;
//	}else{
//		$rocont= $DB->selectRow("select * from $taname where id=?" ,$edit);
//	}

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
											# проверяваме за допълнителни грешки 
											$lister= array();
	$iduserdepu= $_POST["iduserdepu"];
	if ($iduserdepu+0==0){
											$lister["iduserdepu"]= "не е избран";
	}else{
	}

											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
												#---- няма ---- 
							$retucode= -2;
	$smarty->assign("ACTION",true);
		$iduserdepu= $_POST["iduserdepu"];
		$rodepu= getrow("user",$iduserdepu);
	$smarty->assign("NAMEDEPU",$rodepu["name"]);
		$rodepuold= getrow("user",$iddepu);
	$smarty->assign("NAMEDEPUOLD",$rodepuold["name"]);
//print_rr($rodepu);
				# брой дела за прехвърляне 
				$coun= $DB->selectCell("select count(*) from suit where iduser=?d"  ,$edit);
	$smarty->assign("COUNORIG",$coun);
											# край - според дали има грешка 
											}

#------ submit без формални грешки 
# потвърдено заместване - временно 
}elseif ($mfacproc=="submyes"){
							$retucode= 0;
//	$DB->query("delete from $taname where id=?" ,$dele);
															$DB->query("lock tables userdepu write, suit write");
		# избрания заместник 
		$iduserdepu= $_POST["iduserdepu"];
		# нов запис за заместване 
		$aset= array();
		$aset["iduserdepu"]= $iduserdepu;
		$aset["iduserorig"]= $edit;
		$DB->query("insert into $taname set ?a" ,$aset);
				# самото заместване на делата 
				$bset= array();
				$bset["iduser"]= $iduserdepu;
				$bset["iduser2"]= $edit;
						# ВАЖНО. Отключваме евент.заключените дела от титуляра. 
						# Иначе са възможни проблеми при отварянето им от заместника. 
				$bset["lockedby"]= 0;
				$DB->query("update suit set ?a where iduser=?d" ,$bset,$edit);
															$DB->query("unlock tables");

#------ submit без формални грешки 
# потвърдено прехвърляне - ПОСТОЯННО 
}elseif ($mfacproc=="submperm"){
							$retucode= 0;
//															$DB->query("lock tables userdepu write, suit write");
		# избрания заместник 
		$iduserdepu= $_POST["iduserdepu"];
/*
		# нов запис за заместване 
		$aset= array();
		$aset["iduserdepu"]= $iduserdepu;
		$aset["iduserorig"]= $edit;
		$DB->query("insert into $taname set ?a" ,$aset);
*/
				# самото заместване на делата 
				$bset= array();
				$bset["iduser"]= $iduserdepu;
//				$bset["iduser2"]= $edit;
						# ВАЖНО. Отключваме евент.заключените дела от титуляра. 
						# Иначе са възможни проблеми при отварянето им от заместника. 
				$bset["lockedby"]= 0;
				$DB->query("update suit set ?a where iduser=?d" ,$bset,$edit);
//															$DB->query("unlock tables");

#------ допълнителен бутон 
# отказ от заместване 
}elseif ($mfacproc=="submno"){
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
							//# допълнителни js линкове за секцията head 
							//$smarty->assign("HEADJS", array("cluetip.hoverIntent.js","jquery.cluetip.js"));
				# списък с възможните заместници 
				# всички без титуляра и без тези, които вече имат заместник 
				$depulist= $DB->selectCol("
					select user.id as ARRAY_KEY, user.name
					from user
$frjoin
							left join userdepu on user.id=userdepu.iduserorig
where 1 $frwher
					and user.id<>$edit and userdepu.iduserdepu is null
$frgrou
					order by user.name
					");
				$depulist= array(0=>"") + $depulist;
//$depulist= tran1251($depulist);
//print_rr($depulist);
				$smarty->assign("ARDEPUNAME", "depulist");
	# извеждаме формата 
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


?>