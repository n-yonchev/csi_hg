<?php
# зона : събития за делото - списък 
# отгоре : 
#    $edit= case.id 
#    $zone= "teven" 
#    $func= view, modi 
# елемент за настройка 
#    $idel - subject.id  
//print_r($GETPARAM);
//print session_name()."=".session_id();


# таблицата 
$taname= "suitevent";
# шаблона 
$tpname= "cazoevenview.tpl";
//# текст за типа участник 
//$listtext= "длъжници";

# за include при корекция 
$modiname= "cazoevenmodi.ajax.php";
# съобщение при авариен край 
$diemess= "cazoeven";


						# евентуално изтриване 
						$delrec= $GETPARAM["delrec"];
						if (isset($delrec)){
							# общо за взискатели/длъжници 
							include_once "cazoevendele.ajax.php";
exit;
						}else{
						}
									# модификация на избрания запис в тази зона 
									//$view= $GETPARAM["view"];
									if ($func=="modi"){
//										include_once "cazo3modi.ajax.php";
										include_once $modiname;
										exit;
									}else{
									}
# според функцията 
if (0){
}elseif ($func=="view"){
}else{
die("$diemess=func=$func");
}

# основните параметри 
$modeel= "edit=$edit&zone=$zone&func=modi";
//$tpname= "cazo3view.tpl";
# add new link 
$addnew= geturl($modeel."&idel=0");

# списъка 
$filter= "where idcase=$edit";
//$mylist= $DB->select("select * from claimer $filter order by id");
$mylist= $DB->select("select * from $taname $filter order by date");
$mylist= dbconv($mylist);
//print_r($mylist);

# трансформираме го - параметри за иконите 
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
	$mylist[$uskey]["edit"]= geturl($modeel."&idel=".$idcurr);
	$mylist[$uskey]["delrec"]= geturl($modeel."&delrec=".$idcurr);
				$mylist[$uskey]["paym"]= geturl("&subj=".$idcurr);
}

# резултата 
$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
//$smarty->assign("LISTTEXT", $listtext);
$pagecont= smdisp($tpname,"iconv");


?>