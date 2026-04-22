<?php
# подготовка за преводи към взискателите 

#------------------------------------ етап 1 ------------------------------------------

				# ВНИМАНИЕ. ЛЕПЕНКА. Иначе при Бъзински става нного бавно. 
				# само за постъпилите през и след месец 2010-03 
				$filtmont= " and year(time)=2010 and month(time)>=3";

# четем всички постъпления - неприключени, с избран от името на кой длъжник, изравнени 
$mylist= $DB->select("select id as ARRAY_KEY, idcase, iddebtor, toclai from finance 
	where isclosed=0 and iddebtor<>0 and rest+0=0
	$filtmont
	");
$mylist= dbconv($mylist);

#------------------------------------ етап 2 ------------------------------------------

# изчистваме работната таблица 
$DB->query("truncate table finatransfer");

# размножаваме всеки първичен запис по всички взискатели, на които са назначени суми за превод 
# записваме размножените запиои в работната таблица 
foreach($mylist as $idfina=>$elem){
						$aset= array();
						$aset["idfina"]= $idfina;
	$arclaiamou= unsetoclai($elem["toclai"]);
//print "<br>$idfina";
//print_rr($arclaiamou);
	# специфични данни или грешка 
								$codeabnorm= "";
	if (empty($arclaiamou)){
								# няма масив със суми за взискатели - възможно, ако цялата сума е за ЧСИ 
								$codeabnorm= "no.clai";
	}else{
		# четем списъци с взискатели и длъжници по делото 
		$idcase= $elem["idcase"];
		$arclai= $DB->select("select id as ARRAY_KEY, name, iban, bic from claimer where idcase=?d"  ,$idcase);
		$ardebt= $DB->selectCol("select id from debtor where idcase=?d"  ,$idcase);
		# от името на кой - длъжника има ли го в списъка 
		$idde= $elem["iddebtor"];
		if (in_array($idde,$ardebt)){
			# има го - проверяваме за всеки взискател 
			foreach($arclaiamou as $claiid=>$claiam){
				if (in_array($claiid, array_keys($arclai))){
					# поредния взискател е в списъка - сумата да не е нулева 
					if ($claiam+0 <=0){
								# поредния взискател липсва в списъка - грешка 
								$codeabnorm= "c/$claiid/$claiam";
						# край на цикъла по взискатели 
						break;
					}else{
					}
				}else{
								# поредния взискател липсва в списъка - грешка 
								$codeabnorm= "c=$claiid";
					# край на цикъла по взискатели 
					break;
				}
			}
			
		}else{
								# длъжника го няма в списъка - грешка 
								$codeabnorm= "d=$idde";
		}
	}
	# записваме 
	$aset["codeabnorm"]= $codeabnorm;
	$aset["iddebtor"]= $elem["iddebtor"];
								if ($codeabnorm==""){
	# няма грешка - по 1 запис за всеки взискател 
	foreach($arclaiamou as $claiid=>$claiam){
		$aset["idclai"]= $claiid;
		$aset["amount"]= $claiam;
		$aset["name"]= $arclai[$claiid]["name"];
		$aset["iban"]= $arclai[$claiid]["iban"];
		$aset["bic"]=  $arclai[$claiid]["bic"];
				# трансформираме заради групирането в следв.етап 
				if (empty($aset["iban"])){
//		$aset["iban"]= toutf8("липсва")."[".$claiid."]";
		$aset["iban"]= "[".$claiid."]";
				}else{
				}
				if (empty($aset["bic"])){
//		$aset["bic"]= toutf8("липсва")."[".$claiid."]";
		$aset["bic"]= "[".$claiid."]";
				}else{
				}
		# запис 
		$DB->query("insert into finatransfer set ?a"  ,$aset);
	}
								}else{
	# има грешка - само 1 запис с кода на грешката 
	$DB->query("insert into finatransfer set ?a"  ,$aset);
								}
}
# получихме работната таблица 


#------------------------------------ етап 3 ------------------------------------------

# изчистваме сумарната работна таблица 
$DB->query("truncate table finatransfer2");
# попълваме я със сумите по уникален взискател 
$DB->query("insert into finatransfer2
	select id, name, iban, bic, sum(amount) as sumamo
	from finatransfer
	where codeabnorm=''
	group by iban
	");
//	group by iban, bic


# извеждаме 
//$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("finatocrea.tpl","fetch");

?>
