<?php
# документи за връчване от входящи документи - външни 

						# трансформирания филтър 
						$filtse= $_SESSION[$secodename];

//print_ru($filtse);
/////////putlog("deliexte=".print_r($filtse,true));
						# 06.02.2018 ЛЕПЕНКА. 
						# За външни документи - изтриваме елементи на филтъра с полета от табл. docuout и suit 
						# ВМЕСТО : трансформация на филтъра и пренасочване за външни - deli.php 
				if (empty($filtse)){
				}else{
						$arf2= array();
						foreach($filtse as $e2){
							$i2= strpos($e2,"docuout.");
							$i4= strpos($e2,"suit.");
							if ($i2===false and $i4===false){
								$arf2[]= $e2;
							}else{
							}
						}
						$filtse= $arf2;
//print_ru($filtse);
				}

if (empty($filtse)){
	$filtform= "1";
}else{
						$filtform= implode(" and ",$filtse);
}

			# филтър отделен източник 
			#-- избрания : отгоре 
			//$idsour= $GETPARAM["idsour"];
			//$idsour= isset($idsour) ? $idsour : 0;
//			$smarty->assign("IDSOUR", $idsour);
			#-- линковете за избор 
			//$arsourpost= getselect("delisour","name","1",true);
			$mode2= "mode=".$mode."&vari=".$vari;
			$arsourpost= $DB->selectCol("
				select delisour.id as ARRAY_KEY
					, concat(delisour.name, ' [',
						(select count(*) from post where iddocu<>0 and iddelisour=delisour.id)
					,']')
				from delisour
				order by delisour.serial, delisour.name
				");
			$arsourpost= array("0"=>toutf8("-всички-")) + $arsourpost;
//print_rr($arsourpost);
			$arsour2= array();
			foreach($arsourpost as $indx=>$elem){
				$link= geturl($mode2."&idsour=".$indx);
				$arsour2[$link]= $elem;
				#-- за полето 
				if ($indx==$idsour){
					$smarty->assign("IDSOUR", $link);
				}else{
				}
			}
//print_rr($arsour2);
			$smarty->assign("ARSOURPOSTNAME", "arsour2");
			#-- филтъра 
			if ($idsour==0){
				$filtsour= "1";
			}else{
				$filtsour= "post.iddelisour=$idsour";
			}
			
//putlog("deliexte=filtform=\n$filtform");
/***
# списък екземпляри 
$arpost= $DB->select("
	select post.id as ARRAY_KEY
		, post.*
		, poststat.name as statname, poststat.idtype as pstype
		, user.name as postuser
		, if($codepostempty,1,0) as nopostdata
		, if(post.idpoststat=0 or post.idposttype=poststat.idtype,0,1) as isertype
				, docu.serial, docu.year, docu.created, docu.notes as docunotes
				, delisour.name as sourname
	from post
		left join poststat on post.idpoststat=poststat.id 
		left join user on post.iduser=user.id 
				left join docu on post.iddocu=docu.id 
				left join delisour on post.iddelisour=delisour.id 
	where post.iddocu<>0
and $filtform
	order by post.created desc
	");
$arpost= dbconv($arpost);
//print_ru($arpost);
***/

# списък екземпляри 
$query= "
	select post.id as ARRAY_KEY
		, post.*
		, poststat.name as statname, poststat.idtype as pstype
		, user.name as postuser
		, if($codepostempty,1,0) as nopostdata
		, if(post.idpoststat=0 or post.idposttype=poststat.idtype,0,1) as isertype
				, docu.serial, docu.year, docu.created, docu.notes as docunotes
				, delisour.name as sourname
	from post
		left join poststat on post.idpoststat=poststat.id 
		left join user on post.iduser=user.id 
				left join docu on post.iddocu=docu.id 
				left join delisour on post.iddelisour=delisour.id 
	where post.iddocu<>0
and $filtform
and $filtsour
	order by post.created desc
	";

		# странициране 
					include "pagi.class.php";
		$prefurl= "";
		$baseurl= "mode=".$mode."&vari=".$vari."&idsour=".$idsour;
		$obpagi= new paginator(20, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$arpost= dbconv($mylist);

# трансформиране 
$modeel= "mode=".$mode."&vari=".$vari."&idsour=".$idsour."&page=".$page;
foreach($arpost as $idpost=>$elem){
		$arpost[$idpost]["postedit"]= geturl($modeel."&postedit=".$idpost);
		$arpost[$idpost]["postdubl"]= geturl($modeel."&postdubl=".$idpost);
		$arpost[$idpost]["postdele"]= geturl($modeel."&postdele=".$idpost);
		$arpost[$idpost]["postnote"]= geturl($modeel."&postnote=".$idpost);
}
$smarty->assign("ARPOST", $arpost);
//print_ru($arpost);

# линк за прозореца за корекции 
$linkedit= geturl($modeel."&deliedit=0");
$smarty->assign("LINKEDIT", $linkedit);
# линк за прозореца за изчистване 
$linkclear= geturl($modeel."&deliclear=0");
$smarty->assign("LINKCLEAR", $linkclear);
/*
# 18.10.2018 призовкар - списък на призовкарите 
$aruserpost= getselect("poststat","name","idtype=21",false);
$aruserpost= dbconv($aruserpost);
$smarty->assign("ARUSERPOST", $aruserpost);
*/

# извеждаме 
$pagecont= smdisp("deliexte.tpl","fetch");

?>