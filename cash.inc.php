<?php
# общи ресурси за прих.ордери и касови пакети 

# функция - връща заявка за списък с прих.ордери 
# параметър : филтъра 
function getcashquery($filter=""){
	$where= (empty($filter)) ? "" : "where $filter";
	$query= "select cash.*, cash.id as id
		,debtor.name as debtname ,suit.serial as suseri ,suit.year as suyear
			,cashpack.serial as packseri, cashpack.amount as packamou, cashpack.idstatus as packstat
		from cash 
		left join debtor on cash.iddebtor=debtor.id
		left join suit on debtor.idcase=suit.id
			left join cashpack on cash.idcashpack=cashpack.id
		$where
		order by cash.date desc
		";
return $query;
}


?>