<?php
# списък на извършените действия за делото 
# отгоре : 
#    $edit= case.id 
#    $zone= jour 
#    $func= view, modi 
//print session_name()."=".session_id();

//									# НЯМА модификация на избрания запис в тази зона 
									# модификация на избрания запис в тази зона 
									$addnew= $GETPARAM["addnew"];
									if (isset($addnew)){
						$rocase= getrow("suit",$edit);
						$editcasecode= $rocase["serial"]."/".substr($rocase["year"],2);
						$edit= 0;
										include_once "jouredit.ajax.php";
										exit;
									}else{
									}

# основните параметри 
$taname= "jour";
$tpname= "cazojour.tpl";
$modeel= "edit=$edit&zone=$zone";

# списъка 
			# 06.10.2010 - 
			# всяко действие може да има списък с дела, а не само едно 
//$filter= "where idcase=$edit";
//$mylist= $DB->select("select * from $taname $filter order by id");
			$mylist= $DB->select("select jour.* 
				from $taname
				left join joursuit on $taname.id=joursuit.idjour
				where joursuit.idcase=$edit
				order by jour.id
				");
$mylist= dbconv($mylist);
$mylist= arstrip($mylist);
//print_r($mylist);

# основните параметри 
//$modeel= "edit=$edit&zone=$zone&func=modi";
$modeel= "edit=".$edit."&zone=".$zone."&func=".$func;
# add new link 
$addnew= geturl($modeel."&addnew=0");
$smarty->assign("ADDNEW", $addnew);

# извеждаме 
//$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
$pagecont= smdisp($tpname,"iconv");

?>