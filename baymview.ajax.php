<?php
# разглеждане на XML файла за изходящ банков пакет 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $page - текущата страница 
# $view - id на пакетa 

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

# шаблона 
$tpname= "baymview.ajax.tpl";

# получаваме съдържанието на XML файла 
$xmlc= xmlcreate($view);

# извеждаме XML файла 
$xmlc= str_replace("<","&nbsp;<font color=blue[C_L_O_S]&lt;",$xmlc);
$xmlc= str_replace(">","&gt;</font>&nbsp;",$xmlc);
$xmlc= str_replace("[O_P_E_N]","<",$xmlc);
$xmlc= str_replace("[C_L_O_S]",">",$xmlc);

$smarty->assign("CONT", nl2br($xmlc));
print smdisp($tpname,"iconv");


?>
