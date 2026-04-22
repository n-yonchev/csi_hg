<?php
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
# няма страница $page - всичкко на един екран 

//print_r($GETPARAM);
//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

						include_once "reorder.class.php";
				$tareor= "banklist";
						$reor= new reorder($tareor);
				# преподреждане - подготовка 
				$reor->set();

									# корекция на избран запис 
									$edit= $GETPARAM["edit"];
									if (isset($edit)){
										include_once "bankedit.ajax.php";
										exit;
									}else{
									}
								
									# изтриване на избран запис 
									$dele= $GETPARAM["dele"];
									if (isset($dele)){
										include_once "bankdele.ajax.php";
										exit;
									}else{
									}

# за reload 
$relurl= geturl("mode=".$mode);
								
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

# списъка 
//$mylist= $DB->select("select * from banklist order by id");
$mylist= $DB->select("select * from banklist order by serial");
$mylist= dbconv($mylist);

# трансформираме го - параметри за иконите 
//				$modeel= "mode=".$mode ."&page=".$page;
				$modeel= "mode=".$mode;
$bic_count = array();
foreach ($mylist as $uskey=>$uscont){
	$bic_count[$uscont['bic']]++;
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
$smarty->assign("BIC_COUNT", $bic_count);
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("bank.tpl","fetch");

?>
