<?php


# формира данни за запис взискател/длъжник 
function getdata34($ARPOST){
global $ficonst, $filist;
		$aset= $ficonst;
		foreach($filist as $finame=>$ficont){
			if ($ficont["inactive"]){
			}else{
				$aset[$finame]= $ARPOST[$finame];
			}
		}
			# 20.04.2011 - флаг присъединен взискател 
global $isclaimer;
			if ($isclaimer){
$aset["isjoin"]= isset($ARPOST["isjoin"]) ? 1 : 0;
			}else{
//			# 11.10.2011 - съотв. флаг длъжника да не се предава в регистъра 
//$aset["isnoregi"]= isset($ARPOST["isnoregi"]) ? 1 : 0;
			}
# 24.10.2014 - взискателя/длъжника да не се предава в регистъра 
$aset["isnoregi"]= isset($ARPOST["isnoregi"]) ? 1 : 0;
		# 08.10.2010 - заради Регистъра на длъжници/взискатели 
global $ardata;
		$idtype= $ARPOST["idtype"];
		$t2fo= isset($ARPOST["t2fo"]) ? 1 : 0;
						$ardata= array();
		if ($idtype==1){
			$t1type= $ARPOST["t1type"];
			$t1stat= $ARPOST["t1stat"];
						$ardata["t1type"]= $t1type;
						$ardata["t1stat"]= $t1stat;
			$t1fo= isset($ARPOST["t1fo"]) ? 1 : 0;
						$ardata["t1fo"]= $t1fo;
			$t1cory= $ARPOST["t1cory"];
				if ($t1fo==1){
						$ardata["t1cory"]= $t1cory;
				}else{
				}
		}elseif ($idtype==2){
//@@@			$t2et= isset($ARPOST["t2et"]) ? 1 : 0;
			$t2fo= isset($ARPOST["t2fo"]) ? 1 : 0;
			$t2date= $ARPOST["t2date"];
			$t2cory= $ARPOST["t2cory"];
//@@@						$ardata["t2et"]= $t2et;
						$ardata["t2fo"]= $t2fo;
				if ($t2fo==1){
						$ardata["t2date"]= $t2date;
						$ardata["t2cory"]= $t2cory;
				}else{
				}
		}else{
//			$aset["bulstat"]= $ARPOST["buls2"];
			$aset["bulstat"]= $ARPOST["buls2"] ."";
			$t3type= $ARPOST["t3type"];
						$ardata["t3type"]= $t3type;
		}
//print "ardata=";
//print_rr($ardata);
	$aset["exdata"]= serialize($ardata);
return $aset;
}


?>