<?php
# обслужване на таблица с номенклатура - id, name 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
//#    $vari - текущото подменю 
# няма страница $page - всичкко на един екран 
# отгоре - параметри : 
#    $TABLNAME, $HEADMAIN, $HEADEDIT 

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

$smarty->assign("HEADMAIN", $HEADMAIN);
$smarty->assign("HEADEDIT", $HEADEDIT);
/*
# за линковете 
$modeel= "mode=".$mode."&vari=".$vari;
# за reload 
$relurl= geturl("mode=".$mode."&vari=".$vari);
*/
# за линковете 
$modeel= "mode=".$mode;
# за reload 
$relurl= geturl($modeel);

									# корекция на избран запис 
									$edit= $GETPARAM["edit"];
									if (isset($edit)){
										include_once "delilistedit.ajax.php";
										exit;
									}else{
									}
								
									# изтриване на избран запис 
									$dele= $GETPARAM["dele"];
									if (isset($dele)){
										include_once "delilistdele.ajax.php";
										exit;
									}else{
									}

# списъка 
					if (isset($TABLNAME)){
$mylist= $DB->select("select * from $TABLNAME order by id");
					}else{
$mylist= $DB->select("select * from poststat where idtype=?d order by id"  ,$IDTYPE);
					}
$mylist= dbconv($mylist);

# трансформираме го - параметри за иконите 
//				$modeel= "mode=".$mode ."&page=".$page;
//				$modeel= "mode=".$mode."&vari=".$vari;
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
	$mylist[$uskey]["dele"]= geturl($modeel."&dele=".$idcurr);
				# за иконите преподреждане - вземи, спусни  
	$mylist[$uskey]["get"]= geturl($modeel."&get=".$idcurr);
	$mylist[$uskey]["put"]= geturl($modeel."&put=".$idcurr);
}

# add new link 
$addnew= geturl($modeel."&edit=0");

# извеждаме 
$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
//$varipagecont= smdisp("delilist.tpl","fetch");
$pagecont= smdisp("delilist.tpl","fetch");

?>
