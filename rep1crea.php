<?php
# формира на отчет раздел 1 - вика се във вътр.фрейм - виж rep1list.tpl 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
# и още отгоре : 
#    $period - периода за отчета 
#    $create =1 - флаг за извеждане 

/*
# ширина на полето в excel 
# ВНИМАНИЕ. 
# Задължително е да съвпада след заместването, иначе excel файла не се отваря. 
//$exwi= 11;
//$exwi= 8;
$exwi= 16;
# брой на колоните за попълване - шифрите от 1 до 16 
$coco= 16;
# шаблон за отделен маркер : шифър на реда - номер колона 
//$tempmark= "{{%s-%s}}";
//$tempmark= "0,%s%s";
$tempmark= '=VALUE("%s%s")';
# шаблон за новото съдържание след заместване 
$tempnumb= '=VALUE("%s")';
*/

//# име на входния файл - шаблона 
//$f1name= "report/rep1.xls";
# шаблон за изх.файл 
$f2temp= "rep1-%s.xls";
# име на изходния файл - резултата 
list($ye,$pa)= explode("-",$period);
if (empty($pa)){
	$f2pa= $ye;
}else{
	$f2pa= "$ye-$pa";
}
$f2name= sprintf($f2temp,$f2pa);


# заместваме в шаблона 
#-----------------------------------------------------------------------------

# начален и краен месец на периода - според полугодието 
if (empty($pa)){
		$mon1= 1;
		$mon2= 12;
}else{
	if ($pa==1){
		$mon1= 1;
		$mon2= 6;
	}elseif ($pa==2){
		$mon1= 7;
		$mon2= 12;
	}else{
die("rep1crea=1");
	}
}
# общ филтър за фразата where 
# участват записите преди и по време на периода, не участват след периода 
//$filter= "year(suit.created)<=$ye and month(suit.created)<=$mon2";
# 11.07 2011 - след тест от Ангел 
$filter= "12*year(suit.created)+month(suit.created) <= 12*$ye+$mon2";
# код за дело, постъпило през периода 
$inperi= "year(suit.created)=$ye and month(suit.created)>=$mon1 and month(suit.created)<=$mon2";
# ВНИМАНИЕ. 21.12.2009 
# допълнително - номера на делото трябва да е за същата година 
$inperi .= " and suit.year=$ye";
									
									# 30.07.2010 - нов подход - директни списъци за статусите (СВЪРШЕНИ) 
									# остават за кол.7 (НЕСВЪРШЕНИ) :  0=без статус и 24=висящо 
									$stcol4= "121,16";
//									$stcol5= "4,8,122,123,124,125,126,127,128";
									# 15.01.2016 - 129 - др.причини 
									$stcol5= "4,8,122,123,124,125,126,127,128   ,129";
									$stcol6= "201,202";
		# код за образувано преди периода 
		# ВНИМАНИЕ.
		# това е временно решение, защото за предишни дела датата на образуване created е по-късна от реалната 
//		$codebefo= "year(created)<$ye";
		$codebefo= "suit.year<$ye";
			# масив със свършени и прекратени - $listterminate - commspec.php 
			# стринг за фразата "in" от този масив - $codeinterm 
		# код за несвършено дело 
		$codenotend= "suit.idstat not in ($codeinterm)";
									
									//# 30.07.2010 - нов подход - директен списък статуси за несвършено дело 
									//$codenotend= "suit.idstat not in ($stcol4  ,$stcol5  ,$stcol6)";
									# 30.07.2010 - нов подход - директен списък статуси за СВЪРШЕНО дело 
									$codeyesend= "suit.idstat in ($stcol4  ,$stcol5  ,$stcol6)";
									
		# промяната на статуса е преди периода 
		$codestatbefo= "12*year(suit.timestat)+month(suit.timestat) < 12*$ye+$mon1";
# код за дело, образувано преди периода и несвършено КЪМ началото на периода 
$notendbefoperi= "$codebefo and $codenotend and ($codestatbefo)";
									# 30.07.2010 - нов подход 
									# подход чрез пълно отрицание, защото при idstat=0 timestat е празно 
$notendbefoperi= "$codebefo and not ($codeyesend and ($codestatbefo))";

					# ------------------- първо деление ------------------------------
					# кол. 1,2 - несвършени преди периода и образувани през периода 
$var1= "case when $notendbefoperi then '01' when $inperi then '02' else '00' end";
//var_dump($var1);
					
					# ------------------- второ деление ------------------------------
					# кол. 4,5,6 - свършени, прекратени, изпратени през периода 
					# виж commspec.php - $listcasestat 
/***********************************
					$code4= "suit.idstat=16";
						$ark1= array_keys($lica1);
						$ink1= implode(",",$ark1);
					$code5= "suit.idstat in ($ink1)";
						$ark2= array_keys($lica2);
						$ink2= implode(",",$ark2);
					$code6= "suit.idstat in ($ink2)";
***********************************/
									
									# 30.07.2010 - нов подход - директен списък статуси 
								/*
									$code4= "suit.idstat in (121,16)";
									$code5= "suit.idstat in (4,8,122,123,124,125,126,127,128)";
									$code6= "suit.idstat in (201,202)";
								*/
									$code4= "suit.idstat in ($stcol4)";
									$code5= "suit.idstat in ($stcol5)";
									$code6= "suit.idstat in ($stcol6)";
									
					# промяната на статуса е ПРЕЗ периода 
# 06.07.2011 - отново вярното условие 
					$codestatinpe= "year(timestat)=$ye and month(timestat)>=$mon1 and month(timestat)<=$mon2";
//					$codestatinpe= $inperi;
					# комбинирани условия 
					$c4= "$code4 and ($codestatinpe)";
					$c5= "$code5 and ($codestatinpe)";
					$c6= "$code6 and ($codestatinpe)";
$var2= "case when $c4 then '04' when $c5 then '05' when $c6 then '06' else '00' end";
//var_dump($var2);

