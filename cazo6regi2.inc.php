<?php


#----------------------------------------------------------------------------------
# заместване на стринг с евент.тагове 
function tranpost($pacont){
//global $dele1, $dele2;
	$dele1= "(-[";
	$dele2= "]-)";
	$inde1= strpos($pacont,$dele1);
	$inde2= strpos($pacont,$dele2);
	if ($inde1 !==false and $inde2 !==false){
					# етап-1 : заместване {empty} {/empty} 
					$pacont= replempty($pacont);
		# етап-2 : обичайно заместване на тагове 
		$pattern= '|' .'\(\-\[' .'.+?' .'\]\-\)' .'|is';
		$found= preg_match_all($pattern, $pacont, $matches);
//print_rr($matches[0]);
					$resu= $pacont;
		foreach($matches[0] as $elem){
			$elemcont= replcont($elem);
//			if ($elemcont===false){
//				$resu= str_replace($elem," ===ERROR-POST-1=== ",$resu);
//			}else{
				$resu= str_replace($elem,$elemcont,$resu);
//			}
		}
//var_dump($resu);
return $resu;
	}else{
return $pacont;
	}
}

#----------------------------------------------------------------------------------
# заместване на таг 
function replcont($p1){
global $armeta, $artent;
global $arregistration;
	$inregi= array_search($p1,$arregistration);
	$inmeta= array_search($p1,$armeta);
	if ($inregi !==false){
		# намерен в списъка на груповите тагове - не го заместваме 
return $p1;
	}elseif ($inmeta !==false){
		# намерен в списъка на таговете за заместване в документа - заместваме със значението 
return $artent[$inmeta];
	}else{
		# не е нито групов таг, нито го има за заместване - не го заместваме 
		# вероятно е действителен таг, който не е в документа 
return $p1;
	}
}


									
#----------------------------------------------------------------------------------
# заместване : {empty}{маркер}съдържание{/empty} 
# източник=копие : cazo6.php 
function replempty($cont){
global $armeta, $artent;
							# регулярния израз за търсене 
							$rbeg= "{empty}";
							$rend= "{/empty}";
//							$pattern= '|' .$rbeg .'.+?' .$rend .'|';
											# 27.04.2010 - 
											# i= insensitive, s= на повече от един ред 
											$pattern= '|' .$rbeg .'.+?' .$rend .'|is';
							# търсим 
							$found= preg_match_all($pattern, $cont, $matches);
							# цикъл за всички намерени стрингове 
							foreach($matches[0] as $x1=>$maco){
//print "<br>$maco";
								#--- за текущия стринг 
								# отделяме маркера 
								$blen= strlen($rbeg) +1;
								$mac2= substr($maco,$blen);
								$pos2= strpos($mac2,"}");
								$cumark= substr($mac2,0,$pos2);
//print "[$cumark]";
								# съдържанието за заместване на маркера 
								$emmark= "(-[" .$cumark ."]-)";
								$emindx= array_search($emmark,$armeta);
								if ($emindx===false){
die("cazo6creapost=emindx=$cumark");
								}else{
									$emcont= $artent[$emindx];
//print "[$emcont]";
								}
								# според съдържанието на маркера 
//								if (empty($emcont)){
								if (empty($emcont)    or $emcont=="0.00"){
									# празно съдържание на маркера 
									# ще премахнем целия текст заедно с таговете {empty}{маркер} текст {/empty} 
									$newcont= "";
								}else{
									# има съдържание на маркера 
									# ще оставим текста, но премахваме самите тагове {empty}{маркер} текст {/empty} 
									$newcont= $maco;
									$newcont= str_replace($rbeg,"",$newcont);
									$newcont= str_replace($rend,"",$newcont);
									$newcont= str_replace("{".$cumark."}","",$newcont);
								}
								# заместваме за текущия стринг 
		$cont= str_replace($maco, $newcont, $cont);
							# край на цикъла за всички намерени стрингове 
							}
return $cont;
}
#----------------------------------------------------------------------------------


?>