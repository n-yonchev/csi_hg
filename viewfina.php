<?php
# списък постъпления по делата на наблюдател 
# източници : 
#    case.php +tpl 
#    fina.php +tpl _fina.tpl 
# източник : caseall2.php 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 

									include_once "fina.inc.php";
								
# текущата страница 
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

				# флага за отпечатване 
				$prinyes= $GETPARAM["prnt"];
				$flprin= ($prinyes=="yes");
				$smarty->assign("FLPRIN", $flprin);

# логнатия наблюдател =viewer.id 
$iduser= @$_SESSION["iduser"];
//var_dump($iduser);

# делата само на логнатия наблюдател 
$ext1= "left join (select * from viewersuit where idviewer=$iduser) as t2 on t2.idcase=suit.id";
$ext2= "and t2.id is not null";
$orby= "suit.year desc, suit.serial desc";

# заявката - делата 
$query= "select distinct suit.id as id, suit.*
				, user.name as username
	from suit 
				left join user on suit.iduser=user.id
												$ext1
	where 1 $ext2
	order by $orby
	";

				if ($flprin){
$mylist= $DB->select($query);
				}else{
# странициране 
					include "pagi.class.php";
		$prefurl= "";
		//$baseurl= "mode=".$mode ."&filt=".$filt;
		$baseurl= "mode=".$mode;
$obpagi= new paginator(10, 8, $query);
$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
				}
$mylist= dbconv($mylist);
//print_rr($mylist);
										#----------------------------------------------------------------------
										# 12.07.2010 - число - банк.такса за превод на разпределение 
										#----------------------------------------------------------------------
										# източник : cazofina.php 
										$rooffi= getofficerow($iduser);
										$banktax= $rooffi["banktax"] +0;
										$isbanktax= $banktax<>0;
//										$smarty->assign("BANKTAX", number_format($banktax,2,".",""));
//										$smarty->assign("BANKTAX", $banktax);
										$smarty->assign("ISBANKTAX", $isbanktax);
			
# постъпленията 
foreach($mylist as $uskey=>$uscont){
	$idcase= $uscont["id"];
				# извлечението за текущото постъпление 
				$finalist= $DB->select("select finance.*, finance.id as id, finasource.timebank as timebank
					from finance 
					left join finasource on finasource.idfinance=finance.id
					where finance.idcase=?d 
					order by finance.id desc
					"  ,$idcase);
		foreach($finalist as $infina=>$cofina){
										#----------------------------------------------------------------------
										# 12.07.2010 - число - банк.такса за превод на разпределение 
										#----------------------------------------------------------------------
										# обща сума на банк.такси 
										# източник : cazofina.php 
										if ($isbanktax){
											if (empty($cofina["toclaitax"])){
												$arclamtax= array();
											}else{
												$arclamtax= unsetoclai($cofina["toclaitax"]);
											}
											$sumabank= array_sum($arclamtax);
											$sumabank += $finalist[$infina]["backtax"];
			$finalist[$infina]["banktax"]= $sumabank;
										}else{
										}
			# 23.07.2010 - за взискателите - общата сума 
			finacalc($cofina, $finalist[$infina]);
					$claisuma= array_sum($finalist[$infina]["claiamou"]);
			$finalist[$infina]["claisuma"]= $claisuma;
		}
	$mylist[$uskey]["fina"]= $finalist;
}
$mylist= arstrip($mylist);
//print_rr($mylist);

							# за извеждане на "идва от" - кеширания масив 
							$arfrom= unserialize(file_get_contents(COFROMFILE));
							# предаваме съдържанието 
							$smarty->assign("ARFROM", $arfrom);
						# 03.05.2009 
						# за извеждане на статуса - съдържанието на 1-мерния масив 
						$smarty->assign("ARSTAT", $viewcasestat);
						# за извеждане на "тип" - масива $listfinatype - commspec.php 
						# предаваме съдържанието на масива 
						$smarty->assign("ARTYPE", $listfinatype2);
# print link 
$modeel= "mode=".$mode."&page=".$page;
$prntlink= geturl($modeel."&prnt=yes");

# извеждаме 
$smarty->assign("PRNTLINK", $prntlink);
$smarty->assign("CASELIST", $mylist);
//$pagecont= smdisp("viewfina.tpl","fetch");
						
						if ($flprin){
$rouser= getrow("viewer",$iduser);
$fina= $rouser["name"];
$fina= str_replace(" ","_",$fina);
//$fina= toutf8($fina);
# съдържанието 
//$cont= "таблица ексел";
$cont= smdisp("viewfinaprnt.tpl","fetch");
//var_dump($fina.".xls");
ExcelHeader($fina.".xls");
	$outp= "
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\" />
<body>
	$cont
</body>
</html>
	";
print $outp;
exit;
						}else{
# извеждане на текущата страница 
$pagecont= smdisp("viewfina.tpl","fetch");
						}

?>
