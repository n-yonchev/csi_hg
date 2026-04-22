<?php
# изходящи банкови пакети за плащане 
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

# филтър за назначените постъпления, които още не са включени в изходящ пакет 
$filt= "idclaimer>0 and idbankpaym=0";
# от тях - филтър за готовите за включване 
# тоест и трите полета iban, bic, payrem1 не са празни 
$filtready= $filt ." and payiban<>'' and paybic<>'' and payrem1<>''";

									# разглеждане на списъка с готовите за включване или всички 
									# вика се в основния прозорец, а не в ajax 
									$viewlist= $GETPARAM["viewlist"];
									if (isset($viewlist)){
$smarty->assign("PAGEBACK", $page);
$smarty->assign("PAGEBACKLINK", geturl("mode=".$mode ."&page=".$page));
										include_once "baymviewlist.php";
//										exit;
$smarty->assign("VIEWLIST", $viewlist);
$pagecont= smdisp("baymviewlist.tpl","fetch");
return;
									}else{
									}
									# анулиране/формиране на пакет 
									# изпълнява се директно 
									$cancel= $GETPARAM["cancel"];
									if (isset($cancel)){
											if ($cancel==0){
											#------ формираме нов пакет ------
//										include_once "baymcrea.ajax.php";
//										exit;
	# id на пакета с макс.сериен номер 
	$maxser= $DB->selectCell("select max(serial) from bankpaym");
	# следващия сер.номер 
	$maxser ++;
	# формираме нов пакет 
	$newid= $DB->query("insert into bankpaym set created=now(), serial=$maxser");
//var_dump($newid);
	# назначаваме към новия пакет всички постъпления, които още не са включени в пакет 
	# но само готовите от тях 
	$DB->query("update bank set idbankpaym=?d where $filtready" ,$newid);
	# директно download на файла за пакета - след обновяване на страницата 
			$modeel= "mode=".$mode ."&page=".$page;
			$diredown= geturl($modeel."&down=".$newid);
	$smarty->assign("DIREDOWN", $diredown);
											}else{
											#------ анулираме съществуващ пакет ------
																$DB->query("lock tables bankpaym write, bank write");
	$DB->query("update bank set idbankpaym=0 where idbankpaym=$cancel");
	$DB->query("delete from bankpaym where id=$cancel");
																$DB->query("unlock tables");
											}
									}else{
									}
									# разглеждане на XML файла за пакет 
									# вика се в ajax прозорец 
									$view= $GETPARAM["view"];
									if (isset($view)){
										include_once "baymview.ajax.php";
										exit;
									}else{
									}
									# download на XML файла за пакет 
									# вика се в скрит вътр.фрейм на главния прозорец 
									$down= $GETPARAM["down"];
									if (isset($down)){
										include_once "baymdown.php";
										exit;
									}else{
									}

# списъка с изходящи пакети 
		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
		$query= "select * from bankpaym order by created desc";
		$prefurl= "";
		$baseurl= "mode=".$mode;
		$obpagi= new paginator(8, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);

# трансформираме го - параметри за иконите 
				$modeel= "mode=".$mode ."&page=".$page;
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
	$mylist[$uskey]["cancel"]= geturl($modeel."&cancel=".$idcurr);
	$mylist[$uskey]["view"]= geturl($modeel."&view=".$idcurr);
	$mylist[$uskey]["down"]= geturl($modeel."&down=".$idcurr);
	# и броя/сумата на плащанията в текущия пакет 
		# ВНИМАНИЕ. 
		# Изтриваме запетаите като ряазделител за хилядите 
		$amorep= "replace(AMOUNT_C,',','')";
		$listpaym= $DB->select("select count(id) as coun, sum($amorep) as amou 
		from bank where idbankpaym=$idcurr group by idbankpaym");
//print_r($listpaym);
	$mylist[$uskey]["coun"]= $listpaym[0]["coun"];
	$mylist[$uskey]["amou"]= $listpaym[0]["amou"];
}

# броя на назначените постъпления, които още на са включени в изходящ пакет 
//$filt= "idclaimer>0 and idbankpaym=0";
$counpa= $DB->selectCell("select count(id) from bank where $filt");
# колко от тях са готови за включване 
# тоест и трите полета iban, bic, payrem1 не са празни 
//$filtready= $filt ." and payiban<>'' and paybic<>'' and payrem1<>''";
$counready= $DB->selectCell("select count(id) from bank where $filtready");
# за извеждане 
$smarty->assign("COUNPA", $counpa);
$smarty->assign("COUNREADY", $counready);

# add new link 
$addnew= geturl($modeel."&cancel=0");
$smarty->assign("ADDNEW", $addnew);
# бутон за списъка с всички 
$viewall= geturl($modeel."&viewlist=all");
$smarty->assign("VIEWALL", $viewall);
# бутон за списъка с готовите 
$viewready= geturl($modeel."&viewlist=ready");
$smarty->assign("VIEWREADY", $viewready);

# id на пакета с макс.сериен номер 
$maxser= $DB->selectCell("select max(serial) from bankpaym");
$smarty->assign("MAXSER", $maxser);

//# допълнителни js линкове за секцията head 
//$smarty->assign("HEADJS", array("cluetip.hoverIntent.js","jquery.cluetip.js"));

# извеждаме 
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("baym.tpl","fetch");




# връща стринг с XML файла за даден пакет 
function xmlcreate($idpack){
global $DB;
	# четем плащанията от новия пакет 
	# източник : bapaelem.php 
		$query= "select bank.*, bank.id as id
				,claimer.name as clainame ,claimer.iban as claiiban ,claimer.bic as claibic
			from bank 
				left join claimer on bank.idclaimer=claimer.id
			where bank.idbankpaym=$idpack
			order by bank.id
			";
	$mylist= $DB->select($query);
	$mylist= dbconv($mylist);
//print_r($mylist);

	# формираме масив за XML файла за експорт 
	$const1= '<TRANSID>IBAN311</TRANSID>';
	$const2= '<CURRENCY>BGN</CURRENCY>';
					# начало 
					$arxml= array();
					$arxml[]= '<?xml version="1.0" encoding="windows-1251" ?>';
					$arxml[]= '<PAYMENTS>';
	foreach($mylist as $elem){
					$arxml[]= '<PAYMENT>';
					$arxml[]= $const1;
			$arxml[]= '<NAME_R>'.$elem["clainame"].'</NAME_R>';
			$arxml[]= '<IBAN_R>'.$elem["claiiban"].'</IBAN_R>';
			$arxml[]= '<BIC_R>'.$elem["claibic"].'</BIC_R>';
					$arxml[]= $const2;
		# сумата - трием запетаите за хилядите 
		$amou= str_replace(",","",$elem["AMOUNT_C"]);
		$arxml[]= '<JSUM>'.$amou.'</JSUM>';
			$arxml[]= '<REM_I>'.$elem["payrem1"].'</REM_I>';
						if (empty($elem["payrem2"])){
						}else{
			$arxml[]= '<REM_II>'.$elem["payrem2"].'</REM_II>';
						}
					$arxml[]= '</PAYMENT>';
	}
					# край 
					$arxml[]= '</PAYMENTS>';
//print_r($arxml);

	# формираме самия XML файл 
	$xmltex= implode("\n",$arxml);
return $xmltex;
}


?>
