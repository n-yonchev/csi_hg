<?php
# зона-adva : авансови вноски от взискателите по делото 
# отгоре : 
#    $edit= case.id 
#    $zone= adva 
#    $func= view, modi 
//print "[$edit][$zone][$func]";
//print_r($GETPARAM);
//print session_name();
//print session_name()."=".session_id();

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

# таблицата 
$taname= "claimadva";
# шаблона 
$tpname= "cazoadva.tpl";
		
								# за тип на плащане 
								$arpatype= array();
								$arpatype[0]= "";
								$arpatype[1]= "в брой";
								$arpatype[2]= "по банка";
							$smarty->assign("ARPATYPE", $arpatype);
							$arpatype_utf8= toutf8($arpatype);
							$smarty->assign("ARPATYPENAME", "arpatype_utf8");

							# корекция на избрана вноска 
							# вика се в ajax прозорец 
							$editadva= $GETPARAM["editadva"];
							if (isset($editadva)){
										include_once "cazoadvamodi.ajax.php";
										exit;
							}else{
							}
							# изтриване на избрана вноска 
							$deleadva= $GETPARAM["deleadva"];
							if (isset($deleadva)){
										include_once "cazoadvadele.ajax.php";
										exit;	
							}else{
							}
							# отпечатване ПКО за избрана вноска 
							$prinadva= $GETPARAM["prinadva"];
							if (isset($prinadva)){
										include_once "cazoadvaprin.ajax.php";
										exit;	
							}else{
							}

# 12.04.2011 - финансиста да може да корегира аванс.постъпления 
# - дали логнатия е финансист 
//								$finalo= false;
$rouser= getrow("user",$iduser=$_SESSION["iduser"]);
$arperm= explode(",",$rouser["listperm"]);
		if (array_search(4,$arperm)===false){
		}else{
$smarty->assign("FINALOGGED", true);
//								$finalo= true;
		}

# основните параметри 
//$modeel= "edit=$edit&zone=$zone&func=modi";
$modeel= "edit=".$edit."&zone=".$zone."&func=".$func;
# add new link 
$addnew= geturl($modeel."&editadva=0");

# списъка 
$filter= "where claimer.idcase=$edit";
//$mylist= $DB->select("select * from claimer $filter order by id");
$mylist= $DB->select("select $taname.*, $taname.id as id
	, claimer.name as clainame
	from $taname
	left join claimer on claimadva.idclaimer=claimer.id
	$filter 
	order by date desc
	");
$mylist= dbconv($mylist);
//print_rr($mylist);

# трансформираме го - параметри за иконите 
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
	$mylist[$uskey]["editadva"]= geturl($modeel."&editadva=".$idcurr);
	$mylist[$uskey]["deleadva"]= geturl($modeel."&deleadva=".$idcurr);
	$mylist[$uskey]["prinadva"]= geturl($modeel."&prinadva=".$idcurr);
}

# рекапитулация по взискатели 
						# взискателите 
						$arclai= getselect("claimer","name","idcase=$edit",false);
						$arclai= dbconv($arclai);
						$smarty->assign("ARCLAI", $arclai);
# дължими : idtype=2=неолихвяема idsubtype=8=аванс.такси 
$arsum1= $DB->selectCol("
	select idclaimer as ARRAY_KEY, sum(amount)
	from subject
	where idcase=$edit and idtype=2 and idsubtype=8
	group by idclaimer
	");
$smarty->assign("ARSUM1", $arsum1);
# внесени 
$arsum2= $DB->selectCol("
	select idclaimer as ARRAY_KEY, sum(amount)
	from claimadva
	left join claimer on claimadva.idclaimer=claimer.id
	$filter 
	group by idclaimer
	");
$smarty->assign("ARSUM2", $arsum2);
						# изчисляваме невнесените 
								$arsum3= array();
						foreach($arclai as $idclai=>$x2){
								$arsum3[$idclai]= $arsum1[$idclai] - $arsum2[$idclai];
						}
						$smarty->assign("ARSUM3", $arsum3);

				# вертикалните суми 
				$arsuma= array();
				$arsuma[1]= array_sum($arsum1);
				$arsuma[2]= array_sum($arsum2);
				$arsuma[3]= array_sum($arsum3);
				$smarty->assign("ARSUMA", $arsuma);

#-----------------------------------------------------------------
# изработени - 04.07.2011 
# източници : advamontcase2.ajax.php, advastat.php 
		# само изходени документи 
		$filtregi= "docuout.serial<>0 and docuout.year<>0";
$data2= $DB->select("
	select count(docuout.id) as coun, docutype.text as typetext, docutype.regitax
	from docuout
	left join docutype on docuout.iddocutype=docutype.id
	where docuout.idcase=?d and $filtregi 
	group by docuout.iddocutype
	"  ,$edit);
$data2= dbconv($data2);
foreach($data2 as $indx=>$elem){
	$data2[$indx]["suma"]= $elem["coun"] * $elem["regitax"];
}
$smarty->assign("DATA2", $data2);
//$smarty->assign("CASELINK", geturl("idcase=".$edit));
//print_rr($data2);
# общо и невнесени от изработените 
			$su1= 0;
foreach($data2 as $elem){
			$su1 += $elem["suma"];
}
$smarty->assign("SU1", $su1);
$smarty->assign("SU2", $su1 - $arsuma[2]);
#-----------------------------------------------------------------


# извеждаме 
$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
$pagecont= smdisp($tpname,"iconv");

?>
