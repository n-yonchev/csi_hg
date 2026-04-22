<?php
# отгоре : 
//#    $iduser - логнатия деловодител 
#    $reg4user - избрания юзер за списъка 
#    $modeel - стринг за базовия линк 


# деловодител 
if ($reg4user==0){
	$reg4usname= "без деловодител";
}else{
	$userdata= getrow("user",$reg4user);
	$reg4usname= "на ".$userdata["name"];
}
$smarty->assign("REG4USNAME", $reg4usname);

# заглавие 

# текущата страница 
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

# към базовия линк 
//$modeel= "mode=".$mode ."&page=".$page;
$modeel .= "&page=".$page;

# избраното дело 
#-------------------------------------------------------------------------------------------
//print_rr($GETPARAM);
					$edit= $GETPARAM["edit"];
					if (isset($edit)){
							include_once "caseedit.php";
$smarty->assign("PAGEBACK", $page);
$smarty->assign("PAGEBACKTEXT", "назад към стр.$page от списъка дела ".$reg4usname);
	//# текст с номера на делото 
	//$datacase= getrow("suit",$edit);
	//$smarty->assign("PAGEDATACASE", $datacase);
$smarty->assign("PAGEBACKLINK", geturl($modeel));
$pagecont= smdisp("caseedit.tpl","fetch");
return;
					}else{
					}
#-------------------------------------------------------------------------------------------

# заявка за списък дела 
$query= "
	select reg4mess.*, reg4mess.id as id, reg4call.idreg4, reg4call.time
		, suit.serial as caseri ,suit.year as cayear
	from reg4mess 
	left join reg4call on reg4mess.idreg4call=reg4call.id
	left join suit on reg4mess.idcase=suit.id
	where suit.iduser=$reg4user
	order by suit.year desc, suit.serial desc
	";

# странициране 
					include "pagi.class.php";
		$prefurl= "";
//		$baseurl= "mode=".$mode ."&page=".$page;
		$baseurl= $modeel;
		$obpagi= new paginator(30, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);

# трансформиране 
		$mark= "SoapFault";
//		$lemark= strlen($mark);
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$uscont["idcase"]);
				$mytext= $uscont["text"];
//				if (substr($mytext,0,$lemark)==$mark){
				if (strpos($mytext,$mark)===false){
//	$mylist[$uskey]["artext"]= explode("^",$uscont["text"]);
					$art2= explode("^",$uscont["text"]);
								$artext= array();
					foreach($art2 as $elem){
								$artext[]= explode("|",$elem);
					}
	$mylist[$uskey]["artext"]= $artext;
				}else{
//	$mylist[$uskey]["artext"]= array($mark);
	$mylist[$uskey]["artext"]= array(array(substr($mytext,0,240)."..."));
	$mylist[$uskey]["texttip"]= $mytext;
				}
}
//print_ru($mylist);

# извеждане 
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("reg4usermess.tpl","fetch");


?>