<?php
# отчет ВСС по взискатели - данни по дела за избран съд 
//print_rr($GETPARAM);


# заявката 
$code4= "
	where $filtmain and $filtperi and $codeclai='$code'
	group by concat(cayear,'@',caseri)
/*	order by concat(cayear,'@',caseri)	*/
	order by cayear,caseri
	";
//print "<br>".$code4;
//$tafilt= "(ta.c1+ta.c2+ta.c4+ta.c5+ta.c6)<>0 and (ta.c8+ta.c9+ta.c12+ta.c13+ta.c14)<>0";
$q4= str_replace("[CODEEXTE]",$code4,$qubase);
$query4= str_replace("[CODECLAI]",$codeclai,$q4);
$query4= "$query4 where $tafilt";
//queryout($query4);

# данни 
$ardata= $DB->select($query4);
$ardata= dbconv($ardata);
//print_ru($ardata);
$smarty->assign("AR2", $ardata);

# заглавие 
$arhead= $ardata[0];
list($arhead["iden"],$arhead["type"])= explode("^",$arhead["code"]);
$smarty->assign("ARHEAD", $arhead);
			
# извеждаме 
//$smarty->assign("ADDCAS", $addcas);
//$smarty->assign("CASELIST", $mylist);
$rep3cont= smdisp("rep3v22list.tpl","fetch");

?>