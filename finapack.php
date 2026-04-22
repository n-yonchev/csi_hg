<?php
# списък на пакетите за превод 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

# текущата страница 
//print_r($GETPARAM);
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

									# съдържание на избран пакет по дела 
									$pack= $GETPARAM["pack"];
									if (isset($pack)){
						if ($pack==0){
# добавяме нов пакет 
$DB->query("insert into finatranpack set created=now()");
# reload - отново списъка 
$relurl= geturl("mode=".$mode."&page=".$page);
reload("parent",$relurl);

						}else{
										include_once "finapackview.php";
										# в главния прозорец 
										return;
						}
									}else{
									}

									# съдържание на избран пакет по сметки 
									$acco= $GETPARAM["acco"];
									if (isset($acco)){
										include_once "finapackacco.php";
										# в главния прозорец 
										return;
									}else{
									}

# списъка 
		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
$query= "select * from finatranpack order by created desc";
		$prefurl= "";
		$baseurl= "mode=".$mode;
		$obpagi= new paginator(18, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);

# трансформираме го - параметри за иконите 
				$modeel= "mode=".$mode ."&page=".$page;
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
//	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
	$mylist[$uskey]["pack"]= geturl($modeel."&pack=".$idcurr);
	$mylist[$uskey]["acco"]= geturl($modeel."&acco=".$idcurr);
//			# обща сума 
//			$suma= $DB->selectCell("select sum(amount) from finatran where idfinatranpack=?d"  ,$idcurr);
//	$mylist[$uskey]["suma"]= $suma;
			# обща сума и общо преведена сума 
			$arsuma= $DB->selectRow(
				"select sum(amount) as tosuma, sum(if(isdone=0,0,amount)) as pasuma from finatran where idfinatranpack=?d"  
				,$idcurr);
	$mylist[$uskey]["suma"]= $arsuma["tosuma"];
	$mylist[$uskey]["pasuma"]= $arsuma["pasuma"];
			# сумите от пакета по дела 
			# източник : finapackview.php 
			$lis2= $DB->select("
				select finatran.*, finatran.id as id
				, suit.serial as caseseri, suit.year as caseyear
				, user.name as username, claimer.name as clainame
				, claim2.name as clai2name, claim2iban.descrip as descrip
				from finatran 
				left join finance on finatran.idfinance=finance.id
				left join suit on finance.idcase=suit.id
				left join user on suit.iduser=user.id
				left join claimer on finatran.idclaimer=claimer.id
					left join claim2 on finatran.idclaim2=claim2.id
					left join claim2iban on finatran.iban=claim2iban.iban and finatran.bic=claim2iban.bic
				where finatran.idfinatranpack=?d
				order by suit.year desc, suit.serial desc
				"  ,$idcurr);
			$lis2= dbconv($lis2);
	$mylist[$uskey]["listcase"]= $lis2;
					usort($lis2,"comp4");
	$mylist[$uskey]["listacco"]= $lis2;
//	$mylist[$uskey]["get"]= geturl($modeel."&get=".$idcurr);
//	$mylist[$uskey]["put"]= geturl($modeel."&put=".$idcurr);
}

# add new link 
$addnew= geturl($modeel."&pack=0");

# извеждаме 
$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("finapack.tpl","fetch");

					# функция за сравняване при сортировката по сметка 
					function comp4($p1,$p2){
						$ban1= $p1["iban"];
						$ban2= $p2["iban"];
						if ($ban1==$ban2){
							return 0;
						}elseif ($ban1<$ban2){
							return -1;
						}else{
							return 1;
						}
					}

?>
