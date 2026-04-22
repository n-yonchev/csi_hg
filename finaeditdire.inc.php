<?php
# специален скрипт за тип=9=директно 
# СТАНДАРТ. 
# инклудва се 2 пъти в горния скрипт - с 2 различни входни параметъра 
# отгоре входен параматър : 
#     $INPARA = 1,2 

if ($INPARA=="1"){
//print "11111111111111111111111111111111";
/***
	# след submit - проверки и запис 
	# $idcase вече съдържа назначеното дело 
	if (empty($idcase)){
		# няма избрано дело 
											$lister["idcase"]= "няма избрано дело";
	}else{
		# има избрано дело - проверяваме полетата 
		$idclaimer= $_POST["idclaimer"];
		if (empty($idclaimer)){
											$lister["idcase"]= "няма избран взискател";
		}else{
											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
#---------------------------------- няма грешки ----------------------------------- 
							$retucode= 0;
		# подготвяме данните 
		$aset= $ficonst;



		}
	}
***/
	

	# запис след submit 
		$arclai= array($idclaimer=>$aset["inco"]);
		$aset["toclai"]= serialize($arclai);
	# записваме 
	if ($edit==0){
		# нов запис 
		# - все още не е избрано дело и няма разпределение 
		$edit= $DB->query("insert into $taname set ?a, time=now()" ,$aset);
	}else{
		# корекция на записа 
		# ВНИМАНИЕ. $idcase вече е трансформирано и проверено 
/*
		if (empty($idcase)){
			# не е избрано дело - чистим полетата за разпределение 
			$aset["separa"]= "";
			$aset["toclai"]= "";
		}else{
			# взискателите по делото 
			$clailist= getclailist($idcase);
$smarty->assign("CLAILIST", $clailist);
			# има избрано дело - формираме полетата за разпределение 
			$separa= (empty($separa)) ? $separa : number_format($separa,2,".","");
			$aset["separa"]= $separa;
						$arclai= array();
//print_r($clailist);
			foreach($clailist as $idclai=>$x2){
				$claipostname= $claipref.$idclai;
				$clamou= $_POST[$claipostname];
//print "<br>[$idclai][$claipostname][$clamou]";
				$clamou= (empty($clamou)) ? $clamou : number_format($clamou,2,".","");
						$arclai[$idclai]= $clamou;
			}
//print_r($arclai);
			$aset["toclai"]= serialize($arclai);
		}
*/
		$DB->query("update $taname set ?a, time=now() where id=?d" ,$aset,$edit);
	}

}elseif ($INPARA=="2"){
//print "2222222222222222222222222222222";
	# накрая преди извеждане - 
	# списъка на взискателите - за избор на взискател от select/option 
								$myidcase= 0;
						if ($edit==0){
							if ($CALLFROMCASE){
								$myidcase= $editcase;
							}else{
								$myidcase= $idcase;
							}
						}else{
								$myidcase= $idcase;
						}
						if ($myidcase==0){
						}else{
							$clailist= getclailist($myidcase);
											if (count($clailist)==1){
	$smarty->assign("CLAIONE", $clailist);
											}else{
								$claisele= array(0=>"");
							foreach($clailist as $arin=>$arel){
								$claisele[$arin]= toutf8(stripslashes($arel));
							}
	$smarty->assign("CLAISELENAME", "claisele");
											}
						}

}else{
}

?>
