<?php
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 

# права само за админа 
adminonly();

# текущата страница 
//print_r($GETPARAM);
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

									# корекция на избран запис 
									$edit= $GETPARAM["edit"];
									if (isset($edit)){
										include_once "useredit.ajax.php";
										exit;
//return;
									}else{
									}

#---- корекции inactive 
$acti= (int) $GETPARAM["acti"];
if ($acti){
	updrow("user",$acti,"inactive=0");
}else{
}
$inac= (int) $GETPARAM["inac"];
if ($inac){
	updrow("user",$inac,"inactive=1");
}else{
}

# списъка 
//$userlist= $DB->select("select * from user order by name");
		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
		$query= "select * from user order by name";
		$prefurl= "";
		$baseurl= "mode=".$mode;
		$obpagi= new paginator(18, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);

# трансформираме го - параметри за иконите 
				$modeel= "mode=".$mode."&page=".$page;
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
//	$userlist[$uskey]["edit"]= $aaa= rawurlencode(mycrypt("put",$modeel."&edit=".$idcurr));
//	$userlist[$uskey]["acti"]= $aaa= rawurlencode(mycrypt("put",$modeel."&acti=".$idcurr));
//	$userlist[$uskey]["inac"]= $aaa= rawurlencode(mycrypt("put",$modeel."&inac=".$idcurr));
//$userlist[$uskey]["name"]= iconv("UTF-8","windows-1251",$uscont["name"]);
	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
	$mylist[$uskey]["acti"]= geturl($modeel."&acti=".$idcurr);
	$mylist[$uskey]["inac"]= geturl($modeel."&inac=".$idcurr);
}

# add new link 
$addnew= geturl($modeel."&edit=0");

# извеждаме 
$smarty->assign("ADDNEW", $addnew);
$smarty->assign("USERLIST", $mylist);
$pagecont= smdisp("user.tpl","fetch");
//print "<xmp>$pagecont</xmp>";
//print "<xmp>".smdisp("user.tpl","iconv")."</xmp>";
//$pagecont= smdisp("user.tpl","iconv");

?>
