<?php
# всичко за ПКО 

#------------------------------------------------------------------------------------------------
# източник : <- kasa.inc.php дервиш <- cash2.inc.php - Бъзински 
$arc2type= array();
//$arc2type[1]= "постъпление";
$arc2type[1]= "постъпл.от длъжник";
$arc2type[2]= "аванс.такса от взиск.";
//$arc2type[3]= "разход";
$arc2type[9]= "ръчнo";
$smarty->assign("ARC2TYPE", $arc2type);
/*
$arc2docu= array();
$arc2docu[1]= "ПКО";
$arc2docu[2]= "ПКО";
$arc2docu[3]= "РКО";
$smarty->assign("ARC2DOCU", $arc2docu);
*/

# заявка постъпления от длъжник 
#-- код за дата 
$finafielem= "str_to_date(finance.cashdate,'%d.%m.%Y')";
#-- филтър само постъпления в-брой 
$finafilttype= "finance.idtype=2";
$qufina= "select 1 as typesuma, finance.id as idsuma
	, $finafielem as cashdate, finance.descrip, finance.inco as suma
, finance.cashserial, finance.cashyear
	, finance.cashiduser, finance.cashname, t2user.name as cashuser
	, suit.serial as caseseri, suit.year as caseyear, user.name as username
			, finance.idcase as idcase
			, suit.iduser as iduser
	from finance 
		left join suit on finance.idcase=suit.id
		left join user on suit.iduser=user.id
			left join user as t2user on finance.cashiduser=t2user.id
	where $finafilttype 
	";

# заявка аванс.вноска от взискател 
#-- код за дата 
$advafielem= "str_to_date(claimadva.cashdate,'%d.%m.%Y')";
#-- филтър само постъпления в-брой 
$advafilttype= "claimadva.iscash=1";
$quadva= "select 2 as typesuma, claimadva.id as idsuma
	, $advafielem as cashdate, claimadva.descrip, claimadva.amount as suma 
, claimadva.cashserial, claimadva.cashyear
	, claimadva.cashiduser, claimadva.cashname, t2user.name as cashuser
	, suit.serial as caseseri, suit.year as caseyear, user.name as username
			, claimer.idcase as idcase
			, suit.iduser as iduser
	from claimadva 
		left join claimer on claimadva.idclaimer=claimer.id
		left join suit on claimer.idcase=suit.id
		left join user on suit.iduser=user.id
			left join user as t2user on claimadva.cashiduser=t2user.id
	where $advafilttype 
	";
/*
# заявка РКО 
$qurazh= "select 3 as typesuma, razh.id as idsuma
	, razh.cashdate, razh.descrip, razh.amount as suma 
, razh.cashserial, razh.cashyear
	, razh.cashiduser, razh.cashname, razh.cashier as cashuser
	, suit.serial as caseseri, suit.year as caseyear, user.name as username
			, razh.idcase as idcase
			, suit.iduser as iduser
	from razh 
		left join suit on razh.idcase=suit.id
		left join user on suit.iduser=user.id
	";
*/

# заявка свободен ПКО 
$quprih= "select 9 as typesuma, prih.id as idsuma
	, prih.cashdate, prih.descrip, prih.amount as suma 
, prih.cashserial, prih.cashyear
	, prih.cashiduser, prih.cashname, prih.cashier as cashuser
, 0 as caseseri, 0 as caseyear, '' as username
, 0 as idcase
, 0 as iduser
	from prih 
	";

# обща заявка 
$c2query= "
	select t2.*
	from (
		($qufina) 
			union all 
		($quadva)
			union all 
		($quprih)
		) as t2
where [FILT]
	order by t2.cashdate desc, t2.typesuma desc
	";
# сумарна 
$c2qusuma= "
	select sum(if(t2.typesuma=3,0,t2.suma)) as suma1, sum(if(t2.typesuma=3,t2.suma,0)) as suma2
	from (
		($qufina) 
			union all 
		($quadva)
			union all 
		($quprih)
		) as t2
where [FILT]
	";
#------------------------------------------------------------------------------------------------


?>