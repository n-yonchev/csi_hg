<?php

# код за взискател 
//$codeclai= "concat(t1.name,'^',t1.iden,'^',t1.idtype)";
$codeclai= "concat(t1.iden,'^',t1.idtype)";

# филтър за съдилище 
$filtcont= "'%".toutf8("съд")."%'";
$filtmain= "lower(t1.name) like lower($filtcont)";
//print ($filtmain);
//die;

# антетка 
$arhe= array();
$arhe["h1"]= "Несвършени дела в началото на отчетния период";
$arhe["h2"]= "Постъпили";
$arhe["h3"]= "Всичко";
$arhe["h4"]= "Прекратени - Свършени чрез реализиране на вземането";
$arhe["h5"]= "Прекратени - По други причини";
$arhe["h6"]= "Изпратени на друг съдебен изпълнител";
$arhe["h7"]= "Останали несвършени  в края на отчетния период";
$arhe["h8"]= "От образуването им до началото на отчетния период";
$arhe["h9"]= "От образувани през отчетния период";
$arhe["h10"]= "Всичко";
$arhe["h11"]= "Общо";
$arhe["h12"]= "Лихви";
$arhe["h13"]= "Суми по изпълнителни листи";
$arhe["h14"]= "Несъбрани суми по опрощаване, прекр.по подс.перемция, изпратени на друг СИ, давност, обезсилване и др.за периода";
$arhe["h15"]= "Останала несъбрана сума по изпълнителни листове в края на отчетния период";
$smarty->assign("ARHE", $arhe);

# общи елементи 
# отгоре : $tarepo 
$tacoun= $tarepo."_c1";
$taclai= $tarepo."_c2";
$qufrom= "
	from `$taclai` as t1
	left join `$tacoun` as tacoun on t1.idcase=tacoun.idcase
	left join suit on t1.idcase=suit.id
	left join `$tarepo` as t2 on suit.serial=t2.serial and suit.year=t2.year
	";

//# само несвършени преди периода и образувани през периода 
//$filtperi= "tacoun.var1<>'00' and tacoun.var2<>'00' and tacoun.var1 is not null and tacoun.var2 is not null";
//$filtperi= "tacoun.var1 is not null and tacoun.var2 is not null";
//$filtperi= "(tacoun.var1<>'00' or tacoun.var2<>'00') and suit.idrepo<>0";
$filtperi= "suit.idrepo<>0";

# базова заявка 
$qubase= "
	select ta.*
		, ta.c1+ta.c2 as c3
		, ta.c1+ta.c2 -ta.c4-ta.c5-ta.c6 as c7
		, ta.c8+ta.c9 as c10
		, ta.c12+ta.c13 as c11
		, (ta.c8+ta.c9)-(ta.c12+ta.c13) as c15
	from (
		select [CODECLAI] as code
			, suit.serial as caseri, suit.year as cayear
			, sum(tacoun.c1) as c1, sum(tacoun.c2) as c2, sum(tacoun.c4) as c4, sum(tacoun.c5) as c5, sum(tacoun.c6) as c6
			, round(sum(round(t2.c1,2)),2) as c8, round(sum(round(t2.c2,2)),2) as c9
			, round(sum(round(t2.c8,2)),2) as c12, round(sum(round(t2.c9,2)),2) as c13, round(sum(round(t2.c11diff,2)),2) as c14
			, count(t1.idcase) as coun, t1.name as name
		$qufrom
[CODEEXTE]
	) as ta
	";


?>