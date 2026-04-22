<?php
# наблюдение, източник : index.php 

$view_sess_name= "PHPID";
//								session_name("PHPID");
								session_name($view_sess_name);
									session_start();
									include_once "common.php";

//print_r($_SERVER);
# логнатия юзер 
$iduser= @$_SESSION["iduser"];
if (isset($iduser)){
	$rouser= getrow("viewer",$iduser);
	$smarty->assign("USNAME", $rouser["name"]);
//			# 15.09.2009 
//			# заради глобалния филтър номер-дело от-до +enter - main.tpl 
//			$logisadmin= ($rouser["type"]==ADMINTYPE);
//			$logisadmin= ($rouser["inactive"]==0);
//			$smarty->assign("LOGGEDISADMIN", $logisadmin);
}else{
//									# създаваме сесия чак тук 
//									session_start();
	redirect("viewlogi.php");
exit;
}

# заглавен текст за ЧСИ 
$headtext= @$_SESSION["headtext"];
if (isset($headtext)){
}else{
//	$headtext= getofficename($iduser);
	$rooffi= getofficerow($iduser);
	$headtext= $rooffi["text"];
}
//print_r($_SESSION);

# главното меню 
	$maingroup = array(
"case"
,"fina"
	);

$mainmenu["case"]["text"]= "дела";			$mainmenu["case"]["php"]= "viewcase.php";
$mainmenu["fina"]["text"]= "постъпления";	$mainmenu["fina"]["php"]= "viewfina.php";
$mainmenu["exit"]["text"]= "изход";				//$mainmenu["exit"]["php"]= "mode=exit";

# вземаме масива с входните параметри 
$GETPARAM= getparam();
//print_r($GETPARAM);
							# заради новия дизайн 
							$pageform= $_POST["pageform"];
							if (isset($pageform)){
$GETPARAM["page"]= $pageform;
							}else{
							}

# главния режим 
$mode= $GETPARAM["mode"];
if (isset($mode)){
}else{
	$akey= array_keys($mainmenu);
	$mode= $akey[0];
}
# евентуален изход 
if ($mode=="exit"){
	session_destroy();
//	redirect("index.php");
	redirect($_SERVER["PHP_SELF"]);
}else{
}

# криптираме линковете в менюто 
foreach($mainmenu as $inmenu=>$elmenu){
	$mainmenu[$inmenu]["link"]= geturl("mode=$inmenu");
	
//print "<br>$aaa";
}

//var_dump($mode);
					# скрипта според режима 
					# да зарежда променливата $pagecont 
					include_once($mainmenu[$mode]["php"]);
$smarty->assign("CONTENT", $pagecont);

# извеждаме 
$smarty->assign("MAINGROUP", $maingroup);
$smarty->assign("MAINMENU", $mainmenu);
$smarty->assign("MODE", $mode);
//print "<h2>".$rouser["name"]."</h2>";
//$smarty->assign("USNAME", $rouser["name"]);
//smdisp("main.tpl");
//print "<xmp>".smdisp("main.tpl","iconv")."</xmp>";
# чак сега 
$smarty->assign("HEADTEXT", $_SESSION["headtext"]);

print smdisp("view.tpl","iconv");


?>
