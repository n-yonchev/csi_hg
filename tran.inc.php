<?php


# 18.09.2017 ВНИМАНИЕ - странна грешка при Милен 
# - дублирани записи с finatran.idcase=0 
$filtnocase= "finatran.idcase<>0";

# 4 символа от IBAN -> име на банката и BIC на банката 
$temp4iban= "substring(%s,5,4)";
$code4bic= "substring(banklist.bic,1,4)";
				# 19.09.2017 ВАЖНО 
				# при Милен имаше 2 добавени банки с празен БИК, което води до грешна релация 
				# затова добавяме доп.условие 
				$bicex2= "finatran.iban<>''";
//$bictempjoin= "left join banklist on $temp4iban=$code4bic";
$bictempjoin= "left join banklist on $temp4iban=$code4bic and $bicex2";
	# 15.02.2018 след грешка при Милен 
	$bictj2= "left join banklist on $temp4iban=$code4bic";
function getiban4($p1){
return substr($p1,4,4);
}

# банки източници на превод 
$arbankpaym= array();
//$arbankpaym[1]= "Пощенска";
//$arbankpaym[2]= "ОББ";
//$arbankpaym[3]= "Алианц";
$arbankpaym[4]= "УниКредит";

$smarty->assign("ARBANKPAYM", $arbankpaym);
	$arbankpaym_utf8= toutf8($arbankpaym);
$smarty->assign("ARBANKPAYMNAME", "arbankpaym_utf8");
# индекс на Пощ.банка - 
# за нея има 2 вида пакети : бюджетен [tranpack.code="bud"] и кредитен [tranpack.code=""] 
	$indxbankpost= 4;
$smarty->assign("INDXBANKPOST", $indxbankpost);
	$codebankpost= "bud";
$smarty->assign("CODEBANKPOST", $codebankpost);
# тип на файла за банката 
$arbankpaymsuff= array();
$arbankpaymsuff[1]= "TXT";
//$arbankpaymsuff[2]= "XML";
$arbankpaymsuff[3]= "TXT";
$arbankpaymsuff[4]= "BGI";
$smarty->assign("ARBANKPAYMSUFF", $arbankpaymsuff);

# типове специфични сметки 
$araccotype= array();
$araccotype["nop"]= "за ЧСИ неолихвяеми";
//$araccotype["nop"]= "за ЧСИ неолихв чрез опис";
//$araccotype["t26"]= "за ЧСИ т.26 чрез опис";
$araccotype["t26"]= "за ЧСИ т.26";
$araccotype["bud"]= "за преводи към бюджета";
$araccotype["lis"]= "за формиране на опис";
$araccotype["uni"]= "за преводи от УниКредит";
$smarty->assign("ARACCOTYPE", $araccotype);
	$araccotype_utf8= array(""=>"") + toutf8($araccotype);
$smarty->assign("ARACCOTYPENAME", "araccotype_utf8");
# код за бюдж.сметка 
$codebudg= "bud";
# код за сметка за опис 
$codelist= "lis";
# код за сметка за опис по т.26 
$codet26= "t26";
# код за сметка за опис по ЧСИ неолихв 
$codenop= "nop";

#------------------------------------------------------------------------------
# 11.09.2017 ВАЖНА КОРЕКЦИЯ 
# кодове за полето tranacco.codeclai - индекс за псевдовзискател 
# - да съвпадат с индексите в $pseuclainame - fina.inc.php 
$araccocode= array();
$araccocode["nop"]= -3;
$araccocode["t26"]= -2;
#------------------------------------------------------------------------------

//# списък с полета за прехвърляне разрешение-връщане-чакащо 
//$artranfiel= "idfinance,idclaimer,iddebtor,amount,created,iban,bic,idtranbudget,isfull";

# за пакет според статуса - и за опис 
$arpacktext[0]= "активен";
$arpacktext[1]= "заключен";
//$arpacktext[2]= "преведен";
$arpacktext[2]= "приключен";
$smarty->assign("ARPACKTEXT", $arpacktext);
	$arpackcolo[0]= "lightgreen";
	$arpackcolo[1]= "gold";
	$arpackcolo[2]= "salmon";
