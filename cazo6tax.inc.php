<?php
										# 23.06.2010 - флаг - при изходяване на документ 
										# автоматично да се добавя таксата като предмет на изпълнение 

# добавя запис с предмет на изпълнение такса 
function insertsubject($iddocuout){
global $DB;
//print_rr($_POST);
							# само ако сумата не е нулева 
							if ($_POST["regitax"] +0==0){
							}else{
			$rodout= getrow("docuout",$iddocuout);
			$idcase= $rodout["idcase"];
	$sset= array();
	$sset["idcase"]= $rodout["idcase"];
	$sset["text"]= $_POST["regitext"];
		# неолихвяема сума 
	$sset["idtype"]= 2;
		# приети други разходи 
	$sset["idsubtype"]= 8;
	$sset["amount"]= $_POST["regitax"];
	$sset["fromdate"]= date("Y-m-d");
		# първия взискател по делото 
		$idclai= $DB->selectCell("select id from claimer where idcase=?d order by id limit 1"  ,$idcase);
	$sset["idclaimer"]= $idclai +0;
		# първия длъжник по делото 
		$iddebt= $DB->selectCell("select id from debtor where idcase=?d order by id limit 1"  ,$idcase);
	$sset["listdebtor"]= $iddebt +0;
	$sset["istoclaimer"]= 0;
	$sset["isintax"]= 0;
	$DB->query("insert into subject set ?a"  ,$sset);
							# край - само ако сумата не е нулева 
							}
}

?>