/*====
					# ------------------- трето деление ------------------------------
					# кол. 8,9,10,11,12 - характер на изпълнението - всички преди и през периода 
					# виж commspec.php - $listchartype 
					//$code8= "idchar=1";
					//$code9= "idchar=2";
					//$code10= "idchar=3";
					//$code11= "idchar=4";
					//$code12= "idchar=5";
					# промяната на статуса е ПРЕЗ периода - $filter 
//					$codestatinpe= "year(timestat)=$ye and month(timestat)>=$mon1 and month(timestat)<=$mon2";
					# комбинирани условия 
					$c8 = "suit.idchar=1 and ($filter)";
					$c9 = "suit.idchar=2 and ($filter)";
					$c10= "suit.idchar=3 and ($filter)";
					$c11= "suit.idchar=4 and ($filter)";
					$c12= "suit.idchar=5 and ($filter)";
$var3= "case when $c8 then '08' when $c9 then '09' when $c10 then '10' when $c11 then '11' when $c12 then '12' else '00' end";
									
									# 30.07.2010 - нов подход 
									# броят се принудителните действия, А НЕ ДЕЛАТА 
									# КРЪПКА - полетата се попълват с нули 
$var3= "'00'";

# заявка 1 - делата 
//	select count(suit.*) as coun, suit.idrepo, $var1 as var1, $var2 as var2, $var3 as var3
$que1= "
	select count(suit.id) as coun, suit.idrepo, $var1 as var1, $var2 as var2, $var3 as var3
	from suit 
	where $filter
	group by suit.idrepo, var1, var2, var3
	";
$lis1= $DB->select($que1);
$lis1= dbconv($lis1);
//print_r($lis1);
====*/
# заявка 1 - делата 
//	select count(suit.*) as coun, suit.idrepo, $var1 as var1, $var2 as var2, $var3 as var3
//	select count(suit.id) as coun, suit.idrepo, $var1 as var1, $var2 as var2, $var3 as var3
$que1= "
	select count(suit.id) as coun, suit.idrepo, $var1 as var1, $var2 as var2
	from suit 
	where $filter
	group by suit.idrepo, var1, var2
	";
$lis1= $DB->select($que1);
$lis1= dbconv($lis1);
//print $que1;
//print_rr($lis1);
$arrep1= print_r($lis1,true);
file_put_contents("rep1.txt",$arrep1);


#-------------------------------------------------------------------------
# за отчет ВСС 
					include_once "rep2.inc.php";
$que3= "
	select t4.* 
		, if(t4.var1='01',1,0) as c1
		, if(t4.var1='02',1,0) as c2
		, if(t4.var2='04',1,0) as c4
		, if(t4.var2='05',1,0) as c5
		, if(t4.var2='06',1,0) as c6
	from (
		select suit.id as idcase, $var1 as var1, $var2 as var2
		from suit 
		where $filter
		) as t4
	";
$tac1= $tarepo."_c1";
creafrom("20_c1", $tac1, "");
$DB->query("insert into `$tac1` $que3");
#-------------------------------------------------------------------------


					# 16.12.2010 
					# ------------------- характер на изпълнението ------------------------------
					# кол. 8,9,10,11,12 - броя на принудителните мероприятия по характер на изп. 
					# периода се отнася за датата на мероприятието 
					# характера се отнася за мероприятието, а не за делото 
					# участват ВСИЧКИ дела, независимо от датата на образуване 
					# принудителните мероприятия са записи от табл.jour с idchar<>0 
$inperichar= "year(jour.created)=$ye and month(jour.created)>=$mon1 and month(jour.created)<=$mon2";
					# комбинирани условия 
					$c8 = "jour.idchar=1 and ($inperichar)";
					$c9 = "jour.idchar=2 and ($inperichar)";
					$c10= "jour.idchar=3 and ($inperichar)";
					$c11= "jour.idchar=4 and ($inperichar)";
					$c12= "jour.idchar=5 and ($inperichar)";
$varcharac= "case when $c8 then '08' when $c9 then '09' when $c10 then '10' when $c11 then '11' when $c12 then '12' else '00' end";
# заявка [char] - всички принудителните мероприятия, създадени през периода - чрез $varcharac 
//	select count(docu.*) as coun, suit.idrepo as idrepo, $var1 as var1
//	where $iscomp and $compinpe and $filter
$quechar= "
	select count(joursuit.id) as coun, suit.idrepo as idrepo, $varcharac as varcharac
	from joursuit 
		left join jour on joursuit.idjour=jour.id
		left join suit on joursuit.idcase=suit.id
	where $inperichar 
	group by suit.idrepo, varcharac
	";
$lischar= $DB->select($quechar);
$lischar= dbconv($lischar);

/********************
					# ------------------- жалбите ------------------------------
					# кол. 13,14 - жалбите - всички и удовлетворените 
					# участват документите, които са жалби, постъпили през периода и са за дела, образувани преди и по време на периода 
					# броим всички жалби и само тези, които са удовлетворени и то през периода 
					# виж commspec.php - $liststatcomp, $TYPECOMP 
							# ВНИМАНИЕ. 
							# Всеки документ е свързан с група дела, а не с едно - чрез рефер.табл. docusuit 
							# За жалбата приемаме, че е свързана само с 1 дело и вземаме само първия запис от рефер.таблица 
					# дали е жалба 
					$iscomp = "docu.idtype=$TYPECOMP";
					# дали е постъпила (създадена) през периода 
					$compinpe= "year(docu.created)=$ye and month(docu.created)>=$mon1 and month(docu.created)<=$mon2";
					# дела, образувани преди и по време на периода - $filter 
# уловие - всички жалби 
$var1= "case when 1 then '13' else '00' end";
						# дали жалбата е удовлетворена 
						$code1= "aadocucomp.idstatus=1 ";
						# дали промяната на статуса (удовлетворена) е през периода 
						$code2= "year(aadocucomp.created)=$ye and month(aadocucomp.created)>=$mon1 and month(aadocucomp.created)<=$mon2";
						# комбинирано условие 
						$c14 = "$code1 and $code2";
# условие - само удовлетворените жалби 
$varyes= "case when $c14 then '14' else '00' end";

					# 30.07.2010 - нов подход 
					# жалбите са по всички дела - махаме $filter 
					# НЕ САМО ЗА дела, образувани преди и по време на периода - $filter 

						# 2 различни заявки 

# заявка 2 - всички жалби, създадени през периода - чрез $var1 
//	select count(docu.*) as coun, suit.idrepo as idrepo, $var1 as var1
//	where $iscomp and $compinpe and $filter
$que2= "
	select count(docu.id) as coun, suit.idrepo as idrepo, $var1 as var1
	from docu 
		left join docusuit on docu.id=docusuit.iddocu
		left join suit on docusuit.idcase=suit.id
	where $iscomp and $compinpe
	group by suit.idrepo, var1
	";
$lis2= $DB->select($que2);
$lis2= dbconv($lis2);
//print_r($lis2);
# заявка 3 - жалбите, удовлетворени през периода - чрез $varyes 
//	select count(docu.*) as coun, suit.idrepo as idrepo, $var1 as var1
//	where $iscomp and $compinpe and $filter
					# 30.07.2010 - нов подход 
					# БЕЗ ВРЪЗКА С жалбите, създадени през периода - отпада $compinpe 
$que3= "
	select count(docu.id) as coun, suit.idrepo as idrepo, $varyes as varyes
	from docu 
		left join docusuit on docu.id=docusuit.iddocu
		left join suit on docusuit.idcase=suit.id
			left join aadocucomp on docu.id=aadocucomp.iddocu
	where $iscomp
	group by suit.idrepo, varyes
	";
$lis3= $DB->select($que3);
$lis3= dbconv($lis3);
//print_r($lis3);
*********************/

					# 25.01.2011 
					# ------------------- жалбите ------------------------------
					# кол. 13,14 - жалбите - всички и удовлетворените 
					# участват документите, които са жалби, постъпили през периода и са за дела, независимо от датата на образуване 