# за деловодителя - списък постъпления - fina.php $armaxstat 
# - за директно преведена сума 
	$arpackcolo[-4]= "plum";
# - за чакаща сума 
	$arpackcolo[-2]= "skyblue";
$smarty->assign("ARPACKCOLO", $arpackcolo);



# код за статус на постъпление 
# 12.11.2012 - нови специални статуси [istran=2] : 
#      старо приключено = isclosed=1 istran=2 
#      готово за превод = isclosed=0 istran=2 
	$arwork= array();
# 29.09.2014 - неопределен тип 
//				$codeisnew= "finance.idtype in (1,2,7)";
$codeisnew= "finance.idtype in (0,1,2,7)";
				$coderestzero= "finance.rest+0=0";
				$codecloszero= "finance.isclosed=0";
				$codetranzero= "finance.istran=0";
#------------------------------------------------------------------------------------------
	$arwork[5]= "!($codecloszero) and (finance.istran in (0,2))";
	$arwork[2]= "!($codecloszero) and (finance.istran in (1))";
	$arwork[4]= "$codecloszero and !($codeisnew)";
	$arwork[3]= "$codecloszero and $codeisnew and !($coderestzero)";
	$arwork[6]= "$codecloszero and $codeisnew and $coderestzero and finance.istran=0";
	$arwork[1]= "$codecloszero and $codeisnew and $coderestzero and finance.istran=2";
#------------------------------------------------------------------------------------------
		$arcode= array();
foreach($arwork as $indx=>$elem){
		$arcode[]= "when " .$elem ." then ".$indx;
}
		$stcode= implode(" ",$arcode);
$finastatcode= "case $stcode else 0 end";

# статуси на постъпление 
$arfinastat= array();
$arfinastat[1]= "готово за превод";
$arfinastat[2]= "в списъка с преводи";
$arfinastat[3]= "неизравнено";
$arfinastat[4]= "приключи постарому";
$arfinastat[5]= "приключено постарому";
$arfinastat[6]= "изравнено";
$smarty->assign("ARFINASTAT", $arfinastat);
# статусите за менюто 
$arfinastat2= array();
//$arfinastat2[0]= "всички";
$arfinastat2[1]= "готови за превод";
$arfinastat2[2]= "в списъка с преводи";
$arfinastat2[3]= "неизравнени";
$arfinastat2[4]= "НА ВЗИСКАТЕЛЯ";
$arfinastat2[5]= "приключени постарому";
$arfinastat2[6]= "изравнени";
$arfinastat2[0]= "всички";
$smarty->assign("ARFINASTAT2", $arfinastat2);
# според менюто - икона към преводите 
$aristopaym= array();
$aristopaym[1]= 1;
$aristopaym[2]= 0;
$aristopaym[3]= 0;
$aristopaym[4]= 0;
$aristopaym[5]= 0;
$aristopaym[6]= 0;
$aristopaym[0]= 1;
# според менюто - доп.колони 
$arexcolo= array();
$arexcolo[1]= 0;
$arexcolo[2]= 1;
$arexcolo[3]= 0;
$arexcolo[4]= 0;
$arexcolo[5]= 0;
$arexcolo[6]= 0;
$arexcolo[0]= 0;



# общи филтри за постъпленията 
			$codeisnorm= "finatran.idstat=0";
			$codeisbudg= "tranacco.code is not null and tranacco.code='bud'";
//^			$codeisinve= "tranacco.code is not null and tranacco.code in ('t26','lis')";
//^			$codeisinve= "tranacco.code is not null and tranacco.code in ('t26','lis','nop')";
			#------ Милен 18.09.2017 - ЧСИнеолихв и ЧСИт26 да не са чрез опис ------
			//$codeisinve= "tranacco.code is not null and tranacco.code in ('t26','lis','nop') and finatran.isnolist=0";
			$codeisinve= "tranacco.code is not null and tranacco.code in ('lis') and finatran.isnolist=0";
