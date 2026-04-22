<?php

# типове връчване 
$listtypepost[0]= "";
$listtypepost[1]= "по пощата";
$listtypepost[2]= "призовкар";
# 28.08.2015 
$listtypepost[3]= "куриер";
$listtypepost[4]= "email";
//$listtypepost[3]= "в офиса";
$listtypepost_utf8= toutf8($listtypepost);
$smarty->assign("ARPOSTTYPE", $listtypepost);
$smarty->assign("ARPOSTTYPENAME", "listtypepost_utf8");
	$listtypepost[9]= "НЕ СЕ ВРЪЧВА";
	$listtypepost_utf8_2= toutf8($listtypepost);
	$smarty->assign("ARPOSTTYPE_2", $listtypepost);
	$smarty->assign("ARPOSTTYPENAME_2", "listtypepost_utf8_2");

# специални тагове 
$listspectags= array("DB_BANKLIST_CB", "DB_REGIONKAT_CB", "DB_REGIONVPI_CB", "DB_REGIONNAP_CB", "ADRESAT_BANK");

# префикс за шаблоните 
$preftemp= "outgoing/";

# код за непопълнени полета за връчване 
$codepostempty= "post.date1='' and post.date2='' and post.date3='' and post.idpoststat=0";

# филтър - само изходени изходящи документи 
$filtdout= "docuout.id is not null and docuout.serial<>0 and docuout.year<>0";

# код чл.417 
$codeinterest= "docutype.mark='pdi' and suit.idtitu=1 and suit.idsubtit>=1 and suit.idsubtit<=9";

/*
# връща данни за екземпляри, включени в списък пликове 
function getenvelist($filtpost){
global $DB;
//var_dump($filtpost);
	$ardata= $DB->select("
		select postenve.id as ARRAY_KEY1, post.id as ARRAY_KEY2
			, postenve.adresat as enveasat, postenve.address as enveaddr
			, post.adresat as postasat, post.address as postaddr
			, docuout.serial as d2seri, docuout.year as d2year
		from postenve
		left join post on post.idenve=postenve.id
		left join docuout on post.iddocuout=docuout.id
		where $filtpost
		order by postenve.id desc
		");
	$ardata= dbconv($ardata);
//print_ru($ardata);
return $ardata;
}
*/

$quenvelist= "
		select postenve.id as ARRAY_KEY1, post.id as ARRAY_KEY2
			, postenve.adresat as enveasat, postenve.address as enveaddr
			, postenve.idstat as idstat
			, post.adresat as postasat, post.address as postaddr
			, docuout.serial as d2seri, docuout.year as d2year
		from postenve
		left join post on post.idenve=postenve.id
		left join docuout on post.iddocuout=docuout.id
		where [FILTENVE]
		order by postenve.id desc
		";

# премахва всички видове кавички 
function noquotes($p1){
/*
				#  132=„  147=“  148=”  - виж резултата от _abet.php 
	$ar1= array('\"' ,'"' ,"\\", "/" ,"'" ,"-"  ,chr(132),chr(147),chr(148)  ,"\t" );
	$ar2= array(""   ,""  ,""  , ""  ,""  ," "  ,""      ,""      ,""        ,""   );
*/
	$ar1= array('\"' ,'"' ,"\\" ,"'" ,"\t" );
	$ar2= array(""   ,""  ,""   , "" ,""   );
	$resu= str_replace($ar1,$ar2,$p1);
return $resu;
}

# връща данни за екземпляри, включени в списък пликове 
function getenvelist($filtpost){
global $DB, $quenvelist;
//var_dump($filtpost);
	$quenve2= str_replace("[FILTENVE]",$filtpost,$quenvelist);
	$ardata= $DB->select($quenve2);
	$ardata= dbconv($ardata);
//print_ru($ardata);
return $ardata;
}

# изчиства данните за плик, останал без документи 
function tranenve0($idenve){
global $DB;
	$cou2= $DB->selectCell("select count(*) from post where idenve=?d"  ,$idenve);
	if ($cou2==0){
$DB->query("update postenve set adresat='', address='' where id=?d"  ,$idenve);
	}else{
	}
}

# записва данните за плик от първия му документ 
function tranenve1($idenve,$idpost){
global $DB;
	$roenve= getrow("postenve",$idenve);
//print_ru($roenve);
	if (empty($roenve["adresat"]) and empty($roenve["address"])){
		$ropost= getrow("post",$idpost);
//print_ru($ropost);
			$aset= array();
		$aset["adresat"]= toutf8($ropost["adresat"]);
		$aset["address"]= toutf8($ropost["address"]);
$DB->query("update postenve set ?a where id=?d"  ,$aset,$idenve);
	}else{
	}
}

