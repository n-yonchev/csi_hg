<?php

/*
		# 15.04.2010 - Бъзински - влизат само : 
		#    тип=1 - банка, само ако има връзка с банк.постъпления 
		#    тип=2 - в-брой 
		$typefilt= "(finance.idtype=2 or finance.idtype=1 and finasource.id is not null)";
		$typelink= "left join finasource on finasource.idfinance=finance.id";
$typefiltcode= "if(finance.idtype=2 or finance.idtype=1 and finasource.id is not null  ,1,0)";
*/

# 14.06.2010 - Бъзински (Софрониев) - влизат всички : 
#    тип=1 - банка, независимо дали има връзка с банк.постъпления 
#    тип=2 - в-брой 
#    тип=7 - старо 
#    тип=9 - директно за взискателя - няма да има разпределени суми за ЧСИ - separa, separa2 
$typefilt= "1";
$typelink= "left join finasource on finasource.idfinance=finance.id";
$typefiltcode= "1";

?>