//					# броим всички жалби и само тези, които са удовлетворени и то през периода 
//					# виж commspec.php - $liststatcomp, $TYPECOMP 
							# ВНИМАНИЕ. 
							# Всеки документ е свързан с група дела, а не с едно - чрез рефер.табл. docusuit 
							# За жалбата приемаме, че е свързана само с 1 дело и вземаме само първия запис от рефер.таблица 
//					# дали е жалба 
//					$iscomp = "docu.idtype=$TYPECOMP";
					# дали е постъпила през периода = внесена такса 
						$pacode= "aadocucomp.date4";
					$wher1= "$pacode<>''";
					$comp1= "year($pacode)=$ye and month($pacode)>=$mon1 and month($pacode)<=$mon2";
# уловие - постъпилите жалби 
$var1= "case when $comp1 then '13' else '00' end";
					# дали е удовлетворена през периода 
						$udcode= "aadocucomp.date6";
					$wheryes= "$udcode<>''";
					$compyes= "year($udcode)=$ye and month($udcode)>=$mon1 and month($udcode)<=$mon2";
# условие - удовлетворените жалби 
$varyes= "case when $compyes then '14' else '00' end";

$querefe= "select iddocu, idcase from docusuit group by iddocu";
# заявка - постъпили през периода 
//		left join docu on aadocucomp.iddocu=docu.id
//		left join ($querefe) as t2 on docu.id=t2.iddocu
$que2= "
	select count(aadocucomp.id) as coun, suit.idrepo as idrepo, $var1 as var1
	from aadocucomp
		left join ($querefe) as t2 on aadocucomp.iddocu=t2.iddocu
		left join suit on t2.idcase=suit.id
	where $wher1
	group by suit.idrepo, var1
	";
$lis2= $DB->select($que2);
$lis2= dbconv($lis2);

# заявка - удовлетворени през периода 
/*
$que3= "
	selectt count(aadocucomp.id) as coun, suit.idrepo as idrepo, $varyes as varyes
	from aadocucomp
		left join docu on aadocucomp.iddocu=docu.id
		left join docusuit on docu.id=docusuit.iddocu
		left join suit on docusuit.idcase=suit.id
	where $wheryes
	group by suit.idrepo, varyes
	";
*/
$que3= "
	select count(aadocucomp.id) as coun, suit.idrepo as idrepo, $varyes as varyes
	from aadocucomp
		left join ($querefe) as t2 on aadocucomp.iddocu=t2.iddocu
		left join suit on t2.idcase=suit.id
	where $wheryes
	group by suit.idrepo, varyes
	";
$lis3= $DB->select($que3);
$lis3= dbconv($lis3);

/***********************************
					# ------------------- призовките ------------------------------
					# съвпадат с ПДИ - покани за доброволно изпълнение 
					# кол. 15,16 - поканите - всички и връчените 
					# участват изходящите документи, които са ПДИ, създадени през периода и са за дела, образувани преди и по време на периода 
					# броим всички ПДИ и само тези, които са връчени и то през периода 
# условие за ПДИ 
#    ПДИ вече се маркират чрез полето mark=pdi 
$pdlist= getpdlist();
$iscomp = "docuout.iddocutype in ($pdlist)";
					# дали е постъпила (създадена) през периода 
							# ВНИМАНИЕ. 
							# Има създадени, но неизведени ПДИ. Правилно е да броим само ако е изведена и според датата на извеждане. 
							# В данните обаче няма датата на извеждане, затова вземаме датата на създаване. 
//					$compinpe= "year(docuout.created)=$ye and month(docuout.created)>=$mon1 and month(docuout.created)<=$mon2";
# 23.02.2010 
# вече има дата на извеждането - registered 
					$compinpe= "year(docuout.registered)=$ye and month(docuout.registered)>=$mon1 and month(docuout.registered)<=$mon2";
					# дела, образувани преди и по време на периода - $filter 
# условие - всички ПДИ 
$var1= "case when 1 then '15' else '00' end";
# ВНИМАНИЕ. 13.08.2009 - Божилова Бургас 
# броят се всички изходящи документи, а не само от тип ПДИ=4=$IDINVITA 
# броят се всички независимо дали делото е образувано в периода 
# - премахваме филтъра $iscomp, още и филтъра $filter 
$que4= "
	select count(docuout.id) as coun, suit.idrepo as idrepo, $var1 as var1
	from docuout 
		left join suit on docuout.idcase=suit.id
	where $compinpe
	group by suit.idrepo, var1
	";
$lis4= $DB->select($que4);
$lis4= dbconv($lis4);
//print_r($lis4);
					
					#------ специално за кол.16 ------
					# дали ПДИ е връчена 
							# ВНИМАНИЕ. 
							# Датата на връчване aainvita.date е в бълг.формат d.m.y 
							# затова ще броим връчените чрез отделна заявка без group by и ще разлагаме датата програмно. 
$quepdiyes= "
	select aainvita.*, suit.idrepo as idrepo
	from aainvita 
		left join docuout on aainvita.iddocuout=docuout.id
		left join suit on docuout.idcase=suit.id
	where $iscomp and $compinpe and $filter
	";
//print "$quepdiyes\n";
$lispdiyes= $DB->select($quepdiyes);
$lispdiyes= dbconv($lispdiyes);
//print_r($lispdiyes);
***********************************/


					# 30.07.2010 - нов подход 

# кол.16  - само изх.документи 
# всички изходящи документи, изведени през периода 
$compinpe4= "year(docuout.registered)=$ye and month(docuout.registered)>=$mon1 and month(docuout.registered)<=$mon2";
$var4= "case when 1 then '16' else '00' end";
$que4= "
	select count(docuout.id) as coun, suit.idrepo as idrepo, $var4 as var1
	from docuout 
		left join suit on docuout.idcase=suit.id
	where $compinpe4
	group by suit.idrepo, var1
	";
$lis4= $DB->select($que4);
$lis4= dbconv($lis4);
//print_rr($lis4);

