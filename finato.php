<?php

# логнатия потребител 
$iduser= @$_SESSION["iduser"];

# текущата страница 
//print_r($GETPARAM);
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

# сумарните записи 
$myquery= "select * from finatransfer2 order by name";
		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
		$query= $myquery;
		$prefurl= "";
		$baseurl= "mode=".$mode;
		$obpagi= new paginator(14, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);

# детайлните записи 
foreach($mylist as $myin=>$elem){
				# ВНИМАНИЕ. 
				# Условията за детайлните записи да съвпадат с полетата 
				# за групиране в етап-3 на подготвителния скрипт finatocrea.php 
				$myiban= $elem["iban"];
				$mybicc= $elem["bic"];
//				$mycond= "and finatransfer.iban='$myiban' and finatransfer.bic='$mybicc'";
				$mycond= "and finatransfer.iban='$myiban'";
	$mydeta= $DB->select("
		select finatransfer.* 
			,debtor.name as debtname ,debtor.bulstat as bulstat ,debtor.egn as egn
			,suit.serial as caseseri ,suit.year as caseyear
		from finatransfer 
			left join debtor on finatransfer.iddebtor=debtor.id
			left join finance on finatransfer.idfina=finance.id
			left join suit on finance.idcase=suit.id
		where finatransfer.codeabnorm='' 
$mycond
		order by suit.year desc, suit.serial desc
		");
//		order by finatransfer.name
//		"  ,$myiban,$mybicc);
	$mydeta= dbconv($mydeta);
	$mylist[$myin]["ardeta"]= $mydeta;
}
//print_rr($mylist);



# извеждаме 
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("finato.tpl","fetch");

?>