# обслужване записа 
function postinse($pset,$iscrea=true){
global $DB;
			if ($iscrea){
	$taid= $DB->query("insert into post set ?a, created=now()"  ,$pset);
			}else{
	$taid= $DB->query("insert into post set ?a"  ,$pset);
			}
return $taid;
}
function postupda($pset,$myid){
global $DB;
	$DB->query("update post set ?a where id=?d"  ,$pset,$myid);
}

# заместване съдържание на тагове 
# източник: cazo6crea.ajax.php 
function posttran($pacont,$artags){
global $listspectags;
//	$artags= tran1251($artags);
//print_rr($artags);
	$pattern= '|' .'\(\-\[' .'.+?' .'\]\-\)' .'|is';
	$found= preg_match_all($pattern, $pacont, $matches);
		$resucont= $pacont;
		foreach($matches[0] as $x1=>$maco){
			$maco2= substr($maco,3,strlen($maco)-6);
//print "<br>maco=$maco";
//print "<br>maco2=$maco2";
						//$maco= toutf8($maco);
						//$maco2= toutf8($maco2);
			$resu2= array_search($maco2,$listspectags);
			if ($resu2===false){
				$cont2= $artags[$maco];
//var_dump($cont2);
				$resucont= str_replace($maco,$cont2,$resucont);
			}else{
			}
		}
return $resucont;
}

# заместване група {empty} 
# източник: cazo6crea.ajax.php 
function posttranempty($pacont,$artags){
							$rbeg= "{empty}";
							$rend= "{/empty}";
//							$pattern= '|' .$rbeg .'.+?' .$rend .'|';
//$basepattern= $pattern;
											# 27.04.2010 - 
											# i= insensitive, s= на повече от един ред 
											$pattern= '|' .$rbeg .'.+?' .$rend .'|is';
							# търсим 
							$found= preg_match_all($pattern, $pacont, $matches);
							# цикъл за всички намерени стрингове 
							foreach($matches[0] as $x1=>$maco){
print "<br>maco=$maco";
								#--- за текущия стринг 
								# отделяме маркера 
								$blen= strlen($rbeg) +1;
								$mac2= substr($maco,$blen);
								$pos2= strpos($mac2,"}");
								$cumark= substr($mac2,0,$pos2);
print "<br>cumark=$cumark";
								# съдържанието за заместване на маркера 
								$emmark= "(-[" .$cumark ."]-)";
								//$emindx= array_search($emmark,$armeta);
								//if ($emindx===false){
//die("cazo6crea=emindx=$cumark");
								//}else{
									$emcont= $artags[$emmark];
print "<br>emcont=$emcont";
								//}
								# според съдържанието на маркера 
								if (empty($emcont)){
//								if (empty($emcont)    or $emcont=="0.00"){
									# празно съдържание на маркера 
									# ще премахнем целия текст заедно с таговете {empty}{маркер} текст {/empty} 
									$newcont= "";
								}else{
									# има съдържание на маркера 
									# ще оставим текста, но премахваме самите тагове {empty}{маркер} текст {/empty} 
									$newcont= $maco;
									$newcont= str_replace($rbeg,"",$newcont);
									$newcont= str_replace($rend,"",$newcont);
									$newcont= str_replace("{".$cumark."}","",$newcont);
								}
								# заместваме за текущия стринг 
		$pacont= str_replace($maco, $newcont, $pacont);
							# край на цикъла за всички намерени стрингове 
							}
		$pacont= posttran($pacont,$artags);
return $pacont;
}

# информация за колоната и cluetip 
function deliinfo($codein){
global $DB, $smarty;
global $codepostempty;
/*
			$ardeli= $DB->select("
				select post.iddocuout as ARRAY_KEY1, post.id as ARRAY_KEY2
					, post.*
					, poststat.name as statname
					, if($codepostempty,1,0) as nopostdata
					, if(post.idpoststat=0 or post.idposttype=poststat.idtype,0,1) as isertype
				from post
					left join poststat on post.idpoststat=poststat.id 
				where post.iddocuout in ($codein)
				");
*/
			$ardeli= $DB->select("
				select post.iddocuout as ARRAY_KEY1, post.id as ARRAY_KEY2
					, post.id
				from post
				where post.iddocuout in ($codein)
				");
			$ardeli= dbconv($ardeli);
//print_ru($ardeli);
			$smarty->assign("ARDELI", $ardeli);
						$ardelimeth= $DB->selectCol("
							select post.iddocuout as ARRAY_KEY, if(count(distinct post.idposttype)<=1 ,post.idposttype,-1)
							from post
							where post.iddocuout in ($codein)
							group by post.iddocuout
							");
//print_ru($ardelimeth);
						$smarty->assign("ARDELIMETH", $ardelimeth);
						$ardelinoda= $DB->selectCol("
							select post.iddocuout as ARRAY_KEY, if(sum(if($codepostempty,0,1))=0,0,1)
							from post
							where post.iddocuout in ($codein)
							group by post.iddocuout
							");
//print_ru($ardelinoda);
						$smarty->assign("ARDELINODA", $ardelinoda);
}


?>