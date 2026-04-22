<?php
# обслужване на таблица с номенклатура - id, name 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущи€ режим 
# н€ма страница $page - всичкко на един екран 
# отгоре - параметри : 
#    $TABLNAME, $HEADMAIN, $HEADEDIT 

//# права само за админа 
//adminonly();
# логнати€ потребител 
$iduser= @$_SESSION["iduser"];

$smarty->assign("HEADMAIN", $HEADMAIN);
$smarty->assign("HEADEDIT", $HEADEDIT);
									# корекци€ на избран запис 
									$edit= $GETPARAM["edit"];
									if (isset($edit)){
										include_once "regionedit.ajax.php";
										exit;
									}else{
									}
								
									# изтриване на избран запис 
									$dele= $GETPARAM["dele"];
									if (isset($dele)){
										include_once "regiondele.ajax.php";
										exit;
									}else{
									}

# за reload 
$relurl= geturl("mode=".$mode);

				#---- всичко за преподреждането --- 
//				$tareor= "banklist";
$tareor= $TABLNAME;
						include_once "reorder.class.php";
						$reor= new reorder($tareor);
				# преподреждане - подготовка 
				$reor->set();
								
				# преподреждане - вземане на избран запис - за преместване 
								$get= $GETPARAM["get"];
								if (isset($get)){
				$rocurr= getrow($tareor,$get);
				$_SESSION["reorderget"]= $get;
				$_SESSION["reordertext"]= $rocurr["name"];
# redirect 
reload("",$relurl);
								}else{
								}
									
				# преподреждане -  спускане на избран запис - с цел преместване 
								$put= $GETPARAM["put"];
								if (isset($put)){
				$reor->put($put,$_SESSION["reorderget"]);
				unset($_SESSION["reorderget"]);
				unset($_SESSION["reordertext"]);
# redirect 
reload("",$relurl);
								}else{
								}
				#---- край на всичко за преподреждането --- 

# списъка 
//$mylist= $DB->select("select * from $TABLNAME order by id");
$mylist= $DB->select("select * from $TABLNAME order by serial");
$mylist= dbconv($mylist);

# трансформираме го - параметри за иконите 
//				$modeel= "mode=".$mode ."&page=".$page;
				$modeel= "mode=".$mode;
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
$pagecont= smdisp("region.tpl","fetch");

?>
