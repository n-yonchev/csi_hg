<?php
# наблюдатели, източник : user.php 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $page - текущата страница 
//print_rr($GETPARAM);
//print_rr($_POST);

# права само за админа 
adminonly();

#---- корекции inactive 
$acti= (int) $GETPARAM["acti"];
if ($acti){
	updrow("viewer",$acti,"inactive=0");
}else{
}
$inac= (int) $GETPARAM["inac"];
if ($inac){
	updrow("viewer",$inac,"inactive=1");
}else{
}

# текущата страница 
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

# филтър - име 
$filtname= $GETPARAM["filtname"];
$filtpost= $_POST["filtname"];
if (isset($filtpost)){
	$filtname= $filtpost;
	$page= 1;
}else{
}
$smarty->assign("FILTNAME", tran1251($filtname));
if (empty($filtname)){
	$whname= "1";
}else{
	$myfilt= "%".$filtname."%";
	$whname= "lower(name) like lower('$myfilt')";
}

# филтър - всички или не 
$flagall= $GETPARAM["flagall"];
if (isset($flagall)){
}else{
	$flagall= 0;
}
//			$modeel= "mode=".$mode."&page=".$page;
			$modeel= "mode=".$mode."&page=1"."&filtname=".$filtname;
if ($flagall==0){
	$filt= "inactive=0";
	$linkalte= geturl($modeel."&flagall=1");
}else{
	$filt= "1";
	$linkalte= geturl($modeel."&flagall=0");
}
$smarty->assign("FLAGALL", $flagall);
$smarty->assign("LINKALTE", $linkalte);

									# корекция на избран запис 
									$edit= $GETPARAM["edit"];
									if (isset($edit)){
										include_once "v1edit.ajax.php";
										exit;
//return;
									}else{
									}
									# списък дела на избран наблюдател 
									$viewer= $GETPARAM["viewer"];
									if (isset($viewer)){
# назад към списъка наблюдатели 
$smarty->assign("PAGEBACK", $page);
$smarty->assign("PAGEBACKTEXT", "назад към списъка наблюдатели");
//$smarty->assign("PAGEBACKLINK", geturl("mode=".$mode ."&page=".$page));
$smarty->assign("PAGEBACKLINK", geturl("mode=".$mode ."&page=".$page ."&flagall=".$flagall."&filtname=".$filtname));
										include_once "v1list.php";
//										exit;
return;
/***
# назад към списъка наблюдатели 
$smarty->assign("PAGEBACK", $page);
$smarty->assign("PAGEBACKTEXT", "назад към списъка наблюдатели");
$smarty->assign("PAGEBACKLINK", geturl("mode=".$mode ."&page=".$page));
***/
/*
						$addcas= $GETPARAM["addcas"];
						if (isset($addcas)){
print "SET-ADDCAS";
						}else{
print "NOTSET-ADDCAS";
//$pagecont= smdisp("v1list.tpl","fetch");
//return;
						}
*/
									}else{
									}

/*
#---- корекции inactive 
$acti= (int) $GETPARAM["acti"];
if ($acti){
	updrow("viewer",$acti,"inactive=0");
}else{
}
$inac= (int) $GETPARAM["inac"];
if ($inac){
	updrow("viewer",$inac,"inactive=1");
}else{
}
						# броя дела по наблюдатели 
						$arcoun= $DB->selectCol("select idviewer as ARRAY_KEY, count(*) from viewersuit group by idviewer");
						$smarty->assign("ARCOUN", $arcoun);
# филтър - име 
$filtname= $GETPARAM["filtname"];
$filtpost= $_POST["filtname"];
if (isset($filtpost)){
	$filtname= $filtpost;
	$page= 1;
}else{
}
$smarty->assign("FILTNAME", tran1251($filtname));
if (empty($filtname)){
	$whname= "1";
}else{
	$myfilt= "%".$filtname."%";
	$whname= "lower(name) like lower('$myfilt')";
}

# филтър - всички или не 
$flagall= $GETPARAM["flagall"];
if (isset($flagall)){
}else{
	$flagall= 0;
}
//			$modeel= "mode=".$mode."&page=".$page;
			$modeel= "mode=".$mode."&page=1"."&filtname=".$filtname;
if ($flagall==0){
	$filt= "inactive=0";
	$linkalte= geturl($modeel."&flagall=1");
}else{
	$filt= "1";
	$linkalte= geturl($modeel."&flagall=0");
}
$smarty->assign("FLAGALL", $flagall);
$smarty->assign("LINKALTE", $linkalte);
*/

						# броя дела по наблюдатели 
						$arcoun= $DB->selectCol("select idviewer as ARRAY_KEY, count(*) from viewersuit group by idviewer");
						$smarty->assign("ARCOUN", $arcoun);

# списъка 
//$userlist= $DB->select("select * from user order by name");
		# странициране заедно с dbsimple [dklab] 
				if (class_exists("paginator")){
				}else{
					include "pagi.class.php";
				}
//		$query= "select * from viewer order by name";
		$query= "select * from viewer where $filt and $whname order by name";
		$prefurl= "";
		$baseurl= "mode=".$mode."&flagall=".$flagall."&filtname=".$filtname;
		$obpagi= new paginator(20, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);

# трансформираме го - параметри за иконите 
//				$modeel= "mode=".$mode."&page=".$page;
				$modeel= "mode=".$mode."&page=".$page."&flagall=".$flagall."&filtname=".$filtname;
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
	$mylist[$uskey]["viewer"]= geturl($modeel."&viewer=".$idcurr);
	$mylist[$uskey]["acti"]= geturl($modeel."&acti=".$idcurr);
	$mylist[$uskey]["inac"]= geturl($modeel."&inac=".$idcurr);
}

# add new link 
$addnew= geturl($modeel."&edit=0");

					# допълнителни js линкове за секцията head 
					$headlist= "
<script type='text/javascript' src='autocomp/jquery.bgiframe.min.js'></script>
<script type='text/javascript' src='autocomp/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='autocomp/thickbox-compressed.js'></script>
<script type='text/javascript' src='autocomp/jquery.autocomplete.js'></script>
<link rel='stylesheet' type='text/css' href='autocomp/jquery.autocomplete.css' />
					";
					$smarty->assign("HEADLIST", $headlist);

# извеждаме 
$smarty->assign("ADDNEW", $addnew);
$smarty->assign("USERLIST", $mylist);
$pagecont= smdisp("v1.tpl","fetch");

?>
