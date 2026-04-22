<?php
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
# няма страница $page - всичкко на един екран 

$TABLNAME= "regionadv";
$HEADMAIN= "клоновете на АДВ";
$HEADEDIT= "клон на АДВ";
						include "region.inc.php";

/*
//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

									# корекция на избран запис 
									$edit= $GETPARAM["edit"];
									if (isset($edit)){
										include_once "advregedit.ajax.php";
										exit;
									}else{
									}
								
									# изтриване на избран запис 
									$dele= $GETPARAM["dele"];
									if (isset($dele)){
										include_once "advregdele.ajax.php";
										exit;
									}else{
									}

# за reload 
$relurl= geturl("mode=".$mode);

# списъка 
$mylist= $DB->select("select * from regionadv order by id");
$mylist= dbconv($mylist);

# трансформираме го - параметри за иконите 
//				$modeel= "mode=".$mode ."&page=".$page;
				$modeel= "mode=".$mode;
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
	$mylist[$uskey]["dele"]= geturl($modeel."&dele=".$idcurr);
}

# add new link 
$addnew= geturl($modeel."&edit=0");

# извеждаме 
$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("advreg.tpl","fetch");
*/

?>