# още филтри за постъпленията 
					$codebudgprob= "(tranbudget.id is null or tranbudget.typedoc='' or tranbudget.docdate='')";
//+					$codeprobpost= "finatran.idbank=$indxbankpost and bankbic.id is null";
					$codeprobpost= "finatran.idbank=$indxbankpost and banklist.id is null";
//+					$codeprobacco= "(length(finatran.iban)<>22 or length(finatran.bic)<>8)";
//=					$codeprobacco= "(length(finatran.iban)<>22)";
					$codeprobacco= "(length(finatran.iban)<>22 or finatran.ibaniser<>0)";
//						$codeclaiprob= "char_length(finatran.clainame)>35";
						$codeclaiprob= "(char_length(finatran.clainame)<1 or char_length(finatran.clainame)>35)";
						//$codetextprob= "(finatran.idbank=$indxbankpost and char_length(finatran.text)>70)";
//&							$codetextprob1= "(finatran.idbank=$indxbankpost and char_length(finatran.text)>70)";
//&							$codetextprob2= "(finatran.idbank<>$indxbankpost and (char_length(finatran.text1)>35 or char_length(finatran.text2)>35)";
//&						$codetextprob= "($codetextprob1 or $codetextprob2)";
/***/
//		$codelen_postbank= "char_length(finatran.text)>70";
		$codelen_postbank= "(char_length(finatran.text)<1 or char_length(finatran.text)>70)";
		$codetextprob1= "(finatran.idbank=$indxbankpost and $codelen_postbank)";
	$codedeliposi= "instr(finatran.text,'|')";
	$codesub1= "substring(finatran.text,1,$codedeliposi-1)";
	$codesub2= "substring(finatran.text,$codedeliposi+1)";
//	$codelen1= "char_length($codesub1)>35";
//	$codelen2= "char_length($codesub2)>35";
	$codelen1= "(char_length($codesub1)<1 or char_length($codesub1)>35)";
	$codelen2= "(char_length($codesub2)<1 or char_length($codesub2)>35)";
	$codetextprob2= "(finatran.idbank<>$indxbankpost and ($codelen1 or $codelen2))";
	$codetextprob= "($codetextprob1 or $codetextprob2)";
/***/
					$codeprob= "($codeprobacco or $codeprobpost or ($codeisbudg and $codebudgprob) or $codeclaiprob or $codetextprob)";



#++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
# пренесено от tranfi.php 
#-------------------------------------------------------------------------------------
# базов филтър 
//$basefilt= "$codeisnew and finance.idcase<>0 and finance.isclosed=0 and finance.rest+0=0";
# 12.11.2012 - старо приключено или готово за превод 
$basefilt= "$codeisnew and finance.idcase<>0 and finance.rest+0=0 and finance.isclosed=0 and finance.istran=2";
# базова заявка - постъпления 
		$qutran= "select finance.*, finance.id as id, finance.idcase as idcase, finance.iddebtor as iddebtor
			, suit.serial as caseseri, suit.year as caseyear
					, user.name as username
					, finasource.id as idsour, finasource.idfinabank, finasource.date as finadate, finasource.hour as finahour
					, finabank.codebank as codebank
							, t3.name as lockname
					, $finastatcode as idfinastat
						, datediff(finance.time,finance.dateinco) as delay1
						, datediff(if(finance.isclosed=0,now(),finance.timeclosed),finance.time) as delay2
						, date_format(finance.dateinco,'%d.%m.%Y') as visuinco
						, date_format(finance.time,'%d.%m.%Y') as visutime
						, date_format(if(finance.isclosed=0,now(),finance.timeclosed),'%d.%m.%Y') as visuclos

			from finance 
			left join suit on finance.idcase=suit.id
			left join user on suit.iduser=user.id
			left join finasource on finance.id=finasource.idfinance
			left join finabank on finasource.idfinabank=finabank.id
							left join user as t3 on finance.lockedby=t3.id
			";

# текстове за тип, банка 
$smarty->assign("ARTYPE", $listfinatype2);
$smarty->assign("ARBANK", $listxmltype);
#++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++



