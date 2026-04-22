<?php
# постъпленията, готови за приключване 
#    източник : fina.php 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $page - текущата страница 
#    $codebudg="bud" - код за бюдж.сметка 
//print_rr($GETPARAM);
//print_rr($_POST);

								# функции за финансите 
								include_once "fina.inc.php";
if ($flagbankmass){
}else{
$pagecont= "<br><center>функцията е изключена</center>";
return;
}
								# всичко за преводите 
								include_once "tran.inc.php";

# базов филтър 
//$basefilt= "finance.idtype in (1,2) and finance.isclosed=0 and finance.rest+0=0";
//$basefilt= "finance.idtype in (1,2) and finasource.id is not null and finance.isclosed=0 and finance.rest+0=0";
//$basefilt= "(finance.idtype=1 and finasource.id is not null or finance.idtype=2) and finance.isclosed=0 and finance.rest+0=0";
//$basefilt= "$codeisnew and finance.isclosed=0 and finance.rest+0=0";
$basefilt= "$codeisnew and finance.idcase<>0 and finance.isclosed=0 and finance.rest+0=0";
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
/***
# базова заявка - доп.данни за постъпления и преводи 
$qurefe= "
		finatranrefe.idfinance as ARRAY_KEY1, finatran.idclaimer as ARRAY_KEY2
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
***/

# текстове за тип, банка 
$smarty->assign("ARTYPE", $listfinatype2);
$smarty->assign("ARBANK", $listxmltype);

//# код за бюдж.сметка 
//$codebudg= "bud";
									
									# функции, свързани с финансите 
									include_once "fina.inc.php";

# текущата страница 
//print_rr($GETPARAM);
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

# за връщане 
$baco= "mode=".$mode."&page=".$page;
$relurl= geturl($baco);
//$smarty->assign("GOTEXT", "назад към стр. $page от постъпленията готови за превод");
$smarty->assign("GOTEXT", "постъпления готови за превод [стр.$page]");
$smarty->assign("GOBACK", $relurl);
									
									# избрано постъпление - отключване 
									$unlock= $GETPARAM["unlock"];
									if (isset($unlock)){
//$relurl= geturl("mode=".$mode."&vari=".$vari."&page=".$page);
										include_once "tranfiunlo.ajax.php";
										exit;
									}else{
									}
															# вика се алтернативно от tran.php 
//print "TRANFI=";
															if($CALLFROMALTE){
															}else{
							# въведено дело 
							$seyefina= $_POST["seyefina"];
							if (isset($seyefina)){
//unset($vari);
				list($myseri,$myyear)= explode("/",$seyefina);
				if (strlen($myyear)==2){
					$myyear= "20".$myyear;
				}else{
				}
				$idcase= $DB->selectCell("select id from suit where serial=?d and year=?d"  ,$myseri,$myyear);
				$idcase += 0;
				if ($idcase==0){
$smarty->assign("ERCASE", "липсва дело $seyefina");
unset($idcase);
				}else{
				}
							}else{
				$idcase= $GETPARAM["idcase"];
							}
															# if($CALLFROMALTE){
															}
									# постъпленията за избрано дело 
//									$idcase= $GETPARAM["idcase"];
									if (isset($idcase)){
										include_once "tranficase.php";
//										exit;
# не ajax 
return;
									}else{
									}

									//# функции за филтрите 
									//include_once "tranfi.inc.php";

# списъка със странициране 
					include "pagi.class.php";
//$query= finaquery();
/*
		$qutran= "select finance.*, finance.id as id, finance.idcase as idcase
			, suit.serial as caseseri, suit.year as caseyear
					, user.name as username
					, finasource.id as idsour, finasource.idfinabank, finasource.date as finadate, finasource.hour as finahour
					, finabank.codebank as codebank
							, t3.name as lockname
			from finance 
			left join suit on finance.idcase=suit.id
			left join user on suit.iduser=user.id
			left join finasource on finance.id=finasource.idfinance
			left join finabank on finasource.idfinabank=finabank.id
							left join user as t3 on suit.lockedby=t3.id
			";
*/
//$query= "$query where $filtcode and $exfiltcode order by finance.created desc, $ordedist, finance.id";
$qutranpage= "$qutran where $basefilt order by finance.created desc, finance.id desc";
//print $query;
//	$query= "$query order by finance.id desc";
//	$query= "$query where finance.idtype in (1,7,9) order by finance.id desc";
		$prefurl= "";
//		$baseurl= "mode=".$mode ."&filtpara=".$filtpara;
		$baseurl= "mode=".$mode;
		$obpagi= new paginator(24, 8, $qutranpage);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);

//		$modeel= "mode=".$mode ."&page=".$page ."&filtpara=".$filtpara;
		$modeel= "mode=".$mode ."&page=".$page;
foreach ($mylist as $uskey=>$uscont){
//				$idcurr= $uscont["id"];
	$mylist[$uskey]["linkcase"]= geturl($modeel."&idcase=".$uscont["idcase"]);
	$mylist[$uskey]["unlock"]= geturl($modeel."&unlock=".$uscont["id"]);
}
//print_rr(toutf8($mylist));

# извеждане 
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("tranfi.tpl","fetch");

?>