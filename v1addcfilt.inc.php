<?php

function getfilters(){
global $smarty;
							//$arfilt= array();
									$artextfilt= array();
		#-- име взискател - таблица claimer 
		$claitext= trim($_POST["claitext"]);
		if (empty($claitext)){
$filtclai= "";
		}else{
					$mycoreal= $claitext;
					$mycoreal= mysql_real_escape_string($mycoreal);
					$mycoreal= mysql_real_escape_string($mycoreal);
					$myco2= "%" .$mycoreal ."%";
//print "<br>mycoreal<br>";
//var_dump($mycoreal);
							//$arfilt[]= sprintf("upper(claimer.name) like upper('%s')"  ,$myco2);
$filtclai= sprintf("upper(claimer.name) like upper('%s')"  ,$myco2);
									$claitx= tran1251($claitext);
									$artextfilt[]= "взискател \"$claitx\"";
		}
		#-- име представител - таблица agent 
		$agentext= trim($_POST["agentext"]);
		if (empty($agentext)){
$filtagen= "";
		}else{
					$mycoreal= $agentext;
					$mycoreal= mysql_real_escape_string($mycoreal);
					$mycoreal= mysql_real_escape_string($mycoreal);
					$myco2= "%" .$mycoreal ."%";
//print "<br>mycoreal<br>";
//var_dump($mycoreal);
							//$arfilt[]= sprintf("upper(agent.name) like upper('%s')"  ,$myco2);
$filtagen= sprintf("upper(agent.name) like upper('%s')"  ,$myco2);
									$agentx= tran1251($agentext);
									$artextfilt[]= "представител \"$agentx\"";
 		}
//print_rr($arfilt);
		//# формираме филтъра и текста 
		//$filtcode= implode(" and ",$arfilt);
		# формираме текста 
		$filttext= implode(" и ",$artextfilt);
$smarty->assign("FILTTEXT",$filttext);
//var_dump($filtcode);
//return array($filtcode,$filttext);
return array($filtclai,$filtagen,$filttext);
}


function getlist($filtclai,$filtagen,$createmp,$limit){
global $DB;
/*
	$temp= "
		select distinct suit.id as idcase 
		from %s
		left join suit on %s.idcase=suit.id
		where %s
		";
	$quagen= sprintf($temp,"agent","agent",$filtagen);
	$quclai= sprintf($temp,"claimer","claimer",$filtclai);
*/
	$quclai= "
		select distinct suit.id as idcase 
		from claimer
		left join suit on claimer.idcase=suit.id
		where $filtclai
		";
	$quagen= "
		select distinct suit.id as idcase 
		from agent
		left join suit on suit.idagent=agent.id
		where $filtagen
		";
	if (empty($filtclai)){
		if (empty($filtagen)){
die("v1=getlist=1");
		}else{
			# филтър само за представител 
			$query= "
				$createmp
				$quagen
				$limi1
				";
		}
	}else{
		if (empty($filtagen)){
			# филтър само за взискател 
			$query= "
				$createmp
				$quclai
				$limi1
				";
		}else{
			# филтър и за взискател и за представител 
			# търсим не обединението на множествата (or)=union, 
			# а сечението (and)= вторична заявка в join  
/*
			$query= "
				$createmp
($quclai) 
union distinct
($quagen) 
				$limi1
				";
*/
			$query= "
				$createmp
select distinct suit.id as idcase 
from agent
left join suit on suit.idagent=agent.id
	left join ($quclai) as t2 on suit.id=t2.idcase
where $filtagen
	and t2.idcase is not null
				$limi1
				";
		}
	}
/*
			$q1= "
$createmp
			select distinct suit.id as idcase 
			from claimer
			left join suit on claimer.idcase=suit.id
			where $filtcode
$limi1
			";
*/
	# специфична заявка - query вместо select 
	$mylist= $DB->query($query);
//			if (empty($createmp)){
			if (is_array($mylist)){
	$mylist= dbconv($mylist);
			}else{
			}
return $mylist;
}



function addtolist($idviewer,$idcase){
global $DB;
	$myli= $DB->selectCol("select id from viewersuit where idviewer=?d and idcase=?d" ,$idviewer,$idcase);
	if (count($myli)==0){
			$aset= array();
			$aset["idviewer"]= $idviewer;
			$aset["idcase"]= $idcase;
		$DB->query("insert into viewersuit set ?a"  ,$aset);
return true;
	}else{
return false;
	}
}


?>
