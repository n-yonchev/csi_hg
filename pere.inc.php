<?php
# отгоре : 
#    параметри : $p1days, $p1inlist, $p1outlist 
//var_dump($p1inlist, $p1outlist);

# настройка на списъците вх/изх типове 
if (empty($p1inlist)){
	$code1in= "1";
}else{
	$list1= implode(",",$p1inlist);
	$code1in= "aadocutype.id in ($list1)";
}
if (empty($p1outlist)){
	$code1out= "1";
}else{
	$list2= implode(",",$p1outlist);
	$code1out= "docutype.id in ($list2)";
}
		
# 11.10.2018 планиране 2 
//$daysdiff= 45;
$daysdiff= $p1days;
$codediff= "(datediff( date_add(date(suit.created),interval 2 year) ,date(now()) ))";
//$codediff= "(datediff(date_sub(date(now()),interval 2 year),date(suit.created)))";
//$codesuit= "(date_sub(date(now()), interval 2 year)>=date(suit.created))"

		$p1sele= "
, suit.id as idcase
, $codediff as diff
, suit.serial, suit.year, suit.created, suit.idstat, suit.timestat
, suit.iduser
, (
	select max(date(docuout.registered))
	from docuout
	left join docutype on docuout.iddocutype=docutype.id
	where docuout.idcase=suit.id
/*------ изх.шаблон да се отчита при перемция ------*/
		/*>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> and docutype.ispere=1 >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>*/
		and $code1out
	group by docuout.idcase
) as datedout
, (
	select max(date(finance.dateinco))
	from finance
	where finance.idcase=suit.id
/*------ постъплението да не е на-взискател ------*/
		and finance.idtype<>9
	group by finance.idcase
) as datefina
, (
	select max(date(docu.created))
	from docusuit
	left join docu on docusuit.iddocu=docu.id
	left join aadocutype on docu.idtype=aadocutype.id
	where 
/*------ от всички входящи документи по делото ------*/
		docusuit.idcase=suit.id
/*------ типа входящ документ да е за евент.перемиране ------*/
		/*>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> and aadocutype.mode='pere' >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>*/
		and $code1in
	group by docusuit.idcase
) as datepere
		";

		$p4sele= "
, user.name as username
, (select count(*) from claimer where claimer.idcase=t4.idcase) as counclai
, (select count(*) from debtor where debtor.idcase=t4.idcase) as coundebt
		";
		
		$p1filt= "
/*------ делото да е образувано преди > 2 год. минус въведените $p1days дни ------*/
	and $codediff <= $daysdiff
/*------ 30.10.2018 делото да е с титул, различен от обезп.заповед ------*/
	and suit.idtitu<>2
/*------ 06.12.2018 делото да е висящо ------*/
	and suit.idstat in (0,24)
		";
/*------ 30.11.2018 делото да не е все още перемирано ------*/
//	and suit.idstat<>4
		
		$p2filt= "
/*------ изх.документ от важащ шаблон да липсва или ако има - последното изходяване на такъв да е преди > 2 год. ------*/
	and 
	(t2.datedout is null or date_sub(date(now()), interval 2 year)>=t2.datedout)
/*------ постъпления да липсват или ако има, датата на последното да е преди > 2 год. ------*/
	and 
	(t2.datefina is null or date_sub(date(now()), interval 2 year)>=t2.datefina)
/*------ входящи документи за евент.перемиране да липсват или ако има, датата на последния да е преди > 2 год. ------*/
	and 
	(t2.datepere is null or date_sub(date(now()), interval 2 year)>=t2.datepere)
		";

$q4= "
	select t2.*, if(archive.id is null,0,1) as isarch
	from (
		select 'a' as a $p1sele from suit where 1 $p1filt
and $filtvari
	) as t2 
	left join archive on t2.idcase=archive.idcase
	where 1 $p2filt
	";

/*
$q4= "
	select * from (
		select 'a' as a $p1sele from suit where 1 $p1filt
and $filtvari
	) as t2 where 1 $p2filt
	";
$q4coun= "
	select * from (
		select 'a' as a $p1sele from suit where 1 $p1filt
	) as t2 where 1 $p2filt
	";
*/


?>