# за Бъзински 
# банки - източници на преводи 
$arfrombank= array();
$arfrombank[0]= "ПБ";
$arfrombank[1]= "ОББ";
$smarty->assign("ARFROMBANK", $arfrombank);
	$arfrombank_utf8= toutf8($arfrombank);
$smarty->assign("ARFROMBANKNAME", "arfrombank_utf8");

# базова заявка - доп.данни за постъпления и преводи 
$qurefe= "
		finatranrefe.idfinance as ARRAY_KEY1, finatran.idclaimer as ARRAY_KEY2
, finatranrefe.suma as suma
, finatran.statmodi as finastatmodi
, finatran.clainame as clainame
, tranpack.statmodi as packstatmodi
, finatran.id as printid
, tp2.statmodi as invepackstatmodi
		, finatran.amount, finatran.idbank, finatran.idinve, finatran.idpack
		, finatran.idinve as idinve, finatran.idpack as idpack
		, finatran.idstat as idstat
					, traninve.idstat as idinvestat, tranpack.idstat as idpackstat
					, traninve.idpack as idinvepack, tp2.idstat as idinvepackstat
	from finatranrefe
	left join finatran on finatranrefe.idfinatran=finatran.id
				left join traninve on finatran.idinve=traninve.id
				left join tranpack on finatran.idpack=tranpack.id
					left join tranpack as tp2 on traninve.idpack=tp2.id
	";

# базова заявка - приключени постъпления чрез преводи 
$costat= "if(finatran.idinve=0,tranpack.idstat,traninve.idstat)";
$cotranendd= "sum(if($costat=2 or finatran.idstat=9 ,1,0))";
$cofinaendd= "if(count(finatran.id)=$cotranendd ,1,0)";
$quendd= "
		finatranrefe.idfinance as ARRAY_KEY1, $cofinaendd as isendd
, count(finatran.id) as counfina
, $cotranendd as cotranendd
	from finatranrefe
	left join finatran on finatranrefe.idfinatran=finatran.id
				left join traninve on finatran.idinve=traninve.id
				left join tranpack on finatran.idpack=tranpack.id
	";
$quenddgr= "group by finatranrefe.idfinance";

# специфична релация за основ.заявка 
$codeon= "if(finatran.idclaimer in (-3,-2), finatran.iban=tranacco.iban and finatran.idclaimer=tranacco.codeclai, finatran.iban=tranacco.iban)";
$codetranacco= "left join tranacco on $codeon";
# за основната заявка 
					$codejoin= sprintf($bictempjoin,"finatran.iban");
$mainqucode= "
	from finatran 
	left join suit on finatran.idcase=suit.id
	left join user on suit.iduser=user.id
	left join claimer on finatran.idclaimer=claimer.id
	left join debtor on finatran.iddebtor=debtor.id
$codetranacco
			left join tranbudget on finatran.idtranbudget=tranbudget.id
		left join traninve on finatran.idinve=traninve.id
		left join tranpack on finatran.idpack=tranpack.id
			left join tranpack as tp2 on traninve.idpack=tp2.id
					$codejoin
	left join user as t2user on finatran.iduser=t2user.id
