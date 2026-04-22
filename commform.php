<?php
# формиране на формули за Excel чрез HTML 

function formrow(&$arresu,$cellresu,$arform,$range){
//print "FORMROW";
	list($first,$last)= explode("-",$range);
	for ($curr=$first; $curr<=$last; $curr++){
					$resu= "";
								$flagoper= false;
		foreach($arform as $elem){
			if ($flagoper){
					$resu .= $elem;
			}else{
					$resu .= $elem.$curr;
			}
								$flagoper= ! $flagoper;
		}
		$arresu[$cellresu.$curr]= "=".$resu;
//print "<br>$resu";
	}
}

function formcol(&$arresu,$cellresu,$arform,$range){
//print "FORMCOL";
	list($first,$last)= explode("-",$range);
	$ordfir= ord($first);
	$ordlas= ord($last);
	for ($curr=$ordfir; $curr<=$ordlas; $curr++){
		$chrcurr= chr($curr);
					$resu= "";
								$flagoper= false;
		foreach($arform as $elem){
			if ($flagoper){
					$resu .= $elem;
			}else{
					$resu .= $chrcurr.$elem;
			}
								$flagoper= ! $flagoper;
		}
		$arresu[$chrcurr.$cellresu]= "=".$resu;
//print "<br>$resu";
	}
}

?>
