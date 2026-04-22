<?php

									include_once "common.php";

$tofile= "register/persons.csv";

		# от основ.данни - флаг дали в данните за регистъра да участват взискателите
		$rooffi= getofficerow($iduser);
		$isregiclai= ($rooffi["isregiclai"]<>0);

						$f1= fopen($tofile,"w");
		if ($isregiclai){
output("claimer",0);
		}else{
		}
output("debtor",1);
						fclose($f1);

//////print "OK";

function output($taname,$actype){
global $DB;
global $f1;
	$mylist= $DB->select("
		select $taname.idtype, $taname.egn, $taname.bulstat, $taname.name, $taname.exdata
			,suit.year as caseyear, suit.serial as caseseri
		from $taname
		left join suit on $taname.idcase=suit.id
		where suit.id is not null
		order by caseyear, caseseri
		");
//print_rr($mylist);
//$mylist= arstrip($mylist);
	foreach($mylist as $elem){
		$elem= arstrip($elem);
//		$ardata= unserialize($elem["exdata"]);
		if (empty($elem["exdata"])){
			$ardata= array();
		}else{
			$ardata= unserialize($elem["exdata"]);
		}
			$aset= array();
			$aset[]= $elem["caseyear"];
			$aset[]= regicaseseri($elem["caseseri"]);
			$aset[]= $actype;
		$idtype= $elem["idtype"];
		if ($idtype==1){
			$aset[]= "";
			$aset[]= $elem["bulstat"];
			$aset[]= "";
			$aset[]= "";
			$aset[]= "";
			$aset[]= $elem["name"];
# default=3 юр.лице със стопанска цел 
//			$aset[]= $ardata["t1type"];
			$aset[]= isset($ardata["t1type"]) ? $ardata["t1type"] : 3;
			$aset[]= "";
			$aset[]= "";
			$aset[]= "";
# default=0 активен 
//			$aset[]= $ardata["t1stat"];
			$aset[]= isset($ardata["t1stat"]) ? $ardata["t1stat"] : 0;
		}elseif ($idtype==2){
			$aset[]= $elem["egn"];
			$aset[]= "";
					$arwork= explode(" ",$elem["name"]);
								$arname= array("","","");
								$inname= 0;
					foreach($arwork as $elna){
						if ($elna==""){
						}else{
								if ($inname==2){
									if ($arname[2]==""){
										$arname[2]= $elna;
									}else{
										$arname[2] .= (" ".$elna);
									}
								}else{
									$arname[$inname]= $elna;
									$inname ++;
								}
						}
					}
			$aset[]= $arname[0];
			$aset[]= $arname[1];
			$aset[]= $arname[2];
			$aset[]= "";
					if ($ardata["t2et"]==0){
			$aset[]= 1;
					}else{
			$aset[]= 2;
					}
					if ($ardata["t2fo"]==0){
			$aset[]= "";
			$aset[]= 0;
			$aset[]= "";
					}else{
			$aset[]= $ardata["t2cory"];
//			$aset[]= "country";
			$aset[]= 1;
			$aset[]= bgdateto($ardata["t2date"]);
					}
			$aset[]= 0;		// физ.лице=активен ? 
		}else{
			$aset[]= "";
			$aset[]= "";
			$aset[]= "";
			$aset[]= "";
			$aset[]= "";
			$aset[]= $elem["name"];
			$aset[]= $ardata["t3type"];
			$aset[]= "";
			$aset[]= "";
			$aset[]= "";
			$aset[]= 0;		// други=активен ? 
		}
						fputcsv($f1,$aset);
	}
}

?>