";
//							left join bankbic on finatran.bic=bankbic.bic
////			left join finatranrefe on finatran.id=finatranrefe.idfinatran
//////	left join finance on finatran.idfinance=finance.id
//////	left join suit on if(finatran.idcase=0,finance.idcase,finatran.idcase)=suit.id
//	left join suit on finance.idcase=suit.id
# връща основната заявка 
function getmainqu($filtcode){
global $mainqucode;
								# за тестове 
								global $codeisnorm, $codeisbudg, $codeisinve, $codebudgprob, $codeprobpost, $codeprobacco, $codeclaiprob, $codetextprob;
								global $codesub1, $codesub2;
$query= "
	select finatran.*, finatran.id as id, finatran.idpack as idpack, finatran.created as timetran
	, suit.serial as caseseri, suit.year as caseyear, suit.notes as casenote
	, user.name as username
, finatran.clainame as clainame
	, debtor.name as debtname, debtor.idtype as debttype, debtor.egn as debtegn, debtor.bulstat as debtbul
	, finatran.idcase as idcase
			/****** Милен 18.09.2017 - ЧСИнеолихв и ЧСИт26 да не са чрез опис ******/
			, if(tranacco.code in ('lis') ,1,0) as islist
			, tranacco.code as trancode, tranacco.desc as trandesc
					, traninve.idstat as idinvestat, tranpack.idstat as idpackstat
					, traninve.idpack as idinvepack, tp2.idstat as idinvepackstat
							, banklist.name as bankname, banklist.bic as bic
	, t2user.name as usernametran
					/*****
								, if($codeisnorm,1,0) as codeisnorm
								, if($codeisbudg,1,0) as codeisbudg
								, if($codeisinve,1,0) as codeisinve
								, if($codebudgprob,1,0) as codebudgprob
								, if($codeprobpost,1,0) as codeprobpost
								, if($codeprobacco,1,0) as codeprobacco
								, if($codeclaiprob,1,0) as codeclaiprob
								, if($codetextprob,1,0) as codetextprob
							, concat('[',$codesub1,']') as sub1, concat('[',$codesub2,']') as sub2
					*****/
$mainqucode
where $filtcode
	order by finatran.id desc
	";
						#------ Милен 18.09.2017 - ЧСИнеолихв и ЧСИт26 да не са чрез опис ------
//, if(tranacco.code in ('t26','lis','nop') ,1,0) as islist
//							, bankbic.bank as bankname
//	, user.name as username, claimer.name as clainame
//////, if(finatran.idbank=1 and bankbic.id is null,1,0) as codeprobpost
//////, if($codeprob,1,0) as codeprob
//////	, if(finatran.idcase=0,finance.idcase,finatran.idcase) as idcase
//////	, finance.isclosed as isclosed
//	, finance.idcase as idcase
return $query;
}
# връща сумата от ВСИЧКИ редове по основната заявка 
function getmainsuma($filtcode){
global $mainqucode, $DB;
$suma= $DB->selectCell("
	select sum(amount) as suma
$mainqucode
where $filtcode
	");
return $suma;
}

# връща заявка за опис 
function getinvequ($filtcode){
		$query= "select traninve.*, traninve.id as id, traninve.idstat as idstatinve 
			, tranacco.iban, tranacco.desc, tranacco.code as codeacco
			, tranpack.idstat as idstat, tranpack.idbank as idbankpack, tranpack.code as codepack
						, user.name as usernameinve
			from traninve
			left join tranacco on traninve.idacco=tranacco.id
			left join tranpack on traninve.idpack=tranpack.id
						left join user on traninve.iduser=user.id
where $filtcode
			order by traninve.id desc
			";
return $query;
}

# връща заявка за пакет 
function getpackqu($filtcode){
		$query= "select tranpack.*, tranpack.id as id 
						, user.name as usernamepack
			from tranpack
						left join user on tranpack.iduser=user.id
where $filtcode
			order by tranpack.id desc
			";
return $query;
}


# връща подзаявка за врем.таблица при назначаване 
function getworkcode($filtcode){
global $codetranacco;
	$workcode= "
		select id from (
			select finatran.id from finatran
/*......left join tranacco on finatran.iban=tranacco.iban......*/
$codetranacco
				left join tranbudget on finatran.idtranbudget=tranbudget.id
			where $filtcode
		) as t2
	";
return $workcode;
}

# кодиране/декодиране finatran.id за чекбоксовете 
function tocbcode($idcurr){
return base_convert($idcurr+51,10,29);
}
function fromcbcode($code){
return base_convert($code,29,10)-51;
}

# връща масив с активните пакети и съотв.брой преводи 
# $codepost - код за филтриране пакетите от Пощ.банка 
function getpackacti($codepost=""){
global $DB;
	$arpack= $DB->select("
		select tranpack.id as ARRAY_KEY, t2.coun, tranpack.idbank, tranpack.code
		from tranpack
		left join (
			select idpack, count(*) as coun
			from finatran 
			left join tranpack on finatran.idpack=tranpack.id
			where finatran.idpack<>0 and tranpack.idstat=0
			group by finatran.idpack
		) as t2 on tranpack.id=t2.idpack
	where tranpack.idstat=0
		order by tranpack.id desc
		");
//print_rr($arpack);
						$ar2= array();
foreach($arpack as $idpack=>$cont){
	if ($cont["idbank"]==1 and $cont["code"]<>$codepost){
	}else{
						$ar2[$idpack]= $cont;
	}
}
//return $arpack;
return $ar2;
}

# формира текстове за основание 
function updatrantext($idtran){
//global $DB;
	# подготовка 
		$rotran= getrow("finatran",$idtran);
		$rocase= getrow("suit",$rotran["idcase"]);
	# според "пълно погасяване" 
	if ($rotran["isfull"]==0){
		$textpp= "";
	}else{
//		$textpp .= " ПЪЛНО ПОГАСЯВАНЕ";
		$textpp= "ПЪЛНО";
	}
	# първи текст 
	$funu= getfullnumb2($rocase["serial"],$rocase["year"]);
		$rodebt= getrow("debtor",$rotran["iddebtor"]);
		if ($rodebt["idtype"]==1){
	$detx= "ЕИК ".$rodebt["bulstat"];
		}elseif ($rodebt["idtype"]==2){
	$detx= "ЕГН ".$rodebt["egn"];
		}else{
	$detx= "";
		}
	$text1= "ИД $funu$textpp $detx";
/*
	$text1= "ИД $funu $detx";
		# според "пълно погасяване" 
		if ($rotran["isfull"]==0){
		}else{
//			$text1 .= " ПЪЛНО ПОГАСЯВАНЕ";
			$text1 .= " ПЪЛНО";
		}
*/
	# втори текст 
	$debtname= $rodebt["name"];
	$debtname= charspec($debtname);
						if ($rotran["idclaimer"]==-1){
							# връщане 
	$text2= "ВРЪЩАНЕ НА ".$debtname;
						}elseif ($rotran["idclaimer"]==-2){
							# ЧСИ неолихв 
	$text2= "ЧСИ т.26";
						}elseif ($rotran["idclaimer"]==-3){
							# ЧСИ неолихв 
	$text2= "ЧСИ неолихвяеми";
						}else{
							# нормално 
	$text2= ($rodebt['client_number'] != '' ? "{$rodebt['client_number']} " : "") . $debtname;
						}
//		$text2= trim($text2);
		# сборен текст - според банката 
$indxbankpost= $GLOBALS["indxbankpost"];
		if ($rotran["idbank"]==$indxbankpost){
			$textup= "$text1 $text2";
		}else{
			$textup= "$text1|$text2";
		}
		$textup= toutf8($textup);
//var_dump($idtran);
//var_dump($textup);
	updrow("finatran",$idtran,"text='$textup'");
}

# премахва кавичките и др. 
# източник : _abet.php 
				#  132=„  147=“  148=”  - виж резултата от _abet.php 
function charspec($p1){
	$ar1= array('\"' ,'"' ,"\\", "/" ,"'" ,"-"  ,chr(132),chr(147),chr(148)  ,"\t" );
	$ar2= array(""   ,""  ,""  , ""  ,""  ," "  ,""      ,""      ,""        ,""   );
	$resu= str_replace($ar1,$ar2,$p1);
//var_dump($resu);
			$ar3= array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"
						,"a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
			$ar4= array("А","Б","Ц","Д","Е","Ф","Г","Х","И","Й","К","Л","М","Н","О","П","Я","Р","С","Т","У","В","В","Ь","Ъ","З"
						,"а","б","ц","д","е","ф","г","х","и","й","к","л","м","н","о","п","я","р","с","т","у","в","в","ь","ъ","з");
	$resu= str_replace($ar3,$ar4,$resu);
return $resu;
}

# четем специалните сметки в масив 
//$arspeciban= $DB->select("select code as ARRAY_KEY, iban, `desc` from tranacco");
//print_rr($arspeciban);

# данни за насочване на постъплението към финансиста 
function gettrandata($idfina){
global $DB;
global $pseuclaifiel, $pseuclainame, $arspeciban;
global $codebudg;
	$rofina= getrow("finance",$idfina);
//print_rr($rofina);
					$arresu= array();
	# псевдо взискатели 
	foreach($pseuclaifiel as $claicode=>$claifiel){
		$fisuma= $rofina[$claifiel];
//print "<br>[$claicode][$claifiel][$fisuma]";
		if ($fisuma+0==0){
		}else{
						$arelem= array();
						$arelem["suma"]= $fisuma;
						//$arelem["idclai"]= $claicode;
//						$arelem["clainame"]= $pseuclainame[$claicode];
//						$arelem["isinpu"]= true;
						if (0){
						}elseif($claicode==-3){
							# ЧСИ неолихв. 
							$arelem["clainame"]= $pseuclainame[$claicode];
//							$arelem["iban"]= $arspeciban["nop"]["iban"];
							$arelem["inpuid"]= "";
						}elseif($claicode==-2){
							# ЧСИ т.26 
							$arelem["clainame"]= $pseuclainame[$claicode];
//							$arelem["iban"]= $arspeciban["t26"]["iban"];
							$arelem["inpuid"]= "";
						}elseif($claicode==-1){
							# връщане на длъжник - сметката-източник 
/*
								$iddebtor= $rofina["iddebtor"];
								$rodebt= getrow("debtor",$iddebtor);
							$arelem["clainame"]= "връщане на длъжник " .$rodebt["name"];
*/
							$arelem["clainame"]= "връщане на длъжник";
//							$arelem["iban"]= $rodebt["iban"];
							$arelem["iban"]= $rofina["iban"];
//+							$arelem["bic"]= $rofina["bic"];
//							$arelem["inpuid"]= "iban_".$iddebtor."_debt";
							$arelem["inpuid"]= "iban_debt";
							$arelem["inpuidbic"]= "bic_debt";
												$arelem["inpudebt"]= "debt_D";
			$arelem["oldinpuid"]= "old".$arelem["inpuid"];
						}else{
die("gtranda=1=$claicode");
						}
//					$arresu[]= $arelem;
					$arresu[$claicode]= $arelem;
		}
	}
	# взискателите 
//	$arclai= getclailist($rofina["idcase"]);
	$idcase= $rofina["idcase"];
//var_dump($idcase);
//	$arclai= $DB->select("select id as ARRAY_KEY, name, iban, bic from claimer where idcase=?d order by id"  ,$idcase);
	$arclai= $DB->select("
		select claimer.id as ARRAY_KEY, claimer.name, claimer.iban, claimer.bic 
			, if(tranacco.code='$codebudg',1,0) as isbudg
		from claimer 
		left join tranacco on claimer.iban=tranacco.iban
		where idcase=?d 
		order by claimer.id
		"  ,$idcase);
	$arclai= dbconv($arclai);
	$arclai= arstrip($arclai);
	$arto= unsetoclai($rofina["toclai"]);
	foreach($arto as $idclai=>$tosuma){
		if ($tosuma+0==0){
		}else{
						$arelem= array();
						$arelem["suma"]= $tosuma;
						//$arelem["idclai"]= $idclai;
						//$arelem["isinpu"]= true;
						$arelem["clainame"]= $arclai[$idclai]["name"];
						$arelem["iban"]= $arclai[$idclai]["iban"];
						$arelem["bic"]= $arclai[$idclai]["bic"];
						$arelem["isbudg"]= $arclai[$idclai]["isbudg"];
						$arelem["inpuid"]= "iban_".$idclai;
						$arelem["inpuidbic"]= "bic_".$idclai;
												$arelem["inpudebt"]= "debt_".$idclai;
												$arelem["inpufull"]= "full_".$idclai;
//					$arresu[]= $arelem;
			$arelem["oldinpuid"]= "old".$arelem["inpuid"];
					$arresu[$idclai]= $arelem;
		}
	}
return $arresu;
}


# връща бюджетните сметки 
function getarbudg(){
global $DB;
	$arbudg= $DB->selectCol("select iban from tranacco where code=?"  ,"bud");
return $arbudg;
}
function getlistbudg($arbudg){
	if (empty($arbudg)){
$listbudg= "''";
	}else{
		$ar2= array();
		foreach($arbudg as $elem){
			$ar2[]= "'$elem'";
		}
$listbudg= implode(",",$ar2);
	}
return $listbudg;
}

# връща сметките -3= неолих и -2= т.26
function getarspec(){
global $DB;
//	$arspec= $DB->selectCol("select (if(code='nop',-3,-2)) as ARRAY_KEY, iban from tranacco where code in ('nop','t26')");
	$arspec= $DB->select("select (if(code='nop',-3,-2)) as ARRAY_KEY, iban, bic from tranacco where code in ('nop','t26')");
return $arspec;
}

# връща пълния номер на делото - алтернативна функция 
function getfullnumb2($caseseri,$caseyear){
global $rooffi;
return $caseyear .$rooffi['serial'] ."04" .str_pad($caseseri,5,"0",STR_PAD_LEFT);
}

# трансформация на дата за бюджетен превод за ИЗХ.ФАЙЛ 
function tranbudgdate($mydate){
	$resudate= bgdatefrom($mydate);
	$resudate= str_replace(".","",$resudate);
return $resudate;
}

# хедър за ИЗХ.ФАЙЛ 
function OutfHeader($filename="outp"){
//	header("Content-type: application/vnd.ms-word");
	header("Content-type: application/plain");
	header("Content-Disposition: attachment; filename=$filename" );
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
	header("Pragma: public");
}

# IBAN контролно число 
function ibancheck($iban){
//print "<br>------FUNC------$iban<br>";
	if (strlen($iban)==22){
	}else{
//return "*";
return "A";
	}
				if (function_exists("bcmod")){
				}else{
return true;
				}
	$iban2= substr_replace($iban,"00",2,2);
	$iban3= substr($iban2,4).substr($iban2,0,4);
						$str3= "";
//print "=$iban3=";
	for($i=0;$i<strlen($iban3);$i++){
		$char= substr($iban3,$i,1);
//var_dump($char);
//print "=[$char]=";
		if (strpos("0123456789",$char)===false){
			$numb= ord($char)-ord("A")+10;
//var_dump($numb);
			if ($numb>=10 and $numb<=35){
			}else{
//return NULL;
return "B";
			}
						$str3 .= $numb;
		}else{
						$str3 .= $char;
		}
//print "[$str3]";
	}
//print "[$str3]";
//++++++var_dump((int)$str3);
//++++++	$remind= (int)$str3 % 97;
						# спец.библиотека BCMath - произволна точност 
						$remind= bcmod($str3,"97");
//print "remind=[$remind]";
	$resu= 98 - $remind;
//print "resu=[$resu]";
	$stresu= (string)$resu;
	if (strlen($stresu)==1){
		$stresu= "0".$stresu;
	}else{
	}
	if ($stresu==substr($iban,2,2)){
return true;
	}else{
return $stresu;
	}
}

# IBAN проверка 
function ibanerror($iban){
global $DB;
global $code4bic;
								$ermess= "";
//		$iban= $_POST["iban"];
		$ibanslen= 22;
		$slen= strlen($iban);
		if ($slen<>$ibanslen){
								$ermess= "съдържа $slen вместо $ibanslen символа";
		}else{
			# IBAN контр.число (2 цифри) 
			$chresu= ibancheck($iban);
//var_dump($chresu);
			if($chresu === "A"){
								$ermess= "грешна дължина";
			}elseif($chresu === "B"){
								$ermess= "съдържа грешни символи";
			}elseif ($chresu!==true){
				$let2= substr($iban,0,2);
								$ermess= "грешен IBAN [$let2$chresu]";
			}else{
				$mybicpart= getiban4($iban);
				$roba= $DB->selectRow("select * from banklist where $code4bic=?" ,$mybicpart);
				if (empty($roba)){
								$ermess= "няма банка с bic=$mybicpart"."xxxx";
				}else{
				}
			}
		}
return $ermess;
}


?>