<?php
# извежда текст за формиране на отчет раздел 1 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
# и още отгоре : 
#    $period - периода за отчета 


# текста за периода 
$arpe= explode("-",$period);
$smarty->assign("ARPERI", $arpe);

# URL за вътр.фрейм, който извежда 
$urlcreate= geturl("mode=".$mode."&period=".$period."&create=1");
$smarty->assign("URLCREATE", $urlcreate);

# извеждаме 
$smarty->assign("PERIOD", $period);
//$smarty->assign("LIST", $mylist);
$pagecont= smdisp("rep1list.tpl","fetch");

?>