# допълнително за кол.15 - добавя се към кол.16 
# всички ръчно добавени записи от дневника на изв.действия, създадени през периода 
# без поле за колона 
$compinpe5= "year(jour.created)=$ye and month(jour.created)>=$mon1 and month(jour.created)<=$mon2";
//$var5= "case when 1 then '16' else '00' end";
/*
$que5= "
	select count(jour.id) as coun, suit.idrepo as idrepo
	from jour 
		left join suit on jour.idcase=suit.id
	where $compinpe5
	group by suit.idrepo
	";
*/
			# 06.10.2010 - 
			# всяко ръчно добавено действие може да има списък с дела, а не само едно 
$qusub= "select * from jour where $compinpe5";
$que5= "
	select count(joursuit.id) as coun, suit.idrepo as idrepo
	from joursuit
		left join ($qusub) as t2 on joursuit.idjour=t2.id
		left join suit on joursuit.idcase=suit.id
	where t2.id is not null
	group by suit.idrepo
	";
$lis5= $DB->select($que5);
$lis5= dbconv($lis5);
//print_rr($lis5);



# шаблон за отделен маркер : шифър на реда - номер колона 
//$tempmark= "{{%s-%s}}";
//$tempmark= "0,%s%s";
//$tempmark= '=VALUE("%s%s")';
$tempmark= "%s-%s";
# формираме масив за заместване на маркерите в шаблона 
# $repocode - шифрите на редовете - според указателя idrepo 
				$arrepl= array();
/*
foreach($lis1 as $elem){
	$idrepo= $elem["idrepo"];
		$corepo= $repocode[$idrepo];
	$var1= $elem["var1"];
		$comark= sprintf($tempmark  ,$corepo,$var1);
				$coun= $elem["coun"];
				$arrepl[$comark]= $coun;
	$var2= $elem["var2"];
		$comark= sprintf($tempmark  ,$corepo,$var2);
				$coun= $elem["coun"];
				$arrepl[$comark]= $coun;
	$var3= $elem["var3"];
		$comark= sprintf($tempmark  ,$corepo,$var3);
				$coun= $elem["coun"];
				$arrepl[$comark]= $coun;
}
//print_r($arrepl);
*/

# за всички заявки 
/*====
fillarrepl($lis1,array("var1","var2","var3"));
====*/
fillarrepl($lis1,array("var1","var2"));
		$arrep1= print_r($arrepl,true);
		file_put_contents("rep1.txt",$arrep1,FILE_APPEND);
fillarrepl($lischar,array("varcharac"));
fillarrepl($lis2,array("var1"));
fillarrepl($lis3,array("varyes"));
fillarrepl($lis4,array("var1"));
//+++ksort($arrepl);
//+++print_rr($arrepl);
//fp($arrepl);
file_put_contents($creaname1, serialize($arrepl));


/***********************************
					#------ специално за кол.16 ------
					# дали ПДИ е връчена 
					foreach($lispdiyes as $elem){
		$idrepo= $elem["idrepo"];
			$corepo= $repocode[$idrepo];
			$comark= sprintf($tempmark  ,$corepo,"16");
						# разлагаме датата 
						list($myda,$mymo,$myye)= explode(".",$elem["date"]);
						# ако датата е в периода - броим 
//$compinpe= "year(docuout.created)=$ye and month(docuout.created)>=$mon1 and month(docuout.created)<=$mon2";
						if ($myye==$ye and $mymo>=$mon1 and $mymo<=$mon2){
			$arrepl[$comark] += 1;
						}else{
						}
					}
***********************************/

					# 30.07.2010 - нов подход 

					# формираме кол.15 
					foreach($lis4 as $elem){
						$idrepo= $elem["idrepo"];
						$corepo= $repocode[$idrepo];
						$comark= sprintf($tempmark  ,$corepo,"15");
								$arrepl[$comark] += $elem["coun"];
					}
					foreach($lis5 as $elem){
						$idrepo= $elem["idrepo"];
						$corepo= $repocode[$idrepo];
						$comark= sprintf($tempmark  ,$corepo,"15");
								$arrepl[$comark] += $elem["coun"];
					}
//print_rr($arrepl);



function fillarrepl($dblist,$arname){
global $arrepl, $repocode, $tempmark;
	foreach($dblist as $elem){
		$idrepo= $elem["idrepo"];
			$corepo= $repocode[$idrepo];
		$coun= $elem["coun"];
//+++print "\r\n[$idrepo][$coun]";
		foreach($arname as $cuname){
			$valuname= $elem[$cuname];
			$comark= sprintf($tempmark  ,$corepo,$valuname);
//print "\r\n[$idrepo][$corepo][$coun][$valuname][$comark]";
//+++print "\r\n[$idrepo][$comark][$coun]=";
//+++print $arrepl[$comark];
//						$arrepl[$comark]= $coun;
						# 21.12.2009 - ОПРАВЕНА ВАЖНА ГРЕШКА 
						$arrepl[$comark] += $coun;
//+++print "=".$arrepl[$comark];
		}
	}
}




//							include_once "rep1crea.inc.php";

# 20.05.2009 - не работи с include 
#+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
# начало на вмъкнатия код 

/**/
$row0= 10;
$col0= "B";
/*
$totcol= 18;
*/
									# юни 2019 промени в отчетите раздел 1 и 2 
									# без последните 2 колони - общото колич.колони 
$totcol= 16;

$forcol[3]= array("1","+","2");
$forcol[7]= array("3","-","4","-","5","-","6");

$forrow[1300]= array("1310","+","1320","+","1330","+","1340");
$forrow[1200]= array("1210","+","1220","+","1230");
/*
$forrow[1100]= array("1110","+","1120");
$forrow[1000]= array("1100","+","1200","+","1300","+","1400","+","1500");
*/
									# юни 2019 промени в отчетите раздел 1 и 2 
									# формули за новите редове 
									$forrow[1140]= array("1150","+","1160");
									$forrow[1110]= array("1120","+","1130");
									$forrow[1100]= array("1110","+","1140","+","1170");
									$forrow[1000]= array("1100","+","1200","+","1300","+","1400","+","1500");

$listro= array(
	"1000"
/*
	,"1100","1110","1120"
*/
									# юни 2019 промени в отчетите раздел 1 и 2 
									# новите редове 
									,"1100","1110","1120","1130","1140","1150","1160","1170"
	,"1200","1210","1220","1230"
	,"1300","1310","1320","1330","1340"
	,"1400"
	,"1500"
	);

//$listco= array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16");
									# юни 2019 промени в отчетите раздел 1 и 2 
									# без последните 2 колони 
$listco= array("1","2","3","4","5","6","7","8","9","10","11","12","13","14");
		$nameco= array();
