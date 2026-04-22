<?php
# екземпляри от документи за връчване - пликове статуси и отпечатване 
# отгоре : 
#    $modebase= "mode=".$mode."&vari=".$vari; 
# локални параметри : 
#    $v3 - меню 3-то ниво 
#    $page - текуща страница 
//var_dump($modebase);
//print_rr($GETPARAM);


# меню 3-то ниво 
$arv3= array();
$arv3["eall"]= "всички";
$arv3["enos"]= "чакащи";
$arv3["esen"]= "изпратени";
$smarty->assign("ARV3", $arv3);

# линкове 3-то ниво 
			$arv3link= array();
foreach($arv3 as $indx=>$x2){
	$arv3link[$indx]= geturl($modebase."&v3=$indx");
}
//print_ru($arv3link);
$smarty->assign("ARV3LINK", $arv3link);

/*
# филтър само по пощата 
$codepostonly= "post.idenvetype=1";
$filtbase= "$filtdout and $codepostonly";
*/

# филтри 3-то ниво 
$arv3filt= array();
$arv3filt["eall"]= "1";
$arv3filt["enos"]= "postenve.idstat=0";
$arv3filt["esen"]= "postenve.idstat=1";

/*
# бройки 3-то ниво 
				$arcode= array();
foreach($arv3filt as $code=>$elem){
//	$e2= "$filtbase and $elem";
	$e2= "$elem";
				$arcode[]= "sum(if($e2,1,0)) as $code";
}
				$codecoun= implode(",",$arcode);
$arv3coun= $DB->selectRow("
	select $codecoun 
	from postenve
	");
$smarty->assign("ARV3COUN", $arv3coun);
//print_rr($arcoun3);
*/

# елемент от меню 3-то ниво 
$v3= $GETPARAM["v3"];
if (isset($v3)){
}else{
	$akey= array_keys($arv3);
	$v3= $akey[0];
}
$smarty->assign("V3", $v3);

# текущата страница 
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

# подготовка 
$modeel= $modebase."&v3=$v3"."&page=$page";
//var_dump($modeel);

									# директно плика става изпратен 
									$tostat1= $GETPARAM["tostat1"];
									if (isset($tostat1)){
	$DB->query("update postenve set idstat=1 where id=?d"  ,$tostat1);
									}else{
									}
									# директно плика става чакащ 
									$tostat0= $GETPARAM["tostat0"];
									if (isset($tostat0)){
	$DB->query("update postenve set idstat=0 where id=?d"  ,$tostat0);
									}else{
									}
									
									# директно ИЗключване документа от назначения плик 
									$noenve= $GETPARAM["noenve"];
									if (isset($noenve)){
											$DB->query("lock tables post write, postenve write");
	$idenve2= $DB->selectCell("select idenve from post where id=?d"  ,$noenve);
	$DB->query("update post set idenve=0 where id=?d"  ,$noenve);
	tranenve0($idenve2);
											$DB->query("unlock tables");
									}else{
									}
									
									# отпечатване плик с/без известие - iframe 
									$prnt= $GETPARAM["prnt"];
									if (isset($prnt)){
											$isenveonly= isset($GETPARAM["enveonly"]);
											$smarty->assign("ISENVEONLY", $isenveonly);
										include_once "delisendprnt.php";
										exit;
									}else{
									}

# бройки 3-то ниво 
				$arcode= array();
foreach($arv3filt as $code=>$elem){
//	$e2= "$filtbase and $elem";
	$e2= "$elem";
				$arcode[]= "sum(if($e2,1,0)) as $code";
}
				$codecoun= implode(",",$arcode);
$arv3coun= $DB->selectRow("
	select $codecoun 
	from postenve
	");
$smarty->assign("ARV3COUN", $arv3coun);
//print_rr($arcoun3);

# филтър от вторич.меню 
$filtv3= $arv3filt[$v3];
//var_dump($filtv3);

# заявка 
$query= str_replace("[FILTENVE]",$filtv3,$quenvelist);
# странициране 
					include "pagi.class.php";
		$prefurl= "";
		$baseurl= $modebase ."&v3=".$v3;
		$obpagi= new paginator(20, 8, $query);
$arenve= $obpagi->calculate($page, $prefurl, $baseurl);
$arenve= dbconv($arenve);

# трансформиране 
foreach($arenve as $idenve=>$x2){
	foreach($x2 as $idpost=>$elem){
		$arenve[$idenve][$idpost]["tostat0"]= geturl($modeel."&tostat0=".$idenve);
		$arenve[$idenve][$idpost]["tostat1"]= geturl($modeel."&tostat1=".$idenve);
		$arenve[$idenve][$idpost]["prnt"]= geturl($modeel."&prnt=".$idenve);
		$arenve[$idenve][$idpost]["prntenve"]= geturl($modeel."&prnt=".$idenve."&enveonly=1");
			$arenve[$idenve][$idpost]["noenve"]= geturl($modeel."&noenve=".$idpost);
	}
}
$smarty->assign("ARENVE", $arenve);
//print_ru($arenve);

//# линкове 
# бройки екземпляри по пликове 
				$arcounenve= array();
//				$arlink= array();
foreach($arenve as $idenve=>$x2){
	$c2= count($x2);
				$arcounenve[$idenve]= ($c2==0)?1:$c2;
//				$arlink[$idenve]= geturl($modeel."&toexi=".$toexi."&envechos=".$idenve);
}
$smarty->assign("ARCOUNENVE", $arcounenve);
//$smarty->assign("ARLINK", $arlink);
//print_rr($arlink);

/*
# буквата за редактиране - от основ.данни 
$rooffi= getofficerow($iduser);
$letdoc= $rooffi["letterdocu"];
$smarty->assign("LETDOC", $letdoc);
*/

# извеждаме 
$cont3= smdisp("delisend.tpl","fetch");

?>