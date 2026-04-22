<?php
# разглеждане историята на избрано постъпление 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $hist - finance.id за разглеждане 
//print $hist;
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

# списъка 
$myli= $DB->select("select * from finahist where idfinance=?d order by id desc"  ,$hist);
$myli= dbconv($myli);
//print_r($myli);
				$mylist= array();
foreach($myli as $elem){
//	$mycont= $elem["content"];
//				$mylist[]= unseriraw($mycont);
# ВНИМАНИЕ. 
# имената трябва да отговарят на шаблона _fina.tpl, който се вика от finahist.ajax.tpl 
	$myar= unseriraw($elem["content"]);
		$rouser= getrow("user",$myar["iduser"]);
	$myar["finaname"]= $rouser["name"];
		$rocase= getrow("suit",$myar["idcase"]);
	$myar["caseseri"]= $rocase["serial"];
	$myar["caseyear"]= $rocase["year"];
		$rouser= getrow("user",$rocase["iduser"]);
	$myar["username"]= $rouser["name"];
				# изчисляваме и зареждаме балансовите полета 
	finacalc($myar, $myar);
//print_rr(to1251($myar));
										#----------------------------------------------------------------------
										# 12.07.2010 - число - банк.такса за превод на разпределение 
										#----------------------------------------------------------------------
										# обща сума на банк.такси 
										# източник : cazofina.php 
										if ($isbanktax){
											if (empty($myar["toclaitax"])){
												$arclamtax= array();
											}else{
												$arclamtax= unsetoclai($myar["toclaitax"]);
											}
											$sumabank= array_sum($arclamtax);
											$sumabank += $myar["backtax"];
//var_dump($sumabank);
	$myar["banktax"]= $sumabank;
										}else{
										}
		# 23.07.2010 - за взискателите - обща сума с cluetip 
		# изчисляваме общата сума 
		$claisuma= array_sum($myar["claiamou"]);
	$myar["claisuma"]= $claisuma;
				
				# записваме в основния масив 
				$mylist[]= $myar;
}
//print_r(to1251($mylist));

		# 23.07.2010 - за взискателите - обща сума с cluetip 
		# допълнителни js линкове за секцията head 
		$smarty->assign("HEADJS", array("cluetip.hoverIntent.js","jquery.cluetip.js"));

						# за извеждане на "тип" - масива $listfinatype - commspec.php 
						# предаваме съдържанието на масива 
						$smarty->assign("ARTYPE", $listfinatype);

# извеждаме 
$smarty->assign("LIST", $mylist);
//$pagecont= smdisp("fina.tpl","fetch");
print smdisp("finahist.ajax.tpl","iconv");


?>
