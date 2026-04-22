<?php

class reorder {
	var $taname;

function reorder($taname){
	$this->taname= $taname;
}

function set(){
global $DB;
	$taname= $this->taname;
			$myco= $DB->selectCell("select count(*) from $taname where serial<>0");
			if ($myco==0){
//				$query= "select id as ARRAY_KEY, name from $taname order by id";
				$query= "select id from $taname order by id";
				$ardata= $DB->selectCol($query);
				$serial= 0;
//				foreach($ardata as $arin=>$x2){
				foreach($ardata as $arin){
					$serial ++;
					$DB->query("update $taname set serial=?d where id=?d" ,$serial,$arin);
				}
//print "SETTTTTTTTTTTTTTTT";
			}else{
			}
}

function put($put,$get){
global $DB;
	$taname= $this->taname;
//				$query= "select id as ARRAY_KEY, name from claimorigin order by serial";
				$query= "select id from $taname order by serial";
				$arfrom= $DB->selectCol($query);
					$getind= $_SESSION["getclor"];
											$ar2= array();
									foreach($arfrom as $arin){
/*
									foreach($arfrom as $arin=>$arco){
										if (0){
										}elseif ($arin==$get){
										}elseif ($arin==$put){
											$ar2[$get]= $arfrom[$get];
											$ar2[$arin]= $arco;
										}else{
											$ar2[$arin]= $arco;
										}
*/
										if (0){
										}elseif ($arin==$get){
										}elseif ($arin==$put){
											$ar2[$get]= "*";
											$ar2[$arin]= "*";
										}else{
											$ar2[$arin]= "*";
										}
									}
//print_r($ar2);
							$serial= 0;
							foreach($ar2 as $arin=>$x2){
//							foreach($ar2 as $arin){
								$serial ++;
								$DB->query("update $taname set serial=?d where id=?d" ,$serial,$arin);
							}
}


# class end 
}

?>