foreach($listco as $indx=>$elem){
		$nameco[$elem]= chr(ord($col0)+$indx+1);
}
//print_r($nameco);
/**/

//$listrepl= array(1,2  ,4,5,6  ,8,9,10,11,12  ,13,14,15,16);
									# юни 2019 промени в отчетите раздел 1 и 2 
									# без последните 2 колони 
$listrepl= array(1,2  ,4,5,6  ,8,9,10,11,12  ,13,14);

/**/
$left= array();
$left[]= array(
	/*
	"cont"=> array("а","б","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16")
	*/
									# юни 2019 промени в отчетите раздел 1 и 2 
									# без последните 2 колони 
	"cont"=> array("а","б","1","2","3","4","5","6","7","8","9","10","11","12","13","14")
	,"form"=> 4
	);
$left[]= array(
	"cont"=> array("ОБЩО","1000")
	,"form"=> 3
	);

/*
$left[]= array(
	"cont"=> array("I. В ПОЛЗА НА ДЪРЖАВАТА","1100")
	,"form"=> 2
	);
$left[]= array(
	"cont"=> array("а) публични държавни вземания","1110")
	,"form"=> 2
//	,"repl"=> array(1=>"1110-01", 2=>"1110-02", 4=>"1110-04", 5=>"1110-05", 6=>"1110-06")
	,"repl"=> crearepl("1110")
	);
$left[]= array(
	"cont"=> array("б) частни държавни вземания","1120")
	,"form"=> 3
//	,"repl"=> array(1=>"1120-01", 2=>"1120-02", 4=>"1120-04", 5=>"1120-05", 6=>"1120-06")
	,"repl"=> crearepl("1120")
	);
*/
					# юни 2019 промени в отчетите раздел 1 и 2 
					# "form"=> 3 = подчертаване 
					$left[]= array(
						"cont"=> array("I. В ПОЛЗА НА ДЪРЖАВАТА И ОБЩИНИТЕ","1100")
						,"form"=> 3
						);
					$left[]= array(
						"cont"=> array("1. В ПОЛЗА НА ДЪРЖАВНИ ОРГАНИ","1110")
						,"form"=> 2
						);
					$left[]= array(
						"cont"=> array("а) публични вземания","1120")
						,"form"=> 2
						,"repl"=> crearepl("1120")
						);
					$left[]= array(
						"cont"=> array("б) частни вземания","1130")
						,"form"=> 3
						,"repl"=> crearepl("1130")
						);
					$left[]= array(
						"cont"=> array("2. В ПОЛЗА НА ОБЩИНИТЕ","1140")
						,"form"=> 2
						);
					$left[]= array(
						"cont"=> array("а) публични вземания","1150")
						,"form"=> 2
						,"repl"=> crearepl("1150")
						);
					$left[]= array(
						"cont"=> array("б) частни вземания","1160")
						,"form"=> 3
						,"repl"=> crearepl("1160")
						);
					$left[]= array(
						"cont"=> array("3. В ПОЛЗА НА СЪДИЛИЩАТА","1170")
						,"form"=> 3
						,"repl"=> crearepl("1170")
						);

$left[]= array(
	"cont"=> array("II. В ПОЛЗА НА ЮРИДИЧЕСКИ ЛИЦА И ТЪРГОВЦИ","1200")
	,"form"=> 2
	);
$left[]= array(
	"cont"=> array("а) в полза на банки","1210")
	,"form"=> 2
//	,"repl"=> array(1=>"1210-01", 2=>"1210-02", 4=>"1210-04", 5=>"1210-05", 6=>"1210-06")
	,"repl"=> crearepl("1210")
	);
$left[]= array(
	"cont"=> array("б) в полза на търговци","1220")
	,"form"=> 2
//	,"repl"=> array(1=>"1220-01", 2=>"1220-02", 4=>"1220-04", 5=>"1220-05", 6=>"1220-06")
	,"repl"=> crearepl("1220")
	);
$left[]= array(
	"cont"=> array("в) в полза на други ЮЛ","1230")
	,"form"=> 3
//	,"repl"=> array(1=>"1230-01", 2=>"1230-02", 4=>"1230-04", 5=>"1230-05", 6=>"1230-06")
	,"repl"=> crearepl("1230")
	);

$left[]= array(
	"cont"=> array("III. В ПОЛЗА НА ГРАЖДАНИ","1300")
	,"form"=> 2
	);
$left[]= array(
	"cont"=> array("а) за издръжка","1310")
	,"form"=> 2
//	,"repl"=> array(1=>"1310-01", 2=>"1310-02", 4=>"1310-04", 5=>"1310-05", 6=>"1310-06")
	,"repl"=> crearepl("1310")
	);
$left[]= array(
	"cont"=> array("б) по трудови спорове","1320")
	,"form"=> 2
//	,"repl"=> array(1=>"1320-01", 2=>"1320-02", 4=>"1320-04", 5=>"1320-05", 6=>"1320-06")
	,"repl"=> crearepl("1320")
	);
$left[]= array(
	"cont"=> array("в) предаване на дете","1330")
	,"form"=> 2
//	,"repl"=> array(1=>"1330-01", 2=>"1330-02", 4=>"1330-04", 5=>"1330-05", 6=>"1330-06")
	,"repl"=> crearepl("1330")
	);
$left[]= array(
	"cont"=> array("д) други","1340")
	,"form"=> 3
//	,"repl"=> array(1=>"1340-01", 2=>"1340-02", 4=>"1340-04", 5=>"1340-05", 6=>"1340-06")
	,"repl"=> crearepl("1340")
	);

$left[]= array(
	"cont"=> array("IV. ИЗПЪЛНЕНИЕ НА ЧУЖДЕСТРАННИ РЕШЕНИЯ","1400")
	,"form"=> 3
//	,"repl"=> array(1=>"1400-01", 2=>"1400-02", 4=>"1400-04", 5=>"1400-05", 6=>"1400-06")
	,"repl"=> crearepl("1400")
	);

$left[]= array(
	"cont"=> array("V. ИЗПЪЛНЕНИЕ НА ОБЕЗПЕЧИТЕЛНИ МЕРКИ","1500")
	,"form"=> 3
//	,"repl"=> array(1=>"1500-01", 2=>"1500-02", 4=>"1500-04", 5=>"1500-05", 6=>"1500-06")
	,"repl"=> crearepl("1500")
	);
/**/

/**/
function crearepl($rocode){
global $listrepl;
			$arresu= array();
	foreach($listrepl as $indx=>$elem){
		$padele= str_pad($elem,2,"0",STR_PAD_LEFT);
			$arresu[$elem]= $rocode ."-" .$padele;
	}
//print_r($arresu);
return $arresu;
}
/**/

