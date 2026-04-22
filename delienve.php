<?php
# екземпляри от документи за връчване - комплектоване на екземпляри в пликове 
# отгоре : 
#    $modebase= "mode=".$mode."&vari=".$vari; 
# локални параметри : 
#    $v3 - меню 3-то ниво 
#    $page - текуща страница 
//var_dump($modebase);


# меню 3-то ниво 
$arv3= array();
$arv3["eall"]= "всички";
$arv3["emin"]= "документи без плик";
$arv3["eplu"]= "документи с плик";
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
$codepostonly= "post.idposttype=1";
$filtbase= "$filtdout and $codepostonly";
*/

# филтри 3-то ниво 
$arv3filt= array();
$arv3filt["eall"]= "1";
$arv3filt["emin"]= "post.idenve=0";
$arv3filt["eplu"]= "post.idenve<>0";

/*
# бройки 3-то ниво 
				$arcode= array();
foreach($arv3filt as $code=>$elem){
	$e2= "$filtbase and $elem";
				$arcode[]= "sum(if($e2,1,0)) as $code";
}
				$codecoun= implode(",",$arcode);
$arv3coun= $DB->selectRow("
	select $codecoun 
	from post
	left join docuout on post.iddocuout=docuout.id
	");
$smarty->assign("ARV3COUN", $arv3coun);
//print_rr($arv3coun);
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
									
									# директно включване към нов плик 
									$tonew= $GETPARAM["tonew"];
									if (isset($tonew)){
											$DB->query("lock tables post write, postenve write");
/*
	$ropost= $DB->selectRow("select * from post where id=?d"  ,$tonew);
		$aset= array();
		$aset["adresat"]= $ropost["adresat"];
		$aset["address"]= $ropost["address"];
	$idpostnew= $DB->query("insert into postenve set ?a, timestat=now()"  ,$aset);
*/
	$idenvenew= $DB->query("insert into postenve set timestat=now()");
	$DB->query("update post set idenve=$idenvenew where id=?d"  ,$tonew);
	tranenve1($idenvenew,$tonew);
											$DB->query("unlock tables");
									}else{
									}
									
									# nyroModal включване към съществуващ плик 
									$toexi= $GETPARAM["toexi"];
									if (isset($toexi)){
//$relurl= geturl($modeel);
										include_once "delienveexis.ajax.php";
										exit;
									}else{
									}
									
									# директно ИЗключване от назначения плик 
									$noenve= $GETPARAM["noenve"];
									if (isset($noenve)){
											$DB->query("lock tables post write, postenve write");
	$idenve2= $DB->selectCell("select idenve from post where id=?d"  ,$noenve);
	$DB->query("update post set idenve=0 where id=?d"  ,$noenve);
	tranenve0($idenve2);
											$DB->query("unlock tables");
									}else{
									}

									# съдържание за избран запис - прозорец wopen 
									$viewcont= $GETPARAM["viewcont"];
									if (isset($viewcont)){
										include_once "deliviewcont.php";
										exit;
									}else{
									}

# бройки 3-то ниво 
				$arcode= array();
foreach($arv3filt as $code=>$elem){
	$e2= "$filtbase and $elem";
				$arcode[]= "sum(if($e2,1,0)) as $code";
}
				$codecoun= implode(",",$arcode);
$arv3coun= $DB->selectRow("
	select $codecoun 
	from post
	left join docuout on post.iddocuout=docuout.id
	");
$smarty->assign("ARV3COUN", $arv3coun);
//print_rr($arv3coun);

# филтър от вторич.меню 
$filtv3= $arv3filt[$v3];
//var_dump($filtv3);

# заявка 
	$query= "
			select post.id as ARRAY_KEY
		, post.*
			, docuout.serial as d2seri, docuout.year as d2year
			, docutype.text as d2text
		, poststat.name as statname, poststat.idtype as pstype
						, u2.name as postuser
		, if($codepostempty,1,0) as nopostdata
		, if(post.idpoststat=0 or post.idposttype=poststat.idtype,0,1) as isertype
			, docuout.id as iddout
		, suit.id as idcase
		, suit.serial as caseri, suit.year as cayear
		, user.name as username
				, postenve.idstat as idstatenve, postenve.adresat as enveasat, postenve.address as enveaddr
		from post
		left join poststat on post.idpoststat=poststat.id
			left join docuout on post.iddocuout=docuout.id
			left join docutype on docuout.iddocutype=docutype.id 
				left join suit on docuout.idcase=suit.id
				left join user on suit.iduser=user.id
						left join user as u2 on post.iduser=u2.id
				left join postenve on post.idenve=postenve.id
		where $filtbase and $filtv3
		order by post.created desc, post.id desc
		";
# странициране 
					include "pagi.class.php";
		$prefurl= "";
		$baseurl= $modebase ."&v3=".$v3;
		$obpagi= new paginator(20, 8, $query);
$arpost= $obpagi->calculate($page, $prefurl, $baseurl);
$arpost= dbconv($arpost);

# трансформиране 
foreach($arpost as $idpost=>$elem){
	$arpost[$idpost]["tonew"]= geturl($modeel."&tonew=".$idpost);
	$arpost[$idpost]["toexi"]= geturl($modeel."&toexi=".$idpost);
	$arpost[$idpost]["noenve"]= geturl($modeel."&noenve=".$idpost);
	$arpost[$idpost]["viewcont"]= geturl($modeel."&viewcont=".$elem["iddocuout"]);
}
$smarty->assign("ARPOST", $arpost);
//print_ru($arpost);


# буквата за редактиране - от основ.данни 
$rooffi= getofficerow($iduser);
$letdoc= $rooffi["letterdocu"];
$smarty->assign("LETDOC", $letdoc);

# извеждаме 
$cont3= smdisp("delienve.tpl","fetch");

?>