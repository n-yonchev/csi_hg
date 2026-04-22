<?php
# отчет ВСС - подготовка 
//sleep(1);
//print $tarepo;

				# копирано от _claim2.php 
				# премахваме всички видове кавички - още при четенето с MySQL, в PHP не става 
				#  132=„  147=“  148=”  - виж резултата от _abet.php 
				$ups0= "replace(  replace(  replace(trim(claimer.name),char(132 using cp1251),'')  ,char(147 using cp1251),'')  ,char(148 using cp1251),'')";
				$ups1= "replace(  replace(  replace($ups0,'\\\"','')  ,'\\\\','')  ,\"\'\",'')";
				# троен и двоен интервал - става единичен 
				$ups2= "replace(  replace(  $ups1  ,'   ',' ')  ,'  ',' ')";

# заявката 
$t1= "`$tarepo`";
/*
$quclai= "
	select $t1.idcase as idcase
		, claimer.idtype as idtype
		, if(claimer.idtype=2,claimer.egn,claimer.bulstat) as iden
		, $ups1 as name
	from $t1
	left join claimer on $t1.idcase=claimer.idcase
	";
*/
/***
$quclai= "
	select $t1.idcase as idcase
		, t4.idtype as idtype
		, if(t4.idtype=2,t4.egn,t4.bulstat) as iden
		, $ups1 as name
	from $t1
	left join (
		select idcase, idtype, egn, bulstat, name
		from claimer
		where idcase=$t1.idcase and isjoin=0
		limit 1
	) as t4 on $t1.idcase=t4.idcase
	";
***/
$quclai= "
	select $t1.idcase as idcase
		, claimer.idtype as idtype
		, if(claimer.idtype=2,claimer.egn,claimer.bulstat) as iden
		, $ups2 as name
	from $t1
	left join (
		select distinct(idcase), id as idclai
		from claimer
		where isjoin=0
		group by idcase
	) as t4 on $t1.idcase=t4.idcase
	left join claimer on t4.idclai=claimer.id
	";

# таблицата 
//$taclai= $tarepo."_c2";
creafrom("20_c2", $taclai, "");
$DB->query("insert into `$taclai` $quclai");

# извеждаме 
//$smarty->assign("ARMESS", $artexter);
$rep2cont= smdisp("rep3v1.tpl","fetch");

?>