# край на вмъкнатия код 
#+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++





# начало на Excel формирането 
require_once('write_excel/Worksheet.php');
require_once('write_excel/Workbook.php');

function HeaderingExcel($filename) {
      header("Content-type: application/vnd.ms-excel");
      header("Content-Disposition: attachment; filename=$filename" );
      header("Expires: 0");
      header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
      header("Pragma: public");
}

// HTTP headers
HeaderingExcel($f2name);

// Creating a workbook
$workbook = new Workbook("-");
// Creating the first worksheet
$ws1 =& $workbook->add_worksheet('отчет раздел 1');
$ws1->set_landscape();
//$ws1->set_column(0, 0, 26);
$ws1->set_column(0, 0, 30);
$ws1->set_column(1, 1, 5);
$ws1->set_column(2, 18, 5);

//$form1 =& $workbook->add_format(array("center"=>1));
$form1 =& $workbook->add_format();
	$form1->set_align('center');
$form2 =& $workbook->add_format();
//	$form2->set_text_wrap('1');
	$form2->set_text_wrap();
$form3 =& $workbook->add_format();
//	$form3->set_text_wrap('1');
	$form3->set_text_wrap();
	$form3->set_bottom('1');
$form4 =& $workbook->add_format();
	$form4->set_align('center');
	$form4->set_align('vcenter');
	$form4->set_bottom('1');
	$form4->set_top('1');
	$form4->set_left('1');
	$form4->set_right('1');
$arform[1]= $form1;
$arform[2]= $form2;
$arform[3]= $form3;
$arform[4]= $form4;


# заглавие 
$text= "Раздел 1 - изпълнителни дела";
$crow= $row0 -4;
$ws1->set_row($crow, 35);
$f1 =& $workbook->add_format();
	$f1->set_bold();
//	$f1->set_size(55);
	$f1->set_align('center');
	$f1->set_align('vcenter');
	$f1->set_merge();
									//$f1->rotation= 90;
/*
$f2 =& $workbook->add_format();
	$f2->set_bold();
//	$f2->set_size(55);
	$f2->set_align('center');
	$f2->set_align('vcenter');
	$f2->set_merge();
*/
//$ws1->write      ($row0, 0, $text, $f1);
$ws1->write($crow, 0, $text, $f1);
wblank($crow, $f1);

function wblank($crow, $f1){
global $ws1, $totcol;
	for ($i=1; $i<=$totcol-1; $i++){
		$ws1->write_blank($crow, $i, $f1);
	}
}

# заглавие 
$txpa= $ye;
if (empty($pa)){
	$txpa .= " год.";
}else{
	$txpa .= " год. полугодие " .$pa;
}
$text= "ЗА ДЕЙНОСТТА НА ЧАСТЕН СЪДЕБЕН ИЗПЪЛНИТЕЛ В ОКРЪЖНИТЕ СЪДЪЛИЩА ПРЕЗ " .$txpa;
$crow= $row0 -5;
$f1 =& $workbook->add_format();
//	$f1->set_bold();
//	$f1->set_size(55);
	$f1->set_align('center');
	$f1->set_align('vcenter');
	$f1->set_merge();
$ws1->write($crow, 0, $text, $f1);
wblank($crow, $f1);

$text= "ОТЧЕТ";
$crow= $row0 -6;
$ws1->write($crow, 0, $text, $f1);
wblank($crow, $f1);



# формати за антетката 
$fohe =& $workbook->add_format();
	$fohe->set_size(8);
	$fohe->set_align('center');
	$fohe->set_align('vcenter');
	$fohe->set_text_wrap();
		$fohe->set_top('1');
		$fohe->set_bottom('1');
		$fohe->set_left('1');
		$fohe->set_right('1');
$fohero =& $workbook->add_format();
	$fohero->set_size(8);
	$fohero->set_align('center');
	$fohero->set_align('vcenter');
	$fohero->set_text_wrap();
		$fohero->set_top('1');
		$fohero->set_bottom('1');
		$fohero->set_left('1');
		$fohero->set_right('1');
	$fohero->rotation= 90;
$arfohe["fohe"]= $fohe; 
$arfohe["fohero"]= $fohero; 

# антетка 
				$ws1->set_row($row0-1, 80);
				$ws1->set_row($row0-2, 22);
				$ws1->set_row($row0-3, 22);
$head= array();
$head[]= array(
	"cont"=> "Видове изпълнителни дела"
	,"coor"=> array($row0-3,0)
//	,"rota"=> true
	,"merg"=> array($row0-3,0  ,$row0-1,0)
	);
$head[]= array(
	"cont"=> "Шифър на реда"
	,"coor"=> array($row0-3,1)
	,"rota"=> true
	,"merg"=> array($row0-3,1  ,$row0-1,1)
	);
$head[]= array(
	"cont"=> "Движение на делата"
	,"coor"=> array($row0-3,2)
//	,"rota"=> true
	,"merg"=> array($row0-3,2  ,$row0-3,8)
	);
$head[]= array(
	"cont"=> "несвършени дела в началото на отчетния период"
	,"coor"=> array($row0-2,2)
	,"rota"=> true
	,"merg"=> array($row0-2,2  ,$row0-1,2)
	);
$head[]= array(
	"cont"=> "постъпили"
	,"coor"=> array($row0-2,3)
	,"rota"=> true
	,"merg"=> array($row0-2,3  ,$row0-1,3)
	);
$head[]= array(
	"cont"=> "всичко"
	,"coor"=> array($row0-2,4)
	,"rota"=> true
	,"merg"=> array($row0-2,4  ,$row0-1,4)
	);
$head[]= array(
	"cont"=> "Прекратени"
	,"coor"=> array($row0-2,5)
//	,"rota"=> true
	,"merg"=> array($row0-2,5  ,$row0-2,6)
	);
$head[]= array(
	"cont"=> "свършени чрез реализиране на вземането"
	,"coor"=> array($row0-1,5)
	,"rota"=> true
//	,"merg"=> array($row0-1,5  ,$row0-1,5)
	);
$head[]= array(
	"cont"=> "по други причини"
	,"coor"=> array($row0-1,6)
	,"rota"=> true
//	,"merg"=> array($row0-1,6  ,$row0-1,6)
	);
$head[]= array(
	"cont"=> "изпратени на друг съдебен изпълнител"
	,"coor"=> array($row0-2,7)
	,"rota"=> true
	,"merg"=> array($row0-2,7  ,$row0-1,7)
	);
$head[]= array(
	"cont"=> "останали несвършени в края н отчет.период"
	,"coor"=> array($row0-2,8)
	,"rota"=> true
	,"merg"=> array($row0-2,8  ,$row0-1,8)
	);
