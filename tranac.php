<?php
# списък специфични сметки за трансфера 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
//#    $page - текущата страница 

								# функции за финансите 
								include_once "fina.inc.php";
if ($flagbankmass){
}else{
$pagecont= "<br><center>функцията е изключена</center>";
return;
}

						# всичко за преводите 
						include_once "tran.inc.php";

# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page);
$relurl= geturl("mode=".$mode);
$smarty->assign("RELURL", $relurl);
									# корекция на избран запис 
									$edit= $GETPARAM["edit"];
									if (isset($edit)){
										include_once "tranacedit.ajax.php";
										exit;
									}else{
									}
									# изтриване - javascript 

# задължителни сметки 
						$armess= array();
$arcoun= $DB->selectCol("select code as ARRAY_KEY, count(*) from tranacco group by code");
//print_rr($arcoun);
if ($arcoun["t26"]==0){
						$armess[]= "t26";
}else{
}
if ($arcoun["nop"]==0){
						$armess[]= "nop";
}else{
}
if ($arcoun["uni"]==0){
						$armess[]= "uni";
}else{
}
$smarty->assign("ARMESS", $armess);

# списъка 
$mylist= $DB->select("select * from tranacco order by code");
$mylist= dbconv($mylist);

# трансформираме го - параметри за иконите 
//				$modeel= "mode=".$mode."&page=".$page;
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
$pagecont= smdisp("tranac.tpl","fetch");

?>