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
		

# брой дни - интервал за предварително предупреждение 
//$daysdiff= 45;
$daysdiff= $p1days;

# шаблон за трансформация : [днешна дата] [минус] [определена дата плюс 2 години] 
# резултата е брой дни : 
#    положително, ако трансформираната дата е преди днешната 
#    отрицателно, ако трансформираната дата е СЛЕД днешната 
$codediff= "(datediff( date_add([DATEBASE],interval 2 year) ,date(now()) ))";

# трансформирана дата на образуване на делото 
$coded1= str_replace("[DATEBASE]","date(suit.created)",$codediff);
		
		# ограничен списък дела 
		$s1filt= "
/*------ делото да е образувано преди повече от (2 год.минус брой-дни-интервал) ------*/
	and $coded1 <= $daysdiff
/*------ 30.10.2018 делото да е с титул, различен от обезп.заповед ------*/
	and suit.idtitu<>2
/*------ 09.05.2019 делото да е с ред на отчета, различен от издръжка ------*/
	and suit.idrepo<>31
/*------ делото да е висящо или спряно ------*/
	and suit.idstat in (0,24,8)
		";

		# макс.дата на постъпване на входящ документ за дело [suit.id], NULL ако няма 
		$codemaxdocu= "
	select max(date(docu.created))
	from docusuit
	left join docu on docusuit.iddocu=docu.id
	left join aadocutype on docu.idtype=aadocutype.id
	where 
/*------ от всички входящи документи по делото ------*/
		docusuit.idcase=suit.id
/*------ типа входящ документ да се отчита при перемиране ------*/
		/*>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> and aadocutype.mode='pere' >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>*/
		and $code1in
	group by docusuit.idcase
		";

		# макс.дата на изходяване на изх.документ за дело [suit.id], NULL ако няма 
		$codemaxdout= "
	select max(date(docuout.registered))
	from docuout
	left join docutype on docuout.iddocutype=docutype.id
	where docuout.idcase=suit.id
/*------ изх.шаблон да се отчита при перемиране ------*/
		/*>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> and docutype.ispere=1 >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>*/
		and $code1out
	group by docuout.idcase
		";

		# макс.дата на постъпление за дело [suit.id], NULL ако няма 
		$codemaxfina= "
	select max(date(finance.dateinco))
	from finance
	where finance.idcase=suit.id
/*------ постъплението да не е на-взискател ------*/
		and finance.idtype<>9
	group by finance.idcase
		";


						include_once "common.php";
						
		# дело, дата-образуване и 3-те макс.дати 
		$codes1= "
			select suit.id as idcase, suit.idstat, date(suit.created) as casecrea
				, ($codemaxdocu) as maxdatedocu
				, ($codemaxdout) as maxdatedout
				, ($codemaxfina) as maxdatefina
			from suit
			where 1 $s1filt
			order by suit.id
			";
//			select suit.id as idcase, suit.idstat, suit.idor2 as idorde, date(suit.created) as casecrea

//$ardate= $DB->select($codes1);
//print_rr($ardate);

# общата макс.дата за делото 
$codemaxdate= "
				greatest(
					if(maxdatedocu is null,casecrea,maxdatedocu)
					,if(maxdatedout is null,casecrea,maxdatedout)
					,if(maxdatefina is null,casecrea,maxdatefina)
					)
	";
# брой оставащи дни от сега до макс.дата за делото 
$coded2= str_replace("[DATEBASE]",$codemaxdate,$codediff);
		
		# същите полета и общата макс.дата за делото 
		$codes2= "
			select * 
				, $codemaxdate as maxdate
				, $coded2 as diff
			from (
$codes1
			) as s2
/*------ общата макс.дата за делото да е преди повече от (2 год. минус брой-дни-интервал) ------*/
where $coded2 <= $daysdiff
			";

//$ardate= $DB->select($codes2);
//print_rr($ardate);

		# още полета за делото 
		$p1sele= "
, t2.*
, t2.maxdatedocu as datepere, t2.maxdatedout as datedout, t2.maxdatefina as datefina
, suit2.serial, suit2.year, suit2.created, suit2.iduser
, if(archive.id is null,0,1) as isarch
		";
		$p4sele= "
, user.name as username
, (select count(*) from claimer where claimer.idcase=t4.idcase) as counclai
, (select count(*) from debtor where debtor.idcase=t4.idcase) as coundebt
		";

/*		
		# същите полета заедно с още полета за делото 
		$codes4= "
			select 1 $p1sele
			from (
$codes2
			) as s4
			left join suit as suit2 on s4.idcase=suit2.id
			";

//$ardate= $DB->select($codes4);
//print_rr($ardate);
*/
		
		# окончателна заявка - същата, но с външния филтър 
		$q4= "
			select 1 $p1sele
			from (
$codes2
			) as t2
			left join suit as suit2 on t2.idcase=suit2.id
			left join archive on suit2.id=archive.idcase
where $filtvari
			";
//queryout($q4);

		# заявка за бройките 
/*
		$q4coun= "
			select * from (
$codes2
			) as t2 
		";
*/
		$q4coun= $codes2;
//queryout($q4coun);


?>