$head[]= array(
	"cont"=> "Характер на изпълнението"
	,"coor"=> array($row0-3,9)
//	,"rota"=> true
	,"merg"=> array($row0-3,9  ,$row0-3,13)
	);
$head[]= array(
	"cont"=> "Продажби на вещи"
	,"coor"=> array($row0-2,9)
//	,"rota"=> true
	,"merg"=> array($row0-2,9  ,$row0-2,10)
	);
$head[]= array(
	"cont"=> "движими"
	,"coor"=> array($row0-1,9)
	,"rota"=> true
//	,"merg"=> array($row0-1,9  ,$row0-1,9)
	);
$head[]= array(
	"cont"=> "недвижими"
	,"coor"=> array($row0-1,10)
	,"rota"=> true
//	,"merg"=> array($row0-1,10  ,$row0-1,10)
	);
$head[]= array(
	"cont"=> "въводи"
	,"coor"=> array($row0-2,11)
	,"rota"=> true
	,"merg"=> array($row0-2,11  ,$row0-1,11)
	);
$head[]= array(
	"cont"=> "предаване на движими вещи"
	,"coor"=> array($row0-2,12)
	,"rota"=> true
	,"merg"=> array($row0-2,12  ,$row0-1,12)
	);
$head[]= array(
	"cont"=> "други"
	,"coor"=> array($row0-2,13)
	,"rota"=> true
	,"merg"=> array($row0-2,13  ,$row0-1,13)
	);
$head[]= array(
	"cont"=> "Брой жалби"
	,"coor"=> array($row0-3,14)
//	,"rota"=> true
	,"merg"=> array($row0-3,14  ,$row0-3,15)
	);
$head[]= array(
	"cont"=> "постъпили"
	,"coor"=> array($row0-2,14)
	,"rota"=> true
	,"merg"=> array($row0-2,14  ,$row0-1,14)
	);
$head[]= array(
	"cont"=> "уважени"
	,"coor"=> array($row0-2,15)
	,"rota"=> true
	,"merg"=> array($row0-2,15  ,$row0-1,15)
	);
									# юни 2019 промени в отчетите раздел 1 и 2 
									# без последните 2 колони 
/*
$head[]= array(
	"cont"=> "Призовки и книжа"
	,"coor"=> array($row0-3,16)
//	,"rota"=> true
	,"merg"=> array($row0-3,16  ,$row0-3,17)
	);
$head[]= array(
	"cont"=> "изготвени"
	,"coor"=> array($row0-2,16)
	,"rota"=> true
	,"merg"=> array($row0-2,16  ,$row0-1,16)
	);
$head[]= array(
	"cont"=> "връчени"
	,"coor"=> array($row0-2,17)
	,"rota"=> true
	,"merg"=> array($row0-2,17  ,$row0-1,17)
	);
*/

# формати за горните зони 
$ftop1 =& $workbook->add_format();
	$ftop1->set_size(10);
	$ftop1->set_align('vcenter');
		$ftop1->set_top('1');
//		$ftop1->set_bottom('1');
		$ftop1->set_left('1');
		$ftop1->set_right('1');
$ftop1cent =& $workbook->add_format();
	$ftop1cent->set_size(10);
	$ftop1cent->set_align('center');
	$ftop1cent->set_align('vcenter');
		$ftop1cent->set_top('1');
//		$ftop1cent->set_bottom('1');
		$ftop1cent->set_left('1');
		$ftop1cent->set_right('1');
$ftop2 =& $workbook->add_format();
	$ftop2->set_size(10);
	$ftop2->set_align('vcenter');
//		$ftop2->set_top('1');
//		$ftop2->set_bottom('1');
		$ftop2->set_left('1');
		$ftop2->set_right('1');
$ftop3 =& $workbook->add_format();
	$ftop3->set_size(10);
	$ftop3->set_align('vcenter');
//		$ftop3->set_top('1');
		$ftop3->set_bottom('1');
		$ftop3->set_left('1');
		$ftop3->set_right('1');
$ftop3cent =& $workbook->add_format();
	$ftop3cent->set_size(10);
	$ftop3cent->set_align('center');
	$ftop3cent->set_align('vcenter');
//		$ftopcent->set_top('1');
		$ftop3cent->set_bottom('1');
		$ftop3cent->set_left('1');
		$ftop3cent->set_right('1');
$arfohe["ftop1"]= $ftop1; 
$arfohe["ftop1cent"]= $ftop1cent; 
$arfohe["ftop2"]= $ftop2; 
$arfohe["ftop3"]= $ftop3; 
$arfohe["ftop3cent"]= $ftop3cent; 

# лявата горна зона 
$head[]= array(
	"cont"=> "ПОЛУЧАТЕЛ : МП"
	,"coor"=> array(0,0)
	,"merg"=> array(0,0  ,0,3)
	,"form"=> "ftop1"
	);
$head[]= array(
	"cont"=> "ЧАСТЕН СЪДЕБЕН ИЗПЪЛНИТЕЛ"
	,"coor"=> array(1,0)
	,"merg"=> array(1,0  ,1,3)
	,"form"=> "ftop2"
	);
								$rooffi= getofficerow(0);
$head[]= array(
	"cont"=> "РЕГ.№ " .$rooffi["serial"]
	,"coor"=> array(2,0)
	,"merg"=> array(2,0  ,2,3)
	,"form"=> "ftop2"
	);
$head[]= array(
	"cont"=> "ОКРЪЖЕН СЪД : "
	,"coor"=> array(3,0)
	,"merg"=> array(3,0  ,3,3)
	,"form"=> "ftop3"
	);
/*
# дясната горна зона 
$head[]= array(
	"cont"=> "МИНИСТЕРСТВО НА ПРАВОСЪДИЕТО"
	,"coor"=> array(0,10)
	,"merg"=> array(0,10  ,0,17)
	,"form"=> "ftop1cent"
	);
$head[]= array(
	"cont"=> " "
	,"coor"=> array(1,10)
	,"merg"=> array(1,10  ,1,17)
	,"form"=> "ftop2"
	);
$head[]= array(
	"cont"=> "ФОРМА СП - ЧСИ"
	,"coor"=> array(2,10)
	,"merg"=> array(2,10  ,2,17)
	,"form"=> "ftop3cent"
	);
*/
									# юни 2019 промени в отчетите раздел 1 и 2 
									# без последните 2 колони - отместваме блока 2 колони вляво 10->8 17->15 
# дясната горна зона 
$head[]= array(
	"cont"=> "МИНИСТЕРСТВО НА ПРАВОСЪДИЕТО"
	,"coor"=> array(0,8)
	,"merg"=> array(0,8  ,0,15)
	,"form"=> "ftop1cent"
	);
