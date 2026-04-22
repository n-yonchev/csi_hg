<?php

$spec1= toutf8("съд");
	$spec1a= toutf8("съдруж");
	$spec1b= toutf8("правосъд");
	$spec1c= toutf8("съдеб");
	$spec1d= toutf8("чси");
	$spec1e= toutf8("съдов");
$spec2= toutf8("община");
$codefilt= "(
	[NAME] like '%$spec1%' 
		and [NAME] not like '%$spec1a%'
		and [NAME] not like '%$spec1b%'
		and [NAME] not like '%$spec1c%'
		and [NAME] not like '%$spec1d%'
		and [NAME] not like '%$spec1e%'
	or [NAME] like '%$spec2%'
	)";
/*
$codefilt= "(
	[NAME] like '%$spec1%' and [NAME] not in ('%$spec1a%','%$spec1b%','%$spec1c%','%$spec1d%')
	or [NAME] like '%$spec2%'
	)";
*/
//	and [NAME] not like '%$spec1a%' and [NAME] not like '%$spec1b%' and [NAME] not like '%$spec1c%' and [NAME] not like '%$spec1d%' 

$code1= str_replace("[NAME]","name",$codefilt);
$code2= str_replace("[NAME]","c3.name",$codefilt);
$DB->query("truncate table rep2tran");
$DB->query("
	insert into rep2tran
select t3.*
from (
	select t2.idcase 
		, (select id from claimer as c2 where c2.idcase=t2.idcase order by c2.id limit 1) as idclai
	from (
		select idcase
		from claimer
		where $code1
	) as t2
) as t3
left join claimer as c3 on t3.idclai=c3.id
where $code2
	");

//$pagecont= smdisp("rep2tran1.tpl","fetch");
$rep2cont= smdisp("rep2tran1.tpl","fetch");

?>