$head[]= array(
	"cont"=> " "
	,"coor"=> array(1,8)
	,"merg"=> array(1,8  ,1,15)
	,"form"=> "ftop2"
	);
$head[]= array(
	"cont"=> "ФОРМА СП - ЧСИ"
	,"coor"=> array(2,8)
	,"merg"=> array(2,8  ,2,15)
	,"form"=> "ftop3cent"
	);

# извеждаме антетката 
foreach($head as $elem){
	$cont= $elem["cont"];
	$coor= $elem["coor"];
	$merg= $elem["merg"];
	$rota= $elem["rota"];
	$form= $elem["form"];
		list($cellro,$cellco)= $coor;
		if ($rota){
			$fhindx= "fohero";
		}else{
			$fhindx= "fohe";
		}
		if (isset($form)){
			$fhindx= $form;
		}else{
		}
		$cuform= $arfohe[$fhindx];
$ws1->write($cellro, $cellco, $cont, $cuform);
	if (isset($merg)){
		list($r0,$c0,$r1,$c1)= $merg;
$ws1->merge_cells($r0,$c0,$r1,$c1);
				# форматиране на празните клетки 
				# номерацията на редовете и колоните трябва да е нарастваща 
				for($irow=$r0; $irow<=$r1; $irow++){
					for($icol=$c0; $icol<=$c1; $icol++){
						if ($irow==$cellro and $icol==$cellco){
						}else{
$ws1->write_blank($irow, $icol, $cuform);
						}
					}
				}
	}else{
	}
}




/**/
$ffor =& $workbook->add_format();
	$ffor->set_bottom('1');
/*
$arffor= array($row0+1, $row0+4, $row0+8, $row0+13, $row0+14, $row0+15);
*/
					# юни 2019 промени в отчетите раздел 1 и 2 
					# кои редове да бъдат подчертани 
					$arffor= array($row0+1, $row0+2, $row0+5, $row0+8, $row0+9, $row0+13, $row0+18, $row0+19, $row0+20);
#----------------------------------------------------------------------------------------------
# формулите за колони 
							# отместване на 2 реда за формулите 
							$rowoffset= 2;
foreach($listro as $roin=>$roco){
					$roaddr= $row0+$roin  +$rowoffset;
	foreach($forcol as $indx=>$cont){
							$form= "";
//print "[$indx][$cont]";
		foreach($cont as $formel){
			$for2= $formel+0;
//print "====[$indx][$formel]";
			if ($for2==0){
							$form .= $formel;
			}else{
					$coaddr= $nameco[$for2];
					$celladdr= $coaddr.$roaddr;
//print "+++[$roaddr][$coaddr][$celladdr]";
							$form .= $celladdr;
			}
		}
//var_dump($form);
		$formcoaddr= $nameco[$indx+1];
//print "===[$indx][$formcoaddr]/";
		$formcelladdr= $formcoaddr.$roaddr;
//var_dump($formcelladdr);
			#-------------------------------------------------
//print "===[$roaddr][$indx][$form]\n";
			$form= "=" .$form;
//			$form= "=VALUE(\"" .$form ."\")";
											$reffor= array_search($roaddr-1,$arffor);
											//$myffor= ($reffor===false) ? 0 : $ffor;
//print "111\n";
//var_dump($reffor);
											if ($reffor===false){
			$ws1->write_formula($roaddr-1,$indx+1,$form);
											}else{
			$ws1->write_formula($roaddr-1,$indx+1,$form    ,$ffor);
											}
			#-------------------------------------------------
	}
}
/**/

/**/
#----------------------------------------------------------------------------------------------
# формулите за редове 
foreach($nameco as $coin=>$cona){
//print "[$cona]\n";
	foreach($forrow as $indx=>$cont){
							$form= "";
//print "[$cona][$indx]\n";
		foreach($cont as $formel){
//print "[$cona][$indx][$formel]\n";
			$for2= $formel+0;
			if ($for2==0){
							$form .= $formel;
			}else{
					$roindx= array_search("$for2",$listro);
					if ($roindx===false){
die("rep1crea=2=$for2");
					}else{
					}
					$roaddr= $row0+$roindx + $rowoffset;
//print "[$roaddr]\n";
					$celladdr= $cona.$roaddr;
//print "[$celladdr]\n";
							$form .= $celladdr;
			}
		}
//print "form=[$form]\n";
	$formroindx= array_search("$indx",$listro);
//print "[$formroindx]\n";
	if ($formroindx===false){
die("rep1crea=3=$cona");
	}else{
	}
	$formroaddr= $row0+$formroindx + $rowoffset;
//print "[$formroaddr]\n";
			#-------------------------------------------------
//print "===[$formroaddr][$coin][$form]\n";
			$form= "=" .$form;
											$reffor= array_search($formroaddr-1,$arffor);
											//$myffor= ($reffor===false) ? 0 : $ffor;
//print "222\n";
//var_dump($reffor);
											if ($reffor===false){
			$ws1->write_formula($formroaddr-1,$coin+1,$form);
											}else{
			$ws1->write_formula($formroaddr-1,$coin+1,$form    ,$ffor);
											}
			#-------------------------------------------------
	}
}
/**/

/**/
#----------------------------------------------------------------------------------------------
# редовете 
				$numrow= $row0-1;
foreach($left as $elem){
				$numrow ++;
				$numcol= -1;
# първите 2 колони с текстове 
	foreach($elem["cont"] as $elemcont){
				$numcol ++;
		$formindx= $elem["form"];
		if (isset($formindx)){
			$ws1->write_string($numrow,$numcol,$elemcont,$arform[$formindx]);
		}else{
			$ws1->write_string($numrow,$numcol,$elemcont);
		}
	}
			if (isset($elem["repl"])){
				$bascol= 1;
# следващите колони със съдържание 
	foreach($elem["repl"] as $indxrepl=>$elemrepl){
		$curcol= $bascol + $indxrepl;
		$curval= $arrepl[$elemrepl];
//print "[$numrow][$curcol][$curval]\n";
//			$ws1->write($numrow,$curcol,$curval+0);
//			$ws1->write($numrow,$curcol,"[$numrow][$curcol][$curval]");
//		if ($curval==0){
//		}else{
			$formindx= $elem["form"];
			if (isset($formindx)){
				$ws1->write($numrow,$curcol,$curval,$arform[$formindx]);
			}else{
				$ws1->write($numrow,$curcol,$curval);
			}
//		}
	}
			}else{
			}
}
#----------------------------------------------------------------------------------------------
/**/



# край 
$workbook->close();



?>
